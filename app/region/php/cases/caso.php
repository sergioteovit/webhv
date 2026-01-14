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
    <link rel="shortcut icon" href="#"/>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
      <style>
        #subtitle-container {
            position: absolute;
            top: 0px; /* Adjust vertical position */
            left: 50%;
            transform: translateX(-50%); /* Center the text */
            color: white;
            background-color: rgba(0, 0, 0, 0.7); /* The "box" for the subtitle */
            padding: 10px 15px;
            border-radius: 5px;
            font-family: sans-serif;
            text-align: center;
            z-index: 1;
            pointer-events: auto;
            width: 100%;
        }
        #caseButtons {
            position: absolute;
            bottom: 0px; /* Adjust vertical position */
            left: 50%;
            transform: translateX(-50%);/* Center the text */
            color: white;
            background-color: rgba(0, 0, 0, 0.7); /* The "box" for the subtitle */
            padding: 10px 15px;
            border-radius: 5px;
            font-family: sans-serif;
            text-align: center;
            z-index: 1;
            pointer-events: auto;
            width: 100%;
        }
        #infoDiv {
            position: absolute;
            top: 50%; 
            left: 50%;
            transform: translateY(-50%);
            transform: translateX(-50%);
            color: white;
            background-color: rgba(0, 0, 0, 0.3); /* The "box" for the subtitle */
            padding: 10px 15px;
            border-radius: 5px;
            font-family: sans-serif;
            text-align: center;
            z-index: 1;
            pointer-events: auto;
            width: 30%;
        }
      </style>
</head>

<body>
      
    <?php
    $filecase = "sistemas/" . $system . "/" . $url . ".xml";
    $caseicon = "sistemas/images/" . $url . ".jpg";

    $xml = simplexml_load_file($filecase);

    if ($xml === false) {
        echo "Estamos trabajando en este caso. Perdona el inconveniente.<br>";
        exit();
    }
    ?>
    
    <div id="subtitle-container">
        <div id="subtitlesBox">Vamos a abordar un nuevo caso. Da clic en alguno de los botones de abajo.
        </div>
        <button type="button" class="btn btn-primary">
          Puntos <span class="badge text-bg-danger fs-4" id="rankCounter">100</span>
        </button>
    </div>
    <div id="caseButtons">
        <button type="button" class="btn btn-primary" id="introButton">Instrucciones</button>
        <button type="button" class="btn btn-primary" id="caseButton">Información General del Caso</button>
        <button type="button" class="btn btn-info position-relative" id="ipButton">Información del paciente<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">-10</span></button>
        <button type="button" class="btn btn-info position-relative" id="hcButton">Historia Clínica<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">-10</span></button>
        <button type="button" class="btn btn-info position-relative" id="efButton">Exploración física<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">-10</span></button>
        <button type="button" class="btn btn-info position-relative" id="acButton">Auscultación<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">-10</span></button>
        <button type="button" class="btn btn-info position-relative" id="lpButton">Laboratorios y otras pruebas<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">-10</span></button>
        <button type="button" class="btn btn-info position-relative" id="imButton">Imagen<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">-10</span></button>
        <button type="button" class="btn btn-info position-relative" id="tmButton">Tratamiento<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">-10</span></button>
        <button type="button" class="btn btn-success" id="runButton">Ponte a Prueba</button>
    </div>
    <div id="infoDiv">
        <img class="image-square" id="imgElement" src="/" width="100%"/>
        
        <div class="carousel slide carousel-fade" id="questionElement">
          <div class="carousel-inner">
              
            <!--div class="carousel-item active">
              <img src="..." class="d-block w-100" alt="...">
                <div class="mb-3" >
                  <label class="form-label">Select one option:</label>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="radioOptions" id="radio1" value="option1" checked>
                    <label class="form-check-label" for="radio1">
                      Option 1
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="radioOptions" id="radio2" value="option2">
                    <label class="form-check-label" for="radio2">
                      Option 2
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="radioOptions" id="radio3" value="option3">
                    <label class="form-check-label" for="radio3">
                      Option 3
                    </label>
                  </div>
                </div>
            </div-->
              <?php
                foreach ($xml->question as $question) {
                    echo "<div class='carousel-item'>";
                    echo "<div class='mb-3'>";
                    echo "<h1>".$question->statement."</h1>";
                    echo "</div>";
                    echo "</div>";
                    echo "<h3>INDICADOR: ".$question->statement."</h3>";
                }
                
              ?>
          </div>
          
          <button class="carousel-control-prev" type="button" data-bs-target="#questionElement" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#questionElement" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
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
    <script type="module" src="./js/avatar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
      
      <script>
          
        const switchElement = document.getElementById("infoDiv");
        switchElement.hidden = true;
          
        document.getElementById("caseButton").addEventListener("click", playCase, false);
        document.getElementById("introButton").addEventListener("click", instructions, false);
          
        document.getElementById("ipButton").addEventListener("click", ipCase, false);
        document.getElementById("hcButton").addEventListener("click", hcCase, false);
        document.getElementById("efButton").addEventListener("click", efCase, false);
        document.getElementById("acButton").addEventListener("click", acCase, false);
        document.getElementById("lpButton").addEventListener("click", lpCase, false);
        document.getElementById("imButton").addEventListener("click", imCase, false);
        document.getElementById("tmButton").addEventListener("click", tmCase, false);
        document.getElementById("runButton").addEventListener("click", runCase, false);
          
          function playCase(){
              let texto = <?php echo json_encode(strval($xml->description)); ?>;
              playText(texto);
              switchElement.hidden = false;
              const imageElement = document.getElementById("imgElement");
              imageElement.src = <?php echo json_encode($caseicon); ?>;
              const questionElement = document.getElementById("questionElement");
              questionElement.hidden = true;
              
          }
          
          function ipCase(){
              switchElement.hidden = true;
              if (!checkPoints()) return;
              let texto = <?php echo json_encode(strval($xml->patient)); ?>;
              playText(texto);
              
          }
          
          function hcCase(){
              switchElement.hidden = true;
              if (!checkPoints()) return;
              let texto = <?php echo json_encode(strval($xml->history)); ?>;
              playText(texto);
          }
          
          function efCase(){
              switchElement.hidden = true;
              if (!checkPoints()) return;
              let texto = <?php echo json_encode(strval($xml->examination)); ?>;
              playText(texto);
          }
          
          function acCase(){
              switchElement.hidden = true;
              if (!checkPoints()) return;
              let texto = <?php echo json_encode(strval($xml->auscultation)); ?>;
              playText(texto);
          }
          
          function lpCase(){
              switchElement.hidden = true;
              if (!checkPoints()) return;
              let texto = <?php echo json_encode(strval($xml->tests)); ?>;
              playText(texto);
          }
          
          function imCase(){
              
              switchElement.hidden = true;
              if (!checkPoints()) return;
              let texto = <?php echo json_encode(strval($xml->images)); ?>;
              playText(texto);
          }
          
          function tmCase(){
              
              switchElement.hidden = true;
              if (!checkPoints()) return;
              let texto = <?php echo json_encode(strval($xml->treatment)); ?>;
              playText(texto);
          }
          
          function runCase(){
              switchElement.hidden = false;
              const imageElement = document.getElementById("imgElement");
              imageElement.src = <?php echo json_encode($caseicon); ?>;
              questionElement.hidden = false;
          }
          
          function instructions() {
                let texto =
                    "Para comenzar, puedes dar clic en el botón Información General del Caso para escuchar la descripción. Posteriormente podrás solicitarme datos más detallados. Cada vez que consultes información, gastarás puntos, por lo que elige bien los datos a consultar. Una vez estudiado el caso, da clic en el botón Ponte a Prueba, para resolver los cuestionamientos y ganar puntos, que se sumarán a tu ranking.";

                playText(texto);
            }
          
          function insufficientPoints(){
              playText("Tus puntos se han agotado, da clic en Ponte a Prueba o reinicia el caso.");
          }

            function playText(texto) {
                window.speechSynthesis.cancel();
                
                let mensaje = new SpeechSynthesisUtterance(texto);
                mensaje.lang = "es-US";
                mensaje.rate = 1.0;
                mensaje.pitch = 1;

                document.getElementById("subtitlesBox").innerHTML = texto;

                window.speechSynthesis.speak(mensaje);
            }
          
          function deductPoints(){
            let counterBox = document.getElementById("rankCounter"); 
            let valueCounter = Number(counterBox.innerText);
            valueCounter-=10;
            counterBox.innerHTML = valueCounter;
          }
          
          function checkPoints(){
              let counterBox = document.getElementById("rankCounter"); 
              let valueCounter = Number(counterBox.innerText);
              if ( valueCounter<=0 )
              {
                  insufficientPoints();
                  return false;
              }
              else {
                  deductPoints();
              }
              return true;
          }
          
      </script>
      
</body>
</html>