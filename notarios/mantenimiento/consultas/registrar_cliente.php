	<?php
    
    include("../../extraprotocolares/view/funciones.php");
    
    $conexion = Conectar();
  
	$idcliente = $_REQUEST['n_cod'];
	$tipper = $_REQUEST['tip_per'];
	$apepat = strtoupper($_REQUEST['n_apepat']);
	$apemat = strtoupper($_REQUEST['n_apemat']);
	$prinom = strtoupper($_REQUEST['n_prinom']);
	$segnom = strtoupper($_REQUEST['n_segnom']);
	$nombre = $apepat.' '.$apemat.', '.$prinom.' '.$segnom;
	if(trim($nombre==',')){$nombre="";}
	$direccion = strtoupper($_REQUEST['n_direccion']);
	$idtipdoc = $_REQUEST['tip_doc'];
	$numdoc = strtoupper($_REQUEST['n_doc']);
	$email = $_REQUEST['n_mail'];
	$telfijo = $_REQUEST['n_telefono'];
	$telcel = $_REQUEST['n_celular'];
	$telofi = $_REQUEST['n_telofi'];
	$sexo = $_REQUEST['n_sexo']; 
	$idestcivil = $_REQUEST['n_civil'];
	$natper = strtoupper($_REQUEST['n_natde']);
	if($idestcivil<>"2"){$conyuge="";}
	$conyuge = strtoupper($_REQUEST['n_conyugue']);
	$nacionalidad = $_REQUEST['n_nacionalidad'];
	$idprofesion = $_REQUEST['n_profesiones'];
	$detaprofesion = strtoupper($_REQUEST['n_detprof']);
	$idcargoprofe = $_REQUEST['n_cargo'];
	$profocupa = strtoupper($_REQUEST['n_ocupacion']); 
	$idubigeo = $_REQUEST['n_idubigeo'];
	$cumpclie = $_REQUEST['n_fecnac'];
	$fechaing = $_REQUEST['n_fecha'];
	$razonsocial = strtoupper($_REQUEST['n_razon']);
	$domfiscal = $_REQUEST['n_domfis'];
	$telempresa = $_REQUEST['n_telemp'];
	$mailempresa = $_REQUEST['n_mailemp'];
	$contacempresa = $_REQUEST['n_contacto'];
	$fechaconstitu = $_REQUEST['n_feccons'];
	if (isset($_REQUEST['n_sede'])){$idsedereg = $_REQUEST['n_sede'];}else{$idsedereg = 0;}
	$numregistro = $_REQUEST['n_registro']; 
	$numpartida = $_REQUEST['n_partida'];
	$actmunicipal = $_REQUEST['n_acta']; 
	$residente = $_REQUEST['n_residente'];
	$docpaisemi = $_REQUEST['n_emision'];
	$tipocli = $_REQUEST['n_tipcliente'];
	if($tipocli=="on"){$tipocli=1;}else{$tipocli=0;}
	$impeingre =  $_REQUEST['n_impeingre'];
	$impnumof = $_REQUEST['n_impnumof'];
	$impeorigen =  $_REQUEST['n_impeorigen'];
	$impentidad = $_REQUEST['n_impentidad'];
	$impremite = $_REQUEST['n_impremite'];
	$impmotivo = $_REQUEST['n_impmotivo'];
	
	$sql_ncliente = "insert into cliente(idcliente, tipper, apepat, apemat, prinom, segnom, nombre, direccion, idtipdoc, numdoc, email, telfijo, telcel, telofi, sexo, idestcivil, natper, conyuge, nacionalidad, idprofesion, detaprofesion, idcargoprofe, profocupa, idubigeo, cumpclie, fechaing, razonsocial, domfiscal, telempresa, mailempresa, contacempresa, fechaconstitu, idsedereg, numregistro, numpartida, actmunicipal, tipocli, impeingre, impnumof, impeorigen, impentidad, impremite, impmotivo, residente, docpaisemi) values ('$idcliente', '$tipper', '$apepat', '$apemat', '$prinom', '$segnom', '$nombre', '$direccion', '$idtipdoc', '$numdoc', '$email', '$telfijo', '$telcel', '$telofi', '$sexo', '$idestcivil', '$natper', '$conyuge', '$nacionalidad', '$idprofesion', '$detaprofesion', '$idcargoprofe', '$profocupa', '$idubigeo', '$cumpclie', '$fechaing', '$razonsocial', '$domfiscal', '$telempresa', '$mailempresa', '$contacempresa', '$fechaconstitu', '$idsedereg', '$numregistro', '$numpartida', '$actmunicipal', '$tipocli', '$impeingre', '$impnumof', '$impeorigen', '$impentidad', '$impremite', '$impmotivo', '$residente', '$docpaisemi')";
	
    $exe_ncliente = mysql_query($sql_ncliente, $conexion);
	
	?>