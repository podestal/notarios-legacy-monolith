<?php 
include("../../conexion.php");

$numformu 	  = $_POST["numformu"];
$pincapaz 	  = $_POST["pincapaz"];
$rangoin1 	  = $_POST["rangoin1"];
$rangoin2	  = $_POST["rangoin2"];
$direccionin  = $_POST["direccionin"];

if($rangoin1=='' && $rangoin2==''){
$consulkar=mysql_query("SELECT * FROM cert_supervivencia WHERE 
						cert_supervivencia.swt_capacidad = 'I' 
						AND RIGHT(num_crono,6) LIKE CONCAT('%','$numformu','%')
					 	AND cert_supervivencia.nombre LIKE CONCAT('%','$pincapaz','%')
					 	AND cert_supervivencia.direccion LIKE CONCAT('%','$direccionin','%')", $conn) or die(mysql_error());
}
else if($rangoin1=='' || $rangoin2=='')
{
	if($rangoin1!='' && $rangoin2=='')
	{
		$consulkar=mysql_query("SELECT * FROM cert_supervivencia WHERE 
						cert_supervivencia.swt_capacidad = 'I' 
						AND RIGHT(num_crono,6) LIKE CONCAT('%','$numformu','%')
					 	AND cert_supervivencia.nombre LIKE CONCAT('%','$pincapaz','%')
					 	AND cert_supervivencia.direccion LIKE CONCAT('%','$direccionin','%')
						AND fecha >= DATE_FORMAT(STR_TO_DATE('$rangoin1','%d/%m/%Y'),'%Y-%m-%d')
					 	ORDER BY cert_supervivencia.num_crono DESC", $conn) or die(mysql_error());
	}
	else if($rangoin2!='' && $rangoin1=='')
	{
		$consulkar=mysql_query("SELECT * FROM cert_supervivencia WHERE 
						cert_supervivencia.swt_capacidad = 'I' 
						AND RIGHT(num_crono,6) LIKE CONCAT('%','$numformu','%')
					 	AND cert_supervivencia.nombre LIKE CONCAT('%','$pincapaz','%')
					 	AND cert_supervivencia.direccion LIKE CONCAT('%','$direccionin','%')
						AND fecha <= DATE_FORMAT(STR_TO_DATE('$rangoin2','%d/%m/%Y'),'%Y-%m-%d')
					 	ORDER BY cert_supervivencia.num_crono DESC", $conn) or die(mysql_error());
	
	}
}
else if($rangoin1!='' && $rangoin2!='')
{
		$consulkar=mysql_query("SELECT * FROM cert_supervivencia WHERE 
						cert_supervivencia.swt_capacidad = 'I' 
						AND RIGHT(num_crono,6) LIKE CONCAT('%','$numformu','%')
					 	AND cert_supervivencia.nombre LIKE CONCAT('%','$pincapaz','%')
					 	AND cert_supervivencia.direccion LIKE CONCAT('%','$direccionin','%')
						AND fecha >= DATE_FORMAT(STR_TO_DATE('$rangoin1','%d/%m/%Y'),'%Y-%m-%d')
						AND fecha <= DATE_FORMAT(STR_TO_DATE('$rangoin2','%d/%m/%Y'),'%Y-%m-%d')
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