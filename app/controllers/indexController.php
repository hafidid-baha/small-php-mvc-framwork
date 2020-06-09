<?php

namespace MVCF\CONTROLLERS;
use MVCF\MODELS\users;
use MVCF\LIB\helper;

class indexController extends abstractController{

    public function defaultAction(){
        
        if(isset($_POST['submit']) && ($_POST['submit'] == 'Save' || $_POST['submit'] == 'حفظ')){
            $fname = helper::filterStr($_POST['fname']);
            $lname = helper::filterStr($_POST['lname']);
            $email = helper::filterStr($_POST['email']);
            $username = helper::filterStr($_POST['username']);
            $password = helper::filterStr($_POST['password']);
            $prevelege = helper::filterStr($_POST['prevelege']);

            $user = new users($fname,$lname,$email,$username,$password,$prevelege);
            $user->Create();
            $this->messanger->add('user_Added');
            header('Location:/mvcFramwork/public');
        }
        $this->data['users'] = users::getAll(); 
        $this->language->load("template.template");
        $this->language->load("index.default");
        // this function shows you view
        $this->view();
        // don 't foreget to delete your messages after they ara viewed
        $this->messanger->deleteMessages();
    }
    public function editeAction(){
        if(isset($this->params[0]) && !empty($this->params[0])){
            $id = helper::filterInt($this->params[0]);
            if(!empty($id)){
                $u =  users::getByPk($id);
                $this->data['user'] = $u;
                if(isset($_POST['submit']) && $_POST['submit'] == 'Save'){
                    $u->fname = helper::filterStr($_POST['fname']);
                    $u->lname = helper::filterStr($_POST['lname']);
                    $u->email = helper::filterStr($_POST['email']);
                    $u->username = helper::filterStr($_POST['username']);
                    $u->password = helper::filterStr($_POST['password']);
                    $u->prevelege = helper::filterStr($_POST['prevelege']);
                    
                    if($u->Update()){
                        $this->messanger->add('user_Updated');
                        header('Location:/mvcFramwork/public');
                    }
                    
                }
            }
        }else{
            $this->controller = 'notFound';
            $this->action = 'notFound';
        }
        $this->language->load("template.template");
        $this->language->load("index.default");
        $this->view();
    }
    public function deleteAction(){
        if(isset($this->params[0]) && !empty($this->params[0])){
            $id = helper::filterInt($this->params[0]);
            if(!empty($id)){
                $u =  users::getByPk($id);
                $u->delete();
                $this->messanger->add('user_Deleted');
                header('Location:/mvcFramwork/public');
            }
        }else{
            $this->controller = 'notFound';
            $this->action = 'notFound';
        }
    }
    public function languageAction(){
        if(!isset($_SESSION['lang'])){
            $_SESSION['lang'] = DEFAULT_LANG;
        }else{
            if($_SESSION['lang'] == 'en'){
                $_SESSION['lang'] = 'ar';
            }else{
                $_SESSION['lang'] = 'en';
            }
        }
        header("Location:/mvcFramwork/public/");

    }
}