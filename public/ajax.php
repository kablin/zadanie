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
    echo json_encode(['status' => 'ok', 'msg' => $error]);
    die;
}
else if ($_POST['method'] === 'delete') {

    $user = new User;
    $error = $user->deleteUser();
    echo json_encode(['status' => 'ok', 'msg' => '']);
    die;
}
else if ($_POST['method'] === 'login') {
    session_regenerate_id() ;
    $user = new User;
    $error = $user->loginUser();
    if ($error) {
        echo json_encode(['status' => 'error', 'msg' => $error]);
        die;
    }
    echo json_encode(['status' => 'ok', 'msg' => '']);
    die;
}
else if ($_POST['method'] === 'saveAvatar') {
    $user = new User;
    $error = $user->saveAvatar();
    if ($error) {
        echo json_encode(['status' => 'error', 'msg' => $error]);
        die;
    }
    echo json_encode(['status' => 'ok', 'msg' => 'Фотография сохранена', 'src' => $user->findUserBySession()['photo'] ]);
    die;
}
else if ($_POST['method'] === 'deleteAvatar') {
    $user = new User;
    $error = $user->deleteAvatar();
    if ($error) {
        echo json_encode(['status' => 'error', 'msg' => $error]);
        die;
    }
    echo json_encode(['status' => 'ok', 'msg' => 'Фотография удалена']);
    die;
}



