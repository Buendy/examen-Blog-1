<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 30/12/18
 * Time: 17:38
 */

namespace Mini\Controller;
Use Mini\Core\Controller;
Use Mini\Core\Validacion;
Use Mini\Model\User;


class UserController extends Controller
{

    public function login()
    {
        $errores = [];
        if(!isset($_SESSION['userConSesionIniciada']['id'])){
            if(!$_POST){
                echo $this->view->render("/user/login");
            }else{

                if(Validacion::checkField() != null){
                    Validacion::formateaDatos($_POST['initname']);
                    $errores['inituser']=Validacion::checkField();
                };

                if(Validacion::checkPass() != null){
                    $errores['pass']=Validacion::checkPass();
                    Validacion::formateaDatos($_POST['pass']);
                    Validacion::formateaDatos($_POST['pass']);
                    Validacion::formateaDatos($_POST['pass']);
                };


                if(!$errores){
                    if(Validacion::checkRep('administradores', 'email', $_POST['initname'], 'password', $_POST['pass']) != null){
                        $errores['inituser']=Validacion::checkRep('administradores', 'email', $_POST['initname'], 'password', $_POST['pass']);
                    };
                }



                if ($errores) {
                    echo $this->view->render("/user/login", ["errores" => $errores]);
                } else {

                    $query = new User();
                    $user = $query->allFields('administradores', 'email', $_POST['initname']);



                    $_SESSION['userConSesionIniciada']['id'] = $user['id'];
                    $_SESSION['userConSesionIniciada']['email'] = $user['email'];
                    d($_SESSION);
                    d($user);

                    echo $this->view->render("/partials/login-succes");

                }

            }

        }else{

            echo $this->view->render("/error/error-login");
        }
    }

    public function logout()
    {
        session_destroy();
        echo $this->view->render("/partials/logout");
    }

}