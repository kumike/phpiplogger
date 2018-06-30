<!DOCTYPE html>
<html>
<head>
    <meta charset="utf8">
	<link rel="stylesheet" href="css/ipbot.css">
<script>
//***  Функция яваскрипт для смены стиля кнопки при наведении мышки
function classChange(styleChange,item){
   item.className=styleChange;
}
</script>
    <title></title>
</head>
<body class="body">

<fieldset class="fieldset">
<legend class="legend">Шифрование пароля</legend>
<form method="post">
<label for="pass" class="label">Пароль:</label>
<input class="input" type="password" name="pass" placeholder="Пароль для шифрования" required='required'/><br>
    <input type="submit" name="submit" value="Зашифровать" class="buttonSubmit" style="width:140px;"
     onMouseOver="classChange('buttonSubmitRoll',this)" 
     onMouseOut="classChange('buttonSubmit',this)" />
</fieldset>
<?php
$hpass = $_POST['pass']; 
if (empty($hpass)){
	  exit; //*** если переменная пуста выходим, иначе функция md5 шифрует пустую строку	
	}else{
      echo '<br><fieldset class="fieldset">'.md5($hpass).'</fieldset>'; //*** если не пустая шифруем и выводим содержимое переменной
	  echo '<br><fieldset class="fieldset"><p>Полученый выше код нужно подставить в переменную $pass=\' \' 
            которая находится в файле index.php, в этом же файле изменить переменную $admin=\'admin\' подставивши вашего пользователя.
             <br>Теперь можно зайти на страницу используя имяПользователя:вашПароль</p></fieldset>';
	}	
?>
</body>
</head>
