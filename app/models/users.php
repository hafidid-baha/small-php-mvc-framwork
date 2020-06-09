<?php
namespace MVCF\MODELS;
use MVCF\MODELS\AbstructModel;

class users extends AbstructModel{
    public $user_id;
    public $fname;
    public $lname;
    public $email;
    public $username;
    public $password;
    public $prevelege;

    public function __construct($fname,$lname,$email,$username,$password,$prevelege){
        $this->fname = $fname;
        $this->lname = $lname;
        $this->email = $email;
        $this->password = $password;
        $this->username = $username;
        $this->prevelege = $prevelege;
        parent::__construct();
    }

    protected static $tableSchema = array(
        'fname'     => \PDO::PARAM_STR,
        'lname'     => \PDO::PARAM_STR,
        'username'  => \PDO::PARAM_STR,
        'email'     => \PDO::PARAM_STR,
        'password'  => \PDO::PARAM_STR,
        'prevelege' => \PDO::PARAM_INT
    );
    protected static $tableName = 'users';
    protected static $primaryKey = 'user_id';


}