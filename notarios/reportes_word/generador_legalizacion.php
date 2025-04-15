<?php 
require_once 'Phpdocx/Create/CreateDocx.inc';
session_start(); 

function legalizacion(){
	

	include('../conexion.php');
	include('../conexion2.php');
	include('../extraprotocolares/view/funciones.php');
	include('../includes/tbs_class.php');
	include('../includes/tbs_plugin_opentbs.php');
	include('../includes/ClaseLetras.class.php');
	include('fecha_letra.php');

	$idLegalizacion = $_REQUEST["idLocalizacion"]; // idLegalizacion o numero cronologico
	$anio = date('Y');

	$num_carta = $anio.str_pad($idLegalizacion, 6, '0', STR_PAD_LEFT);
	
	
	$usuario_imprime  = $_REQUEST["usuario_imprime"];  //Nombre del usuario que imprime.



	$queryUsuario = "SELECT loginusuario,
							dni
					FROM usuarios 
					WHERE CONCAT(apepat,' ',prinom)='$usuario_imprime'";
	$executeQuery = mysql_query($queryUsuario);
	$arrUsuario = mysql_fetch_assoc($executeQuery);

	
	$rutaPlantilla="D:/plantillas/EXTRAPROTOCOLARES/CERTIFICACIONES/CERTIFICACION DE FIRMAS/FIRMA SIMPLE Y FUNCIONARIOS/FIRMA SIMPLE BASE.docx";
	
	$rutaDocumentoGenerado="C:/Doc_generados/legalizaciones/";
	$txtListContratantes=array();

		
		$resultTransferencia = consulta_legalizaciones($num_carta, $idLegalizacion);


		$template = $rutaPlantilla;
		
		$file_name  = $rutaDocumentoGenerado."__FIRMA__".$num_carta."."."docx";
		$contratantes=array();
				
		
		$dataDocumento = get_data_documento($resultTransferencia);
		// print_r($dataDocumento);return false;	
		
		$dataContratantes = get_data_contratantes($resultTransferencia);
		// print_r($dataContratantes);return false;
		// return false;
		
		$totalDataTransferentes = count($dataContratantes['transferentes']);
		
		
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
		
			'INICIO_P' => $dataContratantes['INICIO_P'],
			'ES' => $dataContratantes['ES'],
			'S' => $dataContratantes['S'], 
			'ES_SON_P' => $dataContratantes['ES_SON_P'],
			'Y_CON_P' => $dataContratantes['Y_PON_P'],
			'N' => $dataContratantes['N'],
			'Y_P' => $dataContratantes['Y_P'],
			'L_P' => $dataContratantes['L_P'],
			'O_A_P' => $dataContratantes['O_A_P'],
			'O_ERON_P' => $dataContratantes['O_ERON_P'],
			'O_ARON_P' => $dataContratantes['O_ARON_P'],
			'P_FIRMA' => $dataContratantes['P_FIRMA'],
			'P_AMBOS' => $dataContratantes['P_AMBOS'],
			'USUARIO_DNI' => $arrUsuario['dni'],
			'USUARIO' => $arrUsuario['loginusuario'],
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
		
		
		
		$contratantes=array();

		// print_r($dataContratantes['empresas']);return false;

		foreach($dataContratantes['transferentes'] as $key => $value){ 
			$contratantes += $value;
		}

		foreach($dataContratantes['empresas'] as $key => $value){ 
			$contratantes += $value;
		}
		

		$dataDocumento += $contratantes;
		$dataDocumento += $articulosContratantes;
		$dataDocumento += $dataEscrituracion;
		$dataDocumentoWord[] = $dataDocumento;

		// print_r($dataContratantes);return false;
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

	$directorio.= $rutaDocumentoGenerado."__FIRMA__".$num_carta.".docx";
	// print_r($directorio);return false;

	chmod($directorio, 0777);

	
		echo "Se genero el archivo: __FIRMA__".$num_carta." satisfactoriamente.. !!";
}

legalizacion();

function get_data_documento($resultTransferencia){

	$letras = new ClaseNumeroLetra();
	
	$numeroActa = ($resultTransferencia['num_firma']=='')?'[E.NRO_ESC]':$resultTransferencia['num_firma'].'('.$letras->fun_nume_letras($resultTransferencia['num_firma']).')';

	$fechaActa = ($resultTransferencia['fechaIngreso']==0)?'[E.F_IMPRESION]':$letras->fun_fech_letras($resultTransferencia['fechaIngreso']);
	
	$anio = date('Y');
	$dataDocumento= array(
		'NRO_ESC' => $numeroActa,
		// 'NUM_ESC_LET' => $letras->fun_nume_letras($numeroActa),
		'K'=>$resultTransferencia['num_firma'],
		'NUM_REG'=>'1',
		'FEC_LET'=>$letras->fun_fech_letras($resultTransferencia['fechaIngreso']),
		'F_IMPRESION'=>$fechaActa,
		'F'=>$fechaActa,
		'COMPROBANTE'=>'sin',
		'O_S'=>$anio.str_pad($resultTransferencia['idLegalizacion'], 6, '0', STR_PAD_LEFT), //ORDEN DE SERVICIO
		'ORDEN_SERVICIO'=>$resultTransferencia['num_firma'],
	);
	return $dataDocumento;
}

function consulta_legalizaciones($num_carta, $idLegalizacion){
	$query="SELECT l.`idLegalizacion`,
				l.`fechaIngreso`,
				GROUP_CONCAT(sl.idSolicitanteLocalizacion) AS id_solicitante,
				GROUP_CONCAT(c.prinom) AS primer_nombre_solicitante,
				GROUP_CONCAT(IF(c.segnom='',' ',c.segnom)) AS segundo_nombre_solicitante,
				GROUP_CONCAT(c.apepat) AS apellido_paterno_solicitante,
				GROUP_CONCAT(c.apemat) AS apellido_materno_solicitante,
				GROUP_CONCAT(c.numdoc) AS numero_documento_solicictante,
				GROUP_CONCAT(c.sexo) AS sexo_solicictante
			FROM legalizacion AS l
			INNER JOIN solicitantelegalizacion AS sl ON sl.`idLocalizacion`=l.`idLegalizacion`
			INNER JOIN cliente AS c ON c.numdoc = sl.numdoc 
			WHERE idLegalizacion = $idLegalizacion
			GROUP BY idLegalizacion";


	$resultTransferencia = mysql_query($query);
	$row = mysql_fetch_assoc($resultTransferencia);
	return $row;
}


function get_data_contratantes($resultTransferencia){
	$letras = new ClaseNumeroLetra();
	//PERSONA NATURAL A NATURAL
	$llaves=array('{','}','"');
	$primerNombreSolicitante = explode(',',$resultTransferencia['primer_nombre_solicitante']);
	$segundoNombreSolicitante = explode(',',$resultTransferencia['segundo_nombre_solicitante']);
	$apellidoPaternoSolicitante = explode(',',$resultTransferencia['apellido_paterno_solicitante']);
	$apellidoMaternoSolicitante = explode(',',$resultTransferencia['apellido_materno_solicitante']);
	$numeroDocumento = explode(',',$resultTransferencia['numero_documento_solicictante']);
	$sexo = explode(',',$resultTransferencia['sexo_solicictante']);
	
	foreach ($primerNombreSolicitante as $k => $v){

		$contratantes['transferentes'][] = array(
			
			'nombres'=>$primerNombreSolicitante[$k].' '.$segundoNombreSolicitante[$k].' '.$apellidoPaternoSolicitante[$k].' '.$apellidoMaternoSolicitante[$k],
			//'nacionalidad'=>$nacionalidad[$k],
			// 'tipoDocumento'=>$tipoDocumento[$k],
			'numeroDocumento'=>$numeroDocumento[$k],
			'sexo'=>$sexo[$k],
				
		);
		$contratantes['sexoTransferentes'][]=$sexo[$k];	
		 
	}

	foreach ($contratantes['sexoTransferentes'] as  $value) {
		if($value=='F'){
			$contratantes['sexoTransferentes'] = 'MUJERES';
		}if($value=='M'){
			$contratantes['sexoTransferentes'] = 'MIXTO';
			break;
		}
	}


	array_sort_by($contratantes['transferentes'], 'sexo', $order = SORT_DESC);
	

	$articulosTransferentes = articulos_singular_plural($contratantes,'transferentes',count($contratantes['transferentes']),'P',$contratantes['sexoTransferentes']);
	$contratantes = $articulosTransferentes;
	
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

			if($v['condicionEmpresa']=='EMPRESA EN CONSTITUCION'){
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
		$contratantes['ES'] = 'ES';
		$contratantes['S'] = 'S';
		$contratantes['ES_SON_'.$inicial] = 'SON';
		$contratantes['Y_CON_'.$inicial] = 'Y';
		$contratantes['N'] = 'N';
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
		$contratantes['O_ERON_'.$inicial] = '';
		$contratantes['O_ARON_'.$inicial] = '';
		$contratantes[$inicial.'_FIRMA'] = 'FIRMA EN';
		$contratantes[$inicial.'_AMBOS'] = ' ';

	}

	return $contratantes;

}
?>