<?php

namespace Mini\Controller;
use Illuminate\Support\Facades\URL;
use Mini\Core\Controller;
use Mini\Libs\Dbpdo;
Use Mini\Model\Contact;
use Mini\Core\Validacion;
use Mini\Model\Category;


class PostController extends Controller
{
    public function index()
    {
        if(!isset($_SESSION['userConSesionIniciada']['id'])){
            echo $this->view->render("/error/error-private");
        }else {

            if (isset($_POST['search'])) {
                $search = new Contact();
                $query = $search->search($_POST['search']);
                if ($query) {
                    echo $this->view->render("/home/index", ['data' => $query]);
                } else {
                    echo $this->view->render("/partials/error-search");
                }
            } else {
                $_SESSION['check'] = true;
                $categorias = new Dbpdo();
                $query = $categorias->all('posts');
                echo $this->view->render("/post/index", ['data' => $query]);
            }
        }

    }
    public function show($id = null)
    {

        if($id == null){
            header("Location:" . URL);
        }else {
            $post = new Dbpdo();
            $query = $post->allWithId('posts', $id);
            echo $this->view->render("post/show", ["data" => $query]);
        }

    }


    public function create()
    {
        if(!isset($_SESSION['userConSesionIniciada']['id'])){
            echo $this->view->render("/error/error-private");
        }else {
            $categoria = new Dbpdo();
            $query = $categoria->all('categorias');
            $errores = [];
            if(!$_POST){
                echo $this->view->render("/post/create", ['categoria' => $query]);
            }else {

                $repeat = new Dbpdo();
                $validaciones = new Validacion();

                if (!isset($_POST['titulo'])) {
                    $errores['titulo'] = 'No he recibido el título';
                } else {
                    Validacion::formateaDatos($_POST['titulo']);
                    $value = $validaciones->validaTitulo($_POST['titulo']);
                    if ($value) {
                        $errores['titulo'] = $value;
                    }
                    if ($check = $repeat->checkRepeat('posts', 'titulo', $_POST['titulo'])) {
                        $errores['titulo'] = 'Este título ya existe';
                    }
                }

                if (empty($_POST['resumen'])) {
                    $errores['resumen'] = 'No he recibido el resumen';
                } else {
                    Validacion::formateaDatos($_POST['resumen']);
                    $value = $validaciones->validaResumen($_POST['resumen']);
                    if ($value) {
                        $errores['resumen'] = $value;
                    }
                }


                if (empty($_POST['contenido'])) {
                    $errores['contenido'] = 'No he recibido el contenido';
                } else {
                    Validacion::formateaDatos($_POST['contenido']);
                    $value = $validaciones->validaContenido($_POST['contenido']);
                    if ($value) {
                        $errores['contenido'] = $value;
                    }
                }

                if (empty($_POST['palabras'])) {
                    $errores['palabras'] = 'No he recibido ninguna palabra';
                } else {
                    Validacion::formateaDatos($_POST['palabras']);
                    $value = $validaciones->validaPalabras($_POST['palabras']);
                    if ($value) {
                        $errores['contenido'] = $value;
                    }
                }

                if (!isset($_POST['categoria'])) {
                    $errores['categoria'] = 'No he recibido la categoria';
                } else {
                    Validacion::formateaDatos('categoria');
                    $cat = new Dbpdo();
                    $check = $cat->checkRepeat('categorias', 'id', $_POST['categoria']);
                    if ($check == false) {
                        $errores['categoria'] = 'No has elegido una categoría correcta';
                    }

                }

                if (!isset($_POST['privado'])) {
                    $errores['privado'] = 'No he recibido si es privado o no';
                } else {
                    if ($_POST['privado'] != '0') {
                        if ($_POST['privado'] != '1') {
                            $errores['privado'] = 'No has indicado si es privado o no';
                        }
                    }

                }
            }



            if($errores){
                echo $this->view->render("/post/create", ['categoria' => $query, 'errores' => $errores]);

            }else{
                self::store();
            }

        }

    }

    public function store()
    {
        if(!isset($_SESSION['userConSesionIniciada']['id'])){
            header("Location:" . URL);
        }else {
            if(!isset($_POST)){
                header("Location:" . URL);
            }else{
                $slug = str_replace(' ', '_', $_POST['titulo']);

                $insert = new Contact();
                $insert->insert(['titulo' => $_POST['titulo'], 'slug' => $slug, 'resumen' => $_POST['resumen'], 'contenido' => $_POST['contenido'],
                    'palabras' => $_POST['palabras'], 'categoria' => $_POST['categoria'], 'privado' => $_POST['privado']]);
                echo $this->view->render("/partials/post-success");
            }

        }

    }

    public function edit($id = null)
    {
        if(!isset($_SESSION['userConSesionIniciada']['id'])){
            header("Location:" . URL);
        }else{
            if($id){
                $categoria = new Dbpdo();
                $query = $categoria->all('categorias');
                $errores = [];
                if(!$_POST){

                    $post = new Dbpdo();
                    $postUp = $post->allWithId('posts', $id);
                    echo $this->view->render("/post/edit", ['categoria' => $query, 'data' => $postUp]);


                }else{


                    $post = new Contact();
                    $validaciones = new Validacion();

                    if(!isset($_POST['titulo'])){
                        $errores['titulo'] = 'No he recibido el titulo';
                    }else{
                        Validacion::formateaDatos($_POST['titulo']);
                        if(!$check = $post->checkRepeatUpdate('posts', 'titulo', $_POST['titulo'], $id)){
                            $errores['titulo'] = 'Ese titulo ya existe';
                        }
                    }

                    if(empty($_POST['resumen'])){
                        $errores['resumen'] = 'No he recibido el resumen';
                    }else{
                        Validacion::formateaDatos($_POST['resumen']);
                        $value = $validaciones->validaResumen($_POST['resumen']);
                        if($value){
                            $errores['resumen'] = $value;
                        }
                    }


                    if(empty($_POST['contenido'])){
                        $errores['contenido'] = 'No he recibido el contenido';
                    }else{
                        Validacion::formateaDatos($_POST['contenido']);
                        $value = $validaciones->validaContenido($_POST['contenido']);
                        if($value){
                            $errores['contenido'] = $value;
                        }
                    }

                    if(empty($_POST['palabras'])){
                        $errores['palabras'] = 'No he recibido ninguna palabra';
                    }else{
                        Validacion::formateaDatos($_POST['palabras']);
                    }

                    if(!isset($_POST['categoria'])){
                        $errores['categoria'] = 'No he recibido la categoria';
                    }else{
                        Validacion::formateaDatos('categoria');
                        $cat = new Dbpdo();
                        $check = $cat->checkRepeat('categorias','id', $_POST['categoria']);
                        if($check == false){
                            $errores['categoria'] = 'No has elegido una categoría correcta';
                        }

                    }

                    if(!isset($_POST['privado'])){
                        $errores['privado'] = 'No he recibido si es privado o no';
                    }else{
                        if($_POST['privado'] != '0'){
                            if($_POST['privado'] != '1'){
                                $errores['privado'] = 'No has indicado si es privado o no';
                            }
                        }

                    }


                    if($errores){
                        echo $this->view->render("/post/edit", ['data' => $_POST, 'errores' => $errores, 'categoria' => $query]);
                    }else{
                        $post = new Contact();
                        $slug = str_replace(' ', '_', $_POST['titulo']);
                        $dataArray = ['id' => $id, 'titulo' => $_POST['titulo'], 'slug' => $slug, 'resumen' => $_POST['resumen'], 'contenido' => $_POST['contenido'],
                            'palabras' => $_POST['palabras'], 'categoria' => $_POST['categoria'], 'privado' => $_POST['privado']];
                        $post->update('posts', $dataArray);
                        echo $this->view->render("/partials/update-success");
                    }
                }
            }else{
                header("Location:" . URL);
            }


        }



    }


    public function delete()
    {
        if(!isset($_SESSION['userConSesionIniciada']['id'])){
            header("Location:" . URL);
        }else{
            if(!isset($_POST)){
                header("Location:" . URL . "post/show");
            }else{
                $postDeleted = new Dbpdo();
                $postDeleted->delete('posts', $_POST['id']);
                echo $this->view->render("/partials/delete-success");
            }
        }

    }
}


