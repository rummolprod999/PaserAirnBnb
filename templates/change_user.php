<?php
require_once 'templates/admin_navigation.php'; ?>

<div id="article">
    <?php if ($data['user']['proxy_address'] !== null): ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 border border-2 border-secondary rounded mb-3 p-2">
                    <div><p><strong>Change Proxy for user <?php echo $data['user']['user_name'] ?></strong></p></div>
                    <?php if (isset($_SESSION['update_proxy'])) {
                        echo "<div class='alert alert-warning' role='alert'>{$_SESSION['update_proxy']}</div>";
                        unset($_SESSION['update_proxy']);
                    } ?>
                    <form class="form" method="post">
                        <div class="form-group">
                            <label for="proxyAddr">Proxy address</label>
                            <input type="text" class="form-control" id="proxyAddr"
                                   placeholder="<?php echo $data['user']['proxy_address'] ?>"
                                   pattern="\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}"
                                   value="<?php echo $data['user']['proxy_address'] ?>" name="proxy_address">
                        </div>
                        <div class="form-group">
                            <label for="proxyPort">Proxy port</label>
                            <input type="text" class="form-control" id="proxyPort"
                                   placeholder="<?php echo $data['user']['proxy_port'] ?>" pattern="\d{1,5}"
                                   value="<?php echo $data['user']['proxy_port'] ?>" name="proxy_port">
                        </div>
                        <div class="form-group">
                            <label for="proxyUser">Proxy user</label>
                            <input type="text" class="form-control" id="proxyUser"
                                   placeholder="<?php echo $data['user']['proxy_user'] ?>" pattern=".+"
                                   value="<?php echo $data['user']['proxy_user'] ?>" name="proxy_user">
                        </div>
                        <div class="form-group">
                            <label for="proxyPass">Proxy password</label>
                            <input type="text" class="form-control" id="proxyPass"
                                   placeholder="<?php echo $data['user']['proxy_pass'] ?>" pattern=".+"
                                   value="<?php echo $data['user']['proxy_pass'] ?>" name="proxy_pass">
                        </div>
                        <button type="submit" class="btn btn-success mb-2">Update Proxy</button>

                    </form>

                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 border border-2 border-secondary rounded mb-3 p-2">
                <div><p><strong>Change Password for user <?php echo $data['user']['user_name'] ?></strong></p></div>
                <?php if (isset($_SESSION['update_password'])) {
                    echo "<div class='alert alert-warning' role='alert'>{$_SESSION['update_password']}</div>";
                    unset($_SESSION['update_password']);
                } ?>
                <form class="form" method="post"
                      oninput='pass.setCustomValidity(pass.value != confirm_pass.value ? "Passwords do not match." : "")'>
                    <div class="form-group">
                        <label for="pass">New password</label>
                        <input type="password" class="form-control" id="pass"
                               placeholder=""
                               value="" name="pass" required>
                    </div>
                    <div class="form-group">
                        <label for="confirmPass">Confirm password</label>
                        <input type="password" class="form-control" id="confirmPass"
                               value="" name="confirm_pass" required>
                    </div>
                    <button type="submit" class="btn btn-success mb-2">Update Password</button>
                </form>
            </div>
        </div>
    </div>
</div>