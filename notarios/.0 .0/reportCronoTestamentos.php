<?php

$fechade = $_POST['fechade'];
$fecha=explode("/",$fechade);
$desde=$fecha[2]."-".$fecha[1]."-".$fecha[0];

$fechaa  = $_POST['fechaa'];
$fecha2=explode("/",$fechaa);
$hasta=$fecha2[2]."-".$fecha2[1]."-".$fecha2[0];

if($_POST['fechade']!="" or $_POST['fechaa']!="") {
	
include("../conexion.php");
include('../extraprotocolares/view/funciones.php');

//Exportar datos de php a Excel
header("Content-Description: File Transfer");  
header("Content-Type: application/force-download"); 
header("Content-Disposition: attachment; filename=IC_TTOS.doc");

$consulta = mysql_query("SELECT *, CAST(numescritura AS SIGNED) AS numescritura2 FROM kardex WHERE idtipkar='5' and nc=0 and fechaescritura <> '' 
					   AND STR_TO_DATE(fechaescritura,'%Y-%m-%d') >= STR_TO_DATE('".$desde."','%Y-%m-%d') 
					   AND STR_TO_DATE(fechaescritura,'%Y-%m-%d') <= STR_TO_DATE('".$hasta."','%Y-%m-%d') order by fechaescritura, numescritura2, numminuta asc", $conn) or die(mysql_error());
$paginador=2;

$confinotario=mysql_query("SELECT nombre,apellido FROM confinotario",$conn);
$resnotario=mysql_fetch_assoc($confinotario);
$nombrenotario=$resnotario['nombre']." ".$resnotario['apellido'];				   
?>
<HTML LANG="es">
<TITLE>::. Exportacion de Datos .::</TITLE>
<style>
.Estilo12{
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
	<td align="left" width="300"><b><span><font size="-3">INDICE CRONOLOGICO DE TESTAMENTOS</font></span></b></td>
    <td align="right" width="300"><b><span>del <?php echo "del $desde al $hasta"; ?></span></b></td>
</tr>
</table>
<hr/>
<table width="650" bordercolor="#333333"  BORDER="0" align="center" CELLPADDING="0" CELLSPACING="0">       
		<tr class="titulos">   
        
                <TH  width='60' style="font-size:11px" align="left" ><span class=''>Fech. Inst.</span></TH >
                      <TH  width='85' style="font-size:11px" align="left"><span class=''>Nro 
           Inst</span></div></TH >
                     <Td  width='224' style="font-size:11px" align="left"><b><span class=''>Contratantes</span></b></Td >
                     <TH  width='66' style="font-size:11px" align="center"><span class=''>Contrato</span></TH >
                     <TH  width='47' style="font-size:11px"><span class=''>Minuta</span></TH>
                     <TH  width='36' style="font-size:11px"><span class=''>Folio</span></TH>
                      <TH  width='61' style="font-size:11px" align="center"><span class=''>Serie</span></TH >
                       <TH width='71' style="font-size:11px" align="center"><span class=''>Kardex</span></TH >
                       
            </tr> 
</TABLE>            
<hr />
<table width="650" bordercolor="#333333"  BORDER="0" align="center">  
<?php

while($row = mysql_fetch_array($consulta)){
	
	$arr_vehicular[$i][0] = $row["fechaescritura"]; 
	$arr_vehicular[$i][1] = $row["kardex"]; 
	$arr_vehicular[$i][2] = $row["contrato"]; 
	$arr_vehicular[$i][3] = $row["numescritura"]; 
	$arr_vehicular[$i][4] = $row["numminuta"]; 
	$arr_vehicular[$i][5] = $row["folioini"]; 
	$i++; 
}

for($j=0; $j<count($arr_vehicular); $j++) { 
echo "<tr>
			<td width='73' valign='top' align='center'><span class='Estilo12'>".fechabd_an($arr_vehicular[$j][0])."</span></td>
			<td width='50' valign='top' align='center'><span class='Estilo12'>".$arr_vehicular[$j][1]."</span></td>
			<td width='400' valign='top' align='left'><span class='Estilo12'>"; 
			
			$id_kardex = $arr_vehicular[$j][1];
			$consulta_clientes = "SELECT
							  CONCAT(cliente2.prinom,' ',cliente2.segnom,' ',cliente2.apepat,' ',cliente2.apemat) as nombre,
							  kardex.kardex,
							  contratantes.idcontratante,
							  cliente2.razonsocial as empresa
							  FROM
							  contratantes
							  INNER JOIN cliente2 ON cliente2.idcontratante = contratantes.idcontratante
							  INNER JOIN kardex ON contratantes.kardex = kardex.kardex
							  WHERE
							  contratantes.kardex = '$id_kardex'";

		$ejecuta_clientes= mysql_query($consulta_clientes, $conn);
			while($rowcliente=mysql_fetch_array($ejecuta_clientes)){
			 echo simbolos(strtoupper($rowcliente['nombre'].$rowcliente['empresa']))."<br>";
			}
			echo"</span></td>
			<td width='50' valign='top' align='center'><span class='Estilo12'>".strtoupper($arr_vehicular[$j][2])."</span></td>
			<td width='50' valign='top' align='center'><span class='Estilo12'>".strtoupper($arr_vehicular[$j][4])."</span></td>
			<td width='50' valign='top' align='center'><span class='Estilo12'>".strtoupper($arr_vehicular[$j][5])."</span></td>
			<td width='91' valign='top' align='center'><span class='Estilo12'>xxxxxxxx</span></td>
			<td width='84' valign='top' align='center'><span class='Estilo12'>".$arr_vehicular[$j][1]."</span></td>
 	</tr>";

}?>
</table>
</body>
</html>

<?php
}else{
	echo "<script>window.location='../indicecrotestamentos.php'</script>";	
}
?>