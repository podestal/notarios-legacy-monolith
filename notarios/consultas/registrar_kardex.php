	<?php
    
    include("../extraprotocolares/view/funciones.php");
    
    $conexion = Conectar();
	
	$sql_idkardex = "SELECT
					 kardex.idkardex
					 FROM
					 kardex
					 ORDER BY
					 kardex.idkardex DESC";
	
	$exe_idkardex = mysql_query($sql_idkardex, $conexion);
	
	$row_idkardex = mysql_fetch_array($exe_idkardex);
	
	$new_idkardex = $row_idkardex[0]+1;
	
	if($new_idkardex == ''){$idkardex = 1;}
	
	if($new_idkardex != ''){$idkardex = $new_idkardex;}
	
	$kardex =  correlativo_numero($idkardex);
	
	$idtipkar = $_REQUEST['n_tipkardex'];
	$kardexconexo = $_REQUEST['n_kardconex'];
	$fechaingreso = $_REQUEST['n_feckardex'];
	$horaingreso = $_REQUEST[''];
	$referencia = strtoupper($_REQUEST['n_referencia']);
	$codactos = $_REQUEST['n_codactos'];
	$contrato = $_REQUEST['n_contrato'];
	$idusuario = 0;
	$responsable = 0;
	$observacion = $_REQUEST[''];
	$documentos = $_REQUEST[''];
	$fechacalificado = $_REQUEST[''];
	$fechainstrumento = $_REQUEST[''];
	$fechaconclusion = $_REQUEST[''];
	$numinstrmento = $_REQUEST[''];
	$folioini = $_REQUEST[''];
	$folioinivta = $_REQUEST[''];
	$foliofin = $_REQUEST[''];
	$foliofinvta = 0;
	$papelini = $_REQUEST[''];
	$papelinivta = 0; 
	$papelfin = $_REQUEST[''];
	$papelfinvta = 0;
	$comunica1 = $_REQUEST[''];
	$contacto = $_REQUEST['']; 
	$telecontacto = $_REQUEST[''];
	$mailcontacto = $_REQUEST['']; 
	$retenido = 0;
	$desistido = 0;
	$autorizado = 0;
	$idrecogio = 0;
	$pagado = 0;
	$visita = 0;
	$dregistral = $_REQUEST['n_registral'];
	$dnotarial = $_REQUEST['n_notarial'];
	$idnotario = $_REQUEST['n_notaria'];
	if($idnotario==""){$idnotario=0;}
	$numminuta = $_REQUEST[''];
	$numescritura = $_REQUEST[''];
	$fechaescritura = $_REQUEST[''];
	$insertos = $_REQUEST[''];
	$direc_contacto = $_REQUEST[''];
	$txa_minuta = $_REQUEST[''];
	
	$sql_nkardex = "insert into kardex (idkardex, kardex, idtipkar, kardexconexo, fechaingreso, horaingreso, referencia, codactos, contrato, idusuario, responsable, observacion, documentos, fechacalificado, fechainstrumento, fechaconclusion, numinstrmento, folioini, folioinivta, foliofin, foliofinvta, papelini, papelinivta, papelfin, papelfinvta, comunica1, contacto, telecontacto, mailcontacto, retenido, desistido, autorizado, idrecogio, pagado, visita, dregistral, dnotarial, idnotario, numminuta, numescritura, fechaescritura, insertos, direc_contacto, txa_minuta) values('$idkardex', '$kardex', '$idtipkar', '$kardexconexo', '$fechaingreso', '$horaingreso', '$referencia', '$codactos', '$contrato', '$idusuario', '$responsable', '$observacion', '$documentos', '$fechacalificado', '$fechainstrumento', '$fechaconclusion', '$numinstrmento', '$folioini', '$folioinivta', '$foliofin', '$foliofinvta', '$papelini', '$papelinivta', '$papelfin', '$papelfinvta', '$comunica1', '$contacto', '$telecontacto', '$mailcontacto', '$retenido', '$desistido', '$autorizado', '$idrecogio', '$pagado', '$visita', '$dregistral', '$dnotarial', '$idnotario', '$numminuta', '$numescritura', '$fechaescritura', '$insertos', '$direc_contacto', '$txa_minuta')";
	
    $exe_nkardex = mysql_query($sql_nkardex, $conexion);
	
	$sql_idkardex = "SELECT
					 kardex.idkardex
					 FROM
					 kardex
					 ORDER BY
					 kardex.idkardex DESC";
	
	$exe_idkardex = mysql_query($sql_idkardex, $conexion);
	
	$row_idkardex = mysql_fetch_array($exe_idkardex);
	
	$new_idkardex = $row_idkardex[0];
	
	$kardex =  correlativo_numero($new_idkardex);
	
	echo json_encode($kardex); 
	
	
	?>
    
   
	
    