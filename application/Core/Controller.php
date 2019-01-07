<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 2/12/18
 * Time: 17:23
 */

namespace Mini\Core;


class Controller
{
    protected $view;

    public function __construct()
    {
        $this->view=TemplatesFactory::templates();
        Session::init();
    }
}