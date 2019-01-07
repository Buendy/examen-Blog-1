<?php //$this->layout('layout') ?>
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
<body style="background-color: #f6be15;">
<div class="errorPage">
    <h1>404</h1>
    <h3>This is the Error-page. Will be shown when a page (= controller / method) does not exist.</h3>

</div>
</body>
