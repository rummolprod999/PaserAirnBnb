<div id="article">
    <div id="login_form_div">
        <?php if (AuthController::$wrong_pass) { ?>
            <div class="alert alert-danger" role="alert">Wrong login or password</div>
        <?php } ?>
        <form role="form" method="post">
            <fieldset>
                <legend>Enter</legend>
                <div class="form-group">
                    <label for="inputLogin">Login</label>
                    <input id="inputLogin" placeholder="Enter login" class="form-control" name="login" required>
                </div>
                <div class="form-group">
                    <label for="inputPassword">Password</label>
                    <input type="password" id="inputPassword" placeholder="Enter password" class="form-control"
                           name="password" required>
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" name="remember">Remember</label>
                </div>
                <button type="submit" class="btn btn-default">Sign in</button>
            </fieldset>
        </form>
    </div>
</div>