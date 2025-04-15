<?php 

include('../conexion.php');

include('../extraprotocolares/view/funciones.php');

$conexion = Conectar();

$desde = $_REQUEST['fechade'];
$hasta = $_REQUEST['fechaa'];

$desde = fechan_abd($desde);
$hasta = fechan_abd($hasta); 


$consulta_vehicular = "SELECT *, CAST(numescritura AS SIGNED) AS numescritura2 FROM kardex WHERE idtipkar='4' and fechaescritura <> '' 
					   AND STR_TO_DATE(fechaescritura,'%Y-%m-%d') >= STR_TO_DATE('$desde','%Y-%m-%d') 
					   AND STR_TO_DATE(fechaescritura,'%Y-%m-%d') <= STR_TO_DATE('$hasta','%Y-%m-%d') order by fechaescritura, numescritura2, numminuta asc";
					
$ejecutar_vehicular = mysql_query($consulta_vehicular, $conexion);

$i=0;

while($vehicular = mysql_fetch_array($ejecutar_vehicular)){

	$arr_vehicular[$i][0] = $vehicular["fechaescritura"]; 
	$arr_vehicular[$i][1] = $vehicular["kardex"]; 
	$arr_vehicular[$i][2] = $vehicular["contrato"]; 
	$arr_vehicular[$i][3] = $vehicular["numescritura"]; 
	$arr_vehicular[$i][4] = $vehicular["numminuta"]; 
	$arr_vehicular[$i][5] = $vehicular["folioini"]; 
	$i++; 
}

echo "<table width='834' border='1' cellpadding='0' cellspacing='0' bordercolor='#000000' align='center'>";

	for($j=0; $j<count($arr_vehicular); $j++) { 

	echo "<tr>
			<td width='73' valign='top'><span class='Estilo12'>".fechabd_an($arr_vehicular[$j][0])."</span></td>
			<td width='50' valign='top'><span class='Estilo12'>".$arr_vehicular[$j][1]."</span></td>
			<td width='354' valign='top'><span class='Estilo12'>"; 
			
			$id_kardex = $arr_vehicular[$j][1];
			$consulta_clientes = "SELECT
							  CONCAT(cliente2.prinom,' ',cliente2.segnom,' ',cliente2.apepat,' ',cliente2.apemat) as nombre,
							  kardex.idkardex,
							  contratantes.idcontratante,
							  cliente2.razonsocial as empresa
							  FROM
							  contratantes
							  INNER JOIN cliente2 ON cliente2.idcontratante = contratantes.idcontratante
							  INNER JOIN kardex ON contratantes.kardex = kardex.idkardex
							  WHERE
							  contratantes.kardex = $id_kardex";

		$ejecuta_clientes= mysql_query($consulta_clientes, $conexion);
			while($rowcliente=mysql_fetch_array($ejecuta_clientes)){
			 echo simbolos(strtoupper($rowcliente['nombre'].$rowcliente['empresa']))."<br>";
			}
			echo"</span></td>
			<td width='166' valign='top'><span class='Estilo12'>".strtoupper($arr_vehicular[$j][2])."</span></td>
			<td width='91' valign='top'><span class='Estilo12'>".$arr_vehicular[$j][3]."</span></td>
			<td width='84' valign='top'><span class='Estilo12'>".$arr_vehicular[$j][5]."</span></td>
 	</tr>";
   }
   
echo"</table>";


?>