
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../Libs/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/home.css">
	<style type="text/css">
		.faltante{
			color: #f54163;
   			 font-weight: bold;
   			 font-size:18px;
		}
	</style>
</head>
<body onload="loadData(1)">

<div class="container">
	<br>
	<div class="row">
		<div class="col-sm-2">
			<img src="logo.png">
		</div>
		<div class="col-sm-4">
			<h3 style="margin-top: 7px;">-BASE CENTRALIZADA</h3>
		</div>
	</div>
	<br>
	<div  class="row">
		<div  class="col-sm-3">
			<select id="cmbEstado" class="form-control">
				<option value="1">Todos</option>
				<option value="2">Faltantes</option>
			</select>
		</div>
		<div class="col-sm-4">
			<span id="total" style="font-size: 20px;font-weight: bold;"></span>
		</div>
	</div>
	<br>
	<table class="table table-hover"> 
		<tr>
			<thead>
				<tr>
					<th>Nº</th>
					<th>Kardex</th>
					<th>Fecha de Instrumento</th>
					<th>Tipo de Instrumento</th>
					<th>Numero de Instrumento</th>
					<th>Descripcion del Acto</th>
					<th>Error</th>
				</tr>
			</thead>

			<tbody id="tblData">
				
			</tbody>
		</tr>
	</table>
</div>

<script src="../Libs/jquery/jquery-3.1.0.min.js" type="text/javascript"></script>
<script src="../Libs/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

<script type="text/javascript">
	
	$('#cmbEstado').on('change',function(){
		estado = this.value;
		loadData(estado);
		

	});

	function loadData(estado){
		 $('#tblData tr').remove();
		$.ajax({
			url:'get_data_excel.php',
            dataType:'json',
            type:'POST',
            data:{estado:estado},
            success:function(response){
            	html = '';
                list = response.data;
            	var x = 1;

            	 if(list.length != 0){
            	 	$('#total').text('Total de Documentos: '+list.length);
					for(i in list){
						kardex = list[i].kardex;
						classRow = '';
						classFaltante = '';
						if(kardex == -1){
							classRow = 'danger';
							classFaltante = 'faltante';
						}
				        html = html + '<tr class="'+classRow+'"><td>'+x+'</td>';
				        html = html +'<td>'+list[i]['kardex']+'</td>';
				        html = html +'<td>'+list[i]['fechaEscritura']+'</td>';
				        html = html +'<td>'+list[i]['tipoInstrumento']+'</td>';
				        html = html +'<td><span class="'+classFaltante+'">'+list[i]['numeroInstrumento']+'</span></td>';
				        html = html +'<td>'+list[i]['descripcionActo']+'</td>';
				        html = html +'<td>'+list[i]['error']+'</td></tr>';
				        x++; 
			     	}
			     	$('#tblData').append(html);

            	 }
			     
            }
		});
	}

</script>

</body>
</html>


