<?php
namespace MVCF\LIB;
class sessions extends \SessionHandler{

    private $sessionLifeTime = 0;
    private $sessionPath = '/';
    private $sessionDomain = "";
    private $sessionSecure = false;
    private $sessionHttpOnly = true;
    private $sessionSavePath = SESSION_PATH;
    private $sessionName = "MVCFRAMWORK";


    private $ttl = 1;

    private $cipherKey = 'WYK3Y2@18HASH';
    private $cipherAlgo = MCRYPT_BLOWFISH;
    private $cipherMode = MCRYPT_MODE_ECB;

    public function __construct(){
        ini_set('session.save_handler','files');
        ini_set('session.use_cookies','1');
        ini_set('session.use_only_cookies','1');
        ini_set('session.use_trans_sid','0');

        session_name($this->sessionName);
        session_save_path($this->sessionSavePath);

        //void session_set_cookie_params ( int $lifetime [, string $path [, string $domain [, bool $secure = false [, bool $httponly = false ]]]] )
        session_set_cookie_params($this->sessionLifeTime,$this->sessionPath,$this->sessionDomain,$this->sessionSecure,$this->sessionHttpOnly);
        session_set_save_handler($this);
        
    }

    public function __get($key){
        return $_SESSION[$key];
    }

    public function __set($key,$value){
        $_SESSION[$key] = $value;
    }

    public function read($id){
        //$cipher = mcrypt_encrypt($cipherAlgo,$cipherKey,'hafid',$cipherMode);
        //$decripter = mcrypt_decrypt($cipherAlgo,$cipherKey,$cipher,$cipherMode);
        return mcrypt_decrypt($this->cipherAlgo,$this->cipherKey,parent::read($id),$this->cipherMode);
    }

    public function write($id,$value){
        return parent::write($id, mcrypt_encrypt($this->cipherAlgo,$this->cipherKey,$value,$this->cipherMode));
    }

    public function start(){          
        if(session_id() === ''){
            if(session_start()){
                $this->setSessionStartTime();
                $this->sessionValidity();
            }
        }
    }

    public function __isset($key){
        return isset($_SESSION[$key]) ? true : false;
    }

    private function setSessionStartTime(){
        if(!isset($this->sessionStartTime)){
            $this->sessionStartTime = time();
        }
        return true;
    }

    private function sessionValidity(){
        if((time() - $this->sessionStartTime) > ($this->ttl * 60)){
            $this->renewSession();
        }
        return true;
    }

    private function renewSession(){
        $this->sessionStartTime = time();
        return session_regenerate_id(true);
    }

    

}
