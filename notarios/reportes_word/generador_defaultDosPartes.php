<?php 
require_once 'Phpdocx/Create/CreateDocx.inc';

$num_kardex       	= $_REQUEST["num_kardex"];
$grupoCliente=$_REQUEST['grupoCliente'];
$idtipoacto=$_REQUEST['idtipoacto'];

$rutaRaiz="C://Doc_Generados/templates/";
$header= $rutaRaiz."plantilla_protocolar_genericaUnaParteHeader.docx";
$footer=$rutaRaiz."plantilla_protocolar_genericaUnaParteFooter.docx";

$rutaFinalProyecto="";

$rutaVehicular="C:/Proyectos/Vehicular/";
$txtListContratantes=array();
	
	session_start(); 
	## 1.-CARGARMOS LAS LIBRERIAS
	include('../conexion.php');
	include('../conexion2.php');
	include('../extraprotocolares/view/funciones.php');
	include('../includes/tbs_class.php');
	include('../includes/tbs_plugin_opentbs.php');
	include('../includes/ClaseLetras.class.php');
	include('fecha_letra.php');



	## 2.-RECIBIMOS EL KARDEX Y LO CARGAMOS
	
	$sqlListaCliente="SELECT c2.idcliente,c2.tipper FROM `contratantes` con INNER JOIN cliente2 c2 ON 
	con.idcontratante=c2.idcontratante
	 WHERE con.kardex='".$num_kardex ."'";

	$queryListaCliente=mysqli_query($conn_i,$sqlListaCliente);

	$rutaReal="";
	$isValidarExhibio=0;
	$numPlantilla='';
	while($rowListaCliente=mysqli_fetch_array($queryListaCliente))
	{
		$rowListaCliente['idcliente']=trim($rowListaCliente['idcliente']);

		if($rutaReal==""){

			if($idtipoacto=="096"){//DONACION
				$rutaReal='plantilla_protocolar_Proyecto_tv4.docx';
			}else if($idtipoacto=="100"){//OPCION DE COMPRA
				
				$rutaReal='plantilla_protocolar_Proyecto_tv5.docx';
			
			}else if(trim($rowListaCliente['tipper'])=="J")
				{//0000379185 0000405205 0000380357 0000022616
					if($rowListaCliente['idcliente']=="0000022616"||$rowListaCliente['idcliente']=="0000383662"||$rowListaCliente['idcliente']=="0000384796" || $rowListaCliente['idcliente']=="0000409583" || $rowListaCliente["idcliente"]=="0000421248")
					{
						$rutaReal='plantilla_protocolar_Proyecto_tv2.docx'; //daichi
						$isValidarExhibio=1;
						$numPlantilla='tv2';
						//0000010923
					}else if($rowListaCliente['idcliente']=="0000010923" || $rowListaCliente['idcliente']=="0000411214") 
					{	

						$rutaReal='plantilla_protocolar_Proyecto_tv3.docx'; //dim
						$isValidarExhibio=1;
						$numPlantilla='tv3';
					}else if($rowListaCliente['idcliente']=="0000024723" || $rowListaCliente['idcliente']=="0000420792") 
					{	

						$rutaReal='plantilla_protocolar_Proyecto_tv2_adj.docx'; //adj
						$isValidarExhibio=1;
						$numPlantilla='tv2';
					}
				}
		}
	}
	if($rutaReal==""){
		$rutaReal='plantilla_protocolar_Proyecto_tv1.docx';
		$isValidarExhibio=1;
	}


$rutaFinalProyecto=$rutaRaiz.$rutaReal;


	$sql_idtipacto		= mysqli_query($conn_i,"select codactos from kardex where kardex='$num_kardex'") or die(mysqli_error($conn_i));
	$row_idtipacto		= mysqli_fetch_array($sql_idtipacto);	
	$idtipacto       	= $row_idtipacto["codactos"];	
	## 3.-EXTENSION DE LA PLANTILLA SEGUN CONFIGURACION
	
	## 4.-SELECCION DE LA PLANTILLA
		
	$titulo="";
	/*23 ES PROYECTO, 15 ES KARDEX, POR DEFECTO ES 23. LUEGO TOMAMOS EL 15 PARA DECIRLE QUE ES TIPOKARDEX DE TODAS FORMAS.*/ 
	if($_REQUEST["tipo"]==23){
		$tipo = 15;
		$tipoGuardar = 23;
	}
			
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
	$numcartabus 		= mysqli_query($conn_i,$busnumcarta) or die(mysqli_error($conn_i));
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
	## 8.-DATOS DEL VEHICULO
	$cosuldetvehiculos = mysqli_query($conn_i,'
	SELECT detallevehicular.numplaca AS "placa", 
	detallevehicular.marca AS "marca", 
	detallevehicular.clase AS "clase",
	detallevehicular.anofab AS "anio",
	detallevehicular.numserie AS "serie", 
	detallevehicular.color AS "color",
	detallevehicular.motor AS "motor", 
	detallevehicular.modelo AS "modelo", 
	detallevehicular.carroceria AS "carroceria",
	detallevehicular.pregistral as "partida",
	detallevehicular.`combustible` AS "combustible",
	UPPER(sedesregistrales.`dessede`) AS sede
	FROM detallevehicular 
	LEFT JOIN `sedesregistrales` ON sedesregistrales.`idsedereg`=detallevehicular.`idsedereg` 
	WHERE detallevehicular.kardex = "'.$num_kardex.'" ') or die(mysqli_error($conn_i));	
	$numvehiculos =  mysqli_num_rows($cosuldetvehiculos);
	## 9.-DATOS DEL PATRIMONIAL
	$cosulpreciovehi = mysqli_query($conn_i,'
	SELECT patrimonial.importetrans AS "precio" , 
	patrimonial.idmon AS "moneda",
	fpago_uif.descripcion AS "medio_pago", 
	monedas.simbolo, mediospago.desmpagos, 
	patrimonial.`exhibiomp`, 
	patrimonial.`idoppago` 
	FROM patrimonial
	INNER JOIN fpago_uif ON fpago_uif.id_fpago = patrimonial.fpago
	INNER JOIN monedas ON monedas.idmon = patrimonial.idmon
	LEFT JOIN detallemediopago ON patrimonial.kardex = detallemediopago.kardex
	LEFT JOIN mediospago ON detallemediopago.codmepag = mediospago.codmepag
	WHERE patrimonial.kardex = "'.$num_kardex.'" LIMIT 0,1 ') or die(mysqli_error($conn_i));
	$rowprevehi = mysqli_fetch_array($cosulpreciovehi);
	$numprevehi = mysqli_num_rows($cosulpreciovehi);
	## 10.-DATOS DEL KARDEX
	$consulcabecera1 = mysqli_query($conn_i,'
									SELECT kardex.numescritura as "escritura", kardex.kardex as "num_kardex",
									0 as "conMinuta",
									kardex.fechaescritura, 
									kardex.txa_minuta as "registro" ,
								    CURRENT_DATE() as fechaGenerado,
									 kardex.fechaconclusion as "fechaconclusion",
									kardex.numminuta as "numminuta" ,`FN_ONLYNUM`(kardex.kardex) AS numero,kardex.kardexconexo
									FROM kardex 
									WHERE kardex.kardex =  "'.$num_kardex.'" ') or die(mysqli_error($conn_i));
	$rowcabecera1 	 = mysqli_fetch_array($consulcabecera1);
	$consulcabecera2 = mysqli_query($conn_i,'
									SELECT kardex.referencia AS "referencia", kardex.contrato AS "contrato" 
									FROM kardex 
									WHERE kardex.kardex =   "'.$num_kardex.'" ') or die(mysqli_error($conn_i));
	$rowcabecera2 	 = mysqli_fetch_array($consulcabecera2);
	$consulfolio 	 = mysqli_query($conn_i,'
									SELECT kardex.folioini, kardex.foliofin, kardex.papelini, kardex.papelfin	
									FROM kardex 
									WHERE kardex.kardex = "'.$num_kardex.'" ') or die(mysqli_error($conn_i));
	$rowfolio = mysqli_fetch_array($consulfolio);	
	## 11.-CONTRATANTES
	//PARTE 1 ORDENANTE / TRANSFERNTE ETC
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
	GROUP BY contratantesxacto.`idcontratante`") or die(mysqli_error($conn_i));
	//PARTE 2 A FAVOR / ADQUIRENTE ETC
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
	GROUP BY contratantesxacto.`idcontratante`") or die(mysqli_error($conn_i));

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
	GROUP BY contratantesxacto.`idcontratante`") or die(mysqli_error($conn_i));
	
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
	  c2.`numpartida` AS numpartida,
	  SUBSTRING_INDEX(src.dessede,"- ",-1) as idsedereg,
	   fncCantidadRepresentantes(ca.kardex,ca.idcontratante)as cantRepre,
	  c2.separaciondebienes,
	  SUBSTRING_INDEX(srcconyuge.dessede,"- ",-1) as idsedereg2,
	  c2.partidaconyuge
	
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
	  LEFT JOIN cliente c2y 
		ON LPAD(c2.conyuge,10,0) = c2y.idcliente 
	  LEFT JOIN contratantes cny 
		ON cny.idcontratante = c2.`idcontratante` 
	  LEFT JOIN sedesregistrales src 
    	ON src.`idsedereg`=c2.`idsedereg`
      LEFT JOIN sedesregistrales srcconyuge 
    	ON srcconyuge.`idsedereg`=c2.`idsedeconyuge`
	WHERE ca.`kardex` = "'.$num_kardex.'" 
	  
	  AND (a.`parte_generacion` = "1" OR a.`parte_generacion` = "2" OR a.`parte_generacion` = "3" OR a.`parte_generacion` = "4" )
	GROUP BY ca.`idcontratante` HAVING a.parte_generacion   ', $conn) or die("1=>".mysql_error());
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
	  AND cn.`plantilla` = "1" 
	  AND a.`parte_generacion` = "2" 
	GROUP BY ca.`idcontratante`', $conn) or die("2=>".mysql_error());
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

	$FECHA_ESCRITURA  		= strtoupper($fecha->fun_fech_comple2(implode("/", array_reverse(explode("/", $rowcabecera1["fechaescritura"])))));	


	$FECHA_ESCRITURA=utf8_decode($FECHA_ESCRITURA);
  
	$sqlFechaGen="SELECT 
					fecha
					FROM
					  documentogenerados d 
					  LEFT JOIN usuarios u 
						ON u.`idusuario` = d.`usuario` 
					WHERE d.kardex = '".$num_kardex."' 
					AND flag='ESCRI' ORDER BY d.id DESC LIMIT 1";

	$queryFechaGen=mysql_query($sqlFechaGen);
	$rowFechGen=mysql_fetch_array($queryFechaGen);
	$FECHA_GENERADO  		= strtoupper($fecha->fun_fech_comple2($fechaGen_));	
	$fechaGen_="";

	if($rowFechGen['fecha']!=""){
		$fechaGenArr_=explode(" ",$rowFechGen['fecha']);
		if(sizeof($fechaGenArr_)>0)
			$fechaGen_=$fechaGenArr_[0];
		//$fechaGen_=fechabd_an($fechaGen_);
	}

	##TIPO  MINUTA
	if(trim($num_minuta=="S/M")){
		$tipominuta=utf8_decode("POR QUIENES MANIFIESTAN SU VOLUNTAD OTORGAR PODER SIN MINUTA EN LOS SIGUIENTES TÉRMINOS:");
	}else{
		$tipominuta=utf8_decode("Y CUYO TENOR LITERAL ES COMO SIGUE:");
	}

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
		$desmonto_vehi	=$precio->fun_capital_moneda($moneda_vehi,$monto_vehi,'monto');
		
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

	$consulta_numcontratantes = mysql_query('SELECT COUNT(idcontratante) AS conteo FROM contratantes WHERE KARDEX= "'.$num_kardex.'" ', $conn)
								or die("3=>".mysql_error());
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
					WHERE c.`idcliente` = "'.$row_consulNaturales_dp_parte1['conyuge'].'"', $conn) or die("4=>".mysql_error());
	
					$rowconyuge2= mysql_fetch_array($consulconyuge2);	
					$conyuge = $rowconyuge2['conyuge']=='' ? "" : $rowconyuge2['conyuge'];
					$nacionalidad_conyuge = $rowconyuge2['descripcion']=='' ? "" : $rowconyuge2['descripcion'];
					$tipodoc_conyuge = $rowconyuge2['destipdoc']=='' ? "" : $rowconyuge2['destipdoc'];
					$numdoc_conyuge = $rowconyuge2['numdoc']=='' ? "" : $rowconyuge2['numdoc'];
					$ocupacion_conyuge = $rowconyuge2['detaprofesion']=='' ? "<OCUPACION NO ESPECIFICADA>" : $rowconyuge2['detaprofesion'];
					
					if(trim($conyuge)!=""){
				
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
				
				$nuevointer='SELECT 
				  CONCAT(
					c2r.prinom,
					" ",
					c2r.segnom,
					" ",
					c2r.apepat,
					" ",
					c2r.apemat
				  ) AS conyuge,
				  t.`destipdoc`,
				  c.`numdoc`,
				  if(trim(c.`detaprofesion`)<>"",c.`detaprofesion`,"<NO ESPECIFICADA>") AS detaprofesion 
				FROM
				  cliente2 c 
				  LEFT JOIN contratantes cn 
					ON c.idcontratante = cn.idcontratante 
				  LEFT JOIN tipodocumento t 
					ON t.idtipdoc = c.idtipdoc 
				  INNER JOIN intervinientes i 
					ON i.`idcontratante` = c.`idcontratante` 
				  INNER JOIN cliente2 c2r 
					ON i.`idcontratante_r` = c2r.`idcliente` 
				WHERE cn.`kardex` = "'.$row_consulNaturales_dp_parte1['idcontratante'].'" and i.tipoinvervencion=1 ';
				
				
			
				$nuevointer = mysql_query('SELECT 
				  CONCAT(
					c2r.prinom,
					" ",
					c2r.segnom,
					" ",
					c2r.apepat,
					" ",
					c2r.apemat
				  ) AS conyuge,
				  t.`destipdoc`,
				  c.`numdoc`,
				  if(trim(c.`detaprofesion`)<>"",c.`detaprofesion`,"<NO ESPECIFICADA>") AS detaprofesion 
				FROM
				  cliente2 c 
				  LEFT JOIN contratantes cn 
					ON c.idcontratante = cn.idcontratante 
				  LEFT JOIN tipodocumento t 
					ON t.idtipdoc = c.idtipdoc 
				  INNER JOIN intervinientes i 
					ON i.`idcontratante` = c.`idcontratante` 
				  INNER JOIN cliente2 c2r 
					ON i.`idcontratante_r` = c2r.`idcliente` 
				WHERE cn.`kardex` = "'.$row_consulNaturales_dp_parte1['idcontratante'].'" and i.tipoinvervencion=1 ', $conn) or die("5=>".mysql_error());
				if(mysql_num_rows($nuevointer)>0){
					$textoadicional=SUBRAYADO(NEGRITA("TESTIGO DE IDENTIDAD",$CHAR_NEGRITA).$SEPARAESTILOS,$CHAR_SUBRAYADO).$SEPARAESTILOS.": ".$conyuge.$CHAR_LINEA;			

				}
				while($row=mysql_fetch_array($nuevointer)){
					
					$texto_conyuge .= 
					 NEGRITA("NOMBRE: ",$CHAR_NEGRITA).$SEPARAESTILOS.$row["conyuge"];
					
				}
				//uno
			if($row_consulNaturales_dp_parte1['cantRepre']=="")	{	
				//buscamos al representante	
					//buscamos al representante	
				$txtRepre='		
				SELECT 
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
				  	fncCantidadRepresentantes("'.$num_kardex.'",c.idcontratante)as cantRepre,
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
				  AND firma=1
				GROUP BY c.idcliente ';

				$consul_repre = mysql_query($txtRepre, $conn) or die("6=>".mysql_error());
				
				$REPRESENTATE="";
				$DERECHO="";
				if($row_consulNaturales_dp_parte1['parte_generacion']=="1"){
					$DERECHO=" quien procede por derecho propio";
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

						$REPRESENTATE=fNegrita($row_repre["nombre"]).", QUIEN MANIFIESTA SER DE NACIONALIDAD ".$row_repre["descripcion"].", DE ESTADO CIVIL ";
					if($row_repre['sexo']=="F"){
						if($row_repre['desestcivil']!="")
						{
							
								$REPRESENTATE.=substr($row_repre['desestcivil'],0,-1)."A";
							
							if($row_repre['desestcivil']=="CASADO" && $row_repre['nombreConyuge']!=""){
								$REPRESENTATE.=" CON ".$row_repre['nombreConyuge'];
							}
						}
							$REPRESENTATE.=", DE OCUPACIÓN ".$row_repre['detaprofesion'].", DOMICILIADA EN ".utf8_decode($row_repre['direccion'])." ";


					}else{
						if($row_repre['desestcivil']!=""){	 						  
	 						
	 							$REPRESENTATE.=substr($row_repre['desestcivil'],0,-1)."O";
	 					

	 						if($row_repre['desestcivil']=="CASADO" && $row_repre['nombreConyuge']!=""){
								$REPRESENTATE.=" CON ".$row_repre['nombreConyuge'];
							}

	 					}
	 						$REPRESENTATE.=", DE OCUPACIÓN ".$row_repre['detaprofesion'].", DOMICILIADO EN ".$row_repre['direccion']." ";
					}

					if($row_repre['coddis']=="999999")
							$REPRESENTATE.="DE TRANSITO POR ESTE PAIS";
						else{
							if($row_repre['codprov']=="01" && $row_repre['codpto']=="15")
								$REPRESENTATE.="DISTRITO DE ".$row_repre['nomdis'].", PROVINCIA Y DEPARTAMENTO DE LIMA";
							else
								$REPRESENTATE.=utf8_decode($row_repre["Distrito"]);
						}
						if($row_repre['codpto']!="15" && $row_repre['codpto']!="07" && $row_repre['coddis']!="999999") 
							$REPRESENTATE.="DE TRANSITO POR ESTA CIUDAD";

					$REPRESENTATE.=", SE IDENTIFICA CON ".$row_repre["destipdoc"]." NÚMERO ".$row_repre["numdoc"]." Y ";
					if($row_repre['parte_generacion']==1||$row_repre['parte_generacion']==2||$row_repre['parte_generacion']==3)
						$REPRESENTATE.="DECLARA QUE PROCEDE POR DERECHO PROPIO Y ";
					else
						$REPRESENTATE.="DECLARA QUE PROCEDE ";
					$REPRESENTATE=utf8_decode($REPRESENTATE);

					}else if($row_repre["tipper"]=="J"){
						$REPRESENTATE=fNegrita(str_replace("  "," ",$row_repre["nombre"])).$SEPARAESTILOS.", con domicilio en ".utf8_decode($row_repre["direccion"]).", ".$row_repre["Distrito"].", según facultades que constan inscritas en la partida electronica numero ".NEGRITA($row_repre["partida"]).$SEPARAESTILOS." del Registro de Personas Juridicas DE ".strtoupper(substr($row_repre["dessede"],4,12)).", y a su vez ";								
					}
		
					$txtListRepresentantes[$cont]=$REPRESENTATE;
				 }
				}

				$REPRESENTATE=str_replace(", y a su vez *",".",$REPRESENTATE);
				$REPRESENTATE = $REPRESENTATE=='*' ? "" : $REPRESENTATE;	

				if($row_consulNaturales_dp_parte1['cantRepre']=="" ||(int)$row_consulNaturales_dp_parte1['cantRepre']==1){

				$txtTransferentesSolo="";


				$txtTransferentesSolo=fNegrita($row_consulNaturales_dp_parte1["nombre"])." ";

				if($row_consulNaturales_dp_parte1['parte_generacion']==1)
				{
					//jncarlo
					if($idtipoacto=="100")//OPCION DE COMPRA
					{
						$txtTransferentes="COMO VENDEDOR ";
					}else if($idtipoacto=="096")//DONACION
					{
						$txtTransferentes="COMO DONANTE ";
					}else
					{
						$txtTransferentes="COMO TRANSFERENTE ";
					}
					
				}else if($row_consulNaturales_dp_parte1['parte_generacion']==2)
				{	
					if($idtipoacto=="100")//OPCION DE COMPRA
					{
						$txtTransferentes="COMO COMPRADOR ";
					}else if($idtipoacto=="096")//DONACION
					{
						$txtTransferentes="COMO DONATARIO ";
					}else
					{
						$txtTransferentes="COMO ADQUIRIENTE ";
					}

					
				}else if($row_consulNaturales_dp_parte1['parte_generacion']==4)
				{
					$txtTransferentes="INTERVIENE EN LA PRESENTE ";
				}
				$estc=substr($row_consulNaturales_dp_parte1['ecivil'],0,-1);
				$xxestcivil=strtoupper($estc."o");
				$txtTransferentes.=
				"".fNegrita(utf8_decode($row_consulNaturales_dp_parte1["nombre"])).", ".	
				"QUIEN MANIFIESTA SER DE NACIONALIDAD ".$row_consulNaturales_dp_parte1["nacionalidad"].", ".
				"DE ESTADO CIVIL ".$xxestcivil;  
				
					if(($row_consulNaturales_dp_parte1['ecivil']=="CASADO" && $row_consulNaturales_dp_parte1['nombreconyuge']!="") && $row_consulNaturales_dp_parte1['separaciondebienes']!=1){
						$txtTransferentes.=" CON ".$row_consulNaturales_dp_parte1['nombreconyuge'];
					}

					if($row_consulNaturales_dp_parte1['separaciondebienes']==1){
						$txtTransferentes.=" CON SEPARACION DE PATRIMONIOS INSCRITA EN LA PARTIDA ".$row_consulNaturales_dp_parte1["partidaconyuge"]." DEL REGISTRO PERSONAL DE LA ZONA REGISTRAL ".$row_consulNaturales_dp_parte1['idsedereg2'];
					
						$txtTransferentes=utf8_decode($txtTransferentes);
					}
				$txtTransferentes.=", DE OCUPACION ".$evalocupacion.", ";
				if($row_consulNaturales_dp_parte1['sexo']=="F")
					$txtTransferentes.="DOMICILIADA ";
				else
					$txtTransferentes.="DOMICILIADO ";	
//1515
				$txtTransferentes.="EN ".str_replace("?",".",utf8_decode(str_replace("De","de",""."".strtolower($row_consulNaturales_dp_parte1["direccion"])))).", ";
				if($row_consulNaturales_dp_parte1['coddis']=="999999")
					$txtTransferentes.="DE TRANSITO POR ESTE PAIS, ";
				else{
					if($row_consulNaturales_dp_parte1['codprov']=="01" && $row_consulNaturales_dp_parte1['codpto']=="15")
						$txtTransferentes.="DISTRITO DE ".$row_consulNaturales_dp_parte1['nomdis'].", PROVINCIA Y DEPARTAMENTO DE LIMA, ";
					else
						$txtTransferentes.=utf8_decode($row_consulNaturales_dp_parte1["Distrito"]).", ";
				}
				if($row_consulNaturales_dp_parte1['codpto']!="15" && $row_consulNaturales_dp_parte1['codpto']!="07" && $row_consulNaturales_dp_parte1['coddis']!="999999")
					$txtTransferentes.="DE TRANSITO POR ESTA CIUDAD, ";

				$txtTransferentes.="SE IDENTIFICA CON ".
				holaacentos4(ucwords(strtolower(utf8_decode(holaacentos4($row_consulNaturales_dp_parte1["tipo_docu"])))))." ".utf8_decode("NÚMERO ").fNegrita($row_consulNaturales_dp_parte1["numdoc"])." ";	

				if(sizeof($txtListRepresentantes)>0)
				{
					$txtTransferentesSolo.=utf8_decode("SEGÚN FACULTADES QUE CONSTAN EN LA PARTIDA ELECTRONICA NÚMERO ").$numPartida." DEL REGISTRO DE MANDATOS DE PODERES DE ".strtoupper($_sede).".";
				}else
				{ 
					if($row_consulNaturales_dp_parte1['parte_generacion']==4)
					{
						$txtTransferentes.="Y DECLARA QUE PROCEDE EN CALIDAD DE TESTIGO DE";
					}else{
					$txtTransferentes.="Y DECLARA QUE PROCEDE POR DERECHO PROPIO.";
					}
				}
			

				if($cont>0){
					foreach ($txtListRepresentantes as $key => $value) {
						$TRANSFERENTES=$value." EN REPRESENTACION DE ".$txtTransferentesSolo;


						$txtListContratantes[]=array('contratante'=>strtoupper($TRANSFERENTES));		
					}
				}else{
					
					if($row_consulNaturales_dp_parte1["nfirma"]==1){
						$TRANSFERENTES=$txtTransferentes;
						$txtListContratantes[]=array('contratante'=>strtoupper($TRANSFERENTES));
					}
				}
				
			}
		}

			
			}else{
			//dos

				if($row_consulNaturales_dp_parte1['cantRepre']==""){
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
		where cc2.idcliente=LPAD(c.conyuge,10,0) LIMIT 1) as nombreConyuge
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
				
				$consul_repre = mysql_query($queryRepre, $conn) or die("7=>".mysql_error());
			
				$numpartida2="";
				$_sede="";
				$txtListRepresentantes=array(); 
				$REPRESENTATE="";$COMOAPODERADO="";$cr=0;
				while($row_repre=mysql_fetch_array($consul_repre)){
					if($row_repre['partida']!="")
					{
						$numpartida2=$row_repre['partida'];
					}
					if($row_repre['sedreg']!="")
					{
						$_sede=$row_repre['sedreg'];
					}
					
					if($row_consulNaturales_dp_parte1['parte_generacion']==1)
					{ 
						

						if($idtipoacto=="100")//OPCION DE COMPRA
						{
							$REPRESENTATE="COMO VENDEDOR ";
						}else if($idtipoacto=="096")//DONACION
						{
							$REPRESENTATE="COMO DONANTE ";
						}else
						{
							$REPRESENTATE="COMO TRANSFERENTE ";
						}
					}else if($row_consulNaturales_dp_parte1['parte_generacion']==2)
					{
							if($idtipoacto=="100")//OPCION DE COMPRA
							{
								$REPRESENTATE="COMO COMPRADOR ";
							}else if($idtipoacto=="096")//DONACION
							{
								$REPRESENTATE="COMO DONATARIA ";
							}else
							{
								$REPRESENTATE="COMO ADQUIRIENTE ";
							}

					}
					$REPRESENTATE.=fNegrita($row_repre["nombre"]).", QUIEN MANIFIESTA SER DE NACIONALIDAD ".$row_repre["descripcion"].", DE ESTADO CIVIL ";
					if($row_repre['sexo']=="F"){
						if($row_repre['desestcivil']!="")
						{
							
								$REPRESENTATE.=substr($row_repre['desestcivil'],0,-1)."A";
							
							if($row_repre['desestcivil']=="CASADO" && $row_repre['nombreConyuge']!=""){
								$REPRESENTATE.=" CON ".$row_repre['nombreConyuge'];
							}
						}
							$REPRESENTATE.=", DE OCUPACIÓN ".$row_repre['detaprofesion'].", DOMICILIADA EN ".utf8_decode($row_repre['direccion'])." ";


					}else{
						if($row_repre['desestcivil']!=""){	 						  
	 						
	 							$REPRESENTATE.=substr($row_repre['desestcivil'],0,-1)."O";
	 					

	 						if($row_repre['desestcivil']=="CASADO" && $row_repre['nombreConyuge']!=""){
								$REPRESENTATE.=" CON ".$row_repre['nombreConyuge'];
							}

	 					}
	 						$REPRESENTATE.=", DE OCUPACIÓN ".$row_repre['detaprofesion'].", DOMICILIADO EN ".$row_repre['direccion']." ";
					}

					if($row_repre['coddis']=="999999")
							$REPRESENTATE.="DE TRANSITO POR ESTE PAIS";
						else{
							if($row_repre['codprov']=="01" && $row_repre['codpto']=="15")
								$REPRESENTATE.="DISTRITO DE ".$row_repre['nomdis'].", PROVINCIA Y DEPARTAMENTO DE LIMA";
							else
								$REPRESENTATE.=utf8_decode($row_repre["Distrito"]);
						}
						if($row_repre['codpto']!="15" && $row_repre['codpto']!="07" && $row_repre['coddis']!="999999")
							$REPRESENTATE.="DE TRANSITO POR ESTA CIUDAD";
					$REPRESENTATE.=", SE IDENTIFICA CON ".$row_repre["destipdoc"]." NÚMERO ".fNegrita($row_repre["numdoc"])." Y ";
					if($row_repre['parte_generacion']==1||$row_repre['parte_generacion']==2||$row_repre['parte_generacion']==3)
						$REPRESENTATE.="DECLARA QUE PROCEDE ";
					else
						$REPRESENTATE.="DECLARA QUE PROCEDE ";
					$REPRESENTATE=utf8_decode($REPRESENTATE);

		
					$cr++;
					$txtListRepresentantes[$cr]=$REPRESENTATE;

				}
				
				if($cr>1){
					$nombra="DECLARAN QUE PROCEDEN";
				}else{
					$nombra="DECLARA QUE PROCEDE";
				}
				if($cr>0){
					$numpartida=$row_consulNaturales_dp_parte1["numpartida"];
				foreach ($txtListRepresentantes as $key => $value) {
					$TRANSFERENTES=$value."EN REPRESENTACION DE ".
				fNegrita("".str_replace("","",(strtolower())).str_replace("","",str_replace("","",strtoupper(utf8_decode($row_consulNaturales_dp_parte1["nombre"]))))).", CON ".$row_consulNaturales_dp_parte1["tipo_docu"].utf8_decode(" NÚMERO ").fNegrita($row_consulNaturales_dp_parte1["numdoc"]) .				
				", ".   
				utf8_decode("SEGÚN FACULTADES QUE CONSTAN EN LA PARTIDA ELECTRONICA NÚMERO ").$numpartida2." DEL REGISTRO DE PERSONAS JURIDICAS DE ".strtoupper($_sede).".";

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
	$sqlListRepresentantesKardex='SELECT c.`idcontratante`,c.`tipper`, LTRIM( CONCAT( c.prinom, " ", c.segnom, " ", c.apepat, " ", c.apemat, c.`razonsocial` ) ) AS nombre, t.`destipdoc`, c.`numdoc`, LTRIM( CONCAT(c.`domfiscal`, c.`direccion`) ) AS direccion, c.`sexo`,u.codprov,u.codpto,u.coddis,u.nomdis, IF( u.coddis = "070101", "DISTRITO DEL CALLAO , PROVINCIA CONSTITUCIONAL DEL CALLAO", CONCAT( "DISTRITO DE ", u.nomdis, ", PROVINCIA DE ", u.nomprov, ", DEPARTAMENTO DE ", u.nomdpto ) ) AS "Distrito", r.`facultades`, r.`inscrito`, s.`dessede`, r.`partida`, n.`descripcion`, civ.`desestcivil`, if(trim(c.`detaprofesion`)<>"",c.`detaprofesion`,"") AS detaprofesion , fncCantidadRepresentantes("'.$num_kardex.'",c.idcontratante)as cantRepre FROM representantes r INNER JOIN contratantesxacto cn ON cn.`idcontratante` = r.`idcontratante` INNER JOIN cliente2 c ON cn.`idcontratante` = c.`idcontratante` INNER JOIN tipodocumento t ON t.idtipdoc = c.idtipdoc LEFT OUTER JOIN ubigeo u ON u.coddis = c.idubigeo LEFT OUTER JOIN `sedesregistrales` s ON r.`sede_registral` = s.`idsedereg` LEFT OUTER JOIN tipoestacivil civ ON c.`idestcivil` = civ.`idestcivil` LEFT OUTER JOIN nacionalidades n ON c.`nacionalidad` = n.`idnacionalidad` INNER JOIN contratantes conn on c.idcontratante=conn.idcontratante WHERE r.`kardex` = "'.$num_kardex.'" AND firma=1 GROUP BY c.idcliente 
';

	$queryListRepresentantesKardex=mysql_query($sqlListRepresentantesKardex,$conn) or die("error");
	while ($rowLListRepresentantesKardex=mysql_fetch_array($queryListRepresentantesKardex)) {
	

		if($rowLListRepresentantesKardex['cantRepre']!="" && (int)$rowLListRepresentantesKardex['cantRepre']>1){
					if($rowLListRepresentantesKardex["tipper"]=="N"){	
							$_REPRESENTATE=fNegrita($rowLListRepresentantesKardex["nombre"])." ";
							if($rowLListRepresentantesKardex['sexo']=="F"){
								$_REPRESENTATE.="IDENTIFICADA CON ".$rowLListRepresentantesKardex["destipdoc"]." NÚMERO ".$rowLListRepresentantesKardex["numdoc"]." QUIEN MANIFIESTA SER";
								if($rowLListRepresentantesKardex['desestcivil']!="")
									$_REPRESENTATE.=" ".substr($rowLListRepresentantesKardex['desestcivil'],0,-1)."A".",";
								
							}else{
								$_REPRESENTATE.="IDENTIFICADO CON ".$rowLListRepresentantesKardex["destipdoc"]." NÚMERO ".$rowLListRepresentantesKardex["numdoc"]." QUIEN MANIFIESTA SER";
								if($rowLListRepresentantesKardex['desestcivil']!="")
									$_REPRESENTATE.=" ".substr($rowLListRepresentantesKardex['desestcivil'],0,-1)."O".",";
							}
									$_REPRESENTATE.=" DE OCUPACIÓN ".$rowLListRepresentantesKardex["detaprofesion"].", ";


								if($rowLListRepresentantesKardex['sexo']=="F")
									$_REPRESENTATE.="DOMICILIADA ";
								else
									$_REPRESENTATE.="DOMICILIADO ";	

								$_REPRESENTATE.="EN ".utf8_decode(holaacentos4(str_replace("De","de",""."".holaacentos4(strtolower(utf8_decode($rowLListRepresentantesKardex["direccion"])))))).", ";
								if($rowLListRepresentantesKardex['coddis']=="999999")
									$_REPRESENTATE.="DE TRANSITO POR ESTE PAIS, ";
								else{
									if($rowLListRepresentantesKardex['codprov']=="01" && $rowLListRepresentantesKardex['codpto']=="15")
										$_REPRESENTATE.="DISTRITO DE ".$rowLListRepresentantesKardex['nomdis'].", PROVINCIA Y DEPARTAMENTO DE LIMA, ";
									else
										$_REPRESENTATE.=utf8_decode($rowLListRepresentantesKardex["Distrito"]).", ";
								}
								if($rowLListRepresentantesKardex['codpto']!="15" && $rowLListRepresentantesKardex['codpto']!="07" && $rowLListRepresentantesKardex['coddis']!="999999")
									$_REPRESENTATE.="DE TRANSITO POR ESTA CIUDAD, ";


							}




						$dataRepresentantes=$_REPRESENTATE." Y DECLARA QUE PROCEDE POR DERECHO PROPIO Y EN REPRESENTACION DE ";

						$consultaPersonasQueRepresenta="SELECT 
							rep.idcontratante,
							ce.`idcontratante`,
							cli2.`idcontratante`,
							rep.partida,
							cli2.idcliente,
							CONCAT(
							(
							  CASE
								WHEN cli2.`tipper` = 'N' 
								AND cli2.`sexo` = 'F' 
								THEN CONVERT('', CHAR CHARACTER SET utf8) 
								WHEN cli2.`tipper` = 'N' 
								AND cli2.`sexo` = 'M' 
								THEN '' 
								WHEN cli2.`tipper` = 'N' 
								AND cli2.`sexo` = '' 
								THEN '' 
							  END
							),
							IFNULL(cli2.`prinom`, ''),
							' ',
							IFNULL(cli2.`segnom`, ''),
							' ',
							IFNULL(cli2.`apepat`, ''),
							' ',
							IFNULL(cli2.`apemat`, ''),
							IFNULL(cli2.razonsocial, '')
						  ) AS cliente
						 FROM representantes rep INNER JOIN 
						cliente2 cli2 ON rep.idcontratante_r=cli2.idcliente
						INNER JOIN contratantesxacto ce ON cli2.`idcontratante`=`ce`.`idcontratante`
						INNER JOIN actocondicion ac ON `ce`.`idcondicion`=`ac`.`idcondicion`
						 WHERE rep.kardex='".$num_kardex."'  AND rep.idcontratante='".$rowLListRepresentantesKardex['idcontratante']."'
						 GROUP BY cli2.idcliente";
						 $numPartida="";

	 					$querycontratantesMAsdeUno=mysql_query($consultaPersonasQueRepresenta,$conn);
	 					$numRowContratantesMAsdeUno=mysql_num_rows($querycontratantesMAsdeUno);

		 					$_cont=0;
		 					while($rowContMasDeUno=mysql_fetch_array($querycontratantesMAsdeUno)){
		 						$_cont++;
		 						
		 						$numPartida=$rowContMasDeUno['partida'];
		 						if($_cont==1)
		 							$dataRepresentantes.=$rowContMasDeUno['cliente'];
		 						else if($numRowContratantesMAsdeUno==$_cont)
		 							$dataRepresentantes.=" Y ".$rowContMasDeUno['cliente'];
		 						else
		 							$dataRepresentantes.=", ".$rowContMasDeUno['cliente'];
		 					}
		 					$dataRepresentantes.=" SEGÚN FACULTADES QUE CONSTAN EN LA PARTIDA ELECTRONICA NUMERO $numPartida DEL REGISTRO DE MANDATOS Y PODERES DE LIMA.";

		 					$dataRepresentantes=utf8_decode($dataRepresentantes);
array_unshift($txtListContratantes, array('contratante'=>strtoupper($dataRepresentantes)));
		}


	}

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
					WHERE c.`idcliente` = "'.$row_consulNaturales_dp_parte2['conyuge'].'"', $conn) or die(mysql_error());
									
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
				$consul_repre = mysql_query('		
				SELECT 
				  c.`tipper`,
				  LTRIM(
					CONCAT(
					  IFNULL(c.`prinom`, ""),
					  " ",
					  IFNULL(c.`segnom`, ""),
					  " ",
					  IFNULL(c.`apepat`, ""),
					  " ",
					  IFNULL(c.`apemat`, ""),
					  IFNULL(c.razonsocial, "")
					)
				  ) AS nombre,
				  t.`destipdoc`,

				  c.`numdoc`,
				  LTRIM(
					CONCAT(IFNULL(c.`domfiscal`, ""),IFNULL(c.`direccion`, ""))
				  ) AS direccion,
				  c.`sexo`,
				  IF(
					u.coddis = "070101",
					"DISTRITO DE CALLAO , PROVINCIA CONSTITUCIONAL DEL CALLAO",
					CONCAT(u.nomdis,", ",u.nomprov,", ",u.nomdpto)
				  ) AS "Distrito",
				  r.`facultades`,
				  r.`inscrito`,
				  s.`dessede`,
				  r.`partida`,
				  n.`descripcion`,
				  civ.`desestcivil`,
				  if(trim(c.`detaprofesion`)<>"",c.`detaprofesion`,"<NO ESPECIFICADA>") AS detaprofesion
				FROM
				  representantes r 
				  INNER JOIN cliente2 c 
					ON c.`idcliente` = r.`idcontratante_r` 
				  INNER JOIN contratantesxacto cn 
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
				WHERE r.`kardex` = "'.$num_kardex.'"
				  AND r.`idcontratante` = "'.$row_consulNaturales_dp_parte2['idcontratante'].'"
				GROUP BY c.idcliente ', $conn) or die(mysql_error());
				
				$REPRESENTATE="";
				$DERECHO="";
				if($row_consulNaturales_dp_parte2['tiporepresentacion']=="0"){
					$DERECHO=" quien procede derecho propio";
				}else if($row_consulNaturales_dp_parte2['tiporepresentacion']=="1"){
					$DERECHO="procede en nombre y representacion";
				}else if($row_consulNaturales_dp_parte2['tiporepresentacion']=="2"){
					$DERECHO="por su propio derecho y en representacion";
				}
								
				while($row_repre=mysql_fetch_array($consul_repre)){
					if($row_repre["tipper"]=="N"){					
						$REPRESENTATE.=" de ".fNegrita($row_repre["nombre"]).$SEPARAESTILOS." IDENTIFICADO CON ".$row_repre["destipdoc"].utf8_decode(" NÚMERO ").$row_repre["numdoc"].", QUIEN MANIFIESTA SER ".$row_repre["desestcivil"].", DE OCUPACION ".$row_repre["detaprofesion"]." ";						
					}else if($row_repre["tipper"]=="J"){
						$REPRESENTATE.=" de la empresa ".fNegrita(str_replace("  "," ",$row_repre["nombre"])).$SEPARAESTILOS.", con domicilio en ".utf8_decode($row_repre["direccion"]).", ".$row_repre["Distrito"].", según facultades que constan inscritas en la partida electronica numero ".NEGRITA($row_repre["partida"]).$SEPARAESTILOS." del Registro de Personas Juridicas ".NEGRITA(str_replace("  "," ","DE ".strtoupper(substr($row_repre["dessede"],4,12)))).$SEPARAESTILOS.", y a su vez ";								
					}					
				}
				$REPRESENTATE.="*";
				$REPRESENTATE=str_replace(", y a su vez *",".",$REPRESENTATE);
				$REPRESENTATE = $REPRESENTATE=='*' ? "" : $REPRESENTATE;	
				
				$ADQUIRENTES.=	
				fNegrita(" ".$row_consulNaturales_dp_parte2["nombre"])." ".	
				"QUIEN MANIFIESTA SER DE NACIONALIDAD ".NEGRITA($row_consulNaturales_dp_parte2["nacionalidad"]).$SEPARAESTILOS.", ".
				"DE ESTADO CIVIL ".NEGRITA($estcivil)."".", ".
				"DE OCUPACION ".NEGRITA($evalocupacion)."".", ".$ambos."".
				"DOMICILIADO EN ".holaacentos4(ucwords(strtolower(utf8_decode($row_consulNaturales_dp_parte2["direccion"].",  ".$row_consulNaturales_dp_parte2["Distrito"]))))." ".
				"SE IDENTIFICA CON ".
				holaacentos4(ucwords(strtolower(utf8_decode(holaacentos4($row_consulNaturales_dp_parte2["tipo_docu"])))))." ".utf8_decode("NÚMERO ").$row_consulNaturales_dp_parte2["numdoc"].", ".
				"Y DECLARA QUE PROCEDE DERECHO PROPIO. ".utf8_decode("")." ".chr(10);	
				//aui se elimino $REPRESENTATE
			 }
			}else{
				
			if($row_consulNaturales_dp_parte1['cantRepre']==""){
				
				//buscamos al representante			
				$consul_repre = mysql_query('		
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
				  c.`sexo`,
				  IF(
					u.coddis = "070101",
					"DISTRITO DE CALLAO , PROVINCIA CONSTITUCIONAL DEL CALLAO ",
					CONCAT(
					  u.nomdis
					)
				  ) AS "Distrito",
				  r.`facultades`,
				  r.`inscrito`,
				  s.`dessede`,
				  r.`partida`,
				  n.`descripcion`,
				  civ.`desestcivil`,
				  if(trim(c.`detaprofesion`)<>"",c.`detaprofesion`,"<NO ESPECIFICADA>") AS detaprofesion
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
				WHERE r.`kardex` = "'.$num_kardex.'"
				  AND r.`idcontratante_r` = "'.$row_consulNaturales_dp_parte2['idcliente'].'"
				GROUP BY c.idcliente ', $conn) or die(mysql_error());
				
				
								
				$REPRESENTATE="";$COMOAPODERADO="";$cr=0;
				while($row_repre=mysql_fetch_array($consul_repre)){
					$REPRESENTATE.=
					fNegrita($row_repre["nombre"]).", quien se identifico con ".$row_repre["destipdoc"].utf8_decode(" N° ").
					NEGRITA($row_repre["numdoc"])." y ";
					$COMOAPODERADO.=NEGRITA($row_repre["nombre"])." ";
					$cr++;
				}
				if($cr>1){
					$nombra="CUYOS NOMBRAMIENTOS Y FACULTADES";
				}else{
					$nombra="CUYO NOMBRAMIENTO Y FACULTAD";
				}

				$ADQUIRENTES.=$REPRESENTATE." DECLARA QUE PROCEDE EN REPRESENTACION DE ".
				fNegrita("".str_replace("?","?",(strtolower())).str_replace("*","&",str_replace("?","'",strtoupper(utf8_decode($row_consulNaturales_dp_parte2["nombre"])))))."          ".
				utf8_decode("SEGUN FACULTADES QUE CONSTAN EN LA PARTIDA ELECTRONICA NÚMERO ").$row_consulNaturales_dp_parte2["numpartida"]." DEL REGISTRO DE PERSONAS JURIDICAS DE ".strtoupper($row_consulNaturales_dp_parte2["idsedereg"]).".  ".chr(10);
								
				$COMOAPODERADO.=" EN CALIDAD DE APODERADO FINANCIERO DE LA EMPRESA ".NEGRITA("".str_replace("?","?",(strtolower($evalsexo))).str_replace("*","&",str_replace("?","'",strtoupper(utf8_decode($row_consulNaturales_dp_parte2["nombre"]))))).chr(10);
				
			}
		 }
		}//FIN DEL WHILE
		
	}//FIN DEL FOR	


	
	
	##

	$query_inter="
	SELECT 
	  TRIM(
		CONCAT(
		  IFNULL(c2_c.`prinom`, ''),
		  ' ',
		  IFNULL(c2_c.`segnom`, ''),
		  ' ',
		  IFNULL(c2_c.`apepat`, ''),
		  ' ',
		  IFNULL(c2_c.`apemat`, ''),
		  IFNULL(c2_c.razonsocial, '')
		)
	  ) AS cliente_representante,
	  n.descripcion AS 'nacionalidad',
	  td.destipdoc AS 'tipo_docu',
	  c2_c.numdoc,
	  UPPER(c2_c.detaprofesion) AS 'Ocupacion',
	  tes.desestcivil AS 'ecivil',
	  CONCAT(c2_c.domfiscal, c2_c.direccion) AS direccion,
	  IF(
		u.coddis = '070101',
		'DISTRITO DEL CALLAO , PROVINCIA CONSTITUCIONAL DEL CALLAO',
		CONCAT(
		  'DISTRITO DE ',
		  u.nomdis,
		  ', PROVINCIA Y DEPARTAMENTO DE ',
		  u.nomdpto
		)
	  ) AS 'Distrito',
	  c2_c.sexo AS 'sexo',
	  c2_c.idcontratante 
	FROM
	  contratantesxacto ca 
	  INNER JOIN actocondicion ac 
		ON ac.`idcondicion` = ca.`idcondicion` 
	  INNER JOIN cliente2 c2 
		ON c2.`idcontratante` = ca.`idcontratante` 
	  INNER JOIN intervinientes t 
		ON c2.`idcliente` = t.`idcontratante_r` 
	  INNER JOIN cliente2 c2_c 
		ON c2_c.`idcontratante` = t.`idcontratante` 
	  LEFT JOIN nacionalidades n 
		ON n.idnacionalidad = c2_c.nacionalidad 
	  LEFT JOIN tipodocumento td 
		ON td.idtipdoc = c2_c.idtipdoc 
	  LEFT OUTER JOIN tipoestacivil tes 
		ON tes.idestcivil = c2_c.idestcivil 
	  LEFT OUTER JOIN ubigeo u 
		ON u.coddis = c2_c.idubigeo 
	WHERE ca.`kardex` = '".$num_kardex_original."' ";
	$exe_inter=mysql_query($query_inter,$conn);
	$eval_mostrar_persona_int="";$conintervencion="";
	while($row_inter=mysql_fetch_assoc($exe_inter)){
		$eval_mostrar_persona_int.=$row_inter["cliente_representante"].", ";
		$conintervencion=strtoupper("con intervencion de:");	
	}
	
	$eval_mostrar_persona_int=substr($eval_mostrar_persona_int,0,-2);
	
	## CARACTERISTICAS DEL VEHICULO
	$placa="";$marca="";$modelo="";$clase="";$carroceria="";$color="";
	$anio="";$motor="";$serie="";$combustible="";$partida="";$sede="";$categoria="";

	## LLENANDO EL ARRAY VEHICULOS: ##
	for($i = 0; $i <= $numvehiculos-1; $i++)
	{
		$rowvehiculo = mysqli_fetch_array($cosuldetvehiculos);		
		$placa=strtoupper($rowvehiculo["placa"])!="" ? strtoupper($rowvehiculo["placa"]) : "PLACA";
		$marca=strtoupper($rowvehiculo["marca"]);
		$modelo=strtoupper($rowvehiculo["modelo"]);
		$clase=strtoupper($rowvehiculo["clase"]);
		$carroceria=strtoupper($rowvehiculo["carroceria"]);
		$color=strtoupper($rowvehiculo["color"]);
		$anio=strtoupper($rowvehiculo["anio"]);
		$motor=strtoupper($rowvehiculo["motor"]);
		$serie=strtoupper($rowvehiculo["serie"]);
		$combustible=strtoupper($rowvehiculo["combustible"]);
		$partida=strtoupper($rowvehiculo["partida"]);
		$categoria=strtoupper($rowvehiculo["categoria"]);
		$sede=str_replace("  "," ","DE ".strtoupper(substr($rowvehiculo["sede"],4,12)));

	}
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
	

	$eval_mostrar_persona_tran= str_replace("Ñ","N",$eval_mostrar_persona_tran);
	$eval_mostrar_persona_adq= str_replace("Ñ","N",$eval_mostrar_persona_adq);
	$eval_mostrar_personaInterv= str_replace("Ñ","N",$eval_mostrar_personaInterv);
	$subtitulo="";
	if(true){
		if($eval_mostrar_persona_tran!="")
			$subtitulo="QUE OTORGA: ".$eval_mostrar_persona_tran.chr(10);

		if($eval_mostrar_persona_adq!="")
			$subtitulo.=" A FAVOR DE: ".$eval_mostrar_persona_adq.chr(10);
		if($eval_mostrar_personaInterv!="")
			$subtitulo.=" CON INTERVENCION DE: ".$eval_mostrar_personaInterv;
	}/*else{
		$subtitulo="QUE OTORGA: ".$eval_mostrar_persona_tran.chr(10)." A FAVOR DE: ".$eval_mostrar_persona_adq;		
	}*/







	$subtitulo22=utf8_decode($subtitulo);
	$subtitulo22=str_replace(",",chr(10),utf8_decode($subtitulo22));
	$subtitulo22=str_replace(":",chr(10),utf8_decode($subtitulo22));
	//$subtitulo22=str_replace(",","",$subtitulo22_);

	$sellos_biometrico="";
	$sellos_advertencia="";	
	$insertos_general="";
/*
	//SELLOS KARINA
	$sql_query_sellos="SELECT 
	  s.`tipo` ,d.`idsello`
	FROM
	  detalle_sellos_kardex d 
	  INNER JOIN selloskardex s 
		ON s.`idsello` = d.`idsello` 
	WHERE d.`kardex` = '".$num_kardex_original."'";
	
	$exe_sellos=mysql_query($sql_query_sellos,$conn) or die (mysql_error());
	while($row_sellos=mysql_fetch_array($exe_sellos)){
		if($row_sellos["tipo"]=="BIOMETRICO"){
			$sellos_biometrico.=str_replace("SELLO17","SELLO0","[[SELLO".$row_sellos["idsello"]."]]$%&");
		}else{
			$sellos_advertencia.="[[SELLO".$row_sellos["idsello"]."]]$%&";
		}	
	  
	}

	$sql_query_insertos="SELECT 
	  s.`tipo` ,d.`idsello`
	FROM
	  detalle_insertos_kardex d 
	  INNER JOIN sellosinsertos s 
		ON s.`idsello` = d.`idsello` 
	WHERE d.`kardex` = '".$num_kardex_original."'";
	
	$exe_insertos=mysql_query($sql_query_insertos,$conn) or die (mysql_error());
	while($row_insertos=mysql_fetch_array($exe_insertos)){
		
		$insertos_general.="[[INSERTO".$row_insertos["idsello"]."]]$%&";
	 
	}*/

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
	  ) AS condicion ,
	  TRIM(
		CONCAT(
		  IFNULL(c2_rdo.`prinom`, ''),
		  ' ',
		  IFNULL(c2_rdo.`segnom`, ''),
		  ' ',
		  IFNULL(c2_rdo.`apepat`, ''),
		  ' ',
		  IFNULL(c2_rdo.`apemat`, ''),
		  IFNULL(c2_rdo.razonsocial, '')
		)
	  ) AS aquienrepresenta
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
	",$conn) or die ("dada".mysql_error());

	$contador_firmas=1;
	while($row_exe_firmas=mysql_fetch_array($exe_firmas)){
		$AquienRepre=$row_exe_firmas['aquienrepresenta'];
		

		$rayafirma=RAYAFIRMAS(strlen($row_exe_firmas["cliente"]));
		if($row_exe_firmas["fechafirma"]!=""){
			$firmo=utf8_decode("FIRMADO: ".$row_exe_firmas["fechafirma"]);
		}else{
			$firmo="";
		}
		$firmador.=$row_exe_firmas["cliente"].";";
		if(($contador_firmas % 2)==1){
			$firma1=$rayafirma.chr(10).utf8_decode($row_exe_firmas["cliente"]).chr(10);
			if($AquienRepre!=""){
				$firma1.="POR: ".$AquienRepre.chr(10);
			}
			//OBSTACULIZAMOS EL PASO PARA DONACION Y OPCION DE COMPRA
			if($idtipoacto!="10000" ){
				$_firma="";
				if($row_exe_firmas["fechafirma"]!="")
					$_firma=$fecha->fun_fech_letras(fechan_abd($row_exe_firmas["fechafirma"]));
				else
					$_firma="";

			$firma1.=utf8_decode("FIRMO EL: ".$_firma).chr(10);
			}
			$dataFirmas[]=array('firma'=>$firma1);


		}else if(($contador_firmas % 2)==0){
			$firma2="";
			$firma2=$rayafirma.chr(10).utf8_decode($row_exe_firmas["cliente"]).chr(10);
			if($AquienRepre!=""){
				$firma2.="POR: ".$AquienRepre.chr(10);
			}
			//OBSTACULIZAMOS EL PASO PARA DONACION Y OPCION DE COMPRA

			if( $idtipoacto!="10000" ){
				$_firma2="";
				if($row_exe_firmas["fechafirma"]!="")
					$_firma2=$fecha->fun_fech_letras(fechan_abd($row_exe_firmas["fechafirma"]));
				else
					$_firma2="";


				$firma2.=utf8_decode("FIRMO EL: ".$_firma2).chr(10);
			}
			$dataFirmas2[]=array('firma'=>$firma2);
		}
		$contador_firmas++;
	}




/*IMPORTES*/
$sqlImpor = "SELECT  patrimonial.idmon,monedas.desmon AS moneda,monedas.simbolo AS simbolo_moneda,patrimonial.tipocambio,patrimonial.importetrans AS importe_patrimonial,
			patrimonial.exhibiomp,fpago_uif.descripcion AS forma_pago FROM  patrimonial  LEFT JOIN monedas ON patrimonial.idmon = monedas.idmon
			LEFT JOIN fpago_uif ON patrimonial.fpago  = fpago_uif.id_fpago
			WHERE patrimonial.kardex =  '$num_kardex'";

		$resultImpor = mysql_query($sqlImpor);
		$row = mysql_fetch_assoc($resultImpor);

		if($row){
			foreach ($row as $key => $value) {
				# code...
				


		   		switch ($key) {
		   			case 'importe_patrimonial':
		   				# code...
		   				$bookmarkName = mb_strtoupper('LETRA_'.$key);

		   				$valueBookMark = $precio->fun_capital_moneda($row['idmon'],$value,'monto');
		   				
		   				$TBS->VarRef[$bookmarkName] = $valueBookMark;
		   				
		   				

		   				break;
		   			
		   			default:
		   				# code...
		   				break;
		   		}
		   	    $key = mb_strtoupper(trim($key));
		   		$value = is_null($value)?'?':$value;
		   		
		   		if($key=="IMPORTE_PATRIMONIAL")
		   		{
		   			
		   			$TBS->VarRef[$key] = number_format($value,2,".",",");
		   		}else
		   		{
		   			$TBS->VarRef[$key] = mb_strtoupper($value);
		   		}


		   		
		   		
			}
		}else{

			$columnCount =  mysql_num_fields($resultImpor);
			for ( $j = 0;$j < mysql_num_fields($resultImpor);$j++) {
    			$metaData = mysql_fetch_field($resultImpor, $j);
		      	$key = $metaData->name;
		      	$value = null;
		   		$key = mb_strtoupper(trim($key));
		   		$value = is_null($value)?'?':$value;
		   		$TBS->_objTbs->VarRef[$key] = mb_strtoupper($value);
			
			}
		}
/*FIN IMPORTES*/

	
	//medios de pago anidados
	$querypagos=mysqli_query($conn_i,"
	SELECT 
	  dmp.detmp,
	  mp.`desmpagos`,dmp.`codmepag`,mp.sunat,
	  dmp.`codmepag` AS conteo ,
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
	
	ORDER BY detmp DESC 
	");
	$textoMediosPago="";
	if(mysqli_num_rows($querypagos)>0){
		//PARA EFECTOS DE LO ESTABLECIDO POR LA LEY N° 30730 SE BANCARIZA LA TOTALIDAD DEL PRECIO DE ACUERDO CON LO SIGUIENTE: MONTO TOTAL DE LA OPERACIÓN: [onshow.SIMBOLO_MONEDA]  [onshow.IMPORTE_PATRIMONIAL] ([onshow.LETRA_IMPORTE_PATRIMONIAL]); VALOR TOTAL PAGADO CON MEDIO DE PAGO: [onshow.texto_mediopago] 
		if($numPlantilla!='tv2' && $numPlantilla!='tv3')
 
		{
			$textoMediosPago=utf8_decode("PARA EFECTOS DE LO ESTABLECIDO POR LA LEY N°  30730 SE BANCARIZA LA TOTALIDAD DEL PRECIO DE ACUERDO CON LO SIGUIENTE: MONTO TOTAL DE LA OPERACIÓN ".$SIMBOLO_MONEDA." ".$IMPORTE_PATRIMONIAL." (".$LETRA_IMPORTE_PATRIMONIAL.") VALOR TOTAL PAGADO CON MEDIO DE PAGO: "); 
		}else
		{
			$textoMediosPago=utf8_decode("PARA EFECTOS DE LO ESTABLECIDO EN LA LEY N° 30730; DEJO CONSTANCIA QUE SE HA ACREDITADO EL USO DE MEDIOS DE PAGO FINANCIEROS RESPECTO A PARTE DEL MONTO PAGADO. RESPECTO A LA OTRA PARTE DEL PRECIO LOS OTORGANTES DECLARAN BAJO JURAMENTO NO PODER EXHIBIR LOS MEDIOS DE PAGO FINANCIEROS POR  HABER SIDO  CANCELADAS CON ANTERIORIDAD A LA VIGENCIA DE DICHA LEY. SIENDO EL DETALLE DE LA BANCARIZACIÓN EL SIGUIENTE: MONTO TOTAL DE LA OPERACIÓN ".$SIMBOLO_MONEDA." ".$IMPORTE_PATRIMONIAL." (".$LETRA_IMPORTE_PATRIMONIAL.") ; VALOR TOTAL PAGADO CON MEDIO DE PAGO: ");
		}
		 
		
		$ffOrperacion="";	
		$nnumOperacion="";		
		while($row_querypagos=mysqli_fetch_assoc($querypagos)){
			$texto_mediopago="";
			$querydetmedio=mysqli_query($conn_i,"
			SELECT 
			  m.`simbolo`,
			  dmp.`importemp`,
			  CONCAT(' ', m.`desmon`) AS desmon,
			  dmp.`foperacion`,
			  mp.`desmpagos` ,
			  mp.sunat,
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
			  ) AS 'cliente' ,
			  dmp.idmon
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
			WHERE dmp.KARDEX = '".$num_kardex."'  and dmp.`exhibio` = '1' AND dmp.`detmp` = '".$row_querypagos["detmp"]."'
			

			");
				//dmp.`codmepag` = '".$row_querypagos["codmepag"]."'1		
			
			$num_deposito=utf8_decode(numtoletras($row_querypagos["conteo"]));			
			//num_deposito	
			//$row_querypagos["desbanco"]
			
			
			$i_m=1;
			while($row_mediospago=mysqli_fetch_array($querydetmedio)){
				$ffOrperacion=$row_mediospago['foperacion'];
				if($i_m>1){
					//$num=", EL ".numeroTipo($i_m)." ";
					$num=", ";
				}
				
				$fecha_dmp= $fecha->fun_fech_corta_3(implode("/", array_reverse(explode("/", $row_mediospago["foperacion"]))));	
										/*
													$precio->fun_capital_moneda($row['idmon'],$value);
													(numtoletras($row_mediospago["importemp"])).$row_mediospago["desmon"]					
										*/

				$descript.=$num."".$row_mediospago["simbolo"]." ".number_format($row_mediospago["importemp"],2,".",",")
							." (".($precio->fun_capital_moneda($row_mediospago["idmon"],$row_mediospago["importemp"],'monto')).")";
						

							$nnumOperacion=$row_mediospago['documentos'];
							$txtMoneda="";
					if((int)$row_mediospago['idmon']==1)
					{
						$txtMoneda="SOLES";
					}else if((int)$row_mediospago['idmon']==2)
					{
						$txtMoneda="DOLARES AMERICANOS";
					}	

				$i_m++;
			}
			//

			$texto_mediopago.=fNegrita($descript)."; ";
			$texto_mediopago.=" MONEDA: ".fNegrita($txtMoneda).utf8_decode("; TIPO Y CÓDIGO DE MEDIO DE PAGO: ").$row_querypagos["desmpagos"]."-".$row_querypagos['sunat'];
			$texto_mediopago.=utf8_decode("; NÙMERO DE DOCUMENTO QUE ACREDITA EL USO DE MEDIO DE PAGO: ").fNegrita($nnumOperacion);
			$texto_mediopago.="; EMPRESA(S) DEL SISTEMA FINANCIERO: ".fNegrita($row_querypagos["desbanco"]);

			$texto_mediopago.=utf8_decode("; FECHA(S) EMISIÓN O FECHA(S) DE OPERACIÓN: ").fNegrita($ffOrperacion).". ";
			$descript="";		

			$textoMediosPago.=$texto_mediopago;
				//textoMediosPago
		}
	}else{

		if($numPlantilla!='tv2' && $numPlantilla!='tv3')
{
			$textoMediosPago=utf8_decode("DE CONFORMIDAD CON LA LEY NRO. 30730, SE DEJA CONSTANCIA QUE LAS PARTES CONTRATANTES NO HAN CUMPLIDO CON EXHIBIR EL MEDIO DE PAGO UTILIZADO EN LA PRESENTE TRANSFERENCIA, SIENDO QUE LA OBLIGACIÓN MATERIA DE PAGO ES INFERIOR A 3 UNIDADES IMPOSITIVAS TRIBUTARIAS.");

		}else
			{
				$textoMediosPago=utf8_decode("PARA EFECTOS DE LO ESTABLECIDO POR LA LEY N° 30730 DEJO CONSTANCIA, QUE LOS OTORGANTES DECLARAN BAJO JURAMENTO NO PODER EXHIBIR LOS MEDIOS DE PAGO FINANCIEROS POR CUANTO EL PAGO DE LA TOTALIDAD DE CUOTAS DEL PRECIO SE CANCELO CON ANTERIORIDAD A LA VIGENCIA DE DICHA LEY.");
			}
		
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
	$file_name      		= $rutaVehicular."__PROY__".$num_kardex."."."docx";	
	$file_name_show 		= $num_kardex.$extension;
	$PREACATA="ESCRITURA";	
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
if(trim($num_escritura_letras2)=="CERO")
			$num_escritura_letras2="";

$numeroskardex=$num_kardex;

$textoCompareciente=""; 
if((int)$rowcabecera1['conMinuta']==1)
{
	//cuando hay minuta 

	if($vvCont>1)
	{
	$textoCompareciente="LOS COMPARECIENTES, QUIENES SE OBLIGAN CON CAPACIDAD, LIBERTAD Y CONOCIMIENTO SUFICIENTE, DE LO QUE DOY FE, Y HABIENDO CUMPLIDO CON IDENTIFICARLOS CON LOS DOCUMENTOS POR ELLOS PRESENTADOS, CUYOS NUMEROS FIGURAN EN EL PARRAFO QUE ANTECEDE DANDO CUMPLIMIENTO A LO ESTABLECIDO EN EL ARTICULO 54 INCISO D) DEL DECRETO DEL NOTARIADO, DECRETO LEGISLATIVO NUMERO 1049, ME ENTREGAN UNA MINUTA FIRMADA Y AUTORIZADA POR LETRADO PARA QUE ELEVE SU CONTENIDO A ESCRITURA PUBLICA, LA MISMA QUE ARCHIVO EN MI LEGAJO RESPECTIVO CON EL NUMERO DE ORDEN CORRESPONDIENTE Y CUYO TENOR LITERAL ES EL SIGUIENTE: ";
	}else
	{
		switch ($vvContSexo) {
			case 'F':
			$textoCompareciente="LA COMPARECIENTE, QUIEN SE OBLIGAN CON CAPACIDAD, LIBERTAD Y CONOCIMIENTO SUFICIENTE, DE LO QUE DOY FE, Y HABIENDO CUMPLIDO CON IDENTIFICARLA CON EL DOCUMENTO POR ELLA PRESENTADO, CUYO NUMERO FIGURA EN EL PARRAFO QUE ANTECEDE DANDO CUMPLIMIENTO A LO ESTABLECIDO EN EL ARTICULO 54 INCISO D) DEL DECRETO DEL NOTARIADO, DECRETO LEGISLATIVO NUMERO 1049, ME ENTREGA UNA MINUTA FIRMADA Y AUTORIZADA POR LETRADO PARA QUE ELEVE SU CONTENIDO A ESCRITURA PUBLICA, LA MISMA QUE ARCHIVO EN MI LEGAJO RESPECTIVO CON EL NUMERO DE ORDEN CORRESPONDIENTE Y CUYO TENOR LITERAL ES EL SIGUIENTE: ";
				break;
			
			default:
				$textoCompareciente="EL COMPARECIENTE, QUIEN SE OBLIGAN CON CAPACIDAD, LIBERTAD Y CONOCIMIENTO SUFICIENTE, DE LO QUE DOY FE, Y HABIENDO CUMPLIDO CON IDENTIFICARLO CON EL DOCUMENTO POR EL PRESENTADO, CUYO NUMERO FIGURA EN EL PARRAFO QUE ANTECEDE DANDO CUMPLIMIENTO A LO ESTABLECIDO EN EL ARTICULO 54 INCISO D) DEL DECRETO DEL NOTARIADO, DECRETO LEGISLATIVO NUMERO 1049, ME ENTREGA UNA MINUTA FIRMADA Y AUTORIZADA POR LETRADO PARA QUE ELEVE SU CONTENIDO A ESCRITURA PUBLICA, LA MISMA QUE ARCHIVO EN MI LEGAJO RESPECTIVO CON EL NUMERO DE ORDEN CORRESPONDIENTE Y CUYO TENOR LITERAL ES EL SIGUIENTE: ";
				break;
		}	
	}
}else
{
	if($vvCont>1)
	{
		$textoCompareciente="LOS COMPARECIENTES, QUIENES SE OBLIGAN CON CAPACIDAD, LIBERTAD Y CONOCIMIENTO SUFICIENTE, DE LO QUE DOY FE, Y HABIENDO CUMPLIDO CON IDENTIFICARLOS CON LOS DOCUMENTOS POR ELLOS PRESENTADOS, CUYO NUMEROS FIGURA EN EL PARRAFO QUE ANTECEDE, DANDO CUMPLIMIENTO A LO ESTABLECIDO EN EL ARTICULO 54 INCISO D) DEL DECRETO DEL NOTARIADO, DECRETO LEGISLATIVO 1049, DEJANDO CONSTANCIA QUE EN LA FORMALIZACION DEL PRESENTE INSTRUMENTO NO SE REQUIERE LA PRESENTACION DE MINUTA, DE CONFORMIDAD CON LO DISPUESTO EN EL ARTICULO ".utf8_decode("58°")." DE LA LEY DEL NOTARIADO, MANIFESTANDOME EL COMPARECIENTE LO SIGUIENTE: ";
	}else
	{

		switch ($vvContSexo) {
			case 'F':
			$textoCompareciente="LA COMPARECIENTE, QUIEN SE OBLIGA CON CAPACIDAD, LIBERTAD Y CONOCIMIENTO SUFICIENTE, DE LO QUE DOY FE, Y HABIENDO CUMPLIDO CON IDENTIFICARLA CON EL DOCUMENTO POR ELLA PRESENTADO, CUYO NUMERO FIGURA EN EL PARRAFO QUE ANTECEDE, DANDO CUMPLIMIENTO A LO ESTABLECIDO EN EL ARTICULO 54 INCISO D)DEL DECRETO DEL NOTARIADO, DECRETO LEGISLATIVO 1049, DEJANDO CONSTANCIA QUE EN LA FORMALIZACION DEL PRESENTE INSTRUMENTO NO SE REQUIERE LA PRESENTACION DE MINUTA, DE CONFORMIDAD CON LO DISPUESTO EN EL ARTICULO ".utf8_decode("58°")." DE LA LEY DEL NOTARIADO, MANIFESTANDOME EL COMPARECIENTE LO SIGUIENTE:";
				break;
			
			default:
				$textoCompareciente="EL COMPARECIENTE, QUIEN SE OBLIGA CON CAPACIDAD, LIBERTAD Y CONOCIMIENTO SUFICIENTE, DE LO QUE DOY FE, Y HABIENDO CUMPLIDO CON IDENTIFICARLO CON EL DOCUMENTO POR EL PRESENTADO, CUYO NUMERO FIGURA EN EL PARRAFO QUE ANTECEDE, DANDO CUMPLIMIENTO A LO ESTABLECIDO EN EL ARTICULO 54 INCISO D) DEL DECRETO DEL NOTARIADO, DECRETO LEGISLATIVO 1049, DEJANDO CONSTANCIA QUE EN LA FORMALIZACION DEL PRESENTE INSTRUMENTO NO SE REQUIERE LA PRESENTACION DE MINUTA, DE CONFORMIDAD CON LO DISPUESTO EN EL ARTICULO ".utf8_decode("58°")." DE LA LEY DEL NOTARIADO, MANIFESTANDOME EL COMPARECIENTE LO SIGUIENTE:";
				break;
		}
	}
}

/*
BIEN
*/

$sqlBien = "SELECT  detallevehicular.numplaca AS placa,detallevehicular.motor,detallevehicular.clase, detallevehicular.marca,detallevehicular.anofab AS anio,detallevehicular.modelo,detallevehicular.carroceria,detallevehicular.color, detallevehicular.numserie AS numero_serie, sedesregistrales.dessede as zona_reg,
(SELECT idmon FROM patrimonial WHERE itemmp=detallevehicular.itemmp LIMIT 1) AS idmon,
 (SELECT importetrans FROM patrimonial WHERE itemmp=detallevehicular.itemmp LIMIT 1) AS importe
 FROM detallevehicular 
			LEFT JOIN sedesregistrales ON detallevehicular.idsedereg=sedesregistrales.idsedereg
			INNER JOIN tiposdeacto ON tiposdeacto.idtipoacto = detallevehicular.idtipacto
			INNER JOIN det_placa ON det_placa.id_placa = detallevehicular.idplaca
			WHERE detallevehicular.kardex = '$num_kardex'";
	
		$resultBien = mysql_query($sqlBien);
		$arrPatrimonial = array();
		while ($record = mysql_fetch_assoc($resultBien)) {
				if($record['placa']!="")			
					$record['placa'] = mb_strtoupper($record['placa']);
				else
					$record['placa']="<NO ESPECIFICA>";

				if($record['motor']!="")
					$record['motor'] = mb_strtoupper($record['motor']);
				else
					$record['motor']="<NO ESPECIFICA>";

				if($record['clase']!="")
					$record['clase'] = mb_strtoupper($record['clase']);
				else
					$record['clase']="<NO ESPECIFICA>";

				if($record['marca']!="")
					$record['marca'] = mb_strtoupper($record['marca']);
				else
					$record['marca'] ="<NO ESPECIFICA>";

				if($record['anio']!="")
					$record['anio'] = mb_strtoupper($record['anio']);
				else
					$record['anio'] ="<NO ESPECIFICA>";

				if($record['modelo']!="")
					$record['modelo'] = mb_strtoupper($record['modelo']);
				else
					$record['modelo']="<NO ESPECIFICA>";

				if($record['carroceria']!="")
					$record['carroceria'] = mb_strtoupper($record['carroceria']);
				else
					$record['carroceria'] ="<NO ESPECIFICA>";

				if($record['color']!="")
					$record['color'] = mb_strtoupper($record['color']);
				else
					$record['color']="<NO ESPECIFICA>";

				if($record['numero_serie']!="")
					$record['numero_serie'] = mb_strtoupper($record['numero_serie']);
				else
					$record['numero_serie'] ="<NO ESPECIFICA>";

				if($record['zona_reg']!="")
					$record['zona_reg'] = mb_strtoupper($record['zona_reg']);
				else
					$record['zona_reg']="<NO ESPECIFICA>";


				$record['importe'] = ($record['idmon']=="2"?"US$":"S/")." ".$record['importe']." (".$precio->fun_capital_moneda($record['idmon'],$record['importe'],'monto').")"; 
//				".$SIMBOLO_MONEDA." ".$IMPORTE_PATRIMONIAL." (".$LETRA_IMPORTE_PATRIMONIAL.") 

				$arrPatrimonial[] = $record;
			}
/*FIN BIEN*/

	$papel_ini="";
	if($PAPELINI!=null)
		$papel_ini=$PAPELINI;

	$papel_fin="";
	if($PAPELFIN!=null)
		$papel_fin=$PAPELFIN;

	
	//$titulo="abc";	 
	$textoCompareciente=trim($textoCompareciente);
	$TBS->LoadTemplate($template);
	$TBS->MergeBlock('bien',$arrPatrimonial);
	$TBS->MergeBlock('a', $dataContratantes);
	$TBS->MergeBlock('b', $dataContratantes2);
	$TBS->MergeBlock('c', $dataContratantes_r);
	$TBS->MergeBlock('g', $dataFirmas);
	$TBS->MergeBlock('h', $dataFirmas2);
	$TBS->MergeBlock('i', $txtListContratantes);
	$TBS->PlugIn(OPENTBS_DELETE_COMMENTS);
    $TBS->Show(TBSZIP_FILE, $file_name);				
	

$sql="select * from servidor where idservidor='1'";
$rpta=mysqli_query($conn_i,$sql) or die(mysqli_error($conn_i));
$row=mysqli_fetch_array($rpta);
$server = $row['nombre'];


if($server=="WINDOWS"){
	$directorio="\\"."\\".$server;
}else if($row["so"]=="LINUX"){
	$directorio="";
} 

$directorio.= $rutaVehicular."__PROY__".$num_kardex.".docx";

chmod($directorio, 0777);

/*
$rutaMinuta="C:\Doc_signo\Minutas\__MIN__K171230.odt";
	 //var_dump($fileName);
	 //return ;
$objetoDocumento = setFilePath($rutaMinuta);
//$textoString = convertToText();
echo utf8_decode($objetoDocumento);
return ;/*

/*
*/




echo "Se genero el archivo: ".$file_name_show." satisfactoriamente.. !!";
/*	mysql_query("update estadokardex set generado_proyecto='1' where kardex='".$num_kardex."'",$conn) or die(mysql_error());
*/

?>



