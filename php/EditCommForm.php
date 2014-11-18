<?php
session_start();
require_once '../connectdb/connectguest.php';

if(strlen(trim($_POST['comment']))==0)
{
echo "Вы ввели пустое сообщение";
echo '<meta http-equiv="refresh" content="3;EditComm.php?comm_id='."{$_SESSION['comm_id']}";
exit();
}
$query = "UPDATE `guest`.`comments` SET `comment` = '{$_POST['comment']}' 
		WHERE `comments`.`comm_id` = {$_SESSION['comm_id']}";
$result = mysql_query($query);
if($result)
{
	echo "Комментарий изменён.";	
}
else
{
echo "Ошибка при изменении комментария в БД.";
}
echo '<meta http-equiv="refresh" content="3;Main.php">';
?>