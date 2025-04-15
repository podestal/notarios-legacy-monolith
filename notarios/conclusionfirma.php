<?php 
include("conexion.php");
$codkardex=$_POST['codkardex'];
$firmafin=$_POST['fecfirmaa'];

$consulta = mysql_query("SELECT * from contratantes where kardex='$codkardex' and (firma='1' and fechafirma='')", $conn) or die(mysql_error());
$numero = mysql_num_rows($consulta);

if($numero==0) 
  {  mysql_query("update kardex set fechaconclusion='$firmafin' where kardex='$codkardex'", $conn) or die(mysql_error());
  }


?>