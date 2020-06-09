<?php
namespace MVCF\MODELS;
use MVCF\CONTROLLERS\dbHandler;


class AbstructModel{

    public $connection;
    
    public function __construct(){
        $this->connection = dbHandler::getInstance();
    }

    private function prepareCreateSql(){
        $param = array();
        $query = 'insert into '.static::$tableName.' ('.implode(',', array_keys(static::$tableSchema)).') 
                values (';

        foreach(static::$tableSchema as $column=>$type){
            $param[] = ':'.$column;
        }

        $query .= implode(',', $param);
        $query.= ')';

        return $query;

    }

    private function prepareUpdateSql(){
        $param = array();
        $query = 'Update '.static::$tableName.' set ';

        foreach(static::$tableSchema as $column=>$type){
            $param[] = $column .' = :'.$column;
        }

        $query .= implode(',', $param);
        $query.= ' where '.static::$primaryKey.' = '.$this->{static::$primaryKey};

        return $query;

    }
    public function Create(){
        $query = $this->prepareCreateSql();
        $stmt = $this->connection->prepare($query);
        foreach(static::$tableSchema as $column=>$type){ 
             $stmt->bindValue(':'.$column,$this->{$column},$type);
        }
        return $stmt->execute();
    }

    public function Update(){

        $query = $this->prepareUpdateSql();
        $stmt = $this->connection->prepare($query);
        foreach(static::$tableSchema as $column=>$type){ 
             $stmt->bindValue(':'.$column,$this->{$column},$type);
        } 
        return $stmt->execute();
    }

    public function Delete(){
        $query = 'Delete From '.static::$tableName.' Where '.static::$primaryKey.' = '.$this->{static::$primaryKey};
        $stmt = $this->connection->prepare($query);
        return $stmt->execute();
    }

    public static function getAll(){
        //$stm->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Fruit");
        $connection = dbHandler::getInstance();
        $query = "select * from ".static::$tableName;
        $stmt = $connection->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_called_class(),array_keys(static::$tableSchema));

        return $result;
    }

    public static function getByPk(int $pk){
        $connection = dbHandler::getInstance();
        $query = 'select * from users where '.static::$primaryKey.' = '.$pk;
        $stmt = $connection->prepare($query);
        $stmt->bindValue(':id',$pk,\PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_called_class(),array_keys(static::$tableSchema));

        $result = array_shift($result);
        return $result;
    }

}


