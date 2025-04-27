<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"


include_once('correggiErrore.php');



$connhelp = mysql_connect("localhost", "root", "");
$DB = "my_DataBase";
mysql_select_db($DB, $connhelp);


?>
