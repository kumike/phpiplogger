<?php require_once 'auth.php';?>
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
//***служебные ошибки***
ini_set('display_errors',1);
error_reporting(E_ALL);

//*** Вставляем файл подключения к бд MySQL
require_once 'db.php';
//*** Содержит GET-параметр из строки запроса. У первой страницы его не будет, и нужно будет вместо него подставить 0!!!
$start = isset($_GET['start']) ? intval( $_GET['start'] ) : 0 ;
//*** лимит для выборки строк с бд, отвечает за вывод строк таблицы на странице отчета бота
$limit = 5;
//*** запрос на подсчёт количества строк в базе с лимитом выборки заданым выше
$result = $link->query("SELECT SQL_CALC_FOUND_ROWS * FROM userip_log LIMIT $start , $limit") or die("Query failed: " . $link->error);

// *** !!!! это только для разработки, подключена старая база из хо.уа, для работы с записями, выше строка коректна для новой базы
#$result = $link->query("SELECT SQL_CALC_FOUND_ROWS * FROM ip0 LIMIT $start , $limit") or die("Query failed: " . $link->error);

//*** Составляем запрос на подсчёт количество записей в базе, который записывается в масив count прямо в базе, и возвращается переменной в виде масива.
$result_found_rows = $link->query("SELECT FOUND_ROWS() as `count`") or die("Немогу сделать запрос2: " . $link->error);

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
while ($rowLog = $result->fetch_assoc()) {
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

//*** 
$rowCount = $result_found_rows->fetch_assoc();
//*** подсчёт записей в базе данных 
echo "<table class='allnum'>
	  <tbody>
      <tr class='alnumTrHead'>
      <th class='alnumThHead'>Всего записей:</th>
      </tr>
	  <tr class='alnumTrBody'>	
	  <td class='alnumTdBody'>{$rowCount['count']}</td>	
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
    $pageCount = ceil($rowCount['count'] / $limit);
    //*** Начинаем с нуля! Это даст нам правильные смещения для БД
    for($i = 0;$i < $pageCount;$i++){
        //*** Здесь ($i * $limit) - вычисляет нужное для каждой страницы  смещение,
        //*** а ($i + 1) - для того что бы нумерация страниц начиналась с 1, а не с 0
        //*** если после ли поставить "\n". то возникает интересный глюк ефект в меню пагинатора
        $html .= '<a href="admip.php?start='.($i * $limit).'">'.($i + 1)."</a>";
    }
//*** Собственно выводим на экран:
echo '<div id="pagination">'.$html."</div>\n";

//*** Закрываем соединение с базой
$link->close();
?>
</body>
</html>
