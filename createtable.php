<?php
//*** Вставляем файл подключения к бд MySQL
require_once('db.php');
//*** формируемм запрос на добавление таблиц в базу
$create_table = "CREATE TABLE `userip_logtest`(
                 `id` INT(10) NOT NULL AUTO_INCREMENT,
                 `ip` VARCHAR(15) NOT NULL,
                 `useragent` VARCHAR(255) NOT NULL,
                 `referrer` VARCHAR(255) NOT NULL,
                 `access_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                 PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8";
//*** выбираем базу данных для вставки таблиц
//$link->select_db('ipbot0');
$link->query($create_table);
if($link->error) {
    echo "Таблица 'userip_log' уже существует: (" . $link->errno .") " . $link->error . "<br><hr>\n";
   // echo "Таблица 'userip_log' уже существует: ($link->errno) $link->error<br><hr>\n";
} else {
    echo "Таблица <b style='color:blue'>userip_log</b> успешно добавлена <br><hr>\n";
}
//*** добавляем таблицу счётчика
$create_table_ipcount = "CREATE TABLE `ipcounter`(
                         `counter` INT(10) NOT NULL)
                         ENGINE=InnoDB DEFAULT CHARSET=utf8";
$link->query($create_table_ipcount);
//*** проверка создались ли таблицы в базе
if($link->error) {
    echo "Таблица 'ipcounter' уже существует: (" . $link->errno .") " . $link->error . "<br><hr>\n";
   // echo "Таблица 'userip_log' уже существует: ($link->errno) $link->error<br><hr>\n";
} else {
    echo "Таблица <b style='color:blue'>ipcounter</b> успешно добавлена <br><hr>\n";
}

//*** отображение полей таблицы
$result = $link->query("SHOW COLUMNS FROM userip_logtest");
while($row = $result->fetch_row()){
    printf("<span style='color:blue'><b>%s:</b>  %s %s %s %s %s</span>\n<br />", $row[0], $row[1], $row[2], $row[3], $row[4], $row[5]);
}

//*** очищаем результирующий набор
$result->free();
//*** закрываем подключение к бд
$link->close();
echo "<hr>";
?>
