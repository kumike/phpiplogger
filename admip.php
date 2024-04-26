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

$tableName = "userip_log";
$targetpage = "admip.php";
//*** количество отображаемых записей на странице
$limit = 6;
//*** количество страниц на пагинаторе до и после активной страницы до разрывов ...
$stages = 6;

//*** считаем общее количество записей в базе для вормировки количества страниц
$result = $dbh->query("SELECT COUNT(id) as num FROM $tableName");
$total_pages = $result->fetch(PDO::FETCH_ASSOC);
$total_pages = $total_pages['num'];

//*** назначаем переменной старт номер откуда начинать выборку данных на данную через гет страницу
if (empty($_GET['page'])){
	$_GET['page'] = 1;
}
$page = $_GET['page'];
$start = is_numeric($page) ? ($page - 1) * $limit : 0;

//*** тут дынные
$result = $dbh->prepare("SELECT * FROM $tableName LIMIT :start, :limit");
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
while ($rowLog = $result->fetch(PDO::FETCH_NUM)){
	echo "<tr class='body'>
	      <td class='id'>{$rowLog['0']}</td>
		  <td class='ip'>{$rowLog['1']}</td>
   	      <td class='ua'>{$rowLog['2']}</td>	
          <td class='ref'>{$rowLog['3']}</td>	
          <td class='at'>{$rowLog['4']}</td>
	      </tr>\n";
}
echo "</tbody>
      </table>\n";

//*** показать количство записей в базе данных 
echo "<table class='allnum'>
	  <tbody>
      <tr>
      <th class='alnumThHead'>Всего записей:   {$total_pages}</th>
      </tr>
	  </tbody>
	  </table>
	  </div>\n";

// Initial page num setup
if($page == 0 or !is_numeric($page)){
	$page = 1;
}
$prev = $page - 1;
$next = $page + 1;
$lastpage = ceil($total_pages/$limit);
$LastPagem1 = $lastpage - 1;

$paginate = '';
if($lastpage > 1){
	$paginate .= "<div class='paginate'>";

	//*** Previous
	$paginate.= $page > 1 ? "<a href='$targetpage?page=$prev'>Предидущая</a>" : "<span class='disabled'>Предидущая</span>";

	// Pages
	if($lastpage < 7 + ($stages * 2)){	// Not enough pages to breaking it up
		for($counter = 1; $counter <= $lastpage; $counter++){
			$paginate.= $counter == $page ? "<span class='current'>$counter</span>": "<a href='$targetpage?page=$counter'>$counter</a>";
		}
	}elseif($lastpage > 5 + ($stages * 2)){	// Enough pages to hide a few?
		// Beginning only hide later pages
		if($page < 1 + ($stages * 2)){
			for ($counter = 1; $counter < 4 + ($stages * 2); $counter++){
				$paginate.= $counter==$page?"<span class='current'>$counter</span>":"<a href='$targetpage?page=$counter'>$counter</a>";
			}
			$paginate.= "...";
			$paginate.= "<a href='$targetpage?page=$LastPagem1'>$LastPagem1</a>";
			$paginate.= "<a href='$targetpage?page=$lastpage'>$lastpage</a>";
		}
		// Middle hide some front and some back
		elseif($lastpage - ($stages * 2) > $page && $page > ($stages * 2)){
			$paginate.= "<a href='$targetpage?page=1'>1</a>";
			$paginate.= "<a href='$targetpage?page=2'>2</a>";
			$paginate.= "...";
			for ($counter = $page - $stages; $counter <= $page + $stages; $counter++){
				$paginate.= $counter==$page?"<span class='current'>$counter</span>":"<a href='$targetpage?page=$counter'>$counter</a>";
			}
			$paginate.= "...";
			$paginate.= "<a href='$targetpage?page=$LastPagem1'>$LastPagem1</a>";
			$paginate.= "<a href='$targetpage?page=$lastpage'>$lastpage</a>";
		}
		// End only hide early pages
		else{
			$paginate.= "<a href='$targetpage?page=1'>1</a>";
			$paginate.= "<a href='$targetpage?page=2'>2</a>";
			$paginate.= "...";
			for ($counter = $lastpage - (2 + ($stages * 2)); $counter <= $lastpage; $counter++){
				$paginate.= $counter==$page?"<span class='current'>$counter</span>":"<a href='$targetpage?page=$counter'>$counter</a>";
			}
		}
	}

	//*** Next
	$paginate.= $page < $counter - 1 ? "<a href='$targetpage?page=$next'>Следующая</a>" : "<span class='disabled'>Следующая</span>";

	$paginate.= "</div>";
}
//*** выводим строку пагинатора
echo $paginate;
?>

<div class="tableCenter">
<fieldset class="ipstackFieldset">
	<form class="ipstackForm" id='submit'>
		<input class="ipstackInput" type="text" id="ip" placeholder="IP или Доменное имя">
		<input class="ipstackButton" type="submit" value="Отправить">
	</form>
	<div id="loadResult"></div>
</fieldset>
</div>

<script src='js/ipstackAjax.js'></script>
</body>
</html>
