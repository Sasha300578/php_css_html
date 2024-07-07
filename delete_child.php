<?php
require_once('connect.php');
mysql_query('SET NAMES utf8');
mysql_query('use hospital'); 

if (!empty($_POST['child_id'])) {
    $child_id = $_POST['child_id'];
    $delete_query = "DELETE FROM Children WHERE ID = $child_id"; 
    $result = mysql_query($delete_query);

    if ($result) {
        echo "Запись успешно удалена.";
    } else {
        echo "Ошибка при удалении записи: " . mysql_error();
    }
} else {
    echo "Не выбрана запись для удаления.";
}

echo '<br><a href="main.php">Вернуться назад</a>'; 
?>
