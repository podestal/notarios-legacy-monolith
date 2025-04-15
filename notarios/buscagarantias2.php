<?php 
include('conexion.php');

$fechade = $_POST['fechade'];
$fechaa  = $_POST['fechaa'];

$consulta = mysql_query("SELECT UPPER((CASE WHEN (cliente2.tipper='N') THEN CONCAT(cliente2.apepat,' ',cliente2.apemat,' ',cliente2.prinom,' ',cliente2.segnom) ELSE cliente2.razonsocial END)) AS 'cliente',
DATE_FORMAT(kardex.fechaescritura,'%d/%m/%Y') AS fec_escritura, kardex.kardex,
kardex.contrato, kardex.numescritura, kardex.folioini
FROM kardex
INNER JOIN contratantes ON contratantes.kardex = kardex.kardex AND contratantes.indice='1'
INNER JOIN cliente2 ON cliente2.idcontratante = contratantes.idcontratante 
WHERE kardex.idtipkar='4'  
AND kardex.fechaescritura >= STR_TO_DATE('".$fechade."','%d/%m/%Y')
AND kardex.fechaescritura <= STR_TO_DATE('".$fechaa."','%d/%m/%Y')
ORDER BY cliente ASC", $conn) or die(mysql_error());

while($row = mysql_fetch_array($consulta)){

echo"<table width='834' border='1' cellpadding='0' cellspacing='0' bordercolor='#E5E5E5'>
  <tr>
    <td width='282' height='19' valign='top'><span class='Estilo12'>".$row['cliente']."</span></td>
    <td width='83' valign='top'><span class='Estilo12'>".$row['fec_escritura']."</span></td>
    <td width='66' valign='top'><span class='Estilo12'>".$row['kardex']."</span></td>
    <td width='187' valign='top'><span class='Estilo12'>".$row['contrato']."</span></td>
    <td width='102' valign='top'><span class='Estilo12'>".$row['numescritura']."</span></td>
    <td width='100' valign='top'><span class='Estilo12'>".$row['folioini']."</span></td>
  </tr>
</table>";
}


?>