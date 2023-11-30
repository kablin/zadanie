<?php

require('user.php');



if ($_POST['method'] === 'register') {
    session_start();
    session_regenerate_id() ;

    $user = new User;
    $error = $user->registerUser();
    if ($error)
    {
       require ('error.php');
       die;

    }
    header("Location: edit.php");
    die();

}
