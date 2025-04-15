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
header("Content-Disposition: attachment; filename=IC_CN.doc");
$consulta = mysql_query("SELECT
						ingreso_cartas.num_carta AS num_carta,
						DATE_FORMAT(STR_TO_DATE(fec_ingreso,'%d/%m/%Y'),'%d/%m/%Y') AS fec_ingreso,
						ingreso_cartas.fec_entrega AS fec_entrega,
						ingreso_cartas.hora_entrega AS hora_entrega,
						ingreso_cartas.nom_destinatario AS destinatario,
						ingreso_cartas.nom_remitente AS remitente,
						ubigeo.nomdis as zona
						FROM
						ingreso_cartas
						INNER JOIN ubigeo ON ubigeo.coddis = ingreso_cartas.zona_destinatario
						WHERE STR_TO_DATE(fec_ingreso,'%d/%m/%Y') BETWEEN STR_TO_DATE('".$fechade."','%d/%m/%Y') AND STR_TO_DATE('".$fechaa."','%d/%m/%Y')
						ORDER BY num_carta asc", $conn) or die(mysql_error());
$paginador=2;	
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

<table width='600' border='0' cellpadding='0' cellspacing='0'>
<tr>
	<td colspan="2" align="left"><b><span><font size="-1">Notaria <?php echo $nombrenotario;?></font></span></b></td>
</tr>
<tr>
	<td align="left" width="300"><b><span><font size="-3">INDICE CRONOLOGICO DE CARTAS NOTARIALES</font></span></b></td>
    <td align="right" width="300"><b><span>Listado <?php echo fechabd_an($desde)." al ".fechabd_an($hasta); ?></span></b></td>
</tr>
</table>
<hr/>
<table width="650" bordercolor="#333333"  BORDER="0" align="center" CELLPADDING="0" CELLSPACING="0">       
		<tr class="titulos">   
        
                <TH  width='104' style="font-size:11px" ><span class=''>N&uacute;mero</span></TH >
                      <TH  width='94' style="font-size:11px" align="left"><span class=''>           Fec. Recep</span></div></TH >
                     <Td  width='99' style="font-size:11px"><b><span class=''>Fec. Dilig.</span></b></Td >
                     <TH  width='89' style="font-size:11px" align="left"><span class=''>Hora</span></TH >
                      <TH  width='125' style="font-size:11px" align="left"><span class=''>Remitente</span></TH >
                       <TH width='139' style="font-size:11px" align="left"><span class=''>Destinatario</span></TH >
                       
            </tr> 
</TABLE>            
<hr />
<table width="650" bordercolor="#333333"  BORDER="0" align="center">   

<?php


while($row = mysql_fetch_array($consulta)){

echo "<tr>
			<td class='cualquierotroestilo' width='90'   align='center' valign='top'><div style='height:40px;width:20px'><span class='Estilo12'>".substr(formato_crono_agui($row['num_carta']),0,-5)."&nbsp;</span></div></td>
			<td class='cualquierotroestilo' width='86'   align='center' valign='top'><div style='height:40px;width:20px'><span class='Estilo12'>".$row['fec_ingreso']."</span></div></td>
			<td class='cualquierotroestilo' width='86'  align='center' valign='top'><div style='height:40px;width:20px'><span class='Estilo12'>".$row['fec_entrega']."</span></div></td>
			<td class='cualquierotroestilo'  width=90'  align='center' valign='top'><div style='height:40px;width:20px'><span class='Estilo12'>".strtoupper($row['hora_entrega'])."</span></div></td>
			<td class='cualquierotroestilo' width='150'   align='left' valign='top'><div style='height:40px;width:20px'><span class='Estilo12'>".strtoupper(simbolos($row['remitente']))."</span></div></td>
			<td class='cualquierotroestilo' width='150'  align='left' valign='top'><div style='height:40px;width:20px'><span class='Estilo12'>".strtoupper(simbolos($row['destinatario']))."</span></div></td>
	
 	</tr>";
}?>
</table>
</body>
</html>

<?php
}else{
	echo "<script>window.location='../indicecronocartas.php'</script>";	
}
?>