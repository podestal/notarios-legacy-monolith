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
header("Content-Disposition: attachment; filename=INDICE_CRONOLOGICO_PODERES_".$fecha2[2].".".$extension);

$consulta = mysql_query("SELECT
						ingreso_poderes.id_poder  as id_poder,
						ingreso_poderes.num_kardex as kardex,
						poderes_asunto.des_asunto as tip_poder,
						ingreso_poderes.fec_crono as fec_crono,
						ingreso_poderes.referencia as referencia,
						ingreso_poderes.fec_ingreso as fec_ingreso,
						ingreso_poderes.swt_est as estado,
						ingreso_poderes.num_formu AS formulario
						FROM ingreso_poderes 
						INNER JOIN poderes_asunto ON poderes_asunto.id_asunto = ingreso_poderes.id_asunto
						WHERE STR_TO_DATE(ingreso_poderes.fec_crono,'%Y-%m-%d') >= STR_TO_DATE('$desde','%Y-%m-%d') 
						AND STR_TO_DATE(ingreso_poderes.fec_crono,'%Y-%m-%d') <= STR_TO_DATE('$hasta','%Y-%m-%d') order by kardex", $conn) or die(mysql_error());
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
	<td colspan="9" align="center" style="font-size:18.5px"><b>INDICE CRONOLOGICO - PODERES FUERA DE REGISTRO</b></td>
</tr>
<tr>
	<td colspan="9" align="center" style="font-size:18.5px"><b><?php echo utf8_decode('AÑO ').$fecha2[2];?></b></td>
</tr>
<tr><td>&nbsp;</td></tr>
<!-- <tr><td>&nbsp;</td></tr> -->
<tr>
	<td colspan="2" align="left"><b><span>NOTARIA</span></b></td>
	<td colspan="2" align="left"><span>: <?php echo $nombrenotario;?></span></td>
	<td></td>
	<td colspan="3"></td>
</tr>
<tr>
	<td colspan="2" align="left"><b><span>DIRECCION</span></b></td>
	<td colspan="2" align="left"><span>: JR.BOLIVAR NRO. 340</span></td>
	<td><b>TELEFONO</b></td>
	<td colspan="3">: (051) 326609</td>
</tr>
<tr>
	<td colspan="2" align="left"><b><span>DEPARTAMENTO</span></b></td>
	<td colspan="2" align="left"><span>: PUNO</span></td>
	<td><b>RUC</b></td>
	<td colspan="3">: 10024231572</td>
</tr>
<tr>
	<td colspan="2" align="left"><b><span>PROVINCIA</span></b></td>
	<td colspan="2" align="left"><span>: SAN ROMAN</span></td>
	<td align="left"><b><span>DESDE </span></b></td>
	<td colspan="3" align="left"><span>: <?php echo strtoupper(obtenerFechaEnLetra($desde));?></span></td>
</tr>
<tr>
	<td colspan="2" align="left"><b><span>DISTRITO</span></b></td>
	<td colspan="2" align="left"><span>: JULIACA</span></td>
	<td align="left"><b><span>HASTA</span></b></td>
	<td colspan="3" align="left"><span>: <?php echo strtoupper(obtenerFechaEnLetra($hasta)); ?></span></td>
</tr>
</table>
<br>
<table width="650" bordercolor="#333333"  BORDER="1" align="center" CELLPADDING="0" CELLSPACING="0">       
		<tr class="titulos">   
        
            <th align="center"><span class=''>FECHA</span></th>
            <th align="center"><span class=''><?php echo utf8_decode('N°')?></span></th>
            <th align="center"><span class=''>PODERDANTE</span></div></th>
            <th align="center"><span class=''><?php echo utf8_decode('N° DNI')?></span></div></th>
            <th align="center"><span class=''>INTERVINIENTE</span></div></th>
            <th align="center"><span class=''><?php echo utf8_decode('N° DNI')?></span></div></th>
            <th align="center"><span class=''>APODERADO</span></div></th>
            <th align="center"><span class=''><?php echo utf8_decode('N° DNI')?></span></div></th>
            <th align="center"><b><span class=''>MOTIVO</span></b></th>
                       
        </tr> 

<?php
$i=0;
while($poder = mysql_fetch_array($consulta)){

	$arr_poder[$i][0] = $poder["id_poder"]; 
	$arr_poder[$i][1] = $poder["kardex"]; 
	$arr_poder[$i][2] = $poder["tip_poder"]; 
	$arr_poder[$i][3] = $poder["fec_crono"]; 
	$arr_poder[$i][4] = $poder["referencia"]; 
	$arr_poder[$i][5] = $poder["fec_ingreso"]; 
	$arr_poder[$i][6] = $poder["estado"]; 
	$arr_poder[$i][7] = $poder["formulario"]; 
		
	$i++; 
}


	for($j=0; $j<count($arr_poder); $j++) { 

			$sql_contratantes = "SELECT
										poderes_contratantes.id_contrata id,
										poderes_contratantes.c_descontrat as nombres,
										poderes_contratantes.c_fircontrat as firma,
										c_condiciones.des_condicion as condicion,
										poderes_contratantes.c_codcontrat as dni_contratantes
									FROM poderes_contratantes 
									INNER JOIN c_condiciones ON c_condiciones.id_condicion = poderes_contratantes.c_condicontrat
									WHERE poderes_contratantes.id_poder =".$arr_poder[$j][0];
                                     
                $exe_contratantes = mysql_query($sql_contratantes, $conn);
                $exe_contratantes2 = mysql_query($sql_contratantes, $conn);
                $exe_contratantes3 = mysql_query($sql_contratantes, $conn);
	$html= "<tr>
			<td class='cualquierotroestilo' valign='top' align='center'><div><span class='Estilo12'>".$arr_poder[$j][3]."</span></div></td>
			<td class='cualquierotroestilo' valign='top' align='center'><div><span class='Estilo12'>".(int)substr($arr_poder[$j][1], 4,8)."</span></div></td>";
			
				$poderdante = '';
				$dni_poderdante = '';
		while($contratantes = mysql_fetch_array($exe_contratantes)){
		
			$arr_contratantes[$k][0] = $contratantes["id"]; 
			$arr_contratantes[$k][1] = $contratantes["nombres"]; 
			$arr_contratantes[$k][2] = $contratantes["firma"]; 
			$arr_contratantes[$k][3] = $contratantes["condicion"]; 
			$arr_contratantes[$k][4] = $contratantes["dni_contratantes"];

			if($arr_contratantes[$k][3]=='PODERDANTE'){

				$poderdante .= "<div><span class='Estilo12'>".simbolos(strtoupper(utf8_decode($arr_contratantes[$k][1])))."</span></div>";
				$dni_poderdante .=  "<div><span class='Estilo12'>".strtoupper($arr_contratantes[$k][4])."</span></div>";
			}

			$k++; 
		}
	$html.= "<td class='cualquierotroestilo'  valign='top' align='left'>".$poderdante."</td>";	
	$html.= "<td class='cualquierotroestilo'  valign='top' align='left'>".$dni_poderdante."</td>";

	$testigo = '';
		$dni_testigo = '';
		while($contratantes3 = mysql_fetch_array($exe_contratantes3)){
		
			$arr_contratantes3[$k][0] = $contratantes3["id"]; 
			$arr_contratantes3[$k][1] = $contratantes3["nombres"]; 
			$arr_contratantes3[$k][2] = $contratantes3["firma"]; 
			$arr_contratantes3[$k][3] = $contratantes3["condicion"]; 
			$arr_contratantes3[$k][4] = $contratantes3["dni_contratantes"]; 

			if($arr_contratantes3[$k][3]=='TESTIGO A RUEGO'){

				$testigo .= "<div><span class='Estilo12'>".simbolos(strtoupper(utf8_decode($arr_contratantes3[$k][1])))."</span></div>";
				$dni_testigo .=  "<div><span class='Estilo12'>".strtoupper($arr_contratantes3[$k][4])."</span></div>";
			}

			$k++; 
		}

	$html.= "<td class='cualquierotroestilo'  valign='top' align='left'>".$testigo."</td>";	
	$html.= "<td class='cualquierotroestilo'  valign='top' align='left'>".$dni_testigo."</td>";

	
		$apoderado = '';
		$dni_apoderado = '';
		while($contratantes2 = mysql_fetch_array($exe_contratantes2)){
		
			$arr_contratantes2[$k][0] = $contratantes2["id"]; 
			$arr_contratantes2[$k][1] = $contratantes2["nombres"]; 
			$arr_contratantes2[$k][2] = $contratantes2["firma"]; 
			$arr_contratantes2[$k][3] = $contratantes2["condicion"]; 
			$arr_contratantes2[$k][4] = $contratantes2["dni_contratantes"]; 

			if($arr_contratantes2[$k][3]=='APODERADO'){

				$apoderado .= "<div><span class='Estilo12'>".simbolos(strtoupper(utf8_decode($arr_contratantes2[$k][1])))."</span></div>";
				$dni_apoderado .=  "<div><span class='Estilo12'>".strtoupper($arr_contratantes2[$k][4])."</span></div>";
			}

			$k++; 
		}
	$html.= "<td class='cualquierotroestilo'  valign='top' align='left'>".$apoderado."</td>";	
	$html.= "<td class='cualquierotroestilo'  valign='top' align='left'>".$dni_apoderado."</td>";

		

	$html.= "</td>";			

	$html.= "<td class='cualquierotroestilo' width='47' valign='top' align='center' ><div> <span class='Estilo12'>".($arr_poder[$j][2])."</span></div></td></tr>";

	echo $html;
		
}?>
</table>
</body>
</html>

<?php
}else{
	echo "<script>window.location='../indicecronopoder.php'</script>";	
}
?>