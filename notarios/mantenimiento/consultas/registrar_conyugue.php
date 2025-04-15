	<?php
    
    include("../../extraprotocolares/view/funciones.php");
    
    $conexion = Conectar();
  
	$idcliente = $_REQUEST['c_cod'];
	$tipper = $_REQUEST['c_tipper'];
	$apepat = strtoupper($_REQUEST['c_apepat']);
	$apemat = strtoupper($_REQUEST['c_apemat']);
	$prinom = strtoupper($_REQUEST['c_prinom']);
	$segnom = strtoupper($_REQUEST['c_segnom']);
	$nombre = $apepat.' '.$apemat.', '.$prinom.' '.$segnom;
	if(trim($nombre==',')){$nombre="";}
	$direccion = strtoupper($_REQUEST['c_direccion']);
	$idtipdoc = $_REQUEST['c_tipdoc'];
	$numdoc = strtoupper($_REQUEST['c_doc']);
	$email = $_REQUEST['c_mail'];
	$telfijo = $_REQUEST['c_telefono'];
	$telcel = $_REQUEST['c_celular'];
	$telofi = $_REQUEST['c_telofi'];
	$sexo = $_REQUEST['c_sexo']; 
	$idestcivil = $_REQUEST['c_civil'];
	$natper = strtoupper($_REQUEST['c_natde']);
	$conyuge = strtoupper($_REQUEST['c_conyugue']);
	$nacionalidad = $_REQUEST['c_nacionalidad'];
	$idprofesion = $_REQUEST['c_profesiones'];
	$detaprofesion = strtoupper($_REQUEST['c_detprof']);
	$idcargoprofe = $_REQUEST['c_cargo'];
	$profocupa = strtoupper($_REQUEST['c_ocupacion']); 
	$idubigeo = $_REQUEST['c_idubigeo'];
	$cumpclie = $_REQUEST['c_fecnac'];
	$fechaing = $_REQUEST['c_fecha'];
	$razonsocial = strtoupper($_REQUEST['c_razon']);
	$domfiscal = $_REQUEST['c_domfis'];
	$telempresa = $_REQUEST['c_telemp'];
	$mailempresa = $_REQUEST['c_mailemp'];
	$contacempresa = $_REQUEST['c_contacto'];
	$fechaconstitu = $_REQUEST['c_feccons'];
	if (isset($_REQUEST['c_sede'])){$idsedereg = $_REQUEST['c_sede'];}else{$idsedereg = 0;}
	$numregistro = $_REQUEST['c_registro']; 
	$numpartida = $_REQUEST['c_partida'];
	$actmunicipal = $_REQUEST['c_acta']; 
	$residente = $_REQUEST['c_residente'];
	$docpaisemi = $_REQUEST['c_emision'];
	
	$tipocli = $_REQUEST['c_tipcliente'];
	if($tipocli=="on"){$tipocli=1;}else{$tipocli=0;}
	$impeingre =  $_REQUEST['c_impeingre'];
	$impnumof = $_REQUEST['c_impnumof'];
	$impeorigen =  $_REQUEST['c_impeorigen'];
	$impentidad = $_REQUEST['c_impentidad'];
	$impremite = $_REQUEST['c_impremite'];
	$impmotivo = $_REQUEST['c_impmotivo'];
	
	echo $sql_ccliente = "insert into cliente(idcliente, tipper, apepat, apemat, prinom, segnom, nombre, direccion, idtipdoc, numdoc, email, telfijo, telcel, telofi, sexo, idestcivil, natper, conyuge, nacionalidad, idprofesion, detaprofesion, idcargoprofe, profocupa, idubigeo, cumpclie, fechaing, razonsocial, domfiscal, telempresa, mailempresa, contacempresa, fechaconstitu, idsedereg, numregistro, numpartida, actmunicipal, tipocli, impeingre, impnumof, impeorigen, impentidad, impremite, impmotivo, residente, docpaisemi) values ('$idcliente', '$tipper', '$apepat', '$apemat', '$prinom', '$segnom', '$nombre', '$direccion', '$idtipdoc', '$numdoc', '$email', '$telfijo', '$telcel', '$telofi', '$sexo', '$idestcivil', '$natper', '$conyuge', '$nacionalidad', '$idprofesion', '$detaprofesion', '$idcargoprofe', '$profocupa', '$idubigeo', '$cumpclie', '$fechaing', '$razonsocial', '$domfiscal', '$telempresa', '$mailempresa', '$contacempresa', '$fechaconstitu', '$idsedereg', '$numregistro', '$numpartida', '$actmunicipal', '$tipocli', '$impeingre', '$impnumof', '$impeorigen', '$impentidad', '$impremite', '$impmotivo', '$residente', '$docpaisemi')";
	
	$exe_ccliente = mysql_query($sql_ccliente, $conexion);
	
	?>