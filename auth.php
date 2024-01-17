<?php
require_once ('helpers.php');
require_once ('config/config.php');


if (!$con) {
    $error = mysqli_connect_error();
    //print("няма");
} else {
    $sql = "SELECT name_category, title ,id FROM categories";
    $result = mysqli_query($con, $sql);
    if ($result) {
        $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        $error = mysqli_error($con);
    }
}




$page_content= include_template('login.php',
    [
        "categories" => $categories,


    ]);

$layout_content = include_template ('layout-lot.php',
    ['content'=>$page_content,
        'title'=> 'тест',
        'user_name' =>'mmm',
// 'name_user1' => $result_name_nick3
        "categories" => $categories,

    ]);


print ($layout_content);