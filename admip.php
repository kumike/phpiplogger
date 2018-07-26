<?php
//***служебные ошибки***
ini_set('display_errors',1);
error_reporting(E_ALL);

session_start();
if (isset($_GET['do']) and $_GET['do'] == 'logout'){
	unset($_SESSION['admin']);
	session_destroy();
}
if (!$_SESSION['admin']){
	header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>PHPipLogger</title>
	<link rel="stylesheet" href="css/style.css">   
</head>
<body class='body'>
<header class='header'>
	<span class='pname'>PHPipLogger</span>
	<div class='exit'><a href="admip.php?do=logout">Выход</a></div>
</header>

<?php 
//*** Вставляем файл подключения к бд MySQL
require 'dbpdo.php';
//*** Содержит GET-параметр из строки запроса. У первой страницы его не будет, и нужно будет вместо него подставить 0!!!
$start = isset($_GET['start']) ? intval( $_GET['start'] ) : 0 ;
//*** лимит для выборки строк с бд, отвечает за вывод строк таблицы на странице отчета бота
$limit = 5;

//*** запрос на выборку нужного количества строк в базе с лимитом выборки заданым выше
$result = $dbh->prepare("SELECT SQL_CALC_FOUND_ROWS * FROM userip_log LIMIT :start , :limit");
//*** биндим значения как цифры,если их передать масивом из ексекуте то берёт значения в кавычки вызывая ошибку синтаксиса
$result->bindValue(':start',$start,PDO::PARAM_INT);
$result->bindValue(':limit',$limit,PDO::PARAM_INT);
$result->execute();

//*** выводим таблицу с логом
echo "<div class='tableCenter'>
	  <table>
	  <caption>Айпи заходящих на главную страницу</caption>
	  <tbody>
	  <tr class='head'>
      <th class='id'>id</th>
      <th class='ip'>Айпи</th>
      <th class='ua'>Браузер агента</th>
      <th class='ref'>Реферер</th>
      <th class='dat'>Дата/время доступа</th>
	  </tr>\n";
while ($rowLog = $result->fetch()){
	echo "<tr class='body'>
	      <td class='id'>{$rowLog['id']}</td>
		  <td class='ip'>{$rowLog['ip']}</td>
   	      <td class='ua'>{$rowLog['useragent']}</td>	
          <td class='ref'>{$rowLog['referrer']}</td>	
          <td class='at'>{$rowLog['access_time']}</td>
	      </tr>\n";
}
echo "</tbody>
      </table>\n";

//*** подсчёт количество записей в базе,который записывается в масив count прямо в базе,и возвращается переменной в виде масива.
$result_found_rows = $dbh->query("SELECT FOUND_ROWS() as `count`")->fetch();
//*** показать количство записей в базе данных 
echo "<table class='allnum'>
	  <tbody>
      <tr class='alnumTrHead'>
      <th class='alnumThHead'>Всего записей:</th>
      </tr>
	  <tr class='alnumTrBody'>	
	  <td class='alnumTdBody'>{$result_found_rows['count']}</td>	
	  </tr>
	  </tbody>
	  </table>
	  </div>\n";
//*** начинаеться пагинатор TODO! дописать пагинатор так чтобы страницы выводил блоками в одну линию
//$allItems = 0;
	$html = NULL;
	$pageCount = 0;			
    //*** Здесь округляем в большую сторону, потому что остаток
    //*** от деления - кол-во страниц тоже нужно будет показать
    //*** на ещё одной странице.
    $pageCount = ceil($result_found_rows['count'] / $limit);
    //*** Начинаем с нуля! Это даст нам правильные смещения для БД
    for($i = 0;$i < $pageCount;$i++){
        //*** Здесь ($i * $limit) - вычисляет нужное для каждой страницы  смещение,
        //*** а ($i + 1) - для того что бы нумерация страниц начиналась с 1, а не с 0
        //*** если после ли поставить "\n". то возникает интересный глюк ефект в меню пагинатора
        $html .= '<a href="admip.php?start='.($i * $limit).'">'.($i + 1)."</a>";
    }
//*** Собственно выводим на экран:
echo '<div id="pagination">'.$html."</div>\n";

?>
</body>
</html>
