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
    </style>
  </head>

  <body>
    <script type="importmap">
        {
            "imports": {
                "three": "https://threejs.org/build/three.module.js",
                "GLTFLoader": "https://threejs.org/examples/jsm/loaders/GLTFLoader.js",
                "PointerLockControls": "https://threejs.org/examples/jsm/controls/PointerLockControls.js",
                "HDRLoader":"https://threejs.org/examples/jsm/loaders/HDRLoader.js",
                "RGBELoader":"https://threejs.org/examples/jsm/loaders/RGBELoader.js",
                "OrbitControls":"https://threejs.org/examples/jsm/controls/OrbitControls.js"
            }
        }
    </script>
    <script type="module" src="./js/scene.js"></script>
  </body>
</html>