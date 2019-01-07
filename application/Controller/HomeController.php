<?php

/**
 * Class HomeController
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */

namespace Mini\Controller;
use Mini\Core\Controller;
use Mini\Model\Post;

class HomeController extends Controller
{

    public function index()
    {

        if(isset($_POST['search'])){
            $search = new Post();
            $query = $search->search($_POST['search']);
            if($query){
                echo $this->view->render("/home/index", ['data' => $query]);
            }else{
                echo $this->view->render("/partials/error-search");
            }

        }else {
            $_SESSION['check'] = true;
            $this->view->addData(['titulo' => 'Home - [MINI3]']);
            $allPosts = new Post();
            $posts = $allPosts->allWithCategory();
            echo $this->view->render("/home/index", ['data' => $posts]);
        }

    }


}
