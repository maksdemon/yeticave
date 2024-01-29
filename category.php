<?php

require_once ('helpers.php');
require_once ('pages/test.php');
require_once ('config/session.php');
require_once ('config/config.php');

$errors=[];
$cateid=$_GET['idcat'] ?? 1;
if (!$con) {
    $error = mysqli_connect_error();
    print("няма бд");
} else {
    $sql = "SELECT name_category, title,id FROM categories";
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
WHERE bets.user_id = $user_id;
";
$cur_page = $_GET['idcat'] ?? 1;
$page_items = 6;
if (empty($search)){
    $result = mysqli_query($con, "SELECT COUNT(*) as cnt FROM lots WHERE lots.category=$cateid");
}
else{
    $result = mysqli_query($con, "SELECT COUNT(*) as cnt FROM lots WHERE lots.category=1  ");
}

$items_count = mysqli_fetch_assoc($result)['cnt'];
$pages_count = ceil($items_count / $page_items);
$offset = ($cur_page - 1) * $page_items;
$pages = range(1, $pages_count);


$sqllots = 'SELECT * FROM lots ';
$resultmyrate = mysqli_query($con, $myrate);
$myratef = mysqli_fetch_all($resultmyrate, MYSQLI_ASSOC);



$sqllot = "SELECT lots.*,categories.title, categories.id AS catid FROM lots JOIN categories  ON lots.category=categories.id WHERE lots.category=$cateid";
$resultlot = mysqli_query($con, $sqllot);
$lot = mysqli_fetch_all($resultlot , MYSQLI_ASSOC);

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

$page_content= include_template('lots.php',
    [
        //    "categories" => $categories,

         "lot" => $lot,
        "errors" =>$errors,
        // "addlot"=>$addlot
        'pages'=>$pages,
        'cur_page'   =>  $cur_page


    ]);

$layout_content = include_template ('layout-lot.php',
    ['content'=>$page_content,
        'title'=> 'тест',
        'user_name' => $user_name,
        'is_auth'=>$is_auth,
// 'name_user1' => $result_name_nick3
        "categories" => $categories,
      //  'search'=>$search
    ]);


print ($layout_content);