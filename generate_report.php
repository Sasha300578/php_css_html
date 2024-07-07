<?php
require_once('connect.php');
mysql_query('SET NAMES utf8');
mysql_query('use hospital');

function generateReport() {
    require_once('connect.php');
    mysql_query('SET NAMES utf8');
    mysql_query('use hospital');

    setlocale(LC_ALL, 'ru_RU.UTF-8');  
    $bom = "\xEF\xBB\xBF"; // BOM для UTF-8
    $output = "<html><head><meta charset='UTF-8'><title>Отчет о роженицах</title></head><body>";
    $output .= "<h1>Отчет о роженицах по палатам</h1>";
    $output .= "<table border='1'><tr><th>Номер комнаты</th><th>ФИО Матери</th><th>ФИО Врача</th><th>Дата рождения</th><th>Пол</th><th>Количество рожениц в палате</th></tr>";

    $query = "SELECT 
        r.number AS 'Номер комнаты',
        CONCAT(m.surname, ' ', m.name, ' ', m.secondName) AS 'ФИО Матери',
        CONCAT(d.surname, ' ', d.name, ' ', d.secondName) AS 'ФИО Врача',
        c.birthday AS 'Дата рождения',
        c.pole AS 'Пол',
        (SELECT COUNT(*) FROM Mothers m2 WHERE m2.room = r.ID) AS 'Количество рожениц в палате'
    FROM 
        Children c
        JOIN Mothers m ON c.ID_mother = m.ID
        JOIN Doctors d ON c.ID_doctor = d.ID
        JOIN Rooms r ON m.room = r.ID
    GROUP BY r.number, m.ID
    ORDER BY r.number;";

    $result = mysql_query($query);

    if ($result) {
        while ($row = mysql_fetch_assoc($result)) {
            $formatted_date = strftime('%d %B %Y г.', strtotime($row['Дата рождения']));
            $output .= "<tr><td>" . $row['Номер комнаты'] . "</td><td>" . htmlspecialchars($row['ФИО Матери']) . "</td><td>" . htmlspecialchars($row['ФИО Врача']) . "</td><td>" . $formatted_date . "</td><td>" . $row['Пол'] . "</td><td>" . $row['Количество рожениц в палате'] . "</td></tr>";
        }
    } else {
        echo "Ошибка при выполнении запроса: " . mysql_error();
        return;
    }
    $output .= "</table>";
    $output .= "<a href='main.php'>Вернуться на главную</a>";
    $output .= "</body></html>";

    // Сохраняем отчет в файл с BOM
    $filename = "report_" . date("Y-m-d_H-i-s") . ".html";
    file_put_contents($filename, $bom . $output);

    // Выводим результат и ссылку на файл отчета
    echo "Отчет создан успешно. <a href='$filename'>Открыть отчет</a><br>";
    echo "<a href='main.php'>Вернуться на главную</a>";
}

generateReport();
?>
