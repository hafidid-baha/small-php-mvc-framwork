<?php

namespace MVCF\LIB;

class messanger{

    private $messages = array();
    private $isShowed = false;

    public function add($key,$type = MESSAGE_SUCCESS){ 
        $this->messages[] = $key.'|'.$type;      
    }

    public function show($data){
        extract($data,EXTR_SKIP);
        if(!empty($this->messages)){
            $_SESSION['messages'] = $this->messages;
        }
        
        if(!empty($_SESSION['messages'])){
            echo 'iam her';
            $this->isShowed = true;
            foreach($_SESSION['messages'] as $message){
                $m = explode('|',$message);
                // to look for the right div class name
                echo '<div class= ';
                    if($m[1] == 0){
                        echo "error";
                    }else{
                        echo "success";
                    }

                echo '>';

                if(isset(${$m[0]})) {
                    echo ${$m[0]};
                }
                echo '</div>';            
            }
        }
        
    }

    public function deleteMessages(){
        unset($_SESSION['messages']);
    }
}