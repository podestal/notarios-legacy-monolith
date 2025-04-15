<?php 

include("../../conexion.php");

$usuario=strtoupper($_REQUEST['user']);
$password=strtoupper($_REQUEST['pass']);

$sql = "SELECT * FROM usuarios WHERE loginusuario='".$usuario."'";
$result = mysql_query($sql,$conn) or die(mysql_error());

if($row=mysql_fetch_array($result))
{ 				
     if ($row["password"] == $password & $row["estado"]==1)
     {
	 $flag = 1;	 
	 echo json_encode($flag); 
	 ?>
     <?php
	 }else{
	 $flag = 2;	 
	  echo json_encode($flag); 
	 }
 } else{
	 $flag = 2;
	 echo json_encode($flag); 
 
}

 ?>	