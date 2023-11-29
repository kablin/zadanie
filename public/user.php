<?php


class User
{
    private $connection;
    private $db_host = 'hh-db';
    private $db_user = 'root';
    private $db_password = 'root';
    private $db_name = 'test';

    function __construct() {
        $dsn = "mysql:host=$this->db_host;dbname=$this->db_name;charset=utf8";
        $this->connection = new PDO($dsn, $this->db_user, $this->db_password);
    }





    // объявление метода
    public function registerUser() {
        print_r($_POST);
    }
}