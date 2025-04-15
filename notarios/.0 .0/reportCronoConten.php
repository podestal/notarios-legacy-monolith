
<?php
include("../conexion.php");
include("../extraprotocolares/view/funciones.php");	

$desde = $_POST['fechade'];
$hasta = $_POST['fechaa'];

$desde = fechan_abd($desde);
$hasta = fechan_abd($hasta);

if($_POST['fechade']!="" or $_POST['fechaa']!="") {
	
	//Exportar datos de php a Excel
	//header("Content-Description: File Transfer");  
	//header("Content-Type: application/force-download"); 
	//header("Content-Disposition: attachment; filename=IC_EP.xlsx");

	header("Content-Type: application/vnd.ms-excel");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("content-disposition: attachment;filename=IC_EP.xls");
	$sql = "SELECT 
			UPPER(K.contrato) AS contrato
			,CAST(K.numescritura AS SIGNED) AS numescritura2 
			,K.fechaescritura
			,K.kardex
			,K.numescritura
			,K.numminuta
			,K.folioini
			,K.foliofin
			,(SELECT SUM(importemp) FROM detallemediopago WHERE kardex = K.kardex ) AS importe
			,K.papelini
			,K.papelfin
			FROM kardex K 
			WHERE 
			K.idtipkar='2' 
			AND (K.fechaescritura BETWEEN '$desde' AND '$hasta') ";

	$result = mysql_query($sql, $conn);
	$arrData = Array();
	while ($row = mysql_fetch_assoc($result)) 
		$arrData[] = $row;

	//$contador=mysql_num_rows($consulta); 
	$confinotario=mysql_query("SELECT nombre,apellido FROM confinotario",$conn);
	$resnotario=mysql_fetch_assoc($confinotario);
	$nombrenotario=$resnotario['nombre']." ".$resnotario['apellido'];	  
?>
<style type="text/css">
	.cabecera{
		color: #FFF;
		background: #083E69;
		font-size: 16px;
	}

	.cabecera2{
		color: #FFF;
		background: #083E69;
		font-size: 14px;
	}
</style>

	<table bordercolor="#585858"  BORDER="1">
		<thead>
			<tr>
				<th class="cabecera" colspan="12"><b>NOTARIA: <?php echo $nombrenotario;?></b></th>
			</tr>
			<tr>
				<th class="cabecera" colspan="12"><b>INDICE CRONOL&Oacute;GICO DE ASUNTOS NO CONTENCIOSOS</b></th>
			</tr>
			<tr>
				<th class="cabecera" colspan="12"><b>DESDE:&nbsp;<?php echo $desde;?> - HASTA:&nbsp;<?php echo $hasta;?> </b></th>
			</tr>
			<tr>
				<th width="85" class="cabecera2">Kardex</th>
				<th width="75" class="cabecera2">Nro. Instr</th>
				<th width="75" class="cabecera2">Nro. Minuta</th>
				<th width="80" class="cabecera2">Fec. Instr</th>
				<th width="300" class="cabecera2">Contratantes</th>
				<th width="120" class="cabecera2">Condici&oacute;n</th>
				<th width="180" class="cabecera2">Acto Juridico</th>
				<th width="120" class="cabecera2">Importe</th>
				<th width="100" class="cabecera2">Folio Inicial</th>
				<th width="100" class="cabecera2">Folio final</th>
				<th width="150" class="cabecera2">Nro. Papel notarial inicial</th>
				<th width="150" class="cabecera2">Nro. Papel notarial final</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($arrData as $row) { 
				$id_kardex = $row['kardex'];
				$sqlContra = "SELECT
							
						 UPPER((CASE WHEN (C2.tipper='N') THEN CONCAT(C2.apepat,' ',C2.apemat,' ',C2.prinom,' ',C2.segnom) ELSE C2.razonsocial END)) AS nombre
						,AC.condicion
						FROM contratantes C
						LEFT JOIN cliente2 C2 ON C2.idcontratante = C.idcontratante
						LEFT JOIN contratantesxacto CA ON CA.idcontratante = C2.idcontratante
						LEFT JOIN actocondicion AC ON AC.idcondicion = CA.idcondicion
						WHERE C.kardex = '$id_kardex'";

				$result = mysql_query($sqlContra, $conn);
				$result2 = mysql_query($sqlContra, $conn);
			?>
			<tr>
				<td align="center" valign="top"><?php echo $row['kardex'];?></td>
				<td align="center" valign="top"><?php echo $row['numescritura'];?></td>
				<td align="center" valign="top"><?php echo $row['numminuta'];?></td>
				<td align="center" valign="top"><?php echo $row['fechaescritura'];?></td>

				<td valign="top"><?php while ($rowCont = mysql_fetch_assoc($result)) 
								echo utf8_decode($rowCont['nombre']).'<br>';											 		
				 	?>				 	
				</td>
				<td valign="top"><?php while ($rowCond = mysql_fetch_assoc($result2)) 
								echo $rowCond['condicion'].'<br>';											 		
				 	?>				 	
				</td>
				<td align="center" valign="top"><?php echo $row['contrato'];?></td>
				<td align="right" valign="top"><?php echo $row['importe'];?></td>
				<td align="center" valign="top"><?php echo $row['folioini'];?></td>
				<td align="center" valign="top"><?php echo $row['foliofin'];?></td>
				<td align="center" valign="top"><?php echo $row['papelini'];?></td>
				<td align="center" valign="top"><?php echo $row['papelfin'];?></td>

			</tr>
			<?php } ?>
		</tbody>
	</table>

<?php
}else{
	echo "<script>window.location='../indicecronoconten.php'</script>";	
}
?>