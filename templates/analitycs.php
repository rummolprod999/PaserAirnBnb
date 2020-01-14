<?php require_once 'templates/navigation.php' ?>
<?php
if (!function_exists('array_key_first')) {
    function array_key_first(array $arr)
    {
        foreach ($arr as $key => $unused) {
            return $key;
        }
        return NULL;
    }
}
$tabs = 0;
$divs = 0;
$ind = count ($data) - 1;
$url = $data[$ind][1];
array_pop($data[$ind]);
?>
<div id="article">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="not_full_width title_margin">
                    <h1 class="analitycs__title text-left">ANALITYCS</h1>
                    <a target="_blank" href="<?= $url ?>" class="float-right main_tutorial tutorial__text">Watch tutorial</a>
                </div>

                 <div class="analitycs__setNights not_full_width d-flex">
                    <form class="d-flex form__nights" method="get">
                    <div class="nights d-flex">
                        <span class="night__text">
                            Night:
                        </span>
                        <?php $selectedData = (int)(array_key_first($data[0])) ?>


                            <input value="<?php echo $selectedData ?>" min="<?php echo $selectedData ?>" max="<?php echo count($data); ?>" type="number" class="night__field">

                        <script>
                            $(document).ready(function(){
                                $('.form__nights').submit(function(event){
                                    event.preventDefault();
                                    let value = $('.night__field').val();
                                    $('.tab-pane').removeClass('active');
                                    $('.days__quant').html(parseInt(value) + 1);
                                    $('.js_link' + value).trigger('click');

                                });

                                $('.nights').each(function() {
                                    var spinner = jQuery(this),
                                        input = spinner.find('input[type="number"]'),
                                        btnUp = spinner.find('.btn_up'),
                                        btnDown = spinner.find('.btn_down');
                                    btnUp.click(function() {
                                        var oldValue = parseFloat(input.val());
                                        var newVal = oldValue + 1;
                                        spinner.find("input").val(newVal);
                                        $(".days__quant").text(newVal + 1);
                                        spinner.find("input").trigger("change");
                                    });

                                    btnDown.click(function() {
                                        var oldValue = parseFloat(input.val());
                                        var newVal = oldValue - 1;
                                        spinner.find("input").val(newVal);
                                        $(".days__quant").text(newVal + 1);
                                        spinner.find("input").trigger("change");
                                    });

                                });
                                $('[data-toggle="tooltip"]').hover(function() {
                                    $(this).tooltip({
                                        trigger: "hover",
                                        html: true,
                                        animation: false,
                                        content: $(this).prop("title").text
                                    }).tooltip('show');
                                });
                            });
                        </script>
                        <div class="buttons__selector">
                            <img class="btn_up" src="/img/ic-arrow-up-18px.png" aria-hidden="true" >
                            <img class="btn_down" src="/img/ic-arrow-down-18px.png" aria-hidden="true" >
                        </div>
                    </div>
                    <div class="days d-flex">
                        <span class="days__text">
                            Days:
                        </span>
                        <span class="days__quant">
                            <?php echo (int)(array_key_first($data[0]) + 1) ?>
                        </span>
                    </div>
                    <button type="submit" class="btn btn-primary anal__accept">Accept</button>
                    </form>
                </div>

<!--                <ul class="nav nav-pills nav-fill" role="tablist">-->
<!--                    --><?php //foreach ($data as $m): ?>
<!--                        <li role="presentation" class="nav-item"><a href="#tab--><?php //echo array_key_first($m) ?><!--" role="tab"-->
<!--                                                                    data-toggle="tab" class="nav-link--><?php //if ($tabs === 0) {
//                                echo ' active';
//                            } ?><!--">--><?php //$tabs++;
//                                echo array_key_first($m) ?><!--</a></li>-->
<!--                    --><?php //endforeach; ?>
<!--                </ul>-->
                <div class="tab-content">
                    <?php $divs = $selectedData ?>
                    <?php foreach ($data as $m): ?>

                        <a href="#tab<?php echo array_key_first($m) ?>" role="tab"
                           data-toggle="tab" class="js_link<?= array_key_first($m); ?> d-none nav-link<?php if ($tabs === 0) {
                            echo ' active';
                        } ?>"><?php $tabs++;
                            echo array_key_first($m);
                            ?></a>

                        <div role="tabpanel" class="tab-pane <?php if ($divs == $selectedData) {
                            echo 'active';
                        } ?>" id="tab<?php $divs++;
                        echo array_key_first($m) ?>">
                            <div id="">
<!--                                <h4 class="text-center">--><?php //echo (int)(array_key_first($m) + 1) ?>
<!--                                    DAYS(--><?php //echo (int)(array_key_first($m)) ?><!-- NIGHTS)</h4>-->
                                <di class="table-responsive">
                                    <table class="analitycs_table main_table table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th class="thead__title"> Period</th>
                                            <th> <div class="thead__title">Prices</div></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($m as $t): ?>
                                            <?php foreach ($t as $k => $d): ?>
                                                <tr>
                                                    <td><?php echo "<span class = 'default-text'>{$d[0]['start_date']} - {$d[0]['end_date']}</span>" ?></td>
                                                    <td><?php foreach ($d as $p) {
                                                            if ($p['own'] === '1') {
                                                                echo "<a class='default-text link_text' href='/stat/{$p['id']}' data-toggle=\"tooltip\" data-placement=\"top\" title='{$p['owner']}' target='_blank'><span class='text-success'>\${$p['price']}</span></a>, ";
                                                            } elseif ($p['id'] === '38') {
                                                                echo "<a class='default-text link_text' href='/stat/{$p['id']}' data-toggle=\"tooltip\" data-placement=\"top\" title='{$p['owner']}' target='_blank'><span class='text-danger'>\${$p['price']}</span></a>, ";
                                                            } else {
                                                                echo "<a class='default-text link_text' href='/stat/{$p['id']}' data-toggle=\"tooltip\" data-placement=\"top\" title='{$p['owner']}' target='_blank'>\${$p['price']}</a>, ";
                                                            }
                                                        } ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endforeach; ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                    <?php endforeach ?>
                        </div>

                </div>
            </div>
        </div>
    </div>

    </div>