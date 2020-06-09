<?php
namespace MVCF\CONTROLLERS;
use MVCF\LIB\template;
use MVCF\LIB\language;
use MVCF\LIB\messanger;

class frontController{

    private $controller = 'index';
    private $action = 'default';
    private $params = array();
    private $template;
    private $language;
    private $messanger;


    public function __construct(template $template,language $language,messanger $messanger){
        $this->parseUrl();
        $this->template = $template;
        $this->language = $language;
        $this->messanger = $messanger;
    }
    public function parseUrl(){
        $url = parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);
        $url = str_replace('/mvcFramwork','',$url);
        $url = str_replace('/public','',$url);
        $url = explode('/',trim($url,'/'),3);
        if(isset($url[0]) && $url[0] != ''){
            $this->controller = $url[0];
        }
        if(isset($url[1]) && $url[1] != ''){
            $this->action = $url[1];
        }
        if(isset($url[2]) && $url[2] != ''){
            $this->params = explode('/',$url[2]);
        }
    }
    public function dispatch(){
        $controllerName = 'MVCF\CONTROLLERS\\'.$this->controller.'Controller';
        if(!class_exists($controllerName)){
            $this->controller = 'notFoundController';
            $controllerName = 'MVCF\CONTROLLERS\\'.$this->controller;
        }
        $controllerName = new $controllerName();
        $this->action .= 'Action';
        if(!method_exists($controllerName,$this->action)){
            $this->action = 'notFoundAction';
        }
        $controllerName->setController($this->controller);
        $controllerName->setAction($this->action);
        $controllerName->setParams($this->params);
        $controllerName->setTemplate($this->template);
        $controllerName->setLanguage($this->language);
        $controllerName->setMessanger($this->messanger);

        $controllerName->{$this->action}();
    }

}