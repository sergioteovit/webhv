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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
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
            max-height: 90vh;
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
            max-height: 90vh;
        }
        #infoDiv {
            position: absolute;
            top: 0%; 
            left: 50%;
            transform: translateY(-50%);
            transform: translateX(-50%);
            color: white;
            background-color: rgba(0, 0, 0, 0.8); /* The "box" for the subtitle */
            padding: 10px 15px;
            border-radius: 5px;
            font-family: sans-serif;
            text-align: center;
            z-index: 9999;
            pointer-events: auto;
            width: 100%;
            height: 100vh; 
            
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
    <nav class="navbar fixed-top bg-dark navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
      <div class="container-fluid">
        <!--div class="bg-dark text-white fw-semibold text-center">Vamos a abordar un nuevo caso. Da clic en alguno de los botones de abajo.</div-->
        
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item">
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalPopup" id="introButton">Instrucciones</button>
            </li>
            <li class="nav-item">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalPopup" id="caseButton">Información General del Caso</button> 
            </li>  
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Información Adicional
              </a>
              <ul class="dropdown-menu">
                <li><button type="button" class="btn btn-info position-relative dropdown-item" data-bs-toggle="modal" data-bs-target="#modalPopup" id="ipButton">Información del paciente<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">-10</span></button></li>
                <li><button type="button" class="btn btn-info position-relative dropdown-item" data-bs-toggle="modal" data-bs-target="#modalPopup" id="hcButton">Historia Clínica<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">-10</span></button></li>
                <li><button type="button" class="btn btn-info position-relative dropdown-item" data-bs-toggle="modal" data-bs-target="#modalPopup" id="efButton">Exploración física<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">-10</span></button></li>
                <li><button type="button" class="btn btn-info position-relative dropdown-item" data-bs-toggle="modal" data-bs-target="#modalPopup" id="acButton">Auscultación<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">-10</span></button></li>
                <li><button type="button" class="btn btn-info position-relative dropdown-item" data-bs-toggle="modal" data-bs-target="#modalPopup" id="lpButton">Laboratorios y otras pruebas<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">-10</span></button></li>
                <li><button type="button" class="btn btn-info position-relative dropdown-item" data-bs-toggle="modal" data-bs-target="#modalPopup" id="imButton">Imagen<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">-10</span></button></li>
                <li><button type="button" class="btn btn-info position-relative dropdown-item" data-bs-toggle="modal" data-bs-target="#modalPopup" id="tmButton">Tratamiento<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">-10</span></button></li>
              </ul>
            </li>
          </ul>
        </div>
        <div class="text-center"><button type="button" class="btn btn-success">
            <span class="h2"><i class="bi bi-trophy-fill h2"></i></span> <span class="badge text-bg-warning fs-4" id="rankCounter">100</span>
        </button><button type="button" class="btn btn-danger" onclick="history.back()">
          <i class="bi bi-box-arrow-right h1"></i>
        </button></div>
      </div>
    </nav>
    
    <div class="modal" id="modalPopup" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered"> 
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body" id="myModalBody">
                This is a vertically centered modal.
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <!--button type="button" class="btn btn-primary">Save changes</button-->
              </div>
            </div>
        </div>
    </div>
    
    <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-bottom justify-content-center" data-bs-theme="dark">
        <button type="button" class="btn btn-success" id="runButton"><span class="h2">Ponte a Prueba</span></button>
    </nav>
    
    <div id="infoDiv">
        <button type="button" class="btn-close btn-close-white" aria-label="Close" id="closeButton"></button>
        <br/>
        <hr/>
        <br/>
        <div id="countdown"></div>
        <img class="img-fluid rounded" id="imgElement" src="/"/>
        
        <div class="carousel slide" id="questionElement">
          <div class="carousel-inner">
              
            <div class="carousel-item active">
              <!--img src="..." class="d-block w-100" alt="..."-->
                <div class="mb-3" >
                  <label class="form-label">Da clic en las flechas para continuar con las interaciones.</label>
                </div>
            </div>
               <?php foreach ($xml->questions->children() as $question) {
                   echo "<div class='carousel-item'>";
                   echo "<div class='btn-group-vertical' role='group' aria-label='Options'";
                   echo "<label>" . $question->statement . "</label>";
                   foreach ($question->options->children() as $key => $option) {
                       echo "<button type='button' class='btn btn-secondary'>" . $option . "</button><hr>";
                   }
                   echo "</div>";
                   echo "</div>";
               } ?>
          </div>
          
          <button class="carousel-control-prev" type="button" data-bs-target="#questionElement" data-bs-slide="prev" id="prevCarouselBtn">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#questionElement" data-bs-slide="next" id="nextCarouselBtn">
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
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="js/jquery.progressBarTimer.min.js"></script>
    
    <script>
          
        const switchElement = document.getElementById("infoDiv");
        switchElement.hidden = true;
          
        let countdownBar = $("#countdown").progressBarTimer({
              timeLimit: 30,
              warningThreshold: 1,
              baseStyle: 'bg-info',
              warningStyle: 'bg-danger',
              animated: true,
              autostart: false,
              onFinish  : function () { alert("Se agotó el tiempo :'/ "); }
            });
        countdownBar.stop();
          
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
        document.getElementById("closeButton").addEventListener("click", closeTest, false);
          
        document.getElementById("prevCarouselBtn").addEventListener("click", prevQuestion, false);
        document.getElementById("nextCarouselBtn").addEventListener("click", nextQuestion, false);
          
        function playCase(){
            
            let modal = document.getElementById("myModalLabel");
            modal.innerText = "Información general del caso";
            
            switchElement.hidden = true;
            let texto = <?php echo json_encode(strval($xml->description)); ?>;
            playText(texto);
            
            /*switchElement.hidden = false;
            const imageElement = document.getElementById("imgElement");
            imageElement.src = <?php echo json_encode($caseicon); ?>;
            const questionElement = document.getElementById("questionElement");
            questionElement.hidden = true;*/
        }
          
        function ipCase(){
            
            let modal = document.getElementById("myModalLabel");
            modal.innerText = "Información del paciente";
            
            switchElement.hidden = true;
            if (!checkPoints()) return;
            let texto = <?php echo json_encode(strval($xml->patient)); ?>;
            playText(texto);
        }

        function hcCase(){
            
            let modal = document.getElementById("myModalLabel");
            modal.innerText = "Historia Clínica";
            
            switchElement.hidden = true;
            if (!checkPoints()) return;
            let texto = <?php echo json_encode(strval($xml->history)); ?>;
            playText(texto);
        }

        function efCase(){
            
            let modal = document.getElementById("myModalLabel");
            modal.innerText = "Exploración física";
            
            switchElement.hidden = true;
            if (!checkPoints()) return;
            let texto = <?php echo json_encode(strval($xml->examination)); ?>;
            playText(texto);
        }

        function acCase(){
            
            let modal = document.getElementById("myModalLabel");
            modal.innerText = "Auscultación";
            
            switchElement.hidden = true;
            if (!checkPoints()) return;
            let texto = <?php echo json_encode(strval($xml->auscultation)); ?>;
            playText(texto);
        }

        function lpCase(){
            
            let modal = document.getElementById("myModalLabel");
            modal.innerText = "Laboratorios y otras pruebas";
            
            switchElement.hidden = true;
            if (!checkPoints()) return;
            let texto = <?php echo json_encode(strval($xml->tests)); ?>;
            playText(texto);
        }

        function imCase(){
            
            let modal = document.getElementById("myModalLabel");
            modal.innerText = "Imagen";
            
            switchElement.hidden = true;
            if (!checkPoints()) return;
            let texto = <?php echo json_encode(strval($xml->images)); ?>;
            playText(texto);
        }

        function tmCase(){
            
            let modal = document.getElementById("myModalLabel");
            modal.innerText = "Tratamiento";
            
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

        function closeTest(){
            switchElement.hidden = true;
            questionElement.hidden = true;
        }
          
        function prevQuestion(){
            console.log("Previous question loaded...");
        }
        function nextQuestion(){
            console.log("Next question loaded...");
            countdownBar.stop();
        }
          
        function instructions() {
            
            let modal = document.getElementById("myModalLabel");
            modal.innerText = "Instrucciones";
            
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
            
            let modal = document.getElementById("myModalBody");
            modal.innerHTML = texto;

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