<?php

function Timelimit($datetime)
{
    $datatest = new DateTime();

    $interval = date_diff($datatest, $datetime);
    $days = $interval->format('%a'); // Получаем количество дней
    $hours = $interval->format('%h') + $days * 24; // Добавляем дни к часам
    $minutes = $interval->format('%i');

    return array($hours, $minutes);
}

$datetime = date_create('2023-09-12 19:00');
$result = Timelimit($datetime);
echo "Часы: " . $result[0] . "<br/>";
echo "Минуты: " . $result[1] . "<br/>";
//print_r($result);
//$result =Timelimit(date_create('2023-08-12 19:00'));

//echo "Все: [" . $result[0] . ", " . $result[1] . "]<br/>";
//echo "Часы: " . $result[0] . "<br/>";
//print_r(Timelimit(date_create('2023-08-12 19:00')));
/*
//хороший код не трогать
function formatDateTimeAndInterval($datetime) {
    $datatest = new DateTime();

    $interval = date_diff($datatest, $datetime);
    $hours = $interval->format('%h');
    $minutes = $interval->format('%i');

    return array("[" . $hours . ", " . $minutes . "]");
}

$datetime = date_create('2023-08-12');
$result = formatDateTimeAndInterval($datetime);

echo "Все: " . $result[0] . "<br/>";
*/

/*
function formatDateTimeAndInterval($datetime) {
    $datatest = new DateTime();

    $interval = date_diff($datatest, $datetime);
    $formattedInterval = $interval->format('%a дней, %I мин');

    return array(

        'formattedInterval' => $formattedInterval
    );
}

$datetime = date_create('2023-08-12');
$result = formatDateTimeAndInterval($datetime);

echo $result['formattedInterval'];
*/
/*
 function date_Limit2 ($date) {
    $datatest  = new DateTime();
  //  $datatest2 = date_format($datatest, 'Y-m-d');
    $interval = date_diff( $datatest,$date);
    $formattedInterval = $interval->format('%a , %I');

    return $formattedInterval;
}
$datetime = date_create('2023-11-15');
$result = date_Limit2($datetime);
echo $result;
*/
/*
function date_Limit2($date) {
    $datatest = new DateTime();
    //  $datatest2 = date_format($datatest, 'Y-m-d');
    $interval = date_diff($datatest, $date);
    $formattedInterval = sprintf('%d , %02d', $interval->days, $interval->h);
    return $formattedInterval;
}

$datetime = date_create('2023-11-15');
$result = date_Limit2($datetime);
echo $result;
*/