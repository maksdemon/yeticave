<?php
require_once ('helpers.php');
require_once ('pages/test.php');

$con = mysqli_connect("localhost", "root", "", "yeticave");
mysqli_set_charset($con, "utf8");

if ($con == false) {
    print("Ошибка подключения: " . mysqli_connect_error());
}
else {
    print("Соединение установлено");
    // выполнение запросов
}









$categories_list = [
    'boards' => 'Доски и лыжи',
    'attachment' => 'Крепления',
    'boots' => 'Ботинки',
    'clothing' => 'Одежда',
    'tools' => 'Инструменты',
    'other' => 'Разное'
];









$datetime = date_create('2023-08-12');
$datatest  = new DateTime();


$interval = date_diff( $datatest,$datetime);
//echo $interval->format('%a дней, %I min');

// Массив объявлений
$announcements_list = [
    [
        'name' => '2014 Rossignol District Snowboard',
        'category' => 'boards',
        'price' => 10999,
        'picture' => 'img/lot-1.jpg',
        'expiration date'=>'2023-08-14'
    ],
    [
        'name' => 'DC Ply Mens 2016/2017 Snowboard',
        'category' => 'boards',
        'price' => 159999,
        'picture' => 'img/lot-2.jpg',
        'expiration date'=>'2023-08-17'
    ],
    [
        'name' => 'Крепления Union Contact Pro 2015 года размер L/XL',
        'category' => 'attachment',
        'price' => 8000,
        'picture' => 'img/lot-3.jpg',
        'expiration date'=>'2023-08-12'
    ],
    [
        'name' => 'Ботинки для сноуборда DC Mutiny Charocal',
        'category' => 'boots',
        'price' => 10999,
        'picture' => 'img/lot-4.jpg',
        'expiration date'=>'2023-05-15'
    ],
    [
        'name' => 'Куртка для сноуборда DC Mutiny Charocal',
        'category' => 'clothing',
        'price' => 7500,
        'picture' => 'img/lot-5.jpg',
        'expiration date'=>'2023-09-15'
    ],
    [
        'name' => 'Маска Oakley Canopy',
        'category' => 'other',
        'price' => 5400,
        'picture' => 'img/lot-6.jpg',
        'expiration date'=>'2023-10-15'
    ]
];
$user_name ='mmm';

$page_content= include_template('main.php',
    ['categories_list'=> $categories_list,
    'announcements' => $announcements_list

]);

$layout_content = include_template ('layout.php',
    ['content'=>$page_content,
     'title'=> 'тест',
      'user_name' =>'mmm',
      // 'name_user1' => $result_name_nick3
        'categories_list'=> $categories_list,
    ]);


print ($layout_content);



