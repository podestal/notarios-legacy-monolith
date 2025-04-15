<?php 
include("conexion.php");

$codkardex=$_POST['codkardex'];
$idcontratantee=$_POST['idcontratantee'];
$pregu1=$_POST['pregu1'];
$pregu2=$_POST['pregu2'];
$pregu3=$_POST['pregu3'];

$consultac3=mysql_query("Select * from renta where idcontratante='$idcontratantee'", $conn) or die(mysql_error());
$rowcc3 = mysql_fetch_array($consultac3);


mysql_query("update renta set pregu1='$pregu1', pregu2='$pregu2', pregu3='$pregu3' where idcontratante='$idcontratantee'", $conn) or die(mysql_error());

if($pregu3=$_POST['pregu3']=="1"){
	
	mysql_query("delete from formulario where idrenta='".$rowcc3['idrenta']."'", $conn) or die(mysql_error());

	}


// aqui tengo que eliminar los formularios si es si 
echo "<input name='idrenta' id='idrenta' value='".$rowcc3['idrenta']."' type='hidden' />";
echo "Preguntas Grabadas...";

?>