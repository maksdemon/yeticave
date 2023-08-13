<?php

function format_sum($amount) {
    // Округляем число до целого
    $rounded_amount = ceil($amount);

    // Если число меньше 1000, оставляем его без изменений
    if ($rounded_amount < 1000) {
        $formatted_amount = $rounded_amount;
    } else {
        // Если число больше 1000, отделяем пробелом три последних цифры от остальной части суммы
        $formatted_amount = number_format($rounded_amount, 0, '.', ' ');
    }

    // Добавляем знак рубля ₽ и возвращаем итоговую строку
    return $formatted_amount . ' ₽';
}

// Пример использования функции
//функция дат
function date_Limit ($date) {
    $datatest  = new DateTime();
    $datatest2 = date_format($datatest, 'Y-m-d');
    $interval = date_diff( $datatest,$date);
    $formattedInterval =$interval->format('%a дней, %I min');


    return $formattedInterval ;
}
//$datetime = date_create('2023-11-12');
//$result = date_Limit($datetime);
//echo $result;



function Timelimit($datetime)
{
    $datatest = new DateTime();
    $interval = date_diff($datatest, $datetime);
    $days = $interval->format('%a'); // Получаем количество дней
    $hours = $interval->format('%h') + $days * 24; // Добавляем дни к часам
    $minutes = $interval->format('%i');
    $hours =str_pad($hours,2,0,STR_PAD_LEFT);
    $minutes =str_pad($minutes,2,0,STR_PAD_LEFT);
    return array($hours, $minutes);
   // return array("[" . $hours . ", " . $minutes . "]");

}

//$datetime = date_create('2023-08-12 19:00');
//$result = Timelimit($datetime);

//echo "Часы: " . $result[0] . "<br/>";
//echo "Минуты: " . $result[1] . "<br/>";