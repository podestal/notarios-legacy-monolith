<?php
require_once '../../Cpu/ROClass.php';
include_once('../../includes/ClaseLetras.class.php');
//include_once('../../conexion.php');
$initialDate = $_GET["initialDate"];
$finalDate = $_GET["finalDate"];
//$exchangeRate = $_GET["exchangeRate"];

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



$arrInitialDate = explode('/', $initialDate);
$month = ClaseNumeroLetra::fun_mes($arrInitialDate[1]);
$year = $arrInitialDate[2];
$objRoClass = new RoClass($initialDate,$finalDate);
//$objRoClass->setExchangeRate($exchangeRate);
$objRoClass->loadData();
$objRoClass->generateData();
//$dataUndeUmbral = $objRoClass->generateDataUmbral();
$listErros = $objRoClass->getListErrors();
$countErrors =  $objRoClass->getCountErrors();
$totalKardex = $objRoClass->getTotalKardex();
$dataKardex = $objRoClass->getDataKardex();
$objRoClass->loadDataRoNotUmbral(); 

$i = 1;

$sql = "SELECT ro_not.idKardex, ro_not.kardex,tiposdeacto.desacto, ro_not.idTipoKardex, ro_not.tipoInstumentoPublicoNotarial,ro_not.codActos, ro_not.uif, ro_not.numeroEscritura,ro_not.fechaConclusion, ro_not.tipo,patrimonial.idmon,
patrimonial.tipocambio,patrimonial.importetrans FROM  ro_not LEFT  JOIN  tiposdeacto  ON ro_not.codActos = tiposdeacto.idtipoacto
 LEFT JOIN patrimonial ON ro_not.kardex = patrimonial.kardex AND ro_not.codActos = patrimonial.idtipoacto";
$resultKardexNotRo = mysql_query($sql);
$totalKardexNotRo = mysql_affected_rows();



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

<div class="container"><h2>REGISTRO DE OPERACIONES - UIF</h2></div>
<div class="container">
	<ul class="nav nav-tabs">
		<li class="active">
    		<a class="nav-link" data-toggle="tab" href="#on-umbral" role="tab">REPORTE RO - UIF</a>
  		</li>
		<!--<li class="nav-item">
    			<a class="nav-link" id="btnReportUnderUmbral" data-toggle="tab" href="#on-under" role="tab">POR DEBAJO-UMBRAL</a>
  		</li>-->
	</ul>
	<div class="tab-content">
		<div class="tab-pane active" id="on-umbral">
		<br>
				<div class="table-responsive">
						<table class="table table-bordered table-striped" >
						    <tbody>
						        <tr>
						            <td width="35%">MES</td>
						            <td width="65%"><?php echo  $month.' - '.$year; ?></td>
						        </tr>
						        <tr>
						            <td width="35%">FECHA:</td>
						            <td width="65%"><?php echo $initialDate; ?> A <?php echo $finalDate; ?> 
							            <input type="hidden" id="txtInitialDate" name="initialDate" value="<?php echo $initialDate; ?>">
							            <input type="hidden" id="txtFinalDate" name="finalDate" value="<?php echo $finalDate; ?>">
						            </td>

						        </tr>
						        <tr>
						            <td width="35%">CANTIDAD DE KARDEX</td>
						            <td width="65%"><?php  echo  $totalKardex;?></td>
						        </tr>
						        <tr>
						            <td width="35%">ARCHIVO PLANO </td>
						            <td width="65%"><a href="generate_ro.php?initialDate=<?php echo $initialDate; ?>&finalDate=<?php echo $finalDate; ?>"> <i class="glyphicon glyphicon-save-file" style="font-size:18px;"></i> DESCARGAR</a></td>
						        </tr>
						        <tr>
						            <td width="35%">ARCHIVO EXCEL </td>
						            <td width="65%"><a target="_blank"  href="excel_ro.php?initialDate=<?php echo $initialDate; ?>&finalDate=<?php echo $finalDate; ?>"> <i class="glyphicon glyphicon-eye-open" style="font-size:18px;"></i> VER</a></td>
						        </tr>
						       <!-- <tr>
						            <td width="35%">TIPO DE CAMBIO </td>
						            <td width="65%"></td>
						        </tr>-->
						     </tbody>
						</table>
				</div>
		</div>
		<div class="tab-pane" id="on-under">
			<br>
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
							 	<td><span></span><?php echo $objRoClass->getTotalKardexUmbral(); ?></td>
							 </tr>
							 <tr>	
							 	<td width="40%">Monto total en dolares de las operaciones por debajo del umbral</td>
							 	<td><span></span><span><?php echo $objRoClass->getTotalAmountOperationUmbral(); ?></span></td>
							</tr>
							
						</tbody>
				</table>
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
							 	<td><span></span><?php echo $objRoClass->getTotalKardexUmbral(); ?></td>
							 </tr>
							 <tr>	
							 	<td width="40%" bgcolor="#376091" ><span style="color:#FFF; font-size:12px">Monto total en dolares de las operaciones por debajo del umbral</span></td>
							 	<td align='right'  style='mso-number-format:\@'><span></span><span><?php echo $objRoClass->getTotalAmountOperationUmbral(); ?></span></td>
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
					
			</div>
		</div>
	</div>

	


</div>

<div id="exTab2" class="container">	
	
			<ul class="nav nav-tabs">
			  <li class="active"><a data-toggle="tab" href="#home">Lista de Errores</a></li>
			  <li><a data-toggle="tab" href="#menu1">Lista de Kardex(RO)</a></li>
			  <li><a data-toggle="tab" href="#menu3">Lista de kardex que no envìan(<?php echo  $totalKardexNotRo;?>)</a></li>
			 
			</ul>

			<div class="tab-content">
				  <div id="home" class="tab-pane fade in active">
				  	<br>
				    <div class="row">
						<div class="col-sm-3">
							<button id="btnUpdateListErrors"  class="btn btn-primary" data-toggle="tab"> <i class="glyphicon glyphicon-refresh"></i> 
					        	LISTA DE ERRORES (<span id="total-errors"><?php  echo $countErrors; ?></span>)</button>
						</div>
						<div class="col-sm-6">
							
						</div>
						<div class="col-sm-3">
							<label>TODOS</label>&nbsp;&nbsp;
							<input id="chkAllCorrectErrors" type="checkbox" name="">&nbsp;&nbsp;
							<button id="btn-correct-errors" disabled="" class="btn btn-success">(<span id="totalCorrectErrors">0</span>) <i class="glyphicon glyphicon-ok"></i> Subsanar</button>
						</div>
					</div>
	        	


			

				 	<div class="table-responsive">
				 		<table id="tblListErrors" class="table table-hover">
						 	<thead>
							    <tr>
							      <th width="10%"></th>
							      <th width="10%">KARDEX</th>
							      <th width="25%">ACTO</th>
							    
							      <th>DESCRIPCIÓN DEL ERROR</th>
							     <!-- <th>Validar</th>-->
							    </tr>
						 	</thead>
				  			<tbody>
							  	<?php foreach ($listErros as $key => $row) {?>
									<?php foreach ($listErros[$key] as $objItemRo) { 
										$disabled = $objItemRo->isCorrectable() == 0?'disabled':''; ?>
										 <tr id="error_<?php echo $i; ?>" onmouseover="verUsuario('<?php echo $objItemRo->getKardex(); ?>','<?php echo $i; ?>')">
									       <td><input <?php echo $disabled; ?> class="correct-error-uif" data-id="<?php echo  $i; ?>" data-idcontractor="<?php echo  $objItemRo->getIdContractor(); ?>" data-typeofcorrection="<?php echo $objItemRo->getTypeOfCorrection(); ?>" data-categorycorrect="<?php echo  $objItemRo->getCategoryCorrect(); ?>" data-iscorrectable="<?php echo  $objItemRo->isCorrectable(); ?>"  type="checkbox" >
									      <th><a target="_blank"  href="../../verkardex.php?kardex=<?php  echo $objItemRo->getKardex();?>&id=<?php echo $objItemRo->getIdKardex(); ?>"><?php echo $objItemRo->getKardex(); ?></a></th>
									      <td><?php echo $objItemRo->getAct(); ?></td>
									     
									      <td>
									      	<?php if($objItemRo->getRowType() == 2){ ?>
									      	<span style="color:#337ab7;"><?php echo  $objItemRo->getDetailsError();?></span>  <span><?php echo $objItemRo->getDescriptionElement(); ?></span>
									      	<?php }else {?>
		                                      <?php echo $objItemRo->getDescriptionElement(); ?> 
		                                      <?php 
		                                      	 $items = explode(',',$objItemRo->getDetailsError());
		                                      	 foreach ($items as $key => $value) {
		                                      ?>
		                                      <ul>
		                                      	 <li><?php  echo $value;?></li>
		                                      </ul>
		                                      <?php }?>
									      	<?php }?>
									      </td>
									     

							    		</tr>
									<?php
										$i++;
									 	} 
									 ?>
								
								 <?php }?>
				    
				  			</tbody>
						</table>
						<div id="msg-list-kardex" class="alert alert-warning" style="display:<?php echo  $totalKardex == 0?'block':'none'?>;">
							No se encontraron kardex en la fecha de <?php  echo $initialDate;  ?> a <?php  echo $finalDate; ?>
						</div>

						<div id="msg-success" style="display:<?php echo  $countErrors==0 && $totalKardex != 0?'block':'none'?>;" class="alert alert-success">
							NO,  existe errores en la lista,  el archivo  plano esta  listo para generar.
						</div>

					</div>	
				  </div>
				  <div id="menu1" class="tab-pane fade">
				  	<br>
				    <div class="table-responsive">
				    	<table class="table table-hover">
				    		<thead>
				    			<tr>
				    				<th>KARDEX</th>
				    				<th>ACTO</th>
				    				<th>TIPO DE MONEDA</th>
									<th>TIPO DE CAMBIO</th>
				    				<th>PATRIMONIAL</th>
				    				<th>EN DOLARES</th>
				    			</tr>
				    		</thead>
				    		<tbody>
				    			<?php foreach ($dataKardex as   $rowKardex) { 
									$tipoCambio = $rowKardex['tipoCambio'];
				    				if($rowKardex['idMoneda'] == 2){
				    					$currencySymbol = '$ ';
				    					$currencyDescription = 'DOLARES';
				    				}else{
				    					$currencySymbol = 'S./ ';
				    					$currencyDescription = 'SOLES';
				    				}


				    			?>
				    				
				    			<tr>
				    				<td>
				    					<a target="_blank"  href="../../verkardex.php?kardex=<?php echo $rowKardex['kardex'];?>&id=<?php echo $rowKardex['idKardex']; ?>"><?php echo $rowKardex['kardex']; ?></a>
				    				</td>
				    				<td><?php echo $rowKardex['act']; ?></td>
				    				<td><?php echo $currencyDescription; ?></td>
									<td><?php echo $tipoCambio; ?></td>
				    				<td><span style="color: green;"><?php echo $currencySymbol.' '.$rowKardex['montoTotalOperacion']; ?></span></td>
				    				<td><span style="color: green;"><?php if($rowKardex['idMoneda'] == 1){  echo '$ '.number_format(($rowKardex['montoTotalOperacion']/$tipoCambio),2,'.',' '); }else{ echo  '$ '.$rowKardex['montoTotalOperacion'];} ?></span></td>
				    			</tr>
				    			<?php } ?>
				    		</tbody>
				    	</table>	
				    </div>
				  </div>
				   <div id="menu3" class="tab-pane fade">
				   <br>
						<table class="table table-hover">
				    		<thead>
				    			<tr>
				    				<th>KARDEX</th>
				    				<th>ACTO</th>
				    				<th>TIPO DE MONEDA</th>
				    				<th>PATRIMONIAL</th>
				    			
				    			</tr>
				    		</thead>
				    		<tbody>
							<?php while($rowKardexNotRo = mysql_fetch_assoc($resultKardexNotRo)){ 
								$tipoCambio = $rowKardexNotRo['tipocambio'];
								if($rowKardexNotRo['idmon'] == 2){
									$currencySymbol = '$ ';
									$currencyDescription = 'DOLARES';
								}else{
									$currencySymbol = 'S./ ';
									$currencyDescription = 'SOLES';
								}

							?>
								<tr>
									<td><?php echo $rowKardexNotRo['kardex']; ?></td>
									<td><?php echo $rowKardexNotRo['desacto']; ?></td>
									<td><?php echo $currencyDescription; ?></td>
									<td><?php echo $rowKardexNotRo['importetrans']; ?></td>
								</tr>
							<?php } ?>
							</tbody>
						</table>		
				   </div>
				 
			</div>
	 	</div>
	 	
<div id="modal-correct-errors" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">

            <div id="modal-delete-header" class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">MENSAJE AL USUARIO</h4>
            </div>

            <div  class="modal-body">
                <input id="txt-pk-type-user" type="hidden" />
                <div id="modal-delete-body">¿Estas seguro que deseas autocorregir los <span id="modal-total-errors" ></span> errores?</div>

                <div id="msg-correct-error" class="alert alert-success" style="display:none;">
                    <span id="icon-delete-type-user" class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                    <span id="msg"></span>
                </div>
                <div id="loading-delete-correct-error" style="display:none;">
                    <span class="loading-icon"><span   class="fa fa-spinner fa-spin fa-lg" ></span>&nbsp;Autocorrigiendo lista de errores ...
                    </span>
                </div>
                <div id="modal-delete-ok" style="text-align:right;display:none;">
                    <button id="close" type="button" class="btn btn-success" data-dismiss="modal">OK</button>
                </div>

            </div>



            <div id="modal-delete-footer" class="modal-footer">
                <a id="btn-yes-correct-errors" type="button" class="btn btn-success">SI</a>
                <a id="close" type="button" class="btn btn-danger" data-dismiss="modal">NO</a>
            </div>
        </div>
    </div>
</div>

<script src="../../Libs/jquery/jquery-3.1.0.min.js" type="text/javascript"></script>
<script src="../../Libs/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script type="text/javascript">
	var arrCorrectErrors = new Array();
	$('#btnUpdateListErrors').on('click',function(e){
		e.preventDefault();
		vInitialDate = $('#txtInitialDate').val();
		vFinalDate = $('#txtFinalDate').val();
		$('#msg-success').hide();
		$('#msg-list-kardex').hide();
		$.ajax({
           url:'get_list_errors.php',
           type:'POST',
           data:{initialDate:vInitialDate,finalDate:vFinalDate},
           dataType:'json',
           beforeSend: function()
            {
               $('#tblListErrors').addClass('loading-table');
            },
           success:function(response){
           	$('#tblListErrors  tbody tr').remove();
            $('#tblListErrors').removeClass('loading-table');
            html = '';


            if(response.totalKardex == 0){
            	$('#msg-list-kardex').show();
            }else{

            	if(response.totalError != 0){
	            	x = 1;
	            	for(i  in response.list){
	            		disabled = response.list[i].isCorrectable == 0?'disabled':'';
	            		html = html +'<tr>';
	            		//html = html + '<td>' + x + '</td>';
	            		html = html + '<td><input '+disabled+' type="checkbox" class="correct-error-uif" data-id="'+x+'" data-idcontractor="'+response.list[i].idContractor+'" data-typeofcorrection="'+response.list[i].typeOfCorrection+'" data-categorycorrect="'+response.list[i].categoryCorrect+'" data-iscorrectable="'+response.list[i].isCorrectable+'" ></td>';

	            		html = html + '<th><a target="_blank"  href="../../verkardex.php?kardex='+response.list[i].kardex+'&id='+response.list[i].idKardex+'">' + response.list[i].kardex + '</a></th>';

	            		html = html + '<td>' + response.list[i].act  + '</td>';
	            		

	            		html = html + '<td>';
	            		if(response.list[i].rowType == 2){
	            			html = html +'<span style="color:#337ab7;">'+response.list[i].detailsError+'</span>  <span>'+response.list[i].descriptionElement+'</span>';
	            		}else{

	            			html = html + response.list[i].descriptionElement;
	            			items = response.list[i].detailsError.split(",");
	            			for(z = 0;z<items.length;z++){
	            				html = html + '<ul>';
	            				html = html + '<li>'+items[z]+'</li>';
	            				html = html + '</ul>';
	            			}
	            		}

	            		html = html + '</td>';
	            		html = html + '</tr>';
	            		x++;
	            	}
	            	$('#tblListErrors  tbody').append(html);
           		}else{
            		$('#msg-success').show();
           		}
            	$('#total-errors').text(response.totalError);
            }

     
           }
       });

	});	




	$("#btn-export-excel").on('click',function(event) {
		
		$("#sendHtmlExcel").val($("<div>").append( $("#table-export-excel").eq(0).clone()).html());
   		$("#frm-export-excel").submit();
	

	});



	$('#btn-correct-errors').on('click',function(e){
	$('#modal-total-errors').text(arrCorrectErrors.length);

	$('#modal-delete-body').show();
    $('#modal-delete-header').show();
    $('#modal-delete-footer').show();
	$('#msg-correct-error').hide();
    $('#modal-delete-ok').hide();

	$('#modal-correct-errors').modal({'show':true,"backdrop"  : "static",
             "keyboard"  : true});
	});

	$('#btn-yes-correct-errors').on('click',function(e){

		$('#modal-delete-body').hide();
	    $('#modal-delete-header').hide();
	    $('#modal-delete-footer').hide();
		$.ajax({
			url:'correct_error_uif.php',
			type:'POST',
			dataType:'json',
			data:{listError:JSON.stringify(arrCorrectErrors)},
			beforeSend:function(){
				$('#loading-delete-correct-error').show();
			},
			
			success:function(response){
				$('#loading-delete-correct-error').hide();
				$('#modal-delete-header').show();
				$('#msg-correct-error').show();
		        $('#modal-delete-ok').show();
				if(response.error == 0){
					
					$("#chkAllCorrectErrors").prop("checked", "");
					$('#btn-correct-errors').attr('disabled',true);
					arrCorrectErrors = new Array();
					$('#totalCorrectErrors').text(arrCorrectErrors.length);
					
					$('#msg-correct-error').text(response.errorDescription);
					console.log(response);
					$('#btnUpdateListErrors').click();
				}else{

				}
				
		        

			}

		});
	});


	$('#tblListErrors').on('change','.correct-error-uif',function(e){
	
		vid = $(this).data('id');
		vkardex = $(this).data('kardex');
		vtipoActo = 0;
		//vtipoActo = $(this).data('tipoacto');
		//vitemMp = $(this).data('itemmp');
		vitemMp = 0;
		vTypeOfCorrection = $(this).data('typeofcorrection');
		vCategoryCorrect = $(this).data('categorycorrect');
		//vWritingDate = $(this).data('writingdate');
		vWritingDate = 0;
		vIdContractor = $(this).data('idcontractor');
		//vTypeFile = 
		
		if(this.checked == true){
			arrCorrectErrors.push({id:vid,kardex:vkardex,tipoActo:vtipoActo,itemMp:vitemMp,typeOfCorrection:vTypeOfCorrection,categoryCorrect:vCategoryCorrect,writingDate:vWritingDate,idContractor:vIdContractor});
		}else{
			arrCorrectErrors =  arrCorrectErrors.filter(function (el) {
	                    return el.id != vid;
	                   });
		}
		if(arrCorrectErrors.length == 0){
			$('#btn-correct-errors').attr('disabled',true);
		}else{
			$('#btn-correct-errors').attr('disabled',false);
		}
		$('#totalCorrectErrors').text(arrCorrectErrors.length);

	//alert('hola'+this.checked);
	});

	$('#chkAllCorrectErrors').on('change',function(e){
	
		if(this.checked){
			$('#tblListErrors input[type=checkbox]').each(function(){
	            /*if (this.checked) {
	                selected += $(this).val()+', ';
	            }*/
	            vid = $(this).data('id');
				vkardex = $(this).data('kardex');
				//vtipoActo = $(this).data('tipoacto');
				vtipoActo = 0;
				//vitemMp = $(this).data('itemmp');
				vitemMp = 0;
				vTypeOfCorrection = $(this).data('typeofcorrection');
				vCategoryCorrect = $(this).data('categorycorrect');
				
				vWritingDate = 0;
				//vWritingDate = $(this).data('writingdate');

	            isCorrectable = $(this).data('iscorrectable');
	            vIdContractor = $(this).data('idcontractor');

	            if(isCorrectable == 1){
	            	this.checked = true;
	            		
	            	arrCorrectErrors.push({id:vid,kardex:vkardex,tipoActo:vtipoActo,itemMp:vitemMp,typeOfCorrection:vTypeOfCorrection,categoryCorrect:vCategoryCorrect,writingDate:vWritingDate,idContractor:vIdContractor});
	            }
	            
       		 }); 
			$('#totalCorrectErrors').text(arrCorrectErrors.length);
			if(arrCorrectErrors.length > 0){
				$('#btn-correct-errors').attr('disabled',false);
			}
			
		}else{
			$('#tblListErrors input[type=checkbox]').each(function(){
	            /*if (this.checked) {
	                selected += $(this).val()+', ';
	            }*/
	            this.checked = false;
	            

       		 }); 
			arrCorrectErrors = new Array();
			$('#totalCorrectErrors').text(arrCorrectErrors.length);
			$('#btn-correct-errors').attr('disabled',true);
			
		}


	});

	const verUsuario = (kardex,indice)=>{
		const request=new XMLHttpRequest();
		request.open('POST','ver_usuario.php',true);
		request.setRequestHeader('Content-Type','application/x-www-form-urlencoded;charset=UTF-8');
		request.send('kardex='+kardex)
		request.onload=function(){
			if(request.status >= 200 && request.status < 400){
				let data=request.responseText;
				 let registro=JSON.parse(data);
				 let filaUsuario = document.getElementById('error_'+indice)
				 filaUsuario.title = registro['loginusuario']
				
			}else{
				let data=request.responseText;
				console.log(data);
			}
		}
		request.onerror=function(){
			console.log('no hay conexion con el servidor');
		}
	}

</script>
</body>
</html>