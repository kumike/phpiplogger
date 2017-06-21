<?php //*** записывает айпи пришедшего на главную страницу в базу данных
$ip0 = $_SERVER['REMOTE_ADDR'];
if(!empty($_SERVER['HTTP_USER_AGENT'])) {
	$usag = $_SERVER['HTTP_USER_AGENT'];
   }else {//*** если HTTP_USER_AGENT не пустой записываем значение переменной масива, если пуст пишем соопчение что неопределён
	   $usag = "Броузер не определён .. :(";
      }
if(!empty($_SERVER['HTTP_REFERER'])) {
   $ref = $_SERVER['HTTP_REFERER'];
	}else {
		$ref ="Реферер пустой .. :(";
		}
//*** Вставляем файл подключения к бд MySQL
require_once('db.php');        
//*** Формируем запрос на запись в базу        
$link->query("INSERT INTO userip_log (ip, useragent, referrer) VALUES('$ip0', '$usag', '$ref')");
//*** закрываем соединение с базой данных
$link->close();
?> 
