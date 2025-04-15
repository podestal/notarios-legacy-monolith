<?php 
include('conexion.php');

$fecini = $_POST['fechade'];
$fecfin  = $_POST['fechaa'];

$consulta = mysql_query("SELECT UPPER((CASE WHEN (cliente2.tipper='N') THEN CONCAT(cliente2.apepat,' ',cliente2.apemat,' ',cliente2.prinom,' ',cliente2.segnom) ELSE cliente2.razonsocial END)) AS 'cliente',
DATE_FORMAT(kardex.fechaescritura,'%d/%m/%Y') AS fec_escritura, kardex.kardex,
kardex.contrato, kardex.numescritura, kardex.numminuta, kardex.folioini
FROM kardex
INNER JOIN contratantes ON contratantes.kardex = kardex.kardex AND contratantes.indice='1'
INNER JOIN cliente2 ON cliente2.idcontratante = contratantes.idcontratante 
WHERE kardex.idtipkar='3'  
AND kardex.fechaescritura >= STR_TO_DATE('".$fecini."','%d/%m/%Y')
AND kardex.fechaescritura <= STR_TO_DATE('".$fecfin."','%d/%m/%Y')
ORDER BY cliente ASC", $conn) or die(mysql_error());

while($row = mysql_fetch_array($consulta)){

echo"<table width='834' border='1' cellpadding='0' cellspacing='0' bordercolor='#E5E5E5'>
  <tr>
    <td width='314' height='19' valign='top'><span class='Estilo12'>".$row['cliente']."</span></td>
    <td width='82' valign='top'><span class='Estilo12'>".$row['fec_escritura']."</span></td>
    <td width='78' valign='top'><span class='Estilo12'>".$row['kardex']."</span></td>
    <td width='228' valign='top'><span class='Estilo12'>".$row['contrato']."</span></td>
    <td width='58' valign='top'><span class='Estilo12'>".$row['numescritura']."</span></td>
    <td width='60' valign='top'><span class='Estilo12'>".$row['folioini']."</span></td>
  </tr>
</table>";
}

?>