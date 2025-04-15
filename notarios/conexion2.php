<?php
/*CONEXION ALTERNA PARA LA BASE DE DATOS LOG_NOTARIOS EN MYSQLI*/
$ip_i      = "db";
$user_i    = 'root';
$contra_i  = '12345';
$db_name_i = 'notarios';
$conn_i    = mysqli_connect($ip_i,$user_i,$contra_i,$db_name_i) or die (mysqli_error($conn_i));   
mysqli_query($conn_i,"SET CHARACTER SET 'utf8'");
?>
