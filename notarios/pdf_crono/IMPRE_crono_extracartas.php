<?php 

include('../conexion.php');

include('../extraprotocolares/view/funciones.php');

$conexion = Conectar();

$fechade = $_REQUEST['fechade'];
$fechaa  = $_REQUEST['fechaa'];


$ejecutar = mysql_query("SELECT
						ingreso_cartas.num_carta AS num_carta,
						DATE_FORMAT(STR_TO_DATE(fec_ingreso,'%d/%m/%Y'),'%d/%m/%Y') AS fec_ingreso,
						ingreso_cartas.fec_entrega AS fec_entrega,
						ingreso_cartas.nom_remitente AS remitente,
						ingreso_cartas.nom_destinatario AS destinatario,
						ingreso_cartas.zona_destinatario AS cod_zona,
						ubigeo.nomdis as zona
						FROM
						ingreso_cartas
						INNER JOIN ubigeo ON ubigeo.coddis = ingreso_cartas.zona_destinatario
						WHERE STR_TO_DATE(fec_ingreso,'%d/%m/%Y') BETWEEN STR_TO_DATE('$fechade','%d/%m/%Y') AND STR_TO_DATE('$fechaa','%d/%m/%Y')
						ORDER BY num_carta asc", $conexion);


echo "<table width='834' border='1' cellpadding='0' cellspacing='0' bordercolor='#000000' align='center'>";


while($roww = mysql_fetch_array($ejecutar)){

	echo "<tr>
			<td width='70' valign='top'><span class='Estilo12'>".$roww['num_carta']."</span></td>
			<td width='86' valign='top'><span class='Estilo12'>".$roww['fec_ingreso']."</span></td>
			<td width='86' valign='top'><span class='Estilo12'>".$roww['fec_entrega']."</span></td>
			<td width='93' valign='top'><span class='Estilo12'>".strtoupper($roww['zona'])."</span></td>
			<td width='171' valign='top'><span class='Estilo12'>".simbolos($roww['remitente'])."</span></td>
			<td width='275' valign='top'><span class='Estilo12'>".simbolos($roww['destinatario'])."</span></td>
			
 	</tr>";
}

   
echo"</table>";




?>