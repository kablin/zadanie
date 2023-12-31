<?php
require_once('header.php');
?>

<div class="container">
    <div class="container d-flex ">
        <div class="alert alert-danger mx-auto d-none mt-5" id="alert-error" role="alert">
        </div>
    </div>

    <div class="container d-flex">
        <div class="alert alert-success mx-auto d-none  mt-5" id="alert-success" role="alert">
        </div>
    </div>

    <div class="card  mt-5">
        <h5 class="card-header">Регистрация </h5>
        <div class="card-body">
            <form id="user-form">
                <input name="method" type="hidden" value="register">
                <div class="form-group my-2">
                    <label for="username">Фио</label>
                    <input class="form-control" name="username" id="username" placeholder="Иванов Иван Иванович" required>
                </div>


                <div class="form-group my-2">
                    <label for="age">Возраст</label>
                    <input type="number" min="1" max="120" class="form-control" name="age" id="age" required>
                </div>


                <div class="form-group my-2">
                    <label for="phone">Телефон</label>
                    <input class="form-control" type="tel" name="phone" id="phone" placeholder="+7-123-456-77-88" required>
                </div>


                <div class="form-group my-2">
                    <label for="mail">Почтовый адрес</label>
                    <input type="email" class="form-control" name="mail" id="mail" placeholder="name@example.com" required>
                </div>


                <div class="form-group my-2">
                    <label for="city">Город проживания</label>
                    <input class="form-control" name="city" id="city" placeholder="Москва" required>
                </div>


                <div class="form-group my-2">
                    <label for="postindex">Домашний индекс</label>
                    <input class="form-control" name="postindex" id="postindex" pattern="[0-9]{6}" placeholder="123456" required>
                </div>

                <div class="form-group my-2">
                    <label for="password">Пароль</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>


                <div class="form-group my-2">
                    <label for="password-confirm">Подтвердить пароль</label>
                    <input type="password" class="form-control" name="password-confirm" id="password-confirm" required>
                    <div class="alert alert-danger d-none" role="alert" id="password-error">
                        Пароли не совпадают
                    </div>
                </div>

                <div class="form-group d-flex">
                    <button onclick="submitForm(true)" class="btn btn-primary mx-auto mt-4">Зарегистрироваться</button>
                </div>
            </form>

        </div>
    </div>

</div>



<?php

require_once('footer.php');
?>