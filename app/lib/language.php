<?php

namespace MVCF\LIB;
class language{
    private $mergedData = [];
    private $lang;

    public function __construct(){
        if(isset($_SESSION['lang'])){
            $this->lang = $_SESSION['lang'];
        }else{
            $this->lang = DEFAULT_LANG;
        }
    }

    public function load($path){
        $pathParts = explode('.',$path);
        if(!empty($pathParts) && count($pathParts) == 2){
            $file = LANGUAGE_PATH.$this->lang.DS.$pathParts[0].DS.$pathParts[1].'Lang.php';
            if(is_file($file) && file_exists($file)){
                require_once $file;
                if(isset($lang) && !empty($lang)){
                    foreach($lang as $label => $name){
                        $this->mergedData[$label] = $name;
                    }
                }          
            }
        }
    }

    public function getData(){
        return $this->mergedData;
    }
}