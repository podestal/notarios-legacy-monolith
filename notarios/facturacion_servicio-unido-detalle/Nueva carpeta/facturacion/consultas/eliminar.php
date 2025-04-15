<?php

include("../../extraprotocolares/view/funciones.php");
	
$conexion = Conectar();

$a_tipodocu = $_REQUEST['a_t'];
$a_serie = $_REQUEST['a_s'];
$a_doic = $_REQUEST['a_d'];

$id_regventas = $_REQUEST['id'];

$sql_deletev = "delete from m_regventas where tipo_docu=$a_tipodocu and serie=$a_serie and factura=$a_doic";

$exe_deletev = mysql_query($sql_deletev, $conexion);

$sql_deletep = "delete from m_regpagos where tipo_docu=$a_tipodocu and serie=$a_serie and numero=$a_doic";

$exe_deletep = mysql_query($sql_deletep, $conexion);

$sql_deletec = "delete from m_cteventas where tipo_docu=$a_tipodocu and serie=$a_serie and documento=$a_doic";

$exe_deletec = mysql_query($sql_deletec, $conexion);


$sql_del_detalle = "delete from d_regventas where id_regventas= $id_regventas";

$exe_del_detalle = mysql_query($sql_del_detalle, $conexion);

$consul=mysql_query("SELECT CONCAT( REPEAT( '0', 6 - LENGTH( grp_item-1) ) , grp_item-1) AS grp_item FROM t_params t WHERE t.num_item=".$a_tipodocu." AND serie_item='".$a_serie."'");


$contao=mysql_num_rows($consul);
if($contao==1){
	$row=mysql_fetch_array($consul);
	if($a_doic==$row['grp_item']){
		mysql_query("update t_params set grp_item='".$row['grp_item']."' where num_item='".$a_tipodocu."' AND serie_item='".$a_serie."' ",$conexion) or die(mysql_error());
		

	}
		
}



?>