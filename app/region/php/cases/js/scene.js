import * as THREE from "three";
import { GLTFLoader } from "GLTFLoader";
import { PointerLockControls } from "PointerLockControls";
import { HDRLoader } from "HDRLoader";

import { RGBELoader } from "RGBELoader";

import { OrbitControls } from "OrbitControls";

let camera, scene, renderer, controls;
let avatar;
let clock = new THREE.Clock();

// Controladores de movimiento
const moveState = {
    forward: false,
    backward: false,
    left: false,
    right: false
};
const velocity = new THREE.Vector3();

let mixer;

let walkAction, walkBackAction, idleAction;

// Inicializa la escena
function init() {
    // Escena
    scene = new THREE.Scene();
    scene.background = new THREE.Color(0x87ceeb); // Cielo azul

    // Cámara
    camera = new THREE.PerspectiveCamera(45, window.innerWidth / window.innerHeight, 0.1, 1000);
    camera.position.set( 0, 1.3, 2 );
    // La posición inicial de la cámara ya no es importante, se actualizará en cada frame

    // Renderizador
    renderer = new THREE.WebGLRenderer({ antialias: true });
    renderer.setSize(window.innerWidth, window.innerHeight);
    document.body.appendChild(renderer.domElement);

    // Luces
    const ambientLight = new THREE.AmbientLight(0xffffff, 0.6);
    scene.add(ambientLight);
    const directionalLight = new THREE.DirectionalLight(0xffffff, 0.8);
    directionalLight.position.set(5, 10, 7.5);
    scene.add(directionalLight);

    // Plano (Suelo)
    const planeGeometry = new THREE.PlaneGeometry(10, 10);
    const planeMaterial = new THREE.MeshStandardMaterial({ color: 0x8b4513 });
    const plane = new THREE.Mesh(planeGeometry, planeMaterial);
    plane.rotation.x = -Math.PI / 2;
    scene.add(plane);

    // Controles de puntero (FPS)
    // Se seguirá usando, pero el movimiento se aplicará al avatar
    /* controls = new PointerLockControls(camera, document.body);
    document.body.addEventListener("click", () => {
        controls.lock();
    }); */
    const controls = new OrbitControls(camera, renderer.domElement);
    controls.enablePan = false;
    controls.enableZoom = true;
    controls.target.set(0, 1.3, 0);
    controls.update();

    loadHDR();

    // Carga el avatar de Ready Player Me
    loadAvatar();

    // Maneja los eventos del teclado
    // setupKeyboardControls();

    // Maneja el redimensionamiento de la ventana
    window.addEventListener("resize", onWindowResize);

    // Inicia el bucle de animación
    animate();
}

//
function loadHDR() {
    const rgbeLoader = new HDRLoader();
    rgbeLoader.load("hdr/qwantani_morning_puresky_2k.hdr", (texture) => {
        // Code to execute after the HDR texture is loaded
        texture.mapping = THREE.EquirectangularReflectionMapping;
        scene.background = texture;
        scene.environment = texture;
    });

    renderer.toneMapping = THREE.ACESFilmicToneMapping;
    renderer.toneMappingExposure = 1.0; // Adjust as needed
    renderer.outputEncoding = THREE.sRGBEncoding;
}

// Carga el modelo GLB del avatar
function loadAvatar() {
    const loader = new GLTFLoader();
    loader.load(
        "https://models.readyplayer.me/68faa4be7b19a1488f8eb68b.glb", // Reemplaza con la ruta de tu archivo
        (gltf) => {
            avatar = gltf.scene;
            avatar.scale.set(1.0, 1.0, 1.0);
            avatar.position.set(0, 0, 0); // Posición inicial
            scene.add(avatar);
            console.log("Avatar cargado con éxito");

            mixer = new THREE.AnimationMixer(avatar);

            // Load animation (assuming it's in a separate GLB)
            loader.load("WalkInPlace.glb", (animGltf) => {
                const animationClip = animGltf.animations[0]; // Assuming one animation

                walkAction = mixer.clipAction(animationClip);
                walkAction.setLoop(THREE.LoopRepeat, Infinity);
            });
            // Load animation (assuming it's in a separate GLB)
            loader.load("WalkBackwards.glb", (animGltf) => {
                const animationClip = animGltf.animations[0]; // Assuming one animation

                walkBackAction = mixer.clipAction(animationClip);
                walkBackAction.setLoop(THREE.LoopRepeat, Infinity);
            });

            // Load animation (assuming it's in a separate GLB)
            loader.load("M_Standing_Idle_001.glb", (animGltf) => {
                const animationClip = animGltf.animations[0]; // Assuming one animation

                idleAction = mixer.clipAction(animationClip);
                idleAction.setLoop(THREE.LoopRepeat, Infinity);
                idleAction.play();
            });
        },
        (xhr) => {
            console.log((xhr.loaded / xhr.total) * 100 + "% cargado");
        },
        (error) => {
            console.error("Error al cargar el avatar:", error);
        }
    );
}

// Configura las teclas de movimiento
/*
function setupKeyboardControls() {
    document.addEventListener("keydown", (event) => {
        switch (event.code) {
            case "KeyW":
                moveState.forward = true;
                walkAction.play();
                break;
            case "KeyS":
                walkBackAction.play();
                moveState.backward = true;
                break;
            case "KeyA":
                walkAction.play();
                moveState.left = true;
                break;
            case "KeyD":
                walkAction.play();
                moveState.right = true;
                break;
        }
    });

    document.addEventListener("keyup", (event) => {
        switch (event.code) {
            case "KeyW":
                walkAction.stop();
                walkBackAction.stop();
                idleAction.play();
                moveState.forward = false;
                break;
            case "KeyS":
                walkAction.stop();
                walkBackAction.stop();
                idleAction.play();
                moveState.backward = false;
                break;
            case "KeyA":
                walkAction.stop();
                walkBackAction.stop();
                idleAction.play();
                moveState.left = false;
                break;
            case "KeyD":
                walkAction.stop();
                walkBackAction.stop();
                idleAction.play();
                moveState.right = false;
                break;
        }
    });
}*/

// Bucle de animación
function animate() {
    requestAnimationFrame(animate);

    const delta = clock.getDelta();
    if (mixer) {
        mixer.update(delta);
    }

    /*
    if (controls.isLocked) {
        if (avatar) {
            // const delta = clock.getDelta();
            const speed = 1.0;

            const forwardVector = new THREE.Vector3();
            avatar.getWorldDirection(forwardVector);
            forwardVector.y = 0;
            forwardVector.normalize();

            // Mueve el avatar en la dirección que mira la cámara
            if (moveState.forward) {
                avatar.position.addScaledVector(forwardVector, speed * delta);
            }
            if (moveState.backward) {
                avatar.position.addScaledVector(forwardVector, -speed * delta);
            }

            if (moveState.left) {
                avatar.rotation.y += speed * delta;
            }
            if (moveState.right) {
                avatar.rotation.y -= speed * delta;
            }

            camera.position.set(
                avatar.position.x - 4.0 * forwardVector.x,
                avatar.position.y - 4.0 * forwardVector.y + 1.8,
                avatar.position.z - 4.0 * forwardVector.z
            ); // Apunta la cámara al avatar

            camera.lookAt(
                avatar.position.x + forwardVector.x,
                avatar.position.y + forwardVector.y + 1.8,
                avatar.position.z + forwardVector.z
            );
        }
    }*/

    renderer.render(scene, camera);
}

// Maneja el redimensionamiento
function onWindowResize() {
    camera.aspect = window.innerWidth / window.innerHeight;
    camera.updateProjectionMatrix();
    renderer.setSize(window.innerWidth, window.innerHeight);
}

// Inicia el programa
init();
