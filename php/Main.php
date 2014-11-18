<?php
session_start();
require_once '../connectdb/connectguest.php';
require_once '../connectdb/config.php';

function get_name($id_user) //получить никнейм имея id пользователя
{
	if($id_user == -1)
		return "Аноним";
	$query = mysql_query("SELECT login FROM users 
						 WHERE user_id = {$id_user};");
	if($query)
	{
		$result = mysql_fetch_row($query);
		return $result[0];
	}
	else 
		return "{$id_user}"."Ошибка запроса к БД.(никнейм)";
}

function get_admin($id_user)
{
if($id_user == -1)
{
return false;
}
$query = mysql_query("SELECT admin FROM users 
					 WHERE user_id = {$id_user}");				 
if($query)
	{
	$result = mysql_fetch_row($query);
	if($result[0]==0)
		return false;
	else 
		return true;
	}
	else
		echo "Ошибка запроса к БД.(админская панель)";
}

function get_comments($first_limit,$comments_per_page) //Запрос в комментарии
{
$query = "SELECT comm_id,user_id, ts, comment 
          FROM comments 
		  ORDER BY comm_id DESC 
		  LIMIT {$first_limit},{$comments_per_page};";
		  
$result = mysql_query($query);

if($result)
	return $result;
else 
	echo("Ошибка запроса к БД(комментарии).");
}


function print_query($arr)  //функция вывода комментариев
{ //
		echo '<table id ="tablecomment" class="table table-striped table-hover table-bordered">';
		echo '<thead>';
			echo '<tr>';
				echo '<td><i class="icon-user icon-white"></i> Автор</td>';
				echo '<td><i class="icon-time icon-white"></i> Дата/время</td>';
				echo '<td><i class="icon-comment icon-white"></i> Комментарий</td>';
				if(get_admin($_SESSION['user_id']) == true)
				{echo '<td>Редактировать</td>';
				echo '<td>Удалить</td>';}
			echo '</tr>';
		echo '</thead>';
			while($row = mysql_fetch_array($arr))
			{
			
			echo '<tbody>';
				echo '<tr>';
					echo "<td style='width:18%;'>".get_name($row[1])."</td>";
					echo "<td style='width:15%;'>{$row[2]}</td>";
					echo '<td>'."<a href = 'CommBranch.php?comm_id={$row[0]}'>{$row[3]}</a>".'</td>';
					if(get_admin($_SESSION['user_id']) == true)
				{echo '<td>'."<a href = 'EditComm.php?comm_id={$row[0]}'>Редактировать</a>".'</td>';
				echo '<td>'."<a href = 'DeleteComm.php?comm_id={$row[0]}'>Удалить</a>".'</td>';}
				echo '</tr>';
			echo '</tbody>';
			}
		echo '</table>';
}
?>

<html>
<head>
<meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/main.css"
<title>
Гостевая книга
</title>
</head>
<body>

<div id = "header"> 
<p class=header>Гостевая книга,главная. Привет, <?php echo get_name($_SESSION['user_id']);?></p>
    <ul class="css-menu-2">
        <li><a href="Main.php">Главная</a></li>
        <li><a href="exit.php">Выход</a></li>
        <?php if(get_admin($_SESSION['user_id'])==true)
        echo '<li><a href="BlockUsers.php">Заблокировать пользователей</a></li>';
        ?>
    </ul>
</div>

<div id = "body">
<?php

if(isset($_GET['page']))
	{
	$page = $_GET['page'];
	$_SESSION['page'] = $page;
	}
else
	$page = 1;
	
if($page == 1)
	$first_limit = 0 ;
else
	$first_limit = $comments_per_page * ($page-1);
	
$query = "SELECT COUNT(*) FROM comments";
$result = mysql_fetch_array(mysql_query($query));
$count  = $result[0];
$pages = ceil($count/$comments_per_page);
	
print_query(get_comments($first_limit,$comments_per_page));
echo "<p id='spancomments'>";
for($i = 0;$i < $pages;$i++)
{
$j = $i+1;
if($j != $page)
	echo "<a id='spancomments' href='?page={$j}'><span>' {$j} ' </span></a>";
else 
	echo "' {$j} '";
}
echo "</p>";
?>

</div>

<div id = "bottom">
<form action="AddComment.php" method="POST">
<fieldset>
<textarea id="comment" name="comment"
cols="65" rows="8"><?php if(isset($_GET['comment'])) echo "{$_GET['comment']}";?></textarea>
<?php
if($_SESSION['user_id'] != -1)
echo '<input type="checkbox" name="Anonim" value="Anonim"> Анонимно ';
?>
</fieldset>
<?php
if($_SESSION['user_id']== -1)
{
echo 'Капча<br>';
echo '<img style="border: 1px solid gray;height:40px;width:120px; background: url('.'../captcha/bg_capcha.png'.');" src = "../captcha/captcha.php"/><br><br>';
echo '<input type="text" name="captcha" /><br><br>';
}
?>
<fieldset id = "buttoncomment">
<input type="submit" value="Отправить комментарий" />
<input type="reset" value="Очистить" />
</fieldset>
</form>
</div>
</body>
</html>