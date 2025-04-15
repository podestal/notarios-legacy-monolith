            <?php 
include("../../conexion.php");
$descri = $_POST["descri"];

$consulkar=mysql_query("Select * from servicios WHERE servicios.descrip LIKE '%$descri%' ORDER BY servicios.codigo ASC", $conn) or die(mysql_error());

while($rowkar = mysql_fetch_array($consulkar)){

echo "<table width='880' border='1' cellpadding='0' cellspacing='0' bordercolor='#333333' >
  <tr>
    <td width='63' align='center' ><span class='reskar'><a href='EdiServicios.php?codigo=".$rowkar['codigo']."'>
	".$rowkar['codigo']."</a></span></td>
	<td width='86' align='center' ><span class='reskar'>".$rowkar['descrip']."</span></td>
	<td width='86' align='center' ><span class='reskar'>".$rowkar['tipo']."</span></td>
  </tr>
</table>";
}
?>