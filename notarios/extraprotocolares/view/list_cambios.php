      <?php 
include("../../conexion.php");
	
$id_cambio      = $_REQUEST['id_cambio'];
$id_solicitante = $_REQUEST['id_solicitante'];


$consulcontrat=mysql_query("Select cambio_caracter.id_cambio,cambio_caracter.num_crono, ccaracter_solicitantes.* from ccaracter_solicitantes
INNER JOIN cambio_caracter ON cambio_caracter.id_cambio = ccaracter_solicitantes.id_cambio
WHERE ccaracter_solicitantes.id_cambio='$id_cambio'", $conn) or die(mysql_error());
$i = 1;
while($row = mysql_fetch_array($consulcontrat)){

$c_desc = $row['descri_solicitante'];
$textorpat=str_replace("?","'",$c_desc);
$textoamperpat=str_replace("*","&",$textorpat);

$c_desc1 = $row['domic_solicitante'];
$textorpat1=str_replace("?","'",$c_desc1);
$textoamperpat1=str_replace("*","&",$textorpat1);

		  
echo "<table width='880' border='1' cellpadding='0' cellspacing='0' bordercolor='#333333' >
  <tr>
    <td width='20' align='center' ><span class='reskar'>".$i."</span></td>
	<td width='90' align='center' ><span class='reskar'>".$row['numdocu_solicitante']."</span></td>
	<td width='150' align='center' ><span class='reskar'>".$textoamperpat."</span></td>
    <td width='150' align='center'><span class='reskar'>".$textoamperpat1."</span></td>
	<td width='23' align='center' ><span class='reskar'><a href='#' id='".$row['id_cambio']."' name='".$row['id_solicitante']."' onclick='ElimSolicitante(this.id,this.name)'><img src='../../iconos/eliminamv.png' width='16' height='18'></a></span></td>
    <td width='25' bgcolor='#FFFFFF'><span class='textocontratantesss'><a href='#' id='".$row['id_cambio']."' name='".$row['id_solicitante']."' onclick='editarsolicitante(this.id,this.name)'><img src='../../iconos/editacontrar.png' width='22'  height='22' border='0' title='Editar Contratante' /></a></span></td>
  </tr>
</table>";
$i++;
}
?>
