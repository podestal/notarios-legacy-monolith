
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
    $dias = array('Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sabado');
    $dia = $dias[date('w', strtotime($fecha))];
    return $dia;
}


if($_POST['fechade']!="" or $_POST['fechaa']!="") {
	
include("../conexion.php");
// include("../extraprotocolares/view/funciones.php");	

//Exportar datos de php a Excel

header("Content-Description: File Transfer");  
header("Content-Type: application/force-download"); 
header("Content-Disposition: attachment; filename=IC_EP.doc");
$consulta = mysql_query("SELECT fechaescritura,
								k.kardex,
								contrato,
								numescritura,
								numminuta,
								folioini, 
								CAST(numescritura AS SIGNED) AS numescritura2,
								p.importetrans as precio,
								m.simbolo as moneda
	FROM kardex as k 
	LEFT JOIN patrimonial as p ON p.kardex=k.kardex
	LEFT JOIN monedas as m ON m.idmon=p.idmon
	WHERE k.idtipkar='1' and nc=0 and fechaescritura <> '' 
					   AND STR_TO_DATE(fechaescritura,'%Y-%m-%d') >= STR_TO_DATE('".$desde."','%Y-%m-%d') 
					   AND STR_TO_DATE(fechaescritura,'%Y-%m-%d') <= STR_TO_DATE('".$hasta."','%Y-%m-%d') order by numescritura2 asc,fechaescritura asc", $conn) or die(mysql_error());
					   
$contador=mysql_num_rows($consulta); 
$confinotario=mysql_query("SELECT nombre,apellido FROM confinotario",$conn);
$resnotario=mysql_fetch_assoc($confinotario);
$nombrenotario=$resnotario['nombre']." ".$resnotario['apellido'];	  
?>
<HTML LANG="es">
<head>
<TITLE>::. Exportacion de Datos .::</TITLE>
<style>

table{
	font-family:Arial;
	font-size: 13px;
	width:100%;
	border-collapse:collapse;
}
/* th{
	white-space: nowrap;

} */
</style>
</head>
<body>

<table border='0' cellpadding='0' cellspacing='0'>
<tr>
	<!-- <td colspan="1" align="center" style="font-size:18.5px"><img src="http://localhost/notarios/imagenes/logo-notaria-rodriguez-zea-juliaca-gris.png" alt=""></td> -->
	<td colspan="4" align="center" style="font-size:18.5px"><b>INDICE CRONOLOGICO - ESCRITURAS PUBLICAS</b></td>
</tr>
<tr>
	<td colspan="4" align="center" style="font-size:18.5px"><b><?php echo ('AÑO ').$fecha2[2];?></b></td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td></tr>
<tr>
	<td align="left"><b><span>NOTARIA</span></b></td>
	<td align="left"><span>: <?php echo $nombrenotario;?></span></td>
	<td></td>
	<td></td>
</tr>
<tr>
	<td align="left"><b><span>DIRECCION</span></b></td>
	<td align="left"><span>: JR.BOLIVAR NRO. 340</span></td>
	<td><b>TELEFONO</b></td>
	<td>: (051) 326609</td>
</tr>
<tr>
	<td align="left"><b><span>DEPARTAMENTO</span></b></td>
	<td align="left"><span>: PUNO</span></td>
	<td><b>RUC</b></td>
	<td>: 10024231572</td>
</tr>
<tr>
	<td align="left"><b><span>PROVINCIA</span></b></td>
	<td align="left"><span>: SAN ROMAN</span></td>
	<td align="left"><b><span>DESDE </span></b></td>
	<td align="left"><span>: <?php echo strtoupper(obtenerFechaEnLetra($desde));?></span></td>
</tr>
<tr>
	<td align="left"><b><span>DISTRITO</span></b></td>
	<td align="left"><span>: JULIACA</span></td>
	<td align="left"><b><span>HASTA</span></b></td>
	<td align="left"><span>: <?php echo strtoupper(obtenerFechaEnLetra($hasta)); ?></span></td>
</tr>
</table>
<br>
<table border="1" width="1000" align="center" cellpadding="0" cellspacing="0">       
		<tr>   
			<th align="center">ESCR.</th>
			<th align="center">FECH.ESCR.</th>
			<th align="center">CONTRATANTE</th>
			<th align="center">ACTO JURIDICO</th>
			<th align="center">PRECIO</th>
			<th align="center">NUM.FOLIO</th>
         </tr> 

<?php




while($row = mysql_fetch_array($consulta)){
	
	$kardex = $row['kardex'];
	$time = explode("-",$row['fechaescritura']);

	$consultrr = mysql_query("SELECT 
			UPPER(CONCAT(c2.prinom,' ',c2.segnom,' ',c2.apepat,' ',c2.apemat)) AS nombre,
			k.idkardex,cxa.idcontratante,UPPER(c2.razonsocial) AS empresa,ac.condicion,
			con.idcontratanterp,
			IF(c2.razonsocial='','PN','PJ') AS tipo_persona
	FROM contratantesxacto AS cxa
	LEFT JOIN actocondicion AS ac ON ac.idcondicion = cxa.idcondicion
	LEFT JOIN kardex AS k ON k.kardex = cxa.kardex
	LEFT JOIN contratantes AS con ON con.idcontratante=cxa.idcontratante
	LEFT JOIN cliente2 AS c2 ON c2.idcontratante=con.idcontratante
	WHERE cxa.kardex = '$kardex' ORDER BY cxa.parte asc", $conn) or die(mysql_error());

	
	

	$html = "<tr>";
		$html .= "<td align='center'>".$row['numescritura']."</td>";
		$html .= "<td align='center'>".$time[2] . "/" . $time[1] . "/" . $time[0]."</td>";	
		$html .= "<td>";
		
		
		
		while($row3 = mysql_fetch_array($consultrr)){

			$idContratanteRep = $row3['idcontratanterp'];

			$consultaRepresentante = mysql_query("SELECT 
									UPPER(CONCAT(c2.prinom,' ',c2.segnom,' ',c2.apepat,' ',c2.apemat)) AS nombre,
									ac.condicion,
									UPPER(c2.razonsocial) AS empresa
							FROM cliente2 AS c2
							LEFT JOIN contratantesxacto AS cxa ON cxa.idcontratante = c2.idcontratante
							LEFT JOIN actocondicion AS ac ON ac.idcondicion = cxa.idcondicion
							WHERE c2.idcontratante = '$idContratanteRep'", $conn) or die(mysql_error());
							

				if(!empty($idContratanteRep)){
					$arrContratantesRep = array();
					while($row4 = mysql_fetch_array($consultaRepresentante)){
						$arrContratantesRep[]= $idContratanteRep;
						$html .= "<b>".$row4['condicion'].":</b> ".$row4['nombre'].$row4['empresa']."<br/>";
						$html .= "&nbsp;&nbsp;&nbsp;&nbsp;- <b>".$row3['condicion'].":</b> ".$row3['nombre'].$row3['empresa']."<br/>";
					}

				}else{
					
					if($row3['tipo_persona']!='PJ'){
						$html .= "<b>".$row3['condicion'].":</b> ".$row3['nombre'].$row3['empresa']."<br/>";

					}
				
				}
				
				// $html .= "<b>".$row3['condicion'].":</b> ".$row3['nombre'].$row3['empresa'];
				// 	while($row4 = mysql_fetch_array($consultaRepresentante)){
							
				// 			$html .= "<b>".$row4['condicion'].":</b> ".$row4['nombre'].$row4['empresa'];
							
				// 	}
				// $html .= "<br/>";

		}
		
		$html .= "</td>";
		$html .= "<td>".str_replace('/','',strtoupper($row['contrato']))."<br><span style='font-size:9px;'>".$row['kardex']."</span></td>";
		$html .= "<td style='white-space: nowrap;' align='right'>".$row['moneda'].' '.$row['precio']."&nbsp;</td>";
		$html .= "<td align='center'>".$row['folioini']."</td>";
	$html .=  "</tr>";

	 echo ($html);
}
?>

</table>
</body>
</html>

<?php
}else{
	echo "<script>window.location='../indicecroescrituras.php'</script>";	
}
?>


