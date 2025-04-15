<?php 
include("conexion.php");

$usuario=$_POST['loginusuario'];

$consult = mysql_query("SELECT loginusuario FROM usuarios WHERE loginusuario='$usuario'", $conn) or die(mysql_error());

while($row = mysql_fetch_array($consult)){
echo "Ya existe";
}
?>