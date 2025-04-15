<?php 

//PRIMERO UNE PROYECTO CON MINUTA

$extensiones=array(".docx",".doc");

require_once 'Phpdocx/Create/CreateDocx.inc';

$num_kardex       	= $_REQUEST["num_kardex"];



$rutaRaiz="C://Doc_Generados/templates/";
$header= $rutaRaiz."plantilla_protocolar_genericaUnaParteHeader.docx";
$footer=$rutaRaiz."plantilla_protocolar_genericaUnaParteFooter.docx";

//$rutaMinuta="/home/notarysoft/Minutas/__MIN__".$num_kardex.".docx";
$rutaMinuta="C://Minutas/"."__MIN__".$num_kardex.".docx";
$rutaMinuta2="C://Minutas/"."__MIN__".$num_kardex.".doc";

$rutaFinalProyecto=$rutaRaiz.'plantilla_protocolar_Proyecto.docx';
if(!file_exists($rutaMinuta) and !file_exists($rutaMinuta2)  ){
	echo "Falta Documento de Minuta, adjunte uno, de preferencia de extension doc o docx !!";
	return;
}

$txtListContratantes=array();
$arrConstancia=array();
$constancia_conclusion="";

	session_start(); 
	## 1.-CARGARMOS LAS LIBRERIAS
	include('../conexion2.php');
	include('../conexion.php');
	include('../extraprotocolares/view/funciones.php');
	include('../includes/tbs_class.php');
	include('../includes/tbs_plugin_opentbs.php');
	include('../includes/ClaseLetras.class.php');
	include('fecha_letra.php');


     


	## 2.-RECIBIMOS EL KARDEX Y LO CARGAMOS
	
	$sql_idtipacto		= mysqli_query($conn_i,"select codactos from kardex where kardex='$num_kardex'") or die(mysqli_error($conn_i)."ERROR ".$sql);
	$row_idtipacto		= mysqli_fetch_array($sql_idtipacto);	
	$idtipacto       	= $row_idtipacto["codactos"];	
	## 3.-EXTENSION DE LA PLANTILLA SEGUN CONFIGURACION
	
	$titulo="";
	/*23 ES PROYECTO, 15 ES KARDEX, POR DEFECTO ES 23. LUEGO TOMAMOS EL 15 PARA DECIRLE QUE ES TIPOKARDEX DE TODAS FORMAS.*/ 
	if($_REQUEST["tipo"]==23){
		$tipo = 15;
		$tipoGuardar = 23;
	}
	//CARPETA PARA GUARDAR EL DOCUMENTO
	
	$template=$rutaFinalProyecto;
	## 5.-CREAMOS EL OBJETO DONDE GENERAREMOS EL DOCUMENTO	
	$TBS = new clsTinyButStrong; 
	$TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN);
	$suffix = '';
	$debug  = '';
	## 6.-VALIDACION DE LA EXISTENCIA DE PLANTILLA
	$x = pathinfo($template);
	$template_ext  = $x['extension'];
	$template_name = $x['basename'];		
	if (!file_exists($template)) exit("Ruta o nombre de la plantilla definido Incorrectamente.".$template);
	## 7.-DEFINIMOS DE VARIABLES A USAR	
	//FECHAS
	$fecha 		= new ClaseNumeroLetra();
	$fec_firma	= new ClaseNumeroLetra();
	$dia  		= $fecha->fun_fecha_dia(); 
	$mes  		= $fecha->fun_fecha_mes();
	$anio 		= $fecha->fun_fecha_anio();
	// DOCE DE SETIEMBRE DEL DOS MIL DIECISEIS
	$fec_letra  = $fecha->fun_fech_letras(date("Y/m/d"));
	// DOCE(12) DIAS DEL MES DE SEPTIEMBRE DEL AÑO DOS MIL DIECISEIS(2016)
	$fec_letras1 =strtoupper(convierte_numtildes(fechaALetras1(date("d/m/Y"))));
	// DOCE DIAS DEL MES DE SEPTIEMBRE DEL AÑO DOS MIL DIECISEIS
	$fec_letras =strtoupper(convierte_numtildes(fechaALetras(date("d/m/Y"))));
	// DOCE(12) DEL MES DE SEPTIEMBRE DEL DOS MIL DIECISEIS (2016)
	$fec_letras2=strtoupper(utf8_decode(str_replace("X","ñ",fechaALetras3(date("d/m/Y")))));
	// DOCE(12) DE SEPTIEMBRE DEL DOS MIL DIECISEIS (2016)
	$fec_letras3=strtoupper(utf8_decode(str_replace("X","ñ",fechaALetras2(date("d/m/Y")))));
	// 12 DE SETIEMBRE DEL 2016
	$fec_letras4= $fecha->fun_fech_corta(date("Y/m/d"));
	// DOCE DIAS DE SETIEMBRE DE 2016
	$fec_letras5= $fecha->fun_fech_comple(date("Y/m/d"));	
	// 12 DE SETIEMBRE DEL 2016
	$fec_letras6= $fecha->fun_fech_corta_3(date("Y/m/d"));
	// DOCE DIAS DEL MES DE SEPTIEMBRE DEL AÑO DOS MIL DIECISEIS
	$fec_letras7 =strtoupper(convierte_numtildes(fechaALetras7(date("d/m/Y"))));	
	
	$FEC_LETRAS=$fec_letras1;	
	//DATOS DEL NOTARIO :
	$busnumcarta = 		"SELECT CONCAT(confinotario.nombre, ' ', confinotario.apellido ) AS 'NOTARIO',
						 confinotario.direccion, confinotario.distrito, confinotario.provincia, confinotario.departamento,
						 confinotario.correo , confinotario.telefono, confinotario.abrev, confinotario.ruc
						 FROM confinotario";
	$numcartabus 		= mysqli_query($conn_i,$busnumcarta) or die(mysqli_error($conn_i)."ERROR ".$sql);
	$rownum				= mysqli_fetch_array($numcartabus);
	$NOMBRE_NOTARIO	 	= strtoupper(utf8_decode($rownum["NOTARIO"]));	
	$DIR_NOTARIO	  	= strtoupper(utf8_decode($rownum["direccion"]));
	$DIST_NOTARIO  		= strtoupper(utf8_decode($rownum["distrito"]));
	$PROV_NOTARIO  		= strtoupper(utf8_decode($rownum["provincia"]));
	$DEP_NOTARIO  		= strtoupper(utf8_decode($rownum["departamento"]));	
	$TELEF_NOTARIO 		= strtoupper(utf8_decode($rownum["telefono"]));
	$CORREO_NOTARIO		= strtoupper(utf8_decode($rownum["correo"]));	
	$ABREV_NOTARIO		= strtoupper(utf8_decode($rownum["abrev"]));
	$RUC_NOTARIO		= strtoupper(utf8_decode($rownum["ruc"]));
	$DNI_NOTARIO		= strtoupper(utf8_decode(substr($rownum["ruc"],2,8)));	
	$NOMBRE_NOTARIO_MIN	= strtolower(ucwords(utf8_decode($rownum["NOTARIO"])));
	$DIR_NOTARIO_MIN	= strtolower(ucwords(utf8_decode($rownum["direccion"])));
	$DIST_NOTARIO_MIN	= strtolower(ucwords(utf8_decode($rownum["distrito"])));
	$PROV_NOTARIO_MIN	= strtolower(ucwords(utf8_decode($rownum["provincia"])));
	$DEP_NOTARIO_MIN	= strtolower(ucwords(utf8_decode($rownum["departamento"])));
	$ABREV_NOTARIO_MIN	= strtolower(ucwords(utf8_decode($rownum["abrev"])));	
	
	
	## 9.-DATOS DEL PATRIMONIAL
	$cosulpreciovehi = mysqli_query($conn_i,'
	SELECT patrimonial.importetrans AS "precio" , patrimonial.idmon AS "moneda",
	fpago_uif.descripcion AS "medio_pago", monedas.simbolo, mediospago.desmpagos, patrimonial.`exhibiomp`, patrimonial.`idoppago` 
	FROM patrimonial
	INNER JOIN fpago_uif ON fpago_uif.id_fpago = patrimonial.fpago
	INNER JOIN monedas ON monedas.idmon = patrimonial.idmon
	LEFT JOIN detallemediopago ON patrimonial.kardex = detallemediopago.kardex
	LEFT JOIN mediospago ON detallemediopago.codmepag = mediospago.codmepag
	WHERE patrimonial.kardex = "'.$num_kardex.'" LIMIT 0,1 ') or die(mysqli_error($conn_i)."ERROR ".$sql);
	$rowprevehi = mysqli_fetch_array($cosulpreciovehi);
	$numprevehi = mysqli_num_rows($cosulpreciovehi);
	## 10.-DATOS DEL KARDEX
	$consulcabecera1 = mysqli_query($conn_i,'
									SELECT kardex.numescritura as "escritura", kardex.kardex as "num_kardex",
									1 as "conMinuta",
									kardex.txa_minuta as "registro" ,
									"" as  "fechaGenerado",
									kardex.idtipkar,
									 kardex.fechaconclusion as "fechaconclusion",
									kardex.numminuta as "numminuta" ,`FN_ONLYNUM`(kardex.kardex) AS numero,kardex.kardexconexo
									FROM kardex 
									WHERE kardex.kardex =  "'.$num_kardex.'" ') or die(mysqli_error($conn_i)."ERROR ".$sql);
	$rowcabecera1 	 = mysqli_fetch_array($consulcabecera1);
	$consulcabecera2 = mysqli_query($conn_i,'
									SELECT kardex.referencia AS "referencia", kardex.contrato AS "contrato" 
									FROM kardex 
									WHERE kardex.kardex =   "'.$num_kardex.'" ') or die(mysqli_error($conn_i)."ERROR ".$sql);
	$rowcabecera2 	 = mysqli_fetch_array($consulcabecera2);
	$consulfolio 	 = mysqli_query($conn_i,'
									SELECT kardex.folioini, kardex.foliofin, kardex.papelini, kardex.papelfin	
									FROM kardex 
									WHERE kardex.kardex = "'.$num_kardex.'" ') or die(mysqli_error($conn_i)."ERROR ".$sql);
	$rowfolio = mysqli_fetch_array($consulfolio);	
	## 11.-CONTRATANTES
	//PARTE 1 ORDENANTE / TRANSFERNTE ETC
	$idtipoacto=$_REQUEST['idtipoacto'];
	$vidtipoacto=substr($idtipoacto,0,3);
	//and contratantesxacto.idtipoacto='".$vidtipoacto."'
	$contratantesnew1=mysqli_query($conn_i,"
	SELECT 
		CONCAT(
		(
		  CASE
			WHEN cliente2.`tipper` = 'N' 
			AND cliente2.`sexo` = 'F' 
			THEN CONVERT('', CHAR CHARACTER SET utf8) 
			WHEN cliente2.`tipper` = 'N' 
			AND cliente2.`sexo` = 'M' 
			THEN '' 
			WHEN cliente2.`tipper` = 'N' 
			AND cliente2.`sexo` = '' 
			THEN '' 
		  END
		),
		IFNULL(cliente2.`prinom`, ''),
		' ',
		IFNULL(cliente2.`segnom`, ''),
		' ',
		IFNULL(cliente2.`apepat`, ''),
		' ',
		IFNULL(cliente2.`apemat`, ''),
		IFNULL(cliente2.razonsocial, '')
	  ) AS cliente,
	  cliente2.tipper,
	  cliente2.sexo,
	  cliente2.razonsocial,
	  contratantesxacto.uif,
	  actocondicion.condicion ,contratantesxacto.uif,actocondicion.condicion
	FROM contratantesxacto 
	INNER JOIN actocondicion ON `contratantesxacto`.`idcondicion`=`actocondicion`.`idcondicion`
	INNER JOIN cliente2 ON cliente2.`idcontratante`=`contratantesxacto`.`idcontratante`
	INNER JOIN contratantes cn on cliente2.idcontratante= cn.idcontratante
	WHERE contratantesxacto.kardex='".$num_kardex."'   
	
	and (actocondicion.parte_generacion='1')
	GROUP BY contratantesxacto.`idcontratante`") or die(mysqli_error($conn_i)."ERROR ".$sql);
	//PARTE 2 A FAVOR / ADQUIRENTE ETC


	//and contratantesxacto.idtipoacto='".$vidtipoacto."'
	$contratantesnew2=mysqli_query($conn_i,"
	SELECT 
		CONCAT(
		(
		  CASE
			WHEN cliente2.`tipper` = 'N' 
			AND cliente2.`sexo` = 'F' 
			THEN CONVERT('', CHAR CHARACTER SET utf8) 
			WHEN cliente2.`tipper` = 'N' 
			AND cliente2.`sexo` = 'M' 
			THEN '' 
			WHEN cliente2.`tipper` = 'N' 
			AND cliente2.`sexo` = '' 
			THEN '' 
		  END
		),
		IFNULL(cliente2.`prinom`, ''),
		' ',
		IFNULL(cliente2.`segnom`, ''),
		' ',
		IFNULL(cliente2.`apepat`, ''),
		' ',
		IFNULL(cliente2.`apemat`, ''),
		IFNULL(cliente2.razonsocial, '')
	  ) AS cliente,

	  cliente2.tipper,
	  cliente2.sexo,
	  cliente2.razonsocial,
	  contratantesxacto.uif,actocondicion.condicion
	FROM contratantesxacto 
	INNER JOIN actocondicion ON `contratantesxacto`.`idcondicion`=`actocondicion`.`idcondicion`
	INNER JOIN cliente2 ON cliente2.`idcontratante`=`contratantesxacto`.`idcontratante`
	INNER JOIN contratantes cn on cliente2.idcontratante= cn.idcontratante
	WHERE contratantesxacto.kardex='".$num_kardex."'
	 and (actocondicion.parte_generacion='2')
	GROUP BY contratantesxacto.`idcontratante`") or die(mysqli_error($conn_i)."ERROR ".$sql);

		$contratantesnew3=mysqli_query($conn_i,"
	SELECT 
		CONCAT(
		(
		  CASE
			WHEN cliente2.`tipper` = 'N' 
			AND cliente2.`sexo` = 'F' 
			THEN CONVERT('', CHAR CHARACTER SET utf8) 
			WHEN cliente2.`tipper` = 'N' 
			AND cliente2.`sexo` = 'M' 
			THEN '' 
			WHEN cliente2.`tipper` = 'N' 
			AND cliente2.`sexo` = '' 
			THEN '' 
		  END
		),
		IFNULL(cliente2.`prinom`, ''),
		' ',
		IFNULL(cliente2.`segnom`, ''),
		' ',
		IFNULL(cliente2.`apepat`, ''),
		' ',
		IFNULL(cliente2.`apemat`, ''),
		IFNULL(cliente2.razonsocial, '')
	  ) AS cliente,

	  cliente2.tipper,
	  cliente2.sexo,
	  cliente2.razonsocial,
	  contratantesxacto.uif,actocondicion.condicion
	FROM contratantesxacto 
	INNER JOIN actocondicion ON `contratantesxacto`.`idcondicion`=`actocondicion`.`idcondicion`
	INNER JOIN cliente2 ON cliente2.`idcontratante`=`contratantesxacto`.`idcontratante`
	INNER JOIN contratantes cn on cliente2.idcontratante= cn.idcontratante
	WHERE contratantesxacto.kardex='".$num_kardex."'
	
	 and actocondicion.condicion='INTERVINIENTE'
	GROUP BY contratantesxacto.`idcontratante`") or die(mysqli_error($conn_i)."ERROR ".$sql);

	$c1=mysqli_num_rows($contratantesnew1);
	
	$c2=mysqli_num_rows($contratantesnew2);
	

	if($c1==1 && $c2==1){

		$v1=strtoupper("El vendedor");
		$otorga=strtoupper("OTORGA");
		$v2=strtoupper("El comprador");
		$v22=strtoupper("el adquirente");
		$v3=strtoupper("El transferente y el adquirente ");
		$v4=strtoupper("transferente y el adquirente ");
		$declara1=strtoupper("declara");
		$declara2=strtoupper("declara");
		$num_trans=strtoupper("TRANSFERENTE");
		$transfieren=strtoupper("transfiere");
		$propietario=strtoupper("es propietario");
		$num_adq=strtoupper("ADQUIRENTE");	
		$conocen=strtoupper("conoce");
		$advierten=strtoupper("advierte");
		$intervienen=strtoupper("Intervienen");
		$dat=strtoupper("da");
		$daa=strtoupper("da");
		$reciben=strtoupper("recibe");
		$han=strtoupper("ha");
		$res=strtoupper("responsabiliza");
		$compradq=strtoupper("AL COMPRADOR / ADQUIRENTE");
		$manifiesta=strtoupper(utf8_decode("HABER IDENTIFICADO A LOS INTERVINIENTES CON LOS DOCUMENTOS ANTES INDICADOS, QUE SON MAYORES DE EDAD, INTELIGENTES EN EL IDIOMA ESPAÑOL; QUE PROCEDEN CON CAPACIDAD, LIBERTAD Y CONOCIMIENTO SUFICIENTE PARA OBLIGARSE, QUE LOS DATOS PERSONALES Y ESTADO CIVIL QUE ANTECEDEN SON VERDADEROS, QUE NO TIENEN RESTRICCIONES PARA EFECTUAR EL PRESENTE DOCUMENTO Y QUE ME MANIFESTAN SU VOLUNTAD DE CELEBRAR LA PRESENTE RATIFICACION DE TRANSFERENCIA VEHICULAR"));
		$manifiesta_abajo=strtoupper(utf8_decode("QUE LOS COMPARECIENTES LUEGO DE HABER LEIDO ESTE INSTRUMENTO Y DE HABERLES ADVERTIDO SOBRE SU OBJETO, SE AFIRMA Y RATIFICA EN SU CONTENIDO PROCEDIENDO A FIRMARLO"));
		$exhiben_dni=strtoupper(utf8_decode("EXHIBEN SU DNI Y SON IDENTIFICADOS MEDIANTE IDENTIFICACION BIOMETRICA DE HUELLAS DACTILARES - RENIEC"));

	}else if($c1==1 && $c2>1){

		$v1=strtoupper("El vendedor");
		$otorga=strtoupper("OTORGA");
		$v2=strtoupper("Los compradores");
		$v22=strtoupper("los adquirentes");
		$v3=strtoupper("El transferente y los adquirentes ");
		$v4=strtoupper("transferente y los adquirentes ");
		$declara1=strtoupper("declara");
		$declara2=strtoupper("declaran");
		$num_trans=strtoupper("TRANSFERENTE");
		$transfieren=strtoupper("transfiere");
		$propietario=strtoupper("es propietario");
		$num_adq=strtoupper("ADQUIRENTES");
		$conocen=strtoupper("conocen");
		$advierten=strtoupper("advierten");
		$dat=strtoupper("da");
		$intervienen=strtoupper("Intervienen");
		$daa=strtoupper("dan");
		$reciben=strtoupper("reciben");
		$han=strtoupper("han");
		$res=strtoupper("responsabilizan");
		$compradq=strtoupper("A LOS COMPRADORES / ADQUIRENTES");
		$manifiesta=strtoupper(utf8_decode("HABER IDENTIFICADO A LOS INTERVINIENTES CON LOS DOCUMENTOS ANTES INDICADOS, QUE SON MAYORES DE EDAD, INTELIGENTES EN EL IDIOMA ESPAÑOL; QUE PROCEDEN CON CAPACIDAD, LIBERTAD Y CONOCIMIENTO SUFICIENTE PARA OBLIGARSE, QUE LOS DATOS PERSONALES Y ESTADO CIVIL QUE ANTECEDEN SON VERDADEROS, QUE NO TIENEN RESTRICCIONES PARA EFECTUAR EL PRESENTE DOCUMENTO Y QUE ME MANIFESTAN SU VOLUNTAD DE CELEBRAR LA PRESENTE RATIFICACION DE TRANSFERENCIA VEHICULAR"));
		$manifiesta_abajo=strtoupper(utf8_decode("QUE LOS COMPARECIENTES LUEGO DE HABER LEIDO ESTE INSTRUMENTO Y DE HABERLES ADVERTIDO SOBRE SU OBJETO, SE AFIRMA Y RATIFICA EN SU CONTENIDO PROCEDIENDO A FIRMARLO"));
		$exhiben_dni=strtoupper(utf8_decode("EXHIBEN SU DNI Y SON IDENTIFICADOS MEDIANTE IDENTIFICACION BIOMETRICA DE HUELLAS DACTILARES - RENIEC"));


	}else if($c1>1 && $c2==1){
		
		$v1=strtoupper("los vendedores");
		$otorga=strtoupper("OTORGAN");
		$v2=strtoupper("El comprador");
		$v22=strtoupper("el adquirente");
		$v3=strtoupper("Los transferentes y el adquirente ");
		$v4=strtoupper("transferentes y el adquirente ");
		$declara1=strtoupper("declaran");
		$declara2=strtoupper("declara");
		$num_trans=strtoupper("TRANSFERENTES");
		$transfieren=strtoupper("transfieren");
		$propietario=strtoupper("son propietarios");
		$num_adq=strtoupper("ADQUIRENTE");
		$conocen=strtoupper("conoce");
		$advierten=strtoupper("advierte");
		$dat=strtoupper("dan");
		$daa=strtoupper("da");
		$reciben=strtoupper("recibe");
		$han=strtoupper("ha");
		$res=strtoupper("responsabiliza");
		$intervienen=strtoupper("Intervienen");
		$compradq=strtoupper("AL COMPRADOR / ADQUIRENTE");
		$manifiesta=strtoupper(utf8_decode("HABER IDENTIFICADO A LOS INTERVINIENTES CON LOS DOCUMENTOS ANTES INDICADOS, QUE SON MAYORES DE EDAD, INTELIGENTES EN EL IDIOMA ESPAÑOL; QUE PROCEDEN CON CAPACIDAD, LIBERTAD Y CONOCIMIENTO SUFICIENTE PARA OBLIGARSE, QUE LOS DATOS PERSONALES Y ESTADO CIVIL QUE ANTECEDEN SON VERDADEROS, QUE NO TIENEN RESTRICCIONES PARA EFECTUAR EL PRESENTE DOCUMENTO Y QUE ME MANIFESTAN SU VOLUNTAD DE CELEBRAR LA PRESENTE RATIFICACION DE TRANSFERENCIA VEHICULAR"));
		$manifiesta_abajo=strtoupper(utf8_decode("QUE LOS COMPARECIENTES LUEGO DE HABER LEIDO ESTE INSTRUMENTO Y DE HABERLES ADVERTIDO SOBRE SU OBJETO, SE AFIRMA Y RATIFICA EN SU CONTENIDO PROCEDIENDO A FIRMARLO"));
		$exhiben_dni=strtoupper(utf8_decode("EXHIBEN SU DNI Y SON IDENTIFICADOS MEDIANTE IDENTIFICACION BIOMETRICA DE HUELLAS DACTILARES - RENIEC"));
	}else if($c1>1 && $c2>1){
		
		$v1=strtoupper("Los vendedores");
		$otorga=strtoupper("OTORGAN");
		$v2=strtoupper("Los compradores");
		$v22=strtoupper("los adquirentes");
		$v3=strtoupper("Los transferentes y los adquirentes ");
		$v4=strtoupper("transferentes y los adquirentes ");
		$declara1=strtoupper("declaran");
		$declara2=strtoupper("declaran");
		$num_trans=strtoupper("TRANSFERENTES");
		$transfieren=strtoupper("transfieren");
		$propietario=strtoupper("son propietarios");
		$conocen=strtoupper("conocen");
		$advierten=strtoupper("advierten");
		$num_adq=strtoupper("ADQUIRENTES");
		$dat=strtoupper("dan");
		$daa=strtoupper("dan");
		$reciben=strtoupper("reciben");
		$han=strtoupper("han");
		$res=strtoupper("responsabilizan");
		$intervienen=strtoupper("Intervienen");
		$compradq=strtoupper("A LOS COMPRADORES / ADQUIRENTES");
		$manifiesta=strtoupper(utf8_decode("HABER IDENTIFICADO A LOS INTERVINIENTES CON LOS DOCUMENTOS ANTES INDICADOS, QUE SON MAYORES DE EDAD, INTELIGENTES EN EL IDIOMA ESPAÑOL; QUE PROCEDEN CON CAPACIDAD, LIBERTAD Y CONOCIMIENTO SUFICIENTE PARA OBLIGARSE, QUE LOS DATOS PERSONALES Y ESTADO CIVIL QUE ANTECEDEN SON VERDADEROS, QUE NO TIENEN RESTRICCIONES PARA EFECTUAR EL PRESENTE DOCUMENTO Y QUE ME MANIFESTAN SU VOLUNTAD DE CELEBRAR LA PRESENTE RATIFICACION DE TRANSFERENCIA VEHICULAR"));
		$manifiesta_abajo=strtoupper(utf8_decode("QUE LOS COMPARECIENTES LUEGO DE HABER LEIDO ESTE INSTRUMENTO Y DE HABERLES ADVERTIDO SOBRE SU OBJETO, SE AFIRMA Y RATIFICA EN SU CONTENIDO PROCEDIENDO A FIRMARLO"));
		$exhiben_dni=strtoupper(utf8_decode("EXHIBEN SU DNI Y SON IDENTIFICADOS MEDIANTE IDENTIFICACION BIOMETRICA DE HUELLAS DACTILARES - RENIEC"));
	}else if($c1==1 && $c2==0){
		
		
		$v1=strtoupper("El vendedor");
		$otorga=strtoupper("OTORGAN");
		$v2=strtoupper("Los adquirentes");
		$v22=strtoupper("los adquirentes");
		$v3=strtoupper("Los transferentes y los adquirentes ");
		$v4=strtoupper("transferentes y los adquirentes ");
		$declara1=strtoupper("declaran");
		$declara2=strtoupper("declaran");
		$num_trans=strtoupper("TRANSFERENTES");
		$transfieren=strtoupper("transfieren");
		$propietario=strtoupper("son propietarios");
		$conocen=strtoupper("conocen");
		$advierten=strtoupper("advierten");
		$num_adq=strtoupper("ADQUIRENTES");
		$dat=strtoupper("dan");
		$daa=strtoupper("dan");
		$reciben=strtoupper("reciben");

		$han=strtoupper("han");
		$res=strtoupper("responsabilizan");
		$compradq=strtoupper("A LOS COMPRADORES / ADQUIRENTES");
		$intervienen=strtoupper("Interviene");
		$manifiesta=strtoupper(utf8_decode("HABER IDENTIFICADO AL INTERVINIENTE CON EL DOCUMENTO ANTE INDICADO, QUE ES MAYOR DE EDAD, INTELIGENTE EN EL IDIOMA ESPAÑOL; QUE PROCEDE CON CAPACIDAD, LIBERTAD Y CONOCIMIENTO SUFICIENTE PARA OBLIGARSE, QUE LOS DATOS PERSONALES Y ESTADO CIVIL QUE ANTECEDEN SON VERDADEROS, QUE NO TIENE RESTRICCIONES PARA EFECTUAR EL PRESENTE DOCUMENTO Y QUE ME MANIFESTA SU VOLUNTAD DE CELEBRAR LA PRESENTE RATIFICACION DE TRANSFERENCIA VEHICULAR"));
		$manifiesta_abajo=strtoupper(utf8_decode("QUE EL COMPARECIENTE LUEGO DE LEIDO ESTE INSTRUMENTO Y DE HABERLE ADVERTIDO SOBRE SU OBJETO, SE AFIRMA Y RATIFICA EN SU CONTENIDO PROCEDIENDO A FIRMARLO"));
		$exhiben_dni=strtoupper(utf8_decode("EXHIBE SU DNI Y ES IDENTIFICADO MEDIANTE IDENTIFICACION BIOMETRICA DE HUELLAS DACTILARES - RENIEC"));
	}else if($c2==1 && $c1==0){
		
		$v1=strtoupper("El comprador");
		$otorga=strtoupper("OTORGAN");
		$v2=strtoupper("Los adquirentes");
		$v22=strtoupper("los adquirentes");
		$v3=strtoupper("Los transferentes y los adquirentes ");
		$v4=strtoupper("transferentes y los adquirentes ");
		$declara1=strtoupper("declaran");
		$declara2=strtoupper("declaran");
		$num_trans=strtoupper("TRANSFERENTES");
		$transfieren=strtoupper("transfieren");
		$propietario=strtoupper("son propietarios");
		$conocen=strtoupper("conocen");
		$advierten=strtoupper("advierten");
		$num_adq=strtoupper("ADQUIRENTES");
		$dat=strtoupper("dan");
		$daa=strtoupper("dan");
		$reciben=strtoupper("reciben");
		$han=strtoupper("han");
		$res=strtoupper("responsabilizan");
		$compradq=strtoupper("A LOS COMPRADORES / ADQUIRENTES");
		$intervienen=strtoupper("Interviene");
		$manifiesta=strtoupper(utf8_decode("HABER IDENTIFICADO AL INTERVINIENTE CON EL DOCUMENTO ANTE INDICADO, QUE ES MAYOR DE EDAD, INTELIGENTE EN EL IDIOMA ESPAÑOL; QUE PROCEDE CON CAPACIDAD, LIBERTAD Y CONOCIMIENTO SUFICIENTE PARA OBLIGARSE, QUE LOS DATOS PERSONALES Y ESTADO CIVIL QUE ANTECEDEN SON VERDADEROS, QUE NO TIENE RESTRICCIONES PARA EFECTUAR EL PRESENTE DOCUMENTO Y QUE ME MANIFESTA SU VOLUNTAD DE CELEBRAR LA PRESENTE RATIFICACION DE TRANSFERENCIA VEHICULAR"));
		$manifiesta_abajo=strtoupper(utf8_decode("QUE EL COMPARECIENTE LUEGO DE LEIDO ESTE INSTRUMENTO Y DE HABERLE ADVERTIDO SOBRE SU OBJETO, SE AFIRMA Y RATIFICA EN SU CONTENIDO PROCEDIENDO A FIRMARLO"));
		$exhiben_dni=strtoupper(utf8_decode("EXHIBE SU DNI Y ES IDENTIFICADO MEDIANTE IDENTIFICACION BIOMETRICA DE HUELLAS DACTILARES - RENIEC"));
	}else if($c1>1 && $c2==0){
		
		$v1=strtoupper("Los vendedores");
		$otorga=strtoupper("OTORGAN");
		$v2=strtoupper("Los adquirentes");
		$v22=strtoupper("los adquirentes");
		$v3=strtoupper("Los transferentes y los adquirentes ");
		$v4=strtoupper("transferentes y los adquirentes ");
		$declara1=strtoupper("declaran");
		$declara2=strtoupper("declaran");
		$num_trans=strtoupper("TRANSFERENTES");
		$transfieren=strtoupper("transfieren");
		$propietario=strtoupper("son propietarios");
		$conocen=strtoupper("conocen");
		$advierten=strtoupper("advierten");
		$num_adq=strtoupper("ADQUIRENTES");
		$dat=strtoupper("dan");
		$daa=strtoupper("dan");
	

		$reciben=strtoupper("reciben");
		$han=strtoupper("han");
		$res=strtoupper("responsabilizan");
		$compradq=strtoupper("A LOS COMPRADORES / ADQUIRENTES");
		$intervienen=strtoupper("Intervienen");
		$manifiesta=strtoupper(utf8_decode("HABER IDENTIFICADO A LOS INTERVINIENTES CON LOS DOCUMENTOS ANTES INDICADOS, QUE SON MAYORES DE EDAD, INTELIGENTES EN EL IDIOMA ESPAÑOL; QUE PROCEDEN CON CAPACIDAD, LIBERTAD Y CONOCIMIENTO SUFICIENTE PARA OBLIGARSE, QUE LOS DATOS PERSONALES Y ESTADO CIVIL QUE ANTECEDEN SON VERDADEROS, QUE NO TIENEN RESTRICCIONES PARA EFECTUAR EL PRESENTE DOCUMENTO Y QUE ME MANIFESTAN SU VOLUNTAD DE CELEBRAR LA PRESENTE RATIFICACION DE TRANSFERENCIA VEHICULAR"));
		$manifiesta_abajo=strtoupper(utf8_decode("QUE LOS COMPARECIENTES LUEGO DE HABER LEIDO ESTE INSTRUMENTO Y DE HABERLES ADVERTIDO SOBRE SU OBJETO, SE AFIRMA Y RATIFICA EN SU CONTENIDO PROCEDIENDO A FIRMARLO"));
		$exhiben_dni=strtoupper(utf8_decode("EXHIBEN SU DNI Y SON IDENTIFICADOS MEDIANTE IDENTIFICACION BIOMETRICA DE HUELLAS DACTILARES - RENIEC"));

	}else if($c2>1 && $c1==0){
		$v1=strtoupper("Los compradores");
		$otorga=strtoupper("OTORGAN");
		$v2=strtoupper("Los adquirentes");
		$v22=strtoupper("los adquirentes");
		$v3=strtoupper("Los transferentes y los adquirentes ");
		$v4=strtoupper("transferentes y los adquirentes ");
		$declara1=strtoupper("declaran");
		$declara2=strtoupper("declaran");
		$num_trans=strtoupper("TRANSFERENTES");
		$transfieren=strtoupper("transfieren");
		$propietario=strtoupper("son propietarios");
		$conocen=strtoupper("conocen");
		$advierten=strtoupper("advierten");
		$num_adq=strtoupper("ADQUIRENTES");
		$dat=strtoupper("dan");
		$daa=strtoupper("dan");
		$reciben=strtoupper("reciben");
		$han=strtoupper("han");
		$res=strtoupper("responsabilizan");
		$compradq=strtoupper("A LOS COMPRADORES / ADQUIRENTES");
		$intervienen=strtoupper("Intervienen");
		$manifiesta=strtoupper(utf8_decode("HABER IDENTIFICADO A LOS INTERVINIENTES CON LOS DOCUMENTOS ANTES INDICADOS, QUE SON MAYORES DE EDAD, INTELIGENTES EN EL IDIOMA ESPAÑOL; QUE PROCEDEN CON CAPACIDAD, LIBERTAD Y CONOCIMIENTO SUFICIENTE PARA OBLIGARSE, QUE LOS DATOS PERSONALES Y ESTADO CIVIL QUE ANTECEDEN SON VERDADEROS, QUE NO TIENEN RESTRICCIONES PARA EFECTUAR EL PRESENTE DOCUMENTO Y QUE ME MANIFESTAN SU VOLUNTAD DE CELEBRAR LA PRESENTE RATIFICACION DE TRANSFERENCIA VEHICULAR"));
		$manifiesta_abajo=strtoupper(utf8_decode("QUE LOS COMPARECIENTES LUEGO DE HABER LEIDO ESTE INSTRUMENTO Y DE HABERLES ADVERTIDO SOBRE SU OBJETO, SE AFIRMA Y RATIFICA EN SU CONTENIDO PROCEDIENDO A FIRMARLO"));
		$exhiben_dni=strtoupper(utf8_decode("EXHIBEN SU DNI Y SON IDENTIFICADOS MEDIANTE IDENTIFICACION BIOMETRICA DE HUELLAS DACTILARES - RENIEC"));
		
	}
	

	
	## ACOTACION: PARA LOS ACTOS COMPRADORES:PARTE2, VENDEDORES:PARTE1 O VACIO
	
//CONSULTAS PARA BENEFICIARIOS -> PARTE 1 O VACIO
	$consulNaturales_dp_parte1 = mysql_query('
	SELECT 
	  ca.kardex,
	  a.parte_generacion,
	  ca.idtipoacto,
	  ca.idcontratante,
	  TRIM(
		CONCAT(
		  IFNULL(c2.`prinom`, ""),
		  " ",
		  IFNULL(c2.`segnom`, ""),
		  " ",
		  IFNULL(c2.`apepat`, ""),
		  " ",
		  IFNULL(c2.`apemat`, ""),
		  IFNULL(c2.razonsocial, "")
		)
	  ) AS nombre,
	  n.descripcion AS "nacionalidad",
	  td.destipdoc AS "tipo_docu",
	  td.idtipdoc,
	  c2.numdoc,
	  UPPER(c2.detaprofesion) AS "Ocupacion",
	  tec.desestcivil AS "ecivil",
	  c2.domfiscal,
	  c2.direccion,
	  u.codpto,
	  u.coddis,
	  u.codprov,
	  u.nomdis,
	  u.nomprov,
	  u.nomdpto,
	  IF(
		u.coddis = "070101",
		"DISTRITO DEL CALLAO , PROVINCIA CONSTITUCIONAL DEL CALLAO",
		CONCAT(
		  "DISTRITO DE ",
		  u.nomdis,
		  ", PROVINCIA DE ",
		  u.nomprov,
		  ", DEPARTAMENTO DE ",
		  u.nomdpto
		)
	  ) AS "Distrito",
	  c2.sexo AS "sexo",
	  c2.tipper,
	  IF(cn.firma = "0", "NO", "SI") AS "firma",
	  cn.firma as nfirma,
	  cn.tiporepresentacion,
	  sr.dessede,
	  cn.inscrito,
	  a.`condicion`,
	  c2.tipper,
	  c2.idcliente,
	  CONCAT(
		c2y.prinom,
		" ",
		c2y.segnom,
		" ",
		c2y.apepat,
		" ",
		c2y.apemat,
		c2y.razonsocial
	  ) AS nombreconyuge,
	  c2.`conyuge`,
	  cny.`firma`,
	  cn.`tiporepresentacion`  ,
	  r.`partida` AS numpartida,
	  SUBSTRING_INDEX(src.dessede,"- ",-1) as idsedereg,
	   fncCantidadRepresentantes22(ca.kardex,c2.idcliente)as cantRepre,
	   "" as benef_final
	FROM
	  contratantesxacto ca 
	  INNER JOIN cliente2 c2 
		ON ca.`idcontratante` = c2.`idcontratante` 
	  INNER JOIN contratantes cn 
		ON ca.`idcontratante` = cn.`idcontratante` 
	  LEFT JOIN representantes r 
		ON ca.`idcontratante` = r.`idcontratante` 
	  INNER JOIN actocondicion a 
		ON a.`idcondicion` = ca.`idcondicion` 
	  LEFT JOIN nacionalidades n 
		ON n.idnacionalidad = c2.nacionalidad 
	  LEFT JOIN tipodocumento td 
		ON td.idtipdoc = c2.idtipdoc 
	  LEFT OUTER JOIN tipoestacivil tec 
		ON tec.idestcivil = c2.idestcivil 
	  LEFT OUTER JOIN ubigeo u 
		ON u.coddis = c2.idubigeo 
	  LEFT OUTER JOIN sedesregistrales sr 
		ON sr.idsedereg = cn.idsedereg 
	  LEFT JOIN cliente2 c2y 
		ON LPAD(c2.conyuge,10,0) = c2y.idcliente 
	  LEFT JOIN contratantes cny 
		ON cny.idcontratante = c2y.`idcontratante` 
	  LEFT JOIN sedesregistrales src 
    	ON src.`idsedereg`=c2.`idsedereg`
	WHERE ca.`kardex` = "'.$num_kardex.'" 
	  
	  AND (a.`parte_generacion` = "1" OR a.`parte_generacion` = "2" OR a.`parte_generacion` = "3" OR a.`parte_generacion` = "4" )
	GROUP BY ca.`idcontratante` HAVING a.parte_generacion    ', $conn) or die("==>=>123".mysql_error());
	##CONTADOR
	
		

	$conteo_consulNaturales_dp_parte1=mysql_num_rows($consulNaturales_dp_parte1);
	
	## CONSULTAS PARA OTORGANTES -> PARTE 2
		
	$consulNaturales_dp_parte2 = mysql_query('
	SELECT 
	  ca.kardex,
	  ca.idtipoacto,
	  ca.idcontratante,
	  TRIM(
		CONCAT(
		  IFNULL(c2.`prinom`, ""),
		  " ",
		  IFNULL(c2.`segnom`, ""),
		  " ",
		  IFNULL(c2.`apepat`, ""),
		  " ",
		  IFNULL(c2.`apemat`, ""),
		  IFNULL(c2.razonsocial, "")
		)
	  ) AS nombre,
	  n.descripcion AS "nacionalidad",
	  td.destipdoc AS "tipo_docu",
	  c2.numdoc,
	  UPPER(c2.detaprofesion) AS "Ocupacion",
	  tec.desestcivil AS "ecivil",
	  c2.domfiscal,
	  c2.direccion,
	  IF(
		u.coddis = "070101",
		"DISTRITO DEL CALLAO , PROVINCIA CONSTITUCIONAL DEL CALLAO",
		CONCAT(
		  "DISTRITO DE ",

		  u.nomdis,
		  ", PROVINCIA DE ",
		  u.nomprov,
		  ", DEPARTAMENTO DE ",
		  u.nomdpto
		)
	  ) AS "Distrito",
	  c2.sexo AS "sexo",
	  c2.tipper,
	  IF(cn.firma = "0", "NO", "SI") AS "firma",
	  cn.tiporepresentacion,
	  cn.numpartida,
	  sr.dessede,
	  cn.inscrito,
	  a.`condicion`,
	  c2.tipper,
	  c2.idcliente,
	  CONCAT(
		c2y.prinom,
		" ",
		c2y.segnom,
		" ",
		c2y.apepat,
		" ",
		c2y.apemat,
		c2y.razonsocial
	  ) AS nombreconyuge,
	  c2.`conyuge`,
	  cny.`firma`,
	  cn.`tiporepresentacion`,
	  c2.`numpartida`,
	  SUBSTRING_INDEX(src.dessede,"- ",-1) as idsedereg
	FROM
	  contratantesxacto ca 
	  INNER JOIN cliente2 c2 
		ON ca.`idcontratante` = c2.`idcontratante` 
	  INNER JOIN contratantes cn 
		ON ca.`idcontratante` = cn.`idcontratante` 
	  LEFT JOIN representantes r 
		ON ca.`idcontratante` = r.`idcontratante` 
	  INNER JOIN actocondicion a 
		ON a.`idcondicion` = ca.`idcondicion` 
	  LEFT JOIN nacionalidades n 
		ON n.idnacionalidad = c2.nacionalidad 
	  LEFT JOIN tipodocumento td 
		ON td.idtipdoc = c2.idtipdoc 
	  LEFT OUTER JOIN tipoestacivil tec 
		ON tec.idestcivil = c2.idestcivil 
	  LEFT OUTER JOIN ubigeo u 
		ON u.coddis = c2.idubigeo 
	  LEFT OUTER JOIN sedesregistrales sr 
		ON sr.idsedereg = cn.idsedereg 
	  LEFT JOIN cliente2 c2y 
		ON c2.conyuge = c2y.idcliente 
	  LEFT JOIN contratantes cny 
		ON cny.idcontratante = c2y.`idcontratante` 
	  LEFT JOIN sedesregistrales src 
    	ON src.`idsedereg`=c2.`idsedereg`
	WHERE ca.`kardex` = "'.$num_kardex.'" 
	  AND r.`id` IS NULL 
	  AND a.`parte_generacion` = "2" 
	GROUP BY ca.`idcontratante`', $conn) or die("==>88".mysql_error());
	##CONTADOR
	$conteo_consulNaturales_dp_parte2=mysql_num_rows($consulNaturales_dp_parte2);
	##VARIABLE QUE CONTENDRA EL TEXTO EL LETRAS
	$letras = new ClaseNumeroLetra();
	## ESCRITURA
	$ESCRITURA   			= $rowcabecera1["escritura"];	
	$ESCRITURA_MAY			= strtoupper($letras->fun_nume_letras($ESCRITURA));
	$ESCRITURA_MIN			= strtolower($letras->fun_nume_letras($ESCRITURA));
	## KARDEX
	$KARDEX		      	 	= $rowcabecera1["num_kardex"];
	$KARDEX_SOLO			= $rowcabecera1["numero"];
	$KARDEX_MAY				= strtoupper($letras->fun_nume_letras($KARDEX_SOLO));
	$KARDEX_MIN				= strtolower($letras->fun_nume_letras($KARDEX_SOLO));
	## MINUTA
	$MINUTA		       		= $rowcabecera1["numminuta"];
	$MINUTA_MAY				= strtoupper($letras->fun_nume_letras($MINUTA));
	$MINUTA_MIN				= strtolower($letras->fun_nume_letras($MINUTA));
	## REGISTRO
	$REGISTRO          		= $rowcabecera1["registro"];	
	$REGISTRO_MAY			= strtoupper($letras->fun_nume_letras($REGISTRO));
	$REGISTRO_MIN			= strtolower($letras->fun_nume_letras($REGISTRO));
	##FOLIOINI
	$FOLIOINI         		= $rowfolio["folioini"];	
	$FOLIOINI_MAY			= strtoupper($letras->fun_nume_letras($FOLIOINI).revisarFolios($FOLIOINI));
	$FOLIOINI_MIN			= strtolower($letras->fun_nume_letras($FOLIOINI).revisarFolios($FOLIOINI));
	##FOLIOFIN
	$FOLIOFIN         		= $rowfolio["foliofin"];	
	$FOLIOFIN_MAY			= strtoupper($letras->fun_nume_letras($FOLIOFIN).revisarFolios($FOLIOFIN));
	$FOLIOFIN_MIN			= strtolower($letras->fun_nume_letras($FOLIOFIN).revisarFolios($FOLIOFIN));
	##PAPELINI
	$PAPELINI         		= $rowfolio["papelini"];	
	$PAPELINI_MAY			= strtoupper($letras->fun_nume_letras($PAPELINI).revisarFolios($PAPELINI));
	$PAPELINI_MIN			= strtolower($letras->fun_nume_letras($PAPELINI).revisarFolios($PAPELINI));
	##PAPELFIN
	$PAPELFIN         		= $rowfolio["papelfin"];	
	$PAPELFIN_MAY			= strtoupper($letras->fun_nume_letras($PAPELFIN).revisarFolios($PAPELFIN));
	$PAPELFIN_MIN			= strtolower($letras->fun_nume_letras($PAPELFIN).revisarFolios($PAPELFIN));
	##CABECERA DEL CONTRATO
	$CONTRATO_MAY        	= strtoupper($rowcabecera2["contrato"]);
	$CONTRATO_MIN         	= strtolower($rowcabecera2["contrato"]);
	$REFERENCIA_MAY    		= strtoupper($rowcabecera2["referencia"]);
	$REFERENCIA_MIN    		= strtolower($rowcabecera2["referencia"]);
	$ANO_ACTUAL				= date("Y");
	$ANO_ACTUAL_MAY			= (strtoupper(convierte_numtildes(numtoletras(date("Y")))));
	$ANO_ACTUAL_MIN			= ucwords(strtolower(convierte_numtildes(numtoletras(date("Y")))));
	## FECHA DE CONCLUSION
	$FECHA_CONCLUSION  		= strtoupper($fecha->fun_fech_letras(implode("/", array_reverse(explode("/", $rowcabecera1["fechaconclusion"])))));	



	if($rowcabecera1["idtipkar"]!=3){
			if($rowcabecera1["fechaGenerado"]!="")
			{
				$FECHA_GENERADO=fechan_abd($rowcabecera1["fechaGenerado"]);
				$FECHA_GENERADO=trim($FECHA_GENERADO);
				$FECHA_GENERADO  = strtoupper($fecha->fun_fech_comple2($FECHA_GENERADO));
			}else
				$FECHA_GENERADO  		= strtoupper($fecha->fun_fech_comple2(date("Y-m-d")));	
	}   
		else
			$FECHA_GENERADO  		= strtoupper($fecha->fun_fech_comple2(date("Y-m-d")));	
	//echo $FECHA_GENERADO;
	//return ;
	

	## VARIABLES PARA EL PRECIO DEL VEHICULO
    $monto_vehi     = "";
	$moneda_vehi    = "";
	$mediopago_vehi = "";
	$simbolo_mon    = "";
	
	## PRECIO DEL VEHICULO:
	if($numprevehi > 0)
	{
		$monto_vehi     = number_format($rowprevehi[0],2,".",",");
		$moneda_vehi    = $rowprevehi[1];
		$simbolo_mon    = $rowprevehi[3];
		
		$precio 		= new ClaseNumeroLetra();
		$desmonto_vehi	=$precio->fun_capital_moneda($moneda_vehi,$monto_vehi);
		
		if($moneda_vehi==1){
			$aaa=" Y 00/100 SOLES";
		}else if($moneda_vehi==2){
			$aaa=" Y 00/100 DOLARES AMERICANOS";
		}		
		$desmonto_vehi	=numtoletras($rowprevehi[0]).$aaa;
		
	}
	else if($numprevehi == 0)
	{
		$monto_vehi     = "";
		$moneda_vehi    = "";
		$mediopago_vehi = "";
		$desmonto_vehi  = "";
	}

	#VALIDACION PARA CONTRATANTES - NUMERO DE CONTRATANTES
//	echo 'SELECT COUNT(idcontratante) AS conteo FROM CONTRATANTES WHERE KARDEX= "'.$num_kardex.'" ';
	$consulta_numcontratantes = mysql_query('SELECT COUNT(idcontratante) AS conteo FROM contratantes WHERE KARDEX= "'.$num_kardex.'" ', $conn)
								or die("==>".mysql_error());
	$row_conteo_contratantes =  mysql_fetch_array($consulta_numcontratantes);	

	if($row_conteo_contratantes['conteo']==0)
	{
		echo "<script>alert('ERROR: DEBE HABER AL MENOS UN CONTRATANTE PARA GENERAR EL PROYECTO $num_kardex.');window.close();</script>";
		exit();
	}

	## DECLARACION DE ARREGLOS Y VARIABLES PARA CARGAR Y EXPORTAR DATA

	$dataContratantes 		= array();
	$dataContratantes_r 	= array();
	$dataContratantes2 		= array();
	$dataContratantes2_r 	= array();
	$dataFirmas 			= array();
	$dataFirmas2 			= array();
	$TRANSFERENTES			="";
	$ADQUIRENTES			="";
	$REPRESENTANTES			="";


	## COMPRADORES DERECHO PROPIO			
	for($i = 0; $i <= $conteo_consulNaturales_dp_parte1 -1; $i++)
	{
		while($row_consulNaturales_dp_parte1 = mysql_fetch_array($consulNaturales_dp_parte1)){	
				
			if($row_consulNaturales_dp_parte1['tipper']=="N"){
				//validacion estado civil
				if($row_consulNaturales_dp_parte1['ecivil']=="CASADO"){
					
					$rowconyuge1="";				
					$consulconyuge2 = mysql_query('
					SELECT 
					  CONCAT(
						c.prinom,
						" ",
						c.segnom,
						" ",
						c.apepat,
						" ",
						c.apemat
					  ) AS conyuge,
					  n.`descripcion`,
					  t.`destipdoc`,
					  c.`numdoc`,
					  if(trim(c.`detaprofesion`)<>"",c.`detaprofesion`,"<NO ESPECIFICADA>") AS detaprofesion,
					  r.dessede AS idsedeconyuge,
					  c.`partidaconyuge`,
					  c.`separaciondebienes` 
					FROM
					  cliente c 
					  LEFT JOIN `nacionalidades` n 
						ON n.`idnacionalidad` = c.`nacionalidad` 
					  LEFT JOIN tipodocumento t 
						ON t.idtipdoc = c.idtipdoc 
					  LEFT JOIN cliente2 c2 
						ON c2.`idcliente` = c.`conyuge` 
					  LEFT JOIN sedesregistrales r 
   						 ON r.`idsedereg` = c.`idsedeconyuge` 
					WHERE c.`idcliente` = "'.$row_consulNaturales_dp_parte1['conyuge'].'"', $conn) or die("==>".mysql_error());
	
					$rowconyuge2= mysql_fetch_array($consulconyuge2);	
					$conyuge = $rowconyuge2['conyuge']=='' ? "" : $rowconyuge2['conyuge'];
					$nacionalidad_conyuge = $rowconyuge2['descripcion']=='' ? "" : $rowconyuge2['descripcion'];
					$tipodoc_conyuge = $rowconyuge2['destipdoc']=='' ? "" : $rowconyuge2['destipdoc'];
					$numdoc_conyuge = $rowconyuge2['numdoc']=='' ? "" : $rowconyuge2['numdoc'];
					$ocupacion_conyuge = $rowconyuge2['detaprofesion']=='' ? "<OCUPACION NO ESPECIFICADA>" : $rowconyuge2['detaprofesion'];
					
					if(trim($conyuge)!=""){
					//$texto_conyuge = " con ".NEGRITA($conyuge,$CHAR_NEGRITA).$SEPARAESTILOS.", ".$nacionalidad_conyuge.", ".trim($ocupacion_conyuge).", con ".trim($tipodoc_conyuge)." numero ".NEGRITA($numdoc_conyuge,$CHAR_NEGRITA).$SEPARAESTILOS."";
						if($rowconyuge2['separaciondebienes']==1){
							
							$texto_conyuge = utf8_decode(" CON SEPARACION DE PATRIMONIOS INSCRITA EN LA PARTIDA ".$rowconyuge2['partidaconyuge']." DEL REGISTRO PERSONAL DE LA ZONA REGISTRAL N.º ".$rowconyuge2['idsedeconyuge']." ");
							$ambos="";
							$interviene="interviene";
						}else{
							
							$texto_conyuge = " CON ".NEGRITA($conyuge,$CHAR_NEGRITA).$SEPARAESTILOS." "
						."IDENTIFICADO CON ".$tipodoc_conyuge.utf8_decode(" NÚMERO ").$numdoc_conyuge
						.(", DE OPUPACION : ").$ocupacion_conyuge;
							$ambos=" ambos ";
							$interviene="intervienen";
						}
					}
				}else{
					
					$texto_conyuge="";				
					$ambos=" ";
					$interviene="interviene";
				}
				
				//EVALUACION DEL SEXO DEL CONTRATANTE
				
				if($row_consulNaturales_dp_parte1["sexo"]=="M")
				{
					$evalsexo = "";	
					$iden = "identificado";	
					$domicilado="domiciliado";
					$nacionalidad=substr(trim($row_consulNaturales_dp_parte1["nacionalidad"]),0,-1)."o";
					if($row_consulNaturales_dp_parte1['ecivil']=="SOLTERO" || $row_consulNaturales_dp_parte1['ecivil']=="CASADO" || $row_consulNaturales_dp_parte1['ecivil']=="VIUDO" || $row_consulNaturales_dp_parte1['ecivil']=="DIVORCIADO" ){
						$estc=substr($row_consulNaturales_dp_parte1['ecivil'],0,-1);
						$estcivil=strtolower($estc."o");
					}else if($row_consulNaturales_dp_parte1['ecivil']=="CONVIVIENTE" ){
						$estcivil="conviviente";
					}
					
				}
				else if($row_consulNaturales_dp_parte1["sexo"]=="F")
				{
					$evalsexo = "";
					$iden = "identificada";	
					$domicilado="domiciliada";
					$nacionalidad=substr(trim($row_consulNaturales_dp_parte1["nacionalidad"]),0,-1)."a";
					if($row_consulNaturales_dp_parte1['ecivil']=="SOLTERO" || $row_consulNaturales_dp_parte1['ecivil']=="CASADO" || $row_consulNaturales_dp_parte1['ecivil']=="VIUDO" || $row_consulNaturales_dp_parte1['ecivil']=="DIVORCIADO" ){
						$estc=substr($row_consulNaturales_dp_parte1['ecivil'],0,-1);
						$estcivil=strtolower($estc."a");
					}else if($row_consulNaturales_dp_parte1['ecivil']=="CONVIVIENTE" ){
						$estcivil="conviviente";
					}
				}
				
				//evalua ocupacion:
				if($row_consulNaturales_dp_parte1["Ocupacion"]=="")
				{
					$evalocupacion = "<OCUPACION NO ESPECIFICADA>";	
				}
				else if($row_consulNaturales_dp_parte1["Ocupacion"]!="")
				{
					$evalocupacion = utf8_decode($row_consulNaturales_dp_parte1["Ocupacion"]);	
				}
				
				if($row_consulNaturales_dp_parte1['condicion']=="VENDEDOR"){				
					 $var=$row_consulNaturales_dp_parte1['condicion'];
				}else if ($row_consulNaturales_dp_parte1['condicion']=="COMPRADOR"){
					 $var=$row_consulNaturales_dp_parte1['condicion'];
				}
	
	//PERSONAS NATURALES QUE FIRMAN
				
			if($row_consulNaturales_dp_parte1["nfirma"]==1 or $row_consulNaturales_dp_parte1["cantRepre"]>0)	{	

				//buscamos al representante	
					//buscamos al representante	
				$txtRepre='		
				SELECT 
				"" as benef_final,
				c.`tipper`,
				  LTRIM(
					CONCAT(
					  c.prinom,
					  " ",
					  c.segnom,
					  " ",
					  c.apepat,
					  " ",
					  c.apemat,
					  c.`razonsocial`
					)
				  ) AS nombre,
				  t.`destipdoc`,
				  c.`numdoc`,
				  LTRIM(
					CONCAT(c.`domfiscal`, c.`direccion`)
				  ) AS direccion,
				  c.`sexo`,
				 IF(
		u.coddis = "070101",
		"DISTRITO DEL CALLAO , PROVINCIA CONSTITUCIONAL DEL CALLAO",
		CONCAT(
		  "DISTRITO DE ",
		  u.nomdis,
		  ", PROVINCIA DE ",
		  u.nomprov,
		  ", DEPARTAMENTO DE ",
		  u.nomdpto
		)
	  ) AS "Distrito",
	  u.codprov,
	  u.codpto,
	  u.coddis,
	  u.nomdis,
	  u.nomprov,
	  u.nomdpto,
				  r.`facultades`,
				  r.`inscrito`,
				  s.`dessede`,
				  SUBSTRING_INDEX(s.dessede,"- ",-1) as sedreg,
				  r.`partida`,
				  n.`descripcion`,
				  civ.`desestcivil`,
				  if(trim(c.`detaprofesion`)<>"",c.`detaprofesion`,"<NO ESPECIFICADA>") AS detaprofesion ,
				  	fncCantidadRepresentantes22("'.$num_kardex.'",r.idcontratante_r)as cantRepre,
		  ac.`parte_generacion`,
		(select  CONCAT(
		cc2.prinom,
		" ",
		cc2.segnom,
		" ",
		cc2.apepat,
		" ",
		cc2.apemat,
		cc2.razonsocial
	  ) AS nombreconyuge from cliente2 cc2
		where cc2.idcliente=LPAD(c.conyuge,10,0) limit 1) as nombreConyuge
				FROM
				  representantes r 
				  INNER JOIN contratantesxacto cn 
					ON cn.`idcontratante` = r.`idcontratante` 
				  INNER JOIN cliente2 c 
					ON cn.`idcontratante` = c.`idcontratante` 
				  INNER JOIN tipodocumento t 
					ON t.idtipdoc = c.idtipdoc 
				  LEFT OUTER JOIN ubigeo u 
					ON u.coddis = c.idubigeo 
				  LEFT OUTER JOIN `sedesregistrales` s 
					ON r.`sede_registral` = s.`idsedereg` 
				  LEFT OUTER JOIN tipoestacivil civ 
					ON c.`idestcivil` = civ.`idestcivil` 
				  LEFT OUTER JOIN nacionalidades n 
					ON c.`nacionalidad` = n.`idnacionalidad` 
				  INNER JOIN contratantes conn 
				  on c.idcontratante=conn.idcontratante
				   INNER JOIN actocondicion ac 
					ON ac.`idcondicion` = cn.`idcondicion` 
				WHERE r.`kardex` = "'.$num_kardex.'"
				  AND r.`idcontratante_r` = "'.$row_consulNaturales_dp_parte1['idcliente'].'"
				  
				GROUP BY c.idcliente ';

				//echo $txtRepre." <br> <br>";

				$consul_repre = mysql_query($txtRepre, $conn) or die("==>".mysql_error());
				
				$REPRESENTATE="";
				$DERECHO="";
				if(!isset($row_consulNaturales_dp_parte1['parte_generacion']))
					$row_consulNaturales_dp_parte1['parte_generacion']="";


				if($row_consulNaturales_dp_parte1['parte_generacion']=="1"){
					$DERECHO=" quien procede por SU propio derecho";
				}else if($row_consulNaturales_dp_parte1['tiporepresentacion']=="1"){
					$DERECHO=" representada por";
				}else if($row_consulNaturales_dp_parte1['tiporepresentacion']=="2"){
					$DERECHO=" representada por";
				}
				$lengArrRepre=mysql_num_rows($consul_repre);
				$cont=0;
				$txtListRepresentantes=array();
				$numPartida="";
				$_sede="";
				while($row_repre=mysql_fetch_array($consul_repre)){
					if($row_repre['partida']!="")
					{
						$numPartida=$row_repre['partida'];
					}
					if($row_repre['sedreg']!="")
					{
						$_sede=$row_repre['sedreg'];
					}
				  if((int)$row_repre['cantRepre']==1){
						$cont++;
					if($row_repre["tipper"]=="N"){	

						$REPRESENTATE=fNegrita($row_repre["nombre"]).",  DE NACIONALIDAD ".$row_repre["descripcion"].", ESTADO CIVIL ";
					if($row_repre['sexo']=="F"){
						if($row_repre['desestcivil']!="")
						{
							
								$REPRESENTATE.=substr($row_repre['desestcivil'],0,-1)."A";
							
							if($row_repre['desestcivil']=="CASADO" && $row_repre['nombreConyuge']!=""){
								$REPRESENTATE.=" CON ".$row_repre['nombreConyuge'];
							}
						}
							$REPRESENTATE.=", OCUPACIÓN ".$row_repre['detaprofesion'].", CON DOMICILIO EN ".utf8_decode($row_repre['direccion'])." ";


					}else{
						if($row_repre['desestcivil']!=""){	 						  
	 						
	 							$REPRESENTATE.=substr($row_repre['desestcivil'],0,-1)."O";
	 					

	 						if($row_repre['desestcivil']=="CASADO" && $row_repre['nombreConyuge']!=""){
								$REPRESENTATE.=" CON ".$row_repre['nombreConyuge'];
							}

	 					}
	 						$REPRESENTATE.=", OCUPACIÓN ".$row_repre['detaprofesion'].", CON DOMICILIO EN ".$row_repre['direccion']." ";
					}

					if($row_repre['coddis']=="999999")
							$REPRESENTATE.="DE TRANSITO POR ESTE PAIS";
						else{
							if($row_repre['codprov']=="01" && $row_repre['codpto']=="15")
								$REPRESENTATE.="DISTRITO DE ".$row_repre['nomdis'].", PROVINCIA Y DEPARTAMENTO DE LIMA";
							else
								$REPRESENTATE.=utf8_decode($row_repre["Distrito"]);
						}
						if(( $row_repre['codpto']!="" || $row_repre['coddis']!="" )&& $row_repre['codpto']!="15" && $row_repre['coddis']!="999999") 
							$REPRESENTATE.="DE TRANSITO POR ESTA CIUDAD";

					$REPRESENTATE.=", SE IDENTIFICA CON ".$row_repre["destipdoc"]." NÚMERO ".$row_repre["numdoc"]." Y ";
					if($row_repre['parte_generacion']==1||$row_repre['parte_generacion']==2||$row_repre['parte_generacion']==3)
						$REPRESENTATE.="QUIEN PROCEDE POR DERECHO PROPIO Y ";
					else
						$REPRESENTATE.="QUIEN PROCEDE ";
					$REPRESENTATE=utf8_decode($REPRESENTATE);   
				
					}else if($row_repre["tipper"]=="J"){
						$REPRESENTATE=fNegrita(str_replace("  "," ",$row_repre["nombre"])).$SEPARAESTILOS.", con domicilio en ".utf8_decode($row_repre["direccion"]).", ".$row_repre["Distrito"].", "; 					

							if($row_repre["benef_final"]=="SI")
								$REPRESENTATE.=utf8_decode(strtoupper("respecto de la que, conforme a lo establecido en el primer párrafo del artículo 9 del Decreto Legislativo N° 1372, se ha cumplido con verificar en el sistema SUNAT, la presentación de la Declaración del Beneficiario Final, cuya información mostrada por el sistema, se imprime e inserta en el presente instrumento."));
							else if($row_repre["benef_final"]=="NO")
								$REPRESENTATE.=utf8_decode(strtoupper("respecto de la que, conforme a lo establecido en el primer párrafo del artículo 9 del Decreto Legislativo N° 1372, se ha cumplido con verificar en el sistema SUNAT, que ésta no ha presentado la Declaración del Beneficiario Final."));
							else
								$REPRESENTATE.=utf8_decode("SEGÚN FACULTADES QUE CONSTAN EN LA PARTIDA ELECTRONICA NÚMERO ").$row_repre["partida"]." DEL REGISTRO DE PERSONAS JURIDICAS DE ".strtoupper(substr($row_repre["dessede"],4,12)).".";			
					}
					$txtListRepresentantes[$cont]=$REPRESENTATE;
				 }
				}

				$REPRESENTATE=str_replace(", y a su vez *",".",$REPRESENTATE);
				$REPRESENTATE = $REPRESENTATE=='*' ? "" : $REPRESENTATE;	

				if($row_consulNaturales_dp_parte1['nfirma']==1 ||(int)$row_consulNaturales_dp_parte1['cantRepre']>0){

				$txtTransferentesSolo="";


				$txtTransferentesSolo=fNegrita($row_consulNaturales_dp_parte1["nombre"])." ";

				$txtTransferentes=
				"".fNegrita($row_consulNaturales_dp_parte1["nombre"])." ".	
				"DE NACIONALIDAD ".$row_consulNaturales_dp_parte1["nacionalidad"].", ".
				"ESTADO CIVIL ".$estcivil;
				
					if($row_consulNaturales_dp_parte1['ecivil']=="CASADO" && $row_consulNaturales_dp_parte1['nombreconyuge']!=""){
						$txtTransferentes.=" CON ".$row_consulNaturales_dp_parte1['nombreconyuge'];
					}
				$txtTransferentes.=", OCUPACION ".$evalocupacion.", ";
				
					$txtTransferentes.="CON DOMICILIO ";	

				$txtTransferentes.="EN ".utf8_decode(holaacentos4(str_replace("De","de",""."".holaacentos4(strtolower(utf8_decode($row_consulNaturales_dp_parte1["direccion"])))))).", ";
				if($row_consulNaturales_dp_parte1['coddis']=="999999")
					$txtTransferentes.="DE TRANSITO POR ESTE PAIS, ";
				else{
					if($row_consulNaturales_dp_parte1['codprov']=="01" && $row_consulNaturales_dp_parte1['codpto']=="15")
						$txtTransferentes.="DISTRITO DE ".$row_consulNaturales_dp_parte1['nomdis'].", PROVINCIA Y DEPARTAMENTO DE LIMA, ";
					else
						$txtTransferentes.=utf8_decode($row_consulNaturales_dp_parte1["Distrito"]).", ";
				}
				if(($row_consulNaturales_dp_parte1['codpto']!="" || $row_consulNaturales_dp_parte1['coddis']!="") && $row_consulNaturales_dp_parte1['codpto']!="15" && $row_consulNaturales_dp_parte1['coddis']!="999999")
					$txtTransferentes.="DE TRANSITO POR ESTA CIUDAD, ";

				$txtTransferentes.="SE IDENTIFICA CON ".
				holaacentos4(ucwords(strtolower(utf8_decode(holaacentos4($row_consulNaturales_dp_parte1["tipo_docu"])))))." ".utf8_decode("NÚMERO ").$row_consulNaturales_dp_parte1["numdoc"]." ";	

				if(sizeof($txtListRepresentantes)>0)
				{ 
					echo $row_consulNaturales_dp_parte1["nombre"]."<br><br>";
						if($row_consulNaturales_dp_parte1["benef_final"]=="SI")
								$txtTransferentesSolo.=utf8_decode(strtoupper("respecto de la que, conforme a lo establecido en el primer párrafo del artículo 9 del Decreto Legislativo N° 1372, se ha cumplido con verificar en el sistema SUNAT, la presentación de la Declaración del Beneficiario Final, cuya información mostrada por el sistema, se imprime e inserta en el presente instrumento."));
							else if($row_consulNaturales_dp_parte1["benef_final"]=="NO")
								$txtTransferentesSolo.=utf8_decode(strtoupper("respecto de la que, conforme a lo establecido en el primer párrafo del artículo 9 del Decreto Legislativo N° 1372, se ha cumplido con verificar en el sistema SUNAT, que ésta no ha presentado la Declaración del Beneficiario Final."));
							else
								$txtTransferentesSolo.=utf8_decode("**SEGÚN FACULTADES QUE CONSTAN EN LA PARTIDA ELECTRONICA NÚMERO ").$numPartida." DEL REGISTRO DE PERSONAS JURIDICAS DE ".strtoupper($_sede).".";

				}else
					$txtTransferentes.="QUIEN PROCEDE POR SU PROPIO DERECHO.";
				
			    
			    if($row_consulNaturales_dp_parte1["idtipdoc"]==2){
			    	$constancia_conclusion=utf8_decode(fNegrita("CONSTANCIA.- D.LEG N° 1232.-")." EL NOTARIO QUE AUTORIZA DEJA EXPRESA CONSTANCIA QUE ACCEDIO A LA BASE DE DATOS DEL REGISTRO DE CARNÉS DE EXTRANJERIA DE LA SUPERINTENDENCIA NACIONAL DE MIGRACIONES, CONFORME AL INCISO C) DEL ARTICULO 55 DEL DECRETO LEGISLATIVO N° 1049.");

			    	$arrConstancia[]=array('constancia'=>$constancia_conclusion);
			    }
			   else if($row_consulNaturales_dp_parte1["idtipdoc"]==5){
			    	$constancia_conclusion=utf8_decode(fNegrita("CONSTANCIA.- D.LEG N° 1232.-")." EL NOTARIO QUE AUTORIZA DEJA EXPRESA CONSTANCIA QUE ACCEDIO A LA BASE DE DATOS DEL REGISTRO DE PASAPORTES DE LA SUPERINTENDENCIA NACIONAL DE MIGRACIONES, CONFORME AL INCISO C) DEL ARTICULO 55 DEL DECRETO LEGISLATIVO N° 1049.");

			    	$arrConstancia[]=array('constancia'=>$constancia_conclusion);
			    }else
			    {
			    	$constancia_conclusion=utf8_decode(fNegrita("CONSTANCIA.- D.LEG N° 1232.-")." EL NOTARIO QUE AUTORIZA DEJA EXPRESA CONSTANCIA QUE SE HA VERIFICADO LA IDENTIDAD DE LOS INTERVINIENTES UTILIZANDO LA COMPARACIÓN BIOMÉTRICA DE LAS HUELLAS DACTILARES A TRAVÉS DEL SERVICIO QUE BRINDA EL RENIEC, CONFORME AL INCISO A) DEL ARTÍCULO 55 DEL DECRETO LEGISLATIVO N° 1049.");

			    	$arrConstancia[]=array('constancia'=>$constancia_conclusion);
			    }


				if($cont>0){
					foreach ($txtListRepresentantes as $key => $value) {
						$TRANSFERENTES=$value." EN REPRESENTACION DE ".$txtTransferentesSolo;


						$txtListContratantes[]=array('contratante'=>strtoupper($TRANSFERENTES));		
					}
				}else{ //jn
					//$row_consulNaturales_dp_parte1["nfirma"]==1
					if($row_consulNaturales_dp_parte1["nfirma"]==1 || $row_consulNaturales_dp_parte1["cantRepre"]>0){
						$TRANSFERENTES=$txtTransferentes;
						$txtListContratantes[]=array('contratante'=>strtoupper($TRANSFERENTES));
					}
				}
				
			}
		}

			//PERSONAS JURIDICAS
			}else{
				
			

				if($row_consulNaturales_dp_parte1['cantRepre']>0){
				//buscamos al representante	
				$queryRepre='		
				SELECT 
				  LTRIM(
					CONCAT(
					  c.prinom,
					  " ",
					  c.segnom,
					  " ",
					  c.apepat,
					  " ",
					  c.apemat,
					  c.`razonsocial`
					)
				  ) AS nombre,
				  t.`destipdoc`,
				  c.`numdoc`,
				  LTRIM(
					CONCAT(c.`domfiscal`, c.`direccion`)
				  ) AS direccion,
				  u.coddis,
				  u.codpto,
				  u.codprov,
				  u.nomdis,
				  u.nomprov,
				  u.nomdpto,
				  c.`sexo`,
				  IF(
		u.coddis = "070101",
		"DISTRITO DEL CALLAO , PROVINCIA CONSTITUCIONAL DEL CALLAO",
		CONCAT(
		  "DISTRITO DE ",
		  u.nomdis,
		  ", PROVINCIA DE ",
		  u.nomprov,
		  ", DEPARTAMENTO DE ",
		  u.nomdpto
		)
	  ) AS "Distrito",
				  r.`facultades`,
				  r.`inscrito`,
				  s.`dessede`,
				  SUBSTRING_INDEX(s.dessede,"- ",-1) as sedreg,
				  r.`partida`,
				  n.`descripcion`,
				  civ.`desestcivil`,
				  if(trim(c.`detaprofesion`)<>"",c.`detaprofesion`,"<NO ESPECIFICADA>") AS detaprofesion,
				  ac.parte_generacion,
				(select  CONCAT(
		cc2.prinom,
		" ",
		cc2.segnom,
		" ",
		cc2.apepat,
		" ",
		cc2.apemat,
		cc2.razonsocial
	  ) AS nombreconyuge from cliente2 cc2
		where cc2.idcliente=LPAD(c.conyuge,10,0) LIMIT 1) as nombreConyuge,
		t.idtipdoc
				FROM
				  representantes r 
				  INNER JOIN contratantesxacto cn 
					ON cn.`idcontratante` = r.`idcontratante` 
				  INNER JOIN cliente2 c 
					ON cn.`idcontratante` = c.`idcontratante` 
				  INNER JOIN tipodocumento t 
					ON t.idtipdoc = c.idtipdoc 
				  LEFT OUTER JOIN ubigeo u 
					ON u.coddis = c.idubigeo 
				  LEFT OUTER JOIN `sedesregistrales` s 
					ON r.`sede_registral` = s.`idsedereg` 
				  LEFT OUTER JOIN tipoestacivil civ 
					ON c.`idestcivil` = civ.`idestcivil` 
				  LEFT OUTER JOIN nacionalidades n 
					ON c.`nacionalidad` = n.`idnacionalidad`
				 INNER JOIN contratantes conn 
				    ON  c.idcontratante=conn.idcontratante
				     INNER JOIN actocondicion ac 
					ON ac.`idcondicion` = cn.`idcondicion`
				WHERE r.`kardex` = "'.$num_kardex.'"
				AND firma=1 
				  AND r.`idcontratante_r` = "'.$row_consulNaturales_dp_parte1['idcliente'].'"
				GROUP BY c.idcliente ';
				
				//echo $queryRepre."<br>";
				//die($queryRepre);
				
				$consul_repre = mysql_query($queryRepre, $conn) or die("==>".mysql_error());
			
				$numpartida="";
				$_sede="";
				$txtListRepresentantes=array(); 
				$REPRESENTATE="";$COMOAPODERADO="";$cr=0;
				while($row_repre=mysql_fetch_array($consul_repre)){
					if($row_repre['partida']!="")
					{
						$numpartida=$row_repre['partida'];
					}
					if($row_repre['sedreg']!="")
					{
						$_sede=$row_repre['sedreg'];
					}
					
					$REPRESENTATE=fNegrita($row_repre["nombre"]).", SER DE NACIONALIDAD ".$row_repre["descripcion"].", ESTADO CIVIL ";
					if($row_repre['sexo']=="F"){
						if($row_repre['desestcivil']!="")
						{
							
								$REPRESENTATE.=substr($row_repre['desestcivil'],0,-1)."A";
							
							if($row_repre['desestcivil']=="CASADO" && $row_repre['nombreConyuge']!=""){
								$REPRESENTATE.=" CON ".$row_repre['nombreConyuge'];
							}
						}
							$REPRESENTATE.=", OCUPACIÓN ".$row_repre['detaprofesion'].", CON DOMICILIO EN ".utf8_decode($row_repre['direccion'])." ";


					}else{
						if($row_repre['desestcivil']!=""){	 						  
	 						
	 							$REPRESENTATE.=substr($row_repre['desestcivil'],0,-1)."O";
	 					

	 						if($row_repre['desestcivil']=="CASADO" && $row_repre['nombreConyuge']!=""){
								$REPRESENTATE.=" CON ".$row_repre['nombreConyuge'];
							}

	 					}
	 						$REPRESENTATE.=", OCUPACIÓN ".$row_repre['detaprofesion'].", CON DOMICILIO EN ".$row_repre['direccion']." ";
					}

					if($row_repre['coddis']=="999999")
							$REPRESENTATE.="DE TRANSITO POR ESTE PAIS";
						else{
							if($row_repre['codprov']=="01" && $row_repre['codpto']=="15")
								$REPRESENTATE.="DISTRITO DE ".$row_repre['nomdis'].", PROVINCIA Y DEPARTAMENTO DE LIMA";
							else
								$REPRESENTATE.=utf8_decode($row_repre["Distrito"]);
						}
						if(($row_repre['codpto']!="" || $row_repre['coddis']!="") && $row_repre['codpto']!="15" && $row_repre['coddis']!="999999")
							$REPRESENTATE.="DE TRANSITO POR ESTA CIUDAD";
					$REPRESENTATE.=", SE IDENTIFICA CON ".$row_repre["destipdoc"]." NÚMERO ".$row_repre["numdoc"]." Y ";
					if($row_repre['parte_generacion']==1||$row_repre['parte_generacion']==2||$row_repre['parte_generacion']==3)
						$REPRESENTATE.="QUIEN PROCEDE POR DERECHO PROPIO Y ";
					else
						$REPRESENTATE.="QUIEN PROCEDE ";
					$REPRESENTATE=utf8_decode($REPRESENTATE);


					 if($row_repre["idtipdoc"]==2){
			    	$constancia_conclusion=utf8_decode(fNegrita("CONSTANCIA.- D.LEG N° 1232.-")." EL NOTARIO QUE AUTORIZA DEJA EXPRESA CONSTANCIA QUE ACCEDIO A LA BASE DE DATOS DEL REGISTRO DE CARNÉS DE EXTRANJERIA DE LA SUPERINTENDENCIA NACIONAL DE MIGRACIONES, CONFORME AL INCISO C) DEL ARTICULO 55 DEL DECRETO LEGISLATIVO N° 1049.");
			    	$arrConstancia[]=array('constancia'=>$constancia_conclusion);
				    }
				    else if($row_repre["idtipdoc"]==5){
				    	$constancia_conclusion=utf8_decode(fNegrita("CONSTANCIA.- D.LEG N° 1232.-")." EL NOTARIO QUE AUTORIZA DEJA EXPRESA CONSTANCIA QUE ACCEDIO A LA BASE DE DATOS DEL REGISTRO DE PASAPORTES DE LA SUPERINTENDENCIA NACIONAL DE MIGRACIONES, CONFORME AL INCISO C) DEL ARTICULO 55 DEL DECRETO LEGISLATIVO N° 1049.");

			    		$arrConstancia[]=array('constancia'=>$constancia_conclusion);
				    }

					$cr++;
					$txtListRepresentantes[$cr]=$REPRESENTATE;

				}
				
				if($cr>1){
					$nombra="QUIENES PROCEDEN";
				}else{
					$nombra="QUIEN PROCEDE";
				}
				if($cr>0){
				foreach ($txtListRepresentantes as $key => $value) {
					$TRANSFERENTES=$value."EN REPRESENTACION DE ".
				fNegrita("".str_replace("","",(strtolower())).str_replace("","",str_replace("","",strtoupper(utf8_decode($row_consulNaturales_dp_parte1["nombre"]))))).				  
				" ";
				if($row_consulNaturales_dp_parte1["benef_final"]=="SI")
					$TRANSFERENTES.=utf8_decode(strtoupper("respecto de la que, conforme a lo establecido en el primer párrafo del artículo 9 del Decreto Legislativo N° 1372, se ha cumplido con verificar en el sistema SUNAT, la presentación de la Declaración del Beneficiario Final, cuya información mostrada por el sistema, se imprime e inserta en el presente instrumento."));
				else if($row_consulNaturales_dp_parte1["benef_final"]=="NO")
					$TRANSFERENTES.=utf8_decode(strtoupper("respecto de la que, conforme a lo establecido en el primer párrafo del artículo 9 del Decreto Legislativo N° 1372, se ha cumplido con verificar en el sistema SUNAT, que ésta no ha presentado la Declaración del Beneficiario Final."));
				else
					$TRANSFERENTES.=utf8_decode("SEGÚN FACULTADES QUE CONSTAN EN LA PARTIDA ELECTRONICA NÚMERO ").$numpartida." DEL REGISTRO DE PERSONAS JURIDICAS DE ".strtoupper($_sede).".";

					$txtListContratantes[]=array('contratante'=>strtoupper($TRANSFERENTES));
					}
				}


				$COMOAPODERADO.=" EN CALIDAD DE APODERADO FINANCIERO DE LA EMPRESA ".NEGRITA("".str_replace("?","?",(strtolower($evalsexo))).str_replace("*","&",str_replace("?","'",strtoupper(utf8_decode($row_consulNaturales_dp_parte1["nombre"])))))."".", ";
					

				
				 
			}
			
		}//FIN DEL WHILE
		
	 }
	}



/*CUANDO UN REPRE... REPRESENTA A MAS UN UN CONTRATANTE*/
$dataRepresentantes="";

   
		
	//FIN DEL FOR
	## VENDEDORES DERECHO PROPIO			
	for($i = 0; $i <= $conteo_consulNaturales_dp_parte2 -1; $i++)
	{
		while($row_consulNaturales_dp_parte2 = mysql_fetch_array($consulNaturales_dp_parte2)){
				
			if($row_consulNaturales_dp_parte2['tipper']=="N"){
				//validacion estado civil
				if($row_consulNaturales_dp_parte2['ecivil']=="CASADO"){				
	
					$rowconyuge1="";		
					$consulconyuge2 = mysql_query('
					SELECT 
					  CONCAT(
						c.prinom,
						" ",
						c.segnom,
						" ",
						c.apepat,
						" ",
						c.apemat
					  ) AS conyuge,
					  n.`descripcion`,
					  t.`destipdoc`,
					  c.`numdoc`,
					  if(trim(c.`detaprofesion`)<>"",c.`detaprofesion`,"<NO ESPECIFICADA>") AS detaprofesion,
					  r.dessede AS idsedeconyuge,
					  c.`partidaconyuge`,
					  c.`separaciondebienes` 
					FROM
					  cliente c 
					  LEFT JOIN `nacionalidades` n 
						ON n.`idnacionalidad` = c.`nacionalidad` 
					  LEFT JOIN tipodocumento t 
						ON t.idtipdoc = c.idtipdoc 
					  LEFT JOIN cliente2 c2 
						ON c2.`idcliente` = c.`conyuge` 
					  LEFT JOIN sedesregistrales r 
   						 ON r.`idsedereg` = c.`idsedeconyuge` 
					WHERE c.`idcliente` = "'.$row_consulNaturales_dp_parte2['conyuge'].'"', $conn) or die("==>11".mysql_error());
									
					$rowconyuge2= mysql_fetch_array($consulconyuge2);	
					$conyuge = $rowconyuge2['conyuge']=='' ? "" : $rowconyuge2['conyuge'];
					$nacionalidad_conyuge = $rowconyuge2['descripcion']=='' ? "" : $rowconyuge2['descripcion'];
					$tipodoc_conyuge = $rowconyuge2['destipdoc']=='' ? "" : $rowconyuge2['destipdoc'];
					$numdoc_conyuge = $rowconyuge2['numdoc']=='' ? "" : $rowconyuge2['numdoc'];
					$ocupacion_conyuge = $rowconyuge2['detaprofesion']=='' ? "<OCUPACION NO ESPECIFICADA>" : $rowconyuge2['detaprofesion'];
					
					if(trim($conyuge)!=""){
					$texto_conyuge = " con ".NEGRITA($conyuge,$CHAR_NEGRITA);
					
				
					}
				}else{
					
					$texto_conyuge="";				
					$ambos="";
					$interviene="interviene";
				}
				
				//EVALUACION DEL SEXO DEL CONTRATANTE
				
				if($row_consulNaturales_dp_parte2["sexo"]=="M")
				{
					$evalsexo = "";	
					$iden = "identificado";	
					$domicilado="domiciliado";
					$nacionalidad=substr(trim($row_consulNaturales_dp_parte2["nacionalidad"]),0,-1)."o";
					if($row_consulNaturales_dp_parte2['ecivil']=="SOLTERO" || $row_consulNaturales_dp_parte2['ecivil']=="CASADO" || $row_consulNaturales_dp_parte2['ecivil']=="VIUDO" || $row_consulNaturales_dp_parte2['ecivil']=="DIVORCIADO" ){
						$estc=substr($row_consulNaturales_dp_parte2['ecivil'],0,-1);
						$estcivil=strtolower($estc."o");
					}else if($row_consulNaturales_dp_parte2['ecivil']=="CONVIVIENTE" ){
						$estcivil="conviviente";
					}
					
				}
				else if($row_consulNaturales_dp_parte2["sexo"]=="F")
				{
					$evalsexo ="";
					$iden = "identificada";	
					$domicilado="domiciliada";
					$nacionalidad=substr(trim($row_consulNaturales_dp_parte2["nacionalidad"]),0,-1)."a";
					if($row_consulNaturales_dp_parte2['ecivil']=="SOLTERO" || $row_consulNaturales_dp_parte2['ecivil']=="CASADO" || $row_consulNaturales_dp_parte2['ecivil']=="VIUDO" || $row_consulNaturales_dp_parte2['ecivil']=="DIVORCIADO" ){
						$estc=substr($row_consulNaturales_dp_parte2['ecivil'],0,-1);
						$estcivil=strtolower($estc."a");
					}else if($row_consulNaturales_dp_parte2['ecivil']=="CONVIVIENTE" ){
						$estcivil="conviviente";
					}
				}
				
				//evalua ocupacion:
				if($row_consulNaturales_dp_parte2["Ocupacion"]=="")
				{
					$evalocupacion = "<OCUPACION NO ESPECIFICADA>";	
				}
				else if($row_consulNaturales_dp_parte2["Ocupacion"]!="")
				{
					$evalocupacion = utf8_decode($row_consulNaturales_dp_parte2["Ocupacion"]);	
				}
				
				if($row_consulNaturales_dp_parte2['condicion']=="VENDEDOR"){				
					 $var=$row_consulNaturales_dp_parte2['condicion'];
				}else if ($row_consulNaturales_dp_parte2['condicion']=="COMPRADOR"){
					 $var=$row_consulNaturales_dp_parte2['condicion'];
				}
			

			if($row_consulNaturales_dp_parte1['cantRepre']==""){	
				//buscamos al representante	
				$consul_repre = mysql_query('	SELECT "" AS DATA ', $conn) or die("==>22".mysql_error());
				
				$REPRESENTATE="";
				$DERECHO="";
				if($row_consulNaturales_dp_parte2['tiporepresentacion']=="0"){
					$DERECHO=" quien procede por SU propio derecho";
				}else if($row_consulNaturales_dp_parte2['tiporepresentacion']=="1"){
					$DERECHO="procede en nombre y representacion";
				}else if($row_consulNaturales_dp_parte2['tiporepresentacion']=="2"){
					$DERECHO="por su propio derecho y en representacion";
				}
								
				while($row_repre=mysql_fetch_array($consul_repre)){
					if($row_repre["tipper"]=="N"){					
						$REPRESENTATE.=" de ".fNegrita($row_repre["nombre"]).$SEPARAESTILOS." IDENTIFICADO CON ".$row_repre["destipdoc"].utf8_decode(" NÚMERO ").$row_repre["numdoc"].", QUIEN MANIFIESTA SER ".$row_repre["desestcivil"].", OCUPACION ".$row_repre["detaprofesion"]." ";						
					}else if($row_repre["tipper"]=="J"){
						$REPRESENTATE.=" de la empresa ".fNegrita(str_replace("  "," ",$row_repre["nombre"])).$SEPARAESTILOS.", con domicilio en ".utf8_decode($row_repre["direccion"]).", ".$row_repre["Distrito"].", según facultades que constan inscritas en la partida electronica numero ".NEGRITA($row_repre["partida"]).$SEPARAESTILOS." del Registro de Personas Juridicas ".NEGRITA(str_replace("  "," ","DE ".strtoupper(substr($row_repre["dessede"],4,12)))).$SEPARAESTILOS.", y a su vez ";								
					}					
				}
				$REPRESENTATE.="*";
				$REPRESENTATE=str_replace(", y a su vez *",".",$REPRESENTATE);
				$REPRESENTATE = $REPRESENTATE=='*' ? "" : $REPRESENTATE;	
				
				$ADQUIRENTES.=	
				fNegrita(" ".$row_consulNaturales_dp_parte2["nombre"])." ".	
				"DE NACIONALIDAD ".NEGRITA($row_consulNaturales_dp_parte2["nacionalidad"]).$SEPARAESTILOS.", ".
				"ESTADO CIVIL ".NEGRITA($estcivil)."".", ".
				"OCUPACION ".NEGRITA($evalocupacion)."".", ".$ambos."".
				"CON DOMICILIO EN ".holaacentos4(ucwords(strtolower(utf8_decode($row_consulNaturales_dp_parte2["direccion"].",  ".$row_consulNaturales_dp_parte2["Distrito"]))))." ".
				"SE IDENTIFICA CON ".
				holaacentos4(ucwords(strtolower(utf8_decode(holaacentos4($row_consulNaturales_dp_parte2["tipo_docu"])))))." ".utf8_decode("NÚMERO ").$row_consulNaturales_dp_parte2["numdoc"].", ".
				"QUIEN PROCEDE POR SU PROPIO DERECHO. ".utf8_decode("")." ".chr(10);	
				//aui se elimino $REPRESENTATE
			 }
			}else{
				
			if($row_consulNaturales_dp_parte1['cantRepre']==""){
				
				//buscamos al representante			
				$consul_repre = mysql_query('		
				SELECT "" AS DATA ', $conn) or die("==>33".mysql_error());
				
				
								
				$REPRESENTATE="";$COMOAPODERADO="";$cr=0;
				while($row_repre=mysql_fetch_array($consul_repre)){
					$REPRESENTATE.=
					fNegrita($row_repre["nombre"]).", quien se identifico con ".$row_repre["destipdoc"].utf8_decode(" N° ").
					NEGRITA($row_repre["numdoc"],"")." y ";
					$COMOAPODERADO.=NEGRITA($row_repre["nombre"],"")." ";
					$cr++;
				}
				if($cr>1){
					$nombra="CUYOS NOMBRAMIENTOS Y FACULTADES";
				}else{
					$nombra="CUYO NOMBRAMIENTO Y FACULTAD";
				}

				$ADQUIRENTES.=$REPRESENTATE." QUIEN PROCEDE EN REPRESENTACION DE ".
				fNegrita("".str_replace("?","?",(strtolower(""))).str_replace("*","&",str_replace("?","'",strtoupper(utf8_decode($row_consulNaturales_dp_parte2["nombre"])))))."          ".
				utf8_decode("SEGUN FACULTADES QUE CONSTAN EN LA PARTIDA ELECTRONICA NÚMERO ").$row_consulNaturales_dp_parte2["numpartida"]." DEL REGISTRO DE PERSONAS JURIDICAS DE ".strtoupper($row_consulNaturales_dp_parte2["idsedereg"]).".  ".chr(10);
								
				$COMOAPODERADO.=" EN CALIDAD DE APODERADO FINANCIERO DE LA EMPRESA ".NEGRITA("".str_replace("?","?",(strtolower($evalsexo))).str_replace("*","&",str_replace("?","'",strtoupper(utf8_decode($row_consulNaturales_dp_parte2["nombre"])))),"").chr(10);
				
			}
		 }
		}//FIN DEL WHILE
		
	}//FIN DEL FOR	

	$eval_mostrar_persona_int="";$conintervencion="";

	
	$eval_mostrar_persona_int=substr($eval_mostrar_persona_int,0,-2);
	
	## CARACTERISTICAS DEL VEHICULO
	$placa="";$marca="";$modelo="";$clase="";$carroceria="";$color="";
	$anio="";$motor="";$serie="";$combustible="";$partida="";$sede="";$categoria="";

	
	$vvCont=0;
	$vvContSexo="";
	##CABECERA PARA LOS CONTRATANTES
	while ($res1=mysqli_fetch_assoc($contratantesnew1)){	
			if($res1['tipper']=="J")
				$eval_mostrar_persona_tran.=$res1['razonsocial'].", ";
			else 
				$eval_mostrar_persona_tran.=$res1['cliente'].", ";

		$vvCont++;
		$vvContSexo=$res1['sexo'];
	}
	$eval_mostrar_personaInterv="";
	
	while ($res2=mysqli_fetch_assoc($contratantesnew2)){


			if($res2['tipper']=="J")
				$eval_mostrar_persona_adq.=$res2['razonsocial'].", ";
			else
				$eval_mostrar_persona_adq.=$res2['cliente'].", ";		

			$vvCont++;
			$vvContSexo=$res1['sexo'];
	}
	while ($res3=mysqli_fetch_assoc($contratantesnew3)){


			if($res3['tipper']=="J")
				$eval_mostrar_personaInterv.=$res3['razonsocial'].", ";
			else
				$eval_mostrar_personaInterv.=$res3['cliente'].", ";		

			$vvCont++;
			$vvContSexo=$res1['sexo'];
	}
	
	//PARSEAMOS LA COMA FINAL
	$eval_mostrar_persona_tran=trim(substr($eval_mostrar_persona_tran,0,-2));
	$eval_mostrar_persona_adq=trim(substr($eval_mostrar_persona_adq,0,-2));
	$eval_mostrar_personaInterv=trim(substr($eval_mostrar_personaInterv,0,-2));

//JNCARLO
	$titulo=strtoupper($rowcabecera2["contrato"]);

	$num_escritura    		= $rowcabecera1["escritura"];
	$num_escritura_letras2	= $letras->fun_nume_letras($num_escritura);

	$num_minuta       		= $rowcabecera1["numminuta"];
//$idtipacto=="032" || $idtipacto=="034"
	
	##TIPO  MINUTA
	$cert_constitucion="";
	if($idtipacto=="033" or $idtipacto=="036"){
		$cert_constitucion="CERTIFICO: QUE LOS OTORGANTES EXHIBIERON EL FORMATO DE LA PERSONA NATURAL QUE CALIFICA COMO BENEFICIARIO FINAL DE CONFORMIDAD CON EL ARTÍCULO 10 DEL DECRETO SUPREMO N°003-2019-EF";
		$cert_constitucion=utf8_decode($cert_constitucion);
	}

	$eval_mostrar_persona_tran= str_replace("Ñ","N",$eval_mostrar_persona_tran);
	$eval_mostrar_persona_adq= str_replace("Ñ","N",$eval_mostrar_persona_adq);
	$eval_mostrar_personaInterv= str_replace("Ñ","N",$eval_mostrar_personaInterv);
	$subtitulo="";
	if(true){
		if($eval_mostrar_persona_tran!="")
			$subtitulo="QUE OTORGA: ".$eval_mostrar_persona_tran." ";

		if($eval_mostrar_persona_adq!=""){
			if($idtipacto!="033")
				$subtitulo.=" A FAVOR DE: ";
			else
				$subtitulo.=", ";
			$subtitulo.=$eval_mostrar_persona_adq." ";
		}
		if($eval_mostrar_personaInterv!="")
			$subtitulo.=" CON INTERVENCION DE: ".$eval_mostrar_personaInterv;
	}



	$subtitulo22=utf8_decode($subtitulo);
	$subtitulo22=str_replace(",",", ",utf8_decode($subtitulo22));
	$subtitulo22=str_replace(":"," ",utf8_decode($subtitulo22));
	//$subtitulo22=str_replace(",","",$subtitulo22_);
	
	$sellos_biometrico="";
	$sellos_advertencia="";	
	$insertos_general="";

	//FIRMAS 
	$exe_firmas=mysql_query("
	SELECT 
	  TRIM(
		CONCAT(
		  IFNULL(c2.`prinom`, ''),
		  ' ',
		  IFNULL(c2.`segnom`, ''),
		  ' ',
		  IFNULL(c2.`apepat`, ''),
		  ' ',
		  IFNULL(c2.`apemat`, ''),
		  IFNULL(c2.razonsocial, '')
		)
	  ) AS cliente,
	  c.fechafirma,
	  c.firma,
	  (
		CASE
		  WHEN TRIM(a.`condicion`) = 'REPRESENTANTE' 
		  THEN a_rdo.condicion 
		  WHEN TRIM(a.`condicion`) = 'APODERADO' 
		  THEN a_rdo.condicion 
		  ELSE a.`condicion` 
		END
	  ) AS condicion 
	FROM
	  cliente2 c2 
	  INNER JOIN contratantes c 
		ON c.idcontratante = c2.idcontratante 
	  INNER JOIN contratantesxacto ca 
		ON c.idcontratante = ca.idcontratante 
	  INNER JOIN actocondicion a 
		ON ca.`idcondicion` = a.`idcondicion` 
	  LEFT JOIN representantes r 
		ON r.`idcontratante` = c.`idcontratante` 
	  LEFT JOIN cliente2 c2_rdo 
		ON r.`idcontratante_r` = c2_rdo.`idcliente` 
	  LEFT JOIN contratantesxacto ca_rdo 
		ON ca_rdo.`idcontratante` = c2_rdo.`idcontratante` 
	  LEFT JOIN actocondicion a_rdo 
		ON a_rdo.`idcondicion` = ca_rdo.`idcondicion` 
	WHERE c.kardex = '".$num_kardex."' 
	  AND c2.`tipper` = 'N' 
	  AND c.firma = '1' 
	GROUP BY c.idcontratante 
	",$conn) or die ("data"."==>".mysql_error());

	$contador_firmas=1;
	while($row_exe_firmas=mysql_fetch_array($exe_firmas)){
		$rayafirma=RAYAFIRMAS(strlen($row_exe_firmas["cliente"]));
		if($row_exe_firmas["fechafirma"]!=""){
			$firmo=utf8_decode("FIRMADO: ".$row_exe_firmas["fechafirma"]);
		}else{
			$firmo="";
		}
		$firmador.=$row_exe_firmas["cliente"].";";
		if(($contador_firmas % 2)==1){
			$dataFirmas[]=array('firma'=>$rayafirma.chr(10)."\n".$row_exe_firmas["cliente"].chr(10).chr(10).utf8_decode(" FIRMO EL: ".$fecha->fun_fech_letras(fechan_abd($row_exe_firmas["fechafirma"]))).chr(10));
		}else if(($contador_firmas % 2)==0){
			$dataFirmas2[]=array('firma'=>$rayafirma.chr(10)."\n".$row_exe_firmas["cliente"].chr(10).chr(10).utf8_decode(" FIRMO EL: ".$fecha->fun_fech_letras(fechan_abd($row_exe_firmas["fechafirma"]))).chr(10));
		}
		$contador_firmas++;
	}


	//medios de pago anidados



	$querypagos=mysqli_query($conn_i,"
	SELECT 
	  mp.`desmpagos`,dmp.`codmepag`,
	  COUNT(dmp.`codmepag`) AS conteo ,
	    b.`desbanco`,
	   TRIM(
				REPLACE(
				  CONCAT(
					IFNULL(CONCAT(TRIM(c2.`prinom`), ' '), ''),
					IFNULL(CONCAT(TRIM(c2.`segnom`), ' '), ''),
					IFNULL(CONCAT(TRIM(c2.`apepat`), ' '), ''),
					IFNULL(CONCAT(TRIM(c2.`apemat`), ' '), ''),
					IFNULL(
					  CONCAT(TRIM(c2.`razonsocial`), ''),
					  ''
					)
				  ),
				  '  ',
				  ' '
				)
			  ) AS 'cliente' 
	FROM
	  detallemediopago dmp 
	  LEFT JOIN mediospago mp 
		ON mp.`codmepag` = dmp.`codmepag` 
	 LEFT JOIN cliente2 c2 
    	ON dmp.`idcontratante` = c2.idcontratante 
	 LEFT JOIN bancos b 
		ON dmp.`idbancos`=b.`idbancos`
	WHERE dmp.`kardex` = '".$num_kardex."' 
	  AND dmp.`exhibio` = '1' 
	GROUP BY dmp.`codmepag` 
	");


	if($querypagos!=false && mysqli_num_rows($querypagos)>0){
		
		$texto_mediopago=utf8_decode("SEGÚN LEY N° 28194: SE EXHIBE LO SIGUIENTE: ");			
		while($row_querypagos=mysqli_fetch_assoc($querypagos)){
			
			$querydetmedio=mysqli_query($conn_i,"
			SELECT 
			  m.`simbolo`,
			  dmp.`importemp`,
			  CONCAT(' Y 00/100 ', m.`desmon`) AS desmon,
			  dmp.`foperacion`,
			  mp.`desmpagos` ,
			  b.`desbanco`,
			  dmp.`documentos`,
			  TRIM(
				REPLACE(
				  CONCAT(
					IFNULL(CONCAT(TRIM(c2.`prinom`), ' '), ''),
					IFNULL(CONCAT(TRIM(c2.`segnom`), ' '), ''),
					IFNULL(CONCAT(TRIM(c2.`apepat`), ' '), ''),
					IFNULL(CONCAT(TRIM(c2.`apemat`), ' '), ''),
					IFNULL(
					  CONCAT(TRIM(c2.`razonsocial`), ''),
					  ''
					)
				  ),
				  '  ',
				  ' '
				)
			  ) AS 'cliente' 
			FROM
			  detallemediopago dmp 
			  INNER JOIN monedas m 
				ON m.`idmon` = dmp.`idmon` 
			  LEFT JOIN mediospago mp 
				ON mp.`codmepag` = dmp.`codmepag` 
			  LEFT JOIN bancos b 
				ON dmp.`idbancos`=b.`idbancos`
			  LEFT JOIN cliente2 c2 
    			ON dmp.`idcontratante` = c2.idcontratante 
			WHERE KARDEX = '".$num_kardex."'  and dmp.`exhibio` = '1' AND dmp.`codmepag` = '".$row_querypagos["codmepag"]."'  
			");
					
			$num_deposito=utf8_decode(numtoletras($row_querypagos["conteo"]));				
			$texto_mediopago.=$num_deposito." ".$row_querypagos["desmpagos"]." del ".$row_querypagos["desbanco"];
			$i_m=1;
			while($row_mediospago=mysqli_fetch_array($querydetmedio)){
				
				if($row_querypagos["conteo"]>1){
					$num=", EL ".numeroTipo($i_m)." ";
				}
				
				$fecha_dmp= $fecha->fun_fech_corta_3(implode("/", array_reverse(explode("/", $row_mediospago["foperacion"]))));	
										
				$descript.=$num." por el importe de ".$row_mediospago["simbolo"]." ".number_format($row_mediospago["importemp"],2,".",",")
							." (".(numtoletras($row_mediospago["importemp"])).$row_mediospago["desmon"].")"
							.utf8_decode(", de fecha: ".str_replace("X","Ñ",$fecha_dmp))
							.utf8_decode(", NÚMERO ").$row_mediospago["documentos"];				
				$i_m++;
			}
			
			$texto_mediopago.=$descript;
			$texto_mediopago.=", a la orden de ".$row_querypagos["cliente"].", ";	
			$descript="";			
		}
	}else{
		$texto_mediopago=utf8_decode("SEGÚN LEY N° 28194:")." NO EXHIBEN NINGUNO";
	}
	
	$texto_mediopago=strtoupper(substr($texto_mediopago,0,-2));
	
	$ACTA_CONEXO="";
	$FECHAACTA_CONEXO="";
	$PLACA_CONEXO="";
		
	if(trim($rowcabecera1["kardexconexo"])!=""){
		$query_conexo=mysqli_query($conn_i,"
		SELECT 
		  k.fechaescritura,
		  k.numescritura,
		  d.`numplaca` 
		FROM
		  kardex k 
		  LEFT JOIN detallevehicular d 
			ON d.`kardex` = k.`kardex` 
		WHERE k.kardex = '".$rowcabecera1["kardexconexo"]."'");
		$row_conexo=mysqli_fetch_assoc($query_conexo);
		$ACTA_CONEXO=strtoupper($letras->fun_nume_letras($row_conexo["numescritura"]));
		$FECHAACTA_CONEXO= $fecha->fun_fech_letras(str_replace("-","/",$row_conexo["fechaescritura"]));
		$PLACA_CONEXO=strtoupper($row_conexo["numplaca"]);
	}
		

		
	$USUARIO_QUERY=mysqli_query($conn_i,"
	SELECT 
	  TRIM(
		REPLACE(
		  TRIM(
			CONCAT(
			  LEFT(prinom, 1),
			  LEFT(segnom, 1),
			  LEFT(apepat, 1),
			  LEFT(apemat, 1)
			)
		  ),
		  ' ',
		  ''
		)
	  ) AS responsable 
	FROM
	  usuarios u 
	WHERE u.`idusuario` = '".$_SESSION["id_usu"]."' ");
	
	$ROW_USUARIO=mysqli_fetch_assoc($USUARIO_QUERY);
	$RESPONSABLE=$ROW_USUARIO["responsable"];
	
	$TEXTO_MEDIOPAGO		= strtoupper($texto_mediopago);
	$FIRMADOR				= strtoupper(substr(trim($firmador),0,-1));
	$TRANSFERENTES			= str_replace("  "," ",strtoupper(trim($TRANSFERENTES)));
	$ADQUIRENTES			= str_replace("  "," ",strtoupper(trim($ADQUIRENTES)));
	$REPRESENTANTES			= trim($REPRESENTANTES);		
	//Carga la plantilla;
	$file_name      		= $ruta_plantilla["ruta_guardar"]."__PROY__".$num_kardex."."."docx";	
	$file_name_show 		= $num_kardex.$extension;
	$PREACATA="INSTRUMENTO";	
	$INTERVINIENTES="";
	$titulo=substr($titulo,0,strlen(trim($titulo))-1);

	if(trim($FECHA_CONCLUSION)=='CERO  DE  DEL CERO')
		$FECHA_CONCLUSION="";
	if(trim($num_escritura_letras2)=="CERO")
			$num_escritura_letras2="";


if(trim($FECHA_GENERADO)=='CERO  DE  DEL CERO')
		$FECHA_GENERADO="";
else
	$FECHA_GENERADO=utf8_decode($FECHA_GENERADO);

$FECHA_GENERADO=trim($FECHA_GENERADO);
if(trim($num_escritura_letras2)=="CERO")
			$num_escritura_letras2="";

$numeroskardex=$num_kardex;
$num_minuta= $rowcabecera1["numminuta"];
$strMinuta=utf8_decode("MINUTA : SEÑOR NOTARIO");
	if(trim($num_minuta=="S/M")) 
		$strMinuta="";


$textoCompareciente=""; 
if($num_minuta!="" && $num_minuta!="S/M" && (int)$num_minuta>0)
{

	//cuando hay minuta 

	if($vvCont>1)
	{

	$textoCompareciente="LOS COMPARECIENTES: A QUIENES IDENTIFICO, SON MAYORES DE EDAD E INTELIGENTES EN EL IDIOMA CASTELLANO, QUIENES PROCEDEN CON CAPACIDAD, LIBERTAD Y CONOCIMIENTO BASTANTE PARA CONTRATAR HAN SIDO ADVERTIDAS SOBRE LOS EFECTOS Y OBLIGACIONES LEGALES DE ESTE INSTRUMENTO PÚBLICO Y ME ENTREGAN UNA MINUTA FIRMADA PARA QUE SU CONTENIDO SEA ELEVADO A ESCRITURA PÚBLICA, LA MISMA QUE ARCHIVO EN MI LEGAJO RESPECTIVO BAJO EL NÚMERO DE ORDEN CORRESPONDIENTE Y CUYO TENOR LITERAL ES EL SIGUIENTE.";
	}else
	{
		switch ($vvContSexo) {
			case 'F':
		

			$textoCompareciente="LA COMPARECIENTE: A QUIEN IDENTIFICO, ES MAYOR DE EDAD E INTELIGENTE EN EL IDIOMA CASTELLANO, QUIEN PROCEDE CON CAPACIDAD, LIBERTAD Y CONOCIMIENTO BASTANTE PARA CONTRATAR HA SIDO ADVERTIDA SOBRE LOS EFECTOS Y OBLIGACIONES LEGALES DE ESTE INSTRUMENTO PÚBLICO Y ME ENTREGA UNA MINUTA FIRMADA PARA QUE SU CONTENIDO SEA ELEVADO A ESCRITURA PÚBLICA, LA MISMA QUE ARCHIVO EN MI LEGAJO RESPECTIVO BAJO EL NÚMERO DE ORDEN CORRESPONDIENTE Y CUYO TENOR LITERAL ES EL SIGUIENTE. ";

				break;
			
			default:
				$textoCompareciente="EL COMPARECIENTE: A QUIEN IDENTIFICO, ES MAYOR DE EDAD E INTELIGENTE EN EL IDIOMA CASTELLANO, QUIEN PROCEDE CON CAPACIDAD, LIBERTAD Y CONOCIMIENTO BASTANTE PARA CONTRATAR HA SIDO ADVERTIDO SOBRE LOS EFECTOS Y OBLIGACIONES LEGALES DE ESTE INSTRUMENTO PÚBLICO Y ME ENTREGA UNA MINUTA FIRMADA PARA QUE SU CONTENIDO SEA ELEVADO A ESCRITURA PÚBLICA, LA MISMA QUE ARCHIVO EN MI LEGAJO RESPECTIVO BAJO EL NÚMERO DE ORDEN CORRESPONDIENTE Y CUYO TENOR LITERAL ES EL SIGUIENTE. ";
				break;
		}	
	}
}else if(trim($num_minuta)=="S/M" || trim($num_minuta)=="")
{	
	$strAdicionalSinMin="";
	if($idtipacto=="888")
		$strAdicionalSinMin=" CONFORME AL INCISO A) DEL";
	else 
		$strAdicionalSinMin=" AL";

	if($vvCont>1)
	{
		$textoCompareciente="LOS COMPARECIENTES: A QUIENES IDENTIFICO SON MAYORES DE EDAD E INTELIGENTES EN EL IDIOMA CASTELLANO, QUIENES PROCEDEN CON CAPACIDAD, LIBERTAD Y CONOCIMIENTO BASTANTE PARA CONTRATAR HAN SIDO ADVERTIDAS SOBRE LOS EFECTOS Y OBLIGACIONES LEGALES DE ESTE INSTRUMENTO PÚBLICO Y OTORGAN LA PRESENTE ESCRITURA PUBLICA CONFORME".$strAdicionalSinMin." ARTICULO 58 DEL DECRETO LEGISLATIVO 1049.";
	}else
	{

		switch ($vvContSexo) {
			case 'F':
			$textoCompareciente="LA COMPARECIENTE: A QUIEN IDENTIFICO ES MAYOR DE EDAD E INTELIGENTE EN EL IDIOMA CASTELLANO, QUIEN PROCEDE CON CAPACIDAD, LIBERTAD Y CONOCIMIENTO BASTANTE PARA CONTRATAR HA SIDO ADVERTIDA SOBRE LOS EFECTOS Y OBLIGACIONES LEGALES DE ESTE INSTRUMENTO PÚBLICO Y OTORGAN LA PRESENTE ESCRITURA PUBLICA CONFORME".$strAdicionalSinMin." ARTICULO 58 DEL DECRETO LEGISLATIVO 1049.";
				break;
			
			default:
				$textoCompareciente="EL COMPARECIENTE: A QUIEN IDENTIFICO ES MAYOR DE EDAD E INTELIGENTE EN EL IDIOMA CASTELLANO, QUIEN PROCEDE CON CAPACIDAD, LIBERTAD Y CONOCIMIENTO BASTANTE PARA CONTRATAR HA SIDO ADVERTIDO SOBRE LOS EFECTOS Y OBLIGACIONES LEGALES DE ESTE INSTRUMENTO PÚBLICO Y OTORGAN LA PRESENTE ESCRITURA PUBLICA CONFORME".$strAdicionalSinMin." ARTICULO 58 DEL DECRETO LEGISLATIVO 1049.";
				break;
		}
	}
}

$textoCompareciente=utf8_decode($textoCompareciente);

//CONTRATANTES NO ASOCIADOS A CONTRATANTES
$listRepresentantesNoAsociados="
SELECT DISTINCT cl2.idcliente,cl2.nombre,n.`descripcion`,desestcivil,cn.kardex,
(SELECT  CONCAT(
		cc2.prinom,
		' ',
		cc2.segnom,
		' ',
		cc2.apepat,
		' ',
		cc2.apemat,
		cc2.razonsocial
	  ) AS nombreconyuge FROM cliente2 cc2
		WHERE cc2.idcliente=LPAD(cl2.conyuge,10,0) LIMIT 1) AS nombreConyuge,
	cl2.detaprofesion,cl2.direccion,
	u.coddis,
				  u.codpto,
				  u.codprov,
				  u.nomdis,
				  u.nomprov,
				  u.nomdpto,
				  cl2.tipper,
				  cl2.idtipdoc

 FROM `contratantes` cn 
INNER JOIN cliente2 cl2
ON cn.`idcontratante`=cl2.idcontratante
LEFT JOIN nacionalidades n 
ON cl2.`nacionalidad` = n.`idnacionalidad`
LEFT  JOIN tipoestacivil civ 
ON cl2.`idestcivil` = civ.`idestcivil` 
LEFT OUTER JOIN ubigeo u  ON  cl2.idubigeo=u.coddis
WHERE cn.kardex='".$num_kardex."' AND
(SELECT COUNT(idcontratante) FROM representantes WHERE idcontratante=cn.`idcontratante` AND kardex=cn.kardex)=0 AND
 cn.tiporepresentacion=1 ";

$consul_repre2=mysql_query($listRepresentantesNoAsociados,$conn);

$REPRESENTATE="";
while($row_repre=mysql_fetch_array($consul_repre2)){

					$numPartida="0";					
					$_sede="<NO ESPECIFICADA>";
					
				 
						$cont++;
					if($row_repre["tipper"]=="N"){	

						$REPRESENTATE=fNegrita($row_repre["nombre"]).", DE NACIONALIDAD ".$row_repre["descripcion"].", ESTADO CIVIL ";
					if($row_repre['sexo']=="F"){
						if($row_repre['desestcivil']!="")
						{
							
								$REPRESENTATE.=substr($row_repre['desestcivil'],0,-1)."A";
							
							if($row_repre['desestcivil']=="CASADO" && $row_repre['nombreConyuge']!=""){
								$REPRESENTATE.=" CON ".$row_repre['nombreConyuge'];
							}
						}
							$REPRESENTATE.=", OCUPACIÓN ".$row_repre['detaprofesion'].", CON DOMICILIO EN ".utf8_decode($row_repre['direccion'])." ";


					}else{
						if($row_repre['desestcivil']!=""){	 						  
	 						
	 							$REPRESENTATE.=substr($row_repre['desestcivil'],0,-1)."O";
	 					

	 						if($row_repre['desestcivil']=="CASADO" && $row_repre['nombreConyuge']!=""){
								$REPRESENTATE.=" CON ".$row_repre['nombreConyuge'];
							}

	 					}
	 						$REPRESENTATE.=", OCUPACIÓN ".$row_repre['detaprofesion'].", CON DOMICILIO EN ".$row_repre['direccion']." ";
					}

					if($row_repre['coddis']=="999999")
							$REPRESENTATE.="DE TRANSITO POR ESTE PAIS";
						else{
							if($row_repre['codprov']=="01" && $row_repre['codpto']=="15")
								$REPRESENTATE.="DISTRITO DE ".$row_repre['nomdis'].", PROVINCIA Y DEPARTAMENTO DE LIMA";
							else
								$REPRESENTATE.=utf8_decode($row_repre["Distrito"]);
						}
						if(( $row_repre['codpto']!="" || $row_repre['coddis']!="" )&& $row_repre['codpto']!="15" && $row_repre['coddis']!="999999") 
							$REPRESENTATE.="DE TRANSITO POR ESTA CIUDAD";

					$REPRESENTATE.=", SE IDENTIFICA CON ".$row_repre["destipdoc"]." NÚMERO ".$row_repre["numdoc"]." Y ";
					if($row_repre['parte_generacion']==1||$row_repre['parte_generacion']==2||$row_repre['parte_generacion']==3)
						$REPRESENTATE.="QUIEN PROCEDE POR DERECHO PROPIO Y ";
					else
						$REPRESENTATE.="QUIEN PROCEDE EN REPRESENTACIÓN DE ";
					$REPRESENTATE=utf8_decode($REPRESENTATE);


					 if($row_repre["idtipdoc"]==2){
			    	$constancia_conclusion=utf8_decode(fNegrita("CONSTANCIA.- D.LEG N° 1232.-")." EL NOTARIO QUE AUTORIZA DEJA EXPRESA CONSTANCIA QUE ACCEDIO A LA BASE DE DATOS DEL REGISTRO DE CARNÉS DE EXTRANJERIA DE LA SUPERINTENDENCIA NACIONAL DE MIGRACIONES, CONFORME AL INCISO C) DEL ARTICULO 55 DEL DECRETO LEGISLATIVO N° 1049.");

			    	$arrConstancia[]=array('constancia'=>$constancia_conclusion);
				    }
				    else if($row_repre["idtipdoc"]==5){
				    	$constancia_conclusion=utf8_decode(fNegrita("CONSTANCIA.- D.LEG N° 1232.-")." EL NOTARIO QUE AUTORIZA DEJA EXPRESA CONSTANCIA QUE ACCEDIO A LA BASE DE DATOS DEL REGISTRO DE PASAPORTES DE LA SUPERINTENDENCIA NACIONAL DE MIGRACIONES, CONFORME AL INCISO C) DEL ARTICULO 55 DEL DECRETO LEGISLATIVO N° 1049.");

				    	$arrConstancia[]=array('constancia'=>$constancia_conclusion);
				    }


							
					}else if($row_repre["tipper"]=="J"){
						$REPRESENTATE=fNegrita(str_replace("  "," ",$row_repre["nombre"])).$SEPARAESTILOS.", con domicilio en ".utf8_decode($row_repre["direccion"]).", ".$row_repre["Distrito"].", según facultades que constan inscritas en la partida electronica numero ".NEGRITA($row_repre["partida"]).$SEPARAESTILOS." del Registro de Personas Juridicas DE ".strtoupper(substr($row_repre["dessede"],4,12)).", y a su vez ";								
					}
					$REPRESENTATE.=utf8_decode("<NO ESPECIFICA A QUIÉN REPRESENTA>");
					$dataContratantes_r[$cont]=$REPRESENTATE;
				 
		}

//FIN


$papel_ini=$PAPELINI;
$papel_fin=$PAPELFIN;
$fec_conclusion=$FECHA_CONCLUSION;
//die($FECHA_CONCLUSION);
$file_name="C:/Proyectos/BORRADOR/".$file_name;
//var_dump($file_name);

 	if($REPRESENTATE!="")
		$textoCompareciente=TRIM($REPRESENTATE).chr(10).trim($textoCompareciente);
	else
		$textoCompareciente=trim($textoCompareciente);
	
	$constancia=$arrConstancia[0]['constancia'];
		$TBS->LoadTemplate($template);
	$TBS->MergeBlock('a', $dataContratantes);
	$TBS->MergeBlock('b', $dataContratantes2);
	$TBS->MergeBlock('c', $dataContratantes_r);
	$TBS->MergeBlock('g', $dataFirmas);
	$TBS->MergeBlock('h', $dataFirmas2);
	$TBS->MergeBlock('i', $txtListContratantes);
	$TBS->MergeBlock('j', $arrConstancia);


	$TBS->PlugIn(OPENTBS_DELETE_COMMENTS);
    $TBS->Show(TBSZIP_FILE, $file_name);				
	

$sql="select nombre,so from servidor where idservidor='1'";
$rpta=mysqli_query($conn_i,$sql) or die(mysqli_error($conn_i)."ERROR ".$sql);
$row=mysqli_fetch_array($rpta);
$server = $row['nombre'];


if($server=="WINDOWS"){
	$directorio="\\"."\\".$server;
}else if($row["so"]=="LINUX"){
	$directorio="";
} 
 
$directorio.= "C:/Proyectos/BORRADOR/"."__PROY__".$num_kardex.".odt";



echo "Se genero el archivo: ".$file_name_show." satisfactoriamente.. !!";


?>



