<?php 
include("conexion.php");

$codkardex=$_POST['codkardex'];
$idcontratantee=$_POST['idcontratantee'];
$pregu1=$_POST['pregu1'];
$pregu2=$_POST['pregu2'];
$pregu3=$_POST['pregu3'];

$consulta=mysql_query("Select * from renta order by idrenta DESC LIMIT 1", $conn) or die(mysql_error());

$row = mysql_fetch_array($consulta);

$numero=$row['idrenta'];
$suma= intval($numero) + 1;
$cantidad= strlen($suma);
 switch ($cantidad) {
	case "1":
	$nrenta="00000".$suma;
	break;
	case "2":
	$nrenta="0000".$suma;	
	break;
	case "3":
	$nrenta="000".$suma;
	break;
	case "4":
	$nrenta="00".$suma;	
	break;
	case "5":
	$nrenta="0".$suma;
	break;
	case "6":
	$nrenta=$suma;	
	break;						
}


$consulta_v_renta=mysql_query("select kardex,idcontratante,idrenta from renta where kardex='".$codkardex."' and idcontratante='".$idcontratantee."'", $conn) or die(mysql_error());

$row_consulta = mysql_fetch_array($consulta_v_renta);
$row_valida = mysql_num_rows($consulta_v_renta);





if($row_valida>0)
{
	$nrenta=$row_consulta['idrenta'];
	
	mysql_query("update renta set pregu1='$pregu1' , pregu2='$pregu2', pregu3='$pregu3' 
	where kardex='$codkardex' and idcontratante='$idcontratantee' ", $conn) or die(mysql_error());
	
	echo "<input name='idrenta' id='idrenta' value='".$nrenta."' type='hidden' />";
echo "Preguntas Actualizadas...";

	
}else
{
	
mysql_query("INSERT INTO renta (idrenta, idcontratante, kardex, pregu1, pregu2, pregu3) VALUES ('$nrenta','$idcontratantee','$codkardex','$pregu1','$pregu2','$pregu3')", $conn) or die(mysql_error());
	
	echo "<input name='idrenta' id='idrenta' value='".$nrenta."' type='hidden' />";
echo "Preguntas Grabadas...";

	
	}





?>