<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>
    <?php if (isset($_GET["url"])) {
      $url = $_GET["url"];

      echo $url;
    } else {
      echo "Selection failed";
    } ?>
    </title>
    <link rel="stylesheet" href="https://rawcdn.githack.com/SochavaAG/example-mycode/master/_common/css/reset.css" />
    <link rel="stylesheet" href="./style.css" />
    <link rel="shortcut icon" href="#" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  </head>

  <body>
    <nav class="navbar fixed-top bg-dark navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
      <div class="container-fluid">
        <button type="button" class="btn btn-danger" onclick="history.back()">
            <i class="bi bi-box-arrow-left h1"></i>
        </button>
      </div>
    </nav>
    <div class="ag-timeline-block">
      <div class="ag-timeline_title-box">
        <div class="ag-timeline_title" id="system_title"></div>
        <div class="ag-timeline_tagline">Desplazate hacia abajo para seleccionar el caso</div>
      </div>
      <section class="ag-section">
        <div class="ag-format-container">
          <div class="js-timeline ag-timeline">
            <div class="js-timeline_line ag-timeline_line">
              <div class="js-timeline_line-progress ag-timeline_line-progress"></div>
            </div>
            <div class="ag-timeline_list" id="contenedor-json"></div>
          </div>
        </div>
      </section>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="./script.js"></script>
  </body>
</html>
