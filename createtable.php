
<?php
//*** Вставляем файл подключения к бд MySQL
require_once('db.php');
//*** формируемм запрос на добавление таблиц в базу
$create_table = "create table staffip(id INT(10) NOT NULL AUTO_INCREMENT, 
                 ip VARCHAR(15) NOT NULL, 
                 useragent VARCHAR(255) NOT NULL, 
                 referrer VARCHAR(255) NOT NULL, 
                 time TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, 
                 PRIMARY KEY (id))";
//*** выбираем базу данных для вставки таблиц
//$link->select_db('ipbot0');
$link->query($create_table);
//*** проверка чи создались таблицы в базе
if($link->error) {
	die("Ошибка при добавлении таблицы: \n" . $link->error);
   }
echo "Таблица <b style='color:blue'>staffip</b> успешно добавлена <br><hr>\n";




//*** отображение полей таблицы
if ($result = $link->query("SHOW COLUMNS FROM staffip")) {
    while($row = $result->fetch_row()){
    printf("<span style='color:blue'><b>%s:</b>  %s %s %s %s %s</span>\n<br />", $row[0], $row[1], $row[2], $row[3], $row[4], $row[5]);
 } //*** очищаем результирующий набор
    $result->close();
}
$link->close();
echo "<hr>";




//*** закрываем подключение к бд
$link->close();
?>
