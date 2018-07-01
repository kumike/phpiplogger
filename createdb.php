<?php
//*** подключение выполняеться в ооп стиле, да и весь установщик базы написан в ооп
$link = new mysqli("127.0.0.1", "mishele", "1437");

//require_once('db.php');
//*** проверка подключения
if ($link->connect_error) {
    die('Ошибка подключения: (' . $link->connect_errno . ') ' . $link->connect_error);
   }
echo 'Соединение установлено: ' . $link->host_info . "\n<br>";
//*** формируем запрос для создания базы данных
$create_db = "CREATE DATABASE ipbot0 DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";
//*** сам запрос на создание базы в ооп стиле
$link->query($create_db); // or die(mysqli_error($link));
//*** проверка чи создалась база данных
if($link->error) { 
   die('Ошибка создания базы данных: ' . $link->error);
   }
echo "База данных ipbot успешно создана<br>\n";
//*** формируемм запрос на добавление таблиц в базу
$create_table = "create table staffip(id INT(10) NOT NULL AUTO_INCREMENT, 
                 ip VARCHAR(15) NOT NULL, 
                 useragent VARCHAR(255) NOT NULL, 
                 referrer VARCHAR(255) NOT NULL, 
                 time TIMESTAMP, 
                 PRIMARY KEY (id))";
//*** выбираем базу данных для вставки таблиц
$link->select_db('ipbot0');
$link->query($create_table);
//* проверка чи создались таблицы в базе
if ($link->error){
	die("Ошибка при добавлении таблицы: \n" . $link->error);
   }
echo "Таблица staffip успешно добавлена: <br><hr>\n";

//*** возвращаем имя текущей базы данных 
if ($result = $link->query("SELECT DATABASE()")){
    $row = $result->fetch_row();
    printf("Default database is %s.\n<br />", $row[0]);
    $result->close();
}

//*** просто тесты, не существенно
$result = $link->query("DESCRIBE staffip");
$row0 = $result->fetch_assoc();

$d = var_dump($row0);
echo "<pre>" . $d . "</pre><hr>";

echo "<hr>";

echo $row0['Field'] . "<br>" ;
echo $row0['Type'] . "<br>";
print_r($row['Null']) . "<br>";
print_r($row['Key']) . "<br>";
print_r($row['Default']) . "<br>";
print_r($row['Extra']) . "<br>";


//*** Закрываем соединение с базой
$link->close();
?>
