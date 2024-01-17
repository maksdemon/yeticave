<?
session_start();
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

$value1="";
$value3="";
$value4="";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $addlot = $_POST;
    $value1 = $addlot['email'];
    $value2 = $addlot['password'];
    $value3 = $addlot['name'];
    $value4 = $addlot['message'];

    $required_fields = ['email', 'password', 'name', 'message'];

    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            $errors[$field] = 'Это поле обязательно для заполнения';
        }
    }


    if (!empty($value1) && filter_var($value1, FILTER_VALIDATE_EMAIL)) {
        $sql="SELECT id FROM users WHERE user_email = '$value1'";
        $res = mysqli_query($con, $sql);
        if (mysqli_num_rows($res) > 0) {
            $errors['email'] = 'Пользователь с этим email уже зарегистрирован';
        }else{
            $value1 = $addlot['email'];
        }


    } else {
        $errors['email'] = 'Введите корректный адрес электронной почты';
        $value1="";
    }
    if (!empty($value3)) {
        $value3 = $addlot['name'];
    } else {
        $errors['name'] = 'укажите имя';
        $value3="";
    }
    if (!empty($value4)) {
        $value4 = $addlot['message'];
    } else {
        $errors['message'] = 'укажите имя';
        $value4="";
    }


    if (!empty($value2)) {
        // Проверка минимальной длины пароля
        if (strlen($value2) >= 8) {
            // Проверка, что пароль состоит только из латинских букв
            if (ctype_alpha($value2)) {
                // Пароль удовлетворяет всем условиям
                // Ваш код для дальнейших действий, например, сохранение в базу данных
                $value2=password_hash($value2, PASSWORD_DEFAULT);
            } else {
                $errors['password'] = 'Пароль должен содержать только латинские буквы';
            }
        } else {
            $errors['password'] = 'Пароль должен содержать минимум 8 символов';
        }
    } else {
        $errors['password'] = 'Введите пароль';
    }



    if (empty($errors)) {
        $sqladd = "INSERT INTO users (user_email,user_password,user_name,contact) VALUES
                          ( '$value1','$value2','$value3','$value4');";
        $statement = db_get_prepare_stmt($con, $sqladd);
//// Выполняем запрос
        $statement->execute();
        if ($statement) {
            $lastInsertedId = mysqli_insert_id($con);
            header("Location: /auth.php");
            exit();
        }
    }
}


$page_content= include_template('auth.php',
    [
        "categories" => $categories,
        "errors" =>$errors,
        "email"=>$value1,
       "name1"=>$value3,
       "message"=>$value4

    ]);

$layout_content = include_template ('layout-lot.php',
    ['content'=>$page_content,
        'title'=> 'тест',
        'user_name' =>'mmm',
// 'name_user1' => $result_name_nick3
        "categories" => $categories,

    ]);


print ($layout_content);