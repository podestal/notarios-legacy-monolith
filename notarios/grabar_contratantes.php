<?php 
 session_start();
include("conexion.php");

$idtipkar   		= $_POST['idtipkar'];
$codkardex  		= $_POST['codkardex'];
$condicion  		= $_POST['codcon'];
	
$resfirma   		= "0";
$tiporepresentacion	=$_POST['repre'];
$idcontratanterp  	=$_POST['representaa'];
$facultades		  	=$_POST['facultades'];
$visita			  	="0";
$codclie		  	=$_POST['codclie'];
$firma			  	=$_POST['firma'];
$indice			  	=$_POST['indice'];
$inscrito		  	=$_POST['inscrito'];
$idsedregrp       	= $_POST['idsederegerp'];
$numparti         	= $_POST['nparti'];

$consulta = mysql_query("Select * from contratantes order by idcontratante DESC LIMIT 1", $conn) or die(mysql_error());

$row = mysql_fetch_array($consulta);

$numero=$row['idcontratante'];
$suma= intval($numero) + 1;
$cantidad= strlen($suma);


 switch ($cantidad) {
	case "1":
	$ncontratante="000000000".$suma;
	break;
	case "2":
	$ncontratante="00000000".$suma;	
	break;
	case "3":
	$ncontratante="0000000".$suma;
	break;
	case "4":
	$ncontratante="000000".$suma;	
	break;
	case "5":
	$ncontratante="00000".$suma;
	break;
	case "6":
	$ncontratante="0000".$suma;	
	break;		
	case "7":
	$ncontratante="000".$suma;	
	break;	
	case "8":
	$ncontratante="00".$suma;	
	break;	
	case "9":
	$ncontratante="0".$suma;	
	break;
	case "10":
	$ncontratante=$suma;	
	break;			
}

$contratantes="INSERT INTO contratantes(idcontratante, idtipkar, kardex, condicion, firma, fechafirma, resfirma, tiporepresentacion, idcontratanterp, idsedereg, numpartida, facultades, indice, visita,inscrito) VALUES ('$ncontratante','$idtipkar','$codkardex','$condicion','$firma','','$resfirma','$tiporepresentacion','$idcontratanterp','$idsedregrp','$numparti','$facultades','$indice','$visita','$inscrito')"; 
mysql_query($contratantes,$conn) or die(mysql_error());

	if($idcontratanterp!=""){
		$sqlIdCliente="SELECT idcliente from cliente2 where idcontratante ='".$idcontratanterp."' LIMIT 1";
		$queryIdCliente=mysql_query($sqlIdCliente,$conn);
		$rowIdCliente=mysql_fetch_array($queryIdCliente);
		$xxidCliente=$rowIdCliente["idcliente"];
		mysql_query("INSERT INTO representantes (idcontratante, kardex, facultades, inscrito, sede_registral,partida,idcontratante_r) VALUES ('$ncontratante','$codkardex','$facultades','$inscrito','$idsedregrp','$numparti','$xxidCliente')",$conn) or die (mysql_error());  

	}
$cliente="select * from cliente where idcliente='$codclie'"; 
$respuesta=mysql_query($cliente,$conn) or die(mysql_error());
$rowclie=mysql_fetch_array($respuesta);

$tipper=$rowclie['tipper'];
$apepat=strtoupper($rowclie['apepat']);
$apemat=strtoupper($rowclie['apemat']); 
$prinom=strtoupper($rowclie['prinom']);
$segnom=strtoupper($rowclie['segnom']); 
$nombre=strtoupper($rowclie['nombre']); 
$direccion=strtoupper($rowclie['direccion']); 
$idtipdoc=$rowclie['idtipdoc']; 
$numdoc=$rowclie['numdoc']; 
$email=$rowclie['email']; 
$telfijo=$rowclie['telfijo']; 
$telcel=$rowclie['telcel']; $telofi=$rowclie['telofi']; $sexo=strtoupper($rowclie['sexo']); $idestcivil=strtoupper($rowclie['idestcivil']); $natper=strtoupper($rowclie['natper']); $conyuge=$rowclie['conyuge']; $nacionalidad=strtoupper($rowclie['nacionalidad']); $idprofesion=$rowclie['idprofesion']; $profocupa=$rowclie['profocupa']; $dirfer=$rowclie['dirfer']; $idubigeo=$rowclie['idubigeo']; $cumpclie=$rowclie['cumpclie']; $fechaing=$rowclie['fechaing']; $razonsocial=strtoupper($rowclie['razonsocial']); $domfiscal=strtoupper($rowclie['domfiscal']); $telempresa=$rowclie['telempresa']; $mailempresa=$rowclie['mailempresa']; $contacempresa=strtoupper($rowclie['contacempresa']); $fechaconstitu=$rowclie['fechaconstitu']; $idsedereg=$rowclie['idsedereg']; $numregistro=$rowclie['numregistro']; $numpartida=$rowclie['numpartida']; $actmunicipal=$rowclie['actmunicipal']; $tipocli=$rowclie['tipocli']; $impeingre=$rowclie['impeingre']; $impnumof=$rowclie['impnumof']; $impeorigen=$rowclie['impeorigen']; $impentidad=$rowclie['impentidad']; $impremite=strtoupper($rowclie['impremite']); $impmotivo=strtoupper($rowclie['impmotivo']);$idcargoo=$rowclie['idcargoprofe']; $detaprofesion=$rowclie['detaprofesion']; $residente=$rowclie['residente'];$docpaisemi=$rowclie['docpaisemi'];
$ubigeoPlantilla=$rowclie['ubigeo_plantilla'];



if($idprofesion=="")
	$idprofesion="0";

if($idcargoo=="")
	$idcargoo="0";

$cliente2="INSERT INTO cliente2(idcontratante, idcliente, tipper, apepat, apemat, prinom, segnom, nombre, direccion, idtipdoc, numdoc, email, telfijo, telcel, telofi, sexo, idestcivil, natper, conyuge, nacionalidad, idprofesion, detaprofesion, idcargoprofe, profocupa, dirfer, idubigeo, cumpclie, fechaing, razonsocial, domfiscal, telempresa, mailempresa, contacempresa, fechaconstitu, idsedereg, numregistro, numpartida, actmunicipal, tipocli, impeingre, impnumof, impeorigen, impentidad, impremite, impmotivo,residente,docpaisemi,ubigeo_plantilla) VALUES ('$ncontratante','$codclie','$tipper','$apepat','$apemat','$prinom', '$segnom', '$nombre', '$direccion','$idtipdoc', '$numdoc', '$email', '$telfijo', '$telcel', '$telofi', '$sexo', '$idestcivil', '$natper', '$conyuge', '$nacionalidad', '$idprofesion','$detaprofesion','$idcargoo','$profocupa', '$dirfer', '$idubigeo', '$cumpclie', '$fechaing', '$razonsocial', '$domfiscal', '$telempresa', '$mailempresa', '$contacempresa', '$fechaconstitu', '$idsedereg', '$numregistro', '$numpartida', '$actmunicipal', '$tipocli', '$impeingre', '$impnumof', '$impeorigen', '$impentidad', '$impremite', '$impmotivo','$residente','','$ubigeoPlantilla')"; 

mysql_query($cliente2,$conn) or die(mysql_error());


$condiciones=explode("/",$condicion);
	$condi1=$condiciones[0];
	$condi2=$condiciones[1];
	$condi3=$condiciones[2];
	$condi4=$condiciones[3];
	$condi5=$condiciones[4];
	$condi6=$condiciones[5];
	$condi7=$condiciones[6];
	$condi8=$condiciones[7];
	$condi9=$condiciones[8];
	$condi10=$condiciones[9];
	
	$ressepa=explode(".",$condi1);
	$codcondi=$ressepa[0]; $item0=$ressepa[1];
	
	$ressepa1=explode(".",$condi2);
	$codcondi1=$ressepa1[0]; $item1=$ressepa1[1];
	
	$ressepa2=explode(".",$condi3);
	$codcondi2=$ressepa2[0]; $item2=$ressepa2[1];
	
	$ressepa3=explode(".",$condi4);
	$codcondi3=$ressepa3[0]; $item3=$ressepa3[1];
	
	$ressepa4=explode(".",$condi5);
	$codcondi4=$ressepa4[0]; $item4=$ressepa4[1];
	
	$ressepa5=explode(".",$condi6);
	$codcondi5=$ressepa5[0]; $item5=$ressepa5[1];
	
	$ressepa6=explode(".",$condi7);
	$codcondi6=$ressepa6[0]; $item6=$ressepa6[1];
	
	$ressepa7=explode(".",$condi8);
	$codcondi7=$ressepa7[0]; $item7=$ressepa7[1];
	
	$ressepa8=explode(".",$condi9);
	$codcondi8=$ressepa8[0]; $item8=$ressepa8[1];
	
	$ressepa9=explode(".",$condi10);
	$codcondi9=$ressepa9[0]; $item9=$ressepa9[1];
	
	$condicionesss = array($codcondi,$codcondi1,$codcondi2,$codcondi3,$codcondi4,$codcondi5,$codcondi6,$codcondi7,$codcondi8,$codcondi9);
	$itemsss= array($item0,$item1,$item2,$item3,$item4,$item5,$item6,$item7,$item8,$item9);
	
	$i=0;
	while ($i < count ($condicionesss) ) {
		$numitem=$condicionesss[$i];
        $consulta=mysql_query("SELECT * FROM actocondicion WHERE idcondicion='$numitem'", $conn) or die(mysql_error());
		$rowpendex=mysql_fetch_array($consulta);
		if(!empty($rowpendex)){
		        $condition=$rowpendex['idcondicion']; $parte=$rowpendex['parte']; $idtipoacto=$rowpendex['idtipoacto']; $itemm=$itemsss[$i]; $uif=$rowpendex['uif']; $formu=$rowpendex['formulario']; $montop=$rowpendex['montop'];
				                                       
				$sqlxxx="INSERT INTO contratantesxacto(id, idtipkar, kardex, idtipoacto, idcontratante, item, idcondicion, parte, porcentaje, uif, formulario, monto, opago, ofondo, montop) VALUES ( NULL, '$idtipkar','$codkardex','$idtipoacto','$ncontratante','$itemm','$condition','$parte','','$uif','$formu','','','','$montop')";
				mysql_query($sqlxxx,$conn) or die(mysql_error());    
						
					}
		
		$i++;
		}

 


mysql_query("UPDATE cliente SET tipper='J' WHERE tipper='' AND razonsocial!='' AND (idtipdoc='8' OR idtipdoc='10')",$conn) or die(mysql_error());
mysql_query("UPDATE cliente2 SET tipper='J' WHERE tipper='' AND razonsocial!='' AND (idtipdoc='8' OR idtipdoc='10')",$conn) or die(mysql_error());

mysql_query("UPDATE cliente SET tipper='N' WHERE tipper='' AND (idtipdoc!='8' OR idtipdoc!='10')",$conn) or die(mysql_error());
mysql_query("UPDATE cliente2 SET tipper='N' WHERE tipper='' AND (idtipdoc!='8' OR idtipdoc!='10')",$conn) or die(mysql_error());

	
?>
