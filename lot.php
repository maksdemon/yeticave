<?php
require_once ('helpers.php');
require_once ('pages/test.php');
/*
$con = mysqli_connect("localhost", "yeti", "mN2sB4oZ6c", "yeti");
mysqli_set_charset($con, "utf8");

*/
$title="test";
$con = mysqli_connect("localhost", "root", "", "yeticave");
mysqli_set_charset($con, "utf8");



if ($con == false) {
    print("Ошибка подключения: " . mysqli_connect_error());
}
else {
    print("Соединение установлено");
    // выполнение запросов
}

if (!$con) {
    $error = mysqli_connect_error();
    print("няма");
} else {
    $sql = "SELECT name_category, title FROM categories";
    $result = mysqli_query($con, $sql);
    if ($result) {
        $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        $error = mysqli_error($con);
    }
}
//$id =25;

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
print($id);

if ($id) {
    $sql = get_query_lot ($id);
} else {
    http_response_code(404);
    echo "<br>";
    echo ("няма");

}

$res = mysqli_query($con, $sql);
if ($res) {
    $lot = mysqli_fetch_assoc($res);
} else {
    $error = mysqli_error($con);
}


//var_dump($lot);

function get_query_lot ($id_lot) {
 return "SELECT * FROM lots  JOIN categories ON lots.category=categories.name_category
    WHERE lots.id=$id_lot;";

}





function get_time_left ($date) {
    date_default_timezone_set('Europe/Moscow');

    $final_date = date_create($date);
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





$page_content= include_template('main-lot.php',
[
    "categories" => $categories,
    "lot" => $lot

]);

$layout_content = include_template ('layout-lot.php',
['content'=>$page_content,
'title'=> 'тест',
'user_name' =>'mmm',
// 'name_user1' => $result_name_nick3
        "categories" => $categories
]);


print ($layout_content);