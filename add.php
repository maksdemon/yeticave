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





$page_content= include_template('add_lot.php',
    [
        "categories" => $categories,
       // "lot" => $lot

    ]);

$layout_content = include_template ('layout-lot.php',
    ['content'=>$page_content,
        'title'=> 'тест',
        'user_name' =>'mmm',
// 'name_user1' => $result_name_nick3
        "categories" => $categories
    ]);


print ($layout_content);