<div id="header">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link <?php active('admin'); ?>" href="/">Main</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-danger <?php active('/?action=out'); ?>"
               href="/?action=out">Logout <?php if (isset($_SESSION['user_name'])) {
                    echo " {$_SESSION['user_name']}";
                } ?></a>
        </li>
    </ul>
</div>