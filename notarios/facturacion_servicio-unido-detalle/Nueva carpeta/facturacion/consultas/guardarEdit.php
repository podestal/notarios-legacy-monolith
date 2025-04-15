<?php

	session_start();
	include("../../extraprotocolares/view/funciones.php");
	$conexion = Conectar();

$idregventas = $_REQUEST['idregventas'];

$tipo_docu_=$_REQUEST['tip_comp'];
$serie_=$_REQUEST['numDocBoleta'];
$factura_=$_REQUEST['numBoleta'];
//$fecha_=$_REQUEST['fedita'];
$tip_doc_=$_REQUEST['dni'];
$num_docu_=$_REQUEST['dnicliente'];
$telefono_=$_REQUEST['tel'];
$concepto_=$_REQUEST['cliente'];
$direccion_=$_REQUEST['direccion'];
$tipopago_=$_REQUEST['tipoPago'];



	$consulta_m_regventas =mysql_query( "SELECT id_regventas FROM m_regventas WHERE id_regventas='".$idregventas."'",$conexion);

	$row_idregventas = mysql_fetch_assoc($consulta_m_regventas);
	$conteo=mysql_num_rows($consulta_m_regventas);
	if($conteo==1){
		 $sql_insertregventas = "update m_regventas set
		                         tipo_docu='".$tipo_docu_."',
		                         serie='".$serie_."',
		                         factura='".$factura_."',
		                         tip_doc='".$tip_doc_."', 
		                         num_docu='".$num_docu_."',
		                         telefono='".$telefono_."',
		                         concepto='".$concepto_."',
 		                         direccion='".$direccion_."',
							     tipopago='".$tipopago_."'
								 where id_regventas='".$idregventas."'";
							
		$resultado_insertregventas = mysql_query($sql_insertregventas, $conexion);
		
		if($resultado_insertregventas){
		
			$sql_insertdetventas = "update d_regventas set
									serie='".$numDocBoleta."'
									where id_regventas='".$idregventas."'";
								
			$resultado_insertdetventas = mysql_query($sql_insertdetventas, $conexion);					
		}
	
}
?>