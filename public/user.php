<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
/*
require '../vendor/phpmailer/src/Exception.php';
require '../vendor/phpmailer/src/PHPMailer.php';
require '../vendor/phpmailer/src/SMTP.php';
*/

require '../vendor/autoload.php';

$env = parse_ini_file('../.env');


class User
{
    private $connection;
    private $connection_error = '';

    function __construct()
    {
        global $env;
        try {
            $dsn = "mysql:host=".$env['DB_HOST'].";dbname=".$env['DB_DATABASE'].";charset=utf8";
            $this->connection = new PDO($dsn,$env['DB_USERNAME'], $env['DB_PASSWORD']);
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
            'username' => $_POST['username'], 'age' =>  $_POST['age'], 'phone' => $_POST['phone'], 'mail' => $_POST['mail'],
            'city' => $_POST['city'], 'postindex' => $_POST['postindex'], 'password' => password_hash($_POST['password'], PASSWORD_BCRYPT),
            'session' => session_id()
        );

        try {

            $insert_query = $this->connection->prepare("INSERT INTO users (username, age, phone,mail,city,postindex,password,session)
            values (:username, :age, :phone,:mail,:city,:postindex,:password,:session)");
            $insert_query->execute($data);
            $this->sendMail($_POST['mail']);
            return null;
        } catch (PDOException $e) {
            return    $e->getMessage();
        }
    }



    private function sendMail($email)
    {
        global $env;
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->CharSet = "UTF-8";
            $mail->Host       = $env['MAIL_HOST'];
            $mail->SMTPAuth   = true;
            $mail->Username   = $env['MAIL_USERNAME'];
            $mail->Password   = $env['MAIL_PASSWORD'];
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = $env['MAIL_PORT'];

            $mail->setFrom('test@example.com');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Регистрация';
            $mail->Body    = 'Поздравляем вы успешно зарегистрировались';
            $mail->send();
            return "";
        } catch (Exception $e) {
            return $mail->ErrorInfo;
        }
    }




    public function loginUser()
    {
        if ($this->connection_error) return $this->connection_error;

        $user = $this->findUserByMail($_POST['mail']);
        if (!$user) return "Пользователь не найден";
        if (!password_verify($_POST['password'], $user['password'])) return "Неверный пароль";
        $data = array('id' => $user['id'], 'session' => session_id());
        try {

            $update_query = $this->connection->prepare("UPDATE  users set session = :session where id = :id");
            $update_query->execute($data);
            return null;
        } catch (PDOException $e) {
            return    $e->getMessage();
        }
    }



    public function updateUser()
    {
        if ($this->connection_error) return $this->connection_error;

        $user = $this->findUserBySession();
        if ($user && ($user['id'] == $_POST['id'])) {
            $data = array(
                'id' => $_POST['id'], 'username' => $_POST['username'], 'age' =>  $_POST['age'], 'phone' => $_POST['phone'],
                'city' => $_POST['city'], 'postindex' => $_POST['postindex'], 'password' => $_POST['password'] ? password_hash($_POST['password'], PASSWORD_BCRYPT) : $user['password'],
            );

            try {
                $update_query = $this->connection->prepare("UPDATE users set username = :username, age = :age, phone = :phone,
                city = :city, postindex = :postindex ,password = :password where id = :id");
                $update_query->execute($data);
                return null;
            } catch (PDOException $e) {
                return    $e->getMessage();
            }
        } else     return  'Сессия не найдена. Залогиньтесь';
    }

    public function logoutUser()
    {
        if ($this->connection_error) return $this->connection_error;
        $user = $this->findUserBySession();
        if ($user) {
            $data = array('id' => $user['id']);

            try {
                $update_query = $this->connection->prepare("UPDATE users set session = NULL where id = :id");
                $update_query->execute($data);
                return null;
            } catch (PDOException $e) {
                return    $e->getMessage();
            }
        }
    }

    public function deleteUser()
    {
        if ($this->connection_error) return $this->connection_error;

        $user = $this->findUserBySession();
        if ($user && ($user['id'] == $_POST['id'])) {
            $data = array('id' => $_POST['id']);

            try {
                $update_query = $this->connection->prepare("DELETE FROM users  where id = :id");
                $update_query->execute($data);
                return null;
            } catch (PDOException $e) {
                return    $e->getMessage();
            }
        } else     return  'Сессия не найдена. Залогиньтесь';
    }


    public function saveAvatar()
    {
        if ($this->connection_error) return $this->connection_error;

        $user = $this->findUserBySession();
        if ($user && ($user['id'] == $_POST['id'])) {
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $ext = array_search(
                $finfo->file($_FILES['file']['tmp_name']),
                array(
                    'jpg' => 'image/jpeg',
                    'png' => 'image/png',
                )
            );
            if (!$ext)  return 'Неверный формат файла';
            $filename = sha1_file($_FILES['file']['tmp_name']) . '.' . $ext;
            if ($_FILES['file']['error'])  return 'Ошибка загрузки файла ' . $_FILES['file']['error'];
            if (move_uploaded_file($_FILES['file']['tmp_name'], 'files/' . $filename)) {

                $data = array('id' => $_POST['id'], 'photo' => $filename);

                try {
                    $update_query = $this->connection->prepare("UPDATE users set photo = :photo where id = :id");
                    $update_query->execute($data);
                    return null;
                } catch (PDOException $e) {
                    return    $e->getMessage();
                }
            } else  return 'Ошибка загрузки файла';
        } else     return  'Сессия не найдена. Залогиньтесь';
    }


    public function deleteAvatar()
    {
        if ($this->connection_error) return $this->connection_error;

        $user = $this->findUserBySession();
        if ($user && ($user['id'] == $_POST['id'])) {
            if ($user['photo'] && file_exists('files/' . $user['photo']))  unlink('files/' . $user['photo']);

            $data = array('id' => $_POST['id']);

            try {
                $update_query = $this->connection->prepare("UPDATE users set photo = '' where id = :id");
                $update_query->execute($data);
                return null;
            } catch (PDOException $e) {
                return    $e->getMessage();
            }
        } else     return  'Сессия не найдена. Залогиньтесь';
    }
}
