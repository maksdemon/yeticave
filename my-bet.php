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
$myrate ="SELECT 
    lots.*, 
    MAX(bets.price) AS max_betprice,
    (SELECT MAX(bet_date) FROM bets WHERE lot_id = lots.id AND user_id = 15) AS max_bet_date,
    bets.user_id AS betsuser, 
    categories.* 
FROM  
    lots 
LEFT JOIN  
    bets ON lots.id = bets.lot_id 
LEFT JOIN   
    categories ON categories.id = lots.category 
WHERE   
    bets.user_id = 15 
GROUP BY  
    lots.id;";
$resultmyrate = mysqli_query($con, $myrate);
$myratef = mysqli_fetch_all($resultmyrate, MYSQLI_ASSOC);
var_dump($myratef );



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
