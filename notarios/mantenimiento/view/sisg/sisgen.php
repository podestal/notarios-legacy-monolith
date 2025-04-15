<!DOCTYPE html>
<?php

require_once("../../../includes/combo.php")  	  ;
$oCombo = new CmbList()  				  ;
include("conexion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../../../tcal.css" />
<link rel="stylesheet" type="text/css" href="../../../Libs/bootstrap/css/bootstrap.min.css">

<!--<script src="../../../mantenimiento/view/funciones_ro.js"></script>-->


<title>BASE CENTRALIZADA</title>
<style type="text/css">


.table-fixed thead {
  width: 100%;
}
.table-fixed tbody {
  height: 600px;
  overflow-y: auto;
  width: 100%;
}
.table-fixed thead, .table-fixed tbody, .table-fixed tr, .table-fixed td, .table-fixed th {
  display: block;
}
.table-fixed tbody td, .table-fixed thead > tr> th {
  float: left;
  border-bottom-width: 0;
}


<!--
.line {color: #FFFFFF}
.titulosprincipales {	font-family: Calibri;
	font-size: 18px;
	color: #FF9900;
	font-style: italic;
}
div.frmcrono {  background-color: #ffffff;
border: 5px solid #264965;

-moz-border-radius: 13px;
-webkit-border-radius: 13px;
border-radius: 13px;
-moz-box-shadow: 0px 0px 5px #000000;
-webkit-box-shadow: 0px 0px 5px #000000;
box-shadow: 0px 0px 5px #000000;
width:900px; height:850px;
}

iframe #principal {
	width: 900px;
}

body {
	background-color: initial;

}

td {
	font-size: 12px
}

th {
	font-size: 12px
}

.Estilo7 {font-family: Calibri; font-size: 13px; font-style: italic; }
.Estilo14 {font-family: Calibri; font-size: 12px; color: #333333; font-weight: bold; }
.Estilo12 {font-family: Calibri; font-size: 12px; color: #333333; font-style: italic; }
-->
</style>
<script type="text/javascript">


function objetoAjax(){
	var xmlhttp=false;
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
		try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (E) {
			xmlhttp = false;
  		}
	}

	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
		xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}

function objetoAjax2(){
	var xmlhttp=false;
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
		try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (E) {
			xmlhttp = false;
  		}
	}

	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
		xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}

// BUSQUEDA DE VIAJES EN INDICE DE VIAJES:
function buscakardex(){

	divResultado = document.getElementById('buscakardex');
	var fec_desde = document.getElementById('fec_desde').value;
	var fec_hasta  = document.getElementById('fec_hasta').value;

	if(fec_desde > fec_hasta)
	{
		alert("Seleccione un rango de fecha correcto.");return;
	}

    divResultado.innerHTML= '<img src="ajax-loader.gif"  WIDTH=200  HEIGHT=40>';

	ajax = objetoAjax();

	ajax.open("POST", "sisgen_kardex.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divResultado.innerHTML = ajax.responseText
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("&fec_desde="+fec_desde+"&fec_hasta="+fec_hasta)


}
function buscacount(){


	divResultado2 = document.getElementById('message2');
	/*
	if(_fechade == "" || _fechaa == "")
	{
		alert("Debe seleccionar un rango de Fechas válido");return;
	}	*/
    //divResultado2.innerHTML= '<img src="../../../loading.gif">';

	ajax2 = objetoAjax2();

	ajax2.open("POST", "sisgen_count.php",true);
	ajax2.onreadystatechange=function() {
		if (ajax2.readyState==4) {
			divResultado2.innerHTML = ajax2.responseText
		}
	}
	ajax2.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax2.send()


}

function funciones(){
	/*console.time("t1");
	buscakardex();
	console.timeEnd("t1");
	alert (console.timeEnd);
	setTimeout("buscacount()",3000);*/

	buscakardex();
	setTimeout("buscacount()",3000);
}

// FUNCIONES SISGEN
function cargar_data_sisgen3(){
	divResultado = document.getElementById('message');
	divResultado.innerHTML= '<img src="ajax-loader.gif"  WIDTH=200  HEIGHT=40>';
	//tomamos el valor de la lista desplegable
	//var _cmb_tipkar = document.getElementById('cmb_tipkar').value;
	var fec_desde = document.getElementById('fec_desde').value;
	var fec_hasta = document.getElementById('fec_hasta').value;
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","xmlcompraventa.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
			}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("&fec_desde="+fec_desde+"&fec_hasta="+fec_hasta)

	}


function enviar_data_sisgen(){
	divResultado = document.getElementById('message');
	divResultado.innerHTML= '<img src="ajax-loader.gif"  WIDTH=200  HEIGHT=40>';
	//tomamos el valor de la lista desplegable
	var _formu = (0);
	var fec_desde = document.getElementById('fec_desde').value;
	var fec_hasta = document.getElementById('fec_hasta').value;
	var cantidad = document.getElementById('txtCantidad').value;
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
	//datoscliente.php
	ajax.open("POST","enviarxml.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("formu="+cantidad+"&fec_desde="+fec_desde+"&fec_hasta="+fec_hasta)

	}

	function fShowRO()
	{
		var _desde    = document.getElementById('fec_desde').value;
		var _hasta    = document.getElementById('fec_hasta').value;

		window.open('list_error_sisgen.php?initialDate='+_desde+'&finalDate='+_hasta);
	}

function verreporte(name,id){
	//document.location.href="consultas/verkardex.php?kardex="+kardex;

	var fec_desde = document.getElementById('fec_desde').value;
	var fec_hasta = document.getElementById('fec_hasta').value;

	window.open("sisgen_errores_1.php?kardex="+name+"&fec_desde="+fec_desde+"&fec_hasta="+fec_hasta);
}


</script>

</head>

<?php
/*

$reconsulta= mysql_query("SET @numero=0;", $conn) or die(mysql_error());

 FECHA DE ESCRITURA BUSQUEDA
$consulta = mysql_query("SELECT @numero:=@numero+1 AS POSICION, IDKARDEX AS IDKARDEX, KARDEX AS KARDEX, KARDEX.IDTIPKAR AS TIPO_KARDEX, CODACTOS AS CODIGO_ACTO,
				CONTRATO AS CONTRATO, FECHAINGRESO AS FECHA_INGRESO, FECHACONCLUSION AS FECHA_CONCLUSION,
				NUMESCRITURA AS NUMERO_ESCRITURA, FECHAESCRITURA AS FECHA_ESCRITURA  FROM KARDEX ,tiposdeacto ta
				WHERE STR_TO_DATE(FECHAESCRITURA,'%Y-%m-%d') BETWEEN STR_TO_DATE('$desde','%Y-%m-%d')
				AND STR_TO_DATE('$hasta','%Y-%m-%d') AND SUBSTRING(KARDEX.codactos,1,3)=ta.idtipoacto
				AND numescritura <>'' AND cod_ancert <>'' ORDER BY KARDEX DESC  ", $conn) or die(mysql_error());

//FECHA DE MODIFICACION
$consulta = mysql_query("SELECT @numero:=@numero+1 AS POSICION, IDKARDEX AS IDKARDEX, KARDEX AS KARDEX, KARDEX.IDTIPKAR AS TIPO_KARDEX, CODACTOS AS CODIGO_ACTO,
				CONTRATO AS CONTRATO, FECHAINGRESO AS FECHA_INGRESO, FECHACONCLUSION AS FECHA_CONCLUSION,
				NUMESCRITURA AS NUMERO_ESCRITURA, FECHAESCRITURA AS FECHA_ESCRITURA  FROM KARDEX ,tiposdeacto ta
				WHERE STR_TO_DATE(FECHA_MODIFICACION,'%d/%m/%y') BETWEEN STR_TO_DATE('12/12/2016','%d/%m/%y')
				AND STR_TO_DATE('12/12/2016','%d/%m/%y') AND SUBSTRING(KARDEX.codactos,1,3)=ta.idtipoacto
				AND numescritura <>'' AND cod_ancert <>'' ORDER BY KARDEX DESC  ", $conn) or die(mysql_error());

$data = array();

	while($row = mysql_fetch_array($consulta)){

	if($row['TIPO_KARDEX']=='1'){$TIPO ='EP';}
	if($row['TIPO_KARDEX']=='2'){$TIPO ='NC';}
	if($row['TIPO_KARDEX']=='3'){$TIPO ='TV';}
	if($row['TIPO_KARDEX']=='4'){$TIPO ='GM';}
	if($row['TIPO_KARDEX']=='5'){$TIPO ='TE';}
	$idkardex=$row['IDKARDEX'];
	$posicion=$row['POSICION'];
	$kardex=$row['KARDEX'];
	$fecha_escritura=$row['FECHA_ESCRITURA'];
	$num_escritura=$row['NUMERO_ESCRITURA'];
	$contrato=$row['CONTRATO'];
	$data[] = $row;
	}*/

?>




<body style="background-color: none; overflow-y: hidden;" >

<div class="container"  style="width: 900px;margin-left: 20px; background-color: #fff;border: 5px solid #264965;
border-radius: 5px;  ">

	<div class="row">
		<h3 class="col-sm-5">Kardex Pendientes de Envio</h3>
		<div class="col-sm-2"></div>
		<div class="col-sm-1"></div>
		<div class="col-sm-1"></div>
		<div class="col-sm-1">
			<img src="logo.png" alt="...">
		</div>

	</div>


	<br>

	<div class="row">

				<label class="col-sm-2" >Fecha desde: </label>
				<div class="col-sm-3">
					<input name="fec_desde" type="text" value="<?php echo date("d/m/Y"); ?>" class="tcal form-control" id="fec_desde" maxlength="12" />
				</div>

			<label class="col-sm-2">Hasta:</label>
			<div class="col-sm-3">
				<input name="fec_hasta" type="text" value="<?php echo date("d/m/Y"); ?>" class="tcal form-control" id="fec_hasta" maxlength="12" />
			</div>




	</div>
	<br>
	<div class="row" >

		<div class="col-sm-5"></div>
		<div class="btn-group">


					<a class="btn btn-default " href="javascript:;"  id="btnBuscar" ><span class="glyphicon glyphicon-search" aria-hidden="true"> </span> BUSCAR</a>
					<a class="btn btn-default " href="javascript:;"  id="btnValidar" onclick="fShowRO();"><span class="glyphicon glyphicon-object-align-bottom" aria-hidden="true"> </span> VALIDAR</a>
					<a class="btn btn-default " href="javascript:;"  id="btnValidar" onclick="cargar_data_sisgen3();"><span class="glyphicon glyphicon-sort-by-attributes-alt" aria-hidden="true"> </span> GENERAR</a>

					<a class="btn btn-default " href="javascript:;"  id="btnValidar" onclick="enviar_data_sisgen();"><span class="glyphicon glyphicon-export" aria-hidden="true"> </span> ENVIAR</a>
					<a class="btn btn-default " href="javascript:;"  id="btnValidar" onclick="verreporte();"><span class="glyphicon glyphicon-modal-window" aria-hidden="true"> </span> REPORTE</a>
		</div>
	</div>

		<input type="hidden" id="txtCantidad" />
		<h4 align="center" id="message" style="font-family:fantasy, Geneva, sans-serif; font-size:15px; color:#036;"></h4>



 		 <div class="row" style="padding: 0 7px 0 7px;">
			<div class="panel panel-default">
				<div class="table-responsive">
					<table class="table table-fixed"  id="tblList">
						<thead>
							<tr>
								<th width="5%">ID</th>
								<th width="10%">TIPO</th>
								<th width="15%">KARDEX</th>
								<th width="20%">FECHA DE INSTRUMENTO</th>
								<th width="20%">Nº DE INSTRUMENTO</th>
								<th width="30%">CONTRATO</th>
							</tr>
						</thead>

						<tbody>

						</tbody>
					</table>
				</div>
			</div>
		</div>





</div>

<script type="text/javascript" src="../../../tcal.js"></script>
<script language="JavaScript" type="text/javascript" src="../../../ajax2.js"></script>
<script language="JavaScript" type="text/javascript" src="../../../includes/script1.js"></script>
<!-- <script src="../../../includes/jquery-1.8.3.js"></script> -->
<script type="text/javascript" src="../../../Libs/jquery/jquery-3.1.0.min.js"></script>
<script type="text/javascript" src="../../../Libs/bootstrap/js/bootstrap.min.js"></script>
<script src="../../../includes/js/jquery-ui-notarios.js"></script>

<script type="text/javascript">

	$("#btnBuscar").on('click',function(e){


	divResultado = document.getElementById('message');
	vstartDate = $('#fec_desde').val();
	vendDate = $('#fec_hasta').val();
	$.ajax({
		url:'sisgen_kardex_1.php',
		type:'POST',
		dataType:'json',
		data:{startDate:vstartDate,endDate:vendDate},
		beforeSend:function(){
			divResultado.innerHTML= '<img src="ajax-loader.gif"  WIDTH=200  HEIGHT=40>';
		},
		success : function(response){
			 html = '';
			 divResultado.innerHTML= '';
			 $('#tblList  tbody tr').remove();
			 x = 1;
			for(i  in response.list){

				html = html  + '<tr>';
				html = html  + '<td width="5%">'+x+'</td>';
				html = html  + '<td  width="10%">'+response.list[i].TIPO_KARDEX2+'</td>';
				html = html  + '<td width="15%"><a target="_blank"  href="../../../verkardex.php?kardex='+response.list[i].KARDEX+'&id='+response.list[i].IDKARDEX+'">' + response.list[i].KARDEX + '</a></td>';
				html = html  + '<td width="20%">'+response.list[i].FECHA_ESCRITURA+'</td>';
				html = html  + '<td width="20%">'+response.list[i].NUMERO_ESCRITURA+'</td>';
				html = html  + '<td  width="30%">'+response.list[i].CONTRATO+'</td>';



				html = html  + '</tr>';
				x = parseInt(x+1);
			}

			$('#message').text(response.cantidad);
			$('#txtCantidad').val(response.totalkardex);
			$('#tblList  tbody').append(html);



		}

	});

});




</script>




</body>

</html>
