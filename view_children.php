<!DOCTYPE html>
<html>
<head>
  <title>Главная страница - Информация о роддоме</title>
  <meta charset="utf-8">
  <style>
    table, th, td {
      border: 1px solid black;
      border-collapse: collapse;
    }
    th, td {
      padding: 8px;
      text-align: left;
    }
    a {
      display: block;
      margin-top: 20px;
    }
  </style>
</head>
<?php
require_once('connect.php');
mysql_query('SET NAMES utf8');
mysql_query('use hospital');

// Устанавливаем локаль для русского языка
setlocale(LC_ALL, 'ru_RU', 'ru_RU.UTF-8', 'ru', 'russian');  

$sql = "SELECT 
    c.ID AS 'ID Ребенка',
    CONCAT(d.surname, ' ', d.name, ' ', d.secondName) AS 'ФИО Врача',
    CONCAT(m.surname, ' ', m.name, ' ', m.secondName) AS 'ФИО Матери',
    c.pole AS 'Пол',
    c.weight AS 'Вес',
    c.height AS 'Рост',
	c.birthday AS 'Дата рождения',
    r.number AS 'Номер комнаты'
FROM 
    Children c
    JOIN Doctors d ON c.ID_doctor = d.ID
    JOIN Mothers m ON c.ID_mother = m.ID
    JOIN Rooms r ON m.room = r.ID;
";

$result = mysql_query($sql);

if (!$result) {
    exit("Ошибка выполнения запроса: " . mysql_error());
}

?>

<form method="post" action="delete_child.php">
  <table>
    <tr>
      <th></th> <!-- Для радио кнопок -->
      <th>ID Ребенка</th>
      <th>ФИО Врача</th>
      <th>ФИО Матери</th>
      <th>Пол</th>
      <th>Вес</th>
      <th>Рост</th>
      <th>Дата рождения</th>
      <th>Номер комнаты</th>
    </tr>

    <?php
    while ($row = mysql_fetch_assoc($result)) {
		$formatted_date = strftime('%d %B %Y г.', strtotime($row['Дата рождения']));
        echo "<tr>";
		echo "<td><input type='radio' name='child_id' value='" . $row['ID Ребенка'] . "'></td>";
        echo "<td>" . $row['ID Ребенка'] . "</td>";
        echo "<td>" . $row['ФИО Врача'] . "</td>";
        echo "<td>" . $row['ФИО Матери'] . "</td>";
        echo "<td>" . $row['Пол'] . "</td>";
        echo "<td>" . $row['Вес'] . "</td>";
        echo "<td>" . $row['Рост'] . "</td>";
        echo "<td>" . $formatted_date . "</td>";
        echo "<td>" . $row['Номер комнаты'] . "</td>";
        echo "</tr>";
    }
    ?>
  </table>
  <input type="submit" value="Удалить">
</form>

<?php
// Запросы для подсчета количества мальчиков и девочек
$sql_boys = "SELECT COUNT(*) AS boys_count FROM Children WHERE pole = 'М'";
$sql_girls = "SELECT COUNT(*) AS girls_count FROM Children WHERE pole = 'Ж'";

$result_boys = mysql_query($sql_boys);
$result_girls = mysql_query($sql_girls);

if (!$result_boys || !$result_girls) {
    echo "Ошибка при выполнении запроса подсчета: " . mysql_error();
} else {
    $boys_data = mysql_fetch_assoc($result_boys);
    $girls_data = mysql_fetch_assoc($result_girls);
    $boys_count = $boys_data['boys_count'];
    $girls_count = $girls_data['girls_count'];
}

// Выводим количество мальчиков и девочек
echo "<h2>Статистика роддома</h2>";
echo "<p>Количество мальчиков: $boys_count</p>";
echo "<p>Количество девочек: $girls_count</p>";
?>
<?php
echo '<br><a href="main.php">Вернуться назад</a>'
?>

</html>