<?php
namespace MVCF\LIB;

class autoLoad{
    public static function autoload($classname){
        $classname = APP_PATH.$classname;
        $classname = str_replace('MVCF','',$classname);
        $classname = str_replace('\\',DS,$classname);
        $classname = strtolower($classname);
        $classname = $classname.'.php';
        if(file_exists($classname)){
            require_once $classname;
        }
    }

}

spl_autoload_register(__NAMESPACE__.'\autoLoad::autoload');
