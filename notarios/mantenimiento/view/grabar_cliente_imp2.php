<?php 

include("../../conexion.php");

$tipper=$_POST['tipoper'];
$apepat=strtoupper(str_replace("ñ","Ñ",$_POST['apepat']));
$apemat=strtoupper(str_replace("ñ","Ñ",$_POST['apemat']));
$prinom=strtoupper(str_replace("ñ","Ñ",$_POST['prinom']));
$segnom=strtoupper(str_replace("ñ","Ñ",$_POST['segnom']));
$nombre=strtoupper($apepat." ".$apemat.", ".$prinom." ".$segnom);
$direccion=strtoupper(str_replace("ñ","Ñ",$_POST['direccion']));
$idtipdoc=intval(1);
 

if($_POST['numdoc']==""){
$numdoc="";
}else{
$numdoc=$_POST['numdoc'];	
}

$email=$_POST['email'];
$telfijo=$_POST['telfijo'];
$telcel=$_POST['telcel'];
$telofi=$_POST['telofi'];
$sexo=$_POST['sexo'];
$idestcivil=intval($_POST['idestcivil']);
$natper=$_POST['natper'];
$nacionalidad=intval($_POST['nacionalidad']);
$idprofesion=intval($_POST['idprofesion']);
$idcargoo=intval($_POST['idcargoo']);
$cumpclie=$_POST['cumpclie'];
$codubisc=$_POST['codubisc'];
$nomprofesiones=$_POST['nomprofesiones'];
$profocupa=$_POST['nomcargoss'];
$cconyuge="0";
$ubigensc=$_POST['ubigensc'];
$residente=$_POST['residente'];
$docpaisemi=$_POST['docpaisemi'];

if ($nomprofesiones==""){
$idprofesiioon=0;
}else{
$idprofesiioon=$idprofesion;
}

if ($profocupa==""){
$idcargoosss=0;
}else{
$idcargoosss=$idcargoo;
}


if ($ubigensc==""){
$idubigeoos=0;
}else{
$idubigeoos=$codubisc;
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


$grabarclientesc="INSERT INTO cliente (idcliente, tipper, apepat, apemat, prinom, segnom, nombre, direccion, idtipdoc, numdoc, email, telfijo, telcel, telofi, sexo, idestcivil, natper, conyuge, nacionalidad, idprofesion, detaprofesion, idcargoprofe, profocupa, dirfer, idubigeo, cumpclie, fechaing, razonsocial, domfiscal, telempresa, mailempresa, contacempresa, fechaconstitu, idsedereg, numregistro, numpartida, actmunicipal, tipocli, impeingre, impnumof, impeorigen, impentidad, impremite, impmotivo,residente,docpaisemi) VALUES ('$ncliente','$tipper','$apepat','$apemat','$prinom','$segnom','$nombre','$direccion','$idtipdoc','$numdoc','$email','$telfijo','$telcel','$telofi','$sexo','$idestcivil','$natper','$cconyuge','$nacionalidad','$idprofesiioon','$nomprofesiones','$idcargoosss','$profocupa','',$idubigeoos,'$cumpclie','','','','','','','',1,'','','','0','','','','','','','$residente','$docpaisemi')";
mysql_query($grabarclientesc,$conn) or die(mysql_error());



?>


<!-- aca empieza la webada-->

<!-- aca empieza la webada-->


<div style="margin:20px;">


<fieldset >
<legend >Resultados</legend>
<table width="506" cellpadding="0" cellspacing="0">
<TR>
 <td colspan="2"><span style="color:red; margin-left:5px">Cliente</span>         <input id="cliente" name="cliente" type="text" value="<?php echo $nombre;?>" class="Estilo7" style="width:250px; text-transform:uppercase" onkeypress="sendCli(event);" readonly maxlength="80" />
          </span></td>
          <td width="154"><span style="color:red; margin-left:5px">DNI</span>
          <input id="cliente" name="cliente" value="<?php echo $numdoc; ?>" type="text" class="Estilo7" style="width:100px; text-transform:uppercase" onkeypress="sendDNI(event);" readonly maxlength="80" />  </td>
          <td width="18" height="50" align="right"><img src="../../iconos/cerrar.png" width="15" onclick="regresa_caja();" height="15" alt="cerrar"/></td>
<TR>
</Table>
<input id="idcliente" name="idcliente" value="<?php echo $ncliente; ?>" type="hidden" class="Estilo7" style="width:100px; text-transform:uppercase" readonly maxlength="80"/>
</fieldset>
</div>
