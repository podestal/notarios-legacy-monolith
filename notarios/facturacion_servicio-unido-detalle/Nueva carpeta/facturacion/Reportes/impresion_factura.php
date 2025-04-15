<?php

// Carga las librerias:
include('../../conexion.php');
include_once('../../includes/tbs_class.php');
include_once('../../includes/tbs_plugin_opentbs.php');
include_once('../../includes/ClaseLetras.class.php');
include_once('../../extraprotocolares/Config/Configuracion.php');

###########################################
##  SE DEFINE PATH PARA TEMPLATES Y SALIDAS
$ruta_templates  = new AsignaPath;	
$ruta_archivos   = new AsignaPath;

$path_template   = $ruta_templates->__set_path_template();
$path_exit       = $ruta_archivos->__set_path_exit('facturas');
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
	$template = $path_template."plantilla_factura.odt";

	$x = pathinfo($template);
	$template_ext  = $x['extension'];
	$template_name = $x['basename'];
	if (!file_exists($template)) exit("Ruta o nombre de la plantilla definido Incorrectamente.");

	$id_regventas    = $_REQUEST["id_regventas"];        // Num. id reg_ventas a exportar.
	$fec_documen     = date("d/m/Y");                    // Fecha de impresion.
	

//CABECERA DEL DOCUMENTO
$consulcabecera = mysql_query('SELECT m_regventas.id_regventas AS "id", CONCAT(m_regventas.serie,"-",m_regventas.factura) AS "num_documen", IF(cliente.tipper="J", cliente.razonsocial, cliente.nombre) AS "nombre_cliente", 
IF(cliente.tipper="J", cliente.domfiscal, cliente.direccion) AS "direc_cliente", m_regventas.subtotal AS "subtotal", m_regventas.impuesto AS "monto_igv", m_regventas.imp_total AS "monto_total",
(CASE WHEN m_regventas.monedatipo = "01" THEN "NUEVOS SOLES" ELSE "DOLARES AMERICANOS" END) AS "moneda", m_regventas.monedatipo AS "idmon", tip_documen.des_docum AS "TIPO_DOCU"
FROM m_regventas
INNER JOIN cliente ON cliente.numdoc = m_regventas.num_docu
INNER JOIN tip_documen ON m_regventas.tipo_docu = tip_documen.id_documen
WHERE m_regventas.id_regventas = "'.$id_regventas.'" ', $conn) or die(mysql_error());
	$regcabec = mysql_fetch_array($consulcabecera);
	

//DETALLE DEL DOCUMENTO
$consuldetalle = mysql_query('SELECT d_regventas.id_regventas AS "id", d_regventas.codigo AS "cod_item", ROUND(d_regventas.cantidad) AS "cant_item", d_regventas.precio AS "prec_uni", 
ROUND((d_regventas.precio * d_regventas.cantidad),2) AS "total_item", d_regventas.detalle AS "des_item"
FROM d_regventas
WHERE d_regventas.id_regventas = "'.$id_regventas.'" ', $conn) or die(mysql_error());
	//$regdetalle = mysql_fetch_array($consuldetalle);	
	
	$numdetalles =  mysql_num_rows($consuldetalle);


//Definicion de las variables para llenar la plantilla dinamicamente
	
	$tipo_documento       = strtoupper($regcabec[9]);
	$val_igv 			  = 1 ;
	if($tipo_documento=='NOTA DE CREDITO' || $tipo_documento=='FACTURA')
	{
		$val_igv 		  = 0.82 ;	
	}
	
	
	$num_documen          = strtoupper($regcabec[1]);
	$nombre_cliente       = str_replace("*","&",str_replace("?","'",strtoupper(utf8_decode($regcabec[2]))));
	$direc_cliente        = str_replace("*","&",str_replace("?","'",strtoupper(utf8_decode($regcabec[3]))));
	$subtotal             = strtoupper($regcabec[4]);
	$eval_monto_igv       = strtoupper($regcabec[5]);
	$monto_igv            = strtoupper($regcabec[5]);
	$mues                 = "I.G.V."; // Muestra el texto I.G.V. en el documento generado
	if($eval_monto_igv == 0.00)
	{
		$monto_igv            = " ";
		$mues                 = " "; // Muestra el texto I.G.V. en el documento generado
	}
	
	$monto_total          = strtoupper($regcabec[6]);
	
	
	
	//$cant_item    = "";
	//$des_item	  = "";
	//$prec_uni	  = "";
	//$total_item	  = "";
	$monto_letras = "";


//VARIOS ITEMS:
$dataDocumento = array();

for($i = 0; $i <= $numdetalles-1; $i++)
	{
		$rowdetalle = mysql_fetch_array($consuldetalle);
	
		$dataDocumento[] = array('cant_item' => strtoupper($rowdetalle[2]) , 'des_item'=> strtoupper($rowdetalle[5]) , 'prec_uni'=> round(($val_igv*$rowdetalle[3]),2) , 'total_item'=>round(($val_igv*$rowdetalle[4]),2));
	}

	//echo var_dump($dataDocumento)."</br>";
	//echo $numdetalles;
	//exit();


//Carga la plantilla;
	$TBS->LoadTemplate($template);
	
	$TBS->MergeBlock('a', $dataDocumento);

//Si existen comentios en la plantilla los oculta.
	$TBS->PlugIn(OPENTBS_DELETE_COMMENTS);

    $file_name = $path_exit.'Doc_'.$id_regventas.'.odt';
	$file_name_show = 'Doc_'.$id_regventas.'.odt';

    //$TBS->Show(TBSZIP_FILE, $file_name);
	
	$TBS->Show(OPENTBS_DOWNLOAD, $file_name);
#}
	echo '<!DOCTYPE HTML><html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Impresion</title>
	</head>
		<body><center>
			DOCUMENTO GENERADO..!!</br>
			Nombre del archivo: '.$file_name_show.'</br>'; 
	echo '  Fecha de creación : '.date("d-m-Y").'</br></br>'; 
	echo '<a href="download.php?file='.$file_name.'">Abrir archivo</a>';
	#echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="javascript:self.close();">Cerrar ventana</a>';
	echo'</center></body>
	</html>';
//$TBS->Show(OPENTBS_DOWNLOAD, $file_name);
//$execute_file = exec('ping google.com.pe'); 
//$execute_file = system('whoami'); 

#echo $execute_file;

?>
