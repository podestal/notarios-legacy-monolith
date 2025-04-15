
<?php 

include('../../conexion.php');
include('../../extraprotocolares/view/funciones.php');

$fechade = $_REQUEST['fechade'];
$fechaa  = $_REQUEST['fechaa'];

$desde = fechan_abd($fechade);
$hasta = fechan_abd($fechaa); 

$conexion = Conectar();
if($_POST['fechade']!="" or $_POST['fechaa']!="") {	

//Exportar datos de php a Excel
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=Reporte_Alfa_conten.xls");

$sql = "SELECT 
		   	UPPER((CASE WHEN (C2.tipper='N') THEN CONCAT(C2.apepat,' ',C2.apemat,' ',C2.prinom,' ',C2.segnom) ELSE C2.razonsocial END)) AS cliente
        	,K.fechaescritura
	      	,K.kardex
	      	,K.numescritura
	        ,K.numminuta
	        ,K.folioini
	        ,K.foliofin
	        ,(SELECT SUM(importemp) FROM detallemediopago WHERE kardex = K.kardex ) AS importe
	        ,K.papelini
	        ,K.papelfin
	        ,AC.condicion
	        ,UPPER(K.contrato) AS contrato
	        FROM kardex K
	        INNER JOIN contratantes C ON C.kardex = K.kardex AND C.indice='1'
	        INNER  JOIN cliente2 C2 ON C2.idcontratante = C.idcontratante
	        LEFT JOIN contratantesxacto CA ON CA.idcontratante = C2.idcontratante
	        LEFT JOIN actocondicion AC ON AC.idcondicion = CA.idcondicion

		    WHERE K.idtipkar='2' and nc=0
		    AND (K.fechaescritura BETWEEN '$desde' AND '$hasta')
		    ORDER BY cliente ASC ";
$result = mysql_query($sql,$conn);

$paginador=2;	

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
			<th class="cabecera" colspan="12"><b>INDICE ALFAB&Eacute;TICO DE ASUNTOS NO CONTENCIOSOS</b></th>
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
		<?php while($row = mysql_fetch_array($result)){ ?>
			<tr>
		        <td align="center"><span valign='top' class='Estilo12'><?php echo $row['kardex'];?></span></td>
		        <td align="center"><span valign='top' class='Estilo12'><?php echo $row['numescritura'];?></span></td>
		        <td align="center"><span valign='top' class='Estilo12'><?php echo $row['numminuta'];?></span></td>
		        <td><span valign='top' class='Estilo12'><?php echo $row['fechaescritura'];?></span></td>
		        <td><span valign='top' class='Estilo12'><?php echo utf8_decode(strtoupper($row['cliente']));?></span> </td>
		          
		        <td valign='top'><span class='Estilo12'><?php echo strtoupper($row['condicion']);?></span></td>
		        <td><span valign='top' class='Estilo12'><?php echo str_replace('/', '', strtoupper($row['contrato']));?></span></td>
		        <td align="right"><span valign='top' class='Estilo12'><?php echo strtoupper($row['importe']);?></span></td>     
		        <td align="center"><span valign='top' class='Estilo12'><?php echo $row['folioini'];?></span></td>
		        <td align="center"><span valign='top' class='Estilo12'><?php echo $row['foliofin'];?></span></td>
		        <td align="center" valign="top"><?php echo $row['papelini'];?></td>
				<td align="center" valign="top"><?php echo $row['papelfin'];?></td>
		    </tr
		<?php } ?>
	</tbody>
	</table>

<?php
}else{
	echo "<script>window.location='../indicecronocontenalfa.php'</script>";	
}
?>
