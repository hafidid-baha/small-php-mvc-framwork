<?php
namespace MVCF\CONTROLLERS;
use MVCF\LIB\template;
use MVCF\LIB\language;
use MVCF\LIB\messanger;

class abstractController{
    protected $controller;
    protected $action;
    protected $params;
    protected $template;
    protected $language;
    protected $messanger;
    protected $data = array();

    public function setController($controller){
        $this->controller = $controller;
    }

    public function setAction($action){
        $this->action = $action;
    }

    public function setMessanger(messanger $messanger){
        $this->messanger = $messanger;
    }

    public function setParams($params){
        $this->params = $params;
    }

    public function setLanguage(language $language){
        $this->language = $language;
    }

    public function notFoundAction(){
        $this->view();
    }

    public function setTemplate(template $template){
        $this->template = $template;
    }

    protected function view(){
        $newAction = str_replace('Action','',$this->action);
        $view = VIEWS_PATH.$this->controller.DS.$newAction.'View.php';
        if(file_exists($view)){  
            $this->data = array_merge($this->data,$this->language->getData());
            $this->template->setData($this->data); 
            $this->template->setMessanger($this->messanger);       
            $this->template->render($view);
            
        }else{
            $view = VIEWS_PATH.'notFound'.DS.'defaultView.php';
            $this->template->render($view);
        }
    }
}