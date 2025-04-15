<?php 

include('../conexion.php');

include('../extraprotocolares/view/funciones.php');

$conexion = Conectar();

$desde = $_REQUEST['fechade'];
$hasta = $_REQUEST['fechaa'];

$desde = fechan_abd($desde);
$hasta = fechan_abd($hasta); 

$consulta_incapaces = "SELECT
						  cert_supervivencia.num_crono as num_crono,
						  cert_supervivencia.fecha as fecha,
						  cert_supervivencia.nombre as nombre,
						  cert_supervivencia.direccion as direccion
						  FROM cert_supervivencia
						  WHERE cert_supervivencia.swt_capacidad = 'I'
						  AND STR_TO_DATE(cert_supervivencia.fecha,'%Y-%m-%d') >= STR_TO_DATE('$desde','%Y-%m-%d') 
						  AND STR_TO_DATE(cert_supervivencia.fecha,'%Y-%m-%d') <= STR_TO_DATE('$hasta','%Y-%m-%d')";
$ejecutar_incapaces = mysql_query($consulta_incapaces, $conexion);

$i=0;

while($incapaz = mysql_fetch_array($ejecutar_incapaces)){

	$arr_incapaz[$i][0] = $incapaz["num_crono"]; 
	$arr_incapaz[$i][1] = $incapaz["fecha"]; 
	$arr_incapaz[$i][2] = $incapaz["nombre"]; 
	$arr_incapaz[$i][3] = $incapaz["direccion"]; 
	
	$i++; 
}

echo "<table width='834' border='1' cellpadding='0' cellspacing='0' bordercolor='#000000' align='center'>";

	for($j=0; $j<count($arr_incapaz); $j++) { 

	echo "<tr>
			<td width='85' valign='top' align='center'><span class='Estilo12'>".$arr_incapaz[$j][0]."</span></td>
			<td width='69' valign='top' align='center'><span class='Estilo12'>".$arr_incapaz[$j][1]."</span></td>
			<td width='500' valign='top' align='center'><span class='Estilo12'>".$arr_incapaz[$j][2]."</span></td>
			<td width='180' valign='top' align='center'><span class='Estilo12'>".$arr_incapaz[$j][3]."</span></td>

 	</tr>";
   }
   
echo"</table>";


?>