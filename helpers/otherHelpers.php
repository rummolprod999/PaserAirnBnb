<?php

function print_collapse_min_nights($min_nights, $id_row)
{
    ob_start();
    $iMax = count($min_nights);
    echo "<div class='date_height default__date-trans' >";
    if ($iMax > 0) {
        for ($i = 0; $i < $iMax && $i <= 6; $i += 2) {
            echo "<p class='nightes_dates' > {$min_nights[$i]['date']} - {$min_nights[$i+1]['date']} </p> <p class='nightes_days'> {$min_nights[$i+1]['min_nights']} nights</p>";
        }
        if ($iMax > 8) {
//            echo "<button class=\"btn btn-link\" data-toggle=\"collapse\" data-target=\"#collapse{$id_row}\" aria-expanded=\"false\" aria-controls=\"collapse{$id_row}\">Expand</button><div class=\"collapse\" id=\"collapse{$id_row}\">";
            for ($i = 8; $i < $iMax; $i += 2) {
                echo "<p class='nightes_dates' > {$min_nights[$i]['date']} - {$min_nights[$i+1]['date']} </p> <p class='nightes_days'> {$min_nights[$i+1]['min_nights']} nights</p>";
            }
        }
    }
    echo "</div>";
    if($iMax > 4){
        echo "<button class='js_deploy_btn js_date btn_deploy btn btn-primary'>Expand</button>";
    }
    return ob_get_clean();

}