<?php 
include('conexion.php');

$fechade = $_POST['fechade'];
$tiempo  = explode ("/", $fechade);
$desde   = $tiempo[2] . "-" . $tiempo[1] . "-" . $tiempo[0];

$fechaa  = $_POST['fechaa'];
$tiempo2 = explode ("/", $fechaa);
$hasta   = $tiempo2[2] . "-" . $tiempo2[1] . "-" . $tiempo2[0];

echo"<table width='834' border='1' cellpadding='0' cellspacing='0' bordercolor='#E5E5E5'>";
$consulta = mysql_query("SELECT UPPER((CASE WHEN (cliente2.tipper='N') THEN CONCAT(cliente2.apepat,' ',cliente2.apemat,' ',cliente2.prinom,' ',cliente2.segnom) ELSE cliente2.razonsocial END)) AS 'cliente',
DATE_FORMAT(kardex.fechaescritura,'%d/%m/%Y') AS fec_escritura, kardex.kardex,
kardex.contrato, kardex.numescritura, kardex.numminuta, kardex.folioini
FROM kardex
INNER JOIN contratantes ON contratantes.kardex = kardex.kardex AND contratantes.indice='1'
INNER  JOIN cliente2 ON cliente2.idcontratante = contratantes.idcontratante 
WHERE kardex.idtipkar='1'  
AND kardex.fechaescritura >= STR_TO_DATE('".$fechade."','%d/%m/%Y')
AND kardex.fechaescritura <= STR_TO_DATE('".$fechaa."','%d/%m/%Y')
ORDER BY cliente ASC", $conn) or die(mysql_error());
while($row = mysql_fetch_array($consulta)){
			  echo"<tr><td width='275' height='19' valign='top'><span class='Estilo12'>".$row[0]."</span></td>
					<td width='63' valign='top'><span class='Estilo12'>".$row[1]."</span></td>
					<td width='48' valign='top'><span class='Estilo12'>".$row[2]."</span></td>
					<td width='166' valign='top'><span class='Estilo12'>".$row[3]."</span></td>
					<td width='91' valign='top'><span class='Estilo12'>".$row[4]."</span></td>
					<td width='84' valign='top'><span class='Estilo12'>".$row[5]."</span></td>
					<td width='91' valign='top'><span class='Estilo12'>".$row[6]."</span></td></tr>";
			 
		

}


echo"</table>";


?>