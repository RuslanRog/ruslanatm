<?php

// Базовый класс подключается к БД
class DBConfig
{
    private $_host = 'localhost';
    private $_username = 'mysql';
    private $_password = 'mysql';
    private $_database = 'atm_base';

    protected $connection;

    public function __construct()
    {
        if (!isset($this->connection)) {

            $this->connection = new mysqli($this->_host, $this->_username, $this->_password, $this->_database);

            if (!$this->connection) {
                echo 'Cannot connect to database server';
                exit;
            }
        }

        return $this->connection;
    }
}

?>
