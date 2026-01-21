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
        #backgroundDiv{
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
            z-index: 1;
            pointer-events: auto;
            width: 100%;
            height: 100vh; 
            
        }
        #patientDiv{
            position: absolute;
            top: 0%; 
            left: 50%;
            transform: translateY(-50%);
            transform: translateX(-50%);
            color: white;
            background-color: rgba(0, 0, 0, 0); /* The "box" for the subtitle */
            padding: 10px 15px;
            border-radius: 5px;
            font-family: sans-serif;
            text-align: center;
            z-index: 10;
            pointer-events: auto;
            width: 100%;
            height: 100vh; 
            
        }
        #medicalDiv{
            position: absolute;
            top: 0%; 
            left: 50%;
            transform: translateY(-50%);
            transform: translateX(-50%);
            color: white;
            background-color: rgba(0, 0, 0, 0); /* The "box" for the subtitle */
            padding: 10px 15px;
            border-radius: 5px;
            font-family: sans-serif;
            text-align: center;
            z-index: 20;
            pointer-events: auto;
            width: 100%;
            height: 100vh; 
        }
    </style>
</head>

<body>
      
    <?php
    $dirbase = "sistemas/" . $system . "/" . $url . "/";
    $filecase = $dirbase . "case.xml";
    $caseicon = $dirbase . "case.jpg";

    $xml = simplexml_load_file($filecase);

    if ($xml === false) {
        echo "Estamos trabajando en este caso. Perdona el inconveniente.<br>";
        exit();
    }
    ?>
    <nav class="navbar fixed-top bg-dark navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
      <div class="container-fluid">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item">
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalPopup" id="introButton">Instrucciones</button>
            </li>
            <!--li class="nav-item">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalPopup" id="caseButton">Información General del Caso</button> 
            </li-->  
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Información Adicional
              </a>
              <ul class="dropdown-menu">
                <!--li><button type="button" class="btn btn-info position-relative dropdown-item" data-bs-toggle="modal" data-bs-target="#modalPopup" id="ipButton">Información del paciente<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">-10</span></button></li-->
                <!--li><button type="button" class="btn btn-info position-relative dropdown-item" data-bs-toggle="modal" data-bs-target="#modalPopup" id="hcButton">Historia Clínica<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">-10</span></button></li-->
                <!--li><button type="button" class="btn btn-info position-relative dropdown-item" data-bs-toggle="modal" data-bs-target="#modalPopup" id="efButton">Exploración física<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">-10</span></button></li-->
                <li><button type="button" class="btn btn-info position-relative dropdown-item" data-bs-toggle="modal" data-bs-target="#modalPopup" id="acButton">Auscultación<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">-10</span></button></li>
                <!--li><button type="button" class="btn btn-info position-relative dropdown-item" data-bs-toggle="modal" data-bs-target="#modalPopup" id="lpButton">Laboratorios y otras pruebas<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">-10</span></button></li-->
                <!--li><button type="button" class="btn btn-info position-relative dropdown-item" data-bs-toggle="modal" data-bs-target="#modalPopup" id="imButton">Imagen<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">-10</span></button></li-->
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
    
    <div id="backgroundDiv">
        <img src="images/background.png" class="img-fluid"/>
    </div>
    <div id="patientDiv">
        <?php
            $imageatt = $xml->patient->attributes();
            $imageurl = $dirbase . $imageatt["image"];
            if ( empty($imageatt["image"]) ) 
                $imageurl = "images/patient.png";
                
            echo "<img src='" . $imageurl ."' class='img-fluid'/>";
        ?>
    </div>
    <div id="medicalDiv">
        <img src="images/desktop.png" class="img-fluid" usemap="#image-map"/>
        <map name="image-map">
            <area id="tel-area" coords="94,554,92,916,191,919,374,812,366,549,220,558" shape="poly" href="javascript:void(0);" alt="Telephone" data-bs-toggle="modal" data-bs-target="#modalPopup">
            <area id="screen-area" target="_self" alt="Screen" title="Screen" href="javascript:void(0);" coords="432,444,437,849,847,775,847,456" shape="poly" data-bs-toggle="modal" data-bs-target="#modalPopup">
            <area id="keyboard-area" target="_self" alt="Keyboard" title="Keyboard" href="javascript:void(0);"  coords="640,924,603,975,1110,975,1088,924" shape="poly" data-bs-toggle="modal" data-bs-target="#modalPopup">
            <area id="note-area" target="_self" alt="Note" title="Note" href="javascript:void(0);"  coords="1073,851,1100,926,1303,926,1244,853" shape="poly" data-bs-toggle="modal" data-bs-target="#modalPopup">
            <area id="print-area" target="_self" alt="Print" title="Print" href="javascript:void(0);"  coords="1303,802,1300,907,1358,966,1415,968,1436,988,1727,988,1690,965,1690,944,1709,946,1709,861,1688,848,1602,804" shape="poly" data-bs-toggle="modal" data-bs-target="#modalPopup">
            <area id="mouse-area" target="_self" alt="Mouse" title="Mouse" href="javascript:void(0);" coords="1130,949,1147,970,1188,971,1193,938,1163,927,1134,932" shape="poly" data-bs-toggle="modal" data-bs-target="#modalPopup">
            <area id="patient-area" target="_self" alt="Patient" title="Patient" href="#" coords="1005,844,1234,846,1229,476,1000,471" shape="poly" data-bs-toggle="modal" data-bs-target="#modalPopup">
            <area id="tallimeter-area" target="_self" alt="Tallimeter" title="Tallimeter" href="#" coords="1388,834,1397,453,1348,432,1344,371,1509,376,1509,437,1453,456,1458,834" shape="poly" data-bs-toggle="modal" data-bs-target="#modalPopup">
            <area id="negatoscope-area" target="_self" alt="Negatoscope" title="Negatoscope" href="#" coords="1578,249,1578,414,1914,414,1911,256" shape="poly" data-bs-toggle="modal" data-bs-target="#modalPopup">
        </map>
    </div>
    
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
    
    <!--script type="module" src="./js/avatar.js"></!--script-->
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
          
        // document.getElementById("caseButton").addEventListener("click", playCase, false);
        document.getElementById("introButton").addEventListener("click", instructions, false);
          
        // document.getElementById("ipButton").addEventListener("click", ipCase, false);
        // document.getElementById("hcButton").addEventListener("click", hcCase, false);
        // document.getElementById("efButton").addEventListener("click", efCase, false);
        document.getElementById("acButton").addEventListener("click", acCase, false);
        // document.getElementById("lpButton").addEventListener("click", lpCase, false);
        // document.getElementById("imButton").addEventListener("click", imCase, false);
        document.getElementById("tmButton").addEventListener("click", tmCase, false);
        document.getElementById("runButton").addEventListener("click", runCase, false);
        document.getElementById("closeButton").addEventListener("click", closeTest, false);
          
        document.getElementById("prevCarouselBtn").addEventListener("click", prevQuestion, false);
        document.getElementById("nextCarouselBtn").addEventListener("click", nextQuestion, false);
        
        document.getElementById("tel-area").addEventListener("click", telephoneClicked, false);
        document.getElementById("screen-area").addEventListener("click", pcClicked, false);
        document.getElementById("keyboard-area").addEventListener("click", pcClicked, false);
        document.getElementById("mouse-area").addEventListener("click", pcClicked, false);
        document.getElementById("note-area").addEventListener("click", noteaudioClicked, false);
        document.getElementById("print-area").addEventListener("click", printaudioClicked, false);
        document.getElementById("patient-area").addEventListener("click", patientClicked, false);
        document.getElementById("negatoscope-area").addEventListener("click", negatoscopeClicked, false);
        document.getElementById("tallimeter-area").addEventListener("click", tallimeterClicked, false);
        
        const telaudio = new Audio('audio/telephone.mp3');
        const pcaudio = new Audio('audio/click.mp3');
        const noteaudio = new Audio('audio/note.mp3');
        const printaudio = new Audio('audio/print.mp3');
        const patientaudio = new Audio('audio/patient.mp3');
        
        function telephoneClicked(){
            telaudio.play();
        }
        function pcClicked(){
            pcaudio.play();
            hcCase();
        }
        function noteaudioClicked(){
            noteaudio.play();
            playCase();
        }
        function printaudioClicked(){
            printaudio.play();
            lpCase();
        }
        function patientClicked(){
            patientaudio.play();
            efCase();
        }
        
        function negatoscopeClicked(){
            noteaudio.play();
            imCase();
        }
        
        function tallimeterClicked(){
            patientaudio.play();
            ipCase();
        }
        
        function playCase(){
            
            let modal = document.getElementById("myModalLabel");
            modal.innerText = "Información general del caso";
            
            switchElement.hidden = true;
            let texto = <?php echo json_encode(strval($xml->description)); ?>;
            playText(texto);
            
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
            playPatientText(texto);
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
                "Para comenzar, da clic en las notas sobre tu escritorio, para revisar la información general del caso. Posteriormente da clic en el paciente para escuchar su padecimiento. Podrás hacer uso de tus créditos iniciales dando clic en el teléfono para solicitarme ayuda. Una vez estudiado el caso, da clic en el botón Ponte a Prueba, para resolver los cuestionamientos y ganar puntos, que se sumarán a tu ranking.";

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
        
        function playPatientText(texto, generoPreferido = 'female'){
            let modal = document.getElementById("myModalBody");
            modal.innerHTML = texto;
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