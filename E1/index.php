<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Órganos y Sistemas</title>
    <!-- Incluye el CSS de Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="./css/mainmenu.css">
</head>
<body>

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
            while ($row = $result->fetch_assoc()) {
                echo '<div class="card col-12 col-sm-6 col-md-3 mb-3">';
                echo '<img src="icons/main/' . $row["Icon"] . '" class="card-img-top bg-info icon-btn" alt="...">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . $row["System"] . "</h5>";
                echo '<p class="card-text">Descripción general.</p>';
                echo '<a href="region/' . $row["Url"] . '.php" class="btn btn-primary">Iniciar</a>';
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "0 resultados";
        }

        // Cierra la conexión
        $conn->close();
        ?>
    </div>
</div>

<!-- Incluye el JavaScript de Bootstrap para algunas funcionalidades (opcional en este caso) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <div class="containercarrousel">
      <div class="carousel">
        <div class="item a">A</div>
        <div class="item b">B</div>
        <div class="item c">C</div>
        <div class="item d">D</div>
        <div class="item e">E</div>
        <div class="item f">F</div>
          <div class="item g">G</div>
          <div class="item h">H</div>
          <div class="item i">I</div>
          <div class="item j">J</div>
          <div class="item k">K</div>
          <div class="item l">L</div>
      </div>
    </div>
    <div class="next">Next</div>
    <div class="prev">Prev</div>
    
<script src="./js/mainmenu.js"></script>
</body>
</html>