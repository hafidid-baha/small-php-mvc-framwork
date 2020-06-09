<?php
namespace MVCF\CONTROLLERS;

class dbHandler{
    private static $server = 'localhost';
    private static $db_name = 'users';
    private static $db_user = "root";
    private static $db_pass = "";
    private static $opt = array(
         \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
         \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
         );
    
    private static $connection = null;

    private  function __construct(){}

    public static function getInstance(){
        if(is_null(self::$connection)){
            $dsn = 'mysql:host='.self::$server.';dbname='.self::$db_name.';charset=utf8';
            $connection = new \PDO($dsn,self::$db_user,self::$db_pass,self::$opt); 
            return $connection;  
        }
        return $connection;
    }

}