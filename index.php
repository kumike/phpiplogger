<?php
session_start();

//***служебные ошибки***
ini_set('display_errors',1);
error_reporting(E_ALL);

if (isset($_SESSION['admin'])){ //*** убирает нотисы про несуществующую переменную, хотя работает и без него
	if ($_SESSION['admin']){
		header('Location: admip.php');
		exit;
	}
}
$admin = 'admin'; //*** тут подставить вашего пользователя, по умолчанию admin
$pass = 'a029d0df84eb5549c641e04a9ef389e5'; //*** тут в кавычки вставить код полученый на станице hashPass

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/ipbot.css">
	<title><?php echo $_SERVER["PHP_SELF"];?></title>
</head>
<body class="body">
<?php 
if(isset($_POST['submit'])){
	if($admin == $_POST['user'] and $pass == md5($_POST['pass'])){
		$_SESSION['admin'] = $admin;
		header('Location: admip.php');
		exit;
	} else { //*** вывод ошибки подвигает вниз форму, как решить пока не придумал
		//echo "<div class='error'>Логин или пароль неверны!</div>\n";
		$errmess = "<div class='error'>Логин или пароль неверны!</div>\n";
	}
}
?>

<fieldset class="fieldset">
	<legend class="legend">Авторизация</legend>
	<form method="post">
		<label for="user" class="label">Имя:</label>
		<input class="input" type="text" name="user" placeholder="Имя пользователя" required='required'/><br>
		<label for="pass" class="label">Пароль:</label>
		<input class="input" type="password" name="pass" placeholder="Пароль" required='required'/><br>
		<input type="submit" name="submit" value="Вход" class="buttonSubmit"/>
	</form>
</fieldset>

<?php //*** какойто костыль получился, продолжить сюда блок елсе получилось но както через зад работало оно 
if (isset($errmess)){ //*** можно просто ехо, но есть нотисы,этот костыль убирает нотисы про несуществ переменную
	echo $errmess;
}
?>

</body>
</html>
