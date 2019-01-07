<?php

namespace Mini\Core;
use Mini\Model\User;

class Validacion
{
    private $tam_max = 2 * 1024 * 1024; //declaramos como tam maximo 2 MB

    public static function checkField()
    {

        if(!isset($_POST['initname'])){
            return 'No he recibido el nombre de usuario';

        }else if(!$_POST['initname']){
            return'No he recibido el nombre de usuario';

        }else{
            return null;
        }

    }


    public static function checkPass()
    {
        if(!isset($_POST['pass'])){
            return  'No he recibido la contraseña';

        }else if(!$_POST['pass']){
            return  'No he recibido la contraseña';

        }else{
            return null;
        }
    }

    public static function checkRep($table, $nombreCampo, $valorCampo, $pass, $valorPass)
    {
        $query = new User();
        d($valorPass);
        d(md5($valorPass));

        if(!$query->checkRepeat($table, $nombreCampo, $valorCampo)){
            return 'Usuario o contraseña incorrectos1';



        }else{
            if(!$query->checkRepeatPass($table, $nombreCampo, $valorCampo, $pass,  md5($valorPass))){
                return 'Usuario o contraseña incorrecto2';

            }

        }

    }

    public function validaDescripcion($campo){

        if ( isset($campo)){

            if(strlen($campo) < 20){
                return 'La descripción es demasiado corta<br>';
            }elseif(strlen($campo) > 100){
                return 'la descripcion es demasiado larga';
            }else {
                return null;
            }
        } else {
            return 'No he recibido la descripción';
        }
    }


public function validaPalabras($campo){

    if (isset($campo)){

        if(!preg_match("/^([A-ZÑ\d]{2,}[,]){4,9}[A-ZÑ\d]{2,}$/",$campo)){
            return 'Por favor, introduce de 5 a 10 palabras separadas por comas';
        }else {
            return null;
        }
    } else {
        return 'No he recibido ninguna palabra';
    }
}


    public function validaNombre($campo){

        if (isset($campo)){

            if(strlen($campo) < 4){
                return 'El nombre es demasiado corto<br>';
            }elseif(!preg_match("/[^a-zA-Z' áéíóúàèìòùäëïöüÁÉÍÓÚÀÈÌÒÙÄËÏÖÜ]/", $campo)){
                return 'El nombre no puede contener números o caracteres especiales';
            }else {
                return null;
            }
        } else {
            return 'No he recibido el nombre';
        }
    }

    public function validaTitulo($campo){

        if (isset($campo)){

            if(strlen($campo) < 4){
                return 'El nombre es demasiado corto<br>';
            }elseif(preg_match("/[^a-zA-Z' áéíóúàèìòùäëïöüÁÉÍÓÚÀÈÌÒÙÄËÏÖÜ \d]/", $campo)){
                return 'El titulo no puede contener caracteres especiales';
            }else {
                return null;
            }
        } else {
            return 'No he recibido el titulo';
        }
    }


    public function validaResumen($campo){

        if ( isset($campo)){

            if(strlen($campo) < 20){
                return 'El resumen es demasiado corto<br>';
            }elseif(strlen($campo) > 100){
                return 'El resumen es demasiado largo';
            }else {
                return null;
            }
        } else {
            return 'No he recibido el resumen';
        }
    }

    public function validaContenido($campo){

        if ( isset($campo)){

            if(strlen($campo) < 20){
                return 'El contenido es demasiado corto<br>';
            }elseif(strlen($campo) > 300){
                return 'El contenido es demasiado largo';
            }else {
                return null;
            }
        } else {
            return 'No he recibido el contenido';
        }
    }



    public static function formateaDatos($campo){

        if ( isset($_POST[$campo])){
            $_POST[$campo] = trim($_POST[$campo]);
            $_POST[$campo] = strip_tags($_POST[$campo]);
            $_POST[$campo] = preg_replace("/\"/",'', $_POST[$campo]);
            return $_POST[$campo];
        }

    }



}