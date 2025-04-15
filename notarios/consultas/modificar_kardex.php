	<?php
    
    include("../extraprotocolares/view/funciones.php");
    
    $conexion = Conectar();
    
	//$idkardex = $_REQUEST['id'];
	$kardex = $_REQUEST['id'];
	$idtipkar = $_REQUEST['m_tipkardex'];
	$kardexconexo = $_REQUEST['m_kardconex'];
	$fechaingreso = $_REQUEST['m_feckardex'];
	$horaingreso = $_REQUEST[''];
	$referencia = $_REQUEST['m_referencia'];
	$codactos = $_REQUEST['m_codactos'];
	$contrato = $_REQUEST['m_contrato'];
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
	$dregistral = $_REQUEST['m_registral'];
	$dnotarial = $_REQUEST['m_notarial'];
	$idnotario = $_REQUEST['m_notaria'];
	$numminuta = $_REQUEST[''];
	$numescritura = $_REQUEST[''];
	$fechaescritura = $_REQUEST[''];
	$insertos = $_REQUEST[''];
	$direc_contacto = $_REQUEST[''];
	$txa_minuta = $_REQUEST[''];
 
	$sql_mkardex =  "update kardex set idtipkar='$idtipkar', kardexconexo='$kardexconexo', fechaingreso='$fechaingreso', horaingreso='$horaingreso', referencia='$referencia', codactos='$codactos', contrato='$contrato', idusuario='$idusuario', responsable='$responsable', observacion='$observacion', documentos='$documentos', fechacalificado='$fechacalificado', fechainstrumento='$fechainstrumento', fechaconclusion='$fechaconclusion', numinstrmento='$numinstrmento', folioini='$folioini', folioinivta='$folioinivta', foliofin='$foliofin', foliofinvta='$foliofinvta', papelini='$papelini', papelinivta='$papelinivta', papelfin='$papelfin', papelfinvta='$papelfinvta', comunica1='$comunica1', contacto='$contacto', telecontacto='$telecontacto', mailcontacto='$mailcontacto', retenido='$retenido', desistido='$desistido', autorizado='$autorizado', idrecogio='$idrecogio', pagado='$pagado', visita='$visita', dregistral='$dregistral', dnotarial='$dnotarial', idnotario='$idnotario', numminuta='$numminuta', numescritura='$numescritura', fechaescritura='$fechaescritura', insertos='$insertos', direc_contacto='$direc_contacto', txa_minuta='$txa_minuta' where kardex.kardex ='$kardex'";
				  
    $exe_mkardex = mysql_query($sql_mkardex, $conexion);
	
	?>