<?php //*** записывает айпи пришедшего на главную страницу в базу данных
$ip = $_SERVER['REMOTE_ADDR'];
if (!empty($_SERVER['HTTP_USER_AGENT'])){
	$usag = $_SERVER['HTTP_USER_AGENT'];
    } else { //*** если HTTP_USER_AGENT не пустой записываем значение переменной масива, если пуст пишем соопчение что неопределён
		$usag = "Броузер не определён .. :(";
	}
if (!empty($_SERVER['HTTP_REFERER'])){
    $ref = $_SERVER['HTTP_REFERER'];
	} else {
		$ref ="Реферер пустой .. :(";
	}
//*** Вставляем файл подключения к бд MySQL
require 'dbpdo.php';
//*** Формируем запрос на запись в базу        
$query = $dbh->prepare("INSERT INTO userip_log (ip, useragent, referrer) VALUES(:ip, :usag, :ref)");
$query->execute([':ip'=>$ip,':usag'=>$usag,':ref'=>$ref]);
//*** инкрементируем счётчик заходов на страничку
$dbh->exec("UPDATE ipcounter SET counter = counter+1");
?> 
