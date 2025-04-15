<?php 
include("../../conexion.php");
$data=$_post['numdoc2'];
mysql_query("truncate kardex_ro",$conn);
echo "Reiniciado y listo para cargar data..!!!";

?>