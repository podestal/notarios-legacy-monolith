<?php

include('../../conexion.php');
include('../../extraprotocolares/view/funciones.php');


$fechade = $_POST['fechade'];
$fecha=explode("/",$fechade);
$desde=$fecha[2]."-".$fecha[1]."-".$fecha[0];

$fechaa  = $_POST['fechaa'];
$fecha2=explode("/",$fechaa);
$hasta=$fecha2[2]."-".$fecha2[1]."-".$fecha2[0];


function obtenerFechaEnLetra($fecha){
    $dia= conocerDiaSemanaFecha($fecha);
    $num = date("j", strtotime($fecha));
    $anno = date("Y", strtotime($fecha));
    $mes = array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
    $mes = $mes[(date('m', strtotime($fecha))*1)-1];
    return $dia.', '.$num.' de '.$mes.' del '.$anno;
}
function conocerDiaSemanaFecha($fecha) {
    $dias = array('Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sabado');
    $dia = $dias[date('w', strtotime($fecha))];
    return $dia;
}


if($_POST['fechade']!="" or $_POST['fechaa']!="") {
	
	$tipoDocumento = $_POST['enviarrr'];
	$extension = '';
	if($tipoDocumento == 'EXCEL'){
		$extension = 'xls';
	}else if($tipoDocumento == 'WORD'){
		$extension = 'doc';
	}

	header("Content-Description: File Transfer");  
	header("Content-Type: application/force-download"); 
	header("Content-Disposition: attachment; filename=INDICE_ALFABETICO_TESTAMENTOS_".$fecha2[2].".".$extension);
//Exportar datos de php a Excel

/*$consulta = mysql_query("SELECT *, CAST(numescritura AS SIGNED) AS numescritura2 FROM kardex WHERE idtipkar='2' and nc=0 and fechaescritura <> '' 
					   AND STR_TO_DATE(fechaescritura,'%Y-%m-%d') >= STR_TO_DATE('$desde','%Y-%m-%d') 
					   AND STR_TO_DATE(fechaescritura,'%Y-%m-%d') <= STR_TO_DATE('$hasta','%Y-%m-%d') order by fechaescritura, numescritura2, numminuta asc", $conn) or die(mysql_error());*/

$consulta = mysql_query("SELECT 
						GROUP_CONCAT(UPPER((CASE WHEN (c2.tipper='N') THEN 
						CONCAT(ac.condicion,': ',c2.apepat,' ',c2.apemat,' ',c2.prinom,' ',c2.segnom) 
						ELSE c2.razonsocial END)) SEPARATOR ',,') AS 'cliente',
						GROUP_CONCAT(UPPER((CASE WHEN (c2.tipper='N') THEN 
						CONCAT(c2.apepat,' ',c2.apemat,' ',c2.prinom,' ',c2.segnom) 
						ELSE c2.razonsocial END)) SEPARATOR ',,') AS 'cliente2',
						k.idkardex,
						cxa.idcontratante,
						UPPER(c2.razonsocial) AS empresa,
						ac.condicion,
						k.fechaescritura, 
						k.kardex,
						k.contrato, 
						k.numescritura, 
						k.numminuta, 
						k.folioini
					FROM contratantesxacto AS cxa
					LEFT JOIN actocondicion AS ac ON ac.idcondicion = cxa.idcondicion
					LEFT JOIN kardex AS k ON k.kardex = cxa.kardex
					LEFT JOIN contratantes AS con ON con.idcontratante=cxa.idcontratante
					LEFT JOIN cliente2 AS c2 ON c2.idcontratante=con.idcontratante
				   WHERE k.idtipkar='5' and nc=0
				   AND STR_TO_DATE(k.fechaescritura,'%Y-%m-%d') >= STR_TO_DATE('$desde','%Y-%m-%d') 
				   AND STR_TO_DATE(k.fechaescritura,'%Y-%m-%d') <= STR_TO_DATE('$hasta','%Y-%m-%d') GROUP BY k.idkardex
				   ORDER BY cliente2 ASC", $conn) or die(mysql_error());
	
	
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
table{
	font-family:Arial;
	font-size: 13.5px;
	width:100%;
	border-collapse:collapse;
}
</style>
</head>
<body>

<table width='1000' border='0' cellpadding='0' cellspacing='0'>
<tr>
	<td colspan="6" align="center" style="font-size:18.5px"><b>INDICE ALFABETICO - TESTAMENTOS</b></td>
	
</tr>
<tr>
	<td colspan="6" align="center" style="font-size:18.5px"><b><?php echo utf8_decode('AÑO ').$fecha2[2];?></b></td>
</tr>
<!-- <tr><td>&nbsp;</td></tr> -->
<tr><td>&nbsp;</td></tr>
<tr>
	<td colspan="2" align="left"><b><span>NOTARIA</span></b></td>
	<td align="left"><span>: <?php echo $nombrenotario;?></span></td>
	<td></td>
	<td colspan="2"></td>
</tr>
<tr>
	<td colspan="2" align="left"><b><span>DIRECCION</span></b></td>
	<td align="left"><span>: JR. BOLIVAR NRO. 340</span></td>
	<td align="right"><b>TELEFONO</b></td>
	<td colspan="2">: (051) 326609</td>
</tr>
<tr>
	<td colspan="2" align="left"><b><span>DEPARTAMENTO</span></b></td>
	<td align="left"><span>: PUNO</span></td>
	<td align="right"><b>RUC</b></td>
	<td colspan="2">: 10024231572</td>
</tr>
<tr>
	<td colspan="2" align="left"><b><span>PROVINCIA</span></b></td>
	<td align="left"><span>: SAN ROMAN</span></td>
	<td align="right"><b><span>DESDE </span></b></td>
	<td colspan="2" align="left"><span>: <?php echo strtoupper(obtenerFechaEnLetra($desde));?></span></td>
</tr>
<tr>
	<td colspan="2" align="left"><b><span>DISTRITO</span></b></td>
	<td align="left"><span>: JULIACA</span></td>
	<td align="right"><b><span>HASTA</span></b></td>
	<td colspan="2" align="left"><span>: <?php echo strtoupper(obtenerFechaEnLetra($hasta)); ?></span></td>
</tr>
</table>
<br>
<table width="1000" bordercolor="#333333"  BORDER="1" align="center" CELLPADDING="0" CELLSPACING="0">       
		<tr class="titulos">   
         <td width='40'  align="center" style="font-size:12px"><span class=''><B><?php echo utf8_decode('N° ESC.');?></B></span></td>
          <td width='70'  align="center" style="font-size:12px"><span class=''><B>FECHA</B></span></td>
              <td width='150' align="center" style="font-size:12px"><span class=''><B>TESTADOR</B></span></td>
              <td width='150' align="center" style="font-size:12px"><span class=''><B>A FAVOR</B></span></td>
              <td width='150' align="center" style="font-size:12px"><span class=''><B>ACTO</B></span></td>
               <td width='40' align="center" style="font-size:12px"><span class=''><B>FOJA</B></span></td>

                         
            </tr> 
          
  



<?php
$i=1;
while($row = mysql_fetch_array($consulta)){
	
	$kardex=$row['kardex'];
	
	$sql1=mysql_query("SELECT cliente2.nombre FROM contratantesxacto 
INNER JOIN cliente2 ON cliente2.`idcontratante`= contratantesxacto.`idcontratante`
INNER JOIN `actocondicion` ON contratantesxacto.`idcondicion`= actocondicion.`idcondicion`
WHERE (contratantesxacto.kardex='$kardex' AND actocondicion.`condicion` LIKE '%TESTADOR%' )
OR  (contratantesxacto.kardex='$kardex' AND actocondicion.`condicion` LIKE '%OTORGANTE%' )",$conn);

$sql2=mysql_query("SELECT cliente2.nombre FROM contratantesxacto 
INNER JOIN cliente2 ON cliente2.`idcontratante`= contratantesxacto.`idcontratante`
INNER JOIN `actocondicion` ON contratantesxacto.`idcondicion`= actocondicion.`idcondicion`
WHERE (contratantesxacto.kardex='$kardex' AND actocondicion.`condicion` LIKE '%BENEFICIARIO%' )
OR  (contratantesxacto.kardex='$kardex' AND actocondicion.`condicion` LIKE '%OTORGADO%' )",$conn);

$conteo1=mysql_num_rows($sql1);
$conteo2=mysql_num_rows($sql2);

	$sql1x=mysql_query("SELECT cliente2.nombre FROM contratantesxacto 
INNER JOIN cliente2 ON cliente2.`idcontratante`= contratantesxacto.`idcontratante`
INNER JOIN `actocondicion` ON contratantesxacto.`idcondicion`= actocondicion.`idcondicion`
WHERE (contratantesxacto.kardex='$kardex' AND actocondicion.`condicion` LIKE '%TESTADOR%' )
OR  (contratantesxacto.kardex='$kardex' AND actocondicion.`condicion` LIKE '%OTORGANTE%' )",$conn);

$sql2x=mysql_query("SELECT cliente2.nombre FROM contratantesxacto 
INNER JOIN cliente2 ON cliente2.`idcontratante`= contratantesxacto.`idcontratante`
INNER JOIN `actocondicion` ON contratantesxacto.`idcondicion`= actocondicion.`idcondicion`
WHERE (contratantesxacto.kardex='$kardex' AND actocondicion.`condicion` LIKE '%BENEFICIARIO%' )
OR  (contratantesxacto.kardex='$kardex' AND actocondicion.`condicion` LIKE '%OTORGADO%' )",$conn);

$conteo1x=mysql_num_rows($sql1x);
$conteo2x=mysql_num_rows($sql2x);


		if($row['numminuta']==""){
		$minuta="S/M";
	}else{
		$minuta=$row['numminuta'];
	}

echo"<TR>	
<TD width='40  align='center' valign='top'><span style='font-size:12px;'>".$row['numescritura']."</span></TD>

<TD  width='70' align='center'  valign='top'><span style='font-size:12px;'>"; $time=explode("-",$row['fechaescritura']); echo $time[2] . "/" . $time[1] . "/" . $time[0]; 
	 echo"</span></TD>
	 
	 
	 
	 
	 
	 
	 <TD align='left' width='235' valign='top'><span style='font-size:12px;'>"; 
	 if($conteo1>0 && $conteo2==0){
while($fila1=mysql_fetch_assoc($sql1)){
	echo str_replace(',,','<br>',strtoupper(utf8_decode($fila1['nombre'])));  
	   echo "<br>"; }
	 }else if($conteo2>0 && $conteo1==0){
while($fila2=mysql_fetch_assoc($sql2)){
	echo str_replace(',,','<br>',strtoupper(utf8_decode($fila2['nombre'])));  
	   echo "<br>"; }
	 }else if($conteo1>0 && $conteo2>0){
	while($fila1=mysql_fetch_assoc($sql1)){
	echo str_replace(',,','<br>',strtoupper(utf8_decode($fila1['nombre'])));  
	   echo "<br>"; }	 
		 
	 }
	echo"</span></td>
	
	
	<TD align='left' width='235' valign='top'><span style='font-size:12px;'>"; 
	 if($conteo1x>0 && $conteo2x==0){
while($fila1x=mysql_fetch_assoc($sql1x)){
	echo str_replace(',,','<br>',strtoupper(utf8_decode($fila1x['nombre'])));  
	   echo "<br>"; }
	 }else if($conteo2x>0 && $conteo1x==0){
while($fila2x=mysql_fetch_assoc($sql2x)){
	echo str_replace(',,','<br>',strtoupper(utf8_decode($fila2x['nombre'])));  
	   echo "<br>"; }
	 }else if($conteo1x>0 && $conteo2x>0){
	while($fila2x=mysql_fetch_assoc($sql2x)){
	echo str_replace(',,','<br>',strtoupper(utf8_decode($fila2x['nombre'])));  
	   echo "<br>"; }	 
		  
	 }
	echo"</span></td>
	 
	  
	 <TD width='150'  align='left' valign='top'><span style='font-size:12px;'>".str_replace('/','',strtoupper($row['contrato']))."</span></TD>
	
    <TD  width='40 align='center' valign='top'><span style='font-size:12px;'>".$row['folioini']."</span></TD>
	
	
    

   
  </TR>
";
	$i++;
	}
	
	?>
</table>
</body>
</html>

<?php
}else{
	echo "<script>window.location='../indicecrotestamentosalfa.php'</script>";
}
?>