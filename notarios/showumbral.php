<?php 

include("conexion.php");
$codkardex = $_POST['codkardex'];
$idttiippooacto=$_POST['idttiippooacto'];

$separar= explode("|",$_POST['idttiippooacto'] );
$tipoactopatri = $separar[0];
$item = $separar[1];


$sqlxxx=mysql_query("SELECT * FROM detalle_actos_kardex where kardex='$codkardex' and item='$item'",$conn) or die(mysql_error()); 
$rowxxx= mysql_fetch_array($sqlxxx);

$tipodeacto=$rowxxx['idtipoacto'];

$sqlddd=mysql_query("SELECT * FROM tiposdeacto where idtipoacto='$tipodeacto'",$conn) or die(mysql_error()); 
$rowddd = mysql_fetch_array($sqlddd);
echo"<input name='humbral' value='".$rowddd['umbral']."' type='hidden' />";

?>
