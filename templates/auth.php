<?php

if (isset($_POST['login'], $_POST['password'])) {
    if (isset($_POST['remember']) && $_POST['remember'] === 'on') {
        setcookie('session_id', md5(trim($_POST['password']) . trim($_POST['login'])), time() + (30 * 24 * 3600));
    } else {
        setcookie('session_id', md5(trim($_POST['password']) . trim($_POST['login'])));
    }

}
?>
<form role="form" method="post">
    <fieldset>
        <legend>Вход на сайт</legend>
        <div class="form-group">
            <label for="inputLogin">Логин</label>
            <input id="inputLogin" placeholder="Введите логин" class="form-control" name="login">
        </div>
        <div class="form-group">
            <label for="inputPassword">Пароль</label>
            <input type="password" id="inputPassword" placeholder="Введите пароль" class="form-control" name="password">
        </div>
        <div class="checkbox">
            <label><input type="checkbox" name="remember"> Запомнить меня</label>
        </div>
        <button type="submit" class="btn btn-default">Войти</button>
    </fieldset>
</form>
