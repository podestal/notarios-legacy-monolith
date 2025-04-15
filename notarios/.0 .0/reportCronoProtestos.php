
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

if($_POST['fechade']!="" or $_POST['fechaa']!="") {
	
include("../conexion.php");
include('../extraprotocolares/view/funciones.php');

//Exportar datos de php a Excel
header("Content-Description: File Transfer");  
header("Content-Type: application/force-download"); 
header("Content-Disposition: attachment; filename=IC_PRO.doc"); 


$consulta_protestos =  "SELECT 
						protesto.id_protesto as id_protesto,
						SUBSTRING(protesto.num_protesto,5,8) as num_protesto,
						protesto.fec_ingreso AS 'fec_ingreso', 
						protesto.fec_notificacion AS 'fec_notificacion',
						protesto.solicitante as solicitante,
						protesto.fec_constancia AS 'fec_constancia',
						monedas.simbolo as moneda,
						protesto.importe as importe,
						protesto.tipo as tipo,
						protesto.fec_venc as vencimiento,
						protesto.anio as anio
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
br{margin-bottom:-15px;}
.cualquierotroestilo{
   font-size: 9px;
  line-height: 1px;	 
}
</style>
</head>
<body>          
            
<table width='950'>
<tr>
	<td align="left"> <b><span><font size="-3">Notaria <?php echo $nombrenotario;?></font></span></b></td>
</tr>
<tr>
	<td align="CENTER" ><b><span><font size="-1">INDICE CRONOLOGICO DE TITULOS VALORES</font></span></b></td>
</tr>
<tr>
	<td align="center"><b><span><font size="-3">DESDE <?php echo $fechade ?> HASTA <?php echo $fechaa ?></font></span></b></td>
</tr>
</table>
<hr/>
<table width="900" bordercolor="#333333"  BORDER="0" align="center" CELLPADDING="0" CELLSPACING="0">       
		<tr class="">   
        
            <td width='37'style="font-size:11px"  align='center'><b><span class=''>FECHA INGRESO</span></b></td>
			<td width='37' style="font-size:11px"  align='center'><b><span class=''>FECHA NOTIFIC</span></b></td>
			<td width='27' style="font-size:11px"  align='center'><b><span class=''>FECHA PROTESTO</span></b></td>
			<td width='37' style="font-size:11px"  align='left'><b><span class=''>ACTA</span></b></td>
			<td width='100' style="font-size:11px"  align='left'><b><span class=''>ACREEDOR</span></b></td>
			<td width='100' style="font-size:11px"  align='left'><b><span class=''>DEUDOR / AVAL</span></b></td>
			<td width='20' style="font-size:11px"  align='center'><b><span class=''>MN</span></b></td>
			<td width='40' style="font-size:11px"  align='center'><b><span class=''>MONTO</span></b></td>
			<td width='52' style="font-size:11px"  align='center'><b><span class=''>T.V.</span></b></td>
            <td width='36' style="font-size:11px"  align='center'><b><span class=''>FECHA VENC.</span></b></td>

            
                       
            </tr> 
</TABLE>            
<hr />
<table width="900" bordercolor="#333333"  BORDER="0" align="center">   
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
	$i++; 
}
			
	for($j=0; $j<count($arr_protestos); $j++) { 
	
	$id_protesto = $arr_protestos[$j][0];
	$anio = $arr_protestos[$j][10];
	
	$consulta_participantes =   "SELECT
								CONCAT (protesto_participantes.descri_parti,' / ') as descri_parti,
								c_protesto.des_condicionp
								FROM
								protesto_participantes
								LEFT JOIN c_protesto ON protesto_participantes.tip_condi = c_protesto.id_condicionp
								WHERE
								protesto_participantes.id_protesto = $id_protesto and protesto_participantes.anio='$anio'
								AND (tip_condi ='002' OR tip_condi = '003')";
								
	$ejecutar_participantes = mysql_query($consulta_participantes, $conn);
	
	$consulta_participante_acreedor =   "SELECT
								protesto_participantes.descri_parti,
								c_protesto.des_condicionp
								FROM
								protesto_participantes
								LEFT JOIN c_protesto ON protesto_participantes.tip_condi = c_protesto.id_condicionp
								WHERE
								protesto_participantes.id_protesto = $id_protesto and protesto_participantes.anio='$anio'
								AND tip_condi ='001'";
								
	$ejecutar_acreedor = mysql_query($consulta_participante_acreedor, $conn);

	echo "<tr >
			<td width='50'  align='center'><span class='cualquierotroestilo' >".fechabd_an($arr_protestos[$j][2])."</span></td>
			<td width='50'  align='center'><span class='cualquierotroestilo' >".fechabd_an($arr_protestos[$j][3])."</span></td>
			<td width='50'  align='center'><span class='cualquierotroestilo' >".fechabd_an($arr_protestos[$j][5])."</span></td>
			<td width='50'  align='center'><span class='cualquierotroestilo' >".$arr_protestos[$j][1]."</span></td>
			<td width='100' align='left'>";
	while($acreedor = mysql_fetch_array($ejecutar_acreedor)){				
    		echo "<span class='cualquierotroestilo' >".strtoupper($acreedor['descri_parti'])."</span>";}echo "	</td>
			<td width='100' align='left'>";
	while($ejecutar_participantes2 = mysql_fetch_array($ejecutar_participantes)){				
    		echo "<span class='cualquierotroestilo' >".strtoupper($ejecutar_participantes2['descri_parti'])."</span>";}echo "	</td>
			<td width='20'  align='center'><span class='cualquierotroestilo' >".utf8_decode($arr_protestos[$j][6])."</span></td>
			<td width='40'  align='center'><span class='cualquierotroestilo' >".$arr_protestos[$j][7]."</span></td>
			<td width='52'  align='center'><span class='cualquierotroestilo' >";	
	$sql=mysql_query("select SUBSTRING(des_tipop,1,3) from tipo_protesto where cod_tipop='".$arr_protestos[$j][8]."'",$conn);
	$res = mysql_fetch_array($sql);	echo $res[0];echo "</span></td>
			<td width='36'  align='center'><span class='cualquierotroestilo' >".fechabd_an($arr_protestos[$j][9])."</span></td>

		  </tr>";
  
}?>
</table>
</body>
</html>

<?php
}else{
	echo "<script>window.location='../indicecronoprote.php'</script>";	
}
?>