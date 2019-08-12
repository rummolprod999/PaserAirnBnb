<?php
if (isset($_POST['login'], $_POST['password'])) {
    if (isset($_POST['remember']) && $_POST['remember'] === 'on') {
        setcookie('session_id', md5(trim($_POST['password']) . trim($_POST['login'])), time() + (30 * 24 * 3600));
    } else {
        setcookie('session_id', md5(trim($_POST['password']) . trim($_POST['login'])));
    }

}
require_once 'templates/header.php';
require_once 'route/route.php';
require_once 'templates/footer.php';