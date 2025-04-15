<style type="text/css">
<!--
.checks {
	font-family: Calibri;
	font-size: 12px;
	color: #FFFFFF;
	font-style: italic;
}
-->
</style>
<?php 
include("conexion.php");

$idtipkar=$_POST['idtipkar'];

$consulta=mysql_query("Select * from tiposdeacto where idtipkar='$idtipkar' ORDER BY desacto ASC", $conn) or die(mysql_error());

 while($row=mysql_fetch_array($consulta)){
		//   echo "<table width='600' border='0' cellspacing='0' cellpadding='0' id='txtItems".(int)$row['idtipoacto']."'>
		// 		  <tr>
		// 			<td width='20'>&nbsp;</td>
		// 			<td width='580'><input type='checkbox' name='".$row['idtipoacto']."' value='".$row['desacto']."' id='".$row['idtipoacto']."' onClick='mostrar(this.checked,this.value); mostrar2(this.checked, this.name)'><span class='checks'>".$row['desacto']."</span></td>
		// 		  </tr>
		// 		</table>
		
		if($row['actouif']==''){
			$uif = '';
		}else{
			$uif = "&nbsp;&nbsp;&nbsp;<span style='color:#88F5F5'>--> UIF: </span><span style='color:#00FFFF;font-weight:bold;'>".$row['actouif']."</span>";
		}
		if($row['actosunat']==''){
			$sunat = '';
		}else{
			$sunat = "&nbsp;&nbsp;&nbsp;<span style='color:#fba595'>--> SUNAT: </span><span style='color:tomato;font-weight:bold;'>".$row['actosunat']."</span>";
		}
			echo "<table width='600' border='0' cellspacing='0' cellpadding='0' id='txtItems".(int)$row['idtipoacto']."'>
					
					<tr>
						<td width='20'>&nbsp;</td>
						<td width='580'><input type='checkbox' name='".$row['idtipoacto']."' value='".$row['desacto']."' id='".$row['idtipoacto']."' onClick='mostrar(this.checked,this.value); mostrar2(this.checked, this.name)'><span class='checks'>".$row['desacto'].$uif.$sunat."</span></td>
					</tr>
				</table>

		  
		  
		  ";  
		  }
 
?>
