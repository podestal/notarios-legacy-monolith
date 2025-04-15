
<?php 
include("../../conexion.php");

$noficio=$_POST['noficio'];



if($noficio!=""){
	$sql_cliente="SELECT DISTINCT impedidos.idimpedido AS 'id',
impedidos.`origen` AS 'entidad',impedidos.`motivo` AS 'motivo' FROM impedidos 
WHERE  impedidos.idimpedido='$noficio'
ORDER BY impedidos.idimpedido desc";

}else{
$sql_cliente="SELECT DISTINCT impedidos.idimpedido AS 'id',
impedidos.`origen` AS 'entidad',impedidos.`motivo` AS 'motivo' FROM impedidos 

ORDER BY impedidos.idimpedido desc";	
}



			 include("mostrarimpecontrol.php");



 
?>
