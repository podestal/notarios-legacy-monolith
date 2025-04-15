<?php

// Carga las librerias:
include('../conexion.php');
include_once('../includes/tbs_class.php');
include_once('../includes/tbs_plugin_opentbs.php');
include_once('../includes/ClaseLetras.class.php');
include_once('../extraprotocolares/Config/Configuracion.php');


include("../phpqrcode/qrlib.php");

$TBS =  new clsTinyButStrong('{,}');
$TBS->NoErr = true;
// Se cargan las propiedades del PLUGIN
$TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN);
$TBS->ResetVarRef(true);
$TBS->MergeField('var');

## notario :
$busnumcarta = "SELECT CONCAT(confinotario.nombre, ' ', confinotario.apellido ) AS 'NOTARIO' FROM confinotario";
$numcartabus = mysql_query($busnumcarta,$conn) or die(mysql_error());
$rownum = mysql_fetch_array($numcartabus);
$muesnotario = $rownum[0];
##

###########################################
##  SE DEFINE PATH PARA TEMPLATES Y SALIDAS
# 1 Se crea Objetos
$ruta_templates  = new AsignaPath;	
$ruta_archivos   = new AsignaPath;
# 2. Templates
$path_template   = $ruta_templates->__set_path_template();
# 3. Salida de Data
$path_exit       = $ruta_archivos->__set_path_exit('cartas');

$extension       = $ruta_archivos->__set_tip_output_ep();
###########################################

//se crea el objeto  ClaseLetras
	$fecha = new ClaseNumeroLetra();
	
	$dia  = $fecha->fun_fecha_dia(); 
	$mes  = $fecha->fun_fecha_mes();
	$anio = $fecha->fun_fecha_anio();
	$fec_letras = $fecha->fun_fech_comple(date("Y/m/d"));


	$suffix = '';
	$debug  = '';

// Se verifica que formato de plantilla se usara.
	$template = $path_template."plantilla_certificaciones_carta".$extension;
	
	//echo $template; exit;
	//$template = basename($template);
	$x = pathinfo($template);
	$template_ext  = $x['extension'];
	$template_name = $x['basename'];
	if (!file_exists($template)) exit("Ruta o nombre de la plantilla definido Incorrectamente.");

	$num_carta        = $_REQUEST["num_carta"];        //Num. Cronologico a exportar.
	$usuario_imprime  = $_REQUEST["usuario_imprime"];  //Nombre del usuario que imprime.
	$nombre_notario   = strtoupper(utf8_decode($muesnotario));       //Nombre del notario.
	//$nom_dist     = $_REQUEST["dist_notario"];       //Nombre del Distrito.
	$fecha_impresion  = date("d/m/Y");                 //Fecha de impresion.

//Consulta segun parametro enviado:
$consulcartas = mysql_query('SELECT CONCAT(RIGHT(ingreso_cartas.num_carta,6),"-", LEFT(ingreso_cartas.num_carta,4)) AS "num_carta", 
UPPER(ingreso_cartas.conte_carta) AS "contenido", DATE_FORMAT(STR_TO_DATE(ingreso_cartas.fec_entrega,"%d/%m/%Y"),"%Y/%m/%d") AS "fecha_diligencia",
ingreso_cartas.hora_entrega, DATE_FORMAT(STR_TO_DATE(ingreso_cartas.fec_entrega,"%d/%m/%Y"),"%d/%m/%Y") AS "fecha_diligencia",
DATE_FORMAT(STR_TO_DATE(ingreso_cartas.fec_ingreso,"%d/%m/%Y"),"%Y/%m/%d") AS "fecha_ingreso"
FROM ingreso_cartas WHERE ingreso_cartas.num_carta = "'.$num_carta.'" ', $conn) or die(mysql_error());

// CONCAT(RIGHT("'.$num_carta.'",4),"0", LEFT("'.$num_carta.'",5))
	$rowcartas = mysql_fetch_array($consulcartas);


//Definicion de las variables para llenar la plantilla dinamicamente

	$num_carta	          = $rowcartas[0];
	$contenido_carta_0      = strtoupper(utf8_decode($rowcartas[1]));
	
	$contenido_carta_1 = str_replace("00/00/0000", $rowcartas[4], $contenido_carta_0);
	$contenido_carta   = str_replace("00:00", $rowcartas[3], $contenido_carta_1);
	
	//$fec_diligencia       = $rowcartas[2];
	$fec_diligencia       = $fecha->fun_fech_comple($rowcartas[2]);
	$fec_ingreso       = $fecha->fun_fech_num($rowcartas[5]);
	

/////////////////////////////////////////////////////////////7
//qr
$sqlpoder = mysql_query('SELECT id_carta, num_carta, 
		fec_ingreso,
		id_remitente AS docuremitente,
		nom_remitente,
		dir_remitente,
		nom_destinatario,
		dir_destinatario,
		zona_destinatario,
		costo,
		fec_entrega ,
		hora_entrega,
		conte_carta AS contenido,
		doc_recogio,
		nom_regogio,
		fec_recogio,
		fact_recogio AS numero
		FROM ingreso_cartas   WHERE id_carta ="'.$num_carta.'"', $conn) or die(mysql_error());

$arr_viaje[]=array();
$poder = mysql_fetch_array($sqlpoder);
	$arr_viaje[0] = $poder["id_carta"]; 
	$arr_viaje[1] = $poder["num_carta"]; 
	$arr_viaje[2] = $poder["fec_ingreso"]; 
	$arr_viaje[3] = $poder["docuremitente"]; 
	$arr_viaje[4] = $poder["nom_remitente"]; 
	$arr_viaje[5] = $poder["dir_remitente"]; 
	$arr_viaje[6] = $poder["nom_destinatario"]; 
	$arr_viaje[7] = $poder["dir_destinatario"]; 
	$arr_viaje[8] = $poder["zona_destinatario"]; 
	$arr_viaje[9] =  $poder["nom_destinatario"]; 
	$arr_viaje[10] = $poder["fec_entrega"]; 
	$arr_viaje[11] = $poder["hora_entrega"]; 
	$arr_viaje[12] = $poder["contenido"]; 
	$arr_viaje[13] = $poder["doc_recogio"]; 
	$arr_viaje[14] = $poder["nom_regogio"]; 
	$arr_viaje[15] = $poder["fec_recogio"]; 
	$arr_viaje[16] = $poder["numero"]; 
	
	//JSON
         $objPermisoViaje = new stdClass();
		 $objPermisoViaje->codigotipoinstrumento = 104;
		 $objPermisoViaje->codigoinstrumento = 254; 
		 $objPermisoViaje->codigonotaria ="10024231572";
		 $objPermisoViaje->fecharegistro =$arr_viaje[2];
		 $objPermisoViaje->numerocontrol =  $arr_viaje[0];
		 $objPermisoViaje->numeroformulario =$arr_viaje[15];
		 $objPermisoViaje->cronologico = $arr_viaje[1];
		 $objPermisoViaje->observacion = $arr_viaje[12];;
		 $objPermisoViaje->fechadiligencia =  $arr_viaje[10]; 
		 $objPermisoViaje->horadiligencia =  $arr_viaje[11];
		 $objPermisoViaje->diligenciadopor = $arr_viaje[9];
		 $objPermisoViaje->documentoclienteentrega = "";
		 $objPermisoViaje->numerodocumentoclienteentrega =$arr_viaje[13];
		 $objPermisoViaje->nombreclienteentrega = $arr_viaje[14];
		 $objPermisoViaje->fechaentregadocliente = $arr_viaje[10];
		

		
		 $consultapar = mysql_query('SELECT 
		 11 AS remitente,
		  C.`idtipdoc`,
		 id_remitente AS docuremitente,
		 dir_remitente,
		 U.nomdis, U.nomprov,U.nomdpto
		 ,C.apepat,C.`apemat`, C.`prinom`,
		 SUBSTRING(C.`docpaisemi`, 1, 3) AS segundo,
		 12 AS destinatario,
		  C.`idtipdoc`,
		 id_remitente AS docuremitente,
		 dir_remitente,
		 U.nomdis, U.nomprov,U.nomdpto
		 ,C.apepat,C.`apemat`, C.`prinom`,
		 SUBSTRING(C.`docpaisemi`, 1, 3) AS segundo
		 FROM ingreso_cartas P
		 INNER JOIN cliente C ON C.`numdoc`= P.`id_remitente` 
		 INNER JOIN ubigeo U ON U.coddis = C.`idubigeo`
		 WHERE id_carta ="'.$num_carta.'"', $conn) or die(mysql_error());
			$objParticipante = new stdClass();

			$nuevo = mysql_fetch_array($consultapar);
		
		
		
		
			$valores = array(
				array($nuevo[0],$nuevo[1],$nuevo[2],$nuevo[3],$nuevo[4],$nuevo[5],$nuevo[6],$nuevo[7] ,$nuevo[8],$nuevo[9],$nuevo[10]),
				array($nuevo[11],$nuevo[12],$nuevo[13] ,$nuevo[14],$nuevo[15],$nuevo[16],$nuevo[17],$nuevo[18] ,$nuevo[19],$nuevo[20],$nuevo[21]));

								


			for($i = 0; $i < count($valores); ++$i){
			
			$objParticipante->condicion = $valores[$i][0];
			$objParticipante->tipodocumento = '0'.$valores[$i][1];
			$objParticipante->documento = $valores[$i][2];
			$objParticipante->nombres = $valores[$i][9];
			$objParticipante->apellidopaterno = $valores[$i][7];
			$objParticipante->apellidomaterno = $valores[$i][8];
			$objParticipante->direccion = $valores[$i][3];
			$objParticipante->correo = '';
			$objParticipante->nacionalidad = 'PER';
			$objParticipante->departamento =  $valores[$i][4];
			$objParticipante->provincia =  $valores[$i][5];
			$objParticipante->distrito =  $valores[$i][6];
			$objParticipante->observacion = '';
			$objParticipante->observacion = '';

			$datos[] = array('condicion'=> $objParticipante->condicion, 'tipodocumento'=>$objParticipante->tipodocumento,
			'documento'=>$objParticipante->documento,'nombres'=>$objParticipante->nombres,'apellidopaterno'=>$objParticipante->apellidopaterno,
			'apellidomaterno'=>$objParticipante->apellidomaterno,'direccion'=>$objParticipante->direccion,'correo'=>$objParticipante->correo,
			'telefono'=>$objParticipante->telefono,'nacionalidad'=>$objParticipante->nacionalidad,
			'departamento'=>$objParticipante->departamento,'provincia'=>$objParticipante->provincia
			,'distrito'=>$objParticipante->distrito,'observacion'=>$objParticipante->observacion);
			
		}
		
		
		 $objPermisoViaje->participantes  = $datos; 


		 // echo json_encode($objPermisoViaje);
		$objJson  = new stdClass();
		$objPermiViaje = new  stdClass();
		$objPermiViaje->ppoder = $objPermisoViaje;
		$objJson->ppoder = $objPermisoViaje;
		//$objJson->json = $objPermiViaje;
		$dataJson =  $objJson;
		$dataJson =  json_encode(array($objPermisoViaje));
		$std = new stdClass();
		$std->ppoder = $objPermisoViaje;
		$json = json_encode($std);
		$data = array("cartas" => $objPermisoViaje);
		$versiones = array(
			"cartas" => $objPermisoViaje
		);
		$myJSON = json_encode($versiones);

		$dataJson = json_encode(array("json" => $myJSON));
		

         

		define('WS_ENVIAR_DOCUMENTO','http://200.60.145.200/serviceqr/public/api/cartas');
		$ch = curl_init();  
		curl_setopt($ch, CURLOPT_URL, WS_ENVIAR_DOCUMENTO);  
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36');
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_POST,true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $dataJson);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: '.strlen($dataJson)));
		curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, true);
		$responseString = curl_exec ($ch); 

		$objResponse = json_decode($responseString, true);

		

		$codigonuevo=$objResponse['instrumento']['codigoencriptado'];
		
		//var_dump ($arr_resp[0]);
		$TBS->VarRef['codigonuevo'] = $codigonuevo;
		
		if(count($objResponse['error'])>0){
			$erroresnew='';
			for ($i = 0; $i < count($objResponse['error']); $i++) {
				$arr_resp[$i]=$objResponse['error'][$i];
				$erroresnew = $erroresnew."\n".$arr_resp[$i];
			}
			echo "Error'.$erroresnew.' ";
			die();

		}else {

			$dir = 'tempo1/';
			//Si no existe la carpeta la creamos
			if (!file_exists($dir))
				mkdir($dir);
				//Declaramos la ruta y nombre del archivo a generar
			$filename = $dir.'carta'.$arr_viaje[0] .'.png';
			$img='carta'.$arr_viaje[0] .'.png';
				//Parametros de Condiguración
			$tamaño = 10; //Tamaño de Pixel
			$level = 'L'; //Precisión Baja
			$framSize = 3; //Tamaño en blanco
			$contenido =$objResponse['hash']; //Texto
				//Enviamos los parametros a la Función para generar código QR 
			QRcode::png($contenido, $filename, $level, $tamaño, $framSize); 
			//Mostramos la imagen generada
			//echo '<img src="'.$dir.basename($filename).'" /><hr/>'; 
			$imagen =$dir.basename($filename); 
			$ruta1 = getcwd().'\\tempo1\\';
			$ruta = $ruta1.$img;
			$TBS->VarRef['test'] =  $ruta;

//Carga la plantilla;
	$TBS->LoadTemplate($template);
	
	$TBS->MergeBlock('a', $dataTestigos);
	$TBS->MergeBlock('b', $dataContratantes);
	$TBS->MergeBlock('e', $firmasTestigos);
	$TBS->MergeBlock('f', $dataPoderdantes);
	$TBS->MergeBlock('g', $dataCabecera);
	

//Si existen comentios en la plantilla los oculta.
	$TBS->PlugIn(OPENTBS_DELETE_COMMENTS);
	$TBS->PlugIn(OPENTBS_CHANGE_PICTURE, 'descripcionImagen', $ruta);
//Nombre para el archivo a descargar.
	//$file_name = 


    $file_name = $path_exit.'Carta'.$num_carta.$extension;
	$file_name_show = 'Carta'.$num_carta.$extension;
	
	//$file_name = str_replace('.','_'.$suffix.'.',$file_name);
	
    $TBS->Show(TBSZIP_FILE, $file_name);
	
	//$TBS->Show(OPENTBS_DOWNLOAD, $file_name);
#}
	echo "Se genero el archivo: ".$file_name_show." satisfactoriamente..!!";
//$TBS->Show(OPENTBS_DOWNLOAD, $file_name);
}
?>
