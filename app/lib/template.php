<?php
namespace MVCF\LIB;
use MVCF\LIB\messanger;

class template{    
    private $files;
    private $data;
    private $messanger;

    public function __construct(){
        $this->files = require_once APP_PATH.'config'.DS.'templateConfig.php';
    }

    public function setMessanger(messanger $messanger){
        $this->messanger = $messanger;
    }
    
    private  function getHeaderTemplateStart()
    {
        $headerTemplateStart = TEMPLATE_PATH.$this->files['template']['headerTemplateStart'];
        return $headerTemplateStart;
    }    

    private function getHeaderCss(){
        if(is_array($this->files['headerRessource']['css']) && !empty($this->files['headerRessource']['css'])){
            foreach($this->files['headerRessource']['css'] as $file=>$path){
                if(isset($_SESSION['lang'])){
                    $defaultlang = $_SESSION['lang'];
                }else{
                    $defaultlang = DEFAULT_LANG;
                }
                echo '<link type="text/css" rel="stylesheet" href="'.$path.$defaultlang.'.css" />';
            }
        }
    }

    private function getHeaderJs(){
        if(is_array($this->files['headerRessource']['js']) && !empty($this->files['headerRessource']['js'])){
            foreach($this->files['headerRessource']['js'] as $file=>$js){
                echo '<script src="'.$js.'" ></script>';
            }
        }
    }

    private function getHeaderTemplateEnd()
    {
        $headerTemplateEnd = TEMPLATE_PATH.$this->files['template']['headerTemplateEnd'];
        return $headerTemplateEnd;
    }

    private function getHeader(){
        $header = TEMPLATE_PATH.$this->files['template']['header'];
        return $header;
    }


    public function setData($data)
    {
        $this->data = $data;
    }

    private function getNav(){
        return TEMPLATE_PATH.$this->files['template']['nav'];
    }

    private function getWrapperStart(){
        return TEMPLATE_PATH.$this->files['template']['wrapperStart'];
    }
    private function getWrapperEnd(){
        return TEMPLATE_PATH.$this->files['template']['wrapperEnd'];
    }

    private function getContainerStart(){
        return  TEMPLATE_PATH.$this->files['template']['containerStart'];
    }

    private function getContainerEnd(){
        return TEMPLATE_PATH.$this->files['template']['containerEnd'];
    }

    private function getFooter()
    {
        if(is_array($this->files['footerRessources']['js']) && !empty($this->files['footerRessources']['js'])){
                foreach($this->files['footerRessources']['js'] as $js){
                    echo '<script src="js/"'.$js.' ></script>';
                }
            }
        return  TEMPLATE_PATH.$this->files['template']['footer'];
    }

    public function render($view){
        extract($this->data);
        require_once $this->getHeaderTemplateStart();
        $this->getHeaderCss();
        $this->getHeaderJs();
        require_once $this->getHeaderTemplateEnd();
        require_once $this->getHeader();

        require_once $this->getWrapperStart();
        require_once $this->getNav();
        require_once $this->getContainerStart();
        //TODO:her you have to create and show all you messages
        $this->messanger->show($this->data);
        require_once $view;
        
        require_once $this->getContainerEnd();
        require_once $this->getWrapperEnd();
        require_once $this->getFooter();
    }
    

}