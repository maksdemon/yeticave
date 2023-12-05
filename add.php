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
    $sql = "SELECT name_category, title ,id FROM categories";
    $result = mysqli_query($con, $sql);
    if ($result) {
        $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        $error = mysqli_error($con);
    }
}
//$id =25;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $addlot=$_POST;
    //$filename = uniqid() . '.img';
    $addlot['picture'] = $_FILES['picture']['name'];
    $filename = uniqid() . '.jpg';
    move_uploaded_file($_FILES['picture']['tmp_name'], 'uploads/' . $filename);

    //header("Location: /index.php?success=true");

    $value1 = $addlot['lot-name'];
    $value2 = $addlot['category'];
    $value3 =$addlot['message'];
    $value4 =$addlot['picture'];
    $value5 =$addlot['lot-rate'];
    $value6 =$addlot['lot-step'];
    $value7 =$addlot['lot-date'];
    $value8 = 1;


    $sqladd="INSERT INTO lots (lot_name, category,description_lot,picture,price,step,expiration_date,user_id) VALUES
                           (  '$value1','$value2','$value3','$value4','$value5','$value6','$value7','$value8');";
    $statement = db_get_prepare_stmt($con, $sqladd);
    // Связываем параметры с их значениями
   // $statement->bindParam(':value1', $value1);
    //$statement->bindParam(':value2', $value2);
    //$statement->bindParam(':value3', $value3);
    //$statement->bindParam(':value4', $value4);
    //$statement->bindParam(':value5', $value5);
    //$statement->bindParam(':value6', $value6);
    //$statement->bindParam(':value7', $value7);
    //$statement->bindParam(':value8', $value8);
  //  "INSERT INTO lots (lot_name, category,description_lot,picture,price,step,expiration_date,user_id) VALUES (  'lot_name','category','description_lot','picture','5','6','7','8');";

 //   $stmt = db_get_prepare_stmt($link, $sqladd, $gif);
//    $res = mysqli_stmt_execute($stmt);
//// Выполняем запрос
   $statement->execute();

}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
}

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