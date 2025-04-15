<?php

	include("../extraprotocolares/view/funciones.php");
		
	$conexion = Conectar();

	$tipper = $_REQUEST['n_tipper'];
	$apepat = strtoupper($_REQUEST['n_apepat']);
	$apemat = strtoupper($_REQUEST['n_apemat']);
	$prinom = strtoupper($_REQUEST['n_prinom']);
	$segnom = strtoupper($_REQUEST['n_segnom']);
	$nombre = $apepat.' '.$apemat.', '.$prinom.' '.$segnom;
	if(trim($nombre==',')){$nombre="";}
	$direccion = strtoupper($_REQUEST['n_dir']);
	$idtipdoc = $_REQUEST['n_tipdoc'];
	$numdoc = strtoupper($_REQUEST['n_numdoc']);
	$email = $_REQUEST['n_email'];
	$telfijo = $_REQUEST['n_telfijo'];
	$telcel = $_REQUEST['n_telcel'];
	$telofi = $_REQUEST['n_telofi'];
	$sexo = $_REQUEST['n_sexo']; 
	if (isset($_REQUEST['n_civil'])){$idestcivil = $_REQUEST['n_civil'];}else{$idestcivil = 0;}
	$natper = strtoupper($_REQUEST['n_natde']);
	if($idestcivil<>"2"){$conyuge="";}
	$conyuge = strtoupper($_REQUEST['n_conyugue']);
	$nacionalidad = $_REQUEST['n_nac'];
	if (isset($_REQUEST['n_idocupacion'])){$idprofesion = $_REQUEST['n_idocupacion']; }else{$idprofesion = 0;}
	$detaprofesion = strtoupper($_REQUEST['n_detprof']);
	if (isset($_REQUEST['n_idcargo'])){$idcargoprofe = $_REQUEST['n_idcargo'];}else{$idcargoprofe = 0;}
	if (isset($_REQUEST['n_idocupacion'])){$profocupa = $_REQUEST['n_idocupacion'];}else{$profocupa = 0;} 
	$idubigeo = $_REQUEST['n_idubigeo'];
	$cumpclie = $_REQUEST['n_fecnac'];
	$fechaing = $_REQUEST['n_fecha'];
	$razonsocial = strtoupper($_REQUEST['n_razon']);
	$domfiscal = $_REQUEST['domfiscal'];
	$telempresa = $_REQUEST['n_telemp'];
	$mailempresa = $_REQUEST['n_mailemp'];
	$contacempresa = $_REQUEST['n_contacto'];
	$fechaconstitu = $_REQUEST['n_feccons'];
	if (isset($_REQUEST['n_sede'])){$idsedereg = $_REQUEST['n_sede'];}else{$idsedereg = 0;}
	$numregistro = $_REQUEST['n_registro']; 
	$numpartida = $_REQUEST['n_partida'];
	$actmunicipal = $_REQUEST['n_acta']; 
	if(isset($_REQUEST['n_residente'])){$residente=1;}else{$residente=0;}
	$docpaisemi = $_REQUEST['n_paisemi'];
	if(isset($_REQUEST['m_tipcliente'])){$tipocli=1;}else{$tipocli=0;}
	$impeingre =  $_REQUEST['n_impeingre'];
	$impnumof = $_REQUEST['n_impnumof'];
	$impeorigen =  $_REQUEST['n_impeorigen'];
	$impentidad = $_REQUEST['n_impentidad'];
	$impremite = $_REQUEST['n_impremite'];
	$impmotivo = $_REQUEST['n_impmotivo'];
	
	$sql_idcliente = "SELECT cliente.idcliente AS idcliente FROM cliente ORDER BY cast(idcliente as unsigned) DESC";
	$exe_idcliente = mysql_query($sql_idcliente, $conexion);
	$row_idcliente = mysql_fetch_array($exe_idcliente);
	$new_idcliente = $row_idcliente[0] + 1;
	$new_idcliente = correlativo_numero10($new_idcliente);
	
	$sql_buscardoc = "SELECT cliente.idcliente, cliente.numdoc AS idcliente FROM cliente where cliente.numdoc=$numdoc"; 
	$exe_buscardoc = mysql_query($sql_buscardoc, $conexion);
	$existe_doc = mysql_num_rows($exe_buscardoc);
	
	if($existe_doc==0){
		
		$sql_ncliente = "insert into cliente(idcliente, tipper, apepat, apemat, prinom, segnom, nombre, direccion, idtipdoc, numdoc, email, telfijo, telcel, telofi, sexo, idestcivil, natper, conyuge, nacionalidad, idprofesion, detaprofesion, idcargoprofe, profocupa, idubigeo, cumpclie, fechaing, razonsocial, domfiscal, telempresa, mailempresa, contacempresa, fechaconstitu, idsedereg, numregistro, numpartida, actmunicipal, tipocli, impeingre, impnumof, impeorigen, impentidad, impremite, impmotivo, residente, docpaisemi) values ('$new_idcliente', '$tipper', '$apepat', '$apemat', '$prinom', '$segnom', '$nombre', '$direccion', '$idtipdoc', '$numdoc', '$email', '$telfijo', '$telcel', '$telofi', '$sexo', '$idestcivil', '$natper', '$conyuge', '$nacionalidad', '$idprofesion', '$detaprofesion', '$idcargoprofe', '$profocupa', '$idubigeo', '$cumpclie', '$fechaing', '$razonsocial', '$domfiscal', '$telempresa', '$mailempresa', '$contacempresa', '$fechaconstitu', '$idsedereg', '$numregistro', '$numpartida', '$actmunicipal', '$tipocli', '$impeingre', '$impnumof', '$impeorigen', '$impentidad', '$impremite', '$impmotivo', '$residente', '$docpaisemi')";
		
		$exe_ncliente = mysql_query($sql_ncliente, $conexion);
		
		echo json_encode($new_idcliente);
	
	}else{
		
		echo json_encode("NO");
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
?>