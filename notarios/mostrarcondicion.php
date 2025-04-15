<style type="text/css">
<!--
.ajo {
	font-family: Calibri;
	font-size: 14px;
	color:#F90;
	font:bold;
	font-style: italic;
}

.ajo2 {
	font-family: Calibri;
	font-size: 12px;
	color:#ffffff;
	font-style: italic;
}
-->
</style>
<?php 
include("conexion.php");

     $codkardex=$_POST['codkardex'];


        $consulta=mysql_query("Select * from detalle_actos_kardex where kardex = '$codkardex'", $conn) or die(mysql_error());
		while($row=mysql_fetch_array($consulta)){
		   echo "<tr>
				<td ><span class='ajo'>".$row['desacto']."</span><br></td>
			  </tr>
			  <tr>
				<td width='520'>";
				    $consulta2=mysql_query("Select * from actocondicion where idtipoacto = '".$row['idtipoacto']."' ", $conn) or die(mysql_error());
					 while($row2=mysql_fetch_array($consulta2)){
					echo"<input type='checkbox' name='".$row2['idcondicion']."' id='".$row['item']."' value='".$row2['idcondicion']."' onClick='mostrar3(this.checked, this.name, this.id)'><span class='ajo2'>".$row2['condicion']."</span><br>";
				
				     }
				
				echo "</td>
			  </tr>
			  <tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			  </tr>
			</table>";
		
		}
		
		 

		
?>
