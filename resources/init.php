<?php

include_once('config.php');

if(!mysql_connect(DB_HOST, DB_USER, DB_PASS))
	echo"<br>Cannot connect to ".DB_HOST."<br>";
if(!mysql_select_db(DB_NAME))
	echo "<br>Error connecting to database<br>";

include_once('func/func.php');