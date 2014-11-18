<?php
session_start();
$_SESSION['user_id'] = -1;
?>

<html>
<head>
<meta http-equiv="Content-type" content="text/html;chaarset=UTF-8" />
<link rel="stylesheet" href="php/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="php/css/main.css">
<title>
Гостевая книга
</title></head>
<body>

<div id = "header"> 
<p class='header'>Гостeвая книга, авторизация</p>
</div>

<div id = "body">
<form id='formlogin' action="php/LoginForm.php" method="POST">
Логин <input name="login" type="text"><br><br>
Пароль <input name="password" type="password"><br><br>
Капча<br>
 <img style="border: 1px solid gray; background: url('captcha/bg_capcha.png');" src = "captcha/captcha.php" width="120" height="40"/><br><br>

<input type="text" name="captcha" /><br><br>
<input name="submit" type="submit" value="Авторизироваться">
<input type="reset" value="Очистить" /><br><br>
<a href="Signup.html">@Зарегистрироваться.@</a><br>
<a href="php/Main.php">@Продолжить без авторизации.@</a>
</form>
</div>
</body>
</html>