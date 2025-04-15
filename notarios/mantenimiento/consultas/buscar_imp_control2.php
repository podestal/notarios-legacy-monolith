
<?php 
include("../../conexion.php");

$noficio=$_POST['noficio'];



if($noficio!=""){
	$sql_cliente="SELECT DISTINCT impedidos.idimpedido AS 'id',
impedidos.`origen` AS 'entidad',impedidos.`motivo` AS 'motivo' FROM impedidos 

WHERE  impedidos.motivo LIKE '%$noficio%'
ORDER BY impedidos.idimpedido DESC";

}else{
$sql_cliente="SELECT DISTINCT impedidos.idimpedido AS 'id',
impedidos.`origen` AS 'entidad',impedidos.`motivo` AS 'motivo' FROM impedidos 

ORDER BY impedidos.idimpedido desc";	
}



			 include("mostrarimpecontrol.php");



 
?>
