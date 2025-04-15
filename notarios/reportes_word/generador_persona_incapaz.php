<?php

// Carga las librerias:
include('../conexion.php');
include_once('../includes/tbs_class.php');
include_once('../includes/tbs_plugin_opentbs.php');
include_once('../includes/ClaseLetras.class.php');
include_once('../extraprotocolares/Config/Configuracion.php');
include_once('fecha_letra.php');
## notario :
$busnumcarta = "SELECT CONCAT(confinotario.nombre, ' ', confinotario.apellido ) AS 'NOTARIO' , confinotario.direccion, confinotario.distrito FROM confinotario"; 
$numcartabus = mysql_query($busnumcarta,$conn) or die(mysql_error());
$rownum = mysql_fetch_array($numcartabus);
$muesnotario = strtoupper(utf8_decode($rownum[0]));
$direccion   =  strtoupper(utf8_decode($rownum[1]));
$distrito_notario   =  strtoupper(utf8_decode($rownum[2]));
##

###########################################
##  SE DEFINE PATH PARA TEMPLATES Y SALIDAS
# 1 Se crea Objetos
$ruta_templates  = new AsignaPath;	
$ruta_archivos   = new AsignaPath;
# 2. Templates
$path_template   = $ruta_templates->__set_path_template();
# 3. Salida de Data
$path_exit       = $ruta_archivos->__set_path_exit('certificado_persona');

$extension       = $ruta_archivos->__set_tip_output_ep();
###########################################


//se crea el objeto  ClaseLetras
	$fecha = new ClaseNumeroLetra();

	$dia  = $fecha->fun_fecha_dia(); 
	$mes  = $fecha->fun_fecha_mes();
	$anio = $fecha->fun_fecha_anio();
	
	$num_cronos        = $_REQUEST["num_crono"]; 
	
	$fechitainterior = "SELECT cert_supervivencia.fecha, SUBSTR(num_crono, -6) AS idcapaz FROM cert_supervivencia where cert_supervivencia.num_crono='".$num_cronos."' AND SWT_CAPACIDAD ='I'";
	$resulfecha = mysql_query($fechitainterior,$conn) or die(mysql_error());
	$rowviaint = mysql_fetch_array($resulfecha);
	$fechaconv	      = explode('-',$rowviaint[0]);
	$fechaingresovieint  = $fechaconv[2]."/".$fechaconv[1]."/".$fechaconv[0];
	$fecha_letras_viaext = strtoupper(fechaALetras($fechaingresovieint));
	
	
	$fecha_letras_viaext2 = $fecha->fun_fech_completo2_anio($rowviaint[0]);
	$fec_letras_completa= strtoupper(utf8_decode($fecha_letras_viaext2));
	
	
	
	$fec_letras = $fecha->fun_fech_comple(date("Y/m/d"));

	
	$capaz = (int)$rowviaint[1];
	
//Se crea el objeto TBS
	$TBS = new clsTinyButStrong; 			
// Se cargan las propiedades del PLUGIN
	$TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN);

	$suffix = '';
	$debug  = '';

// Se verifica que formato de plantilla se usara.
	$template = $path_template."plantilla_persona_incapaz".$extension;

	#$template = basename($template);
	$x        = pathinfo($template);
	$template_ext  = $x['extension'];
	$template_name = $x['basename'];
	if (!file_exists($template)) exit("Ruta o nombre de la plantilla definido Incorrectamente.");

	$num_crono        = $_REQUEST["num_crono"];        //Num. Cronologico a exportar.
	$numcrono2        = substr($num_crono,5,6).'-'.substr($num_crono,0,4);	//Para Mostrar num_crono.
	$usuario_imprime  = $_REQUEST["usuario_imprime"];  //Nombre del usuario que imprime.
	$nombre_notario   = $muesnotario;      //Nombre del notario.
	$direc_notario	  = $direccion; 		//Direccion del notario.
	$fecha_impresion  = date("d/m/Y");                 //Fecha de impresion.

	//echo $num_crono;exit();

	if($num_crono=='')
	{
		echo "Error al generar"; exit();	
	}

//Consulta segun parametro enviado:
$consulcertificado = mysql_query('SELECT UPPER(cert_supervivencia.nombre) AS "NOMBRE_PERSONA", UPPER(tipodocumento.destipdoc) AS "TIP_DOC", UPPER(cert_supervivencia.numdocu) AS "NUM_DOC", UPPER(nacionalidades.descripcion) AS "NACIONALIDAD", IF(ISNULL(tipoestacivil.desestcivil),"<NO INGRESADO>", UPPER(tipoestacivil.desestcivil)) AS "EST_CIVIL", UPPER(cert_supervivencia.direccion) AS "DOMICILIO",
UPPER(ubigeo.nomdis) AS "NOM_DIST" , UPPER(cert_supervivencia.observaciones) AS "OBSERVACIONES", UPPER(CONCAT(cliente.prinom," ",cliente.segnom,", ",cliente.apepat," ",cliente.apemat)) AS "NOM_REP", UPPER(docu_rep.destipdoc) AS "TIP_DOC_REP", UPPER(cert_supervivencia.numdocu_rep) AS "NUM_DOC_REP", UPPER(cert_supervivencia.nombre_rep) AS "TIP_REP",
IF(ubigeo.coddis="070101","DISTRITO DE CALLAO , PROVINCIA CONSTITUCIONAL DEL CALLAO",CONCAT("DISTRITO DE ",ubigeo.nomdis, ", PROVINCIA DE ", ubigeo.nomprov,", DEPARTAMENTO DE ",ubigeo.nomdpto )) AS "UBIGEO",
cert_supervivencia.pelectronica
FROM cert_supervivencia    
INNER JOIN tipodocumento ON cert_supervivencia.tipdocu = tipodocumento.codtipdoc
INNER JOIN tipodocumento docu_rep ON cert_supervivencia.tipdocu_rep = docu_rep.codtipdoc
INNER JOIN nacionalidades ON nacionalidades.idnacionalidad = cert_supervivencia.nacionalidad
INNER JOIN cliente ON cliente.numdoc = cert_supervivencia.numdocu
LEFT OUTER JOIN tipoestacivil ON tipoestacivil.idestcivil = cert_supervivencia.ecivil
LEFT OUTER JOIN ubigeo ON ubigeo.coddis = cert_supervivencia.ubigeo
WHERE num_crono = "'.$num_crono.'" AND SWT_CAPACIDAD ="I"', $conn) or die(mysql_error());
	$registro = mysql_fetch_array($consulcertificado);
	
// CONSULTA TESTIGO:
$consultestigo = mysql_query('SELECT UPPER(cert_supervivencia.nom_testigo) AS "NOMBRE_TESTIGO", UPPER(cert_supervivencia.ndocu_testigo) AS "NUMDOCU_TESTIGO", UPPER(tipodocumento.destipdoc) AS "TIP_DOC",
cert_supervivencia.especificacion
FROM cert_supervivencia    
INNER JOIN tipodocumento ON cert_supervivencia.tdoc_testigo = tipodocumento.codtipdoc
WHERE num_crono = "'.$num_crono.'" AND SWT_CAPACIDAD ="I"', $conn) or die(mysql_error());
	$rowtestigo = mysql_fetch_array($consultestigo);	



//Definicion de las variables para llenar la plantilla dinamicamente
	$nombre_persona0   = strtoupper(utf8_decode($registro[0]));
	$nombre_persona1	    	=str_replace("?","'",$nombre_persona0);
	$nombre_persona2	   		=str_replace("*","&",$nombre_persona1);
	$nombre_persona	  		=strtoupper($nombre_persona2);
	
	$tip_doc1          = $registro[1];
	if($tip_doc1==""){
	
		$tip_doc = "<NO INGRESADO>";
		}
		else if($tip_doc1!=''){
				$tip_doc = $tip_doc1;
			
			}
	$num_doc1            = $registro[2];
	if($num_doc1==""){
	
		$num_doc = "<NO INGRESADO>";
		}
		else if($num_doc1!=''){
				$num_doc = $num_doc1;
			
			}
	$est_civil1        = $registro[4];
		if($est_civil1==""){
	
		$est_civil = "<NO INGRESADO>";
		}
		else if($est_civil1!=''){
				$est_civil = $est_civil1;
			
			}
	$nacionalidad1       = $registro[3];
	
	if($nacionalidad1==""){
	
		$nacionalidad = "<NO INGRESADO>";
		}
		else if($nacionalidad1!=''){
				$nacionalidad = $nacionalidad1;
			
			}
	
	$domicilio0         = strtoupper(utf8_decode($registro[5]));
	$domicilio1	    	= str_replace("?","'",$domicilio0);
	$domicilio2	   		= str_replace("*","&",$domicilio1);
	$domicilio 			= strtoupper($domicilio2);
	
	$observaciones      = strtoupper(utf8_decode($registro[7]));
	
	$nom_rep0           = strtoupper(utf8_decode($registro[8]));
	$nom_rep1	    	= str_replace("?","'",$nom_rep0);
	$nom_rep2	   		= str_replace("*","&",$nom_rep1);
	$nom_rep 			= strtoupper($nom_rep2);
	
	$tip_doc_rep1      = $registro[9];
	if($tip_doc_rep1==""){
	
		$tip_doc_rep = "<NO INGRESADO>";
		}
		else if($tip_doc_rep1!=''){
				$tip_doc_rep = $tip_doc_rep1;
			
			}
	$num_doc_rep1      = $registro[10];
	if($num_doc_rep1==""){
	
		$num_doc_rep = "<NO INGRESADO>";
		}
		else if($num_doc_rep1!=''){
				$num_doc_rep = $num_doc_rep1;
			
			}
	$tip_rep	      = strtoupper(utf8_decode($registro[11]));
	$ubigeo	          = strtoupper(utf8_decode($registro[12]));
	
	//NUEVO REQUERIMIENTO PARTIDA DATO NO OBLIGATORIO.
	
	$pelectronicas	 = strtoupper(utf8_decode($registro[13]));
	 $texto = "SEGÚN INSCRIPCIÓN QUE OBRA EN LA PARTIDA ELECTRÓNICA N° ";
	 if($pelectronicas!='')
	 {
	 $pelectronica  = utf8_decode($texto).$pelectronicas." DEL REGISTRO DE PERSONAS NATURALES DE LA OFICINA REGISTRAL DE LIMA, ";
	 }else 
	 {
	 $pelectronica  = '';
		}

// DATOS TESTIGO :
	$nombre_testigo0   = strtoupper(utf8_decode($rowtestigo[0]));
	$nombre_testigo1	    	=str_replace("?","'",$nombre_testigo0);
	$nombre_testigo2	   		=str_replace("*","&",$nombre_testigo1);
	$nombre_testigo 			=strtoupper($nombre_testigo2);
	
	
	$tipdoc_testigo   = $rowtestigo[2];
	$numdoc_testigo   = $rowtestigo[1];
	$especificacion1  = strtoupper($rowtestigo[3]);
	
	
	
	switch ($especificacion1) {
    case "IL":
        $especificacion = "POR SER ILETRADO(A)";
        break;
    case "IN":
        $especificacion = "POR TENER INCAPACIDAD FISICA";
        break;
    case "AR":
        $especificacion = "A RUEGO DE";
        break;
    }
	

	if($nombre_testigo!='')
				{
					$datos_testigo = "ASIMISMO INTERVIENE ".$nombre_testigo.utf8_decode(", CON DNI N° ").$numdoc_testigo.utf8_decode(" EN CALIDAD DE TESTIGO , ".$especificacion." ").$nombre_persona.chr(13).chr(10)." , POR ENCONTRARSE ESTE ULTIMO IMPOSIBILITADO DE FIRMAR, EL CUAL COLOCA SU HUELLA DACTILAR COMO PRUEBA DE SUPERVIVENCIA";
				}
	else{$datos_testigo = "" ;}			


	if($nombre_testigo=='')
			{
				# ARMA FIRMA TESTIGO
				$evalua_firma     = "-----------------------------------".chr(13).chr(10).$nom_rep.chr(13).chr(10).utf8_decode("DNI N°: ").$num_doc_rep.chr(13).chr(10).chr(13).chr(10).chr(13).chr(10)."-----------------------------------".chr(13).chr(10).$nombre_persona.chr(13).chr(10).utf8_decode(" DNI N°: ").$num_doc.chr(13).chr(10).chr(13).chr(10).chr(13).chr(10);
			}
				else if($nombre_testigo!='')
				{
					$evalua_firma = "-----------------------------------".chr(13).chr(10).$nom_rep.chr(13).chr(10).utf8_decode("DNI N°: ").$num_doc_rep.chr(13).chr(10).chr(13).chr(10).chr(13).chr(10)."-----------------------------------".chr(13).chr(10).$nombre_testigo.chr(13).chr(10).utf8_decode(" DNI N°: ").$numdoc_testigo.chr(13).chr(10).chr(13).chr(10).chr(13).chr(10)/*"HUELLA DACTILAR".chr(13).chr(10)*/;	
				}


//Carga la plantilla;
	$TBS->LoadTemplate($template);

//Si existen comentios en la plantilla los oculta.
	$TBS->PlugIn(OPENTBS_DELETE_COMMENTS);

//Nombre para el archivo a descargar.
	//$file_name = 

    $file_name      = $path_exit.'CIncapaz'.$numcrono2.$extension;
	$file_name_show = 'CIncapaz'.$numcrono2.$extension;
	
	//$file_name = str_replace('.','_'.$suffix.'.',$file_name);
	
    $TBS->Show(TBSZIP_FILE, $file_name);
	
	//$TBS->Show(OPENTBS_DOWNLOAD, $file_name);
#}
	echo "Se genero el archivo: ".$file_name_show." satisfactoriamente..!!";
//$TBS->Show(OPENTBS_DOWNLOAD, $file_name);
?>
