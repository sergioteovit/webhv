import * as THREE from "three";
import { OrbitControls } from "three/addons/controls/OrbitControls.js";
import { FBXLoader } from "three/addons/loaders/FBXLoader.js";

let scene;
let camera;
let renderer;
let controls;

let ambientlight, Hlight;

const raycaster = new THREE.Raycaster();
const mouse = new THREE.Vector2();
const doorsList = [
    "PTABANIO",
    "PTABANIO60cm",
    "PTACIRUGIA1",
    "PTACONSULTORIO",
    "PTACONSULTORIOVENTANA",
    "PTADOBLE",
    "PTADOBLEQX",
    "PTAOFICINA",
    "PTAQX",
    "PTARADIOLOGIA",
    "PTASANITARIO",
    "PTASANITARIO2",
    "PTASANITARIO3",
    "PTAVENTANACIRC"
];

const lampsList = ["TLAMP", "LAMP"];
let lightsMap = new Map();
let lightsOn = 0;
let numLights = 0;

function readSceneData() {
    fetch("xml/" + xmlfile + ".xml")
        .then((response) => response.text()) // Get the response as text
        .then((xmlString) => {
            // Process the XML string here
            // console.log("XML Loaded ok...");
            const parser = new DOMParser();
            const xmlDoc = parser.parseFromString(xmlString, "text/xml");
            // console.log("Root element name:", xmlDoc.documentElement.nodeName);

            let rootData = {
                name: xmlDoc.documentElement.getAttribute("name"),
                x: 0,
                y: 0,
                z: 0,
                rx: 0,
                ry: 0,
                rz: 0,
                sx: 1,
                sy: 1,
                sz: 1
            };

            loadFBX(rootData);

            // Example: Iterating through multiple elements
            const allItems = xmlDoc.querySelectorAll("object");

            allItems.forEach((item) => {
                let objectData = {
                    name: item.getAttribute("name"),
                    x: Number(item.getAttribute("x")),
                    y: Number(item.getAttribute("z")),
                    z: -Number(item.getAttribute("y")),
                    rx: Number(item.getAttribute("ry")),
                    ry: Number(item.getAttribute("rz")),
                    rz: Number(item.getAttribute("rx")),
                    sx: Number(item.getAttribute("sx")),
                    sy: Number(item.getAttribute("sz")),
                    sz: Number(item.getAttribute("sy"))
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
            object.scale.set(objectData.sx * 0.01, objectData.sy * 0.01, objectData.sz * 0.01);

            object.rotateX(THREE.MathUtils.degToRad(objectData.rx));
            object.rotateY(THREE.MathUtils.degToRad(objectData.ry));
            object.rotateZ(THREE.MathUtils.degToRad(objectData.rz));

            object.position.set(objectData.x, objectData.y, objectData.z);

            object.name = objectData.name;

            if (lampsList.includes(objectData.name)) {
                const spotLight = new THREE.SpotLight(0xffffff, 1, 20, Math.PI / 2.5, 0.5, 1.5);

                spotLight.position.set(objectData.x, objectData.y + 2.8, objectData.z);
                const targetl = new THREE.Object3D();
                targetl.position.set(objectData.x, 0, objectData.z);
                spotLight.target = targetl;

                scene.add(targetl);
                scene.add(spotLight);

                object.userData.isTurnedOn = true;

                lightsMap.set(object.uuid, spotLight.uuid);
                // console.log(object.uuid + " => " + spotLight.uuid);

                numLights++;
                lightsOn++;

                //const spotLightHelper = new THREE.SpotLightHelper(spotLight);
                //scene.add(spotLightHelper);
            } else if (doorsList.includes(objectData.name)) {
                object.userData.isOpened = false;
            }
            // console.log(object);

            scene.add(object);

            // console.log("models/" + objectData.name + ".fbx  loaded");

            /*for (const [key, value] of lightsMap.entries()) {
                console.log(`Key: ${key}, Value: ${value}`);
            }*/
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

function onDoubleClick(event) {
    event.preventDefault();

    // Calculate mouse position in normalized device coordinates (-1 to +1)
    mouse.x = (event.clientX / window.innerWidth) * 2 - 1;
    mouse.y = -(event.clientY / window.innerHeight) * 2 + 1;

    raycaster.setFromCamera(mouse, camera);

    const intersects = raycaster.intersectObjects(scene.children, true); // `true` for recursive check

    if (intersects.length > 0) {
        const object = intersects[0].object.parent;

        // console.log("Clicked object:", object);
        if (object.isGroup) {
            if (doorsList.includes(object.name)) {
                // console.log("The object is a Door.");
                if (object.userData.isOpened) {
                    object.rotateY(-Math.PI / 2);
                    object.userData.isOpened = false;
                } else {
                    object.rotateY(Math.PI / 2);
                    object.userData.isOpened = true;
                }
            } else if (lampsList.includes(object.name)) {
                //console.log("The object is a light.");
                //console.log("ID: " + object.uuid + " light: " + lightsMap.get(object.uuid));
                if (object.userData.isTurnedOn) {
                    const light = scene.getObjectByProperty("uuid", lightsMap.get(object.uuid));
                    light.intensity = 0;
                    object.userData.isTurnedOn = false;
                    lightsOn--;
                    //console.log(light);
                    ambientlight.intensity = (0.1 * lightsOn) / numLights;
                    Hlight.intensity = (0.2 * lightsOn) / numLights;
                } else {
                    const light = scene.getObjectByProperty("uuid", lightsMap.get(object.uuid));
                    light.intensity = 1;
                    object.userData.isTurnedOn = true;
                    lightsOn++;
                    //console.log(light);
                    ambientlight.intensity = (1.0 * lightsOn) / numLights;
                    Hlight.intensity = (1.5 * lightsOn) / numLights;
                }
            }
        }

        // You can now interact with the clickedObject, e.g., change its color
        // clickedObject.material.color.set(0xff0000);
    }
}

function start() {
    // 1. Create the Scene
    scene = new THREE.Scene();

    // 2. Create and configure the Camera
    camera = new THREE.PerspectiveCamera(45, window.innerWidth / window.innerHeight, 0.1, 1000);
    camera.position.y = 1.5;
    camera.position.z = 2; // Position the camera back so we can see objects

    // 3. Create the Renderer
    renderer = new THREE.WebGLRenderer({ antialias: true });
    renderer.setSize(window.innerWidth, window.innerHeight);
    document.body.appendChild(renderer.domElement);

    ambientlight = new THREE.AmbientLight(0xffffff, 1.0); // soft white light
    scene.add(ambientlight);

    Hlight = new THREE.HemisphereLight(0xffffff, 0x000000, 1.5);
    scene.add(Hlight);

    // 5. Handle window resize
    window.addEventListener("resize", onWindowResize, false);

    // 6. Add navigation controls
    controls = new OrbitControls(camera, renderer.domElement);
    controls.enableDamping = true; // Provides a smoother feel
    controls.dampingFactor = 0.25;
    controls.screenSpacePanning = false;
    controls.minDistance = 0.01;
    controls.maxDistance = 500;

    // Optional: Target the controls to a specific point (defaults to origin 0,0,0)
    controls.target.set(0, 1.5, 0);

    scene.background = new THREE.Color(0, 0, 0);

    readSceneData();

    document.addEventListener("dblclick", onDoubleClick, false);

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
