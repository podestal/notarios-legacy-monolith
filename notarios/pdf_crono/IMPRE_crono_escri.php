<?php 

include('../conexion.php');

include('../extraprotocolares/view/funciones.php');

$conexion = Conectar();

$desde = $_REQUEST['fechade'];
$hasta = $_REQUEST['fechaa'];

$desde = fechan_abd($desde);
$hasta = fechan_abd($hasta); 



$consulta = mysql_query("SELECT fechaescritura,kardex,contrato,numescritura,numminuta,folioini, CAST(numescritura AS SIGNED) AS numescritura2 FROM kardex WHERE idtipkar='1' and fechaescritura != '' 
					   AND STR_TO_DATE(fechaescritura,'%Y-%m-%d') >= STR_TO_DATE('$desde','%Y-%m-%d') 
					   AND STR_TO_DATE(fechaescritura,'%Y-%m-%d') <= STR_TO_DATE('$hasta','%Y-%m-%d') order by fechaescritura, numescritura2, numminuta", $conn) or die(mysql_error());

?>
<table width='1000' border='0' cellpadding='0' cellspacing='0'>
<tr>
	<td colspan="2" align="left"><b><span>Notaria Fernando Loayza Bellido</span></b></td>
</tr>
<tr>
	<td align="left" width="500"><b><span>INDICE ALFABETICO DE ESCRITURAS PUBLICAS</span></b></td>
    <td align="right" width="500"><b><span>del <?php echo $fechade ?> al <?php echo $fechaa ?></span></b></td>
</tr>
</table>
<hr />
<table width='834' border='0' align="center" cellpadding='0' cellspacing='0'>

		<tr>
              <td width='73' height='19' align="center"><span>Fecha Escr.</span></td>
              <td width='50' align="center"><span>Kardex</span></td>
              <td width='263' align="center"><span>Contratantes</span></td>
              <td width='166' align="center"><span>Acto</span></td>
              <td width='91' align="center"><span>Instrumento</span></td>
              <td width='84' align="center"><span>Nro Minuta</span></td>
              <td width='91' align="center"><span>Nro Folio</span></td>
            </tr>
</TABLE>
<hr />
<?php

echo"<table width='834' bordercolor='#333333'  BORDER=0 align='center' CELLPADDING=0 CELLSPACING=0 >";

while($row = mysql_fetch_array($consulta)){

echo"
			<TR>	
			<TD width='73'  align='center' height='19' valign='top'><span style='font-size:11px;'>"; $time=explode("-",$row['fechaescritura']); echo $time[2] . "/" . $time[1] . "/" . $time[0]; 
	 echo"</span></TD>
    <TD width='50' align='center' valign='top'><span style='font-size:11px;'>".$row['kardex']."</span></TD>
    <TD width='263' align='left' valign='top'><span style='font-size:11px;'>"; 
	$kardex=$row['kardex'];
	$consultr = mysql_query("SELECT * FROM contratantes WHERE kardex='$kardex' and indice='1'", $conn) or die(mysql_error());
	while($row2 = mysql_fetch_array($consultr)){
	  $contratante=$row2['idcontratante'];
	  $consultrr = mysql_query("SELECT * FROM cliente2 WHERE idcontratante='$contratante' order by idcontratante asc", $conn) or die(mysql_error());
	  while($row3 = mysql_fetch_array($consultrr)){
	   if($row3['tipper']=="N") { 
	   $nom = $row3['apepat']." ".$row3['apemat'].", ".$row3['prinom']." ".$row3['segnom']."<br>";  
	   $textormat=str_replace("?","'",$nom);
    $textoampermat=str_replace("*","&",$textormat);
	echo utf8_encode(strtoupper($nom));
	   }else {
		   	$textormat4=str_replace("?","'",$row3['razonsocial']);
    $textoampermat4=str_replace("*","&",$textormat4);
	echo utf8_encode(strtoupper($row3['razonsocial']));  
	   echo "<br>"; }
	  }
	}
	echo"</span></td>
    <TD width='166' align='left' valign='top'><span style='font-size:11px;'>".strtoupper($row['contrato'])."</span></TD>
    <TD width='91'  align='center' valign='top'><span style='font-size:11px;'>".$row['numescritura']."</span></TD>
    <TD width='84'  align='center' valign='top'><span style='font-size:11px;'>".$row['numminuta']."</span></TD>
    <TD width='91' align='center' valign='top'><span style='font-size:11px;'>".$row['folioini']."</span></TD>
  </TR>
";
}
echo"</TABLE>";
	
mysql_free_result($consulta);
mysql_free_result($consultr);
mysql_close($conn);
