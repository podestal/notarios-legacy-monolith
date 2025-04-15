
<?php

$fechade = $_POST['fechade'];
$fecha=explode("/",$fechade);
$desde=$fecha[2]."-".$fecha[1]."-".$fecha[0];

$fechaa  = $_POST['fechaa'];
$fecha2=explode("/",$fechaa);
$hasta=$fecha2[2]."-".$fecha2[1]."-".$fecha2[0];

$fec_cons = $_POST['fec_cons'];
$fec_not = $_POST['fec_not'];
$fec_ing = $_POST['fec_ing'];

$cantidad_tres= $_POST['tre'];
$cantidad_cuatro = $_POST['cuatro'];

if($_POST['fechade']!="" or $_POST['fechaa']!="") {
	
include("../conexion.php");
include('../extraprotocolares/view/funciones.php');
include_once('../includes/tbs_class.php');
include_once('../includes/tbs_plugin_opentbs.php');
include_once('../extraprotocolares/Config/Configuracion.php');
include_once('../ClaseLetras.class.php');

//se crea el objeto  ClaseLetras
	$fecha = new ClaseNumeroLetra();
	
	$dia  = $fecha->fun_fecha_dia(); 
	$mes  = $fecha->fun_fecha_mes();
	$anio = $fecha->fun_fecha_anio();
	$fec_letras = $fecha->fun_fech_compleDO(date("Y/m/d"));


//Exportar datos de php a Excel
header("Content-Description: File Transfer");  
header("Content-Type: application/force-download"); 
header("Content-Disposition: attachment; filename=ACTAS.doc"); 


$consulta_protestos =  "SELECT 
						protesto.id_protesto as id_protesto,
						protesto.num_protesto as num_protesto,
						protesto.fec_ingreso AS 'fec_ingreso', 
						protesto.fec_notificacion AS 'fec_notificacion',
						CONCAT (' SOLICITANTE: ',protesto.solicitante)as solicitante,
						protesto.fec_constancia AS 'fec_constancia',
						monedas.simbolo as moneda,
						protesto.importe as importe,
						protesto.tipo as tipo,
						protesto.fec_venc as vencimiento,
						protesto.anio as anio,
						monedas.desmon AS desmon,
						protesto.diligencia as diligencia
						FROM
						protesto
						LEFT OUTER JOIN monedas ON monedas.idmon = protesto.moneda";
						
if($fec_cons=='on'){						
	$consulta_protestos = $consulta_protestos." where STR_TO_DATE(protesto.fec_constancia,'%Y-%m-%d') >= STR_TO_DATE('".$desde."','%Y-%m-%d') AND STR_TO_DATE(protesto.fec_constancia,'%Y-%m-%d') <= STR_TO_DATE('".$hasta."','%Y-%m-%d') ORDER BY fec_constancia, num_protesto ASC";
}

if($fec_not=='on'){						
	$consulta_protestos = $consulta_protestos." where STR_TO_DATE(protesto.fec_notificacion,'%Y-%m-%d') >= STR_TO_DATE('".$desde."','%Y-%m-%d') AND STR_TO_DATE(protesto.fec_notificacion,'%Y-%m-%d') <= STR_TO_DATE('".$hasta."','%Y-%m-%d') ORDER BY fec_notificacion, id_protesto ASC";
}

if($fec_ing=='on'){						
	$consulta_protestos = $consulta_protestos." where STR_TO_DATE(protesto.fec_ingreso,'%Y-%m-%d') >= STR_TO_DATE('".$desde."','%Y-%m-%d') AND STR_TO_DATE(protesto.fec_ingreso,'%Y-%m-%d') <= STR_TO_DATE('".$hasta."','%Y-%m-%d') ORDER BY fec_ingreso, id_protesto ASC"; 
}

$ejecutar_protestos = mysql_query($consulta_protestos, $conn);

$confinotario=mysql_query("SELECT nombre,apellido FROM confinotario",$conn);
$resnotario=mysql_fetch_assoc($confinotario);
$nombrenotario=$resnotario['nombre']." ".$resnotario['apellido'];
			   
?>
<HTML LANG="es">
<TITLE>::. Exportacion de Datos .::</TITLE>
<style>

.cualquierotroestilo{
   font-size: 9px;
   font-family: Arial;
   line-height:1em;
  text-align: justify;
}
.cualquierotroestilo2{
   font-size: 9px;
   font-family: Arial;
   font-weight: bold;
}

</style>
<body>          

<!--<table width="600" bordercolor="#333333"  BORDER="0" align="center">   -->
<?php
$i=0;
$x=1;
while($protestos = mysql_fetch_array($ejecutar_protestos)){

	$arr_protestos[$i][0] = $protestos["id_protesto"]; 
	$arr_protestos[$i][1] = $protestos["num_protesto"]; 
	$arr_protestos[$i][2] = $protestos["fec_ingreso"]; 
	$arr_protestos[$i][3] = $protestos["fec_notificacion"]; 
	$arr_protestos[$i][4] = $protestos["solicitante"]; 
	$arr_protestos[$i][5] = $protestos["fec_constancia"]; 
	$arr_protestos[$i][6] = $protestos["moneda"]; 
	$arr_protestos[$i][7] = $protestos["importe"]; 
	$arr_protestos[$i][8] = $protestos["tipo"]; 
	$arr_protestos[$i][9] = $protestos["vencimiento"]; 
	$arr_protestos[$i][10] = $protestos["anio"]; 
	$arr_protestos[$i][11] = $protestos["desmon"]; 
	$arr_protestos[$i][12] = $protestos["diligencia"]; 
	$i++; 
}
			
	for($j=0; $j<count($arr_protestos); $j++) { 
	
	$id_protesto = $arr_protestos[$j][0];
	$anio = $arr_protestos[$j][10];
	$importe = $arr_protestos[$j][7];
	$num_acta1 = $arr_protestos[$j][1];
	$num_acta = substr($num_acta1,5,6).'-'.substr($num_acta1,0,4);
	
	$consuldeudor = mysql_query('SELECT protesto_participantes.tip_condi,GROUP_CONCAT(CONCAT("OBLIGADO: ",cliente.prinom," ",cliente.segnom," ",cliente.apepat," ",cliente.apemat, cliente.razonsocial) SEPARATOR " / ") AS descri_parti, 
	GROUP_CONCAT(CONCAT(`num_docparti`) SEPARATOR " / ") AS num_docparti,GROUP_CONCAT(CONCAT("DIRECCION: ",IF(cliente.tipper="N",cliente.direccion,cliente.domfiscal))SEPARATOR " / ") AS direccion,
	cliente.telfijo,protesto.id_protesto,protesto_participantes.id_participante
	FROM protesto_participantes
	LEFT OUTER JOIN cliente ON cliente.numdoc = protesto_participantes.num_docparti
	LEFT OUTER JOIN protesto ON protesto.id_protesto = protesto_participantes.id_protesto
	WHERE  protesto_participantes.tip_condi = "002" AND protesto.id_protesto = "'.$id_protesto.'" and protesto.anio= "'.$anio.'" ', $conn) or die(mysql_error());
		$rowdeudor = mysql_fetch_array($consuldeudor);
	
	$obligado = utf8_decode($rowdeudor['descri_parti']);
	$domicilio = utf8_decode($rowdeudor['direccion']);
	$fec_ingreso  = $fecha->fun_fech_compleDO($arr_protestos[$j][2]);
	$fec_NOTIFIC  = $fecha->fun_fech_compleDO($arr_protestos[$j][3]);
	$fec_CONSTANC  = $fecha->fun_fech_compleDO($arr_protestos[$j][5]);
	
	if($arr_protestos[$j][8]=='001'){
		$tipo=' UNA LETRA DE CAMBIO';	
	}else if ($arr_protestos[$j][8]=='002'){
		$tipo=' UN PAGARE';		
	}else if ($arr_protestos[$j][8]=='003'){
		$tipo=' UN CHEQUE';		
	}else if ($arr_protestos[$j][8]=='004'){
		$tipo=' UN WARRANT';		
	}
	
	
		
	$acta="ACTA NUMERO:"." ".$num_acta.".  ====================================================================================";
	$contenido ="PROTESTO DE ".$tipo.". MONTO ".$arr_protestos[$j][6]." ".$arr_protestos[$j][7]." ".$valletras=strtoupper(valorEnLetras2($importe))." "
	.$arr_protestos[$j][11]." ".$arr_protestos[$j][4]." ".$obligado." ".$domicilio." FECHA DE PRESENTACION AL NOTARIO: ".$fec_ingreso." NOTIFICADO: ".$fec_NOTIFIC."
	FECHA DE CONSTANCIA: ".$fec_CONSTANC." DILIGENCIA: LA DILIGENCIA SE REALIZO EN LA DIRECCION QUE SE INDICA, ".$arr_protestos[$j][12]." =======================";
	$acabado="FIRMA LA PRESENTE: EL DR. ".$nombrenotario."  ABOGADO-NOTARIO DE LIMA. ========================";
	if($cantidad_tres=='on'){
		$espacios="<br/><br/><br/><br/><br/><br/><br/><br/><br/>";
	}else if ($cantidad_cuatro=='on') {
		$espacios="<br/><br/><br/><br/><br/>";
	}
	
	//echo "<align='left'><td class='cualquierotroestilo2' >".$acta."</td>";
	echo "<p class='cualquierotroestilo' ><b>".$acta."</b><br/>".strtoupper($contenido)."<br/>".$acabado."</p>".$espacios."";
	

	
}?>

<!--</table>-->
</body>
</html>

<?php
}else{
	echo "<script>window.location='../generaracta.php'</script>";	
}
?>