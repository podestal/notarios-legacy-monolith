<?php 

include('../conexion.php');

include('../extraprotocolares/view/funciones.php');

$conexion = Conectar();

$desde = $_REQUEST['fechade'];
$hasta = $_REQUEST['fechaa'];

$desde = fechan_abd($desde);
$hasta = fechan_abd($hasta); 



$consulta_capaces = "SELECT
						 cert_supervivencia.num_crono as num_crono,
						 cert_supervivencia.fecha as fecha,
						 cert_supervivencia.nombre as nombre,
						 cert_supervivencia.direccion as direccion
						 FROM cert_supervivencia
						 WHERE cert_supervivencia.swt_capacidad = 'C'
						 AND STR_TO_DATE(cert_supervivencia.fecha,'%Y-%m-%d') >= STR_TO_DATE('$desde','%Y-%m-%d') 
						 AND STR_TO_DATE(cert_supervivencia.fecha,'%Y-%m-%d') <= STR_TO_DATE('$hasta','%Y-%m-%d')";
	
   $consulta_capaces = $consulta_capaces." ORDER BY cert_supervivencia.id_supervivencia DESC ";
   
   
$ejecutar_capaces = mysql_query($consulta_capaces, $conexion);

$i=0;

while($capaz = mysql_fetch_array($ejecutar_capaces)){

	$arr_capaz[$i][0] = $capaz["num_crono"]; 
	$arr_capaz[$i][1] = $capaz["fecha"]; 
	$arr_capaz[$i][2] = $capaz["nombre"]; 
	$arr_capaz[$i][3] = $capaz["direccion"]; 
	
	$i++; 
}

echo "<table width='834' border='1' cellpadding='0' cellspacing='0' bordercolor='#000000' align='center'>";

	for($j=0; $j<count($arr_capaz); $j++) { 

	echo "<tr>
			<td width='85' valign='top' align='center'><span class='Estilo12'>".$arr_capaz[$j][0]."</span></td>
			<td width='69' valign='top' align='center'><span class='Estilo12'>".$arr_capaz[$j][1]."</span></td>
			<td width='500' valign='top' align='center'><span class='Estilo12'>".$arr_capaz[$j][2]."</span></td>
			<td width='180' valign='top' align='center'><span class='Estilo12'>".$arr_capaz[$j][3]."</span></td>

 	</tr>";
   }
   
echo"</table>";


?>