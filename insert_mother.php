<?php
require_once('connect.php');
mysql_query('SET NAMES utf8');
mysql_query('use hospital');

// Получаем данные из POST запроса
$mother_surname = mysql_real_escape_string($_POST['mother_surname']);
$mother_name = mysql_real_escape_string($_POST['mother_name']);
$mother_secondName = mysql_real_escape_string($_POST['mother_secondName']);
$mother_doctor_id = intval($_POST['mother_doctor_id']);
$mother_room = intval($_POST['mother_room']);

// Формируем и выполняем SQL запрос для добавления записи
$insert_query = "INSERT INTO Mothers (surname, name, secondName, ID_doctor, room) VALUES ('$mother_surname', '$mother_name', '$mother_secondName', '$mother_doctor_id', '$mother_room')";
$result = mysql_query($insert_query);

if ($result) {
    echo "Мать успешно добавлена.";
} else {
    echo "Ошибка при добавлении матери: " . mysql_error();
}

echo "<br><a href='main.php'>Вернуться на главную</a>";
?>
