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
                if(in_array($data[$c]['date'], $book_changes, true)){
                    echo "<td class=\"table-danger\"><font color=black>{$iValue[$j]}</font></br><font color=green>\${$data[$c]['price_day']}</font></td>";
                }

                elseif ($data[$c]['available'] === '1' && $data[$c]['bookable'] === '1' /* && $data[$c]['available_for_checkin'] == '1'  */) {
                    echo "<td class=\"table-success\"><font color=black>{$iValue[$j]}</font></br><font color=green>\${$data[$c]['price_day']}</font></td>";
                }

                else {
                    echo "<td>{$iValue[$j]}</br><font color=green>\${$data[$c]['price_day']}</font></td>";
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