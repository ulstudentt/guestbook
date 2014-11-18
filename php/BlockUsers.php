<?php
session_start();
require_once '../connectdb/connectguest.php';

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

function banned_list()
{
    $query = mysql_query("SELECT login
                          FROM users
                          WHERE blocked = 1;");
    if($query)
    {
        while($row = mysql_fetch_array($query))
        {
            echo $row[0]."<br>";
        }
    }
    else
        echo "Ошибка доступа к бд(блокированные пользователи)";
}
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
    <p class='header'>Гостевая книга, блокирование пользователей</p>
    <ul class="css-menu-2">
        <li><a href="Main.php">Главная</a></li>
        <li><a href="exit.php">Выход</a></li>
        <?php if(get_admin($_SESSION['user_id'])==true)
            echo '<li><a href="BlockUsers.php">Заблокировать пользователей</a></li>';
        ?>
    </ul>
</div>

<div id = "body">
    <div style= "margin-left: 35%; margin-top: 20px;">
    <?php
    echo "Список блокированных пользователей:<br>";
    banned_list();
    ?>
    </div>
    <br><br>
    <form style="margin-left: 35%;" action="BlockUsersForm.php" method="POST">
        Добавить пользователя в бан-лист:
        <fieldset>
            <textarea  name="login"
                      cols="30" rows="2"></textarea>
        </fieldset>
        <fieldset >
            <input type="submit" value="Заблокировать" />
            <input type="reset" value="Очистить" />
        </fieldset>
    </form>

</div>
</body>
</html>


