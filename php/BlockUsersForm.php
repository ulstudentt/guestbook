<?php
session_start();
require_once '../connectdb/connectguest.php';

if(strlen(trim($_POST['login']))==0)
{
    echo "Вы ввели пустой логин";
    echo '<meta http-equiv="refresh" content="3;BlockUsers.php>';
    exit();
}
$query = "UPDATE `users`
          SET `blocked` = '1'
          WHERE login = '{$_POST['login']}';";
$result = mysql_query($query);
if($result)
{
    echo "Пользователь заблокирован.";
}
else
{
    echo "Ошибка при блокировке пользователя в БД.";
}
echo '<meta http-equiv="refresh" content=3;BlockUsers.php>';
?>