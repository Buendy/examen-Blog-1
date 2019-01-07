<?php
namespace Mini\Core;
Use Mini\Core\Controller;


class View extends Controller
{
    public function render($filename, $data = null)
    {
        if ($data) {
            foreach ($data as $key => $value) {
                $this->{$key} = $value;
            }
        }
        echo $this->view->render("/error/index");
    }
    /*public function renderFeedbackMessages()
    {
        require APP . 'view/_templates/feedback.php';
        Session::set('feedback_negative', null);
        Session::set('feedback_positive', null);
    }*/
}