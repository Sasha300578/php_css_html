<?php
require_once('connect.php');
mysql_query('SET NAMES utf8');
mysql_query('use hospital');

setlocale(LC_ALL, 'ru_RU', 'ru_RU.UTF-8', 'ru', 'russian');  

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $surname = mysql_real_escape_string($_POST['surname']);
    $name = mysql_real_escape_string($_POST['name']);
    $secondName = mysql_real_escape_string($_POST['secondName']);

    $sql = "SELECT 
        r.number AS 'Номер комнаты',
        CONCAT(m.surname, ' ', m.name, ' ', m.secondName) AS 'ФИО Матери',
        c.birthday AS 'Дата рождения'
    FROM 
        Children c
        JOIN Mothers m ON c.ID_mother = m.ID
        JOIN Doctors d ON c.ID_doctor = d.ID
        JOIN Rooms r ON m.room = r.ID
    WHERE 
        d.surname LIKE '%$surname%' AND 
        d.name LIKE '%$name%' AND 
        d.secondName LIKE '%$secondName%'
    ORDER BY r.number;";

    $result = mysql_query($sql);

    if ($result) {
        echo "<table border='1'>
            <tr>
                <th>ФИО Матери</th>
                <th>Номер комнаты</th>
                <th>Дата рождения ребенка</th>
            </tr>";
        while ($row = mysql_fetch_assoc($result)) {
			$formatted_date = strftime('%d %B %Y г.', strtotime($row['Дата рождения']));
            echo "<tr>
                <td>" . htmlspecialchars($row['ФИО Матери']) . "</td>
                <td>" . $row['Номер комнаты'] . "</td>
                <td>" . $formatted_date . "</td>
            </tr>";
        }
        echo "</table>";
    } else {
        echo "Ошибка при выполнении запроса: " . mysql_error();
    }
} else {
    echo "Пожалуйста, введите данные для поиска.";
}

echo "<br><a href='main.php'>Вернуться на главную страницу</a>";
?>
