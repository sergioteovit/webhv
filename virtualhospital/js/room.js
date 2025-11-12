import * as THREE from "three";
import { OrbitControls } from "three/addons/controls/OrbitControls.js";
import { FBXLoader } from "three/addons/loaders/FBXLoader.js";

let scene;
let camera;
let renderer;
let controls;

function readSceneData() {
    fetch("xml/" + xmlfile + ".xml")
        .then((response) => response.text()) // Get the response as text
        .then((xmlString) => {
            // Process the XML string here
            console.log("XML Loaded ok...");
            const parser = new DOMParser();
            const xmlDoc = parser.parseFromString(xmlString, "text/xml");
            console.log("Root element name:", xmlDoc.documentElement.nodeName);

            // Example: Iterating through multiple elements
            const allItems = xmlDoc.querySelectorAll("object");
            allItems.forEach((item) => {
                let objectData = {
                    name: item.getAttribute("name"),
                    x: Number(item.getAttribute("x")),
                    y: Number(item.getAttribute("y")),
                    z: Number(item.getAttribute("z")),
                    rx: Number(item.getAttribute("rx")),
                    ry: Number(item.getAttribute("ry")),
                    rz: Number(item.getAttribute("rz")),
                    sx: Number(item.getAttribute("sx")),
                    sy: Number(item.getAttribute("sy")),
                    sz: Number(item.getAttribute("sz"))
                };

                /*console.log("Item:" + objectData.name);
                console.log("pos: (" + objectData.x + "," + objectData.y + "," + objectData.z + ")");
                console.log("rot: (" + objectData.rx + "," + objectData.ry + "," + objectData.rz + ")");
                console.log("scl: (" + objectData.sx + "," + objectData.sy + "," + objectData.sz + ")");*/

                loadFBX(objectData);
            });

        })
        .catch((error) => {
            console.error("Error fetching XML:", error);
        });
}

function loadFBX(objectData) {
    const loader = new FBXLoader();
    loader.setResourcePath("models/" + objectData.name + ".fbm/");
    loader.load(
        "models/" + objectData.name + ".fbx",
        (object) => {
            object.position.x = objectData.x;
            object.position.y = objectData.y;
            object.position.z = objectData.z;
            scene.add(object);
        },
        function (progress) {
            console.log((progress.loaded / progress.total) * 100 + "% cargado");
            // updateProgressBar((progress.loaded / progress.total) * 100);
        },
        function (error) {
            console.error("Error al cargar el modelo FBX:", error);
            // document.getElementById("loading").style.display = "none";
            alert("Error al cargar el modelo FBX. Por favor, intenta con otro archivo.");
        }
    );
}

function start() {
    // 1. Create the Scene
    scene = new THREE.Scene();

    // 2. Create and configure the Camera
    camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
    camera.position.z = 10; // Position the camera back so we can see objects

    // 3. Create the Renderer
    renderer = new THREE.WebGLRenderer({ antialias: true });
    renderer.setSize(window.innerWidth, window.innerHeight);
    document.body.appendChild(renderer.domElement);

    const ambientLight = new THREE.AmbientLight(0x404040); // Soft white light
    scene.add(ambientLight);

    // 5. Handle window resize
    window.addEventListener("resize", onWindowResize, false);

    // 6. Add navigation controls
    controls = new OrbitControls(camera, renderer.domElement);
    controls.enableDamping = true; // Provides a smoother feel
    controls.dampingFactor = 0.25;
    controls.screenSpacePanning = false;
    controls.minDistance = 1;
    controls.maxDistance = 500;

    // Optional: Target the controls to a specific point (defaults to origin 0,0,0)
    controls.target.set(0, 0, 0);
    
    const geometry = new THREE.BoxGeometry(1, 1, 1); 
    const material = new THREE.MeshBasicMaterial({ color: 0x00ff00 });
    const cube = new THREE.Mesh(geometry, material);
    scene.add(cube);
    
    scene.background = new THREE.Color(0.5, 0.7, 0.9); 

    readSceneData();
    
    animate();
}

function onWindowResize() {
    camera.aspect = window.innerWidth / window.innerHeight;
    camera.updateProjectionMatrix();
    renderer.setSize(window.innerWidth, window.innerHeight);
}

// 7. Create the animation loop
function animate() {
    requestAnimationFrame(animate);

    // Update controls in the loop
    controls.update();

    renderer.render(scene, camera);
}

start();
