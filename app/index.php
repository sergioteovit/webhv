<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/">
    <title>Órganos y Sistemas</title>
    <!-- Incluye el CSS de Bootstrap 5 -->
    <!--link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/mainmenu.css">
</head>
<body>  
<div class="container">
    <div class="row">
        <?php
        /*$servidor = "localhost";
        $usuario = "myhvirtual";
        $contraseña = "uPLtaPntlDJnThpf";
        $nombre_base_de_datos = "myhvirtual";

        // Crea la conexión
        $conn = new mysqli($servidor, $usuario, $contraseña, $nombre_base_de_datos);

        // Revisa la conexión
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // Consulta SQL para obtener todos los datos de la tabla 'usuarios'
        $sql = "SELECT * FROM systems";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo '<div class="carousel">';
            while ($row = $result->fetch_assoc()) {

                echo '<div class="carousel-item" style="background-image: url(icons/main/' . $row["Icon"] . ');">';
                
                echo "<h3>" .
                    $row["System"] .
                    '<br/><a class="waves-effect waves-light btn btn-large light-blue accent-2" href="region/php/levels.php?url='.
                    $row["Url"]
                    .'" width="100%">Explorar</a></h3>';
                echo "</div>";
            }
            echo "</div>";
        } else {
            echo "0 resultados";
        }

        // Cierra la conexión
        $conn->close();*/
        
        function readJsonFilesInDirectory($directoryPath) {
            
            $files = glob($directoryPath . '/*.json');
            
            if ($files === false) {
                echo "<h3>No se encontraron archivos de configuración.</h3>";
            }
            
            echo '<div class="carousel">';
            
            foreach ($files as $filePath) {
                if (is_file($filePath)) {
                    $jsonString = file_get_contents($filePath);
                    
                    if ($jsonString === false) {
                        error_log("Error al leer el archivo");
                    }
                    
                    $data = json_decode($jsonString, true);
                    
                    if ($data === null) {
                        error_log("Error al decodificar el archivo JSON");
                    }
                    
                    echo '<div class="carousel-item" style="background-image: url(icons/main/' . $data['background-image'] . ');">';
                    
                    echo "<h3>" . $data['name'] . '<br/><a class="waves-effect waves-light btn btn-large light-blue accent-2" href="region/php/levels.php?url='. $data['url'] .'" width="100%">Explorar</a></h3>';
                    
                    echo "</div>";
                    
                }
            }
            
            echo "</div>";
            
        }
        
        $directory = 'json';
        readJsonFilesInDirectory($directory);
        
        ?>
    </div>
</div>

<!-- Incluye el JavaScript de Bootstrap para algunas funcionalidades (opcional en este caso) -->
<!--script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></!--script-->
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="./js/mainmenu.js"></script>


</body>
</html>