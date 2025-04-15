<?php 

	include("../../conexion.php");
	
	$apepatexto=strtoupper($_REQUEST['apepatcnt']);
	$cabioapostroa=str_replace("'","?",$apepatexto);
	$apepat3=strtoupper($cabioapostroa);

	$apemattexto=strtoupper($_REQUEST['apematcnt']);
	$cabioapostrom=str_replace("'","?",$apemattexto);
	$apemat3=strtoupper($cabioapostrom);

	$prinomp=strtoupper($_REQUEST['prinomcnt']);
	$cabioapostrop=str_replace("'","?",$prinomp);
	$prinom3=strtoupper($cabioapostrop);

	$segnomp=strtoupper($_REQUEST['segnomcnt']);
	$cabioapostromm=str_replace("'","?",$segnomp);
	$segnom3=strtoupper($cabioapostromm);


	$nombre3		= $apepat3." ".$apemat3.", ".$prinom3." ".$segnom3;
	
	$direccion=strtoupper($_REQUEST['direccioncnt']);
	$direccion2=str_replace("'","?",$direccion);
	$direccion3=strtoupper($direccion2);


	$numdoc3		= $_REQUEST['numdoccnt'];
	$email3			= $_REQUEST['emailcnt'];
	$telfijo3		= $_REQUEST['telfijocnt'];
	$telcel3		= $_REQUEST['telcelcnt'];
	$telofi3		= $_REQUEST['teloficnt'];
	$sexo3			= $_REQUEST['sexocnt'];
	$idestcivil3	= intval($_REQUEST['idestcivilcnt']);
	$natper3		= strtoupper($_REQUEST['natpercnt']);
	$nacionalidad3	= intval($_REQUEST['nacionalidadcnt']);
	$idprofesion3	= intval($_REQUEST['idprofesioncnt']);
	$idcargoo3		= intval($_REQUEST['idcargoocnt']);
	$cumpclie3		= $_REQUEST['cumpcliecnt'];
	$codubisc3		= $_REQUEST['codubisccnt'];
	$nomprofesiones3= $_REQUEST['nomprofesionescnt'];
	$profocupa3		= $_REQUEST['nomcargosscnt'];
	$ubigensc3		= $_REQUEST['ubigensccnt'];
	$residente3		= strtoupper($_REQUEST['residentecnt']);
	$docpaisemi3	= $_REQUEST['docpaisemicnt'];
	$codclie3		= $_REQUEST['codcliecnt'];
	$cconyuge6		= $_REQUEST['cconyugecnt'];

	if ($nomprofesiones3==""){
	$idprofesiioon3=0;
	}else{
	$idprofesiioon3=$idprofesion3;
	}
	
	if ($profocupa3==""){
	$idcargoosss3=0;
	}else{
	$idcargoosss3=$idcargoo3;
	}
	
	
	if ($ubigensc3==""){
	$idubigeoos3=0;
	}else{
	$idubigeoos3=$codubisc3;
	}

// UPDATEA LA TABLA CLIENTES : 
	$grabarclientesc2 = "UPDATE cliente SET apepat='$apepat3',apemat='$apemat3',prinom='$prinom3',segnom='$segnom3',nombre='$nombre3',direccion='$direccion3',email='$email3',telfijo='$telfijo3',telcel='$telcel3',telofi='$telofi3',sexo='$sexo3',idestcivil='$idestcivil3',natper='$natper3',nacionalidad='$nacionalidad3',idprofesion='$idprofesiioon3',detaprofesion='$nomprofesiones3',idcargoprofe='$idcargoosss3',profocupa='$profocupa3',idubigeo='$idubigeoos3',cumpclie='$cumpclie3',residente='$residente3',docpaisemi='$docpaisemi3' WHERE numdoc='$numdoc3'";
	mysql_query($grabarclientesc2,$conn) or die(mysql_error());

// UPDATEA LA TABLA poderes_contratantes : 
$grabarpodercontratantes="UPDATE viaje_contratantes SET viaje_contratantes.c_codcontrat = '$numdoc3', viaje_contratantes.c_descontrat = '$nombre3' WHERE viaje_contratantes.c_codcontrat = '$numdoc3'";
	mysql_query($grabarpodercontratantes,$conn) or die(mysql_error());
	
	if ($cconyuge6!=""){
	
	$grabarconyugee="update cliente set conyuge='$codclie3' where numdoc='$cconyuge6'";
	mysql_query($grabarconyugee,$conn) or die(mysql_error());

}

// Encodea a JSON para ver los datos:
	$sqldata = mysql_query("SELECT * FROM cliente WHERE cliente.numdoc = '$numdoc3'");
	$rows = array();
	while($r = mysql_fetch_assoc($sqldata)) {
	  $rows[] = $r;
	}
	echo json_encode($rows);

?>