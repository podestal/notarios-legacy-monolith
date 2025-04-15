<?php 

include("conexion.php");

$tipper="J";
$razonsocial=$_POST['razonsocial'];
$ndomfiscal=strtoupper(str_replace("ñ","Ñ",$_POST['ndomfiscal']));
$ubigen=$_POST['ubigen2'];
$codubi=$_POST['codubi'];
$contacempresa=strtoupper(str_replace("ñ","Ñ",$_POST['contacempresa']));
$fechaconstitu=$_POST['fechaconstitu'];
$numregistro=$_POST['numregistro'];
$idsedereg3=$_POST['idsedereg3'];
$numpartida=$_POST['numpartida'];
$telempresa=$_POST['telempresa'];
$telofi=$_POST['telofi'];
$actmunicipal=$_POST['actmunicipal'];
$mailempresa=$_POST['mailempresa'];
$idtipdoc=intval("8");
$numdoc=$_POST['numdoc_solic'];

if ($ubigen==""){
$idubigeo=0;
}else{
$idubigeo=$codubi;
}

$consulclien=mysql_query("Select * from cliente order by idcliente DESC LIMIT 1", $conn) or die(mysql_error());

$rowclin = mysql_fetch_array($consulclien);

$numeroc=$rowclin['idcliente'];
$sumac= intval($numeroc) + 1;
$cantidadc= strlen($sumac);


 switch ($cantidadc) {
	case "1":
	$ncliente="000000000".$sumac;
	break;
	case "2":
	$ncliente="00000000".$sumac;	
	break;
	case "3":
	$ncliente="0000000".$sumac;
	break;
	case "4":
	$ncliente="000000".$sumac;	
	break;
	case "5":
	$ncliente="00000".$sumac;
	break;
	case "6":
	$ncliente="0000".$sumac;	
	break;		
	case "7":
	$ncliente="000".$sumac;	
	break;	
	case "8":
	$ncliente="00".$sumac;	
	break;	
	case "9":
	$ncliente="0".$sumac;	
	break;
	case "10":
	$ncliente=$sumac;	
	break;			
}


$grabarclientesc="INSERT INTO cliente (idcliente, tipper, idtipdoc, numdoc, idubigeo,razonsocial, domfiscal, telempresa, mailempresa, contacempresa, fechaconstitu, idsedereg, numregistro, numpartida, actmunicipal) 
VALUES ('$ncliente','$tipper','$idtipdoc','$numdoc','$idubigeo','$razonsocial','$ndomfiscal','$telempresa','$mailempresa','$contacempresa','$fechaconstitu','$idsedereg3','$numregistro','$numpartida','$actmunicipal')";


mysql_query($grabarclientesc,$conn) or die(mysql_error());



?>


<!-- aca empieza la webada-->
<table  width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="33"><span class="camposss">Remitente:</span></td>
    <td colspan="3"><input name="remitente2" type="text" id="remitente2" style="text-transform:uppercase" size="60" onkeypress="return soloLetrasynumeros(event)" onKeyUp="remitente1();" maxlength="400" value="<?php echo strtoupper($razonsocial);
 ?>"/> 
      <input type="hidden" name="remitente" id="remitente" value="<?php echo $nombre;?>" ></td>
  </tr>
  <tr>
    <td><span class="camposss">Direccion:</span></td>
    <td colspan="3"><input name="direccion_remi1" style="text-transform:uppercase" type="text" id="direccion_remi1" size="60" onkeypress="return soloLetrasynumeros(event)"  onKeyUp="direccion_remi2();" maxlength="300" value="<?php   echo strtoupper($ndomfiscal);
 ?>"/>
      <input type="hidden" name="direccion_remi" id="direccion_remi" value="<?php  echo $ndomfiscal;
		 
 ?>" ></td>
  </tr>
</table>