<?php require_once 'templates/admin_navigation.php'; ?>
<div id="article">
    <div><h1 class="text-center">USERS LIST</h1></div>

    <div id="table_div">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>User name</th>
                    <th>Proxy address</th>
                    <th>Proxy Port</th>
                    <th>Proxy User</th>
                    <th>Proxy Pass</th>
                    <th>Last activity</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($data['users_list'] as $row): ?>
                    <tr>
                        <td><strong><?php echo $row['id'] ?></strong></td>
                        <td><strong><?php echo $row['user_name'] ?></strong></td>
                        <td><strong><?php echo $row['proxy_address'] ?></strong></td>
                        <td><strong><?php echo $row['proxy_port'] ?></strong></td>
                        <td><strong><?php echo $row['proxy_user'] ?></strong></td>
                        <td><strong><?php echo $row['proxy_pass'] ?></strong></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

