<?php
require "configguest.php";

$link = mysql_connect(DATABASE_HOST,USER, PASSWORD)
or die("<p>Ошибка подключения к базе данных: " . mysql_error() . "</p>");

mysql_query("SET NAMES utf8",$link)
or die ("<p>Ошибка запроса utf8. </p>");

mysql_select_db(DATABASE_NAME)
or die("<p>Ошибка при выборе базы данных " . mysql_error() . "</p>");

?>