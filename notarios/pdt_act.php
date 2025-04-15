<?php
include('conexion.php');
$result=mysql_query("SELECT * FROM actocondicion2",$conn);
while($row = mysql_fetch_array($result)) {
 mysql_query("update actocondicion set totorgante='".$row['totorgante']."', parte='".$row['parte']."', montop='".$row['montop']."', formulario='".$row['formulario']."' where idcondicion ='".$row['idcondicion']."' and condicion='".$row['condicion']."'",$conn);
echo "modificado<br>";

}	