<?php

// Carga las librerias:
include('../conexion.php');
include_once('../includes/tbs_class.php');
include_once('../includes/tbs_plugin_opentbs.php');
include_once('../includes/ClaseLetras.class.php');

## notario :
$busnumcarta = "SELECT CONCAT(confinotario.nombre, ' ', confinotario.apellido ) AS 'NOTARIO' , confinotario.direccion, confinotario.distrito FROM confinotario";
$numcartabus = mysql_query($busnumcarta,$conn) or die(mysql_error());
$rownum = mysql_fetch_array($numcartabus);
$muesnotario        =  $rownum[0];
$direccion          =  strtoupper($rownum[1]);
$distrito_notario   =  strtoupper($rownum[2]);
##

//se crea el objeto  ClaseLetras
	$fecha     = new ClaseNumeroLetra();
	$fec_firma = new ClaseNumeroLetra();
		
	$precio = new ClaseNumeroLetra();

	$dia  = $fecha->fun_fecha_dia(); 
	$mes  = $fecha->fun_fecha_mes();
	$anio = $fecha->fun_fecha_anio();
	$fec_letras = $fecha->fun_fech_comple_suc_intes(date("Y/m/d"));

//Se crea el objeto TBS
	$TBS = new clsTinyButStrong; 
// Se cargan las propiedades del PLUGIN
	$TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN);

	$suffix = '';
	$debug  = '';

// Se verifica que formato de plantilla se usara.
	$template = "plantilla_protocolar_vehicular.odt";

	$template = basename($template);
	$x = pathinfo($template);
	$template_ext  = $x['extension'];
	$template_name = $x['basename'];
	if (!file_exists($template)) exit("Archivo no existe.");

	$num_kardex       = $_REQUEST["num_kardex"];        //Num. kardex a exportar.
	$idtipoacto       = $_REQUEST["idtipoacto"];        //Id del tipo de acto.
	
	//$numcrono2        = substr($num_crono,5,6).'-'.substr($num_crono,0,4);	//Para Mostrar num_crono.
	$usuario_imprime  = $_REQUEST["usuario_imprime"];   //Nombre del usuario que imprime.
	$nom_notario      = $muesnotario;       //Nombre del notario.
	$num_doc      	  = $_REQUEST["num_doc"];           //numero documento notario
	$reg_contrib      = $_REQUEST["reg_contrib"];       //registro unico de contribuyentes.
	$num_doc2      	  = $_REQUEST["num_doc2"];          //numero libreta militar
	$direc_notario	  = $direccion; 		//Direccion del notario.
	
	$fecha_impresion  = date("d/m/Y");                  //Fecha de impresion.
	
	

//Consulta segun parametro enviado:

#########
 ## fecha  de inscripcion del vehiculo##
 $fechainscve = mysql_query('SELECT DATE_FORMAT(STR_TO_DATE(detallevehicular.fecinsc,"%d/%m/%Y"),"%Y/%m/%d")  FROM detallevehicular  WHERE    kardex = "'.$num_kardex.'" ',$conn) or die(mysql_error());
 	$rowfechains = mysql_fetch_array($fechainscve);
######################
## Cabecera Datos I ##

$consulcabecera1 = mysql_query('select kardex.numescritura as "escritura", kardex.kardex as "num_kardex" 
from kardex where kardex.kardex =  "'.$num_kardex.'" ', $conn) or die(mysql_error());
	$rowcabecera1 = mysql_fetch_array($consulcabecera1);
	

######################################
## Obtener Referencia y Contrato(s) ##

$consulcabecera2 = mysql_query('SELECT kardex.referencia AS "referencia", kardex.contrato AS "contrato"
FROM kardex WHERE kardex.kardex =   "'.$num_kardex.'" ', $conn) or die(mysql_error());
	$rowcabecera2 = mysql_fetch_array($consulcabecera2);

######################################
## Obtener Foli y Papel  ##

$consulfolio = mysql_query('select kardex.folioini, kardex.foliofin, kardex.papelini, kardex.papelfin
from kardex where kardex.kardex = "'.$num_kardex.'" ', $conn) or die(mysql_error());
	$rowfolio = mysql_fetch_array($consulfolio);

######################################
######## Detalles del Vehiculo #######

$cosuldetvehiculos = mysql_query('SELECT detallevehicular.numplaca AS "placa", detallevehicular.marca AS "marca", detallevehicular.clase AS "clase", detallevehicular.anofab AS "anio",
detallevehicular.numserie AS "serie", detallevehicular.color AS "color", detallevehicular.motor AS "motor", detallevehicular.modelo AS "modelo", detallevehicular.carroceria AS "carroceria"
FROM detallevehicular WHERE detallevehicular.kardex = "'.$num_kardex.'" ', $conn) or die(mysql_error());
	//$rowvehiculo = mysql_fetch_array($cosuldetvehiculos);
	$numvehiculos =  mysql_num_rows($cosuldetvehiculos);

#########################################
######## Precio y moneda vehiculo #######

/*
SELECT detallevehicular.precio AS "precio" , detallevehicular.idmon AS "moneda", mediospago.desmpagos AS "medio_pago"
FROM detallevehicular
INNER JOIN mediospago ON mediospago.codmepag = detallevehicular.codmepag
WHERE detallevehicular.kardex = "'.$num_kardex.'"
*/
$cosulpreciovehi = mysql_query('SELECT patrimonial.importetrans AS "precio" , patrimonial.idmon AS "moneda", fpago_uif.descripcion AS "medio_pago", monedas.simbolo, mediospago.desmpagos
FROM patrimonial
INNER JOIN fpago_uif ON fpago_uif.id_fpago = patrimonial.fpago
INNER JOIN monedas ON monedas.idmon = patrimonial.idmon
INNER JOIN detallemediopago ON patrimonial.kardex = detallemediopago.kardex
INNER JOIN mediospago ON detallemediopago.codmepag = mediospago.codmepag
WHERE patrimonial.kardex = "'.$num_kardex.'" LIMIT 0,1 ', $conn) or die(mysql_error());
	$rowprevehi = mysql_fetch_array($cosulpreciovehi);
	$numprevehi = mysql_num_rows($cosulpreciovehi);


######################
######################
##   CONTRATANTES   ##  -> ANTERIOR

########################################################################################

/*$consulcontratantes = mysql_query('SELECT DISTINCT contratantesxacto.kardex, contratantesxacto.idtipoacto, contratantesxacto.idcontratante,
cliente2.nombre, nacionalidades.descripcion AS "nacionalidad", tipodocumento.destipdoc AS "tipo_docu",
cliente2.numdoc , (CASE WHEN(cliente2.idprofesion<>"0") THEN profesiones.desprofesion ELSE ""  END) AS "Ocupacion", 
tipoestacivil.desestcivil AS "ecivil", cliente2.direccion,  ubigeo.nomdis AS "Distrito" , cliente2.sexo AS "sexo" , contratantesxacto.idcondicion  AS "condicion"
FROM contratantesxacto
INNER JOIN cliente2 ON cliente2.idcontratante = contratantesxacto.idcontratante
INNER JOIN nacionalidades ON nacionalidades.idnacionalidad = cliente2.nacionalidad
INNER JOIN tipodocumento ON tipodocumento.idtipdoc = cliente2.idtipdoc
LEFT OUTER JOIN profesiones ON profesiones.idprofesion = cliente2.idprofesion
INNER JOIN tipoestacivil ON tipoestacivil.idestcivil = cliente2.idestcivil
INNER JOIN ubigeo ON ubigeo.coddis = cliente2.idubigeo
WHERE contratantesxacto.kardex =  "'.$num_kardex.'" ', $conn) or die(mysql_error());
	$numcontratantes =  mysql_num_rows($consulcontratantes);  */

## FIN CONTRATANTES
#########################################################################################

## CONTRATANTES V. 1.1


## PERSONA NATURAL. ##
## Objeto para naturales.
$consulcontratantes = mysql_query('SELECT DISTINCT contratantesxacto.kardex, contratantesxacto.idtipoacto, contratantesxacto.idcontratante,
cliente2.nombre, nacionalidades.descripcion AS "nacionalidad", tipodocumento.destipdoc AS "tipo_docu",
cliente2.numdoc , (CASE WHEN(cliente2.idprofesion<>"0") THEN cliente2.detaprofesion ELSE ""  END) AS "Ocupacion", 
tipoestacivil.desestcivil AS "ecivil", cliente2.direccion, 
IF(ubigeo.coddis="070101","DISTRITO DE CALLAO , PROVINCIA CONSTITUCIONAL DEL CALLAO",CONCAT("DISTRITO DE ",ubigeo.nomdis, ", PROVINCIA DE ", ubigeo.nomprov,", DEPARTAMENTO DE ",ubigeo.nomdpto )) AS "Distrito" ,
 cliente2.sexo AS "sexo", contratantesxacto.idcondicion  AS "condicion", cliente2.tipper,contratantes.firma
FROM contratantesxacto
INNER JOIN cliente2 ON cliente2.idcontratante = contratantesxacto.idcontratante
INNER JOIN nacionalidades ON nacionalidades.idnacionalidad = cliente2.nacionalidad
INNER JOIN tipodocumento ON tipodocumento.idtipdoc = cliente2.idtipdoc
LEFT OUTER JOIN profesiones ON profesiones.idprofesion = cliente2.idprofesion
INNER JOIN tipoestacivil ON tipoestacivil.idestcivil = cliente2.idestcivil
LEFT OUTER JOIN ubigeo ON ubigeo.coddis = cliente2.idubigeo
INNER JOIN contratantes ON contratantes.idcontratante = contratantesxacto.idcontratante
WHERE contratantesxacto.kardex = "'.$num_kardex.'" AND cliente2.tipper="N" ORDER BY idcontratante ASC ', $conn) or die(mysql_error());


## Objeto para juridicas. -->>>>>>>> ESTE VALEEEEEEEEEEEEEEEEEEEE
#######################
$consulcontratantes5 = mysql_query('SELECT DISTINCT contratantesxacto.kardex, contratantesxacto.idtipoacto, contratantesxacto.idcontratante,
cliente2.nombre, nacionalidades.descripcion AS "nacionalidad", tipodocumento.destipdoc AS "tipo_docu",
cliente2.numdoc , (CASE WHEN(cliente2.idprofesion<>"0") THEN cliente2.detaprofesion ELSE ""  END) AS "Ocupacion", 
tipoestacivil.desestcivil AS "ecivil", cliente2.direccion, 
IF(ubigeo.coddis="070101","DISTRITO DE CALLAO , PROVINCIA CONSTITUCIONAL DEL CALLAO",CONCAT("DISTRITO DE ",ubigeo.nomdis, ", PROVINCIA DE ", ubigeo.nomprov,", DEPARTAMENTO DE ",ubigeo.nomdpto )) AS "Distrito" ,
cliente2.sexo AS "sexo", contratantesxacto.idcondicion  AS "condicion", cliente2.tipper, contratantes.idcontratanterp "REPRESENTADO", 
IF(ISNULL(representados.idcondicion) OR representados.idcondicion="","",representados.idcondicion)AS "CONDI_REPRESENTADO"
FROM contratantesxacto
INNER JOIN cliente2 ON cliente2.idcontratante = contratantesxacto.idcontratante
INNER JOIN nacionalidades ON nacionalidades.idnacionalidad = cliente2.nacionalidad
INNER JOIN tipodocumento ON tipodocumento.idtipdoc = cliente2.idtipdoc
LEFT OUTER JOIN profesiones ON profesiones.idprofesion = cliente2.idprofesion
INNER JOIN tipoestacivil ON tipoestacivil.idestcivil = cliente2.idestcivil
LEFT OUTER JOIN ubigeo ON ubigeo.coddis = cliente2.idubigeo
INNER JOIN contratantes ON contratantes.idcontratante = contratantesxacto.idcontratante
LEFT OUTER JOIN contratantesxacto representados ON contratantes.idcontratanterp = representados.idcontratante
WHERE contratantesxacto.kardex = "'.$num_kardex.'" AND cliente2.tipper="N" ', $conn) or die(mysql_error());
###########################



## NUMERO DE CONTRATANTES (NATURAL Y JURIDICOS)
$consulnumcontrat = mysql_query('SELECT DISTINCT cliente2.idcliente FROM contratantesxacto 
INNER JOIN cliente2 ON cliente2.idcontratante = contratantesxacto.idcontratante
WHERE kardex=  "'.$num_kardex.'" ', $conn) or die(mysql_error());

$numcontratantes =  mysql_num_rows($consulnumcontrat);	


## PERSONA JURIDICA. ##
$consuljuridica = mysql_query('SELECT DISTINCT contratantesxacto.kardex, contratantesxacto.idtipoacto, contratantesxacto.idcontratante,
cliente2.razonsocial, (CASE WHEN ISNULL(nacionalidades.descripcion) THEN "23" ELSE nacionalidades.descripcion END) AS "nacionalidad", tipodocumento.destipdoc AS "tipo_docu",
cliente2.numdoc, cliente2.domfiscal AS "direccion",  ubigeo.nomdis AS "Distrito" , cliente2.actmunicipal, cliente2.tipper, cliente2.numpartida,contratantesxacto.idcondicion  AS "condicion"
FROM contratantesxacto
INNER JOIN cliente2 ON cliente2.idcontratante = contratantesxacto.idcontratante
LEFT OUTER JOIN nacionalidades ON nacionalidades.idnacionalidad = cliente2.nacionalidad
INNER JOIN tipodocumento ON tipodocumento.idtipdoc = cliente2.idtipdoc
INNER JOIN ubigeo ON ubigeo.coddis = cliente2.idubigeo
WHERE contratantesxacto.kardex = "'.$num_kardex.'" AND cliente2.tipper="J" ', $conn) or die(mysql_error());

$numjuridica =  mysql_num_rows($consuljuridica);	

	
########################

## FECHA DE CONCLUSION
$consulfecconclu = mysql_query('SELECT DATE_FORMAT(STR_TO_DATE(kardex.fechaconclusion,"%d/%m/%Y"),"%Y/%m/%d") FROM kardex WHERE kardex.kardex = "'.$num_kardex.'" ', $conn) or die(mysql_error());

$numfecconlusion =  mysql_num_rows($consulfecconclu);
$rowfecconlusion =  mysql_fetch_array($consulfecconclu);	

if($numfecconlusion == 0)
{
	$fec_conclusion  =  " ";
}
else if($numfecconlusion > 0)
{ 
    $fec_conclusion = $fec_firma->fun_fech_letras($rowfecconlusion[0]);
}

//Definicion de las variables para llenar la plantilla dinamicamente
// # cabecera I
	$num_escritura    = $rowcabecera1[0];
	$num_kardex       = $rowcabecera1[1];
	$num_reg          = "1"; #$rowcabecera1[2];
	
// # cabecera II
	$contrato         = $rowcabecera2[1];
	$referencia       = $rowcabecera2[0];
// #  fecha de inscripcion
	 
	$fechains1 =  $fecha->fun_fech_comple($rowfechains[0]);
// # Contratantes 
	$nom_contratante  = $rowcontratantes[3];
	$nacionalidad     = $rowcontratantes[4];
	$numdoc_contrat   = $rowcontratantes[6];
	$ocupacion        = $rowcontratantes[7];
	$est_civil        = $rowcontratantes[8];
	$domicilio        = $rowcontratantes[9];
	$nom_distrito     = $rowcontratantes[10];
	$cont_sexo        = $rowcontratantes[11];
	$cont_condicion   = $rowcontratantes[12];
	
	// EN ALGUNOS CASOS NO HAY MEDIOS DE PAGO (EJEMPLO : DONACIONES)
    $monto_vehi     = "";
	$moneda_vehi    = "";
	$mediopago_vehi = "";
	$simbolo_mon    = "";
	
// #Precio vehiculo:
if($numprevehi > 0)
{
	$monto_vehi     = $rowprevehi[0];
	$moneda_vehi    = $rowprevehi[1];
	$mediopago_vehi = $rowprevehi[4];
	$simbolo_mon    = $rowprevehi[3];
	
	$desmonto_vehi = $precio->fun_capital_moneda($moneda_vehi,$monto_vehi);
}
else if($numprevehi == 0)
{
	$monto_vehi     = "";
	$moneda_vehi    = "";
	$mediopago_vehi = "";
	$desmonto_vehi  = "";
}

// # Datos adicionales
#1. dependiendo el numero:
if($numcontratantes==1)
{
	$evalnumcon = "EL(ELLA)";
	$evalotor   = "EL(LA) OTORGANTE";	
}
else if($numcontratantes>1)
{
	$evalnumcon = "ELLOS";
	$evalotor   = "LOS OTORGANTES";	
}

// # Folio:
	$folioini         = $rowfolio[0];
	$foliofin         = $rowfolio[1];
	$papelini         = $rowfolio[2];
	$papelfin         = $rowfolio[3];

//# referencia_contratantes

	$referencia_contratantes= " ";
	
############################################################
###################### EVALUA LA MINUTA: ###################

#Se escoge el disco:
$disk      = "C:/";
#Se escoge la carpeta base:
$mainfile  = "minutas/";
#Se escoge nombre archivo:
$archivo = $num_kardex.".docx";
$ruta =  $disk.$mainfile;

$fp = fopen($ruta.$archivo, 'r'); 
$contents = fread($fp, filesize($ruta.$archivo)); 

######## WORD ##########
$archivo_ruta = $ruta.$archivo;
function docx2text($filename) {
   return readZippedXML($filename, "word/document.xml");
 }

function readZippedXML($archiveFile, $dataFile) {
// se crea archivo ZIP
$zip = new ZipArchive;

// abrir archivo
if (true === $zip->open($archiveFile)) {
    // si existe busca la data en el archivo
    if (($index = $zip->locateName($dataFile)) !== false) {
        // si encuentra la convierte a cadena
        $data = $zip->getFromIndex($index);
        // cierra el archivo
        $zip->close();
        // carga el XML dela cadena
        // pasa errores y alertas
        $xml = DOMDocument::loadXML($data, LIBXML_NOENT | LIBXML_XINCLUDE | LIBXML_NOERROR | LIBXML_NOWARNING);
        // retorna la data sin etiquetas de formato XML 
        return strip_tags($xml->saveXML());
    }
    $zip->close();
}

// En caso de que falle retorna una cadena vacia
return "";
}
########################

$contents2 = docx2text($archivo_ruta);

if($contents=="")
{
	//echo "No existe el archivo: ".$archivo;
	//exit();
$contents2 = "";	
}



################################################################################################################################
############################################## INICIO DEFINICION Y CARGA DE LOS INSERTOS #######################################

$diskinserto              = "C:/";
$mainfile_inserto         = "insertos/";
#Se escoge nombre archivo:
$archivo_inserto = $num_kardex.".docx"; 

$ruta_inserto =  $diskinserto.$mainfile_inserto;

$fp = fopen($ruta.$archivo, 'r'); 
$contents = fread($fp, filesize($ruta.$archivo)); 

######## WORD ##########
$archivo_ruta = $ruta.$archivo;

//$contents2 = (docx2text($archivo_ruta));

//if($contents=="")
//{$contents2="No se ha definido la minuta";	}

##### BUSQUEDA DE LOS INSERTOS
$busca_insertos = mysql_query('SELECT insertos FROM kardex WHERE kardex.kardex = "'.$num_kardex.'" ', $conn) or die(mysql_error());
$row_inserto =  mysql_fetch_array($busca_insertos);

# Guarda los insertos	
$values = explode(",",$row_inserto[0]);	

# Cuenta los insertos:
$num_insertos =  substr_count($row_inserto[0], ',');

# Pushea el array con los Insertos
$todos_insertos = array();

for($i=0;$i<=$num_insertos-1;$i++)
	{
		trim($values[$i].".docx");
		$fp = fopen($ruta.$archivo, 'r'); 
		$contents_inserto  = fread($fp, filesize($ruta_inserto.trim($values[$i]).".docx")); 
		$contents2_inserto = strtoupper((docx2text($ruta_inserto.trim($values[$i]).".docx")));
			if($contents2_inserto=="")
				{
					$contents2_inserto="";	
				}
	//echo $contents2_inserto.chr(13).chr(10);	
	//$todos_insertos[] = array('data_insertos_todo' => $contents2_inserto);
	$data_insertar .= $contents2_inserto.chr(13).chr(10);
	}
	//echo var_dump($todos_insertos);
	//exit();
	if($data_insertar=="")
	{$data_insertar = "";}
##############################################  FIN DEFINICION Y CARGA DE LOS INSERTOS #########################################
################################################################################################################################


$dataContratantes = array();
$dataContratantes2 = array();
$dataContratantes3 = array();
$dataContratantes4 = array();


// Evalua multiplicidad de representantes para una empresa
$dataRepresentantes = array();

$dataRepresentantes_muestra = array();

## LLENANDO EL ARRAY CONTRATANTES: ##

for($i = 0; $i <= $numcontratantes-1; $i++)
	{ 
		
		$rowcontratantes =  mysql_fetch_array($consulcontratantes5);
		$rowjuridica     =  mysql_fetch_array($consuljuridica);
		
		//echo $rowcontratantes[12];
		#busca conyuge:
		$consulconyuge1 = mysql_query('SELECT cliente.nombre AS "coyuge" FROM cliente WHERE conyuge =  "'.$rowcontratantes[2].'" ', $conn) or die(mysql_error());
	    $rowconyuge1 = mysql_fetch_array($consulconyuge1);
		
		//evalua conyuge:
		if($rowconyuge1!="")
		{
			$nom_conyuge      = $rowconyuge1[0];
			$formaconyuge     = "CON ".$rowconyuge1[0];
		}
	
		else if($rowconyuge1=="")
		{
			$nom_conyuge      = "";
			$formaconyuge     = "";
		}
		
		//evalua sexo:
		if($rowcontratantes[11]=="M")
		{
			$evalsexo = "";	
		}
		else if($rowcontratantes[11]=="F")
		{
			$evalsexo = "";
		}
		
		//evalua ocupacion:
		if($rowcontratantes[7]=="")
		{
			$evalocupacion = "NO ESPECIFICA";	
		}
		else if($rowcontratantes[7]!="")
		{
			$evalocupacion = $rowcontratantes[7];	
		}
		$evalcondicion = "";
		if($rowcontratantes[12]=='006' || $rowcontratantes[12]=='043' || $rowcontratantes[12]=='049' || $rowcontratantes[12]=='055' || $rowcontratantes[12]=='113' || $rowcontratantes[12]=='188' || $rowcontratantes[12]=='117' || $rowcontratantes[12]=='175' )
			{
				if($rowcontratantes[12]=='117' || $rowcontratantes[12]=='175') // evalua al apoderado o representante
				{
					if($rowcontratantes[15]=='006' || $rowcontratantes[15]=='043' || $rowcontratantes[15]=='049' || $rowcontratantes[15]=='055' || $rowcontratantes[15]=='113' || $rowcontratantes[12]=='188')
						{
							$evalcondicion = "COMO TRANSFERENTE "; // ES EL APODERADO DEL TRANSFERENTE
						}
					else if($rowcontratantes[15]=='007' || $rowcontratantes[15]=='044' || $rowcontratantes[15]=='050' || $rowcontratantes[15]=='056' || $rowcontratantes[15]=='114' || $rowcontratantes[12]=='189')
					    {
							$evalcondicion = "COMO ADQUIRIENTE"; // ES EL APODERADO DEL ADQUIRIENTE
						}
				}
				else // SI NO ES APODERADO SIGUE EL FLUJO NORMAL 113 VENDEDOR (TRANSFERENTE)-.-"
				{
					$evalcondicion = "COMO TRANSFERENTE "; // $evalcondicion = "COMO TRANSFERENTE ";	
				} // 117 -> APODERADO
	
			} // TRASNFERENTE
			
			else if($rowcontratantes[12]=='007' || $rowcontratantes[12]=='044' || $rowcontratantes[12]=='050' || $rowcontratantes[12]=='056' || $rowcontratantes[12]=='114' || $rowcontratantes[12]=='189')    
				{
					$evalcondicion = "COMO ADQUIRIENTE"; // $evalcondicion = "COMO ADQUIRIENTE ";	
				} // ADQUIRIENTE  
		
		
		##Natural y Juridica V 1.1 :
		$consulrepresentante = mysql_query('SELECT cliente2.nombre, nacionalidades.descripcion AS "nacionalidad", tipodocumento.destipdoc AS "tipo_docu", cliente2.numdoc,
(CASE WHEN(cliente2.idprofesion<>"0") THEN profesiones.desprofesion ELSE ""  END) AS "Ocupacion", tipoestacivil.desestcivil AS "ecivil",
cliente2.direccion,  
IF(ubigeo.coddis="070101","DISTRITO DE CALLAO , PROVINCIA CONSTITUCIONAL DEL CALLAO",CONCAT("DISTRITO DE ",ubigeo.nomdis, ", PROVINCIA DE ", ubigeo.nomprov,", DEPARTAMENTO DE ",ubigeo.nomdpto )) AS "Distrito"
 
			FROM contratantes
			INNER JOIN cliente2 ON cliente2.idcontratante = contratantes.idcontratante
			INNER JOIN nacionalidades ON nacionalidades.idnacionalidad = cliente2.nacionalidad
			INNER JOIN tipodocumento ON tipodocumento.idtipdoc = cliente2.idtipdoc
			LEFT OUTER JOIN profesiones ON profesiones.idprofesion = cliente2.idprofesion
			LEFT OUTER JOIN tipoestacivil ON tipoestacivil.idestcivil = cliente2.idestcivil
			LEFT OUTER JOIN ubigeo ON ubigeo.coddis = cliente2.idubigeo
			WHERE contratantes.idcontratanterp =  "'.$rowjuridica[2].'" ', $conn) or die(mysql_error());
		$eval_mostrar_persona = "";	
		$eval_mostrar_persona_2 = "";
		
		$eval_mostrar_persona_tran	= "";
		$eval_mostrar_persona_adq   = "";
		
		if($rowjuridica[12]=='114')
		{
			$evalcondij= "COMO ADQUIRIENTE";
			}else {$evalcondij= "COMO TRANSFERENTE";}
		if($rowjuridica[10]=='J')
		{
			$evaljuridica = $rowjuridica[2];
		

		while($rowrepresentante = mysql_fetch_array($consulrepresentante))
			{
			
		$dataRepresentantes[] = array('nom_contratante' => $evalcondij." ".($evalseguim)." ".str_replace("*","&",str_replace("?","'",strtoupper(($rowrepresentante[0])))).", QUIEN MANIFIESTA SER DE NACIONALIDAD ".strtoupper($rowrepresentante[1]).", DE ESTADO CIVIL ".strtoupper($rowrepresentante[5]).", DE OCUPACION Y/O PROFESION ".strtoupper(($rowrepresentante[4])).", DOMICILIAR EN ".strtoupper(($rowrepresentante[6])).", ".strtoupper(($rowrepresentante[7])).", SE IDENTIFICA CON DOCUMENTO NACIONAL DE IDENTIDAD NUMERO ".strtoupper(($rowrepresentante[3])).strtoupper((", Y DECLARA QUE PROCEDE EN REPRESENTACIÓN DE ")).str_replace("*","&",str_replace("?","'",strtoupper($rowjuridica[3])))." CON REGISTRO UNICO DE CONTRIBUYENTE ".strtoupper($rowjuridica[6]).strtoupper((" CON FACULTADES INSCRITAS EN LA PARTIDA ELECTRÓNICA NUMERO ")).strtoupper($rowjuridica[11])."  DEL REGISTRO DE PERSONAS JURIDICAS DE LIMA", 'nom_firma'=>str_replace("*","&",str_replace("?","'",strtoupper(($rowrepresentante[0])))).chr(13).chr(10)." POR ".str_replace("*","&",str_replace("?","'",strtoupper($rowjuridica[3]))));
		
		// if($rowjuridica[3])
		if($rowjuridica[12]=='006' || $rowjuridica[12]=='043' || $rowjuridica[12]=='049' || $rowjuridica[12]=='055' || $rowjuridica[12]=='113' || $rowcontratantes[12]=='188')      # TRANSFERENTE
		{	
		$eval_mostrar_personax = str_replace("*","&",str_replace("?","'",strtoupper($rowjuridica[3]))) . " REPRESENTADA POR " . strtoupper(($rowrepresentante[0]));
		#$eval_mostrar_personay = "";
		}
		else if($rowjuridica[12]=='007' || $rowjuridica[12]=='044' || $rowjuridica[12]=='050' || $rowjuridica[12]=='056' || $rowjuridica[12]=='114' || $rowcontratantes[12]=='189') # ADQUIRIENTE
		{	
		$eval_mostrar_personay = str_replace("*","&",str_replace("?","'",strtoupper($rowjuridica[3]))) . " REPRESENTADA POR " . strtoupper(($rowrepresentante[0]));
		#$eval_mostrar_personax = "";
		}
		// PARA MOSTRAR ARRIBA :
		//$dataRepresentantes_muestra[] = array('mues_nom_contratante' => strtoupper($rowjuridica[3]) . " REPRESENTADA POR " . strtoupper(($rowrepresentante[0])));
			//echo $rowrepresentante[0]." | ";
			    
			}
		}  
		 $eval_mostrar_persona_tran .= $eval_mostrar_personax; 
		 $eval_mostrar_persona_adq  .= $eval_mostrar_personay;
		  
					
	}
	//echo var_dump($dataRepresentantes);
	//exit();	
	
## FIN ARRAY CONTRATANTES. ##
 
## NUEVA UBICACION PESONA NATURAL : (AFUERA) 

## EVALUA AL REPRESENTANTE:
		
		//$rowrept =  mysql_fetch_array($consultrepre);	
		//$evalua_rept = $rowrept[0];
		
		
for($i = 0; $i <= $numcontratantes-1; $i++)
	{
		while($rowcontratantes = mysql_fetch_array($consulcontratantes))
			{
				/*$consultrepre = mysql_query('SELECT contratantes.idcontratante FROM contratantes WHERE contratantes.kardex = "'.$num_kardex.'" AND contratantes.tiporepresentacion != "1"', $conn) or die(mysql_error());
				$rowrept =  mysql_fetch_array($consultrepre);	
		echo "a".$rowrept[0]."b";*/
		//echo "hola ".$rowrept[0]."fin";
		
		#busca conyuge:
		$consulconyuge1 = mysql_query('SELECT cliente.nombre AS "conyuge", cliente2.detaprofesion as "ocupacion"
FROM cliente
INNER JOIN cliente2 ON cliente.idcliente=cliente2.idcliente 
WHERE cliente2.idcontratante = "'.$rowcontratantes[2].'"', $conn) or die(mysql_error());
	    $rowconyuge1 = mysql_fetch_array($consulconyuge1);
		//echo $rowconyuge1[0]; exit();
		//evalua conyuge:
		if($rowconyuge1 != "")
		{
			$nom_conyuge      = strtoupper($rowconyuge1[0]);
			$formaconyuge     = "CON ".strtoupper($rowconyuge1[0]);
		}
	
		else if($rowconyuge1=="")
		{
			$nom_conyuge      = "";
			$formaconyuge     = "";
		}
		
		//evalua sexo:
		if($rowcontratantes[11]=="M")
		{
			$evalsexo = "";	
		}
		else if($rowcontratantes[11]=="F")
		{
			$evalsexo = "";
		}
		
		//evalua ocupacion:
		if($rowconyuge1['ocupacion']=="")
		{
			$evalocupacion = "NO ESPECIFICA";	
		}
		else if($rowconyuge1[7]!="")
		{
			$evalocupacion = $rowconyuge1['ocupacion'];	
		}
			
		// NUEVO PARA EVALUACIÓN
		$evalcondicion = " ";
		if($rowcontratantes[12]=='006' || $rowcontratantes[12]=='043' || $rowcontratantes[12]=='049' || $rowcontratantes[12]=='055' || $rowcontratantes[12]=='113' || $rowcontratantes[12]=='188' || $rowcontratantes[12]=='117' || $rowcontratantes[12]=='175')
			{
				if($rowcontratantes[12]=='117' || $rowcontratantes[12]=='175') // evalua al apoderado o representante
				{
					if($rowcontratantes[15]=='006' || $rowcontratantes[15]=='043' || $rowcontratantes[15]=='049' || $rowcontratantes[15]=='055' || $rowcontratantes[15]=='113' || $rowcontratantes[15]=='188')
						{
							$evalcondicion = "COMO TRANSFERENTE "; // ES EL APODERADO DEL TRASNFERENTE
						}
					else if($rowcontratantes[15]=='007' || $rowcontratantes[15]=='044' || $rowcontratantes[15]=='050' || $rowcontratantes[15]=='056' || $rowcontratantes[15]=='114' || $rowcontratantes[15]=='189')
					    {
							$evalcondicion = "COMO ADQUIRIENTE "; // ES EL APODERADO DEL ADQUIRIENTE
						}
				}
				else // SI NO ES APODERADO SIGUE EL FLUJO NORMAL
				{
					$evalcondicion = "COMO TRANSFERENTE "; // $evalcondicion = "COMO TRANSFERENTE ";	
				} // 117 -> APODERADO
	
			} // TRASNFERENTE
			else if($rowcontratantes[12]=='007' || $rowcontratantes[12]=='044' || $rowcontratantes[12]=='050' || $rowcontratantes[12]=='056' || $rowcontratantes[12]=='114' || $rowcontratantes[12]=='189')    
				{
					$evalcondicion = "COMO ADQUIRIENTE "; // $evalcondicion = "COMO ADQUIRIENTE ";	
				} 	

		$eval_persona_adquiriente  = "";
		$eval_persona_transferente = "";
		
		if($rowcontratantes[13]=='N') 
		{
		
		if($rowcontratantes[12]!='188' && $rowcontratantes[12]!='189' && $rowcontratantes[12]!='117' && $rowcontratantes[14]=='1')
		{
				
		$dataContratantes2[] = array('nom_contratante'=>$evalsexo.$evalcondicion." ".str_replace("*","&",str_replace("?","'",strtoupper(($rowcontratantes[3])))).", QUIEN MANIFIESTA SER DE NACIONALIDAD ".$rowcontratantes[4].", DE ESTADO CIVIL ".$rowcontratantes[8]." ".($formaconyuge).", DE OCUPACION Y/O PROFESION ".($evalocupacion).", DOMICILIAR EN ".($rowcontratantes[9]).", ".($rowcontratantes[10]).", SE IDENTIFICA CON DOCUMENTO NACIONAL DE IDENTIDAD NUMERO ".$rowcontratantes[6]." Y DECLARA QUE PROCEDE POR DERECHO PROPIO", 'nom_firma'=>str_replace("*","&",str_replace("?","'",strtoupper(($rowcontratantes[3])))));
			## -> .strtoupper($rowrepderecho[2])." ".strtoupper($rowrepderecho[4])
			
				if($rowcontratantes[12]=='006' || $rowcontratantes[12]=='043' || $rowcontratantes[12]=='049' || $rowcontratantes[12]=='055' || $rowcontratantes[12]=='113' || $rowcontratantes[12]=='188') # TRANSFERENTE
					{
						$eval_x_persona_transferente = "PRUEBA".strtoupper($rowcontratantes[3]);
						$dataContratantes3[] = array('nom_transferente'=>$eval_x_persona_transferente);
					}
					else if($rowcontratantes[12]=='007' || $rowcontratantes[12]=='044' || $rowcontratantes[12]=='050' || $rowcontratantes[12]=='056' || $rowcontratantes[12]=='114' || $rowcontratantes[12]=='189') # ADQUIRIENTE
							{
								$eval_x_persona_adquiriente = strtoupper(($rowcontratantes[3]));
								$dataContratantes4[] = array('nom_adquiriente'=>$eval_x_persona_adquiriente);
							}
			
		}
		else if($rowcontratantes[12]!='188' && $rowcontratantes[12]!='189' && $rowcontratantes[12]!='117' && $rowcontratantes[14]=='0')
		{

			$consulrepresentantenatural = mysql_query('SELECT  cliente2.nombre, nacionalidades.descripcion AS "nacionalidad", tipodocumento.destipdoc AS "tipo_docu", cliente2.numdoc,
(CASE WHEN(cliente2.idprofesion<>"0") THEN profesiones.desprofesion ELSE ""  END) AS "Ocupacion", tipoestacivil.desestcivil AS "ecivil",
cliente2.direccion,  
IF(ubigeo.coddis="070101","DISTRITO DE CALLAO , PROVINCIA CONSTITUCIONAL DEL CALLAO",CONCAT("DISTRITO DE ",ubigeo.nomdis, ", PROVINCIA DE ", ubigeo.nomprov,", DEPARTAMENTO DE ",ubigeo.nomdpto )) AS "Distrito",contratantes.numpartida as numpartida
 
			FROM contratantes
			INNER JOIN cliente2 ON cliente2.idcontratante = contratantes.idcontratante
			INNER JOIN nacionalidades ON nacionalidades.idnacionalidad = cliente2.nacionalidad
			INNER JOIN tipodocumento ON tipodocumento.idtipdoc = cliente2.idtipdoc
			LEFT OUTER JOIN profesiones ON profesiones.idprofesion = cliente2.idprofesion
			LEFT OUTER JOIN tipoestacivil ON tipoestacivil.idestcivil = cliente2.idestcivil
			LEFT OUTER JOIN ubigeo ON ubigeo.coddis = cliente2.idubigeo
			WHERE contratantes.idcontratanterp="'.$rowcontratantes[2].'" ', $conn) or die(mysql_error());
			
			//echo "hola".$consulrepresentantenatural[4];
							while($consulrepresentantenatural1 = mysql_fetch_array($consulrepresentantenatural))
			{
					$dataContratantes2[] = array('nom_contratante'=>$evalsexo.$evalcondicion." ".str_replace("*","&",str_replace("?","'",strtoupper(($consulrepresentantenatural1[0])))).", QUIEN MANIFIESTA SER DE NACIONALIDAD ".$consulrepresentantenatural1[1].", DE ESTADO CIVIL ".$consulrepresentantenatural1[5]." ".($formaconyuge).", DE OCUPACION Y/O PROFESION ".($consulrepresentantenatural1[4]).", DOMICILIAR EN ".($consulrepresentantenatural1[6]).", ".($consulrepresentantenatural1[7]).", SE IDENTIFICA CON DOCUMENTO NACIONAL DE IDENTIDAD NUMERO ".$consulrepresentantenatural1[3]." Y DECLARA QUE PROCEDE EN REPRESENTACION DE ".$rowcontratantes[3]." SEGUN FACULTADES INSCRITAS EN LA PARTIDA ELECTRONICA Nº".$consulrepresentantenatural1['numpartida']." DEL REGISTRO DE MANDATOS Y PODERES DE LIMA", 'nom_firma'=>str_replace("*","&",str_replace("?","'",strtoupper(($rowcontratantes[3])))));
					
				
					## -> .strtoupper($rowrepderecho[2])." ".strtoupper($rowrepderecho[4])
					
						if($rowcontratantes[12]=='006' || $rowcontratantes[12]=='043' || $rowcontratantes[12]=='049' || $rowcontratantes[12]=='055' || $rowcontratantes[12]=='113' || $rowcontratantes[12]=='188') # TRANSFERENTE
							{
								$eval_x_persona_transferente = strtoupper("PRUEBA".$rowcontratantes[3]);
							
							}
							else if($rowcontratantes[12]=='007' || $rowcontratantes[12]=='044' || $rowcontratantes[12]=='050' || $rowcontratantes[12]=='056' || $rowcontratantes[12]=='114' || $rowcontratantes[12]=='189') # ADQUIRIENTE
									{
										$eval_x_persona_adquiriente = strtoupper(($rowcontratantes[3]));
									}
					
			// *********************************************************************************************************
					
					
		}

		}}}
				
		
		 $eval_persona_adquiriente  .= $eval_x_persona_adquiriente;
		  $eval_persona_transferente .= $eval_x_persona_transferente;	
	}
	
	#echo var_dump($dataContratantes2);
	#exit();

$dataVehiculos = array();

## LLENANDO EL ARRAY VEHICULOS: ##

for($i = 0; $i <= $numvehiculos-1; $i++)
	{
		$rowvehiculo = mysql_fetch_array($cosuldetvehiculos);
		
		## Array Vehiculos:
		$dataVehiculos[] = array(
		'contenido_vehicular' => 
							 "PLACA: " .strtoupper($rowvehiculo[0]).", MARCA: " .strtoupper($rowvehiculo[1]).", CLASE: " .strtoupper($rowvehiculo[2]).strtoupper((", AÑO DE FABRICACIÓN: ")).strtoupper($rowvehiculo[3]).strtoupper((", SERIE N° ")).strtoupper($rowvehiculo[4]).", COLOR(ES): " .strtoupper($rowvehiculo[5]).strtoupper((", MOTOR N° ")).strtoupper($rowvehiculo[6]).", MODELO: " .strtoupper($rowvehiculo[7]).", CARROCERIA: " .strtoupper($rowvehiculo[8])	
								);	
	}

## FIN ARRAY VEHICULOS ##	

// Plantilla - Contratantes a imprimir
$contratante = str_replace("*","&",str_replace("?","'",($nom_contratante))).", QUIEN MANIFIESTA SER DE NACIONALIDAD ".($nacionalidad).", DE ESTADO CIVIL ".$est_civil." ".($formaconyuge).", DE OCUPACION Y/O PROFESION ".$ocupacion.", DOMICILIAR EN ".($domicilio).", DISTRITO DE ".($nom_distrito).", PROVINCIA Y DEPARTAMENTO DE LIMA, SE IDENTIFICA CON DOCUMENTO NACIONAL DE IDENTIDAD NUMERO ".($numdoc_contrat). " Y DECLARA QUE PROCEDE POR PROPIO DERECHO";
//Carga la plantilla;
	$TBS->LoadTemplate($template);
	
	// Creando el bloque para la impresion de contratanates:
	
	$TBS->MergeBlock('b', $dataVehiculos);
	
	$TBS->MergeBlock('a', $dataContratantes);
	
	$TBS->MergeBlock('d,g', $dataRepresentantes);
	
	$TBS->MergeBlock('e,c', $dataContratantes2);
	
	$TBS->MergeBlock('h', $dataContratantes3);
		
	$TBS->MergeBlock('i', $dataContratantes4);
	$TBS->MergeBlock('f', $dataRepresentantes_muestra);
	
	
//Si existen comentios en la plantilla los oculta.
	$TBS->PlugIn(OPENTBS_DELETE_COMMENTS);

//Nombre para el archivo a descargar.

    //$file_name = 'Imp_kardex_Vehi'.$num_kardex.'.odt';
	$file_name = 'K'.$num_kardex.'.odt';
	//$file_name = str_replace('.','_'.$suffix.'.',$file_name);
	
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
