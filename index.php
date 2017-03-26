<?php
session_start();
if($_SESSION['admin']){
	header("Location: ../phpipbot/admip.php");
	exit;
}
$admin = 'admin';
$pass = 'a029d0df84eb5549c641e04a9ef389e5';
if($_POST['submit']){
	if($admin == $_POST['user'] AND $pass == md5($_POST['pass'])){
		$_SESSION['admin'] = $admin;
		header("Location: /phpipbot/admip.php");
		exit;
	}else echo '<div style="color:red;font-weight:bold;margin-left:-200px;">Логин или пароль неверны!</div>';
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
<style>
.body{
	padding-left:48%;
	padding-top:10%;
	font-family:Verdana,Arial,Helvetica,sans-serif;
	font-size:1em;
	color:#555753;
}
input{
	display:block;
	width:175px;
	float:left;
	margin-bottom:10px;
}
label{
	display:block;
	text-align:right;
	float:left;
	width:75px;
	padding-right:20px;
}
br{
	clear:left;
}
.buttonSubmit{
	color:white;
	background-color:#2E3436;
	font-size:1em;
	border:1px solid #2E3436;
	border-radius:5px 5px 5px 5px;
	width:75px;
	margin-left:95px;
}
.buttonSubmitRoll{
	color:white;
	background-color:#555753;
	font-size:1em;
	border:1px solid #2E3436;
	border-radius:5px 5px 5px 5px;
	width:75px;
	margin-left:95px;

}
fieldset{
	width:350px;
	margin-left:-200px;	
	border:none;
	background-color:#EEEEEE;/*#F6F6F6;*/
	box-shadow:15px 15px 10px #888;
	-moz-box-shadow:15px 15px 10px #888;
	-webkit-box-shadow:15px 15px 10px #888;
/*** -moz- и -webkit- нада применять и для border-radius хотя в iceweasel работает и так TODO дома проверить на разных браузерах ***/
}
legend{
	border:none;
	border-radius: 5px 5px;
	background-color:#EEEEEE;/*#F6F6F6;*/
	margin-bottom:1em;
	padding:.3em;
	text-shadow:#555753 0 .15em .10em;
}
</style>
    <title><?php $title=$_SERVER['PHP_SELF']; echo $title;?></title>
</head>
<body class="body">
<script>
//***  Функция яваскрипт для смены стиля кнопки при наведении мышки
function classChange(styleChange,item){
   item.className=styleChange;
}
</script>
<fieldset>
<legend>Авторизация</legend>
<form method="post">
<label for="user">Имя:</label>
<input type="text" name="user" required='required'/><br>
<label for="pass">Пароль:</label>
<input type="password" name="pass" required='required'/><br>
    <input type="submit" name="submit" value="Вход" class="buttonSubmit" 
     onMouseOver="classChange('buttonSubmitRoll',this)" 
     onMouseOut="classChange('buttonSubmit',this)" />
</form>
</fieldset>
</body>
</html>
