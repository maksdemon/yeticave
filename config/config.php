<?php
$title="test";
$con = mysqli_connect("localhost", "root", "", "yeticave");
mysqli_set_charset($con, "utf8");
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
if ($con == false) {
    print("Ошибка подключения: " . mysqli_connect_error());
}
else {
    //  print("Соединение установлено");
    // выполнение запросов
}