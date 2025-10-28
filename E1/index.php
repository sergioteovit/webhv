<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuadrícula de 11 Botones</title>
    <!-- Incluye el CSS de Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            margin-top: 2rem;
        }
        .btn-cuadrado {
            width: 100%; /* El botón ocupa todo el ancho de su columna */
            padding-top: 100%; /* Mantiene una relación de aspecto cuadrada */
            position: relative;
        }
        .btn-cuadrado .texto-btn {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
        }
    </style>
</head>
<body>

<div class="container">
    <h1 class="text-center mb-4">Seleccionar sistema</h1>
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
            // Imprime los datos de cada fila
            echo "<table><tr><th>ID</th><th>System</th><th>Icon</th><th>Description</th><th>Url</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" .
                    $row["ID"] .
                    "</td><td>" .
                    $row["System"] .
                    "</td><td>" .
                    $row["Icon"] .
                    "</td><td>" .
                    $row["Description"] .
                    "</td><td>".
                    $row["Url"] .
                    "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "0 resultados";
        }

        // Cierra la conexión
        $conn->close();

        // Define el número total de botones
        $numero_botones = 11;
        // Se define el número de columnas para que el diseño sea uniforme.
        // Por ejemplo, 4 columnas en dispositivos medianos (md) o más grandes.
        $columnas_por_fila = 4;

        // Bucle para generar los 11 botones
        for ($i = 1; $i <= $numero_botones; $i++) {
            // Crea una columna para cada botón
            // En pantallas medianas y grandes, muestra $columnas_por_fila por fila.
            // En pantallas pequeñas, muestra 2 por fila (col-6).
            // En pantallas extra-pequeñas, muestra 1 por fila (col-12).
            echo '<div class="col-12 col-sm-6 col-md-3 mb-3">';
            echo '<button type="button" class="btn btn-primary btn-cuadrado"><span class="texto-btn">Botón ' .
                $i .
                "</span></button>";
            echo "</div>";
        }
        ?>
    </div>
</div>

<!-- Incluye el JavaScript de Bootstrap para algunas funcionalidades (opcional en este caso) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>