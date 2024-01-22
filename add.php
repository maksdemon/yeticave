<?php
require_once ('helpers.php');
require_once ('pages/test.php');
require_once ('config/session.php');
/*
$con = mysqli_connect("localhost", "yeti", "mN2sB4oZ6c", "yeti");
mysqli_set_charset($con, "utf8");

*/
if (!$is_auth) {
    http_response_code(403); // Устанавливаем код ответа 403 Forbidden
    die("Доступ запрещен"); // Останавливаем выполнение скрипта
}

$title="test";
$con = mysqli_connect("localhost", "root", "", "yeticave");
mysqli_set_charset($con, "utf8");

if ($con == false) {
    print("Ошибка подключения: " . mysqli_connect_error());
}
else {
   // print("Соединение установлено");
    // выполнение запросов
}

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
//$id =25;

$errors=[];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $addlot=$_POST;
  //  var_dump($addlot);
    $required_fields = ['lot-name', 'category', 'message', 'lot-rate', 'lot-step', 'lot-date'];
    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            $errors[$field] = 'Это поле обязательно для заполнения';
        }
    }
    $addlot['picture'] = $_FILES['picture']['name'];
    $filename = uniqid() . '.jpg';
    move_uploaded_file($_FILES['picture']['tmp_name'], 'uploads/' . $filename);
    $value1 = $addlot['lot-name'];
    $value2 = $addlot['category'];
    $value3 =$addlot['message'];
    $value4 =$filename;
    $value5 =$addlot['lot-rate'];
    $value6 =$addlot['lot-step'];
    $value7 =$addlot['lot-date'];
    $value8 =$user_id;

    if (!is_numeric($value5) || $value5 <= 0) {
        $errors['lot-rate'] = 'Введите число больше нуля в поле "начальная цена"';
    }
    if (!ctype_digit($value6) || $value6 <= 0) {
        $errors['lot-step'] = 'Шаг должен быть больше 0"';
    }
    $allowed_formats = ['image/jpeg', 'image/jpg', 'image/png'];
    $addlot['picture']  = $_FILES['picture']['type']; // Извлекаем тип файла из массива $_FILES

    if (!in_array( $addlot['picture'] , $allowed_formats)) {
        // Здесь проводится проверка на допустимые форматы файлов
        $errors['picture'] = 'недопустимый формат изображения"';
    }

    if (empty($errors)) {
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

}


$page_content= include_template('add_lot.php',
    [
        "categories" => $categories,
       // "lot" => $lot
        "errors" =>$errors,
       // "addlot"=>$addlot
    ]);

$layout_content = include_template ('layout-lot.php',
    ['content'=>$page_content,
        'title'=> 'тест',
       'user_name' => $user_name,
        'is_auth'=>$is_auth,
// 'name_user1' => $result_name_nick3
        "categories" => $categories
    ]);


print ($layout_content);