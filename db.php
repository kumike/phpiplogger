<?php 
//*** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера
$db_host = '127.0.0.1';
$db_user = 'root';
$db_pass = ',j,thrf';
$db_name = 'iplogger';

//*** Подключение к MySQL.
$link = new mysqli($db_host, $db_user, $db_pass, $db_name);
//*** проверка на подключение, если неудачно, вывести сообщение и умереть, если нормально молча работать дальше.
$link->connect_error ? die ("Немогу подключится: (" . $link->connect_errno . ") " . $link->connect_error) : '';
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
