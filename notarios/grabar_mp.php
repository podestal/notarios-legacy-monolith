<?php 
include("conexion.php");

$codkardex       = $_POST['codkardex'];
$variables   = $_POST['tipoactopatri'];
$separar= explode("|",$variables );
$tipoactopatri = $separar[0];
$item = $separar[1];
$nnminuta        = $_POST['nnminuta'];
$imptrans        = $_POST['imptrans'];
$tipomoneda      = $_POST['tipomoneda'];
$exibio          = $_POST['exibio'];
$tipcambio       = $_POST['tipcambio'];
$humbral         = $_POST['humbral'];
$fpago         = $_POST['fpago'];
$fecha_modificacion = date("d/m/Y");
$idoppago         = $_POST['idoppago'];
$des_idoppago     = strtoupper($_POST['des_idoppago']);


$consulta        = mysql_query("Select * from patrimonial order by itemmp DESC LIMIT 1", $conn) or die(mysql_error());
$row             = mysql_fetch_array($consulta);
$itmp="";
$numero   = $row['itemmp'];
$suma     = intval($numero) + 1;
$cantidad = strlen($suma);

 switch ($cantidad) {
	case "1":
	$itmp="00000".$suma;
	break;
	case "2":
	$itmp="0000".$suma;	
	break;
	case "3":
	$itmp="000".$suma;
	break;
	case "4":
	$itmp="00".$suma;	
	break;
	case "5":
	$itmp="0".$suma;
	break;
	case "6":
	$itmp=$suma;	
	break;						
}
$_SESSION['varitem']=$itmp;
$opopago = $_POST['idoppago'];
$sedereg = 0;

$consulkarmp=mysql_query("SELECT patrimonial.itemmp FROM patrimonial WHERE patrimonial.itemmp = '$itmp'", $conn) or die(mysql_error());
$rowkarmp = mysql_fetch_array($consulkarmp);
$vareval = $rowkarmp[0]; 

if($vareval=='')
{ 

$sqlmp="INSERT INTO patrimonial(itemmp, kardex, idtipoacto, nminuta, idmon, tipocambio, importetrans, exhibiomp, presgistral, nregistral, idsedereg, fpago, idoppago, ofondos, item, des_idoppago) VALUES ('$itmp','$codkardex','$tipoactopatri','$nnminuta','$tipomoneda','$tipcambio','$imptrans','$exibio','','','$sedereg','$fpago','$opopago','','$item', '$des_idoppago')"; 

mysql_query($sqlmp,$conn) or die(mysql_error());

$sqlmodificacion="UPDATE KARDEX SET  fecha_modificacion ='$fecha_modificacion' WHERE KARDEX ='$codkardex'"; 

mysql_query($sqlmodificacion,$conn) or die(mysql_error());

}
else if($vareval!='')
{	

$sqlmp="UPDATE patrimonial SET patrimonial.idtipoacto='$tipoactopatri', patrimonial.nminuta='$nnminuta', patrimonial.idmon='$tipomoneda', patrimonial.tipocambio='$tipcambio', patrimonial.importetrans='$imptrans', patrimonial.exhibiomp='$exibio', patrimonial.idsedereg='$sedereg', patrimonial.fpago='$fpago', patrimonial.idoppago='$opopago', patrimonial.item='$item', patrimonial.des_idoppago = '$des_idoppago' WHERE patrimonial.itemmp='$itmp')"; 

mysql_query($sqlmp,$conn) or die(mysql_error());

$sqlmodificacion="UPDATE KARDEX SET  fecha_modificacion ='$fecha_modificacion' WHERE KARDEX ='$codkardex'"; 

mysql_query($sqlmodificacion,$conn) or die(mysql_error());

}

echo "<input name='itemmpp' id='itemmpp' readonly='readonly' type='hidden' value='$itmp' size='8'>";


?>