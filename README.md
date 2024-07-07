Сайт, написанный на PHP, CSS, HTML для работы с БД. 

Схема БД:

![image](https://github.com/Sasha300578/php_css_html/assets/113348429/3fdb8837-6698-4413-b3fb-459b58a93869)


Разворачивается при помощи Denwer.

Скрипт создания БД (БД создается в phpMyAdmin):

-- Создание базы данных
CREATE DATABASE IF NOT EXISTS hospital;
USE hospital;
 
-- Создание таблицы Doctors
CREATE TABLE IF NOT EXISTS Doctors (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    surname VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    secondName VARCHAR(255) NOT NULL
); 
 
-- Создание таблицы Rooms
CREATE TABLE IF NOT EXISTS Rooms (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    number INT NOT NULL
);
 
-- Создание таблицы Mothers
CREATE TABLE IF NOT EXISTS Mothers (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    surname VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    secondName VARCHAR(255) NOT NULL,
    ID_doctor INT,
    room INT,
    FOREIGN KEY (ID_doctor) REFERENCES Doctors(ID),
    FOREIGN KEY (room) REFERENCES Rooms(ID)
); 
 
-- Создание таблицы Children
CREATE TABLE IF NOT EXISTS Children (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    pole CHAR(1) NOT NULL,
    weight DECIMAL(5, 2) NOT NULL,
    height DECIMAL(5, 2) NOT NULL,
    birthday DATE NOT NULL,
    ID_mother INT,
    ID_doctor INT,
    FOREIGN KEY (ID_mother) REFERENCES Mothers(ID),
    FOREIGN KEY (ID_doctor) REFERENCES Doctors(ID)
);

Запускать с файла main.php

P.S. после  подготовки к разворачиванию, а именно установки локального сервера и создания БД не забудьте сменить креды в connect.php

Скриншоты сайта:

![image](https://github.com/Sasha300578/php_css_html/assets/113348429/77208803-248c-4c27-8550-e28e15b1b018)

<img width="673" alt="image" src="https://github.com/Sasha300578/php_css_html/assets/113348429/b003ae71-3a7c-4c61-a698-ed507dcb5cef">

<img width="563" alt="image" src="https://github.com/Sasha300578/php_css_html/assets/113348429/077d37bf-c705-4bbb-bbf7-04f257beb164">

![image](https://github.com/Sasha300578/php_css_html/assets/113348429/019142e4-1226-4f5c-8281-ffaa8f7c4d1d)

![image](https://github.com/Sasha300578/php_css_html/assets/113348429/ea7681e8-21d8-435c-850c-867c07daa35b)

![image](https://github.com/Sasha300578/php_css_html/assets/113348429/9c3eed6a-1b84-40af-b788-839e8ba8908d)

![image](https://github.com/Sasha300578/php_css_html/assets/113348429/dee524be-82ac-4f11-ae8d-d98f90fd61c0)

![image](https://github.com/Sasha300578/php_css_html/assets/113348429/9165f663-8619-4533-9673-6585f1011318)




