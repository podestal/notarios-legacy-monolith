<?php

// Carga las librerias:
include('../conexion.php');
include_once('../includes/ClaseLetras.class.php');


## notario :
$busnumcarta = "SELECT CONCAT(confinotario.nombre, ' ', confinotario.apellido ) AS 'NOTARIO' , confinotario.direccion, confinotario.distrito FROM confinotario";
$numcartabus = mysql_query($busnumcarta,$conn) or die(mysql_error());
$rownum      = mysql_fetch_array($numcartabus);
$muesnotario = $rownum[0];
$direccion   =  strtoupper($rownum[1]);
$distrito_notario   =  strtoupper($rownum[2]);
##

//se crea el objeto  ClaseLetras
	$fecha     = new ClaseNumeroLetra();
	$fec_firma = new ClaseNumeroLetra();

	$dia  = $fecha->fun_fecha_dia(); 
	$mes  = $fecha->fun_fecha_mes();
	$anio = $fecha->fun_fecha_anio();
	$fec_letras = $fecha->fun_fech_comple(date("Y/m/d"));
	

	$num_kardex       = $_REQUEST["num_kardex"];        //Num. kardex a exportar.
	//$idtipoacto       = $_REQUEST["idtipoacto"];        //Id del tipo de acto.
	
	//$numcrono2        = substr($num_crono,5,6).'-'.substr($num_crono,0,4);	//Para Mostrar num_crono.
	$usuario_imprime  = $_REQUEST["usuario_imprime"];  //Nombre del usuario que imprime.
	$nom_notario      = $muesnotario;       //Nombre del notario.
	$num_doc      	  = $_REQUEST["num_doc"];           //numero documento notario
	$reg_contrib      = $_REQUEST["reg_contrib"];       //registro unico de contribuyentes.
	$num_doc2      	  = $_REQUEST["num_doc2"];           //numero libreta militar

	$direc_notario	  = $direccion; 		//Direccion del notario.

	$fecha_impresion  = date("d/m/Y");                 //Fecha de impresion.
	

######################
## Cabecera Datos I ##

$consulcabecera1 = mysql_query('SELECT kardex.numescritura AS "escritura", kardex.kardex AS "num_kardex" , kardex.numminuta AS "num_minuta", kardex.txa_minuta 
from kardex where kardex.kardex =  "'.$num_kardex.'" ', $conn) or die(mysql_error());
	$rowcabecera1 = mysql_fetch_array($consulcabecera1);

######################################
## Obtener Referencia y Contrato(s) ##

$consulcabecera2 = mysql_query('SELECT kardex.referencia AS "referencia", kardex.contrato AS "contrato"
FROM kardex WHERE kardex.kardex =   "'.$num_kardex.'" ', $conn) or die(mysql_error());
	$rowcabecera2 = mysql_fetch_array($consulcabecera2);

######################################


######################################
## Obtener Folios y Papel ini y fin  ##

$consulfolio = mysql_query('select kardex.folioini, kardex.foliofin, kardex.papelini, kardex.papelfin
from kardex where kardex.kardex = "'.$num_kardex.'" ', $conn) or die(mysql_error());
	$rowfolio = mysql_fetch_array($consulfolio);

######################
## Contratantes     ##

## PERSONA NATURAL. ##
## Objeto para naturales.
$consulcontratantes = mysql_query('SELECT DISTINCT contratantesxacto.kardex, contratantesxacto.idtipoacto, contratantesxacto.idcontratante,
cliente2.nombre, nacionalidades.descripcion AS "nacionalidad", tipodocumento.destipdoc AS "tipo_docu",
cliente2.numdoc, upper(cliente2.detaprofesion)  AS "Ocupacion", 
tipoestacivil.desestcivil AS "ecivil", cliente2.direccion,  (CASE WHEN ISNULL(ubigeo.nomdis) THEN "" ELSE ubigeo.nomdis  END) AS "Distrito"  , cliente2.sexo AS "sexo" ,CLIENTE2.tipper, IF(contratantes.firma = "0", "NO","SI") AS "firma"
FROM contratantesxacto
INNER JOIN cliente2 ON cliente2.idcontratante = contratantesxacto.idcontratante
INNER JOIN contratantes ON contratantes.idcontratante = contratantesxacto.idcontratante AND contratantes.kardex = contratantesxacto.kardex
INNER JOIN nacionalidades ON nacionalidades.idnacionalidad = cliente2.nacionalidad
INNER JOIN tipodocumento ON tipodocumento.idtipdoc = cliente2.idtipdoc
LEFT OUTER JOIN tipoestacivil ON tipoestacivil.idestcivil = cliente2.idestcivil
LEFT OUTER JOIN ubigeo ON ubigeo.coddis = cliente2.idubigeo
WHERE contratantesxacto.kardex =  "'.$num_kardex.'" AND cliente2.tipper="N" ', $conn) or die(mysql_error());


## Objeto para juridicas.
#######################
$consulcontratantes5 = mysql_query('SELECT DISTINCT contratantesxacto.kardex, contratantesxacto.idtipoacto, contratantesxacto.idcontratante, 
cliente2.nombre, nacionalidades.descripcion AS "nacionalidad", tipodocumento.destipdoc AS "tipo_docu",
cliente2.numdoc , UPPER(cliente2.detaprofesion)  AS "Ocupacion", 
tipoestacivil.desestcivil AS "ecivil", cliente2.direccion,  (CASE WHEN ISNULL(ubigeo.nomdis) THEN "" ELSE ubigeo.nomdis  END) AS "Distrito"  , cliente2.sexo AS "sexo" ,CLIENTE2.tipper
FROM contratantesxacto
INNER JOIN cliente2 ON cliente2.idcontratante = contratantesxacto.idcontratante
INNER JOIN nacionalidades ON nacionalidades.idnacionalidad = cliente2.nacionalidad
INNER JOIN tipodocumento ON tipodocumento.idtipdoc = cliente2.idtipdoc
LEFT OUTER JOIN tipoestacivil ON tipoestacivil.idestcivil = cliente2.idestcivil
LEFT OUTER JOIN ubigeo ON ubigeo.coddis = cliente2.idubigeo
WHERE contratantesxacto.kardex =  "'.$num_kardex.'" AND cliente2.tipper="N" ', $conn) or die(mysql_error());
###########################
# /*(CASE WHEN(cliente2.idprofesion<>"0") THEN profesiones.desprofesion ELSE ""  END)*/
#LEFT OUTER JOIN profesiones ON profesiones.idprofesion = cliente2.idprofesion	
	
## NUMERO DE CONTRATANTES (NATURAL Y JURIDICOS)
$consulnumcontrat = mysql_query('SELECT DISTINCT cliente2.idcliente FROM contratantesxacto INNER JOIN cliente2 ON cliente2.idcontratante = contratantesxacto.idcontratante WHERE kardex=  "'.$num_kardex.'" ', $conn) or die(mysql_error());

$numcontratantes =  mysql_num_rows($consulnumcontrat);	

//$rowcontratantes =  mysql_fetch_array($consulcontratantes);
	
## PERSONA JURIDICA. ##
$consuljuridica = mysql_query('SELECT DISTINCT contratantesxacto.kardex, contratantesxacto.idtipoacto, contratantesxacto.idcontratante,
cliente2.razonsocial, (CASE WHEN ISNULL(nacionalidades.descripcion) THEN "23" ELSE nacionalidades.descripcion END) AS "nacionalidad", tipodocumento.destipdoc AS "tipo_docu",
cliente2.numdoc, cliente2.domfiscal AS "direccion",  ubigeo.nomdis AS "Distrito" , cliente2.actmunicipal, cliente2.tipper, cliente2.numpartida
FROM contratantesxacto
INNER JOIN cliente2 ON cliente2.idcontratante = contratantesxacto.idcontratante
LEFT OUTER JOIN nacionalidades ON nacionalidades.idnacionalidad = cliente2.nacionalidad
INNER JOIN tipodocumento ON tipodocumento.idtipdoc = cliente2.idtipdoc
left outer join ubigeo ON ubigeo.coddis = cliente2.idubigeo
WHERE contratantesxacto.kardex =  "'.$num_kardex.'" AND cliente2.tipper="J" ', $conn) or die(mysql_error());
##WHERE contratantesxacto.kardex =  "'.$num_kardex.'" AND contratantesxacto.idtipoacto = "'.$idtipoacto.'" ', $conn) or die(mysql_error());

	//$rowjuridica =  mysql_fetch_array($consuljuridica);
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
	$num_minuta       = $rowcabecera1[2];
	$num_reg          = "1"; #$rowcabecera1[2];
	
// # cabecera II
	$contrato         = strtoupper($rowcabecera2[1]);
	$referencia       =strtoupper($rowcabecera2[0]);

// # Contratantes 
	$nom_contratante  = $rowcontratantes[3];
	$nacionalidad     = $rowcontratantes[4];
	$numdoc_contrat   = $rowcontratantes[6];
	$ocupacion        = $rowcontratantes[7];
	$est_civil        = $rowcontratantes[8];
	$domicilio        = $rowcontratantes[9];
	$nom_distrito     = $rowcontratantes[10];
	$cont_sexo        = $rowcontratantes[11];

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
	$folioini         = $rowfolio[1];
	$foliofin         = $rowfolio[0];


//# referencia_contratantes

	$referencia_contratantes= " ";

################################################################################################################################
############################################## DEFINICION Y CARGA DE LOS INSERTOS ##############################################

$diskinserto              = "C:/";
$mainfile_inserto         = "insertos/";
#Se escoge nombre archivo:
$archivo_inserto = $num_kardex.".docx"; 

$ruta_inserto =  $diskinserto.$mainfile_inserto;

$fp = fopen($ruta.$archivo, 'r'); 
$contents = fread($fp, filesize($ruta.$archivo)); 

######## WORD ##########
$archivo_ruta = $ruta.$archivo;

##### BUSQUEDA DE LOS INSERTOS
$busca_insertos = mysql_query('SELECT insertos FROM kardex WHERE kardex.kardex = "'.$num_kardex.'" ', $conn) or die(mysql_error());
$row_inserto    =  mysql_fetch_array($busca_insertos);

# Guarda los insertos	
$values = explode(",",$row_inserto[0]);	

# Cuenta los insertos:
$num_insertos = substr_count($row_inserto[0], ',');

# Pushea el array con los Insertos
$todos_insertos = array();

for($i=0;$i<=$num_insertos-1;$i++)
	{
		trim($values[$i].".docx");
		$fp = fopen($ruta.$archivo, 'r'); 
		$contents_inserto  = fread($fp, filesize($ruta_inserto.trim($values[$i]).".docx")); 
		$contents2_inserto = strtoupper(utf8_decode(docx2text($ruta_inserto.trim($values[$i]).".docx")));
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
	if($data_insertar == "")
	{$data_insertar = "";}
############################################## DEFINICION Y CARGA DE LOS INSERTOS ##############################################
################################################################################################################################

// Evalua el numero de datos:

$dataContratantes = array();
$dataContratantes2 = array();

// Evalua multiplicidad de representantes para una empresa
$dataRepresentantes = array();

//opcion 2:


for($i = 0; $i <= $numcontratantes-1; $i++)
	{
		
	// PEGAR PERSONA JURIDICA	
		
		$rowcontratantes =  mysql_fetch_array($consulcontratantes5);
		$rowjuridica     =  mysql_fetch_array($consuljuridica);

		#busca conyuge:
		$consulconyuge1 = mysql_query('SELECT cliente.nombre AS "conyuge" FROM cliente WHERE idcliente = (SELECT cliente2.conyuge FROM cliente2 WHERE idcontratante =  "'.$rowcontratantes[2].'") ', $conn) or die(mysql_error());
	    $rowconyuge1 = mysql_fetch_array($consulconyuge1);

		//evalua conyuge:
		if($rowconyuge1 != "")
		{
			$nom_conyuge      = utf8_decode($rowconyuge1[0]);
			$formaconyuge     = "CON ".utf8_decode($rowconyuge1[0]);
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
			$evalsexo = utf8_decode("");
		}
		
		//evalua ocupacion:
		if($rowcontratantes[7]=="")
		{
			$evalocupacion = "NO ESPECIFICA";	
		}
		else if($rowcontratantes[7]!="")
		{
			$evalocupacion = utf8_decode($rowcontratantes[7]);	
		}
		
		 $consulrepresentante = mysql_query('SELECT cliente2.nombre, nacionalidades.descripcion AS "nacionalidad", tipodocumento.destipdoc AS "tipo_docu", cliente2.numdoc,
UPPER(cliente2.detaprofesion) AS "Ocupacion", tipoestacivil.desestcivil AS "ecivil",
cliente2.direccion,  (CASE WHEN ISNULL(ubigeo.nomdis) THEN "" ELSE ubigeo.nomdis  END) AS "Distrito"
			FROM contratantes
			INNER JOIN cliente2 ON cliente2.idcontratante = contratantes.idcontratante
			INNER JOIN nacionalidades ON nacionalidades.idnacionalidad = cliente2.nacionalidad
			INNER JOIN tipodocumento ON tipodocumento.idtipdoc = cliente2.idtipdoc
			LEFT OUTER JOIN tipoestacivil ON tipoestacivil.idestcivil = cliente2.idestcivil
			LEFT OUTER JOIN ubigeo ON ubigeo.coddis = cliente2.idubigeo
			WHERE contratantes.idcontratanterp =  "'.$rowjuridica[2].'" ', $conn) or die(mysql_error());
			# (CASE WHEN(cliente2.idprofesion<>"0") THEN profesiones.desprofesion ELSE ""  END) --> profesiones
			# LEFT OUTER JOIN profesiones ON profesiones.idprofesion = cliente2.idprofesion
			
		if($rowjuridica[10]=='J')
		{
			$evaljuridica = utf8_decode($rowjuridica[2]);

			// EVALUA SI FIRMA O NO FIRMA.
			if($rowcontratantes[13]=='SI')
				{
					$eval_firma = $rowcontratantes[3];	
				}
				else if($rowcontratantes[13]=='NO')
					{
						$eval_firma = "";		
					}
			
		     $i = 0;
		while($rowrepresentante = mysql_fetch_array($consulrepresentante))
			{
			
			if($i > 0){$evalseguim ="";}else {$evalseguim = "";}
				
		$dataRepresentantes[] = array('nom_contratante' => utf8_decode($evalseguim)." ".strtoupper(utf8_decode($rowrepresentante[0]))." QUIEN MANIFIESTA SER DE NACIONALIDAD ".strtoupper($rowrepresentante[1]).", DE ESTADO CIVIL ".strtoupper($rowrepresentante[5]).", DE OCUPACION Y/O PROFESION ".strtoupper(utf8_decode($rowrepresentante[4]))." , DOMICILIAR EN ".strtoupper(utf8_decode($rowrepresentante[6])).", DISTRITO DE ".strtoupper(utf8_decode($rowrepresentante[7])).", PROVINCIA Y DEPARTAMENTO DE LIMA, SE IDENTIFICA CON DOCUMENTO NACIONAL DE IDENTIDAD NUMERO ".strtoupper(utf8_decode($rowrepresentante[3])).strtoupper(utf8_decode(", Y DECLARA QUE PROCEDE EN REPRESENTACIÓN DE ")).strtoupper($rowjuridica[3])." CON REGISTRO UNICO DE CONTRIBUYENTE ".strtoupper($rowjuridica[6]).strtoupper(utf8_decode(", CON FACULTADES INSCRITAS EN LA PARTIDA NUMERO ")).strtoupper($rowjuridica[11])." DEL REGISTRO DE PERSONAS JURIDICAS DE LIMA ", 'nom_firma'=>strtoupper(utf8_decode($rowrepresentante[0])).chr(13).chr(10)." POR ".strtoupper($rowjuridica[3]));
			//echo $rowrepresentante[0]." | ";
			    $i++;
			
			 $eval_mostrar_persona = strtoupper($rowjuridica[3]) . " REPRESENTADA POR " . strtoupper(utf8_decode($rowrepresentante[0]));
			}

		}
	### AQUI IBA PERSONAS NATURALES	
		
	}
#############################################################################################################################################################

## EVALUA AL REPRESENTANTE:
		$consultrepre = mysql_query('SELECT contratantes.idcontratante FROM contratantes WHERE contratantes.kardex = "'.$num_kardex.'" AND contratantes.tiporepresentacion != "1"', $conn) or die(mysql_error());

			
for($i = 0; $i <= $numcontratantes-1; $i++)
	{
		
		$rowcontratantes = mysql_fetch_array($consulcontratantes);
		$rowrept =  mysql_fetch_array($consultrepre);	
		
		#busca conyuge:
		$consulconyuge1 = mysql_query('SELECT cliente.nombre AS "conyuge" FROM cliente WHERE idcliente = (SELECT cliente2.conyuge FROM cliente2 WHERE idcontratante =  "'.$rowcontratantes[2].'") ', $conn) or die(mysql_error());
	    $rowconyuge1 = mysql_fetch_array($consulconyuge1);
		//evalua conyuge:
		if($rowconyuge1 != "")
		{
			$nom_conyuge      = strtoupper(utf8_decode($rowconyuge1[0]));
			$formaconyuge     = "CON ".strtoupper(utf8_decode($rowconyuge1[0]));
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
			$evalsexo = utf8_decode("");
		}
		
		//evalua ocupacion:
		if($rowcontratantes[7]=="")
		{
			$evalocupacion = "NO ESPECIFICA";	
		}
		else if($rowcontratantes[7]!="")
		{
			$evalocupacion = utf8_decode($rowcontratantes[7]);	
		}

		if($rowcontratantes[12]=='N')
		{
		$evalua_rept = utf8_decode($rowrept[0]);
		

		$evalrepresentante = $rowcontratantes[2];
		
			if(($evalrepresentante == $evalua_rept) && ($evalua_rept != ""))
			{
				#
				$eval_firma_natural = "";
				if($rowcontratantes[13]=="SI")
					{
						$eval_firma_natural =  strtoupper(utf8_decode($rowcontratantes[3]))	;
					}

				$dataContratantes2[] = array('nom_contratante'=>$evalsexo." ".strtoupper(utf8_decode($rowcontratantes[3])).", QUIEN MANIFIESTA SER DE NACIONALIDAD ".$rowcontratantes[4].", DE ESTADO CIVIL ".$rowcontratantes[8]." ".utf8_decode($formaconyuge).", DE OCUPACION Y/O PROFESION ".utf8_decode($evalocupacion).", DOMICILIAR EN ".utf8_decode($rowcontratantes[9]).", DISTRITO DE ".utf8_decode($rowcontratantes[10]).", PROVINCIA Y DEPARTAMENTO DE LIMA SE IDENTIFICA CON DOCUMENTO NACIONAL DE IDENTIDAD NUMERO ".$rowcontratantes[6]." Y DECLARA QUE PROCEDE POR DERECHO PROPIO ", 'nom_firma'=>$eval_firma_natural);
				## -> .strtoupper($rowrepderecho[2])." ".strtoupper($rowrepderecho[4])
			
			}  

		}	
	
	}
	
// Plantilla - Contratantes a imprimir
$contratante = utf8_decode($nom_contratante).", QUIEN MANIFIESTA SER DE NACIONALIDAD ".utf8_decode($nacionalidad).", DE ESTADO CIVIL ".$est_civil." ".utf8_decode($formaconyuge).", DE OCUPACION Y/O PROFESION ".$ocupacion.", DOMICILIAR EN ".utf8_decode($domicilio).", DISTRITO DE ".utf8_decode($nom_distrito).", PROVINCIA Y DEPARTAMENTO DE LIMA, SE IDENTIFICA CON DOCUMENTO NACIONAL DE IDENTIDAD NUMERO ".utf8_decode($numdoc_contrat). " Y DECLARA QUE PROCEDE POR PROPIO DERECHO ";

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<p align="center"><strong>ESCRITURA PUBLICA DE COMPRA VENTA DE INMUEBLE /</strong></p>
<p><strong>INTRODUCCIÓN:</strong> EN LA CIUDAD DE LIMA, CAPITAL DE LA REPUBLICA DEL  PERU, A LOS  <strong>DOCE DIAS DE DICIEMBRE DE  2013 ,</strong> <strong>aa aa</strong><strong>, ABOGADO-NOTARIO DE  LIMA, </strong>CON OFICIO NOTARIAL EN<strong>  11, </strong>DISTRITO DE <strong> 11 </strong>EXTIENDO EL PRESENTE  INSTRUMENTO PUBLICO NOTARIAL EN MI REGISTRO DE ESCRITURAS PUBLICAS EN EL QUE  COMPARECEN:                                                                                                    <br />
  VELAZQUEZ  HERRERA, LUIS , QUIEN MANIFIESTA SER DE NACIONALIDAD PERUANA, DE ESTADO CIVIL  SOLTERO , DE OCUPACION Y/O PROFESION INGENIERO DE SISTEMAS, DOMICILIAR EN LAS  FLORES 166, DISTRITO DE LINCE, PROVINCIA Y DEPARTAMENTO DE LIMA SE IDENTIFICA  CON DOCUMENTO NACIONAL DE IDENTIDAD NUMERO 07639534 Y DECLARA QUE PROCEDE POR  DERECHO PROPIO                           </p>
<p>DOY FE DE LA CAPACIDAD, LIBERTAD Y CONOCIMIENTO CON QUE  SE OBLIGAN QUIENES COMPARECEN, ASI COMO DE HABERLES IDENTIFICADO, INTELIGENTES  EN EL IDIOMA CASTELLANO Y ME ENTREGAN UNA MINUTA FIRMADA Y AUTORIZADA POR  ABOGADO PARA QUE ELEVE SU CONTENIDO A ESCRITURA PUBLICA, LA MISMA QUE ARCHIVO  EN MI LEGAJO RESPECTIVO CON EL NUMERO DE ORDEN CORRESPONDIENTE Y CUYO TENOR  LITERAL ES EL SIGUIENTE:                                                                                                                                                  <br />
  MINUTA</p>
</body>
</html>