<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>
    <?php if (isset($_GET["system"]) && isset($_GET["index"]) && isset($_GET["url"])) {
        $system = $_GET["system"];
        $index = $_GET["index"];
        $url = $_GET["url"];

        echo "System: " . $system . " Level: " . $index . " Url: " . $url;
    } else {
        echo "Selection failed";
    } ?>
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css"/>
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
    
    <?php
    $filecase = $system . "/" . $url . ".xml";

    $xml = simplexml_load_file($filecase);

    if ($xml === false) {
        echo "Failed to load XML file: $filecase<br>";
        foreach (libxml_get_errors() as $error) {
            echo $error->message . "<br>";
        }
        exit();
    }

    echo "<h1>Caso:</h1>";
    foreach ($xml->attributes() as $attributeName => $attributeValue) {
        echo "<p>  " . $attributeName . ": " . $attributeValue . "</p><br>";
    }

    echo "<p> Description: " . $xml->description . "</p>";
    echo "<p> History: " . $xml->history . "</p>";
    echo "<p> Examination: " . $xml->examination . "</p>";
    echo "<p> Auscultation: " . $xml->auscultation . "</p>";
    echo "<p> Tests: " . $xml->tests . "</p>";
    echo "<p> Images: " . $xml->images . "</p>";
    echo "<p> Treatment: " . $xml->treatment . "</p>";

    echo "<h2>Preguntas:</h2>";
    ?>
    
    <div id="overlay">
        <p><?php echo $content; ?></p>
        <div class="rounded-square" id="intro"> <?php echo $xml->description; ?> </div>
        <button id="startButton" onclick="removeElementById('overlay')">Iniciar</button>
    </div>
    
    <script>
        function removeElementById(elementId) {
            const elementToRemove = document.getElementById(elementId);
            if (elementToRemove) { // Check if the element exists
                elementToRemove.remove();
            } else {
                console.warn(`Element with ID '${elementId}' not found.`);
            }
        }
    </script>
    
    <div class="container d-flex align-items-center justify-content-center flex-wrap">
        <div class="box">
            <div class="body">
                <div class="imgContainer">
                    <img src="https://images.pexels.com/photos/3601422/pexels-photo-3601422.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="">
                </div>
                <div class="content d-flex flex-column align-items-center justify-content-center">
                    <div>
                        <h3 class="text-white fs-5">Post Title</h3>
                        <p class="fs-6 text-white">Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo sed cum neque, rem provident ex. Laboriosam perspiciatis modi eveniet in?</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="box">
            <div class="body">
                <div class="imgContainer">
                    <img src="https://images.pexels.com/photos/1532771/pexels-photo-1532771.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" alt="">
                </div>
                <div class="content d-flex flex-column align-items-center justify-content-center">
                    <div>
                        <h3 class="text-white fs-5">Post Title</h3>
                        <p class="fs-6 text-white">Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo sed cum neque, rem provident ex. Laboriosam perspiciatis modi eveniet in?</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="box">
            <div class="body">
                <div class="imgContainer">
                    <img src="https://images.pexels.com/photos/573238/pexels-photo-573238.jpeg?auto=compress&cs=tinysrgb&dpr=3&h=750&w=1260" alt="">
                </div>
                <div class="content d-flex flex-column align-items-center justify-content-center">
                    <div>
                        <h3 class="text-white fs-5">Post Title</h3>
                        <p class="fs-6 text-white">Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo sed cum neque, rem provident ex. Laboriosam perspiciatis modi eveniet in?</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!--
    
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
    -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  </body>
</html>