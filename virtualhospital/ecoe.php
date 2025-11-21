<!DOCTYPE html>
<html lang="es">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hospital Virtual Menú</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    
    </head>
<body style="min-height: 100vh;margin: 0;">  

<?php
$reader = new XMLReader();
$reader->open("ecoe/ECOE-scenarios.xml");
echo '<div class="row justify-content-center">';
while ($reader->read()) {
    if ($reader->nodeType == XMLReader::ELEMENT && $reader->name == "scenario") {
        if ($reader->getAttribute("enabled")=="true") {
            echo '<div class="card" style="width: 18rem;">';
            echo '<img src="' . $reader->getAttribute("icon") . '.png" class="card-img-top" alt="...">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . $reader->getAttribute("name") . "</h5>";
            echo '<p class="card-text">En este escenario...</p>';
            echo '<a href="ecoe-room.php?room=' . $reader->getAttribute("room") . '" class="btn btn-primary">Entrar</a>';
            echo "</div>";
            echo "</div>";
        }
    }
}
echo "</div>";
$reader->close();
?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>

</body>
</html>