<?php require_once 'templates/navigation.php' ?>
<?php require_once 'helpers/calendar.php' ?>


<div id="article">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">



                <div><h1 class="stat__title text-left">Statistics</h1></div>
                <div class="stat__apart stat__char"><strong>Apartment Name: </strong><?php if (isset($data['info_url']['apartment_name'])) {
                        ?> <span> <?php echo $data['info_url']['apartment_name']; ?> </span> <?php
                    } ?></div>
                <div class="stat__owner stat__char"><strong>Owner: </strong><?php if (isset($data['info_url']['owner'])) {
                        ?> <span> <?php echo $data['info_url']['owner']; ?> </span> <?php
                    } ?></div>
                <div class="stat__char"><strong>Url: </strong><a target="_blank" href="<?php if (isset($data['info_url']['url'])) {
                         echo $data['info_url']['url'];
                    } ?>"><?php echo $data['info_url']['url'] ?></a></div>
                <div class="stat__char"><strong>Minimum number of nights to order: </strong><span
                            class="text-info"><?php if (isset($data['min_nights'])) {
                            $min_nights = $data['min_nights'];
                            $iMax = count($min_nights);
                            if ($iMax > 0) {
                                for ($i = 0; $i < $iMax; $i += 2) {
                                    echo "{$min_nights[$i]['date']} - {$min_nights[$i+1]['date']}: {$min_nights[$i+1]['min_nights']} nights; ";
                                }
                            }
                        } ?></span></div>
                <div class="stat__char"><strong>Cleaning fee: </strong><?php if (isset($data['cleaning_price']['price_cleaning'])) {
                        ?> <span> <?php echo "\${$data['cleaning_price']['price_cleaning']}"; ?> </span> <?php
                    } ?></div>
                <div class="stat__terms d-flex">
                <div class="stat__char"><strong>Long terms: </strong><?php if (isset($data['discounts'])) {
                        $discounts = '';
                        foreach ($data['discounts'] as $disc) {
                            $discounts .= "{$disc}, ";
                        }
                    ?> <span> <?php echo trim($discounts, ', '); ?> </span> <?php
                    } ?></div>
                <?php if (isset($_SESSION['bookable_clean'])) {
                    echo $_SESSION['bookable_clean'];
                    unset($_SESSION['bookable_clean']);
                } ?>
                <?php if (isset($_SESSION['suspend'])) {
                    echo $_SESSION['suspend'];
                    unset($_SESSION['suspend']);
                } ?>
                <?php if (isset($_SESSION['unsuspend'])) {
                    echo $_SESSION['unsuspend'];
                    unset($_SESSION['unsuspend']);
                } ?>
                <form class="form-inline" method="post"><input type="hidden" name="remove_bookable"
                                                               value='remove'>
                    <button type="submit" class="stat__changesBtn stat__btns btn btn-danger mb-2">I have seen these changes</button>
                </form>

                    <form class="form-inline" method="post"><input type="hidden" name="suspend"
                                                                   value='true'>
                        <button type="submit" class="stat__btns btn btn-warning mb-2">Suspend</button>
                    </form>
                    <form class="form-inline" method="post"><input type="hidden" name="unsuspend"
                                                                   value='true'>
                        <button type="submit" class="stat__btns btn btn-success mb-2">Unsuspend</button>
                    </form>
                </div>

                <div class="d-flex">
                    <div class="py-4 col-xs-12 col-md-8">
                    </div>

                    <div class="py-4 col-xs-6 col-md-4">
                        <div class="alert__title alert alert-warning">
                            <div><p><span><strong>Price for the minimum period</strong></span></p></div>
                            <div><span><strong>Period: </strong></span><?php if (isset($data['prices']['check_in'])) {
                                    echo $data['prices']['check_in'];
                                } ?> - <?php if (isset($data['prices']['check_out'])) {
                                    echo $data['prices']['check_out'];
                                } ?></div>
                            <div><span><strong>Price: </strong></span><?php if (isset($data['prices']['price'])) {
                                    echo $data['prices']['price'];
                                } ?></div>
                        </div>
                    </div>
                </div>

                <?php
                    $len = count($data['prices']['check_in_first_15']);
                    for($i = 0; $i < $len; $i++){

                ?>
                    <div class="d-flex">
                        <div class="py-4 col-xs-12 col-md-8">
                            <?php
                            if($i == 0){
                                $j = '';
                            } else if($i >= 1){
                                $j = $i + 1;
                            }
                            if (isset($data["days$j"]) && count($data["days$j"]) > 0) {
                                echo print_calendar($data["days$j"], $data['res_bookable_change']);
                            } ?>
                        </div>
                        <div class="py-4 col-xs-6 col-md-4">
<!--                            --><?php //foreach ($data['prices']['check_in_first_15'] as $k => $v): ?>
                                <?php if ($data['prices']['check_in_first_15'][$i] === '') break; ?>
                                <div class="mb-5"></div>
                                <div class="cal__leftTable alert alert-info">
                                    <div><p><span><strong>Period price 1 - 15</strong></span></p></div>
                                    <div><span><strong>Period: </strong></span><?php if (isset($data['prices']['check_in_first_15'][$i])) {
                                            echo $data['prices']['check_in_first_15'][$i];
                                        } ?> - <?php if (isset($data['prices']['check_out_first_15'][$i])) {
                                            echo $data['prices']['check_out_first_15'][$i];
                                        } ?></div>
                                    <div><span><strong>Price: </strong></span><?php if (isset($data['prices']['price_first_15'][$i])) {
                                            echo $data['prices']['price_first_15'][$i];
                                        } ?></div>
                                    <div class="mb-5"></div>
                                    <div><p><span><strong>Period price 16 - 30</strong></span></p></div>
                                    <div><span><strong>Period: </strong></span><?php if (isset($data['prices']['check_in_second_15'][$i])) {
                                            echo $data['prices']['check_in_second_15'][$i];
                                        } ?> - <?php if (isset($data['prices']['check_out_second_15'][$i])) {
                                            echo $data['prices']['check_out_second_15'][$i];
                                        } ?></div>
                                    <div><span><strong>Price: </strong></span><?php if (isset($data['prices']['price_second_15'][$i])) {
                                            echo $data['prices']['price_second_15'][$i];
                                        } ?></div>
                                    <div class="mb-5"></div>
                                    <div><p><span><strong>Period price 1 - 30</strong></span></p></div>
                                    <div><span><strong>Period: </strong></span><?php if (isset($data['prices']['check_in_30'][$i])) {
                                            echo $data['prices']['check_in_30'][$i];
                                        } ?> - <?php if (isset($data['prices']['check_out_30'][$i])) {
                                            echo $data['prices']['check_out_30'][$i];
                                        } ?></div>
                                    <div><span><strong>Price: </strong></span><?php if (isset($data['prices']['price_30'][$i])) {
                                            echo $data['prices']['price_30'][$i];
                                        } ?></div>
                                </div>
<!--                            --><?php //endforeach; ?>
                        </div>
                    </div>
                <?php  }  ?>


                </div>
            </div>
        </div>
    </div>
</div>