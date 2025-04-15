<?php 

include('../../conexion.php');
include('../../extraprotocolares/view/funciones.php');
include('../../facturacion/consultas/comprobante.php');

$id=$_GET['id_regventas'];

function actual_date()  
{  
    $week_days = array ("Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado");  
    $months = array ("", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");  
    $year_now = date ("Y");  
    $month_now = date ("n");  
    $day_now = date ("j");  
    $week_day_now = date ("w");  
    $date = $day_now . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $months[$month_now] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $year_now;   
    return $date;    
} 

function actual_date_simple()  
{  
    
    $year_now = date ("Y");  
    $month_now = date ("n");  
    $day_now = date ("j");  
    
    $date = $day_now . "/" . $month_now . "/" . $year_now;   
    return $date;    
} 



							
$arrHeaderSale = dame_comprobante($id);



	$id_pago=$arr_regventa[10];
	$id_bol=$arr_regventa[1];
	
$arr_documentos = dame_documentos();
$arr_comprobantes = dame_comprobantes($id_bol);
$arr_tipospagos = dame_tipopagos($id_pago);
$arr_servicios = dame_servicios();
$arr_usuarios = dame_usuarios();
$arrDetailsSale = dame_dregventas($id);





$contadorX=strlen($arr_regventa[6]);
$contador=$contadorX*2;



	$acu="&nbsp;";
	$ini=50;
	$arr=$ini-$contador;
	
for($i=1;$i<=$arr;$i++){
	
	$acu=$acu."&nbsp;";
}

$nombre=$arr_regventa[6].$acu;

$maxItems = 10;
$rowEmpty =  $maxItems - count($arrHeaderSale);

?>

<html>
<head>
	<title></title>
	<style type="text/css">
	body{
		font-size:11px;
		font-family:arial;
	}
	</style>
</head>
<body>

<div style="margin-left:74px;margin-top:164px;margin-right:50px;">

	<table width="1000" border="0">
		<tr>
			<td width="722" colspan="4" height="32">
			
			</td>
			
			<td colspan="3"><?php echo $arrHeaderSale[0]['numeroComprobante']; ?></td>
		</tr>
		<tr>
			<td width="100" height="10">
			</td>
			<td width="572" height="10" colspan="2">
			</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td width="100">
				
			</td>
			<td width="572" height="32" colspan="2">
				<?php echo $arrHeaderSale[0]['cliente']; ?>
			</td>
			<td width="50"></td>
			<td width="50"><?php echo date('d'); ?></td>
			<td width="50"><?php echo date('m'); ?></td>
			<td width="50"><?php echo substr(date('Y'),2,4); ?></td>
		</tr>
		<tr>
			<td width="100">
				
			</td>
			<td colspan="2" width="572" height="32">
			
			</td>
			<td width="50" colspan="4"><?php echo $arrHeaderSale[0]['numeroDocumentoCliente']; ?></td>
		
		</tr>
		<tr>
			<td width="100" height="32"><!--Cant.--></td>
			<td width="560"><!--Descripcion--></td>
			<td width="62" colspan="2"><!--P.Uni--></td>
			<td colspan="3" ><!--Importe--></td>
		</tr>
		<?php foreach ($arrDetailsSale as   $row) { ?>
			<tr>
				<td width="100" height="32"><?php echo (int)$row['cantidad'];?></td>
				<td width="560" ><?php echo $row['detalle'];?></td>
				<td width="62" colspan="2"><?php  echo number_format($row['precio'], 2, ',', ' ');?></td>
				<td colspan="3" ><?php echo number_format($row['total'], 2, ',', ' '); ?></td>
			</tr>
		<?php } 
			for($i = 1;$i<=$rowEmpty;$i++){
		?>
			<tr>
				<td width="100" height="32"><!--Cant.--></td>
				<td width="560"><!--Descripcion--></td>
				<td width="62" colspan="2"><!--P.Uni--></td>
				<td colspan="3" ><!--Importe--></td>
			</tr>	
		<?php }?>

		<tr>
			<td width="100" height="32"><!--Cant.--></td>
			<td width="560"><!--Descripcion--></td>
			<td width="62" colspan="2"><!--P.Uni--></td>
			<td colspan="3" ><?php echo number_format($arrHeaderSale[0]['importeTotal'], 2, ',', ' '); ?></td>
		</tr>
	</table>

</div>





</body>
</html>