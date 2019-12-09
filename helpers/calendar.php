<?php

function print_calendar($data, $book_changes)
{
    ob_start();
    $currs = strtotime($data[0]['date']);
    echo '<div>' . date('F', $currs) . '</div>';
    $dayofmonth = date('t', $currs);

    $day_count = 1;
    $num = 0;

    for ($i = 0; $i < 7; $i++) {

        $dayofweek = date('w',

            mktime(0, 0, 0, date('m', $currs), $day_count, date('Y', $currs)));

        $dayofweek = $dayofweek - 1;

        if ($dayofweek == -1) {
            $dayofweek = 6;
        }


        if ($dayofweek == $i) {

            $week[$num][$i] = $day_count;

            $day_count++;

        } else {

            $week[$num][$i] = '';

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

    echo '<div class="table-responsive"><table class="table table-bordered">';
    $c = 0;
    foreach ($week as $iValue) {

        echo '<tr>';

        for ($j = 0; $j < 7; $j++) {

            if (!empty($iValue[$j])) {
                if (in_array($data[$c]['date'], $book_changes, true)) {
                    echo "<td class=\"table-danger\"><span class=\"text-dark\">{$iValue[$j]}</span></br><span class=\"text-success\">\${$data[$c]['price_day']}</span></td>";
                } elseif ($data[$c]['available'] === '1' && $data[$c]['bookable'] === '1'  /* && $data[$c]['available_for_checkin'] == '1'  */) {
                    echo "<td class=\"table-success\"><span class=\"text-dark\">{$iValue[$j]}</span></br><span class=\"text-success\">\${$data[$c]['price_day']}</span></td>";
                } elseif ($data[$c]['available'] === '1' /* && $data[$c]['bookable'] === '1'  && $data[$c]['available_for_checkin'] == '1'  */) {
                    echo "<td class=\"table-secondary\"><span class=\"text-dark\">{$iValue[$j]}</span></br><span class=\"text-success\">\${$data[$c]['price_day']}</span></td>";
                } else {
                    echo "<td>{$iValue[$j]}</br><span class=\"text-success\">\${$data[$c]['price_day']}</span></td>";
                }
                $c++;
            } else {
                echo '<td>&nbsp;</td>';
            }

        }

        echo '</tr>';

    }

    echo '</table></div>';
    return ob_get_clean();
}

function print_calendar_free($period)
{
    ob_start();
    $start = (new DateTime($period[0]['date']))->modify('first day of this month');
    $end = (new DateTime($period[count($period) - 1]['date']))->modify('first day of next month');
    $interval = DateInterval::createFromDateString('1 month');
    $per = new DatePeriod($start, $interval, $end);

    foreach ($per as $dt) {
        echo return_moths_calendar($dt, $period);
    }
    return ob_get_clean();
}

function return_moths_calendar($date, $period)
{
    ob_start();
    $currs = $date->getTimestamp();
    echo '<div>' . date('F', $currs) . '</div>';
    $dayofmonth = date('t', $currs);

    $day_count = 1;
    $num = 0;

    for ($i = 0; $i < 7; $i++) {

        $dayofweek = date('w',

            mktime(0, 0, 0, date('m', $currs), $day_count, date('Y', $currs)));

        $dayofweek = $dayofweek - 1;

        if ($dayofweek == -1) {
            $dayofweek = 6;
        }


        if ($dayofweek == $i) {

            $week[$num][$i] = $day_count;

            $day_count++;

        } else {

            $week[$num][$i] = '';

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

    echo '<div class="table-responsive"><table class="table table-bordered">';
    $c = 0;
    foreach ($week as $iValue) {

        echo '<tr>';

        for ($j = 0; $j < 7; $j++) {

            if (!empty($iValue[$j])) {
                $currday = $date->modify('first day of this month')->modify("{$c} day")->format('Y-m-d');
                $per = get_perid($currday, $period);
                if ($per !== null) {
                    echo "<td class=\"table-success\"><span class=\"text-dark\">{$iValue[$j]}</span></br><span class=\"text-success\">\${$per['price_day']}</span></td>";
                } else {
                    echo "<td>{$iValue[$j]}</br></br></td>";
                }
                $c++;
            } else {
                echo '<td>&nbsp;</td>';
            }

        }

        echo '</tr>';

    }

    echo '</table></div>';
    return ob_get_clean();
}

function get_perid($dt, $periods)
{
    foreach ($periods as $p) {
        if ($p['date'] === $dt) {
            return $p;
        }
    }
    return null;
}

function get_sum($periods)
{
    $sum = 0;
    foreach ($periods as $p) {
        $sum += (int)$p['price_day'];
    }
    return $sum;
}