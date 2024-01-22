<?php
require_once ('config/session.php');
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
    $form = $_POST;
    $errors = [];
    $required_fields = ['email', 'password'];
    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            $errors[$field] = 'Это поле обязательно для заполнения';
        }
    }
    if (empty($errors)){

        $email = mysqli_real_escape_string($con, $form['email']);
        $sql = "SELECT * FROM users WHERE user_email = '$email'";
        $res = mysqli_query($con, $sql);
        $user = $res ? mysqli_fetch_array($res, MYSQLI_ASSOC) : null;

        if (!count($errors) and $user) {
            if (password_verify($form['password'], $user['user_password'])) {
                $_SESSION['user_name'] = $user['user_name'];
                $_SESSION['user_id'] = $user['id'];
                header("Location: /index.php");
            }
            else {
                $errors['password'] = 'Неверный пароль';
            }
        }
        else {
            $errors['email'] = 'Такой пользователь не найден';
        }
    }


}


$page_content= include_template('login.php',
    [
        "categories" => $categories,
        "errors" =>$errors,
     //   "demo"=>$user['user_password']

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