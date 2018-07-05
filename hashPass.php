<!DOCTYPE html>
<html>
<head>
    <meta charset="utf8">
	<link rel="stylesheet" href="css/style.css">
    <title>Шифруем пароль</title>
</head>
<body class="body">

<fieldset>
	<legend>Шифрование пароля</legend>
		<form method="post">
			<label for="pass">Пароль:</label>
			<input type="password" name="pass" placeholder="Пароль для шифрования" required='required'/><br>
			<input type="submit" name="submit" value="Зашифровать" style="width:140px";/>
		</form>
</fieldset>

<?php
$hpass = $_POST['pass']; 
if (empty($hpass)){
	  exit; //*** если переменная пуста выходим, иначе функция md5 шифрует пустую строку	
	} else { //*** если не пустая шифруем и выводим содержимое переменной
      echo '<div class="hpass">'.md5($hpass). 	  
	       '<p>Полученый выше код нужно подставить в переменную $pass=\' \' 
            которая находится в файле index.php, в этом же файле изменить переменную $admin=\'admin\' подставивши вашего пользователя.
            <br>Теперь можно зайти на страницу используя имяПользователя:вашПароль</p>
			</div>';
	}	
?>
</body>
</head>
