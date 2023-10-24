<?php
require_once ('helpers.php');
require_once ('pages/test.php');
/*
$con = mysqli_connect("localhost", "yeti", "mN2sB4oZ6c", "yeti");
mysqli_set_charset($con, "utf8");

*/
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
} else {
    $sql = "SELECT name_category, title FROM categories";
    $result = mysqli_query($con, $sql);
    if ($result) {
        $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        $error = mysqli_error($con);
    }
}

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
if ($id) {
    $sql = get_query_lot ($id);
} else {
    http_response_code(404);
    die();
}

$res = mysqli_query($con, $sql);
if ($res) {
    $lot = mysqli_fetch_assoc($res);
} else {
    $error = mysqli_error($con);
}


$id_lot=24;

function get_query_lot ($id_lot) {
    return "SELECT * FROM lots  JOIN categories ON lots.category=categories.name_category
    WHERE lots.id=$id_lot;";
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