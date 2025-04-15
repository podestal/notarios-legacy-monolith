<?php 
require_once 'Phpdocx/Create/CreateDocx.inc';
session_start(); 

function transferencia_vehicular(){
	
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
	// print_r($accion);return false;
	

	if ($idTemplate==0 || $idTemplate=='') exit("Seleccione una Plantilla");

	$rutaPlantilla="D://plantillas/PROTOCOLARES/ACTAS DE TRANSFERENCIA DE BIENES MUEBLES REGISTRABLES/";
	// $rutaPlantilla="C://Doc_Generados/templates/PROTOCOLARES/VEHICULARES/";
	$rutaDocumentoGenerado="C:/Proyectos/Vehicular/";
	$txtListContratantes=array();
		

		## 2.-RECIBIMOS EL KARDEX Y LO CARGAMOS

		$sql_idtipacto		= mysqli_query($conn_i,"select codactos from kardex where kardex='$num_kardex'") or die(mysqli_error($conn_i));
		$row_idtipacto		= mysqli_fetch_array($sql_idtipacto);	
		$idtipacto       	= $row_idtipacto["codactos"];	
		## 3.-EXTENSION DE LA PLANTILLA SEGUN CONFIGURACION
		
		$resultTransferencia = consulta_transferencia($num_kardex,$idtipacto,$idTemplate);

		// print_r($resultTransferencia);return false;
		## 4.-SELECCION DE LA PLANTILLA
		// $plantilla = choose_pantilla_escritura($resultTransferencia);
		$plantilla = $resultTransferencia['plantilla'];
		// $plantilla = 'TRANSFERENCIA VEHICULAR PERSONA NATURAL A JURIDICA CON PODER.docx';
		//print_r($plantilla);return false;

		$titulo="";
		/*23 ES PROYECTO, 15 ES KARDEX, POR DEFECTO ES 23. LUEGO TOMAMOS EL 15 PARA DECIRLE QUE ES TIPOKARDEX DE TODAS FORMAS.*/ 
		if($_REQUEST["tipo"]==23){
			$tipo = 15;
			$tipoGuardar = 23;
		}
		
		if($accion=='actualizar'){
			$template = $rutaDocumentoGenerado.'__PROY__'.$num_kardex.'.docx';
			// print_r($template);return false;
		}else if($accion=='parte'){
			$template = 'D:/plantillas/parte testimonio E INSERTOS/PARTE TRANSFERENCIA.docx';
		}else{

			$template = $rutaPlantilla.$plantilla;
		}
				

		
		
		$dataDocumento = get_data_documento($resultTransferencia);
		// print_r($dataDocumento);return false;
		
		$dataVehiculos = get_data_vehiculos($resultTransferencia);
		$dataPagos = get_data_pagos($resultTransferencia);
		
		
		$dataContratantes = get_data_contratantes($resultTransferencia);
		
		//print_r($dataContratantes); return false;


		$totalDataTransferentes = count($dataContratantes['transferentes']);
		$totalDataAdquirientes = count($dataContratantes['adquirientes']);

		$dataContratantesVaciosTrans = get_data_contratantes_vacios($dataContratantes,'transferentes','P');
		$dataContratantes = $dataContratantesVaciosTrans;

		$dataContratantesVaciosAdq = get_data_contratantes_vacios($dataContratantes,'adquirientes','C');
		$dataContratantes = $dataContratantesVaciosAdq;

		$dataContratantesVaciosEmp = get_data_empresas_vacios($dataContratantes,'empresas');

		$dataContratantes = $dataContratantesVaciosEmp;

		$articulosContratantes = array(
			'EL_P'=>$dataContratantes['EL_P'],
			'EL_C'=>$dataContratantes['EL_C'],
			'AMBOS'=>' AMBOS ',
			'S_P'=>'  ', //PLURAL DE SI ES REPRESENTANTE O REPRESENTANTES
			'ES_P'=>'  ', 

			'C_INICIO' => $dataContratantes['C_INICIO'], 
			'C_CALIDAD' => $dataContratantes['C_CALIDAD'], 
			'Y_CON_C' => $dataContratantes['Y_CON_C'],
			'N_C' => $dataContratantes['N_C'],
			'Y_C' => $dataContratantes['Y_C'],
			'L_C' => $dataContratantes['L_C'],
			'O_A_C' => $dataContratantes['O_A_C'],
			'C_FIRMA' => $dataContratantes['C_FIRMA'],
			'C_AMBOS' => $dataContratantes['C_AMBOS'],
		
			'P_INICIO' => $dataContratantes['P_INICIO'],
			'P_CALIDAD' => $dataContratantes['P_CALIDAD'],
			'Y_CON_P' => $dataContratantes['Y_PON_P'],
			'N_P' => $dataContratantes['N_P'],
			'Y_P' => $dataContratantes['Y_P'],
			'L_P' => $dataContratantes['L_P'],
			'O_A_P' => $dataContratantes['O_A_P'],
			'P_FIRMA' => $dataContratantes['P_FIRMA'],
			'P_AMBOS' => $dataContratantes['P_AMBOS'],
			
		);
				
		
		$dataEscrituracion = get_data_escrituracion($resultTransferencia);

		
		
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

		// print_r($dataDocumento);return false;
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

transferencia_vehicular();

function get_data_documento($resultTransferencia){

	$letras = new ClaseNumeroLetra();
	
	$numeroActa = ($resultTransferencia['numero_escritura']=='')?'[E.NRO_ESC]':$resultTransferencia['numero_escritura'].'('.$letras->fun_nume_letras($resultTransferencia['numero_escritura']).')';

	$fechaActa = ($resultTransferencia['fecha_escritura']==0)?'[E.F_IMPRESION]':$letras->fun_fech_letras($resultTransferencia['fecha_escritura']);
	
	$dataDocumento= array(
		'NRO_ESC' => $numeroActa,
		// 'NUM_ESC_LET' => $letras->fun_nume_letras($numeroActa),
		'K'=>$resultTransferencia['kardex'],
		'NUM_REG'=>'1',
		'FEC_LET'=>$letras->fun_fech_letras($resultTransferencia['fecha_escritura']),
		'F_IMPRESION'=>$fechaActa,
		'USUARIO'=>$resultTransferencia['usuario'],
		'USUARIO_DNI'=>$resultTransferencia['dni_usuario'],
		'NRO_MIN'=>$resultTransferencia['dni_usuario'],
		'COMPROBANTE'=>'sin',
		'O_S'=>$resultTransferencia['kardex'], //ORDEN DE SERVICIO
		'ORDEN_SERVICIO'=>$resultTransferencia['kardex'],
		'FECHA_ACT'=>$letras->fun_fech_letras($resultTransferencia['fecha_escritura']),
		'FECHA_MAX'=>$letras->fun_fech_letras($resultTransferencia['fecha_escritura']),
	);
	return $dataDocumento;
}

function consulta_transferencia($num_kardex,$idtipacto,$idTemplate){
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
					(SELECT fileName FROM tpl_template WHERE pkTemplate='$idTemplate') as plantilla,
					(SELECT nameTemplate FROM tpl_template WHERE pkTemplate='$idTemplate') as nombre_plantilla,
					k.fechaingreso as fecha_ingreso,
					k.responsable_new as usuario,
					usu.dni as dni_usuario,
					GROUP_CONCAT(c2.idcliente) as id_cliente,
					GROUP_CONCAT(IF(c2.conyuge='','NO',c2.conyuge)) as id_conyuge,
					GROUP_CONCAT(cxa.idcontratante) as id_contratante,
					GROUP_CONCAT(TRIM(CONCAT(IFNULL(c2.prinom, ''), ' ', IFNULL(c2.segnom, ''), ' ',IFNULL(c2.`apepat`, ''), ' ',IFNULL(c2.apemat, ''),
				IFNULL(c2.razonsocial, '')))) AS nombres,
					GROUP_CONCAT(cxa.uif) as uif,
					GROUP_CONCAT(IF(ac.condicion='REPRESENTANTE',acr.condicion,ac.condicion)) as condicion,
					GROUP_CONCAT(IF(n.descripcion=0,n.descripcion,'EMPRESA')) as nacionalidad,
					GROUP_CONCAT(td.destipdoc) as tipo_documento,
					GROUP_CONCAT(c2.numdoc) AS numero_documento,
					GROUP_CONCAT(UPPER(c2.profesion_plantilla)) AS ocupacion,
					GROUP_CONCAT(IF(tec.desestcivil=0,tec.desestcivil,'EMPRESA')) as estado_civil,
					GROUP_CONCAT(IF(c2.tipper='N',c2.direccion,c2.domfiscal)) as direccion,
					-- GROUP_CONCAT(c2.domfiscal) as domicilio_fiscal,
					-- GROUP_CONCAT(c2.direccion) as direccion,
					GROUP_CONCAT(u.codpto) as codigo_departamento,
					GROUP_CONCAT(u.coddis) as codigo_distrito,
					GROUP_CONCAT(u.codprov) as codigo_provincia,
					GROUP_CONCAT(u.nomdis) as distrito,
					GROUP_CONCAT(u.nomprov) as provincia,
					GROUP_CONCAT(u.nomdpto) as departamento,
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
					GROUP_CONCAT(TRIM(CONCAT(IFNULL(cr2.prinom, ''), ' ', IFNULL(cr2.segnom, ''), ' ',IFNULL(cr2.apepat, ''), ' ',IFNULL(cr2.apemat, ''),
				IFNULL(cr2.razonsocial, '')))) AS nombre_empresa,
					GROUP_CONCAT(cr2.tipper) as tipo_persona_empresa,
					GROUP_CONCAT(acr.condicion) as condicion_empresa,
					GROUP_CONCAT(tdr.destipdoc) as tipo_documento_empresa,
					GROUP_CONCAT(cr2.numdoc) AS numero_documento_empresa,
					GROUP_CONCAT(cr2.domfiscal) as domicilio_empresa,
					GROUP_CONCAT(ur.nomdis) as distrito_empresa,
					GROUP_CONCAT(ur.nomprov) as provincia_empresa,
					GROUP_CONCAT(ur.nomdpto) as departamento_empresa,
					dmp.foperacion as fecha_operacion,
					dmp.documentos as documentos,
					ban.desbanco as banco
				FROM kardex as k
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
				LEFT JOIN tipodocumento as tdr ON tdr.idtipdoc = cr2.idtipdoc
				LEFT OUTER JOIN tipoestacivil as tecr ON tecr.idestcivil = cr2.idestcivil
				LEFT OUTER JOIN ubigeo as ur ON ur.coddis = cr2.idubigeo
				LEFT JOIN  bancos as ban ON ban.idbancos=dmp.idbancos
				WHERE k.kardex='$num_kardex' and (c2.tipper='N')
				GROUP BY k.idkardex";


		$resultTransferencia = mysql_query($query);
		$row = mysql_fetch_assoc($resultTransferencia);
		return $row;
}

function get_data_vehiculos($resultTransferencia){

	$sede_registral = explode('-',$resultTransferencia['sede']);

	$dataVehiculos=array(
		'PLACA'=> ($resultTransferencia['placa']=='')?'[E.PLACA]':strtoupper($resultTransferencia['placa']),
		'CLASE'=> ($resultTransferencia['clase']=='')?'[E.CLASE]':strtoupper($resultTransferencia['clase']),
		'MARCA'=> ($resultTransferencia['marca']=='')?'[E.MARCA]':strtoupper($resultTransferencia['marca']),
		'MODELO'=> ($resultTransferencia['modelo']=='')?'[E.MODELO]':strtoupper($resultTransferencia['modelo']),
		'AÑO_FABRICACION'=> ($resultTransferencia['anio']=='')?utf8_decode('[E.AÑO_FABRICACION]'):strtoupper($resultTransferencia['anio']),
		'CARROCERIA'=> ($resultTransferencia['carroceria']=='')?'[E.CARROCERIA]':strtoupper($resultTransferencia['carroceria']),
		'COLOR'=> ($resultTransferencia['color']=='')?'[E.COLOR]':strtoupper($resultTransferencia['color']),
		'NRO_MOTOR'=> ($resultTransferencia['motor']=='')?'[E.NRO_MOTOR]':strtoupper($resultTransferencia['motor']),
		'NRO_SERIE'=> ($resultTransferencia['serie']=='')?'[E.NRO_SERIE]':strtoupper($resultTransferencia['serie']),
		'FEC_INS'=> ($resultTransferencia['fecha_inscripcion']=='')?'[E.FEC_INS]':strtoupper($resultTransferencia['fecha_inscripcion']),
		'FECHA_INSCRIPCION'=> ($resultTransferencia['fecha_inscripcion']=='')?'[E.FECHA_INSCRIPCION]':strtoupper($resultTransferencia['fecha_inscripcion']),
		'ZONA_REGISTRAL'=> ($resultTransferencia['sede']=='')?'[E.ZONA_REGISTRAL]':strtoupper($resultTransferencia['sede']),
		'NUM_ZONA_REG'=> ($resultTransferencia['numero_zona']=='')?'[E.NUM_ZONA_REG]':strtoupper($resultTransferencia['numero_zona']),
		'SEDE'=> ($sede_registral[1]=='')?'[E.SEDE]':strtoupper(trim(strtoupper($sede_registral[1]))),
		'INSTRUIDO'=> ' ',
		'COMBUSTIBLE'=> ' ',
		'NRO_TARJETA'=> ' ',
		'NRO_CILINDROS'=> ' ',
	);

	return $dataVehiculos;
}
function get_data_pagos($resultTransferencia){

	switch ($resultTransferencia['sunat_medio_pago']) {
		case '008':
			$medioPago = 'EL COMPRADOR DECLARA QUE HA PAGADO EL PRECIO DEL VEHICULO EN DINERO EN EFECTIVO Y CON ANTERIORIDAD A LA CELEBRACION DE LA PRESENTE ACTA DE TRANSFERENCIA. NO HABIENDO UTILIZADO NINGÚN MEDIO DE PAGO ESTABLECIDO EN LA LEY Nº 28194, PORQUE EL MONTO TOTAL NO ES IGUAL NI SUPERA LOS S/ 3,500.00 O US$ 1,000.00. EL TIPO Y CÓDIGO DEL MEDIO EMPLEADO ES: "EFECTIVO POR OPERACIONES EN LAS QUE NO EXISTE OBLIGACIÓN DE UTILIZAR MEDIOS DE PAGO-008". INAPLICABLE LA LEY 30730 POR SER EL PAGO DEL PRECIO INFERIOR A 3 UIT.';
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
		
		case '001':
			
			$medioPago= 'AMBAS PARTES DECLARAN QUE HAN UTILIZADO EL '.$resultTransferencia['descripcion_medio_pago'].' POR EL MONTO DE : '.$resultTransferencia['simbolo_moneda'].' '.$resultTransferencia['precio'].', DE FECHA '.$resultTransferencia['fecha_operacion'].' , A NOMBRE DE...... BAJO EL NÚMERO '.$resultTransferencia['documentos'].', A CARGO DE BANCO '.$resultTransferencia['banco'].' , CUYA COPIA SE ADJUNTA AL PARTE NOTARIAL. EL TIPO Y CODIGO DEL MEDIO EMPLEADO ES: "'.$resultTransferencia['descripcion_medio_pago'].' - 001".';

			$exhibioMedioPago = 'EN APLICACIÓN DE LA LEY 30730, SE DEJA CONSTANCIA QUE PARA LA REALIZACIÓN DEL PRESENTE ACTO, LAS PARTES ME HAN EXHIBIDO EL SIGUIENTE MEDIO DE PAGO: '.$resultTransferencia['banco'].' - FECHA:'.$resultTransferencia['fecha_operacion'].'- A NOMBRE DE XXXXXXXX - CODIGO DE CUENTA:'.$resultTransferencia['documentos'].' - IMPORTE DEPOSITADO: '.$resultTransferencia['simbolo_moneda'].' '.$resultTransferencia['precio'].'. DOY FE.'; 

			$finMedioPago = 'DEPOSITO EN CUENTA';
			$formaPago = $resultTransferencia['descripcion_medio_pago'];
			break;
		
		default:
			$medioPago = 'EL COMPRADOR DECLARA QUE HA PAGADO EL PRECIO DEL VEHICULO EN DINERO EN EFECTIVO Y CON ANTERIORIDAD A LA CELEBRACION DE LA PRESENTE ACTA DE TRANSFERENCIA. NO HABIENDO UTILIZADO NINGÚN MEDIO DE PAGO ESTABLECIDO EN LA LEY Nº 28194, EL TIPO Y CÓDIGO DEL MEDIO EMPLEADO ES: "EFECTIVO POR OPERACIONES EN LAS QUE NO EXISTE OBLIGACIÓN DE UTILIZAR MEDIOS DE PAGO-009". INAPLICABLE LA LEY 30730 POR SER EL PAGO DEL PRECIO INFERIOR A 3 UIT.';
			$exhibioMedioPago = 'SE DEJA CONSTANCIA QUE PARA LA REALIZACIÓN DEL PRESENTE ACTO, LAS PARTES NO ME HAN EXHIBIDO NINGÚN MEDIO DE PAGO. DOY FE.'; 
			$finMedioPago = 'EN DINERO EN EFECTIVO';
			$formaPago = 'AL CONTADO CON DINERO EN EFECTIVO';
	}

	$precio = new ClaseNumeroLetra();
	
	
	$dataMontoVehiculo = array(
		'MONTO'     => $resultTransferencia['precio'],
		'MON_VEHI'    => $resultTransferencia['moneda'],
		'MONTO_LETRAS' => $precio->fun_capital_moneda($resultTransferencia['moneda'],$resultTransferencia['precio']),
		"MONEDA_C"    => $resultTransferencia['simbolo_moneda'],
		"SUNAT_MED_PAGO"    => $resultTransferencia['sunat_medio_pago'],
		'DES_PRE_VEHI'    => $precio->fun_capital_moneda($resultTransferencia['moneda'],$resultTransferencia['precio']),
		'EXH_MED_PAGO'    => utf8_decode($exhibioMedioPago),
		'MED_PAGO'    => utf8_decode($medioPago),
		'FIN_MED_PAGO'    => $finMedioPago,
		'FORMA_PAGO'    => $formaPago,
		'C_INICIO_MP'    => '',
		'TIPO_PAGO_E'    => '',
		'TIPO_PAGO_C'    => '',
		'MONTO_MP'    => '',
		'CONSTANCIA'    => utf8_decode($exhibioMedioPago),
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
	//PERSONA NATURAL A NATURAL

	$letras = new ClaseNumeroLetra();

	$llaves=array('{','}','"');
	$condiciones = explode(',',$resultTransferencia['condicion']);
	$nombres = explode(',',$resultTransferencia['nombres']);
	$nacionalidad = explode(',',$resultTransferencia['nacionalidad']);
	$tipoDocumento = explode(',',$resultTransferencia['tipo_documento']);
	$numeroDocumento = explode(',',$resultTransferencia['numero_documento']);
	$ocupacion = explode(',',$resultTransferencia['ocupacion']);
	$estadoCivil = explode(',',$resultTransferencia['estado_civil']);
	$direccion = explode(',',$resultTransferencia['direccion']);
	$distrito = explode(',',$resultTransferencia['distrito']);
	$provincia = explode(',',$resultTransferencia['provincia']);
	$departamento = explode(',',$resultTransferencia['departamento']);
	$sexo = explode(',',$resultTransferencia['sexo']);
	$idCliente = explode(',',$resultTransferencia['id_cliente']);
	$idConyuge = explode(',',$resultTransferencia['id_conyuge']);
	
	
	$contadorVendedor = 1;
	$contadorAdquiriente = 1;
	$contadorEmpresa = 1;

	
	
	foreach ($condiciones as $k => $v) {
		
		
		if($v=='VENDEDOR' || $v=='DONANTE'){

		
			$dataContratantes['CONYUGE'][]=$idConyuge[$k];
			$dataContratantes['CLIENTE'][]=$idCliente[$k];
			
			if($contadorVendedor==1){
	
				$agregadoVendedor = '';
			}else{
				$agregadoVendedor = '_'.$contadorVendedor;
			}
			
			if($v=='APODERADO'){
				$condicionTotal = $k>1;
			}else{
				$condicionTotal = $k>2;
			}
			if($condicionTotal){
			//PLURAL
				if($sexo[$k]=='F'){
					$dataContratantes['EL_P'] = 'LOS';
					$dataContratantes['CALIDAD_P'] = 'VENDEDORES';
					$dataContratantes['P_CALIDAD'] = 'VENDEDORES';
				}
				if($sexo[$k]=='M'){
					$dataContratantes['EL_P'] = 'LOS';
					$dataContratantes['CALIDAD_P'] = 'VENDEDORES';
					$dataContratantes['P_CALIDAD'] = 'VENDEDORES';
				}

				$dataContratantes['P_INICIO'] = utf8_decode(' SEÑORES') ;
				$dataContratantes['Y_CON_P'] = ' Y ';
				$dataContratantes['N_P'] = 'N';
				$dataContratantes['Y_P'] = '';
				$dataContratantes['L_P'] = ' Y ';
				$dataContratantes['O_A_P'] = 'OS';
				$dataContratantes['P_FIRMA'] = 'FIRMAN EN';
				$dataContratantes['P_AMBOS'] = ' AMBOS ';
				

			}else{
			//SINGULAR
				if($sexo[$k]=='F'){
					$dataContratantes['EL_P'] = 'LA';
					$dataContratantes['CALIDAD_P'] = 'VENDEDORA';
					$dataContratantes['P_CALIDAD'] = 'VENDEDORA';
					$dataContratantes['P_INICIO'] = utf8_decode(' SEÑORA') ;
				}
				if($sexo[$k]=='M'){
					$dataContratantes['EL_P'] = 'EL';
					$dataContratantes['CALIDAD_P'] = 'VENDEDOR';
					$dataContratantes['P_CALIDAD'] = 'VENDEDOR';
					$dataContratantes['P_INICIO'] = utf8_decode(' SEÑOR') ;
				}
				
				
				$dataContratantes['Y_CON_P'] = '';
				$dataContratantes['N_P'] = '';
				$dataContratantes['Y_P'] = '';
				$dataContratantes['L_P'] = '';
				$dataContratantes['O_A_P'] = 'O';
				$dataContratantes['P_FIRMA'] = 'FIRMA EN';
				$dataContratantes['P_AMBOS'] = '';
			}
				
			if($sexo[$k]=='F'){

				$documentoVendedor = utf8_decode('IDENTIFICADA CON DNI N° '.$numeroDocumento[$k].', ');
				$nacionalidadVendedor = substr($nacionalidad[$k],0,-1).'A, ';
				$estadoCivilVendedor = substr($estadoCivil[$k],0,-1).'A, ';
			}

			if($sexo[$k]=='M'){
				$documentoVendedor = utf8_decode('IDENTIFICADO CON DNI N° '.$numeroDocumento[$k].', ');
				$nacionalidadVendedor = substr($nacionalidad[$k],0,-1).'O, ';
				$estadoCivilVendedor = $estadoCivil[$k].', ';
			}
			
			$dataContratantes['transferentes'][] = array(
				'P_NOM'.$agregadoVendedor=>utf8_decode($nombres[$k]).', ',
				'P_NACIONALIDAD'.$agregadoVendedor=>$nacionalidadVendedor,
				'P_TIP_DOC'.$agregadoVendedor=>$tipoDocumento[$k],
				'P_DOC'.$agregadoVendedor=>$documentoVendedor,
				'P_OCUPACION'.$agregadoVendedor=>$ocupacion[$k],
				'P_ESTADO_CIVIL'.$agregadoVendedor=>$estadoCivilVendedor,
				'P_DOMICILIO'.$agregadoVendedor=>utf8_decode('CON DOMICILIO EN '.$direccion[$k].' DEL DISTRITO DE '.$distrito[$k].' PROVINCIA DE '.$provincia[$k].' Y DEPARTAMENTO DE '.$departamento[$k]),
				'P_IDE'.$agregadoVendedor=>' ',
				'SEXO_P'.$agregadoVendedor=>$sexo[$k],
				'P_FIRMAN'.$agregadoVendedor=>utf8_decode($nombres[$k]).', ',
				'P_IMPRIME'.$agregadoVendedor=>' FIRMA EN: '.$letras->fun_fech_letras($resultTransferencia['fecha_escritura']),	
			);

			$contadorVendedor++;
		}
		
		
		if($v=='COMPRADOR' || $v=='DONATARIO'){

			if($contadorAdquiriente==1){

				$agregadoAdquiriente = '';
			}else{
				$agregadoAdquiriente = '_'.$contadorAdquiriente;
			}
			
			if($k>1){
			//PLURAL
				$dataContratantes['EL_C'] = 'LOS';
				$dataContratantes['CALIDAD_C'] = 'COMPRADORES';
				$dataContratantes['C_CALIDAD'] = 'COMPRADORES';
				$dataContratantes['C_INICIO'] = utf8_decode(' SEÑORES') ;
				$dataContratantes['Y_CON_C'] = ' Y ';
				$dataContratantes['N_C'] = 'N';
				$dataContratantes['Y_C'] = '';
				$dataContratantes['L_C'] = ' Y ';
				$dataContratantes['O_A_C'] = 'OS';
				$dataContratantes['C_FIRMA'] = 'FIRMAN EN';
				$dataContratantes['C_AMBOS'] = ' AMBOS ';

			}else{
			//SINGULAR
				if($sexo[$k]=='F'){
					$dataContratantes['EL_C'] = 'LA';
					$dataContratantes['CALIDAD_C'] = 'COMPRADORA';
					$dataContratantes['C_CALIDAD'] = 'COMPRADORA';
				}
				if($sexo[$k]=='M'){
					$dataContratantes['EL_C'] = 'EL';
					$dataContratantes['CALIDAD_C'] = 'COMPRADOR';
					$dataContratantes['C_CALIDAD'] = 'COMPRADOR';
				}
				
				$dataContratantes['C_INICIO'] = utf8_decode(' SEÑOR') ;
				$dataContratantes['Y_CON_C'] = '';
				$dataContratantes['N_C'] = '';
				$dataContratantes['Y_C'] = '';
				$dataContratantes['L_C'] = '';
				$dataContratantes['O_A_C'] = 'O';
				$dataContratantes['C_FIRMA'] = 'FIRMA EN';
				$dataContratantes['C_AMBOS'] = '';
			}
				
			if($sexo[$k]=='F'){

				$documentoComprador = utf8_decode('IDENTIFICADA CON DNI N° '.$numeroDocumento[$k].', ');
				$nacionalidadComprador = str_replace('O','A',$nacionalidad[$k]).', ';
				$estadoCivilComprador = substr($estadoCivil[$k],0,-1).'A, ';
			}

			if($sexo[$k]=='M'){
				$documentoComprador = utf8_decode('IDENTIFICADO CON DNI N° '.$numeroDocumento[$k].', ');
				$nacionalidadComprador = $nacionalidad[$k].', ';
				$estadoCivilComprador = $estadoCivil[$k].', ';
			}

			$dataContratantes['adquirientes'][] = array(
				'C_NOM'.$agregadoAdquiriente=>utf8_decode($nombres[$k]).', ',
				'C_FIRMAN'.$agregadoAdquiriente=>utf8_decode($nombres[$k]).', ',
				'C_NACIONALIDAD'.$agregadoAdquiriente=>$nacionalidadComprador,
				'C_TIP_DOC'.$agregadoAdquiriente=>$tipoDocumento[$k],
				'C_DOC'.$agregadoAdquiriente=>$documentoComprador,
				'C_OCUPACION'.$agregadoAdquiriente=>$ocupacion[$k],
				'C_ESTADO_CIVIL'.$agregadoAdquiriente=>$estadoCivilComprador,
				'C_DOMICILIO'.$agregadoAdquiriente=>utf8_decode('CON DOMICILIO EN '.$direccion[$k].' DEL DISTRITO DE '.$distrito[$k].' PROVINCIA DE '.$provincia[$k].' Y DEPARTAMENTO DE '.$departamento[$k]),
				'C_IDE'.$agregadoAdquiriente=>' ',
				'SEXO_C'.$agregadoAdquiriente=>$sexo[$k],
				'C_IMPRIME'.$agregadoAdquiriente=>' FIRMA EN: '.$letras->fun_fech_letras($resultTransferencia['fecha_escritura']),
				
			);

			$contadorAdquiriente++;

		 }

		//CON EMPRESA
		$nombreEmpresa = explode(',',$resultTransferencia['nombre_empresa']);
		$numeroDocumentoEmpresa = explode(',',$resultTransferencia['numero_documento_empresa']);
		$direccionEmpresa = explode(',',$resultTransferencia['domicilio_empresa']);
		$distritoEmpresa = explode(',',$resultTransferencia['distrito_empresa']);
		$provinciaEmpresa = explode(',',$resultTransferencia['provincia_empresa']);
		$departamentoEmpresa = explode(',',$resultTransferencia['departamento_empresa']);

		 $dataContratantes['empresas'][] = array(
			'NOMBRE_EMPRESA_'.$contadorEmpresa=>utf8_decode($nombreEmpresa[$k]),
			'INS_EMPRESA_'.$contadorEmpresa=>' ',
			'RUC_'.$contadorEmpresa=>utf8_decode(', CON RUC N° '.$numeroDocumentoEmpresa[$k].', '),	
			'DOMICILIO_EMPRESA_'.$contadorEmpresa=>utf8_decode('CON DOMICILIO EN '.$direccionEmpresa[$k].' DEL DISTRITO DE '.$distritoEmpresa[$k].' PROVINCIA DE '.$provinciaEmpresa[$k].' Y DEPARTAMENTO DE '.$departamentoEmpresa[$k]),	
		);

		$contadorEmpresa++;
		 
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
			$inicial.'_OCUPACION_'.$i=>'[E.'.$inicial.'_OCUPACION_'.$i.']',
			$inicial.'_ESTADO_CIVIL_'.$i=>'[E.'.$inicial.'_ESTADO_CIVIL_'.$i.']',
			$inicial.'_DOMICILIO_'.$i=>'[E.'.$inicial.'_DOMICILIO_'.$i.']',
			$inicial.'_CALIDAD_'.$i=>'[E.'.$inicial.'_CALIDAD_'.$i.']',
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
		'S_IN'  => $folioFinal,
		'FF'  => $papelInicial,
		'S_FN'  => $papelFinal,
	);
	return $dataEscrituracion;
}



function choose_pantilla_escritura($dataTransferencia){

	$tipoPersona = explode(',',$dataTransferencia['tipo_persona']);
	$tipoPersonaEmpresa = explode(',',$dataTransferencia['tipo_persona_empresa']);
	// return $tipoPersonaEmpresa;
	$plantilla = '';
	switch (true) {
		case ($tipoPersonaEmpresa[0]=='N' && $tipoPersonaEmpresa[1]=='N'):
			$plantilla='TRANSFERENCIA VEHICULAR DE PERSONA NATURAL A NATURAL BASE.docx';
			break;
		case ($tipoPersonaEmpresa[0]=='J' && $tipoPersonaEmpresa[1]=='J'):
			$plantilla='TRANSFERENCIA VEHICULAR JURIDICA A JURIDICA.docx';
			break;
		case ($tipoPersonaEmpresa[0]=='N' && $tipoPersonaEmpresa[1]=='J'):
			$plantilla='TRANSFERENCIA VEHICULAR PERSONA NATURAL A JURIDICA.docx';
			break;
		case ($tipoPersonaEmpresa[0]=='J' && $tipoPersonaEmpresa[1]=='N'):
			$plantilla='TRANSFERENCIA VEHICULAR PERSONA JURIDICA A NATURAL.docx';
			break;
		
		default:
			$plantilla='TRANSFERENCIA VEHICULAR DE PERSONA NATURAL A NATURAL BASE.docx';
			break;
	}
	return $plantilla;
}

////funcion para obtener texto de un word
// class DocxConversion{
//     private $filename;

//     public function __construct($filePath) {
//         $this->filename = $filePath;
//     }

//     private function read_doc() {
//         $fileHandle = fopen($this->filename, "r");
//         $line = @fread($fileHandle, filesize($this->filename));   
//         $lines = explode(chr(0x0D),$line);
//         $outtext = "";
//         foreach($lines as $thisline)
//           {
//             $pos = strpos($thisline, chr(0x00));
//             if (($pos !== FALSE)||(strlen($thisline)==0))
//               {
//               } else {
//                 $outtext .= $thisline." ";
//               }
//           }
//          $outtext = preg_replace("/[^a-zA-Z0-9\s\,\.\-\n\r\t@\/\_\(\)]/","",$outtext);
//         return $outtext;
//     }

//     private function read_docx(){

//         $striped_content = '';
//         $content = '';

//         $zip = zip_open($this->filename);

//         if (!$zip || is_numeric($zip)) return false;

//         while ($zip_entry = zip_read($zip)) {

//             if (zip_entry_open($zip, $zip_entry) == FALSE) continue;

//             if (zip_entry_name($zip_entry) != "word/document.xml") continue;

//             $content .= zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));

//             zip_entry_close($zip_entry);
//         }// end while

//         zip_close($zip);

//         $content = str_replace('</w:r></w:p></w:tc><w:tc>', " ", $content);
//         $content = str_replace('</w:r></w:p>', "\r\n", $content);
//         $striped_content = strip_tags($content);

//         return $striped_content;
//     }

//  /************************excel sheet************************************/

// function xlsx_to_text($input_file){
//     $xml_filename = "xl/sharedStrings.xml"; //content file name
//     $zip_handle = new ZipArchive;
//     $output_text = "";
//     if(true === $zip_handle->open($input_file)){
//         if(($xml_index = $zip_handle->locateName($xml_filename)) !== false){
//             $xml_datas = $zip_handle->getFromIndex($xml_index);
//             $xml_handle = DOMDocument::loadXML($xml_datas, LIBXML_NOENT | LIBXML_XINCLUDE | LIBXML_NOERROR | LIBXML_NOWARNING);
//             $output_text = strip_tags($xml_handle->saveXML());
//         }else{
//             $output_text .="";
//         }
//         $zip_handle->close();
//     }else{
//     $output_text .="";
//     }
//     return $output_text;
// }

// /*************************power point files*****************************/
// function pptx_to_text($input_file){
//     $zip_handle = new ZipArchive;
//     $output_text = "";
//     if(true === $zip_handle->open($input_file)){
//         $slide_number = 1; //loop through slide files
//         while(($xml_index = $zip_handle->locateName("ppt/slides/slide".$slide_number.".xml")) !== false){
//             $xml_datas = $zip_handle->getFromIndex($xml_index);
//             $xml_handle = DOMDocument::loadXML($xml_datas, LIBXML_NOENT | LIBXML_XINCLUDE | LIBXML_NOERROR | LIBXML_NOWARNING);
//             $output_text .= strip_tags($xml_handle->saveXML());
//             $slide_number++;
//         }
//         if($slide_number == 1){
//             $output_text .="";
//         }
//         $zip_handle->close();
//     }else{
//     $output_text .="";
//     }
//     return $output_text;
// }


//     public function convertToText() {

//         if(isset($this->filename) && !file_exists($this->filename)) {
//             return "File Not exists";
//         }

//         $fileArray = pathinfo($this->filename);
//         $file_ext  = $fileArray['extension'];
//         if($file_ext == "doc" || $file_ext == "docx" || $file_ext == "xlsx" || $file_ext == "pptx")
//         {
//             if($file_ext == "doc") {
//                 return $this->read_doc();
//             } elseif($file_ext == "docx") {
//                 return $this->read_docx();
//             } elseif($file_ext == "xlsx") {
//                 return $this->xlsx_to_text();
//             }elseif($file_ext == "pptx") {
//                 return $this->pptx_to_text();
//             }
//         } else {
//             return "Invalid File Type";
//         }
//     }

// }




// 	$docObj = new DocxConversion("C:\Proyectos\Vehicular/__PROY__ACT2040-2020.docx");
// 	$docText = $docObj->convertToText();

// 	$dataDocumento['REGISTRO']=utf8_decode($docText);
?>






