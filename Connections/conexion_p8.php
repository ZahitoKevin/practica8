<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_conexion_p8 = "localhost";
$database_conexion_p8 = "bd_p8";
$username_conexion_p8 = "root";
$password_conexion_p8 = "";
$conexion_p8 = mysql_pconnect($hostname_conexion_p8, $username_conexion_p8, $password_conexion_p8) or trigger_error(mysql_error(),E_USER_ERROR); 
?>