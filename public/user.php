<?php

class User
{
    private $connection;
    private $db_host = 'hh-db';
    private $db_user = 'root';
    private $db_password = 'root';
    private $db_name = 'test';
    private $connection_error = '';

    function __construct()
    {
        try {
            $dsn = "mysql:host=$this->db_host;dbname=$this->db_name;charset=utf8";
            $this->connection = new PDO($dsn, $this->db_user, $this->db_password);
        } catch (PDOException $e) {
            $this->connection_error =   $e->getMessage();
        }
    }



    private function findUserByMail($mail)
    {
        if (!$this->connection_error) 
        try {

            $select_query = $this->connection->prepare("SELECT * from users where mail = ?");
            $select_query->execute([$mail]);
            $select_query->setFetchMode(PDO::FETCH_ASSOC); 
            return  $select_query->fetch();
      
        } catch (PDOException $e) {
            return    null;
        }
    }



    public function findUserBySession()
    {
        if (!$this->connection_error) 
        try {
            $select_query = $this->connection->prepare("SELECT * from users where session = ?");
            $select_query->execute([session_id()]);
            $select_query->setFetchMode(PDO::FETCH_ASSOC); 
            return  $select_query->fetch();
      
        } catch (PDOException $e) {
            return    null;
        }
    }


    
    public function registerUser()
    {
        if ($this->connection_error) return $this->connection_error;

        $user = $this->findUserByMail($_POST['mail']);
        if ($user) return "Пользователь с такой почтой уже зарегистрирован";
        $data = array(
            'username' => $_POST['username'], 'age' =>  $_POST['age'], 'phone' => $_POST['phone'],'mail' => $_POST['mail'],
            'city' => $_POST['city'], 'postindex' => $_POST['postindex'], 'password' => password_hash($_POST['password'],PASSWORD_BCRYPT),
            'session' =>session_id()
        );

        try {

            $insert_query = $this->connection->prepare("INSERT INTO users (username, age, phone,mail,city,postindex,password,session)
            values (:username, :age, :phone,:mail,:city,:postindex,:password,:session)");
            $insert_query->execute($data);
            return null;
        } catch (PDOException $e) {
            return    $e->getMessage();
        }
    }
}
