<?php $this->layout('layout');
d($data);
?>

<div class="contentTitles">
    <div class="titles">
        <?php if(isset($_SESSION['check'])) : ?>
            <form action="<?php echo URL; ?>home/index" method="post">
                <p><label for="search">Buscar por palabras: </label><input type="text" name="search"><input type="submit" value="Buscar" class="btnss"></p>
            </form>
        <?php endif ?>
    </div>
</div>

<div class="contentTitles">
    <div class="titles">
        <h2>Home</h2>
    </div>
    <div class="paddin">
        <h3>You are in the View: application/view/home/index.php (everything in the box comes from this file)</h3>
        <p>In a real application this could be the homepage.</p>
    </div>
</div>



<?php  foreach($data as $value):  ?>

    <div class="contentTitles">
        <div class="titles">
            <h5><a href="<?= URL?>post/show/<?= $value->id ?>"><?= $value->titulo  ?></a><span style="float: right;"><?= $value->fecha ?></span></h5>
        </div>
        <div class="paddin">
            <p><?= $value->resumen ?></p>
            <div class="autor">Categoría: <?= $value->nombre ?></div>
        </div>
    </div>

<?php endforeach ?>




