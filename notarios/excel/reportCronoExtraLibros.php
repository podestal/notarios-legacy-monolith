<?php

include("../conexion.php");
include("../extraprotocolares/view/funciones.php");	
include('../includes/ClaseLetras.class.php');

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

$tipoDocumento = $_POST['enviarrr'];

$extension = '';
if($tipoDocumento == 'EXCEL'){
	$extension = 'xls';
}else if($tipoDocumento == 'WORD'){
	$extension = 'doc';
}

if($_POST['fechade']!="" or $_POST['fechaa']!="") {
	

//Exportar datos de php a Excel

header("Content-Description: File Transfer");  
header("Content-Type: application/force-download"); 
header("Content-Disposition: attachment; filename=INDICE_CRONOLOGICO_LIBROS_CONTABLES_".$fecha2[2].".".$extension);
$consulta = mysql_query("SELECT
					concat(libros.numlibro) as num_crono,
					libros.fecing as fecha,
					concat(libros.apepat,' ',libros.apemat,' ',libros.prinom,' ',libros.segnom) as cliente,
					libros.empresa as empresa,
					libros.descritiplib as tip_lib,
					nlibro.desnlibro as n_lib,
					libros.folio as folio,
					tipofolio.destipfol as tip_fol,
					libros.ruc as ruc,
					libros.dni as dni,
					libros.descritiplib as deslibro,
					libros.solicitante as solicitante,
					libros.numdoc_plantilla as ruc_plantilla
					FROM
					libros
					LEFT JOIN nlibro ON libros.idnlibro = nlibro.idnlibro
					LEFT JOIN tipofolio ON libros.idtipfol = tipofolio.idtipfol
					LEFT JOIN tipolibro ON libros.idtiplib = tipolibro.idtiplib
					WHERE STR_TO_DATE(libros.fecing,'%Y-%m-%d') >= STR_TO_DATE('$desde','%Y-%m-%d') 
					AND STR_TO_DATE(libros.fecing,'%Y-%m-%d') <= STR_TO_DATE('$hasta','%Y-%m-%d')
					ORDER BY num_crono", $conn) or die(mysql_error());
		$confinotario=mysql_query("SELECT nombre,apellido FROM confinotario",$conn);
$resnotario=mysql_fetch_assoc($confinotario);
$nombrenotario=$resnotario['nombre']." ".$resnotario['apellido'];				   
?>
<HTML LANG="es">
<head>
<TITLE>::. Exportacion de Datos .::</TITLE>
<style>
br{margin-bottom:-15px;}
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
	<td colspan="7" align="center" style="font-size:18.5px"><b>INDICE CRONOLOGICO - LEGALIZACION DE APERTURA DE LIBROS</b></td>
	
</tr>
<tr>
	<td colspan="7" align="center" style="font-size:18.5px"><b><?php echo utf8_decode('AÑO ').$fecha2[2];?></b></td>
</tr>
<tr><td>&nbsp;</td></tr>
<!-- <tr><td>&nbsp;</td></tr> -->
<tr>
	<td colspan="3" align="left"><b><span>NOTARIA</span></b>: <?php echo $nombrenotario;?></td>
	<td></td>
	<td></td>
</tr>
<tr>
	<td colspan="3" align="left"><b><span>DIRECCION</span></b>: JR.BOLIVAR NRO. 340</td>
	<td colspan="1" align="right"><b>TELEFONO</b></td>
	<td colspan="3">: (051) 326609</td>
</tr>
<tr>
	<td colspan="3" align="left"><b><span>DEPARTAMENTO</span></b>: PUNO</td>
	<td colspan="1" align="right"><b>RUC</b></td>
	<td colspan="3">: 10024231572</td>
</tr>
<tr>
	<td colspan="3" align="left"><b><span>PROVINCIA</span></b>: SAN ROMAN</td>
	<td colspan="1" align="right"><b><span>DESDE </span></b></td>
	<td colspan="3" align="left"><span>: <?php echo strtoupper(obtenerFechaEnLetra($desde));?></span></td>
</tr>
<tr>
	<td colspan="3"align="left"><b><span>DISTRITO</span></b>: JULIACA</td>
	<td colspan="1" align="right"><b><span>HASTA</span></b></td>
	<td colspan="3" align="left"><span>: <?php echo strtoupper(obtenerFechaEnLetra($hasta)); ?></span></td>
</tr>
</table>
<br>
<table width="1000" bordercolor="#333333"  BORDER="1" align="center" CELLPADDING="0" CELLSPACING="0">       
		<tr class="titulos">   
        
						<TH  width='90' align="center" ><span class=''>NRO.</span></TH >
                      <TH  width='200' align="LEFT"><span class=''>INGRESO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;LIBRO</span></div></TH >
                     <TH  colspan="" width='70' align="center"><span class=''>PERTENECE A</span></TH >
                     <TH  colspan="" width='70' align="center"><span class=''></span></TH >
                     <TH  width='68' align="center"><span class=''>NRO. LIBRO</span></TH >
                     <TH  width='68' align="center"><span class=''>NRO. FOLIOS</span></TH >
                     <TH  width='68' align="center"><span class=''>TIPO FOL.</span></TH >
                   
                       
            </tr> 



<?php

while($roww = mysql_fetch_array($consulta)){

		if($roww['dni']==''){
			$dniSolicitante = $roww['dni'];
		}else{
			$dniSolicitante = 'DNI: '.$roww['dni'];
		}

		if (strpos($roww['ruc_plantilla'], 'CODJU') !== false) {
			$rucPropietario = $roww['ruc_plantilla'];
		}else{
			if($roww['ruc']==''){
				$rucPropietario = $roww['ruc'];
			}else{
				$rucPropietario = 'RUC: '.$roww['ruc'];
			}
		}
		// if (strpos($roww['ruc'], 'CODJU') !== false) {
		// 	$rucPropietario = $roww['ruc'];
		// }else{
		// 	if($roww['ruc']==''){
		// 		$rucPropietario = $roww['ruc'];
		// 	}else{
		// 		$rucPropietario = 'RUC: '.$roww['ruc'];
		// 	}
		// }
	
		echo "<tr>
	      <td class='cualquierotroestilo' width='90'  align='center' valign='top'>".(int)$roww['num_crono']."</td>
		  <td  class='cualquierotroestilo' width='200' height='45' align='left' valign='top'>".fechabd_an($roww['fecha'])."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>".$roww['tip_lib']."</b><br>
		  		".simbolos(utf8_decode($roww['solicitante']))."<br>
		  		".simbolos(utf8_decode($roww['cliente'].$roww['empresa']))."</td>
		  
		  <td class='cualquierotroestilo' width='70'  align='left' valign='top'><br>SOLICITANTE: <br>PROPIETARIO:</td>
		  <td class='cualquierotroestilo' width='70'  align='left' valign='top'><br>".$dniSolicitante."<br>".$rucPropietario."</td>
		    <td class='cualquierotroestilo' width='68'  align='left' valign='top'><br>".$roww['n_lib']."</td>
			<td class='cualquierotroestilo' width='68' align='center' valign='top'><br>".$roww['folio']."</td>
			<td class='cualquierotroestilo' width='68' align='center' valign='top'><br>".$roww['tip_fol']."</td>
 	</tr>";}?>
</table>
</body>
</html>

<?php
}else{
	echo "<script>window.location='../indicecrolibros.php'</script>";	
}
?>