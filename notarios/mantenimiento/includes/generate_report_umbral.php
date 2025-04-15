<?php
require_once '../../Cpu/ROClass.php';
$sql = "SELECT  idnotar AS idNotario,nombre AS nombreNotario, apellido AS apellidosNotario,CONCAT(nombre,' ',apellido)AS notario,telefono AS telefonoNotario,correo AS correoNotario, ruc AS rucNotario, direccion AS direccionNotario, distrito  AS distritoNotario, codnotario AS codigoNotario,codoficial AS codigoOficial, coduif AS codigoUif  FROM confinotario";
$result = mysql_query($sql);
$row = mysql_fetch_assoc($result);

$idNotario = $row['idNotario'];
$nombreNotario = $row['nombreNotario'];
$apellidoNotario = $row['apellidosNotario'];
$telefonoNotario = $row['telefonoNotario'];
$rucNotario = $row['rucNotario'];
$direccionNotario = $row['direccionNotario'];
$distritoNotario = $row['distritoNotario'];
$codigoNotario = $row['codigoNotario'];
//$initialDate = '01/01/2015';
//$initialDate = $_GET["initialDate"];
//$finalDate = $_GET["finalDate"];
//$finalDate = '01/12/2015';

/*
$sql = "SELECT  numberMonth,monthExchangeRate,yearMonth FROM exchange_rate ORDER BY numberMonth";
$result = mysql_query($sql);

$array = array();
while($row = mysql_fetch_assoc($result)){
	$row['nameMonth'] = ClaseNumeroLetra::fun_mes($row['numberMonth']);
	$array[] = $row;
}*/
/*
$objRoClass = new RoClass();
$objRoClass->setYear('2016');
$objRoClass->loadDataByYear();
$array =  $objRoClass->generateDataByYearUnderUmbral();
*/
$totalOperations = 0;
$totalAmount = 0.00;
//var_dump($array);
/*
$arrInitialDate  = explode('/', $initialDate);
$initialMonth = (int)($arrInitialDate[1]);
$yearInitial = $arrInitialDate[2];

$arrFinalDate  = explode('/', $finalDate);
$finalMonth = (int)($arrFinalDate[1]);
$finalInitial = $arrFinalDate[2];
$arrMonthsDate = array();
for($i = $initialMonth;$i<=$finalMonth;$i++){
	$arrMonthsDate[$i] = $arrMonth[$i];
}
*/


?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" type="text/css" href="../../Libs/bootstrap/css/bootstrap.min.css">
	<style type="text/css">
		.loading-table{
		    opacity: 0.25;
		    background: url(../../images/market.gif) no-repeat center;
		}

	</style>
</head>
<body>
<div class="container">
		<h2>REGISTRO DE OPERACIONES  BAJO EL UMBRAL</h2>
</div>
<br>
<div class="container">
		<div class="table-responsive" >	
				<table class="table table-bordered table-striped"  id="">
						<tbody>	
							 <tr>
							 	<td width="40%">Nombre de la empresa:</td>
							 	<td><span><?php echo $nombreNotario.' '.$apellidoNotario; ?></span></td>
							 </tr>	
							 <tr>
							 	<td width="40%">RUC</td>
							 	<td><span><?php echo $rucNotario; ?></span></td>
							 </tr>
							 <tr>
							 	<td width="40%">N° de operacion por debajo del umbral</td>
							 	<td><span id="spanTotalOperations"><?php echo $totalOperations; ?></span></td>
							 </tr>
							 <tr>	
							 	<td width="40%">Monto total en dolares de las operaciones por debajo del umbral</td>
							 	<td><span></span><span id="spanTotalAmount"><?php echo number_format($totalAmount,2,'.',' '); ?></span></td>
							</tr>
							
						</tbody>
				</table>
		</div>		
		<table class="table table-hover"  id="table-export-excel" border="1" style="font-family:'Arial Narrow'; font-size:10px;display:none;" bordercolor="#4F81BD" cellpadding="00" cellspacing="0" style="display:none;" id="table-export-excel">
						<tbody>	
							 <tr>
							 	<td width="40%" bgcolor="#376091" ><span style="color:#FFF; font-size:12px">Nombre de la empresa:</span></td>
							 	<td><span><?php echo $nombreNotario.' '.$apellidoNotario; ?></span></td>
							 </tr>	
							 <tr>
							 	<td width="40%" bgcolor="#376091"><span style="color:#FFF; font-size:12px">RUC</span></td>
							 	<td><span><?php echo $rucNotario; ?></span></td>
							 </tr>
							 <tr>
							 	<td width="40%" bgcolor="#376091"><span style="color:#FFF; font-size:12px">N de operacion por debajo del umbral</span></td>
							 	<td><span id="spanHiddenTotalOperations"><?php echo $totalOperations; ?></span></td>
							 </tr>
							 <tr>	
							 	<td width="40%" bgcolor="#376091" ><span style="color:#FFF; font-size:12px">Monto total en dolares de las operaciones por debajo del umbral</span></td>
							 	<td align='right'  style='mso-number-format:\@'><span></span><span id="spanHiddenTotalAmount"><?php number_format($totalAmount,2,'.',' ');  ?></span></td>
							</tr>
							
						</tbody>
		</table>	
		<div class="table-responsive">
			<form id="frm-export-excel" action="report_under_umbral.php" method="post" target="_blank">
				<input type="hidden" id="sendHtmlExcel" name="sendHtmlExcel">
			
				<table  class="table table-hover"  >
					<tbody>
						<tr>
				            <td width="40%">REPORTE EXCEL </td>
				            <td width=""><a id="btn-export-excel" href="javascript:;"> <i class="glyphicon glyphicon-save-file" style="font-size:18px;"></i> DESCARGAR</a></td>

				        </tr>
					</tbody>
				</table>
			</form>
		</div>
		<div class="row">
			<div class="col-sm-4">
				
			</div>
			<div class="col-sm-4">
				<select class="form-control" id="cmbYear">
					<option>Selecione año</option>
					<option>2015</option>
					<option>2016</option>
					<option>2017</option>
				</select>
			</div>
			<div class="col-sm-4">
				
			</div>
		</div>
		<div class="table-responsive">
		
			<table class="table table-hover" id="tblListMonths">
				<thead>	
						<tr>
							<th>Mes</th>
							<th>Tipo de  Cambio</th>
							<th>Total de operaciones</th>
							<th>Monto Total en Dolares</th>
								
						</tr>
				</thead>
				<tbody>
				</tbody>

			</table>
		</div>
		
</div>



<script src="../../Libs/jquery/jquery-3.1.0.min.js" type="text/javascript"></script>
<script src="../../Libs/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script type="text/javascript">
	$("#btn-export-excel").on('click',function(event) {
		
		$("#sendHtmlExcel").val($("<div>").append( $("#table-export-excel").eq(0).clone()).html());
   		$("#frm-export-excel").submit();
	

	});

	$('#cmbYear').on('change',function(){

		vYear = $('#cmbYear').val();
		
		/*$('#msg-success').hide();
		$('#msg-list-kardex').hide();*/
		$.ajax({
           url:'get_under_umbral.php',
           type:'POST',
           data:{year:vYear},
           dataType:'json',
           beforeSend: function()
            {
               $('#tblListMonths').addClass('loading-table');
            },
           success:function(response){
           	$('#tblListMonths  tbody tr').remove();
            $('#tblListMonths').removeClass('loading-table');
            html = '';
            totalOperations = 0;
            totalAmount = 0.00;
           	for(i  in response.data){
           		html = html + '<tr><td>'+response.data[i].nameMonth+'</td>';
           		html = html + '<td>'+response.data[i].monthExchangeRate+'</td>';
           		html = html + '<td>'+response.data[i].totalOperations+'</td>';
           		html = html + '<td>'+parseFloat(response.data[i].totalAmount).toFixed(2)+'</td>';
           		html = html  + '</tr>';
           		totalOperations = totalOperations + response.data[i].totalOperations;
           		totalAmount = totalAmount + response.data[i].totalAmount;
           	}
           	totalAmount = parseFloat(totalAmount).toFixed(2);
           	$('#spanTotalOperations').text(totalOperations);
           	$('#spanTotalAmount').text(totalAmount);
           	$('#spanHiddenTotalOperations').text(totalOperations);
           	$('#spanHiddenTotalAmount').text(totalAmount);
           	$('#tblListMonths  tbody').append(html);
     
           }
       });

	});

</script>
</body>
</html>