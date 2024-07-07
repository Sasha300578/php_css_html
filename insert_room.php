<?php
require_once('connect.php');
mysql_query('SET NAMES utf8');
mysql_query('use hospital');

// Получаем данные из POST запроса
$room_number = intval($_POST['room_number']);

// Проверяем, существует ли уже комната с таким номером
$check_query = "SELECT number FROM Rooms WHERE number = '$room_number'";
$check_result = mysql_query($check_query);

if (mysql_num_rows($check_result) > 0) {
    echo "Комната с таким номером уже существует.";
} else {
    // Формируем и выполняем SQL запрос для добавления записи
    $insert_query = "INSERT INTO Rooms (number) VALUES ('$room_number')";
    $result = mysql_query($insert_query);

    if ($result) {
        echo "Комната успешно добавлена.";
    } else {
        echo "Ошибка при добавлении комнаты: " . mysql_error();
    }
}

echo "<br><a href='main.php'>Вернуться на главную</a>";
?>
