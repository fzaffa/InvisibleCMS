<?php namespace Fzaffa\System;

use PDO;

class Database {

    private $host;
    private $dbname;
    private $user;
    private $pass;
    private $dbh;
    private $error;
    private $statement;

    public function __construct()
    {
        $this->host = Config::getInstance()->get('database.host');
        $this->dbname = Config::getInstance()->get('database.database');
        $this->user = Config::getInstance()->get('database.username');
        $this->pass = Config::getInstance()->get('database.password');
        $dsn = 'pgsql:host=' . $this->host . ';dbname=' . $this->dbname . ";";
        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE    => PDO::ERRMODE_EXCEPTION
        ];

        try
        {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (PDOException $e)
        {
            //$this->error = $e->getMessage();
            die($e->getMessage());
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

    public function get()
    {
        $this->execute();

        $results = $this->statement->fetchAll(PDO::FETCH_ASSOC);

            return $results;

    }
    public function first()
    {
        $this->execute();

        $results = $this->statement->fetchAll(PDO::FETCH_ASSOC);

        return $results[0];
    }

    public function getModel($class)
    {
        $this->execute();

        $results = $this->statement->fetchAll(PDO::FETCH_CLASS, $class);
        if (count($results)>1)
        {
            return $results;
        }
        return $results[0];
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