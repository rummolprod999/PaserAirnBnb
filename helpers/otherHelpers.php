<?php

function print_collapse_min_nights($min_nights, $id_row)
{
    ob_start();
    $iMax = count($min_nights);
    if ($iMax > 0) {
        for ($i = 0; $i < $iMax && $i <= 6; $i += 2) {
            echo "{$min_nights[$i]['date']} - {$min_nights[$i+1]['date']}: {$min_nights[$i+1]['min_nights']} nights;</br>";
        }
        if ($iMax > 8) {
            echo "<button class=\"btn btn-link\" data-toggle=\"collapse\" data-target=\"#collapse{$id_row}\" aria-expanded=\"false\" aria-controls=\"collapse{$id_row}\">Expand</button><div class=\"collapse\" id=\"collapse{$id_row}\">";
            for ($i = 8; $i < $iMax; $i += 2) {
                echo "{$min_nights[$i]['date']} - {$min_nights[$i+1]['date']}: {$min_nights[$i+1]['min_nights']} nights;</br>";
            }
            echo '</div>';
        }
    }
    return ob_get_clean();

}