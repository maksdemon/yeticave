<?php
session_start(); // Обязательно вызывать session_start() перед использованием сессий

// Проверяем, есть ли имя пользователя в сессии
if (isset($_SESSION['user_name'])) {
    $userName = $_SESSION['user_name'];
    echo "Добро пожаловать, $userName!";
} else {
    echo "Пользователь не авторизован.";
}