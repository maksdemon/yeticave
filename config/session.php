<?php
session_start(); // Обязательно вызывать session_start() перед использованием сессий

// Проверяем, есть ли имя пользователя в сессии
if (isset($_SESSION['user_name'])) {
    $user_name = $_SESSION['user_name'];
    $user_id = $_SESSION['user_id'];
    //echo "Добро пожаловать, $user_name!";
    $is_auth = 1;
    if (isset($_GET['id'])) {
        // Получаем значение 'id' из параметра запроса
        $id = $_GET['id'];
        // Устанавливаем значение 'id' в сессию
        $_SESSION['id'] = $id;
        $id= $_SESSION['id'] ;

    }
} else {
  //  echo "Пользователь не авторизован.";
    $is_auth = 0;
    $user_name="";
}



