<?php

// Carga las librerias:
include('../conexion.php');
include_once('../includes/tbs_class.php');
include_once('../includes/tbs_plugin_opentbs.php');
include_once('../includes/ClaseLetras.class.php');

########### notario : #############
$busnumcarta = "SELECT CONCAT(confinotario.nombre, ' ', confinotario.apellido ) AS 'NOTARIO' , confinotario.direccion, confinotario.distrito FROM confinotario";
$numcartabus = mysql_query($busnumcarta,$conn) or die(mysql_error());
$rownum = mysql_fetch_array($numcartabus);
$muesnotario = $rownum[0];
$direccion   =  strtoupper($rownum[1]);
$distrito    =  strtoupper($rownum[2]);
##########################

//se crea el objeto  ClaseLetras
	$fecha = new ClaseNumeroLetra();
	$fec_firma = new ClaseNumeroLetra();

	$dia  = $fecha->fun_fecha_dia(); 
	$mes  = $fecha->fun_fecha_mes();
	$anio = $fecha->fun_fecha_anio();
	$fec_letras = $fecha->fun_fech_comple_suc_intes(date("Y/m/d"));
	
//Se crea el objeto TBS
	$TBS = new clsTinyButStrong; 
// Se cargan las propiedades del PLUGIN
	$TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN);

// Se verifica que formato de plantilla se usara.
	$template = "plantilla_protocolar_sucesionintestada.odt";

	$template = basename($template);
	$x = pathinfo($template);
	$template_ext  = $x['extension'];
	$template_name = $x['basename'];
	if (!file_exists($template)) exit("Archivo no existe.");

	$num_kardex       = $_REQUEST["num_kardex"];        //Num. kardex a exportar.
	$usuario_imprime  = $_REQUEST["usuario_imprime"];   //Nombre del usuario que imprime.
	$nom_notario      = $muesnotario;                   //Nombre del notario.
	$direc_notario	  = $direccion; 		            //Direccion del notario.
	$distrito_notario = $distrito; 		                //Direccion del notario.
	$fecha_impresion  = date("d/m/Y");                  //Fecha de impresion.
	

//Consulta segun parametro enviado:

######################
## Cabecera Datos I ##
$consulcabecera1 = mysql_query('select kardex.numescritura as "escritura", kardex.kardex as "num_kardex" , kardex.folioini, kardex.foliofin, kardex.papelini, kardex.papelfin
from kardex where kardex.kardex =  "'.$num_kardex.'" ', $conn) or die(mysql_error());
	$rowcabecera1 = mysql_fetch_array($consulcabecera1);
#####################################

######################
####   CAUSANTE   ####
$consulcausante = mysql_query('SELECT cliente2.nombre FROM contratantesxacto INNER JOIN cliente2 ON cliente2.idcontratante = contratantesxacto.idcontratante WHERE contratantesxacto.kardex =  "'.$num_kardex.'" AND cliente2.tipper="N" and contratantesxacto.idcondicion="125" ', $conn) or die(mysql_error());
	$rowcausante =  mysql_fetch_array($consulcausante);
	#$numsolicitantes =  mysql_num_rows($consulcausante);	


//Definicion de las variables para llenar la plantilla dinamicamente
// # cabecera 
	$num_escritura    = $rowcabecera1[0];
	$num_kardex       = $rowcabecera1[1];
	$folioini         = $rowcabecera1[2];
	$foliofin         = $rowcabecera1[3];
	$papelini         = $rowcabecera1[4];
	$pepelfin         = $rowcabecera1[5];

// # Causante 
	$nom_causante     = $rowcausante[0];

############################################################


######################
##   SOLICITANTES   ##
$consulsolicitantes = mysql_query('SELECT cliente2.nombre FROM contratantesxacto INNER JOIN cliente2 ON cliente2.idcontratante = contratantesxacto.idcontratante WHERE contratantesxacto.kardex =  "'.$num_kardex.'" AND cliente2.tipper="N" and contratantesxacto.idcondicion != "125" ', $conn) or die(mysql_error());
	#$rowsolicitantes =  mysql_fetch_array($consulcausante);
	$numsolicitantes =  mysql_num_rows($consulsolicitantes);	

$Arraysolicitantes = array();
while($rowsolicitantes= mysql_fetch_array($consulsolicitantes))
{
  array_push($Arraysolicitantes, $rowsolicitantes[0]);	
}

for($i=0;$i<=$numsolicitantes-1;$i++)
	{
		$contents = $Arraysolicitantes[$i];
			if($contents=="")
				{
					$contents="";	
				}
		$nombre_solicitantes .= " ".$contents.", ";
	}
	#echo $nombre_solicitantes; exit();	
	
//Carga la plantilla;
	$TBS->LoadTemplate($template);
	
	// Creando el bloque para la impresion de contratanates:
	
	//$TBS->MergeBlock('a,b', $data);

	
	//$TBS->MergeBlock('i', $todos_insertos);
	
	# $TBS->MergeBlock('c', $dataContratantes);
	
	
//Si existen comentios en la plantilla los oculta.
	$TBS->PlugIn(OPENTBS_DELETE_COMMENTS);

//Nombre para el archivo a descargar.
	//$file_name = 

    $file_name = 'K'.$num_kardex.'.odt';
	
    //$TBS->Show(TBSZIP_FILE, $file_name);
	//$TBS->Show(OPENTBS_FILE+TBS_EXIT, $file_name);
	
	$TBS->Show(OPENTBS_DOWNLOAD, $file_name);
#}
	echo '<!DOCTYPE HTML><html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Impresion</title>
	</head>
		<body><center>
			Archivo Generado correctamente..!!</br>
			Nombre del archivo: '.$file_name.'</br>'; 
	echo '  Fecha de creación : '.date("d-m-Y").'</br>'; 
	echo '<a href="download.php?file='.$file_name.'" target="_blank">Descargar archivo</a>';
	echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="javascript:self.close();">Cerrar ventana</a>';
	echo'</center></body>
	</html>';

//$TBS->Show(OPENTBS_DOWNLOAD, $file_name);
?>
