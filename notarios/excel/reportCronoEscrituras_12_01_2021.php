
<?php

$fechade = $_POST['fechade'];
$fecha=explode("/",$fechade);
$desde=$fecha[2]."-".$fecha[1]."-".$fecha[0];

$fechaa  = $_POST['fechaa'];
$fecha2=explode("/",$fechaa);
$hasta=$fecha2[2]."-".$fecha2[1]."-".$fecha2[0];

if($_POST['fechade']!="" or $_POST['fechaa']!="") {
	
include("../conexion.php");
include("../extraprotocolares/view/funciones.php");	

//Exportar datos de php a Excel

header("Content-Description: File Transfer");  
header("Content-Type: application/force-download"); 
header("Content-Disposition: attachment; filename=IC_EP.doc");
$consulta = mysql_query("SELECT fechaescritura,kardex,contrato,numescritura,numminuta,folioini, CAST(numescritura AS SIGNED) AS numescritura2 FROM kardex WHERE idtipkar='1' and nc=0 and fechaescritura <> '' 
					   AND STR_TO_DATE(fechaescritura,'%Y-%m-%d') >= STR_TO_DATE('".$desde."','%Y-%m-%d') 
					   AND STR_TO_DATE(fechaescritura,'%Y-%m-%d') <= STR_TO_DATE('".$hasta."','%Y-%m-%d') order by fechaescritura, numescritura2, numminuta asc", $conn) or die(mysql_error());
					   
$contador=mysql_num_rows($consulta); 
$confinotario=mysql_query("SELECT nombre,apellido FROM confinotario",$conn);
$resnotario=mysql_fetch_assoc($confinotario);
$nombrenotario=$resnotario['nombre']." ".$resnotario['apellido'];	  
?>
<HTML LANG="es">
<head>
<TITLE>::. Exportacion de Datos .::</TITLE>
<style>
.cualquierotroestilo{
   font-size: 9px;
}
</style>
</head>
<body>

<table width='900' border='0' cellpadding='0' cellspacing='0'>
<tr>
	<td colspan="2" align="left"><b><span><font size="-1">Notaria <?php echo $nombrenotario;?></font></span></b></td>
</tr>
<tr>
	<td align="left" width="300"><b><span><font size="-3">INDICE CRONOLOGICO DE ESCRITURAS PUBLICAS</font></span></b></td>
    <td align="right" width="300"><b><span>del <?php echo fechabd_an($desde)." al ".fechabd_an($hasta); ?></span></b></td>
</tr>
</table>
<hr/>
<table width="900" bordercolor="#333333"  BORDER="0" align="center" CELLPADDING="0" CELLSPACING="0">       
		<tr class="titulos">   
          <TH  width='71'  style="font-size:11px" align="left"><span class=''>FECH. ESCR</span></TH >
                      <TH  width='93' style="font-size:11px" align="center"><span class=''>KARDEX</span></TH >
                     <TH  width='250' style="font-size:11px"><span class=''>CONTRATANTE</span></TH >
                     <TH  width='150' style="font-size:11px" align="left"><span class=''>ACTO JURIDICO</span></TH >
                      <TH  width='53' style="font-size:11px" align="center"><span class=''>ESCRITURA</span></TH >
                       <TH width='84'  style="font-size:11px" ><span class=''>N. MNUTA</span></TH >
					<TH width='63'  style="font-size:11px"><span class=''>NUM. FOLIO</span></TH >
                         
            </tr> 
</TABLE>            
<hr />
<table width="900" bordercolor="#333333"  BORDER="0" align="center">   

<?php


while($row = mysql_fetch_array($consulta)){
	
	$kardex=$row['kardex'];
	

echo"<TR><td class='cualquierotroestilo' width='90'  align='left' valign='top'><span class='Estilo12'>"; $time=explode("-",$row['fechaescritura']); echo $time[2] . "/" . $time[1] . "/" . $time[0]; 
	 echo"&nbsp;</span></td>
    <td class='cualquierotroestilo' width='75'  align='center' valign='top'><span class='Estilo12'>".$row['kardex']."</span></td>
	
    <td class='cualquierotroestilo' width='300'   align='left' valign='top'><span class='Estilo12'>"; 

	  
	  $consultrr = mysql_query("SELECT
							  UPPER(CONCAT(cliente2.prinom,' ',cliente2.segnom,' ',cliente2.apepat,' ',cliente2.apemat)) as nombre,
							  kardex.idkardex,
							  contratantes.idcontratante,
							  UPPER(cliente2.razonsocial) as empresa
							  FROM
							  contratantes
							  INNER JOIN cliente2 ON cliente2.idcontratante = contratantes.idcontratante
							  INNER JOIN kardex ON contratantes.kardex = kardex.kardex
							  WHERE
							  contratantes.kardex = '$kardex'", $conn) or die(mysql_error());
	  while($row3 = mysql_fetch_array($consultrr)){

	echo strtoupper(str_replace("?","'",$row3['nombre']).str_replace("?","'",$row3['empresa']))."<br />";  
	 }

	echo"</span></td>
   <td class='cualquierotroestilo' width='200'   align='left' valign='top'><span class='Estilo12'>".strtoupper($row['contrato'])."</span></td>
   
    <td class='cualquierotroestilo' width='70'  align='center' valign='top'><span class='Estilo12'>".$row['numescritura']."</span></td>
	
    <td class='cualquierotroestilo' width='70'   align='center' valign='top'><span class='Estilo12'>".$row['numminuta']."</span></td>
	
     <td class='cualquierotroestilo' width='70' align='center' valign='top'><span class='Estilo12'>".$row['folioini']."</span></td>
  </TR>
";
}?>
</table>
</body>
</html>

<?php
}else{
	echo "<script>window.location='../indicecroescrituras.php'</script>";	
}
?>


