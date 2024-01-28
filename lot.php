<?php
require_once ('helpers.php');
require_once ('pages/test.php');
require_once ('config/session.php');
require_once ('config/config.php');
$title="test";


if ($con == false) {
    print("Ошибка подключения: " . mysqli_connect_error());
}
else {
   // print("Соединение установлено");
}

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

$id=$_SESSION["id"];

var_dump($_SESSION);
//echo "page: " . $id . "<br>";
echo "page: " . $_SESSION["id"] . "<br>";

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

function getTimeAgo($betDate) {
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
        return "{$hoursAgo} часов и {$remainingMinutes} минут назад";
    }
}


function get_query_lot ($id_lot) {
 return "SELECT * FROM lots  JOIN categories ON lots.category=categories.id
    WHERE lots.id=$id_lot;";
}

$sqlbets="SELECT bets.*, users.*
FROM bets
JOIN users ON bets.user_id = users.id
WHERE bets.lot_id = $id";
$resultbets = mysqli_query($con, $sqlbets);
$betsrate = mysqli_fetch_all($resultbets, MYSQLI_ASSOC);

$maxprice ="SELECT bets.id,bets.bet_date,bets.user_id,bets.lot_id, lots.* , bets.price AS betprice FROM bets JOIN lots ON lots.id = bets.lot_id
                                                                                       WHERE bets.lot_id = $id ORDER BY bets.price DESC LIMIT 1";
$resultmax= mysqli_query($con, $maxprice);
$maxfin= mysqli_fetch_assoc( $resultmax);
if (!$maxfin) {
    $maxfin = array(); // Вернуть пустой массив, если нет результатов
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
$error=[];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cost = filter_input(INPUT_POST,"cost",FILTER_VALIDATE_INT);
  //  $cost=55;
    $max=$maxfin["betprice"];
    if (empty($cost)){
        $error="не заполнено";
    }
    else{
        if($cost>$max){
            $maxp = "INSERT INTO bets (price, user_id, lot_id) VALUES ($cost, $user_id,  {$_SESSION['id']})";
            $statement = db_get_prepare_stmt($con, $maxp);
            $statement->execute();
            header("Location: /lot.php?id=$id");
            $error=$cost;
            echo "cost: " . $cost . "<br>";

        }else{
            echo "error";
        }
    }
}

$page_content= include_template('main-lot.php',
[
    "categories" => $categories,
    "lot" => $lot,
    "betsrate"=> $betsrate,
   // "minutesAgo"=>$minutesAgo
    'is_auth'=>$is_auth,
    'maxfin'=>$maxfin,
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
