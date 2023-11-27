<?php

function get_time_left ($date) {
    date_default_timezone_set('Europe/Moscow');
    print_r($date );
    $final_date = date_create($date);
    $cur_date = date_create("now");
    print_r($cur_date  );

    if ($final_date > $cur_date) { // Заменил проверку на >
        $diff = date_diff($cur_date, $final_date); // Поменял местами даты здесь
        $format_diff = date_interval_format($diff, "%d %H %I");
        $arr = explode(" ", $format_diff);

        $hours = $arr[0] * 24 + $arr[1];
        $minutes = intval($arr[2]);
        $hours = str_pad($hours, 2, "0", STR_PAD_LEFT);
        $minutes = str_pad($minutes, 2, "0", STR_PAD_LEFT);

        return [$hours, $minutes];
    }

    return ['00', '00']; // Вернуть 00:00, если дата уже прошла
}
print_r(get_time_left('2023-05-15'));
