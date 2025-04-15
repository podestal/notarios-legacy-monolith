<?php 

include("../../conexion.php");

$tipper="J";
$razonsocial=$_POST['razonsocial'];
$ndomfiscal=strtoupper(str_replace("ñ","Ñ",$_POST['ndomfiscal']));
$ubigen=$_POST['ubigen'];
$codubi=$_POST['codubi'];
$contacempresa=strtoupper(str_replace("ñ","Ñ",$_POST['contacempresa']));
$fechaconstitu=$_POST['fechaconstitu'];
$numregistro=$_POST['numregistro'];

$numpartida=$_POST['numpartida'];
$telempresa=$_POST['telempresa'];
$telofi=$_POST['telofi'];
$actmunicipal=$_POST['actmunicipal'];
$mailempresa=$_POST['mailempresa'];
$idtipdoc=intval("8");
$numdoc=$_POST['numdoc_solic'];



if($_POST['idsedereg3']==""){
$idsedereg3=0;
}else{
$idsedereg3=$_POST['idsedereg3'];
}



if ($ubigen==""){
$idubigeo=0;
}else{
$idubigeo=$codubi;
}

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


<div style="margin:20px;">


<fieldset >
<legend >Resultados</legend>
<table width="506" cellpadding="0" cellspacing="0">
<TR>
 <td colspan="2"><span style="color:red; margin-left:5px">Cliente</span>         <input id="cliente" name="cliente" type="text" value="<?php echo $razonsocial;?>" class="Estilo7" style="width:250px; text-transform:uppercase" onkeypress="sendCli(event);" readonly maxlength="80" />
          </span></td>
          <td width="150"><span style="color:red; margin-left:5px">RUC</span>
          <input id="cliente" name="cliente" value="<?php echo $numdoc; ?>" type="text" class="Estilo7" style="width:100px; text-transform:uppercase" onkeypress="sendDNI(event);" readonly maxlength="80" />  </td>
          <td width="21" height="50" align="right"><img src="../../iconos/cerrar.png" width="15" onclick="regresa_caja();" height="15" alt="cerrar"/></td>
<TR>
</Table>
<input id="idcliente_m" name="idcliente_m" value="<?php echo $ncliente; ?>" type="hidden" class="Estilo7" style="width:100px; text-transform:uppercase" readonly maxlength="80"/>
</fieldset>
</div>
