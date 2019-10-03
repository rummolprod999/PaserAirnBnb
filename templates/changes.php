<?php require_once 'templates/navigation.php' ?>
<?php require_once 'helpers/arraysHelpers.php' ?>
<div><h1 class="text-center">Changes <?php if (isset($data['descr'])) {
            echo " <span class=\"text-secondary\">{$data['descr']['apartment_name']}</span>";
        } ?></h1></div>
<div id="article">
    <div class="container-fluid">
        <form>
            <div class="form-group row">
                <label for="date_start" class="col-sm-1 col-form-label">Start date:</label>
                <div class="col-xs-5 col-sm-2">
                    <input type="date" id="date_start" name="date_start" class="form-control" required/>
                </div>
            </div>
            <div class="form-group row">
                <label for="date_end" class="col-sm-1 col-form-label">End date:</label>
                <div class="col-xs-5 col-sm-2">
                    <input type="date" id="date_end" name="date_end" class="form-control" required/>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-xs-3">
                    <button type="submit" class="btn btn-primary btn-lg">Get changes</button>
                </div>
            </div>
        </form>
    </div>
    <ul class="nav nav-pills nav-fill" role="tablist">
        <li role="presentation" class="nav-item"><a href="#tabbook" role="tab"
                                                    data-toggle="tab" class="nav-link active">Bookable changes</a></li>
        <li role="presentation" class="nav-item"><a href="#tabprice" role="tab"
                                                    data-toggle="tab" class="nav-link">Price changes</a></li>
    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="tabbook">
            <div class="container-fluid">
                <div class="row">
                    <div class="py-4 col-12">
                        <?php if (isset($data['bookable_changes']) && $data['bookable_changes'] !== null): ?>
                            <?php /*foreach ($data['bookable_changes'] as $row): */ ?><!--
                        <p class="text-danger"><?php /*echo "<span class=\"text-secondary\">{$row['date_parsing']}</span>  NEW BOOKING: {$row['date_cal']}" */ ?></p>
                    --><?php /*endforeach; */ ?>
                            <?php $arr = group_array($data['bookable_changes']);
                            foreach ($arr as $k_arr => $v_arr):?>
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-auto col-8 border border-5 border-primary rounded mb-3 p-2"><?php foreach ($v_arr as $vv): ?>
                                                <p class="text-danger"><?php echo "<span class=\"text-secondary\">{$k_arr}</span>  NEW BOOKING: {$vv}" ?></p>
                                            <?php endforeach; ?></div>
                                        <div class="col-md-auto col-4 align-self-center mb-3 p-1"><?php $c = count($v_arr) - 1;
                                            if ($c === 1) {
                                                echo "<p class=\"font-weight-bold\">{$c} night</p>";
                                            } elseif ($c > 1) {
                                                echo "<p class=\"font-weight-bold\">{$c} nights</p>";
                                            } ?></div>

                                    </div>
                                </div>
                            <?php endforeach; ?>

                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="tabprice">
            <div class="container-fluid">
                <div class="row">
                    <div class="py-4 col-12">
                        <?php if (isset($data['price_changes']) && $data['price_changes'] !== null): ?>
                            <?php foreach ($data['price_changes'] as $row): ?>
                                <p class="text-danger"><?php echo "<span class=\"text-secondary\">{$row['date_parsing']}</span>  PRICE CHANGE: {$row['date_cal']}   \${$row['price_was']} -> \${$row['price']}" ?></p>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--<div class="container-fluid">
        <div class="row">


        </div>
    </div>-->
</div>
