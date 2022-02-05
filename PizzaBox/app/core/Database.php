<?php

class Database
{
    private $dbHost = DB_HOST;
    private $dbUser = DB_USER;
    private $dbPass = DB_PASS;
    private $dbName = DB_NAME;

    private $statement;
    private $dbHandler;
    private $err;

    public function __construct()
    {
        $conn = 'mysql:host=' .$this->dbHost . '; dbname=' . $this->dbName;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        );

        try
        {
            $this->dbHandler = new PDO($conn, $this->dbUser, $this->dbPass, $options);
        }catch(PDOException $e){
            $this->err = $e->getMessage();
            echo $this->err;
        }
    }

    public function query($sql)
    {
        $this->statement = $this->dbHandler->prepare($sql);
    }

    public function bind($param, $val, $type=null)
    {
        switch (is_null($type))
        {
            case is_int($val):
                $type = PDO::PARAM_INT;
                break;
            case is_bool($val):
                $type = PDO::PARAM_BOOL;
                break;
            case is_null($val):
                $type = PDO::PARAM_NULL;
                break;
            default:
            $type = PDO::PARAM_STR;
        }
        $this->statement->bindValue($param, $val, $type);
    }

    public function execute()
    {
        return $this->statement->execute();
    }

    public function resultArray()
    {
        $this->execute();
        return $this->statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function resultRow()
    {
        $this->execute();
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }

    public function rowCount()
    {
        $this->execute();
        return $this->statement->rowCount();
    }

    public function getLastID(){
        return $this->dbHandler->lastInsertId();
    }
}