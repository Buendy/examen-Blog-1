<?php  ?>

<div class="content">
    <div class="navbar">
        <a href="<?php echo URL; ?>">INICIO</a>
        <?php if(!isset($_SESSION['userConSesionIniciada']['id'])) : ?>
            <a href="<?php echo URL; ?>user/login" class="float-left">INICIAR SESION</a>
        <?php endif ?>
        <?php if(isset($_SESSION['userConSesionIniciada']['id'])) : ?>
            <a href="<?php echo URL; ?>user/logout" >CERRAR SESION</a>
        <?php endif ?>




    </div>
</div>
