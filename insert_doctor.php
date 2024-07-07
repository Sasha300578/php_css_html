<?php
require_once('connect.php');
mysql_query('SET NAMES utf8');
mysql_query('use hospital');

// Получаем данные из POST запроса
$doctor_surname = mysql_real_escape_string($_POST['doctor_surname']);
$doctor_name = mysql_real_escape_string($_POST['doctor_name']);
$doctor_secondName = mysql_real_escape_string($_POST['doctor_secondName']);

// Формируем и выполняем SQL запрос для добавления записи
$insert_query = "INSERT INTO Doctors (surname, name, secondName) VALUES ('$doctor_surname', '$doctor_name', '$doctor_secondName')";
$result = mysql_query($insert_query);

if ($result) {
    echo "Доктор успешно добавлен.";
} else {
    echo "Ошибка при добавлении доктора: " . mysql_error();
}

echo "<br><a href='main.php'>Вернуться на главную</a>";
?>
