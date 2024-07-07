<?php
require_once('connect.php');
mysql_query('SET NAMES utf8');
mysql_query('use hospital');
?>
<h2>Добавление доктора</h2>
<form action="insert_doctor.php" method="post">
    Фамилия: <input type="text" name="doctor_surname" required><br>
    Имя: <input type="text" name="doctor_name" required><br>
    Отчество: <input type="text" name="doctor_secondName" required><br>
    <input type="submit" value="Добавить">
</form>