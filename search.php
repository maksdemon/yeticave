<?php
require_once ('config/session.php');
require_once ('helpers.php');
require_once ('config/config.php');
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
//$sqllots = "SELECT * FROM lots LIMIT 6 OFFSET 0";
//$resultlots  = mysqli_query($con, $sqllots);
//$announcements_list = mysqli_fetch_all($resultlots , MYSQLI_ASSOC);
$search = $_GET['q'] ?? '';



$cur_page = $_GET['id'] ?? 1;
$page_items = 6;
if (empty($search)){
    $result = mysqli_query($con, "SELECT COUNT(*) as cnt FROM lots");
}
else{
    $result = mysqli_query($con, "SELECT COUNT(*) as cnt FROM lots WHERE MATCH(lot_name, description_lot) AGAINST('$search') ");
}
echo $search;
$items_count = mysqli_fetch_assoc($result)['cnt'];
$pages_count = ceil($items_count / $page_items);
$offset = ($cur_page - 1) * $page_items;
$pages = range(1, $pages_count);
//$sql = 'SELECT * FROM lots '   . $page_items . ' OFFSET ' . $offset;
//$sqllots = 'SELECT * FROM lots ' . 'ORDER BY lot_name DESC LIMIT ' . $page_items . ' OFFSET ' . $offset;

$sqllots = 'SELECT * FROM lots ';
// Проверяем, был ли задан поисковый запрос
if (!empty($search)) {
    // Если да, добавляем условие полнотекстового поиска
    $sqllots .= "WHERE MATCH(lot_name, description_lot) AGAINST('$search') ";
    $result = mysqli_query($con, "SELECT COUNT(*) as cnt FROM lots WHERE MATCH(lot_name, description_lot) AGAINST('$search') ");
}

// Добавляем условие сортировки и лимитирования
$sqllots .= 'ORDER BY lot_name DESC LIMIT ' . $page_items . ' OFFSET ' . $offset;
// Теперь у вас есть полный SQL-запрос, который может содержать условие полнотекстового поиска в зависимости от значения $search
$resultlots  = mysqli_query($con, $sqllots);
$announcements_list = mysqli_fetch_all($resultlots , MYSQLI_ASSOC);

$search = $_GET['q'] ?? '';
$sqlsearch = "SELECT * FROM lots WHERE MATCH(lot_name,description_lot) AGAINST('$search')";
$resultsearch  = mysqli_query($con, $sqlsearch);
$searchq = mysqli_fetch_all($resultsearch , MYSQLI_ASSOC);




$page_content= include_template('search.php',
    [
    //    "categories" => $categories,
       "announcements_list"=>$announcements_list,
        // "lot" => $lot
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
        'search'=>$search
    ]);


print ($layout_content);