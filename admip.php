<?php require_once ("auth.php");?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title><?php $title=$_SERVER['PHP_SELF']; echo $title;?></title>
<link rel="stylesheet" href="css/ipbot.css">
</head>
<body>
<h1>PHPipbot</h1>

<hr/>

<!-- кнопка выхода из сесии admin для phpipbot -->
<!--<p><a href="<?php $path = pathinfo($_SERVER['PHP_SELF']); echo $path['dirname'];?>/admip.php?do=logout">Выход</a></p>-->
<p><a href="admip.php?do=logout">Выход</a></p>
<!-- -->

<!-- -->

<?php 
//*** Вставляем файл подключения к бд MySQL
require_once('db.php');
//*** Содержит GET-параметр из строки запроса. У первой страницы его не будет, и нужно будет вместо него подставить 0!!!
$start = isset($_GET['start']) ? intval( $_GET['start'] ) : 0 ;
//*** лимит для выборки строк с бд, отвечает за вывод строк таблицы на странице отчета бота
$limit = 5;
//*** запрос на подсчёт количества строк в базе с лимитом выборки заданым выше
$result = $link->query("SELECT SQL_CALC_FOUND_ROWS * FROM userip_log LIMIT $start , $limit") or die("Query failed: " . $link->error);
//*** Составляем запрос на подсчёт количество записей в базе, который записывается в масив count прямо в базе, и возвращается переменной в виде масива.
$result_found_rows = $link->query("SELECT FOUND_ROWS() as `count`") or die("немогу сделать запрос2 :( : " . $link->error);

echo "<br>";
//echo '<div style="float: left; ">';
echo '<table style="width: 800px; font-family: Verdana,Geneva,Arial,Helvetica,sans-serif; border: 1px solid #AAAAAA; font-size: 12px; box-shadow: 10px 10px 5px #777777; ">' . "\r\n";
echo '<caption style="background-color:#FFFFF0; font-weight:bold; border:1px solid #BBBBBB; border-top-left-radius:8px; border-top-right-radius:8px;">Айпи заходящих на главную страницу <br /></caption>' . "\r\n";
echo '<tbody>' . "\r\n";

echo '<tr style="background-color: #FFFFF0; border: 1px solid #EEEEEE;">'."\n".
     '<th style="width: 5%; border: 1px solid #EEEEEE;">id</th>'."\n".
     '<th style="width: 20%; border: 1px solid #EEEEEE;">Айпи</th>'."\n".
     '<th style="width: 60%; border: 1px solid #EEEEEE;">Браузер агента</th>'."\n".
     '<th style="width: 60%; border: 1px solid #EEEEEE;">Реферрер</th>'."\n".
     '<th style="width: 15%; border: 1px solid #EEEEEE;">Дата/время доступа </th>'."\n";
echo '</tr>' . "\r\n";

while ($row = $result->fetch_assoc()) {
	echo '<tr style="background-color:#F0F0F0;">';
	echo '<td style="text-align:center; padding:4px 4px 4px 4px;">' . $row['id'] . '</td>';
	echo '<td style="text-align:left; padding:4px 20px 4px 20px;">' . $row['ip'] . '</td>';
   echo '<td style="text-align:left; padding:4px 10px 4px 10px;">' . $row['useragent'] . '</td>';	
	echo '<td style="text-align:left; padding:4px 10px 4px 10px;">' . $row['referrer'] . '</td>';	
	echo '<td style="text-align:left; padding:4px 20px 4px 20px;">' . $row['access_time'] . '</td>';
	echo '</tr>' . "\r\n";
//*** просто проверка значений в масиве для отладки
//$d = var_dump($row);
//echo "<pre>" . $d. "</pre>";
}
echo '</tbody>'.
     '</table>'."\n";

//*** подсчёт записей в базе данных 
echo '<table style="width: 150px; font-family: Verdana,Geneva,Arial,Helvetica,sans-serif; border: 1px solid #AAAAAA; font-size: 10px; box-shadow: 5px 5px 5px #777777; margin-top: 20px; ">' . "\r\n";
//echo '<caption style="background-color:#FFFFF0; font-weight:bold; border:1px solid #BBBBBB; border-top-left-radius:8px; border-top-right-radius:8px;">Айпи заходящих на главную страницу <br /></caption>' . "\r\n";
echo '<tbody>' . "\r\n";

echo '<tr style="background-color: #FFFFF0; border: 1px solid #EEEEEE;">';
echo '<th style="width: 100%; text-align: left; padding: 2px 2px 2px 2px; border: 1px solid #EEEEEE; ">Всего записей: </th>';
echo '</tr>' . "\r\n";

while ($row = $result_found_rows->fetch_assoc()) {
   echo '<tr style="background-color:#F0F0F0;">';	
	echo '<td style="text-align: right; padding: 4px 14px 4px 4px; font-weight: bold; ">' . $row['count'] . '</td>';	
	echo '</tr>' . "\r\n";
//$d0 = var_dump($result_found_rows);
//echo "<pre>" . $d0. "</pre>";
echo '</tbody>';
echo '</table>'."\n";
//echo '</div>';

//*** начинаеться пагинатор TODO! дописать пагинатор так чтобы страницы выводил блоками в одну линию
//$allItems = 0;
$html = NULL;
$pageCount = 0;			
    $rw = $row['count'];
    //*** Здесь округляем в большую сторону, потому что остаток
    //*** от деления - кол-во страниц тоже нужно будет показать
    //*** на ещё одной странице.
    $pageCount = ceil($rw / $limit);
    //*** Начинаем с нуля! Это даст нам правильные смещения для БД
    for( $i = 0; $i < $pageCount; $i++ ) {

        //*** Здесь ($i * $limit) - вычисляет нужное для каждой страницы  смещение,
        //*** а ($i + 1) - для того что бы нумерация страниц начиналась с 1, а не с 0
        //*** если перед ли поставить "\n". то возникает интересный глюк ефект в меню пагинатора
        $html .= '<li><a href="admip.php?start=' . ($i * $limit)  . '">' . ($i + 1).'</a></li>';
    }
}
//*** Собственно выводим на экран:
echo '<div id="art"><ul id="pagination">' . $html . '</ul></div>';
echo '<hr>';

//*** Закрываем соединение с базой
$link->close();

//*** определялка имени хоста с айпи и айпи из имени
//echo '<hr>';
if($_POST['submit']){
	$addr = $_POST['addres'];
	$name = $_POST['name'];
	}
$hostaddr = gethostbyaddr($addr);
$hostname = gethostbyname($name);
?>

<!-- <div style="float: right; "> -->
<form method="post"  style="width:600px;">
<fieldset>
<legend>&nbsp;Узнать имя по айпи адресу&nbsp;</legend>
   <input type="text" name="addres" />&nbsp;Имя хоста:&nbsp;&nbsp;<?php echo $hostaddr;?><br />
	<input type="submit" name="submit" value="ok" /><br />
</fieldset>
</form>

<form method="post" style="width:600px;">
<fieldset>
<legend>&nbsp;Узнать айпи адрес по имени&nbsp;</legend>
   <input type="text" name="name" />&nbsp;айпи хоста:&nbsp;&nbsp;<?php echo $hostname;?><br />
   <input type="submit" name="submit" value="ok" /><br />
</fieldset>
</form>
<!-- </div> -->

</body>
</html>
