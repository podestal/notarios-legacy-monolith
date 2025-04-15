<?php


function fdate($mifecha)

		{
		$var = str_replace('/', '-', $mifecha);
		return date('Y-m-d', strtotime($var));
		}

include('conexion.php');


$fechade = $_POST['startDate'];
$fecha=explode("/",$fechade);
$desde=$fecha[2]."-".$fecha[1]."-".$fecha[0];

$fechaa  = $_POST['endDate'];
$fecha2=explode("/",$fechaa);
$hasta=$fecha2[2]."-".$fecha2[1]."-".$fecha2[0];



$reconsulta= mysql_query("SET @numero=0;", $conn) or die(mysql_error());

/* FECHA DE ESCRITURA BUSQUEDA
*/
$consulta = mysql_query("SELECT @numero:=@numero+1 AS POSICION, IDKARDEX AS IDKARDEX, KARDEX AS KARDEX, KARDEX.IDTIPKAR AS TIPO_KARDEX,FECHAINGRESO AS FECHA_INGRESO,
				CODACTOS AS CODIGO_ACTO, CONTRATO AS CONTRATO, FOLIOINI AS FOLIOINI, FOLIOFIN AS FOLIOFIN,  FECHACONCLUSION AS FECHA_CONCLUSION,
				NUMESCRITURA AS NUMERO_ESCRITURA, FECHAESCRITURA AS FECHA_ESCRITURA, COD_ANCERT AS ANCERT  FROM KARDEX ,tiposdeacto ta
				WHERE STR_TO_DATE(FECHAESCRITURA,'%Y-%m-%d') BETWEEN STR_TO_DATE('$desde','%Y-%m-%d')
				AND STR_TO_DATE('$hasta','%Y-%m-%d') AND SUBSTRING(KARDEX.codactos,1,3)=ta.idtipoacto
				AND numescritura <>'' AND cod_ancert <>'' AND estado_sisgen <>'1'  ORDER BY KARDEX DESC  ", $conn) or die(mysql_error());/**/

//FECHA DE MODIFICACION
/*
$consulta = mysql_query("SELECT @numero:=@numero+1 AS POSICION, IDKARDEX AS IDKARDEX, KARDEX AS KARDEX, KARDEX.IDTIPKAR AS TIPO_KARDEX, CODACTOS AS CODIGO_ACTO,
				CONTRATO AS CONTRATO, FECHAINGRESO AS FECHA_INGRESO, FECHACONCLUSION AS FECHA_CONCLUSION,
				NUMESCRITURA AS NUMERO_ESCRITURA, DATE_FORMAT(FECHAESCRITURA, '%d/%m/%Y') AS FECHA_ESCRITURA  FROM KARDEX ,tiposdeacto ta
				WHERE STR_TO_DATE(FECHA_MODIFICACION,'%d/%m/%y') BETWEEN STR_TO_DATE('$fechade','%d/%m/%y')
				AND STR_TO_DATE('$fechaa','%d/%m/%y') AND SUBSTRING(KARDEX.codactos,1,3)=ta.idtipoacto
				AND numescritura <>'' AND cod_ancert <>'' AND estado_sisgen <>'1' ORDER BY KARDEX DESC  ", $conn) or die(mysql_error());*/



$borrardatos="TRUNCATE sisgen_temp";
mysql_query($borrardatos,$conn) or die(mysql_error());

$data = array();
while($row = mysql_fetch_array($consulta)){

	if($row['TIPO_KARDEX']=='1'){$TIPO ='EP';}
	if($row['TIPO_KARDEX']=='2'){$TIPO ='NC';}
	if($row['TIPO_KARDEX']=='3'){$TIPO ='TV';}
	if($row['TIPO_KARDEX']=='4'){$TIPO ='GM';}
	if($row['TIPO_KARDEX']=='5'){$TIPO ='TE';}
	$idkardex=$row['IDKARDEX'];
	$kardex=$row['KARDEX'];
	if($row['TIPO_KARDEX']=='1'){$TIPO2 ='E';}
	if($row['TIPO_KARDEX']=='2'){$TIPO2 ='C';}
	if($row['TIPO_KARDEX']=='3'){$TIPO2 ='V';}
	if($row['TIPO_KARDEX']=='4'){$TIPO2 ='G';}
	if($row['TIPO_KARDEX']=='5'){$TIPO2 ='T';}
	$fecha_ingreso=$row['FECHA_INGRESO'];
	$codigoacto=$row['CODIGO_ACTO'];
	$folioini=$row['FOLIOINI'];
	$foliofin=$row['FOLIOFIN'];
	$fecha_escritura=$row['FECHA_ESCRITURA'];
	$fecha_conclusion=$row['FECHA_CONCLUSION'];
	$ancert=$row['ANCERT'];
	$num_escritura=$row['NUMERO_ESCRITURA'];
	$contrato=$row['CONTRATO'];
	$row['TIPO_KARDEX2'] = $TIPO;

	$data[] = $row;

$grabardatatemp="INSERT INTO sisgen_temp(idkardex,kardex,idtipkar,fecha_ingreso,codactos,contrato,folioini,foliofin,fecha_conclusion,numescritura,fechaescritura, cod_ancert ) VALUES ('$idkardex','$kardex','$TIPO2','$fecha_ingreso','$codigoacto','$contrato','$folioini','$foliofin','$fecha_conclusion','$num_escritura','$fecha_escritura','$ancert')";
mysql_query($grabardatatemp,$conn) or die(mysql_error());

}

//TEMP PERSONA JURIDICA

$borrardatos="TRUNCATE sisgen_temp_j";
mysql_query($borrardatos,$conn) or die(mysql_error());

$consulta_Juridica= mysql_query("SELECT cl.idcontratante, cl.idcliente AS id, cl.tipper AS tipp,
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
FROM sisgen_temp,cliente2 cl
LEFT JOIN contratantes co ON cl.idcontratante=co.idcontratante
LEFT JOIN ubigeo u ON cl.idubigeo=u.coddis
LEFT JOIN ciiu c ON cl.actmunicipal=c.coddivi
LEFT JOIN tipodocumento td ON cl.idtipdoc=td.idtipdoc
LEFT JOIN profesiones prof ON cl.idprofesion=prof.idprofesion
LEFT JOIN nacionalidades na ON cl.nacionalidad=na.idnacionalidad
LEFT OUTER JOIN contratantesxacto cx ON co.idcontratante=cx.idcontratante
WHERE (cx.uif ='O' OR cx.uif='B' OR cx.uif='R') AND cl.tipper='J'
AND sisgen_temp.kardex=cx.kardex",$conn) or die(mysql_error());
while($row_juridica = mysql_fetch_array($consulta_Juridica)){

	$idcontratante=$row_juridica['idcontratante'];
	$id=$row_juridica['id'];
	$tipp=$row_juridica['tipp'];
	$tipodoc=$row_juridica['tipodoc'];
	$numdoc=$row_juridica['numdoc'];
	$idubigeo=$row_juridica['idubigeo'];
	$razonsocial=$row_juridica['razonsocial'];
	$domfiscal=$row_juridica['domfiscal'];
	$telempresa=$row_juridica['telempresa'];
	$correoemp=$row_juridica['correoemp'];
	$objeto=$row_juridica['objeto'];
	$fechaconstitu=$row_juridica['fechaconstitu'];
	$sedereg=$row_juridica['sedereg'];
	$numregistro=$row_juridica['numregistro'];
	$numpartidareg=$row_juridica['numpartidareg'];
	$actmunicipal=$row_juridica['actmunicipal'];
	$residente=$row_juridica['residente'];
	$docpaisemi=$row_juridica['docpaisemi'];
	$idtipkar=$row_juridica['idtipkar'];
	$kardex=$row_juridica['kardex'];
	$condi=$row_juridica['condi'];
	$firma=$row_juridica['firma'];
	$fechafirma=$row_juridica['fechafirma'];
	$resfirma=$row_juridica['resfirma'];
	$tiporepresentacion=$row_juridica['tiporepresentacion'];
	$idcontratanterp=$row_juridica['idcontratanterp'];
	$idsedereg=$row_juridica['idsedereg'];
	$numpartida=$row_juridica['numpartida'];
	$facultades=$row_juridica['facultades'];
	$inscrito=$row_juridica['inscrito'];
	$distrito=$row_juridica['distrito'];
	$provincia=$row_juridica['provincia'];
	$departamento=$row_juridica['departamento'];
	$ciuu=$row_juridica['ciuu'];
	$ROUIF=$row_juridica['ROUIF'];
	$idcliente=$row_juridica['idcliente'];

$grabardatajuridica="INSERT INTO `sisgen_temp_j` (`idcontratante`, `id`, `tipp`, `tipodoc`, `numdoc`, `idubigeo`, `razonsocial`, `domfiscal`, `telempresa`, `correoemp`, `objeto`, `fechaconstitu`, `sedereg`, `numregistro`, `numpartidareg`, `actmunicipal`, `residente`, `docpaisemi`, `idtipkar`, `kardex`, `condi`, `firma`, `fechafirma`, `resfirma`, `tiporepresentacion`, `idcontratanterp`, `idsedereg`, `numpartida`, `facultades`, `inscrito`, `distrito`, `provincia`, `departamento`, `ciuu`,`profesion`, `nacionalidad`, `ROUIF`, `idcliente`) VALUES('$idcontratante','$id','$tipp','$tipodoc','$numdoc','$idubigeo','$razonsocial','$domfiscal','$telempresa','$correoemp','$objeto','$fechaconstitu','$sedereg','$numregistro','$numpartidareg','$actmunicipal','$residente','$docpaisemi','$idtipkar','$kardex','$condi','$firma','$fechafirma','$resfirma','$tiporepresentacion','$idcontratanterp','$idsedereg','$numpartida','$facultades','$inscrito','$distrito','$provincia','$departamento','$ciuu','','','$ROUIF','$idcliente')";
mysql_query($grabardatajuridica,$conn) or die(mysql_error());

}

//TEMP PERSONA NATURAL

$borrardatos2="TRUNCATE sisgen_temp_n";
mysql_query($borrardatos2,$conn) or die(mysql_error());

$consulta_Natural= mysql_query("SELECT cl.idcontratante, cl.idcliente AS id, cl.tipper AS tipp, cl.apepat AS apepat,
 cl.apemat AS apemat, CONCAT(TRIM(cl.prinom),' ',TRIM(cl.segnom)) AS nom,
 cl.nombre, cl.direccion AS direccion, cl.idtipdoc , cl.numdoc AS numdoc,
 cl.email AS email, cl.telfijo AS telfijo, cl.telcel, cl.telofi, cl.sexo AS gen,
 cl.idestcivil AS estc, cl.natper, cl.conyuge, cl.nacionalidad AS naci,
 cl.idprofesion , cl.detaprofesion, cl.idcargoprofe , cl.profocupa, cl.dirfer,
 cl.idubigeo, cl.cumpclie AS fechanaci, cl.residente,  u.coddist AS distrito,
 u.codprov AS provincia, u.codpto AS departamento,codtipdoc AS tipodoc,
 prof.codprof AS profesion, na.codnacion AS nacionalidad, cp.codcargoprofe
 AS cargo, cx.uif AS ROLUIF,co.kardex AS kardex
FROM sisgen_temp,cliente2 cl
LEFT JOIN contratantes co ON cl.idcontratante=co.idcontratante
LEFT JOIN ubigeo u ON cl.idubigeo=u.coddis
LEFT JOIN tipodocumento td ON cl.idtipdoc=td.idtipdoc
LEFT JOIN profesiones prof ON cl.idprofesion=prof.idprofesion
LEFT JOIN nacionalidades na ON cl.nacionalidad=na.idnacionalidad
LEFT JOIN cargoprofe cp ON cl.idcargoprofe=cp.idcargoprofe
LEFT JOIN contratantesxacto cx ON co.idcontratante=cx.idcontratante
WHERE (cx.uif ='O' OR cx.uif='B' OR cx.uif='R') AND cl.tipper='N'
AND sisgen_temp.kardex=cx.kardex",$conn) or die(mysql_error());
while($row_natural = mysql_fetch_array($consulta_Natural)){

	$idcontratante=$row_natural['idcontratante'];
	$id=$row_natural['id'];
	$tipp=$row_natural['tipp'];
	$apepat=$row_natural['apepat'];
	$apemat=$row_natural['apemat'];
	$nom=$row_natural['nom'];
	$nombre=$row_natural['nombre'];
	$direccion=$row_natural['direccion'];
	$idtipdoc=$row_natural['idtipdoc'];
	$numdoc=$row_natural['numdoc'];
	$email=$row_natural['email'];
	$telfijo=$row_natural['telfijo'];
	$telcel=$row_natural['telcel'];
	$telofi=$row_natural['telofi'];
	$gen=$row_natural['gen'];
	$estc=$row_natural['estc'];
	$natper=$row_natural['natper'];
	$conyuge=$row_natural['conyuge'];
	$naci=$row_natural['naci'];
	$idprofesion=$row_natural['idprofesion'];
	$detaprofesion=$row_natural['detaprofesion'];
	$idcargoprofe=$row_natural['idcargoprofe'];
	$profocupa=$row_natural['profocupa'];
	$dirfer=$row_natural['dirfer'];
	$idubigeo=$row_natural['idubigeo'];
	$fechanaci=$row_natural['fechanaci'];
	$residente=$row_natural['residente'];
	$distrito=$row_natural['distrito'];
	$provincia=$row_natural['provincia'];
	$departamento=$row_natural['departamento'];
	$tipodoc=$row_natural['tipodoc'];
	$profesion=$row_natural['profesion'];
	$nacionalidad=$row_natural['nacionalidad'];
	$cargo=$row_natural['cargo'];
	$ROLUIF=$row_natural['ROLUIF'];
	$kardex=$row_natural['kardex'];

$grabardatanatural="insert into `sisgen_temp_n` (`idcontratante`, `id`, `tipp`, `apepat`, `apemat`, `nom`, `nombre`, `direccion`, `idtipdoc`, `numdoc`, `email`, `telfijo`, `telcel`, `telofi`, `gen`, `estc`, `natper`, `conyuge`, `naci`, `idprofesion`, `detaprofesion`, `idcargoprofe`, `profocupa`, `dirfer`, `idubigeo`, `fechanaci`, `residente`, `distrito`, `provincia`, `departamento`, `tipodoc`, `profesion`, `nacionalidad`, `cargo`, `ROLUIF`,`idcliente`, `kardex`) values('$idcontratante','$id','$tipp','$apepat','$apemat','$nom','$nombre','$direccion','$idtipdoc','$numdoc','$email','$telfijo','$telcel','$telofi','$gen','$estc','$natper','$conyuge','$naci','$idprofesion','$detaprofesion','$idcargoprofe','$profocupa','$dirfer','$idubigeo','$fechanaci','$residente','$distrito','$provincia','$departamento','$tipodoc','$profesion','$nacionalidad','$cargo','$ROLUIF','$id','$kardex');";
mysql_query($grabardatanatural,$conn) or die(mysql_error());

}


//TEMP INTERVENCIONES QUERY 6

$borrardatos3="TRUNCATE sisgen_intervenciones_6";
mysql_query($borrardatos3,$conn) or die(mysql_error());

$consulta_intervenciones_6= mysql_query("SELECT
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
LEFT JOIN actocondicion act ON act.`idcondicion` = cxa.`idcondicion`   ",$conn) or die(mysql_error());
while($row_intervenciones_6 = mysql_fetch_array($consulta_intervenciones_6)){

	$idcon=$row_intervenciones_6['idcon'];
	$idcl=$row_intervenciones_6['idcl'];
	$tipp=$row_intervenciones_6['tipp'];
	$apepat=$row_intervenciones_6['apepat'];
	$apemat=$row_intervenciones_6['apemat'];
	$nom=$row_intervenciones_6['nom'];
	$nombre=$row_intervenciones_6['nombre'];
	$direccion=$row_intervenciones_6['direccion'];
	$tipodoc=$row_intervenciones_6['tipodoc'];
	$numdoc=$row_intervenciones_6['numdoc'];
	$email=$row_intervenciones_6['email'];
	$telfijo=$row_intervenciones_6['telfijo'];
	$telcel=$row_intervenciones_6['telcel'];
	$telofi=$row_intervenciones_6['telofi'];
	$gen=$row_intervenciones_6['gen'];
	$estc=$row_intervenciones_6['estc'];
	$natper=$row_intervenciones_6['natper'];
	$conyuge=$row_intervenciones_6['conyuge'];
	$nacionalidad=$row_intervenciones_6['nacionalidad'];
	$profesion=$row_intervenciones_6['profesion'];
	$detaprofesion=$row_intervenciones_6['detaprofesion'];
	$cargo=$row_intervenciones_6['cargo'];
	$profocupa=$row_intervenciones_6['profocupa'];
	$dirfer=$row_intervenciones_6['dirfer'];
	$idubigeo=$row_intervenciones_6['idubigeo'];
	$fechanaci=$row_intervenciones_6['fechanaci'];
	$fechaing=$row_intervenciones_6['fechaing'];
	$razonsocial=$row_intervenciones_6['razonsocial'];
	$domfiscal=$row_intervenciones_6['domfiscal'];
	$telempresa=$row_intervenciones_6['telempresa'];
	$correoemp=$row_intervenciones_6['correoemp'];
	$contacempresa=$row_intervenciones_6['contacempresa'];
	$fechaconstitu=$row_intervenciones_6['fechaconstitu'];
	$idsedereg=$row_intervenciones_6['idsedereg'];
	$numregistro=$row_intervenciones_6['numregistro'];
	$numpartida=$row_intervenciones_6['numpartida'];
	$actmunicipal=$row_intervenciones_6['actmunicipal'];
	$tipocli=$row_intervenciones_6['tipocli'];
	$impeingre=$row_intervenciones_6['impeingre'];
	$impnumof=$row_intervenciones_6['impnumof'];
	$impeorigen=$row_intervenciones_6['impeorigen'];
	$impentidad=$row_intervenciones_6['impentidad'];
	$impremite=$row_intervenciones_6['impremite'];
	$impmotivo=$row_intervenciones_6['impmotivo'];
	$residente=$row_intervenciones_6['residente'];
	$docpaisemi=$row_intervenciones_6['docpaisemi'];
	$kardex=$row_intervenciones_6['kardex'];
	$firma=$row_intervenciones_6['firma'];
	$ffirma=$row_intervenciones_6['ffirma'];
	$resfirma=$row_intervenciones_6['resfirma'];
	$tiporepresentacion=$row_intervenciones_6['tiporepresentacion'];
	$idcontratanterp=$row_intervenciones_6['idcontratanterp'];
	$facultades=$row_intervenciones_6['facultades'];
	$indice=$row_intervenciones_6['indice'];
	$visita=$row_intervenciones_6['visita'];
	$inscrito=$row_intervenciones_6['inscrito'];
	$condi=$row_intervenciones_6['condi'];
	$condicionn=$row_intervenciones_6['condicionn'];
	$condicionnsisgen=$row_intervenciones_6['condicionnsisgen'];
	$id=$row_intervenciones_6['id'];
	$idtipkar=$row_intervenciones_6['idtipkar'];
	$idtipoacto=$row_intervenciones_6['idtipoacto'];
	$idcontratante=$row_intervenciones_6['idcontratante'];
	$item=$row_intervenciones_6['item'];
	$idcondicion=$row_intervenciones_6['idcondicion'];
	$parte=$row_intervenciones_6['parte'];
	$porcentaje=$row_intervenciones_6['porcentaje'];
	$repre=$row_intervenciones_6['repre'];
	$formulario=$row_intervenciones_6['formulario'];
	$montoo=$row_intervenciones_6['montoo'];
	$opago=$row_intervenciones_6['opago'];
	$fondos=$row_intervenciones_6['fondos'];
	$montop=$row_intervenciones_6['montop'];


$grabardataintervenciones6="insert into `sisgen_intervenciones_6` (`idcon`, `idcl`, `tipp`, `apepat`, `apemat`, `nom`, `nombre`, `direccion`, `tipodoc`, `numdoc`, `email`, `telfijo`, `telcel`, `telofi`, `gen`, `estc`, `natper`, `conyuge`, `nacionalidad`, `profesion`, `detaprofesion`, `cargo`, `profocupa`, `dirfer`, `idubigeo`, `fechanaci`, `fechaing`, `razonsocial`, `domfiscal`, `telempresa`, `correoemp`, `contacempresa`, `fechaconstitu`, `idsedereg`, `numregistro`, `numpartida`, `actmunicipal`, `tipocli`, `impeingre`, `impnumof`, `impeorigen`, `impentidad`, `impremite`, `impmotivo`, `residente`, `docpaisemi`, `kardex`, `firma`, `ffirma`, `resfirma`, `tiporepresentacion`, `idcontratanterp`, `facultades`, `indice`, `visita`, `inscrito`, `condi`, `condicionn`, `condicionnsisgen`, `id`, `idtipkar`, `idtipoacto`, `idcontratante`, `item`, `idcondicion`, `parte`, `porcentaje`, `repre`, `formulario`, `montoo`, `opago`, `fondos`, `montop`) values('$idcon','$idcl','$tipp','$apepat','$apemat','$nom','$nombre','$direccion','$tipodoc','$numdoc','$email','$telfijo','$telcel','$telofi','$gen','$estc','$natper','$conyuge','$nacionalidad','$profesion','$detaprofesion','$cargo','$profocupa','$dirfer','$idubigeo','$fechanaci','$fechaing','$razonsocial','$domfiscal','$telempresa','$correoemp','$contacempresa','$fechaconstitu','$idsedereg','$numregistro','$numpartida','$actmunicipal','$tipocli','$impeingre','$impnumof','$impeorigen','$impentidad','$impremite','$impmotivo','$residente','$docpaisemi','$kardex','$firma','$ffirma','$resfirma','$tiporepresentacion','$idcontratanterp','$facultades','$indice','$visita','$inscrito','$condi','$condicionn','$condicionnsisgen','$id','$idtipkar','$idtipoacto','$idcontratante','$item','$idcondicion','$parte','$porcentaje','$repre','$formulario','$montoo','$opago','$fondos','$montop');";
mysql_query($grabardataintervenciones6,$conn) or die(mysql_error());

}

$consulta = mysql_query("SELECT CONCAT('Kardex Encontrados: ',COUNT(kardex)) AS cantidad, count(kardex) as totalkardex FROM sisgen_temp", $conn) or die(mysql_error());
while($cantidad = mysql_fetch_array($consulta)){
	$canti=$cantidad['cantidad'];
	$totalkardex=$cantidad['totalkardex'];
}

echo json_encode(array('list'=>$data,'cantidad'=>$canti,'totalkardex'=>$totalkardex));
