<?php
include('conexion.php');
$variable=$_POST['paterno'];
mysql_query('truncate temp_act',$conn);
mysql_query('truncate temp_bie',$conn);
mysql_query('truncate temp_otg',$conn);
?>