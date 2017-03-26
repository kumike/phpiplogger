<?php 
//*** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера
$db_host = ' ';
$db_user = ' ';
$db_pass = ' ';
$db_name = ' ';

//*** Подключение к MySQL, подключение написано в ооп стиле.
$link = new mysqli($db_host, $db_user, $db_pass, $db_name) or die("Could not connect: " . $link->connect_error);
//*** утанавливаем кодировку utf8 для вывода корректных русских символов        
$link->set_charset("utf8");


//*** проверка подключения для отладки
/*
if ($link->connect_error) {
    die('Ошибка подключения: (' . $link->connect_errno . ') ' . $link->connect_error);
   }
echo 'Соединение установлено: ' . $link->host_info . "\n<br>";
*/
?>
