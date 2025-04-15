<?php

include("../../extraprotocolares/view/funciones.php");
	
$conexion = Conectar();

$a_tipodocu = $_REQUEST['a_t'];
$a_serie = $_REQUEST['a_s'];
$a_doic = $_REQUEST['a_d'];

$id_regventas = $_REQUEST['id'];

$sql_desactivarv = "update m_regventas set estado='ANULADO',imp_total='0.00',subtotal='0.00',impuesto='0.00' where tipo_docu=$a_tipodocu and serie=$a_serie and factura=$a_doic";

$exe_desactivarv = mysql_query($sql_desactivarv, $conexion);

$sql_del_detalle = "delete from d_regventas where id_regventas= $id_regventas";

$exe_del_detalle = mysql_query($sql_del_detalle, $conexion);

$sql_deletep = "delete from m_regpagos where tipo_docu=$a_tipodocu and serie=$a_serie and numero=$a_doic";

$exe_deletep = mysql_query($sql_deletep, $conexion);

$sql_deletec = "delete from m_cteventas where tipo_docu=$a_tipodocu and serie=$a_serie and documento=$a_doic";

$exe_deletec = mysql_query($sql_deletec, $conexion);



?>