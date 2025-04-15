<?php
 session_start();
	

include('../../conexion.php');
include('../../extraprotocolares/view/funciones.php');
include('../../facturacion/consultas/comprobante.php');

$id=$_GET['id_regventas'];

$sql=mysql_query("SELECT tipo_docu AS ultimo from m_regventas WHERE id_regventas='$id'", $conn);
$res=mysql_fetch_array($sql);

if($res['ultimo']==01){
	include("pdf_boleta.php");
	
}else if($res['ultimo']==02){
	
	include("pdf_factura.php");
}else if($res['ultimo']==04){
	include("pdf_recibo.php");


}



?>