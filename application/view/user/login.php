<?php
use Mini\Core\Functions;
$this->layout('layout'); ?>

<div class="contentTitles">
    <div class="titles">
        <h2>Login</h2>
    </div>
    <div class="paddin">

        <h2>You are in the View: application/view/login/index.php (everything in the box comes from this file)</h2>
        <p>In a real application this could be the login page.</p>
    </div>
</div>


<div class="contentTitles">
    <div class="titles">
        <h5>Formulario de login</h5>
    </div>
    <div class="paddin">
        <div class="container">
            <div align="center">
                <form class="" action="<?= URL."user/login"?>" method="post">
                    <?php
                    if(isset($errores)){
                        Functions::mostrarErrorCampo('pass', $errores);
                        Functions::mostrarErrorCampo('inituser', $errores);            }
                    ?>
                    <p><input type="text" name="initname" class="form-control"></p>
                    <p>Contraseña:</p>
                    <p><input type="password" name="pass" value="" class="form-control"></p>
                    <p><input type="submit" name="submit" value="Acceder"></p>
                </form>
            </div>
        </div>

    </div>
</div>
