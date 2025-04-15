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
	

//Exportar datos de php a Excel

header("Content-Description: File Transfer");  
header("Content-Type: application/force-download"); 
header("Content-Disposition: attachment; filename=IC_LC.doc");
$consulta = mysql_query("SELECT
					concat(libros.numlibro,'-',libros.ano) as num_crono,
					libros.fecing as fecha,
					concat(libros.prinom,' ',libros.segnom,' ',libros.apepat,' ',libros.apemat) as cliente,
					libros.empresa as empresa,
					libros.descritiplib as tip_lib,
					nlibro.desnlibro as n_lib,
					libros.folio as folio,
					tipofolio.destipfol as tip_fol,
					libros.ruc as ruc,
					libros.dni as dni,
					libros.descritiplib as deslibro,
					libros.solicitante as solicitante
					FROM
					libros
					LEFT JOIN nlibro ON libros.idnlibro = nlibro.idnlibro
					LEFT JOIN tipofolio ON libros.idtipfol = tipofolio.idtipfol
					LEFT JOIN tipolibro ON libros.idtiplib = tipolibro.idtiplib
					WHERE STR_TO_DATE(libros.fecing,'%Y-%m-%d') >= STR_TO_DATE('$desde','%Y-%m-%d') 
					AND STR_TO_DATE(libros.fecing,'%Y-%m-%d') <= STR_TO_DATE('$hasta','%Y-%m-%d')
					ORDER BY num_crono", $conn) or die(mysql_error());
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

<table width='1000' border='0' cellpadding='0' cellspacing='0'>
<tr>
	<td colspan="2" align="left"><b><span><font size="-1">Notaria <?php echo $nombrenotario;?></font></span></b></td>
</tr>
<tr>
	<td align="left" width="300"><b><span><font size="-3">INDICE CRONOLOGICO DE LEGALIZACION DE APERTURA DE LIBROS Y HOJAS SUELTAS</font></span></b></td>
    <td align="center" width="300"><b><span><?php echo "Listado del ".fechabd_an($desde)." al ".fechabd_an($hasta); ?></span></b></td>
</tr>
</table>
<hr/>
<table width="1000" bordercolor="#333333"  BORDER="0" align="center" CELLPADDING="0" CELLSPACING="0">       
		<tr class="titulos">   
        
						<TH  width='90' style="font-size:11px" align="center" ><span class=''>LIBRO</span></TH >
                      <TH  width='98' style="font-size:11px" align="center"><span class=''>FECHA</span></div></TH >
                     <Td  width='190' style="font-size:11px" align="center"><b><span class=''>PERTENECE A</span></b></Td>
                     <TH  width='178' style="font-size:11px" align="center"><span class=''>OBJETO DEL LIBRO</span></TH >
                     <TH  width='68' style="font-size:11px" align="center"><span class=''>NRO. LIBRO</span></TH >
                     <TH  width='68' style="font-size:11px" align="center"><span class=''>NRO. FOLIOS</span></TH >
                     <TH  width='68' style="font-size:11px" align="center"><span class=''>TIPO FOL.</span></TH >
                     <TH  width='90' style="font-size:11px" align="center"><span class=''>NRO. RUC.</span></TH >
                   
                       
            </tr> 
</TABLE>            
<hr />
<table width="1000" bordercolor="#333333"  BORDER="0" align="center">  



<?php

while($roww = mysql_fetch_array($consulta)){
	
		echo "<tr>
	      <td class='cualquierotroestilo' width='90'  align='center' valign='top'>".$roww['num_crono']."</td>
		  <td  class='cualquierotroestilo' width='98' height='45' align='center' valign='top'>".fechabd_an($roww['fecha'])."</td>
		  
		  <td class='cualquierotroestilo' width='190'  align='left' valign='top'>".simbolos($roww['cliente'].$roww['empresa'])."</div></td>
		   <td class='cualquierotroestilo' width='178'  align='left' valign='top'>".$roww['tip_lib']."</td>
		    <td class='cualquierotroestilo' width='68'  align='left' valign='top'>".$roww['n_lib']."</td>
			<td class='cualquierotroestilo' width='68' align='center' valign='top'>".$roww['folio']."</td>
			<td class='cualquierotroestilo' width='68' align='center' valign='top'>".$roww['tip_fol']."</td>
		  <td class='cualquierotroestilo' width='90'  align='left' valign='top'>".$roww['ruc']."</td>
		 
		  
	
			
 	</tr>";}?>
</table>
</body>
</html>

<?php
}else{
	echo "<script>window.location='../indicecrolibros.php'</script>";	
}
?>