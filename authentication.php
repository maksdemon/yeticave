<?php
require_once ('helpers.php');
require_once ('config/config.php');
$errors=[];
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
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $addlot=$_POST;
    $value1 = $addlot['email'];
    $value2 =$addlot['password'];
    $value3 =$addlot['name'];
    $value4 =$addlot['message'];

    $required_fields = ['email', 'password', 'name', 'message'];

    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            $errors[$field] = 'Это поле обязательно для заполнения';
        }
    }
    if (empty($_POST[$field])) {
        $errors[$field] = 'Это поле обязательно для заполнения';
    }
    if (!is_numeric($value1) || $value5 <= 0) {
        $errors['email'] = 'Это поле обязательно для заполнения"';
    }
    if (!ctype_digit($value2) || $value6 <= 0) {
        $errors['lot-step'] = 'Шаг должен быть больше 0"';
    }
    $allowed_formats = ['image/jpeg', 'image/jpg', 'image/png'];
    $addlot['picture']  = $_FILES['picture']['type']; // Извлекаем тип файла из массива $_FILES


    $sqladd="INSERT INTO lots (lot_name, category,description_lot,picture,price,step,expiration_date,user_id) VALUES
                           (  '$value1','$value2','$value3','$value4','$value5','$value6','$value7','$value8');";
    $statement = db_get_prepare_stmt($con, $sqladd);
//// Выполняем запрос
    $statement->execute();
    if ($statement) {
        $lastInsertedId = mysqli_insert_id($con);
        header("Location: /lot.php?id=$lastInsertedId");
        exit();
    }
}


var_dump($errors=[]);

$page_content= include_template('auth.php',
    [
        "categories" => $categories,
        "errors" =>$errors
    ]);

$layout_content = include_template ('layout-lot.php',
    ['content'=>$page_content,
        'title'=> 'тест',
        'user_name' =>'mmm',
// 'name_user1' => $result_name_nick3
        "categories" => $categories
    ]);


print ($layout_content);