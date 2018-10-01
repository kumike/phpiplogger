<?php 
//*** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера
$db_host = '127.0.0.1';
$db_user = 'root';
$db_pass = ',j,thrf';
//$db_name = 'iplogger';

#$db_name = 'ipbothoua';

/*$db_host = '';*/
//$db_user = '';
//$db_pass = '';
$db_name = 'iplogger';

try{
//	$opt = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];
//	$dbh = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8",$db_user,$db_pass,$opt);

	$dbh = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8",$db_user,$db_pass);
//	$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	$dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
	} catch (PDOException $e){
		echo "<div class='hdb'>Настройте подключение к базе данных в файле dbpdo.php</div>\n</div>\n</div>\n</body>\n</html>";
}
?>
