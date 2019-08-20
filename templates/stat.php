<?php require_once  'templates/navigation.php'?>
<div><h1 class="text-center">Статистика</h1></div>
<div id="article">
    <div><strong>Название апартаментов: </strong><?php if (isset($data['info_url']['apartment_name'])) {
            echo $data['info_url']['apartment_name'];
        } ?></div>
    <div><strong>Владелец: </strong><?php if (isset($data['info_url']['owner'])) {
            echo $data['info_url']['owner'];
        } ?></div>
    <div><strong>Ссылка: </strong><a target="_blank" href="<?php if (isset($data['info_url']['url'])) {
            echo $data['info_url']['url'];
        } ?>"><?php echo $data['info_url']['url'] ?></a></div>
    <div><strong>Минимальное количестов дней для
            заказа: </strong><?php if (isset($data['min_nights']['min_nights'])) {
            echo $data['min_nights']['min_nights'];
        } ?></div>
    <div class="container-fluid">
        <div class="row">
            <div class="py-4 col-xs-12 col-md-8">
                <div><p><strong>Доступность для заказа</strong></p></div>
                <?php
                if (isset($data['days'])):?>
                    <div><?php echo date('F')?></div>
                    <?php

                    $dayofmonth = date('t');

                    $day_count = 1;
                    $num = 0;

                    for ($i = 0; $i < 7; $i++) {

                        $dayofweek = date('w',

                            mktime(0, 0, 0, date('m'), $day_count, date('Y')));

                        $dayofweek = $dayofweek - 1;

                        if ($dayofweek == -1) $dayofweek = 6;


                        if ($dayofweek == $i) {

                            $week[$num][$i] = $day_count;

                            $day_count++;

                        } else {

                            $week[$num][$i] = "";

                        }

                    }

                    while (true) {

                        $num++;

                        for ($i = 0; $i < 7; $i++) {

                            $week[$num][$i] = $day_count;

                            $day_count++;

                            if ($day_count > $dayofmonth) break;

                        }
                        if ($day_count > $dayofmonth) break;

                    }

                    echo "<table border=1>";
                    $c = 0;
                    for ($i = 0; $i < count($week); $i++) {

                        echo "<tr>";

                        for ($j = 0; $j < 7; $j++) {

                            if (!empty($week[$i][$j])) {

                                if ($data['days'][$c]['available'] == '1' && $data['days'][$c]['available_for_checkin'] == '1' && $data['days'][$c]['bookable'] == '1')

                                    echo "<td><font color=red>" . $week[$i][$j] . "</font></td>";

                                else echo "<td>" . $week[$i][$j] . "</td>";
                                $c++;
                            } else echo "<td>&nbsp;</td>";

                        }

                        echo "</tr>";

                    }

                    echo "</table>"; ?>
                <?php endif; ?>
            </div>
            <div class="py-4 col-xs-6 col-md-4">
                <div><p><strong>Цена за минимальный период</strong></p></div>
                <div><strong>Период: </strong><?php if (isset($data['prices']['check_in'])) {
                        echo $data['prices']['check_in'];
                    } ?> - <?php if (isset($data['prices']['check_in'])) {
                        echo $data['prices']['check_out'];
                    } ?></div>
                <div><strong>Цена: </strong><?php if (isset($data['prices']['check_in'])) {
                        echo $data['prices']['price'];
                    } ?></div>
            </div>
        </div>
    </div>
</div>