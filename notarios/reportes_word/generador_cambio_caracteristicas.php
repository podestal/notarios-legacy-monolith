<?php

// Carga las librerias:
include('../conexion.php');
//include('../extraprotocolares/Config/Config_notario.php');
include_once('../includes/tbs_class.php');
include_once('../includes/tbs_plugin_opentbs.php');
include_once('../includes/ClaseLetras.class.php');
include_once('../extraprotocolares/Config/Configuracion.php');


## notario :
$busnumcarta = "SELECT CONCAT(confinotario.nombre, ' ', confinotario.apellido ) AS 'NOTARIO' , confinotario.direccion, confinotario.distrito FROM confinotario"; 
$numcartabus = mysql_query($busnumcarta,$conn) or die(mysql_error());
$rownum = mysql_fetch_array($numcartabus);
$muesnotario     = strtoupper(utf8_decode($rownum[0]));
$direc_notario   = strtoupper(utf8_decode($rownum[1]));
$ubigeo_notario  = strtoupper(utf8_decode($rownum[2]));

	$nombre_notario   = $muesnotario;      //Nombre del notario.
	$direccion_notario	  = $direc_notario; 		//Direcion del notario.
	$distrito_notario = $ubigeo_notario;

##

###########################################
##  SE DEFINE PATH PARA TEMPLATES Y SALIDAS
# 1 Se crea Objetos
$ruta_templates  = new AsignaPath;	
$ruta_archivos   = new AsignaPath;
//$muestra_notario   = new AsignaPath;
# 2. Templates
$path_template   = $ruta_templates->__set_path_template();
# 3. Salida de Data
$path_exit       = $ruta_archivos->__set_path_exit('cambio_caracteristicas');

$extension       = $ruta_archivos->__set_tip_output_ep();
###########################################

## notario : 

//echo $path_exit; exit();
//se crea el objeto  ClaseLetras
	$fecha = new ClaseNumeroLetra();

	$dia  = $fecha->fun_fecha_dia(); 
	$mes  = $fecha->fun_fecha_mes();
	$anio = $fecha->fun_fecha_anio();
	$fec_letras = $fecha->fun_fech_comple(date("Y/m/d"));
	
//Se crea el objeto TBS
	$TBS = new clsTinyButStrong; 
// Se cargan las propiedades del PLUGIN
	$TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN);

	$suffix = '';
	$debug  = '';

// Se verifica que formato de plantilla se usara.
	$template = $path_template."plantilla_cambio_caracteristicas".$extension;

	#$template = basename($template);
	$x = pathinfo($template);
	$template_ext  = $x['extension'];
	$template_name = $x['basename'];
	if (!file_exists($template)) exit("Ruta o nombre de la plantilla definido Incorrectamente.");

	$num_crono        = $_REQUEST["num_crono"];        //Num. poder a exportar.
	$id_cambio        = $_REQUEST["id_cambio"];       
	
	$numcrono2        = substr($num_crono,5,6).'-'.substr($num_crono,0,4);	//Para Mostrar num_crono.
	$usuario_imprime  = $_REQUEST["usuario_imprime"];  //Nombre del usuario que imprime.
	$nombre_notario   = $muesnotario;       //Nombre del notario.
	$fecha_impresion  = date("d/m/Y");                 //Fecha de impresion.
	      

// #= Consultas 

#########################
##### CABECERA ########
$consulcabecera = mysql_query('SELECT cambio_caracter.num_crono, detalle_cambios.des_cambio AS "tipo_cambio" , UPPER(det_cambiocarac.descripcion) AS "num_placa", 
cambio_caracter.nombre AS "participante_particular", IF(ISNULL(cambio_caracter.observacion),"",cambio_caracter.observacion) AS observacion,
cambio_caracter.fec_ingreso AS "fechadeingreso"
FROM cambio_caracter
INNER JOIN det_cambiocarac ON det_cambiocarac.id_cambio = cambio_caracter.id_cambio AND det_cambiocarac.id_dato="0000"
INNER JOIN detalle_cambios ON detalle_cambios.id_cambio = det_cambiocarac.id_dato
WHERE cambio_caracter.num_crono = "'.$num_crono.'" ', $conn) or die(mysql_error());
	$rowcabecera = mysql_fetch_array($consulcabecera);

	
#########################	
## DETALLE
$consuldetalle = mysql_query('SELECT detalle_cambios.des_cambio AS "tip_cambio", det_cambiocarac.descripcion AS "caracter"
FROM det_cambiocarac
INNER JOIN detalle_cambios ON detalle_cambios.id_cambio = det_cambiocarac.id_dato AND det_cambiocarac.id_dato<>"0000"
WHERE det_cambiocarac.id_cambio = "'.$id_cambio.'" ', $conn) or die(mysql_error());

	//$rowdetalle  = mysql_fetch_array($consuldetalle);
	$numcaracter =  mysql_num_rows($consuldetalle);	
	
#########################	
## SOLICITANTES
$consulsolicitante = mysql_query('SELECT cambio_caracter.nombre, tipodocumento.destipdoc AS "tipdoc", cambio_caracter.num_docu AS "numdocu", cambio_caracter.direccion,
tipoestacivil.desestcivil AS "ecivil"
FROM cambio_caracter
INNER JOIN tipodocumento ON tipodocumento.codtipdoc = cambio_caracter.tipdoc
INNER JOIN tipoestacivil ON tipoestacivil.idestcivil = cambio_caracter.ecivil
WHERE cambio_caracter.num_crono = "'.$num_crono.'" ', $conn) or die(mysql_error());
	$rowsolicitante = mysql_fetch_array($consulsolicitante);		


################################
## CAMBIÓ A VARIOS SOLICITANTES:

$consulsolicitantes = mysql_query('SELECT UPPER(CONCAT (CLIENTE.prinom, " ",CLIENTE.segnom, " ",CLIENTE.apepat," ",CLIENTE.apemat )) AS "tipdoc", ccaracter_solicitantes.numdocu_solicitante AS "numdocu",
ccaracter_solicitantes.domic_solicitante AS "direccion", tipoestacivil.desestcivil AS "ecivil",
IF(ubigeo.coddis="070101","DISTRITO DE CALLAO , PROVINCIA CONSTITUCIONAL DEL CALLAO",CONCAT("DISTRITO DE ",ubigeo.nomdis, ", PROVINCIA DE ", ubigeo.nomprov,", DEPARTAMENTO DE ",ubigeo.nomdpto ))  AS "ubigeo",
ccaracter_solicitantes.representante AS "REPRESENTANTE", ccaracter_solicitantes.poder_inscrito AS "PODER_INSCRITO",
ccaracter_solicitantes.tipdoc_representante
FROM ccaracter_solicitantes
INNER JOIN cambio_caracter ON ccaracter_solicitantes.id_cambio = cambio_caracter.id_cambio
INNER JOIN tipodocumento ON tipodocumento.codtipdoc = ccaracter_solicitantes.tipdoc_solicitante
INNER JOIN CLIENTE ON CLIENTE.numdoc = CCARACTER_SOLICITANTES.numdocu_solicitante
INNER JOIN tipoestacivil ON tipoestacivil.idestcivil = ccaracter_solicitantes.ecivil_solicitante
LEFT OUTER JOIN ubigeo ON ubigeo.coddis = ccaracter_solicitantes.ubigeo
WHERE cambio_caracter.num_crono = "'.$num_crono.'" ', $conn) or die(mysql_error());
$numsolicitantes =  mysql_num_rows($consulsolicitantes);	

################################

//Definicion de las variables para llenar la plantilla dinamicamente
	# CABECERA
	$num_placa      = strtoupper($rowcabecera[2]);

	##
	$observaciones  = strtoupper(utf8_decode($rowcabecera[4]));
	
	$fecha_letras_viaext2 = $fecha->fun_fech_completo2_anio($rowcabecera[5]);
	$fec_letras_completa= strtoupper(utf8_decode($fecha_letras_viaext2));
	
	
	# DETALLE
	//$tipcam_vehicular    = $rowdetalle[0];
	//$cambios_vehicular   = $rowdetalle[1];

	
	#DATOS SOLICITANTE
	$nombre_persona0   = strtoupper(utf8_decode($rowsolicitante[0]));
	$nombre_persona1   = str_replace("?","'",$nombre_persona0);
	$nombre_persona2   = str_replace("*","&",$nombre_persona1);
	$nombre_persona    = strtoupper($nombre_persona2);
	
	$tip_doc  		   = utf8_decode($rowsolicitante[1]);
	$num_doc    	   = utf8_decode($rowsolicitante[2]);
	
	$domicilio0    	   = strtoupper(utf8_decode($rowsolicitante[3]));
	$domicilio1	       = str_replace("?","'",$domicilio0);
	$domicilio2	   	   = str_replace("*","&",$domicilio1);
	$domicilio 		   = strtoupper($domicilio2);
	
	$ecivil            = utf8_decode($rowsolicitante[4]);
	
	//$emision = $fecha->fun_fech_comple2($emision2);


// datos en cadena
$eval_mostrar_persona = "";	

// CONTIENE AL TEXTO:  Y ACTUAR/N POR SU PROPIO DERECHO, SOLICITO/AN.
$eval_propioderecho = "";


// VARIOS SOLICITANTES: 
$dataSolicitantes = array();

for($i = 0; $i <= $numsolicitantes-1; $i++)
	{
		$rowsolic = mysql_fetch_array($consulsolicitantes);
		if($rowsolic[0] == '')
		{
			echo 'Error : Falta Ingresar: Solicitante(s).';
			exit();	
		}
		
		if($rowsolic[8] == '08')
		{
			$eval_nj = utf8_decode(" SEGÚN PODER INSCRITO EN EN LA PARTIDA ELECTRONICA N° ").strtoupper(utf8_decode($rowsolic[7]))." DEL REGISTRO DE PERSONAS JURIDICAS DE LIMA";
		} else if($rowsolic[8] == '01')
		{
			$eval_nj = utf8_decode(" SEGÚN PODER INSCRITO EN EN LA PARTIDA ELECTRONICA N° ").strtoupper(utf8_decode($rowsolic[7]))." DEL REGISTRO DE PERSONAS NATURALES DE LIMA";
		} else if($rowsolic[8] == '')
		{
			$eval_nj = "";
		}
		//  
		// EVALUA REPRESENTACION 
		if($rowsolic[6] == "")
		{
			$eval_representacion = "";	
			$eval_propioderecho = "QUIEN SOLICITA PARA EL VEHICULO PLACA/DUA " .$num_placa. ", LO SIGUIENTE:";
			$evalua_Empresa_repre = "";
			
			// EVALUA MULTIPLICIDAD FIRMAS POR DERECHO PROPIO :
		$firma_solicitantes = "----------------------------------------------".chr(13).chr(10).strtoupper(utf8_decode($rowsolic[0])).chr(13).chr(10).utf8_decode(" DNI N°: ").strtoupper($rowsolic[1]).chr(13).chr(10).chr(13).chr(10).chr(13).chr(10) ;
		
		}
		else if($rowsolic[6] != "")
		{
			
			$eval_propioderecho = "";
			$evalua_Empresa_repre = utf8_decode(" EN REPRESENTACIÓN DE ").strtoupper(utf8_decode($rowsolic[6]));
			
			// EVALUA MULTIPLICIDAD FIRMAS EN REPRESENTACION DE :
		$firma_solicitantes = "----------------------------------------------".chr(13).chr(10).strtoupper(utf8_decode($rowsolic[0])).utf8_decode(" EN REPRESENTACIÓN DE ").strtoupper(utf8_decode($rowsolic[6])).chr(13).chr(10).strtoupper($rowsolic[1]).utf8_decode(" N°: ").strtoupper($rowsolic[2]).chr(13).chr(10).chr(13).chr(10).chr(13).chr(10) ;
		
			
			$eval_representacion = utf8_decode(" QUIEN ACTUA EN REPRESENTACIÓN DE ").strtoupper(utf8_decode($rowsolic[6])).$eval_nj;
		}
		
		
		// EVALUA MULTIPLICIDAD SOLICITANTES
		$dataSolicitantes[] = array('nom_solicitante' => "".strtoupper(utf8_decode($rowsolic[0]))." IDENTIFICADO CON ".utf8_decode(" DNI N° ").strtoupper(utf8_decode($rowsolic[1])).strtoupper(utf8_decode(" DE NACIONALIDAD PERUANA, CON DOMICILIO EN ")).strtoupper(utf8_decode($rowsolic[2])).", ".strtoupper(utf8_decode($rowsolic[4]))." MANIFIESTA SER DE ESTADO CIVIL ".$rowsolic[3]. " ".$eval_representacion, 'nom_firma'=>$firma_solicitantes  );
	
		// EVALUA MULTIPLICIDAD SOLICITANTES EN CADENA:
		$eval_mostrar_personax = " ".strtoupper($rowsolic[0]) .UTF8_DECODE(" IDENTIFICADO CON DNI N° ").strtoupper(utf8_decode($rowsolic[1])).$eval_nj;
		
	$eval_mostrar_persona_Guarda .= $eval_mostrar_personax;
	
	$eval_mostrar_persona = $eval_mostrar_persona_Guarda.$evalua_Empresa_repre;
	}
	
	// CAPTURA LOS SOLICITANTES EN CADENA:
	


//VARIAS CARACTERISTICAS:
$dataCaracter = array();

for($i = 0; $i <= $numcaracter-1; $i++)
	{
		$rowdetalle  = mysql_fetch_array($consuldetalle);
		
		if($rowdetalle[0] == '')
		{
			echo 'Error 01: Falta Ingresar: Caracteristicas';
			exit();	
		}
		
		$dataCaracter[] = array('cambios_vehicular' => strtoupper(utf8_decode($rowdetalle[0]))." : ".strtoupper(utf8_decode($rowdetalle[1])));
	}

	//echo var_dump($dataCaracter)."</br>";
	//echo $numcaracter;
	//exit();


//Carga la plantilla;
	//die($template);
	$TBS->LoadTemplate($template);

	
	$TBS->MergeBlock('a', $dataCaracter);
	$TBS->MergeBlock('b,c', $dataSolicitantes);

//Si existen comentios en la plantilla los oculta.
	$TBS->PlugIn(OPENTBS_DELETE_COMMENTS);

//Nombre para el archivo a descargar.
	//$file_name = 

    $file_name      = $path_exit.'CCambio'.$numcrono2.$extension;
	$file_name_show = 'CCambio'.$numcrono2.$extension;
	
	//$file_name = str_replace('.','_'.$suffix.'.',$file_name);
	
    $TBS->Show(TBSZIP_FILE, $file_name);
	
	//$TBS->Show(OPENTBS_DOWNLOAD, $file_name);
#}
	echo "Se genero el archivo: ".$file_name_show." satisfactoriamente..!!";
//$TBS->Show(OPENTBS_DOWNLOAD, $file_name);
?>
