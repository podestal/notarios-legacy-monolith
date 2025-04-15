<?php

include_once '../conexion_pdo.php';
include_once('../includes/tbs_class.php');
include_once('../includes/tbs_plugin_opentbs.php');
include_once('../includes/ClaseLetras.class.php');

#
$kardex = $_REQUEST["num_kardex"];
$download = (int)$_REQUEST['donwload'];
$typeDocument = (int)$_REQUEST['typeDocument'];


$pathDocument = 'C:/Doc_Generados/kardex/';

$arrPathTypeDocument = array(1=>'documentos/',2=>'parte_notarial/',3=>'testimonio/');

$arrTemplateTypeDocument = array(1=>'plantilla_protocolar_kardex.odt',2=>'plantilla_protocolar_kardex_parte_notarial.odt',
	3=>'plantilla_protocolar_kardex_testimonio.odt');


$pathTypeDocument = $arrPathTypeDocument[$typeDocument];

$template = $arrTemplateTypeDocument[$typeDocument];

$tipDocumentAndKardex = $typeDocument.'#'.$kardex;



$documentKardex = $kardex.'.odt';
$pathDocument = $pathDocument.$pathTypeDocument.$documentKardex;



if(file_exists($pathDocument) && $download == 1 ){

	header ("Content-Disposition: attachment; filename=".$documentKardex." "); 
	header ("Content-Type: application/octet-stream");
	header ("Content-Length: ".filesize($pathDocument ));
	readfile($pathDocument );
	exit();
	
}

$count = '';
$params = array($kardex);
$objNumeroLetra = new ClaseNumeroLetra();
$curdate = $objNumeroLetra->fun_fech_letras(date("Y/m/d"));

$sqlTestimonio = 'SELECT movirrpp.idmovreg,movirrpp.kardex,detallemovimiento.fechamov,detallemovimiento.vencimiento,
detallemovimiento.titulorp,
detallemovimiento.idsedereg,sedesregistrales.dessede,
detallemovimiento.idsecreg,seccionesregistrales.dessecc,
detallemovimiento.idtiptraoges,tipotramogestion.desctiptraoges,
detallemovimiento.idestreg,estadoregistral.desestreg,detallemovimiento.encargado,
detallemovimiento.registrador,
detallemovimiento.anotacion,detallemovimiento.importee,detallemovimiento.observa,
detallemovimiento.numeroo,detallemovimiento.mayorderecho,
detallemovimiento.numeroPartida,detallemovimiento.asiento,detallemovimiento.recibo,
detallemovimiento.fechaInscripcion

FROM 
 movirrpp LEFT JOIN detallemovimiento 
 
 ON movirrpp.idmovreg = detallemovimiento.idmovreg LEFT JOIN sedesregistrales
   ON detallemovimiento.idsedereg = sedesregistrales.idsedereg LEFT JOIN 
   seccionesregistrales ON  detallemovimiento.idsecreg = seccionesregistrales.idsecreg
 LEFT JOIN    tipotramogestion ON  detallemovimiento.idtiptraoges = tipotramogestion.idtiptraoges
 LEFT JOIN estadoregistral ON detallemovimiento.idestreg  = estadoregistral.idestreg
 WHERE movirrpp.kardex = ? AND detallemovimiento.idtiptraoges = "001" LIMIT 1';


$sth = $objPDO->prepare($sqlTestimonio);
$sth->execute($params);

$colcount = $sth->columnCount();
$arrayColumns = array();
for ($i=0; $i <$colcount; $i++) { 
	# code...
	$array = $sth->getColumnMeta($i);
	$row = array();
	$row['name'] =  $array['name'];
	$arrayColumns[] = $row;

}


$rowTestimonio = $sth->fetch(PDO::FETCH_ASSOC);

if($rowTestimonio){
	foreach ($rowTestimonio as $key => $value){
	   			# code...
				$v = is_null($value)?'':$value;
	   			$$key = $v;
	}	
}else{

	foreach ($arrayColumns as $key => $value) {
		$$value['name'] = '';
	}
}

$dessede = strtoupper($dessede);


$sql = "SELECT CONCAT(nombre,' ',apellido) AS notario,ruc,distrito FROM confinotario";


$sth = $objPDO->prepare($sql);
$sth->execute();


$colcount = $sth->columnCount();
$arrayColumns = array();
for ($i=0; $i <$colcount; $i++) { 
	# code...
	$array = $sth->getColumnMeta($i);
	$row = array();
	$row['name'] =  $array['name'];
	$arrayColumns[] = $row;

}

$resultSql = $sth->fetch(PDO::FETCH_ASSOC);

if($resultSql){
	foreach ($resultSql as $key => $value){
	   			# code...
				$v = is_null($value)?'':$value;
	   			$$key = $v;
	}	
}else{

	foreach ($arrayColumns as $key => $value) {
		$$value['name'] = '';
	}
}

$rucLetras = $objNumeroLetra->fun_nume_letras($ruc);




$sql = "SELECT kardex.idkardex,kardex.kardex,kardex.idtipkar,tipokar.nomtipkar,kardex.kardexconexo,
kardex.fechaingreso,YEAR(STR_TO_DATE(kardex.fechaingreso,'%d/%m/%Y')) AS 
yearKardex,kardex.horaingreso,kardex.referencia,kardex.codactos,kardex.contrato,
kardex.idusuario,usuarios.apepat,usuarios.apemat,usuarios.prinom,usuarios.segnom,kardex.responsable,
kardex.observacion,kardex.documentos,kardex.fechacalificado,kardex.fechainstrumento,
kardex.fechaconclusion,kardex.numinstrmento,kardex.folioini,kardex.folioinivta,kardex.foliofin,
kardex.foliofinvta,kardex.papelinivta,kardex.papelini,kardex.papelfin,kardex.papelfinvta,kardex.papelTrasladoIni,kardex.papelTrasladoFin,kardex.comunica1,kardex.contacto,
kardex.telecontacto,kardex.mailcontacto,kardex.retenido,kardex.desistido,kardex.autorizado,
kardex.idrecogio,kardex.pagado,kardex.visita,kardex.dregistral,kardex.dnotarial,
kardex.idnotario, notarios.descon,notarios.direccion,kardex.numminuta,kardex.numescritura,
kardex.fechaescritura,kardex.insertos,kardex.direc_contacto,kardex.txa_minuta,kardex.idabogado,
tb_abogado.razonsocial  AS abogado,tb_abogado.documento,tb_abogado.matricula,tb_abogado.sede_colegio,
kardex.responsable_new,kardex.fechaminuta,kardex.ob_nota,kardex.ins_espec,kardex.recepcion,
kardex.funcionario_new,kardex.nc,kardex.fecha_modificacion,kardex.idPresentante,
presentante.numeroDocumento AS numeroDocumentoPresentante, CONCAT(presentante.apellidoPaterno,' ',presentante.apellidoMaterno,' ',
presentante.primerNombre, ' ',presentante.segundoNombre, ' '
) AS presentante
FROM kardex INNER JOIN tipokar 
ON kardex.idtipkar = tipokar.idtipkar LEFT JOIN  usuarios ON kardex.idusuario  = usuarios.idusuario
LEFT JOIN  notarios ON  kardex.idnotario = notarios.idnotario LEFT JOIN tb_abogado 
ON kardex.idabogado = tb_abogado.idabogado LEFT JOIN presentante ON kardex.idPresentante = presentante.idPresentante

WHERE kardex.kardex = ?";

$sth = $objPDO->prepare($sql);
$sth->execute($params);

$colcount = $sth->columnCount();
$arrayColumns = array();
for ($i=0; $i <$colcount; $i++) { 
	# code...
	$array = $sth->getColumnMeta($i);
	$row = array();
	$row['name'] =  $array['name'];
	$arrayColumns[] = $row;

}

$resultSql = $sth->fetch(PDO::FETCH_ASSOC);

if($resultSql){
	foreach ($resultSql as $key => $value){
	   			# code...
				$v = is_null($value)?'':$value;
	   			$$key = $v;
	
	}	

}else{

	foreach ($arrayColumns as $key => $value) {
		$$value['name'] = '';
	}
}






$sqlContratantes = "SELECT  cliente.idcliente,cliente.tipper,cliente.apepat,cliente.apemat,cliente.prinom,cliente.segnom,cliente.nombre,
cliente.direccion,cliente.idtipdoc,tipodocumento.destipdoc,cliente.numdoc,cliente.email,
cliente.telfijo,cliente.telcel,cliente.telofi,cliente.sexo,cliente.idestcivil,tipoestacivil.desestcivil,
cliente.natper,cliente.conyuge,cliente.nacionalidad,cliente.idprofesion,profesiones.desprofesion,
cliente.idcargoprofe,cargoprofe.descripcrapro,cliente.dirfer,cliente.idubigeo,ubigeo.nomdis,ubigeo.nomprov,
ubigeo.nomdpto,cliente.cumpclie,cliente.fechaing,cliente.razonsocial,cliente.domfiscal,cliente.telempresa,
cliente.mailempresa,cliente.contacempresa,cliente.fechaconstitu,cliente.idsedereg,
sedesregistrales.dessede,cliente.numregistro,cliente.numpartida,cliente.actmunicipal,
cliente.tipocli,cliente.impeingre,cliente.impnumof,cliente.impeorigen,cliente.impentidad,
cliente.impremite,cliente.impmotivo,cliente.residente,cliente.docpaisemi,
contratantes.condicion,contratantes.firma,contratantes.fechafirma,contratantes.resfirma,
contratantes.tiporepresentacion,contratantes.idcontratanterp,
contratantes.numpartida,contratantes.facultades,contratantes.indice,
contratantes.visita,contratantes.inscrito,contratantesxacto.item,contratantesxacto.idcondicion,
actocondicion.condicion,
contratantesxacto.parte,contratantesxacto.porcentaje,contratantesxacto.uif,
contratantesxacto.formulario,contratantesxacto.monto,contratantesxacto.opago,
contratantesxacto.ofondo,contratantesxacto.montop


 FROM cliente LEFT JOIN tipodocumento ON cliente.idtipdoc = tipodocumento.idtipdoc 
 LEFT JOIN tipoestacivil ON cliente.idestcivil =  tipoestacivil.idestcivil 
 LEFT JOIN  profesiones ON cliente.idprofesion =  profesiones.idprofesion
 LEFT JOIN cargoprofe ON cliente.idcargoprofe = cargoprofe.idcargoprofe
 LEFT JOIN  ubigeo ON ubigeo.coddis = cliente.idubigeo
 LEFT JOIN  sedesregistrales ON cliente.idsedereg = sedesregistrales.idsedereg
 INNER JOIN cliente2 ON cliente.idcliente = cliente2.idcliente
 INNER JOIN contratantes ON cliente2.idcontratante =  contratantes.idcontratante
 INNER JOIN contratantesxacto ON contratantes.idcontratante = contratantesxacto.idcontratante
 INNER JOIN actocondicion ON actocondicion.idcondicion = contratantesxacto.idcondicion
 WHERE    contratantes.kardex = ? ";


$stringWhere = " AND contratantesxacto.idcondicion = '271'";
$sql = $sqlContratantes . $stringWhere;

$sth = $objPDO->prepare($sql);
$sth->execute($params);
$arrDataAcreedores = $sth->fetchAll(PDO::FETCH_ASSOC);



$dataAcredores = '';
$countArrDataAcreedores = count($arrDataAcreedores);
$i = 1;
foreach ($arrDataAcreedores as $key => $value) {
	# code...
	$dataAcredores = $dataAcredores. $value['razonsocial'];
	
	if($i == ($countArrDataAcreedores-1)){
		$dataAcredores = $dataAcredores. ' Y ';
	}elseif($i<$countArrDataAcreedores){
		$dataAcredores = $dataAcredores . ',';
	}
	$i++;
}

$stringWhere = " AND contratantesxacto.idcondicion = '548'";
$sql = $sqlContratantes. $stringWhere;

$sth = $objPDO->prepare($sql);
$sth->execute($params);
$arrDataDeudores = $sth->fetchAll(PDO::FETCH_ASSOC);

//var_dump($arrDataDeudores);
//exit();

$dataDeudores = '';
$i = 1;
$countArrDataDeudores = count($arrDataDeudores);
foreach ($arrDataDeudores as $key => $value) {
	# code...
	$dataDeudores = $dataDeudores.$value['nombre'];
	if($i == ($countArrDataDeudores-1)){
		$dataDeudores = $dataDeudores. ' Y ';
	}elseif($i<$countArrDataDeudores){
		$dataDeudores = $dataDeudores . ',';
	}
	$i++;
}


$dataFullAcreedor = '';
$i = 1;
foreach ($arrDataAcreedores as $key => $value) {
	# code...
	$dataFullAcreedor = $dataFullAcreedor . $value['razonsocial'].' CON '.
	$value['destipdoc'].' NUMERO '. $objNumeroLetra->fun_nume_letras($value['numdoc']).' CON DOMICILIO '.
	$value['domfiscal'].' DEL DISTRITO DE '. $value['nomdis'].','. 'PROVINCIA Y DEPARTAMENTO DE '.
	$value['nomdpto'].', INSCRITA DE LA PARTIDA ELECTRONICA N° '. $value['numpartida'].' DE REGISTRO DE  PERSONAS JURIDICAS DE LA ZONA REGISTRAL N° '.strtoupper($value['dessede']);

	if($i == ($countArrDataAcreedores-1)){
		$dataFullAcreedor = $dataFullAcreedor.' Y ';
	}else if($i<$countArrDataAcreedores){
		$dataFullAcreedor = $dataFullAcreedor.',';
	}
	$i++;
}




$stringWhere = " AND contratantesxacto.idcondicion = '274' AND contratantes.tiporepresentacion = 1";
$sql = $sqlContratantes. $stringWhere;
$sth = $objPDO->prepare($sql);
$sth->execute($params);
$arrDataRepresentantes = $sth->fetchAll(PDO::FETCH_ASSOC);

$dataFullRepresentantes = '';
$i = 1;
$countArrDataRepresentantes = count($arrDataRepresentantes);
foreach ($arrDataRepresentantes as $key => $value) {
	# code...

	$dataFullRepresentantes = $dataFullRepresentantes.$value['nombre'].' IDENTIFICADO CON '.$value['destipdoc'].' NUMERO '.$objNumeroLetra->fun_nume_letras($value['numdoc']).
    '('.$value['numdoc'].'), '.$value['desprofesion'].' QUIEN DECLARA SER '.$value['desestcivil'].', CON DOMICILIO EN LA '.$value['direccion'].' DEL DISTRITO DE '.$value['nomdis'].' PROVINCIA Y DEPARTAMENTO DE '.$value['nomdpto'];
    $i++;
	if($i == $countArrDataRepresentantes){
		$dataFullRepresentantes = $dataFullRepresentantes.' Y ';
	}else if($i<$countArrDataRepresentantes){
		$dataFullRepresentantes = $dataFullRepresentantes.',';
	}
	
}




$dataAclaracionJuradaAcreedor = '';
$i = 1;
foreach ($arrDataAcreedores as $key => $value) {
	# code...
	$dataAclaracionJuradaAcreedor = $dataAclaracionJuradaAcreedor . $value['razonsocial'];

	if($i == ($countArrDataAcreedores-1)){
		$dataAcredores = $dataAcredores. ' Y ';
	}elseif($i<$countArrDataAcreedores){
		$dataAcredores = $dataAcredores . ',';
	}
	$i++;
}

$dataAclaracionJuradaRepresentantes = '';
$dataFirmasRepresentantes = '';
$i = 1;
foreach ($arrDataRepresentantes as $key => $value) {
	# code...
	$dataAclaracionJuradaRepresentantes = $dataAclaracionJuradaRepresentantes . $value['nombre'];
	$dataFirmasRepresentantes = $dataFirmasRepresentantes . $value['nombre'].' '.$value['descripcrapro'];
	$i++;
	if($i == ($countArrDataRepresentantes)){
		$dataAclaracionJuradaRepresentantes = $dataAclaracionJuradaRepresentantes. ' Y ';
		$dataFirmasRepresentantes = $dataFirmasRepresentantes .' Y ';
	}elseif($i<$countArrDataRepresentantes){
		$dataAclaracionJuradaRepresentantes = $dataAclaracionJuradaRepresentantes . ',';
		$dataFirmasRepresentantes = $dataFirmasRepresentantes .' , ';
	}
	
}

$dataFirmasImpresion  = utf8_decode($dataFirmasImpresion);




$objTbs = new clsTinyButStrong(); 


$objTbs->Plugin(TBS_INSTALL, OPENTBS_PLUGIN);
$objTbs->LoadTemplate($template);

$fileName = $kardex.'.odt';


//$arrDataRepresentantes[] 
//$arr [] = array('nombre'=>'spencer');
//$arr [] = array('nombre'=>'calors');
//$arr [] = array('nombre'=>'spencer');

$objTbs->MergeBlock('f', $arrDataRepresentantes);


$objTbs->PlugIn(OPENTBS_DELETE_COMMENTS);

$objTbs->Show(OPENTBS_DOWNLOAD, $fileName);








