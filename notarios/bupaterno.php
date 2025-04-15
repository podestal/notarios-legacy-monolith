<?php 
include("conexion.php");

$paterno=$_POST['paterno'];

$consult = mysql_query("SELECT usuarios.idusuario, usuarios.apepat, usuarios.apemat, usuarios.prinom, usuarios.segnom, usuarios.loginusuario, usuarios.estado, cargousu.descargo FROM usuarios inner join cargousu on usuarios.idcargo=cargousu.idcargo WHERE apepat LIKE '%".$paterno."%'", $conn) or die(mysql_error());

while($row = mysql_fetch_array($consult)){
echo "<table width='568' border='1' cellpadding='0' cellspacing='0' bordercolor='#CCCCCC'>
  <tr> 
    <td width='160' height='31' class='Estilo14'>".$row['apepat']." ".$row['apemat'].",".$row['prinom']." ".$row['segnom']."</td>
    <td width='102' align='center' class='Estilo14'>".$row['descargo']."</td> 
    <td width='85' align='center' class='Estilo14'>".$row['loginusuario']."</td>
    <td width='67' align='center' class='Estilo14'>"; if ($row['estado']==0)
	{echo "Inhabilitado";}else{echo "Habilitado";} echo "</td>
    <td width='34' align='center'>"; if ($row['estado']==0)
	{echo "<a href='activar_usu.php?idusu=".$row['idusuario']."'><img src='iconos/desbloquear.png' title='Desbloquear Usuario' width='34' height='36' border='0' /></a>";}else{echo "<a href='bloquear_usu.php?idusu=".$row['idusuario']."'><img src='iconos/bloquear.png' title='Bloquear Usuario' width='34' height='36' border='0' /></a>";} echo "</td>
    <td width='34' align='center'><a href='#' onmouseover='seleccion(".$row['idusuario'].")' onClick='editar()'><img src='iconos/editar.jpg' width='34' title='Editar Usuario' height='36' border='0' /></a></td>
    <td width='34' align='center'><a href='#' onmouseover='seleccion2(".$row['idusuario'].")' onClick='permisos()'><img src='iconos/permisos.jpg' width='34' height='36' border='0' title='Permisos Usuario' /></a></td>
    <td width='34' align='center'><a href='#' onmouseover='seleccion3(".$row['idusuario'].")' onClick='clave()'><img src='iconos/clave.jpg' width='34' height='36' border='0' title='Cambiar Clave' /></a></td>
  </tr>
</table>
";
}
?>