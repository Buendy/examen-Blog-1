<?php $this->layout('layout');
d($_GET);
d($data);
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
        <h2>Formulario para la creación de categorías</h2>
    </div>
    <div class="paddin">
        <?php
        if(isset($errores)){
            \Mini\Core\Functions::mostrarErrorCampo('nombre', $errores);
            \Mini\Core\Functions::mostrarErrorCampo('descripcion', $errores);
            }
        ?>


        <form action="<?= URL ?>category/edit/<?= $data[0]->id ?>" method="post">

            <p><label for="nombre">Nombre:</label></p>
            <p><input type="text" name="nombre" value="<?= isset($data[0]->nombre) ? $data[0]->nombre : $data['nombre'] ?>"></p>
            <p><label for="descripcion">Descripción:</label></p>
            <p><textarea name="descripcion" id="" cols="30" rows="10"><?= isset($data[0]->descripcion) ? $data[0]->descripcion : $data['descripcion'] ?></textarea></p>

            <p><input type="submit" value="Crear" class="btnss"></p>
        </form>


    </div>
</div>
