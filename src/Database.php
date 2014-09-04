<?php

class Database {

    private $host = 'localhost';
    private $dbname = 'mycms';
    private $user = 'homestead';
    private $pass = 'secret';
    private $dbh;
    private $error;
    private $statement;

    public function __construct()
    {
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname . ";charset=utf8";
        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE    => PDO::ERRMODE_EXCEPTION
        ];

        try
        {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (PDOException $e)
        {
            $this->error = $e->getMessage();
        }
    }

    public function query($query)
    {
        $this->statement = $this->dbh->prepare($query);
    }

    public function bind($param, $value, $type = null)
    {
        if (is_null($type))
        {
            switch (true)
            {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }

            $this->statement->bindValue($param, $value, $type);
        }

    }

    public function execute()
    {
        return $this->statement->execute();
    }

    public function resultSet()
    {
        $this->execute();

        return $this->statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetchColumn()
    {
        $this->execute();

        return $this->statement->fetchColumn(PDO::FETCH_ASSOC);
    }

    public function getNumber()
    {
        $this->execute();

        return $this->statement->fetch(PDO::FETCH_NUM)[0];
    }
}