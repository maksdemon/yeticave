<?php
require_once ('helpers.php');
require_once ('pages/test.php');
$categories_list = [
    'boards' => 'Доски и лыжи',
    'attachment' => 'Крепления',
    'boots' => 'Ботинки',
    'clothing' => 'Одежда',
    'tools' => 'Инструменты',
    'other' => 'Разное'
];

// Массив объявлений
$announcements_list = [
    [
        'name' => '2014 Rossignol District Snowboard',
        'category' => 'boards',
        'price' => 10999,
        'picture' => 'img/lot-1.jpg'
    ],
    [
        'name' => 'DC Ply Mens 2016/2017 Snowboard',
        'category' => 'boards',
        'price' => 159999,
        'picture' => 'img/lot-2.jpg'
    ],
    [
        'name' => 'Крепления Union Contact Pro 2015 года размер L/XL',
        'category' => 'attachment',
        'price' => 8000,
        'picture' => 'img/lot-3.jpg'
    ],
    [
        'name' => 'Ботинки для сноуборда DC Mutiny Charocal',
        'category' => 'boots',
        'price' => 10999,
        'picture' => 'img/lot-4.jpg'
    ],
    [
        'name' => 'Куртка для сноуборда DC Mutiny Charocal',
        'category' => 'clothing',
        'price' => 7500,
        'picture' => 'img/lot-5.jpg'
    ],
    [
        'name' => 'Маска Oakley Canopy',
        'category' => 'other',
        'price' => 5400,
        'picture' => 'img/lot-6.jpg'
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



