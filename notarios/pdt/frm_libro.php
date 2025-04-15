<?php 
include_once '../Cpu/PDTClass.php';
include_once('../includes/ClaseLetras.class.php');
$initialDate = $_GET["initialDate"];
$finalDate = $_GET["finalDate"];

$arrInitialDate = explode('/', $initialDate);
$month = ClaseNumeroLetra::fun_mes($arrInitialDate[1]);
$year = $arrInitialDate[2];
$objPdt = new PDTClass();
$objPdt->setInitialDate($initialDate);
$objPdt->setFinalDate($finalDate);

$objPdt->loadDataLibro();

$listErrors = $objPdt->getErrorsLib();
$totalErrors = $objPdt->getCountErrors();
$totalLibro = $objPdt->getTotalLibro();
$i = 1;
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<!--<link href="../Libs/jquery-icheck/skins/all.css" rel="stylesheet" />-->
	<link rel="stylesheet" type="text/css" href="../Libs/bootstrap/css/bootstrap.min.css">
	<style type="text/css">
		.loading-table{
		    opacity: 0.25;
		    background: url(../images/market.gif) no-repeat center;
		}

	</style>

</head>
<body>
<div class="container"><h2>REPORTE PDT - LIBROS</h2></div>
<div class="container">
	<ul class="nav  nav-tabs">
			<li class="active">
	    		<a class="nav-link" data-toggle="tab" href="#on-umbral" role="tab">Libros</a>
	  		</li>
			<!--<li class="nav-item">
	    		<a class="nav-link" id="btnReportUnderUmbral" data-toggle="tab" href="#file-act" role="tab">Archivo de Bienes</a>
	  		</li>
	  		<li class="nav-item">
	    			<a class="nav-link" id="btnReportUnderUmbral" data-toggle="tab" href="#file-act1" role="tab">Archivo de Otorgantes</a>
	  		</li>
	  		<li class="nav-item">
	    			<a class="nav-link" id="btnReportUnderUmbral" data-toggle="tab" href="#file-act2" role="tab">Archivo de Medio  de Pago</a>
	  		</li>
	  		<li class="nav-item">
	    			<a class="nav-link" id="btnReportUnderUmbral" data-toggle="tab" href="#file-act3" role="tab">Archivo de Formmulario</a>
	  		</li>-->
	</ul>
	<div class="tab-content">
		<div class="tab-pane active" id="on-umbral">
			<br>	
			<div class="table-responsive">
				<table class="table table-bordered table-striped" >
					<tbody>
						<!--<tr>
						    <td width="35%">MES</td>
						    <td width="65%"></td>
						</tr>-->
				        <tr>
				            <td width="35%">FECHA:</td>
				            <td width="65%"><?php echo $initialDate; ?> A <?php echo $finalDate; ?> 
					            <input type="hidden" id="txtInitialDate" name="initialDate" value="<?php echo $initialDate; ?>">
					            <input type="hidden" id="txtFinalDate" name="finalDate" value="<?php echo $finalDate; ?>">
				            </td>

				        </tr>
				        <tr>
				            <td width="35%">CANTIDAD DE LIBROS</td>
				            <td width="65%"><?php  echo  $totalLibro;?></td>
						</tr>
				        
					</tbody>
				</table>
			</div>
			<div class="row">	
				<div class="col-sm-6">
					<a href="generate_file_pdt.php?initialDate=<?php echo $initialDate; ?>&finalDate=<?php echo $finalDate; ?>&numberFile=6" class="btn btn-default"><i class="glyphicon glyphicon-save-file"></i> Lib</a>
				</div>
				<div class="col-sm-3">
					<a  id="btnUpdateListErrors" class="btn btn-primary"><i class="glyphicon glyphicon-refresh"></i> Actualizar Errores (<span id="total-errors"><?php echo $totalErrors; ?></span>)</a>
				</div>
				<div class="col-sm-3">

					<!--<input id="chkAllCorrectErrors" type="checkbox" name="">&nbsp;&nbsp;<label>TODOS</label>
					<button id="btn-correct-errors" disabled="" class="btn btn-success">(<span id="totalCorrectErrors">0</span>) <i class="glyphicon glyphicon-ok"></i> Subsanar</button>-->
				</div>
			</div>
			<br>
				<div class="table-responsive">
						<table class="table table-bordered table-striped" id="tblListErrors">
							<thead>
								<tr>
									<th width="3%"></th>
									<th>NUMERO DE LIBRO</th>
									<th>DESCRIPCIÓN DEL ERROR</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($listErrors as $key => $row) { 
										foreach ($listErrors[$key] as  $objItem) {

											
											//var_dump();
											//die($objItem->getBookNumber().'hola');

										$disabled = $objItem->isCorrectable() == 0?'disabled':'';

									?>
									<tr>
										
										 <td><input <?php echo $disabled; ?> class="correct-error-pdt" data-id="<?php echo  $i; ?>"  data-kardex="<?php echo $objItem->getKardex(); ?>" data-tipoacto="<?php echo $objItem->getTypeAct(); ?>" data-itemmp="<?php echo $objItem->getItemMp(); ?>" data-typeofcorrection="<?php echo $objItem->getTypeOfCorrection(); ?>" data-categorycorrect="<?php echo  $objItem->getCategoryCorrect(); ?>" data-iscorrectable="<?php echo  $objItem->isCorrectable(); ?>" data-writingdate="<?php echo  $objItem->getWritingDate(); ?>" data-idcontractor="<?php echo  $objItem->getIdContractor(); ?>" type="checkbox" name=""></td>		
								
										 <td><a target="_blank"  href="../verlibro.php?numlibro=<?php  echo $objItem->getBookNumber();?>"><?php echo $objItem->getBookNumber(); ?></a></td>
										
										 <td><?php echo $objItem->getErrorItem(); ?></td>
										
									</tr>	


								<?php 
										$i++;
									}

								}

								 ?>
							</tbody>
						
						</table>
						<div id="msg-list-kardex" class="alert alert-warning" style="display:<?php echo  $totalLibro == 0?'block':'none'?>;">
							No se encontraron kardex en la fecha de <?php  echo $initialDate;  ?> a <?php  echo $finalDate; ?>
						</div>

						<div id="msg-success" style="display:<?php echo  $totalErrors==0 && $totalLibro != 0?'block':'none'?>;" class="alert alert-success">
							NO,  existe errores en la lista,  los archivos estan listos para descargar.
						</div>	
				</div>		    
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





<script src="../Libs/jquery/jquery-3.1.0.min.js" type="text/javascript"></script>
<!-- <script type="text/javascript" src="../Libs/jquery-icheck/icheck.min.js"></script>-->
<script src="../Libs/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

<script type="text/javascript">
	/*$('input').iCheck({
      checkboxClass: 'icheckbox_square-aero',
      radioClass: 'iradio_square-aero',
      increaseArea: '10%'
	});*/
var arrCorrectErrors = new Array();


$('#btnUpdateListErrors').on('click',function(e){
		e.preventDefault();
		loadListErrors();

});	

	
function loadListErrors(){
	arrCorrectErrors = new Array();
	vInitialDate = $('#txtInitialDate').val();
	vFinalDate = $('#txtFinalDate').val();
	$('#msg-success').hide();
	$('#msg-list-kardex').hide();
	$.ajax({
       url:'get_list_errors.php',
       type:'POST',
       data:{initialDate:vInitialDate,finalDate:vFinalDate,typeKardex:0},
       dataType:'json',
       beforeSend: function()
        {
           $('#tblListErrors').addClass('loading-table');
        },
       success:function(response){
       	$('#tblListErrors  tbody tr').remove();
        $('#tblListErrors').removeClass('loading-table');
        html = '';


        if(response.totalRecords == 0){
        	$('#msg-list-kardex').show();
        }else{

        	if(response.totalError != 0){
            	x = 1;
            	for(i  in response.list){
            		disabled = response.list[i].isCorrectable == 0?'disabled=""':'';

            		html = html +'<tr>';
            		html = html + '<th><input type="checkbox" '+disabled+' class="correct-error-pdt" data-id="'+x+'" data-kardex="'+response.list[i].kardex+'" data-tipoacto="'+response.list[i].typeAct+'" data-itemmp="'+response.list[i].itemMp+'" data-typeofcorrection="'+response.list[i].typeOfCorrection+'" data-categorycorrect="'+response.list[i].categoryCorrect+'" data-writingdate = "'+response.list[i].writingDate+'" data-idcontractor="'+response.list[i].idContractor+'" data-iscorrectable="'+response.list[i].isCorrectable+'">';
            		html = html + '</td>';
            		html = html + '<td><a target="_blank"  href="../verlibro.php?numlibro='+response.list[i].bookNumber+'">' + response.list[i].bookNumber + '</a></td>';

            		//html = html + '<td>' + response.list[i].act  + '</td>';
            		html = html + '<td>' + response.list[i].errorItem  + '</td>';

            		//html = html + '<td>'+response.list[i].fileType+'</td>';
            		
            	
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
}

	
$('#tblListErrors').on('change','.correct-error-pdt',function(e){
	
	vid = $(this).data('id');
	vkardex = $(this).data('kardex');
	vtipoActo = $(this).data('tipoacto');
	vitemMp = $(this).data('itemmp');
	vTypeOfCorrection = $(this).data('typeofcorrection');
	vCategoryCorrect = $(this).data('categorycorrect');
	vWritingDate = $(this).data('writingdate');
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
		url:'correct_error.php',
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
				loadListErrors();
				$("#chkAllCorrectErrors").prop("checked", "");
				$('#btn-correct-errors').attr('disabled',true);
				arrCorrectErrors = new Array();
				$('#totalCorrectErrors').text(arrCorrectErrors.length);
				$('#msg-correct-error').text(response.errorDescription);
			}else{

			}
			
	        

		}

	});
});

	$('#chkAllCorrectErrors').on('change',function(e){
		
		if(this.checked){
			$('#tblListErrors input[type=checkbox]').each(function(){
	            /*if (this.checked) {
	                selected += $(this).val()+', ';
	            }*/
	            vid = $(this).data('id');
				vkardex = $(this).data('kardex');
				vtipoActo = $(this).data('tipoacto');
				vitemMp = $(this).data('itemmp');
				vTypeOfCorrection = $(this).data('typeofcorrection');
				vCategoryCorrect = $(this).data('categorycorrect');
				vWritingDate = $(this).data('writingdate');
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
	            ;

       		 }); 
			arrCorrectErrors = new Array();
			$('#totalCorrectErrors').text(arrCorrectErrors.length);
			$('#btn-correct-errors').attr('disabled',true);
			
		}


	});


</script>


</body>
</html>