<div id="header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">


                <nav class="navbar navbar-expand-sm navbar-light bg-faded">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav-content"
                            aria-controls="nav-content" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="nav-content">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link <?php active(''); ?>" href="/">
                                    <i>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                                            <defs>
                                                <style>
                                                    .cls-1{opacity:.9}.cls-2s{fill:#7a7a7a}.cls-3{fill: none}
                                                </style>
                                            </defs>
                                            <g id="ic-home-24px" class="cls-1">
                                                <path id="Path_3" d="M8.667 17.167v-5H12v5h4.167V10.5h2.5L10.333 3 2 10.5h2.5v6.667z" class="cls-2s <?php active(''); ?>" data-name="Path 3" transform="translate(-.333 -.5)"/>
                                                <path id="Path_4" d="M0 0h20v20H0z" class="cls-3" data-name="Path 4"/>
                                            </g>
                                        </svg>
                                    </i>
                                    Main
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php active('analytics'); ?>" href="/analytics">
                                    <i>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                                            <defs>
                                                <style>
                                                    .cls-1{fill:#7a7a7a}.cls-2{opacity:.9;clip-path:url(#clip-path)}
                                                </style>
                                                <clipPath id="clip-path">
                                                    <path id="Path_6" d="M0 0h20v20H0z" class="cls-1" data-name="Path 6"/>
                                                </clipPath>
                                            </defs>
                                            <g id="ic-timeline-24px" class="cls-2">
                                                <path id="Path_5" d="M19.333 7.667a1.672 1.672 0 0 1-1.667 1.667 1.416 1.416 0 0 1-.425-.058l-2.967 2.958a1.472 1.472 0 0 1 .058.433 1.667 1.667 0 1 1-3.333 0 1.472 1.472 0 0 1 .058-.433l-2.124-2.126a1.639 1.639 0 0 1-.867 0l-3.792 3.8a1.416 1.416 0 0 1 .058.425 1.667 1.667 0 1 1-1.667-1.667 1.416 1.416 0 0 1 .425.058l3.8-3.792a1.472 1.472 0 0 1-.057-.432 1.667 1.667 0 0 1 3.333 0 1.472 1.472 0 0 1-.058.433l2.125 2.125a1.639 1.639 0 0 1 .867 0l2.958-2.967A1.416 1.416 0 0 1 16 7.667a1.667 1.667 0 1 1 3.333 0z" class="cls-1 <?php active('analytics'); ?>" data-name="Path 5" transform="translate(-.167 -1)"/>
                                            </g>
                                        </svg>
                                    </i>
                                    Analytics</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php active('analytics2'); ?>" href="/analytics2">
                                    <i>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                                            <defs>
                                                <style>
                                                    .cls-1{fill:#7a7a7a}.cls-2{opacity:.9;clip-path:url(#clip-path)}
                                                </style>
                                                <clipPath id="clip-path">
                                                    <path id="Path_6" d="M0 0h20v20H0z" class="cls-1 <?php active('analytics2'); ?>" data-name="Path 6"/>
                                                </clipPath>
                                            </defs>
                                            <g id="ic-timeline-24px" class="cls-2">
                                                <path id="Path_5" d="M19.333 7.667a1.672 1.672 0 0 1-1.667 1.667 1.416 1.416 0 0 1-.425-.058l-2.967 2.958a1.472 1.472 0 0 1 .058.433 1.667 1.667 0 1 1-3.333 0 1.472 1.472 0 0 1 .058-.433l-2.124-2.126a1.639 1.639 0 0 1-.867 0l-3.792 3.8a1.416 1.416 0 0 1 .058.425 1.667 1.667 0 1 1-1.667-1.667 1.416 1.416 0 0 1 .425.058l3.8-3.792a1.472 1.472 0 0 1-.057-.432 1.667 1.667 0 0 1 3.333 0 1.472 1.472 0 0 1-.058.433l2.125 2.125a1.639 1.639 0 0 1 .867 0l2.958-2.967A1.416 1.416 0 0 1 16 7.667a1.667 1.667 0 1 1 3.333 0z" class="cls-1 <?php active('analytics2'); ?>" data-name="Path 5" transform="translate(-.167 -1)"/>
                                            </g>
                                        </svg>
                                    </i>
                                    Analytics2</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php active('search'); ?>" href="/search">Search</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php active('settings'); ?>" href="/settings">Logs</a>
                            </li>
                        </ul>

                    </div>
                    <span style="padding-bottom: 1rem" class="navbar-text justify-content-end">Hello,
                  <?php if (isset($_SESSION['user_name'])) {
                      echo " {$_SESSION['user_name']}";
                  } ?>
                </span>
                &nbsp&nbsp&nbsp&nbsp&nbsp
                    <span class="navbar-text justify-content-end">
                        <a class="nav-link text-danger <?php active('/?action=out'); ?>"
                           href="/?action=out">Logout
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                                    <defs>
                                        <style>
                                            .cls-1{opacity:.9}.cls-2{fill:none}.cls-3s{fill:#7a7a7a}
                                        </style>
                                    </defs>
                                    <g id="ic-exit-to-app-24px" class="cls-1">
                                        <path id="Path_7" d="M0 0h20v20H0z" class="cls-2" data-name="Path 7"/>
                                        <path id="Path_8" d="M8.908 13.492l1.175 1.175L14.25 10.5l-4.167-4.167-1.175 1.175 2.15 2.158H3v1.667h8.058zM16.333 3H4.667A1.666 1.666 0 0 0 3 4.667V8h1.667V4.667h11.666v11.666H4.667V13H3v3.333A1.666 1.666 0 0 0 4.667 18h11.666A1.672 1.672 0 0 0 18 16.333V4.667A1.672 1.672 0 0 0 16.333 3z" class="cls-3s" data-name="Path 8" transform="translate(-.5 -.5)"/>
                                    </g>
                                </svg>

                            </i>
                        </a>
                    </span>
                </nav>
            </div>
        </div>
    </div>
</div>