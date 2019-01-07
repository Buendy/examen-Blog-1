<?php $this->layout('layout'); d($data)?>

<div class="contentTitles">
    <div class="titles">
        <?php if(isset($_SESSION['check'])) : ?>
            <form action="<?php echo URL; ?>post/index" method="post">
                <p><label for="search">Buscar por palabras: </label><input type="text" name="search"><input type="submit" value="Buscar" class="btnss"></p>
            </form>
        <?php endif ?>
    </div>
</div>
<div class="contentTitles">
    <div class="titles">
        <h2>Posts index</h2>
    </div>
    <div class="paddin">
        <h3>You are in the View: application/view/post/index.php (everything in the box comes from this file)</h3>
        <p>In a real application this could be the posts show page.</p>
    </div>
</div>

<div class="contentTitles">
    <div class="titles">
        <h2>Listado de posts</h2>
    </div>
    <div class="paddin">
        <p>Crear nuevo post: <a href="<?= URL ?>post/create" class="btnss">CREAR</a></p>
        <table>
            <tr>
                <th>Nombre</th>
                <th>Resumen</th>
                <th>Palabras</th>
                <th colspan="2">Acciones</th>
            </tr>
            <?php  foreach($data as $value): ?>
                <tr>
                    <td><?= $value->titulo ?></td>

                    <td><?= $value->resumen ?></td>
                    <td><?= $value->palabras ?></td>
                    <td><a href="<?= URL?>post/edit/<?= $value->id ?>">Editar</a></td>
                    <form action="<?= URL ?>post/delete" method="post">
                        <input type="hidden" value="<?= $value->id ?>" name="id">
                        <td><input type="submit" value="Borrar" class="btnsdelete"></td>
                    </form>
                </tr>

            <?php endforeach ?>
        </table>

    </div>
</div>

