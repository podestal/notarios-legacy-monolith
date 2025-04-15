<?php 
include("conexion.php");
$codkardex=$_POST['codkardex'];

$consulta = mysql_query("SELECT * from contratantes where kardex='$codkardex' ORDER BY idcontratante ASC", $conn) or die(mysql_error());

while($row = mysql_fetch_array($consulta)){
    $consul=mysql_query("Select * from cliente2 where idcontratante='".$row['idcontratante']."' ", $conn) or die(mysql_error());
    $row2 = mysql_fetch_array($consul);
	echo "<table width='700' border='1' bordercolor='#666666' cellspacing='0' cellpadding='0'>
  <tr>
    <td width='526' bgcolor='#FFFFFF'><span class='textocontratantesss'>"; if($row2['tipper']=="N") { 
	
	$nomyape=$row2['apepat']." ".$row2['apemat'].", ".$row2['prinom']." ".$row2['segnom'];
	$textorefe=str_replace("?","'",$nomyape);
	$textoampers=str_replace("*","&",$textorefe);
	$textoamperss=str_replace("ñ","Ñ",$textoampers);
echo strtoupper($textoamperss);
	}else {  
	        $empresita=$row2['razonsocial'];
	         $textorefe=str_replace("?","'",$empresita);
			$textoampers=str_replace("*","&",$textorefe);
			$textoamperss=str_replace("ñ","Ñ",$textoampers);
			echo strtoupper($textoamperss);
	 }
	
echo"</span></td>
    <td width='87' bgcolor='#FFFFFF'><span class='textocontratantesss'><a href='#' id='".$row['idcontratante']."' onclick='mosteli()' onmouseover='seleccioncontratanteeli(this.id)'><img src='iconos/eliminacontrar.png' width='22' height='22' border='0' title='Eliminar Contratante' /></a></span></td>
    <td width='87' bgcolor='#FFFFFF'><span class='textocontratantesss'><a href='#' id='".$row['idcontratante']."' onclick='mostedi()' onmouseover='seleccioncontratanteeli(this.id)'><img src='iconos/editacontrar.png' width='22'  height='22' border='0' title='Editar Contratante' /></a></span></td>
  </tr>
</table>";

}
 

?>