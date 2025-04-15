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
include("../extraprotocolares/view/funciones.php");

$tipoDocumento = $_POST['enviarrr'];

		$extension = '';
		if($tipoDocumento == 'EXCEL'){
			$extension = 'xls';
		}else if($tipoDocumento == 'WORD'){
			$extension = 'doc';
		}

//Exportar datos de php a Excel

header("Content-Description: File Transfer");  
header("Content-Type: application/force-download"); 
header("Content-Disposition: attachment; filename=INDICE_CRONOLOGICO_CARTAS_NOTARIALES_".$fecha2[2].".".$extension);
$consulta = mysql_query("SELECT
						ingreso_cartas.num_carta AS num_carta,
						DATE_FORMAT(STR_TO_DATE(fec_ingreso,'%d/%m/%Y'),'%d/%m/%Y') AS fec_ingreso,
						ingreso_cartas.fec_entrega AS fec_entrega,
						ingreso_cartas.hora_entrega AS hora_entrega,
						ingreso_cartas.nom_destinatario AS destinatario,
						ingreso_cartas.nom_remitente AS remitente,
						ubigeo.nomdis as zona,
						ingreso_cartas.dir_destinatario,
						ingreso_cartas.id_remitente as dni_remitente,
						ingreso_cartas.dni_destinatario,
						ingreso_cartas.dir_destinatario,
						ingreso_cartas.recepcion,
						ingreso_cartas.firmo
						FROM
						ingreso_cartas
						INNER JOIN ubigeo ON ubigeo.coddis = ingreso_cartas.zona_destinatario
						WHERE STR_TO_DATE(fec_ingreso,'%d/%m/%Y') BETWEEN STR_TO_DATE('".$fechade."','%d/%m/%Y') AND STR_TO_DATE('".$fechaa."','%d/%m/%Y')
						ORDER BY num_carta asc", $conn) or die(mysql_error());
$paginador=2;	
$confinotario=mysql_query("SELECT nombre,apellido FROM confinotario",$conn);
$resnotario=mysql_fetch_assoc($confinotario);
$nombrenotario=$resnotario['nombre']." ".$resnotario['apellido'];					   
?>
<HTML LANG="es">
<head>
<TITLE>::. Exportacion de Datos .::</TITLE>
<style>
.cualquierotroestilo{
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
	<td colspan="6" align="center" style="font-size:18.5px"><b>INDICE CRONOLOGICO - CARTAS NOTARIALES</b></td>
	
</tr>
<tr>
	<td colspan="6" align="center" style="font-size:18.5px"><b><?php echo utf8_decode('AÑO ').$fecha2[2];?></b></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td></tr>
<tr>
	<td colspan="2" align="left"><b><span>NOTARIA</span></b></td>
	<td colspan="1" align="left"><span>: <?php echo $nombrenotario;?></span></td>
	<td></td>
	<td></td>
</tr>
<tr>
	<td colspan="2" align="left"><b><span>DIRECCION</span></b></td>
	<td align="left"><span>: JR.BOLIVAR NRO. 340</span></td>
	<td><b>TELEFONO</b></td>
	<td colspan="2" >: (051) 326609</td>
</tr>
<tr>
	<td colspan="2" align="left"><b><span>DEPARTAMENTO</span></b></td>
	<td align="left"><span>: PUNO</span></td>
	<td><b>RUC</b></td>
	<td colspan="2">: 10024231572</td>
</tr>
<tr>
	<td colspan="2" align="left"><b><span>PROVINCIA</span></b></td>
	<td align="left"><span>: SAN ROMAN</span></td>
	<td align="left"><b><span>DESDE </span></b></td>
	<td colspan="2" align="left"><span>: <?php echo strtoupper(obtenerFechaEnLetra($desde));?></span></td>
</tr>
<tr>
	<td colspan="2" align="left"><b><span>DISTRITO</span></b></td>
	<td align="left"><span>: JULIACA</span></td>
	<td align="left"><b><span>HASTA</span></b></td>
	<td colspan="2" align="left"><span>: <?php echo strtoupper(obtenerFechaEnLetra($hasta)); ?></span></td>
</tr>
</table>
<br>
<table width="650" bordercolor="#333333"  BORDER="1" align="center" CELLPADDING="0" CELLSPACING="0">       
		<tr class="titulos">   
        
                <TH  width='104' align="center"><span class=''>NRO</span></TH >
                      <TH  width='94' align="center"><span class=''>FEC. INGRESO</span></div></TH >
                     <Td  width='200' align="center"><b><span class=''>DIRECCION ENTREGA</span></b></Td >
                     <Td  width='99' align="center"><b><span class=''>FEC. ENTREGA</span></b></Td >
                     <TH  width='89' align="center"><span class=''>RESULTADO</span></TH >
                     <TH  width='89' align="center"><span class=''>FIRMO</span></TH >
            </tr> 

<?php


while($row = mysql_fetch_array($consulta)){
	if($row['dni_destinatario']==''){
		$dniDestinatario = '&nbsp'; 
	}else{
		$dniDestinatario = 'DNI: '.$row['dni_destinatario'];
	}

echo "<tr>
			<td class='cualquierotroestilo' width='90'   align='center' valign='top'><div style='height:40px;width:20px'><span class='Estilo12'>".substr(formato_crono_agui($row['num_carta']),0,-5)."&nbsp;</span></div></td>
			<td class='cualquierotroestilo' width='86'   align='center' valign='top'><div style='height:40px;width:20px'><span class='Estilo12'>".$row['fec_ingreso']."</span></div></td>
			<td class='cualquierotroestilo' width='200'  align='left' valign='top'><div style='height:40px;width:20px'><span class='Estilo12'>".strtoupper(simbolos(utf8_decode($row['dir_destinatario'])))."</span></div></td>
			<td class='cualquierotroestilo' width='86'  align='center' valign='top'><div style='height:40px;width:20px'><span class='Estilo12'>".$row['fec_entrega']."</span></div></td>
			<td class='cualquierotroestilo'  width=90'  align='left' valign='top'><div style='height:40px;width:20px'><span class='Estilo12'>".utf8_decode(strtoupper($row['recepcion']))."</span></div></td>
			<td class='cualquierotroestilo'  width=90'  align='center' valign='top'><div style='height:40px;width:20px'><span class='Estilo12'>".strtoupper($row['firmo'])."</span></div></td>
	
 	</tr><br>
 	<tr>
 		<td></td>
 		<td class='cualquierotroestilo'>REMITENTE:<br>DESTINATARIO:</td>
 		<td colspan='2' class='cualquierotroestilo' width='200'  align='left' valign='top'><div style='height:40px;width:20px'><span class='Estilo12'>".utf8_decode($row['remitente'])."<br> ".utf8_decode($row['destinatario'])."</span></div></td>
 		<td class='cualquierotroestilo' align='left'>DNI: ".$row['dni_remitente']."<br>".$dniDestinatario."</td>
 		<td class='cualquierotroestilo'></td>
 	</tr>";
}?>
</table>
</body>
</html>

<?php
}else{
	echo "<script>window.location='../indicecronocartas.php'</script>";	
}
?>