<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 30/12/18
 * Time: 21:04
 */

namespace Mini\Controller;
use Mini\Libs\Dbpdo;
use Mini\Core\Controller;
use Mini\Core\Validacion;
use Mini\Model\Category;
use Exception;




class CategoryController extends Controller
{
    public function index()
    {
        $categorias = new Dbpdo();

        $query = $categorias->all('categorias');
        echo $this->view->render("/categories/index", ['data' => $query]);
    }

    public function create()
    {
        if(!isset($_SESSION['userConSesionIniciada']['id'])){
            echo $this->view->render("/error/error-private");
        }else {
            $errores = [];
            if(!$_POST){
                echo $this->view->render("/categories/create");
            }else{
                $repeat = new Dbpdo();
                $validaciones = new Validacion();

                if(!isset($_POST['nombre'])){
                    $errores['nombre'] = 'No he recibido el nombre';
                }else{
                    Validacion::formateaDatos($_POST['nombre']);
                    $value = $validaciones->validaNombre($_POST['nombre']);
                    if($value){
                        $errores['nombre'] = $value;
                    }
                    if($check = $repeat->checkRepeat('categorias','nombre', $_POST['nombre'])){
                        $errores['nombre'] = 'Este producto ya existe';
                    }
                }
                if(empty($_POST['descripcion'])){
                    $errores['descripcion'] = 'No he recibido la descripción';
                }else{
                    Validacion::formateaDatos($_POST['descripcion']);
                }

                if($errores){
                    echo $this->view->render("/categories/create", ['errores' => $errores]);

                }else{
                    self::store();
                }

            }

        }


    }

    public function store()
    {

        if(!isset($_POST['nombre']) || !isset($_POST['descripcion']) ){
            header("Location:" . URL);
        }else{
            try{
                $insert = new Category();
                $insert->insert(['nombre' => $_POST['nombre'], 'descripcion' => $_POST['descripcion']]);
                echo $this->view->render("/partials/category-success");

            }catch (Exception $e){
                echo '<h3>Ha ocurrido un error en la conexión a la BD</h3>';
                if($insert->modeDEV){
                    echo $e->getMessage();
                }
            }
        }



    }



    public function edit($id = null)
    {
        if(!isset($_SESSION['userConSesionIniciada']['id'])){
            echo $this->view->render("/error/error-private");
        }else {
            if($id){
                $errores = [];
                if(!$_POST){
                    $categorias = new Dbpdo();
                    $query = $categorias->allWithId('categorias', $id);
                    echo $this->view->render("/categories/edit", ['data' => $query]);


                }else{

                    $category = new Category();
                    $validaciones = new Validacion();

                    if(!isset($_POST['nombre'])){
                        $errores['nombre'] = 'No he recibido el nombre';
                    }else{
                        Validacion::formateaDatos($_POST['nombre']);
                        if(!$check = $category->checkRepeatUpdate('categorias', 'nombre', $_POST['nombre'], $id)){
                            $errores['nombre'] = 'Ese nombre ya existe';
                        }
                    }

                    if(!isset($_POST['descripcion'])){
                        $errores['descripcion'] = 'No he recibido la descripción';
                    }else{
                        Validacion::formateaDatos($_POST['descripcion']);
                        $value = $validaciones->validaDescripcion($_POST['descripcion']);
                        if($value){
                            $errores['descripcion'] = $value;
                        }
                    }


                    if($errores){
                        echo $this->view->render("/categories/edit", ['data' => $_POST, 'errores' => $errores]);
                    }else{
                        $dataArray = ['id' => $id, 'nombre' => $_POST['nombre'], 'descripcion' => $_POST['descripcion']];
                        $category->update('categorias', $dataArray);
                        echo $this->view->render("/partials/update-success");
                    }
                }

            }else{
                header("Location:" . URL);
            }

        }





    }


}