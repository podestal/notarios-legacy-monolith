<?php

include("../../extraprotocolares/view/funciones.php");
	
$conexion = Conectar();

$a_tipodocu = $_REQUEST['a_t'];
$a_serie = $_REQUEST['a_s'];
$a_doic = $_REQUEST['a_d'];

$id_regventas = $_REQUEST['id'];

$sql_desactivarv = "update tb_egreso set b_estado='0' where c_c_egreso='$id_regventas'";

$exe_desactivarv = mysql_query($sql_desactivarv, $conexion);



?>