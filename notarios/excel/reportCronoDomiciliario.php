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
    $dias = array('Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado');
    $dia = $dias[date('w', strtotime($fecha))];
    return $dia;
}


if($_POST['fechade']!="" or $_POST['fechaa']!="") {
	
include("../conexion.php");
include('../extraprotocolares/view/funciones.php');


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
// header("Content-Disposition: attachment; filename=IC_POD.doc");
header("Content-Disposition: attachment; filename=INDICE_CRONOLOGICO_CERTIFICADO_DOMICILIARIO_".$fecha2[2].".".$extension);

$consulta = mysql_query("SELECT cd.num_certificado as kardex, 
								cd.fec_ingreso as fecha,
								cd.nombre_solic as solicitante,
								cd.numdoc_solic as documento_solicitante,
								cd.domic_solic as domicilio_solicitante,
								cd.motivo_solic as motivo_solicitante,
								cd.recibo_empresa as recibo,
								cd.numero_recibo as numero_recibo
						FROM cert_domiciliario as cd
						WHERE STR_TO_DATE(fec_ingreso,'%Y-%m-%d') >= STR_TO_DATE('$desde','%Y-%m-%d') 
						AND STR_TO_DATE(fec_ingreso,'%Y-%m-%d') <= STR_TO_DATE('$hasta','%Y-%m-%d') order by kardex", $conn) or die(mysql_error());
$paginador=2;

$confinotario=mysql_query("SELECT nombre,apellido FROM confinotario",$conn);
$resnotario=mysql_fetch_assoc($confinotario);
$nombrenotario=$resnotario['nombre']." ".$resnotario['apellido'];	
?>
<HTML LANG="es">
<TITLE>::. Exportacion de Datos .::</TITLE>
<style>
br{margin-bottom:-15px;}
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
	<td colspan="9" align="center" style="font-size:18.5px"><b>INDICE CRONOLOGICO - CERTIFICADO DOMICILIARIO</b></td>
</tr>
<tr>
	<td colspan="9" align="center" style="font-size:18.5px"><b><?php echo utf8_decode('AÑO ').$fecha2[2];?></b></td>
</tr>
<tr><td>&nbsp;</td></tr>
<!-- <tr><td>&nbsp;</td></tr> -->
<tr>
	<td colspan="2" align="left"><b><span>NOTARIA</span></b></td>
	<td colspan="3" align="left"><span>: <?php echo $nombrenotario;?></span></td>
	<td></td>
	<td colspan="3"></td>
</tr>
<tr>
	<td colspan="2" align="left"><b><span>DIRECCION</span></b></td>
	<td colspan="3" align="left"><span>: JR.BOLIVAR NRO. 340</span></td>
	<td><b>TELEFONO</b></td>
	<td colspan="3">: (051) 326609</td>
</tr>
<tr>
	<td colspan="2" align="left"><b><span>DEPARTAMENTO</span></b></td>
	<td colspan="3" align="left"><span>: PUNO</span></td>
	<td><b>RUC</b></td>
	<td colspan="3">: 10024231572</td>
</tr>
<tr>
	<td colspan="2" align="left"><b><span>PROVINCIA</span></b></td>
	<td colspan="3" align="left"><span>: SAN ROMAN</span></td>
	<td align="left"><b><span>DESDE </span></b></td>
	<td colspan="3" align="left"><span>: <?php echo strtoupper(obtenerFechaEnLetra($desde));?></span></td>
</tr>
<tr>
	<td colspan="2" align="left"><b><span>DISTRITO</span></b></td>
	<td colspan="3" align="left"><span>: JULIACA</span></td>
	<td align="left"><b><span>HASTA</span></b></td>
	<td colspan="3" align="left"><span>: <?php echo strtoupper(obtenerFechaEnLetra($hasta)); ?></span></td>
</tr>
</table>
<br>
<table width="650" bordercolor="#333333"  BORDER="1" align="center" CELLPADDING="0" CELLSPACING="0">       
		<tr class="titulos">   
			<th align="center"><span class=''><?php echo utf8_decode('N°')?></span></th>
            <th align="center"><span class=''>FECHA</span></th>
            <th align="center"><span class=''>SOLICITANTE</span></div></th>
            <th align="center"><span class=''><?php echo utf8_decode('N° DNI')?></span></div></th>
            <th align="center"><span class=''>DOMICILIO</span></div></th>
            <th align="center"><span class=''>MOTIVO</span></div></th>
            <th align="center"><span class=''>DOCUMENTO VERIFICADO</span></div></th>
            <th align="center"><span class=''>COMPROBANTE</span></th>
                       
        </tr> 

<?php
	while($domiciliario = mysql_fetch_array($consulta)){

		$recibo = '';
		if($domiciliario['recibo']=='SEDA JULIACA S.A.'){
			$recibo = 'RECIBO DE AGUA';
		}
		if($domiciliario['recibo']=='ELECTRO PUNO S.A.A'){
			$recibo = 'RECIBO DE LUZ';
		}

		$html= "<tr>";	
			$html.= "<td align='right'>".substr($domiciliario['kardex'],4)."</td>";	
			$html.= "<td align='right'>".$domiciliario['fecha']."</td>";
			$html.= "<td align='left'>".utf8_decode($domiciliario['solicitante'])."</td>";
			$html.= "<td align='right'>".$domiciliario['documento_solicitante']."</td>";
			$html.= "<td align='left'>".utf8_decode($domiciliario['domicilio_solicitante'])."</td>";
			$html.= "<td align='left'>".$domiciliario['motivo_solicitante']."</td>";
			$html.= "<td align='left'>".$recibo."</td>";
			$html.= "<td align='left'>".$domiciliario['numero_recibo']."</td>";
		$html.= "</tr>";

		echo $html;
	}
?>
</table>
</body>
</html>

<?php
}else{
	echo "<script>window.location='../indiceCronoDomiciliario.php'</script>";	
}
?>