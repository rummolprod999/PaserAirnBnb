<?php

function print_calendar($data)
{
    ob_start();
    echo '<div>' . date('F') . '</div>';
    $dayofmonth = date('t');

    $day_count = 1;
    $num = 0;

    for ($i = 0; $i < 7; $i++) {

        $dayofweek = date('w',

            mktime(0, 0, 0, date('m'), $day_count, date('Y')));

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

    echo '<table class="table table-bordered">';
    $c = 0;
    foreach ($week as $iValue) {

        echo '<tr>';

        for ($j = 0; $j < 7; $j++) {

            if (!empty($iValue[$j])) {

                if ($data['days'][$c]['available'] == '1' && $data['days'][$c]['available_for_checkin'] == '1' && $data['days'][$c]['bookable'] == '1')

                    echo '<td class="table-success"><font color=red>' . $iValue[$j] . '</font></td>';

                else {
                    echo '<td>' . $iValue[$j] . '</td>';
                }
                $c++;
            } else {
                echo '<td>&nbsp;</td>';
            }

        }

        echo '</tr>';

    }

    echo '</table>';
    return ob_get_clean();
}