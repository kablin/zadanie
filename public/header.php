<?php
session_start();
require('user.php');
$user = new User;
$userdata = $user->findUserBySession();
if ($userdata)
$can_logout = true;

?>

<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Тестове задание</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="assets/script.js"></script>

</head>

<body>



  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <?php if (isset($can_logout) && $can_logout) { ?>
            <li class="nav-item">
              <a class="nav-link " onclick="logout()" aria-current="page" href="#">Выйти</a>
            </li>
            <li class="nav-item">
              <a class="nav-link " aria-current="page" href="edit.php">Пользователь</a>
            </li>
          <?php } else {  ?>
            <li class="nav-item">
              <a class="nav-link " aria-current="page" href="#">Войти</a>
            </li>
          <?php } ?>
          <li class="nav-item">
            <a class="nav-link" href="register.php">Зарегистрироваться</a>
          </li>

        </ul>

      </div>
    </div>
  </nav>