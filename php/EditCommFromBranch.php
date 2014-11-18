<?php
session_start();
$_SESSION['comm_branch_id'] = $_GET['comm_branch_id'];
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
    <p class='header'>Гостевая книга, изменить комментарий в ветке</p>
</div>

<div id = "body">

    <form style = "width:40%;" action="EditCommFromBranchForm.php" method="POST">
        <fieldset>
            <textarea id="comment" name="comment"
                      cols="65" rows="8"></textarea>
        </fieldset>
        <fieldset id = "buttoncomment">
            <input type="submit" value="Изменить комментарий" />
            <input type="reset" value="Очистить" />
        </fieldset>
    </form>

</div>
</body>
</html>


