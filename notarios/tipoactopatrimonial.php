<?php 
include("conexion.php");

$codkardex=$_POST['codkardex'];
$sqlxxx=mysql_query("SELECT * FROM detalle_actos_kardex where kardex='$codkardex'",$conn) or die(mysql_error()); 

echo"<select name='tipoactopatri' style='width:150px' id='tipoactopatri' onchange='callumbral(this.value)'>";
echo"<option value='0'>SELECCIONE ACTO</option>";
	   while($rowdetaacto = mysql_fetch_array($sqlxxx)){

	         echo "<option value=".$rowdetaacto['idtipoacto']."|".$rowdetaacto['item'].">".$rowdetaacto['desacto']."</option> \n";
             }
			 	     
       echo" </select>";

	   
?>
