<?php

// Carga las librerias:
include('../conexion.php');
include_once('../includes/tbs_class.php');
include_once('../includes/tbs_plugin_opentbs.php');
include_once('../includes/ClaseLetras.class.php');
include_once('../extraprotocolares/Config/Configuracion.php');
include_once('fecha_letra.php');


include("../phpqrcode/qrlib.php");

$TBS =  new clsTinyButStrong('{,}');
$TBS->NoErr = true;
// Se cargan las propiedades del PLUGIN
$TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN);
$TBS->ResetVarRef(true);
$TBS->MergeField('var');



###########################################
##  SE DEFINE PATH PARA TEMPLATES Y SALIDAS
# 1 Se crea Objetos
$ruta_templates  = new AsignaPath;	
$ruta_archivos   = new AsignaPath;
# 2. Templates
$path_template   = $ruta_templates->__set_path_template();
# 3. Salida de Data
$path_exit       = $ruta_archivos->__set_path_exit('libro');

$extension       = $ruta_archivos->__set_tip_output_ep();
###########################################

## notario :
$busnumcarta = "SELECT CONCAT(confinotario.nombre, ' ', confinotario.apellido ) AS 'NOTARIO' , confinotario.direccion, confinotario.distrito FROM confinotario";
$numcartabus = mysql_query($busnumcarta,$conn) or die(mysql_error());
$rownum      = mysql_fetch_array($numcartabus);
$muesnotario = strtoupper(utf8_decode($rownum[0]));
$direccion   =  strtoupper(utf8_decode($rownum[1]));
$distrito_notario   = strtoupper(utf8_decode($rownum[2]));
##

//se crea el objeto  ClaseLetras
	$fecha = new ClaseNumeroLetra();
	
	$hojas = new ClaseNumeroLetra();

	$dia  = $fecha->fun_fecha_dia(); 
	$mes  = $fecha->fun_fecha_mes();
	$anio = $fecha->fun_fecha_anio();
	$fec_letras = $fecha->fun_fech_comple(date("Y/m/d"));
	



	$suffix = '';
	$debug  = '';

// Se verifica que formato de plantilla se usara.
	$template = $path_template."plantilla_libro".$extension;
	
	//echo $template; exit;
	//$template = basename($template);
	$x = pathinfo($template);
	$template_ext  = $x['extension'];
	$template_name = $x['basename'];
	if (!file_exists($template)) exit("Ruta o nombre de la plantilla definido Incorrectamente.");

	$num_libro        = $_REQUEST["num_libro"];          //Num. Cronologico a exportar.
	
	$anio1        = $_REQUEST["ano_libro"];  
	$anio = substr($anio1,-10,4);
	
	$usuario_imprime  = $_REQUEST["usuario_imprime"];    //Nombre del usuario que imprime.
	$nombre_notario   = $muesnotario;        //Nombre del notario.
	$direc_notario	  = $direccion; 		//Direccion del notario.
	$nom_dist         = "BARRANCO";       //Nombre del Distrito.
	$fecha_impresion  = date("d/m/Y");                   //Fecha de impresion.

//Consulta segun parametro enviado:
$consullibros = mysql_query('SELECT libros.numlibro, libros.descritiplib, libros.empresa,  libros.ruc, libros.folio, 
tipofolio.destipfol, CONCAT(libros.numlibro , "-" , libros.ano) AS "num_crono", CONCAT(libros.apepat," ",libros.apemat,", ",libros.prinom," ", libros.segnom) AS "nombre",
(CASE WHEN (libros.tipper="N") THEN libros.ruc ELSE libros.ruc END) AS "documento", (CASE WHEN (libros.tipper="N") THEN "D.N.I." ELSE "R.U.C." END) AS "tipo_documento" ,
nlibro.idnlibro , nlibro.idnlibro , libros.solicitante , libros.dni, libros.comentario, libros.comentario2, libros.tipper, libros.fecing, tipolegal.deslegal
FROM libros
INNER JOIN tipofolio ON tipofolio.idtipfol = libros.idtipfol
INNER JOIN nlibro ON nlibro.idnlibro = libros.idnlibro
INNER JOIN tipolegal ON tipolegal.idlegal = libros.idlegal
WHERE libros.numlibro =   "'.$num_libro.'" ', $conn) or die(mysql_error());
	$rowlibro = mysql_fetch_array($consullibros);
	
// CONSULTA DISTRITO LIBRO
$consulDISTRITO = mysql_query('select libros.coddis AS "ID_DISTRITO", ubigeo.nomdis as "DISTRITO"  
from libros
inner join ubigeo ON ubigeo.coddis = libros.coddis
WHERE libros.numlibro =  "'.$num_libro.'" ', $conn) or die(mysql_error());
	$rowdistrito = mysql_fetch_array($consulDISTRITO);


//Definicion de las variables para llenar la plantilla dinamicamente

	$des_libro	            = strtoupper(utf8_decode($rowlibro[1]));
	
	$nom_empresa0     		= strtoupper(utf8_decode($rowlibro[2]));
	$nom_empresa1	    	= str_replace("?","'",$nom_empresa0);
	$nom_empresa2	   		= str_replace("*","&",$nom_empresa1);
	$nom_empresa	  		= strtoupper($nom_empresa2);
	
	$num_ruc                = $rowlibro[3];
	$num_hojas2             = $rowlibro[4];
	$tip_folio	            = $rowlibro[5];
	$num_cronologico        = $rowlibro[6];
	
	$nombre_persona0   		= strtoupper(utf8_decode($rowlibro[7]));
	$nombre_persona1	   	= str_replace("?","'",$nombre_persona0);
	$nombre_persona2	   	= str_replace("*","&",$nombre_persona1);
	$nombre_persona	  	    = strtoupper($nombre_persona2);
	
	$documento              = $rowlibro[8];
	$tipo_documento         = $rowlibro[9];
	$nro_libro		        = $rowlibro[10];
		
	$nombre_solici0	  		= strtoupper(utf8_decode($rowlibro[12]));
	$nombre_solici1	    	= str_replace("?","'",$nombre_solici0);
	$nombre_solici2	   		= str_replace("*","&",$nombre_solici1);
	$nombre_solici	  		= strtoupper($nombre_solici2);
	
	$dni_solici		        = $rowlibro[13];
	//$nom_dist         = $rowdistrito[1];
		
	############### NUEVO SEGUN REQUERIMIENTO ###############
	$comentario		  = strtoupper(utf8_decode($rowlibro[14]));
	$comentario2	  = strtoupper(utf8_decode($rowlibro[15]));
	$fechaconv	      = explode('-',$rowlibro[17]);
	$fechaingresolib  = $fechaconv[2]."/".$fechaconv[1]."/".$fechaconv[0];
	$fecha_letras_lib     = strtoupper(fechaALetras($fechaingresolib));
	
	
	$fecha_letras_viaext2 = $fecha->fun_fech_completo2_dd($rowlibro[17]);
	
	$fec_letras_completa= strtoupper(utf8_decode($fecha_letras_viaext2));
	
	$tipolegalizacion = $rowlibro[18];
	
	## Busca la partida electronica de la persona juridica:
	$consulPartida = mysql_query('SELECT cliente.numpartida FROM cliente WHERE cliente.numdoc = "'.$num_ruc.'" ', $conn) or die(mysql_error());
	$rowpartidareg = mysql_fetch_array($consulPartida);
	$num_partida   = $rowpartidareg[0];

	## evalua tipo persona
	$eval_tipo_persona = "";
	if($rowlibro[16]=="J")
		{
				$eval_tipo_persona = utf8_decode(", SEGÚN FACULTADES QUE OBRAN EN LA PARTIDA ELECTRÓNICA N° " .$num_partida. " DEL REGISTRO DE PERSONAS JURÍDICAS DE LIMA.");
		}
	##########################################################
		
	if($nom_empresa=="")
	{
		$eval_persona = $nombre_persona;
	}
	else if($nom_empresa!="")
	{
		$eval_persona = $nom_empresa;	
	}
	
	
	$num_hojas		  = $num_hojas2;
	
if($des_libro == '' || $num_hojas2=="" || $tip_folio=="" )
		{
			echo 'Error 01: Falta Ingresar datos';
			exit();	
		}



/////////////////////////////////////////////////////////////7
//qr
$sqlpoder = mysql_query("SELECT
(CASE
WHEN L.idtiplib = 1 THEN 201
WHEN L.idtiplib = 99 THEN 999 
WHEN L.idtiplib = 2 THEN 202
WHEN L.idtiplib = 3 THEN 203
WHEN L.idtiplib = 4 THEN 204
WHEN L.idtiplib = 5 THEN 205
WHEN L.idtiplib = 6 THEN 206
WHEN L.idtiplib = 7 THEN 207
WHEN L.idtiplib = 8 THEN 208
WHEN L.idtiplib = 9 THEN 209
WHEN L.idtiplib = 10 THEN 210
WHEN L.idtiplib = 11 THEN 211
WHEN L.idtiplib = 12 THEN 212
WHEN L.idtiplib = 13 THEN 213
WHEN L.idtiplib = 14 THEN 214
WHEN L.idtiplib = 15 THEN 215
WHEN L.idtiplib = 16 THEN 216
WHEN L.idtiplib = 17 THEN 217
WHEN L.idtiplib = 18 THEN 218
WHEN L.idtiplib = 19 THEN 219
WHEN L.idtiplib = 20 THEN 220
END)AS idinstrumento,
IF(DATE_FORMAT(L.fecing,'%d-%m-%Y')='00-00-0000','',DATE_FORMAT(L.fecing,'%d/%m/%Y')) AS fecing,
CAST(L.numlibro AS SIGNED) AS numerocontrol,
'' AS numeroformulario,
CONCAT_WS('-', L.numlibro,L.ano) AS cronologico,
IF(N.descon IS NULL,'',N.descon) AS notariolibroanterior,
'' AS cronologicoanterior,
L.feclegal AS fechalegalizacionlibroanterior,
L.comentario AS comentariolibroanterior,
'' AS denuciapiliciallibroanterior,
'' AS descripciondenpililibroanterior,
(CASE
WHEN L.idlegal = 1 THEN 601
WHEN L.idlegal = 2 THEN 602 
WHEN L.idlegal = 3 THEN 603
END)AS idtipolegalizacion,
(CASE
WHEN L.idtipfol = 1 THEN 501
WHEN L.idtipfol = 2 THEN 502 
WHEN L.idtipfol = 3 THEN 503
WHEN L.idtipfol = 4 THEN 504
WHEN L.idtipfol = 5 THEN 505
WHEN L.idtipfol = 6 THEN 506
WHEN L.idtipfol = 7 THEN 507
WHEN L.idtipfol = 8 THEN 508 
END)AS idtipofoja,
(CASE
WHEN L.idnlibro = 1 THEN 401
WHEN L.idnlibro = 2 THEN 402 
WHEN L.idnlibro = 3 THEN 403
WHEN L.idnlibro = 4 THEN 404
WHEN L.idnlibro = 5 THEN 405
WHEN L.idnlibro = 6 THEN 406
WHEN L.idnlibro = 7 THEN 407
WHEN L.idnlibro = 8 THEN 408
WHEN L.idnlibro = 9 THEN 409
WHEN L.idnlibro = 10 THEN 410
WHEN L.idnlibro = 11 THEN 411
WHEN L.idnlibro = 12 THEN 412
WHEN L.idnlibro = 13 THEN 413
WHEN L.idnlibro = 14 THEN 414
WHEN L.idnlibro = 15 THEN 415
WHEN L.idnlibro = 16 THEN 416
END)AS idnumerolibro,
L.folio,
'' AS folioinicial,
'' AS foliofinal,
L.comentario2 AS observacion
FROM libros L
LEFT JOIN notarios N ON N.idnotario = L.idnotario  WHERE L.numlibro ='".$num_libro."'", $conn) or die(mysql_error());

$arr_viaje[]=array();
$poder = mysql_fetch_array($sqlpoder);
	$arr_viaje[0] = $poder["idinstrumento"]; 
	$arr_viaje[1] = $poder["fecing"]; 
	$arr_viaje[2] = $poder["numerocontrol"]; 
	$arr_viaje[3] = $poder["numeroformulario"]; 
	$arr_viaje[4] = $poder["cronologico"]; 
	$arr_viaje[5] = $poder["notariolibroanterior"]; 
	$arr_viaje[6] = $poder["cronologicoanterior"]; 
	$arr_viaje[7] = $poder["fechalegalizacionlibroanterior"]; 
	$arr_viaje[8] = $poder["comentariolibroanterior"]; 
	$arr_viaje[9] = $poder["denuciapiliciallibroanterior"]; 
	$arr_viaje[10] = $poder["descripciondenpililibroanterior"]; 
	$arr_viaje[11] = $poder["idtipolegalizacion"]; 
	$arr_viaje[12] = $poder["idtipofoja"]; 
	$arr_viaje[13] = $poder["idnumerolibro"]; 
	$arr_viaje[14] = $poder["folio"]; 
	$arr_viaje[15] = $poder["folioinicial"]; 
	$arr_viaje[16] = $poder["foliofinal"]; 
	$arr_viaje[17] = $poder["observacion"]; 
	//JSON
         $objPermisoViaje = new stdClass();
		 $objPermisoViaje->codigotipoinstrumento = 101;
		 $objPermisoViaje->codigoinstrumento = $arr_viaje[0]; 
		 $objPermisoViaje->codigonotaria ="10024231572";
		 $objPermisoViaje->fecharegistro =$arr_viaje[1];
		 $objPermisoViaje->numerocontrol =  $arr_viaje[2];
		 $objPermisoViaje->numeroformulario =$arr_viaje[3];
		 $objPermisoViaje->cronologico = $arr_viaje[1];
		 $objPermisoViaje->notariolibroanterior =  $arr_viaje[5]; 
		 $objPermisoViaje->cronologicolibroanterior = ' ';
		 $objPermisoViaje->fechalegalizacionlibroanterior = $arr_viaje[7];
		 $objPermisoViaje->descripcionlibroanterior =$arr_viaje[8];
		 $objPermisoViaje->denunciapiliciallibroanterior =' ';
		 $objPermisoViaje->descripciondenpolilibroanterior = $arr_viaje[10];
		 $objPermisoViaje->codigolegalizacion = $arr_viaje[11];
		 $objPermisoViaje->codigotipofojas = $arr_viaje[12];
		 $objPermisoViaje->codigonumerolibro = $arr_viaje[13];
		 $objPermisoViaje->folio = $arr_viaje[14];
		 $objPermisoViaje->numerofojas = $arr_viaje[14];
		 $objPermisoViaje->folioinicial = ' ';
		 $objPermisoViaje->foliofinal =' ';
		 $objPermisoViaje->direccion =' ';
		 $objPermisoViaje->observacion = $arr_viaje[17];
		

		 $consultapar = mysql_query("SELECT
		 '4' AS condicion,
		 IF(LENGTH(ruc)=8, '1', '6') AS tipodocu, 
		 ruc,
		 (CASE
		 WHEN LENGTH(ruc) = 8 THEN CONCAT_WS( ' ',apepat,apemat,prinom )
		 WHEN LENGTH(ruc) = 11 THEN empresa
		 END) AS nombre, 
		 (CASE
		 WHEN LENGTH(ruc) = 8 THEN domicilio
		 WHEN LENGTH(ruc) = 11 THEN domfiscal
		 END) AS direccion, 
		 '5' AS condicion1,
		 IF(LENGTH(dni)=8, '1', '6') AS tipodocu2,
		 dni, solicitante,comentario2 FROM libros  WHERE numlibro like '".$num_libro."'", $conn) or die(mysql_error());

			$objParticipante = new stdClass();

			
			$nuevo = mysql_fetch_array($consultapar);


			$valores = array(
				array($nuevo[0],$nuevo[1],$nuevo[2] ,$nuevo[3],$nuevo[4]),
				array($nuevo[5],$nuevo[6],$nuevo[7] ,$nuevo[8],$nuevo[9]));
		

			
			for($i = 0; $i < count($valores); ++$i){
			
			$objParticipante->condicion ='0'.$valores[$i][0];	
			$objParticipante->tipodocumento = '0'.$valores[$i][1];
			$objParticipante->documento =$valores[$i][2];
			$objParticipante->nombres = $valores[$i][3];
			$objParticipante->apellidopaterno = $valores[$i][3];
			$objParticipante->apellidomaterno = $valores[$i][3];
			$objParticipante->direccion =$valores[$i][4];
			$objParticipante->correo = '';
			$objParticipante->nacionalidad = 'PER';
			$objParticipante->departamento =  '';
			$objParticipante->provincia =  '';
			$objParticipante->distrito =  '';
			$objParticipante->representante_cartapoder = '';
			$objParticipante->descripcionacartapoder = '';
			$objParticipante->cargo = '';
			$objParticipante->partidaregistral = ' ';
			$objParticipante->sederegistral = ' ';
			$objParticipante->isrepresentante = '';
			$objParticipante->iscartapoder = '';
			$objParticipante->asiento = '';
			$objParticipante->observacion = '';

			$datos[] = array('condicion'=> $objParticipante->condicion, 'tipodocumento'=>$objParticipante->tipodocumento,
			'documento'=>$objParticipante->documento,'nombres'=>$objParticipante->nombres,'apellidopaterno'=>$objParticipante->apellidopaterno,
			'apellidomaterno'=>$objParticipante->apellidomaterno,'direccion'=>$objParticipante->direccion,'correo'=>$objParticipante->correo,
			'nacionalidad'=>$objParticipante->nacionalidad,'departamento'=>$objParticipante->departamento,'provincia'=>$objParticipante->provincia
			,'distrito'=>$objParticipante->distrito,'representante_cartapoder'=>$objParticipante->representante_cartapoder,'descripcionacartapoder'=>$objParticipante->descripcionacartapoder
			,'cargo'=>$objParticipante->cargo,'partidaregistral'=>$objParticipante->partidaregistral,'sederegistral'=>$objParticipante->sederegistral
			,'isrepresentante'=>$objParticipante->isrepresentante,'iscartapoder'=>$objParticipante->iscartapoder
		,'asiento'=>$objParticipante->asiento,'observacion'=>$objParticipante->observacion);
			
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
		$data = array("libros" => $objPermisoViaje);
		$versiones = array(
			"libros" => $objPermisoViaje
		);
		$myJSON = json_encode($versiones);

		$dataJson = json_encode(array("json" => $myJSON));
		


		define('WS_ENVIAR_DOCUMENTO','http://200.60.145.200/serviceqr/public/api/libros');
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
			$filename = $dir.'libros'.$arr_viaje[0] .'.png';
			$img='libros'.$arr_viaje[0] .'.png';
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

//Si existen comentios en la plantilla los oculta.
	$TBS->PlugIn(OPENTBS_DELETE_COMMENTS);
	$TBS->PlugIn(OPENTBS_CHANGE_PICTURE, 'descripcionImagen', $ruta);
//Nombre para el archivo a descargar.
	//$file_name = 

    $file_name = $path_exit.'Libro'.$num_libro.$extension;
	$file_name_show = 'Libro'.$num_libro.$extension;
	
	
	
    $TBS->Show(TBSZIP_FILE, $file_name);

	echo "Se genero el archivo: ".$file_name_show." satisfactoriamente..!!";
	
		}
?>
