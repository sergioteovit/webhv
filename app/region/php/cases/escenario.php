<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>
    <?php if (isset($_GET["system"]) && isset($_GET["index"])) {
        $system = $_GET["system"];
        $index = $_GET["index"];

        echo "System: " . $system . " Level: " . $index;
    } else {
        echo "Selection failed";
    } ?>
    </title>
    
    <link rel="shortcut icon" href="#" />
    <style>
        body { margin: 0; }
        canvas { display: block; }
        #overlay {
            position: absolute;
            font-size: 16px;
            z-index: 2;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            background: rgba(0,0,0,0.7);
        }

        #overlay button {
            background: transparent;
            border: 0;
            border: 1px solid rgb(255, 255, 255);
            border-radius: 4px;
            color: #ffffff;
            padding: 12px 18px;
            text-transform: uppercase;
            cursor: pointer;
        }
        .rounded-square {
            width: 50%; /* Set the width of the square */
            height: 30vh; /* Set the height of the square (equal to width for a square) */
            background-color: lightblue; /* Optional: Add a background color */
            border-radius: 15px; /* Apply rounded corners */
            font-size: clamp(1.5rem, 4vw, 3rem);
            text-align: center;
            font-family: Arial;
        }
    </style>
  </head>

  <body>
    <div id="overlay">
        <div class="rounded-square" id="intro"></div>
        <hr/>
		<button id="startButton">Iniciar</button>
    </div>
    <script type="importmap">
        {
            "imports": {
                "three": "https://threejs.org/build/three.module.js",
                "GLTFLoader": "https://threejs.org/examples/jsm/loaders/GLTFLoader.js",
                "PointerLockControls": "https://threejs.org/examples/jsm/controls/PointerLockControls.js",
                "HDRLoader":"https://threejs.org/examples/jsm/loaders/HDRLoader.js",
                "RGBELoader":"https://threejs.org/examples/jsm/loaders/RGBELoader.js",
                "OrbitControls":"https://threejs.org/examples/jsm/controls/OrbitControls.js",
                "FBXLoader":"https://threejs.org/examples/jsm/loaders/FBXLoader.js"
            }
        }
    </script>
    <script type="module" src="./js/scene.js"></script>
  </body>
</html>