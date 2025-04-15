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
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=Reporte_EscrPublica.xls");

$consulta = mysql_query("SELECT fechaescritura,kardex,contrato,numescritura,numminuta,folioini, CAST(numescritura AS SIGNED) AS numescritura2 FROM kardex WHERE idtipkar='1' and fechaescritura <> '' 
					   AND STR_TO_DATE(fechaescritura,'%Y-%m-%d') >= STR_TO_DATE('".$desde."','%Y-%m-%d') 
					   AND STR_TO_DATE(fechaescritura,'%Y-%m-%d') <= STR_TO_DATE('".$hasta."','%Y-%m-%d') order by fechaescritura, numescritura2, numminuta asc", $conn) or die(mysql_error());
					   
$contador=mysql_num_rows($consulta);

$confinotario=mysql_query("SELECT nombre,apellido FROM confinotario",$conn);
$resnotario=mysql_fetch_assoc($confinotario);
$nombrenotario=$resnotario['nombre']." ".$resnotario['apellido'];
$paginador=2;				   
?>
<HTML LANG="es">
<TITLE>::. Exportacion de Datos .::</TITLE>
<style>
.cualquierotroestilo{
   font-size: 9px;
}
</style>
</head><body>
<table width="1300" bordercolor="#333333"  BORDER="1" align="center" CELLPADDING="0" CELLSPACING="0">
        <th align="center" height="40" valign="middle" style="font-size:11px">
		<?php 
		echo "1";
		?>
<th width='35%' colspan="6" align="center" height="40" valign="middle" style="font-size:11px"><span><font size="+3">INDICE CRONOLOGICO DE ESCRITURAS PUBLICAS</font></span></th>
<tr class="titulos">
<th width='35%' colspan="7" align="center" height="25" valign="middle"style="font-size:11px"><span><font size="+2"><?php echo "del ".fechabd_an($desde)." al ".fechabd_an($hasta); ?></font></span></th>
<tr height='19' class="titulos">
        
                      <TH  width='90' height="40" bgcolor="#254061" style="color:#FFF; font-size:11px" ><div style='height:auto;width:20px'><span cla5s='Estilo14'>FECH. ESCR</span></div></TH >
                      <TH  width='75' height="40" bgcolor="#254061" style="color:#FFF; font-size:11px"><div style='height:40px;width:20px'><span class='Estilo14'>KARDEX</span></div></TH >
                     <TH  width='150' height="40" bgcolor="#254061" style="color:#FFF; font-size:11px"><div style='height:40px;width:20px'><span class='Estilo14'>CONTRATANTE</span></div></TH >
                     <TH  width='80' height="40" bgcolor="#254061" style="color:#FFF; font-size:11px"><div style='height:40px;width:20px'><span class='Estilo14'>ACTO</span></div></TH >
                      <TH  width='70' height="40" bgcolor="#254061" style="color:#FFF; font-size:11px"><div style='height:40px;width:20px'><span class='Estilo14'>INSTR</span></div></TH >
                       <TH width='70'height="40"  bgcolor="#254061" style="color:#FFF; font-size:11px"><div style='height:40px;width:20px'><span class='Estilo14'>N. MNUTA</span></div></TH >
					<TH width='70'height="40"  bgcolor="#254061" style="color:#FFF; font-size:11px"><div style='height:40px;width:20px'><span class='Estilo14'>NUM. FOLIO</span></div></TH >
                      </tr>

                      
<?php

$x = 1;

while($row = mysql_fetch_array($consulta)){
	
	$kardex=$row['kardex'];
	
	$pregunta=mysql_query("SELECT * FROM contratantes WHERE kardex='$kardex' and indice='1'", $conn) or die(mysql_error());
	
	
		  //contamos el numero de participantes
	  $conteo_cont=mysql_num_rows($pregunta);
	  
	if($conteo_cont<4){
		
		$consultr = mysql_query("SELECT * FROM contratantes WHERE kardex='$kardex' and indice='1'", $conn) or die(mysql_error());

echo"<TR><td class='cualquierotroestilo' width='90'  height='100' align='center' valign='top'><div style='height:40px;width:20px'><span class='Estilo12'>"; $time=explode("-",$row['fechaescritura']); echo $time[2] . "/" . $time[1] . "/" . $time[0]; 
	 echo"&nbsp;</span></div></td>
    <td class='cualquierotroestilo' width='75'  height='100' align='center' valign='top'><div style='height:40px;width:20px'><span class='Estilo12'>".$row['kardex']."</span></div></td>
	
    <td class='cualquierotroestilo' width='150'  height='100' align='center' valign='top'><div style='height:40px;width:20px;'><span class='Estilo12'>"; 

	while($row2 = mysql_fetch_array($consultr)){
	  $contratante=$row2['idcontratante'];
	  

	  
	  $consultrr = mysql_query("SELECT * FROM cliente2 WHERE idcontratante='$contratante' order by idcontratante asc limit 5", $conn) or die(mysql_error());
	  while($row3 = mysql_fetch_array($consultrr)){
	   if($row3['tipper']=="N") { 
	   $nom = $row3['apepat']." ".$row3['apemat'].", ".$row3['prinom']." ".$row3['segnom']."<br>";  
	   $textormat=str_replace("?","'",$nom);
    $textoampermat=str_replace("*","&",$textormat);
	echo strtoupper($textoampermat);
	   }else {
		   	$textormat4=str_replace("?","'",$row3['razonsocial']);
    $textoampermat4=str_replace("*","&",$textormat4);
	echo strtoupper($textoampermat4);  
	   echo "<br>"; }
	  }
	}
	echo"</span></div></td>
   <td class='cualquierotroestilo' width='100'  height='80' align='center' valign='top'><div style='height:40px;width:20px'><span class='Estilo12'>".strtoupper($row['contrato'])."</span></div></td>
   
    <td class='cualquierotroestilo' width='70'  height='100' align='center' valign='top'><div style='height:40px;width:20px'><span class='Estilo12'>".$row['numescritura']."</span></div></td>
	
    <td class='cualquierotroestilo' width='70'  height='100' align='center' valign='top'><div style='height:40px;width:20px'><span class='Estilo12'>".$row['numminuta']."</span></div></td>
	
     <td class='cualquierotroestilo' width='70'  height='100' align='center' valign='top'><div style='height:40px;width:20px'><span class='Estilo12'>".$row['folioini']."</span></div></td>
  </TR>
";

	}else if($conteo_cont>4){
		
		$consultr = mysql_query("SELECT * FROM contratantes WHERE kardex='$kardex' and indice='1' limit 5", $conn) or die(mysql_error());
		
		echo"<TR><td class='cualquierotroestilo' width='90'  height='100' align='center' valign='top'><div style='height:40px;width:20px'><span class='Estilo12'>"; $time=explode("-",$row['fechaescritura']); echo $time[2] . "/" . $time[1] . "/" . $time[0]; 
	 echo"&nbsp;</span></div></td>
    <td class='cualquierotroestilo' width='75'  height='100' align='center' valign='top'><div style='height:40px;width:20px'><span class='Estilo12'>".$row['kardex']."</span></div></td>
	
    <td class='cualquierotroestilo' border=0 width='150'  height='100' align='center' valign='top'><div style='height:40px;width:20px;'><span class='Estilo12'>"; 

	while($row2 = mysql_fetch_array($consultr)){
	  $contratante=$row2['idcontratante'];
	  
	  //contamos el numero de participantes
	  $conteo_cont=mysql_num_rows($consultr);
	  
	  
	  $consultrr = mysql_query("SELECT * FROM cliente2 WHERE idcontratante='$contratante' order by idcontratante asc", $conn) or die(mysql_error());
	  while($row3 = mysql_fetch_array($consultrr)){
	   if($row3['tipper']=="N") { 
	   $nom = $row3['apepat']." ".$row3['apemat'].", ".$row3['prinom']." ".$row3['segnom']."<br>";  
	   $textormat=str_replace("?","'",$nom);
    $textoampermat=str_replace("*","&",$textormat);
	echo strtoupper($textoampermat);
	   }else {
		   	$textormat4=str_replace("?","'",$row3['razonsocial']);
    $textoampermat4=str_replace("*","&",$textormat4);
	echo strtoupper($textoampermat4);  
	   echo "<br>"; }
	  }
	}
	echo"</span></div></td>
   <td class='cualquierotroestilo' width='100'  height='80' align='center' valign='top'><div style='height:40px;width:20px'><span class='Estilo12'>".strtoupper($row['contrato'])."</span></div></td>
   
    <td class='cualquierotroestilo' width='70'  height='100' align='center' valign='top'><div style='height:40px;width:20px'><span class='Estilo12'>".$row['numescritura']."</span></div></td>
	
    <td class='cualquierotroestilo' width='70'  height='100' align='center' valign='top'><div style='height:40px;width:20px'><span class='Estilo12'>".$row['numminuta']."</span></div></td>
	
     <td class='cualquierotroestilo' width='70'  height='100' align='center' valign='top'><div style='height:40px;width:20px'><span class='Estilo12'>".$row['folioini']."</span></div></td>
  </TR>
";

$consultrx = mysql_query("SELECT * FROM contratantes WHERE kardex='$kardex' and indice='1' limit 5,15", $conn) or die(mysql_error());
		
		echo"<TR><td border=0 class='cualquierotroestilo' width='90'  height='100' align='center' valign='top'><div style='height:40px;width:20px'><span class='Estilo12'></span></div></td>
    <td class='cualquierotroestilo' width='75'  height='100' align='center' valign='top'><div style='height:40px;width:20px'><span class='Estilo12'></span></div></td>
	
    <td class='cualquierotroestilo' style='border-top:-1px;' width='150'  height='100' align='center' valign='top'><div style='height:40px;width:20px;'><span class='Estilo12'>"; 

	while($row2x = mysql_fetch_array($consultrx)){
	  $contratantex=$row2x['idcontratante'];
	  
	  
	  $consultrrx = mysql_query("SELECT * FROM cliente2 WHERE idcontratante='$contratantex' order by idcontratante asc", $conn) or die(mysql_error());
	  while($row3x = mysql_fetch_array($consultrrx)){
	   if($row3x['tipper']=="N") { 
	   $nomx = $row3x['apepat']." ".$row3x['apemat'].", ".$row3x['prinom']." ".$row3x['segnom']."<br>";  
	   $textormatx=str_replace("?","'",$nomx);
    $textoampermatx=str_replace("*","&",$textormatx);
	echo strtoupper($textoampermatx);
	   }else {
		   	$textormat4x=str_replace("?","'",$row3x['razonsocial']);
    $textoampermat4x=str_replace("*","&",$textormat4x);
	echo strtoupper($textoampermat4x);  
	   echo "<br>"; }
	  }
	}
	echo"</span></div></td>
   <td class='cualquierotroestilo' width='100'  height='80' align='center' valign='top'><div style='height:40px;width:20px'><span class='Estilo12'></span></div></td>
   
    <td class='cualquierotroestilo' width='70'  height='100' align='center' valign='top'><div style='height:40px;width:20px'><span class='Estilo12'></span></div></td>
	
    <td class='cualquierotroestilo' width='70'  height='100' align='center' valign='top'><div style='height:40px;width:20px'><span class='Estilo12'></span></div></td>
	
     <td class='cualquierotroestilo' width='70'  height='100' align='center' valign='top'><div style='height:40px;width:20px'><span class='Estilo12'></span></div></td>
  </TR>
";


$x++;		
	}
	
	

if(5==$x)
    {
		
        include ('TablaEscrituras.php');
        $x = 0;
		$paginador++;
    }
    
    $x++;	

}?>


</table>
</body>
</html>
<?php
}else{
	echo "<script>window.location='../indicecroesrituras.php'</script>";	
}
