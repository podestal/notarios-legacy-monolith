<?php 
session_start();
include("conexion2.php");	
include("extraprotocolares/view/funciones.php");
$kardex	= $_REQUEST['kardex'];
$tipo	= $_REQUEST['tipo'];
$obs	= $_REQUEST['obs'];
$fecha=date("Y-m-d G:i:s");

if($_REQUEST['cargo']=="CARGO"){
	$CARGO="CARGO";
}else{
	$CARGO="ESCRI";
}
mysqli_query($conn_i,"
insert into documentogenerados (observacion,fecha,usuario,pc,ip,tipogeneracion,kardex,flag) 
values ('".$obs."',NOW(),'".$_SESSION["id_usu"]."','".php_uname('n')."','".$_SESSION["computadora"]."','".$tipo."','".$kardex."','".$CARGO."')");
?>
