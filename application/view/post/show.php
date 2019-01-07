<?php $this->layout('layout');
d($data);
?>


<div class="contentTitles">
    <div class="titles">
        <h2>Show post</h2>
    </div>
    <div class="paddin">
        <h3>You are in the View: application/view/post/show.php (everything in the box comes from this file)</h3>
        <p>In a real application this could be the post show page.</p>
    </div>
</div>



<?php  foreach($data as $value): ?>

    <div class="contentTitles">
        <div class="titles">
            <h5><?= $value->titulo  ?><span style="float: right;"><?= $value->fecha ?></span></h5>

        </div>
        <div class="paddin">
            <p><?=  $value ->resumen ?></p>
            <?php if(!isset($_SESSION['userConSesionIniciada']['email'])): ?>
            <?php if($data[0]->privado) :?>
                <p class="centrado error-list">Este post es privado</p>
            <?php else : ?>
                <p> <?= $value->contenido ?></p>
            <?php endif;  ?>
            <?php else : ?>
                <p> <?= $value->contenido ?></p>
            <?php endif;  ?>

        </div>
    </div>


<?php endforeach ?>

