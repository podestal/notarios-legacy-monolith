            <?php 
include("../../conexion.php");
$numformu 		 = $_POST["numformu"];
$participante	 = $_POST['participante'];
$rangouno		 = $_POST['rangouno'];
$rangodos	 	 = $_POST['rangodos'];
$tippersona 	 = $_POST['tippersona'];

if($tippersona != '')
{
if($rangouno=='' && $rangodos=='')
{
$consulkar=mysql_query("SELECT c_condiciones.des_condicion,viaje_contratantes.c_descontrat, permi_viaje.*,(CASE WHEN(permi_viaje.asunto='001') THEN 'PERMISO VIAJE AL INTERIOR' 
ELSE 'PERMISO VIAJE AL EXTERIOR' END) AS 'tipo_permiso' 
FROM permi_viaje
INNER JOIN viaje_contratantes ON viaje_contratantes.id_viaje = permi_viaje.id_viaje
INNER JOIN c_condiciones ON c_condiciones.id_condicion = viaje_contratantes.c_condicontrat
WHERE permi_viaje.asunto = '$tippersona'
AND RIGHT(num_kardex,6) LIKE CONCAT('%','$numformu','%')
AND viaje_contratantes.c_descontrat  LIKE CONCAT('%','$participante','%')", $conn) or die(mysql_error());
}
else if($rangouno=='' || $rangodos=='')
{
	if($rangouno!='' && $rangodos=='')
	{
		$consulkar=mysql_query("SELECT c_condiciones.des_condicion,viaje_contratantes.c_descontrat, permi_viaje.*,(CASE WHEN(permi_viaje.asunto='001') THEN 'PERMISO VIAJE AL INTERIOR' 
		ELSE 'PERMISO VIAJE AL EXTERIOR' END) AS 'tipo_permiso' 
		FROM permi_viaje
		INNER JOIN viaje_contratantes ON viaje_contratantes.id_viaje = permi_viaje.id_viaje
		INNER JOIN c_condiciones ON c_condiciones.id_condicion = viaje_contratantes.c_condicontrat
		WHERE
		RIGHT(num_kardex,6) LIKE CONCAT('%','$numformu','%')
		AND viaje_contratantes.c_descontrat  LIKE CONCAT('%','$participante','%')
		AND fec_ingreso >= DATE_FORMAT(STR_TO_DATE('$rangouno','%d/%m/%Y'),'%Y-%m-%d')", $conn) or die(mysql_error());
	}
	else if($rangouno=='' && $rangodos!='')
	{
		$consulkar=mysql_query("SELECT c_condiciones.des_condicion,viaje_contratantes.c_descontrat, permi_viaje.*,(CASE WHEN(permi_viaje.asunto='001') THEN 'PERMISO VIAJE AL INTERIOR' 
		ELSE 'PERMISO VIAJE AL EXTERIOR' END) AS 'tipo_permiso' 
		FROM permi_viaje
		INNER JOIN viaje_contratantes ON viaje_contratantes.id_viaje = permi_viaje.id_viaje
		INNER JOIN c_condiciones ON c_condiciones.id_condicion = viaje_contratantes.c_condicontrat
		WHERE
		RIGHT(num_kardex,6) LIKE CONCAT('%','$numformu','%')
		AND viaje_contratantes.c_descontrat  LIKE CONCAT('%','$participante','%')
		AND fec_ingreso <= DATE_FORMAT(STR_TO_DATE('$rangodos','%d/%m/%Y'),'%Y-%m-%d')", $conn) or die(mysql_error());
	}
}
else if($rangouno!='' && $rangodos!='')
{
$consulkar=mysql_query("SELECT c_condiciones.des_condicion,viaje_contratantes.c_descontrat, permi_viaje.*,(CASE WHEN(permi_viaje.asunto='001') THEN 'PERMISO VIAJE AL INTERIOR' 
ELSE 'PERMISO VIAJE AL EXTERIOR' END) AS 'tipo_permiso' 
FROM permi_viaje
INNER JOIN viaje_contratantes ON viaje_contratantes.id_viaje = permi_viaje.id_viaje
INNER JOIN c_condiciones ON c_condiciones.id_condicion = viaje_contratantes.c_condicontrat
WHERE
RIGHT(num_kardex,6) LIKE CONCAT('%','$numformu','%')
AND viaje_contratantes.c_descontrat  LIKE CONCAT('%','$participante','%')
AND fec_ingreso >= DATE_FORMAT(STR_TO_DATE('$rangouno','%d/%m/%Y'),'%Y-%m-%d')
AND fec_ingreso <= DATE_FORMAT(STR_TO_DATE('$rangodos','%d/%m/%Y'),'%Y-%m-%d')", $conn) or die(mysql_error());
}

}
///////////////////////////////////////////////////////////////////////////////////////////////////////////

else if($tippersona == '')
{
	if($rangouno=='' && $rangodos=='')
{
$consulkar=mysql_query("SELECT c_condiciones.des_condicion,viaje_contratantes.c_descontrat, permi_viaje.*,(CASE WHEN(permi_viaje.asunto='001') THEN 'PERMISO VIAJE AL INTERIOR' 
ELSE 'PERMISO VIAJE AL EXTERIOR' END) AS 'tipo_permiso' 
FROM permi_viaje
INNER JOIN viaje_contratantes ON viaje_contratantes.id_viaje = permi_viaje.id_viaje
INNER JOIN c_condiciones ON c_condiciones.id_condicion = viaje_contratantes.c_condicontrat
WHERE RIGHT(num_kardex,6) LIKE CONCAT('%','$numformu','%')
AND viaje_contratantes.c_descontrat  LIKE CONCAT('%','$participante','%')", $conn) or die(mysql_error());
}
else if($rangouno=='' || $rangodos=='')
{
	if($rangouno!='' && $rangodos=='')
	{
		$consulkar=mysql_query("SELECT c_condiciones.des_condicion,viaje_contratantes.c_descontrat, permi_viaje.*,(CASE WHEN(permi_viaje.asunto='001') THEN 'PERMISO VIAJE AL INTERIOR' 
		ELSE 'PERMISO VIAJE AL EXTERIOR' END) AS 'tipo_permiso' 
		FROM permi_viaje
		INNER JOIN viaje_contratantes ON viaje_contratantes.id_viaje = permi_viaje.id_viaje
		INNER JOIN c_condiciones ON c_condiciones.id_condicion = viaje_contratantes.c_condicontrat
		WHERE
		RIGHT(num_kardex,6) LIKE CONCAT('%','$numformu','%')
		AND viaje_contratantes.c_descontrat  LIKE CONCAT('%','$participante','%')
		AND fec_ingreso >= DATE_FORMAT(STR_TO_DATE('$rangouno','%d/%m/%Y'),'%Y-%m-%d')", $conn) or die(mysql_error());
	}
	else if($rangouno=='' && $rangodos!='')
	{
		$consulkar=mysql_query("SELECT c_condiciones.des_condicion,viaje_contratantes.c_descontrat, permi_viaje.*,(CASE WHEN(permi_viaje.asunto='001') THEN 'PERMISO VIAJE AL INTERIOR' 
		ELSE 'PERMISO VIAJE AL EXTERIOR' END) AS 'tipo_permiso' 
		FROM permi_viaje
		INNER JOIN viaje_contratantes ON viaje_contratantes.id_viaje = permi_viaje.id_viaje
		INNER JOIN c_condiciones ON c_condiciones.id_condicion = viaje_contratantes.c_condicontrat
		WHERE
		RIGHT(num_kardex,6) LIKE CONCAT('%','$numformu','%')
		AND viaje_contratantes.c_descontrat  LIKE CONCAT('%','$participante','%')
		AND fec_ingreso <= DATE_FORMAT(STR_TO_DATE('$rangodos','%d/%m/%Y'),'%Y-%m-%d')", $conn) or die(mysql_error());
	}
}
else if($rangouno!='' && $rangodos!='')
{
$consulkar=mysql_query("SELECT c_condiciones.des_condicion,viaje_contratantes.c_descontrat, permi_viaje.*,(CASE WHEN(permi_viaje.asunto='001') THEN 'PERMISO VIAJE AL INTERIOR' 
ELSE 'PERMISO VIAJE AL EXTERIOR' END) AS 'tipo_permiso' 
FROM permi_viaje
INNER JOIN viaje_contratantes ON viaje_contratantes.id_viaje = permi_viaje.id_viaje
INNER JOIN c_condiciones ON c_condiciones.id_condicion = viaje_contratantes.c_condicontrat
WHERE
RIGHT(num_kardex,6) LIKE CONCAT('%','$numformu','%')
AND viaje_contratantes.c_descontrat  LIKE CONCAT('%','$participante','%')
AND fec_ingreso >= DATE_FORMAT(STR_TO_DATE('$rangouno','%d/%m/%Y'),'%Y-%m-%d')
AND fec_ingreso <= DATE_FORMAT(STR_TO_DATE('$rangodos','%d/%m/%Y'),'%Y-%m-%d')", $conn) or die(mysql_error());
}
}

while($rowkar = mysql_fetch_array($consulkar)){

$numkar = $rowkar['num_kardex'];
$numkar2 = substr($numkar,5,6).'-'.substr($numkar,0,4);

echo "<table width='858' border='1' cellpadding='0' cellspacing='0' bordercolor='#333333' >
  <tr>
    <td width='38' align='center' ><span class='reskar'><a href='EditPermiViajeVie.php?id_viaje=".$rowkar['id_viaje']."'>".$rowkar['id_viaje']."</a></span></td>
	<td width='65' align='center' ><span class='reskar'>".$numkar2."</span></td>
	<td width='160' align='center' ><span class='reskar'>".$rowkar['c_descontrat']."</span></td>
	<td width='90' align='center' ><span class='reskar'>".$rowkar['fecha_crono']."</span></td>
    <td width='160' align='center'><span class='reskar'>".$rowkar['tipo_permiso']."</span></td>
	<td width='90' align='center'><span class='reskar'>".$rowkar['fec_ingreso']."</span></td>
	<td width='73' align='center'><span class='reskar'>".$rowkar['des_condicion']."</span></td>
  </tr>
</table>";



}
?>