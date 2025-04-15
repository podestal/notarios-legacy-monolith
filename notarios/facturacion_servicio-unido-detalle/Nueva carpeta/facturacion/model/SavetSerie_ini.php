<?php
include('../../conexion.php');

$tipdocu    = $_POST["tipdocu"];
$seriedoc	= $_POST["seriedoc"];
$numdocumen	= $_POST["numdocumen"];

$saveSerieIni = "UPDATE t_params SET serie_item = '$seriedoc', grp_item = '$numdocumen' WHERE num_item = '$tipdocu'";
mysql_query($saveSerieIni, $conn) or die(mysql_error());

mysql_close($conn);
?>