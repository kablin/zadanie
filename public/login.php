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
        <h5 class="card-header">Вход </h5>
        <div class="card-body">
            <form id="user-form">
                <input name="method" type="hidden" value="login">
   
                <div class="form-group my-2">
                    <label for="mail">Почта</label>
                    <input type="email" class="form-control" name="mail" id="mail" placeholder="name@example.com" required>
                </div>
    
                <div class="form-group my-2">
                    <label for="password">Пароль</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>

                <div class="form-group d-flex">
                    <button onclick="login(true)" class="btn btn-primary mx-auto mt-4">Войти</button>
                </div>
            </form>

        </div>
    </div>

</div>



<?php
require_once('footer.php');
?>