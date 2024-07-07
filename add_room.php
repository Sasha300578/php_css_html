<?php
require_once('connect.php');
mysql_query('SET NAMES utf8');
mysql_query('use hospital');
?>
<h2>Добавление комнаты</h2>
<form action="insert_room.php" method="post">
    Номер комнаты: <input type="number" name="room_number" required><br>
    <input type="submit" value="Добавить">
</form>