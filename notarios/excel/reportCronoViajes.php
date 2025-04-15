<?php

$fechade = $_POST['fechade'];
$fecha=explode("/",$fechade);
$desde=$fecha[2]."-".$fecha[1]."-".$fecha[0];

$fechaa  = $_POST['fechaa'];
$fecha2=explode("/",$fechaa);
$hasta=$fecha2[2]."-".$fecha2[1]."-".$fecha2[0];


function obtenerFechaEnLetra($fecha){
    $dia= conocerDiaSemanaFecha($fecha);
    $num = date("j", strtotime($fecha));
    $anno = date("Y", strtotime($fecha));
    $mes = array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
    $mes = $mes[(date('m', strtotime($fecha))*1)-1];
    return $dia.', '.$num.' de '.$mes.' del '.$anno;
}
function conocerDiaSemanaFecha($fecha) {
    $dias = array('Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado');
    $dia = $dias[date('w', strtotime($fecha))];
    return $dia;
}


if($_POST['fechade']!="" or $_POST['fechaa']!="") {
	
include("../conexion.php");
include("../extraprotocolares/view/funciones.php");//Exportar datos de php a Excel

$tipoDocumento = $_POST['enviarrr'];

$extension = '';
if($tipoDocumento == 'EXCEL'){
	$extension = 'xls';
}else if($tipoDocumento == 'WORD'){
	$extension = 'doc';
}

header("Content-Description: File Transfer");  
header("Content-Type: application/force-download"); 
// header("Content-Disposition: attachment; filename=IC_PV.doc");
header("Content-Disposition: attachment; filename=INDICE_CRONOLOGICO_PERMISOS_DE_VIAJE_".$fecha2[2].".".$extension);
$consulta = mysql_query("SELECT
				permi_viaje.id_viaje as cod_viaje,
				permi_viaje.fec_ingreso as fec_ingreso,
				permi_viaje.fecha_crono as fec_crono,
				permi_viaje.num_kardex as kard,
				(CASE WHEN(permi_viaje.asunto=001) THEN 'PERMISO VIAJE AL INTERIOR' ELSE 'PERMISO VIAJE AL EXTERIOR' END) as asunto,
				permi_viaje.lugar_formu as lugar,
				permi_viaje.swt_est as estado,
				permi_viaje.num_kardex AS crono,
				permi_viaje.num_formu AS formulario,
				permi_viaje.via,
				upper(permi_viaje.observacion) as observacion
					FROM
					permi_viaje
					where STR_TO_DATE(permi_viaje.fecha_crono,'%Y-%m-%d') >= STR_TO_DATE('".$desde."','%Y-%m-%d') 
				    AND STR_TO_DATE(permi_viaje.fecha_crono,'%Y-%m-%d') <= STR_TO_DATE('".$hasta."','%Y-%m-%d') order by kard", $conn) or die(mysql_error());
$paginador=2;
$confinotario=mysql_query("SELECT nombre,apellido FROM confinotario",$conn);
$resnotario=mysql_fetch_assoc($confinotario);
$nombrenotario=$resnotario['nombre']." ".$resnotario['apellido'];	
$desc = 'Descripción';
					   
?>
<HTML LANG="es">
<head>
<TITLE>::. Exportacion de Datos .::</TITLE>
 <meta charset="UTF-8">
<style>
br{margin-bottom:-15px;}
.Estilo12{
}
table{
	font-family:Arial;
	font-size: 13.5px;
	width:100%;
	border-collapse:collapse;
}
</style>
</head>
<body>

<table width='1000' border='0' cellpadding='0' cellspacing='0'>
<tr>
	<td colspan="7" align="center" style="font-size:18.5px"><b>INDICE CRONOLOGICO - PERMISOS DE VIAJE</b></td>
	
</tr>
<tr>
	<td colspan="7" align="center" style="font-size:18.5px"><b><?php echo ('AÑO ').$fecha2[2];?></b></td>
</tr>
<tr><td>&nbsp;</td></tr>
<!-- <tr><td>&nbsp;</td></tr> -->
<tr>
	<td colspan="2" align="left"><b><span>NOTARIA</span></b></td>
	<td align="left"><span>: <?php echo $nombrenotario;?></span></td>
	<td></td>
	<td></td>
	<td colspan="2"></td>
</tr>
<tr>
	<td colspan="2"align="left"><b><span>DIRECCION</span></b></td>
	<td align="left"><span>: JR.BOLIVAR NRO. 340</span></td>
	<td></td>
	<td><b>TELEFONO</b></td>
	<td colspan="2">: (051) 326609</td>
</tr>
<tr>
	<td colspan="2"align="left"><b><span>DEPARTAMENTO</span></b></td>
	<td align="left"><span>: PUNO</span></td>
	<td></td>
	<td><b>RUC</b></td>
	<td colspan="2">: 10024231572</td>
</tr>
<tr>
	<td  colspan="2"align="left"><b><span>PROVINCIA</span></b></td>
	<td align="left"><span>: SAN ROMAN</span></td>
	<td></td>
	<td align="left"><b><span>DESDE </span></b></td>
	<td colspan="2" align="left"><span>: <?php echo strtoupper(obtenerFechaEnLetra($desde));?></span></td>
</tr>
<tr>
	<td  colspan="2"align="left"><b><span>DISTRITO</span></b></td>
	<td align="left"><span>: JULIACA</span></td>
	<td></td>
	<td align="left"><b><span>HASTA</span></b></td>
	<td colspan="2" align="left"><span>: <?php echo strtoupper(obtenerFechaEnLetra($hasta)); ?></span></td>
</tr>
</table>
<br>
<table width="650" bordercolor="#333333"  BORDER="1" align="center" CELLPADDING="0" CELLSPACING="0">       
		<tr class="titulos">   
        
                     <TH  width='20' align="center"><span class=''>NRO.</span></TH >
						<TH  width='73' align="center" ><span class=''>FECHA</span></TH >
                      <TH  width='320' align="center"><span class=''>PARTICIPANTES</span></div></TH >
                     
                     <TH  width='150' align="center"><span class=''>VIA</span></TH >
                     <TH  width='200' align="center"><span class=''>DESTINO</span></TH >
                     <TH  width='250' align="center"><span class=''>OBSERVACIONES</span></TH >
                     
                   
                       
            </tr> 

            
<?php
$i=0;
$x = 1;
	while($viaje = mysql_fetch_array($consulta)){

	$arr_viaje[$i][0] = $viaje["cod_viaje"]; 
	$arr_viaje[$i][1] = $viaje["fec_ingreso"]; 
	$arr_viaje[$i][2] = $viaje["fec_crono"]; 
	$arr_viaje[$i][3] = $viaje["kard"]; 
	//$arr_viaje[$i][4] = $viaje["asunto"]; 
	$arr_viaje[$i][5] = $viaje["lugar"]; 
	$arr_viaje[$i][6] = $viaje["estado"];
	$arr_viaje[$i][7] = $viaje["crono"];
	$arr_viaje[$i][8] = $viaje["formulario"];
	$arr_viaje[$i][9] = $viaje["via"];
	$arr_viaje[$i][10] = $viaje["observacion"];
	
	
	$i++; 
}

	for($j=0; $j<count($arr_viaje); $j++) { 

$sql = mysql_query("SELECT 
						vc.id_viaje, 
						vc.c_descontrat,
						cc.des_condicion,
						vc.c_codcontrat as doc,
						td.td_abrev as tipo_documento 
					FROM viaje_contratantes as vc
					LEFT JOIN cliente as c ON c.numdoc=vc.c_codcontrat
					LEFT JOIN tipodocumento as td ON td.idtipdoc=c.idtipdoc
					LEFT JOIN c_condiciones as cc ON vc.c_condicontrat = cc.id_condicion
					WHERE vc.id_viaje='".$arr_viaje[$j][0]."' 
					GROUP BY vc.c_codcontrat,cc.des_condicion
					ORDER BY vc.id_contratante",$conn) or die(mysql_error());

	echo "<tr>
			<td width='20' class='cualquierotroestilo'  valign='top' align='center'><div style='height:40px;width:20px'><span class='Estilo12'>".(int)substr($arr_viaje[$j][7], 4,8)."</span></div></td>
			<td width='73' class='cualquierotroestilo'  valign='top' align='center'><div style='height:40px;width:20px'><span class='Estilo12'>".fechabd_an($arr_viaje[$j][2])."&nbsp; </span></div></td>
			
			<td width='300' class='cualquierotroestilo'  valign='top' ><div style='height:40px;width:20px'><table style='width:400px'>";		
	while($rowe2 = mysql_fetch_array($sql)){
	
	echo "<tr>
			<td style='width:300px;'>
				<span class='Estilo12'>".simbolos(($rowe2['des_condicion']." :".($rowe2['c_descontrat'])))."<br></span>
			</td>
			<td>
				<span class='Estilo12'>".($rowe2['tipo_documento']).':'.($rowe2['doc'])."<br></span>
			</td>
		</tr>";
	}
	echo "</table></div></td>
	<td width='150' class='cualquierotroestilo'  valign='top' align='center'><div style='height:40px;width:20px'><span class='Estilo12'>".$arr_viaje[$j][9]."</span></div></td>
	<td width='200' class='cualquierotroestilo'  valign='top' align='center'><div style='height:40px;width:20px'><span class='Estilo12'>".str_replace('?','-',strtoupper(($arr_viaje[$j][5])))."</span></div></td>
	<td width='250' class='cualquierotroestilo'  valign='top' align='left'><div style='height:40px;'><span class='Estilo12'>".strtoupper(($arr_viaje[$j][10]))."</span></div></td>
 	</tr>";

}?>
</table>
</body>
</html>

<?php
}else{
	echo "<script>window.location='../indicecronoviaje.php'</script>";	
}
?>