<?php 

include('conexion.php');

$fechade = $_GET['fec_desde'];
$fecha=explode("/",$fechade);
$desde=$fecha[2]."-".$fecha[1]."-".$fecha[0];

$fechaa  = $_GET['fec_hasta'];
$fecha2=explode("/",$fechaa);
$hasta=$fecha2[2]."-".$fecha2[1]."-".$fecha2[0];

//$tipokardex = $_POST['tipokar'];






	$consulta = mysql_query("SELECT sisgen.id_envio AS ID,  tipo_kardex AS TIPKAR, sisgen.kardex AS KARDEX, num_escritura AS NUM_ESC, 
		fech_envio AS FEC_ENVIO, hora_envio AS HORA_ENVIO,estado AS ESTADO, IF ( mensaje IS NULL , '',mensaje) AS MENSAJE, sisgen.status AS ESTATUS, sisgen_temp.idkardex AS IDKARDEX, sisgen_temp.contrato AS CONTRATO FROM sisgen 
		LEFT JOIN sisgen_mensaje ON sisgen.kardex = sisgen_mensaje.kardex 
		INNER JOIN sisgen_temp ON sisgen.kardex = sisgen_temp.kardex
		ORDER BY sisgen.kardex ASC", $conn) or die(mysql_error());

	
	/*
while($row = mysql_fetch_array($consulta)){

echo"<table width='834' border='1' cellpadding='0' cellspacing='0' >
  <tr>
    <td width='83' align='center'><span style='font-family:Verdana, Geneva, sans-serif; font-size:10px; color:#036;' >";
	if($row['TIPO_KARDEX']=='1'){ echo "ESCRITURA PUBLICA"; 	}
	if($row['TIPO_KARDEX']=='2'){ echo "NO CONTENSIOSOS"; 	}
	if($row['TIPO_KARDEX']=='3'){ echo "TRANSFERENCIAS VEHICULARES"; 	}
	if($row['TIPO_KARDEX']=='4'){ echo "GARANTIAS MOBILIARIAS"; 	}
	if($row['TIPO_KARDEX']=='5'){ echo "TESTAMENTOS"; 	}
	 echo"</span></td>
	<td width='35'  align='center' ><span style='font-family:Verdana, Geneva, sans-serif; font-size:10px; color:#036;' >".$row['KARDEX']."</span></td>
    <td width='43'  align='center' height='19' ><span style='font-family:Verdana, Geneva, sans-serif; font-size:10px; color:#036;' >". $row['FECHA_CONCLUSION']."</span></td>
	<td width='92'  align='center' ><span style='font-family:Verdana, Geneva, sans-serif; font-size:10px; color:#036;' >".$row['NUMERO_ESCRITURA']."</span></td>
	<td width='167'  align='center' ><span style='font-family:Verdana, Geneva, sans-serif; font-size:10px; color:#036;' >".$row['CONTRATO']."</span></td>
    <?php 
	
	?>
	<td width='56'  align='center' type='checkbox' >  ".$row['IDKARDEX']."</td>
  </tr>
</table>";
*/
	$consultaguardados=mysql_query("SELECT CONCAT(apellido,' ',nombre) AS NOTARIO, ruc AS CODIGONOTARIA FROM confinotario", $conn)or die(mysql_error());while ($row = mysql_fetch_array($consultaguardados))
	{	$CODNOTARIA=$row['CODIGONOTARIA'];
		$NOTARIO=$row['NOTARIO'];
	}

	$consultaguardados=mysql_query("SELECT COUNT(*) AS cantidadguardados FROM sisgen WHERE sisgen.status ='GUARDADO'", $conn)or die(mysql_error());while ($row = mysql_fetch_array($consultaguardados))
	{$guardados=$row['cantidadguardados'];}

	$consultafallidos=mysql_query("SELECT COUNT(*) AS cantidadguardados FROM sisgen WHERE sisgen.status ='FALLIDO'", $conn)or die(mysql_error());while ($row = mysql_fetch_array($consultafallidos))
	{$fallidos=$row['cantidadguardados'];}

	$consultaobservados=mysql_query("SELECT COUNT(*) AS cantidadguardados FROM sisgen WHERE sisgen.status ='CON OBSERVACIONES'", $conn)or die(mysql_error());while ($row = mysql_fetch_array($consultaobservados))
	{$observados=$row['cantidadguardados'];}		
		
$data = array();
	
			

while($row = mysql_fetch_array($consulta)){



	$tipkar=$row['TIPKAR'];
	$kardex=$row['KARDEX'];
	$numescritura=$row['NUM_ESC'];
	$fechenvio=$row['FEC_ENVIO'];
	$mensaje=$row['MENSAJE'];
	$estado=$row['ESTATUS'];
	$idkardex=$row['IDKARDEX'];
	$contrato=$row['CONTRATO'];
	$horaenvio=$row['HORA_ENVIO'];
	
	$data[] = $row;
	}

		
?>



<!DOCTYPE html>
<html>
<head>
	<title>SISGEN - REPORTE</title>

	<link rel="stylesheet" type="text/css" href="../../../Libs/bootstrap/css/bootstrap.min.css">
</head>
<body>

<div class="container">
	
	<div class="row">
		<div class="col-sm-9">
			<h2>REPORTE DE ENVIO SISGEN (BASE CENTRALIZADA)</h2>
		</div>
		

	</div>


	<div class="table-responsive">
	 <table class="table table-bordered table-striped" >
	     <tbody>
			<tr>
	             <td width="35%">RUC:</td>
	             <td width="65%"><?php echo $CODNOTARIA; ?> 
	             </td>
	         </tr>
			 <tr>
	             <td width="35%">NOTARIO:</td>
	             <td width="65%"><?php echo utf8_decode($NOTARIO); ?> 
	             </td>
	         </tr>
	         <tr>
	             <td width="35%">PERIODO DE ENVIO:</td>
	             <td width="65%"><?php echo $fechade; ?> A <?php echo $fechaa; ?> 
		            <input type="hidden" id="txtInitialDate" name="initialDate" value="<?php echo $initialDate; ?>">
		            <input type="hidden" id="txtFinalDate" name="finalDate" value="<?php echo $finalDate; ?>">
	             </td>

	         </tr>
			 <tr>
	             <td width="35%">FECHA DE ENVIO:</td>
	             <td width="65%"><?php echo ($fechenvio." / ".$horaenvio); ?> 
	             </td>
	         </tr>
	         <tr>
	             <td width="35%">CANTIDAD DE KARDEX GUARDADOS:</td>
	             <td width="65%"><?php  echo  $guardados;?></td>
	         </tr>
	         <tr>
	             <td width="35%">CANTIDAD DE KARDEX CON OBSERVACIONES:</td>
	             <td width="65%"><?php  echo  $observados;?></td>
	         </tr>
	         <tr>	             
	             <td width="35%">CANTIDAD DE KARDEX FALLIDOS:</td>
	             <td width="65%"><?php  echo  $fallidos;?></td>
	         </tr>
			 <tr>	             
	             <td width="35%">DESCARGAR REPORTE:</td>
	             <td width="65%">
					 <a target="_blank"   href="reportes/PDF_SISGEN.php?fec_desde=<?php echo $fechade; ?>&fec_hasta=<?php echo $fechaa; ?>" >
					 <i class="glyphicon glyphicon-save-file" style="font-size:18px;"></i> 
					 PDF</a>
				 </td>

	         </tr>
	         
	     </tbody>
	 </table>
	</div>


	<div class="row">

		<div class="col-sm-8">
			
		</div>
		<div class="col-sm-4">
			<div class="input-group">
		      <select id="cmbSearchValue" class="form-control" placeholder="Search for...">
		      		<option value=""> </option>
		      		<option value="GUARDADO">GUARDADO</option>
		      		<option value="CON OBSERVACIONES">CON OBSERVACIONES</option>
		      		<option value="FALLIDO">FALLIDO</option>
		      		
		      </select>
		      <span class="input-group-btn">
		        <button class="btn btn-default" type="button" id="btnBuscar"><span class="glyphicon glyphicon-search"></span> Buscar</button>
		      </span>
		      
		    </div>
		</div>
		
	</div>
	<br>

	<div class="table-responsive">

		<table class="table table-hover" id="tblReporte">
			<thead>
				<tr>
					<th width="5%">#</th>
					<th width="5%">TIPO</th>
					<th width="10%">KARDEX</th>
					<th width="15%"><?php $instrumentonum = 'Nº INSTRUMENTO'; echo utf8_decode($instrumentonum);?></th>
					<th width="25%">CONTRATO</th>
					<th width="15%">FECHA DE ENVIO</th>
					<th width="50%">MENSAJE DE ERROR</th>
					<th width="10%">ESTADO</th>
				</tr>
			</thead>
			<tbody>
				<?php $i=1; foreach ($data as  $value) { ?>
				

				<tr>
					<td><?php echo $i; ?></td>
					<td><?php echo $value['TIPKAR']; ?></td>
					<td><a target="_blank" id="<?php echo $kardex;?>" name="<?php echo $kardex;?>" style="color:#06C; cursor:pointer" href="../../../verkardex.php?kardex=<?php echo $value['KARDEX'];?>&id=<?php echo $value['IDKARDEX'];?>" ><?php echo $value['KARDEX']; ?></td>
					<td><?php echo $value['NUM_ESC']; ?></td>
					<td><?php echo $value['CONTRATO']; ?></td>
					<td><?php echo $value['FEC_ENVIO']; ?></td>
					<td>
						<font style="color: #9c2b2b;"><?php echo utf8_decode($value['MENSAJE']); ?></font>
					</td>
					<td><?php echo $value['ESTATUS'] ?></td>

				</tr>	
				<?php $i++; } ?>
			</tbody>


		</table>
		
	</div>
	

</div>
<script type="text/javascript" src="../../../Libs/jquery/jquery-3.1.0.min.js"></script>
<script type="text/javascript" src="../../../Libs/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript">
	
$("#btnBuscar").on('click',function(e){

	var cmbSearchValue = $('#cmbSearchValue').val();

	$.ajax({
		url:'list_error_busqueda.php',
		type:'POST',
		dataType:'json',
		data:{valorcombo:cmbSearchValue},

		success : function(response){
			 html = '';
			 $('#tblReporte  tbody tr').remove();
			 x = 1;
			for(i  in response.list){
				html = html  + '<tr>';
				html = html  + '<td>'+x+'</td>';
				html = html  + '<td>'+response.list[i].TIPKAR+'</td>';
				html = html  + '<td><a target="_blank"  href="../../../verkardex.php?kardex='+response.list[i].KARDEX+'&id='+response.list[i].IDKARDEX+'">' + response.list[i].KARDEX + '</a></td>';
				html = html  + '<td>'+response.list[i].NUM_ESC+'</td>';
				html = html  + '<td>'+response.list[i].CONTRATO+'</td>';
				html = html  + '<td>'+response.list[i].FEC_ENVIO+'</td>';
				html = html  + '<td><font style="color: #9c2b2b;">'+response.list[i].MENSAJE+'</font></td>';
				html = html  + '<td>'+response.list[i].ESTATUS+'</td>';



				html = html  + '</tr>';
				x = parseInt(x+1);
			}	
			$('#tblReporte  tbody').append(html);			

		}

	});

});



</script>
</body>
</html>