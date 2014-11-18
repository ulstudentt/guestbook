<?php
session_start();
require_once '../connectdb/connectguest.php';
?>
<html>
<head>
<meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
<title>
Гостевая книга
</title>
</head>
<body>

<div id = "header"> 
<p class='header'>Гостевая книга, изменить комментарий</p>
</div>

<div id = "body">

Вы действительно хотите удалить комментарий ?
<form style = "width:15%;" action="DeleteComm.php" method="POST">
<input name="delete" type="submit" value="Удалить комментарий" />
</form>
<?php
if(isset($_GET["comm_id"]))
 $_SESSION["comm_id"] = $_GET["comm_id"];

echo '<a href = Main.php?page='."{$_SESSION['page']}".">Отменить и вернуться на главную</a>";

if(isset($_POST['delete']))
{
$query = mysql_query( "DELETE FROM `t6`.`comments` WHERE `comments`.`comm_id` = ".$_SESSION["comm_id"].';');

if($query)
{
echo "Комментарий удалён";
}
else
{
echo "Ошибка удаления комментария";
}
echo '<meta http-equiv="refresh" content=3;Main.php?page='."{$_SESSION['page']}".'>';
exit();
}
?>
</div>
</body>
</html>