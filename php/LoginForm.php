<?php
session_start();
require_once '../connectdb/connectguest.php';

if(($_POST['captcha'] != $_SESSION['captcha']) or empty($_POST['login']) or empty($_POST['password'])) 
	{
	echo"Неверно введен код с картинки или не заполнены все поля.";
	echo '<meta http-equiv="refresh" content="3;../Login.php">';
	exit();
	}
	
	$login = $_POST['login'];
	$password = md5($_POST['password']);
	
	
	
	$query = mysql_query( "SELECT user_id FROM users 
						   WHERE login = '{$login}' AND password = '{$password}';" );
	
	if($query)
	{
	$result = mysql_fetch_row($query);
	$_SESSION['user_id'] = $result[0];
	$_SESSION['login'] = $login;
	
	echo "Успешная авторизация, переадресация на главную страницу.";
	echo '<meta http-equiv="refresh" content="3;Main.php">';
	exit();
	}
	else
	{
	echo "Неверно введены логин/пароль.";
	echo '<meta http-equiv="refresh" content="3;../Login.php">';
	exit();
	}
	/*}
	else
	{
	echo "Неправильно отправлен запрос.";
	echo '<meta http-equiv="refresh" content="3;http://localhost/php/Login.php">';
	exit();
	}*/
	
?>