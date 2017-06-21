<?php
session_start();
if($_SESSION['admin']){
	header("Location: admip.php");
	exit;
}

$admin = 'admin'; //*** тут подставить вашего пользователя, по умолчанию admin
$pass = 'a029d0df84eb5549c641e04a9ef389e5'; //*** тут в кавычки вставить код полученый на станице hashPass

if($_POST['submit']){
	if($admin == $_POST['user'] AND $pass == md5($_POST['pass'])){
		$_SESSION['admin'] = $admin;
		header("Location: admip.php");
		exit;
	}else echo '<div style="color:red;font-weight:bold;margin-left:-200px;">Логин или пароль неверны!</div>';
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/ipbot.css">
    <title><?php $title=$_SERVER['PHP_SELF']; echo $title;?></title>
</head>
<body class="body">
<script>
//***  Функция яваскрипт для смены стиля кнопки при наведении мышки
function classChange(styleChange,item){
   item.className=styleChange;
}
</script>
<fieldset class="fieldset">
<legend class="legend">Авторизация</legend>
<form method="post">
<label for="user" class="label">Имя:</label>
<input class="input" type="text" name="user" placeholder="Имя пользователя" required='required'/><br>
<label for="pass" class="label">Пароль:</label>
<input class="input" type="password" name="pass" placeholder="Пароль" required='required'/><br>
    <input type="submit" name="submit" value="Вход" class="buttonSubmit" style="width:75px;"
     onMouseOver="classChange('buttonSubmitRoll',this)" 
     onMouseOut="classChange('buttonSubmit',this)" />
</form>
</fieldset>
</body>
</html>
