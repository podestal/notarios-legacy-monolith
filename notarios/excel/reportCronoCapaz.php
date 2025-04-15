
<?php

include("../conexion.php");
include("../extraprotocolares/view/funciones.php");	


$fechade = $_POST['fechade'];
$fecha=explode("/",$fechade);
$desde=$fecha[2]."-".$fecha[1]."-".$fecha[0];

$fechaa  = $_POST['fechaa'];
$fecha2=explode("/",$fechaa);
$hasta=$fecha2[2]."-".$fecha2[1]."-".$fecha2[0];



if($_POST['fechade']!="" or $_POST['fechaa']!="") {
	
header("Content-Description: File Transfer");  
header("Content-Type: application/force-download"); 
header("Content-Disposition: attachment; filename=IC_PC.doc");
//Exportar datos de php a Excel

$consulta = mysql_query("SELECT
						 cert_supervivencia.num_crono as num_crono,
						 cert_supervivencia.fecha as fecha,
						 cert_supervivencia.nombre as nombre,
						 cert_supervivencia.direccion as direccion
						 FROM cert_supervivencia
						 WHERE cert_supervivencia.swt_capacidad = 'C'
						 AND STR_TO_DATE(cert_supervivencia.fecha,'%Y-%m-%d') >= STR_TO_DATE('$desde','%Y-%m-%d') 
						 AND STR_TO_DATE(cert_supervivencia.fecha,'%Y-%m-%d') <= STR_TO_DATE('$hasta','%Y-%m-%d')", $conn) or die(mysql_error());
	
	$confinotario=mysql_query("SELECT nombre,apellido FROM confinotario",$conn);
$resnotario=mysql_fetch_assoc($confinotario);
$nombrenotario=$resnotario['nombre']." ".$resnotario['apellido'];					   
?>
<HTML LANG="es">
<head>
<TITLE>::. Exportacion de Datos .::</TITLE>
<style>
br{margin-bottom:-15px;}
.cualquierotroestilo{
   font-size: 9px;
}
</style>
</head>
<body>

<table width='600' border='0' cellpadding='0' cellspacing='0'>
<tr>
	<td colspan="2" align="left"><b><span><font size="-1">Notaria <?php echo $nombrenotario;?></font></span></b></td>
</tr>
<tr>
	<td align="left" width="300"><b><span><font size="-3">INDICE CRONOLOGICO DE PERSONA CAPAZ</font></span></b></td>
    <td align="right" width="300"><b><span>del <?php echo "del ".fechabd_an($desde)." al ".fechabd_an($hasta); ?></span></b></td>
</tr>
</table>
<hr/>
<table width="650" bordercolor="#333333"  BORDER="0" align="center" CELLPADDING="0" CELLSPACING="0">       
		<tr class="titulos">   
        
              <td width='264' height='19' align="center" style="font-size:11px"><span class='Estilo14'><B>Cronologico</B></span></td>
              <td width='253' align="center" style="font-size:11px"><span class='Estilo14'><B>Fecha</B></span></td>
              <td width='483' align="center" style="font-size:11px"><span class='Estilo14'><B>Nombre</B></span></td>
              <td width='290' align="center" style="font-size:11px"><span class='Estilo14'><B>Direccion</B></span></td>
                       
            </tr> 
</TABLE>            
<hr />
<table width="650" bordercolor="#333333"  BORDER="0" align="center">  



<?php

	while($capaz = mysql_fetch_array($consulta)){

	$arr_capaz[$i][0] = $capaz["num_crono"]; 
	$arr_capaz[$i][1] = $capaz["fecha"]; 
	$arr_capaz[$i][2] = $capaz["nombre"]; 
	$arr_capaz[$i][3] = $capaz["direccion"]; 
	
	$i++; 
}

	for($j=0; $j<count($arr_capaz); $j++) { 

	echo "<tr>
			<td width='85' valign='top' align='center'><span class='Estilo12'>".substr($arr_capaz[$j][0],4,6)."&nbsp;</span></td>
			<td width='253' valign='top' align='center'><span class='Estilo12'>".$arr_capaz[$j][1]."</span></td>
			<td width='600' valign='top' align='center'><span class='Estilo12'>".simbolos(strtoupper($arr_capaz[$j][2]))."</span></td>
			<td width='200' valign='top' align='center'><span class='Estilo12'>".simbolos(strtoupper($arr_capaz[$j][3]))."</span></td>

 	</tr>";
	
	}
	
	?>
</table>
</body>
</html>

<?php
}else{
	echo "<script>window.location='../indicecronoCPcapaz.php'</script>";	
}
?>