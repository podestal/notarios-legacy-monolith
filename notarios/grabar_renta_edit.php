<?php 
include("conexion.php");

$idrenta=$_POST['idrenta'];
$pregu1=$_POST['pregu1'];
$pregu2=$_POST['pregu2'];
$pregu3=$_POST['pregu3'];

mysql_query("update renta set pregu1='$pregu1', pregu2='$pregu2', pregu3='$pregu3'  where idrenta='$idrenta'", $conn) or die(mysql_error());

echo "<input name='idrenta' id='idrenta' value='".$idrenta."' type='hidden' />";
echo "Preguntas Modificadas ...";

?>