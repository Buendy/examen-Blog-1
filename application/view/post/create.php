<?php $this->layout('layout');
use Mini\Core\Functions;
$content = new Functions();
d($categoria);
?>

<div class="contentTitles">
    <div class="titles">
        <h2>Home</h2>
    </div>
    <div class="paddin">
        <h3>You are in the View: application/view/categories/create.php (everything in the box comes from this file)</h3>
        <p>In a real application this could be the category form.</p>

    </div>
</div>


<div class="contentTitles">
    <div class="titles">
        <h2>Formulario para la creación posts</h2>
    </div>
    <div class="paddin">
        <?php
        if(isset($errores)){
            Functions::mostrarErrorCampo('titulo', $errores);
            Functions::mostrarErrorCampo('resumen', $errores);
           Functions::mostrarErrorCampo('contenido', $errores);
            Functions::mostrarErrorCampo('palabras', $errores);
            Functions::mostrarErrorCampo('categoria', $errores);
            Functions::mostrarErrorCampo('privado', $errores);}
        ?>
        <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post">
            <p><label for="titulo">Nombre:</label></p>
            <p><input type="text" name="titulo" <?= $content::mostrarCampo('titulo') ?>></p>

            <p><label for="resumen">Resumen:</label></p>
            <p><textarea name="resumen" id="" cols="30" rows="5"><?= $content->mostrarCampo2('resumen') ?></textarea></p>

            <p><label for="contenido">Contenido:</label></p>
            <p><textarea name="contenido" id="" cols="30" rows="10"><?= $content->mostrarCampo2('contenido') ?></textarea></p>

            <p><label for="palabras">Palabras:</label></p>
            <p><input type="text" name="palabras" <?= \Mini\Core\Functions::mostrarCampo('palabras') ?>></p>

            <p><label for="privado">Privado:</label></p>
            <input type="radio" name="privado" value="1">Si
            <input type="radio" name="privado" value="0">No

            <p><label for="categoria">Categoría:</label></p>
            <select name="categoria" id="">
                <option value="-">Seleccione una categoría</option>
                <?php foreach ($categoria as $value) :?>
                <option value="<?= $value->id ?>"><?= $value->nombre ?></option>
                <?php endforeach; ?>
            </select>


            <p><input type="submit" value="Crear" class="btnss"></p>
        </form>


    </div>
</div>
