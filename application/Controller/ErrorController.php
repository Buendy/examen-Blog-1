<?php
namespace Mini\Controller;
use Mini\Core\Controller;
use Mini\Core\View;
class ErrorController extends Controller
{
    protected $view = null;
    private $msg;
    public function __construct($msg = "") {
        $this->view = new View;
        $this->msg = $msg;
    }
    public function index()
    {
        echo $this->view->render('error/index');
    }
}