<?php
require_once 'Cpu/ROClass.php';
include_once('../../../includes/ClaseLetras.class.php');
$initialDate = $_GET["initialDate"];
$finalDate = $_GET["finalDate"];
$arrInitialDate = explode('/', $initialDate);
$month = ClaseNumeroLetra::fun_mes($arrInitialDate[1]);
$year = $arrInitialDate[2];
$objRoClass = new RoClass($initialDate,$finalDate);
$objRoClass->loadData();
$objRoClass->generateData();
$listErros = $objRoClass->getListErrors();
$countErrors =  $objRoClass->getCountErrors();
$totalKardex = $objRoClass->getTotalKardex();
$i = 1;


?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" type="text/css" href="../../../Libs/bootstrap/css/bootstrap.min.css">
	<style type="text/css">
		.loading-table{
		    opacity: 0.25;
		    background: url(../../images/market.gif) no-repeat center;
		}

	</style>
</head>
<body>



<div class="container"><h2>Validacion de Información - SISGEN (BASE CENTRALIZADA)</h2></div>
<div class="container">
	<div class="table-responsive">
	 <table class="table table-bordered table-striped" >
	     <tbody>
	         <tr>
	             <td style="font-weight: bold;" width="35%">FECHA:</td>
	             <td width="65%"><?php echo $initialDate; ?> A <?php echo $finalDate; ?> 
		            <input type="hidden" id="txtInitialDate" name="initialDate" value="<?php echo $initialDate; ?>">
		            <input type="hidden" id="txtFinalDate" name="finalDate" value="<?php echo $finalDate; ?>">
	             </td>

	         </tr>
	         <tr>
	             <td style="font-weight: bold;" width="35%">CANTIDAD DE KARDEX:</td>
	             <td width="65%"><?php  echo  $totalKardex;?></td>
	         </tr>
	        <!-- <tr>
	             <td width="35%">GENERAR ARCHIVO XML </td>
	             <td width="65%"><a target="_blank" href="xmlcompraventa.php?fec_desde=<?php echo $initialDate; ?>&fec_hasta=<?php echo $finalDate; ?>" >  <i class="glyphicon glyphicon-import" style="font-size:18px;"></i> GENERAR</a></td>
	         </tr>
	         <tr>
	             <td width="35%">ENVIAR XML </td>
	             <td width="65%"><a target="_blank"  href="excel_ro.php?initialDate=<?php echo $initialDate; ?>&finalDate=<?php echo $finalDate; ?>"> <i class="glyphicon glyphicon-eye-open" style="font-size:18px;"></i> ENVIAR</a></td>
	         </tr> -->
	     </tbody>
	 </table>
	</div>
</div>

<div id="exTab2" class="container">	
	<ul class="nav nav-pills">
			<li class="active">
	        	<a id="btnUpdateListErrors" href="#1"  data-toggle="tab" style="background-color: #546312;"> <i class="glyphicon glyphicon-refresh"></i> 
	        	LISTADO DE KARDEX (<span id="total-errors"><?php  echo $countErrors; ?></span>)</a>


			</li>	
			<!--<li class="nav-item">
    			<a class="nav-link" data-toggle="tab" href="#2" role="tab">KARDEX NO </a>
  			</li>-->
	</ul>
	<div class="tab-content ">
	 	<div class="tab-pane active" id="1">
		 	<div class="table-responsive">
		 		<table id="tblListErrors" class="table table-hover">
				 	<thead>
					    <tr>
					      <th>#</th>
					      <th width="10%">KARDEX</th>
					      <th width="25%">ACTO</th>
					      <th width="10%">ESTADO</th>
					      <th>DESCRIPCIÓN </th>
					     <!-- <th>ESTADO</th>
					      <th>Validar</th>-->
					    </tr>
				 	</thead>
		  			<tbody>
					  	<?php foreach ($listErros as $key => $row) {?>
							<?php foreach ($listErros[$key] as $objItemRo) { ?>
								 <tr id="error_<?php echo $i; ?>">
							      <td><?php echo $i; ?></td>
							      <th><a target="_blank"  href="../../../verkardex.php?kardex=<?php  echo $objItemRo->getKardex();?>&id=<?php echo $objItemRo->getIdKardex(); ?>"><?php echo $objItemRo->getKardex(); ?></a></th>
							      <td><?php echo $objItemRo->getAct(); ?></td>
							      <!--<td><?php echo $objItemRo->getCodeElement(); ?></td>-->
							      <?php 
							      if ($objItemRo->getStatusError()=='2') {
							      	?><td><span style="color:#9c2b2b;font-weight: bold;">ERROR</span></td><?php 
							      	# code...
							      }else{
							      	?><td>OPCIONAL</td><?php 
								  }
							      ?>
							      <td>
							      	<?php if($objItemRo->getRowType() == 2){ 
									?>
							      	<span style="color:#337ab7;"><?php echo  $objItemRo->getDetailsError();?></span>  <span><?php echo $objItemRo->getDescriptionElement(); ?></span>
							      	<?php }else {?>
                                      <?php echo $objItemRo->getDescriptionElement(); 
										 if ($objItemRo->getTipoError() == 1){
												$items = explode(',',$objItemRo->getDetailsError());
												$parte1 = $items[0];
												$parte2 = $items[1];
												$parte3 = $items[2];
										?>
										<ul>
                                      	 <li>
										<span style="color:#337ab7;"><?php echo  $parte1;?></span>  <span><?php echo $parte2; ?></span> <span style="color:#337ab7;"><?php echo  $parte3;?></span>
											</li>
                                      </ul>
										 <?php }else{
                                      	 $items = explode(',',$objItemRo->getDetailsError());
                                      	 foreach ($items as $key => $value) {
                                      ?>
                                      <ul>
                                      	 <li>
										 <?php echo $value; ?>	
										 
										 </li>
                                      </ul>
                                      <?php }?>
							      	<?php }}?>
							      </td>
							    

							      <!--<td><a class="btn btn-success validation-error" href="javascript:;" data-iderror="error_" class="btn btn-success">V</a></td>-->

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
					NO,  existe errores en la lista,  el archivo  XML esta  listo para generar.
				</div>

			</div>	
	 	</div>
	 	<!--<div class="tab-pane" id="2" role="tabpanel">
	 		<div class="table-responsive">
		 		<table id="tblListKardexNot" class="table table-hover">
				 	<thead>
					    <tr>
					      <th>#</th>
					      <th>KARDEX</th>
					      <th>Nº DE ERROR</th>
					      <th>DESCRIPCION DEL ERROR</th>
					    </tr>
				 	</thead>
		  			<tbody>
		  				<tr>
		  					<td></td>
		  					<td></td>
		  					<td></td>
		  				</tr>

		  			</tbody>

		  		</table>
	 	</div>-->
		
		
	</div>
 </div>
<script src="../../../Libs/jquery/jquery-3.1.0.min.js" type="text/javascript"></script>
<script src="../../../Libs/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script type="text/javascript">
	
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
	            		html = html +'<tr>';
	            		html = html + '<td>' + x + '</td>';

	            		html = html + '<th><a target="_blank"  href="../../../verkardex.php?kardex='+response.list[i].kardex+'&id='+response.list[i].idKardex+'">' + response.list[i].kardex + '</a></th>';

	            		html = html + '<td>' + response.list[i].act  + '</td>';
	            		//html = html + '<td>' + response.list[i].codeElement  + '</td>';
	            		if(response.list[i].statusError == 2){
	            			html = html +'<td><font style="color: #9c2b2b;">ERROR</font></td> ';
	            		}else{
	            			html = html + '<td>OPCIONAL</td>';
	            		}
	            		
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

	/*
	$('.validation-error').on('click',function(e){
		idError = $(this).data('iderror');
		$('#'+idError).fadeOut("slow",function(){
			$(this).remove();
		});
		
	});*/

</script>
</body>
</html>