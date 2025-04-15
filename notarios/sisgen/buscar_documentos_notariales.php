<?php
// Esto le dice a PHP que usaremos cadenas UTF-8 hasta el final
mb_internal_encoding('UTF-8'); 
// Esto le dice a PHP que generaremos cadenas UTF-8
mb_http_output('UTF-8');
include('conexion.php');
include('xml_kardex.php');

$fechaDesde = $_POST['fechaDesde'];
$fechaHasta = $_POST['fechaHasta'];
$tipoInstrumento = $_POST['tipoInstrumento'];
$estado = $_POST['estado'];
$codigoActo = $_POST['codigoActo'];
$all = false;
$where = "";
if($codigoActo != 0){
	$where = " AND ta.idtipoacto = '$codigoActo'";
	//die();
}

$sqlTruncate = "TRUNCATE sisgen_temp";
mysqli_query($conn,$sqlTruncate) or die('error consulta 12');

if($estado == 4){
	$sql = "SELECT kardex.idkardex,kardex.kardex,kardex.numescritura,kardex.fechaescritura,
	IF(ta.cod_ancert IS NULL,'',ta.cod_ancert)AS cod_ancert,kardex.estado_sisgen,kardex.idtipkar,kardex.fechaingreso,kardex.codactos,kardex.contrato,kardex.folioini,foliofin,kardex.fechaconclusion,ta.actouif,ta.actosunat
FROM kardex  , tiposdeacto ta WHERE  STR_TO_DATE(kardex.fechaescritura,'%Y-%m-%d') BETWEEN STR_TO_DATE('$fechaDesde','%Y-%m-%d')
				AND STR_TO_DATE('$fechaHasta','%Y-%m-%d') AND SUBSTRING(kardex.codactos,1,3)=ta.idtipoacto
				AND numescritura <>'' and kardex<>'' and kardex.idtipkar = '$tipoInstrumento' AND (ta.cod_ancert = '' OR ta.cod_ancert IS NULL) ".$where." ORDER BY cast(kardex.numescritura as unsigned) ";
}else if($estado == 0){
$sql = "SELECT kardex.idkardex,kardex.kardex,kardex.numescritura,kardex.fechaescritura,IF(ta.cod_ancert IS NULL,'',ta.cod_ancert)AS cod_ancert,kardex.estado_sisgen,kardex.idtipkar,kardex.fechaingreso,kardex.codactos,kardex.contrato,kardex.folioini,foliofin,kardex.fechaconclusion,ta.actouif,ta.actosunat
FROM kardex  , tiposdeacto ta WHERE  STR_TO_DATE(kardex.fechaescritura,'%Y-%m-%d') BETWEEN STR_TO_DATE('$fechaDesde','%Y-%m-%d')
				AND STR_TO_DATE('$fechaHasta','%Y-%m-%d') AND SUBSTRING(kardex.codactos,1,3)=ta.idtipoacto
				AND numescritura <>'' and kardex<>'' and kardex.idtipkar = '$tipoInstrumento' AND kardex.estado_sisgen='$estado' ".$where." ORDER BY cast(kardex.numescritura as unsigned)";
}else
if( $estado == 5){
	$sql = "SELECT kardex.idkardex,kardex.kardex,kardex.numescritura,kardex.fechaescritura,IF(ta.cod_ancert IS NULL,'',ta.cod_ancert)AS cod_ancert,kardex.estado_sisgen,kardex.idtipkar,kardex.fechaingreso,kardex.codactos,kardex.contrato,kardex.folioini,foliofin,kardex.fechaconclusion,ta.actouif,ta.actosunat
FROM kardex  , tiposdeacto ta WHERE  STR_TO_DATE(kardex.fechaescritura,'%Y-%m-%d') BETWEEN STR_TO_DATE('$fechaDesde','%Y-%m-%d')
				AND STR_TO_DATE('$fechaHasta','%Y-%m-%d') AND SUBSTRING(kardex.codactos,1,3)=ta.idtipoacto
				AND numescritura <>'' and kardex<>'' and kardex.idtipkar = '$tipoInstrumento' ".$where."  ORDER BY cast(kardex.numescritura as unsigned)";
				$all = true;
}else
if($estado == 3){
	$sql = "SELECT kardex.idkardex,kardex.kardex,kardex.numescritura,kardex.fechaescritura,IF(ta.cod_ancert IS NULL,'',ta.cod_ancert)AS cod_ancert,kardex.estado_sisgen,kardex.idtipkar,kardex.fechaingreso,kardex.codactos,kardex.contrato,kardex.folioini,foliofin,kardex.fechaconclusion,ta.actouif,ta.actosunat
FROM kardex  , tiposdeacto ta WHERE  STR_TO_DATE(kardex.fechaescritura,'%Y-%m-%d') BETWEEN STR_TO_DATE('$fechaDesde','%Y-%m-%d')
				AND STR_TO_DATE('$fechaHasta','%Y-%m-%d') AND SUBSTRING(kardex.codactos,1,3)=ta.idtipoacto
				AND numescritura <>'' and kardex<>'' and kardex.idtipkar = '$tipoInstrumento' AND kardex.estado_sisgen='3' ".$where." ORDER BY cast(kardex.numescritura as unsigned)";
}elseif($estado == -1){
	$sql = "SELECT kardex.idkardex,kardex.kardex,kardex.numescritura,kardex.fechaescritura,IF(ta.cod_ancert IS NULL,'',ta.cod_ancert)AS cod_ancert,kardex.estado_sisgen,kardex.idtipkar,kardex.fechaingreso,kardex.codactos,kardex.contrato,kardex.folioini,foliofin,kardex.fechaconclusion,ta.actouif,ta.actosunat
FROM kardex  , tiposdeacto ta WHERE  STR_TO_DATE(kardex.fechaescritura,'%Y-%m-%d') BETWEEN STR_TO_DATE('$fechaDesde','%Y-%m-%d')
				AND STR_TO_DATE('$fechaHasta','%Y-%m-%d') AND SUBSTRING(kardex.codactos,1,3)=ta.idtipoacto
				AND numescritura <>'' and kardex<>'' and kardex.idtipkar = '$tipoInstrumento' ".$where." ORDER BY cast(kardex.numescritura as unsigned)";
}else{
	$sql = "SELECT kardex.idkardex,kardex.kardex,kardex.numescritura,kardex.fechaescritura,IF(ta.cod_ancert IS NULL,'',ta.cod_ancert)AS cod_ancert,kardex.estado_sisgen,kardex.idtipkar,kardex.fechaingreso,kardex.codactos,kardex.contrato,kardex.folioini,foliofin,kardex.fechaconclusion,ta.actouif,ta.actosunat
FROM kardex  , tiposdeacto ta WHERE  STR_TO_DATE(kardex.fechaescritura,'%Y-%m-%d') BETWEEN STR_TO_DATE('$fechaDesde','%Y-%m-%d')
				AND STR_TO_DATE('$fechaHasta','%Y-%m-%d') AND SUBSTRING(kardex.codactos,1,3)=ta.idtipoacto
				AND numescritura <>'' and kardex<>'' and kardex.idtipkar = '$tipoInstrumento' AND kardex.estado_sisgen='$estado' ".$where." ORDER BY cast(kardex.numescritura as unsigned)";
}
$result = mysqli_query($conn,$sql) or die('error consulta 1');
$data = array();
$i = 1;
$affectedRow = mysqli_affected_rows($conn);
while($row = mysqli_fetch_array($result)){
	$estadoSisgen = $row['estado_sisgen'];
	switch ($estadoSisgen) {
		case 0:
			# code...
			$row['estado_sisgen'] = 'No Enviado';
			break;
		case 1:
			# code...
			$row['estado_sisgen'] = 'Enviado';
			break;
		case 2:
		# code...
			$row['estado_sisgen'] = 'Enviado(Observado)';
			break;
		case 3:
			# code...
			$row['estado_sisgen'] = 'No Enviado(Fallido)';

			break;
		
		default:
			# code...
			break;
	}


	$kardex = $row['kardex'];
	$numeroEscritura = $row['numescritura'];
	if($i == 1){
		$auxNumeroEscritura = $numeroEscritura;
		$auxKardex = $kardex;
	}else{ 
		if($auxNumeroEscritura == $numeroEscritura && $all){
			$data[] = array('numescritura'=>$numeroEscritura,
				'idkardex'=>'','kardex'=>$auxKardex.','.$kardex,'idtipkar'=>'','fechaingreso'=>'',
				'fechaescritura'=>'','cod_ancert'=>'-2','folioini'=>'',
				'fechaconclusion'=>'','codactos'=>'','contrato'=>'','estado_sisgen'=>'-1',
				'actouif'=>'','actosunat'=>'');
		}else
		if($auxNumeroEscritura  != ($numeroEscritura-1) && $all){
			$data[] = array('numescritura'=>($numeroEscritura-1),
				'idkardex'=>'','kardex'=>'','idtipkar'=>'','fechaingreso'=>'',
				'fechaescritura'=>'','cod_ancert'=>'-10--'.$i,'folioini'=>'',
				'fechaconclusion'=>'','codactos'=>'','contrato'=>'','estado_sisgen'=>'-1',
				'actouif'=>'','actosunat'=>'');
		}
		$auxNumeroEscritura = $numeroEscritura;
		$auxKardex = $kardex;
	}

	$idKardex = $row['idkardex'];
	
	$idTipoKardex = $row['idtipkar'];
	$fechaIngreso = $row['fechaingreso'];



	$fechaEscritura = $row['fechaescritura'];
	$arrFechaEscritura = explode('-', $fechaEscritura);
	$row['fechaescritura'] = $arrFechaEscritura[2].'/'.$arrFechaEscritura[1].'/'.$arrFechaEscritura[0];
	$codigoAncert = $row['cod_ancert'];
	$folioInicial = $row['folioini'];
	$folioFinal = $row['foliofin'];
	$fechaConclusion = $row['fechaconclusion'];
	
	$codigoActo = $row['codactos'];
	$contrato = $row['contrato'];
	$row['contrato'] = utf8_encode($row['contrato']);
	$row[9] = utf8_encode($row[9]);
	if($row['idtipkar']=='1'){$tipoKardexSisgen ='E';}
	if($row['idtipkar']=='2'){$tipoKardexSisgen ='C';}
	if($row['idtipkar']=='3'){$tipoKardexSisgen ='V';}
	if($row['idtipkar']=='4'){$tipoKardexSisgen ='G';}
	if($row['idtipkar']=='5'){$tipoKardexSisgen ='T';}

	if($estado != 5){
		$data[] = $row;
	}
	

	$sqlInsertSisgenTemp = "INSERT INTO sisgen_temp(idkardex,kardex,idtipkar,fecha_ingreso,codactos,contrato,folioini,foliofin,fecha_conclusion,numescritura,fechaescritura, cod_ancert ) VALUES ('$idKardex','$kardex','$tipoKardexSisgen','$fechaIngreso','$codigoActo','$contrato','$folioInicial','$folioFinal','$fechaConclusion','$numeroEscritura','$fechaEscritura','$codigoAncert')";
	//die($sqlInsertSisgenTemp);

	mysqli_query($conn,$sqlInsertSisgenTemp) or die('error consulta 2');
	$i++;
}
if($estado == 5){
	$affectedRow = count($data);
}

//Burcar errores en kardex
//********************************************************************* */
//********************************************************************* */
//********************************************************************* */
//********************************************************************* */
//********************************************************************* */

	#TABLA TEMP PARA PERSONAS JURIDICAS.
	$sqlTruncate = "TRUNCATE sisgen_temp_j";
	mysqli_query($conn,$sqlTruncate) or die('error consulta 3');

	$consulta_Juridica= mysqli_query($conn,"SELECT cl.idcontratante, cl.idcliente AS id, cl.tipper AS tipp,
	cl.idtipdoc AS tipodoc, cl.numdoc AS numdoc, cl.idubigeo,
	cl.razonsocial AS razonsocial, cl.domfiscal, cl.telempresa AS telempresa,
	cl.mailempresa AS correoemp, cl.contacempresa AS objeto,
	cl.fechaconstitu, SUBSTRING(CONCAT('0',cl.idsedereg),1,2) AS sedereg,
	cl.numregistro, cl.numpartida AS numpartidareg, cl.actmunicipal,
	cl.residente, cl.docpaisemi,co.idcontratante, co.idtipkar,
	co.kardex, SUBSTRING(co.condicion,1,3) AS condi, co.firma,
	co.fechafirma, co.resfirma, co.tiporepresentacion, co.idcontratanterp,
	co.idsedereg, co.numpartida, co.facultades, co.inscrito,u.coddist AS distrito,
	u.codprov AS provincia, u.codpto AS departamento, c.coddivi AS ciuu,
	codtipdoc AS tipodoc, prof.codprof AS profesion, na.codnacion AS nacionalidad,
	cx.uif AS ROUIF , cl.idcliente AS idcliente
	FROM sisgen_temp
	LEFT  JOIN contratantesxacto cx ON   sisgen_temp.kardex = cx.kardex
	LEFT JOIN cliente2 cl ON  cx.idcontratante = cl.idcontratante
	LEFT JOIN contratantes co ON cl.idcontratante = co.idcontratante
	LEFT JOIN ubigeo u ON cl.idubigeo=u.coddis
	LEFT JOIN ciiu c ON cl.actmunicipal=c.coddivi
	LEFT JOIN tipodocumento td ON cl.idtipdoc=td.idtipdoc
	LEFT JOIN profesiones prof ON cl.idprofesion=prof.idprofesion
	LEFT JOIN nacionalidades na ON cl.nacionalidad=na.idnacionalidad
	WHERE (cx.uif ='O' OR cx.uif='B' OR cx.uif='G' OR cx.uif='N' OR cx.uif='R') AND cl.tipper='J'") or die('error consulta 11');
	while($row_juridica = mysqli_fetch_array($consulta_Juridica)){
		$idcontratante = $row_juridica['idcontratante'];
		$id = $row_juridica['id'];
		$tipp = $row_juridica['tipp'];
		$tipodoc = $row_juridica['tipodoc'];
		$numdoc = $row_juridica['numdoc'];
		$idubigeo = $row_juridica['idubigeo'];
		$razonsocial = $row_juridica['razonsocial'];
		$domfiscal = $row_juridica['domfiscal'];
		$telempresa = $row_juridica['telempresa'];
		$correoemp = $row_juridica['correoemp'];
		$objeto = $row_juridica['objeto'];
		$fechaconstitu = $row_juridica['fechaconstitu'];
		$sedereg = $row_juridica['sedereg'];
		$numregistro = $row_juridica['numregistro'];
		$numpartidareg = $row_juridica['numpartidareg'];
		$actmunicipal = $row_juridica['actmunicipal'];
		$residente = $row_juridica['residente'];
		$docpaisemi = $row_juridica['docpaisemi'];
		$idtipkar = $row_juridica['idtipkar'];
		$kardex = $row_juridica['kardex'];
		$condi = $row_juridica['condi'];
		$firma = $row_juridica['firma'];
		$fechafirma = $row_juridica['fechafirma'];
		$resfirma = $row_juridica['resfirma'];
		$tiporepresentacion = $row_juridica['tiporepresentacion'];
		$idcontratanterp = $row_juridica['idcontratanterp'];
		$idsedereg = $row_juridica['idsedereg'];
		$numpartida = $row_juridica['numpartida'];
		$facultades = $row_juridica['facultades'];
		$inscrito = $row_juridica['inscrito'];
		$distrito = $row_juridica['distrito'];
		$provincia = $row_juridica['provincia'];
		$departamento = $row_juridica['departamento'];
		$ciuu = $row_juridica['ciuu'];
		$ROUIF = $row_juridica['ROUIF'];
		$idcliente = $row_juridica['idcliente'];
		$sqlJuridica = "INSERT INTO `sisgen_temp_j` (`idcontratante`, `id`, `tipp`, `tipodoc`, 
		`numdoc`, `idubigeo`, `razonsocial`, `domfiscal`, `telempresa`, `correoemp`, 
		`objeto`, `fechaconstitu`, `sedereg`, `numregistro`, `numpartidareg`, 
		`actmunicipal`, `residente`, `docpaisemi`, `idtipkar`, `kardex`, `condi`, 
		`firma`, `fechafirma`, `resfirma`, `tiporepresentacion`, `idcontratanterp`, 
		`idsedereg`, `numpartida`, `facultades`, `inscrito`, `distrito`, `provincia`, 
		`departamento`, `ciuu`,`profesion`, `nacionalidad`, `ROUIF`, `idcliente`) VALUES('$idcontratante','$id','$tipp','$tipodoc','$numdoc','$idubigeo','$razonsocial','$domfiscal','$telempresa','$correoemp','$objeto','$fechaconstitu','$sedereg','$numregistro','$numpartidareg','$actmunicipal','$residente','$docpaisemi','$idtipkar','$kardex','$condi','$firma','$fechafirma','$resfirma','$tiporepresentacion','$idcontratanterp','$idsedereg','$numpartida','$facultades','$inscrito','$distrito','$provincia','$departamento','$ciuu','','','$ROUIF','$idcliente')";
		mysqli_query($conn,$sqlJuridica) or die('error consulta 4');
	}

	#TABLA TEMP PARA PERSONAS NATURALES.
	$sqlTruncate = "TRUNCATE sisgen_temp_n";
	mysqli_query($conn,$sqlTruncate) or die('error consulta 5');

	$consulta_Natural = mysqli_query($conn,"SELECT  cl.idcontratante, cl.idcliente AS id, cl.tipper AS tipp, cl.apepat AS apepat,
		cl.apemat AS apemat, CONCAT(TRIM(cl.prinom),' ',TRIM(cl.segnom)) AS nom,
		cl.nombre, cl.direccion AS direccion, cl.idtipdoc , cl.numdoc AS numdoc,
		cl.email AS email, cl.telfijo AS telfijo, cl.telcel, cl.telofi, cl.sexo AS gen,
		cl.idestcivil AS estc, cl.natper, cl.conyuge, cl.nacionalidad AS naci,
		cl.idprofesion , cl.detaprofesion, cl.idcargoprofe , cl.profocupa, cl.dirfer,
		cl.idubigeo, cl.cumpclie AS fechanaci, cl.residente,  u.coddist AS distrito,
		u.codprov AS provincia, u.codpto AS departamento,codtipdoc AS tipodoc,
		prof.codprof AS profesion, na.codnacion AS nacionalidad, cp.codcargoprofe
		AS cargo, cx.uif AS ROLUIF,co.kardex AS kardex
	FROM sisgen_temp
	LEFT  JOIN contratantesxacto cx ON   sisgen_temp.kardex = cx.kardex
	LEFT JOIN cliente2 cl ON  cx.idcontratante = cl.idcontratante
	LEFT JOIN contratantes co ON cl.idcontratante = co.idcontratante
	LEFT JOIN ubigeo u ON cl.idubigeo=u.coddis
	LEFT JOIN ciiu c ON cl.actmunicipal=c.coddivi
	LEFT JOIN tipodocumento td ON cl.idtipdoc=td.idtipdoc
	LEFT JOIN profesiones prof ON cl.idprofesion=prof.idprofesion
	LEFT JOIN nacionalidades na ON cl.nacionalidad=na.idnacionalidad
	LEFT JOIN cargoprofe cp ON cl.idcargoprofe=cp.idcargoprofe
	WHERE (cx.uif ='O' OR cx.uif='B' OR cx.uif='G' OR cx.uif='N' OR cx.uif='R') AND cl.tipper='N'") or die('error consulta 6');
	while($row_natural = mysqli_fetch_array($consulta_Natural)){
		$idcontratante = $row_natural['idcontratante'];
		$id = $row_natural['id'];
		$tipp = $row_natural['tipp'];
		$apepat = str_replace("'", "\'", $row_natural['apepat']);
		$apemat = str_replace("'", "\'", $row_natural['apemat']);
		$nom = str_replace("'", "\'", $row_natural['nom']);
		$nombre = str_replace("'", "\'", $row_natural['nombre']);
		$direccion = $row_natural['direccion'];
		$idtipdoc = $row_natural['idtipdoc'];
		$numdoc = $row_natural['numdoc'];
		$email = $row_natural['email'];
		$telfijo = $row_natural['telfijo'];
		$telcel = $row_natural['telcel'];
		$telofi = $row_natural['telofi'];
		$gen = $row_natural['gen'];
		$estc = $row_natural['estc'];
		$natper = $row_natural['natper'];
		$conyuge = $row_natural['conyuge'];
		$naci = $row_natural['naci'];
		$idprofesion = $row_natural['idprofesion'];
		$detaprofesion = $row_natural['detaprofesion'];
		$idcargoprofe = $row_natural['idcargoprofe'];
		$profocupa = $row_natural['profocupa'];
		$dirfer = $row_natural['dirfer'];
		$idubigeo = $row_natural['idubigeo'];
		$fechanaci = $row_natural['fechanaci'];
		$residente = $row_natural['residente'];
		$distrito = $row_natural['distrito'];
		$provincia = $row_natural['provincia'];
		$departamento = $row_natural['departamento'];
		$tipodoc = $row_natural['tipodoc'];
		$profesion = $row_natural['profesion'];
		$nacionalidad = $row_natural['nacionalidad'];
		$cargo = $row_natural['cargo'];
		$ROLUIF = $row_natural['ROLUIF'];
		$kardex = $row_natural['kardex'];

		$sqlNatural = "insert into `sisgen_temp_n` (`idcontratante`, `id`, `tipp`, `apepat`, `apemat`, `nom`, `nombre`, `direccion`, `idtipdoc`, `numdoc`, `email`, `telfijo`, `telcel`, `telofi`, `gen`, `estc`, `natper`, `conyuge`, `naci`, `idprofesion`, `detaprofesion`, `idcargoprofe`, `profocupa`, `dirfer`, `idubigeo`, `fechanaci`, `residente`, `distrito`, `provincia`, `departamento`, `tipodoc`, `profesion`, `nacionalidad`, `cargo`, `ROLUIF`,`idcliente`, `kardex`) values('$idcontratante','$id','$tipp','$apepat','$apemat','$nom','$nombre','$direccion','$idtipdoc','$numdoc','$email','$telfijo','$telcel','$telofi','$gen','$estc','$natper','$conyuge','$naci','$idprofesion','$detaprofesion','$idcargoprofe','$profocupa','$dirfer','$idubigeo','$fechanaci','$residente','$distrito','$provincia','$departamento','$tipodoc','$profesion','$nacionalidad','$cargo','$ROLUIF','$id','$kardex');";
		mysqli_query($conn,$sqlNatural) or die('error consulta 7');

	}
	//TEMP INTERVENCIONES  
	$sqlTruncate = "TRUNCATE sisgen_intervenciones_6";
	mysqli_query($conn,$sqlTruncate) or die('error consulta 8');

	$consulta_intervenciones_6= mysqli_query($conn,"SELECT
		cl.idcontratante AS idcon,  cl.idcliente AS idcl,  cl.tipper AS tipp,  cl.apepat AS apepat,  cl.apemat AS apemat,  CONCAT(cl.prinom,' ',cl.segnom) AS nom,  cl.nombre,
		cl.direccion AS direccion,  cl.idtipdoc AS tipodoc,  cl.numdoc AS numdoc,  cl.email AS email,  cl.telfijo AS telfijo,  cl.telcel,  cl.telofi,  cl.sexo AS gen,  cl.idestcivil AS estc,
		cl.natper,  cl.conyuge AS conyuge,  cl.nacionalidad AS nacionalidad,  cl.idprofesion AS profesion,  cl.detaprofesion,  cl.idcargoprofe AS cargo,
		cl.profocupa,  cl.dirfer,  cl.idubigeo,  cl.cumpclie AS fechanaci,  cl.fechaing,  cl.razonsocial AS razonsocial,  cl.domfiscal,
		cl.telempresa AS telempresa,  cl.mailempresa AS correoemp,  cl.contacempresa,  cl.fechaconstitu,  cl.idsedereg,  cl.numregistro,
		cl.numpartida AS numpartida,  cl.actmunicipal,  cl.tipocli,  cl.impeingre,  cl.impnumof,  cl.impeorigen,  cl.impentidad,
		cl.impremite,  cl.impmotivo,  cl.residente,  cl.docpaisemi,co.idcontratante,  co.idtipkar,  co.kardex,
		co.firma,  co.fechafirma AS  ffirma,  co.resfirma,  co.tiporepresentacion,  co.idcontratanterp,
		co.idsedereg,  co.numpartida,  co.facultades,  co.indice,  co.visita,  co.inscrito, SUBSTRING(co.condicion,1,3) AS condi,act.condicion AS condicionn,
		act.codconsisgen AS condicionnsisgen,
		cxa.id,  cxa.idtipkar,  cxa.kardex,  cxa.idtipoacto,  cxa.idcontratante,  cxa.item,  cxa.idcondicion,  act.parte AS parte,  cxa.porcentaje,
		cxa.uif AS repre,  cxa.formulario,  cxa.monto AS montoo,  cxa.opago,  cxa.ofondo AS fondos,  cxa.montop
	FROM   sisgen_temp
	INNER JOIN  contratantesxacto cxa ON sisgen_temp.kardex = cxa.kardex
	INNER JOIN cliente2 cl ON  cl.idcontratante=cxa.idcontratante
	LEFT JOIN contratantes co ON cxa.`idcontratante`=co.`idcontratante`
	LEFT JOIN actocondicion act ON act.`idcondicion` = cxa.`idcondicion` ") or die('error consulta 9');
	while($row_intervenciones_6 = mysqli_fetch_array($consulta_intervenciones_6)){
		$idcon = $row_intervenciones_6['idcon'];
		$idcl = $row_intervenciones_6['idcl'];
		$tipp = $row_intervenciones_6['tipp'];
		$apepat = str_replace("'", "\'", $row_natural['apepat']);
		$apemat = str_replace("'", "\'", $row_natural['apemat']);
		$nom = str_replace("'", "\'", $row_natural['nom']);
		$nombre = str_replace("'", "\'", $row_natural['nombre']);
		$direccion = $row_intervenciones_6['direccion'];
		$tipodoc = $row_intervenciones_6['tipodoc'];
		$numdoc = $row_intervenciones_6['numdoc'];
		$email = $row_intervenciones_6['email'];
		$telfijo = $row_intervenciones_6['telfijo'];
		$telcel = $row_intervenciones_6['telcel'];
		$telofi = $row_intervenciones_6['telofi'];
		$gen = $row_intervenciones_6['gen'];
		$estc = $row_intervenciones_6['estc'];
		$natper = $row_intervenciones_6['natper'];
		$conyuge = $row_intervenciones_6['conyuge'];
		$nacionalidad = $row_intervenciones_6['nacionalidad'];
		$profesion = $row_intervenciones_6['profesion'];
		$detaprofesion = $row_intervenciones_6['detaprofesion'];
		$cargo = $row_intervenciones_6['cargo'];
		$profocupa = $row_intervenciones_6['profocupa'];
		$dirfer = $row_intervenciones_6['dirfer'];
		$idubigeo = $row_intervenciones_6['idubigeo'];
		$fechanaci = $row_intervenciones_6['fechanaci'];
		$fechaing = $row_intervenciones_6['fechaing'];
		$razonsocial = $row_intervenciones_6['razonsocial'];
		$domfiscal = $row_intervenciones_6['domfiscal'];
		$telempresa = $row_intervenciones_6['telempresa'];
		$correoemp = $row_intervenciones_6['correoemp'];
		$contacempresa = $row_intervenciones_6['contacempresa'];
		$fechaconstitu = $row_intervenciones_6['fechaconstitu'];
		$idsedereg = $row_intervenciones_6['idsedereg'];
		$numregistro = $row_intervenciones_6['numregistro'];
		$numpartida = $row_intervenciones_6['numpartida'];
		$actmunicipal = $row_intervenciones_6['actmunicipal'];
		$tipocli = $row_intervenciones_6['tipocli'];
		$impeingre = $row_intervenciones_6['impeingre'];
		$impnumof = $row_intervenciones_6['impnumof'];
		$impeorigen = $row_intervenciones_6['impeorigen'];
		$impentidad = $row_intervenciones_6['impentidad'];
		$impremite = $row_intervenciones_6['impremite'];
		$impmotivo = $row_intervenciones_6['impmotivo'];
		$residente = $row_intervenciones_6['residente'];
		$docpaisemi = $row_intervenciones_6['docpaisemi'];
		$kardex = $row_intervenciones_6['kardex'];
		$firma = $row_intervenciones_6['firma'];
		$ffirma = $row_intervenciones_6['ffirma'];
		$resfirma = $row_intervenciones_6['resfirma'];
		$tiporepresentacion = $row_intervenciones_6['tiporepresentacion'];
		$idcontratanterp = $row_intervenciones_6['idcontratanterp'];
		$facultades = $row_intervenciones_6['facultades'];
		$indice = $row_intervenciones_6['indice'];
		$visita = $row_intervenciones_6['visita'];
		$inscrito = $row_intervenciones_6['inscrito'];
		$condi = $row_intervenciones_6['condi'];
		$condicionn = $row_intervenciones_6['condicionn'];
		$condicionnsisgen = $row_intervenciones_6['condicionnsisgen'];
		$id = $row_intervenciones_6['id'];
		$idtipkar = $row_intervenciones_6['idtipkar'];
		$idtipoacto = $row_intervenciones_6['idtipoacto'];
		$idcontratante = $row_intervenciones_6['idcontratante'];
		$item = $row_intervenciones_6['item'];
		$idcondicion = $row_intervenciones_6['idcondicion'];
		$parte = $row_intervenciones_6['parte'];
		$porcentaje = $row_intervenciones_6['porcentaje'];
		$repre = $row_intervenciones_6['repre'];
		$formulario = $row_intervenciones_6['formulario'];
		$montoo = $row_intervenciones_6['montoo'];
		$opago = $row_intervenciones_6['opago'];
		$fondos = $row_intervenciones_6['fondos'];
		$montop = $row_intervenciones_6['montop'];
		$sqlIntervinientes = "insert into `sisgen_intervenciones_6` (`idcon`, `idcl`, `tipp`, `apepat`, `apemat`, `nom`, `nombre`, `direccion`, `tipodoc`, `numdoc`, `email`, `telfijo`, `telcel`, `telofi`, `gen`, `estc`, `natper`, `conyuge`, `nacionalidad`, `profesion`, `detaprofesion`, `cargo`, `profocupa`, `dirfer`, `idubigeo`, `fechanaci`, `fechaing`, `razonsocial`, `domfiscal`, `telempresa`, `correoemp`, `contacempresa`, `fechaconstitu`, `idsedereg`, `numregistro`, `numpartida`, `actmunicipal`, `tipocli`, `impeingre`, `impnumof`, `impeorigen`, `impentidad`, `impremite`, `impmotivo`, `residente`, `docpaisemi`, `kardex`, `firma`, `ffirma`, `resfirma`, `tiporepresentacion`, `idcontratanterp`, `facultades`, `indice`, `visita`, `inscrito`, `condi`, `condicionn`, `condicionnsisgen`, `id`, `idtipkar`, `idtipoacto`, `idcontratante`, `item`, `idcondicion`, `parte`, `porcentaje`, `repre`, `formulario`, `montoo`, `opago`, `fondos`, `montop`) values('$idcon','$idcl','$tipp','$apepat','$apemat','$nom','$nombre','$direccion','$tipodoc','$numdoc','$email','$telfijo','$telcel','$telofi','$gen','$estc','$natper','$conyuge','$nacionalidad','$profesion','$detaprofesion','$cargo','$profocupa','$dirfer','$idubigeo','$fechanaci','$fechaing','$razonsocial','$domfiscal','$telempresa','$correoemp','$contacempresa','$fechaconstitu','$idsedereg','$numregistro','$numpartida','$actmunicipal','$tipocli','$impeingre','$impnumof','$impeorigen','$impentidad','$impremite','$impmotivo','$residente','$docpaisemi','$kardex','$firma','$ffirma','$resfirma','$tiporepresentacion','$idcontratanterp','$facultades','$indice','$visita','$inscrito','$condi','$condicionn','$condicionnsisgen','$id','$idtipkar','$idtipoacto','$idcontratante','$item','$idcondicion','$parte','$porcentaje','$repre','$formulario','$montoo','$opago','$fondos','$montop');";
		mysqli_query($conn,$sqlIntervinientes) or die('error consulta 10');
	}

/********************	XML ***************/
	
	$salida_xml .= "<DocumentosNotariales xmlns='http://ancert.notariado.org/SISGEN/XML' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xsi:schemaLocation='http://ancert.notariado.org/SISGEN/XML C:\SISGEN\SISGEN_V2_RO\documentos_notariales.xsd'>\n";
	$salida_xml .= "\t<GeneradorDatos>\n";
	$salida_xml .= "\t\t<NomProveedor>" ."CNL". "</NomProveedor>\n"; 
	$salida_xml .= "\t\t<NomAplicacion>" ."SISNOT". "</NomAplicacion>\n"; 
	$salida_xml .= "\t\t<VersionAplicacion>" ."2.7". "</VersionAplicacion>\n"; 
	$salida_xml .= "\t</GeneradorDatos>\n";
	//****************************************************/
	$resultxml = kardexml($conn,$tipoInstrumento,"","");
	$salida_xml .= $resultxml[0];
	$errorListKar = $resultxml[1];
	$errorListKarObs = $resultxml[2];
	$arrPersonasErr = $resultxml[1];
	//****************************************************/
	$salida_xml .= "</DocumentosNotariales>\n";
	$salida = str_replace("&","&amp;",$salida_xml);
	$salida = str_replace("Ã‘","Ñ",$salida);
	$salida = str_replace("Ï¿½","Ñ",$salida);
	$salida = str_replace("Ï¿Ï¿½","Ñ",$salida);

	$crearxml = fopen("textparaenviar.xml", "w+");
	fwrite($crearxml,$salida);
	fclose($crearxml);
		
	$crearxml = fopen("textconerror.xml", "w+");
	fwrite($crearxml,$salida_kardex_error);
	fclose($crearxml);
/********************AAAAAAAAA ******/
//********************************************************************* */
//********************************************************************* */
//********************************************************************* */
//********************************************************************* */
//********************************************************************* */

$objResponse = new stdClass();
$objResponse->error = 0;
$objResponse->data = $data;
$objResponse->total = $affectedRow ;
$objResponse->errores = $errorListKar;
$objResponse->observaciones = $errorListKarObs;
$objResponse->personas = $arrPersonasErr;


echo json_encode($objResponse);
