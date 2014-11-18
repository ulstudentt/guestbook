<?php
session_start();
require_once '../connectdb/connectguest.php';
if(isset($_POST['submit']))
{
    $err = array();

    if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['login']))
    {
        $err[] = "Логин может состоять только из букв английского алфавита и цифр";
    }

    if(strlen($_POST['login']) < 3 or strlen($_POST['login']) > 12)
    {
        $err[] = "Логин должен быть не меньше 3-х символов и не больше 30";
    }

    $query = mysql_query("SELECT COUNT(user_id)
						  FROM users 
						  WHERE login='".($_POST['login'])."'");

    if(mysql_result($query, 0) > 0)
    {
        $err[] = "Пользователь с таким логином уже существует в базе данных";
    }
	
	if($_POST['captcha'] != $_SESSION['captcha']) 
	{
	$err[] = "Неверная капча";
	}
    if(count($err) == 0)
    {
        $login = $_POST['login'];
        $password = md5(trim($_POST['password']));
		$admin = NULL;
        mysql_query("INSERT INTO users(login,password,admin) 
					 VALUES ('{$login}', '{$password}','{$admin}')");
		
		$result = mysql_fetch_row(mysql_query("SELECT user_id FROM users 
											WHERE login = '{$login}' AND password = '{$password}'"));
	
		if($result)
		{
			$_SESSION['user_id'] = $result[0];
			echo "Вы успешно зарегистрировались.Перенаправление на главную страницу";
			echo '<meta http-equiv="refresh" content="3;Main.php">';
			exit();
		}
		else
		{
		echo "Пользователь успешно добавлен. Произошла ошибка при авторизации.";
		echo '<meta http-equiv="refresh" content="3;Login.php">';
		exit();
		}
	}
    else
    {
        print "<b>При регистрации произошли следующие ошибки:</b><br>";
        foreach($err AS $error)
        {
            print $error;
        }
		echo '<meta http-equiv="refresh" content="3;Signup.html">';
		exit();
    }
}
else
{
	echo "Неправильно отправлен запрос.";
	echo '<meta http-equiv="refresh" content="3;http://localhost/php/Signup.html">';
	exit();
}
?>
