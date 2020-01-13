<?php require_once 'templates/navigation.php' ?>
<?php require_once 'helpers/arraysHelpers.php' ?>


<div id="article">
<!--    <div class="container">-->
<!--        <div class="row">-->
<!--            <div class="col-lg-12">-->


    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="main_tutorial changes__title not_full_width">
                    <h1 style="margin-top: 50px;" class="text-left">CHANGES <?php if (isset($data['descr'])) {
                            echo " <span class=\"under-text text-secondary\">{$data['descr']['apartment_name']} </span>";
//                            {$data['descr']['apartment_name']}
                        } ?></h1>
                    <a target="_blank" href="<?= $data['video_url'] ?>" class="float-right tutorial__text">Watch tutorial</a>
                </div>
        <form class="not_full_width changes__form_dates">
            <div class="form-group row">
                <label for="date_start" class="changes__start_title col-sm-1 col-form-label">Start date:</label>
                <div class="col-xs-5 col-sm-2">
                    <input type="date" id="date_start" name="date_start" class="changes__dates_fields form-control" required/>
                </div>
                <label for="date_end" class="changes__end_date col-sm-1 col-form-label">End date:</label>
                <div class="col-xs-5 col-sm-2">
                    <input type="date" id="date_end" name="date_end" class="changes__dates_fields form-control" required/>
                </div>
                <div class="col-xs-3">
                    <button type="submit" class="changes__dates_search btn btn-primary btn-lg">Get changes</button>
                </div>
            </div>
        </form>
        </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">

    <ul class="not_full_width changes__nav nav nav-pills nav-fill" role="tablist">
        <li role="presentation" class="changes__sybmenu nav-item"><a href="#tabbook" role="tab"
                                                    data-toggle="tab" class="changes__submenu-link nav-link active">Bookable changes</a></li>
        <li role="presentation" class="changes__sybmenu nav-item"><a href="#tabprice" role="tab"
                                                    data-toggle="tab" class="changes__submenu-link nav-link">Price changes</a></li>
    </ul>

            </div>
        </div>
    </div>




    <div class="tab-content">
<!--        сделать таблицу элементами -->
<!--        <div role="tabpanel" class="tab-pane active" id="tabbook">-->
<!--            <div class="container-fluid">-->
<!--                <div class="row">-->
<!--                    <div class="py-4 col-12">-->
        <div id="tabbook" role="tabpanel" class="tab-pane active">
        <div class="container">
            <div class="row">


                        <?php if (isset($data['bookable_changes']) && $data['bookable_changes'] !== null): ?>
                            <?php /*foreach ($data['bookable_changes'] as $row): */ ?><!--
                        <p class="text-danger"><?php /*echo "<span class=\"text-secondary\">{$row['date_parsing']}</span>  NEW BOOKING: {$row['date_cal']}" */ ?></p>
                    --><?php /*endforeach; */ ?>
                            <?php $arr = group_array($data['bookable_changes']);

                            foreach ($arr as $k_arr => $v_arr):?>
                                <div class="col-lg-10">
                                <table class="change__table">
                                <tbody>
                                        <?php
                                        $quant = count($v_arr);
                                        $manyNight = false;
                                        if($quant > 5){
                                            $manyNight = true;
                                        }
                                        if(!$manyNight){
                                        foreach ($v_arr as $vv):?>

                                            <?php echo "<tr class='changes__row-default'><td class=\"changes__col-default\">{$k_arr}</td> <td class='changes__col-default'> NEW BOOKING: <span class='changes__col-date'>{$vv[0]}</span></td><td class='changes__col-default'><span class=\"\"> \${$vv[1]}</span></td></tr>" ?>

                                        <?php endforeach;
                                        } else{
                                            for($i = 0; $i < 5; $i++){ ?>
                                                <?php echo "<tr class='changes__row-default'><td class=\"changes__col-default\">{$k_arr}</td> <td class='changes__col-default'> NEW BOOKING: <span class='changes__col-date'>{$v_arr[$i][0]}</span></td><td class='changes__col-default'><span class=\"\"> \${$v_arr[$i][1]}</span></td></tr>" ?>
                                            <?php }
                                        }
                                        ?>

                                </tbody>
                                </table>
                                    <?php if($manyNight){ ?>
                                        <button id="full" class="changes__btn-showAll btn btn-primary">See all</button>
                                    <?php } ?>
                                </div>

                                            <?php
                                                $c = count($v_arr) - 1;
                                            ?>
                                <div class="col-lg-2">
                                    <div class="changes__nights">
                                        <div class="changes__text">
                                            <?php
                                            if ($c === 1) {
                                                echo "{$c} night";
                                            } elseif ($c > 1) {
                                                echo "{$c} nights";
                                            } ?>

                                        </div>
                                    </div>
                                </div>

                                <div class="changes__margin-top"></div>

<!--                                        <div class="col-md-auto col-4 align-self-center mb-3 p-1">--><?php //$c = count($v_arr) - 1;
//                                            if ($c === 1) {
//                                                echo "<p class=\"font-weight-bold\">{$c} night</p>";
//                                            } elseif ($c > 1) {
//                                                echo "<p class=\"font-weight-bold\">{$c} nights</p>";
//                                            } ?><!--</div>-->


                            <?php endforeach; ?>

                        <?php endif; ?>

                </div>
<!--                <div class="col-lg-2">-->
<!--                    <div class="changes__nights">-->
<!--                        <div class="changes__text">-->
<!--                            --><?php
//                            if ($c === 1) {
//                                echo "{$c} night";
//                            } elseif ($c > 1) {
//                                echo "{$c} nights";
//                            } ?>
<!---->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
            </div>
        </div>

        <div id="tabprice" role="tabpanel" class="tab-pane">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10">
        <table class="change__table">
            <tbody>

                        <?php if (isset($data['price_changes']) && $data['price_changes'] !== null): ?>
<!--                            <br><br>-->

                            <?php foreach ($data['price_changes'] as $row): ?>
                                <tr class="changes__row-default"><?php echo "<td class='changes__col-default'>{$row['date_parsing']}</td> <td class='changes__col-default'> PRICE CHANGE: <span class='changes__col-date'>{$row['date_cal']}</span></td> <td class='changes__col-default'>   \${$row['price_was']} -> \${$row['price']}</td>" ?></tr>
                            <?php endforeach; ?>
            </tbody>
        </table>
                        <?php endif; ?>



            </div>
            </div>
            <div class="col-lg-2">
<!--                <div class="changes__nights">-->
<!--                    <div class="changes__text">-->
<!--                        87 nights-->
<!--                    </div>-->
<!--                </div>-->
            </div>
    </div>
</div>
</div>
    <!--<div class="container-fluid">
        <div class="row">


        </div>
    </div>-->


<?php require_once 'templates/footer.php' ?>

