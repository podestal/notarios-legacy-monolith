<?php

// Carga las librerias:
include('../conexion.php');
include_once('../includes/tbs_class.php');
include_once('../includes/tbs_plugin_opentbs.php');
include_once('../includes/ClaseLetras.class.php');
include_once('../extraprotocolares/Config/Configuracion.php');
include_once('fecha_letra.php');


include("../phpqrcode/qrlib.php");


//Se crea el objeto TBS
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
$muesnotario        = strtoupper(utf8_decode($rownum[0]));
$direccion          =  strtoupper(utf8_decode($rownum[1]));
$TBS->VarRef['distrito_notario']   =  strtoupper(utf8_decode($rownum[2]));
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
	$TBS->VarRef['fecha_letras_viaext'] = utf8_decode(strtoupper(fechaALetras($fechaingresovieint)));
	
	
	$fec_letras = $fecha->fun_fech_comple(date("Y/m/d"));


	$suffix = '';
	$debug  = '';

// Se verifica que formato de plantilla se usara.
	$template = $path_template."plantilla_poder_essalud".$extension;

	#$template = basename($template);
	$x = pathinfo($template);
	$template_ext  = $x['extension'];
	$template_name = $x['basename'];
	if (!file_exists($template)) exit("Ruta o nombre de la plantilla definido Incorrectamente.");

	$id_poder         = $_REQUEST["id_poder"];        //Num. poder a exportar.
	//$numcrono2        = substr($num_crono,5,6).'-'.substr($num_crono,0,4);	//Para Mostrar num_crono.
	$usuario_imprime  = $_REQUEST["usuario_imprime"];  //Nombre del usuario que imprime.
	$nombre_notario   = $muesnotario;       //Nombre del notario.
	$direc_notario	  = $direccion; 		//Direccion del notario.
	$fecha_impresion  = date("d/m/Y");                 //Fecha de impresion.

// #= Consultas 

#########################
##### Poderdante ########
$consulpoderdante = mysql_query('SELECT  UPPER(cliente.nombre) AS "NOMBRE_APODERADO", UPPER(tipodocumento.destipdoc) AS "TIP_DOC", UPPER(cliente.numdoc) AS "NUM_DOC", UPPER(tipoestacivil.desestcivil) AS "EST_CIVIL", 
UPPER(nacionalidades.descripcion) AS "NACIONALIDAD", UPPER(cliente.direccion) AS "DIRECCION", poderes_contratantes.codi_asegurado AS "CODI_ASEGURADO", poderes_contratantes.c_fircontrat AS "firma",
IF(ubigeo.coddis="070101","DISTRITO DE CALLAO , PROVINCIA CONSTITUCIONAL DEL CALLAO",CONCAT("DISTRITO DE ",ubigeo.nomdis, ", PROVINCIA DE ", ubigeo.nomprov,", DEPARTAMENTO DE ",ubigeo.nomdpto )) AS "ubigeo",
IF(ISNULL(profesiones.desprofesion),"",profesiones.desprofesion) AS "PROFESION"
FROM poderes_contratantes 
INNER JOIN cliente ON cliente.numdoc = poderes_contratantes.c_codcontrat
INNER JOIN tipodocumento ON tipodocumento.idtipdoc = cliente.idtipdoc
INNER JOIN tipoestacivil ON tipoestacivil.idestcivil = cliente.idestcivil
INNER JOIN nacionalidades ON nacionalidades.idnacionalidad = cliente.nacionalidad
LEFT OUTER JOIN profesiones ON profesiones.idprofesion = cliente.idprofesion
LEFT OUTER JOIN ubigeo ON ubigeo.coddis = cliente.idubigeo
WHERE poderes_contratantes.c_condicontrat = "007" AND poderes_contratantes.id_poder = "'.$id_poder.'" ', $conn) or die(mysql_error());
	//$rowpoderdante = mysql_fetch_array($consulpoderdante);

	
#########################	
## Apoderado 
$consulrepresenta = mysql_query('SELECT  UPPER(cliente.nombre) AS "NOMBRE_APODERADO", UPPER(tipodocumento.destipdoc) AS "TIP_DOC", UPPER(cliente.numdoc) AS "NUM_DOC", UPPER(tipoestacivil.desestcivil) AS "EST_CIVIL", 
UPPER(nacionalidades.descripcion) AS "NACIONALIDAD", UPPER(cliente.direccion) AS "DIRECCION" ,
IF(ubigeo.coddis="070101","DISTRITO DE CALLAO , PROVINCIA CONSTITUCIONAL DEL CALLAO",CONCAT("DISTRITO DE ",ubigeo.nomdis, ", PROVINCIA DE ", ubigeo.nomprov,", DEPARTAMENTO DE ",ubigeo.nomdpto ))  AS "ubigeo"
FROM poderes_contratantes 
INNER JOIN cliente ON cliente.numdoc = poderes_contratantes.c_codcontrat
INNER JOIN tipodocumento ON tipodocumento.idtipdoc = cliente.idtipdoc
INNER JOIN tipoestacivil ON tipoestacivil.idestcivil = cliente.idestcivil
INNER JOIN nacionalidades ON nacionalidades.idnacionalidad = cliente.nacionalidad
LEFT OUTER JOIN ubigeo ON ubigeo.coddis = cliente.idubigeo
WHERE poderes_contratantes.c_condicontrat = "006" AND poderes_contratantes.id_poder = "'.$id_poder.'" ', $conn) or die(mysql_error());
	$rowrepresenta = mysql_fetch_array($consulrepresenta);	

#########################	
## TESTIGO A RUEGO
$consultestigo = mysql_query('SELECT  UPPER(cliente.nombre) AS "NOMBRE_TESTIGO", UPPER(tipodocumento.destipdoc) AS "TIP_DOC", UPPER(cliente.numdoc) AS "NUM_DOC", UPPER(tipoestacivil.desestcivil) AS "EST_CIVIL", 
UPPER(nacionalidades.descripcion) AS "NACIONALIDAD", UPPER(cliente.direccion) AS "DIRECCION" , atestiguados.nombre AS "ATESTIGUADO", d_tablas.des_item AS "INCAPACIDAD",
UPPER(documents_atesti.destipdoc) AS "TIP_DOC_ATES",  UPPER(atestiguados.numdoc) AS "NUM_DOC_ATES", d_tablas.val_item AS "DES_INCAPACIDAD", poderes_contratantes.c_fircontrat AS "firma"
FROM poderes_contratantes 
INNER JOIN cliente ON cliente.numdoc = poderes_contratantes.c_codcontrat
INNER JOIN tipodocumento ON tipodocumento.idtipdoc = cliente.idtipdoc
INNER JOIN tipoestacivil ON tipoestacivil.idestcivil = cliente.idestcivil
INNER JOIN nacionalidades ON nacionalidades.idnacionalidad = cliente.nacionalidad
INNER JOIN cliente atestiguados ON atestiguados.numdoc = poderes_contratantes.codi_testigo
INNER JOIN tipodocumento documents_atesti ON documents_atesti.idtipdoc = atestiguados.idtipdoc
INNER JOIN d_tablas ON d_tablas.num_item = poderes_contratantes.tip_incapacidad AND d_tablas.tip_item = "poder"
WHERE poderes_contratantes.c_condicontrat = "008" AND poderes_contratantes.id_poder = "'.$id_poder.'" ', $conn) or die(mysql_error());
	//$rowtestigo = mysql_fetch_array($consultestigo);	
	$numtestigos =  mysql_num_rows($consultestigo);	


#########################	
## Causante 
$consulcausante = mysql_query('SELECT  UPPER(cliente.nombre) AS "NOMBRE_CAUSANTE", UPPER(tipodocumento.destipdoc) AS "TIPDOC_CAUSANTE", UPPER(cliente.numdoc) AS "NUMDOC_CAUSANTE", 
UPPER(tipoestacivil.desestcivil) AS "EST_CIVIL", UPPER(nacionalidades.descripcion) AS "NACIONALIDAD", UPPER(cliente.direccion) AS "DIREC_CAUSANTE",
IF(ubigeo.coddis="070101","DISTRITO DE CALLAO , PROVINCIA CONSTITUCIONAL DEL CALLAO",CONCAT("DISTRITO DE ",ubigeo.nomdis, ", PROVINCIA DE ", ubigeo.nomprov,", DEPARTAMENTO DE ",ubigeo.nomdpto ))  AS "UBIGEO_CAUSANTE",
poderes_contratantes.codi_asegurado AS "CODI_ASEGURADO"
FROM poderes_contratantes 
INNER JOIN cliente ON cliente.numdoc = poderes_contratantes.c_codcontrat
INNER JOIN tipodocumento ON tipodocumento.idtipdoc = cliente.idtipdoc
INNER JOIN tipoestacivil ON tipoestacivil.idestcivil = cliente.idestcivil
INNER JOIN nacionalidades ON nacionalidades.idnacionalidad = cliente.nacionalidad
LEFT OUTER JOIN ubigeo ON cliente.idubigeo = ubigeo.coddis
WHERE poderes_contratantes.c_condicontrat = "009" AND poderes_contratantes.id_poder = "'.$id_poder.'" ', $conn) or die(mysql_error());
	$rowcausante = mysql_fetch_array($consulcausante);	

#########################	
###### DATOS PODER ######
$consuldatospoder = mysql_query('SELECT DATE_FORMAT(STR_TO_DATE(poderes_essalud.e_fecotor,"%d/%m/%Y"),"%Y/%m/%d") AS "FEC_OTORGAMIENTO", poderes_essalud.e_fecvcto AS "FEC_VCTO",
poderes_essalud.e_montosep AS "SEPELIO", poderes_essalud.e_montolact AS "LACTANCIA", poderes_essalud.e_montomater AS "MATERNIDAD", 
poderes_essalud.e_plazopoder AS "PLAZO" FROM poderes_essalud WHERE poderes_essalud.id_poder = "'.$id_poder.'" ', $conn) or die(mysql_error());
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
# 1.
$numpoderdante  =  mysql_num_rows($consulpoderdante);
# 2.
$numrepresenta  =  mysql_num_rows($consulrepresenta);
	# PODERDANTES : 
	$dataPoderdantes   = array();
	$firmasPoderdantes = array();
	
	for($i=0; $i <= $numpoderdante-1; $i++)
	{
		$rowpoderdante = mysql_fetch_array($consulpoderdante);
		
		
		// Reemplaza (DOCUMENTO NACIONAL DE IDENTIDAD) por (D.N.I.)
		/*
			if($rowpoderdante[1] = "DOCUMENTO NACIONAL DE IDENTIDAD (DNI)") {"";}else {strtoupper($rowpoderdante[1]);}
		*/
				$nombre_poderdante0 		= $rowpoderdante[0];
				$nombre_poderdante1	    	= str_replace("?","'",$nombre_poderdante0);
				$nombre_poderdante2	   		= str_replace("*","&",$nombre_poderdante1);
				$nombre_poderdante	  		= strtoupper($nombre_poderdante2);
			
				$direccion_poderdante0 		= $rowpoderdante[5];
				$direccion_poderdante1	    = str_replace("?","'",$direccion_poderdante0);
				$direccion_poderdante2	    = str_replace("*","&",$direccion_poderdante1);
				$direccion_poderdante	  	= strtoupper($direccion_poderdante2);
				
				$ocupacion_poderdante	  	= strtoupper($rowpoderdante[9]);
				
				/*
SILVA DE NORIEGA, HILDA ANTONIETA, QUIEN MANIFIESTA SER DE NACIONALIDAD PERUANA, DE ESTADO CIVIL CASADO, DE OCUPACION                  , DOMICILIAR EN CALLE LOS SAUCES 655B URB. VILLA MERCEDES DISTRITO DE CHORRILLOS, PROVINCIA Y DEPARTAMENTO DE LIMA, SE IDENTIFICA CON DOCUMENTO NACIONAL DE IDENTIDAD N° 47923124,  Y DECLARA QUE PROCEDE (POR DERECHO PROPIO) (EN REPRESENTACION DE : XXXX S.A.C, SEGÚN PODER INSCRITO EN LA PARTIDA ELECTRÓNICA NUMERO          DEL REGISTRO DE PERSONAS JURIDICAS DE LA OFICINA REGISTRAL DE LIMA.)
*/

				$dataPoderdantes[] = array('datos_poderdante'=> strtoupper(utf8_decode($nombre_poderdante)).", QUIEN MANIFIESTA SER DE NACIONALIDAD " .strtoupper($rowpoderdante[4]). " DE ESTADO CIVIL " .strtoupper($rowpoderdante[3]). utf8_decode(", DE OCUPACIÓN ") .strtoupper($ocupacion_poderdante). ", DOMICILIAR EN " .strtoupper(utf8_decode($direccion_poderdante))." ".strtoupper(utf8_decode($rowpoderdante[8])). ", SE IDENTIFICA CON ".strtoupper($rowpoderdante[1]).utf8_decode(" NUMERO ").strtoupper(utf8_decode($rowpoderdante[2])).", Y DECLARA QUE PROCEDE POR DERECHO PROPIO." )	;
				
				## FIRMAS DE LOS PODERDANTES : 
			/*
					..................................		
					PODERDANTE									HUELLA PODERDANTE
					[onshow.poderdante]	
					[onshow.tip_doc] [onshow.num_doc].
			*/
		if($rowpoderdante[7]=="SI")
		{	
			# ARMA FIRMA PODERDANTE
				$firmasPoderdantes[] = array('firma_poderdante'=> "------------------------------------------".chr(13).chr(10).strtoupper(utf8_decode($nombre_poderdante)).chr(13).chr(10).strtoupper($rowpoderdante[1]).utf8_decode(" N°: ").strtoupper($rowpoderdante[2]).chr(13).chr(10).chr(13).chr(10).chr(13).chr(10));
		
		}
				
	}

	#APODERADO
	$apoderado0 		= strtoupper(utf8_decode($rowrepresenta[0]));
	$apoderado1	    	=str_replace("?","'",$apoderado0);
	$apoderado2	   		=str_replace("*","&",$apoderado1);
	$apoderado	  		=strtoupper($apoderado2);
	
	$tdoc_apoderado     = strtoupper($rowrepresenta[1]);
	$doc_apoderado      = strtoupper($rowrepresenta[2]);
	
	$domi_apoderado0    = strtoupper(utf8_decode($rowrepresenta[5]));
	$domi_apoderado1	=str_replace("?","'",$domi_apoderado0);
	$domi_apoderado2	=str_replace("*","&",$domi_apoderado1);
	$domi_apoderado	  	=strtoupper($domi_apoderado2);
	
	$ubigeo_apoderado      = strtoupper(utf8_decode($rowrepresenta[6]));
	
## CAUSANTE:
/*
DE QUIEN EN VIDA FUE: [onshow.NOMBRE_CAUSANTE] IDENTIFICADO CON [onshow.TIPDOC_CAUSANTE] N. [onshow.NUMDOC_CAUSANTE]. DOMICILIADO EN [onshow.DIREC_CAUSANTE] DEPARTAMENTO DE [onshow.DEPARTAMENTO_CAU] PROVINCIA DE, [onshow.PROVINCIA_CAU], DISTRITO DE [onshow.DISTRITO_CAU]
*/	
	$NOMBRE_CAUSANTE0    	 = strtoupper(utf8_decode($rowcausante[0]));
	$NOMBRE_CAUSANTE1	     =str_replace("?","'",$NOMBRE_CAUSANTE0);
	$NOMBRE_CAUSANTE2	   	 =str_replace("*","&",$NOMBRE_CAUSANTE1);
	$NOMBRE_CAUSANTE	  	 =strtoupper($NOMBRE_CAUSANTE2);
	
	
	$TIPDOC_CAUSANTE    	 = strtoupper($rowcausante[1]);
	$NUMDOC_CAUSANTE     	 = strtoupper($rowcausante[2]);
	
	$DIREC_CAUSANTE0      	 = strtoupper(utf8_decode($rowcausante[5]));
	$DIREC_CAUSANTE1	     =str_replace("?","'",$DIREC_CAUSANTE0);
	$DIREC_CAUSANTE2	   	 =str_replace("*","&",$DIREC_CAUSANTE1);
	$DIREC_CAUSANTE	  		 =strtoupper($DIREC_CAUSANTE2);
	
	/*$DEPARTAMENTO_CAU    = strtoupper(utf8_decode($rowcausante[6]));
	$PROVINCIA_CAU       = strtoupper(utf8_decode($rowcausante[7]));
	$DISTRITO_CAU        = strtoupper(utf8_decode($rowcausante[8]));*/
	$UBIGEO_ASEGURADO       = strtoupper(utf8_decode($rowcausante[6]));
	$COD_ASEGURADO       = strtoupper(utf8_decode($rowcausante[7]));
	
	if(!empty($NOMBRE_CAUSANTE))
	{
		$desc_causante = "DE QUIEN EN VIDA FUE: ".$NOMBRE_CAUSANTE." IDENTIFICADO CON ".$TIPDOC_CAUSANTE." NUMERO ".$NUMDOC_CAUSANTE.". DOMICILIADO EN ".$DIREC_CAUSANTE." ".$UBIGEO_ASEGURADO." CON CODIGO DE ASEGURADO: ".$COD_ASEGURADO; 
	}
	else
	{
		$desc_causante = "";	
	}
	
	#TESTIGOS:
	$dataTestigos = array();
	$firmasTestigos = array();
	
	for($i = 0; $i <= $numtestigos-1; $i++)
	{
		$rowtestigo = mysql_fetch_array($consultestigo);
		
		
				$dataTestigos[] = array('datos_testigo' =>"INTERVIENE ". strtoupper($rowtestigo[0])." IDENTIFICADO CON ".strtoupper($rowtestigo[8])." NUMERO ".strtoupper($rowtestigo[2])." EN CALIDAD DE TESTIGO A RUEGO DE ".strtoupper($rowtestigo[6])." POR ENCONTRARSE ".strtoupper($rowtestigo[10]) );
			
			
			if($rowtestigo[11]=='SI')
			{
				# ARMA FIRMA TESTIGO
				$firmasTestigos[] = array('firma_testigo'=> "------------------------------------------".chr(13).chr(10).strtoupper(utf8_decode($nombre_poderdante)).chr(13).chr(10).strtoupper($rowpoderdante[1]).utf8_decode(" N°: ").strtoupper($rowpoderdante[2]).chr(13).chr(10).chr(13).chr(10).chr(13).chr(10)."------------------------------------------".chr(13).chr(10).strtoupper(utf8_decode($rowtestigo[0])).chr(13).chr(10).strtoupper($rowtestigo[8]).utf8_decode(" N°: ").strtoupper($rowtestigo[2]).chr(13).chr(10).chr(13).chr(10).chr(13).chr(10));
			}
		
	}	
	// echo var_dump($dataTestigos)."</br>";
	// echo $numtestigos;
	// exit();
/*
		   [nom_testigo]			     [tipdoc_testigo][numdoc_testigo]							 [nom_atestiguado]					     [des_imposibilitado]
INTERVIENE [LENY QUIROZ FLORES] IDENTIFICADA CON [DNI] Nº[09999999] EN CALIDAD DE TESTIGO A RUEGO DE [CARLOS LLONTOP VILLAR] POR ENCONTRARSE [IMPOSIBILITADO FISICAMENTE DE FIRMAR]
*/	
	
	#DATOS PODER
	$emision2         = $rowdatospoder[0];
	$vigencia_fin     = strtoupper($rowdatospoder[1]);
	
	$sepelio          = "";
	$maternidad       = "";
	$lactancia        = "";
	$plazo            = "";
	
	if($rowdatospoder[2]!='')
	{$sepelio          = $rowdatospoder[2];}
	
	if($rowdatospoder[4]!='')
	{$maternidad       = $rowdatospoder[4];}
	
	if($rowdatospoder[3]!='')
	{$lactancia       = $rowdatospoder[3];}
	
	if($rowdatospoder[5]!='')
	{$plazo       = strtoupper(utf8_decode($rowdatospoder[5]));}
	
	$emision = utf8_decode($fecha->fun_fech_comple2($emision2));
	#echo $emision;exit();

/////////////////////////////////////////////////////////////7
//qr
$sqlpoder = mysql_query('SELECT I.id_poder ,
I.num_kardex ,
IF(DATE_FORMAT(I.fec_ingreso,"%d-%m-%Y")="00-00-0000","",DATE_FORMAT(I.fec_ingreso,"%d/%m/%Y")) AS fec_ingreso,
IF(DATE_FORMAT(I.fec_crono,"%d-%m-%Y")="00-00-0000","",DATE_FORMAT(I.fec_crono,"%d/%m/%Y")) AS fecha_crono,
I.id_asunto,
I.swt_est AS estado,
I.num_formu,
P.e_monto AS monto,
P.e_plazopoder AS poderplazo,
P.e_fecotor AS fechaemision,
P.e_fecvcto AS fechavencimiento,
P.e_presauto AS codigoprestamista
FROM ingreso_poderes I
INNER JOIN poderes_essalud P ON P.id_poder =  I.id_poder  WHERE I.id_poder ="'.$id_poder.'"', $conn) or die(mysql_error());

$arr_viaje[]=array();
$poder = mysql_fetch_array($sqlpoder);
$arr_viaje[0] = $poder["id_poder"]; 
$arr_viaje[1] = $poder["num_kardex"]; 
$arr_viaje[2] = $poder["fec_ingreso"]; 
$arr_viaje[3] = $poder["fecha_crono"]; 
$arr_viaje[4] = $poder["id_asunto"]; 
$arr_viaje[5] = $poder["estado"]; 
$arr_viaje[6] = $poder["num_formu"]; 
$arr_viaje[7] = $poder["monto"]; 
$arr_viaje[8] = $poder["poderplazo"]; 
$arr_viaje[9] = $poder["fechaemision"]; 
$arr_viaje[10] = $poder["fechavencimiento"]; 
$arr_viaje[11] = $poder["codigoprestamista"]; 
	
	//JSON
	$objPermisoViaje = new stdClass();
	$objPermisoViaje->codigotipoinstrumento = 108;
	$objPermisoViaje->codigoinstrumento = 287; 
	$objPermisoViaje->codigonotaria ="10024231572";
	$objPermisoViaje->fecharegistro =$arr_viaje[2];
	$objPermisoViaje->fechainstrumento =  $arr_viaje[3]; 
	$objPermisoViaje->numerocontrol =  $arr_viaje[0];
	$objPermisoViaje->numeroformulario =$arr_viaje[6];
	$objPermisoViaje->cronologico = $arr_viaje[1];
	$objPermisoViaje->observacion = "";
	$objPermisoViaje->fechaemision =  $arr_viaje[9];
	$objPermisoViaje->fechavencimiento = $arr_viaje[10];
	$objPermisoViaje->poderplazo = $arr_viaje[8];
	$objPermisoViaje->concepto = "";
	$objPermisoViaje->monto = $arr_viaje[7];
	$objPermisoViaje->codigoasegurado = "";
	$objPermisoViaje->prestacionautorizada = "";
	$objPermisoViaje->codigoprestamista = $arr_viaje[11];
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
		
/*
		var_dump($myJSON);
		 die();
*/

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
			$filename = $dir.'SALUD'.$arr_viaje[0] .'.png';
			$img='SALUD'.$arr_viaje[0] .'.png';
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
	
	$TBS->MergeBlock('c', $dataPoderdantes);
	$TBS->MergeBlock('d', $firmasPoderdantes);
	$TBS->MergeBlock('e', $firmasTestigos);

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