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