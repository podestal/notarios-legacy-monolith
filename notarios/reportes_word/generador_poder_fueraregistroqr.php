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

## notario :
$busnumcarta = "SELECT CONCAT(confinotario.nombre, ' ', confinotario.apellido ) AS 'NOTARIO' , confinotario.direccion, confinotario.distrito FROM confinotario";
$numcartabus = mysql_query($busnumcarta,$conn) or die(mysql_error());
$rownum = mysql_fetch_array($numcartabus);
$muesnotario   = strtoupper(utf8_decode($rownum[0]));
$direccion     = strtoupper(utf8_decode($rownum[1]));
$dist_notario  = strtoupper(utf8_decode($rownum[2]));
##

###########################################
##  SE DEFINE PATH PARA TEMPLATES Y SALIDAS
# 1 Se crea Objetos
$ruta_templates  = new AsignaPath;	
$ruta_archivos   = new AsignaPath;
# 2. Templates
$path_template   = $ruta_templates->__set_path_template();
# 3. Salida de Data
$path_exit       = $ruta_archivos->__set_path_exit('poderes');

$extension       = $ruta_archivos->__set_tip_output_ep();
###########################################

//se crea el objeto  ClaseLetras
	$fecha = new ClaseNumeroLetra();

	$dia  = $fecha->fun_fecha_dia(); 
	$mes  = $fecha->fun_fecha_mes();
	$anio = $fecha->fun_fecha_anio();
	
	$id_poderr        = $_REQUEST["id_poder"]; 

	$fechitainterior = "SELECT ingreso_poderes.fec_ingreso FROM ingreso_poderes where ingreso_poderes.id_poder='".$id_poderr."'";
	$resulfecha = mysql_query($fechitainterior,$conn) or die(mysql_error());
	$rowviaint = mysql_fetch_array($resulfecha);
	$fechaconv	      = explode('-',$rowviaint[0]);
	$fechaingresovieint  = $fechaconv[2]."/".$fechaconv[1]."/".$fechaconv[0];
	$fecha_letras_viaext = strtoupper(fechaALetras($fechaingresovieint));
	
	$fec_letras = $fecha->fun_fech_comple(date("Y/m/d"));
	
	$fecha_letras_viaext2 = $fecha->fun_fech_completo2_anio($rowviaint[0]);
	
	$fec_letras_completa= strtoupper(utf8_decode($fecha_letras_viaext2));


	$suffix = '';
	$debug  = '';

// Se verifica que formato de plantilla se usara.
	$template = $path_template."plantilla_poder_fueraregistro".$extension;

	#$template = basename($template);
	$x = pathinfo($template);
	$template_ext  = $x['extension'];
	$template_name = $x['basename'];
	if (!file_exists($template)) exit("Ruta o nombre de la plantilla definido Incorrectamente.");

	$id_poder         = $_REQUEST["id_poder"]; 
	
	       //Num. poder a exportar.
	//$numcrono2        = substr($num_crono,5,6).'-'.substr($num_crono,0,4);	//Para Mostrar num_crono.

	$usuario_imprime  = $_REQUEST["usuario_imprime"];  //Nombre del usuario que imprime.
	$nombre_notario   = $muesnotario;       //Nombre del notario.
	$direc_notario	  = $direccion; 		//Direccion del notario.
	$fecha_impresion  = date("d/m/Y");                 //Fecha de impresion.
	$dataContratantes = array();
// #= Consultas 

#########################
##### NUEVO PODERDANTE JURIDICO 02/25/2014 ########
$consulpoderdante = mysql_query('SELECT  UPPER(cliente.razonsocial) AS "RAZON SOCIAL",  UPPER(tipodocumento.td_abrev) AS "TIP_DOC",UPPER(cliente.numdoc) AS "NUM_DOC",UPPER(cliente.domfiscal) AS "DIRECCION",
IF(ubigeo.coddis="070101","DISTRITO DE CALLAO , PROVINCIA CONSTITUCIONAL DEL CALLAO",CONCAT("DISTRITO DE ",ubigeo.nomdis, ", PROVINCIA DE ", ubigeo.nomprov,", DEPARTAMENTO DE ",ubigeo.nomdpto ))  AS "ubigeo",
cliente.numpartida as "PARTIDA",
cliente.sexo
FROM poderes_contratantes 
INNER JOIN cliente ON cliente.numdoc = poderes_contratantes.c_codcontrat
INNER JOIN tipodocumento ON tipodocumento.idtipdoc = cliente.idtipdoc
LEFT OUTER JOIN ubigeo ON ubigeo.coddis = cliente.idubigeo
WHERE poderes_contratantes.c_condicontrat = "007" AND poderes_contratantes.id_poder = "'.$id_poder.'"', $conn) or die(mysql_error());
$conteoj = mysql_num_rows($consulpoderdante);
	
	
	$sqlfast=mysql_query('SELECT CONCAT(cliente.prinom," ",cliente.segnom," ",cliente.apepat," ",cliente.apemat)  AS "NOMBRE_APODERADO"
FROM poderes_contratantes 
INNER JOIN cliente ON cliente.numdoc = poderes_contratantes.c_codcontrat
WHERE poderes_contratantes.c_condicontrat = "007" AND poderes_contratantes.id_poder = "'.$id_poder.'"',$conn);
	
	
	#########################
##### NUEVO PODERDANTE NATURAL 02/25/2014 ########
	
$consulpoderdanten = mysql_query('SELECT  UPPER(CONCAT(cliente.prinom," ",cliente.segnom," ",cliente.apepat," ",cliente.apemat))AS "NOMBRE_APODERADO", UPPER(tipodocumento.td_abrev) AS "TIP_DOC", UPPER(cliente.numdoc) AS "NUM_DOC", UPPER(tipoestacivil.desestcivil) AS "EST_CIVIL", UPPER(nacionalidades.descripcion) AS "NACIONALIDAD", UPPER(cliente.direccion) AS "DIRECCION", 
poderes_contratantes.codi_asegurado AS "CODI_ASEGURADO", poderes_contratantes.c_fircontrat AS "firma",
IF(ubigeo.coddis="070101","DISTRITO DE CALLAO , PROVINCIA CONSTITUCIONAL DEL CALLAO",CONCAT("DISTRITO DE ",ubigeo.nomdis, ", PROVINCIA DE ", ubigeo.nomprov,", DEPARTAMENTO DE ",ubigeo.nomdpto ))  AS "ubigeo",
cliente.sexo
FROM poderes_contratantes 
INNER JOIN cliente ON cliente.numdoc = poderes_contratantes.c_codcontrat
INNER JOIN tipodocumento ON tipodocumento.idtipdoc = cliente.idtipdoc
INNER JOIN tipoestacivil ON tipoestacivil.idestcivil = cliente.idestcivil
INNER JOIN nacionalidades ON nacionalidades.idnacionalidad = cliente.nacionalidad
LEFT OUTER JOIN ubigeo ON ubigeo.coddis = cliente.idubigeo
WHERE poderes_contratantes.c_condicontrat = "007" AND poderes_contratantes.id_poder = "'.$id_poder.'"', $conn) or die(mysql_error());
$conteon = mysql_num_rows($consulpoderdanten);

$consulpoderdanten2 = mysql_query('SELECT  UPPER(cliente.nombre) AS "NOMBRE_APODERADO", UPPER(tipodocumento.td_abrev) AS "TIP_DOC", UPPER(cliente.numdoc) AS "NUM_DOC", UPPER(tipoestacivil.desestcivil) AS "EST_CIVIL", UPPER(nacionalidades.descripcion) AS "NACIONALIDAD", UPPER(cliente.direccion) AS "DIRECCION", 
poderes_contratantes.codi_asegurado AS "CODI_ASEGURADO", poderes_contratantes.c_fircontrat AS "firma",
IF(ubigeo.coddis="070101","DISTRITO DE CALLAO , PROVINCIA CONSTITUCIONAL DEL CALLAO",CONCAT("DISTRITO DE ",ubigeo.nomdis, ", PROVINCIA DE ", ubigeo.nomprov,", DEPARTAMENTO DE ",ubigeo.nomdpto ))  AS "ubigeo",
cliente.sexo
FROM poderes_contratantes 
INNER JOIN cliente ON cliente.numdoc = poderes_contratantes.c_codcontrat
INNER JOIN tipodocumento ON tipodocumento.idtipdoc = cliente.idtipdoc
INNER JOIN tipoestacivil ON tipoestacivil.idestcivil = cliente.idestcivil
INNER JOIN nacionalidades ON nacionalidades.idnacionalidad = cliente.nacionalidad
LEFT OUTER JOIN ubigeo ON ubigeo.coddis = cliente.idubigeo
WHERE poderes_contratantes.c_condicontrat = "007" AND poderes_contratantes.id_poder = "'.$id_poder.'"', $conn) or die(mysql_error());

$rowpoderdante22 = mysql_fetch_row($consulpoderdanten2);
	

#########################
##### NUEVO REPRESENTANTE 02/25/2014 #####
$consulrepresentante = mysql_query('SELECT  UPPER(CONCAT(cliente.prinom," ",cliente.segnom," ",cliente.apepat," ",cliente.apemat))AS "NOMBRE_APODERADO", UPPER(tipodocumento.td_abrev) AS "TIP_DOC", UPPER(cliente.numdoc) AS "NUM_DOC", UPPER(tipoestacivil.desestcivil) AS "EST_CIVIL", UPPER(nacionalidades.descripcion) AS "NACIONALIDAD", UPPER(cliente.direccion) AS "DIRECCION", 
poderes_contratantes.codi_asegurado AS "CODI_ASEGURADO", poderes_contratantes.c_fircontrat AS "firma",
IF(ubigeo.coddis="070101","DISTRITO DE CALLAO , PROVINCIA CONSTITUCIONAL DEL CALLAO",CONCAT("DISTRITO DE ",ubigeo.nomdis, ", PROVINCIA DE ", ubigeo.nomprov,", DEPARTAMENTO DE ",ubigeo.nomdpto ))  AS "ubigeo",
cliente.sexo
FROM poderes_contratantes 
INNER JOIN cliente ON cliente.numdoc = poderes_contratantes.c_codcontrat
INNER JOIN tipodocumento ON tipodocumento.idtipdoc = cliente.idtipdoc
INNER JOIN tipoestacivil ON tipoestacivil.idestcivil = cliente.idestcivil
INNER JOIN nacionalidades ON nacionalidades.idnacionalidad = cliente.nacionalidad
LEFT OUTER JOIN ubigeo ON ubigeo.coddis = cliente.idubigeo
WHERE poderes_contratantes.c_condicontrat != "011" AND poderes_contratantes.id_poder = "'.$id_poder.'"', $conn) or die(mysql_error());
	$rowpoderdante = mysql_fetch_row($consulrepresentante);
	
	
	
	
#########################	
## Apoderado 
$consulrepresenta = mysql_query('SELECT UPPER(CONCAT(cliente.prinom," ",cliente.segnom," ",cliente.apepat," ",cliente.apemat)) AS "NOMBRE_APODERADO", UPPER(tipodocumento.td_abrev) AS "TIP_DOC", UPPER(cliente.numdoc) AS "NUM_DOC", UPPER(tipoestacivil.desestcivil) AS "EST_CIVIL", 
UPPER(nacionalidades.descripcion) AS "NACIONALIDAD", UPPER(cliente.direccion) AS "DIRECCION" ,
IF(ubigeo.coddis="070101","DISTRITO DE CALLAO , PROVINCIA CONSTITUCIONAL DEL CALLAO",CONCAT("DISTRITO DE ",ubigeo.nomdis, ", PROVINCIA DE ", ubigeo.nomprov,", DEPARTAMENTO DE ",ubigeo.nomdpto ))   AS "ubigeo",
cliente.sexo
FROM poderes_contratantes 
INNER JOIN cliente ON cliente.numdoc = poderes_contratantes.c_codcontrat
INNER JOIN tipodocumento ON tipodocumento.idtipdoc = cliente.idtipdoc
INNER JOIN tipoestacivil ON tipoestacivil.idestcivil = cliente.idestcivil
INNER JOIN nacionalidades ON nacionalidades.idnacionalidad = cliente.nacionalidad
LEFT OUTER JOIN ubigeo ON ubigeo.coddis = cliente.idubigeo
WHERE poderes_contratantes.c_condicontrat = "006" AND poderes_contratantes.id_poder = "'.$id_poder.'" ', $conn) or die(mysql_error());
		


	
#########################	
## TESTIGO A RUEGO
$consultestigo = mysql_query('SELECT UPPER(CONCAT(cliente.prinom," ",cliente.segnom," ",cliente.apepat," ",cliente.apemat))AS "NOMBRE_TESTIGO", UPPER(tipodocumento.td_abrev) AS "TIP_DOC", UPPER(cliente.numdoc) AS "NUM_DOC", UPPER(tipoestacivil.desestcivil) AS "EST_CIVIL", 
UPPER(nacionalidades.descripcion) AS "NACIONALIDAD", UPPER(cliente.direccion) AS "DIRECCION" , UPPER(CONCAT(atestiguados.prinom," ",atestiguados.segnom,", ",atestiguados.apepat," ",atestiguados.apemat))AS "ATESTIGUADO", d_tablas.des_item AS "INCAPACIDAD",
UPPER(documents_atesti.td_abrev) AS "TIP_DOC_ATES",  UPPER(atestiguados.numdoc) AS "NUM_DOC_ATES", d_tablas.val_item AS "DES_INCAPACIDAD", poderes_contratantes.c_fircontrat AS "firma"
FROM poderes_contratantes 
INNER JOIN cliente ON cliente.numdoc = poderes_contratantes.c_codcontrat
INNER JOIN tipodocumento ON tipodocumento.idtipdoc = cliente.idtipdoc
INNER JOIN tipoestacivil ON tipoestacivil.idestcivil = cliente.idestcivil
INNER JOIN nacionalidades ON nacionalidades.idnacionalidad = cliente.nacionalidad
INNER JOIN cliente atestiguados ON atestiguados.numdoc = poderes_contratantes.codi_testigo
INNER JOIN tipodocumento documents_atesti ON documents_atesti.idtipdoc = atestiguados.idtipdoc
INNER JOIN d_tablas ON d_tablas.num_item = poderes_contratantes.tip_incapacidad AND d_tablas.tip_item = "poder"
WHERE poderes_contratantes.c_condicontrat = "008" AND poderes_contratantes.id_poder = "'.$id_poder.'" GROUP BY cliente.idcliente', $conn) or die(mysql_error());
	//$rowtestigo = mysql_fetch_array($consultestigo);	
	$numtestigos =  mysql_num_rows($consultestigo);	


########################################	
###### DATOS PODER FUERA REGISTRO ######
$consuldatospoder = mysql_query('SELECT STR_TO_DATE(poderes_fuerareg.f_fecotor,"%d/%m/%Y") AS "FEC_OTORGAMIENTO", poderes_fuerareg.f_fecvcto AS "FEC_VCTO",
poderes_fuerareg.f_plazopoder AS "PLAZO", poderes_fuerareg.f_solicita AS "SOLICITA", poderes_fuerareg.f_observ AS "OBSERVACION", DATE_FORMAT(STR_TO_DATE(poderes_fuerareg.f_fecotor,"%d/%m/%Y"),"%d/%m/%Y") AS "VIGENCIA_INICIO"
FROM poderes_fuerareg WHERE poderes_fuerareg.id_poder = "'.$id_poder.'"', $conn) or die(mysql_error());
	$rowdatospoder = mysql_fetch_array($consuldatospoder);

##########################
## Verifica num kardex  ##
$consulnumkardex = mysql_query('SELECT ingreso_poderes.num_kardex FROM ingreso_poderes WHERE ingreso_poderes.id_poder = "'.$id_poder.'" ', $conn) or die(mysql_error());
	$rownum_kar = mysql_fetch_array($consulnumkardex);	
	
if($rownum_kar[0] == '')
{
	echo 'Error 01: Falta Generar Nro. Cronologico.';	
	exit();		
}
else if($rownum_kar[0] != '')
{
	$numcrono2  = substr($rownum_kar[0],5,6).'-'.substr($rownum_kar[0],0,4);	//Para Mostrar num_crono.
}
	
## EVALUA PARTICIPANTES.
$numrepresentante  =  mysql_num_rows($consulrepresentante);
# 1.
$numpoderdante  =  mysql_num_rows($consulpoderdante);

# 2.
$numrepresenta  =  mysql_num_rows($consulrepresenta);
/*
if($numpoderdante == 0 || $numrepresenta == 0)
{
	echo '<!DOCTYPE HTML><html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		  <title>Impresion</title>
       	  </head>
		  <body><center>
		  Falta Ingresar: Participantes.</br>'; 
	echo '<a href="#" onclick="javascript:self.close();">Cerrar ventana</a>';
	echo '</center></body></html>';
	exit();
}
*/
$dataCabecera = array();
while($rowfast = mysql_fetch_row($sqlfast))
	{
		
		$dataCabecera[] = array('poderdantesarriba' => str_replace("*","&",str_replace("?","'",strtoupper(utf8_decode($rowfast[0])))));
		
		
	}

$dataPoderdantes = array();
	
	$data2="";
	$data1="";

if($rowpoderdante1[1]== "R.U.C.")
{
	
	
	while($rowpoderdante1 = mysql_fetch_row($consulpoderdante))
	{
//Definicion de las vaiables del nuevo poderdante juridico
	$razon_social0 			= strtoupper(utf8_decode($rowpoderdante1[0]));
	$razon_social1	    	= str_replace("?","'",$razon_social0);
	$razon_social2	   		= str_replace("*","&",$razon_social1);
	$razon_social	  		= strtoupper($razon_social2);
	
	$tipdoc 				= strtoupper($rowpoderdante1[1]);
	$numdoc        			= strtoupper($rowpoderdante1[2]);
	$direccion		        = strtoupper($rowpoderdante1[3]);
	$sexo		            = strtoupper($rowpoderdante1[6]);
	$ubigeopoderd           = strtoupper(utf8_decode($rowpoderdante1[4]));
	$numpartida				= $rowpoderdante1[5];
	
	if($sexo=="F"){

## ARMA VARIABLE PODERDANTE :
	$datos_poderdante1 =  $razon_social.", IDENTIFICADA CON ".strtoupper($tipdoc).utf8_decode(" N. ").strtoupper(utf8_decode($numdoc))." ,SEGUN PODER INSCRITO EN LA PARTIDA ELECTRONICA N° ".$numpartida." DEL REGISTRO DE PERSONAS JURIDICAS DE LIMA , CON DOMICILIO FISCAL EN ".$direccion." ".$ubigeopoderd;
	/*
	$dataPoderdantes[] = array('data_poderdantesx'=> $razon_social.", IDENTIFICADA CON ".strtoupper($tipdoc).utf8_decode(" N. ").strtoupper(utf8_decode($numdoc))." ,SEGUN PODER INSCRITO EN LA PARTIDA ELECTRONICA N° ".$numpartida." DEL REGISTRO DE PERSONAS JURIDICAS DE LIMA , CON DOMICILIO FISCAL EN ".$direccion." ".$ubigeopoderd);
	*/
	
	}else if($sexo=="M"){
	$datos_poderdante1 =  $razon_social.", IDENTIFICADO CON ".strtoupper($tipdoc).utf8_decode(" N. ").strtoupper(utf8_decode($numdoc))." ,SEGUN PODER INSCRITO EN LA PARTIDA ELECTRONICA N° ".$numpartida." DEL REGISTRO DE PERSONAS JURIDICAS DE LIMA , CON DOMICILIO FISCAL EN ".$direccion." ".$ubigeopoderd;
	/*
	$dataPoderdantes[] = array('data_poderdantesx'=>  $razon_social.", IDENTIFICADO CON ".strtoupper($tipdoc).utf8_decode(" N. ").strtoupper(utf8_decode($numdoc))." ,SEGUN PODER INSCRITO EN LA PARTIDA ELECTRONICA N° ".$numpartida." DEL REGISTRO DE PERSONAS JURIDICAS DE LIMA , CON DOMICILIO FISCAL EN ".$direccion." ".$ubigeopoderd);
	*/
	}
	
	}
	$data2.=$datos_poderdante1 ;
}
else 
{
	
	
		
		while ($rowpoderdante2 = mysql_fetch_row($consulpoderdanten)){
		
//Definicion de las variables del nuevo poderdante naural
	$nombre_poderdante0		= strtoupper(utf8_decode($rowpoderdante2[0]));
	$nombre_poderdante1	    = str_replace("?","'",$nombre_poderdante0);
	$nombre_poderdante2	   	= str_replace("*","&",$nombre_poderdante1);
	$nombre_poderdante	  	= strtoupper($nombre_poderdante2);
	
	$tipdocpod				= strtoupper($rowpoderdante2[1]);
	$numdocpod        		= strtoupper($rowpoderdante2[2]);
	$estcivilpod	        = strtoupper($rowpoderdante2[3]);
	$nacionpod	            = strtoupper($rowpoderdante2[4]);
	$sexo	          		= strtoupper($rowpoderdante2[9]);
	$direccionopod          = strtoupper(utf8_decode($rowpoderdante2[5]));
    $ubigeopod				= strtoupper(utf8_decode($rowpoderdante2[8]));
	
	## ARMA VARIABLE PODERDANTE :

	
		if($sexo=="F"){

## ARMA VARIABLE PODERDANTE :
	$datos_poderdante1 = $nombre_poderdante.", IDENTIFICADA CON ".utf8_decode("DNI N° ").strtoupper(utf8_decode($numdocpod)).", DE NACIONALIDAD ".strtoupper($nacionpod).", QUIEN MANIFIESTA SER DE ESTADO CIVIL ".$estcivilpod." CON DOMICILIO EN: ".$direccionopod." ".$ubigeopod;
	/*
	$dataPoderdantes[] = array('data_poderdantesx'=>$nombre_poderdante.",IDENTIFICADA CON ".strtoupper($tipdocpod).utf8_decode(" NUMERO ").strtoupper(utf8_decode($numdocpod)).", QUIEN MANIFIESTA SER DE ESTADO CIVIL ".$estcivilpod." DE NACIONALIDAD ".strtoupper($nacionpod)." CON DOMICILIO REAL EN ".$direccionopod." ".$ubigeopod);
	*/
	
	}else if($sexo=="M"){
	$datos_poderdante1 = $nombre_poderdante.",IDENTIFICADO CON ".utf8_decode("DNI N° ").strtoupper(utf8_decode($numdocpod)).", DE NACIONALIDAD ".strtoupper($nacionpod).", QUIEN MANIFIESTA SER DE ESTADO CIVIL ".$estcivilpod." CON DOMICILIO EN: ".$direccionopod." ".$ubigeopod;
	/*
	$dataPoderdantes[] = array('data_poderdantesx'=> $nombre_poderdante.",IDENTIFICADO CON ".strtoupper($tipdocpod).utf8_decode(" NUMERO ").strtoupper(utf8_decode($numdocpod)).", QUIEN MANIFIESTA SER DE ESTADO CIVIL ".$estcivilpod." DE NACIONALIDAD ".strtoupper($nacionpod)." CON DOMICILIO REAL EN ".$direccionopod." ".$ubigeopod);
	*/
	
	}
	$data1 .=$datos_poderdante1 ;
	
	}
	
	
	
	
	
}
	
//Definicion de las variables para llenar la plantilla dinamicamente
	#PODERDANTE
if($numrepresentante!=0){
	
	for($i = 0; $i <= $numrepresentante; $i++)
	{
		
	$poderdante0  	 = strtoupper(utf8_decode($rowpoderdante[0]));
	$poderdante1	    	=str_replace("?","'",$poderdante0);
	$poderdante2	   		=str_replace("*","&",$poderdante1);
	$poderdante	  		=strtoupper($poderdante2);
	
	
	$tip_doc        = strtoupper($rowpoderdante[1]);
	$num_doc        = strtoupper($rowpoderdante[2]);
	$est_civil      = strtoupper($rowpoderdante[3]);
	$nacionalidad   = strtoupper($rowpoderdante[4]);
	$sexo01   		= strtoupper($rowpoderdante[9]);
	$domicilio0     = strtoupper(utf8_decode($rowpoderdante[5]));
	$domicilio1	    	=str_replace("?","'",$domicilio0);
	$domicilio2	   		=str_replace("*","&",$domicilio1);
	$domicilio	  		=strtoupper($domicilio2);
	$prueba  = strtoupper(utf8_decode($rowpoderdante[0]));
	$ubigeo_poderdante      = strtoupper(utf8_decode($rowpoderdante[8]));
	##
	$seguro         = " ";
	
	
	
		if($sexo01=="F"){

## ARMA VARIABLE PODERDANTE :
	## ARMA VARIABLE PODERDANTE :
	$datos_poderdante = $poderdante.", IDENTIFICADA CON ".strtoupper($tip_doc).utf8_decode(" N° ").strtoupper(utf8_decode($num_doc))." QUIEN MANIFIESTA SER DE ESTADO CIVIL ".strtoupper($est_civil)." DE NACIONALIDAD ".strtoupper($nacionalidad)." CON DOMICILIO EN: ".$domicilio." ".$ubigeo_poderdante.", EN REPRESENTACION DE :";
	}else if($sexo01=="M"){
	## ARMA VARIABLE PODERDANTE :
	$datos_poderdante = $poderdante.", IDENTIFICADO CON ".strtoupper($tip_doc).utf8_decode(" N° ").strtoupper(utf8_decode($num_doc))." QUIEN MANIFIESTA SER DE ESTADO CIVIL ".strtoupper($est_civil)." DE NACIONALIDAD ".strtoupper($nacionalidad)." CON DOMICILIO EN: ".$domicilio." ".$ubigeo_poderdante.", EN REPRESENTACION DE :";
	}
	
	}
}else{$datos_poderdante="";}


for($i = 0; $i <= $numrepresentante; $i++)
	{
		
	while($rowrepresenta = mysql_fetch_array($consulrepresenta)){
	
	#APODERADO - REPRESENTA
	$apoderado0        = strtoupper(utf8_decode($rowrepresenta[0]));
	$apoderado1	    	=str_replace("?","'",$apoderado0);
	$apoderado2	   		=str_replace("*","&",$apoderado1);
	$apoderado	  		=strtoupper($apoderado2);
	
	$tdoc_apoderado   = strtoupper($rowrepresenta[1]);
	$doc_apoderado    = strtoupper($rowrepresenta[2]);
	$sexo01 		   = strtoupper($rowrepresenta[7]);
	$domi_apoderado0   = strtoupper(utf8_decode($rowrepresenta[5]));
	$domi_apoderado1	    	=str_replace("?","'",$domi_apoderado0);
	$domi_apoderado2	   		=str_replace("*","&",$domi_apoderado1);
	$domi_apoderado	  		=strtoupper($domi_apoderado2);
	
	$ubigeo_apoderado      = strtoupper(utf8_decode($rowrepresenta[6]));
	
	
	
			if($sexo01=="F"){

	$dataContratantes[] = array('datos_apoderado' => str_replace("*","&",str_replace("?","'",strtoupper(utf8_decode($rowrepresenta[0])))).", IDENTIFICADA CON ".str_replace("*","&",str_replace("?","'",strtoupper(utf8_decode($rowrepresenta[1])))).utf8_decode(" N° ").str_replace("*","&",str_replace("?","'",strtoupper(utf8_decode($rowrepresenta[2])))).", CON DOMICILIO EN: ".str_replace("*","&",str_replace("?","'",strtoupper(utf8_decode($rowrepresenta[5])))).str_replace("*","&",str_replace("?","'",strtoupper(utf8_decode($rowrepresenta[6])))) );
	}else if($sexo01=="M"){
	## ARMA VARIABLE PODERDANTE :
	$dataContratantes[] = array('datos_apoderado' => str_replace("*","&",str_replace("?","'",strtoupper(utf8_decode($rowrepresenta[0])))).", IDENTIFICADO CON ".str_replace("*","&",str_replace("?","'",strtoupper(utf8_decode($rowrepresenta[1])))).utf8_decode(" N° ").str_replace("*","&",str_replace("?","'",strtoupper(utf8_decode($rowrepresenta[2])))).", CON DOMICILIO EN: ".str_replace("*","&",str_replace("?","'",strtoupper(utf8_decode($rowrepresenta[5])))).str_replace("*","&",str_replace("?","'",strtoupper(utf8_decode($rowrepresenta[6])))) );
	}
	
	
	
	}
	
	# FIRMA DEL APODERADO :
	if($rowpoderdante[7]=="SI")
		{	
			# ARMA FIRMA PODERDANTE
				$firma_poderdante = "---------------------------------------------".chr(13).chr(10).strtoupper(utf8_decode($razon_social)).chr(13).chr(10).strtoupper(utf8_decode($poderdante)).chr(13).chr(10).utf8_decode("DNI N°: ").strtoupper($rowpoderdante[2]).chr(13).chr(10).chr(13).chr(10).chr(13).chr(10);
		
		}
	else
	{
		$firma_poderdante = "" ;	
	}	

/*
if($rowpoderdante22[7]=="SI")
		{	
			# ARMA FIRMA PODERDANTE
				$firma_poderdante1 = "------------------------------------------".chr(13).chr(10).$nombre_poderdante.chr(13).chr(10).utf8_decode("DNI N°: ").strtoupper($rowpoderdante22[2]).chr(13).chr(10).chr(13).chr(10).chr(13).chr(10);
		
		}
	else
	{
		$firma_poderdante1 = "" ;	
	}	
*/
	}
	
	#TESTIGOS:
	$dataTestigos = array();
	$firmasTestigos = array();
	
	for($i = 0; $i <= $numtestigos; $i++)
	{
		while($rowtestigo = mysql_fetch_array($consultestigo)){
		
		
		$nombre_test0        	= $rowtestigo[0];
		$nombre_test1	    	=str_replace("?","'",$nombre_test0);
	    $nombre_test2	   		=str_replace("*","&",$nombre_test1);
	    $nombre_test	  		=strtoupper($nombre_test2);
	
		$dataTestigos[] = array('datos_testigo' =>"INTERVIENE ". strtoupper(utf8_decode($nombre_test))." IDENTIFICAD(A) CON ".utf8_decode(" DNI N° ").strtoupper(utf8_decode($rowtestigo[2]))." EN CALIDAD DE TESTIGO A RUEGO DE ".strtoupper(utf8_decode($rowtestigo[6]))." POR ENCONTRARSE ".strtoupper(utf8_decode($rowtestigo[10])) );
		
		if($rowtestigo[11]=='SI')
			{
				# ARMA FIRMA TESTIGO
				$firmasTestigos[] = array('firma_testigo'=> "---------------------------------------------".chr(13).chr(10).strtoupper(utf8_decode($nombre_test)).chr(13).chr(10).utf8_decode("TESTIGO A RUEGO").chr(13).chr(10).chr(13).chr(10).chr(13).chr(10));
			}
		}
	}	
	//echo var_dump($dataTestigos)."</br>";
	//echo $numtestigos;
	//exit();
/*
		   [nom_testigo]			     [tipdoc_testigo][numdoc_testigo]							 [nom_atestiguado]					     [des_imposibilitado]
INTERVIENE [LUIS VELASQUEZ HERRERA] IDENTIFICADO CON [DNI] Nº[09999999] EN CALIDAD DE TESTIGO A RUEGO DE [CARLOS LLONTOP VILLAR] POR ENCONTRARSE [IMPOSIBILITADO FISICAMENTE DE FIRMAR]
*/	
	
	#DATOS PODER
	$emision2         = strtoupper(utf8_decode($rowdatospoder[0]));
	$vigencia_inicio  = strtoupper($rowdatospoder[5]);
	$vigencia_fin     = strtoupper($rowdatospoder[1]);
	$nombre_marca     = "";
	$solicita         = strtoupper(utf8_decode($rowdatospoder[3]));
	
	$plazo_poder         = strtoupper(utf8_decode($rowdatospoder[2]));
	
	$emision = utf8_decode($fecha->fun_fech_comple2($emision2));



/////////////////////////////////////////////////////////////7
//qr
$sqlpoder = mysql_query('SELECT I.id_poder ,
I.num_kardex ,
IF(DATE_FORMAT(I.fec_ingreso,"%d-%m-%Y")="00-00-0000","",DATE_FORMAT(I.fec_ingreso,"%d/%m/%Y")) AS fec_ingreso,
IF(DATE_FORMAT(I.fec_crono,"%d-%m-%Y")="00-00-0000","",DATE_FORMAT(I.fec_crono,"%d/%m/%Y")) AS fecha_crono,
I.id_asunto,
I.swt_est AS estado,
I.num_formu,
P.f_plazopoder AS poderplazo,
P.f_fecotor AS fechaemision,
P.f_fecvcto AS fechavencimiento
FROM ingreso_poderes I
INNER JOIN poderes_fuerareg P ON P.id_poder =  I.id_poder  WHERE I.id_poder ="'.$id_poder.'"', $conn) or die(mysql_error());

$arr_viaje[]=array();
$poder = mysql_fetch_array($sqlpoder);
	$arr_viaje[0] = $poder["id_poder"]; 
	$arr_viaje[1] = $poder["num_kardex"]; 
	$arr_viaje[2] = $poder["fec_ingreso"]; 
	$arr_viaje[3] = $poder["fecha_crono"]; 
	$arr_viaje[4] = $poder["id_asunto"]; 
	$arr_viaje[5] = $poder["estado"]; 
	$arr_viaje[6] = $poder["num_formu"]; 
	$arr_viaje[7] = $poder["poderplazo"]; 
	$arr_viaje[8] = $poder["fechaemision"]; 
	$arr_viaje[9] = $poder["fechavencimiento"]; 
	
	//JSON
         $objPermisoViaje = new stdClass();
		 $objPermisoViaje->codigotipoinstrumento = 108;
		 $objPermisoViaje->codigoinstrumento = 285; 
		 $objPermisoViaje->codigonotaria ="10024231572";
		 $objPermisoViaje->fecharegistro =$arr_viaje[2];
		 $objPermisoViaje->fechainstrumento =  $arr_viaje[3]; 
		 $objPermisoViaje->numerocontrol =  $arr_viaje[0];
		 $objPermisoViaje->numeroformulario =$arr_viaje[6];
		 $objPermisoViaje->cronologico = $arr_viaje[1];
		 $objPermisoViaje->observacion = "";
		 $objPermisoViaje->fechaemision =  $arr_viaje[8];
		 $objPermisoViaje->fechavencimiento = $arr_viaje[9];
		 $objPermisoViaje->poderplazo = $arr_viaje[7];
		 $objPermisoViaje->concepto = "";
		 $objPermisoViaje->monto = "";
		 $objPermisoViaje->codigoasegurado = "";
		 $objPermisoViaje->prestacionautorizada = "";
		 $objPermisoViaje->codigoprestamista = "";
	    $objPermisoViaje->solicita = "";
		

		 
		
		 $consultapar = mysql_query('SELECT (CASE
		 WHEN P.c_condicontrat = 008 THEN "18" 
		 WHEN P.c_condicontrat = 009 THEN "16" 
		 WHEN P.c_condicontrat = 011 THEN "06" 
		 WHEN P.c_condicontrat = 006 THEN "07"
		 WHEN P.c_condicontrat = 007 THEN "17" 
	 	END) AS campo,P.c_fircontrat,P.c_codcontrat,C.apepat,C.`apemat`, C.`prinom` , C.`idtipdoc`,C.`direccion`,SUBSTRING(C.`docpaisemi`, 1, 3) segundo,C.`email` 
			  ,C.`telcel` , C.`cumpclie`, U.nomdis, U.nomprov,U.nomdpto FROM poderes_contratantes P
				 INNER JOIN cliente C ON C.`numdoc`= P.c_codcontrat 
				 INNER JOIN ubigeo U ON U.coddis = C.`idubigeo` WHERE  P.id_poder ="'.$id_poder.'"', $conn) or die(mysql_error());
			$objParticipante = new stdClass();

			$datos = array();
		while($row3 = mysql_fetch_array($consultapar)){
		
			$objParticipante->condicion = $row3[0];
			$objParticipante->tipodocumento = '0'.$row3[6];
			$objParticipante->documento = $row3[2];
			$objParticipante->nombres = $row3[5];
			$objParticipante->apellidopaterno = $row3[3];
			$objParticipante->apellidomaterno = $row3[4];
			$objParticipante->direccion = $row3[7];
			$objParticipante->correo = $row3[9];
			$objParticipante->telefono = $row3[10];
			$objParticipante->nacionalidad = $row3[8];
			$objParticipante->departamento =  $row3[14];
			$objParticipante->provincia =  $row3[13];
			$objParticipante->distrito =  $row3[12];
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
		$data = array("poderes" => $objPermisoViaje);
		$versiones = array(
			"poderes" => $objPermisoViaje
		);
		$myJSON = json_encode($versiones);

		$dataJson = json_encode(array("json" => $myJSON));
		

		

		define('WS_ENVIAR_DOCUMENTO','http://200.60.145.200/serviceqr/public/api/poderes');
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
				$erroresnew = $erroresnew.'\n'.$arr_resp[$i];
			}
			echo "Error'.$erroresnew.' ";
			die();

		}else {

			$dir = 'tempo1/';
			//Si no existe la carpeta la creamos
			if (!file_exists($dir))
				mkdir($dir);
				//Declaramos la ruta y nombre del archivo a generar
			$filename = $dir.'fuera'.$arr_viaje[0] .'.png';
			$img='fuera'.$arr_viaje[0] .'.png';
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

    $file_name      = $path_exit.'Poder'.$id_poder.$extension;
	$file_name_show = 'Poder'.$id_poder.$extension;
	
	//$file_name = str_replace('.','_'.$suffix.'.',$file_name);
	
    $TBS->Show(TBSZIP_FILE, $file_name);
	
	//$TBS->Show(OPENTBS_DOWNLOAD, $file_name);
#}
	echo "Se genero el archivo: ".$file_name_show." satisfactoriamente..!!";
//$TBS->Show(OPENTBS_DOWNLOAD, $file_name);
		}
?>
