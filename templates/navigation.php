<div id="header">
    <!--<div id="nav">
        <ul>
            <li><a href="/">Main</a></li>
            <li><a href="/settings">Logs</a></li>
            <li><a href="/analytics">Analytics</a></li>
            <li><a href="/analytics2">Analytics2</a></li>
            <li></li>
        </ul>
    </div>-->
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
    </ul>


</div>