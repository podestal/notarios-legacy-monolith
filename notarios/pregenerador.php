<?php 

session_start();

//DECLARAMOS LA CONEXION
include("conexion2.php");
$PRE_tipoRuta	= $_REQUEST["tipo"];
$PRE_kardex		= $_REQUEST["num_kardex"];
$PRE_tipoKardex	= $_REQUEST["tip_kardex"];
$PRE_tipoActo	= $_REQUEST["idtipoacto"];
$accion	= $_REQUEST["accion"];
$idTemplate	= $_REQUEST["idTemplate"];

$_grupoCliente=$_REQUEST['grupoCliente'];
$sql="select nombre from servidor where idservidor='1'";
$rpta=mysqli_query($conn_i,$sql) or die(mysqli_error($conn_i));
$row=mysqli_fetch_array($rpta);
$server = $row['nombre'];

/*
$sql_plantilla="SELECT * FROM confiplantillas where id='1'"; 
$rpta_plantillas=mysqli_query($conn_i,$sql_plantilla);
$row_plantillas = mysqli_fetch_array($rpta_plantillas);
*/

/*
$sql33="select * from configuraciones where id='2'";
$rpta33=mysqli_query($conn_i,$sql33) or die(mysqli_error($conn_i));
$row33=mysqli_fetch_array($rpta33);
*/

if(!isset($row33['estado']))
	$row33['estado']="";
$estadopagos = $row33['estado'];

if($PRE_tipoRuta=='15' || $PRE_tipoRuta=='23'){
	
	if($estadopagos==0){
		$validador=1;
	}else{
		$validador=0;	
		
		$queryNotariales=mysqli_query($conn_i,
		"SELECT 
		  SUM(total) AS notariales 
		FROM
		  presupuesto 
		WHERE kardex = '".$PRE_kardex."' 
		  AND tiposervicio = 'DN'
		"
		) or die(mysqli_error($conn_i));
		$rowN=mysqli_fetch_array($queryNotariales);
		$presupuestoNotarial = $rowN['notariales'];
		
		$queryPagosNotariales=mysqli_query($conn_i,
		"SELECT
			(d_regventas.total) total			
			FROM
			d_regventas
			INNER JOIN m_regventas ON m_regventas.id_regventas = d_regventas.id_regventas
			INNER JOIN m_tippagos  ON m_tippagos.`id_regventas` = m_regventas.`id_regventas`
			LEFT JOIN m_cteventas  ON m_cteventas.id_regventas = m_regventas.id_regventas
			INNER JOIN tipocomprobante ON tipocomprobante.idcompro = m_regventas.tipo_docu
			WHERE d_regventas.kardex = '".$PRE_kardex."'
			GROUP BY d_regventas.`id_dregventas`
		"
		) or die(mysqli_error($conn_i));
		while($rowPN=mysqli_fetch_array($queryPagosNotariales)){
		$presupuestoPagoNotarial += $rowPN['total'];
		}

		$resta=(intval($presupuestoPagoNotarial)-intval($presupuestoNotarial));
		//echo $resta;
		if(intval($resta)>=0){
			$validador=1;	
		}else{
			$validador=0;	
		}
		
	}
	
}else{
	$validador=1;	
}

if($validador==1){
	
	$mainfile = "\Doc_Signo/Proyectos/";
	$rutageneral = "\\"."\\".$server.$mainfile;
	//$ruta = $rutageneral;	
	 $ruta="C:/Minutas/";
	$archivo = "__PROY__".$PRE_kardex.".docx"; 
	$root = $ruta;
	$file = basename($archivo);
	$path = $root.$file;
	
	
	if(is_file($path)){
	
		 echo("<script>if(confirm('ATENCION: ESTE KARDEX YA HA SIDO GENERADO, DESEA GENERARLO NUEVAMENTE .. ?')){
			window.location='pregenerador2.php?tipo=$PRE_tipoRuta&num_kardex=$PRE_kardex&idtipoacto=$PRE_tipoActo&tip_kardex=$PRE_tipoKardex';
		 } else {
			window.close();
		 };</script>");
		
	}else{

		if($PRE_tipoRuta==15 || $PRE_tipoRuta=='23'){
		
			### CONSULTAMOS SI EL ACTO TIENE TEMPLATE ####	
/*			$sql_consulta_tipo_plantilla="select plantilla,archivo from rutatemplates where tipo='15' and idtipacto='".$PRE_tipoActo."'";	
			$rpta_consulta_tipo_plantilla=mysqli_query($conn_i,$sql_consulta_tipo_plantilla) or die(mysqli_error($conn_i));
			$roww_consulta_tipo_plantilla=mysqli_fetch_array($rpta_consulta_tipo_plantilla);*/

			if(!isset($roww_consulta_tipo_plantilla["archivo"]))
				$roww_consulta_tipo_plantilla["archivo"]="";
			$ruta_template_valida=$roww_consulta_tipo_plantilla["archivo"];
			//mysqli_num_rows($rpta_consulta_tipo_plantilla)==0
			if(true){
				$sql_consulta_tipo_plantillaxxx="select tipoplantilla_default from tiposdeacto where idtipoacto='".$PRE_tipoActo."'";	
				$rpta_consulta_tipo_plantillaxxx=mysqli_query($conn_i,$sql_consulta_tipo_plantillaxxx) or die(mysqli_error($conn_i));
				$roww_consulta_tipo_plantillaxxx=mysqli_fetch_array($rpta_consulta_tipo_plantillaxxx);
				//REDIRECCIONAMOS AL GENERADOR POR DEFAULT
				//$roww_consulta_tipo_plantillaxxx["tipoplantilla_default"]==1

		
				if($PRE_tipoKardex==1){
					// header("Location: reportes_word/generador_defaultUnaParte.php?tipo=$PRE_tipoRuta&num_kardex=$PRE_kardex&idtipoacto=$PRE_tipoActo");
					header("Location: reportes_word/generador_escritura_publica.php?tipo=$PRE_tipoRuta&num_kardex=$PRE_kardex&idtipoacto=$PRE_tipoActo&accion=$accion&idTemplate=$idTemplate&idtipkar=$PRE_tipoKardex");
				}else if($PRE_tipoKardex==3){
					// header("Location: reportes_word/generador_defaultDosPartes.php?tipo=$PRE_tipoRuta&num_kardex=$PRE_kardex&idtipoacto=$PRE_tipoActo&grupoCliente=$_grupoCliente");
					header("Location: reportes_word/generador_transferencia_vehicular.php?tipo=$PRE_tipoRuta&num_kardex=$PRE_kardex&idtipoacto=$PRE_tipoActo&grupoCliente=$_grupoCliente&accion=$accion&idTemplate=$idTemplate&idtipkar=$PRE_tipoKardex");
				}else if($roww_consulta_tipo_plantillaxxx["tipoplantilla_default"]==3){
					header("Location: reportes_word/generador_defaultEmpresas.php?tipo=$PRE_tipoRuta&num_kardex=$PRE_kardex&idtipoacto=$PRE_tipoActo");
				}else if($PRE_tipoKardex==6){
					header("Location: reportes_word/generador_defaultCopiaCertificada.php?tipo=$PRE_tipoRuta&num_kardex=$PRE_kardex&idtipoacto=$PRE_tipoActo&grupoCliente=$_grupoCliente");
				}else if($PRE_tipoKardex==4){
					// header("Location: reportes_word/generador_defaultDosPartesGM.php?tipo=$PRE_tipoRuta&num_kardex=$PRE_kardex&idtipoacto=$PRE_tipoActo&grupoCliente=$_grupoCliente");
					header("Location: reportes_word/generador_garantias_mobiliarias.php?tipo=$PRE_tipoRuta&num_kardex=$PRE_kardex&idtipoacto=$PRE_tipoActo&accion=$accion&idTemplate=$idTemplate");
				}else if($PRE_tipoKardex==2){
					
					header("Location: reportes_word/generador_asunto_no_contencioso.php?tipo=$PRE_tipoRuta&num_kardex=$PRE_kardex&idtipoacto=$PRE_tipoActo&accion=$accion&idTemplate=$idTemplate");
				}else if($PRE_tipoKardex==5){
					header("Location: reportes_word/generador_testamento.php?tipo=$PRE_tipoRuta&num_kardex=$PRE_kardex&idtipoacto=$PRE_tipoActo&accion=$accion&idTemplate=$idTemplate");
				}else{
					header("Location: reportes_word/generador_defaultUnaParte.php?tipo=$PRE_tipoRuta&num_kardex=$PRE_kardex&idtipoacto=$PRE_tipoActo");
				}
				
				
			}else{
				header("Location: reportes_word/$ruta_template_valida?tipo=$PRE_tipoRuta&num_kardex=$PRE_kardex&idtipoacto=$PRE_tipoActo");
				
			}
			
		}else{
			echo "<script>alert('Este archivo no es un kardex..!!');window.close();</script>";
		}
		
	}
	
}else{
	echo "<script>alert('ERROR: No se ha podido generar el proyecto debido a que no se ha cancelado completamente el presupuesto. Consulte con el Administrador');window.close();</script>";
	
}
?>