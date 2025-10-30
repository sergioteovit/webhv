<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Órganos y Sistemas</title>
    <!-- Incluye el CSS de Bootstrap 5 -->
    <!--link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/mainmenu.css">
</head>
<body>

    <p>Para comenzar selecciona una región</p>
    
<div class="container">
    <div class="row">
        <?php
        $servidor = "localhost";
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
                /* echo '<div class="card col-12 col-sm-6 col-md-3 mb-3">';
                echo '<img src="icons/main/' . $row["Icon"] . '" class="card-img-top bg-info icon-btn" alt="...">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . $row["System"] . "</h5>";
                echo '<p class="card-text">Descripción general.</p>';
                echo '<a href="region/' . $row["Url"] . '.php" class="btn btn-primary">Iniciar</a>';
                echo "</div>";
                echo "</div>";*/
                
                echo '<div class="carousel-item">';
                echo '<img src="icons/main/'.$row["Icon"].'" alt="Dog" title="Dog"/>';
                echo '<h3>'.$row["System"].'<br/><a class="waves-effect waves-light btn btn-large light-blue accent-2" href="region/' . $row["Url"] . '.php" width="100%">Seleccionar</a></h3>';
                echo '</div>';
            }
            echo '</div>';
        } else {
            echo "0 resultados";
        }

        // Cierra la conexión
        $conn->close();
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