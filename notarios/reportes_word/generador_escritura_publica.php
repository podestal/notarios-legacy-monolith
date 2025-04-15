<?php 
require_once 'Phpdocx/Create/CreateDocx.inc';
session_start(); 

function escritura_publica(){
	
	//P TRANSFERENTE, VENDEDOR
	//C COMPRADOR, ADQUIRIENTE
	## 1.-CARGARMOS LAS LIBRERIAS
	include('../conexion.php');
	include('../conexion2.php');
	include('../extraprotocolares/view/funciones.php');
	include('../includes/tbs_class.php');
	include('../includes/tbs_plugin_opentbs.php');
	include('../includes/ClaseLetras.class.php');
	include('fecha_letra.php');

	$num_kardex = $_REQUEST["num_kardex"];
	$accion = $_REQUEST["accion"];
	$idtipoacto = $_REQUEST['idtipoacto'];
	$idTemplate = $_REQUEST['idTemplate'];
	$idtipkar = $_REQUEST['idtipkar'];

	$arrKardex = explode('-',$num_kardex);
	$anioKardex = $arrKardex[1];

	//print_r($idTemplate);return false;
	if ($idTemplate==0 || $idTemplate=='') exit("Seleccione una Plantilla");

	// $rutaPlantilla="C://Doc_Generados/templates/PROTOCOLARES/ESCRITURAS/";
	$rutaPlantilla="D:/plantillas/PROTOCOLARES/ESCRITURAS PUBLICAS/";
	$rutaDocumentoGenerado="C:/Proyectos/Escrituras/".$anioKardex."/";

	//COMPROBACION DE SI EXISTE O NO EL DIRECTORIO DONDE SE CREARA EL DOCUMENTO
	if(!file_exists($rutaDocumentoGenerado)){
		mkdir($rutaDocumentoGenerado,0700);
	}

	$txtListContratantes=array();
		

		## 2.-RECIBIMOS EL KARDEX Y LO CARGAMOS

		$sql_idtipacto		= mysqli_query($conn_i,"select codactos from kardex where kardex='$num_kardex'") or die(mysqli_error($conn_i));
		$row_idtipacto		= mysqli_fetch_array($sql_idtipacto);	
		$idtipacto       	= $row_idtipacto["codactos"];	
		## 3.-EXTENSION DE LA PLANTILLA SEGUN CONFIGURACION
		
		$resultTransferencia = consulta_escritura($num_kardex,$idtipacto,$idTemplate);
		//   print_r($resultTransferencia);return false;
		## 4.-SELECCION DE LA PLANTILLA
		$uri_plantilla = $resultTransferencia['plantilla'];
		$url_plantilla = $resultTransferencia['url_plantilla'];
		$plantilla = $url_plantilla.$uri_plantilla;
		//$plantilla = 'PERSONAS JURIDICAS/S.R.L/CONSTITUCION DE UNA SRL BASE.docx';
		// print_r($plantilla);return false;

		$titulo="";
		/*23 ES PROYECTO, 15 ES KARDEX, POR DEFECTO ES 23. LUEGO TOMAMOS EL 15 PARA DECIRLE QUE ES TIPOKARDEX DE TODAS FORMAS.*/ 
		if($_REQUEST["tipo"]==23){
			$tipo = 15;
			$tipoGuardar = 23;
		}
		
		if($accion=='actualizar'){
			$queryEscritura = "SELECT kardex,numescritura FROM kardex WHERE kardex='$num_kardex' and idtipkar='$idtipkar'";
			$resultEscritura =mysqli_query($conn_i,$queryEscritura) or die (mysqli_error($conn_i));
			$numeroEscritura = mysqli_fetch_assoc($resultEscritura);
			
			if($numeroEscritura['numescritura'] == '' || $numeroEscritura['numescritura'] == null){
				exit('ERROR: FALTA GRABAR NUMERO DE ACTA');
			}

			$template = $rutaDocumentoGenerado.'__PROY__'.$num_kardex.'.docx';
			// print_r($template);return false;
		}else if($accion=='parte'){
			$queryFirma ="SELECT idcontratante,firma,fechafirma FROM contratantes where kardex='$num_kardex' and firma=1";
			$resultFirma = mysqli_query($conn_i,$queryFirma) or die (mysqli_error($conn_i));
			//$firma = mysqli_fetch_assoc($resultFirma);
			while($row=mysqli_fetch_assoc($resultFirma)){
				
				if($row['firma']==1 && ($row['fechafirma']=='' || $row['fechafirma']==null)){
					exit('ERROR: FALTA COMPLETAR FIRMAS DE LOS CONTRATANTES');
				}
			}
			$template = 'D:/plantillas/parte testimonio E INSERTOS/PARTE TRANSFERENCIA.docx';
		}else{

			$template = $rutaPlantilla.$plantilla;
		}
				
		
		$dataDocumento = get_data_documento($resultTransferencia);
		// print_r($dataDocumento);return false;
		
		$dataVehiculos = get_data_vehiculos($resultTransferencia);
		$dataPagos = get_data_pagos($resultTransferencia);
		
		
		$dataContratantes = get_data_contratantes($resultTransferencia);
		// print_r($dataContratantes);return false;
		// return false;

		
		$totalDataTransferentes = count($dataContratantes['transferentes']);
		$totalDataAdquirientes = count($dataContratantes['adquirientes']);
		
		
		$dataContratantesVaciosTrans = get_data_contratantes_vacios($dataContratantes,'transferentes','P');
		$dataContratantes = $dataContratantesVaciosTrans;
		
		$dataContratantesVaciosAdq = get_data_contratantes_vacios($dataContratantes,'adquirientes','C');
		$dataContratantes = $dataContratantesVaciosAdq;
		
		$dataContratantesVaciosEmp = get_data_empresas_vacios($dataContratantes,'empresas');
		
		$dataContratantes = $dataContratantesVaciosEmp;
		 //print_r($dataContratantes);return false;

		$articulosContratantes = array(
			'EL_P'=>$dataContratantes['EL_P'].' ',
			'EL_C'=>$dataContratantes['EL_C'].' ',	
			'CALIDAD_P'=>$dataContratantes['CALIDAD_P'],	
			'CALIDAD_C'=>$dataContratantes['CALIDAD_C'],	
			'Y_P'=>' y ',
			'AMBOS'=>' AMBOS ',
			'S_P'=>'  ', //PLURAL DE SI ES REPRESENTANTE O REPRESENTANTES
			'ES_P'=>'  ',

			'INICIO_C' => $dataContratantes['INICIO_C'], 
			'ES_C' => $dataContratantes['ES_C'],
			'S_C' => $dataContratantes['S_C'], 
			'ES_SON_C' => $dataContratantes['ES_SON_C'],
			'Y_CON_C' => $dataContratantes['Y_CON_C'],
			'N_C' => $dataContratantes['N_C'],
			'Y_C' => $dataContratantes['Y_C'],
			'L_C' => $dataContratantes['L_C'],
			'O_A_C' => $dataContratantes['O_A_C'],
			'O_ERON_C' => $dataContratantes['O_ERON_C'],
			'O_ARON_C' => $dataContratantes['O_ARON_C'],
			'C_FIRMA' => $dataContratantes['C_FIRMA'],
			'C_AMBOS' => $dataContratantes['C_AMBOS'],
		
			'INICIO_P' => $dataContratantes['INICIO_P'],
			'ES_P' => $dataContratantes['ES_P'],
			'S_P' => $dataContratantes['S_P'], 
			'ES_SON_P' => $dataContratantes['ES_SON_P'],
			'Y_CON_P' => $dataContratantes['Y_PON_P'],
			'N_P' => $dataContratantes['N_P'],
			'Y_P' => $dataContratantes['Y_P'],
			'L_P' => $dataContratantes['L_P'],
			'O_A_P' => $dataContratantes['O_A_P'],
			'O_ERON_P' => $dataContratantes['O_ERON_P'],
			'O_ARON_P' => $dataContratantes['O_ARON_P'],
			'P_FIRMA' => $dataContratantes['P_FIRMA'],
			'P_AMBOS' => $dataContratantes['P_AMBOS'],
		);
		
				
		
		$dataEscrituracion = get_data_escrituracion($resultTransferencia);
		
		// print_r($dataContratantes);return false;
		
		## 5.-CREAMOS EL OBJETO DONDE GENERAREMOS EL DOCUMENTO	
		$TBS = new clsTinyButStrong; 
		$TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN);
		$suffix = '';
		$debug  = '';
		## 6.-VALIDACION DE LA EXISTENCIA DE PLANTILLA

		$x = pathinfo($template);
		$template_ext  = $x['extension'];
		$template_name = $x['basename'];		
		if (!file_exists($template)) exit("Ruta o nombre de la plantilla definido Incorrectamente.".$template);

		
		if($accion=='actualizar'){
			$file_name  = $rutaDocumentoGenerado."__PROY__".$num_kardex."-actualizado."."docx";
		}else if($accion=='parte'){
			$file_name  = $rutaDocumentoGenerado."__PARTE__".$num_kardex."."."docx";

			$dataDocumento['NOMBRE_ACTO'] = $resultTransferencia['nombre_plantilla'];
		}else{
			$file_name  = $rutaDocumentoGenerado."__PROY__".$num_kardex."."."docx";
		}

		
		
		$contratantes=array();

		// print_r($dataContratantes['empresas']);return false;

		foreach($dataContratantes['transferentes'] as $key => $value){ 
			$contratantes += $value;
		}
		foreach($dataContratantes['adquirientes'] as $key => $value){ 
			$contratantes += $value;
		}
		foreach($dataContratantes['empresas'] as $key => $value){ 
			$contratantes += $value;
		}
		

		$dataDocumento += $dataVehiculos;
		$dataDocumento += $dataPagos;
		$dataDocumento += $contratantes;
		$dataDocumento += $articulosContratantes;
		$dataDocumento += $dataEscrituracion;
		$dataDocumentoWord[] = $dataDocumento;

		//print_r($dataDocumento);return false;
		$TBS->NoErr = true;
		$TBS->LoadTemplate($template);
		$TBS->MergeBlock('E',$dataDocumentoWord);
		$TBS->PlugIn(OPENTBS_DELETE_COMMENTS);
		$TBS->Show(TBSZIP_FILE, $file_name);				
	

	$sql="select * from servidor where idservidor='1'";
	$rpta=mysqli_query($conn_i,$sql) or die(mysqli_error($conn_i));
	$row=mysqli_fetch_array($rpta);
	$server = $row['nombre'];

	if($server=="WINDOWS"){
		$directorio="\\"."\\".$server;
	}else if($row["so"]=="LINUX"){
		$directorio="";
	} 

	$directorio.= $rutaDocumentoGenerado."__PROY__".$num_kardex.".docx";

	chmod($directorio, 0777);

	
	if($accion=='actualizar'){
		echo $num_kardex;
	}else if($accion=='parte'){
		echo $num_kardex;
	}else{
		echo "Se genero el archivo: ".$num_kardex." satisfactoriamente.. !!";
	}
	
	/*	mysql_query("update estadokardex set generado_proyecto='1' where kardex='".$num_kardex."'",$conn) or die(mysql_error());
	*/
}

escritura_publica();

function get_data_documento($resultTransferencia){

	$letras = new ClaseNumeroLetra();

	$numeroActa = ($resultTransferencia['numero_escritura']=='')?'[E.NRO_ESC]':$resultTransferencia['numero_escritura'].'('.$letras->fun_nume_letras($resultTransferencia['numero_escritura']).')';

	$fechaImpresion = ($resultTransferencia['fecha_escritura']==0)?'[E.F_IMPRESION]':$letras->fun_fech_letras($resultTransferencia['fecha_escritura']);

	$fechaActa = ($resultTransferencia['fecha_escritura']==0)?'[E.F]':$letras->fun_fech_letras($resultTransferencia['fecha_escritura']);

	$numeroMinuta = ($resultTransferencia['numero_minuta']=='')?'[E.NRO_MIN]':$resultTransferencia['numero_minuta'];

	if(trim($resultTransferencia['sede_colegio'])=='PUNO'){
		$sede = 'CAP.';
	}
	if(trim($resultTransferencia['sede_colegio'])=='AREQUIPA'){
		$sede = 'CAA.';
	}
	
	$dataDocumento= array(
		'NRO_ESC' => $numeroActa,
		// 'NUM_ESC_LET' => $letras->fun_nume_letras($numeroActa),
		'K'=>$resultTransferencia['kardex'],
		'NUM_REG'=>'1',
		'FEC_LET'=>$letras->fun_fech_letras($resultTransferencia['fecha_escritura']),
		'F_IMPRESION'=>$fechaImpresion,
		'USUARIO'=>$resultTransferencia['usuario'],
		'USUARIO_DNI'=>$resultTransferencia['dni_usuario'],
		'NRO_MIN'=>$numeroMinuta,
		'COMPROBANTE'=>'sin',
		'O_S'=>$resultTransferencia['kardex'], //ORDEN DE SERVICIO
		'ORDEN_SERVICIO'=>$resultTransferencia['kardex'],
		'F'=>$fechaActa,
		'DESCRIPCION_SELLO'=>$resultTransferencia['abogado'].' '.$sede.' '.$resultTransferencia['matricula'],
	);
	return $dataDocumento;
}

function consulta_escritura($num_kardex,$idtipacto,$idTemplate){
	$query="SELECT k.idkardex as id_kardex,
					k.kardex,
					k.numescritura as numero_escritura,
					k.fechaescritura as fecha_escritura,
					k.txa_minuta as registro_escritura,
					CURRENT_DATE() as fecha_generado,
					k.fechaconclusion as fecha_conclusion,
					k.numminuta as numero_minuta,
					FN_ONLYNUM(k.kardex) AS numero,
					k.kardexconexo as kardex_conexo,
					k.folioini as folio_inicial, 
					k.foliofin as folio_final, 
					k.papelini as papel_inicial, 
					k.papelfin as papel_final,
					(SELECT desacto FROM tiposdeacto WHERE idtipoacto='$idtipacto') as acto,
					(SELECT fileName FROM tpl_template WHERE pkTemplate=$idTemplate) as plantilla,
					(SELECT urlTemplate FROM tpl_template WHERE pkTemplate=$idTemplate) as url_plantilla,
					k.fechaingreso as fecha_ingreso,
					k.responsable_new as usuario,
					abo.razonsocial as abogado,
					abo.matricula as matricula,
					abo.sede_colegio as sede_colegio,
					usu.dni as dni_usuario,
					GROUP_CONCAT(c2.idcliente) as id_cliente,
					GROUP_CONCAT(IF(c2.conyuge='','NO',c2.conyuge)) as id_conyuge,
					GROUP_CONCAT(cxa.idcontratante) as id_contratante,
					GROUP_CONCAT(TRIM(CONCAT(IFNULL(c2.prinom, ''), ' ', IFNULL(c2.segnom, ''), IF(c2.segnom='','',' ') ,IFNULL(c2.`apepat`, ''), ' ',IFNULL(c2.apemat, ''),
				IFNULL(c2.razonsocial, '')))) AS nombres,
					GROUP_CONCAT(cxa.uif) as uif,
					GROUP_CONCAT(ac.condicion) as condicion,
					GROUP_CONCAT(IF(n.descripcion=0,n.descripcion,'EMPRESA')) as nacionalidad,
					GROUP_CONCAT(td.destipdoc) as tipo_documento,
					GROUP_CONCAT(c2.numdoc) AS numero_documento,
					GROUP_CONCAT(UPPER(c2.profesion_plantilla)) AS ocupacion,
					GROUP_CONCAT(IF(tec.desestcivil=0,tec.desestcivil,'EMPRESA')) as estado_civil,
					GROUP_CONCAT(IF(c2.tipper='N',c2.direccion,c2.domfiscal) SEPARATOR ',,') as direccion,
					-- GROUP_CONCAT(c2.domfiscal) as domicilio_fiscal,
					-- GROUP_CONCAT(c2.direccion) as direccion,
					GROUP_CONCAT(IFNULL(u.codpto, '')) as codigo_departamento,
					GROUP_CONCAT(IFNULL(u.coddis, '')) as codigo_distrito,
					GROUP_CONCAT(IFNULL(u.codprov, '')) as codigo_provincia,
					-- GROUP_CONCAT(IFNULL(u.nomdis, '')) as distrito,
					GROUP_CONCAT(IFNULL(IF(SUBSTRING_INDEX(c2.ubigeo_plantilla, '/', -1)='',u.nomdis,SUBSTRING_INDEX(c2.ubigeo_plantilla, '/', -1)),(IFNULL(u.nomdis, '')))) AS distrito,
					GROUP_CONCAT(IFNULL(u.nomprov, '')) as provincia,
					GROUP_CONCAT(IFNULL(u.nomdpto, '')) as departamento,
					GROUP_CONCAT(c2.sexo) AS sexo,
					GROUP_CONCAT(c2.tipper) as tipo_persona,
					GROUP_CONCAT(IF(cn.firma = '0', 'NO', 'SI')) AS firma,
					GROUP_CONCAT(cn.firma) as n_firma,
					GROUP_CONCAT(cn.tiporepresentacion) AS tipo_representacion,
					dv.numplaca AS placa, 
					dv.marca AS marca, 
					dv.clase AS clase,
					dv.anofab AS anio,
					dv.numserie AS serie, 
					dv.color AS color,
					dv.motor AS motor, 
					dv.modelo AS modelo, 
					dv.carroceria AS carroceria,
					dv.pregistral as partida,
					dv.fecinsc AS fecha_inscripcion,
					dv.`combustible` AS combustible,
					UPPER(sr.dessede) AS sede,
					UPPER(sr.num_zona) AS numero_zona,
					pat.importetrans AS precio , 
					pat.idmon AS moneda,
					pat.exhibiomp, 
					pat.idoppago, 
					uif.descripcion AS medio_pago, 
					mon.simbolo as simbolo_moneda,
					mon.desmon as descripcion_moneda,
					mp.desmpagos as descripcion_medio_pago,
					mp.sunat as sunat_medio_pago,
					GROUP_CONCAT(cnr.idcontratanterp) as id_empresa,
					GROUP_CONCAT(TRIM(CONCAT(IFNULL(cr2.prinom, ''), ' ', IFNULL(cr2.segnom, ''), IF(cr2.segnom='','',' ') ,IFNULL(cr2.apepat, ''), ' ',IFNULL(cr2.apemat, ''),
				IFNULL(cr2.razonsocial, '')))) AS nombre_empresa,
					GROUP_CONCAT(cr2.tipper) as tipo_persona_empresa,
					GROUP_CONCAT(acr.condicion) as condicion_empresa,
					GROUP_CONCAT(tdr.destipdoc) as tipo_documento_empresa,
					GROUP_CONCAT(cr2.numdoc) AS numero_documento_empresa,
					GROUP_CONCAT(cr2.domfiscal) as domicilio_empresa,
					GROUP_CONCAT(ur.nomdis) as distrito_empresa,
					GROUP_CONCAT(ur.nomprov) as provincia_empresa,
					GROUP_CONCAT(ur.nomdpto) as departamento_empresa,
					GROUP_CONCAT(srr2.zona_depar SEPARATOR ',,') as oficina_registral,
					GROUP_CONCAT(cr2.numpartida) as numero_partida,
					dmp.foperacion as fecha_operacion,
					dmp.documentos as documentos,
					ban.desbanco as banco
				FROM kardex as k
				LEFT JOIN tb_abogado as abo on abo.idabogado=k.idabogado
				LEFT JOIN usuarios as usu on usu.idusuario=k.idusuario
				LEFT JOIN contratantesxacto as cxa on cxa.kardex=k.kardex
				LEFT JOIN actocondicion as ac ON cxa.idcondicion=ac.idcondicion
				LEFT JOIN contratantes cn ON cxa.idcontratante = cn.idcontratante
				LEFT JOIN cliente2 as c2 on c2.idcontratante=cxa.idcontratante
				LEFT JOIN nacionalidades as n on n.idnacionalidad=c2.nacionalidad
				LEFT JOIN tipodocumento as td ON td.idtipdoc = c2.idtipdoc
				LEFT OUTER JOIN tipoestacivil as tec ON tec.idestcivil = c2.idestcivil
				LEFT OUTER JOIN ubigeo as u ON u.coddis = c2.idubigeo
				LEFT JOIN detallevehicular as dv ON dv.kardex=k.kardex
				LEFT JOIN sedesregistrales as sr ON sr.idsedereg=dv.idsedereg
				LEFT JOIN patrimonial as pat ON pat.kardex=k.kardex
				LEFT JOIN fpago_uif as uif ON uif.id_fpago = pat.fpago
				LEFT JOIN monedas as mon ON mon.idmon = pat.idmon
				LEFT JOIN detallemediopago as dmp ON pat.kardex = dmp.kardex
				LEFT JOIN mediospago as mp ON dmp.codmepag = mp.codmepag
				LEFT JOIN contratantes as cnr ON cxa.idcontratante = cnr.idcontratante
				LEFT JOIN contratantesxacto as cxar on cxar.idcontratante=cnr.idcontratanterp
				LEFT JOIN actocondicion as acr ON acr.idcondicion=cxar.idcondicion
				LEFT JOIN cliente2 as cr2 on cr2.idcontratante=cnr.idcontratanterp
				left JOIN nacionalidades as nr on nr.idnacionalidad=cr2.nacionalidad
				LEFT JOIN sedesregistrales as srr2 on srr2.idsedereg=cr2.idsedereg
				LEFT JOIN tipodocumento as tdr ON tdr.idtipdoc = cr2.idtipdoc
				LEFT OUTER JOIN tipoestacivil as tecr ON tecr.idestcivil = cr2.idestcivil
				LEFT OUTER JOIN ubigeo as ur ON ur.coddis = cr2.idubigeo
				LEFT JOIN  bancos as ban ON ban.idbancos=dmp.idbancos
				WHERE k.kardex='$num_kardex' and (c2.tipper='N')
				GROUP BY k.idkardex, dmp.detmp LIMIT 1";


		$resultTransferencia = mysql_query($query);
		$row = mysql_fetch_assoc($resultTransferencia);
		return $row;
}

function get_data_vehiculos($resultTransferencia){

	$sede_registral = explode('-',$resultTransferencia['sede']);

	$dataVehiculos=array(
		'PLACA'=> strtoupper($resultTransferencia['placa']),
		'CLASE'=> strtoupper($resultTransferencia['clase']),
		'MARCA'=> strtoupper($resultTransferencia['marca']),
		'MODELO'=> strtoupper($resultTransferencia['modelo']),
		'AÑO_FABRICACION'=> strtoupper($resultTransferencia['anio']),
		'CARROCERIA'=> strtoupper($resultTransferencia['carroceria']),
		'COLOR'=> strtoupper($resultTransferencia['color']),
		'NRO_MOTOR'=> strtoupper($resultTransferencia['motor']),
		'NRO_SERIE'=> strtoupper($resultTransferencia['serie']),
		'FEC_INS'=> strtoupper($resultTransferencia['fecha_inscripcion']),
		'FECHA_INSCRIPCION'=> strtoupper($resultTransferencia['fecha_inscripcion']),
		'ZONA_REGISTRAL'=> strtoupper($resultTransferencia['sede']),
		'NUM_ZONA_REG'=> strtoupper($resultTransferencia['numero_zona']),
		'SEDE'=> trim(strtoupper($sede_registral[1])),
		'INSTRUIDO'=> ' ',
		'COMBUSTIBLE'=> ' ',
		'NRO_TARJETA'=> ' ',
	);

	return $dataVehiculos;
}
function get_data_pagos($resultTransferencia){

	switch ($resultTransferencia['sunat_medio_pago']) {
		case '008':
			$medioPago = 'EL COMPRADOR DECLARA QUE HA PAGADO EL PRECIO DEL VEHICULO EN DINERO EN EFECTIVO. NO HABIENDO UTILIZADO NINGÚN MEDIO DE PAGO ESTABLECIDO EN LA LEY Nº 28194, PORQUE EL MONTO TOTAL NO ES IGUAL NI SUPERA LOS S/ 3,500.00 O US$ 1,000.00. EL TIPO Y CÓDIGO DEL MEDIO EMPLEADO ES: "EFECTIVO POR OPERACIONES EN LAS QUE NO EXISTE OBLIGACIÓN DE UTILIZAR MEDIOS DE PAGO-008". INAPLICABLE LA LEY 30730 POR SER EL PAGO DEL PRECIO INFERIOR A 3 UIT.';
			$exhibioMedioPago = 'SE DEJA CONSTANCIA QUE PARA LA REALIZACIÓN DEL PRESENTE ACTO, LAS PARTES NO ME HAN EXHIBIDO NINGÚN MEDIO DE PAGO. DOY FE.';
			$finMedioPago = 'EN DINERO EN EFECTIVO';
			$formaPago = 'AL CONTADO CON DINERO EN EFECTIVO';
			break;
		case '009':
			$medioPago = 'EL COMPRADOR DECLARA QUE HA PAGADO EL PRECIO DEL VEHICULO EN DINERO EN EFECTIVO Y CON ANTERIORIDAD A LA CELEBRACION DE LA PRESENTE ACTA DE TRANSFERENCIA. NO HABIENDO UTILIZADO NINGÚN MEDIO DE PAGO ESTABLECIDO EN LA LEY Nº 28194, EL TIPO Y CÓDIGO DEL MEDIO EMPLEADO ES: "EFECTIVO POR OPERACIONES EN LAS QUE NO EXISTE OBLIGACIÓN DE UTILIZAR MEDIOS DE PAGO-009". INAPLICABLE LA LEY 30730 POR SER EL PAGO DEL PRECIO INFERIOR A 3 UIT.';
			$exhibioMedioPago = 'SE DEJA CONSTANCIA QUE PARA LA REALIZACIÓN DEL PRESENTE ACTO, LAS PARTES NO ME HAN EXHIBIDO NINGÚN MEDIO DE PAGO. DOY FE.'; 
			$finMedioPago = 'EN DINERO EN EFECTIVO';
			$formaPago = 'AL CONTADO CON DINERO EN EFECTIVO';
			break;
		
		default:
			$medioPago = 'EL COMPRADOR DECLARA QUE HA PAGADO EL PRECIO DEL VEHICULO CON CHEQUE DEL BANCO DE CREDITO DEL PERÚ N° 1111111 111111 1111, GIRADO POR: YYYYYYYYY A FAVOR DE: XXXXXXXXX POR LA SUMA DE S/ 15,000.00, JULIACA 16/08/2018 EL TIPO Y CÓDIGO DEL MEDIO EMPLEADO ES: "CHEQUE -001" ';
			$exhibioMedioPago = 'EN APLICACIÓN DE LA LEY 30730, SE DEJA CONSTANCIA QUE PARA LA REALIZACIÓN DEL PRESENTE ACTO, LAS PARTES ME HAN EXHIBIDO EL SIGUIENTE MEDIO DE PAGO: ……… CHEQUE DEL BANCO DE CREDITO DEL PERÚ N° 1111111 111111 1111, GIRADO POR: YYYYYYYYY A FAVOR DE: XXXXXXXXX POR LA SUMA DE S/ 15,000.00, JULIACA 16/08/2018. DOY FE.'; 
			$finMedioPago = 'EN DINERO EN EFECTIVO';
			$formaPago = 'AL CONTADO CON DINERO EN EFECTIVO';
			break;
	}

	$precio = new ClaseNumeroLetra();
	
	
	$dataMontoVehiculo = array(
		'MONTO'     => $resultTransferencia['precio'],
		'MON_VEHI'    => $resultTransferencia['moneda'],
		//'MONTO_LETRAS' => $resultTransferencia['descripcion_medio_pago'],
		'MONTO_LETRAS' => $precio->fun_capital_moneda($resultTransferencia['moneda'],$resultTransferencia['precio'],'monto'),
		"MONEDA_C"    => $resultTransferencia['simbolo_moneda'].' ',
		"SUNAT_MED_PAGO"    => $resultTransferencia['sunat_medio_pago'],
		'DES_PRE_VEHI'    => $precio->fun_capital_moneda($resultTransferencia['moneda'],$resultTransferencia['precio'],'monto'),
		'EXH_MED_PAGO'    => utf8_decode($exhibioMedioPago),
		'MED_PAGO'    => utf8_decode($medioPago),
		'FIN_MED_PAGO'    => $finMedioPago,
		'FORMA_PAGO'    => $formaPago,
		'C_INICIO_MP'    => '',
		'TIPO_PAGO_E'    => '',
		'TIPO_PAGO_C'    => '',
		'MONTO_MP'    => '',
		'CONSTANCIA'    => '',
		'DETALLE_MP'    => '',
		'FORMA_PAGO_S'    => '',
		'MONEDA_C_MP'    => '',
		'MEDIO_PAGO_C'    => '',
		'MP_MEDIO_PAGO'    => '',
		'MP_COMPLETO'    => '',
		'MEDIO_PAGO_C'    => '',
		'USO'    => '',
	);
	return $dataMontoVehiculo;
}
function get_data_contratantes($resultTransferencia){
	$letras = new ClaseNumeroLetra();
	//PERSONA NATURAL A NATURAL
	$llaves=array('{','}','"');
	$condiciones = explode(',',$resultTransferencia['condicion']);
	$nombres = explode(',',$resultTransferencia['nombres']);
	$nacionalidad = explode(',',$resultTransferencia['nacionalidad']);
	$tipoDocumento = explode(',',$resultTransferencia['tipo_documento']);
	$numeroDocumento = explode(',',$resultTransferencia['numero_documento']);
	$ocupacion = explode(',',$resultTransferencia['ocupacion']);
	$estadoCivil = explode(',',$resultTransferencia['estado_civil']);
	$direccion = explode(',,',$resultTransferencia['direccion']);
	$distrito = explode(',',$resultTransferencia['distrito']);
	$provincia = explode(',',$resultTransferencia['provincia']);
	$departamento = explode(',',$resultTransferencia['departamento']);
	$sexo = explode(',',$resultTransferencia['sexo']);
	$idCliente = explode(',',$resultTransferencia['id_cliente']);
	$idConyuge = explode(',',$resultTransferencia['id_conyuge']);

	//CON EMPRESA
	$nombreEmpresa = explode(',',$resultTransferencia['nombre_empresa']);
	$numeroDocumentoEmpresa = explode(',',$resultTransferencia['numero_documento_empresa']);
	$direccionEmpresa = explode(',',$resultTransferencia['domicilio_empresa']);
	$distritoEmpresa = explode(',',$resultTransferencia['distrito_empresa']);
	$provinciaEmpresa = explode(',',$resultTransferencia['provincia_empresa']);
	$departamentoEmpresa = explode(',',$resultTransferencia['departamento_empresa']);
	$condicionEmpresa = explode(',',$resultTransferencia['condicion_empresa']);
	
	
	foreach ($condiciones as $k => $v){

		if($v=='VENDEDOR' || $v=='PODERDANTE' || $v=="OTORGANTE" || $v=="REPRESENTANTE" || $v=="ANTICIPANTE" ||$v=="ADJUDICANTE" || $v=="DONANTE" || $v=="USUFRUCTUANTE" || $v=="TRANSFERENTE" || $v=="TITULAR" || $v=="MUTUANTE" || $v=="PROPIETARIO" || $v=="DEUDOR" || $v=="ASOCIANTE" || $v=="TRANSFERENTE / PROPIETARIO (VENDEDOR)"){

			$contratantes['transferentes'][] = array(
				'condiciones'=>$condiciones[$k],
				'nombres'=>$nombres[$k],
				'nacionalidad'=>$nacionalidad[$k],
				'tipoDocumento'=>$tipoDocumento[$k],
				'numeroDocumento'=>$numeroDocumento[$k],
				'ocupacion'=>$ocupacion[$k],
				'estadoCivil'=>$estadoCivil[$k],
				'direccion'=>$direccion[$k],
				'distrito'=>utf8_decode($distrito[$k]),
				'provincia'=>utf8_decode($provincia[$k]),
				'departamento'=>$departamento[$k],
				'sexo'=>$sexo[$k],
				'idCliente' => $idCliente[$k],	
				'idConyuge' => $idConyuge[$k],	
				'nombreEmpresa' => $nombreEmpresa[$k],	
				'numeroDocumentoEmpresa' => $numeroDocumentoEmpresa[$k],	
				'direccionEmpresa' => $direccionEmpresa[$k],	
				'distritoEmpresa' => $distritoEmpresa[$k],	
				'provinciaEmpresa' => $provinciaEmpresa[$k],	
				'departamentoEmpresa' => $departamentoEmpresa[$k],	
				'oficinaRegistral' => $oficinaRegistral[$k],	
				'numeroPartida' => $numeroPartida[$k],	
				'condicionEmpresa' => $condicionEmpresa[$k],	
			);
			$contratantes['sexoTransferentes'][]=$sexo[$k];
			
		}
		if($v=='COMPRADOR' || $v=='APODERADO' || $v=="ANTICIPADO" || $v=="ADJUDICATARIO" || $v=="DONATARIO" || $v=="USUFRUCTUARIO" || $v=="TESTIGO A RUEGO" || $v=="ADQUIRIENTE" || $v=="ACREEDOR" || $v=='OTORGADO' || $v=="MUTUATARIO" || $v=="BENEFICIARIA"  || $v=="ASOCIADO" || $v=="ADQUIRENTE / BENEFICIARIO (COMPRADOR)"){

			$contratantes['adquirientes'][] = array(
				'condiciones'=>$condiciones[$k],
				'nombres'=>$nombres[$k],
				'nacionalidad'=>$nacionalidad[$k],
				'tipoDocumento'=>$tipoDocumento[$k],
				'numeroDocumento'=>$numeroDocumento[$k],
				'ocupacion'=>$ocupacion[$k],
				'estadoCivil'=>$estadoCivil[$k],
				'direccion'=>$direccion[$k],
				'distrito'=>$distrito[$k],
				'provincia'=>$provincia[$k],
				'departamento'=>$departamento[$k],
				'sexo'=>$sexo[$k],
				'idCliente' => $idCliente[$k],	
				'idConyuge' => $idConyuge[$k],
				'nombreEmpresa' => $nombreEmpresa[$k],	
				'numeroDocumentoEmpresa' => $numeroDocumentoEmpresa[$k],	
				'direccionEmpresa' => $direccionEmpresa[$k],	
				'distritoEmpresa' => $distritoEmpresa[$k],	
				'provinciaEmpresa' => $provinciaEmpresa[$k],	
				'departamentoEmpresa' => $departamentoEmpresa[$k],
				'oficinaRegistral' => $oficinaRegistral[$k],	
				'numeroPartida' => $numeroPartida[$k],	
				'condicionEmpresa' => $condicionEmpresa[$k],	
			);
			$contratantes['sexoAdquirientes'][]=$sexo[$k];
		}
		 
	}

	foreach ($contratantes['sexoTransferentes'] as  $value) {
		if($value=='F'){
			$contratantes['sexoTransferentes'] = 'MUJERES';
		}if($value=='M'){
			$contratantes['sexoTransferentes'] = 'MIXTO';
			break;
		}
	}
	foreach ($contratantes['sexoAdquirientes'] as  $value) {
		if($value=='F'){
			$contratantes['sexoAdquirientes'] = 'MUJERES';
		}if($value=='M'){
			$contratantes['sexoAdquirientes'] = 'MIXTO';
			break;
		}
	}


	array_sort_by($contratantes['transferentes'], 'sexo', $order = SORT_DESC);
	array_sort_by($contratantes['adquirientes'], 'sexo', $order = SORT_DESC);

	$articulosTransferentes = articulos_singular_plural($contratantes,'transferentes',count($contratantes['transferentes']),'P',$contratantes['sexoTransferentes']);
	$contratantes = $articulosTransferentes;
	$articulosAdquirientes = articulos_singular_plural($contratantes,'adquirientes',count($contratantes['adquirientes']),'C',$contratantes['sexoAdquirientes']);
	$contratantes = $articulosAdquirientes;
	$dataContratantes = $contratantes;


	$contadorVendedor = 1;
	$contadorAdquiriente = 1;
	$contadorEmpresa = 1;

	$casadosTransferentes='';
	foreach ($contratantes['transferentes'] as $k => $v){
		$contratantes['conyuge'][] = $v['idConyuge'];
		$contratantes['cliente'][] = $v['idCliente'];

		if(in_array($v['idConyuge'], $contratantes['cliente']) && in_array($v['idCliente'], $contratantes['conyuge'])){
			$casadosTransferentes = 'SI';
			$dataContratantes['P_AMBOS'] = ' AMBOS ';

		}else{
			$casadosTransferentes = 'NO';
			$dataContratantes['P_AMBOS'] = ' ';
		}
		
	}
	//$dataContratantes['estancasados']=$casadosTransferentes;
	foreach ($contratantes['transferentes'] as $k => $v) {
		
			if($contadorVendedor==1){
	
				$agregadoVendedor = '';
			}else{
				$agregadoVendedor = '_'.$contadorVendedor;
			}
			
			if($v['sexo']=='F'){
				$documentoVendedor = utf8_decode('IDENTIFICADA CON DNI N° '.$v['numeroDocumento'].', ');
				$nacionalidadVendedor = substr($v['nacionalidad'],0,-1).'A, ';
				$estadoCivilVendedor = substr($v['estadoCivil'],0,-1).'A, ';
			}else if($v['sexo']=='M'){
				$documentoVendedor = utf8_decode('IDENTIFICADO CON DNI N° '.$v['numeroDocumento'].', ');
				$nacionalidadVendedor = substr($v['nacionalidad'],0,-1).'O, ';
				$estadoCivilVendedor = $v['estadoCivil'].', ';
			}else{
				$documentoVendedor = utf8_decode('IDENTIFICADO CON DNI N° '.$v['numeroDocumento'].', ');
				$nacionalidadVendedor = substr($v['nacionalidad'],0,-1).'O, ';
				$estadoCivilVendedor = $v['estadoCivil'].', ';
			}
			if($contadorVendedor>1){
				$domicilioTransferente = utf8_decode('CON DOMICILIO EN '.$v['direccion'].' DEL DISTRITO DE '.$v['distrito'].' PROVINCIA DE '.$v['provincia'].' Y DEPARTAMENTO DE '.$v['departamento']);
			}else{
				if($casadosTransferentes=='SI'){
					$domicilioTransferente = ' CON ';
				}else{
					$domicilioTransferente = utf8_decode('CON DOMICILIO EN '.$v['direccion'].' DEL DISTRITO DE '.$v['distrito'].' PROVINCIA DE '.$v['provincia'].' Y DEPARTAMENTO DE '.$v['departamento']);
				}
			}
			//CUANDO LA CONDICION ES OTORGANT

			if($v['condicionEmpresa']=='EMPRESA EN CONSTITUCION' || $v['condicionEmpresa']=='ASOCIACION EN CONSTITUCION'){
				$claveNombreEmpresa = 'NOMBRE_EMPRESA_2'; 
				$claveInsEmpresa = 'INS_EMPRESA_2'; 
				$claveRucEmpresa = 'RUC_2'; 
				$claveDomicilioEmpresa = 'DOMICILIO_EMPRESA_2';
				$claveCondicionEmpresa = 'CONDICION_EMPRESA_2'; 
			}else{
				$claveNombreEmpresa = 'NOMBRE_EMPRESA_1'; 
				$claveInsEmpresa = 'INS_EMPRESA_1'; 
				$claveRucEmpresa = 'RUC_1'; 
				$claveDomicilioEmpresa = 'DOMICILIO_EMPRESA_1';
				$claveCondicionEmpresa = 'CONDICION_EMPRESA_1';
			}

			if($contadorVendedor==2){
				if($casadosTransferentes=='SI'){
					$ocupacionVendedor = utf8_decode($v['ocupacion']);
				}else{
					$ocupacionVendedor = utf8_decode($v['ocupacion'].', '.$estadoCivilVendedor);
				}
			}else{
				$ocupacionVendedor = utf8_decode($v['ocupacion']);
			}

			$dataContratantes['transferentes'][] = array(
				'P_NOM'.$agregadoVendedor=>utf8_decode($v['nombres']).', ',
				'P_NACIONALIDAD'.$agregadoVendedor=>$nacionalidadVendedor,
				'P_TIP_DOC'.$agregadoVendedor=>$v['tipoDocumento'],
				'P_DOC'.$agregadoVendedor=>$documentoVendedor,
				'P_OCUPACION'.$agregadoVendedor=>$ocupacionVendedor,
				'P_ESTADO_CIVIL'.$agregadoVendedor=>$estadoCivilVendedor,
				'P_DOMICILIO'.$agregadoVendedor=>$domicilioTransferente,
				'P_IDE'.$agregadoVendedor=>' ',
				'SEXO_P'.$agregadoVendedor=>$v['sexo'],
				'P_FIRMAN'.$agregadoVendedor=>utf8_decode($v['nombres']).', ',
				'P_IMPRIME'.$agregadoVendedor=>' FIRMA EN: '.$letras->fun_fech_letras($resultTransferencia['fecha_escritura']),
				$claveNombreEmpresa=>utf8_decode($v['nombreEmpresa']),
				$claveInsEmpresa=>utf8_decode(' INSCRITA EN LA PARTIDA ELECTRONICA N° '.$v['numeroPartida'].' DE LA OFICINA REGISTRAL '.$v['oficinaRegistral']),
				$claveRucEmpresa=>utf8_decode(', CON RUC N° '.$v['numeroDocumentoEmpresa'].', '),	
				$claveDomicilioEmpresa=>utf8_decode('CON DOMICILIO EN '.$v['direccionEmpresa'].' DEL DISTRITO DE '.$v['distritoEmpresa'].' PROVINCIA DE '.$v['provinciaEmpresa'].' Y DEPARTAMENTO DE '.$v['departamentoEmpresa']),
				$claveCondicionEmpresa=>$v['condicionEmpresa'],
				
			);
			
			$contadorVendedor++;

		}

		$casadosAdquirientes='';
		foreach ($contratantes['adquirientes'] as $k => $v){
			
			$contratantes['conyuge'][] = $v['idConyuge'];
			$contratantes['cliente'][] = $v['idCliente'];

			if(in_array($v['idConyuge'], $contratantes['cliente']) && in_array($v['idCliente'], $contratantes['conyuge'])){
				$casadosAdquirientes = 'SI';
				$dataContratantes['C_AMBOS'] = ' AMBOS ';
			}else{
				$casadosAdquirientes = 'NO';
				$dataContratantes['C_AMBOS'] = ' ';
			}
		}

		foreach ($contratantes['adquirientes'] as $k => $v) {

			if($contadorAdquiriente==1){
				$agregadoAdquiriente = '';
			}else{
				$agregadoAdquiriente = '_'.$contadorAdquiriente;
			}
			
			if($v['sexo']=='F'){
				$documentoComprador = utf8_decode('IDENTIFICADA CON DNI N° '.$v['numeroDocumento'].', ');
				$nacionalidadComprador = substr($v['nacionalidad'],0,-1).'A, ';
				$estadoCivilComprador = substr($v['estadoCivil'],0,-1).'A, ';
			}
			if($v['sexo']=='M'){
				$documentoComprador = utf8_decode('IDENTIFICADO CON DNI N° '.$v['numeroDocumento'].', ');
				$nacionalidadComprador = substr($v['nacionalidad'],0,-1).'O, ';
				$estadoCivilComprador = $v['estadoCivil'].', ';
			}

			if($contadorAdquiriente>1){
				$domicilioAdquiriente = utf8_decode('CON DOMICILIO EN '.$v['direccion'].' DEL DISTRITO DE '.$v['distrito'].' PROVINCIA DE '.$v['provincia'].' Y DEPARTAMENTO DE '.$v['departamento']);
			}else{
				if($casadosAdquirientes=='SI'){
					$domicilioAdquiriente = ' CON ';
				}else{
					$domicilioAdquiriente = utf8_decode('CON DOMICILIO EN '.$v['direccion'].' DEL DISTRITO DE '.$v['distrito'].' PROVINCIA DE '.$v['provincia'].' Y DEPARTAMENTO DE '.$v['departamento']);
				}
			}

			if($contadorAdquiriente==2){

				if($casadosAdquirientes=='SI'){
					$ocupacionComprador = utf8_decode($v['ocupacion']);
				}else{
					$ocupacionComprador = utf8_decode($v['ocupacion'].', '.$estadoCivilComprador);
				}
				
			}else{
				$ocupacionComprador = utf8_decode($v['ocupacion']);
			}


			$dataContratantes['adquirientes'][] = array(
				'C_NOM'.$agregadoAdquiriente=>utf8_decode($v['nombres']).', ',
				'C_FIRMAN'.$agregadoAdquiriente=>utf8_decode($v['nombres']).', ',
				'C_NACIONALIDAD'.$agregadoAdquiriente=>$nacionalidadComprador,
				'C_TIP_DOC'.$agregadoAdquiriente=>$v['tipoDocumento'],
				'C_DOC'.$agregadoAdquiriente=>$documentoComprador,
				'C_OCUPACION'.$agregadoAdquiriente=>$ocupacionComprador,
				'C_ESTADO_CIVIL'.$agregadoAdquiriente=>$estadoCivilComprador,
				'C_DOMICILIO'.$agregadoAdquiriente=>$domicilioAdquiriente,
				'C_IDE'.$agregadoAdquiriente=>' ',
				'SEXO_C'.$agregadoAdquiriente=>$v['sexo'],
				'C_IMPRIME'.$agregadoAdquiriente=>' FIRMA EN: '.$letras->fun_fech_letras($resultTransferencia['fecha_escritura']),
				'NOMBRE_EMPRESA_2'=>utf8_decode($v['nombreEmpresa']),
				'INS_EMPRESA_2'=>utf8_decode(' INSCRITA EN LA PARTIDA ELECTRONICA N° '.$v['numeroPartida'].' DE LA OFICINA REGISTRAL '.$v['oficinaRegistral']),
				'RUC_2'=>utf8_decode(', CON RUC N° '.$v['numeroDocumentoEmpresa'].', '),	
				'DOMICILIO_EMPRESA_2'=>utf8_decode('CON DOMICILIO EN '.$v['direccionEmpresa'].' DEL DISTRITO DE '.$v['distritoEmpresa'].' PROVINCIA DE '.$v['provinciaEmpresa'].' Y DEPARTAMENTO DE '.$v['departamentoEmpresa']),
				
			);
			$contadorAdquiriente++;
	}

	return $dataContratantes;	

}

function get_data_contratantes_vacios($dataContratantes,$contratante,$inicial){

	$totalData = count($dataContratantes[$contratante]);

	for($i=$totalData+1;$i<=10;$i++){
		$dataContratantes[$contratante][] = array(
			$inicial.'_NOM_'.$i=>'[E.'.$inicial.'_NOM_'.$i.']',
			$inicial.'_NACIONALIDAD_'.$i=>'[E.'.$inicial.'_NACIONALIDAD_'.$i.']',
			$inicial.'_TIP_DOC_'.$i=>'[E.'.$inicial.'_TIP_DOC_'.$i.']',
			$inicial.'_DOC_'.$i=>'[E.'.$inicial.'_DOC_'.$i.']',
			$inicial.'_DOC_LETRAS_'.$i=>'[E.'.$inicial.'_DOC_LETRAS_'.$i.']',
			$inicial.'_OCUPACION_'.$i=>'[E.'.$inicial.'_OCUPACION_'.$i.']',
			$inicial.'_ESTADO_CIVIL_'.$i=>'[E.'.$inicial.'_ESTADO_CIVIL_'.$i.']',
			$inicial.'_DOMICILIO_'.$i=>'[E.'.$inicial.'_DOMICILIO_'.$i.']',
			//'CALIDAD_'.$inicial.'_'.$i=>'[E.CALIDAD_'.$inicial.'_'.$i.']',
			$inicial.'_IDE_'.$i=>'[E.'.$inicial.'_IDE_'.$i.']',
			$inicial.'_FIRMA_'.$i=>'[E.'.$inicial.'_FIRMA_'.$i.']',
			$inicial.'_AMBOS_'.$i=>'[E.'.$inicial.'_AMBOS_'.$i.']',
			'SEXO_'.$inicial.'_'.$i=>'[E.SEXO_'.$inicial.'_'.$i.']',
		);
	}

	return $dataContratantes;
}
function get_data_empresas_vacios($dataContratantes,$contratante){

	$totalData = count($dataContratantes[$contratante]);

	for($i=$totalData+1;$i<=5;$i++){
		$dataContratantes[$contratante][] = array(
			'NOMBRE_EMPRESA_'.$i=>'[E.NOMBRE_EMPRESA_'.$i.']',
			'INS_EMPRESA_'.$i=>'[E.INS_EMPRESA_'.$i.']',
			'RUC_'.$i=>'[E.RUC_'.$i.']',
			'DOMICILIO_EMPRESA_'.$i=>'[E.DOMICILIO_EMPRESA_'.$i.']',

		);
	}

	return $dataContratantes;
}
function get_data_escrituracion($resultTransferencia){

	$folioIncial = ($resultTransferencia['folio_inicial']=='')?'[E.FI]':$resultTransferencia['folio_inicial'];
	$folioFinal = ( $resultTransferencia['folio_final']=='')?'[E.FF]': $resultTransferencia['folio_final'];
	$papelInicial = ($resultTransferencia['papel_inicial']=='')?'[E.S_IN]':$resultTransferencia['papel_inicial'];
	$papelFinal = ($resultTransferencia['papel_final']=='')?'[E.S_FN]':$resultTransferencia['papel_final'];

	$dataEscrituracion = array(
		'FI'  => $folioIncial,
		'S_IN'  => $papelInicial,
		'FF'  => $folioFinal,
		'S_FN'  => $papelFinal,
	);
	return $dataEscrituracion;
}

function array_sort_by(&$arrIni, $col, $order = SORT_ASC)
{
    $arrAux = array();
    foreach ($arrIni as $key=> $row)
    {
        $arrAux[$key] = is_object($row) ? $arrAux[$key] = $row->$col : $row[$col];
        $arrAux[$key] = strtolower($arrAux[$key]);
    }
    array_multisort($arrAux, $order, $arrIni);
}

function articulos_singular_plural($contratantes,$contratante,$cantidad,$inicial,$personas){

	if($cantidad>=2){
		//PLURAL
		$contador = 1;
		foreach($contratantes[$contratante] as $k => $v){

			if($contratantes[$contratante][$k]['condiciones']=='COMPRADOR'){
				$calidad = ($personas=='MUJERES')?'COMPRADORAS':'COMPRADORES';
			}else if($contratantes[$contratante][$k]['condiciones']=='VENDEDOR'){
				$calidad = ($personas=='MUJERES')?'VENDEDORAS':'VENDEDORES';
			}else if($contratantes[$contratante][$k]['condiciones']=='DONANTE'){
				$calidad = 'DONANTES';
			}else if($contratantes[$contratante][$k]['condiciones']=='DONATARIO'){
				$calidad = ($personas=='MUJERES')?'DONATARIAS':'DONATARIOS';
			}else if($contratantes[$contratante][$k]['condiciones']=='PODERDANTE'){
				$calidad = 'PODERDANTES';
			}else if($contratantes[$contratante][$k]['condiciones']=='APODERADO'){
				$calidad = ($personas=='MUJERES')?'APODERADAS':'APODERADOS';
			}else if($contratantes[$contratante][$k]['condiciones']=='OTORGANTE'){
				$calidad = 'OTORGANTES';
			}else{
				$calidad = $contratantes[$contratante][$k]['condiciones'];
			}

			if($contratantes[$contratante][$k]['sexo']=='F'){

				$contratantes['EL_'.$inicial] = ($personas=='MUJERES')?'LAS':'LOS';
				$contratantes['CALIDAD_'.$inicial] = $calidad;
				$contratantes[$inicial.'_CALIDAD'] = $calidad;
			}
			if($contratantes[$contratante][$k]['sexo']=='M'){
				$contratantes['EL_'.$inicial] = 'LOS';
				$contratantes['CALIDAD_'.$inicial] = $calidad;
				$contratantes[$inicial.'_CALIDAD'] = $calidad;
			}
			$contador++;
		}

		$contratantes['INICIO_'.$inicial] = ($personas=='MUJERES')?utf8_decode(' SEÑORAS'):utf8_decode(' SEÑORES');
		$contratantes['ES_'.$inicial] = 'ES';
		$contratantes['S_'.$inicial] = 'S';
		$contratantes['ES_SON_'.$inicial] = 'SON';
		$contratantes['Y_CON_'.$inicial] = 'Y';
		$contratantes['N_'.$inicial] = 'N';
		$contratantes['Y_'.$inicial] = 'Y';
		$contratantes['L_'.$inicial] = 'L';
		$contratantes['O_A_'.$inicial] = 'OS';
		$contratantes['O_ERON_'.$inicial] = 'ERON';
		$contratantes['O_ARON_'.$inicial] = 'ARON';
		$contratantes[$inicial.'_FIRMA'] = 'FIRMAN EN';
		//$contratantes[$inicial.'_AMBOS'] = ' AMBOS ';
		

	}else if($cantidad<2){
	//SINGULAR
		$contador2 = 1;
		foreach($contratantes[$contratante] as $k => $v){

			if($contratantes[$contratante][$k]['sexo']=='F'){

				if($contratantes[$contratante][$k]['condiciones']=='COMPRADOR'){
					$calidad = 'COMPRADORA';
				}else if($contratantes[$contratante][$k]['condiciones']=='VENDEDOR'){
					$calidad = 'VENDEDORA';
				}else if($contratantes[$contratante][$k]['condiciones']=='DONANTE'){
					$calidad = 'DONANTES';
				}else if($contratantes[$contratante][$k]['condiciones']=='DONATARIO'){
					$calidad = 'DONATARIA';
				}else if($contratantes[$contratante][$k]['condiciones']=='PODERDANTE'){
					$calidad = 'PODERDANTE';
				}else if($contratantes[$contratante][$k]['condiciones']=='APODERADO'){
					$calidad = 'APODERADA';
				}else{
					$calidad = $contratantes[$contratante][$k]['condiciones'];
				}

				$contratantes['EL_'.$inicial] = 'LA';
				$contratantes['CALIDAD_'.$inicial] = $calidad;
				$contratantes[$inicial.'_CALIDAD'] = $calidad;
				$contratantes['INICIO_'.$inicial] = utf8_decode(' SEÑORA');
			}
			if($contratantes[$contratante][$k]['sexo']=='M' || $contratantes[$contratante][$k]['sexo']=='M'){
				
				$contratantes['EL_'.$inicial] = 'EL';
				$contratantes['CALIDAD_'.$inicial] = $contratantes[$contratante][$k]['condiciones'];
				$contratantes[$inicial.'_CALIDAD'] = $contratantes[$contratante][$k]['condiciones'];
				$contratantes['INICIO_'.$inicial] = utf8_decode(' SEÑOR');
			}
			$contador2++;
		}

		$contratantes['ES_'.$inicial] = '';
		$contratantes['S_'.$inicial] = '';
		$contratantes['ES_SON_'.$inicial] = 'ES';
		$contratantes['Y_CON_'.$inicial] = '';
		$contratantes['N_'.$inicial] = '';
		$contratantes['Y_'.$inicial] = '';
		$contratantes['L_'.$inicial] = '';
		$contratantes['O_A_'.$inicial] = 'O';
		$contratantes['O_ERON_'.$inicial] = 'O';
		$contratantes['O_ARON_'.$inicial] = 'O';
		$contratantes[$inicial.'_FIRMA'] = 'FIRMA EN';
		$contratantes[$inicial.'_AMBOS'] = ' ';

	}

	return $contratantes;

}
?>






