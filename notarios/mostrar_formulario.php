<style>
.fuente{
	
	font-family:Verdana, Geneva, sans-serif;
	font-size:11px;
	}

</style>
<?php 
include("conexion.php");
$idrenta=$_POST['idrenta'];

$consultas = mysql_query("SELECT * from formulario where idrenta='$idrenta'", $conn) or die(mysql_error());

while($rows = mysql_fetch_array($consultas)){
	echo "<table width='350'  border='1' bordercolor='#333333' cellspacing='0' cellpadding='0'>
  <tr>
    <td width='200' bgcolor='#FFFFFF'><span class='fuente'>".$rows['numformu']."</span></td>
    <td width='123' bgcolor='#FFFFFF' ><span class='fuente'>".$rows['monto']."<span class='fuente'></td> 
	<td width='20' bgcolor='#FFFFFF' ><a id='".$rows['idformulario']."' onclick='eliformul(this.id)'><img src='iconos/eliminamv.png' border='0' /></a></td>
  </tr>
</table>";

}

?>