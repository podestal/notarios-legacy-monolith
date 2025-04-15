	<?php
    
    include("../../extraprotocolares/view/funciones.php");
    include("../../conexion.php");
    $conexion = Conectar();
    
	$idcliente = $_REQUEST['m_cod'];
	
	$tipper = $_REQUEST['m_tipper'];
	$apepat = strtoupper($_REQUEST['m_apepat']);
	$apemat = strtoupper($_REQUEST['m_apemat']);
	$prinom = strtoupper($_REQUEST['m_prinom']);
	$segnom = strtoupper($_REQUEST['m_segnom']);
	$nombre = $apepat.' '.$apemat.', '.$prinom.' '.$segnom;
	if(trim($nombre==',')){$nombre="";}
	$direccion = strtoupper($_REQUEST['m_direccion']);
	$idtipdoc = $_REQUEST['m_tipdoc'];
	$numdoc = strtoupper($_REQUEST['m_doc']);
	$email = $_REQUEST['m_mail'];
	$telfijo = $_REQUEST['m_telefono'];
	$telcel = $_REQUEST['m_celular'];
	$telofi = $_REQUEST['m_telofi'];
	$sexo = $_REQUEST['m_sexo']; 
	$idestcivil = $_REQUEST['m_civil'];
	$natper = strtoupper($_REQUEST['m_natde']);
	$conyuge = $_REQUEST['m_conyugue'];
	if($idestcivil<>"2"){$conyuge="";}
	$nacionalidad = $_REQUEST['m_nacionalidad'];
	$idprofesion = $_REQUEST['m_profesiones'];
	$detaprofesion = strtoupper($_REQUEST['m_detprof']);
	$idcargoprofe = $_REQUEST['m_cargo'];
	$profocupa = strtoupper($_REQUEST['m_ocupacion']); 
	$idubigeo = $_REQUEST['m_idubigeo'];
	$cumpclie = $_REQUEST['m_fecnac'];
	$fechaing = $_REQUEST['m_fecha'];
	$razonsocial = strtoupper($_REQUEST['m_razon']);
	$domfiscal = $_REQUEST['m_domfis'];
	$telempresa = $_REQUEST['m_telemp'];
	$mailempresa = $_REQUEST['m_mailemp'];
	$contacempresa = $_REQUEST['m_contacto'];
	$fechaconstitu = $_REQUEST['m_feccons'];
	if (isset($_REQUEST['m_sede'])){$idsedereg = $_REQUEST['m_sede'];}else{$idsedereg = 0;}
	$numregistro = $_REQUEST['m_registro']; 
	$numpartida = $_REQUEST['m_partida'];
	$actmunicipal = $_REQUEST['m_acta']; 
	$residente = $_REQUEST['m_residente'];
	$docpaisemi = $_REQUEST['m_emision'];
	
	$tipocli = $_REQUEST['m_tipcliente'];
	if($tipocli=="on"){$tipocli=1;}else{$tipocli=0;}
	$impeingre =  $_REQUEST['m_impeingre'];
	$impnumof = $_REQUEST['m_impnumof'];
	$impeorigen =  $_REQUEST['m_impeorigen'];
	$impentidad = $_REQUEST['m_impentidad'];
	$impremite = $_REQUEST['m_impremite'];
	$impmotivo = $_REQUEST['m_impmotivo'];

	$sql_mcliente = "update cliente set tipper='$tipper', apepat='$apepat', apemat='$apemat', prinom='$prinom', segnom='$segnom', nombre='$nombre', direccion='$direccion', idtipdoc='$idtipdoc', numdoc='$numdoc', email='$email', telfijo='$telfijo', telcel='$telcel', telofi='$telofi', sexo='$sexo', idestcivil='$idestcivil', natper='$natper', conyuge='$conyuge', nacionalidad='$nacionalidad',idprofesion='$idprofesion', detaprofesion='$detaprofesion', idcargoprofe='$idcargoprofe', profocupa='$profocupa', idubigeo='$idubigeo', cumpclie='$cumpclie', razonsocial='$razonsocial', domfiscal='$domfiscal', telempresa='$telempresa', mailempresa='$mailempresa', contacempresa='$contacempresa', fechaconstitu='$fechaconstitu', idsedereg='$idsedereg', numregistro='$numregistro', numpartida='$numpartida', actmunicipal='$actmunicipal', tipocli='$tipocli', impeingre='$impeingre', impnumof='$impnumof', impeorigen='$impeorigen', impentidad='$impentidad', impremite='$impremite', impmotivo='$impmotivo', residente='$residente', docpaisemi='$docpaisemi' where cliente.idcliente='$idcliente'";
				  
    $exe_mcliente = mysql_query($sql_mcliente, $conexion);
	
	?>
	
    
