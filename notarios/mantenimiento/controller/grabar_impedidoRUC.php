<?php 

include("../../conexion.php");

$tipper  	= $_POST['tipoper'];
$apepat 	= "";
$apemat	  	= "";
$prinom 	= "";
$segnom		= "";
$nombre		= "";
$direccion	= "";
$idtipdoc	= intval($_POST['tipodoc']);
$numdoc		= $_POST['numdoc'];
$email		= "";
$telfijo	= "";
$telcel		= "";
$telofi		= "";
$sexo		= "";
$idestcivil	= 0;
$natper		= "";
$nacionalidad 	= 0;
$idprofesion	= 0;
$idcargoo	= 0;
$cumpclie	= "";
$nomprofesiones = "";
$profocupa	= "";
$residente	= "";
$docpaisemi	= "";

// DATOS DE EMPRESA
$razonsocial    = $_POST['razonsocial'];
$domfiscal      = $_POST['domfiscal'];
$ubigensc       = $_POST['ubigen2'];
$contacempresa  = $_POST['contacempresa'];
$fechaconstitu  = $_POST['fechaconstitu'];
$numregistro    = $_POST['numregistro'];
$idsedereg3     = $_POST['idsedereg3'];
$numpartida     = $_POST['numpartida'];
$telempresa     = $_POST['telempresa'];
$actmunicipal   = $_POST['actmunicipal'];
$mailempresa    = $_POST['mailempresa'];
$codubisc       = $_POST['codubisc4'];

//Datos de Impedido:
$fechaing 	= $_POST["fechaing"];
$oficio 	= $_POST["oficio"];
$origen 	= $_POST["origen"];
$motivo 	= $_POST["motivo"];
$pep 	    = "0";//$_POST["pep"];
$laft 	    = "0";//$_POST["laft"];

// NEW * :
$entidad 	= $_POST["entidad"];
$remite 	= $_POST["remite"];


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

## crea el ID para el nuevo cliente impedido: ##
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
#=====================================================#
# Crea el ID para la tabla Impedidos #
$consulimpedido = mysql_query("SELECT MAX(impedidos.idimpedido) FROM impedidos", $conn) or die(mysql_error());

$row = mysql_fetch_array($consulimpedido);

$numeImpe = $row[0];
$sumaI = intval($numeImpe) + 1;
$cantidadI = strlen($sumaI);

 switch ($cantidadI) {
	case "1":
	$nimpedido = "000000000".$sumaI;
	break;
	case "2":
	$nimpedido = "00000000".$sumaI;	
	break;
	case "3":
	$nimpedido = "0000000".$sumaI;
	break;
	case "4":
	$nimpedido = "000000".$sumaI;	
	break;
	case "5":
	$nimpedido = "00000".$sumaI;
	break;
	case "6":
	$nimpedido = "0000".$sumaI;	
	break;		
	case "7":
	$nimpedido = "000".$sumaI;	
	break;	
	case "8":
	$nimpedido = "00".$sumaI;	
	break;	
	case "9":
	$nimpedido = "0".$sumaI;	
	break;
	case "10":
	$nimpedido = $sumaI;	
	break;			
}


###################################
### GRABAR CLIENTES (IMPEDIDO) ###
$grabarclientesc = "INSERT INTO cliente (idcliente, tipper, apepat, apemat, prinom, segnom, nombre, direccion, idtipdoc, numdoc, email, telfijo, telcel, telofi, sexo, idestcivil, natper, conyuge, nacionalidad, idprofesion, detaprofesion, idcargoprofe, profocupa, dirfer, idubigeo, cumpclie, fechaing, razonsocial, domfiscal, telempresa, mailempresa, contacempresa, fechaconstitu, idsedereg, numregistro, numpartida, actmunicipal, tipocli, impeingre, impnumof, impeorigen, impentidad, impremite, impmotivo,residente,docpaisemi) VALUES ('$ncliente','$tipper','$apepat','$apemat','$prinom','$segnom','$nombre','$direccion','$idtipdoc','$numdoc','$email','$telfijo','$telcel','$telofi','$sexo','$idestcivil','$natper','','$nacionalidad','$idprofesiioon','$nomprofesiones','$idcargoosss','$profocupa','',$idubigeoos,'$cumpclie','','$razonsocial','$domfiscal','$telempresa','$mailempresa','$contacempresa','$fechaconstitu',$idsedereg3,'$numregistro','$numpartida','$actmunicipal','1','$fechaing','$oficio','$origen','$entidad','$remite','$motivo','$residente','$docpaisemi')";
mysql_query($grabarclientesc,$conn) or die(mysql_error());
###################################


###################################
###    GRABAR DATOS IMPEDIDO    ###

$grabDatImpedido = "INSERT INTO impedidos (idimpedido, idcliente, fechaing, oficio, origen, motivo, pep, laft)
VALUES ('$nimpedido', '$ncliente', '$fechaing', '$oficio', '$origen', '$motivo', '$pep', '$laft')";
mysql_query($grabDatImpedido,$conn) or die(mysql_error());

###################################


if ($cconyuge!=""){

$grabarconyugee="update cliente set conyuge='$ncliente' where idcliente='$cconyuge'";
mysql_query($grabarconyugee,$conn) or die(mysql_error());

}

?>


