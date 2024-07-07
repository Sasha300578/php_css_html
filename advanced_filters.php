<!DOCTYPE html>
<html>
<head>
  <title>Расширенные фильтры информации о роддоме</title>
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
  </style>
</head>
<body>
<h1>Расширенные фильтры</h1>

<h2>Поиск по фамилии матери</h2>
<form method="post">
  Фамилия матери: <input type="text" name="mother_surname" placeholder="Введите фамилию...">
  <input type="submit" name="search_by_mother_surname" value="Поиск">
</form>

<h2>Поиск по дате рождения ребенка</h2>
<form method="post">
  Дата рождения: <input type="date" name="child_birthday">
  <input type="submit" name="search_by_child_birthday" value="Поиск">
</form>

<h2>Сортировка по фамилии матерей</h2>
<form method="post">
  <input type="submit" name="sort_by_mother_surname" value="Сортировать">
</form>

<h2>Сортировка по датам рождения</h2>
<form method="post">
  <input type="submit" name="sort_by_child_birthday" value="Сортировать">
</form>

<h2>Поиск детей по весу выше указанного</h2>
<form method="post">
  Пороговый вес: <input type="text" name="weight_threshold" placeholder="Введите вес...">
  <input type="submit" name="search_by_weight" value="Поиск">
</form>

<h2>Список рожениц в одной палате</h2>
<form method="post">
  Номер палаты: <input type="text" name="room_number" placeholder="Введите номер палаты...">
  <input type="submit" name="search_by_room" value="Поиск">
</form>

<?php
require_once('connect.php');
mysql_query('SET NAMES utf8');
mysql_query('use hospital');

setlocale(LC_ALL, 'ru_RU', 'ru_RU.UTF-8', 'ru', 'russian');  

// Установка локальных настроек для корректного отображения русских дат
setlocale(LC_ALL, 'ru_RU.UTF-8');

function executeQuery($query) {
    $result = mysql_query($query);
    if (!$result) {
        echo "Ошибка выполнения запроса: " . mysql_error();
        return;
    }
    if (mysql_num_rows($result) > 0) {
        echo "<table><tr><th>ФИО Матери</th><th>Дата рождения</th><th>Вес</th><th>Рост</th><th>Номер палаты</th></tr>";
        while ($row = mysql_fetch_assoc($result)) {
				$formatted_date = strftime('%d %B %Y г.', strtotime($row['Дата рождения']));
            echo "<tr>
                  <td>{$row['ФИО Матери']}</td>
                  <td>{$formatted_date}</td>
                  <td>{$row['Вес']}</td>
                  <td>{$row['Рост']}</td>
                  <td>{$row['Номер палаты']}</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Нет результатов для отображения. Пожалуйста, измените критерии поиска.</p>";
    }
}


function executeQuery_search($query) {
    $result = mysql_query($query);
    if (!$result) {
        echo "Ошибка выполнения запроса: " . mysql_error();
        return;
    }
    if (mysql_num_rows($result) > 0) {
        echo "<table><tr><th>ФИО Матери</th><th>Дата рождения</th><th>ФИО Доктора</th><th>Номер палаты</th></tr>";
        while ($row = mysql_fetch_assoc($result)) {
            $formatted_date = strftime('%d %B %Y г.', strtotime($row['Дата рождения']));
            echo "<tr>
                  <td>{$row['ФИО Матери']}</td>
                  <td>{$formatted_date}</td>
                  <td>{$row['Фамилия Врача']} {$row['Имя Врача']} {$row['Отчество Врача']}</td>
                  <td>{$row['Номер палаты']}</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Нет результатов для отображения. Пожалуйста, измените критерии поиска.</p>";
    }
}

if (isset($_POST['search_by_mother_surname'])) {
    $surname = mysql_real_escape_string($_POST['mother_surname']); // Защита от SQL инъекции
    $query = "SELECT
    CONCAT(m.surname, ' ', m.name, ' ', m.secondName) AS 'ФИО Матери',
    c.birthday AS 'Дата рождения',
    c.weight AS 'Вес',
    c.height AS 'Рост',
    r.number AS 'Номер палаты'
    FROM Mothers m
    JOIN Children c ON m.ID = c.ID_mother
    JOIN Rooms r ON m.room = r.ID
    WHERE m.surname LIKE '%$surname%';";
    executeQuery($query);
}


if (isset($_POST['search_by_child_birthday'])) {
    $birthday = mysql_real_escape_string($_POST['child_birthday']); // Защита от SQL инъекции
    $query = "SELECT
    CONCAT(m.surname, ' ', m.name, ' ', m.secondName) AS 'ФИО Матери',
    c.birthday AS 'Дата рождения',
    c.weight AS 'Вес',
    c.height AS 'Рост',
    r.number AS 'Номер палаты'
    FROM Mothers m
    JOIN Children c ON m.ID = c.ID_mother
    JOIN Rooms r ON m.room = r.ID
    WHERE c.birthday = '$birthday';";
    executeQuery($query);
}



if (isset($_POST['sort_by_mother_surname'])) {
    $query = "SELECT
    CONCAT(m.surname, ' ', m.name, ' ', m.secondName) AS 'ФИО Матери',
    c.birthday AS 'Дата рождения',
    c.weight AS 'Вес',
    c.height AS 'Рост',
    r.number AS 'Номер палаты'
FROM
    Mothers m
JOIN
    Children c ON m.ID = c.ID_mother
JOIN
    Rooms r ON m.room = r.ID
ORDER BY
    m.surname;";
    executeQuery($query);
}

if (isset($_POST['sort_by_child_birthday'])) {
    $query = "SELECT
    CONCAT(m.surname, ' ', m.name, ' ', m.secondName) AS 'ФИО Матери',
    c.birthday AS 'Дата рождения',
    c.weight AS 'Вес',
    c.height AS 'Рост',
    r.number AS 'Номер палаты'
FROM
    Mothers m
JOIN
    Children c ON m.ID = c.ID_mother
JOIN
    Rooms r ON m.room = r.ID
ORDER BY
    c.birthday;";
    executeQuery($query);
}

if (isset($_POST['search_by_weight'])) {
    $weight = (float)$_POST['weight_threshold'];
    $query = "SELECT
    CONCAT(m.surname, ' ', m.name, ' ', m.secondName) AS 'ФИО Матери',
    c.birthday AS 'Дата рождения',
    c.weight AS 'Вес',
    c.height AS 'Рост',
    r.number AS 'Номер палаты'
FROM
    Mothers m
JOIN
    Children c ON m.ID = c.ID_mother
JOIN
    Rooms r ON m.room = r.ID
WHERE
    c.weight > $weight;";
    executeQuery($query);
}

if (isset($_POST['search_by_room'])) {
    $room = mysql_real_escape_string($_POST['room_number']);
    $query = "SELECT
    CONCAT(m.surname, ' ', m.name, ' ', m.secondName) AS 'ФИО Матери',
    c.birthday AS 'Дата рождения',
    d.surname AS 'Фамилия Врача',
    d.name AS 'Имя Врача',
    d.secondName AS 'Отчество Врача',
    r.number AS 'Номер палаты'
FROM
    Mothers m
JOIN
    Children c ON m.ID = c.ID_mother
JOIN
    Doctors d ON m.ID_doctor = d.ID
JOIN
    Rooms r ON m.room = r.ID
WHERE
    r.number = $room;
";
    executeQuery_search($query);
}

echo '<br><a href="main.php">Вернуться назад</a>'
?>
</body>
</html>


