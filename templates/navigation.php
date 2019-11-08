<div id="header">
    <?php
    function active($currect_page)
    {
        $url_array = explode('/', $_SERVER['REQUEST_URI']);
        $url = end($url_array);
        if ($currect_page == $url) {
            echo 'active'; //class name in css
        }
    }

    ?>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link <?php active(''); ?>" href="/">Main</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php active('settings'); ?>" href="/settings">Logs</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php active('analytics'); ?>" href="/analytics">Analytics</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php active('analytics2'); ?>" href="/analytics2">Analytics2</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php active('/?action=out'); ?>" href="/?action=out">Logout</a>
        </li>
    </ul>


</div>