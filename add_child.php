<?php
require_once('connect.php');
mysql_query('SET NAMES utf8');
mysql_query('use hospital');
?>
<h2>Добавление информации о новорождённом</h2>
<form action="insert_child.php" method="post">
    Пол:<br>
    <input type="radio" name="child_pole" value="М" required> Мужской<br>
    <input type="radio" name="child_pole" value="Ж" required> Женский<br>
    Вес: <input type="text" name="child_weight" required><br>
    Рост: <input type="text" name="child_height" required><br>
    Дата рождения: <input type="date" name="child_birthday" required><br>
    Мать:
    <select name="mother_id">
        <?php
        $mothers_result = mysql_query("SELECT ID, CONCAT(surname, ' ', name, ' ', secondName) AS FullName FROM Mothers");
        while ($row = mysql_fetch_assoc($mothers_result)) {
            echo "<option value='" . $row['ID'] . "'>" . $row['FullName'] . "</option>";
        }
        ?>
    </select><br>
    Врач:
    <select name="doctor_id">
        <?php
        $doctors_result = mysql_query("SELECT ID, CONCAT(surname, ' ', name, ' ', secondName) AS FullName FROM Doctors");
        while ($row = mysql_fetch_assoc($doctors_result)) {
            echo "<option value='" . $row['ID'] . "'>" . $row['FullName'] . "</option>";
        }
        ?>
    </select><br>
    <input type="submit" value="Добавить">
</form>