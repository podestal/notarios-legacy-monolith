<?php 
include("../../conexion.php");

$numformu 	 = $_POST["numformu"];
$pcapaz 	 = $_POST["pcapaz"];
$rangoca1 	 = $_POST["rangoca1"];
$rangoca2	 = $_POST["rangoca2"];
$direccionca = $_POST["direccionca"];

if($rangoca1=='' && $rangoca2==''){
$consulkar=mysql_query("SELECT * FROM cert_supervivencia WHERE
					 cert_supervivencia.swt_capacidad = 'C' 
					 AND RIGHT(num_crono,6) LIKE CONCAT('%','$numformu','%')
					 AND cert_supervivencia.nombre LIKE CONCAT('%','$pcapaz','%')
					 AND cert_supervivencia.direccion LIKE CONCAT('%','$direccionca','%')
					 ORDER BY cert_supervivencia.num_crono DESC", $conn) or die(mysql_error());
}
else if($rangoca1=='' || $rangoca2=='')
{
	if($rangoca1!='' && $rangoca2=='')
	{
		$consulkar=mysql_query("SELECT * FROM cert_supervivencia WHERE
					 cert_supervivencia.swt_capacidad = 'C' 
					 AND RIGHT(num_crono,6) LIKE CONCAT('%','$numformu','%')
					 AND cert_supervivencia.nombre LIKE CONCAT('%','$pcapaz','%')
					 AND cert_supervivencia.direccion LIKE CONCAT('%','$direccionca','%')
					 AND fecha >= DATE_FORMAT(STR_TO_DATE('$rangoca1','%d/%m/%Y'),'%Y-%m-%d')
					 ORDER BY cert_supervivencia.num_crono DESC", $conn) or die(mysql_error());
	}
	else if($rangoca2!='' && $rangoca1=='')
	{
		$consulkar=mysql_query("SELECT * FROM cert_supervivencia WHERE
					 cert_supervivencia.swt_capacidad = 'C' 
					  AND RIGHT(num_crono,6) LIKE CONCAT('%','$numformu','%')
					 AND cert_supervivencia.nombre LIKE CONCAT('%','$pcapaz','%')
					 AND cert_supervivencia.direccion LIKE CONCAT('%','$direccionca','%')
					 AND fecha <= DATE_FORMAT(STR_TO_DATE('$rangoca2','%d/%m/%Y'),'%Y-%m-%d')
					 ORDER BY cert_supervivencia.num_crono DESC", $conn) or die(mysql_error());
	
	}
}
else if($rangoca1!='' && $rangoca2!='')
{
$consulkar=mysql_query("SELECT * FROM cert_supervivencia WHERE
					 cert_supervivencia.swt_capacidad = 'C' 
					 AND RIGHT(num_crono,6) LIKE CONCAT('%','$numformu','%')
					 AND cert_supervivencia.nombre LIKE CONCAT('%','$pcapaz','%')
					 AND cert_supervivencia.direccion LIKE CONCAT('%','$direccionca','%')
					 AND fecha >= DATE_FORMAT(STR_TO_DATE('$rangoca1','%d/%m/%Y'),'%Y-%m-%d')
					 AND fecha <= DATE_FORMAT(STR_TO_DATE('$rangoca2','%d/%m/%Y'),'%Y-%m-%d')
					 ORDER BY cert_supervivencia.num_crono DESC", $conn) or die(mysql_error());
}


while($rowkar = mysql_fetch_array($consulkar)){

$numkar = $rowkar['num_crono'];
$numkar2 = substr($numkar,5,6).'-'.substr($numkar,0,4);


echo "<table width='858' border='1' cellpadding='0' cellspacing='0' bordercolor='#333333' >
  <tr>
    <td width='63' align='center' ><span class='reskar'><a href='EditPCapazVie.php?id_supervivencia=".$rowkar['id_supervivencia']."'>".$numkar2."</a></span></td>
	<td width='86' align='center' ><span class='reskar'>".$rowkar['fecha']."</span></td>
	<td width='150' align='center' ><span class='reskar'>".$rowkar['nombre']."</span></td>
	<td width='86' align='center' ><span class='reskar'>".$rowkar['direccion']."</span></td>
    <td width='73' align='center'><span class='reskar'>".$rowkar['swt_capacidad']."</span></td>
  </tr>
</table>";
}
?>