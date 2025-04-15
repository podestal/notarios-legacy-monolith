<?php 

include("../../conexion.php");

$usuario=strtoupper($_REQUEST['usuario']);
$password=strtoupper($_REQUEST['clave']);

$sql = "SELECT * FROM usuarios WHERE loginusuario='".$usuario."'";
$result = mysql_query($sql,$conn) or die(mysql_error());

			
if($row=mysql_fetch_array($result))
{ 				
     if ($row["password"] == $password & $row["estado"]==1)
     {
	  echo '<input name="valorusu" type="text" id="valorusu" value="1" />';
	  
	  ?>
      <?php
	  }else{
	  echo'<input name="valorusu" type="text" id="valorusu" value="" />';
	  }
 } else{
	 echo'<input name="valorusu" type="text" id="valorusu" value="" />';
 
}
 ?>	