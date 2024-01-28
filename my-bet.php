<?php
require_once ('helpers.php');
require_once ('pages/test.php');
require_once ('config/session.php');
require_once ('config/config.php');
$title="test";
$error=[];
if (!$con) {
    $error = mysqli_connect_error();
    print("няма бд");
} else {
    $sql = "SELECT name_category, title FROM categories";
    $result = mysqli_query($con, $sql);
    if ($result) {
        $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        $error = mysqli_error($con);
    }
}
//лоты пользователя и лоты со ставками
$myrate ="SELECT lots.*, bets.*, bets.price AS betprice, bets.user_id AS betsuser, categories.* 
FROM lots 
    LEFT JOIN bets ON lots.id = bets.lot_id 
    LEFT JOIN categories ON categories.id = lots.category 
WHERE bets.user_id = 15;
";
$resultmyrate = mysqli_query($con, $myrate);
$myratef = mysqli_fetch_all($resultmyrate, MYSQLI_ASSOC);
var_dump($myratef );

function getTimeAgomy1($betDate) {
    $currentTime = time(); // Текущее время в формате timestamp
    $betDateTimestamp = strtotime($betDate); // Время сделки в формате timestamp
    $timeDifference = $currentTime - $betDateTimestamp; // Разница в секундах
    // Вычисляем количество минут
    $minutesAgo = floor($timeDifference / 60);
    if ($minutesAgo < 60) {
        return "{$minutesAgo} минут назад";
    } else {
        // Если прошло больше 60 минут, вычисляем количество часов
        $hoursAgo = floor($minutesAgo / 60);
        $remainingMinutes = $minutesAgo % 60;
        return "{$hoursAgo} ч {$remainingMinutes} м";
    }
}
function getTimeAgomy ($date) {
    date_default_timezone_set('Europe/Moscow');
    $final_date = date_create($date);
    $cur_date = date_create("now");
    if ($final_date > $cur_date) { // Заменил проверку на >
        $diff = date_diff($cur_date, $final_date); // Поменял местами даты здесь
        $format_diff = date_interval_format($diff, "%d %H %I");
        $arr = explode(" ", $format_diff);
        $day =$arr[0];
        $hours = $arr[1];
        $minutes = intval($arr[2]);
        $hours = str_pad($hours, 2, "0", STR_PAD_LEFT);
        $minutes = str_pad($minutes, 2, "0", STR_PAD_LEFT);
        return [ $day ,$hours, $minutes];
    }
    return ['00', '00']; // Вернуть 00:00, если дата уже прошла
}



$page_content= include_template('my-bets.php',
    [
        "categories" => $categories,
        // "minutesAgo"=>$minutesAgo
        'is_auth'=>$is_auth,
        'myratef'=>$myratef,
        'error'=>$error
    ]);

$layout_content = include_template ('layout-lot.php',
    ['content'=>$page_content,
        'title'=> 'тест',
        'user_name' => $user_name,
        'is_auth'=>$is_auth,
        "categories" => $categories
    ]);
print ($layout_content);
