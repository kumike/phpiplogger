<?php
session_start();

$admin = 'admin'; //*** тут подставить вашего пользователя, по умолчанию admin
$pass = '21232f297a57a5a743894a0e4a801fc3'; //'a029d0df84eb5549c641e04a9ef389e5'; //*** тут в кавычки вставить код полученый на станице hashPass

//***служебные ошибки***
ini_set('display_errors',1);
error_reporting(E_ALL);

//*** isset убирает нотисы про несуществующую переменную, хотя работает и без него
if (isset($_SESSION['admin']) and $_SESSION['admin']){
		header('Location: admip.php');
}

if(isset($_POST['submit'])){
	if($admin == $_POST['user'] and $pass == md5($_POST['pass'])){
		$_SESSION['admin'] = $admin;
		header('Location: admip.php');
	} else { //*** вывод ошибки подвигает вниз форму, как решить пока не придумал
		//echo "<div class='error'>Логин или пароль неверны!</div>\n";
		$errmess = "<div class='error'>Логин или пароль неверны!</div>\n";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/style.css">
	<title>Логин</title>
</head>
<body class="body">

<fieldset class="logform">
	<legend>Авторизация</legend>
	<form method="post">
		<label for="user">Имя:</label>
		<input class="logform" type="text" name="user" placeholder="Имя пользователя" required='required'/><br>
		<label for="pass">Пароль:</label>
		<input class="logform" type="password" name="pass" placeholder="Пароль" required='required'/><br>
		<input type="submit" name="submit" value="Вход"/>
	</form>
</fieldset>

<?php //*** какойто костыль получился, продолжить сюда блок елсе получилось но както через зад работало оно 
if (isset($errmess)){ //*** можно просто ехо, но есть нотисы,этот костыль убирает нотисы про несуществ переменную
	echo $errmess;
}
?>

</body>
</html>
