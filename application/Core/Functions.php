<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 2/12/18
 * Time: 19:36
 */

namespace Mini\Core;


class Functions
{
    public static function mostrarErrorCampo($campo, $errores){
        if(isset($errores[$campo])){
            echo '<p class="error-list">' . $errores[$campo] . '</p>';
        }
    }

    public static function mostrarErrorCampo2($campo, $errores){
        if(isset($errores[$campo])){
            echo '<span class="listaErrores form-group">   ' . $errores[$campo] . '   </span>';
        }
    }


    public static function mostrarCampo($campo){
        if(isset($_POST[$campo])){
            echo 'value="' . $_POST[$campo] . '"';
        }
    }

    public function mostrarCampo2($campo){
        if(isset($_POST[$campo])){
            echo $_POST[$campo];
        }
    }




}