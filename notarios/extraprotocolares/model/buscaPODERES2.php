
<?php 
include("../../conexion.php");
$numformu=$_POST['numformu'];
$nomc=$_POST['nomc'];

$consulkar=mysql_query("
SELECT poderes_contratantes.c_descontrat,poderes_asunto.des_asunto,ingreso_poderes.*
FROM ingreso_poderes
INNER JOIN poderes_contratantes ON poderes_contratantes.id_poder=ingreso_poderes.id_poder
INNER JOIN poderes_asunto ON poderes_asunto.id_asunto=ingreso_poderes.id_asunto
WHERE poderes_contratantes.c_descontrat LIKE '%$nomc%'
ORDER BY ingreso_poderes.id_poder DESC ", $conn) or die(mysql_error());

while($rowkar = mysql_fetch_array($consulkar)){

$numkar = $rowkar['num_kardex'];
$numkar2 = substr($numkar,5,6).'-'.substr($numkar,0,4);


echo "<table width='858' border='1' cellpadding='0' cellspacing='0' bordercolor='#333333' >
  <tr>

    <td width='60' align='center' ><span class='reskar'><a href='EditPoderesVie.php?id_poder=".$rowkar['id_poder']."'>".$rowkar['id_poder']."</a></span></td>
	<td width='95' align='center' ><span class='reskar'>".$numkar2."</span></td>
	<td width='160' align='center' ><span class='reskar'>".$rowkar['des_asunto']."</span></td>
	<td width='92' align='center' ><span class='reskar'>".$rowkar['fec_crono']."</span></td>
    <td width='161' align='center'><span class='reskar'>".$rowkar['c_descontrat']."</span></td>
	<td width='92' align='center'><span class='reskar'>".$rowkar['fec_ingreso']."</span></td>
	<td width='73' align='center'><span class='reskar'>".$rowkar['num_formu']."</span></td>
  </tr>
</table>";
}
?>