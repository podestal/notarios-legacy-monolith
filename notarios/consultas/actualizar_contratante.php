<?php

	include("../extraprotocolares/view/funciones.php");
		
	$conexion = Conectar();
	
	$idcontratante = $_REQUEST['id'];
	$idcliente = $_REQUEST['idcliente'];
	$tipper = $_REQUEST['m_tipper'];
	$apepat = strtoupper($_REQUEST['m_apepat']);
	$apemat = strtoupper($_REQUEST['m_apemat']);
	$prinom = strtoupper($_REQUEST['m_prinom']);
	$segnom = strtoupper($_REQUEST['m_segnom']);
	$nombre = $apepat.' '.$apemat.', '.$prinom.' '.$segnom;
	if(trim($nombre==',')){$nombre="";}
	$direccion = strtoupper($_REQUEST['m_dir']);
	$idtipdoc = $_REQUEST['m_tipdoc'];
	$numdoc = strtoupper($_REQUEST['m_numdoc']);
	$email = $_REQUEST['m_email'];
	$telfijo = $_REQUEST['m_telfijo'];
	$telcel = $_REQUEST['m_telcel'];
	$telofi = $_REQUEST['telofi']; 
	$sexo = $_REQUEST['m_sexo'];
	if (isset($_REQUEST['m_civil'])){$idestcivil = $_REQUEST['m_civil'];}else{$idestcivil = 0;}
	$natper = strtoupper($_REQUEST['m_natde']);
	$conyuge =strtoupper($_REQUEST['m_conyugue']);
	$nacionalidad = $_REQUEST['m_nac'];
	if (isset($_REQUEST['m_idocupacion'])){$idprofesion = $_REQUEST['m_idocupacion']; }else{$idprofesion = 0;}
	$detaprofesion = strtoupper($_REQUEST['m_detprofesion']);
	if (isset($_REQUEST['m_idcargo'])){$idcargoprofe = $_REQUEST['m_idcargo'];}else{$idcargoprofe = 0;}
	if (isset($_REQUEST['m_idocupacion'])){$profocupa = $_REQUEST['m_idocupacion'];}else{$profocupa = 0;} 
	$dirfer = $_REQUEST[''];
	$idubigeo = $_REQUEST['m_idubigeo'];
	$cumpclie = $_REQUEST['m_fecnac'];
	$fechaing = $_REQUEST[''];
	$razonsocial = strtoupper($_REQUEST['m_razon']);
	$domfiscal = $_REQUEST['m_domfiscal'];
	$telempresa = $_REQUEST['m_telfemp'];
	$mailempresa = $_REQUEST['m_mailemp'];
	$contacempresa = $_REQUEST['m_contacto'];
	$fechaconstitu = $_REQUEST['m_feccons'];
	if (isset($_REQUEST['m_sede'])){$idsedereg = $_REQUEST['m_sede'];}else{$idsedereg = 0;}
	$numregistro = $_REQUEST['m_numreg'];
	$numpartida = $_REQUEST['m_partida'];
	$actmunicipal = $_REQUEST[''];
	if(isset($_REQUEST['m_tipcliente'])){$tipocli=1;}else{$tipocli=0;}
	$impeingre = $_REQUEST[''];
	$impnumof = $_REQUEST[''];
	$impeorigen = $_REQUEST[''];
	$impentidad = $_REQUEST[''];
	$impremite = $_REQUEST[''];
	$impmotivo = $_REQUEST[''];
	if(isset($_REQUEST['m_res'])){$residente=1;}else{$residente=0;}
	$docpaisemi = $_REQUEST['m_paisemi'];

	$sql_udpcliente = "update cliente2 set idcliente='$idcliente', tipper='$tipper', apepat='$apepat', apemat='$apemat', prinom='$prinom', segnom='$segnom', nombre='$nombre', direccion='$direccion', idtipdoc='$idtipdoc', numdoc='$numdoc', email='$email', telfijo='$telfijo', telcel='$telcel', telofi='$telofi', sexo='$sexo', idestcivil='$idestcivil', natper='$natper', conyuge='$conyuge', nacionalidad='$nacionalidad', idprofesion='$idprofesion', detaprofesion='$detaprofesion', idcargoprofe='$idcargoprofe', profocupa='$profocupa', dirfer='$dirfer', idubigeo='$idubigeo', cumpclie='$cumpclie', fechaing='$fechaing', razonsocial='$razonsocial', domfiscal='$domfiscal', telempresa='$telempresa', mailempresa='$mailempresa', contacempresa='$contacempresa', fechaconstitu='$fechaconstitu', idsedereg='$idsedereg', numregistro='$numregistro', numpartida='$numpartida', actmunicipal='$actmunicipal', tipocli='$tipocli', impeingre='$impeingre', impnumof='$impnumof', impeorigen='$impeorigen', impentidad='$impentidad', impremite='$impremite', impmotivo='$impmotivo', residente='$residente', docpaisemi='$docpaisemi' where cliente2.idcontratante ='$idcontratante'";
	
	$exe_udpcliente = mysql_query($sql_udpcliente, $conexion);
	
	
	
?>