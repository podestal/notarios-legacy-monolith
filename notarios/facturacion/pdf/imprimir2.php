<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<?php 

include('../../conexion.php');
include('../../extraprotocolares/view/funciones.php');
include('../../facturacion/consultas/comprobante.php');

$id=$_REQUEST['tip_comp'];

$sql=mysql_query("SELECT MAX(m_regventas.id_regventas) AS ultimo FROM m_regventas",$conn) or die (mysql_error());
$res=mysql_fetch_array($sql);

?>

</head>

<body>

<?php
if($id==01){
	
	echo '<iframe width="500" height="600" style="display:none" id = "textfile"  src = "../pdf/boleta.php?id_regventas='.$res[0].'" ></iframe> 
 ';
}else if($id==02){
	
	echo '<iframe width="500" height="600" style="display:none" id = "textfile"  src = "../pdf/factura.php?id_regventas='.$res[0].'" ></iframe> 
';

}else if($id==04){
	echo '<iframe width="500" height="600" style="display:none" id = "textfile"  src = "../pdf/recibo.php?id_regventas='.$res[0].'" ></iframe> 
 ';


}
 ?>



</body>
</html>