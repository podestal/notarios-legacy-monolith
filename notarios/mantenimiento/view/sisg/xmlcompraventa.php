<?php
include('conexion.php');	
function fdate($mifecha)  
  


		{
		$var = str_replace('/', '-', $mifecha);
		return date('Y-m-d', strtotime($var));
		}

set_time_limit(0);
//include("protocolares.php");	


$fechade=$_POST['fec_desde'];
$fechadee=fdate($fechade);
$fechaha=$_POST['fec_hasta'];
$fechahaha=fdate($fechaha);


//$kardexx=($_GET ['sisgen']);



	/*
	$consultakardex = "SELECT kardex FROM kardex WHERE kardex LIKE'%KAR%' ORDER BY kardex ASC LIMIT 1";
$resulset = mysql_query($consultakardex, $conn) or die("sin kardex."); 

	while($karkar = mysql_fetch_array($resulset)){ 
		$karrrrr=$karkar['kardex'];
		}
*/

//CONSULTA LOS  KARDEX A A ENVIAR
/*
$query = "SELECT k.idkardex, k.kardex, k.idtipkar AS tipkar, k.kardexconexo, k.fechaingreso,
k.horaingreso, k.referencia, k.codactos, k.contrato, k.idusuario,
k.responsable, k.observacion, k.documentos, k.fechacalificado,
k.fechainstrumento, k.fechaconclusion, k.numinstrmento, k.folioini AS fini,
k.folioinivta, k.foliofin AS ffin, k.foliofinvta, k.papelini, k.papelinivta,
k.papelfin , k.papelfinvta, k.comunica1, k.contacto, k.telecontacto,
k.mailcontacto, k.retenido, k.desistido, k.autorizado, k.idrecogio,
k.pagado, k.visita, k.dregistral, k.dnotarial, k.idnotario, k.numminuta,
k.numescritura, k.fechaescritura, k.insertos, k.direc_contacto,tk.tipkar AS tipokardex,
k.txa_minuta, cod_ancert AS ancert
FROM kardex k,tipokar tk ,tiposdeacto ta
WHERE k.idtipkar=tk.idtipkar AND K.codactos=ta.idtipoacto AND k.KARDEX IN ('KAR7643','KAR4156','KAR7286') ";
//KAR7795','KAR7802
*/

			// FECHA DE MODIFICACION
			/*
			$query = "SELECT k.idkardex, k.kardex, k.idtipkar AS tipkar, k.kardexconexo, k.fechaingreso,
			k.horaingreso, k.referencia, K.codactos AS codactos, k.contrato, k.idusuario,
			k.responsable, k.observacion, k.documentos, k.fechacalificado,
			k.fechainstrumento, k.fechaconclusion, k.numinstrmento, k.folioini AS fini,
			k.folioinivta, k.foliofin AS ffin, k.foliofinvta, k.papelini, k.papelinivta,
			k.papelfin , k.papelfinvta, k.comunica1, k.contacto, k.telecontacto,
			k.mailcontacto, k.retenido, k.desistido, k.autorizado, k.idrecogio,
			k.pagado, k.visita, k.dregistral, k.dnotarial, k.idnotario, k.numminuta,
			k.numescritura, k.fechaescritura, k.insertos, k.direc_contacto,tk.tipkar AS tipokardex,
			k.txa_minuta, cod_ancert AS ancert
			FROM kardex k,tipokar tk ,tiposdeacto ta
			WHERE k.idtipkar=tk.idtipkar AND SUBSTRING(K.codactos,1,3)=ta.idtipoacto AND STR_TO_DATE(k.FECHA_MODIFICACION,'%d/%m/%y') BETWEEN STR_TO_DATE('$fechade','%d/%m/%y') 
			AND STR_TO_DATE('$fechaha','%d/%m/%y') AND numescritura <>'' and cod_ancert <>'' AND estado_sisgen <>'1'
			ORDER BY k.kardex desc";*/

			// FECHA DE ESCRITURA
			
			/*$query = "SELECT k.idkardex, k.kardex, k.idtipkar AS tipkar, k.kardexconexo, k.fechaingreso,
			k.horaingreso, k.referencia, K.codactos AS codactos, k.contrato, k.idusuario,
			k.responsable, k.observacion, k.documentos, k.fechacalificado,
			k.fechainstrumento, k.fechaconclusion, k.numinstrmento, k.folioini AS fini,
			k.folioinivta, k.foliofin AS ffin, k.foliofinvta, k.papelini, k.papelinivta,
			k.papelfin , k.papelfinvta, k.comunica1, k.contacto, k.telecontacto,
			k.mailcontacto, k.retenido, k.desistido, k.autorizado, k.idrecogio,
			k.pagado, k.visita, k.dregistral, k.dnotarial, k.idnotario, k.numminuta,
			k.numescritura, k.fechaescritura, k.insertos, k.direc_contacto,tk.tipkar AS tipokardex,
			k.txa_minuta, cod_ancert AS ancert
			FROM kardex k,tipokar tk ,tiposdeacto ta
			WHERE k.idtipkar=tk.idtipkar AND SUBSTRING(K.codactos,1,3)=ta.idtipoacto AND STR_TO_DATE(k.fechaescritura,'%Y-%m-%d') BETWEEN STR_TO_DATE('$fechadee','%Y-%m-%d') 
			AND STR_TO_DATE('$fechahaha','%Y-%m-%d') AND numescritura <>'' and cod_ancert <>'' AND estado_sisgen <>'1' 
			ORDER BY k.kardex desc "; */
			
			$query ="SELECT idkardex,kardex,idtipkar as tipokardex,fecha_ingreso,codactos,contrato,folioini,foliofin,fecha_conclusion as fechaconclusion,numescritura,fechaescritura, cod_ancert as ancert FROM sisgen_temp";


//$querynor ="SELECT idnotar,nombre,apellido ,telefono,correo,ruc,direccion,distrito,codnotario,departamento,provincia FROM confinotario";
	$querynor ="SELECT idnotar,nombre,apellido ,telefono,correo,ruc,direccion,distrito,codnotario FROM confinotario";
	
	$resultadonor = mysql_query($querynor, $conn) or die("Sin datos del notario."); 

	while($nor = mysql_fetch_array($resultadonor)){ 
		$xnor=$nor['ruc'];
		$xnor2=$nor['codnotario'];
		$distrito=$nor['distrito'];
	}


$resultado = mysql_query($query, $conn) or die("Sin Kardex Encontrados"); 

	/*
 $salida_xml = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";  
 
$salida_xml .= "<Envelope xmlns='http://schemas.xmlsoap.org/soap/envelope/'>\n";
		$salida_xml .= "\t<Body>\n";
				$salida_xml .= "\t\t<setDocumentosNotariales xmlns='http://ws.sisgen.ancert.notariado.org/'>\n";
						$salida_xml .= "\t\t\t<arg0 xmlns=''><![CDATA[<?xml version='1.0' encoding='utf-8'?>\n";

*/
 $salida_xml .= "<DocumentosNotariales xmlns='http://ancert.notariado.org/SISGEN/XML' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xsi:schemaLocation='http://ancert.notariado.org/SISGEN/XML C:\SISGEN\SISGEN_V2_RO\documentos_notariales.xsd'>\n";

	$salida_xml .= "\t<GeneradorDatos>\n";
			$salida_xml .= "\t\t<NomProveedor>" ."CNL". "</NomProveedor>\n"; 
			$salida_xml .= "\t\t<NomAplicacion>" ."SISNOT". "</NomAplicacion>\n"; 
			$salida_xml .= "\t\t<VersionAplicacion>" ."2.7". "</VersionAplicacion>\n"; 
 $salida_xml .= "\t</GeneradorDatos>\n";

	 while($x = mysql_fetch_array($resultado)){ 
									 
		$d=$x['numescritura']; if($d<>""){ $e=$x['numescritura'];} else{$e="";}
		$d1=$x['fechaescritura']; if($d1<>""){ $e1=$x['fechaescritura'];} else{$e1="";}	
	 // $d3=$x['fechaconclusion']; if($d3<>""){ $e3=date('Y-m-d', strtotime($x['fechaconclusion']));} else{$e3="";}
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

		$query2 ="
		SELECT idcontratante, id, tipp, apepat, apemat, nom, nombre, direccion, idtipdoc, numdoc, email, telfijo, telcel, telofi, gen, estc, natper, conyuge, naci, idprofesion, detaprofesion, idcargoprofe, profocupa, dirfer, idubigeo, fechanaci, residente, distrito, provincia, departamento, tipodoc, profesion, nacionalidad, cargo, ROLUIF FROM sisgen_temp_n WHERE kardex='$kar' GROUP BY idcliente";
				
				//die($query2);
//QUERY PARA PERSONAS JURIDICAS

$query3 ="SELECT idcontratante, id, tipp, tipodoc, numdoc, idubigeo, razonsocial, domfiscal, telempresa, correoemp, objeto, fechaconstitu, sedereg, numregistro, numpartidareg, actmunicipal, residente, docpaisemi, idtipkar, kardex, condi, firma, fechafirma, resfirma, tiporepresentacion, idcontratanterp, idsedereg, numpartida, facultades, inscrito, distrito, provincia, departamento, ciuu,profesion, nacionalidad, ROUIF FROM sisgen_temp_j WHERE kardex='$kar' GROUP BY idcliente";

//die($query3);


$query5="SELECT  dm.detmp AS idmediop FROM detallemediopago dm WHERE  kardex='$kar' GROUP BY dm.kardex";
	
	//die($query5);
	
// PATRIMONIAL CON CUantia Operacion
$queryCuantia="SELECT idtipoacto AS tipacto, kardex,  importetrans , CONCAT('0',idmon)AS tipomon FROM patrimonial WHERE kardex ='$kar' GROUP BY kardex";

$tipoMoneda = mysql_query($queryCuantia, $conn) or die("Sin Kardex Encontrados");
 
 while($tipoMon = mysql_fetch_array($tipoMoneda)){ 
		$tipoM=$tipoMon['tipomon'];
	}
	

//----medios de pago   
$query51="SELECT dm.kardex, dm.tipacto, dm.codmepag, dm.fpago AS fechaope , CONCAT ('000',bc.codbancos) AS idbancos, 
dm.importemp AS importetrans, CONCAT('0',dm.idmon) AS tipomon, dm.foperacion, dm.documentos AS idpago, mp.codmepag , mp.uif, mp.cod_sisgen AS idmediop, mp.desmpagos,
 op.idoppago AS oport, pa.exhibiomp AS exxx, pa.nminuta AS fechaminuta, fp.codigo AS codigofp, 
 SUBSTRING(pa.des_idoppago,1,40) AS des_idoppago 
	FROM sisgen_temp					
	INNER JOIN detallemediopago dm ON dm.kardex = sisgen_temp.kardex
 LEFT JOIN mediospago mp ON dm.codmepag=mp.codmepag 
 LEFT JOIN patrimonial pa ON dm.kardex=pa.kardex 
 LEFT JOIN oporpago op ON pa.idoppago=op.codoppago 
 LEFT JOIN bancos bc ON dm.idbancos= bc.idbancos 
 LEFT JOIN fpago_uif fp ON fp.id_fpago=pa.fpago WHERE dm.kardex='$kar'";
	
	//die ($query51);
	
$querymediopago="SELECT DISTINCT  pa.nminuta AS fechaminuta
	FROM detallemediopago dm 
	LEFT OUTER JOIN patrimonial pa 
	ON dm.kardex=pa.kardex
	WHERE dm.kardex='$kar' GROUP BY dm.tipacto";

$query4 ="SELECT   detveh as idvehiculo,  kardex,  idtipacto,  idplaca,  numplaca,  clase,  marca,  anofab,  modelo,  combustible,  carroceria,
	fecinsc,  color,  motor,  numcil,  numserie,  numrueda,  idmon,  precio,  codmepag,  pregistral,  idsedereg
FROM detallevehicular 
WHERE kardex='$kar' ";


$query6="SELECT idcon, idcl, tipp, apepat, apemat, nom, nombre, direccion, tipodoc, numdoc, email, telfijo, telcel, telofi, gen, estc, natper, conyuge, nacionalidad, profesion, detaprofesion, cargo, profocupa, dirfer, idubigeo, fechanaci, fechaing, razonsocial, domfiscal, telempresa, correoemp, contacempresa, fechaconstitu, idsedereg, numregistro, numpartida, actmunicipal, tipocli, impeingre, impnumof, impeorigen, impentidad, impremite, impmotivo, residente, docpaisemi, kardex, firma, ffirma, resfirma, tiporepresentacion, idcontratanterp, facultades, indice, visita, inscrito, condi, condicionn, id, idtipkar, idtipoacto, idcontratante, item, idcondicion, parte, porcentaje, repre, formulario, montoo, opago, fondos, montop FROM sisgen_intervenciones_6 WHERE kardex ='$kar'";

//die($query6);

$query7="SELECT   id,  idtipkar,  kardex,  idtipoacto,  idcontratante,  item,  idcondicion,  parte,  porcentaje,
	uif,  formulario,  monto,  opago,  ofondo,  montop
FROM contratantesxacto WHERE kardex='$kar'";


$query8="SELECT   db.detbien AS idbien,  db.itemmp,  db.kardex,  db.idtipacto,  db.tipob ,  tb.codbien  AS tipo,  db.coddis,  db.fechaconst,  db.oespecific,  
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



 $query11="SELECT idcon, idcl, tipp, apepat, apemat, nom, nombre, direccion, tipodoc, numdoc, email, telfijo, telcel, 
telofi, gen, estc, natper, conyuge, nacionalidad, profesion, detaprofesion, cargo, profocupa, dirfer, 
idubigeo, fechanaci, fechaing, razonsocial, domfiscal, telempresa, correoemp, contacempresa, fechaconstitu, 
idsedereg, numregistro, numpartida, actmunicipal, tipocli, impeingre, impnumof, impeorigen, impentidad, 
impremite, impmotivo, residente, docpaisemi, kardex, firma, STR_TO_DATE(ffirma,'%d/%m/%Y') AS ffirma, resfirma, tiporepresentacion, 
idcontratanterp, facultades, indice, visita, inscrito, condi, condicionn,condicionnsisgen, id, idtipkar, idtipoacto, 
idcontratante, item, idcondicion, parte, porcentaje, repre, formulario, montoo, opago, fondos, montop 
FROM sisgen_intervenciones_6  where kardex='$kar'
GROUP BY repre ORDER BY repre ASC";

$resultado2=mysql_query($query2, $conn) or die("Personas Naturales no Encontradas"); 
		
		if(mysql_num_rows($resultado2) != 0 ) {
								$salida_xml .= "\t\t<PersonasNaturales>\n"; 
																 while($x2 = mysql_fetch_array($resultado2)){ 
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
																			
																			if($x2['email']==""){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t<Correo>" .trim($x2['email']). "</Correo>\n";}
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

$resultado3=mysql_query($query3, $conn) or die("Sin personas Juridicas"); 

	
			 if(mysql_num_rows($resultado3) != 0 ) {

								$salida_xml .= "\t\t<PersonasJuridicas>\n"; 


								 while($x3 = mysql_fetch_array($resultado3)){ 
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
														if($x3['correoemp']==""){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t\t<Correo>" .trim($x3['correoemp']). "</Correo>\n";} 
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
			 $resultadooo8=mysql_query($query8, $conn) or die("Sin Detalle de Bienes"); 
				if(mysql_num_rows($resultadooo8) != 0 ){	
					$salida_xml .= "\t\t<PrediosUrbanos>\n"; 
								while($xxv= mysql_fetch_array($resultadooo8)){ 

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

			 $resultadooo82=mysql_query($querybienveh, $conn) or die("Sin Vehiculo"); 

				 if(mysql_num_rows($resultadooo82) != 0 ) {

			$salida_xml .= "\t\t<Vehiculos>\n"; 
								 while($xxv= mysql_fetch_array($resultadooo82)){ 
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

$resultado4=mysql_query($query4, $conn) or die("Sin Vehiculo"); 
			 if(mysql_num_rows($resultado4) != 0 ) {

				$salida_xml .= "\t\t<Vehiculos>\n"; 
							while($x4 = mysql_fetch_array($resultado4)){ 
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

		 $resultadooo823=mysql_query($queryotros, $conn) or die("Sin Objeto otros"); 

				 if(mysql_num_rows($resultadooo823) != 0 ) {

			        $salida_xml .= "\t\t<OtrosObjetos>\n"; 


								 while($xxotros= mysql_fetch_array($resultadooo823)){ 

							$salida_xml .= "\t\t\t<OtroObjeto  id='". $xxotros['idbien'] ."'>\n"; 
								
								if($xxotros['oespecific']==""){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t<Descripcion>" . $xxotros['oespecific'] . "</Descripcion>\n";} 
								if($xxotros['tipo']==""){$salida_xml.="";}else{$salida_xml .= "\t\t\t\t<ClaseObjeto>" ."7" . "</ClaseObjeto>\n";} 
										
				
							 $salida_xml .= "\t\t\t</OtroObjeto>\n"; 

						 }
					$salida_xml .= "\t\t</OtrosObjetos>\n";
}


		$salida_xml .= "\t</Maestros>\n";

		
	 $salida_xml .= "\t<Operaciones>\n"; 

		
$resultadoDf=mysql_query($query5, $conn) or die("Sin Detalle medio pago"); 
//EMPIEZA MOD   
$resultadotPREDIO=mysql_query($query8, $conn) or die("sin resultado");    
$resultadotipppp22=mysql_query($querybienveh, $conn) or die("sin resultado");		
$resultadotiotros=mysql_query($queryotros, $conn) or die("sin resultado");				
$resultadoVEHICULO=mysql_query($query4, $conn) or die("sin resultado");
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

								 while($xxx3 = mysql_fetch_array($resultadoDf)){

										$iddddd=$xxx3['idmediop'];
								 }
									
									  
										
					
				// $salida_xml .= "\t\t\t<Operacion id='".$iddddd ."'>\n"; 
				
				$consultakardex ="SELECT idtipoacto, desacto, cod_ancert FROM tiposdeacto WHERE idtipoacto='$codActo62' and cod_ancert !='' ";
				$resultadokardex=mysql_query($consultakardex, $conn) or die("sin resultado");
				
				if(mysql_num_rows($resultadokardex) != 0 ) {								
							 while($kardcant= mysql_fetch_array($resultadokardex)){ 
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
						$prediokarde=mysql_query($prediokardex, $conn) or die("sin resultado");
						if(mysql_num_rows($prediokarde) != 0 ) {								
							 while($bienpredio= mysql_fetch_array($prediokarde)){ 
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
						$bienvehi2=mysql_query($bienvehi, $conn) or die("sin resultado");
						if(mysql_num_rows($bienvehi2) != 0 ) {								
							 while($xxv2= mysql_fetch_array($bienvehi2)){ 
							$salida_xml .="\t\t\t\t\t<Objeto>\n";
						 if($xxv2['idbien']=="" or $xxv2['idbien']==0 ){$salida_xml.="";}else{   $salida_xml .= "\t\t\t\t\t\t<IdMaestro>" . $xxv2['idbien']. "</IdMaestro>\n";}
							$salida_xml .="\t\t\t\t\t</Objeto>\n";
							}							
						 }
						 $otrospredios="SELECT   db.detbien AS idbien,  db.itemmp,  db.kardex,  db.idtipacto,  db.tipob ,  tb.codbien  AS tipo,  db.coddis,  db.fechaconst,  db.oespecific,  
							db.smaquiequipo,  tpsm, db.npsm,  db.pregistral AS pregistral,  db.idsedereg AS sederegistral 
							FROM detallebienes db, tipobien tb
							WHERE db.idtipbien=tb.idtipbien AND db.kardex='$kar' AND codbien =99 AND idtipacto ='$codigoacto'";
						$otrospredios2=mysql_query($otrospredios, $conn) or die("sin resultado");
						if(mysql_num_rows($otrospredios2) != 0 ) {								
							 while($xxv23= mysql_fetch_array($otrospredios2)){ 
							$salida_xml .="\t\t\t\t\t<Objeto>\n";
						 if($xxv23['idbien']=="" or $xxv23['idbien']==0 ){$salida_xml.="";}else{   $salida_xml .= "\t\t\t\t\t\t<IdMaestro>" . $xxv23['idbien']. "</IdMaestro>\n";}
							$salida_xml .="\t\t\t\t\t</Objeto>\n";
							}							
						 }		
						
						$prediokarde=mysql_query($prediokardex, $conn) or die("sin resultado");						 
						if(mysql_num_rows($resultadoVEHICULO) != 0 ) {								
							 while($iddd= mysql_fetch_array($resultadoVEHICULO)){ 
							$salida_xml .="\t\t\t\t\t<Objeto>\n";
						 if($iddd['idvehiculo']=="" or $iddd['idvehiculo']==0 ){$salida_xml.="";}else{   $salida_xml .= "\t\t\t\t\t\t<IdMaestro>" . $iddd['idvehiculo']. "</IdMaestro>\n";}
							$salida_xml .="\t\t\t\t\t</Objeto>\n";
							}							
						 }
							
						$salida_xml .="\t\t\t\t</Objetos>\n";
						//$salida_xml .= "\t\t\t\t\t<IdMaestro>". $iddd . "</IdMaestro>\n"; 
						
					 $sq_sujetos="
					 SELECT idcon, idcl, tipp, apepat, apemat, nom, nombre, direccion, tipodoc, numdoc, email, telfijo, telcel, telofi, gen, estc, natper, conyuge, nacionalidad, profesion, detaprofesion, cargo, profocupa, dirfer, idubigeo, fechanaci, fechaing, razonsocial, domfiscal, telempresa, correoemp, contacempresa, fechaconstitu, idsedereg, numregistro, numpartida, actmunicipal, tipocli, impeingre, impnumof, impeorigen, impentidad, impremite, impmotivo, residente, docpaisemi, kardex, firma, ffirma, resfirma, tiporepresentacion, idcontratanterp, facultades, indice, visita, inscrito, condi, condicionn, id, idtipkar, idtipoacto, idcontratante, item, idcondicion, parte, porcentaje, repre, formulario, montoo, opago, fondos, montop FROM sisgen_intervenciones_6 WHERE kardex ='$kar' AND idtipoacto ='$codigoacto' ";
							

							 $resultadoD=mysql_query($sq_sujetos, $conn) or die("sin resultado");   

						$sq_cuantiadeoperacion="SELECT idtipoacto AS tipacto, kardex,  importetrans , CONCAT('0',idmon)AS tipomon FROM patrimonial WHERE kardex ='$kar'
										AND idtipoacto ='$codigoacto'";	

							$tipoMoneda2 = mysql_query($sq_cuantiadeoperacion, $conn) or die("Sin Kardex Encontrados");
							 
							 while($tipoMon2 = mysql_fetch_array($tipoMoneda2)){ 
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
						
							$resultadoD11=mysql_query($sq_intervencion, $conn) or die("sin resultado");

								while($xxx11 = mysql_fetch_array($resultadoD11)){

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
							 while($xxx = mysql_fetch_array($resultadoD)){
								 
								 

									if($xxx['repre']!='R' and $xxx['repre']=='O' ){


							
							$salida_xml .= "\t\t\t\t\t\t\t\t<Sujeto>\n";


								 $salida_xml .= "\t\t\t\t\t\t\t\t\t<IdMaestro>" .  $xxx['idcl'] . "</IdMaestro>\n";
	//               $salida_xml .= "\t\t\t\t\t<TipoComparecencia>" . "" . "</TipoComparecencia>\n";
	 //              $salida_xml .= "\t\t\t\t\t<ClaseIntervencion>" . "" . "</ClaseIntervencion>\n";
		//             $salida_xml .= "\t\t\t\t\t<TipoAfectacion>" . "" . "</TipoAfectacion>\n";

								 //frankk

								 if($xxx['idtipoacto']=="1111"){
									 
								 }else{
								 
								 $salida_xml .= "\t\t\t\t\t\t\t\t\t<OrigenFondos>\n"; 
									$salida_xml .= "\t\t\t\t\t\t\t\t\t\t<OrigenFondo>\n";
										if($xxx['fondos']==""){$salida_xml.="";}else{  $salida_xml .= "\t\t\t\t\t\t\t\t\t\t\t<Origen>" .  substr($xxx['fondos'],0,40) . "</Origen>\n";}             
										if($xxx['montoo']==""){$salida_xml.="";}else{  $salida_xml .= "\t\t\t\t\t\t\t\t\t\t\t<CuantiaOrigen>" .trim(number_format($xxx['montoo'],2,".","")). "</CuantiaOrigen>\n";}  
										if($xxx['montoo']==""){$salida_xml.="";}else{ $salida_xml .= "\t\t\t\t\t\t\t\t\t\t\t<TipoMonedaPago>" . $tipoM2 . "</TipoMonedaPago>\n";} 
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
						$sql_renta1=mysql_query($query_renta1, $conn) or die("sin resultado"); 	
												
						while($row_renta1 = mysql_fetch_array($sql_renta1)){
							
							
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

 $resultadoD3=mysql_query($query91, $conn) or die("sin resultado3"); 

 
									$salida_xml .= "\t\t\t\t\t\t\t\t\t<Representantes>\n"; 
								 while($xxx1 = mysql_fetch_array($resultadoD3)){

								
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
						
								$resultadoD12=mysql_query($sq_intervencion, $conn) or die("sin resultado");



							 if(mysql_num_rows($resultadoD12)>=1) { 

					
							$salida_xml .= "\t\t\t\t\t\t<Intervencion>\n"; 


								
								while($xxx12 = mysql_fetch_array($resultadoD12)){

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


						$resultadoD2=mysql_query($sq_sujetos, $conn) or die("sin resultado");
						//--------

								$salida_xml .= "\t\t\t\t\t\t\t<Sujetos>\n";
							 while($xxx22 = mysql_fetch_array($resultadoD2)){

									
//apo
									if($xxx22['repre']!='R' and $xxx22['repre']=='B'){ 
							
							$salida_xml .= "\t\t\t\t\t\t\t\t<Sujeto>\n";

							
								 $salida_xml .= "\t\t\t\t\t\t\t\t\t<IdMaestro>" .  $xxx22['idcl'] . "</IdMaestro>\n";
	//               $salida_xml .= "\t\t\t\t\t<TipoComparecencia>" . "" . "</TipoComparecencia>\n";
	 //              $salida_xml .= "\t\t\t\t\t<ClaseIntervencion>" . "" . "</ClaseIntervencion>\n";
		//             $salida_xml .= "\t\t\t\t\t<TipoAfectacion>" . "" . "</TipoAfectacion>\n";

								 //frankk

								 if($xxx22['idtipoacto']=="1111"){
									 
								 }else{
								 
								$salida_xml .= "\t\t\t\t\t\t\t\t\t<OrigenFondos>\n";
								$salida_xml .= "\t\t\t\t\t\t\t\t\t\t<OrigenFondo>\n";								
										if($xxx22['fondos']==""){$salida_xml.="";}else{  $salida_xml .= "\t\t\t\t\t\t\t\t\t\t\t<Origen>" .  substr($xxx22['fondos'],0,40) . "</Origen>\n";}             
										if($xxx22['montoo']=="" ){$salida_xml.="";}else{  $salida_xml .= "\t\t\t\t\t\t\t\t\t\t\t<CuantiaOrigen>" . trim(number_format($xxx22['montoo'],2,".","")) . "</CuantiaOrigen>\n";}  
										if($xxx22['montoo']=="" ){$salida_xml.="";}else{  $salida_xml .= "\t\t\t\t\t\t\t\t\t\t\t<TipoMonedaPago>" . $tipoM2 . "</TipoMonedaPago>\n";}
									 
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
						$sql_renta=mysql_query($query_renta, $conn) or die("sin resultado"); 	
												
						while($row_renta = mysql_fetch_array($sql_renta)){
							
							
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
									 $resultadoD3=mysql_query($query91, $conn) or die("sin resultado 2");    
								
								$salida_xml .= "\t\t\t\t\t\t\t\t\t<Representantes>\n";
								
								 while($xxx223 = mysql_fetch_array($resultadoD3)){

								
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
					
					
					

					$resultado15=mysql_query($sq_cuantiadeoperacion, $conn) or die("sin resultado"); 
					
					
						while($x15 = mysql_fetch_array($resultado15)){ 
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
	
					
					 $resultado5=mysql_query($sq_mediosdepago, $conn) or die("sin resultado"); 

						$salida_xml .= "\t\t\t\t<MediosPagos>\n";
						//mediopago
						 while($x5 = mysql_fetch_array($resultado5)){ 
						 

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
			 $resultado6=mysql_query($querymediopago, $conn) or die("sin resultado"); 
			 while($x6 = mysql_fetch_array($resultado6)){ 
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

								 while($xxx3 = mysql_fetch_array($resultadoDf)){

										$iddddd=$xxx3['idmediop'];
										
								 }
									
									    
																			
					
				// $salida_xml .= "\t\t\t<Operacion id='".$iddddd ."'>\n"; 
				   if($iddddd==""){$salida_xml.="\t\t\t<Operacion id='001'>\n";}else{$salida_xml.="\t\t\t<Operacion id='".$iddddd ."'>\n";}



					if($x['codactos']=="" or $x['codactos']==0 ){$salida_xml.="";}else{   $salida_xml .= "\t\t\t\t<CodActoJuridico>" . $x['ancert']. "</CodActoJuridico>\n";}  
				 
					$salida_xml .= "\t\t\t<Operantes>\n"; 
						$salida_xml .="\t\t\t\t<Objetos>\n";
						
						
						if(mysql_num_rows($resultadotPREDIO) != 0 ) {								
							 while($xxv= mysql_fetch_array($resultadotPREDIO)){ 
							$salida_xml .="\t\t\t\t\t<Objeto>\n";
						 if($xxv['idbien']=="" or $xxv['idbien']==0 ){$salida_xml.="";}else{   $salida_xml .= "\t\t\t\t\t\t<IdMaestro>" . $xxv['idbien']. "</IdMaestro>\n";}
							if($xxv['fechaconst']=="" or $xxv['fechaconst']==0 ){$salida_xml.="";}else{ $salida_xml.="\t\t\t\t\t\t<DetalleObjeto>\n" ;}
							if($xxv['fechaconst']=="" or $xxv['fechaconst']==0 ){$salida_xml.="";}else{  $salida_xml .= "\t\t\t\t\t\t\t<FechaAdquisicion>" .fdate($xxv['fechaconst']). "</FechaAdquisicion>\n";}
							if($xxv['fechaconst']=="" or $xxv['fechaconst']==0 ){$salida_xml.="";}else{ $salida_xml.="\t\t\t\t\t\t</DetalleObjeto>\n"; }
						 
							$salida_xml .="\t\t\t\t\t</Objeto>\n";
							}							
						 }
						if(mysql_num_rows($resultadotipppp22) != 0 ) {								
							 while($xxv2= mysql_fetch_array($resultadotipppp22)){ 
							$salida_xml .="\t\t\t\t\t<Objeto>\n";
						 if($xxv2['idbien']=="" or $xxv2['idbien']==0 ){$salida_xml.="";}else{   $salida_xml .= "\t\t\t\t\t\t<IdMaestro>" . $xxv2['idbien']. "</IdMaestro>\n";}
							$salida_xml .="\t\t\t\t\t</Objeto>\n";
							}							
						 }
						if(mysql_num_rows($resultadotiotros) != 0 ) {								
							 while($xxv23= mysql_fetch_array($resultadotiotros)){ 
							$salida_xml .="\t\t\t\t\t<Objeto>\n";
						 if($xxv23['idbien']=="" or $xxv23['idbien']==0 ){$salida_xml.="";}else{   $salida_xml .= "\t\t\t\t\t\t<IdMaestro>" . $xxv23['idbien']. "</IdMaestro>\n";}
							$salida_xml .="\t\t\t\t\t</Objeto>\n";
							}							
						 }						 
						if(mysql_num_rows($resultadoVEHICULO) != 0 ) {								
							 while($iddd= mysql_fetch_array($resultadoVEHICULO)){ 
							$salida_xml .="\t\t\t\t\t<Objeto>\n";
						 if($iddd['idvehiculo']=="" or $iddd['idvehiculo']==0 ){$salida_xml.="";}else{   $salida_xml .= "\t\t\t\t\t\t<IdMaestro>" . $iddd['idvehiculo']. "</IdMaestro>\n";}
							$salida_xml .="\t\t\t\t\t</Objeto>\n";
							}							
						 }
							
						$salida_xml .="\t\t\t\t</Objetos>\n";
						//$salida_xml .= "\t\t\t\t\t<IdMaestro>". $iddd . "</IdMaestro>\n";       
					 
							

							 $resultadoD=mysql_query($query6, $conn) or die("sin resultado");    
								
						$salida_xml .=	"\t\t\t\t\t<Intervenciones>\n";
						
						


						
							$resultadoD11=mysql_query($query11, $conn) or die("sin resultado");
							
							
							
								while($xxx11 = mysql_fetch_array($resultadoD11)){
								
								
									if($xxx11['repre']!='R' and $xxx11['repre']=='O' ){
									$salida_xml .= "\t\t\t\t\t\t<Intervencion>\n"; 
							$salida_xml .= "\t\t\t\t\t\t\t<TipoIntervencion>" .$xxx11['parte']  . "</TipoIntervencion>\n";
							$salida_xml .= "\t\t\t\t\t\t\t<DescripcionIntervencion>" .$xxx11['condicionnsisgen']. "</DescripcionIntervencion>\n";
							$salida_xml .= "\t\t\t\t\t\t\t<RolRepresentante>" .$xxx11['repre']. "</RolRepresentante>\n";
						
							 /* while($xxx = mysql_fetch_array($resultadoD)){

									if($xxx['repre']!='R' and $xxx['condicionn']=='VENDEDOR' ){  
								 
								*/

									
								
							 $salida_xml .= "\t\t\t\t\t\t<Sujetos>\n";
							 while($xxx = mysql_fetch_array($resultadoD)){
								 
								 

																		if($xxx['repre']!='R' and $xxx['repre']=='O' ){


																
																$salida_xml .= "\t\t\t\t\t\t\t<Sujeto>\n";


																	 $salida_xml .= "\t\t\t\t\t\t\t\t<IdMaestro>" .  $xxx['idcl'] . "</IdMaestro>\n";
										//               $salida_xml .= "\t\t\t\t\t<TipoComparecencia>" . "" . "</TipoComparecencia>\n";
										 //              $salida_xml .= "\t\t\t\t\t<ClaseIntervencion>" . "" . "</ClaseIntervencion>\n";
											//             $salida_xml .= "\t\t\t\t\t<TipoAfectacion>" . "" . "</TipoAfectacion>\n";

																	 //frankk

																	 if($xxx['idtipoacto']=="1111" or $xxx['idtipoacto']=="067"  ){
																		 
																	 }else{
																		 
																	 if($xxx['fondos']!="" or $xxx['montoo']!=""){
																		 
																		 $salida_xml .= "\t\t\t\t\t\t\t\t<OrigenFondos>\n"; 
																			$salida_xml .= "\t\t\t\t\t\t\t\t\t<OrigenFondo>\n";
																				if($xxx['fondos']==""){$salida_xml.="";}else{  $salida_xml .= "\t\t\t\t\t\t\t\t\t\t<Origen>" . substr($xxx['fondos'],0,40) . "</Origen>\n";}            
																				if($xxx['montoo']==""){$salida_xml.="";}else{  $salida_xml .= "\t\t\t\t\t\t\t\t\t\t<CuantiaOrigen>" . trim(number_format($xxx['montoo'],2,".","")) . "</CuantiaOrigen>\n";}
																				if($xxx['montoo']=="" or $tipoM=="00"){$salida_xml.="";}else{ $salida_xml .= "\t\t\t\t\t\t\t\t\t\t<TipoMonedaPago>" . $tipoM . "</TipoMonedaPago>\n";}
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
												  $query_renta1="SELECT r.pregu1 ,r.pregu2,r.pregu3  FROM renta r
																		where r.kardex='".$xxx['kardex']."' AND r.`idcontratante`='".$xxx['idcontratante']."'
																		GROUP BY idcontratante";
															$sql_renta1=mysql_query($query_renta1, $conn) or die("sin resultado"); 	
																					
															while($row_renta1 = mysql_fetch_array($sql_renta1)){
																
																
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
															 
										if($xxx['repre']=='O'){

																		$reppp=$xxx['idcon'];

																		$query91="SELECT idcon, idcl, tipp, apepat, apemat, nom, nombre, direccion, tipodoc, numdoc, email, telfijo, telcel, 
telofi, gen, estc, natper, conyuge, nacionalidad, profesion, detaprofesion, cargo, profocupa, dirfer, 
idubigeo, fechanaci, fechaing, razonsocial, domfiscal, telempresa, correoemp, contacempresa, fechaconstitu, 
idsedereg, numregistro, numpartida, actmunicipal, tipocli, impeingre, impnumof, impeorigen, impentidad, 
impremite, impmotivo, residente, docpaisemi, kardex, firma, STR_TO_DATE(ffirma,'%d/%m/%Y') AS ffirma, resfirma, tiporepresentacion, 
idcontratanterp, facultades, indice, visita, inscrito, condi, condicionn,condicionnsisgen, id, idtipkar, idtipoacto, 
idcontratante, item, idcondicion, parte, porcentaje, repre, formulario, montoo, opago, fondos, montop 
FROM sisgen_intervenciones_6  WHERE repre ='R' AND kardex='$kar' AND idcontratanterp ='$reppp'";
									 $resultadoD3=mysql_query($query91, $conn) or die("sin resultado"); 
									 
																		$salida_xml .= "\t\t\t\t\t\t\t\t<Representantes>\n"; 
																	 while($xxx1 = mysql_fetch_array($resultadoD3)){

																	
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
								$resultadoD12=mysql_query($query11, $conn) or die("sin resultado");



							 if(mysql_num_rows($resultadoD12)>=1) { 

					
							


								
								while($xxx12 = mysql_fetch_array($resultadoD12)){

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
						

									


						$resultadoD2=mysql_query($query6, $conn) or die("sin resultado");
						//--------

								$salida_xml .= "\t\t\t\t\t\t<Sujetos>\n";
							 while($xxx22 = mysql_fetch_array($resultadoD2)){

									
//apo
									if($xxx22['repre']!='R' and $xxx22['repre']=='B'){ 
							
							$salida_xml .= "\t\t\t\t\t\t\t<Sujeto>\n";

							
								 $salida_xml .= "\t\t\t\t\t\t\t\t<IdMaestro>" .  $xxx22['idcl'] . "</IdMaestro>\n";
	//               $salida_xml .= "\t\t\t\t\t<TipoComparecencia>" . "" . "</TipoComparecencia>\n";
	 //              $salida_xml .= "\t\t\t\t\t<ClaseIntervencion>" . "" . "</ClaseIntervencion>\n";
		//             $salida_xml .= "\t\t\t\t\t<TipoAfectacion>" . "" . "</TipoAfectacion>\n";

								 //frankk

								 if($xxx22['idtipoacto']=="1111" or $xxx22['idtipoacto']=="067" ){
									 
								 }else{
								
								if($xxx22['fondos']!="" or $xxx22['montoo']!=""){ 
								$salida_xml .= "\t\t\t\t\t\t\t\t<OrigenFondos>\n";
								$salida_xml .= "\t\t\t\t\t\t\t\t\t<OrigenFondo>\n";								
										if($xxx22['fondos']==""){$salida_xml.="";}else{  $salida_xml .= "\t\t\t\t\t\t\t\t\t\t<Origen>" . substr($xxx22['fondos'],0,40) . "</Origen>\n";}             
										if($xxx22['montoo']=="" ){$salida_xml.="";}else{  $salida_xml .= "\t\t\t\t\t\t\t\t\t\t<CuantiaOrigen>" .trim(number_format($xxx22['montoo'],2,".","")) . "</CuantiaOrigen>\n";}
										if($xxx22['montoo']=="" or $tipoM=="00" ){$salida_xml.="";}else{  $salida_xml .= "\t\t\t\t\t\t\t\t\t\t<TipoMonedaPago>" . $tipoM . "</TipoMonedaPago>\n";}
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
						$sql_renta=mysql_query($query_renta, $conn) or die("sin resultado"); 	
												
						while($row_renta = mysql_fetch_array($sql_renta)){
							
							
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
								 $resultadoD3=mysql_query($query91, $conn) or die("sin resultado");    
								
								$salida_xml .= "\t\t\t\t\t\t\t\t<Representantes>\n";
								
								 while($xxx223 = mysql_fetch_array($resultadoD3)){

								
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
					

					$resultado15=mysql_query($queryCuantia, $conn) or die("sin resultado"); 
					
					
						while($x15 = mysql_fetch_array($resultado15)){ 
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

					
					 $resultado5=mysql_query($query51, $conn) or die("sin resultado"); 

						$salida_xml .= "\t\t\t\t<MediosPagos>\n";
						//mediopago
						 while($x5 = mysql_fetch_array($resultado5)){ 
						 

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
			 $resultado6=mysql_query($querymediopago, $conn) or die("sin resultado"); 
			 while($x6 = mysql_fetch_array($resultado6)){ 
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


	$crearxml = fopen("text.xml", "w+");
	fwrite($crearxml,$salida);
	fclose($crearxml);
	
	$crearxml2 = fopen("ArchivosEnviados/ArchivosXML/XMLTEXT_".date("d-m-Y H-i-s",time()).".xml", "w+");
	fwrite($crearxml2,$salida);
	fclose($crearxml2);
	
	mysql_close();
/*$envio_correcto ='Se Genero el Archivo Correctamente..!';
echo $envio_correcto;*/

echo "<p style='font-size:15px;'>... Se Genero el Archivo Correctamente..!  <a href='text.xml' download='text.xml'>aqui</a></p>"



/*
$envio_correcto ='Se Genero el Archivo Correctamente..!';
echo $envio_correcto;
$xmlobj=new SimpleXMLElement($salida_xml); 
$xmlobj->asXML("text.xml");*/


?>
<!--
<form>
<input type="button" value="Enviar SISGEN" onclick="location.href='prueba6.php'">
</form>
-->