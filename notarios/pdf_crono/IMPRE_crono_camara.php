<?php 

include('../conexion.php');

include('../extraprotocolares/view/funciones.php');

$conexion = Conectar();

$desde = $_REQUEST['fechade'];
$hasta = $_REQUEST['fechaa'];

$desde = fechan_abd($desde);
$hasta = fechan_abd($hasta); 


$consulta_camara = "SELECT
						protesto.id_protesto AS id_protesto,
						protesto.fec_notificacion AS fec_notificacion,
						protesto.fec_constancia AS fec_constancia,
						tipo_protesto.des_tipop AS tip_prot,
						protesto.importe AS importe,
						protesto.solicitante AS solicitante,
						protesto_participantes.descri_parti AS participante,
						protesto_participantes.num_docparti AS dni,
						protesto_participantes.direccion AS direccion
						FROM protesto
						LEFT OUTER JOIN monedas ON monedas.idmon = protesto.moneda
						LEFT OUTER JOIN tipo_protesto ON tipo_protesto.cod_tipop = protesto.tipo
						LEFT OUTER JOIN protesto_participantes ON protesto_participantes.id_protesto = protesto.id_protesto";
					
$ejecutar_camara = mysql_query($consulta_camara, $conexion);

$i=0;

while($camara = mysql_fetch_array($ejecutar_camara)){

	$arr_camara[$i][0] = $camara["id_protesto"]; 
	$arr_camara[$i][1] = $camara["fec_notificacion"]; 
	$arr_camara[$i][2] = $camara["fec_constancia"]; 
	$arr_camara[$i][3] = $camara["tip_prot"]; 
	$arr_camara[$i][4] = $camara["importe"]; 
	$arr_camara[$i][5] = $camara["solicitante"]; 
	$arr_camara[$i][6] = $camara["participante"]; 
	$arr_camara[$i][7] = $camara["dni"]; 
	$arr_camara[$i][8] = $camara["direccion"]; 
	
	
	$i++; 
}

echo "<table width='834' border='1' cellpadding='0' cellspacing='0' bordercolor='#000000' align='center'>";

	for($j=0; $j<count($arr_camara); $j++) { 

	echo "<tr>
			<td width='23' valign='top' align='center'><span class='Estilo12'>".$arr_camara[$j][0]."</span></td>
			<td width='58' valign='top' align='center'><span class='Estilo12'>".fechabd_an($arr_camara[$j][1])."</span></td>
			<td width='60' valign='top' align='center'><span class='Estilo12'>".fechabd_an($arr_camara[$j][2])."</span></td>
			<td width='100' valign='top' align='center'><span class='Estilo12'>".$arr_camara[$j][3]."</span></td>
			<td width='65' valign='top' align='center'><span class='Estilo12'>".$arr_camara[$j][4]."</span></td>
			<td width='173' valign='top' align='center'><span class='Estilo12'>".strtoupper($arr_camara[$j][5])."</span></td>
			<td width='173' valign='top' align='center'><span class='Estilo12'>".$arr_camara[$j][6]."</span></td>
			<td width='58' valign='top' align='center'><span class='Estilo12'>".$arr_camara[$j][7]."</span></td>
			<td width='150' valign='top' align='center'><span class='Estilo12'>".$arr_camara[$j][8]."</span></td>
 	</tr>";
   }
   
echo"</table>";


?>