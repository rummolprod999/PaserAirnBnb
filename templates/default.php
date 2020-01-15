<?php require_once 'templates/navigation.php' ?>
<?php require_once 'helpers/otherHelpers.php' ?>

<?php
        $ind = count ($data['url_arr']) - 1;
        $url = $data['url_arr'][$ind][1];
        array_pop($data['url_arr'][$ind]);
?>
<div id="article">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="main_tutorial not_full_width">
                    <h1  class="mainTitle">APARTMENTS LIST</h1>
                    <a target="_blank" href="<?= $url ?>" class="float-right tutorial__text">Watch tutorial</a>
                </div>
                <div id="table_div">
                    <div class="not_full_width">
                        <div >
                        <form class="form-inline" method="post">
                            <label class="sr-only" for="inlineFormInputUrl">URL:</label>
                                <input type="text" class="main__search-field form-control mb-2 mr-sm-2 w-25" id="inlineFormInputUrl" name="add_url"
                                       placeholder="https://www.airbnb.ru/rooms/XXXXXXX" required pattern="https://.+">
                            <div class="d-flex search_owner">
                                <label class="" for="inlineFormInputOwner">Owner:</label>
                                <label class="checkbox_func">
                                    <input class="d-none form-check-input form-check-rel" type="checkbox" value="true" id="inlineFormInputOwner"
                                       name="own">
                                    <img src="/img/custom_checkbox.svg" class="js_checkBox__img" aria-hidden="true">
                                </label>
                            </div>
                            <button type="submit" class="btn_add_items btn btn-primary mb-2">+add property</button>
                        </form>
                            <div class="btns_rightside d-flex ml-auto">
                                <form id="reorder_table" class="form-inline" method="post"><input type="hidden" name="reorder" value="true">
                                    <button type="submit" class="btn_reorder btn">Reorder table</button>
                                </form>
                                <form class="form-inline" method="post"><input type="hidden" name="launch" value="true">
                                    <button type="submit" class="btn_parse btn">Launch date update</button>
                                </form>
                            </div>
                        </div>
<!--                        </form>-->
                        <?php if (isset($_SESSION['add_mess'])) {
                            echo $_SESSION['add_mess'];
                            unset($_SESSION['add_mess']);
                        }
                        if (isset($_SESSION['rem_mess'])) {
                            echo $_SESSION['rem_mess'];
                            unset($_SESSION['rem_mess']);
                        }
                        if (isset($_SESSION['launch_mess'])) {
                            echo $_SESSION['launch_mess'];
                            unset($_SESSION['launch_mess']);
                        }
                        if (isset($_SESSION['change_notes'])) {
                            echo $_SESSION['change_notes'];
                            unset($_SESSION['change_notes']);
                        }
                        if (isset($_SESSION['reorder'])) {
                            echo $_SESSION['reorder'];
                            unset($_SESSION['reorder']);
                        } ?>
<!--                        <div class="float-right">-->
<!--                            <div class="form-group pull-right">-->
<!--                                <input type="text" class="search form-control" placeholder="What you looking for?">-->
<!--                            </div>-->
<!--                            <span class="counter pull-right"></span>-->
<!--                        </div>-->
                    </div>

                    <div class="table-responsive main__table-resp">
                        <table class="main_table table table-hover results">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th><div class="thead__title">Order</div></th>
<!--                                <th>Statistics</th>-->
<!--                                <th>Changes</th>-->
                                <th><div class="thead__title">Property Name</div></th>
                                <th><div class="thead__title">Owner</div></th>
                                <th><div class="thead__title">Min nights</div></th>
                                <th><div class="thead__title">Changes</div></th>
                                <th><div class="thead__title">Long terms</div></th>
                                <th><div class="thead__title">Edit</div></th>
<!--                                <th>Status</th>-->
<!--                                <th>Remove</th>-->
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="warning no-result">
                                <td colspan="12"><i class="fa fa-warning"></i> No result</td>
                            </tr>
                            <?php $count_app = 0; ?>
                            <?php foreach ($data['url_arr'] as $row): ?>
                                <tr <?php if ($row['own'] === '1') {
                                    echo 'class="table-warning"';
                                } elseif ($row['id'] === '38') {
                                    echo 'class="table-danger"';
                                } ?>>
<!--                                    <tr>-->
                                    <th><?php echo ++$count_app ?></th>
                                    <td><input class="order__field w-100" min="0" max="999" type="number" title="from 0 to 999"
                                               form="reorder_table"
                                               value="<?php echo $row['order_main'] ?>" name="<?php echo $row['id'] ?>"></td>
<!--                                    <td><a href="--><?php //echo "/stat/{$row['id']}" ?><!--">--><?php //echo 'Statistics' ?><!--</a></td>-->
<!--                                    <td><a href="--><?php //echo "/changes/{$row['id']}" ?><!--">--><?php //echo 'Changes' ?><!--</a></td>-->
                                    <td><a class="table_name_link" title="<?php echo $row['url'] ?>" target="_blank"
                                           href="<?php echo $row['url'] ?>"><?php echo $row['apartment_name'] ?></a></td>
                                    <td><?php echo $row['owner'] ?></td>

                                    <td class='text-info text-nowrap'><?php if (isset($row['min_nights'])) {
                                            $min_nights = $row['min_nights'];
                                            echo print_collapse_min_nights($row['min_nights'], $row['id']);
                                        } ?></td>
                                    <td class='price text-danger text-nowrap'><?php if (isset($row['res_bookable_change'])) {
                                        echo "<div class='price_height default__price-trans' >";
                                            foreach ($row['res_bookable_change'] as $rp) {
                                                echo "<span class='price_date'>NEW BOOKING: </span> {$rp['date_cal']}</br>";
                                            }
                                        } ?><?php if (isset($row['res_price_change'])) {
                                            foreach ($row['res_price_change'] as $rp) {
                                                echo "<span class='price_date'> {$rp['date_cal']}:</span> \${$rp['price_was']} -> \${$rp['price']}</br>";
                                            }
                                        }
                                        echo "</div>";
                                        ?>
                                        <?php
                                            if(count($row['res_price_change']) > 3) {
                                                ?>
                                                <button class="js_deploy_btn btn_delpoy_shadow btn_deploy btn btn-primary">Expand</button>
                                                <?php
                                            }
                                        ?>
                                    </td>
                                    <td class='text-success text-nowrap'><?php if (isset($row['discounts'])) {
                                            foreach ($row['discounts'] as $rd) {
                                                echo "{$rd}</br>";
                                            }
                                        } ?></td>
                                        <td>
                                            <div class="d-flex icons_block">
                                                <a class="icon" href="<?php echo "/stat/{$row['id']}" ?>">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                                                        <defs>
                                                            <style>
                                                                .cls-2{opacity:.9;clip-path:url(#clip-path)}
                                                            </style>
                                                            <clipPath id="clip-path">
                                                                <path id="Path_6" d="M0 0h20v20H0z" class="cls-1" data-name="Path 6"/>
                                                            </clipPath>
                                                        </defs>
                                                        <g id="ic-timeline-24px" class="cls-2-icons-time">
                                                            <path id="Path_5" d="M19.333 7.667a1.672 1.672 0 0 1-1.667 1.667 1.416 1.416 0 0 1-.425-.058l-2.967 2.958a1.472 1.472 0 0 1 .058.433 1.667 1.667 0 1 1-3.333 0 1.472 1.472 0 0 1 .058-.433l-2.124-2.126a1.639 1.639 0 0 1-.867 0l-3.792 3.8a1.416 1.416 0 0 1 .058.425 1.667 1.667 0 1 1-1.667-1.667 1.416 1.416 0 0 1 .425.058l3.8-3.792a1.472 1.472 0 0 1-.057-.432 1.667 1.667 0 0 1 3.333 0 1.472 1.472 0 0 1-.058.433l2.125 2.125a1.639 1.639 0 0 1 .867 0l2.958-2.967A1.416 1.416 0 0 1 16 7.667a1.667 1.667 0 1 1 3.333 0z" class="cls-1" data-name="Path 5" transform="translate(-.167 -1)"/>
                                                        </g>
                                                    </svg>
                                                </a>
                                                <a class="icon" href="<?php echo "/changes/{$row['id']}" ?>">
                                                    <svg xmlns="http://www.w3.org/2000/svg" id="Component_13_1" width="30" height="30" data-name="Component 13 – 1" viewBox="0 0 30 30">
                                                        <defs>
                                                            <style>
                                                                .cls-2{opacity:1}.cls-3{clip-path:url(#clip-path)}
                                                            </style>
                                                            <clipPath id="clip-path">
                                                                <path id="Path_14" d="M0 0h26v26H0z" class="cls-1" data-name="Path 14"/>
                                                            </clipPath>
                                                        </defs>
                                                        <rect id="Rectangle_24" width="30" height="30" class="cls-2" data-name="Rectangle 24" rx="5"/>
                                                        <g id="ic-compare-arrows-24px" class="cls-3-switch" transform="translate(2 2)">
                                                            <path id="Path_13" d="M9.594 14.75H2v2.167h7.594v3.25l4.322-4.333L9.594 11.5zm6.478-1.083v-3.25h7.594V8.25h-7.593V5L11.75 9.333z" class="cls-1" data-name="Path 13" transform="translate(.167 .417)"/>
                                                        </g>
                                                    </svg>

                                                </a>
                                                <form class=" form-inline" method="post"><input type="hidden" name="remove_url" value="<?php echo $row['id'] ?>">
                                                <button type="submit" class="btn__icon icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" id="ic-delete-24px" width="26" height="26" viewBox="0 0 26 26">
                                                        <defs>
                                                            <style>
                                                                .cls-2r{fill:none}
                                                            </style>
                                                        </defs>
                                                        <path id="Path_15" d="M5.939 18.022A1.883 1.883 0 0 0 7.817 19.9h7.511a1.883 1.883 0 0 0 1.878-1.878V6.756H5.939zM18.144 3.939h-3.286L13.919 3H9.225l-.939.939H5v1.878h13.144z" class="cls-1" data-name="Path 15" transform="translate(1.717 1.55)"/>
                                                        <path id="Path_16" d="M0 0h26v26H0z" class="cls-2r" data-name="Path 16"/>
                                                    </svg>

                                                </button>
                                                </form>
                                            </div>

                                            <div class="parse_status">
                                                <p>Parsing: <?= $row["status_parsing"]; ?></p>
                                            </div>
                                        </td>
<!--                                    <td>-->
<!--                                        --><?php //echo $row['status_parsing'] ?>
<!--                                    </td>-->
<!--                                    <td>-->
<!--                                        <form class="form-inline" method="post"><input type="hidden" name="remove_url"-->
<!--                                                                                       value='--><?php //echo $row['id'] ?><!--'>-->
<!--                                            <button type="submit" class="btn btn-danger mb-2">Remove</button>-->
<!--                                        </form>-->
<!--                                    </td>-->
                                </tr>
                            <tr
                                <?php if ($row['own'] === '1') {
                                    echo 'class="table-warning"';
                                } elseif ($row['id'] === '38') {
                                    echo 'class="table-danger"';
                                } ?>
                            >
                                <td colspan="8">
                                    <?php //if ($row['notes'] !== ''): ?>
                                    <form method="post" class=" d-flex" id="notes_form<?php echo $row['id'] ?>">
                                        <input type="hidden" name="id_notes"
                                               value='<?php echo $row['id'] ?>'>
                                        <p class="notes_title">Notes:</p>
                                        <textarea id="notes<?php echo $row['id'] ?>" name="notes" class="notes_area notes_textarea" rows="1" placeholder="Enter your notes here..." ><?php echo $row['notes'] ?></textarea>
                                        <?php //if($row['notes'] != ''){ ?>
                                        <button type="submit" class="main__btn_change btn btn-primary d-none" form="notes_form<?php echo $row['id'] ?>">
                                            Save
                                        </button>
                                        <?php //} ?>
                                    </form>
                                    <?php //endif; ?>
                                    <!--                                        <button type="button" class="btn btn-outline-secondary" data-toggle="modal"-->
                                    <!--                                                data-target="#Modal--><?php //echo $row['id'] ?><!--">change-->
                                    <!--                                        </button>-->
                                </td>
<!--                            </tr>-->
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
<!--                    <div>-->
<!--                        <div class="p-2">-->
<!--                            <form id="reorder_table" class="form-inline" method="post"><input type="hidden" name="reorder"-->
<!--                                                                                              value='true'>-->
<!--                                <button type="submit" class="btn btn-outline-dark btn-lg">Reorder table</button>-->
<!--                            </form>-->
<!--                        </div>-->
<!--                        <div class="p-2">-->
<!--                            <form class="form-inline" method="post"><input type="hidden" name="launch"-->
<!--                                                                           value='true'>-->
<!--                                <button type="submit" class="btn btn-success btn-lg">Launch parser</button>-->
<!--                            </form>-->
<!--                        </div>-->
<!--                    </div>-->
                    <?php foreach ($data['url_arr'] as $row): ?>
                        <div class="modal fade" id="Modal<?php echo $row['id'] ?>" tabindex="-1" role="dialog"
                             aria-labelledby="ModalLabel<?php echo $row['id'] ?>" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="ModalLabel<?php echo $row['id'] ?>">Notes for <span
                                                    class="text-secondary"><?php echo $row['apartment_name'] ?><p
                                                        class="text-secondary"></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <form method="post" id="notes_form<?php echo $row['id'] ?>">
                                            <div class="form-group">
                                                <label for="notes<?php echo $row['id'] ?>"></label>
                                                <textarea class="form-control" id="notes<?php echo $row['id'] ?>" rows="3"
                                                          maxlength="2000" name="notes"><?php echo $row['notes'] ?></textarea>
                                                <input type="hidden" name="id_notes"
                                                       value='<?php echo $row['id'] ?>'>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" form="notes_form<?php echo $row['id'] ?>">
                                            Save changes
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <script src="/js/search_in_table.js" async></script>
                    <script src="/js/expand_blocks.js" async></script>
                    <script src="/js/chackbox_switcher.js" async></script>
                </div>
            </div>
        </div>
    </div>
</div>
