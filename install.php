<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/style.css">
	<title>Установка</title>
<style>

</style>
</head>
<body class='body'>
<header class='header'>
	<span class='pname'>PHPipLogger</span>
	<div class='exit'><a href="index.php">Вход</a></div>
</header>

<div class="container">

<p>вапролфарфолрвдормиим рцралотмомтук длцмотфом фывм рдорфцраор фвыолраорршгрцшура ршршрцфурашрррг</p>

</div>

<div class="container">

<div class="radio">
<fieldset class="radio">
	<legend>Установка базы</legend>
		<form method="post">
			<ul>	
				<li>
					<input class="radio" type='radio' name='sdb' value='idb'/>Установить новую базу данных
				</li>
				<li>
					<input class="radio" type='radio' name='sdb' value='itables'/>Установить только таблицы в существующую базу
				</li>
				<li>
					<input type="submit" name="submit" value="Установить" style="width:140px"/>
				</li>
			</ul>	
		</form>
</fieldset>
</div>

<div class="cipher">
<fieldset class="cipher">
	<legend>Шифрование пароля</legend>
		<form method="post">
			<label for="pass">Пароль:</label>
			<input class="logform" type="password" name="pass" placeholder="Пароль для шифрования" required='required'/>
			<input type="submit" name="submit" value="Зашифровать" style="width:140px"/>
		</form>
</fieldset>
</div>

<?php
//*** проверка нужна чтобы не шифровало пустую строку в браузере где не работает required в форме
if (isset($_POST['pass'])){ 
	if (empty($_POST['pass'])){
	//*** если переменная пуста ругаемся,иначе функция md5 шифрует пустую строку,required не даст передать пустую строку
		  $messCipher = '<div class="hpass">Введите пароль для шифрования!</div>';	
		  } else { //*** если не пустая шифруем и выводим содержимое переменной
		  $messCipher = '<div class="hpass"><span style="color:green;font-weight:bold;">'.md5($_POST['pass']). '</span> 	  
			    <p>Полученый выше код нужно подставить в переменную <b>$pass=\' \'</b> 
				которая находится в файле <b>index.php</b>, в этом же файле изменить переменную <b>$admin=\'admin\'</b>
				подставивши вашего пользователя.
				<br>Теперь можно зайти на страницу используя имяПользователя:вашПароль</p>
				</div>';
	}	
}
?>
<div class="messCipher">
<?php
if (isset($messCipher)){
	echo $messCipher;
}
?>
</div>



<div class="messDb">
<?php
//***служебные ошибки***
ini_set('display_errors',1);
error_reporting(E_ALL);

include 'dbpdo.php';
//require 'dbpdo.php';



function showTables($query){
	include 'dbpdo.php';
	if (!empty($db_name)){
		$descTable = $dbh->query($query);
		echo '<div class="hdb">';
		while($row = $descTable->fetch(PDO::FETCH_NUM)){
		   printf("<span style='color:blue'><b>%s:</b>  %s %s %s %s %s</span>\n<br>",
				   $row[0], $row[1], $row[2], $row[3], $row[4], $row[5]);
		}
		echo '</div>';
	}
}


//*** задаем переменные для запросов
$create_table = "CREATE TABLE `userip_log`(
				 `id` INT(10) NOT NULL AUTO_INCREMENT,
				 `ip` VARCHAR(15) NOT NULL,
				 `useragent` VARCHAR(255) NOT NULL,
				 `referrer` VARCHAR(255) NOT NULL,
				 `access_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
				 PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8";

$create_table_ipcount = "CREATE TABLE `ipcounter`(
						 `counter` INT(10) NOT NULL)
						 ENGINE=InnoDB DEFAULT CHARSET=utf8";

//try{

//*** выбор и вызов нужного действия
if (isset($_POST['sdb'])){
	echo '<div class="hdb"><b>Подключён к серверу бд:</b> <span style="color:blue">'.
	      $dbh->getAttribute(PDO::ATTR_CONNECTION_STATUS).'</span></div>';
	switch($_POST['sdb']){
		case 'idb':
			//*** создаем базу данных	
			$dbh->exec("CREATE DATABASE iplogger2 DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci");
			$errm = $dbh->errorInfo();
			$flag = true;
			if ($errm[1] == '1007'){ 
				echo '<div class="hdb"><span style="color:#800000">Ошибка создания базы данных '.$db_name.' : 
					  База данных уже существует! ERROR '.$errm[1].' ('.$dbh->errorCode().')</span></div>';
				$flag = false;
			} elseif ($errm[1] == '1044'){
				echo '<div class="hdb"><span style="color:#800000">Вы не можете создавать баззы данных! ERROR '.
				      $errm[1].' ('.$dbh->errorCode().')</span></div>';
				$flag = false;
			} elseif ($flag){
//				die("stop tables");//***!!!!!!!!!!
				echo '<div class="hdb">База данных <span style="color:green;font-weight:bold;">iplogger</span> успешно создана,
				      теперь можно внести название базы данных в переменную <b>$db_name</b> в файле <b>dbpdo.php</b></div>';
				//*** выбираем для установки таблиц свежесозданую бд
				$dbh->exec('use iplogger2');

				//$dbuse = $dbh->query('select database()')->fetch();
				//echo '<div class="hdb"><b>Используется база данных: <span style="color:green;">'.
					  /*$dbuse['database()'].'</b></span></div>';*/

				//*** собственно создаем таблицы в новой базе
				$dbh->exec($create_table);
				$dbh->exec($create_table_ipcount);
				$dbh->exec("INSERT INTO ipcounter (counter) value ('0')");
			//	$showTable = $dbh->query('show tables')->fetchAll(PDO::FETCH_NUM);
			//	echo '<div class="hdb"><b>Созданы таблицы:</b><span style="color:blue"> '.
			//		  $showTable[0][0].', '.$showTable[1][0].'</span></div><br>';
			}	
		break;
		case 'itables':
//			$dbh->exec('use iplogger2'); //***!!!! TEST
			$dbuse = $dbh->query('select database()')->fetch();
			$flag = true;
			if (empty($dbuse['database()'])){
				echo '<div class="hdb"><span style="color:#800000">Не выбрана база данных, 
					  внесите названия нужной базы в файл <b>dbpdo.php</b></span></div>';
				$flag = false;
			} elseif($flag){
				echo '<div class="hdb"><b>Используется база данных: <span style="color:green;">'.
				      $dbuse['database()'].'</b></span></div>';

				
			//	die("STOP TABLES");
				//*** собственно создаем таблицы в новой базе
				$dbh->exec($create_table);
				//$dbh->exec("INSERT INTO ipcounter (counter) VALUE ('0')");
				$errm = $dbh->errorInfo();
				if ($errm['0'] == '42S01' ){
					echo '<div class="hdb"><span style="color:#800000">Таблица <b>userip_log</b> уже существует!</span></div>';
					$flag = false;
				}
				$dbh->exec($create_table_ipcount);
				$dbh->exec("INSERT INTO ipcounter (counter) value ('0')");
				$errm1 = $dbh->errorInfo();
				if ($errm1['0'] == '42S01' ){
					echo '<div class="hdb"><span style="color:#800000">Таблица <b>ipcounter</b> уже существует!</span></div>';
					$flag = false;
				}
				if ($flag){
					echo '<div class="hdb">Таблицы успешно добавлены!</div>';
				}
//				showTables('SHOW COLUMNS FROM userip_log');
			}
		break;
	}//end switch
}

/*} catch (PDOException $e){*/
	//echo 'exception';
	//echo "<pre>";
	//print_r($e);
	//echo "</pre>";
/*}*/

?>
</div>

</div><!-- end container -->
</body>
</html>
