<?php
require_once('connect.php');
mysql_query('SET NAMES utf8');
mysql_query('use hospital');

$child_pole = $_POST['child_pole'];
$child_weight = $_POST['child_weight'];
$child_height = $_POST['child_height'];
$child_birthday = $_POST['child_birthday']; // ��������� ���� �������� �� �����
$mother_id = $_POST['mother_id'];
$doctor_id = $_POST['doctor_id'];

// �������� ������� ����
if (!$child_birthday || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $child_birthday)) {
    die('���� �������� ������������� � ������������ �������. ��������� ������ YYYY-MM-DD.');
}

// ������������ ������� �� �������
$insert_child = "INSERT INTO Children (pole, weight, height, birthday, ID_mother, ID_doctor) VALUES ('$child_pole', '$child_weight', '$child_height', '$child_birthday', '$mother_id', '$doctor_id')";
$result = mysql_query($insert_child);

if ($result) {
    echo "����� ������ ������� ���������.";
} else {
    echo "������ ���������� ������: " . mysql_error();
}

echo "<br><a href='main.php'><button>��������� �����</button></a>";
?>
