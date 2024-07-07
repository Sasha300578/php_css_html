<?php
require_once('connect.php');
mysql_query('SET NAMES utf8');
mysql_query('use hospital');
?>
<h2>Добавление матери</h2>
<form action="insert_mother.php" method="post">
    Фамилия: <input type="text" name="mother_surname" required><br>
    Имя: <input type="text" name="mother_name" required><br>
    Отчество: <input type="text" name="mother_secondName" required><br>
    ID доктора:
    <select name="mother_doctor_id">
        <?php
        $doctors_result = mysql_query("SELECT ID, CONCAT(surname, ' ', name, ' ', secondName) AS FullName FROM Doctors");
        while ($row = mysql_fetch_assoc($doctors_result)) {
            echo "<option value='" . $row['ID'] . "'>" . $row['FullName'] . "</option>";
        }
        ?>
    </select><br>
    Номер комнаты:
    <select name="mother_room">
        <?php
        $rooms_result = mysql_query("SELECT ID, number FROM Rooms");
        while ($row = mysql_fetch_assoc($rooms_result)) {
            echo "<option value='" . $row['ID'] . "'>" . $row['number'] . "</option>";
        }
        ?>
    </select><br>
    <input type="submit" value="Добавить">
</form>