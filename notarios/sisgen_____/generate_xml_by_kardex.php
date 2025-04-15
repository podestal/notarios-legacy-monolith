<?php
include('conexion.php');

function fdate($mifecha){
	$var = str_replace('/', '-', $mifecha);
	return date('Y-m-d', strtotime($var));
}
//set_time_limit(0);
//$data = json_decode($_POST['listDocumentos']);
$kardex =  $_POST['kardex'];
$idKardex = $_POST['idKardex'];
$sql = "UPDATE sisgen_temp SET seleccionado = 1 WHERE kardex = '$kardex' and idkardex = '$idKardex'";
$result = mysqli_query($conn,$sql);

#TABLA TEMP PARA PERSONAS JURIDICAS.
$sqlTruncate = "TRUNCATE sisgen_temp_j";
mysqli_query($conn,$sqlTruncate) or die(mysqli_error());

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
WHERE (cx.uif ='O' OR cx.uif='B' OR cx.uif='R') AND cl.tipper='J' AND  cx.kardex = '$kardex'") or die(mysqli_error());
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

$sqlJuridica = "INSERT INTO `sisgen_temp_j` (`idcontratante`, `id`, `tipp`, `tipodoc`, `numdoc`, `idubigeo`, `razonsocial`, `domfiscal`, `telempresa`, `correoemp`, `objeto`, `fechaconstitu`, `sedereg`, `numregistro`, `numpartidareg`, `actmunicipal`, `residente`, `docpaisemi`, `idtipkar`, `kardex`, `condi`, `firma`, `fechafirma`, `resfirma`, `tiporepresentacion`, `idcontratanterp`, `idsedereg`, `numpartida`, `facultades`, `inscrito`, `distrito`, `provincia`, `departamento`, `ciuu`,`profesion`, `nacionalidad`, `ROUIF`, `idcliente`) VALUES('$idcontratante','$id','$tipp','$tipodoc','$numdoc','$idubigeo','$razonsocial','$domfiscal','$telempresa','$correoemp','$objeto','$fechaconstitu','$sedereg','$numregistro','$numpartidareg','$actmunicipal','$residente','$docpaisemi','$idtipkar','$kardex','$condi','$firma','$fechafirma','$resfirma','$tiporepresentacion','$idcontratanterp','$idsedereg','$numpartida','$facultades','$inscrito','$distrito','$provincia','$departamento','$ciuu','','','$ROUIF','$idcliente')";
mysqli_query($conn,$sqlJuridica) or die(mysqli_error());

}

#TABLA TEMP PARA PERSONAS NATURALES.
$sqlTruncate = "TRUNCATE sisgen_temp_n";
mysqli_query($conn,$sqlTruncate) or die(mysqli_error());

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
WHERE (cx.uif ='O' OR cx.uif='B' OR cx.uif='R') AND cl.tipper='N' AND cx.kardex = '$kardex'") or die(mysqli_error());
while($row_natural = mysqli_fetch_array($consulta_Natural)){

	$idcontratante = $row_natural['idcontratante'];
	$id = $row_natural['id'];
	$tipp = $row_natural['tipp'];
	$apepat = $row_natural['apepat'];
	$apemat = $row_natural['apemat'];
	$nom = $row_natural['nom'];
	$nombre = $row_natural['nombre'];
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
	mysqli_query($conn,$sqlNatural) or die(mysqli_error());

	}


	//TEMP INTERVENCIONES  
	$sqlTruncate = "TRUNCATE sisgen_intervenciones_6";
	mysqli_query($conn,$sqlTruncate) or die(mysqli_error());

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
	LEFT JOIN actocondicion act ON act.`idcondicion` = cxa.`idcondicion`  WHERE cxa.kardex = '$kardex' ") or die(mysqli_error());
	while($row_intervenciones_6 = mysqli_fetch_array($consulta_intervenciones_6)){

		$idcon = $row_intervenciones_6['idcon'];
		$idcl = $row_intervenciones_6['idcl'];
		$tipp = $row_intervenciones_6['tipp'];
		$apepat = $row_intervenciones_6['apepat'];
		$apemat = $row_intervenciones_6['apemat'];
		$nom = $row_intervenciones_6['nom'];
		$nombre = $row_intervenciones_6['nombre'];
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
	mysqli_query($conn,$sqlIntervinientes) or die(mysqli_error());

	}

	



$query = "SELECT idkardex,kardex,idtipkar as tipokardex,fecha_ingreso,codactos,contrato,folioini,foliofin,fecha_conclusion as fechaconclusion,numescritura,fechaescritura, cod_ancert as ancert FROM sisgen_temp WHERE seleccionado = 1";

$querynor = "SELECT idnotar,nombre,apellido ,telefono,correo,ruc,direccion,distrito,codnotario FROM confinotario";
	
$resultadonor = mysqli_query($conn,$querynor) or die("Sin datos del notario."); 

$nor = mysqli_fetch_array($resultadonor);
$xnor = $nor['ruc'];
$xnor2 = $nor['codnotario'];
$distrito = $nor['distrito'];


$resultado = mysqli_query($conn,$query) or die("Sin Kardex Encontrados."); 


 $salida_xml .= "<DocumentosNotariales xmlns='http://ancert.notariado.org/SISGEN/XML' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xsi:schemaLocation='http://ancert.notariado.org/SISGEN/XML C:\SISGEN\SISGEN_V2_RO\documentos_notariales.xsd'>\n";

	$salida_xml .= "\t<GeneradorDatos>\n";
			$salida_xml .= "\t\t<NomProveedor>" ."CNL". "</NomProveedor>\n"; 
			$salida_xml .= "\t\t<NomAplicacion>" ."SISNOT". "</NomAplicacion>\n"; 
			$salida_xml .= "\t\t<VersionAplicacion>" ."2.7". "</VersionAplicacion>\n"; 
 $salida_xml .= "\t</GeneradorDatos>\n";

	 while($x = mysqli_fetch_array($resultado)){ 
									 
		$d=$x['numescritura']; if($d<>""){ $e=$x['numescritura'];} else{$e="";}
		$d1=$x['fechaescritura']; if($d1<>""){ $e1=$x['fechaescritura'];} else{$e1="";}	
		$folio=$x['foliofin']-$x['folioini']+1;

		$salida_xml .= "\t<DocumentoNotarial>\n"; 
// DECUMENTO DATOS DEl NOTARIO
				$salida_xml .= "\t<Documento>\n"; 
						$salida_xml .= "\t\t<CodNotario>" .trim($xnor2). "</CodNotario>\n"; 
						$salida_xml .= "\t\t<CodNotaria>" .trim($xnor). "</CodNotaria>\n";
						$salida_xml .= "\t\t<NumKardex>" . $x['kardex'] . "</NumKardex>\n";
						//$salida_xml .= "\t\t<NumKardex>" . substr($x['kardex'],0,-5) . "</NumKardex>\n";
						$salida_xml .= "\t\t<FechaIngreso>" .  fdate($x['fecha_ingreso']) . "</FechaIngreso>\n";
						$salida_xml .= "\t\t<TipoInstrumento>" . $x['tipokardex'] . "</TipoInstrumento>\n";
						$salida_xml .= "\t\t<NumDocumento>" . $e . "</NumDocumento>\n";
						$salida_xml .= "\t\t<FechaInstrumento>" .  $e1 . "</FechaInstrumento>\n";
						if($folio<=0){$salida_xml .= "\t\t<NumFolios>" . "1" . "</NumFolios>\n";}else{ $salida_xml .= "\t\t<NumFolios>" . $folio . "</NumFolios>\n";}
						if($x['fechaconclusion'] != null ){$salida_xml .= "\t\t<FechaConclusion>" .fdate($x['fechaconclusion']) . "</FechaConclusion>\n";}else{$salida_xml .= ""; }
			$salida_xml .= "\t</Documento>\n";
			
		$salida_xml .= "\t<Maestros>\n"; 

		$kar=$x['kardex'];

		//QUERY PARA PERSONAS NATURALES
	$query2 ="SELECT idcontratante, id, tipp, apepat, apemat, nom, nombre, direccion, idtipdoc, numdoc, email, telfijo, telcel, telofi, gen, estc, natper, conyuge, naci, idprofesion, detaprofesion, idcargoprofe, profocupa, dirfer, idubigeo, fechanaci, residente, distrito, provincia, departamento, tipodoc, profesion, nacionalidad, cargo, ROLUIF FROM sisgen_temp_n WHERE kardex='$kar' GROUP BY idcliente";
				
	
	//QUERY PARA PERSONAS JURIDICAS
	$query3 = "SELECT idcontratante, id, tipp, tipodoc, numdoc, idubigeo, razonsocial, domfiscal, telempresa, correoemp, objeto, fechaconstitu, sedereg, numregistro, numpartidareg, actmunicipal, residente, docpaisemi, idtipkar, kardex, condi, firma, fechafirma, resfirma, tiporepresentacion, idcontratanterp, idsedereg, numpartida, facultades, inscrito, distrito, provincia, departamento, ciuu,profesion, nacionalidad, ROUIF FROM sisgen_temp_j WHERE kardex='$kar' GROUP BY idcliente";




$query5 = "SELECT  dm.detmp AS idmediop FROM detallemediopago dm WHERE  kardex='$kar' GROUP BY dm.kardex";
	
	
	
// PATRIMONIAL CON CUantia Operacion
$queryCuantia="SELECT idtipoacto AS tipacto, kardex,  importetrans , CONCAT('0',idmon)AS tipomon FROM patrimonial WHERE kardex ='$kar' GROUP BY kardex";

$tipoMoneda = mysqli_query( $conn,$queryCuantia) or die("Sin Kardex Encontrados--");
 
 while($tipoMon = mysqli_fetch_array($tipoMoneda)){ 
		$tipoM=$tipoMon['tipomon'];
	}
	
//----medios de pago   
$query51 = "SELECT dm.detmp,dm.kardex, dm.tipacto, dm.codmepag, dm.fpago AS fechaope , CONCAT ('000',bc.codbancos) AS idbancos, 
dm.importemp AS importetrans, CONCAT('0',dm.idmon) AS tipomon, dm.foperacion, dm.documentos AS idpago, mp.codmepag , mp.uif, mp.cod_sisgen AS idmediop, mp.desmpagos,
 op.idoppago AS oport, pa.exhibiomp AS exxx, pa.nminuta AS fechaminuta, fp.codigo AS codigofp, 
 SUBSTRING(pa.des_idoppago,1,40) AS des_idoppago 
	FROM sisgen_temp					
	INNER JOIN detallemediopago dm ON dm.kardex = sisgen_temp.kardex
 LEFT JOIN mediospago mp ON dm.codmepag=mp.codmepag 
 LEFT JOIN patrimonial pa ON dm.kardex=pa.kardex 
 LEFT JOIN oporpago op ON pa.idoppago=op.codoppago 
 LEFT JOIN bancos bc ON dm.idbancos= bc.idbancos 
 LEFT JOIN fpago_uif fp ON fp.id_fpago=pa.fpago WHERE dm.kardex='$kar' GROUP BY  dm.detmp";
	
	//die ($query51);
	
$querymediopago = "SELECT DISTINCT  pa.nminuta AS fechaminuta
	FROM detallemediopago dm 
	LEFT OUTER JOIN patrimonial pa 
	ON dm.kardex=pa.kardex
	WHERE dm.kardex='$kar' GROUP BY dm.tipacto";

$query4 = "SELECT   detveh as idvehiculo,  kardex,  idtipacto,  idplaca,  numplaca,  clase,  marca,  anofab,  modelo,  combustible,  carroceria,
	fecinsc,  color,  motor,  numcil,  numserie,  numrueda,  idmon,  precio,  codmepag,  pregistral,  idsedereg
FROM detallevehicular 
WHERE kardex='$kar' ";


$query6 = "SELECT idcon, idcl, tipp, apepat, apemat, nom, nombre, direccion, tipodoc, numdoc, email, telfijo, telcel, telofi, gen, estc, natper, conyuge, nacionalidad, profesion, detaprofesion, cargo, profocupa, dirfer, idubigeo, fechanaci, fechaing, razonsocial, domfiscal, telempresa, correoemp, contacempresa, fechaconstitu, idsedereg, numregistro, numpartida, actmunicipal, tipocli, impeingre, impnumof, impeorigen, impentidad, impremite, impmotivo, residente, docpaisemi, kardex, firma, ffirma, resfirma, tiporepresentacion, idcontratanterp, facultades, indice, visita, inscrito, condi, condicionn, id, idtipkar, idtipoacto, idcontratante, item, idcondicion, parte, porcentaje, repre, formulario, montoo, opago, fondos, montop FROM sisgen_intervenciones_6 WHERE kardex ='$kar'";

//die($query6);

$query7 = "SELECT   id,  idtipkar,  kardex,  idtipoacto,  idcontratante,  item,  idcondicion,  parte,  porcentaje,
	uif,  formulario,  monto,  opago,  ofondo,  montop
FROM contratantesxacto WHERE kardex='$kar'";


$query8 = "SELECT   db.detbien AS idbien,  db.itemmp,  db.kardex,  db.idtipacto,  db.tipob ,  tb.codbien  AS tipo,  db.coddis,  db.fechaconst,  db.oespecific,  
db.smaquiequipo,  tpsm, db.npsm,  db.pregistral AS pregistral,  db.idsedereg AS sederegistral, u.coddist AS distrito,u.codprov AS provincia,u.codpto AS departamento
FROM detallebienes db,ubigeo u, tipobien tb
WHERE u.coddis=db.coddis AND db.idtipbien=tb.idtipbien AND db.kardex='$kar' and codbien ='04' " ;

$querybienveh="SELECT   db.detbien AS idbien,  db.itemmp,  db.kardex,  db.idtipacto,  db.tipob ,  tb.codbien  AS tipo,  db.coddis,  db.fechaconst,  db.oespecific,  
db.smaquiequipo,  tpsm, db.npsm,  db.pregistral AS pregistral,  db.idsedereg AS sederegistral 
FROM detallebienes db, tipobien tb
WHERE db.idtipbien=tb.idtipbien AND db.kardex='$kar' and codbien =09";

$queryotros="SELECT   db.detbien AS idbien,  db.itemmp,  db.kardex,  db.idtipacto,  db.tipob ,  tb.codbien  AS tipo,  db.coddis,  db.fechaconst,  db.oespecific,  
db.smaquiequipo,  tpsm, db.npsm,  db.pregistral AS pregistral,  db.idsedereg AS sederegistral 
FROM detallebienes db, tipobien tb
WHERE db.idtipbien=tb.idtipbien AND db.kardex='$kar' AND codbien =99";



 $query11 = "SELECT idcon, idcl, tipp, apepat, apemat, nom, nombre, direccion, tipodoc, numdoc, email, telfijo, telcel, 
telofi, gen, estc, natper, conyuge, nacionalidad, profesion, detaprofesion, cargo, profocupa, dirfer, 
idubigeo, fechanaci, fechaing, razonsocial, domfiscal, telempresa, correoemp, contacempresa, fechaconstitu, 
idsedereg, numregistro, numpartida, actmunicipal, tipocli, impeingre, impnumof, impeorigen, impentidad, 
impremite, impmotivo, residente, docpaisemi, kardex, firma, STR_TO_DATE(ffirma,'%d/%m/%Y') AS ffirma, resfirma, tiporepresentacion, 
idcontratanterp, facultades, indice, visita, inscrito, condi, condicionn,condicionnsisgen, id, idtipkar, idtipoacto, 
idcontratante, item, idcondicion, parte, porcentaje, repre, formulario, montoo, opago, fondos, montop 
FROM sisgen_intervenciones_6  where kardex='$kar'
GROUP BY repre ORDER BY repre ASC";


//die('hola');
$resultado2 = mysqli_query($conn,$query2) or die("Personas Naturales no Encontradas"); 
		
		if(mysqli_num_rows($resultado2) != 0 ) {
				$salida_xml .= "\t\t<PersonasNaturales>\n"; 
							 while($x2 = mysqli_fetch_array($resultado2)){ 
										$f=$x2['tipp'];
										$conyuge=$x2['conyuge'];
										if($x2['gen']=='M'){
												$ge='V';
										}else{
												$ge='M';
										}
										 if($f=='N'){

										 //PERSONA NATURAL

				$salida_xml .= "\t\t\t<PersonaNatural id='".$x2['id']."'>\n"; 
										$salida_xml .="\t\t\t<DocsIdentificativos>\n";
											$salida_xml .= "\t\t\t\t<DocIdentificativo>\n"; 
													 if($x2['tipodoc']==""){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t\t<TipoDocIdentidad>" .trim($x2['tipodoc']). "</TipoDocIdentidad>\n";}  
													 if($x2['numdoc']==""){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t\t<NumDocIdentificativo>" .trim($x2['numdoc']). "</NumDocIdentificativo>\n";}  
											$salida_xml .= "\t\t\t\t</DocIdentificativo>\n";
										$salida_xml .="\t\t\t</DocsIdentificativos>\n";
										if($x2['nom']==""){$salida_xml.='';}else{$salida_xml .= "\t\t\t\t<Nombre>" .trim(str_replace("  "," ",($x2['nom']))). "</Nombre>\n";}  
										if($x2['apepat']==""){$salida_xml.='';}else{$salida_xml .= "\t\t\t\t<PrimerApellido>" .trim(str_replace("  "," ",($x2['apepat']))). "</PrimerApellido>\n";}  
										if($x2['apemat']==""){$salida_xml.='';}else{$salida_xml .= "\t\t\t\t<SegundoApellido>" .trim(str_replace("  "," ",($x2['apemat']))). "</SegundoApellido>\n";} 
										if($x2['gen']==""){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t<Genero>" .$ge. "</Genero>\n";}  
										if($x2['estc']=="" or $x2['estc']==0){$salida_xml.='';}else{$salida_xml .= "\t\t\t\t<EstadoCivil>" .$x2['estc']. "</EstadoCivil>\n";}  
										//if($x2['conyuge']==""){$salida_xml.='';}else{$salida_xml .= "\t\t\t\t<Conyuge>" .$x2['conyuge']. "</Conyuge>\n";}
										if($x2['nacionalidad']==""){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t<PaisNacionalidad>" .$x2['nacionalidad']. "</PaisNacionalidad>\n";}
										if($x2['fechanaci']==""){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t<FechaNacimiento>" .fdate($x2['fechanaci']). "</FechaNacimiento>\n";}
										if($x2['profesion']=="" or $x2['profesion']==0){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t<Profesion>" .$x2['profesion']. "</Profesion>\n";}
										if($x2['cargo']=="" or $x2['cargo']==0){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t<Cargo>" .$x2['cargo']. "</Cargo>\n";}
										
										if($x2['profesion']!="000" && $x2['profesion']!="" && $x2['profesion']=="999"){
											if($x2['detaprofesion']==""){$salida_xml.="\t\t\t\t<OtraProfesion>OTROS</OtraProfesion>\n";}else{$salida_xml .= "\t\t\t\t<OtraProfesion>" .substr(str_replace(")","",str_replace("(","",str_replace("  "," ",str_replace("/","",trim(str_replace("  "," ",($x2['detaprofesion']))))))),0,50). "</OtraProfesion>\n";}
										}
										if($x2['cargo']!="000" && $x2['cargo']!="" && $x2['cargo']=="999"){
											if($x2['profocupa']==""){$salida_xml.="\t\t\t\t<OtroCargo>OTROS</OtroCargo>\n";}else{$salida_xml .= "\t\t\t\t<OtroCargo>" .substr(str_replace(")","",str_replace("(","",str_replace("  "," ",str_replace("/","",trim(str_replace("  "," ",($x2['profocupa']))))))),0,50). "</OtroCargo>\n";}
										}
										
										if($x2['email']=="" || !filter_var($x2['email'], FILTER_VALIDATE_EMAIL)){

											$salida_xml .= "";

										}else{

											$salida_xml .= "\t\t\t\t<Correo>" .trim($x2['email']). "</Correo>\n";
										}
										

										if($x2['telcel']==""){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t<Telefono>".trim(substr($x2['telcel'],0,20)). "</Telefono>\n";}
										if($x2['departamento']!="" and $x2['provincia']!="" and $x2['distrito']!="" and $x2['direccion']!=""){
										$salida_xml .= "\t\t\t\t<Direccion>\n";

												if($x2['residente']==""){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t\t<ResidePeru>" .$x2['residente']. "</ResidePeru>\n";}
												if($x2['nacionalidad']==""){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t\t<PaisResidencia>" .$x2['nacionalidad']. "</PaisResidencia>\n";}

												$salida_xml .= "\t\t\t\t<DireccionNacional>\n";
														if($x2['departamento']==""){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t\t<CodDepartamento>" .$x2['departamento']. "</CodDepartamento>\n";}
														if($x2['provincia']==""){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t\t<CodProvincia>" .$x2['provincia']. "</CodProvincia>\n";}
														if($x2['distrito']==""){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t\t<CodDistrito>" .$x2['distrito']. "</CodDistrito>\n";}
														if($x2['direccion']==""){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t\t<RestoDireccion>" .substr(trim(str_replace("  "," ",($x2['direccion']))),0,255). "</RestoDireccion>\n";}
														
												$salida_xml .= "\t\t\t\t</DireccionNacional>\n";
										$salida_xml .= "\t\t\t\t</Direccion>\n";
											}
									
				$salida_xml .= "\t\t\t</PersonaNatural>\n"; 

															 }
														} 
				$salida_xml .= "\t\t</PersonasNaturales>\n"; 

		}

$resultado3 = mysqli_query($conn,$query3) or die("Sin personas Juridicas"); 

	
			 if(mysqli_num_rows($resultado3) != 0 ) {

				$salida_xml .= "\t\t<PersonasJuridicas>\n"; 


				 while($x3 = mysqli_fetch_array($resultado3)){ 
						$f1=$x3['tipp'];
						 if($f1=='J'){
								$salida_xml .= "\t\t\t<PersonaJuridica id='".$x3['id']."'>\n";
										$salida_xml .= "\t\t\t<DocsIdentificativos>\n";
											$salida_xml .= "\t\t\t\t<DocIdentificativo>\n"; 
												 if($x3['tipodoc']==""){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t\t<TipoDocIdentidad>" .$x3['tipodoc']. "</TipoDocIdentidad>\n";}
												 if($x3['numdoc']==""){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t\t<NumDocIdentificativo>" .trim($x3['numdoc']). "</NumDocIdentificativo>\n";}
											$salida_xml .= "\t\t\t\t</DocIdentificativo>\n";
										$salida_xml .= "\t\t\t</DocsIdentificativos>\n"; 
										
										$salida_xml .= "\t\t\t\t<RegistroFacultades>\n";
												if($x3['sedereg']=="" or $x3['sedereg']=="00" ){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t\t<SedeRegistral>" .$x3['sedereg']. "</SedeRegistral>\n";} 
												 if($x3['numpartidareg']==""){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t\t<PartidaRegistral>" .substr(trim($x3['numpartidareg']),0,12). "</PartidaRegistral>\n";} 
										$salida_xml .= "\t\t\t\t</RegistroFacultades>\n";
										
										if($x3['razonsocial']==""){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t<RazonSocial>" .trim(str_replace("&","*",str_replace("  "," ",str_replace("   "," ",(substr($x3['razonsocial'],0,120)))))). "</RazonSocial>\n";}
										if($x3['ciuu']==""){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t<SectorEconomico>" .$x3['ciuu']. "</SectorEconomico>\n";} 
										if($x3['objeto']==""){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t<OtraActividad>" .trim(str_replace("  "," ",str_replace("   "," ",(substr($x3['objeto'],0,50))))). "</OtraActividad>\n";} 

										if($x3['correoemp'] == "" || !filter_var($x3['correoemp'], FILTER_VALIDATE_EMAIL)){
											$salida_xml.="";
										}else{
											$salida_xml .= "\t\t\t\t\t<Correo>" .trim($x3['correoemp']). "</Correo>\n";
										} 


										if($x3['telempresa']==""){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t\t<Telefono>" .substr(trim($x3['telempresa']),0,20). "</Telefono>\n";}
										if($x3['idubigeo']=="999999" ){$salida_xml.="";}else{
												$salida_xml .= "\t\t\t\t<Direccion>\n";
													if($x3['idubigeo']=="999999"){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t\t<PaisResidencia>" ."PE". "</PaisResidencia>\n";}  
														$salida_xml .= "\t\t\t\t<DireccionNacional>\n";
																if($x3['departamento']==""){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t\t<CodDepartamento>" .$x3['departamento']. "</CodDepartamento>\n";}    
																if($x3['provincia']=="" ){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t\t<CodProvincia>" .$x3['provincia']. "</CodProvincia>\n";} 
																if($x3['distrito']=="" ){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t\t<CodDistrito>" .$x3['distrito']. "</CodDistrito>\n";} 
																if($x3['domfiscal']==""){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t\t<RestoDireccion>" .substr(trim(str_replace("  "," ",str_replace("   "," ",($x3['domfiscal'])))),0,255). "</RestoDireccion>\n";} 
														$salida_xml .= "\t\t\t\t</DireccionNacional>\n";
												$salida_xml .= "\t\t\t\t</Direccion>\n";
											}      
								$salida_xml .= "\t\t\t</PersonaJuridica>\n"; 
						}
				}
				$salida_xml .= "\t\t</PersonasJuridicas>\n"; 

			}
			 $resultadooo8=mysqli_query( $conn,$query8) or die("Sin Detalle de Bienes"); 
				if(mysqli_num_rows($resultadooo8) != 0 ){	
					$salida_xml .= "\t\t<PrediosUrbanos>\n"; 
								while($xxv= mysqli_fetch_array($resultadooo8)){ 

										$salida_xml .= "\t\t\t<PredioUrbano  id='". $xxv['idbien'] ."'>\n"; 
											if($xxv['tipo']==""){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t\t<TipoConstruccion>" ."6". "</TipoConstruccion>\n";} 
												$salida_xml .= "\t\t\t\t<IdentificacionPredio>\n"; 
													if($xxv['sederegistral']==""){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t\t<SedeRegistral>" .$xxv['sederegistral']. "</SedeRegistral>\n";} 
													if($xxv['pregistral']==""){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t\t<PartidaRegistral>" .$xxv['pregistral']. "</PartidaRegistral>\n";}   
												$salida_xml .= "\t\t\t\t</IdentificacionPredio>\n"; 
												$salida_xml .= "\t\t\t\t<DireccionUrbana>\n"; 
													if($xxv['departamento']==""){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t\t<CodDepartamento>" .$xxv['departamento']. "</CodDepartamento>\n";} 
													if($xxv['provincia']==""){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t\t<CodProvincia>" .$xxv['provincia']. "</CodProvincia>\n";} 
													if($xxv['distrito']==""){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t\t<CodDistrito>" .$xxv['distrito']. "</CodDistrito>\n";} 
												$salida_xml .= "\t\t\t\t</DireccionUrbana>\n"; 
										$salida_xml .= "\t\t\t</PredioUrbano>\n"; 
								}
					$salida_xml .= "\t\t</PrediosUrbanos>\n"; 
				}

			 $resultadooo82 = mysqli_query( $conn,$querybienveh) or die("Sin Vehiculo"); 

				 if(mysqli_num_rows($resultadooo82) != 0 ) {

			$salida_xml .= "\t\t<Vehiculos>\n"; 
								 while($xxv= mysqli_fetch_array($resultadooo82)){ 
							$salida_xml .= "\t\t\t<Vehiculo  id='". $xxv['idbien'] ."'>\n"; 

								//$salida_xml .= "\t\t\t\t\t<ClasePredioUrbano>" . "" . "</ClasePredioUrbano>\n";
								if($xxv['tipo']==""){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t\t<TipoVehiculo>" ."4". "</TipoVehiculo>\n";} 
								if($xxv['tipo']==""){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t\t<TipoIdentificacionVehiculo>" ."1". "</TipoIdentificacionVehiculo>\n";} 
								if($xxv['npsm']==""){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t\t<NumPlaca>" .$xxv['npsm']. "</NumPlaca>\n";} 
								//$salida_xml .= "\t\t\t\t\t<Area>" . "" . "</Area>\n";
								if($xxv['sederegistral']==""){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t\t<SedeRegistral>" .$xxv['sederegistral']. "</SedeRegistral>\n";} 
								if($xxv['pregistral']==""){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t\t<PartidaRegistral>" .$xxv['pregistral']. "</PartidaRegistral>\n";}   
							$salida_xml .= "\t\t\t</Vehiculo>\n"; 
						 }
			$salida_xml .= "\t\t</Vehiculos>\n"; 
}

$resultado4=mysqli_query($conn,$query4) or die("Sin Vehiculo"); 
			 if(mysqli_num_rows($resultado4) != 0 ) {

				$salida_xml .= "\t\t<Vehiculos>\n"; 
							while($x4 = mysqli_fetch_array($resultado4)){ 
								$salida_xml .= "\t\t\t<Vehiculo  id='". $x4['idvehiculo'] ."'>\n"; 
								if($x4['idplaca']==""){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t\t<TipoVehiculo>" . "4" . "</TipoVehiculo>\n";}
									
															if($x4['idplaca']=="P"){$salida_xml .= "\t\t\t\t\t<TipoIdentificacionVehiculo>" . "1". "</TipoIdentificacionVehiculo>\n";}else{$salida_xml .= "\t\t\t\t\t<TipoIdentificacionVehiculo>" . "2" . "</TipoIdentificacionVehiculo>\n";}
															if($x4['numplaca']==""){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t\t<NumPlaca>" . trim($x4['numplaca']) . "</NumPlaca>\n";}
															if($x4['clase']=="" ){$salida_xml.="";}else{ $salida_xml .= "\t\t\t\t\t<Clase>" . trim($x4['clase']) . "</Clase>\n";}
															if($x4['marca']=="" ){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t\t<Marca>" . trim($x4['marca']) . "</Marca>\n";}
															if($x4['anofab']==""  ){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t\t<AnoFabricacion>" . trim($x4['anofab']) . "</AnoFabricacion>\n";}
															if($x4['modelo']=="" ){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t\t<Modelo>" . trim($x4['modelo']) . "</Modelo>\n";}
															if($x4['combustible']=="" ){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t\t<Combustible>" . trim($x4['combustible']) . "</Combustible>\n";}
															if($x4['carroceria']==""){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t\t<Carroceria>" . trim($x4['carroceria']) . "</Carroceria>\n";}
															if($x4['color']==""){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t\t<Color>" . trim($x4['color']) . "</Color>\n";}
															if($x4['motor']==""){$salida_xml.="";}else{ $salida_xml .= "\t\t\t\t\t<Motor>" . trim($x4['motor']) . "</Motor>\n";}
															if($x4['numcil']==""){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t\t<NumCilindros>" . trim($x4['numcil']) . "</NumCilindros>\n";}                
															if($x4['numserie']=="" ){$salida_xml.="";}else{ $salida_xml .= "\t\t\t\t\t<NumSerie>" . trim($x4['numserie']) . "</NumSerie>\n";}            
															if($x4['numrueda']=="" ){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t\t<NumRueda>" . trim($x4['numrueda']) . "</NumRueda>\n";}
															if($x4['idsedereg']=="" ){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t\t<SedeRegistral>" . trim($x4['idsedereg']) . "</SedeRegistral>\n";}
															if($x4['pregistral']=="" ){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t\t<PartidaRegistral>" . trim($x4['pregistral']) . "</PartidaRegistral>\n";}
								$salida_xml .= "\t\t\t</Vehiculo>\n"; 

}
				$salida_xml .= "\t\t</Vehiculos>\n"; 
}

		 $resultadooo823=mysqli_query( $conn,$queryotros) or die("Sin Objeto otros"); 

				 if(mysqli_num_rows($resultadooo823) != 0 ) {

			        $salida_xml .= "\t\t<OtrosObjetos>\n"; 


								 while($xxotros= mysqli_fetch_array($resultadooo823)){ 

							$salida_xml .= "\t\t\t<OtroObjeto  id='". $xxotros['idbien'] ."'>\n"; 
								
								if($xxotros['oespecific']==""){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t<Descripcion>" . $xxotros['oespecific'] . "</Descripcion>\n";} 
								if($xxotros['tipo']==""){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t<ClaseObjeto>" ."7" . "</ClaseObjeto>\n";} 
										
				
							 $salida_xml .= "\t\t\t</OtroObjeto>\n"; 

						 }
					$salida_xml .= "\t\t</OtrosObjetos>\n";
}


		$salida_xml .= "\t</Maestros>\n";

		
	 $salida_xml .= "\t<Operaciones>\n"; 

		
$resultadoDf=mysqli_query( $conn,$query5) or die("Sin Detalle medio pago"); 
//EMPIEZA MOD   
$resultadotPREDIO=mysqli_query($conn,$query8) or die("sin resultado 1");    
$resultadotipppp22=mysqli_query($conn,$querybienveh) or die("sin resultado 2");		
$resultadotiotros=mysqli_query($conn,$queryotros) or die("sin resultado 3");				
$resultadoVEHICULO=mysqli_query($conn,$query4) or die("sin resultado 4");
 //             
				//$xk=$x['tipokardex'];
				
		$codactoxkardex=$x['codactos'];
				
				
					

		if(strlen($codactoxkardex) > 3){

			$arrCodActos = array();
				for($i = 0;$i<strlen($codactoxkardex);$i = $i+3){
				$arrCodActos[] = array('codActo'=>substr($codactoxkardex, $i ,3));
				
				}
				
				foreach ($arrCodActos as  $item) {
				# code...
				$codActo62 = $item['codActo'];
				
				
							
							
				/*if($xk==3){

				$resultadotipppp=mysql_query($query4, $conn) or die("sin resultado");     
					while($xtip = mysql_fetch_array($resultadotipppp)){

											 $iddd=$xtip['idvehiculo'];
										
									} 
		
				}

				else  if ($xk==1){

						$resultadotipppp2=mysql_query($query8, $conn) or die("sin resultado");    
					while($xtip2 = mysql_fetch_array($resultadotipppp2)){

											$iddd=$xtip2['idbien'];
																						
										}
										
				}*/

								 while($xxx3 = mysqli_fetch_array($resultadoDf)){

										$iddddd=$xxx3['idmediop'];
								 }
									
									  
										
					
				// $salida_xml .= "\t\t\t<Operacion id='".$iddddd ."'>\n"; 
				
				$consultakardex ="SELECT idtipoacto, desacto, cod_ancert FROM tiposdeacto WHERE idtipoacto='$codActo62' and cod_ancert !='' ";
				$resultadokardex=mysqli_query($conn,$consultakardex) or die("sin resultado 5");
				
				if(mysqli_num_rows($resultadokardex) != 0 ) {								
							 while($kardcant= mysqli_fetch_array($resultadokardex)){ 
						$codigoacto=$kardcant['idtipoacto'];
						$salida_xml.="\t\t<Operacion id='".$kardcant['idtipoacto'] ."'>\n";
						
				  // if($iddddd==""){$salida_xml.="\t\t\t<Operacion id='01'>\n";}else{$salida_xml.="\t\t\t<Operacion id='".$iddddd ."'>\n";}

					if($kardcant['idtipoacto']=="" or $kardcant['idtipoacto']==0 ){$salida_xml.="";}else{   $salida_xml .= "\t\t\t\t<CodActoJuridico>" . $kardcant['cod_ancert']. "</CodActoJuridico>\n";}  
				 
					$salida_xml .= "\t\t\t<Operantes>\n"; 
						$salida_xml .="\t\t\t\t<Objetos>\n";
						
						$prediokardex="SELECT   db.detbien AS idbien,  db.itemmp,  db.kardex,  db.idtipacto,  db.tipob ,  tb.codbien  AS tipo,  db.coddis,  db.fechaconst,  db.oespecific,  
						db.smaquiequipo,  tpsm, db.npsm,  db.pregistral AS pregistral,  db.idsedereg AS sederegistral, u.coddist AS distrito,u.codprov AS provincia,u.codpto AS departamento
						FROM detallebienes db,ubigeo u, tipobien tb
						WHERE u.coddis=db.coddis AND db.idtipbien=tb.idtipbien AND db.kardex='$kar' AND codbien ='04' AND idtipacto ='$codigoacto'";
						$prediokarde=mysqli_query($conn,$prediokardex) or die("sin resultado 6");
						if(mysqli_num_rows($prediokarde) != 0 ) {								
							 while($bienpredio= mysqli_fetch_array($prediokarde)){ 
							$salida_xml .="\t\t\t\t\t<Objeto>\n";
						 if($bienpredio['idbien']=="" or $bienpredio['idbien']==0 ){$salida_xml.="";}else{   $salida_xml .= "\t\t\t\t\t\t<IdMaestro>" . $bienpredio['idbien']. "</IdMaestro>\n";}
							if($bienpredio['fechaconst']=="" or $bienpredio['fechaconst']==0 ){$salida_xml.="";}else{ $salida_xml.="\t\t\t\t\t\t<DetalleObjeto>\n" ;}
							if($bienpredio['fechaconst']=="" or $bienpredio['fechaconst']==0 ){$salida_xml.="";}else{  $salida_xml .= "\t\t\t\t\t\t\t<FechaAdquisicion>" .fdate($bienpredio['fechaconst']). "</FechaAdquisicion>\n";}
							if($bienpredio['fechaconst']=="" or $bienpredio['fechaconst']==0 ){$salida_xml.="";}else{ $salida_xml.="\t\t\t\t\t\t</DetalleObjeto>\n"; }
						 
							$salida_xml .="\t\t\t\t\t</Objeto>\n";
							}							
						 }
						 $bienvehi="SELECT   db.detbien AS idbien,  db.itemmp,  db.kardex,  db.idtipacto,  db.tipob ,  tb.codbien  AS tipo,  db.coddis,  db.fechaconst,  db.oespecific,  
						db.smaquiequipo,  tpsm, db.npsm,  db.pregistral AS pregistral,  db.idsedereg AS sederegistral, u.coddist AS distrito,u.codprov AS provincia,u.codpto AS departamento
						FROM detallebienes db,ubigeo u, tipobien tb
						WHERE u.coddis=db.coddis AND db.idtipbien=tb.idtipbien AND db.kardex='$kar' AND codbien ='09' AND idtipacto ='$codigoacto'";
						$bienvehi2=mysqli_query($conn,$bienvehi) or die("sin resultado 7");
						if(mysqli_num_rows($bienvehi2) != 0 ) {								
							 while($xxv2= mysqli_fetch_array($bienvehi2)){ 
							$salida_xml .="\t\t\t\t\t<Objeto>\n";
						 if($xxv2['idbien']=="" or $xxv2['idbien']==0 ){$salida_xml.="";}else{   $salida_xml .= "\t\t\t\t\t\t<IdMaestro>" . $xxv2['idbien']. "</IdMaestro>\n";}
							$salida_xml .="\t\t\t\t\t</Objeto>\n";
							}							
						 }
						 $otrospredios="SELECT   db.detbien AS idbien,  db.itemmp,  db.kardex,  db.idtipacto,  db.tipob ,  tb.codbien  AS tipo,  db.coddis,  db.fechaconst,  db.oespecific,  
							db.smaquiequipo,  tpsm, db.npsm,  db.pregistral AS pregistral,  db.idsedereg AS sederegistral 
							FROM detallebienes db, tipobien tb
							WHERE db.idtipbien=tb.idtipbien AND db.kardex='$kar' AND codbien =99 AND idtipacto ='$codigoacto'";
						$otrospredios2=mysqli_query($conn,$otrospredios) or die("sin resultado 8");
						if(mysqli_num_rows($otrospredios2) != 0 ) {								
							 while($xxv23= mysqli_fetch_array($otrospredios2)){ 
							$salida_xml .="\t\t\t\t\t<Objeto>\n";
						 if($xxv23['idbien']=="" or $xxv23['idbien']==0 ){$salida_xml.="";}else{   $salida_xml .= "\t\t\t\t\t\t<IdMaestro>" . $xxv23['idbien']. "</IdMaestro>\n";}
							$salida_xml .="\t\t\t\t\t</Objeto>\n";
							}							
						 }		
						
						$prediokarde=mysqli_query($conn,$prediokardex) or die("sin resultado 9");						 
						if(mysqli_num_rows($resultadoVEHICULO) != 0 ) {								
							 while($iddd= mysqli_fetch_array($resultadoVEHICULO)){ 
							$salida_xml .="\t\t\t\t\t<Objeto>\n";
						 if($iddd['idvehiculo']=="" or $iddd['idvehiculo']==0 ){$salida_xml.="";}else{   $salida_xml .= "\t\t\t\t\t\t<IdMaestro>" . $iddd['idvehiculo']. "</IdMaestro>\n";}
							$salida_xml .="\t\t\t\t\t</Objeto>\n";
							}							
						 }
							
						$salida_xml .="\t\t\t\t</Objetos>\n";
						//$salida_xml .= "\t\t\t\t\t<IdMaestro>". $iddd . "</IdMaestro>\n"; 
						
					 $sq_sujetos="
					 SELECT idcon, idcl, tipp, apepat, apemat, nom, nombre, direccion, tipodoc, numdoc, email, telfijo, telcel, telofi, gen, estc, natper, conyuge, nacionalidad, profesion, detaprofesion, cargo, profocupa, dirfer, idubigeo, fechanaci, fechaing, razonsocial, domfiscal, telempresa, correoemp, contacempresa, fechaconstitu, idsedereg, numregistro, numpartida, actmunicipal, tipocli, impeingre, impnumof, impeorigen, impentidad, impremite, impmotivo, residente, docpaisemi, kardex, firma, ffirma, resfirma, tiporepresentacion, idcontratanterp, facultades, indice, visita, inscrito, condi, condicionn, id, idtipkar, idtipoacto, idcontratante, item, idcondicion, parte, porcentaje, repre, formulario, montoo, opago, fondos, montop FROM sisgen_intervenciones_6 WHERE kardex ='$kar' AND idtipoacto ='$codigoacto' ";
							

							 $resultadoD=mysqli_query($conn,$sq_sujetos) or die("sin resultado 10");   

						$sq_cuantiadeoperacion="SELECT idtipoacto AS tipacto, kardex,  importetrans , CONCAT('0',idmon)AS tipomon FROM patrimonial WHERE kardex ='$kar'
										AND idtipoacto ='$codigoacto'";	

							$tipoMoneda2 = mysqli_query($conn,$sq_cuantiadeoperacion) or die("Sin Kardex Encontrados");
							 
							 while($tipoMon2 = mysqli_fetch_array($tipoMoneda2)){ 
									$tipoM2=$tipoMon2['tipomon'];
								}										
								
						$salida_xml .=	"\t\t\t\t\t<Intervenciones>\n";
						$salida_xml .= "\t\t\t\t\t\t<Intervencion>\n"; 

						 $sq_intervencion=" SELECT idcon, idcl, tipp, apepat, apemat, nom, nombre, direccion, tipodoc, numdoc, email, telfijo, telcel, 
telofi, gen, estc, natper, conyuge, nacionalidad, profesion, detaprofesion, cargo, profocupa, dirfer, 
idubigeo, fechanaci, fechaing, razonsocial, domfiscal, telempresa, correoemp, contacempresa, fechaconstitu, 
idsedereg, numregistro, numpartida, actmunicipal, tipocli, impeingre, impnumof, impeorigen, impentidad, 
impremite, impmotivo, residente, docpaisemi, kardex, firma, STR_TO_DATE(ffirma,'%d/%m/%Y') AS ffirma, resfirma, tiporepresentacion, 
idcontratanterp, facultades, indice, visita, inscrito, condi, condicionn,condicionnsisgen, id, idtipkar, idtipoacto, 
idcontratante, item, idcondicion, parte, porcentaje, repre, formulario, montoo, opago, fondos, montop 
FROM sisgen_intervenciones_6  where kardex='$kar' and idtipoacto = '$codigoacto'
GROUP BY repre ORDER BY repre ASC
						";
						
							$resultadoD11=mysqli_query($conn,$sq_intervencion) or die("sin resultado 11");

								while($xxx11 = mysqli_fetch_array($resultadoD11)){

									if($xxx11['repre']!='R' and $xxx11['repre']=='O' ){
									
//apo
						//if($xxx['condi']=="" or $xxx['condi']==0 ){$salida_xml.="";}else{  $salida_xml .= "\t\t\t\t\t<TipoIntervencion>" .'' $xxx['parte']'' . "</TipoIntervencion>\n";}  
							 //if($xxx['condicionn']=="" ){$salida_xml.="";}else{   $salida_xml .= "\t\t\t\t\t<DescripcionIntervencion>" . $xxx['condicionn'] . "</DescripcionIntervencion>\n";}             

						 $salida_xml .= "\t\t\t\t\t\t\t<TipoIntervencion>" .$xxx11['parte']  . "</TipoIntervencion>\n";
						 $salida_xml .= "\t\t\t\t\t\t\t<DescripcionIntervencion>" .$xxx11['condicionnsisgen']. "</DescripcionIntervencion>\n";
						  $salida_xml .= "\t\t\t\t\t\t\t<RolRepresentante>" .$xxx11['repre']. "</RolRepresentante>\n";
						
							 /* while($xxx = mysql_fetch_array($resultadoD)){

									if($xxx['repre']!='R' and $xxx['condicionn']=='VENDEDOR' ){  
								 
								*/

									}
								}
							 $salida_xml .= "\t\t\t\t\t\t\t<Sujetos>\n";
							 while($xxx = mysqli_fetch_array($resultadoD)){
								 
								 

									if($xxx['repre']!='R' and $xxx['repre']=='O' ){


							
							$salida_xml .= "\t\t\t\t\t\t\t\t<Sujeto>\n";


								 $salida_xml .= "\t\t\t\t\t\t\t\t\t<IdMaestro>" .  $xxx['idcl'] . "</IdMaestro>\n";
	//               $salida_xml .= "\t\t\t\t\t<TipoComparecencia>" . "" . "</TipoComparecencia>\n";
	 //              $salida_xml .= "\t\t\t\t\t<ClaseIntervencion>" . "" . "</ClaseIntervencion>\n";
		//             $salida_xml .= "\t\t\t\t\t<TipoAfectacion>" . "" . "</TipoAfectacion>\n";

								 //frankk
								 $idActo = $xxx['idtipoacto'];
								 if($xxx['idtipoacto']=="1111"){
									 
								 }else{
								 
								 $salida_xml .= "\t\t\t\t\t\t\t\t\t<OrigenFondos>\n"; 
									$salida_xml .= "\t\t\t\t\t\t\t\t\t\t<OrigenFondo>\n";
										if($xxx['fondos']==""){$salida_xml.="";}else{  $salida_xml .= "\t\t\t\t\t\t\t\t\t\t\t<Origen>" .  substr($xxx['fondos'],0,40) . "</Origen>\n";}             
										if($xxx['montoo']==""){$salida_xml.="";}else{  $salida_xml .= "\t\t\t\t\t\t\t\t\t\t\t<CuantiaOrigen>" .trim(number_format($xxx['montoo'],2,".","")). "</CuantiaOrigen>\n";}  
										if($xxx['montoo']==""){
											$salida_xml.="";
										}else{ 
											$sql =  "SELECT detmp FROM detallemediopago WHERE kardex = '$kar' AND   tipacto = '$idActo' LIMIT 1";  
										  	$result = mysqli_query($conn,$sql);
										  	if($rowMedioPago = mysqli_fetch_array($result))
											$salida_xml .= "\t\t\t\t\t\t\t\t\t\t\t<TipoMonedaPago>" . $tipoM2 . "</TipoMonedaPago>\n";
										} 
									$salida_xml .= "\t\t\t\t\t\t\t\t\t\t</OrigenFondo>\n";
								 $salida_xml .= "\t\t\t\t\t\t\t\t\t</OrigenFondos>\n"; 

									
		                 $salida_xml .= "\t\t\t\t\t\t\t\t\t<Derecho>\n"; 
		//                 $salida_xml .= "\t\t\t\t\t<ClaseDerecho>" . "" . "</ClaseDerecho>\n";
		               if($xxx['porcentaje']==""){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t\t\t\t\t\t\t<PorcentajeDerecho>" . trim(number_format($xxx['porcentaje'],2,".","")) . "</PorcentajeDerecho>\n";} 
			//             $salida_xml .= "\t\t\t\t\t<OrigenDerecho>" . "" . "</OrigenDerecho>\n";
			//             $salida_xml .= "\t\t\t\t\t<FechaAdquisicion>" . "" . "</FechaAdquisicion>\n";
				         $salida_xml .= "\t\t\t\t\t\t\t\t\t</Derecho>\n"; 
							}
					//       $
					//       $salida_xml .= "\t\t\t\t\t<NumAcciones>" . "" . "</NumAcciones>\n";
						//     $salida_xml .= "\t\t\t\t\t<ValorPorcentaje>" . "" . "</ValorPorcentaje>\n";

							//   $salida_xml .= "\t\t\t\t<DetalleAcciones>\n"; 
								//   $salida_xml .= "\t\t\t\t\t<Serie>" . "" . "</Serie>\n";
									// $salida_xml .= "\t\t\t\t\t<Numeracion>" . "" . "</Numeracion>\n";
 //                  $salida_xml .= "\t\t\t\t\t<ValorNominalUnidad>" . "" . "</ValorNominalUnidad>\n";
	//                 $salida_xml .= "\t\t\t\t\t<TipoMoneda>" . "" . "</TipoMoneda>\n";
		//             $salida_xml .= "\t\t\t\t</DetalleAcciones>\n"; 
//
	//               $salida_xml .= "\t\t\t\t\t<PresenciaRepresentacion>" . "" . "</PresenciaRepresentacion>\n";
		      $query_renta1="SELECT r.pregu1 ,r.pregu2,r.pregu3  FROM renta r
									where r.kardex='".$xxx['kardex']."' AND r.`idcontratante`='".$xxx['idcontratante']."'
									GROUP BY idcontratante";
						$sql_renta1=mysqli_query($conn,$query_renta1) or die("sin resultado 12"); 	
												
						while($row_renta1 = mysqli_fetch_array($sql_renta1)){
							
							
							if($row_renta1["pregu1"]!=""){			
								$salida_xml .= "\t\t\t\t\t\t\t\t\t<Renta3Cat>" . $row_renta1["pregu1"] . "</Renta3Cat>\n";
							}
							if($row_renta1["pregu2"]!="" ){								
								
								$salida_xml .= "\t\t\t\t\t\t\t\t\t<CasaEnajenante>" . $row_renta1["pregu2"] . "</CasaEnajenante>\n";
							}
							if($row_renta1["pregu3"]!=""){								
								
								$salida_xml .= "\t\t\t\t\t\t\t\t\t<ImpuestoCero>" . $row_renta1["pregu3"] . "</ImpuestoCero>\n";
							}
							
							
						}
						 
	if($xxx['repre']=='O'){

									$reppp=$xxx['idcon'];

									$query91="SELECT idcon, idcl, tipp, apepat, apemat, nom, nombre, direccion, tipodoc, numdoc, email, telfijo, telcel, 
									telofi, gen, estc, natper, conyuge, nacionalidad, profesion, detaprofesion, cargo, profocupa, dirfer, 
									idubigeo, fechanaci, fechaing, razonsocial, domfiscal, telempresa, correoemp, contacempresa, fechaconstitu, 
									idsedereg, numregistro, numpartida, actmunicipal, tipocli, impeingre, impnumof, impeorigen, impentidad, 
									impremite, impmotivo, residente, docpaisemi, kardex, firma, STR_TO_DATE(ffirma,'%d/%m/%Y') AS ffirma, resfirma, tiporepresentacion, 
									idcontratanterp, facultades, indice, visita, inscrito, condi, condicionn,condicionnsisgen, id, idtipkar, idtipoacto, 
									idcontratante, item, idcondicion, parte, porcentaje, repre, formulario, montoo, opago, fondos, montop 
									FROM sisgen_intervenciones_6  WHERE repre ='R' AND kardex='$kar' AND idcontratanterp ='$reppp' AND idtipoacto = '$codigoacto'";

 $resultadoD3=mysqli_query($conn,$query91) or die("sin resultado 13"); 

 
									$salida_xml .= "\t\t\t\t\t\t\t\t\t<Representantes>\n"; 
								 while($xxx1 = mysqli_fetch_array($resultadoD3)){

								
								 $salida_xml .= "\t\t\t\t\t\t\t\t\t\t<Representante>\n"; 

										$salida_xml .= "\t\t\t\t\t\t\t\t\t\t\t<IdMaestro>" . $xxx1['idcl'] . "</IdMaestro>\n";
 //                   $salida_xml .= "\t\t\t\t\t<ClaseRepresentacion>" . "" . "</ClaseRepresentacion>\n";
	//                  $salida_xml .= "\t\t\t\t\t<TipoRepresentacion>" . "" . "</TipoRepresentacion>\n";
	//                  $salida_xml .= "\t\t\t\t\t<EsDocumentoNotarial>" . "" . "</EsDocumentoNotarial>\n";

 //                   $salida_xml .= "\t\t\t\t<DocumentoRepresentacion>\n"; 
 //                      $salida_xml .= "\t\t\t\t\t<CodNotario>" . "" . "</CodNotario>\n";
 //                      $salida_xml .= "\t\t\t\t\t<NumDocumento>" . "" . "</NumDocumento>\n";
	//                     $salida_xml .= "\t\t\t\t\t<TipoInstrumento>" . "" . "</TipoInstrumento>\n";
	 //                    $salida_xml .= "\t\t\t\t\t<AnyoDocumento>" . "" . "</AnyoDocumento>\n";
	//                     $salida_xml .= "\t\t\t\t\t<ObservacionesMediata>" . "" . "</ObservacionesMediata>\n";
	 //                 $salida_xml .= "\t\t\t\t</DocumentoRepresentacion>\n"; 

	 //                 $salida_xml .= "\t\t\t\t\t<OtroDocumento>" . "". "</OtroDocumento>\n";

					if($xxx1['idsedereg']=="" and $xxx1['numpartida']==""){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t\t\t\t\t\t\t\t<InscripcionRepresentacion>\n"; }
	                     if($xxx1['idsedereg']=="" or $xxx1['idsedereg']=="0" ){$salida_xml.="";}else{ $salida_xml .= "\t\t\t\t\t\t\t\t\t\t\t\t<SedeRegistral>" . $xxx1['idsedereg'] . "</SedeRegistral>\n";}
	                     if($xxx1['numpartida']==""){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t\t\t\t\t\t\t\t\t<PartidaRegistral>" . trim($xxx1['numpartida']). "</PartidaRegistral>\n";}
	                if($xxx1['idsedereg']=="" and $xxx1['numpartida']==""){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t\t\t\t\t\t\t\t</InscripcionRepresentacion>\n";}
										//$d = strtotime($xxx['ffirma']);
										

									 //$salida_xml .= "\t\t\t\t\t<FechaFirma>" .$xxx1['ffirma']. "</FechaFirma>\n"; 
									 if(empty($xxx1['ffirma'])==true){$salida_xml.="";}else{  $salida_xml .= "\t\t\t\t\t\t\t\t\t\t\t<FechaFirma>" .fdate($xxx1['ffirma']). "</FechaFirma>\n";}

								 $salida_xml .= "\t\t\t\t\t\t\t\t\t\t</Representante>\n"; 
								
									}
									
								 $salida_xml .= "\t\t\t\t\t\t\t\t\t</Representantes>\n"; 
							 }
								//$salida_xml .= "\t\t\t\t\t<FechaFirma>" .$xxx['ffirma']. "</FechaFirma>\n";
								if(empty($xxx['ffirma'])==true){$salida_xml.="";}else{  $salida_xml .= "\t\t\t\t\t\t\t\t\t<FechaFirma>" .fdate($xxx['ffirma']). "</FechaFirma>\n";}
							$salida_xml .= "\t\t\t\t\t\t\t\t</Sujeto>\n";
							

							}
							
						}
						$salida_xml .= "\t\t\t\t\t\t\t</Sujetos>\n"; 
						$salida_xml .= "\t\t\t\t\t\t</Intervencion>\n"; 
						
								$resultadoD12=mysqli_query($conn,$sq_intervencion) or die("sin resultado 14");



							 if(mysqli_num_rows($resultadoD12)>=1) { 

					
							$salida_xml .= "\t\t\t\t\t\t<Intervencion>\n"; 


								
								while($xxx12 = mysqli_fetch_array($resultadoD12)){

									if($xxx12['repre']!='R' and $xxx12['repre']=='B' ){
										
						

							 $salida_xml .= "\t\t\t\t\t\t\t<TipoIntervencion>" .$xxx12['parte'] . "</TipoIntervencion>\n";
						 $salida_xml .= "\t\t\t\t\t\t\t<DescripcionIntervencion>" .$xxx12['condicionnsisgen']. "</DescripcionIntervencion>\n";
						 $salida_xml .= "\t\t\t\t\t\t\t<RolRepresentante>" .$xxx12['repre']. "</RolRepresentante>\n";

						 /*
						while($xxx22 = mysql_fetch_array($resultadoD2)){

									
//
									if($xxx22['repre']!='R' and $xxx22['condicionn']=='COMPRADOR'){  
						*/
						 //if($xxx22['condi']=="" or $xxx22['condi']==0 ){$salida_xml.="";}else{  $salida_xml .= "\t\t\t\t\t<TipoIntervencion>" . $xxx22['parte'] . "</TipoIntervencion>\n";}  
							 //if($xxx22['condicionn']=="" ){$salida_xml.="";}else{   $salida_xml .= "\t\t\t\t\t<DescripcionIntervencion>" . $xxx22['condicionn'] . "</DescripcionIntervencion>\n";}             
						

									}
								}


						$resultadoD2=mysqli_query($conn,$sq_sujetos) or die("sin resultado 15");
						//--------

								$salida_xml .= "\t\t\t\t\t\t\t<Sujetos>\n";
							 while($xxx22 = mysqli_fetch_array($resultadoD2)){

									
//apo
									if($xxx22['repre']!='R' and $xxx22['repre']=='B'){ 
							
							$salida_xml .= "\t\t\t\t\t\t\t\t<Sujeto>\n";

							
								 $salida_xml .= "\t\t\t\t\t\t\t\t\t<IdMaestro>" .  $xxx22['idcl'] . "</IdMaestro>\n";
	//               $salida_xml .= "\t\t\t\t\t<TipoComparecencia>" . "" . "</TipoComparecencia>\n";
	 //              $salida_xml .= "\t\t\t\t\t<ClaseIntervencion>" . "" . "</ClaseIntervencion>\n";
		//             $salida_xml .= "\t\t\t\t\t<TipoAfectacion>" . "" . "</TipoAfectacion>\n";

								 //frankk
								 $idActo = $xxx22['idtipoacto'];
								 if($xxx22['idtipoacto'] == "1111"){
									 
								 }else{
								 
								$salida_xml .= "\t\t\t\t\t\t\t\t\t<OrigenFondos>\n";
								$salida_xml .= "\t\t\t\t\t\t\t\t\t\t<OrigenFondo>\n";								
										if($xxx22['fondos']==""){$salida_xml.="";}else{  $salida_xml .= "\t\t\t\t\t\t\t\t\t\t\t<Origen>" .  substr($xxx22['fondos'],0,40) . "</Origen>\n";}             
										if($xxx22['montoo']=="" ){$salida_xml.="";}else{  $salida_xml .= "\t\t\t\t\t\t\t\t\t\t\t<CuantiaOrigen>" . trim(number_format($xxx22['montoo'],2,".","")) . "</CuantiaOrigen>\n";}  
										if($xxx22['montoo']=="" ){
											$salida_xml.="";
										}else{
										  $sql =  "SELECT detmp FROM detallemediopago WHERE kardex = '$kar' AND   tipacto = '$idActo' LIMIT 1";  
										  	$result = mysqli_query($conn,$sql);
										  	if($rowMedioPago = mysqli_fetch_array($result))	
										  $salida_xml .= "\t\t\t\t\t\t\t\t\t\t\t<TipoMonedaPago>" . $tipoM2 . "</TipoMonedaPago>\n";
									}
									 
								$salida_xml .= "\t\t\t\t\t\t\t\t\t\t</OrigenFondo>\n";
								$salida_xml .= "\t\t\t\t\t\t\t\t\t</OrigenFondos>\n"; 
								 

                 $salida_xml .= "\t\t\t\t\t\t\t\t\t<Derecho>\n"; 
 //                  $salida_xml .= "\t\t\t\t\t<ClaseDerecho>" . "" . "</ClaseDerecho>\n";
	                if($xxx22['porcentaje']==""){$salida_xml.="";}else{ $salida_xml .= "\t\t\t\t\t\t\t\t\t\t<PorcentajeDerecho>" . trim(number_format($xxx22['porcentaje'],2,".","")) . "</PorcentajeDerecho>\n";}
		//               $salida_xml .= "\t\t\t\t\t<OrigenDerecho>" . "" . "</OrigenDerecho>\n";
			//             $salida_xml .= "\t\t\t\t\t<FechaAdquisicion>" . "" . "</FechaAdquisicion>\n";
				         $salida_xml .= "\t\t\t\t\t\t\t\t\t</Derecho>\n"; 
								}
					//       $salida_xml .= "\t\t\t\t\t<NumAcciones>" . "" . "</NumAcciones>\n";
						//     $salida_xml .= "\t\t\t\t\t<ValorPorcentaje>" . "" . "</ValorPorcentaje>\n";

							//   $salida_xml .= "\t\t\t\t<DetalleAcciones>\n"; 
								//   $salida_xml .= "\t\t\t\t\t<Serie>" . "" . "</Serie>\n";
									// $salida_xml .= "\t\t\t\t\t<Numeracion>" . "" . "</Numeracion>\n";
 //                  $salida_xml .= "\t\t\t\t\t<ValorNominalUnidad>" . "" . "</ValorNominalUnidad>\n";
	//                 $salida_xml .= "\t\t\t\t\t<TipoMoneda>" . "" . "</TipoMoneda>\n";
		//             $salida_xml .= "\t\t\t\t</DetalleAcciones>\n"; 
//
	//               $salida_xml .= "\t\t\t\t\t<PresenciaRepresentacion>" . "" . "</PresenciaRepresentacion>\n";
	
		             $query_renta="SELECT r.pregu1 ,r.pregu2,r.pregu3  FROM renta r
									where r.kardex='".$xxx22['kardex']."' AND r.`idcontratante`='".$xxx22['idcontratante']."'
									GROUP BY idcontratante";
						$sql_renta=mysqli_query($conn,$query_renta) or die("sin resultado 16"); 	
												
						while($row_renta = mysqli_fetch_array($sql_renta)){
							
							
							if($row_renta["pregu1"]!=""){			
								$salida_xml .= "\t\t\t\t\t\t\t\t\t<Renta3Cat>" . $row_renta["pregu1"] . "</Renta3Cat>\n";
							}
							if($row_renta["pregu2"]!="" ){								
								
								$salida_xml .= "\t\t\t\t\t\t\t\t\t<CasaEnajenante>" . $row_renta["pregu2"] . "</CasaEnajenante>\n";
							}
							if($row_renta["pregu3"]!=""){								
								
								$salida_xml .= "\t\t\t\t\t\t\t\t\t<ImpuestoCero>" . $row_renta["pregu3"] . "</ImpuestoCero>\n";
							}
							
							
						}
					
						
									if($xxx22['repre']=='B'){

									$reppp2=$xxx22['idcon'];

									$query91="SELECT idcon, idcl, tipp, apepat, apemat, nom, nombre, direccion, tipodoc, numdoc, email, telfijo, telcel, 
									telofi, gen, estc, natper, conyuge, nacionalidad, profesion, detaprofesion, cargo, profocupa, dirfer, 
									idubigeo, fechanaci, fechaing, razonsocial, domfiscal, telempresa, correoemp, contacempresa, fechaconstitu, 
									idsedereg, numregistro, numpartida, actmunicipal, tipocli, impeingre, impnumof, impeorigen, impentidad, 
									impremite, impmotivo, residente, docpaisemi, kardex, firma, STR_TO_DATE(ffirma,'%d/%m/%Y') AS ffirma, resfirma, tiporepresentacion, 
									idcontratanterp, facultades, indice, visita, inscrito, condi, condicionn,condicionnsisgen, id, idtipkar, idtipoacto, 
									idcontratante, item, idcondicion, parte, porcentaje, repre, formulario, montoo, opago, fondos, montop 
									FROM sisgen_intervenciones_6  WHERE repre ='R' AND kardex='$kar' AND idcontratanterp ='$reppp2' AND idtipoacto = '$codigoacto'";
									 $resultadoD3=mysqli_query($conn,$query91) or die("sin resultado 17");    
								
								$salida_xml .= "\t\t\t\t\t\t\t\t\t<Representantes>\n";
								
								 while($xxx223 = mysqli_fetch_array($resultadoD3)){

								
								 $salida_xml .= "\t\t\t\t\t\t\t\t\t\t<Representante>\n"; 

										$salida_xml .= "\t\t\t\t\t\t\t\t\t\t\t<IdMaestro>" . $xxx223['idcl'] . "</IdMaestro>\n";
 //                   $salida_xml .= "\t\t\t\t\t<ClaseRepresentacion>" . "" . "</ClaseRepresentacion>\n";
	//                  $salida_xml .= "\t\t\t\t\t<TipoRepresentacion>" . "" . "</TipoRepresentacion>\n";
	//                  $salida_xml .= "\t\t\t\t\t<EsDocumentoNotarial>" . "" . "</EsDocumentoNotarial>\n";

 //                   $salida_xml .= "\t\t\t\t<DocumentoRepresentacion>\n"; 
 //                      $salida_xml .= "\t\t\t\t\t<CodNotario>" . "" . "</CodNotario>\n";
 //                      $salida_xml .= "\t\t\t\t\t<NumDocumento>" . "" . "</NumDocumento>\n";
	//                     $salida_xml .= "\t\t\t\t\t<TipoInstrumento>" . "" . "</TipoInstrumento>\n";
	 //                    $salida_xml .= "\t\t\t\t\t<AnyoDocumento>" . "" . "</AnyoDocumento>\n";
	//                     $salida_xml .= "\t\t\t\t\t<ObservacionesMediata>" . "" . "</ObservacionesMediata>\n";
	 //                 $salida_xml .= "\t\t\t\t</DocumentoRepresentacion>\n"; 

	 //                 $salida_xml .= "\t\t\t\t\t<OtroDocumento>" . "". "</OtroDocumento>\n";
						
						if($xxx223['idsedereg']=="" and $xxx223['numpartida']==""){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t\t\t\t\t\t\t\t<InscripcionRepresentacion>\n"; }
	                     if($xxx223['idsedereg']=="" or $xxx223['idsedereg']=="0"){$salida_xml.="";}else{ $salida_xml .= "\t\t\t\t\t\t\t\t\t\t\t\t<SedeRegistral>" . $xxx223['idsedereg'] . "</SedeRegistral>\n";}
	                     if($xxx223['numpartida']==""){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t\t\t\t\t\t\t\t\t<PartidaRegistral>" .trim($xxx223['numpartida']). "</PartidaRegistral>\n";}
	                if($xxx223['idsedereg']=="" and $xxx223['numpartida']==""){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t\t\t\t\t\t\t\t</InscripcionRepresentacion>\n";}

	                   

										//$salida_xml .= "\t\t\t\t\t<FechaFirma>" . fdate($xxx223['fechafirma']) . "</FechaFirma>\n";
										if(empty($xxx223['ffirma'])==true){$salida_xml.="";}else{  $salida_xml .= "\t\t\t\t\t\t\t\t\t\t\t<FechaFirma>" .fdate($xxx223['ffirma']). "</FechaFirma>\n";}

								 $salida_xml .= "\t\t\t\t\t\t\t\t\t\t</Representante>\n";
								
									}
									$salida_xml .= "\t\t\t\t\t\t\t\t\t</Representantes>\n"; 
									
									}
									if(empty($xxx22['ffirma'])==true){$salida_xml.="";}else{  $salida_xml .= "\t\t\t\t\t\t\t\t\t<FechaFirma>" .fdate($xxx22['ffirma']). "</FechaFirma>\n";}
								 
							 $salida_xml .= "\t\t\t\t\t\t\t\t</Sujeto>\n";
							

							}
						}
						$salida_xml .= "\t\t\t\t\t\t\t</Sujetos>\n"; 
						
						$salida_xml .= "\t\t\t\t\t\t</Intervencion>\n"; 
					
					}


	//          $salida_xml .= "\t\t\t\t\t<DetalleObjeto>\n"; 

	 //           $salida_xml .= "\t\t\t\t\t<ValorTasacion>" . "" . "</ValorTasacion>\n";
	 //           $salida_xml .= "\t\t\t\t\t<TotalParticipantes>" . "" . "</TotalParticipantes>\n";
	 //           $salida_xml .= "\t\t\t\t\t<ImporteCapitalSocial>" . "" . "</ImporteCapitalSocial>\n";
	 //           $salida_xml .= "\t\t\t\t\t<TipoMonedaImporte>" ."" . "</TipoMonedaImporte>\n";
	 //           $salida_xml .= "\t\t\t\t\t<DisponenSerie>" . "" . "</DisponenSerie>\n";

	//            $salida_xml .= "\t\t\t\t<DetalleAcciones>\n"; 
	 //               $salida_xml .= "\t\t\t\t\t<Serie>" . "" . "</Serie>\n";
		//              $salida_xml .= "\t\t\t\t\t<Numeracion>" . "" . "</Numeracion>\n";
		 //             $salida_xml .= "\t\t\t\t\t<ValorNominalUnidad>" . "" . "</ValorNominalUnidad>\n";
			//            $salida_xml .= "\t\t\t\t\t<TipoMoneda>" . "" . "</TipoMoneda>\n";
			 //       $salida_xml .= "\t\t\t\t</DetalleAcciones>\n"; 

		//        $salida_xml .= "\t\t\t\t\t</DetalleObjeto>\n"; 
					$salida_xml .=	"\t\t\t\t\t</Intervenciones>\n";
					$salida_xml .= "\t\t\t</Operantes>\n"; 
					
					
					

					$resultado15 = mysqli_query($conn,$sq_cuantiadeoperacion) or die("sin resultado 18"); 
					
					
						while($x15 = mysqli_fetch_array($resultado15)){ 
						if($x15['tipacto']=="1111" or $x15['tipacto']=="038"  ){
						}else{
						$salida_xml .= "\t\t\t\t<CuantiaOperacion>\n"; 
						//$salida_xml .= "\t\t\t\t\t<CuantiaOperacion>" . "" . "</CuantiaOperacion>\n";

						if($x15['importetrans']==""){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t\t<Cuantia>" . $x15['importetrans'] . "</Cuantia>\n";} 
						if($x15['tipomon']=="" or $x15['tipomon']==0 ){$salida_xml.="";}else{ $salida_xml .= "\t\t\t\t\t<TipoMoneda>" . $x15['tipomon'] . "</TipoMoneda>\n";}
						//$salida_xml .= "\t\t\t\t\t<TipoMoneda>" . "" . "</TipoMoneda>\n";
						
						$salida_xml .= "\t\t\t\t</CuantiaOperacion>\n"; 
						}
					 }  
	
					$sq_mediosdepago="SELECT dm.detmp,  dm.itemmp,  dm.kardex,  dm.tipacto,  dm.codmepag,
					dm.fpago AS fechaope ,  CONCAT ('000',bc.codbancos) AS idbancos,  dm.importemp AS importetrans,  dm.idmon,  dm.foperacion,  dm.documentos AS idpago,
					mp.codmepag ,  mp.uif,  mp.cod_sisgen AS idmediop,  mp.desmpagos,
					mo.codmon AS tipomon,op.idoppago AS oport, pa.exhibiomp AS exxx, pa.nminuta AS fechaminuta,fp.codigo AS codigofp, SUBSTRING(pa.des_idoppago,1,40) AS des_idppago
					FROM sisgen_temp					
					INNER JOIN detallemediopago dm ON dm.kardex = sisgen_temp.kardex					
					LEFT JOIN mediospago mp	ON dm.codmepag=mp.codmepag
					LEFT JOIN monedas mo ON dm.idmon=mo.idmon
					LEFT JOIN patrimonial pa ON dm.kardex=pa.kardex 
					LEFT JOIN oporpago op	ON pa.idoppago=op.codoppago
					LEFT JOIN bancos bc ON dm.idbancos= bc.idbancos
					LEFT JOIN fpago_uif fp ON fp.id_fpago=pa.fpago
					WHERE pa.kardex='$kar' AND pa.idtipoacto = '$codigoacto' AND dm.tipacto = '$codigoacto' GROUP BY detmp
					";
	
					
					 $resultado5=mysqli_query($conn,$sq_mediosdepago) or die("sin resultado 19"); 

						$salida_xml .= "\t\t\t\t<MediosPagos>\n";
						//mediopago
						 while($x5 = mysqli_fetch_array($resultado5)){ 
						 

					if($x5['tipacto']=="1111" or $x5['tipacto']=="016" or $x5['tipacto']=="038"){
						
						//vacio por medio de pago de donacion
						
					}else{
					
					
					$salida_xml .= "\t\t\t\t<MediosPago>\n"; 

						if($x5['idmediop']=="" or $x5['idmediop']==0 ){$salida_xml.="";}else{  $salida_xml .= "\t\t\t\t\t<MedioPago>" . $x5['idmediop'] . "</MedioPago>\n";}
						if($x5['codigofp']=="" or $x5['codigofp']==0 ){$salida_xml.="";}else{ $salida_xml .= "\t\t\t\t\t<FormaPago>" . $x5['codigofp']. "</FormaPago>\n";}						
						if($x5['oport']=="" or $x5['oport']==0 or $x5['oport']==10){$salida_xml.="";}else{ $salida_xml .= "\t\t\t\t\t<MomentoPago>" . $x5['oport']. "</MomentoPago>\n";}
						if($x5['oport']!="8"  ){$salida_xml.="";}else{ 
						if($x5['des_idppago']==''){
								$salida_xml .= "\t\t\t\t\t<DescripcionMomentoPago>NO PRECISA</DescripcionMomentoPago>\n";
							}else{
								$salida_xml .= "\t\t\t\t\t<DescripcionMomentoPago>" . $x5['des_idppago']. "</DescripcionMomentoPago>\n";
							}
						}
						if($x5['importetrans']==""){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t\t<CuantiaPago>" . $x5['importetrans'] . "</CuantiaPago>\n";}           
						if($x5['tipomon']=="" or $x5['tipomon']==0 ){$salida_xml.="";}else{ $salida_xml .= "\t\t\t\t\t<TipoMonedaPago>" . $x5['tipomon'] . "</TipoMonedaPago>\n";}
						//if($x5['tipomon']=="" or $x5['tipomon']==0 ){$salida_xml.="";}else{ $salida_xml .= "\t\t\t\t\t<TipoMonedaPago>" . $x5['tipomon'] . "</TipoMonedaPago>\n";}
			 //      $salida_xml .= "\t\t\t\t\t<TipoCambio>" . "" . "</TipoCambio>\n";
						//if($x5['exxx']=='SI'){$exxx2=1;}else{$exxx2=0;}
						if($x5['idmediop']=="095" or $x5['idmediop']=="096" or $x5['idmediop']=="097" or $x5['idmediop']=="098"){$exxx2=0;}else{$exxx2=1;}
						if($x5['exxx']=="" ){$salida_xml.="";}else{ $salida_xml .= "\t\t\t\t\t<JustificadoManifestado>" .$exxx2. "</JustificadoManifestado>\n";}
						//$salida_xml .= "\t\t\t\t\t<JustificadoManifestado>" . "" . "</JustificadoManifestado>\n";
			 //     date('Y-m-d', strtotime($x5['foperacion']))
						if($x5['foperacion']=="" or $x5['foperacion']==0 ){$salida_xml.="";}else{ $salida_xml .= "\t\t\t\t\t<FechaPago>" . fdate($x5['foperacion']) . "</FechaPago>\n";}
						if($x5['idpago']=="" or $x5['idpago']==0 ){$salida_xml.="";}else{   $salida_xml .= "\t\t\t\t\t<IdPago>" .  $x5['idpago'] . "</IdPago>\n";}
					 

			     if($x5['idbancos']=="" or $x5['idbancos']==0 ){$salida_xml.="";}else{  $salida_xml .= "\t\t\t\t\t<EntidadFinanciera>" . $x5['idbancos']. "</EntidadFinanciera>\n";}
					 

					$salida_xml .= "\t\t\t\t</MediosPago>\n";
					
							}
							
						}
						$salida_xml .= "\t\t\t\t</MediosPagos>\n";

		//      $salida_xml .= "\t\t\t\t<Plazos>\n"; 
		 //       $salida_xml .= "\t\t\t\t\t<PlazoInicial>" . "" . "</PlazoInicial>\n";
			//      $salida_xml .= "\t\t\t\t\t<PlazoFinal>" . "" . "</PlazoFinal>\n";
			 //   $salida_xml .= "\t\t\t\t</Plazos>\n"; 

			    if($kardcant['desacto']==""){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t\t<NombreContrato>" . substr($kardcant['desacto'],0,30) . "</NombreContrato>\n";}
			 $resultado6=mysqli_query($conn,$querymediopago) or die("sin resultado 20"); 
			 while($x6 = mysqli_fetch_array($resultado6)){ 
			 if($x6['fechaminuta']==""){$salida_xml.="";}else{  $salida_xml .= "\t\t\t\t\t<FechaMinuta>" .  fdate($x6['fechaminuta']). "</FechaMinuta>\n";}}
			 //   $salida_xml .= "\t\t<DocumentoRectificacion>" . "" . "</DocumentoRectificacion>\n";
			 //   $salida_xml .= "\t\t<TipoDocAnterior>" . "" . "</TipoDocAnterior>\n";

			 //   $salida_xml .= "\t\t\t\t<RectificacionDocumento>\n"; 
			 //     $salida_xml .= "\t\t\t\t\t<CodNotario>" . "". "</CodNotario>\n";
			 //     $salida_xml .= "\t\t\t\t\t<NumDocumento>" . "" . "</NumDocumento>\n";
			 //     $salida_xml .= "\t\t\t\t\t<TipoInstrumento>" . "" . "</TipoInstrumento>\n";
			 //     $salida_xml .= "\t\t\t\t\t<AnyoDocumento>" . "" . "</AnyoDocumento>\n";
			 //  $salida_xml .= "\t\t\t\t</RectificacionDocumento>\n"; 

					//$salida_xml .= "\t\t<DescDocNoNotarial>" . "" . "</DescDocNoNotarial>\n";
				
				
				 $salida_xml .= "\t\t</Operacion>\n"; 
				 
				 }
			 }
				 
			}
						 
		 }
				 
				 else
					 
				 //SI ES SOLO 1 ACTO
					 {
						 
						 
				/*if($xk==3){

				$resultadotipppp=mysql_query($query4, $conn) or die("sin resultado");     
					while($xtip = mysql_fetch_array($resultadotipppp)){

											 $iddd=$xtip['idvehiculo'];
										
									} 
		
				}

				else  if ($xk==1){

						$resultadotipppp2=mysql_query($query8, $conn) or die("sin resultado");    
					while($xtip2 = mysql_fetch_array($resultadotipppp2)){

											$iddd=$xtip2['idbien'];
																						
										}
										

				}*/

								 while($xxx3 = mysqli_fetch_array($resultadoDf)){

										$iddddd=$xxx3['idmediop'];
										
								 }
									
									    
																			
					
				// $salida_xml .= "\t\t\t<Operacion id='".$iddddd ."'>\n"; 
				   if($iddddd==""){$salida_xml.="\t\t\t<Operacion id='001'>\n";}else{$salida_xml.="\t\t\t<Operacion id='".$iddddd ."'>\n";}



					if($x['codactos']=="" or $x['codactos']==0 ){$salida_xml.="";}else{   $salida_xml .= "\t\t\t\t<CodActoJuridico>" . $x['ancert']. "</CodActoJuridico>\n";}  
				 
					$salida_xml .= "\t\t\t<Operantes>\n"; 
						$salida_xml .="\t\t\t\t<Objetos>\n";
						
						
						if(mysqli_num_rows($resultadotPREDIO) != 0 ) {								
							 while($xxv= mysqli_fetch_array($resultadotPREDIO)){ 
							$salida_xml .="\t\t\t\t\t<Objeto>\n";
						 if($xxv['idbien']=="" or $xxv['idbien']==0 ){$salida_xml.="";}else{   $salida_xml .= "\t\t\t\t\t\t<IdMaestro>" . $xxv['idbien']. "</IdMaestro>\n";}
							if($xxv['fechaconst']=="" or $xxv['fechaconst']==0 ){$salida_xml.="";}else{ $salida_xml.="\t\t\t\t\t\t<DetalleObjeto>\n" ;}
							if($xxv['fechaconst']=="" or $xxv['fechaconst']==0 ){$salida_xml.="";}else{  $salida_xml .= "\t\t\t\t\t\t\t<FechaAdquisicion>" .fdate($xxv['fechaconst']). "</FechaAdquisicion>\n";}
							if($xxv['fechaconst']=="" or $xxv['fechaconst']==0 ){$salida_xml.="";}else{ $salida_xml.="\t\t\t\t\t\t</DetalleObjeto>\n"; }
						 
							$salida_xml .="\t\t\t\t\t</Objeto>\n";
							}							
						 }
						if(mysqli_num_rows($resultadotipppp22) != 0 ) {								
							 while($xxv2= mysqli_fetch_array($resultadotipppp22)){ 
							$salida_xml .="\t\t\t\t\t<Objeto>\n";
						 if($xxv2['idbien']=="" or $xxv2['idbien']==0 ){$salida_xml.="";}else{   $salida_xml .= "\t\t\t\t\t\t<IdMaestro>" . $xxv2['idbien']. "</IdMaestro>\n";}
							$salida_xml .="\t\t\t\t\t</Objeto>\n";
							}							
						 }
						if(mysqli_num_rows($resultadotiotros) != 0 ) {								
							 while($xxv23= mysqli_fetch_array($resultadotiotros)){ 
							$salida_xml .="\t\t\t\t\t<Objeto>\n";
						 if($xxv23['idbien']=="" or $xxv23['idbien']==0 ){$salida_xml.="";}else{   $salida_xml .= "\t\t\t\t\t\t<IdMaestro>" . $xxv23['idbien']. "</IdMaestro>\n";}
							$salida_xml .="\t\t\t\t\t</Objeto>\n";
							}							
						 }						 
						if(mysqli_num_rows($resultadoVEHICULO) != 0 ) {								
							 while($iddd= mysqli_fetch_array($resultadoVEHICULO)){ 
							$salida_xml .="\t\t\t\t\t<Objeto>\n";
						 if($iddd['idvehiculo']=="" or $iddd['idvehiculo']==0 ){$salida_xml.="";}else{   $salida_xml .= "\t\t\t\t\t\t<IdMaestro>" . $iddd['idvehiculo']. "</IdMaestro>\n";}
							$salida_xml .="\t\t\t\t\t</Objeto>\n";
							}							
						 }
							
						$salida_xml .="\t\t\t\t</Objetos>\n";
						//$salida_xml .= "\t\t\t\t\t<IdMaestro>". $iddd . "</IdMaestro>\n";       
					 
							

							 $resultadoD=mysqli_query($conn,$query6) or die("sin resultado 21");    
								
						$salida_xml .=	"\t\t\t\t\t<Intervenciones>\n";
						
						


						
							$resultadoD11=mysqli_query($conn,$query11) or die("sin resultado 22");
							
							
							
								while($xxx11 = mysqli_fetch_array($resultadoD11)){
								
								
									if($xxx11['repre']!='R' and $xxx11['repre']=='O' ){
									$salida_xml .= "\t\t\t\t\t\t<Intervencion>\n"; 
							$salida_xml .= "\t\t\t\t\t\t\t<TipoIntervencion>" .$xxx11['parte']  . "</TipoIntervencion>\n";
							$salida_xml .= "\t\t\t\t\t\t\t<DescripcionIntervencion>" .$xxx11['condicionnsisgen']. "</DescripcionIntervencion>\n";
							$salida_xml .= "\t\t\t\t\t\t\t<RolRepresentante>" .$xxx11['repre']. "</RolRepresentante>\n";
						
							 /* while($xxx = mysql_fetch_array($resultadoD)){

									if($xxx['repre']!='R' and $xxx['condicionn']=='VENDEDOR' ){  
								 
								*/

									
								
							 $salida_xml .= "\t\t\t\t\t\t<Sujetos>\n";
							 while($xxx = mysqli_fetch_array($resultadoD)){
								 
								 

																		if($xxx['repre']!='R' and $xxx['repre']=='O' ){


																
																$salida_xml .= "\t\t\t\t\t\t\t<Sujeto>\n";


																	 $salida_xml .= "\t\t\t\t\t\t\t\t<IdMaestro>" .  $xxx['idcl'] . "</IdMaestro>\n";
										//               $salida_xml .= "\t\t\t\t\t<TipoComparecencia>" . "" . "</TipoComparecencia>\n";
										 //              $salida_xml .= "\t\t\t\t\t<ClaseIntervencion>" . "" . "</ClaseIntervencion>\n";
											//             $salida_xml .= "\t\t\t\t\t<TipoAfectacion>" . "" . "</TipoAfectacion>\n";

																	 //frankk
																	 $idActo = $xxx['idtipoacto'];
																	 if($xxx['idtipoacto']=="1111" or $xxx['idtipoacto']=="067"  ){
																		 
																	 }else{
																		 
																	if($xxx['fondos']!="" or $xxx['montoo']!=""){
																		 
																		 $salida_xml .= "\t\t\t\t\t\t\t\t<OrigenFondos>\n"; 
																			$salida_xml .= "\t\t\t\t\t\t\t\t\t<OrigenFondo>\n";
																				if($xxx['fondos']==""){$salida_xml.="";}else{  $salida_xml .= "\t\t\t\t\t\t\t\t\t\t<Origen>" . substr($xxx['fondos'],0,40) . "</Origen>\n";}            
																		if($xxx['montoo']==""){$salida_xml.="";}else{  $salida_xml .= "\t\t\t\t\t\t\t\t\t\t<CuantiaOrigen>" . trim(number_format($xxx['montoo'],2,".","")) . "</CuantiaOrigen>\n";}
																		if($xxx['montoo']=="" or $tipoM=="00"){$salida_xml.="";
																		}else{ 
																			$sql =  "SELECT detmp FROM detallemediopago WHERE kardex = '$kar' AND   tipacto = '$idActo' LIMIT 1";  
																		  	$result = mysqli_query($conn,$sql);
																		  	if($rowMedioPago = mysqli_fetch_array($result))	
																			$salida_xml .= "\t\t\t\t\t\t\t\t\t\t<TipoMonedaPago>" . $tipoM . "</TipoMonedaPago>\n";
																		}
																			$salida_xml .= "\t\t\t\t\t\t\t\t\t</OrigenFondo>\n";
																		 $salida_xml .= "\t\t\t\t\t\t\t\t</OrigenFondos>\n"; 
																	 } 
																	 

																		
															 $salida_xml .= "\t\t\t\t\t\t\t\t<Derecho>\n"; 
											//                 $salida_xml .= "\t\t\t\t\t<ClaseDerecho>" . "" . "</ClaseDerecho>\n";
														   if($xxx['porcentaje']==""){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t\t\t\t\t\t<PorcentajeDerecho>" . trim(number_format($xxx['porcentaje'],2,".","")). "</PorcentajeDerecho>\n";} 
												//             $salida_xml .= "\t\t\t\t\t<OrigenDerecho>" . "" . "</OrigenDerecho>\n";
												//             $salida_xml .= "\t\t\t\t\t<FechaAdquisicion>" . "" . "</FechaAdquisicion>\n";
															 $salida_xml .= "\t\t\t\t\t\t\t\t</Derecho>\n"; 
																}
														//       $
														//       $salida_xml .= "\t\t\t\t\t<NumAcciones>" . "" . "</NumAcciones>\n";
															//     $salida_xml .= "\t\t\t\t\t<ValorPorcentaje>" . "" . "</ValorPorcentaje>\n";

																//   $salida_xml .= "\t\t\t\t<DetalleAcciones>\n"; 
																	//   $salida_xml .= "\t\t\t\t\t<Serie>" . "" . "</Serie>\n";
																		// $salida_xml .= "\t\t\t\t\t<Numeracion>" . "" . "</Numeracion>\n";
									 //                  $salida_xml .= "\t\t\t\t\t<ValorNominalUnidad>" . "" . "</ValorNominalUnidad>\n";
										//                 $salida_xml .= "\t\t\t\t\t<TipoMoneda>" . "" . "</TipoMoneda>\n";
											//             $salida_xml .= "\t\t\t\t</DetalleAcciones>\n"; 
									//
										//               $salida_xml .= "\t\t\t\t\t<PresenciaRepresentacion>" . "" . "</PresenciaRepresentacion>\n";
												  $query_renta1 = "SELECT r.pregu1 ,r.pregu2,r.pregu3  FROM renta r
																		where r.kardex='".$xxx['kardex']."' AND r.`idcontratante`='".$xxx['idcontratante']."'
																		GROUP BY idcontratante";
															$sql_renta1=mysqli_query($conn,$query_renta1) or die("sin resultado 23"); 	
																					
															while($row_renta1 = mysqli_fetch_array($sql_renta1)){
																
																
																if($row_renta1["pregu1"]!=""){			
																	$salida_xml .= "\t\t\t\t\t\t\t\t<Renta3Cat>" . $row_renta1["pregu1"] . "</Renta3Cat>\n";
																}
																if($row_renta1["pregu2"]!="" ){								
																	
																	$salida_xml .= "\t\t\t\t\t\t\t\t<CasaEnajenante>" . $row_renta1["pregu2"] . "</CasaEnajenante>\n";
																}
																if($row_renta1["pregu3"]!=""){								
																	
																	$salida_xml .= "\t\t\t\t\t\t\t\t<ImpuestoCero>" . $row_renta1["pregu3"] . "</ImpuestoCero>\n";
																}
																
																
															}
															 
										if($xxx['repre'] == 'O'){

																		$reppp=$xxx['idcon'];

																		$query91="SELECT idcon, idcl, tipp, apepat, apemat, nom, nombre, direccion, tipodoc, numdoc, email, telfijo, telcel, 
telofi, gen, estc, natper, conyuge, nacionalidad, profesion, detaprofesion, cargo, profocupa, dirfer, 
idubigeo, fechanaci, fechaing, razonsocial, domfiscal, telempresa, correoemp, contacempresa, fechaconstitu, 
idsedereg, numregistro, numpartida, actmunicipal, tipocli, impeingre, impnumof, impeorigen, impentidad, 
impremite, impmotivo, residente, docpaisemi, kardex, firma, STR_TO_DATE(ffirma,'%d/%m/%Y') AS ffirma, resfirma, tiporepresentacion, 
idcontratanterp, facultades, indice, visita, inscrito, condi, condicionn,condicionnsisgen, id, idtipkar, idtipoacto, 
idcontratante, item, idcondicion, parte, porcentaje, repre, formulario, montoo, opago, fondos, montop 
FROM sisgen_intervenciones_6  WHERE repre ='R' AND kardex='$kar' AND idcontratanterp ='$reppp'";
									 $resultadoD3=mysqli_query($conn,$query91) or die("sin resultado 24"); 
									 
																		$salida_xml .= "\t\t\t\t\t\t\t\t<Representantes>\n"; 
																	 while($xxx1 = mysqli_fetch_array($resultadoD3)){

																	
																	 $salida_xml .= "\t\t\t\t\t\t\t\t\t<Representante>\n"; 

																			$salida_xml .= "\t\t\t\t\t\t\t\t\t\t<IdMaestro>" . $xxx1['idcl'] . "</IdMaestro>\n";
									 //                   $salida_xml .= "\t\t\t\t\t<ClaseRepresentacion>" . "" . "</ClaseRepresentacion>\n";
										//                  $salida_xml .= "\t\t\t\t\t<TipoRepresentacion>" . "" . "</TipoRepresentacion>\n";
										//                  $salida_xml .= "\t\t\t\t\t<EsDocumentoNotarial>" . "" . "</EsDocumentoNotarial>\n";

									 //                   $salida_xml .= "\t\t\t\t<DocumentoRepresentacion>\n"; 
									 //                      $salida_xml .= "\t\t\t\t\t<CodNotario>" . "" . "</CodNotario>\n";
									 //                      $salida_xml .= "\t\t\t\t\t<NumDocumento>" . "" . "</NumDocumento>\n";
										//                     $salida_xml .= "\t\t\t\t\t<TipoInstrumento>" . "" . "</TipoInstrumento>\n";
										 //                    $salida_xml .= "\t\t\t\t\t<AnyoDocumento>" . "" . "</AnyoDocumento>\n";
										//                     $salida_xml .= "\t\t\t\t\t<ObservacionesMediata>" . "" . "</ObservacionesMediata>\n";
										 //                 $salida_xml .= "\t\t\t\t</DocumentoRepresentacion>\n"; 

										 //                 $salida_xml .= "\t\t\t\t\t<OtroDocumento>" . "". "</OtroDocumento>\n";

														if($xxx1['idsedereg']=="" and $xxx1['numpartida']==""){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t\t\t\t\t\t\t<InscripcionRepresentacion>\n"; }
															 if($xxx1['idsedereg']=="" or $xxx1['idsedereg']=="0" ){$salida_xml.="";}else{ $salida_xml .= "\t\t\t\t\t\t\t\t\t\t\t<SedeRegistral>" . $xxx1['idsedereg'] . "</SedeRegistral>\n";}
															 if($xxx1['numpartida']==""){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t\t\t\t\t\t\t\t<PartidaRegistral>" . trim($xxx1['numpartida']). "</PartidaRegistral>\n";}
														if($xxx1['idsedereg']=="" and $xxx1['numpartida']==""){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t\t\t\t\t\t\t</InscripcionRepresentacion>\n";}
																			//$d = strtotime($xxx['ffirma']);
														if(($xxx1['facultades'])==""){$salida_xml.="";}else{  $salida_xml .= "\t\t\t\t\t\t\t\t\t\t<Facultades>" .substr(trim($xxx1['facultades']),0,50). "</Facultades>\n";}					

																		 //$salida_xml .= "\t\t\t\t\t<FechaFirma>" .$xxx1['ffirma']. "</FechaFirma>\n"; 
																		 if(empty($xxx1['ffirma'])==true){$salida_xml.="";}else{  $salida_xml .= "\t\t\t\t\t\t\t\t\t\t<FechaFirma>" .fdate($xxx1['ffirma']). "</FechaFirma>\n";}

																	 $salida_xml .= "\t\t\t\t\t\t\t\t\t</Representante>\n"; 
																	
																		}
																		
																	 $salida_xml .= "\t\t\t\t\t\t\t\t</Representantes>\n"; 
																 }
																	//$salida_xml .= "\t\t\t\t\t<FechaFirma>" .$xxx['ffirma']. "</FechaFirma>\n";
																	if(empty($xxx['ffirma'])==true){$salida_xml.="";}else{  $salida_xml .= "\t\t\t\t\t\t\t\t<FechaFirma>" .fdate($xxx['ffirma']). "</FechaFirma>\n";}
																$salida_xml .= "\t\t\t\t\t\t\t</Sujeto>\n";
																

																		}
							
								}
							$salida_xml .= "\t\t\t\t\t\t</Sujetos>\n"; 
							$salida_xml .= "\t\t\t\t\t\t</Intervencion>\n"; 
							}
						}
								$resultadoD12=mysqli_query($conn,$query11) or die("sin resultado 25");



							 if(mysqli_num_rows($resultadoD12)>=1) { 

					
							


								
								while($xxx12 = mysqli_fetch_array($resultadoD12)){

									if($xxx12['repre']!='R' and $xxx12['repre']=='B' ){
										$salida_xml .= "\t\t\t\t\t\t<Intervencion>\n"; 
						

							 $salida_xml .= "\t\t\t\t\t\t\t<TipoIntervencion>" .$xxx12['parte'] . "</TipoIntervencion>\n";
						 $salida_xml .= "\t\t\t\t\t\t\t<DescripcionIntervencion>" .$xxx12['condicionnsisgen']. "</DescripcionIntervencion>\n";
						$salida_xml .= "\t\t\t\t\t\t\t<RolRepresentante>" .$xxx12['repre']. "</RolRepresentante>\n";
						 /*
						while($xxx22 = mysql_fetch_array($resultadoD2)){

									
//
									if($xxx22['repre']!='R' and $xxx22['condicionn']=='COMPRADOR'){  
						*/
						 //if($xxx22['condi']=="" or $xxx22['condi']==0 ){$salida_xml.="";}else{  $salida_xml .= "\t\t\t\t\t<TipoIntervencion>" . $xxx22['parte'] . "</TipoIntervencion>\n";}  
							 //if($xxx22['condicionn']=="" ){$salida_xml.="";}else{   $salida_xml .= "\t\t\t\t\t<DescripcionIntervencion>" . $xxx22['condicionn'] . "</DescripcionIntervencion>\n";}             
						

									


						$resultadoD2=mysqli_query($conn,$query6) or die("sin resultado 26");
						//--------

								$salida_xml .= "\t\t\t\t\t\t<Sujetos>\n";
							 while($xxx22 = mysqli_fetch_array($resultadoD2)){

									
//apo
									if($xxx22['repre']!='R' and $xxx22['repre']=='B'){ 
							
							$salida_xml .= "\t\t\t\t\t\t\t<Sujeto>\n";

							
								 $salida_xml .= "\t\t\t\t\t\t\t\t<IdMaestro>" .  $xxx22['idcl'] . "</IdMaestro>\n";
	//               $salida_xml .= "\t\t\t\t\t<TipoComparecencia>" . "" . "</TipoComparecencia>\n";
	 //              $salida_xml .= "\t\t\t\t\t<ClaseIntervencion>" . "" . "</ClaseIntervencion>\n";
		//             $salida_xml .= "\t\t\t\t\t<TipoAfectacion>" . "" . "</TipoAfectacion>\n";

								 //frankk
								 $idActo = $xxx22['idtipoacto'];
								 if($xxx22['idtipoacto']=="1111" or $xxx22['idtipoacto']=="067" ){
									 
								 }else{
								
								if($xxx22['fondos']!="" or $xxx22['montoo']!=""){ 
								$salida_xml .= "\t\t\t\t\t\t\t\t<OrigenFondos>\n";
								$salida_xml .= "\t\t\t\t\t\t\t\t\t<OrigenFondo>\n";								
										if($xxx22['fondos']==""){$salida_xml.="";}else{  $salida_xml .= "\t\t\t\t\t\t\t\t\t\t<Origen>" . substr($xxx22['fondos'],0,40) . "</Origen>\n";}             
										if($xxx22['montoo']=="" ){$salida_xml.="";}else{  $salida_xml .= "\t\t\t\t\t\t\t\t\t\t<CuantiaOrigen>" .trim(number_format($xxx22['montoo'],2,".","")) . "</CuantiaOrigen>\n";}
										if($xxx22['montoo']=="" or $tipoM=="00" ){
											$salida_xml.="";
										}else{  
											$sql =  "SELECT detmp FROM detallemediopago WHERE kardex = '$kar' AND   tipacto = '$idActo' LIMIT 1";  
										  	$result = mysqli_query($conn,$sql);
										  	if($rowMedioPago = mysqli_fetch_array($result))	
											$salida_xml .= "\t\t\t\t\t\t\t\t\t\t<TipoMonedaPago>" . $tipoM . "</TipoMonedaPago>\n";
										}
									//$salida_xml .= "\t\t\t\t\t<TipoMonedaPago>" . $tm . "</TipoMonedaPago>\n";
								$salida_xml .= "\t\t\t\t\t\t\t\t\t</OrigenFondo>\n";
								$salida_xml .= "\t\t\t\t\t\t\t\t</OrigenFondos>\n"; 
								}

                 $salida_xml .= "\t\t\t\t\t\t\t\t<Derecho>\n"; 
 //                  $salida_xml .= "\t\t\t\t\t<ClaseDerecho>" . "" . "</ClaseDerecho>\n";
	                if($xxx22['porcentaje']==""){$salida_xml.="";}else{ $salida_xml .= "\t\t\t\t\t\t\t\t\t<PorcentajeDerecho>" . trim(number_format($xxx22['porcentaje'],2,".","")) . "</PorcentajeDerecho>\n";}
		//               $salida_xml .= "\t\t\t\t\t<OrigenDerecho>" . "" . "</OrigenDerecho>\n";
			//             $salida_xml .= "\t\t\t\t\t<FechaAdquisicion>" . "" . "</FechaAdquisicion>\n";
				         $salida_xml .= "\t\t\t\t\t\t\t\t</Derecho>\n"; 
								}
					//       $salida_xml .= "\t\t\t\t\t<NumAcciones>" . "" . "</NumAcciones>\n";
						//     $salida_xml .= "\t\t\t\t\t<ValorPorcentaje>" . "" . "</ValorPorcentaje>\n";

							//   $salida_xml .= "\t\t\t\t<DetalleAcciones>\n"; 
								//   $salida_xml .= "\t\t\t\t\t<Serie>" . "" . "</Serie>\n";
									// $salida_xml .= "\t\t\t\t\t<Numeracion>" . "" . "</Numeracion>\n";
 //                  $salida_xml .= "\t\t\t\t\t<ValorNominalUnidad>" . "" . "</ValorNominalUnidad>\n";
	//                 $salida_xml .= "\t\t\t\t\t<TipoMoneda>" . "" . "</TipoMoneda>\n";
		//             $salida_xml .= "\t\t\t\t</DetalleAcciones>\n"; 
//
	//               $salida_xml .= "\t\t\t\t\t<PresenciaRepresentacion>" . "" . "</PresenciaRepresentacion>\n";
	
		             $query_renta="SELECT r.pregu1 ,r.pregu2,r.pregu3  FROM renta r
									where r.kardex='".$xxx22['kardex']."' AND r.`idcontratante`='".$xxx22['idcontratante']."'
									GROUP BY idcontratante";
						$sql_renta=mysqli_query($conn,$query_renta) or die("sin resultado 27"); 	
												
						while($row_renta = mysqli_fetch_array($sql_renta)){
							
							
							if($row_renta["pregu1"]!=""){			
								$salida_xml .= "\t\t\t\t\t\t\t\t<Renta3Cat>" . $row_renta["pregu1"] . "</Renta3Cat>\n";
							}
							if($row_renta["pregu2"]!="" ){								
								
								$salida_xml .= "\t\t\t\t\t\t\t\t<CasaEnajenante>" . $row_renta["pregu2"] . "</CasaEnajenante>\n";
							}
							if($row_renta["pregu3"]!=""){								
								
								$salida_xml .= "\t\t\t\t\t\t\t\t<ImpuestoCero>" . $row_renta["pregu3"] . "</ImpuestoCero>\n";
							}
							
							
						}
					
						
									if($xxx22['repre']=='B'){

									$reppp2=$xxx22['idcon'];

									$query91="								
									SELECT idcon, idcl, tipp, apepat, apemat, nom, nombre, direccion, tipodoc, numdoc, email, telfijo, telcel, 
telofi, gen, estc, natper, conyuge, nacionalidad, profesion, detaprofesion, cargo, profocupa, dirfer, 
idubigeo, fechanaci, fechaing, razonsocial, domfiscal, telempresa, correoemp, contacempresa, fechaconstitu, 
idsedereg, numregistro, numpartida, actmunicipal, tipocli, impeingre, impnumof, impeorigen, impentidad, 
impremite, impmotivo, residente, docpaisemi, kardex, firma, STR_TO_DATE(ffirma,'%d/%m/%Y') AS ffirma, resfirma, tiporepresentacion, 
idcontratanterp, facultades, indice, visita, inscrito, condi, condicionn,condicionnsisgen, id, idtipkar, idtipoacto, 
idcontratante, item, idcondicion, parte, porcentaje, repre, formulario, montoo, opago, fondos, montop 
FROM sisgen_intervenciones_6  WHERE repre ='R' AND kardex='$kar' AND idcontratanterp ='$reppp2' 
									";
								 $resultadoD3=mysqli_query($conn,$query91) or die("sin resultado 28");    
								
								$salida_xml .= "\t\t\t\t\t\t\t\t<Representantes>\n";
								
								 while($xxx223 = mysqli_fetch_array($resultadoD3)){

								
								 $salida_xml .= "\t\t\t\t\t\t\t\t\t<Representante>\n"; 

										$salida_xml .= "\t\t\t\t\t\t\t\t\t\t<IdMaestro>" . $xxx223['idcl'] . "</IdMaestro>\n";
 //                   $salida_xml .= "\t\t\t\t\t<ClaseRepresentacion>" . "" . "</ClaseRepresentacion>\n";
	//                  $salida_xml .= "\t\t\t\t\t<TipoRepresentacion>" . "" . "</TipoRepresentacion>\n";
	//                  $salida_xml .= "\t\t\t\t\t<EsDocumentoNotarial>" . "" . "</EsDocumentoNotarial>\n";

 //                   $salida_xml .= "\t\t\t\t<DocumentoRepresentacion>\n"; 
 //                      $salida_xml .= "\t\t\t\t\t<CodNotario>" . "" . "</CodNotario>\n";
 //                      $salida_xml .= "\t\t\t\t\t<NumDocumento>" . "" . "</NumDocumento>\n";
	//                     $salida_xml .= "\t\t\t\t\t<TipoInstrumento>" . "" . "</TipoInstrumento>\n";
	 //                    $salida_xml .= "\t\t\t\t\t<AnyoDocumento>" . "" . "</AnyoDocumento>\n";
	//                     $salida_xml .= "\t\t\t\t\t<ObservacionesMediata>" . "" . "</ObservacionesMediata>\n";
	 //                 $salida_xml .= "\t\t\t\t</DocumentoRepresentacion>\n"; 

	 //                 $salida_xml .= "\t\t\t\t\t<OtroDocumento>" . "". "</OtroDocumento>\n";
						
						if($xxx223['idsedereg']=="" and $xxx223['numpartida']==""){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t\t\t\t\t\t\t<InscripcionRepresentacion>\n"; }
	                     if($xxx223['idsedereg']=="" or $xxx223['idsedereg']=="0"){$salida_xml.="";}else{ $salida_xml .= "\t\t\t\t\t\t\t\t\t\t\t<SedeRegistral>" . $xxx223['idsedereg'] . "</SedeRegistral>\n";}
	                     if($xxx223['numpartida']==""){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t\t\t\t\t\t\t\t<PartidaRegistral>" . trim($xxx223['numpartida']). "</PartidaRegistral>\n";}
						if($xxx223['idsedereg']=="" and $xxx223['numpartida']==""){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t\t\t\t\t\t\t</InscripcionRepresentacion>\n";}

	                   if(($xxx223['facultades'])==""){$salida_xml.="";}else{  $salida_xml .= "\t\t\t\t\t\t\t\t\t\t<Facultades>" .substr(trim($xxx223['facultades']),0,50). "</Facultades>\n";}

										//$salida_xml .= "\t\t\t\t\t<FechaFirma>" . fdate($xxx223['fechafirma']) . "</FechaFirma>\n";
										if(empty($xxx223['ffirma'])==true){$salida_xml.="";}else{  $salida_xml .= "\t\t\t\t\t\t\t\t\t\t<FechaFirma>" .fdate($xxx223['ffirma']). "</FechaFirma>\n";}

								 $salida_xml .= "\t\t\t\t\t\t\t\t\t</Representante>\n";
								
									}
									$salida_xml .= "\t\t\t\t\t\t\t\t</Representantes>\n"; 
									
									}
									if(empty($xxx22['ffirma'])==true){$salida_xml.="";}else{  $salida_xml .= "\t\t\t\t\t\t\t\t<FechaFirma>" .fdate($xxx22['ffirma']). "</FechaFirma>\n";}
								 
							 $salida_xml .= "\t\t\t\t\t\t\t</Sujeto>\n";
							

							}
						}
						$salida_xml .= "\t\t\t\t\t\t</Sujetos>\n"; 
						
						$salida_xml .= "\t\t\t\t\t\t</Intervencion>\n"; 
							}
						}
					}
					

	//          $salida_xml .= "\t\t\t\t\t<DetalleObjeto>\n"; 

	 //           $salida_xml .= "\t\t\t\t\t<ValorTasacion>" . "" . "</ValorTasacion>\n";
	 //           $salida_xml .= "\t\t\t\t\t<TotalParticipantes>" . "" . "</TotalParticipantes>\n";
	 //           $salida_xml .= "\t\t\t\t\t<ImporteCapitalSocial>" . "" . "</ImporteCapitalSocial>\n";
	 //           $salida_xml .= "\t\t\t\t\t<TipoMonedaImporte>" ."" . "</TipoMonedaImporte>\n";
	 //           $salida_xml .= "\t\t\t\t\t<DisponenSerie>" . "" . "</DisponenSerie>\n";

	//            $salida_xml .= "\t\t\t\t<DetalleAcciones>\n"; 
	 //               $salida_xml .= "\t\t\t\t\t<Serie>" . "" . "</Serie>\n";
		//              $salida_xml .= "\t\t\t\t\t<Numeracion>" . "" . "</Numeracion>\n";
		 //             $salida_xml .= "\t\t\t\t\t<ValorNominalUnidad>" . "" . "</ValorNominalUnidad>\n";
			//            $salida_xml .= "\t\t\t\t\t<TipoMoneda>" . "" . "</TipoMoneda>\n";
			 //       $salida_xml .= "\t\t\t\t</DetalleAcciones>\n"; 

		//        $salida_xml .= "\t\t\t\t\t</DetalleObjeto>\n"; 
					$salida_xml .=	"\t\t\t\t\t</Intervenciones>\n";
					$salida_xml .= "\t\t\t</Operantes>\n"; 
					

					$resultado15=mysqli_query($conn,$queryCuantia) or die("sin resultado 29"); 
					
					
						while($x15 = mysqli_fetch_array($resultado15)){ 
						if($x15['tipacto']=="1111" or $x15['tipacto']=="038"  ){
						}else{
						$salida_xml .= "\t\t\t\t<CuantiaOperacion>\n"; 
						//$salida_xml .= "\t\t\t\t\t<CuantiaOperacion>" . "" . "</CuantiaOperacion>\n";

						if($x15['importetrans']==""){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t\t<Cuantia>" . $x15['importetrans'] . "</Cuantia>\n";} 
						if($x15['tipomon']=="" or $x15['tipomon']==0 ){$salida_xml.="";}else{ $salida_xml .= "\t\t\t\t\t<TipoMoneda>" . $x15['tipomon'] . "</TipoMoneda>\n";}
						//$salida_xml .= "\t\t\t\t\t<TipoMoneda>" . "" . "</TipoMoneda>\n";
						
						$salida_xml .= "\t\t\t\t</CuantiaOperacion>\n"; 
						}
					 }  

					
					 $resultado5=mysqli_query($conn,$query51) or die("sin resultado 30"); 

						$salida_xml .= "\t\t\t\t<MediosPagos>\n";
						//mediopago
						 while($x5 = mysqli_fetch_array($resultado5)){ 
						 

					if($x5['tipacto']=="1111" or $x5['tipacto']=="016" or $x5['tipacto']=="038"){
						
						//vacio por medio de pago de donacion
						
					}else{
					
					
					$salida_xml .= "\t\t\t\t<MediosPago>\n"; 

						if($x5['idmediop']=="" or $x5['idmediop']==0 ){$salida_xml.="";}else{  $salida_xml .= "\t\t\t\t\t<MedioPago>" . $x5['idmediop'] . "</MedioPago>\n";}
						if($x5['codigofp']==""  ){$salida_xml.="";}else{ $salida_xml .= "\t\t\t\t\t<FormaPago>" . $x5['codigofp']. "</FormaPago>\n";}
						if($x5['oport']=="" or $x5['oport']==0 or $x5['oport']==10){$salida_xml.="";}else{ $salida_xml .= "\t\t\t\t\t<MomentoPago>" . $x5['oport']. "</MomentoPago>\n";}
						if($x5['oport']!="8"  ){$salida_xml.="";}else{
							if($x5['des_idoppago']==''){
								$salida_xml .= "\t\t\t\t\t<DescripcionMomentoPago>NO PRECISA</DescripcionMomentoPago>\n";
							}else{
								$salida_xml .= "\t\t\t\t\t<DescripcionMomentoPago>" . $x5['des_idoppago']. "</DescripcionMomentoPago>\n";
							}
							
							}
						if($x5['importetrans']==""){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t\t<CuantiaPago>" . $x5['importetrans'] . "</CuantiaPago>\n";}           
						if($x5['tipomon']=="" or $x5['tipomon']==0 ){$salida_xml.="";}else{ $salida_xml .= "\t\t\t\t\t<TipoMonedaPago>" . $x5['tipomon'] . "</TipoMonedaPago>\n";}
						//if($x5['tipomon']=="" or $x5['tipomon']==0 ){$salida_xml.="";}else{ $salida_xml .= "\t\t\t\t\t<TipoMonedaPago>" . $x5['tipomon'] . "</TipoMonedaPago>\n";}
			 //      $salida_xml .= "\t\t\t\t\t<TipoCambio>" . "" . "</TipoCambio>\n";
						//if($x5['exxx']=='SI'){$exxx2=1;}else{$exxx2=0;}
						if($x5['idmediop']=="095" or $x5['idmediop']=="096" or $x5['idmediop']=="097" or $x5['idmediop']=="098"){$exxx2=0;}else{$exxx2=1;}
						if($x5['exxx']=="" ){$salida_xml.="";}else{ $salida_xml .= "\t\t\t\t\t<JustificadoManifestado>" .$exxx2. "</JustificadoManifestado>\n";}
						//$salida_xml .= "\t\t\t\t\t<JustificadoManifestado>" . "" . "</JustificadoManifestado>\n";
			 //     date('Y-m-d', strtotime($x5['foperacion']))
						if($x5['foperacion']=="" or $x5['foperacion']==0 ){$salida_xml.="";}else{ $salida_xml .= "\t\t\t\t\t<FechaPago>" . fdate($x5['foperacion']) . "</FechaPago>\n";}
						if($x5['idpago']=="" or $x5['idpago']==0 ){$salida_xml.="";}else{   $salida_xml .= "\t\t\t\t\t<IdPago>" .  $x5['idpago'] . "</IdPago>\n";}
					 

			     if($x5['idbancos']=="" or $x5['idbancos']==0 ){$salida_xml.="";}else{  $salida_xml .= "\t\t\t\t\t<EntidadFinanciera>" . $x5['idbancos']. "</EntidadFinanciera>\n";}
					 

					$salida_xml .= "\t\t\t\t</MediosPago>\n";
					
							}
							
						}
						$salida_xml .= "\t\t\t\t</MediosPagos>\n";

		//      $salida_xml .= "\t\t\t\t<Plazos>\n"; 
		 //       $salida_xml .= "\t\t\t\t\t<PlazoInicial>" . "" . "</PlazoInicial>\n";
			//      $salida_xml .= "\t\t\t\t\t<PlazoFinal>" . "" . "</PlazoFinal>\n";
			 //   $salida_xml .= "\t\t\t\t</Plazos>\n"; 

			    if($x['contrato']==""){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t\t<NombreContrato>" . substr($x['contrato'],0,30) . "</NombreContrato>\n";}
			 $resultado6=mysqli_query($conn,$querymediopago) or die("sin resultado 31"); 
			 while($x6 = mysqli_fetch_array($resultado6)){ 
			 if($x6['fechaminuta']==""){$salida_xml.="";}else{  $salida_xml .= "\t\t\t\t\t<FechaMinuta>" .  fdate($x6['fechaminuta']). "</FechaMinuta>\n";}}
			 //   $salida_xml .= "\t\t<DocumentoRectificacion>" . "" . "</DocumentoRectificacion>\n";
			 //   $salida_xml .= "\t\t<TipoDocAnterior>" . "" . "</TipoDocAnterior>\n";

			 //   $salida_xml .= "\t\t\t\t<RectificacionDocumento>\n"; 
			 //     $salida_xml .= "\t\t\t\t\t<CodNotario>" . "". "</CodNotario>\n";
			 //     $salida_xml .= "\t\t\t\t\t<NumDocumento>" . "" . "</NumDocumento>\n";
			 //     $salida_xml .= "\t\t\t\t\t<TipoInstrumento>" . "" . "</TipoInstrumento>\n";
			 //     $salida_xml .= "\t\t\t\t\t<AnyoDocumento>" . "" . "</AnyoDocumento>\n";
			 //  $salida_xml .= "\t\t\t\t</RectificacionDocumento>\n"; 

					//$salida_xml .= "\t\t<DescDocNoNotarial>" . "" . "</DescDocNoNotarial>\n";
				
				
				 $salida_xml .= "\t\t\t</Operacion>\n"; 
						 
				 }
			
				 
				
			$salida_xml .= "\t</Operaciones>\n";
		$salida_xml .= "\t</DocumentoNotarial>\n\n"; 
}


$salida_xml .= "</DocumentosNotariales>\n";
$salida = str_replace("&","*",$salida_xml);
$salida = str_replace("Ã‘","Ñ",$salida_xml);
$salida = str_replace("Ï¿½","Ñ",$salida_xml);
$salida = str_replace("Ï¿Ï¿½","Ñ",$salida_xml);




$crearxml = fopen("documento_notarial.xml", "w+");
fwrite($crearxml,$salida);
fclose($crearxml);


$sql = "UPDATE sisgen_temp SET  seleccionado = '0' WHERE kardex = '$kardex'" ;
$r = mysqli_query($conn,$sql);

$objResponse = new stdClass();
$objResponse->error = 0;
$objResponse->kardex = $kardex;
$objResponse->idKardex = $idKardex;
echo json_encode($objResponse);

