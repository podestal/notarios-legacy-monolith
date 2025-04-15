<?php 
include("conexion.php");
$tipper=$_POST['tipoper'];
$nomcontratante=$_POST['nomcontratante'];

if ($tipper=="N"){
$consulcon=mysql_query("Select * from cliente2 where nombre LIKE '%$nomcontratante%'", $conn) or die(mysql_error());
while($rowcon = mysql_fetch_array($consulcon)){
	$consulconkar=mysql_query("Select * from contratantes where idcontratante='".$rowcon['idcontratante']."'", $conn) or die(mysql_error());
     while($rowconkar = mysql_fetch_array($consulconkar)){
	   $consulkar=mysql_query("Select * from kardex where kardex='".$rowconkar['kardex']."'", $conn) or die(mysql_error());

			while($rowkar = mysql_fetch_array($consulkar)){
			
			echo "<table width='1267' border='1' cellpadding='0' cellspacing='0' bordercolor='#333333' >
  <tr>
    <td width='63' align='center' ><span class='reskar'><a href='verkardex.php?kardex=".$rowkar['kardex']."'>".$rowkar['kardex']."</a></span></td>
	<td width='200' align='center' ><span class='reskar'>"; 
	$sqlss=mysql_query("Select * from tipokar where idtipkar='".$rowkar['idtipkar']."'", $conn) or die(mysql_error());
	$rowss=mysql_fetch_array($sqlss);
	echo $rowss['nomtipkar'];
	
	echo"</span></td>
    <td width='86' align='center' ><span class='reskar'>".strtoupper($rowkar['fechaingreso'])."</span></td>
    <td width='238' align='center'><span class='reskar'>".strtoupper($rowkar['contrato'])."</span></td>
    <td width='257' align='center'><span class='reskar'>".strtoupper($rowkar['referencia'])."</span></td>
    <td width='90' align='center'><span class='reskar'>".strtoupper($rowkar['fechaescritura'])."</span></td>
    <td width='96' align='center'><span class='reskar'>".strtoupper($rowkar['numescritura'])."</span></td>
    <td width='70' align='center'><span class='reskar'>".strtoupper($rowkar['folioini'])."</span></td>
    <td width='97' align='center'><span class='reskar'> / / </span></td>
    <td width='50' align='center'><a href='verkardex.php?kardex=".$rowkar['kardex']."'><img src='iconos/verkar.png' width='30' height='31' border='0'></a></td>
  </tr>
</table>";
			
			}
	 
    }
  }

}else{

if ($tipper=="J"){
$consulcon=mysql_query("Select * from cliente2 where razonsocial LIKE '%$nomcontratante%'", $conn) or die(mysql_error());
while($rowcon = mysql_fetch_array($consulcon)){
	$consulconkar=mysql_query("Select * from contratantes where idcontratante='".$rowcon['idcontratante']."'", $conn) or die(mysql_error());
     while($rowconkar = mysql_fetch_array($consulconkar)){
	   $consulkar=mysql_query("Select * from kardex where kardex='".$rowconkar['kardex']."'", $conn) or die(mysql_error());

			while($rowkar = mysql_fetch_array($consulkar)){
			
			echo "<table width='1267' border='1' cellpadding='0' cellspacing='0' bordercolor='#333333' >
  <tr>
    <td width='63' align='center' ><span class='reskar'><a href='verkardex.php?kardex=".$rowkar['kardex']."'>".$rowkar['kardex']."</a></span></td>
	<td width='200' align='center' ><span class='reskar'>"; 
	$sqlss=mysql_query("Select * from tipokar where idtipkar='".$rowkar['idtipkar']."'", $conn) or die(mysql_error());
	$rowss=mysql_fetch_array($sqlss);
	echo $rowss['nomtipkar'];
	
	echo"</span></td>
    <td width='86' align='center' ><span class='reskar'>".strtoupper($rowkar['fechaingreso'])."</span></td>
    <td width='238' align='center'><span class='reskar'>".strtoupper($rowkar['contrato'])."</span></td>
    <td width='257' align='center'><span class='reskar'>".strtoupper($rowkar['referencia'])."</span></td>
    <td width='90' align='center'><span class='reskar'>".strtoupper($rowkar['fechaescritura'])."</span></td>
    <td width='96' align='center'><span class='reskar'>".strtoupper($rowkar['numescritura'])."</span></td>
    <td width='70' align='center'><span class='reskar'>".strtoupper($rowkar['folioini'])."</span></td>
    <td width='97' align='center'><span class='reskar'> / / </span></td>
    <td width='50' align='center'><a href='verkardex.php?kardex=".$rowkar['kardex']."'><img src='iconos/verkar.png' width='30' height='31' border='0'></a></td>
  </tr>
</table>";
			
			}
	 
    }
  }

}






}

?>



