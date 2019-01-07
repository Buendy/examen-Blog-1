<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?= $titulo ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- JS -->
    <!-- please note: The JavaScript files are loaded in the footer to speed up page construction -->
    <!-- See more here: http://stackoverflow.com/q/2105327/1114320 -->

    <!-- CSS -->
    <link href="<?php echo URL; ?>css/estilos.css" rel="stylesheet">
</head>
<body>
<div class="content">
    <div class="cabecera">
        <h1>PHP</h1>
        <p>Practicas PHP</p>
        <p>Sitio creado por <b>Daniel Buendia</b>.</p>
    </div>
    <div class="cabecera2">

    </div>
</div>


<?php $this->insert('partials/menu') ?>
<div class="content">
    <?php $this->insert('partials/izquierda') ?>
    <div class="centro">
        <?= $this->section('content') ?>
    </div>

</div>

<?php $this->insert('partials/footer') ?>

<!-- jQuery, loaded in the recommended protocol-less way -->
<!-- more http://www.paulirish.com/2010/the-protocol-relative-url/ -->
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<!-- define the project's URL (to make AJAX calls possible, even when using this in sub-folders etc) -->
<script>
    var url = "<?php echo URL; ?>";
</script>

<!-- our JavaScript -->
<script src="<?php echo URL; ?>js/application.js"></script>
</body>
</html>


