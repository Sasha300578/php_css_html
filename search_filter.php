<?php
require_once('connect.php');
mysql_query('SET NAMES utf8');
mysql_query('use hospital');
?>
<h2>Поиск рожениц по ФИО врача</h2>
<form action="filter.php" method="post">
    Фамилия врача: <input type="text" name="surname" required>
    Имя врача: <input type="text" name="name" required>
    Отчество врача: <input type="text" name="secondName" required>
    <input type="submit" value="Поиск">
</form>