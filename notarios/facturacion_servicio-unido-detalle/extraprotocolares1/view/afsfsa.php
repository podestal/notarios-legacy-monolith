<?php

$fechade = $_POST['fechade'];
$fecha=explode("/",$fechade);
$desde=$fecha[2]."-".$fecha[1]."-".$fecha[0];

$fechaa  = $_POST['fechaa'];
$fecha2=explode("/",$fechaa);
$hasta=$fecha2[2]."-".$fecha2[1]."-".$fecha2[0];

if($_POST['fechade']!="" or $_POST['fechaa']!="") {
	
include("../conexion.php");


//Exportar datos de php a Excel
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=Reporte_poderes.xls");

$consulta = mysql_query("SELECT
						ingreso_poderes.id_poder  as id_poder,
						ingreso_poderes.num_kardex as kardex,
						poderes_asunto.des_asunto as tip_poder,
						ingreso_poderes.fec_crono as fec_crono,
						ingreso_poderes.referencia as referencia,
						ingreso_poderes.fec_ingreso as fec_ingreso,
						ingreso_poderes.swt_est as estado
						ingreso_poderes.des_condicion as condicion
						FROM ingreso_poderes 
						INNER JOIN poderes_asunto ON poderes_asunto.id_asunto = ingreso_poderes.id_asunto
						WHERE STR_TO_DATE(ingreso_poderes.fec_crono,'%Y-%m-%d') >= STR_TO_DATE('$desde','%Y-%m-%d') 
						AND STR_TO_DATE(ingreso_poderes.fec_crono,'%Y-%m-%d') <= STR_TO_DATE('$hasta','%Y-%m-%d')", $conn) or die(mysql_error());
$paginador=2;					   
?>
<HTML LANG="es">
<TITLE>::. Exportacion de Datos .::</TITLE>
</head>
<body>

<table width="1300" bordercolor="#333333"  BORDER="1" align="center" CELLPADDING="0" CELLSPACING="0">
        <th align="center" height="50" valign="middle" bgcolor="#254061" style="color:#FFF; font-size:11px">
		<?php 
		echo "1";
		?>
<th width='35%' colspan="6" align="center" height="50" valign="middle" bgcolor="#254061" style="color:#FFF; font-size:11px"><span><font size="+3">REPORTE DE INDICES CRONOLOGICOS PODERES FUERA DE REGISTRO</font></span></th>
<tr class="titulos">
<th width='35%' colspan="7" align="center" height="50" valign="middle" bgcolor="#254061" style="color:#FFF; font-size:11px"><span><font size="+2"><?php echo "del $desde al $hasta"; ?></font></span></th>
		<tr class="titulos">
              <td width='67' height='19' align="center"><span class='Estilo14'>Nro Control</span></td>
              <td width='56' align="center"><span class='Estilo14'>Cronologico</span></td>
              <td width='128' align="center"><span class='Estilo14'>Tip. Poder</span></td>
              <td width='128' align="center"><span class='Estilo14'>Fec. Crono</span></td>
              <td width='264' align="center"><span class='Estilo14'>Referencia</span></td>
              <td width='84' align="center"><span class='Estilo14'>Fec.Ingreso</span></td>
              <td width='91' align="center"><span class='Estilo14'>Estado</span></td>
            </tr>
       

<?php
$x=0;
$i=0;

while($poder = mysql_fetch_array($consulta)){

	$arr_poder[$i][0] = $poder["id_poder"]; 
	$arr_poder[$i][1] = $poder["kardex"]; 
	$arr_poder[$i][2] = $poder["tip_poder"]; 
	$arr_poder[$i][3] = $poder["fec_crono"]; 
	$arr_poder[$i][4] = $poder["referencia"]; 
	$arr_poder[$i][5] = $poder["fec_ingreso"]; 
	$arr_poder[$i][6] = $poder["estado"]; 
	$arr_poder[$i][7] = $poder["condicion"]; 
		
	$i++; 
}

echo "<table width='834' border='1' cellpadding='0' cellspacing='0' bordercolor='#000000' align='center'>";

	for($j=0; $j<count($arr_poder); $j++) { 

	echo "<tr>
			<td width='67' valign='top' align='center'><span class='Estilo12'>".$arr_poder[$j][0]."</span></td>
			<td width='56' valign='top' align='center'><span class='Estilo12'>".substr($arr_poder[$j][1],4,10)."&nbsp;</span></td>
			<td width='128' valign='top' align='center'><span class='Estilo12'>".$arr_poder[$j][2]."</span></td>
			<td width='128' valign='top' align='center'><span class='Estilo12'>".$arr_poder[$j][3]."</span></td>
			<td width='264' valign='top' align='center'><span class='Estilo12'>";
			
			$sql_contratantes = "SELECT
 poderes_contratantes.id_contrata id,
 poderes_contratantes.c_descontrat as nombres,
poderes_contratantes.c_fircontrat as firma,
 c_condiciones.des_condicion as condicion
FROM poderes_contratantes 
INNER JOIN c_condiciones ON c_condiciones.id_condicion = poderes_contratantes.c_condicontrat
WHERE poderes_contratantes.id_poder =".$arr_poder[$j][0];
                                     
                $exe_contratantes = mysql_query($sql_contratantes, $conn);
				
				 while($contratantes = mysql_fetch_array($exe_contratantes)){
                
                    $arr_contratantes[$k][0] = $contratantes["id"]; 
                    $arr_contratantes[$k][1] = $contratantes["nombres"]; 
                    $arr_contratantes[$k][2] = $contratantes["firma"]; 
                    $arr_contratantes[$k][3] = $contratantes["condicion"]; 


					echo "-".$arr_contratantes[$k][3] .' : '.$arr_contratantes[$k][1]; 
					$k++; 
					echo "<br><br>";;
                }
				

			echo "</span></td>
			<td width='84' valign='top' align='center'><span class='Estilo12'>".$arr_poder[$j][5]."</span></td>
			<td width='91' valign='top' align='center'><span class='Estilo12'>".$arr_poder[$j][6]."</span></td>
 	</tr>";
 if(25==$x)
    {
		
        include ('TablaPoderes.php');
        $x = 0;
		$paginador++;
    }
    
    $x++; 	
}?>
</table>
</body>
</html>

<?php
}else{
	echo "<script>window.location='../indicecronopoder.php'</script>";	
}
?>