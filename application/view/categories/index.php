<?php $this->layout('layout');

?>

<div class="contentTitles">
    <div class="titles">
        <h2>Home</h2>
    </div>
    <div class="paddin">
        <h3>You are in the View: application/view/categories/index.php (everything in the box comes from this file)</h3>
        <p>In a real application this could be the homepage categories.</p>

    </div>
</div>

<div class="contentTitles">

    <div class="titles">
        <h2>Tabla de categorías</h2>
    </div>
    <div class="paddin">
        <p>Crear nuevas categorias: <a href="<?= URL ?>category/create" class="btnss">CREAR</a></p>
        <table>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>

            <?php  foreach($data as $value): ?>
                <tr>
                    <td><?= $value->nombre ?></td>

                    <td><?= $value->descripcion ?></td>
                    <td><a href="<?= URL?>category/edit/<?= $value->id ?>">Editar</a></td>
                </tr>

            <?php endforeach ?>

        </table>
    </div>
</div>





<?php d($data) ?>
