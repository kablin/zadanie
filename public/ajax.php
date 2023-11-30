<?php
session_start();
require('user.php');


if ($_POST['method'] === 'register') {
    session_regenerate_id() ;

    $user = new User;
    $error = $user->registerUser();
    if ($error) {
        echo json_encode(['status' => 'error', 'msg' => $error]);
        die;
    }
    echo json_encode(['status' => 'ok', 'msg' => 'Пользователь создан']);
    die;

}
else if ($_POST['method'] === 'edit') {

    $user = new User;
    $error = $user->updateUser();
    if ($error) {
        echo json_encode(['status' => 'error', 'msg' => $error]);
        die;
    }
    echo json_encode(['status' => 'ok', 'msg' => 'Данные обновлены']);
    die;
}
else if ($_POST['method'] === 'logout') {

    $user = new User;
    $error = $user->logoutUser();
    echo json_encode(['status' => 'ok', 'msg' => '']);
    die;
}
