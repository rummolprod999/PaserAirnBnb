

<div style="position: relative" id="article">

    <div class="darkSide hidden"></div>
    <div class="mailModal hidden">
        <form action="" id="form" class="mail__write" name="mail__write">
            <div class="mailModal__close">
                <i class="fas fa-times fa-2x"></i>
            </div>
        <label class="mailModal__label">
            Enter email address where access information will be sent to
            <br>
            <input type="email" name="mail_modal" class="mailModal__field" id="">
        </label>

            <p class="result__form">

            </p>

        <button type="submit" class="mailModal__send btn btn-primary">Send</button>
        </form>
    </div>

    <div class="conteiner">
        <div class="row">
            <div class="col-lg-3">

            </div>
        <div class="col-lg-6">
            <div class="auth">
    <div id="login_form_div">
        <?php if (count(AuthController::$error) > 0) { ?>
            <?php foreach (AuthController::$error as $err): ?>
                <div class="alert alert-danger" role="alert"><?php echo $err ?></div>
            <?php endforeach; ?>
        <?php } ?>
        <form role="form" method="post">
            <fieldset>
                <legend class="auth__legend">LOGIN</legend>
                <div class="auth__full-form">
                <div class="form-group">
<!--                    <label for="inputLogin">Login</label>-->
                    <input id="inputLogin" placeholder="Enter login" class="auth__fields auth__login form-control" name="login" required>
                </div>
                <div class="form-group">
<!--                    <label for="inputPassword">Password</label>-->
                    <input type="password" id="inputPassword" placeholder="Enter password" class="auth__fields auth__pass form-control"
                           name="password" required>
                </div>
                 <div class="auth__sendLine d-flex">
                    <div class="auth__checkbox checkbox">
                        <label>Remember<input type="checkbox" class="d-none" name="remember"> <img src="/img/custom_checkbox.svg" class="js_checkBox__img auth__custom-check" aria-hidden="true"></label>
                    </div>
                    <button type="submit" class="auth__sendBtn btn btn-primary mb-2">Sign in</button>
                 </div>
                </div>
            </fieldset>
        </form>

        <button  class="free__btn btn btn-primary">Request free access now</button>
        <div class="d-none">
        <?php require_once 'templates/footer.php'?>
        </div>
    </div>

</div>

        </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.1.1.min.js">
<script src="/js/chackbox_switcher.js"></script>
<script src="/js/modalEmail.js"></script>