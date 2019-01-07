<?php ?>
<div class="izquierda">
    <?php if(isset($_SESSION['userConSesionIniciada']['email'])): ?>
        <h4>Area de categorías</h4>
        <p><a href="<?= URL ?>category/index" class="btns">Ver categorías</a></p>
        <p><a href="<?= URL ?>category/create" class="btns">Crear categorías</a></p>
        <h4>Area de posts</h4>
        <p><a href="<?= URL ?>post/index" class="btns">Ver Posts</a></p>
        <p><a href="<?= URL ?>post/create" class="btns">Crear posts</a></p>
    <?php endif; ?>
</div>