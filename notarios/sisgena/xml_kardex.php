<?php
// Esto le dice a PHP que usaremos cadenas UTF-8 hasta el final
mb_internal_encoding('UTF-8'); 
// Esto le dice a PHP que generaremos cadenas UTF-8
mb_http_output('UTF-8');
$salida_xml="";
function fdate($mifecha){
	$var = str_replace('/', '-', $mifecha);
	return date('Y-m-d', strtotime($var));
}

function validarStringJuridica($dato){
	$result =  preg_match('/\s\s/', $dato);
	$result +=  preg_match('/\t/', $dato);
	$result +=  preg_match('/\</', $dato);
	$result +=  preg_match('/\>/', $dato);
	$info=trim($dato," \t.");
	return array($result,$info);
}
function validarString($dato){
	//$info = str_replace('<','&lt;',$dato);
	//$info = str_replace('>','&gt;',$info);

	$info=trim($dato," \t.");
	return $info;
}
function ValidarTamano($nombre,$tamano,$dato,$mintamano)
{
	$err = 0;
	$errormensaje = '';
	if(strlen($dato)>$tamano){
		$caracteres = strlen($dato - $tamano);
		$errormensaje = $nombre." tiene que tener un máximo de ".$tamano." caracteres(Hay ".$caracteres." caracteres de mas)";
		$err = 1;
	}else if (strlen($dato)<$mintamano and $mintamano>0 and $dato!=""){
		$errormensaje = $nombre." tiene que tener mínimo ".$mintamano." caracteres";
		$err = 1;
	} 
    return array($err,$errormensaje);
}
function ValidarIsTelefono($dato)
{
	$err = 0;
	$errormensaje = '';
	$valor = str_replace('-','',str_replace(')','',str_replace('(','',$dato)));
	if(!is_numeric($valor)){
		$err = 1;
		$errormensaje = 'el numero de telefono es incorrecto';
	}
    return array($err,$errormensaje);
}
function ValidarVacio($nombre,$dato,$importante,$tamano)
{
	$err = 0;
	$errormensaje = '';

	if($dato=='' or $dato==null ){
		if ($importante ==1 ){
			$err = 1;
			$errormensaje ='Falta '.$nombre;
		}
	}else{
		if(strlen($dato)>$tamano and $tamano>0){
			$caracteres = strlen($dato - $tamano);
			$errormensaje = $nombre." tiene que tener un máximo de ".$tamano." caracteres(Hay ".$caracteres." caracteres de mas)";
			$err = 1;
		}
	}
    return array($err,$errormensaje);
}
function ValidarDocumento($tipo,$documento,$persona,$tipoInstrumento)
{
	$err = 0;
	$errormensaje = '';
	if($tipoInstrumento == '2'){
		return array($err,$errormensaje);
	}
	if($tipo == '' and $documento!=''){
		$err = 1;
		$errormensaje = 'Falta el tipo de documento';
	}else if($tipo != '' and $documento ==''){
		if($tipo != 10){
			$err = 1;
			$errormensaje = 'Falta el numero de documento';
		}
	}else {
		if($persona=='J'){
			if($tipo!='10' && $tipo != '08'){
				$err = 1;
				$errormensaje = 'Tipo de documento no corresponde';
			}
		}
	}
    return array($err,$errormensaje);
}
function ValidarSede($dato)
{
	$err = 0;
	$errormensaje = '';
	if(intval($dato)<1 && intval($dato)<14 ){
		$errormensaje = "Sede Registral incorrecta";
		$err = 1;
	}
    return array($err,$errormensaje);
}
function ValidarMoneda($dato,$acto)
{
	$err = 0;
	$errormensaje = '';
	if(intval($dato)<1 && intval($dato)<4 && $acto!='0301' && $acto!='0302' && $acto!='0303' && $acto!='0310'){
		$errormensaje = "Tipo de moneda incorrecta";
		$err = 1;
	}
    return array($err,$errormensaje);
}
function validarUIFSUNAT($cod){
	$actosNOUIFSUNAT = array("0229","0511","0601","0602","0603"
	,"0604","0605","0606","0607","0608","0701","0703","0704","0705"
	,"0706","0806","0810","0907","0908","0910","0912","0913","0914"
	,"0915","0916","0917","0919","0920");

	if (!in_array($cod,$actosNOUIFSUNAT))
		return 1;
	else
		return 0;
}
function PersonaNatural($x2){
	$persona = "";
	$arrKarObsPersona = array();
	$arrKarPersonal = array();
	$f=$x2['tipp'];
	if($x2['gen']=='M'){
			$ge='V';
	}else{
			$ge='M';
	}
	if($f=='N'){
		//PERSONA NATURAL
		$nombrecompleto = $x2['nom'].' '.$x2['apepat'].' '.$x2['apemat'];
		$resultJuridica = validarStringJuridica($xnombrecompleto);
		if($resultJuridica[0]>0){
			array_push($arrKarPersonal,$nombrecompleto.'->Nombre tiene caracteres no permitidos');
		}	
		$persona .= "\t\t\t<PersonaNatural id='".$x2['id']."'>\n"; 
		$persona .="\t\t\t<DocsIdentificativos>\n";
			$persona .= "\t\t\t\t<DocIdentificativo>\n"; 
					$resulValida = ValidarDocumento($x2['tipodoc'],$x2['numdoc'],'N',$tipoInstrumento);
					if($resulValida[0]==1){
						array_push($arrKarPersonal,$nombrecompleto.'->'.$resulValida[1]);
					} 
					if($x2['tipodoc']!=""){$persona .= "\t\t\t\t\t<TipoDocIdentidad>" .trim($x2['tipodoc']). "</TipoDocIdentidad>\n";}  
					if($x2['numdoc']!=""){$persona .= "\t\t\t\t\t<NumDocIdentificativo>" .trim($x2['numdoc']). "</NumDocIdentificativo>\n";}  
			$persona .= "\t\t\t\t</DocIdentificativo>\n";
		$persona .="\t\t\t</DocsIdentificativos>\n";

		if($x2['nom']!=""){					
			$persona .= "\t\t\t\t<Nombre>" .validarString($x2['nom']). "</Nombre>\n";
		}  
		if($x2['apepat']!=""){
			$persona .= "\t\t\t\t<PrimerApellido>" .validarString($x2['apepat']). "</PrimerApellido>\n";
		}  
		if($x2['apemat']!=""){$persona .= "\t\t\t\t<SegundoApellido>" .validarString($x2['apemat']). "</SegundoApellido>\n";} 
		if($x2['gen']!=""){$persona .= "\t\t\t\t<Genero>" .$ge. "</Genero>\n";}  
		if($x2['estc']=="" or $x2['estc']==0){
			array_push($arrKarObsPersona,$nombrecompleto.'->Falta estado civil');
		}else{
			$persona .= "\t\t\t\t<EstadoCivil>" .$x2['estc']. "</EstadoCivil>\n";
		}  
		if($x2['conyuge']!=""){
			$persona .= "\t\t\t\t<Conyuge>" .$x2['conyuge']. "</Conyuge>\n";
		}
		if($x2['nacionalidad']==""){
			array_push($arrKarObsPersona,$nombrecompleto.'->Falta nacionalidad');
		}else{
			$persona .= "\t\t\t\t<PaisNacionalidad>" .$x2['nacionalidad']. "</PaisNacionalidad>\n";
		}
		
		if($x2['fechanaci']==""){
			array_push($arrKarObsPersona,$nombrecompleto.'->Falta fecha de nacimiento');
		}else{
			$persona .= "\t\t\t\t<FechaNacimiento>" .fdate($x2['fechanaci']). "</FechaNacimiento>\n";
		}
		if($x2['profesion']!="" and $x2['profesion']!=0){
			$persona .= "\t\t\t\t<Profesion>" .$x2['profesion']. "</Profesion>\n";
		}else{
			array_push($arrKarObsPersona,$nombrecompleto.'->Falta profesion');
		}
		if($x2['cargo']=="" or $x2['cargo']==0){$persona.="";}else{$persona .= "\t\t\t\t<Cargo>" .$x2['cargo']. "</Cargo>\n";}
		if($x2['profesion']!="000" && $x2['profesion']!="" && $x2['profesion']=="999"){
			if($x2['detaprofesion']==""){$persona.="\t\t\t\t<OtraProfesion>OTROS</OtraProfesion>\n";}else{$persona .= "\t\t\t\t<OtraProfesion>" .mb_substr(str_replace(")","",str_replace("(","",str_replace("  "," ",str_replace("/","",trim(str_replace("  "," ",($x2['detaprofesion']))))))),0,50). "</OtraProfesion>\n";}
		}
		if($x2['cargo']!="000" && $x2['cargo']!="" && $x2['cargo']=="999"){
			if($x2['profocupa']==""){$persona.="\t\t\t\t<OtroCargo>OTROS</OtroCargo>\n";}else{$persona .= "\t\t\t\t<OtroCargo>" .mb_substr(str_replace(")","",str_replace("(","",str_replace("  "," ",str_replace("/","",trim(str_replace("  "," ",($x2['profocupa']))))))),0,50). "</OtroCargo>\n";}
		}
		if($x2['email']=="" || !filter_var($x2['email'], FILTER_VALIDATE_EMAIL)){
			$persona .= "";
		}else{
			$persona .= "\t\t\t\t<Correo>" .trim($x2['email']). "</Correo>\n";
		}
		if($x2['telcel']==""){
			$persona.="";
		}
		else{
			$resulValidaIsTelefono = ValidarIsTelefono($x2['telcel']);
			if($resulValidaIsTelefono[0]==1){
				array_push($arrKarPersonal,$nombrecompleto.'->'.$resulValidaIsTelefono[1]);
			}
			$resulValida = ValidarTamano('Telefono',20,$x2['telcel']);
			if($resulValida[0]==1){
				array_push($arrKarPersonal,$nombrecompleto.'->'.$resulValida[1]);
			}
			$persona .= "\t\t\t\t<Telefono>".trim(mb_substr($x2['telcel'],0,20)). "</Telefono>\n";
		}
		if($x2['departamento']!="" and $x2['provincia']!="" and $x2['distrito']!="" and $x2['direccion']!=""){
			$persona .= "\t\t\t\t<Direccion>\n";
			if($x2['residente']==""){$persona.="";}else{$persona .= "\t\t\t\t\t<ResidePeru>" .$x2['residente']. "</ResidePeru>\n";}
			if($x2['nacionalidad']==""){$persona.="";}else{$persona .= "\t\t\t\t\t<PaisResidencia>" .$x2['nacionalidad']. "</PaisResidencia>\n";}
			$persona .= "\t\t\t\t<DireccionNacional>\n";
			if($x2['departamento']==""){$persona.="";}else{$persona .= "\t\t\t\t\t<CodDepartamento>" .$x2['departamento']. "</CodDepartamento>\n";}
			if($x2['provincia']==""){$persona.="";}else{$persona .= "\t\t\t\t\t<CodProvincia>" .$x2['provincia']. "</CodProvincia>\n";}
			if($x2['distrito']==""){$persona.="";}else{$persona .= "\t\t\t\t\t<CodDistrito>" .$x2['distrito']. "</CodDistrito>\n";}
			if($x2['direccion']==""){$persona.="";}
			else{
				$resultJuridica = validarStringJuridica($x2['direccion']);
				if($resultJuridica[0]>0){
					array_push($arrKarPersonal,$nombrecompleto.'->Direccion tiene caracteres no permitidos');
				}	
				$persona .= "\t\t\t\t\t<RestoDireccion>" .mb_substr($x2['direccion'],0,255). "</RestoDireccion>\n";
			}
			$persona .= "\t\t\t\t</DireccionNacional>\n";
			$persona .= "\t\t\t\t</Direccion>\n";
		}
		$persona .= "\t\t\t</PersonaNatural>\n"; 
	}

	return array($persona,
				$arrKarPersonal,
				$arrKarObsPersona);
}

function kardexml($conn,$tipoInstrumento,$Kardex,$idKardex){
	$salida_kardex_error = '';
	$errorListKar = array();
	$errorListKarObs = array();
	$escritura_old = 0;
	$arrPersonasErr = array();
	$arrConyuge = array();
	$arrPersonasEnKardex = array();
	$simpleKardex = 0;

	$query = "SELECT idkardex,kardex,idtipkar as tipokardex,
	fecha_ingreso,codactos,contrato,folioini,foliofin,fecha_conclusion as fechaconclusion,
	numescritura,fechaescritura, cod_ancert as ancert FROM sisgen_temp";
	if($Kardex!=""){
		$query .=  " WHERE kardex = '$Kardex' and idkardex = '$idKardex'";
		$simpleKardex = 1;
	}
	$resultado = mysqli_query($conn,$query) or die("Sin Kardex Encontrados."); 
	$querynor = "SELECT idnotar,nombre,apellido ,telefono,correo,ruc,direccion,distrito,codnotario FROM confinotario";
	$resultadonor = mysqli_query($conn,$querynor) or die("Sin datos del notario."); 
	$nor = mysqli_fetch_array($resultadonor);
	$xnor = $nor['ruc'];
	$xnor2 = $nor['codnotario'];
	$distrito = $nor['distrito'];
	while($x = mysqli_fetch_array($resultado)){ 
		$arrKar = array();
		$arrKarObs = array();
		$d=$x['numescritura']; if($d<>""){ $e=$x['numescritura'];} else{$e="";}
		$d1=$x['fechaescritura']; if($d1<>""){ $e1=$x['fechaescritura'];} else{$e1="";}	
		$folio=$x['foliofin']-$x['folioini']+1;
		$salida_kardex_documento = "\t<DocumentoNotarial>\n"; 
		$salida_kardex_documento .= "\t<Documento>\n"; 
		$salida_kardex_documento .= "\t\t<CodNotario>" .trim($xnor2). "</CodNotario>\n"; 
		$salida_kardex_documento .= "\t\t<CodNotaria>" .trim($xnor). "</CodNotaria>\n";
		$salida_kardex_documento .= "\t\t<NumKardex>" . $x['kardex'] . "</NumKardex>\n";
		$salida_kardex_documento .= "\t\t<FechaIngreso>" .  fdate($x['fecha_ingreso']) . "</FechaIngreso>\n";
		$salida_kardex_documento .= "\t\t<TipoInstrumento>" . $x['tipokardex'] . "</TipoInstrumento>\n";
		$salida_kardex_documento .= "\t\t<NumDocumento>" . $e . "</NumDocumento>\n";		
		$salida_kardex_documento .= "\t\t<FechaInstrumento>" .  $e1 . "</FechaInstrumento>\n";
		if($folio<=0){
			$salida_kardex_documento .= "\t\t<NumFolios>" . "1" . "</NumFolios>\n";}
		else if ($folio<=99999 && $folio>0){
			$salida_kardex_documento .= "\t\t<NumFolios>" . $folio . "</NumFolios>\n";
		} 	
		else{ 
			array_push($arrKar,'Numero de folio incorrecto');
		}
		if($x['fechaconclusion'] != null ){$salida_kardex_documento .= "\t\t<FechaConclusion>" .fdate($x['fechaconclusion']) . "</FechaConclusion>\n";}else{$salida_kardex_documento .= ""; }
		$salida_kardex_documento .= "\t</Documento>\n";
		$kar=$x['kardex'];
		$idkar=$x['idkardex'];
		if($escritura_old == $e ){
			array_push($errorListKar, array('idkardex'=>$idkar,'kardex'=>$kar,'acto'=>'General','error'=>array('Escritura repetida, por favor revise su base de datos') ));
			//$salida_kardex_documento .= "\t</DocumentoNotarial>\n";
			//$salida_kardex_error .=$salida_kardex_documento;
			//continue;
		}
		$escritura_old = $e;	
		$salida_kardex = $salida_kardex_documento;
		$salida_kardex .= "\t<Maestros>\n"; 		
		$tienerror = 0;
		//QUERY PARA PERSONAS SIN CONDICION
		$querySinCondicion = "SELECT ct.idcontratante,ct.kardex,c2.nombre,c2.razonsocial,ca.parte,ca.uif FROM contratantes ct
		LEFT JOIN contratantesxacto ca ON ca.`idcontratante` = ct.idcontratante
		LEFT JOIN cliente2 c2 ON c2.idcontratante = ct.idcontratante
		WHERE ct.kardex = '$kar' AND (ISNULL(ca.uif) OR ca.uif = '')";
		$conSinCondicion = mysqli_query( $conn,$querySinCondicion) or die("Consulta de participantes sin condicion");
		$arraySinCondicion = array();
		while($sinCon = mysqli_fetch_array($conSinCondicion)){ 
			$nombreSinCondicion = $sinCon['razonsocial']==null?$sinCon['nombre']:$sinCon['razonsocial'];
			array_push($arraySinCondicion,'Falta condición a '.$nombreSinCondicion);
		}
		if(count($arraySinCondicion)>0){
			array_push($errorListKar, array('idkardex'=>$idkar,'kardex'=>$kar,'acto'=>'General','error'=>$arraySinCondicion));
		}


		//QUERY PARA PERSONAS NATURALES
		$query2 ="SELECT idcontratante, id, tipp, apepat, apemat, nom, nombre, direccion, idtipdoc, numdoc, email, 
		telfijo, telcel, telofi, gen, estc, natper, conyuge, naci, idprofesion, detaprofesion, idcargoprofe, 
		profocupa, dirfer, idubigeo, fechanaci, residente, distrito, provincia, departamento, tipodoc, 
		profesion, nacionalidad, cargo, ROLUIF FROM sisgen_temp_n WHERE kardex='$kar' GROUP BY idcliente";
	
		//QUERY PARA PERSONAS JURIDICAS
		$query3 = "SELECT idcontratante, id, tipp, tipodoc, numdoc, 
		idubigeo, razonsocial, domfiscal, telempresa, correoemp, objeto, fechaconstitu, sedereg, numregistro, 
		numpartidareg, actmunicipal, residente, docpaisemi, idtipkar, kardex, condi, firma, fechafirma, resfirma, 
		tiporepresentacion, idcontratanterp, idsedereg, numpartida, facultades, inscrito, distrito, provincia, 
		departamento, ciuu,profesion, nacionalidad, ROUIF FROM sisgen_temp_j WHERE kardex='$kar' GROUP BY idcliente";

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
	
		$querymediopago = "SELECT DISTINCT  pa.nminuta AS fechaminuta
		FROM detallemediopago dm 
		LEFT OUTER JOIN patrimonial pa 
		ON dm.kardex=pa.kardex
		WHERE dm.kardex='$kar' GROUP BY dm.tipacto";

		$query4 = "SELECT   detveh as idvehiculo,  kardex,  idtipacto,  idplaca,  numplaca,  clase,  marca,  anofab,  modelo,  combustible,  carroceria,
		fecinsc,  color,  motor,  numcil,  numserie,  numrueda,  idmon,  precio,  codmepag,  pregistral,  idsedereg
		FROM detallevehicular 
		WHERE kardex='$kar' ";

		$query6 = "SELECT idcon, idcl, tipp, apepat, apemat, nom, nombre, direccion, tipodoc, numdoc, email, 
		telfijo, telcel, telofi, gen, estc, natper, conyuge, nacionalidad, profesion, detaprofesion, cargo, profocupa, 
		dirfer, idubigeo, fechanaci, fechaing, razonsocial, domfiscal, telempresa, correoemp, contacempresa, fechaconstitu, 
		idsedereg, numregistro, numpartida, actmunicipal, tipocli, impeingre, impnumof, impeorigen, impentidad, impremite, 
		impmotivo, residente, docpaisemi, kardex, firma, ffirma, resfirma, tiporepresentacion, idcontratanterp, facultades, 
		indice, visita, inscrito, condi, condicionn, id, idtipkar, idtipoacto, idcontratante, item, idcondicion, parte, 
		porcentaje, repre, formulario, montoo, opago, fondos, montop FROM sisgen_intervenciones_6 WHERE kardex ='$kar'";

		$query7 = "SELECT   id,  idtipkar,  kardex,  idtipoacto,  idcontratante,  item,  idcondicion,  parte,  porcentaje,
		uif,  formulario,  monto,  opago,  ofondo,  montop
		FROM contratantesxacto WHERE kardex='$kar'";


		$query8 = "SELECT   db.detbien AS idbien,  db.itemmp,  db.kardex,  db.idtipacto,  db.tipob ,  tb.codbien  AS tipo,  
					db.coddis,  db.fechaconst,  db.oespecific,  
					db.smaquiequipo,  tpsm, db.npsm,  db.pregistral AS pregistral,  db.idsedereg AS sederegistral, 
					u.coddist AS distrito,u.codprov AS provincia,u.codpto AS departamento
					FROM detallebienes db
					LEFT JOIN tipobien tb ON tb.idtipbien = db.idtipbien
					LEFT JOIN ubigeo u ON u.coddis = db.coddis
					WHERE db.kardex='$kar' and codbien ='04' " ;

		$querybienveh="SELECT   db.detbien AS idbien,  db.itemmp,  db.kardex,  db.idtipacto,  db.tipob ,  tb.codbien  AS tipo,  db.coddis,  db.fechaconst,  db.oespecific,  
		db.smaquiequipo,  tpsm, db.npsm,  db.pregistral AS pregistral,  db.idsedereg AS sederegistral 
		FROM detallebienes db, tipobien tb
		WHERE db.idtipbien=tb.idtipbien AND db.kardex='$kar' and codbien =09";

		$queryotros="SELECT   db.detbien AS idbien,  db.itemmp,  db.kardex,  db.idtipacto,  db.tipob ,  tb.codbien  AS tipo,  db.coddis,  db.fechaconst,  db.oespecific,  
		db.smaquiequipo,  tpsm, db.npsm,  db.pregistral AS pregistral,  db.idsedereg AS sederegistral 
		FROM detallebienes db, tipobien tb
		WHERE db.idtipbien=tb.idtipbien AND db.kardex='$kar' AND codbien =99";

		/*$query11 = "SELECT idcon, idcl, tipp, apepat, apemat, nom, nombre, direccion, tipodoc, numdoc, email, telfijo, telcel, 
		telofi, gen, estc, natper, conyuge, nacionalidad, profesion, detaprofesion, cargo, profocupa, dirfer, 
		idubigeo, fechanaci, fechaing, razonsocial, domfiscal, telempresa, correoemp, contacempresa, fechaconstitu, 
		idsedereg, numregistro, numpartida, actmunicipal, tipocli, impeingre, impnumof, impeorigen, impentidad, 
		impremite, impmotivo, residente, docpaisemi, kardex, firma, STR_TO_DATE(ffirma,'%d/%m/%Y') AS ffirma, resfirma, tiporepresentacion, 
		idcontratanterp, facultades, indice, visita, inscrito, condi, condicionn,condicionnsisgen, id, idtipkar, idtipoacto, 
		idcontratante, item, idcondicion, parte, porcentaje, repre, formulario, montoo, opago, fondos, montop 
		FROM sisgen_intervenciones_6  where kardex='$kar'
		GROUP BY repre ORDER BY repre ASC";*/
		$resultado2 = mysqli_query($conn,$query2) or die("Personas Naturales no Encontradas"); 
		$NoIntervinienteConyuge='';
		if(mysqli_num_rows($resultado2) != 0 ) {
			$conyugeString = "";
			$salida_kardex .= "\t\t<PersonasNaturales>\n"; 
			$strinConyuges = '';
			while($x2 = mysqli_fetch_array($resultado2)){ 
				array_push($arrPersonasEnKardex,$x2['idcontratante']);
				$resultPersona = PersonaNatural($x2);
				$resultConyugue = "";
				$salida_kardex .= $resultPersona[0];
				$arrKar = array_merge($arrKar,$resultPersona[1]);
				$arrPersonasErr[$x2['idcontratante']] = $resultPersona[2];
				
				$x2conyuge = trim($x2['conyuge']);
				if($x2conyuge!=""){
					$consultaConyugue = "SELECT  cl.idCliente, cl.idcliente AS id, cl.tipper AS tipp, cl.apepat AS apepat,
										cl.apemat AS apemat, CONCAT(TRIM(cl.prinom),' ',TRIM(cl.segnom)) AS nom,
										cl.nombre, cl.direccion AS direccion, cl.idtipdoc , cl.numdoc AS numdoc,
										cl.email AS email, cl.telfijo AS telfijo, cl.telcel, cl.telofi, cl.sexo AS gen,
										cl.idestcivil AS estc, cl.natper, cl.conyuge, cl.nacionalidad AS naci,
										cl.idprofesion , cl.detaprofesion, cl.idcargoprofe , cl.profocupa, cl.dirfer,
										cl.idubigeo, cl.cumpclie AS fechanaci, cl.residente,  u.coddist AS distrito,
										u.codprov AS provincia, u.codpto AS departamento,codtipdoc AS tipodoc,
										prof.codprof AS profesion, na.codnacion AS nacionalidad, cp.codcargoprofe
										AS cargo	
										FROM cliente cl	
										LEFT JOIN ubigeo u ON cl.idubigeo=u.coddis	
										LEFT JOIN tipodocumento td ON cl.idtipdoc=td.idtipdoc
										LEFT JOIN profesiones prof ON cl.idprofesion=prof.idprofesion
										LEFT JOIN nacionalidades na ON cl.nacionalidad=na.idnacionalidad
										LEFT JOIN cargoprofe cp ON cl.idcargoprofe=cp.idcargoprofe
										WHERE cl.idCliente = '$x2conyuge'";
					$resultadoConyugue = mysqli_query($conn,$consultaConyugue) or die("Conyugue no Encontradas");	
					if(mysqli_num_rows($resultadoConyugue) != 0 ) {
						while($itemconyuge = mysqli_fetch_array($resultadoConyugue)){ 
							$resultConyugue = PersonaNatural($itemconyuge);
							$strinConyuges .= $resultConyugue[0];
							$arrKar = array_merge($arrKar,$resultConyugue[1]);
							$arrConyuge[$x2['idcontratante']] = $itemconyuge['id'];							
						}
					}else{
						array_push($arrKar,$x2['nom'].' '.$x2['apepat'].' '.$x2['apemat'].'-> No se encontro al Conyuge, verifique el registro');
					}				
				}
			} 
			if(count($arrConyuge)>0){
				foreach ($arrConyuge as $conyugueIntem) {
				    if(in_array($conyugueIntem,$arrPersonasEnKardex)){
				    	$salida_kardex .= $strinConyuges;
				    }
				}
			}

			$salida_kardex .= "\t\t</PersonasNaturales>\n"; 

		}

		$resultado3 = mysqli_query($conn,$query3) or die("Sin personas Juridicas"); 
		if(mysqli_num_rows($resultado3) != 0 ) {
			$salida_kardex .= "\t\t<PersonasJuridicas>\n"; 
			while($x3 = mysqli_fetch_array($resultado3)){ 
					$f1=$x3['tipp'];
					if($f1=='J'){
							$salida_kardex .= "\t\t\t<PersonaJuridica id='".$x3['id']."'>\n";
									$salida_kardex .= "\t\t\t<DocsIdentificativos>\n";
										$salida_kardex .= "\t\t\t\t<DocIdentificativo>\n"; 
											$resulValida = ValidarDocumento($x3['tipodoc'],$x3['numdoc'],'J',$tipoInstrumento);
											if($resulValida[0]==1){
												array_push($arrKar,$x3['razonsocial'].'->'.$resulValida[1]);
											} 
											if($x3['tipodoc']!=""){
												$salida_kardex .= "\t\t\t\t\t<TipoDocIdentidad>" .$x3['tipodoc']. "</TipoDocIdentidad>\n";
											}
											if($x3['numdoc']!=""){
												$salida_kardex .= "\t\t\t\t\t<NumDocIdentificativo>" .trim($x3['numdoc']). "</NumDocIdentificativo>\n";
											}
										$salida_kardex .= "\t\t\t\t</DocIdentificativo>\n";
									$salida_kardex .= "\t\t\t</DocsIdentificativos>\n"; 
									
									$salida_kardex .= "\t\t\t\t<RegistroFacultades>\n";
									if($x3['sedereg']!="" and $x3['sedereg']!="00" ){
										$resulValida = ValidarSede($x3['sedereg']);
										if($resulValida[0]==1){
											array_push($arrKar,'PrediosUrbanos->'.$resulValida[1]);
										}
										$salida_kardex .= "\t\t\t\t\t<SedeRegistral>" .$x3['sedereg']. "</SedeRegistral>\n";
									} 
									if($x3['numpartidareg']!=""){
										$resulValida = ValidarTamano('Partida Registral',12,$x3['numpartidareg']);
										if($resulValida[0]==1){
											array_push($arrKar,$x3['razonsocial'].'->'.$resulValida[1]);
										}
										$salida_kardex .= "\t\t\t\t\t<PartidaRegistral>" .mb_substr(trim($x3['numpartidareg']),0,12). "</PartidaRegistral>\n";
									} 
									$salida_kardex .= "\t\t\t\t</RegistroFacultades>\n";
									
									if($x3['razonsocial']==""){										
										array_push($arrKarObs,'->Falta Razon Social');
									}
									else{
										$resultJuridica = validarStringJuridica($x3['razonsocial']);
										if($resultJuridica[0]>0){
											array_push($arrKarObs,$x3['razonsocial'].'->Razon Social tiene caracteres no permitidos');
										}
										$salida_kardex .= "\t\t\t\t<RazonSocial>" .mb_substr($x3['razonsocial'],0,120). "</RazonSocial>\n";
									}
									if($x3['ciuu']==""){
										array_push($arrKarObs,$x3['razonsocial'].'->Falta el CIIU');
									}else{
										$salida_kardex .= "\t\t\t\t<SectorEconomico>" .$x3['ciuu']. "</SectorEconomico>\n";
									} 
									if($x3['objeto']==""){
										array_push($arrKarObs,$x3['razonsocial'].'->Falta el Objeto Social');
										$salida_kardex.="";
									}else{
										$resultJuridica = validarStringJuridica($x3['objeto']);
										if($resultJuridica[0]>0){
											array_push($arrKarObs,$x3['razonsocial'].'->Objeto social tiene caracteres no permitidos');
										}
										$salida_kardex .= "\t\t\t\t<OtraActividad>" .mb_substr($resultJuridica[1],0,50). "</OtraActividad>\n";
									} 

									if($x3['correoemp'] == "" || !filter_var($x3['correoemp'], FILTER_VALIDATE_EMAIL)){
										$salida_kardex.="";
									}else{
										$salida_kardex .= "\t\t\t\t\t<Correo>" .trim($x3['correoemp']). "</Correo>\n";
									} 


									if($x3['telempresa']==""){$salida_kardex.="";}
									else{
										$resulValidaIsTelefono = ValidarIsTelefono($x3['telempresa']);
										if($resulValidaIsTelefono[0]==1){
											array_push($arrKar,$x3['razonsocial'].'->'.$resulValidaIsTelefono[1]);
										}
										$resulValida = ValidarTamano('Telefono',20,$x3['telempresa']);
										if($resulValida[0]==1){
											array_push($arrKar,$x3['razonsocial'].'->'.$resulValida[1]);
										}
										$salida_kardex .= "\t\t\t\t\t<Telefono>" .mb_substr(trim($x3['telempresa']),0,20). "</Telefono>\n";
									}
									if($x3['idubigeo']=="999999" ){$salida_kardex.="";}else{
										$salida_kardex .= "\t\t\t\t<Direccion>\n";
											if($x3['idubigeo']=="999999"){$salida_kardex.="";}else{$salida_kardex .= "\t\t\t\t\t<PaisResidencia>" ."PE". "</PaisResidencia>\n";}  
												$salida_kardex .= "\t\t\t\t<DireccionNacional>\n";
												if($x3['departamento']==""){$salida_kardex.="";}else{$salida_kardex .= "\t\t\t\t\t<CodDepartamento>" .$x3['departamento']. "</CodDepartamento>\n";}    
												if($x3['provincia']=="" ){$salida_kardex.="";}else{$salida_kardex .= "\t\t\t\t\t<CodProvincia>" .$x3['provincia']. "</CodProvincia>\n";} 
												if($x3['distrito']=="" ){$salida_kardex.="";}else{$salida_kardex .= "\t\t\t\t\t<CodDistrito>" .$x3['distrito']. "</CodDistrito>\n";} 
												if($x3['domfiscal']==""){$salida_kardex.="";}
												else{													
													$resultJuridica = validarStringJuridica($x3['domfiscal']);
													if($resultJuridica[0]>0){
														array_push($arrKar,$x3['razonsocial'].'->Direccion tiene caracteres no permitidos');
													}
													$salida_kardex .= "\t\t\t\t\t<RestoDireccion>" .mb_substr($x3['domfiscal'],0,255). "</RestoDireccion>\n";
												} 
												$salida_kardex .= "\t\t\t\t</DireccionNacional>\n";
										$salida_kardex .= "\t\t\t\t</Direccion>\n";
									}  
									$arrPersonasErr[$x3['idcontratante']] = $arrKarObs;
									$arrKarObs = array();    
							$salida_kardex .= "\t\t\t</PersonaJuridica>\n"; 
					}
			}
			$salida_kardex .= "\t\t</PersonasJuridicas>\n"; 

		}
		$resultadooo8=mysqli_query( $conn,$query8) or die("Sin Detalle de Bienes"); 
		if(mysqli_num_rows($resultadooo8) != 0 ){	
			$salida_kardex .= "\t\t<PrediosUrbanos>\n"; 
			while($xxv= mysqli_fetch_array($resultadooo8)){ 
				$salida_kardex .= "\t\t\t<PredioUrbano  id='". $xxv['idbien'] ."'>\n"; 
					if($xxv['tipo']==""){$salida_kardex.="";}else{$salida_kardex .= "\t\t\t\t\t<TipoConstruccion>" ."6". "</TipoConstruccion>\n";} 
						$salida_kardex .= "\t\t\t\t<IdentificacionPredio>\n"; 
							if($xxv['sederegistral']!=""){
								$resulValida = ValidarSede($xxv['sederegistral']);
								if($resulValida[0]==1){
									array_push($arrKar,'PrediosUrbanos->'.$resulValida[1]);
								}
								$salida_kardex .= "\t\t\t\t\t<SedeRegistral>" .$xxv['sederegistral']. "</SedeRegistral>\n";
							} 
							if($xxv['pregistral']!=""){
								$resulValida = ValidarTamano('Partida Registral',12,$xxv['pregistral']);
								if($resulValida[0]==1){
									array_push($arrKar,'PredioUrbano->'.$resulValida[1]);
								}
								$salida_kardex .= "\t\t\t\t\t<PartidaRegistral>" .$xxv['pregistral']. "</PartidaRegistral>\n";
							}   
							$salida_kardex .= "\t\t\t\t</IdentificacionPredio>\n"; 
							if($xxv['departamento']!="" && $xxv['departamento']!=0 && $xxv['departamento']!=null){
								$salida_kardex .= "\t\t\t\t<DireccionUrbana>\n"; 								
								$salida_kardex .= "\t\t\t\t\t<CodDepartamento>" .$xxv['departamento']. "</CodDepartamento>\n";
								$salida_kardex .= "\t\t\t\t\t<CodProvincia>" .$xxv['provincia']. "</CodProvincia>\n";
								$salida_kardex .= "\t\t\t\t\t<CodDistrito>" .$xxv['distrito']. "</CodDistrito>\n";
								$salida_kardex .= "\t\t\t\t</DireccionUrbana>\n"; 
							}
				$salida_kardex .= "\t\t\t</PredioUrbano>\n"; 
			}
			$salida_kardex .= "\t\t</PrediosUrbanos>\n"; 
		}

		$resultadooo82 = mysqli_query( $conn,$querybienveh) or die("Sin Vehiculo"); 
		if(mysqli_num_rows($resultadooo82) != 0 ) {
			$salida_kardex .= "\t\t<Vehiculos>\n"; 
								while($xxv= mysqli_fetch_array($resultadooo82)){ 
									$salida_kardex .= "\t\t\t<Vehiculo  id='". $xxv['idbien'] ."'>\n"; 
									if($xxv['tipo']==""){$salida_kardex.="";}else{$salida_kardex .= "\t\t\t\t\t<TipoVehiculo>" ."4". "</TipoVehiculo>\n";} 
									if($xxv['tipo']==""){$salida_kardex.="";}else{$salida_kardex .= "\t\t\t\t\t<TipoIdentificacionVehiculo>" ."1". "</TipoIdentificacionVehiculo>\n";} 
									if($xxv['npsm']==""){$salida_kardex.="";}else{$salida_kardex .= "\t\t\t\t\t<NumPlaca>" .$xxv['npsm']. "</NumPlaca>\n";} 
									if($xxv['sederegistral']!=""){
									$resulValida = ValidarSede($xxv['sederegistral']);
									if($resulValida[0]==1){
										array_push($arrKar,'Vehiculos->'.$resulValida[1]);
									}
									$salida_kardex .= "\t\t\t\t\t<SedeRegistral>" .$xxv['sederegistral']. "</SedeRegistral>\n";
									} 
									if($xxv['pregistral']!=""){
										$resulValida = ValidarTamano('Partida Registral',12,$xxv['pregistral']);
										if($resulValida[0]==1){
											array_push($arrKar,'Vehiculos->'.$resulValida[1]);
										}
										$salida_kardex .= "\t\t\t\t\t<PartidaRegistral>" .$xxv['pregistral']. "</PartidaRegistral>\n";
									}   
									$salida_kardex .= "\t\t\t</Vehiculo>\n"; 
								}
			$salida_kardex .= "\t\t</Vehiculos>\n"; 
		}

		$resultado4=mysqli_query($conn,$query4) or die("Sin Vehiculo"); 
		if(mysqli_num_rows($resultado4) != 0 ) {
			$salida_kardex .= "\t\t<Vehiculos>\n"; 
			while($x4 = mysqli_fetch_array($resultado4)){ 
				$salida_kardex .= "\t\t\t<Vehiculo  id='". $x4['idvehiculo'] ."'>\n"; 
				if($x4['idplaca']==""){$salida_kardex.="";}else{$salida_kardex .= "\t\t\t\t\t<TipoVehiculo>" . "4" . "</TipoVehiculo>\n";}
				if($x4['idplaca']=="P"){$salida_kardex .= "\t\t\t\t\t<TipoIdentificacionVehiculo>" . "1". "</TipoIdentificacionVehiculo>\n";}else{$salida_kardex .= "\t\t\t\t\t<TipoIdentificacionVehiculo>" . "2" . "</TipoIdentificacionVehiculo>\n";}
				if($x4['numplaca']==""){$salida_kardex.="";}else{$salida_kardex .= "\t\t\t\t\t<NumPlaca>" . trim($x4['numplaca']) . "</NumPlaca>\n";}
				if($x4['clase']=="" ){$salida_kardex.="";}else{ $salida_kardex .= "\t\t\t\t\t<Clase>" . trim($x4['clase']) . "</Clase>\n";}
				if($x4['marca']=="" ){$salida_kardex.="";}else{$salida_kardex .= "\t\t\t\t\t<Marca>" . trim($x4['marca']) . "</Marca>\n";}
				if($x4['anofab']!=""  ){
					$resulValida = ValidarTamano('Año de Fabricacion',4,$x4['anofab'],4);
					if($resulValida[0]==1){
						array_push($arrKar,$resulValida[1]);
					}
					$salida_kardex .= "\t\t\t\t\t<AnoFabricacion>" . trim($x4['anofab']) . "</AnoFabricacion>\n";
				}
				if($x4['modelo']=="" ){$salida_kardex.="";}else{$salida_kardex .= "\t\t\t\t\t<Modelo>" . trim($x4['modelo']) . "</Modelo>\n";}
				if($x4['combustible']=="" ){$salida_kardex.="";}else{$salida_kardex .= "\t\t\t\t\t<Combustible>" . trim($x4['combustible']) . "</Combustible>\n";}
				if($x4['carroceria']==""){$salida_kardex.="";}else{$salida_kardex .= "\t\t\t\t\t<Carroceria>" . trim($x4['carroceria']) . "</Carroceria>\n";}
				if($x4['color']==""){$salida_kardex.="";}else{$salida_kardex .= "\t\t\t\t\t<Color>" . trim($x4['color']) . "</Color>\n";}
				if($x4['motor']==""){$salida_kardex.="";}else{ $salida_kardex .= "\t\t\t\t\t<Motor>" . trim($x4['motor']) . "</Motor>\n";}
				if($x4['numcil']==""){$salida_kardex.="";}else{$salida_kardex .= "\t\t\t\t\t<NumCilindros>" . trim($x4['numcil']) . "</NumCilindros>\n";}                
				if($x4['numserie']=="" ){$salida_kardex.="";}else{ $salida_kardex .= "\t\t\t\t\t<NumSerie>" . trim($x4['numserie']) . "</NumSerie>\n";}            
				if($x4['numrueda']=="" ){$salida_kardex.="";}else{$salida_kardex .= "\t\t\t\t\t<NumRueda>" . trim($x4['numrueda']) . "</NumRueda>\n";}
				if($x4['idsedereg']!="" ){
					$resulValida = ValidarSede($x4['idsedereg']);
					if($resulValida[0]==1){
						array_push($arrKar,'Vehiculos->'.$resulValida[1]);
					}
					$salida_kardex .= "\t\t\t\t\t<SedeRegistral>" . trim($x4['idsedereg']) . "</SedeRegistral>\n";
				}
				if($x4['pregistral']!="" ){
					$resulValida = ValidarTamano('Partida Registral',12,$x4['pregistral']);
					if($resulValida[0]==1){
						array_push($arrKar,'Vehiculos->'.$resulValida[1]);
					}
					$salida_kardex .= "\t\t\t\t\t<PartidaRegistral>" . trim($x4['pregistral']) . "</PartidaRegistral>\n";
				}
				$salida_kardex .= "\t\t\t</Vehiculo>\n"; 
			}
		$salida_kardex .= "\t\t</Vehiculos>\n"; 
		}

		$resultadooo823=mysqli_query( $conn,$queryotros) or die("Sin Objeto otros"); 
		if(mysqli_num_rows($resultadooo823) != 0 ) {
			$salida_kardex .= "\t\t<OtrosObjetos>\n"; 
			while($xxotros= mysqli_fetch_array($resultadooo823)){ 
				$salida_kardex .= "\t\t\t<OtroObjeto  id='". $xxotros['idbien'] ."'>\n"; 
				if($xxotros['oespecific']==""){$salida_kardex.="";}else{$salida_kardex .= "\t\t\t\t<Descripcion>" . $xxotros['oespecific'] . "</Descripcion>\n";} 
				if($xxotros['tipo']==""){$salida_kardex.="";}else{$salida_kardex .= "\t\t\t\t<ClaseObjeto>" ."7" . "</ClaseObjeto>\n";} 
				$salida_kardex .= "\t\t\t</OtroObjeto>\n"; 
			}
			$salida_kardex .= "\t\t</OtrosObjetos>\n";
		}
		$salida_kardex .= "\t</Maestros>\n";
	 	$salida_kardex .= "\t<Operaciones>\n"; 
		$resultadoDf=mysqli_query( $conn,$query5) or die("Sin Detalle medio pago"); 
		$resultadotPREDIO=mysqli_query($conn,$query8) or die("sin resultado 1");    
		$resultadotipppp22=mysqli_query($conn,$querybienveh) or die("sin resultado 2");		
		$resultadotiotros=mysqli_query($conn,$queryotros) or die("sin resultado 3");				
		$resultadoVEHICULO=mysqli_query($conn,$query4) or die("sin resultado 4");
		$codactoxkardex=$x['codactos'];
		$arrCodActos = array();
		$actos = split('/',$x['contrato']);
		for($i = 0;$i<strlen($codactoxkardex);$i = $i+3){
			$arrCodActos[] = array('codActo'=>mb_substr($codactoxkardex, $i ,3));
		}
		$countActo = 0;
		if(count($arrKar)>0){
			$tienerror = 1;
			array_push($errorListKar, array('idkardex'=>$idkar,'kardex'=>$kar,'acto'=>'General','error'=>$arrKar ));
		} 
		$stop = 0;
		$isNoCorre = '';
		foreach ($arrCodActos as  $item) {
			$arrKar = array();
			$codActo62 = $item['codActo'];
			
			while($xxx3 = mysqli_fetch_array($resultadoDf)){
				$iddddd=$xxx3['idmediop'];
			}
			$consultakardex ="SELECT idtipoacto, desacto, cod_ancert FROM tiposdeacto WHERE idtipoacto='$codActo62'";
			$resultadokardex=mysqli_query($conn,$consultakardex) or die("sin resultado 5");
			if(mysqli_num_rows($resultadokardex) != 0 ) {					
				while($kardcant= mysqli_fetch_array($resultadokardex)){ 
					$codActoSisgen = $kardcant['cod_ancert'];
					if($kardcant['cod_ancert']=='0919'){
						$isNoCorre = $salida_kardex_documento;
						$isNoCorre .= "\t<Operaciones>\n"; 
						$isNoCorre .= "\t\t<Operacion>\n"; 
						$isNoCorre .= "\t\t\t<CodActoJuridico>0919</CodActoJuridico>\n"; 
						$isNoCorre .= "\t\t</Operacion>\n"; 
						$isNoCorre .= "\t</Operaciones>\n"; 
						$isNoCorre .= "\t</DocumentoNotarial>\n"; 
						break;
					}
					$codigoacto=$kardcant['idtipoacto'];
					$salida_kardex.="\t\t<Operacion id='".$kardcant['idtipoacto'] ."'>\n";
					if($kardcant['idtipoacto']=="" or $kardcant['idtipoacto']==0 ){$salida_kardex.="";}else{
						$resulValida = ValidarVacio('Código sisgen',$kardcant['cod_ancert'],1,4);
						if($resulValida[0]==1){
							array_push($arrKar,$resulValida[1]);
						} 
						$salida_kardex .= "\t\t\t\t<CodActoJuridico>" . $kardcant['cod_ancert']. "</CodActoJuridico>\n";
					}  
					$salida_kardex .= "\t\t\t<Operantes>\n"; 
					$salida_kardex .="\t\t\t\t<Objetos>\n";
					$prediokardex="SELECT   db.detbien AS idbien,  db.itemmp,  db.kardex,  db.idtipacto,  db.tipob ,  tb.codbien  AS tipo,  db.coddis,  db.fechaconst,  db.oespecific,  
					db.smaquiequipo,  tpsm, db.npsm,  db.pregistral AS pregistral,  db.idsedereg AS sederegistral, u.coddist AS distrito,u.codprov AS provincia,u.codpto AS departamento
					FROM detallebienes db
					LEFT JOIN ubigeo u ON u.coddis=db.coddis 
					LEFT JOIN tipobien tb ON db.idtipbien=tb.idtipbien
					WHERE db.kardex='$kar' AND codbien ='04' AND idtipacto ='$codigoacto'";
					$prediokarde=mysqli_query($conn,$prediokardex) or die("sin resultado 6");
					if(mysqli_num_rows($prediokarde) != 0 ) {								
						while($bienpredio= mysqli_fetch_array($prediokarde)){ 
							$salida_kardex .="\t\t\t\t\t<Objeto>\n";
							if($bienpredio['idbien']=="" or $bienpredio['idbien']==0 ){$salida_kardex.="";}else{   $salida_kardex .= "\t\t\t\t\t\t<IdMaestro>" . $bienpredio['idbien']. "</IdMaestro>\n";}
							if($bienpredio['fechaconst']=="" or $bienpredio['fechaconst']==0 ){$salida_kardex.="";}else{ $salida_kardex.="\t\t\t\t\t\t<DetalleObjeto>\n" ;}
							if($bienpredio['fechaconst']=="" or $bienpredio['fechaconst']==0 ){$salida_kardex.="";}else{  $salida_kardex .= "\t\t\t\t\t\t\t<FechaAdquisicion>" .fdate($bienpredio['fechaconst']). "</FechaAdquisicion>\n";}
							if($bienpredio['fechaconst']=="" or $bienpredio['fechaconst']==0 ){$salida_kardex.="";}else{ $salida_kardex.="\t\t\t\t\t\t</DetalleObjeto>\n"; }
							$salida_kardex .="\t\t\t\t\t</Objeto>\n";
						}							
					}
					$bienvehi="SELECT   db.detbien AS idbien,  db.itemmp,  db.kardex,  db.idtipacto,  db.tipob ,  tb.codbien  AS tipo,  db.coddis,  db.fechaconst,  db.oespecific,  
					db.smaquiequipo,  tpsm, db.npsm,  db.pregistral AS pregistral,  db.idsedereg AS sederegistral, u.coddist AS distrito,u.codprov AS provincia,u.codpto AS departamento
					FROM detallebienes db
					LEFT JOIN ubigeo u ON u.coddis=db.coddis 
					LEFT JOIN tipobien tb ON db.idtipbien=tb.idtipbien
					WHERE db.kardex='$kar' AND codbien ='09' AND idtipacto ='$codigoacto'";
					$bienvehi2=mysqli_query($conn,$bienvehi) or die("sin resultado 7");
					if(mysqli_num_rows($bienvehi2) != 0 ) {								
						while($xxv2= mysqli_fetch_array($bienvehi2)){ 
							$salida_kardex .="\t\t\t\t\t<Objeto>\n";
						if($xxv2['idbien']=="" or $xxv2['idbien']==0 ){$salida_kardex.="";}
						else{   
							$salida_kardex .= "\t\t\t\t\t\t<IdMaestro>" . $xxv2['idbien']. "</IdMaestro>\n";}
							$salida_kardex .="\t\t\t\t\t</Objeto>\n";
						}							
					}
					$otrospredios="SELECT   db.detbien AS idbien,  db.itemmp,  db.kardex,  db.idtipacto,  db.tipob ,  tb.codbien  AS tipo,  db.coddis,  db.fechaconst,  db.oespecific,  
					db.smaquiequipo,  tpsm, db.npsm,  db.pregistral AS pregistral,  db.idsedereg AS sederegistral 
					FROM detallebienes db, tipobien tb
					WHERE db.idtipbien=tb.idtipbien AND db.kardex='$kar' AND codbien =99 AND idtipacto ='$codigoacto'";
					$otrospredios2=mysqli_query($conn,$otrospredios) or die("sin resultado 8");
					if(mysqli_num_rows($otrospredios2) != 0 ) {								
						while($xxv23= mysqli_fetch_array($otrospredios2)){ 
							$salida_kardex .="\t\t\t\t\t<Objeto>\n";
							if($xxv23['idbien']=="" or $xxv23['idbien']==0 ){$salida_kardex.="";}else{   $salida_kardex .= "\t\t\t\t\t\t<IdMaestro>" . $xxv23['idbien']. "</IdMaestro>\n";}
							$salida_kardex .="\t\t\t\t\t</Objeto>\n";
						}							
					}		
					
					$prediokarde=mysqli_query($conn,$prediokardex) or die("sin resultado 9");						 
					if(mysqli_num_rows($resultadoVEHICULO) != 0 ) {								
							while($iddd= mysqli_fetch_array($resultadoVEHICULO)){ 
						$salida_kardex .="\t\t\t\t\t<Objeto>\n";
						if($iddd['idvehiculo']=="" or $iddd['idvehiculo']==0 ){$salida_kardex.="";}else{   $salida_kardex .= "\t\t\t\t\t\t<IdMaestro>" . $iddd['idvehiculo']. "</IdMaestro>\n";}
						$salida_kardex .="\t\t\t\t\t</Objeto>\n";
						}							
					}
							
					$salida_kardex .="\t\t\t\t</Objetos>\n";
						
					$sq_sujetos="
					SELECT idcon, idcl, tipp, apepat, apemat, nom, nombre, direccion, tipodoc, numdoc, email, telfijo, telcel, telofi, gen, estc, natper, conyuge, nacionalidad, profesion, detaprofesion, cargo, profocupa, dirfer, idubigeo, fechanaci, fechaing, razonsocial, domfiscal, telempresa, correoemp, contacempresa, fechaconstitu, idsedereg, numregistro, numpartida, actmunicipal, tipocli, impeingre, impnumof, impeorigen, impentidad, impremite, impmotivo, residente, docpaisemi, kardex, firma, ffirma, resfirma, tiporepresentacion, idcontratanterp, facultades, indice, visita, inscrito, condi, condicionn, id, idtipkar, idtipoacto, idcontratante, item, idcondicion, parte, porcentaje, repre, formulario, montoo, opago, fondos, montop FROM sisgen_intervenciones_6 
					WHERE kardex ='$kar' AND idtipoacto ='$codigoacto' ";

					$resultadoD=mysqli_query($conn,$sq_sujetos) or die("sin resultado 10");   

					$sq_cuantiadeoperacion="SELECT idtipoacto AS tipacto, kardex,  importetrans , CONCAT('0',idmon)AS tipomon FROM patrimonial WHERE kardex ='$kar'
					AND idtipoacto ='$codigoacto'";	
					$resultado15 = mysqli_query($conn,$sq_cuantiadeoperacion) or die("sin resultado 18"); 
					if(mysqli_num_rows($resultado15)>1){
						array_push($arrKar,"Existe mas de un patrimonial");
						$stop = 1;
						$tienerror = 1;
					}
					while($tipoMon2 = mysqli_fetch_array($resultado15)){ 
						$tipoM2=$tipoMon2['tipomon'];
					}	
					if($stop != 1){		
						$resultIsUIFSUNAT = ($idkar==2 && $idkar==5)?0:validarUIFSUNAT($kardcant['cod_ancert']);
						$resultadoD2All=mysqli_query($conn,$sq_sujetos) or die("sin resultado 15");
						$salida_xml_sujeto_O = '';
						$salida_xml_sujeto_B = '';
						$salida_xml_sujeto_G = '';
						$salida_xml_sujeto_N = '';
						while($xxx = mysqli_fetch_array($resultadoD2All)){
							if($resultIsUIFSUNAT == 1 && ($xxx['firma']=='1' || $xxx['tipp']=='J')){
								$totalErrPersonas = count($arrPersonasErr[$xxx['idcon']]);
								if($totalErrPersonas>0){
									array_push($errorListKar, array('idkardex'=>$idkar,'kardex'=>$kar,'acto'=>$actos[$countActo],'error'=>$arrPersonasErr[$xxx['idcon']] ));
								}
							}
							if($xxx['repre']=='O' ){
								$salida_xml_sujeto_O .= "\t\t\t\t\t\t\t\t<Sujeto>\n";
								$salida_xml_sujeto_O .= "\t\t\t\t\t\t\t\t\t<IdMaestro>" .  $xxx['idcl'] . "</IdMaestro>\n";

								$idActo = $xxx['idtipoacto'];
								if($xxx['fondos']!="" and $xxx['montoo']!=""){
									$salida_xml_sujeto_O .= "\t\t\t\t\t\t\t\t\t<OrigenFondos>\n"; 
									$salida_xml_sujeto_O .= "\t\t\t\t\t\t\t\t\t\t<OrigenFondo>\n";
									$resultJuridica = validarStringJuridica($xxx['fondos']);
									if($resultJuridica[0]>0){
										array_push($arrKar,'OrigenFondos en Otorgante-> tiene caracteres no permitidos');
									}	
									$salida_xml_sujeto_O .= "\t\t\t\t\t\t\t\t\t\t\t<Origen>" .  mb_substr($xxx['fondos'],0,40) . "</Origen>\n";
									$salida_xml_sujeto_O .= "\t\t\t\t\t\t\t\t\t\t\t<CuantiaOrigen>" .trim(number_format($xxx['montoo'],2,".","")). "</CuantiaOrigen>\n";
									$sql =  "SELECT detmp FROM detallemediopago WHERE kardex = '$kar' AND   tipacto = '$idActo' LIMIT 1";  
									$result = mysqli_query($conn,$sql);
									if($rowMedioPago = mysqli_fetch_array($result))									
									$resulValida = ValidarMoneda($tipoM2,$codActoSisgen);
									if($resulValida[0]==1){
										array_push($arrKar,'OrigenFondos->'.$resulValida[1]);
									}else{
										if($tipoM2!="" and $tipoM2!=0 ){
											$salida_xml_sujeto_O .= "\t\t\t\t\t\t\t\t\t\t\t<TipoMonedaPago>" . $tipoM2 . "</TipoMonedaPago>\n";
										}											
									}
									$salida_xml_sujeto_O .= "\t\t\t\t\t\t\t\t\t\t</OrigenFondo>\n";
									$salida_xml_sujeto_O .= "\t\t\t\t\t\t\t\t\t</OrigenFondos>\n"; 								
								}
								$salida_xml_sujeto_O .= "\t\t\t\t\t\t\t\t\t<Derecho>\n"; 
								if($xxx['porcentaje']!=""){
									$salida_xml_sujeto_O .= "\t\t\t\t\t\t\t\t\t\t<PorcentajeDerecho>" . trim(number_format($xxx['porcentaje'],2,".","")) . "</PorcentajeDerecho>\n";
								} 
								$salida_xml_sujeto_O .= "\t\t\t\t\t\t\t\t\t</Derecho>\n"; 
								$query_renta1="SELECT r.pregu1 ,r.pregu2,r.pregu3  FROM renta r
														where r.kardex='".$xxx['kardex']."' AND r.`idcontratante`='".$xxx['idcontratante']."'
														GROUP BY idcontratante";
								$sql_renta1=mysqli_query($conn,$query_renta1) or die("sin resultado 12"); 	
								while($row_renta1 = mysqli_fetch_array($sql_renta1)){						
									if($row_renta1["pregu1"]!=""){			
										$salida_xml_sujeto_O .= "\t\t\t\t\t\t\t\t\t<Renta3Cat>" . $row_renta1["pregu1"] . "</Renta3Cat>\n";
									}
									if($row_renta1["pregu2"]!="" ){								
										$salida_xml_sujeto_O .= "\t\t\t\t\t\t\t\t\t<CasaEnajenante>" . $row_renta1["pregu2"] . "</CasaEnajenante>\n";
									}
									if($row_renta1["pregu3"]!=""){								
										$salida_xml_sujeto_O .= "\t\t\t\t\t\t\t\t\t<ImpuestoCero>" . $row_renta1["pregu3"] . "</ImpuestoCero>\n";
									}
								}
								$reppp=$xxx['idcon'];
								$query91="SELECT idcon, idcl, tipp, apepat, apemat, nom, nombre, direccion, tipodoc, numdoc, email, telfijo, telcel, 
								telofi, gen, estc, natper, conyuge, nacionalidad, profesion, detaprofesion, cargo, profocupa, dirfer, 
								idubigeo, fechanaci, fechaing, razonsocial, domfiscal, telempresa, correoemp, contacempresa, fechaconstitu, 
								idsedereg, numregistro, numpartida, actmunicipal, tipocli, impeingre, impnumof, impeorigen, impentidad, 
								impremite, impmotivo, residente, docpaisemi, kardex, firma, ffirma, resfirma, tiporepresentacion, 
								idcontratanterp, facultades, indice, visita, inscrito, condi, condicionn,condicionnsisgen, id, idtipkar, idtipoacto, 
								idcontratante, item, idcondicion, parte, porcentaje, repre, formulario, montoo, opago, fondos, montop 
								FROM sisgen_intervenciones_6  WHERE repre ='R' AND kardex='$kar' AND idcontratanterp ='$reppp' AND idtipoacto = '$codigoacto'";								
								$resultadoD3=mysqli_query($conn,$query91) or die("sin resultado 13O"); 
								$salida_xml_sujeto_O .= "\t\t\t\t\t\t\t\t\t<Representantes>\n"; 
								
								$ryr = '';
								while($xxx1 = mysqli_fetch_array($resultadoD3)){

									$salida_xml_sujeto_O .= "\t\t\t\t\t\t\t\t\t\t<Representante>\n"; 
									$salida_xml_sujeto_O .= "\t\t\t\t\t\t\t\t\t\t\t<IdMaestro>" . $xxx1['idcl'] . "</IdMaestro>\n";
									if($xxx1['inscrito'] == 1){
										$salida_xml_sujeto_O .= "\t\t\t\t\t\t\t\t\t\t\t<InscripcionRepresentacion>\n";
										if($xxx1['idsedereg']!=""){
												$resulValida = ValidarSede($xxx1['idsedereg']);
												if($resulValida[0]==1){
													array_push($arrKar,'Representante->'.$resulValida[1]);
												}
											$salida_xml_sujeto_O .= "\t\t\t\t\t\t\t\t\t\t\t\t<SedeRegistral>" . $xxx1['idsedereg'] . "</SedeRegistral>\n";
										}else{
											array_push($arrKar,'Representante->Falta la sede registral');
										}
										if($xxx1['numpartida']!=""){
											$resulValida = ValidarTamano('Partida Registral',12,$xxx1['numpartida']);
											if($resulValida[0]==1){
												array_push($arrKar,'Representante->'.$resulValida[1]);
											}
											$salida_xml_sujeto_O .= "\t\t\t\t\t\t\t\t\t\t\t\t<PartidaRegistral>" . trim($xxx1['numpartida']). "</PartidaRegistral>\n";
										}else{
											array_push($arrKar,'Representante->Falta la partida registral');
										}
										$salida_xml_sujeto_O .= "\t\t\t\t\t\t\t\t\t\t\t</InscripcionRepresentacion>\n";
									}	
									if(empty($xxx1['ffirma'])==true){										
										//ver si es r de r 
										$queryRYR="SELECT idcon, idcl, tipp, apepat, apemat, nom, nombre, direccion, tipodoc, numdoc, email, telfijo, telcel, telofi, gen, estc, natper, conyuge, nacionalidad, profesion, detaprofesion, cargo, profocupa, dirfer, idubigeo, fechanaci, fechaing, razonsocial, domfiscal, telempresa, correoemp, contacempresa, fechaconstitu, idsedereg, numregistro, numpartida, actmunicipal, tipocli, impeingre, impnumof, impeorigen, impentidad, impremite, impmotivo, residente, docpaisemi, kardex, firma, ffirma, resfirma, tiporepresentacion, idcontratanterp, facultades, indice, visita, inscrito, condi, condicionn,condicionnsisgen, id, idtipkar, idtipoacto, 
											idcontratante, item, idcondicion, parte, porcentaje, repre, formulario, montoo, opago, fondos, montop 
											FROM sisgen_intervenciones_6  WHERE repre ='R' AND kardex='$kar' AND idcontratanterp ='".$xxx1['idcon']."' AND idtipoacto = '$codigoacto'";
											$resultadoRYR=mysqli_query($conn,$queryRYR) or die("sin resultado representante de representante O"); 
											while($xxxRYR1 = mysqli_fetch_array($resultadoRYR)){
												$salida_xml_sujeto_O .= "\t\t\t\t\t\t\t\t\t\t\t<RepresentanteRepresentante>\n";
												$salida_xml_sujeto_O .= "\t\t\t\t\t\t\t\t\t\t\t\t<IdMaestro>" . $xxxRYR1['idcl'] . "</IdMaestro>\n";
												if($xxxRYR1['inscrito'] == 1){
													$salida_xml_sujeto_O .= "\t\t\t\t\t\t\t\t\t\t\t\t\t<InscripcionRepresentacion>\n";
													if($xxxRYR1['idsedereg']!=""){
															$resulValida = ValidarSede($xxxRYR1['idsedereg']);
															if($resulValida[0]==1){
																array_push($arrKar,'Representante de Representante->'.$resulValida[1]);
															}
														$salida_xml_sujeto_O .= "\t\t\t\t\t\t\t\t\t\t\t\t\t<SedeRegistral>" . $xxxRYR1['idsedereg'] . "</SedeRegistral>\n";
													}else{
														array_push($arrKar,'Representante de Representante->Falta la sede registral');
													}
													if($xxxRYR1['numpartida']!=""){
														$resulValida = ValidarTamano('Partida Registral',12,$xxxRYR1['numpartida']);
														if($resulValida[0]==1){
															array_push($arrKar,'Representante de Representante->'.$resulValida[1]);
														}
														$salida_xml_sujeto_O .= "\t\t\t\t\t\t\t\t\t\t\t\t\t<PartidaRegistral>" . trim($xxxRYR1['numpartida']). "</PartidaRegistral>\n";
													}else{
														array_push($arrKar,'Representante de Representante->Falta la partida registral');
													}
													$salida_xml_sujeto_O .= "\t\t\t\t\t\t\t\t\t\t\t\t</InscripcionRepresentacion>\n";
												}	
												if(empty($xxxRYR1['ffirma'])!=true){
													$salida_xml_sujeto_O .= "\t\t\t\t\t\t\t\t\t\t\t\t<FechaFirma>" .fdate($xxxRYR1['ffirma']). "</FechaFirma>\n";
												}
												$salida_xml_sujeto_O .= "\t\t\t\t\t\t\t\t\t\t\t\t</RepresentanteRepresentante>\n";				
											}
									}else{  
										$salida_xml_sujeto_O .= "\t\t\t\t\t\t\t\t\t\t\t<FechaFirma>" .fdate($xxx1['ffirma']). "</FechaFirma>\n";
									}

									$salida_xml_sujeto_O .= "\t\t\t\t\t\t\t\t\t\t</Representante>\n"; 
								}									
								$salida_xml_sujeto_O .= "\t\t\t\t\t\t\t\t\t</Representantes>\n"; 
							
								if(empty($xxx['ffirma'])==true){$salida_xml_sujeto_O.="";}else{  $salida_xml_sujeto_O .= "\t\t\t\t\t\t\t\t\t<FechaFirma>" .fdate($xxx['ffirma']). "</FechaFirma>\n";}
								$salida_xml_sujeto_O .= "\t\t\t\t\t\t\t\t</Sujeto>\n";							
							}else if($xxx['repre']=='B' ){
								$salida_xml_sujeto_B .= "\t\t\t\t\t\t\t\t<Sujeto>\n";
								$salida_xml_sujeto_B .= "\t\t\t\t\t\t\t\t\t<IdMaestro>" .  $xxx['idcl'] . "</IdMaestro>\n";
								$idActo = $xxx['idtipoacto'];
								if($xxx['fondos']!="" and $xxx['montoo']!=""){
									$salida_xml_sujeto_B .= "\t\t\t\t\t\t\t\t\t<OrigenFondos>\n"; 
									$salida_xml_sujeto_B .= "\t\t\t\t\t\t\t\t\t\t<OrigenFondo>\n";
									$resultJuridica = validarStringJuridica($xxx['fondos']);
									if($resultJuridica[0]>0){
										array_push($arrKar,'OrigenFondos en Beneficiario-> tiene caracteres no permitidos');
									}	
									$salida_xml_sujeto_B .= "\t\t\t\t\t\t\t\t\t\t\t<Origen>" .  mb_substr($xxx['fondos'],0,40) . "</Origen>\n";
									$salida_xml_sujeto_B .= "\t\t\t\t\t\t\t\t\t\t\t<CuantiaOrigen>" .trim(number_format($xxx['montoo'],2,".","")). "</CuantiaOrigen>\n";
									$sql =  "SELECT detmp FROM detallemediopago WHERE kardex = '$kar' AND   tipacto = '$idActo' LIMIT 1";  
									$result = mysqli_query($conn,$sql);
									if($rowMedioPago = mysqli_fetch_array($result))									
									$resulValida = ValidarMoneda($tipoM2,$codActoSisgen);
									if($resulValida[0]==1){
										array_push($arrKar,'OrigenFondos->'.$resulValida[1]);
									}else{
										if($tipoM2!="" and $tipoM2!=0 ){
											$salida_xml_sujeto_B .= "\t\t\t\t\t\t\t\t\t\t\t<TipoMonedaPago>" . $tipoM2 . "</TipoMonedaPago>\n";
										}
									}
									$salida_xml_sujeto_B .= "\t\t\t\t\t\t\t\t\t\t</OrigenFondo>\n";
									$salida_xml_sujeto_B .= "\t\t\t\t\t\t\t\t\t</OrigenFondos>\n"; 								
								}
								$salida_xml_sujeto_B .= "\t\t\t\t\t\t\t\t\t<Derecho>\n"; 
								if($xxx['porcentaje']!=""){
									$salida_xml_sujeto_B .= "\t\t\t\t\t\t\t\t\t\t<PorcentajeDerecho>" . trim(number_format($xxx['porcentaje'],2,".","")) . "</PorcentajeDerecho>\n";
								} 
								$salida_xml_sujeto_B .= "\t\t\t\t\t\t\t\t\t</Derecho>\n"; 
								
								$query_renta="SELECT r.pregu1 ,r.pregu2,r.pregu3  FROM renta r
												where r.kardex='".$xxx['kardex']."' AND r.`idcontratante`='".$xxx['idcontratante']."'
												GROUP BY idcontratante";
								$sql_renta=mysqli_query($conn,$query_renta) or die("sin resultado 16"); 	
								while($row_renta = mysqli_fetch_array($sql_renta)){
									if($row_renta["pregu1"]!=""){			
										$salida_xml_sujeto_B .= "\t\t\t\t\t\t\t\t\t<Renta3Cat>" . $row_renta["pregu1"] . "</Renta3Cat>\n";
									}
									if($row_renta["pregu2"]!="" ){								
										$salida_xml_sujeto_B .= "\t\t\t\t\t\t\t\t\t<CasaEnajenante>" . $row_renta["pregu2"] . "</CasaEnajenante>\n";
									}
									if($row_renta["pregu3"]!=""){								
										$salida_xml_sujeto_B .= "\t\t\t\t\t\t\t\t\t<ImpuestoCero>" . $row_renta["pregu3"] . "</ImpuestoCero>\n";
									}
								}
								$reppp2=$xxx['idcon'];
								$query91="SELECT idcon, idcl, tipp, apepat, apemat, nom, nombre, direccion, tipodoc, numdoc, email, telfijo, telcel, 
								telofi, gen, estc, natper, conyuge, nacionalidad, profesion, detaprofesion, cargo, profocupa, dirfer, 
								idubigeo, fechanaci, fechaing, razonsocial, domfiscal, telempresa, correoemp, contacempresa, fechaconstitu, 
								idsedereg, numregistro, numpartida, actmunicipal, tipocli, impeingre, impnumof, impeorigen, impentidad, 
								impremite, impmotivo, residente, docpaisemi, kardex, firma, ffirma, resfirma, tiporepresentacion, 
								idcontratanterp, facultades, indice, visita, inscrito, condi, condicionn,condicionnsisgen, id, idtipkar, idtipoacto, 
								idcontratante, item, idcondicion, parte, porcentaje, repre, formulario, montoo, opago, fondos, montop 
								FROM sisgen_intervenciones_6  WHERE repre ='R' AND kardex='$kar' AND idcontratanterp ='$reppp2' AND idtipoacto = '$codigoacto'";
								$resultadoD3=mysqli_query($conn,$query91) or die("sin resultado 17B");    
								$salida_xml_sujeto_B .= "\t\t\t\t\t\t\t\t\t<Representantes>\n";
								while($xxx223 = mysqli_fetch_array($resultadoD3)){
									$salida_xml_sujeto_B .= "\t\t\t\t\t\t\t\t\t\t<Representante>\n"; 
									$salida_xml_sujeto_B .= "\t\t\t\t\t\t\t\t\t\t\t<IdMaestro>" . $xxx223['idcl'] . "</IdMaestro>\n";
									if($xxx223['inscrito'] == 1){
										$salida_xml_sujeto_B .= "\t\t\t\t\t\t\t\t\t\t\t<InscripcionRepresentacion>\n";
										if($xxx223['idsedereg']!=""){
											$resulValida = ValidarSede($xxx223['idsedereg']);
											if($resulValida[0]==1){
												array_push($arrKar,'Representante->'.$resulValida[1]);
											}
											$salida_xml_sujeto_B .= "\t\t\t\t\t\t\t\t\t\t\t\t<SedeRegistral>" . $xxx223['idsedereg'] . "</SedeRegistral>\n";
										}else{
											array_push($arrKar,'Representante->Falta la sede registral');
										}
										if($xxx223['numpartida']!=""){
											$resulValida = ValidarTamano('Partida Registral',12,$xxx223['numpartida']);
											if($resulValida[0]==1){
												array_push($arrKar,'Representante->'.$resulValida[1]);
											}
											$salida_xml_sujeto_B .= "\t\t\t\t\t\t\t\t\t\t\t\t<PartidaRegistral>" . trim($xxx223['numpartida']). "</PartidaRegistral>\n";
										}else{
											array_push($arrKar,'Representante->Falta la partida registral');
										}
										$salida_xml_sujeto_B .= "\t\t\t\t\t\t\t\t\t\t\t</InscripcionRepresentacion>\n";
									}	
									if(empty($xxx223['ffirma'])==true){
										$salida_xml_sujeto_B.="";
										//ver si es r de r 
										$queryRYR="SELECT idcon, idcl, tipp, apepat, apemat, nom, nombre, direccion, tipodoc, numdoc, email, telfijo, telcel, telofi, gen, estc, natper, conyuge, nacionalidad, profesion, detaprofesion, cargo, profocupa, dirfer, idubigeo, fechanaci, fechaing, razonsocial, domfiscal, telempresa, correoemp, contacempresa, fechaconstitu, idsedereg, numregistro, numpartida, actmunicipal, tipocli, impeingre, impnumof, impeorigen, impentidad, impremite, impmotivo, residente, docpaisemi, kardex, firma, ffirma, resfirma, tiporepresentacion, idcontratanterp, facultades, indice, visita, inscrito, condi, condicionn,condicionnsisgen, id, idtipkar, idtipoacto, 
											idcontratante, item, idcondicion, parte, porcentaje, repre, formulario, montoo, opago, fondos, montop 
											FROM sisgen_intervenciones_6  WHERE repre ='R' AND kardex='$kar' AND idcontratanterp ='".$xxx1['idcon']."' AND idtipoacto = '$codigoacto'";
											//die($queryRYR);
											$resultadoRYR=mysqli_query($conn,$queryRYR) or die("sin resultado Representante-representante B"); 
											while($xxxRYR1 = mysqli_fetch_array($resultadoRYR)){
												$salida_xml_sujeto_B .= "\t\t\t\t\t\t\t\t\t\t\t<RepresentanteRepresentante>\n";
												$salida_xml_sujeto_B .= "\t\t\t\t\t\t\t\t\t\t\t\t<IdMaestro>" . $xxxRYR1['idcl'] . "</IdMaestro>\n";
												if($xxxRYR1['inscrito'] == 1){
													$salida_xml_sujeto_B .= "\t\t\t\t\t\t\t\t\t\t\t\t\t<InscripcionRepresentacion>\n";
													if($xxxRYR1['idsedereg']!=""){
															$resulValida = ValidarSede($xxxRYR1['idsedereg']);
															if($resulValida[0]==1){
																array_push($arrKar,'Representante de Representante->'.$resulValida[1]);
															}
														$salida_xml_sujeto_B .= "\t\t\t\t\t\t\t\t\t\t\t\t\t<SedeRegistral>" . $xxxRYR1['idsedereg'] . "</SedeRegistral>\n";
													}else{
														array_push($arrKar,'Representante de Representante->Falta la sede registral');
													}
													if($xxxRYR1['numpartida']!=""){
														$resulValida = ValidarTamano('Partida Registral',12,$xxxRYR1['numpartida']);
														if($resulValida[0]==1){
															array_push($arrKar,'Representante de Representante->'.$resulValida[1]);
														}
														$salida_xml_sujeto_B .= "\t\t\t\t\t\t\t\t\t\t\t\t\t<PartidaRegistral>" . trim($xxxRYR1['numpartida']). "</PartidaRegistral>\n";
													}else{
														array_push($arrKar,'Representante de Representante->Falta la partida registral');
													}
													$salida_xml_sujeto_B .= "\t\t\t\t\t\t\t\t\t\t\t\t</InscripcionRepresentacion>\n";
												}	
												if(empty($xxxRYR1['ffirma'])!=true){
													$salida_xml_sujeto_B .= "\t\t\t\t\t\t\t\t\t\t\t\t<FechaFirma>" .fdate($xxxRYR1['ffirma']). "</FechaFirma>\n";
												}
												$salida_xml_sujeto_B .= "\t\t\t\t\t\t\t\t\t\t\t\t</RepresentanteRepresentante>\n";				
											}	

									}else{  
										$salida_xml_sujeto_B .= "\t\t\t\t\t\t\t\t\t\t\t<FechaFirma>" .fdate($xxx223['ffirma']). "</FechaFirma>\n";
									}
									$salida_xml_sujeto_B .= "\t\t\t\t\t\t\t\t\t\t</Representante>\n";
								}
								$salida_xml_sujeto_B .= "\t\t\t\t\t\t\t\t\t</Representantes>\n"; 
								if(empty($xxx['ffirma'])==true){
									$salida_xml_sujeto_B.="";
								}else{  
									$salida_xml_sujeto_B .= "\t\t\t\t\t\t\t\t\t<FechaFirma>" .fdate($xxx['ffirma']). "</FechaFirma>\n";
								}
								$salida_xml_sujeto_B .= "\t\t\t\t\t\t\t\t</Sujeto>\n";
							}else if($xxx['repre']=='G' ){
								$salida_xml_sujeto_G .= "\t\t\t\t\t\t\t\t<Sujeto>\n";
								$salida_xml_sujeto_G .= "\t\t\t\t\t\t\t\t\t<IdMaestro>" .  $xxx['idcl'] . "</IdMaestro>\n";
								$idActo = $xxx['idtipoacto'];
								if($xxx['repre']=='G'){
									$reppp2G=$xxx['idcon'];
									$query91G="SELECT idcon, idcl, tipp, apepat, apemat, nom, nombre, direccion, tipodoc, numdoc, email, telfijo, telcel, 
									telofi, gen, estc, natper, conyuge, nacionalidad, profesion, detaprofesion, cargo, profocupa, dirfer, 
									idubigeo, fechanaci, fechaing, razonsocial, domfiscal, telempresa, correoemp, contacempresa, fechaconstitu, 
									idsedereg, numregistro, numpartida, actmunicipal, tipocli, impeingre, impnumof, impeorigen, impentidad, 
									impremite, impmotivo, residente, docpaisemi, kardex, firma,ffirma, resfirma, tiporepresentacion, 
									idcontratanterp, facultades, indice, visita, inscrito, condi, condicionn,condicionnsisgen, id, idtipkar, idtipoacto, 
									idcontratante, item, idcondicion, parte, porcentaje, repre, formulario, montoo, opago, fondos, montop 
									FROM sisgen_intervenciones_6  WHERE repre ='R' AND kardex='$kar' AND idcontratanterp ='$reppp2G' AND idtipoacto = '$codigoacto'";
									$resultadoD3G=mysqli_query($conn,$query91G) or die("sin resultado 17G");    
									$salida_xml_sujeto_G .= "\t\t\t\t\t\t\t\t\t<Representantes>\n";
									while($xxx223 = mysqli_fetch_array($resultadoD3G)){
										$salida_xml_sujeto_G .= "\t\t\t\t\t\t\t\t\t\t<Representante>\n"; 
										$salida_xml_sujeto_G .= "\t\t\t\t\t\t\t\t\t\t\t<IdMaestro>" . $xxx223['idcl'] . "</IdMaestro>\n";
										if($xxx223['inscrito'] == 1){
											$salida_xml_sujeto_G .= "\t\t\t\t\t\t\t\t\t\t\t<InscripcionRepresentacion>\n";
											if($xxx223['idsedereg']!=""){
												$resulValida = ValidarSede($xxx223['idsedereg']);
												if($resulValida[0]==1){
													array_push($arrKar,'Representante->'.$resulValida[1]);
												}
												$salida_xml_sujeto_G .= "\t\t\t\t\t\t\t\t\t\t\t\t<SedeRegistral>" . $xxx223['idsedereg'] . "</SedeRegistral>\n";
											}else{
												array_push($arrKar,'Representante->Falta la sede registral');
											}
											if($xxx223['numpartida']!=""){
												$resulValida = ValidarTamano('Partida Registral',12,$xxx223['numpartida']);
												if($resulValida[0]==1){
													array_push($arrKar,'Representante->'.$resulValida[1]);
												}
												$salida_xml_sujeto_G .= "\t\t\t\t\t\t\t\t\t\t\t\t<PartidaRegistral>" . trim($xxx223['numpartida']). "</PartidaRegistral>\n";
											}else{
												array_push($arrKar,'Representante->Falta la patida registral');
											}
											$salida_xml_sujeto_G .= "\t\t\t\t\t\t\t\t\t\t\t</InscripcionRepresentacion>\n";
										}	
										if(empty($xxx223['ffirma'])==true){$salida_xml_sujeto_G.="";}else{  $salida_xml_sujeto_G .= "\t\t\t\t\t\t\t\t\t\t\t<FechaFirma>" .fdate($xxx223['ffirma']). "</FechaFirma>\n";}
										$salida_xml_sujeto_G .= "\t\t\t\t\t\t\t\t\t\t</Representante>\n";
									}
									$salida_xml_sujeto_G .= "\t\t\t\t\t\t\t\t\t</Representantes>\n"; 
								}
								if(empty($xxx['ffirma'])==true){
									$salida_xml_sujeto_G.="";
								}else{  
									$salida_xml_sujeto_G .= "\t\t\t\t\t\t\t\t\t<FechaFirma>" .fdate($xxx['ffirma']). "</FechaFirma>\n";
								}
								$salida_xml_sujeto_G .= "\t\t\t\t\t\t\t\t</Sujeto>\n";
							}else if($xxx['repre']=='N' ){
								$salida_xml_sujeto_N .= "\t\t\t\t\t\t\t\t<NoInterviniente>\n";
								$salida_xml_sujeto_N .= "\t\t\t\t\t\t\t\t\t<TipoComparecencia>2</TipoComparecencia>\n";
								$salida_xml_sujeto_N .= "\t\t\t\t\t\t\t\t\t<ClaseIntervencion>3</ClaseIntervencion>\n";
								$salida_xml_sujeto_N .= "\t\t\t\t\t\t\t\t\t<IdMaestro>" .  $xxx['idcl'] . "</IdMaestro>\n";
								if($xxx['repre']=='N'){
									$reppp2N=$xxx['idcon'];
									$query91="SELECT idcon, idcl, tipp, apepat, apemat, nom, nombre, direccion, tipodoc, numdoc, email, telfijo, telcel, 
									telofi, gen, estc, natper, conyuge, nacionalidad, profesion, detaprofesion, cargo, profocupa, dirfer, 
									idubigeo, fechanaci, fechaing, razonsocial, domfiscal, telempresa, correoemp, contacempresa, fechaconstitu, 
									idsedereg, numregistro, numpartida, actmunicipal, tipocli, impeingre, impnumof, impeorigen, impentidad, 
									impremite, impmotivo, residente, docpaisemi, kardex, firma, ffirma, resfirma, tiporepresentacion, 
									idcontratanterp, facultades, indice, visita, inscrito, condi, condicionn,condicionnsisgen, id, idtipkar, idtipoacto, 
									idcontratante, item, idcondicion, parte, porcentaje, repre, formulario, montoo, opago, fondos, montop 
									FROM sisgen_intervenciones_6  WHERE repre ='R' AND kardex='$kar' AND idcontratanterp ='$reppp2N' AND idtipoacto = '$codigoacto'";
									$resultadoD3N=mysqli_query($conn,$query91) or die("sin resultado 17N");    
									while($xxx223 = mysqli_fetch_array($resultadoD3N)){
										$salida_xml_sujeto_N .= "\t\t\t\t\t\t\t\t\t\t<Representante>\n"; 
										$salida_xml_sujeto_N .= "\t\t\t\t\t\t\t\t\t\t\t<IdMaestro>" . $xxx223['idcl'] . "</IdMaestro>\n";
										if($xxx223['inscrito'] == 1){
											$salida_xml_sujeto_N .= "\t\t\t\t\t\t\t\t\t\t\t<InscripcionRepresentacion>\n";
											if($xxx223['idsedereg']!=""){
												$resulValida = ValidarSede($xxx223['idsedereg']);
												if($resulValida[0]==1){
													array_push($arrKar,'Representante->'.$resulValida[1]);
												}
												$salida_xml_sujeto_N .= "\t\t\t\t\t\t\t\t\t\t\t\t<SedeRegistral>" . $xxx223['idsedereg'] . "</SedeRegistral>\n";
											}else{
												array_push($arrKar,'Representante->Falta la sede registral');
											}
											if($xxx223['numpartida']!=""){
												$resulValida = ValidarTamano('Partida Registral',12,$xxx223['numpartida']);
												if($resulValida[0]==1){
													array_push($arrKar,'Representante->'.$resulValida[1]);
												}
												$salida_xml_sujeto_N .= "\t\t\t\t\t\t\t\t\t\t\t\t<PartidaRegistral>" . trim($xxx223['numpartida']). "</PartidaRegistral>\n";
											}else{
												array_push($arrKar,'Representante->Falta la patida registral');
											}
											$salida_xml_sujeto_N .= "\t\t\t\t\t\t\t\t\t\t\t</InscripcionRepresentacion>\n";
										}	
										if(empty($xxx223['ffirma'])==true){$salida_xml_sujeto_N.="";}
										else{  
											$salida_xml_sujeto_N .= "\t\t\t\t\t\t\t\t\t\t\t<FechaFirma>" .fdate($xxx223['ffirma']). "</FechaFirma>\n";
										}
										$salida_xml_sujeto_N .= "\t\t\t\t\t\t\t\t\t\t</Representante>\n";
									}
								}
								$salida_xml_sujeto_N .= "\t\t\t\t\t\t\t\t</NoInterviniente>\n";
							}
				//********************Conyuge*********************************
							$conyugeNoInterviniente = $arrConyuge[$xxx['idcon']];							
							if($conyugeNoInterviniente != null){
								$salida_xml_sujeto_N .= "\t\t\t\t\t\t\t\t<NoInterviniente>\n";
								$salida_xml_sujeto_N .= "\t\t\t\t\t\t\t\t\t<TipoComparecencia>3</TipoComparecencia>\n";
								$salida_xml_sujeto_N .= "\t\t\t\t\t\t\t\t\t<TipoAfectacion>1</TipoAfectacion>\n";
								$salida_xml_sujeto_N .= "\t\t\t\t\t\t\t\t\t<IdMaestro>" .  $conyugeNoInterviniente . "</IdMaestro>\n";
								$salida_xml_sujeto_N .= "\t\t\t\t\t\t\t\t</NoInterviniente>\n";								
							}						

						}
						if($salida_xml_sujeto_O == ''){
							array_push($arrKar,"Falta el otorgante");
						}
						$sq_intervencion=" SELECT idcon, idcl, tipp, apepat, apemat, nom, nombre, direccion, tipodoc, numdoc, email, telfijo, telcel, 
						telofi, gen, estc, natper, conyuge, nacionalidad, profesion, detaprofesion, cargo, profocupa, dirfer, 
						idubigeo, fechanaci, fechaing, razonsocial, domfiscal, telempresa, correoemp, contacempresa, fechaconstitu, 
						idsedereg, numregistro, numpartida, actmunicipal, tipocli, impeingre, impnumof, impeorigen, impentidad, 
						impremite, impmotivo, residente, docpaisemi, kardex, firma, STR_TO_DATE(ffirma,'%d/%m/%Y') AS ffirma, resfirma, tiporepresentacion, 
						idcontratanterp, facultades, indice, visita, inscrito, condi, condicionn,condicionnsisgen, id, idtipkar, idtipoacto, 
						idcontratante, item, idcondicion, parte, porcentaje, repre, formulario, montoo, opago, fondos, montop 
						FROM sisgen_intervenciones_6  where kardex='$kar' and idtipoacto = '$codigoacto'
						GROUP BY repre ORDER BY repre ASC";			
						$resultadoD11=mysqli_query($conn,$sq_intervencion) or die("sin resultado 11");
						$salida_xml_O = '';
						$salida_xml_B = '';
						$salida_xml_G = '';
						$salida_xml_N = '';
						while($xxx11 = mysqli_fetch_array($resultadoD11)){
							if($xxx11['repre']=='O' and $salida_xml_O == '' ){    
								$salida_xml_O .= "\t\t\t\t\t\t<Intervencion>\n"; 
								$salida_xml_O .= "\t\t\t\t\t\t\t<TipoIntervencion>" .$xxx11['parte']  . "</TipoIntervencion>\n";
								$salida_xml_O .= "\t\t\t\t\t\t\t<DescripcionIntervencion>" .$xxx11['condicionnsisgen']. "</DescripcionIntervencion>\n";
								if($xxx11['condicionnsisgen']=="" or $xxx11['condicionnsisgen'] == null){
									array_push($arrKar,"Falta el codigo sisgen del Otorgante");
								}
								$salida_xml_O .= "\t\t\t\t\t\t\t<RolRepresentante>" .$xxx11['repre']. "</RolRepresentante>\n";
								$salida_xml_O .= "\t\t\t\t\t\t\t<Sujetos>\n";
								$salida_xml_O .= $salida_xml_sujeto_O;						
								$salida_xml_O .= "\t\t\t\t\t\t\t</Sujetos>\n";
								$salida_xml_O .= "\t\t\t\t\t\t</Intervencion>\n"; 
		
							}else if($xxx11['repre']=='B'and $salida_xml_B == '' ){      
								$salida_xml_B .= "\t\t\t\t\t\t<Intervencion>\n"; 
								$salida_xml_B .= "\t\t\t\t\t\t\t<TipoIntervencion>" .$xxx11['parte']  . "</TipoIntervencion>\n";
								$salida_xml_B .= "\t\t\t\t\t\t\t<DescripcionIntervencion>" .$xxx11['condicionnsisgen']. "</DescripcionIntervencion>\n";
								if($xxx11['condicionnsisgen']=="" or $xxx11['condicionnsisgen'] == null){
									array_push($arrKar,"Falta el codigo sisgen del Beneficiario");
								}						
								$salida_xml_B .= "\t\t\t\t\t\t\t<RolRepresentante>" .$xxx11['repre']. "</RolRepresentante>\n";
								$salida_xml_B .= "\t\t\t\t\t\t\t<Sujetos>\n";
								$salida_xml_B .= $salida_xml_sujeto_B;						
								$salida_xml_B .= "\t\t\t\t\t\t\t</Sujetos>\n";
								$salida_xml_B .= "\t\t\t\t\t\t</Intervencion>\n"; 
							}else if($xxx11['repre']=='G'and $salida_xml_G == '' ){      
								$salida_xml_G .= "\t\t\t\t\t\t<Intervencion>\n"; 
								$salida_xml_G .= "\t\t\t\t\t\t\t<TipoIntervencion>3</TipoIntervencion>\n";
								$salida_xml_G .= "\t\t\t\t\t\t\t<DescripcionIntervencion>" .$xxx11['condicionnsisgen']. "</DescripcionIntervencion>\n";
								if($xxx11['condicionnsisgen']=="" or $xxx11['condicionnsisgen'] == null){
									array_push($arrKar,"Falta el codigo sisgen del Garante");
								}
								$salida_xml_G .= "\t\t\t\t\t\t\t<RolRepresentante>" .$xxx11['repre']. "</RolRepresentante>\n";
								$salida_xml_G .= "\t\t\t\t\t\t\t<Sujetos>\n";
								$salida_xml_G .= $salida_xml_sujeto_G;						
								$salida_xml_G .= "\t\t\t\t\t\t\t</Sujetos>\n";
								$salida_xml_G .= "\t\t\t\t\t\t</Intervencion>\n"; 
							}
						}
						$salida_kardex .=	"\t\t\t\t\t<Intervenciones>\n";
						$salida_kardex .=	$salida_xml_O;
						$salida_kardex .=	$salida_xml_B;
						$salida_kardex .=	$salida_xml_G;
						$salida_kardex .=	"\t\t\t\t\t</Intervenciones>\n";
						$salida_kardex .=	"\t\t\t\t\t<NoIntervinientes>\n";
						$salida_kardex .=	$salida_xml_sujeto_N;
						$salida_kardex .=	"\t\t\t\t\t</NoIntervinientes>\n";
						$salida_kardex .= "\t\t\t</Operantes>\n"; 
						//Fin Intervencion
						$resultado15 = mysqli_query($conn,$sq_cuantiadeoperacion) or die("sin resultado 18"); 
						while($x15 = mysqli_fetch_array($resultado15)){ 
							
								$salida_kardex .= "\t\t\t\t<CuantiaOperacion>\n"; 
								if($x15['importetrans']==""){$salida_kardex.="";}else{$salida_kardex .= "\t\t\t\t\t<Cuantia>" . $x15['importetrans'] . "</Cuantia>\n";} 
								if($x15['tipomon']=="" or $x15['tipomon']==0 ){$salida_kardex.="";}else{ $salida_kardex .= "\t\t\t\t\t<TipoMoneda>" . $x15['tipomon'] . "</TipoMoneda>\n";}
								$salida_kardex .= "\t\t\t\t</CuantiaOperacion>\n"; 
						} 
						//mediopago
						$sq_mediosdepago="SELECT dm.detmp,  dm.itemmp,  dm.kardex,  dm.tipacto,  dm.codmepag,
						dm.fpago AS fechaope ,  CONCAT ('000',bc.codbancos) AS idbancos,  dm.importemp AS importetrans,  dm.idmon,  dm.foperacion,  dm.documentos AS idpago,
						mp.codmepag ,  mp.uif,  mp.cod_sisgen AS idmediop,  mp.desmpagos,
						mo.codmon AS tipomon,op.idoppago AS oport, pa.exhibiomp AS exxx, pa.nminuta AS fechaminuta,fp.codigo AS codigofp, SUBSTRING(pa.des_idoppago,1,40) AS des_idppago
						FROM sisgen_temp					
						INNER JOIN patrimonial pa ON pa.kardex=sisgen_temp.kardex 					
						INNER JOIN detallemediopago dm ON dm.itemmp = pa.itemmp	AND dm.kardex = pa.kardex				
						LEFT JOIN mediospago mp	ON dm.codmepag=mp.codmepag
						LEFT JOIN monedas mo ON dm.idmon=mo.idmon
						LEFT JOIN oporpago op	ON pa.idoppago=op.codoppago
						LEFT JOIN bancos bc ON dm.idbancos= bc.idbancos
						LEFT JOIN fpago_uif fp ON fp.id_fpago=pa.fpago
						WHERE pa.kardex='$kar' AND pa.idtipoacto = '$codigoacto' AND dm.tipacto = '$codigoacto' GROUP BY detmp";
						$resultado5=mysqli_query($conn,$sq_mediosdepago) or die("sin resultado 19"); 
						$salida_kardex .= "\t\t\t\t<MediosPagos>\n";
						while($x5 = mysqli_fetch_array($resultado5)){ 
							$salida_kardex .= "\t\t\t\t<MediosPago>\n"; 
							if($x5['idmediop']=="" or $x5['idmediop']==0 ){$salida_kardex.="";}else{  $salida_kardex .= "\t\t\t\t\t<MedioPago>" . $x5['idmediop'] . "</MedioPago>\n";}
							if($x5['codigofp']!=null ){								
								$salida_kardex .= "\t\t\t\t\t<FormaPago>" . $x5['codigofp']. "</FormaPago>\n";
							}						
							if($x5['oport']=="" or $x5['oport']==0 or $x5['oport']==9 or $x5['oport']==10){$salida_kardex.="";}else{ $salida_kardex .= "\t\t\t\t\t<MomentoPago>" . $x5['oport']. "</MomentoPago>\n";}
							if($x5['oport']!="8"  ){
								$salida_kardex.="";
							}else{ 
								if($x5['des_idppago']==''){
									$salida_kardex .= "\t\t\t\t\t<DescripcionMomentoPago>NO PRECISA</DescripcionMomentoPago>\n";
								}else{
									$salida_kardex .= "\t\t\t\t\t<DescripcionMomentoPago>" . $x5['des_idppago']. "</DescripcionMomentoPago>\n";
								}
							}
							if($x5['importetrans']!="" ){								
								$salida_kardex .= "\t\t\t\t\t<CuantiaPago>" . $x5['importetrans'] . "</CuantiaPago>\n";
							}else{
								array_push($arrKar,'Falta monto en medio de pago');
							}           
							if($x5['tipomon']!="" and $x5['tipomon']!=0 ){ 
								$resulValida = ValidarMoneda($x5['tipomon'],$codActoSisgen);
								if($resulValida[0]==1){
									array_push($arrKar,'MediosPagos->'.$resulValida[1]);
								}
								$salida_kardex .= "\t\t\t\t\t<TipoMonedaPago>" . $x5['tipomon'] . "</TipoMonedaPago>\n";
							}else if($x5['importetrans']>0){
									array_push($arrKar,'Falta Tipo de moneda en medio de pago->'.$x5['importetrans']);
							}
							if($x5['exxx']=="" ){
								$salida_kardex.="";
							}else{ 
								$salida_kardex .= "\t\t\t\t\t<JustificadoManifestado>" .($x5['exxx']=="SI"?1:0). "</JustificadoManifestado>\n";
							}						
							if($x5['foperacion']=="" or $x5['foperacion']==0 ){$salida_kardex.="";}else{ $salida_kardex .= "\t\t\t\t\t<FechaPago>" . fdate($x5['foperacion']) . "</FechaPago>\n";}
							if($x5['idpago']=="" or $x5['idpago']==0 ){$salida_kardex.="";}
							else{   
								$resulValida = ValidarTamano('Numero de operacion',50,$x5['idpago']);
								if($resulValida[0]==1){
									array_push($arrKar,'Medio de pago('.$x5['importetrans'].')->'.$resulValida[1]);
								}
								$salida_kardex .= "\t\t\t\t\t<IdPago>" .  $x5['idpago'] . "</IdPago>\n";
							}
							if($x5['idbancos']=="" or $x5['idbancos']==0 ){$salida_kardex.="";}else{  $salida_kardex .= "\t\t\t\t\t<EntidadFinanciera>" . $x5['idbancos']. "</EntidadFinanciera>\n";}
							$salida_kardex .= "\t\t\t\t</MediosPago>\n";
								
						}
						$salida_kardex .= "\t\t\t\t</MediosPagos>\n";
						$resultJuridica = validarStringJuridica($kardcant['desacto']);
						if($resultJuridica[0]>0){
							array_push($arrKar,'Nombre Contrato-> tiene caracteres no permitidos');
						}	
						if($kardcant['desacto']!=""){
							$salida_kardex .= "\t\t\t\t\t<NombreContrato>" . mb_substr($kardcant['desacto'],0,30) . "</NombreContrato>\n";
						}
						$resultado6=mysqli_query($conn,$querymediopago) or die("sin resultado 20"); 
						while($x6 = mysqli_fetch_array($resultado6)){ 
						if($x6['fechaminuta']==""){$salida_kardex.="";}else{  $salida_kardex .= "\t\t\t\t\t<FechaMinuta>" .  fdate($x6['fechaminuta']). "</FechaMinuta>\n";}}
						$salida_kardex .= "\t\t</Operacion>\n"; 
					}
				}	
			}				 
			if(count($arrKar)>0){
				$tienerror = 1;
				array_push($errorListKar, array('idkardex'=>$idkar,'kardex'=>$kar,'acto'=>$actos[$countActo],'error'=>$arrKar ));
			} 
			if(count($arrKarObs)>0){
				array_push($errorListKarObs, array('idkardex'=>$idkar,'kardex'=>$kar,'acto'=>$actos[$countActo],'error'=>$arrKarObs ));
			} 
			$countActo++;
		}					 
		$salida_kardex .= "\t</Operaciones>\n";
		$salida_kardex .= "\t</DocumentoNotarial>\n\n";


		if($isNoCorre != ''){
			$salida_kardex = $isNoCorre;
			$tienerror = 0;
		}
		
		if($tienerror == 0 || $simpleKardex == 1){
			$salida_xml .=$salida_kardex;
		}else{
			$salida_kardex_error .=$salida_kardex;
		}
		
	}

    return array($salida_xml,
				$errorListKar,
				$errorListKarObs,
				$arrPersonasErr);
}


$varss = 1;


