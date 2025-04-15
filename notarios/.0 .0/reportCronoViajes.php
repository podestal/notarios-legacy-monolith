<?php

$fechade = $_POST['fechade'];
$fecha=explode("/",$fechade);
$desde=$fecha[2]."-".$fecha[1]."-".$fecha[0];

$fechaa  = $_POST['fechaa'];
$fecha2=explode("/",$fechaa);
$hasta=$fecha2[2]."-".$fecha2[1]."-".$fecha2[0];

if($_POST['fechade']!="" or $_POST['fechaa']!="") {
	
include("../conexion.php");
include("../extraprotocolares/view/funciones.php");//Exportar datos de php a Excel

header("Content-Description: File Transfer");  
header("Content-Type: application/force-download"); 
header("Content-Disposition: attachment; filename=IC_PV.doc");
$consulta = mysql_query("SELECT
				permi_viaje.id_viaje as cod_viaje,
				permi_viaje.fec_ingreso as fec_ingreso,
				permi_viaje.fecha_crono as fec_crono,
				permi_viaje.num_kardex as kard,
				(CASE WHEN(permi_viaje.asunto=001) THEN 'PERMISO VIAJE AL INTERIOR' ELSE 'PERMISO VIAJE AL EXTERIOR' END) as asunto,
				permi_viaje.lugar_formu as lugar,
				permi_viaje.swt_est as estado,
				permi_viaje.num_kardex AS crono,
				permi_viaje.num_formu AS formulario
					FROM
					permi_viaje
					where STR_TO_DATE(permi_viaje.fecha_crono,'%Y-%m-%d') >= STR_TO_DATE('".$desde."','%Y-%m-%d') 
				    AND STR_TO_DATE(permi_viaje.fecha_crono,'%Y-%m-%d') <= STR_TO_DATE('".$hasta."','%Y-%m-%d')", $conn) or die(mysql_error());
$paginador=2;
$confinotario=mysql_query("SELECT nombre,apellido FROM confinotario",$conn);
$resnotario=mysql_fetch_assoc($confinotario);
$nombrenotario=$resnotario['nombre']." ".$resnotario['apellido'];	
$desc = 'Descripción';
					   
?>
<HTML LANG="es">
<head>
<TITLE>::. Exportacion de Datos .::</TITLE>
<style>
br{margin-bottom:-15px;}
.Estilo12{
   font-size: 9px;
}
</style>
</head>
<body>

<table width='600' border='0' cellpadding='0' cellspacing='0'>
<tr>
	<td colspan="2" align="left"><b><span><font size="-1">Notaria <?php echo $nombrenotario;?></font></span></b></td>
</tr>
<tr>
	<td align="left" width="300"><b><span><font size="-3">INDICE CRONOLOGICO DE PERMISOS DE VIAJE</font></span></b></td>
    <td align="right" width="300"><b><span>Listado <?php echo "del ".fechabd_an($desde)." al ".fechabd_an($hasta); ?></span></b></td>
</tr>
</table>
<hr/>
<table width="650" bordercolor="#333333"  BORDER="0" align="center" CELLPADDING="0" CELLSPACING="0">       
		<tr class="titulos">   
        
						<TH  width='73' style="font-size:11px" align="center" ><span class=''>Fecha</span></TH >
                      <TH  width='320' style="font-size:11px" align="left"><span class=''>Participantes</span></div></TH >
                     <Td  width='200' style="font-size:11px" align="left"><b><span class=''><?php echo utf8_decode($desc);?></span></b></Td>
                     <TH  width='200' style="font-size:11px" align="center"><span class=''>Nro. Cro.</span></TH >
                     <TH  width='150' style="font-size:11px" align="center"><span class=''>Nro. For.</span></TH >
                   
                       
            </tr> 
</TABLE>            
<hr />
<table width="650" bordercolor="#333333"  BORDER="0" align="center">  

            
<?php
$i=0;
$x = 1;
	while($viaje = mysql_fetch_array($consulta)){

	$arr_viaje[$i][0] = $viaje["cod_viaje"]; 
	$arr_viaje[$i][1] = $viaje["fec_ingreso"]; 
	$arr_viaje[$i][2] = $viaje["fec_crono"]; 
	$arr_viaje[$i][3] = $viaje["kard"]; 
	$arr_viaje[$i][4] = $viaje["asunto"]; 
	$arr_viaje[$i][5] = $viaje["lugar"]; 
	$arr_viaje[$i][6] = $viaje["estado"];
	$arr_viaje[$i][7] = $viaje["crono"];
	$arr_viaje[$i][8] = $viaje["formulario"];
	
	
	$i++; 
}

	for($j=0; $j<count($arr_viaje); $j++) { 

	echo "<tr>
			<td width='73' class='cualquierotroestilo'  valign='top' align='center'><div style='height:40px;width:20px'><span class='Estilo12'>".fechabd_an($arr_viaje[$j][2])."&nbsp; </span></div></td>
			<td width='300' class='cualquierotroestilo'  valign='top' ><div style='height:40px;width:20px'><span class='Estilo12'>";
			
			$sql = mysql_query("SELECT viaje_contratantes.id_viaje, viaje_contratantes.c_descontrat, c_condiciones.des_condicion FROM viaje_contratantes LEFT JOIN c_condiciones ON viaje_contratantes.c_condicontrat = c_condiciones.id_condicion
WHERE viaje_contratantes.id_viaje='".$arr_viaje[$j][0]."'",$conn) or die(mysql_error());
while($rowe2 = mysql_fetch_array($sql)){
	
	echo simbolos(utf8_decode($rowe2['des_condicion']." : ".$rowe2['c_descontrat']))."<br>";
	}

			echo "</span></div></td>
			<td width='200' class='cualquierotroestilo'  valign='top' align='center'><div style='height:40px;width:20px'><span class='Estilo12'>".$arr_viaje[$j][4]."</span></div></td>
			<td width='200' class='cualquierotroestilo'  valign='top' align='center'><div style='height:40px;width:20px'><span class='Estilo12'>".$arr_viaje[$j][0]."</span></div></td>
			<td width='150' class='cualquierotroestilo'  valign='top' align='center'><div style='height:40px;width:20px'><span class='Estilo12'>".$arr_viaje[$j][8]."</span></div></td>
			
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