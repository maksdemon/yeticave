<?php
require_once ('config/session.php');
require_once ('helpers.php');
require_once ('config/config.php');
function format_sum($amount) {
    // Округляем число до целого
    $rounded_amount = ceil($amount);

    // Если число меньше 1000, оставляем его без изменений
    if ($rounded_amount < 1000) {
        $formatted_amount = $rounded_amount;
    } else {
        // Если число больше 1000, отделяем пробелом три последних цифры от остальной части суммы
        $formatted_amount = number_format($rounded_amount, 0, '.', ' ');
    }

    // Добавляем знак рубля ₽ и возвращаем итоговую строку
    return $formatted_amount . ' ₽';
}
$errors=[];


if (!$con) {
    $error = mysqli_connect_error();

} else {
    $sql = "SELECT name_category, title ,id FROM categories";
    $result = mysqli_query($con, $sql);
    if ($result) {
        $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        $error = mysqli_error($con);
    }
}
/*
function Timelimit($datetime)
{
    $datatest = new DateTime();

    $interval = date_diff($datatest, $datetime);
    $days = $interval->format('%a'); // Получаем количество дней
    $hours = $interval->format('%h') + $days * 24; // Добавляем дни к часам
    $minutes = $interval->format('%i');

    return array($hours, $minutes);
}
*/
function Timelimit ($datetime) {
    date_default_timezone_set('Europe/Moscow');
    if ($datetime instanceof DateTime) {
        $final_date = $datetime;
    } else {
        $final_date = date_create($datetime);
    }
    $cur_date = date_create("now");
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




/*
$sqllots = "   SELECT lots.id AS lotsid, lots.*, categories.*
FROM lots
JOIN categories ON lots.category = categories.name_category";*/
$sqllots = "SELECT * FROM lots LIMIT 6 ";
$resultlots  = mysqli_query($con, $sqllots);
$announcements_list = mysqli_fetch_all($resultlots , MYSQLI_ASSOC);
//var_dump($announcements_list);


$page_content= include_template('main.php',
    [
        "categories" => $categories,
        "announcements_list"=>$announcements_list,
        // "lot" => $lot
        "errors" =>$errors,
        // "addlot"=>$addlot
    ]);

$layout_content = include_template ('layout-lot.php',
    ['content'=>$page_content,
        'title'=> 'тест',
        'user_name' => $user_name,
        'is_auth'=>$is_auth,
// 'name_user1' => $result_name_nick3
        "categories" => $categories
    ]);


print ($layout_content);
