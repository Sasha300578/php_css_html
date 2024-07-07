<?php
require_once('connect.php');
mysql_query('SET NAMES utf8');
mysql_query('use hospital');

$child_pole = $_POST['child_pole'];
$child_weight = $_POST['child_weight'];
$child_height = $_POST['child_height'];
$child_birthday = $_POST['child_birthday']; // Получение даты рождения из формы
$mother_id = $_POST['mother_id'];
$doctor_id = $_POST['doctor_id'];

// Проверка формата даты
if (!$child_birthday || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $child_birthday)) {
    die('Дата рождения предоставлена в некорректном формате. Ожидается формат YYYY-MM-DD.');
}

// Формирование запроса на вставку
$insert_child = "INSERT INTO Children (pole, weight, height, birthday, ID_mother, ID_doctor) VALUES ('$child_pole', '$child_weight', '$child_height', '$child_birthday', '$mother_id', '$doctor_id')";
$result = mysql_query($insert_child);

if ($result) {
    echo "Новая запись успешно добавлена.";
} else {
    echo "Ошибка добавления записи: " . mysql_error();
}

echo "<br><a href='main.php'><button>Вернуться назад</button></a>";
?>
