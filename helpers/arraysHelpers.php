<?php


function group_array($arr)
{
    $group = [];
    foreach ($arr as $item) {
        if (!isset($group[$item['date_parsing']])) {
            $group[$item['date_parsing']] = [];
        }
        foreach ($item as $key => $value) {
            if ($key === 'date_parsing' || $key === 'price') {
                continue;
            }
            $group[$item['date_parsing']][] = [$value, $item['price']];
        }
    }
    return $group;
}