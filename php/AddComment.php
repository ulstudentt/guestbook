<?php
session_start();
require_once '../connectdb/connectguest.php';

$query = "SELECT blocked
            FROM `t6`.`users`
            WHERE user id="."";

if(strlen($_POST['comment'])==0)
{
echo "Вы ввели пустое сообщение";
echo '<meta http-equiv="refresh" content="3;Main.php">';
exit();
}

if($_SESSION['user_id']== -1 )
{
	$user_id = -1;	
	if($_POST['captcha'] != $_SESSION['captcha']) 
	{
		echo "Неверная капча";
		echo '<meta http-equiv="refresh" content="3;Main.php?comment='."{$_POST['comment']}".'">';
		exit();
	}
}
else 
{
	if(isset($_POST['Anonim'])==true)
	{
		$user_id = -1;
	}
	else
	$user_id = $_SESSION['user_id'];
    $query =mysql_query("SELECT (`blocked`)
              FROM `t6`.`users`
              WHERE user_id='{$user_id}';");
    if($query)
    {
        $result = mysql_fetch_row($query);
        if($result[0]==1)
        {
            echo "Вы заблокированы";
            echo '<meta http-equiv="refresh" content="3;Main.php">';
            exit();
        }
    }
    else
        echo "Ошибка обращения к доступу комментирования";
}
	
$ds = date('Y-m-d H:i:s');
$comment = trim($_POST['comment']);

$query = mysql_query("INSERT INTO `t6`.`comments` ( `user_id`, `ts`, `comment`)
					  VALUES ('{$user_id}', '{$ds}', '{$comment}')");
if($query)
{
	echo "Комментарий добавлен.";	
}
else
{
echo "Ошибка при добавлении комментария в БД.".mysql_error();
}
echo '<meta http-equiv="refresh" content="3;Main.php">';
?>