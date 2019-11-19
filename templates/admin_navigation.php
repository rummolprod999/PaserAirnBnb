<div id="header">
    <nav class="navbar navbar-expand-sm navbar-light bg-faded">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav-content"
                aria-controls="nav-content" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="nav-content">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link <?php active('admin'); ?>" href="/">Main</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-danger <?php active('/?action=out'); ?>"
                       href="/?action=out">Logout</a>
                </li>
            </ul>

        </div>
        <span class="navbar-text justify-content-end">Hello,
      <?php if (isset($_SESSION['user_name'])) {
          echo " {$_SESSION['user_name']}";
      } ?>
    </span>
    </nav>

</div>