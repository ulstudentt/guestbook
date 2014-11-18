<?php
session_start();
require_once '../connectdb/connectguest.php';

if(strlen($_POST['comment'])==0)
{
    echo "Вы ввели пустое сообщение";
    echo '<meta http-equiv="refresh" content="3;Main.php">';
    exit();
}
if($_SESSION['user_id']== -1)
{
    $user_id = -1;
    if($_POST['captcha'] != $_SESSION['captcha'])
    {
        echo "Неверная капча";
        echo '<meta http-equiv="refresh" content="3;CommBranch.php?comment='."{$_POST['comment']}".'&comm_id='."{$_SESSION['current_branch']}".'">';
        exit();
    }
}
if(isset($_POST['Administration']))
{
    $user_id = -2;
}
else if(isset($_POST['Anonim']))
{
	$user_id = -1;
}
else
{
    $user_id = $_SESSION['user_id'];
}

$ds = date('Y-m-d H:i:s');
$comment = trim($_POST['comment']);

$query = mysql_query("INSERT INTO `t6`.`commbranch` (`comm_id`,`user_id`, `ts`, `comment`)
					  VALUES ('{$_SESSION['current_branch']}','{$user_id}', '{$ds}', '{$comment}')");
if($query)
{
    echo "Комментарий добавлен.";
}
else
{
    echo "Ошибка при добавлении комментария в БД.".mysql_error();
}
echo '<meta http-equiv="refresh" content="3;CommBranch.php?comm_id='."{$_SESSION['current_branch']}".'">';
?>