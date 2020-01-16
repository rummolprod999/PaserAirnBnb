<?php require_once 'templates/admin_navigation.php'; ?>
<div id="article">
    <div><h1 class="text-center">USERS LOGS</h1></div>

    <form method="post">
        <input type="text" name="user_name">
        <button class="btn btn-primary" type="submit">Find</button>
        <button class="btn btn-primary" type="button" onclick="location.href = '/logs'">Drop</button>
    </form>

    <?php foreach ($data as $d) { ?>

    <div class="container-fluid">
        <div class="row my-5">
            <div class="col-12"><p><?php echo $d['names']['user_name'] ?></p></div>
            <div class="col-sm border border-info"><pre
                    class="pre-scrollable"><code><?php if (isset($data)) {
                            foreach ($d['logs'] as $user) {
                                echo $user;
                            }
                        } ?></code></pre>
            </div>
        </div>
    </div>
    <?php  } ?>

</div>
