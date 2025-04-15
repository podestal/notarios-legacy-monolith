<?php

// Carga las librerias:
include('../conexion.php');
include_once('../includes/tbs_class.php');
include_once('../includes/tbs_plugin_opentbs.php');
include_once('../includes/ClaseLetras.class.php');
include_once('../extraprotocolares/Config/Configuracion.php');

###########################################
##  SE DEFINE PATH PARA TEMPLATES Y SALIDAS
# 1 Se crea Objetos
$ruta_templates  = new AsignaPath;	
$ruta_archivos   = new AsignaPath;
# 2. Templates
$path_template   = $ruta_templates->__set_path_template();
# 3. Salida de Data
$path_exit       = $ruta_archivos->__set_path_exit('anexo5');

$extension       = $ruta_archivos->__set_tip_output_ep();
###########################################

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
	$template = $path_template."plantilla_anexo5".$extension;

	#$template = basename($template);
	$x = pathinfo($template);
	$template_ext  = $x['extension'];
	$template_name = $x['basename'];
	if (!file_exists($template)) exit("Ruta o nombre de la plantilla definido Incorrectamente.");


	$num_crono        = $_REQUEST["num_certificado"];        //Num. certificado a exportar.
	$numcrono2        = substr($num_crono,5,6).'-'.substr($num_crono,0,4);	//Para Mostrar num_crono.
	$usuario_imprime  = $_REQUEST["usuario_imprime"];  //Nombre del usuario que imprime.
	$nombre_notario   = $_REQUEST["nom_notario"];      //Nombre del notario.
	$fecha_impresion  = date("d/m/Y");                 //Fecha de impresion.


//Consulta segun parametro enviado:
$consulnatural = mysql_query('SELECT cliente2.nombre,tipodocumento.destipdoc,cliente2.numdoc,cliente2.natper,cliente2.cumpclie,
cliente2.docpaisemi,cliente2.direccion,cliente2.domfiscal,cliente2.telfijo,cliente2.telcel,cliente2.email,cliente2.detaprofesion,
cliente2.profocupa,tipoestacivil.desestcivil,cliente.nombre,contratantes.firma
FROM cliente2
INNER JOIN contratantes ON cliente2.idcontratante = contratantes.idcontratante
INNER JOIN tipodocumento ON cliente2.idtipdoc = tipodocumento.idtipdoc
INNER JOIN tipoestacivil ON cliente2.idestcivil = tipoestacivil.idestcivil
INNER JOIN cliente ON cliente2.conyuge = cliente.idcliente
WHERE contratantes.firma = "1" and contratantes.kardex = "'.$num_crono.'" ', $conn) or die(mysql_error());
	$registron = mysql_fetch_array($consulnatural);


//Definicion de las variables para llenar la plantilla dinamicamente
	$nombre_persona   = $registron[0];
	$tip_doc          = $registron[1];
	$num_doc          = $registron[2];
	$lugar			  = $registron[3];
	$fecha_nacimiento = $registron[4];
	$nacionalidad 	  = $registron[5];
	$domicilio        = $registron[6];
	$domicilio_fiscal = $registron[7];
	$telefono_fijo	  = $registron[8];
	$telefono_celular = $registron[9];
	$correo 		  = $registron[10];
	$profesion 	 	  = $registron[11];
	$ocupacion        = $registron[12];
	$estado_civil     = $registron[13];
	$nombre_conyuge   = $registron[14];
	
$consuljuridico = mysql_query('SELECT cliente2.razonsocial,cliente2.numdoc,ciiu.nombre,cliente2.direccion,cliente2.domfiscal,
cliente2.telfijo,cliente2.telcel,cliente2.telofi
FROM cliente2
INNER JOIN ciiu ON ciiu.coddivi = cliente2.actmunicipal
INNER JOIN contratantes ON contratantes.idcontratante = cliente2.idcontratante
WHERE contratantes.firma = "1" and contratantes.kardex = "'.$num_crono.'" ', $conn) or die(mysql_error());
	$registroj = mysql_fetch_array($consuljuridico);

	$razon_social  			= $registroj[0];
	$num_doc_j 				= $registroj[1];
	$actividad_economica 	= $registroj[2];
	$domicilioj  			= $registroj[3];
	$domicilio_fiscal_j  	= $registroj[4];
	$telefono_fijo_j		= $registroj[5];
	$telefono_cel_j  		= $registroj[6];
	$telefono_ofi_j  		= $registroj[7];	
	
	

//Carga la plantilla;
	$TBS->LoadTemplate($template);

//Si existen comentios en la plantilla los oculta.
	$TBS->PlugIn(OPENTBS_DELETE_COMMENTS);

//Nombre para el archivo a descargar.

    $file_name      = $path_exit.'Cert_Domiciliario'.$numcrono2.$extension;
	$file_name_show = 'Cert_Domiciliario'.$numcrono2.$extension;
    
	//$TBS->Show(TBSZIP_FILE, $file_name);
	
	$TBS->Show(OPENTBS_DOWNLOAD, $file_name);
#}
	echo '<!DOCTYPE HTML><html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Impresion</title>
	</head>
		<body><center>
			Archivo Generado correctamente..!!</br>
			Nombre del archivo: '.$file_name_show.'</br>'; 
	echo '  Fecha de creación : '.date("d-m-Y").'</br>'; 
	echo '<a href="download.php?file='.$file_name.'" target="_blank">Descargar archivo</a>';
	echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="javascript:self.close();">Cerrar ventana</a>';
	echo'</center></body>
	</html>';
//$TBS->Show(OPENTBS_DOWNLOAD, $file_name);
?>
