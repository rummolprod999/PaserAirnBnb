<div id="article">
    <div id="login_form_div">
        <?php if (AuthController::$wrong_pass) { ?>
            <div class="alert alert-danger" role="alert">Неправильный логин или пароль</div>
        <?php } ?>
        <form role="form" method="post">
            <fieldset>
                <legend>Вход на сайт</legend>
                <div class="form-group">
                    <label for="inputLogin">Логин</label>
                    <input id="inputLogin" placeholder="Введите логин" class="form-control" name="login" required>
                </div>
                <div class="form-group">
                    <label for="inputPassword">Пароль</label>
                    <input type="password" id="inputPassword" placeholder="Введите пароль" class="form-control"
                           name="password" required>
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" name="remember"> Запомнить меня</label>
                </div>
                <button type="submit" class="btn btn-default">Войти</button>
            </fieldset>
        </form>
    </div>
</div>