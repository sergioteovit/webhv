import * as THREE from "three";
import { GLTFLoader } from "GLTFLoader";
import { OrbitControls } from "OrbitControls";
import { HDRLoader } from "HDRLoader";

import { RGBELoader } from "RGBELoader";

let camera, scene, renderer, controls;
let avatar;
let clock = new THREE.Clock();

let mixer;

let idleAction;

// Inicializa la escena
function init() {
    // Escena
    scene = new THREE.Scene();
    scene.background = new THREE.Color(0x87ceeb); // Cielo azul

    // Cámara
    camera = new THREE.PerspectiveCamera(45, window.innerWidth / window.innerHeight, 0.1, 1000);

    // Renderizador
    renderer = new THREE.WebGLRenderer({ antialias: true });
    renderer.setSize(window.innerWidth, window.innerHeight);
    document.body.appendChild(renderer.domElement);

    // Luces
    const ambientLight = new THREE.AmbientLight(0xffffff, 1.0);
    scene.add(ambientLight);
    const Hlight = new THREE.HemisphereLight(0xffffff, 0x000000, 1.5);
    scene.add(Hlight);
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
    controls = new OrbitControls(camera, renderer.domElement);
    camera.position.set(0, 1.5, 3);
    camera.lookAt(0, 1.5, -1);

    controls.target.set(0, 1.5, 0);

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
        "avatar.glb", // Reemplaza con la ruta de tu archivo
        (gltf) => {
            avatar = gltf.scene;
            avatar.scale.set(1.0, 1.0, 1.0);
            avatar.position.set(0, 0, 0); // Posición inicial

            scene.add(avatar);
            console.log("Avatar cargado con éxito");

            mixer = new THREE.AnimationMixer(avatar);

            // Load animation (assuming it's in a separate GLB)
            loader.load("F_Talking_Variations_002.glb", (animGltf) => {
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
function setupKeyboardControls() {}

// Bucle de animación
function animate() {
    requestAnimationFrame(animate);

    const delta = clock.getDelta();
    if (mixer) {
        mixer.update(delta);
    }

    controls.update();

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
