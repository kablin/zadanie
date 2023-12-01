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

    <?php if ($userdata) { ?>
        <div class="card  mt-5">
            <div class="card-header d-flex">
                <h5 class="">Личный кабинет </h5>
                <div id="confirm" class="form-check ms-auto my-auto d-none">
                    <input class="form-check-input" type="checkbox" value="" id="confirm-delete">
                    <label class="form-check-label" for="confirm-delete">
                        Подтвердить удаление
                    </label>
                </div>
                <button onclick="deleteUser()" id="button-delete" class="btn btn-danger ms-auto">Удалить аккаунт</button>
            </div>
            <div class="card-body">
                <form id="user-form">
                    <input name="method" type="hidden" value="edit">
                    <input name="id" id="id" type="hidden" value="<?php echo $userdata['id'] ?>">
                    <div class="form-group my-2">
                        <label for="username">Фио</label>
                        <input class="form-control" name="username" value="<?php echo $userdata['username'] ?>" id="username" placeholder="Иванов Иван Иванович" required>
                    </div>


                    <div class="form-group my-2">
                        <label for="age">Возраст</label>
                        <input type="number" min="1" max="120" class="form-control" value="<?php echo $userdata['age'] ?>" name="age" id="age" required>
                    </div>


                    <div class="form-group my-2">
                        <label for="phone">Телефон</label>
                        <input class="form-control" type="tel" name="phone" id="phone" value="<?php echo $userdata['phone'] ?>" placeholder="+7-123-456-77-88" required>
                    </div>


                    <div class="form-group my-2">
                        <label for="mail">Почтовый адрес</label>
                        <input readonly type="email" class="form-control" name="mail" id="mail" value="<?php echo $userdata['mail'] ?>" placeholder="name@example.com" required>
                    </div>


                    <div class="form-group my-2">
                        <label for="city">Город проживания</label>
                        <input class="form-control" name="city" id="city" value="<?php echo $userdata['city'] ?>" placeholder="Москва" required>
                    </div>


                    <div class="form-group my-2">
                        <label for="postindex">Домашний индекс</label>
                        <input class="form-control" name="postindex" id="postindex" value="<?php echo $userdata['postindex'] ?>" pattern="[0-9]{6}" placeholder="123456" required>
                    </div>

                    <div class="form-group my-2">
                        <label for="password">Пароль</label>
                        <input type="password" class="form-control" name="password" id="password">
                    </div>


                    <div class="form-group my-2">
                        <label for="password-confirm">Подтвердить пароль</label>
                        <input type="password" class="form-control" name="password-confirm" id="password-confirm">
                        <div class="alert alert-danger d-none" role="alert" id="password-error">
                            Пароли не совпадают
                        </div>
                    </div>

                    <div class="form-group d-flex">
                        <button onclick="submitForm()" class="btn btn-primary mx-auto mt-4">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card  mt-5">
            <div class="card-header d-flex">
                <h5 class="">Фотография</h5>
                <button onclick="deleteAvatar()" id="button-delete" class="btn btn-danger ms-auto">Удалить фотографию</button>
            </div>
            <div class="card-body">
                <div class="input-group mb-3">
                    <input type="file" class="form-control" id="avatar" accept=".jpg,.png">
                    <button class="btn btn-outline-secondary" onclick="saveAvatar()" type="button" >Загрузить фотографию</button>
                </div>

                <img id ="image" class="h-auto rounded-5 mx-auto  <?php if (!$userdata['photo']) echo 'd-none' ; ?>" src="files/<?php echo $userdata['photo']?>">                        </div>
           
        </div>
    <?php } ?>

</div>




<?php

require_once('footer.php');
?>