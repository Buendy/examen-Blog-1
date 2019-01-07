<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 2/12/18
 * Time: 17:27
 */

namespace Mini\Core;
use League\Plates\Engine;

class TemplatesFactory
{
    public static $templates;

    public static function templates()
    {
        if(!TemplatesFactory::$templates){
            TemplatesFactory::$templates = new Engine(APP. "view");
            TemplatesFactory::$templates->addData(["titulo" => 'MINI3']);
        }
        return TemplatesFactory::$templates;
    }

}