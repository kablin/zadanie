<?php
require_once('header.php');

?>

<div class="container">

    <div class="card  mt-5">

        <div class="card-body">


            <form id="register-form" action="inner.php" method="post" >
                <input  name="method" type="hidden" value="register">
                <div class="form-group my-2">
                    <label for="fio">Фио</label>
                    <input class="form-control" name="fio" id="fio" placeholder="Иванов Иван Иванович" required>
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
                    <label for="email">Почтовый адрес</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com" required>
                </div>


                <div class="form-group my-2">
                    <label for="city">Город проживания</label>
                    <input class="form-control" name="city" id="city" placeholder="Москва" required>
                </div>


                <div class="form-group my-2">
                    <label for="index">Домашний индекс</label>
                    <input class="form-control" name="index" id="index" pattern="[0-9]{6}" placeholder="123456" required>
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
                    <button onclick="testpasswords()" class="btn btn-primary mx-auto mt-4">Зарегистрироваться</button>
                </div>
            </form>

        </div>
    </div>

</div>


<script>
    function testpasswords() {
        event.preventDefault();
        if (document.getElementById('password').value !=
            document.getElementById('password-confirm').value) {
            document.getElementById('password-error').classList.remove('d-none');
        } else {
            document.getElementById('password-error').classList.add('d-none');
            document.getElementById('register-form').submit();

        }
    }
</script>


<?php

require_once('footer.php');
?>