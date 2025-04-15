<?php 

include('../conexion.php');

include('../extraprotocolares/view/funciones.php');

$conexion = Conectar();

$desde = $_REQUEST['fechade'];
$hasta = $_REQUEST['fechaa'];

$desde = fechan_abd($desde);
$hasta = fechan_abd($hasta); 


$consulta_viajes = "SELECT
				permi_viaje.id_viaje as cod_viaje,
				permi_viaje.fec_ingreso as fec_ingreso,
				permi_viaje.fecha_crono as fec_crono,
				permi_viaje.num_kardex as kard,
				(CASE WHEN(permi_viaje.asunto=001) THEN 'PERMISO VIAJE AL INTERIOR' ELSE 'PERMISO VIAJE AL EXTERIOR' END) as asunto,
				permi_viaje.lugar_formu as lugar,
				permi_viaje.swt_est as estado
					FROM
					permi_viaje
					where STR_TO_DATE(permi_viaje.fecha_crono,'%Y-%m-%d') >= STR_TO_DATE('$desde','%Y-%m-%d') 
				    AND STR_TO_DATE(permi_viaje.fecha_crono,'%Y-%m-%d') <= STR_TO_DATE('$hasta','%Y-%m-%d') ";
						
						

					
$ejecutar_viaje = mysql_query($consulta_viajes, $conexion);

$i=0;

while($viaje = mysql_fetch_array($ejecutar_viaje)){

	$arr_viaje[$i][0] = $viaje["cod_viaje"]; 
	$arr_viaje[$i][1] = $viaje["fec_ingreso"]; 
	$arr_viaje[$i][2] = $viaje["fec_crono"]; 
	$arr_viaje[$i][3] = $viaje["kard"]; 
	$arr_viaje[$i][4] = $viaje["asunto"]; 
	$arr_viaje[$i][5] = $viaje["lugar"]; 
	$arr_viaje[$i][6] = $viaje["estado"]; 
	
	$i++; 
}

echo "<table width='834' border='1' cellpadding='0' cellspacing='0' bordercolor='#000000' align='center'>";

	for($j=0; $j<count($arr_viaje); $j++) { 

	echo "<tr>
			<td width='73' valign='top' align='center'><span class='Estilo12'>".$arr_viaje[$j][0]."</span></td>
			<td width='50' valign='top' align='center'><span class='Estilo12'>".$arr_viaje[$j][1]."</span></td>
			<td width='263' valign='top' align='center'><span class='Estilo12'>";
			
			$sql = mysql_query("SELECT viaje_contratantes.id_viaje, viaje_contratantes.c_descontrat, c_condiciones.des_condicion FROM viaje_contratantes LEFT JOIN c_condiciones ON viaje_contratantes.c_condicontrat = c_condiciones.id_condicion
WHERE viaje_contratantes.id_viaje='".$arr_viaje[$j][0]."'",$conexion) or die(mysql_error());
while($rowe2 = mysql_fetch_array($sql)){
	
	echo strtoupper ($rowe2['des_condicion']." : ".$rowe2['c_descontrat'])."<br>";
	}

			echo "</span></td>
			<td width='73' valign='top' align='center'><span class='Estilo12'>".strtoupper(simbolos($arr_viaje[$j][3]))."</span></td>
			<td width='169' valign='top' align='center'><span class='Estilo12'>".$arr_viaje[$j][4]."</span></td>
			<td width='130' valign='top' align='center'><span class='Estilo12'>".strtoupper($arr_viaje[$j][5])."</span></td>
			<td width='60' valign='top' align='center'><span class='Estilo12'>".$arr_viaje[$j][6]."</span></td>
 	</tr>";
   }
   
echo"</table>";


?>