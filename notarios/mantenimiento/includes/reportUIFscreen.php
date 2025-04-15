<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
// require_once("../../includes/gridRo.class.php");
 
$fechade=$_GET["fDesde"];
$fechaha=$_GET["fHasta"];
 
 function holaacentos($rb){ 
        ## Sustituyo caracteres en la cadena final
        $rb = str_replace("Ã¡","A", $rb);
        $rb = str_replace("Ã©","E", $rb);
        $rb = str_replace("Ã­","I", $rb);
        $rb = str_replace("ï¿½","I", $rb);
        $rb = str_replace("Ã³","O", $rb);
        $rb = str_replace("Ãº","U", $rb);
        $rb = str_replace("n~","#", $rb);
        $rb = str_replace("ÃƒÂ¡","A", $rb);
        $rb = str_replace("Ã±","#", $rb);
        $rb = str_replace("Ã'","#", $rb);
        $rb = str_replace("ÃƒÂ±","#", $rb);
        $rb = str_replace("n~","#", $rb);
        $rb = str_replace("Ãš","U", $rb);
        $rb = str_replace("Ã?","#", $rb);
		$rb = str_replace("Ã??","#", $rb);
		$rb = str_replace("À?","#", $rb);
		$rb = str_replace("À‘","#", $rb);
		$rb = str_replace("À‘","#", $rb);
		$rb = str_replace("Ã‘","#", $rb);
		$rb = str_replace("ã¡","A", $rb);
        $rb = str_replace("ã©","E", $rb);
        $rb = str_replace("ã­","I", $rb);
        $rb = str_replace("ï¿½","I", $rb);
        $rb = str_replace("ã³","O", $rb);
        $rb = str_replace("ãº","U", $rb);
        $rb = str_replace("n~","#", $rb);
        $rb = str_replace("ãƒÂ¡","A", $rb);
        $rb = str_replace("ã±","#", $rb);
        $rb = str_replace("Ã'","#", $rb);
        $rb = str_replace("ãƒÂ±","#", $rb);
        $rb = str_replace("n~","#", $rb);
        $rb = str_replace("ãš","Ú", $rb);
        $rb = str_replace("ã?","#", $rb);
		$rb = str_replace("ã??","#", $rb);
		$rb = str_replace("À?","#", $rb);
		$rb = str_replace("À‘","#", $rb);
		$rb = str_replace("Ã?","#", $rb);
		$rb = str_replace("ã‘","#", $rb);
		$rb = str_replace("*","&", $rb);
		$rb = str_replace("Ô","O", $rb);
		$rb = str_replace("?","#", $rb);
		$rb = str_replace("ñ","#", $rb);
		$rb = str_replace("ÃŠ","U", $rb);
		$rb = str_replace("ô","O", $rb);
		$rb = str_replace("?","", $rb);
		$rb = str_replace("*","", $rb);
		$rb = str_replace("QQ11QQ", "", $rb);
		$rb = str_replace("QQ22KK", "", $rb);
		$rb = str_replace("Á","A", $rb);
		$rb = str_replace("É","E", $rb);
		$rb = str_replace("Í","I", $rb);
		$rb = str_replace("Ó","O", $rb);
		$rb = str_replace("Ú","U", $rb);	
 		$rb = str_replace("Ú","U", $rb);
		$rb = str_replace("Ã","A", $rb);
		$rb = str_replace("I","I", $rb);
		$rb = str_replace("A","A", $rb);
		$rb = str_replace("Á","A", $rb);
		$rb = str_replace("Í","I", $rb);
		$rb = str_replace("Á","A", $rb);
		$rb = str_replace("Í","I", $rb);
		$rb = str_replace("AÂ","A", $rb);
		$rb = str_replace("ÁÂ","A", $rb);
		$rb = str_replace("IÂ","I", $rb);
		$rb = str_replace("Ã‘","#", $rb);
		$rb = str_replace("é","E", $rb);
		$rb = str_replace("ú","U", $rb);
		$rb = str_replace("Ó","O", $rb);
		$rb = str_replace("ó","O", $rb);
        $rb = str_replace("º","", $rb);
		$rb = str_replace(",","", $rb);
		$rb = str_replace("|","", $rb);	
		$rb = str_replace("Ö","O", $rb);
		$rb = str_replace("í","i", $rb);
		$rb = str_replace("N°","", $rb);
		$rb = str_replace("N°","", $rb);
		$rb = str_replace('"',"", $rb);
		$rb = str_replace('1°',"1", $rb);
		$rb = str_replace('2°',"2", $rb);
		$rb = str_replace('3°',"3", $rb);
		$rb = str_replace('4°',"4", $rb);
		$rb = str_replace('5°',"5", $rb);
		$rb = str_replace('6°',"6", $rb);
		$rb = str_replace('7°',"7", $rb);
		$rb = str_replace('8°',"8", $rb);
		$rb = str_replace('9°',"9", $rb);
		$rb = str_replace('0°',"0", $rb);
		$rb = str_replace('´',"", $rb);
        $rb = str_replace('N °',"N", $rb);
		$rb = str_replace(' °',"", $rb);
		$rb = str_replace('°',"", $rb);
		$rb = str_replace('¿',"", $rb);
		$rb = str_replace('?',"", $rb);
		$rb = str_replace(array('á','à','â','ã','ª','ä'),"a",$rb);
		$rb = str_replace(array('Á','À','Â','Ã','Ä'),"A",$rb);
		$rb = str_replace(array('Í','Ì','Î','Ï'),"I",$rb);
		$rb = str_replace(array('í','ì','î','ï'),"i",$rb);
		$rb = str_replace(array('é','è','ê','ë'),"e",$rb);
		$rb = str_replace(array('É','È','Ê','Ë'),"E",$rb);
		$rb = str_replace(array('ó','ò','ô','õ','ö','º'),"o",$rb);
		$rb = str_replace(array('Ó','Ò','Ô','Õ','Ö'),"O",$rb);
		$rb = str_replace(array('ú','ù','û','ü'),"u",$rb);
		$rb = str_replace(array('Ú','Ù','Û','Ü'),"U",$rb);
	    return $rb;
    }  
?>
<head>
<meta http-equiv="Content-Type:   application/vnd.ms-excel; charset=utf-8" />

<style type="text/css">
.titu_uif {
	font-family: Verdana, Geneva, sans-serif;
	font-size:9px;
	color:#FFFFFF;s
}
</style>
<style>
.cur{cursor:pointer; font-family: Arial, Helvetica, sans-serif; font-size: 10px;}

.Estilo26 {font-family: Arial, Helvetica, sans-serif; font-size: 10px; }
.Estilo28 {font-family: Arial, Helvetica, sans-serif; font-size: 10px; color: #FFFFFF; }
.Estilo31 {font-family: Arial, Helvetica, sans-serif; font-size: 10px; color: #376091; }
.Estilo33 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 20px;
	color: #1F497D;
	font-weight: bold;
}
.Estilo41 {
	font-family: Arial, Helvetica, sans-serif;



	font-size: 12px;
	font-weight: bold;
}

</style>
<link href="../../includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>
<link href="../../includes/Css/bootstrap.css" rel="stylesheet" type="text/css"/>

<script src="../../includes/jquery-1.8.3.js"></script>

<script type="text/javascript" src="../../includes/js/bootstrap.js"></script>
<script src="../../includes/js/jquery-ui-notarios.js"></script>

	<title></title>
    <script language="javascript" type="text/javascript">
	function CreateObjectAjax(){
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

function AjaxReturn(url,_nom){
		  ajax = CreateObjectAjax();
		  var _pag = '';
		    ajax.open('GET', url,true);
		    ajax.onreadystatechange = function(){
		    if(ajax.readyState == 4 && ajax.status==200)
			{
				if(ajax.responseText=='' )
					{
						alert('Txt RO Generado Correctamente');
						window.open('../includes/DownloadtxtUIF.php?nom	='+_nom);
					}
		     _pag = ajax.responseText;
			 //obj.innerHTML = _pag;
		    }
		  }
	  ajax.send(null);
	}
	
		function fExporta() // EXCEL
			{
				
					var _nom = prompt('Ingrese nombre de archivo a exportar','ingrese nombre');
					
					if(_nom){
    					//window.open('reportUIFexporta.php?nord=<?php echo $idkardex;?>&fDesde=<?php echo $fDesde;?>&fHasta=<?php echo $fHasta;?>&nom='+_nom);
					
						//window.open('reportUIFexporta.php?nom='+_nom); // pierde los styles y utf
						window.open('exceluif.php?fDesde=<?php echo $fDesde;?>&fec_hasta=<?php echo $fHasta;?>&nom='+_nom);	
					} else {
   						 //alert("Cancelado..!!");
					}
					
			}
			
			
		function fExportatxt()
		{
			window.open('exportaro_xxx.php?fec_desde=<?php echo $fechade;?>&fhasta=<?php echo $fechaha?>');	
			
		}


///////////////////
function fShowDetail(obj)

		{ 
			var _id = obj.cells[0].innerHTML;
			var _gridView = document.getElementById('TbPRO');
			var _rows  = _gridView.rows.length;
			for(i=1;i<=_rows-1;i++)
				{
					if(i%2==0)
						{
							_gridView.rows[i].style.backgroundColor = '#FFFFFF';
						}
					else
						{
							_gridView.rows[i].style.backgroundColor = '#FFFFFF';
						}
				}
			obj.style.backgroundColor = '#E8E8E8'; 
		}
	

function fInsertDatos()
	{
		var _cod_sujeto  = $("#cod_sujeto").val();
		var _cod_oficial = $("#cod_oficial").val();
		$('<div id="div_datacab" ></div>').load('Datos_cabecera.php?cod_sujeto'+_cod_sujeto+'&cod_oficial='+_cod_oficial)
	.dialog({
					autoOpen: true,
					position :["left","top"],
					width   : 500,
					height  : 210,
					modal:false,
					resizable:false,
					buttons: [{id: "btnAceptar", text: "Aceptar",click: function() { fPassData();$(this).dialog("destroy").remove(); }},
					{id: "btnCancelar", text: "Cancelar",click: function() {$(this).dialog("destroy").remove(); }}],
					title:'Datos de la cabecera del RO'
					
					});
					//$(".ui-dialog-titlebar").hide();	
	}
	
	
	function fPassData()
	{
		// texts del div
		var _cod_sujeto_d  = $("#cod_sujeto_d").val();
		var _cod_oficial_d = $("#cod_oficial_d").val();
		
		// texts de la página
		$("#cod_sujeto").val(_cod_sujeto_d);
		$("#cod_oficial").val(_cod_oficial_d); 
	}
	
	
	function fCopyData1(_data){$("#cod_sujeto").val(_data);}
	function fCopyData2(_data){$("#cod_oficial").val(_data);}
	
	</script>

<script language="javascript">
$(document).ready(function() {
	$(".botonExcel").click(function(event) {
		$("#datos_a_enviar").val( $("<div>").append( $("#Exportar_a_Excel").eq(0).clone()).html());
		$("#FormularioExportacion").submit();
});
});
</script>
<style type="text/css">
.botonExcel{cursor:pointer;}
</style>
</head>
<body>

    <div style="display:block;
    width:100%;
    height:80px;
    overflow:hidden;
    position:fixed;
    top:0px;
    border:#fff 1px;
    margin:0 0 0 0px;
    padding:0;" id="div_cabecera">
    <form action="ficheroExcel.php" method="post" target="_blank" id="FormularioExportacion">
    <table width="100%"><tr class="btn-success"><td width="1%" height="53" class="btn-primary"> 
    </td><td width="35%" class="btn-primary" ><h4>REGISTRO DE OPERACIONES UIF</h4></td>
    <td width="64%" class="btn-primary"><h4>
Exportar a Excel :  <img src="../../images/xls.png"  title="exportar a excel" class="botonExcel" />
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
&nbsp;&nbsp; Exportar Archivo RO : <img src="../../images/file_txt.png" width="35" height="35" onClick="fExportatxt();" class="cur" title="exportar a excel"/></h4></td>   </tr>
	</table> </form>  </div> 
    <div style="margin-top:60px; width:100%;">
   <table width="6528" id="Exportar_a_Excel" border="1" style="font-family:'Arial Narrow'; font-size:10px;" bordercolor="#4F81BD" cellpadding="00" cellspacing="0">
  <col width="80" span="13" />
  <col width="97" />
  <col width="119" />
  <col width="115" />
  <col width="110" />
  <col width="119" />
  <col width="80" span="5" />
  <col width="208" />
  <col width="114" />
  <col width="130" />
  <col width="80" span="3" />
  <col width="132" />
  <col width="147" />
  <col width="118" />
  <col width="95" />
  <col width="87" />
  <col width="92" />
  <col width="101" />
  <col width="92" />
  <col width="86" />
  <col width="82" />
  <col width="80" span="12" />
  <col width="97" />
  <col width="89" />
  <col width="128" />
  <col width="80" />
  <col width="88" />
  <col width="91" />
  <col width="146" />
  <tr>
    <td width="62" rowspan="3" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px" >&nbsp;</td>
    <td width="59" rowspan="3" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="titu_uif">Codigo de Fila</span></td>
    <td height="28" colspan="11" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="titu_uif">Datos    de identificacion del registro de la operacion</span></td>
    <td colspan="5" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="titu_uif">Participacion    y representacion de las personas involucradas en la operacion</span></td>
    <td colspan="26" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="titu_uif">Datos de identificacion de las personas que    intervienen en la operacion</span></td>
    <td colspan="14" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="titu_uif">Datos relacionados a la descripcion de la    operacion (Acto/Contrato extendido en IPNP)</span></td>
  </tr>
  <tr>
    <td width="68" rowspan="2" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="titu_uif">Numero Registro de la Operacion</span></td>
    <td width="63" rowspan="2" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="titu_uif">Tipo de    envio del RO</span></td>
    <td colspan="7" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="titu_uif">Instrumento    Publico Notarial Protocolar 
      (IPNP)</span></td>
    <td width="64" rowspan="2" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="titu_uif">Modalidad    de la operacion</span></td>
    <td width="91" rowspan="2" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="titu_uif">Cantidad    de operaciones individuales que contiene la operacion Multiple</span></td>
    <td colspan="3" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="titu_uif">Roles del Participante</span></td>
    <td colspan="2" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="titu_uif">Representacion</span></td>
    <td width="103" rowspan="2" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="titu_uif">Condicion de residencia (Declarada en el IPNP)</span></td>
    <td width="67" rowspan="2" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="titu_uif">Tipo de persona</span></td>
    <td colspan="2" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="titu_uif">Documento de identidad</span></td>
    <td width="149" rowspan="2" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="titu_uif">Numero de Registro unico de Contribuyente (RUC)</span></td>
    <td colspan="3" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="titu_uif">Nombre completo de la persona</span></td>
    <td width="88" rowspan="2" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="titu_uif">Pais de nacionalidad</span></td>
    <td width="96" rowspan="2" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="titu_uif">Fecha de nacimiento</span></td>
    <td width="78" rowspan="2" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="titu_uif">Estado civil</span></td>
    <td colspan="4" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="titu_uif">Ocupacion, oficio, profesion, actividad    economica u objeto social y cargo</span></td>
    <td colspan="2" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="titu_uif">Inscripcion en SUNARP de la Representacion    (Personas Juridicas)</span></td>
    <td colspan="5" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="titu_uif">Domicilio y telefonos</span></td>
    <td width="75" rowspan="2" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="titu_uif">Participacion del conyuge</span></td>
    <td colspan="3" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="titu_uif">Nombre completo del conyuge</span></td>
    <td width="185" rowspan="2" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="titu_uif">Tipo de fondos, bienes u otros activos con que se    realizo la operacion</span></td>
    <td width="78" rowspan="2" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="titu_uif">Tipo de operacion</span></td>
    <td width="155" rowspan="2" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="titu_uif">Forma de pago mediante la cual se realizo la    operacion </span></td>
    <td width="142" rowspan="2" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="titu_uif">Oportunidad de pago de la operacion</span></td>
    <td width="134" rowspan="2" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="titu_uif">Descripcion de la oportunidad de pago 
      (en caso de otros)</span></td>
    <td rowspan="2" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="titu_uif">Origen de los fondos, bienes u otros activos involucrados en la    operacion</span></td>
    <td width="69" rowspan="2" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="titu_uif">Moneda en que se realizo la operacion 
      (Codificacion ISO.4217)</span></td>
    <td colspan="3" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px" ><span class="titu_uif">Montos de la operacion</span></td>
    <td width="57" rowspan="2" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="titu_uif">Tipo de cambio</span></td>
    <td colspan="3" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="titu_uif">Inscripcion en SUNARP 
      del bien materia de la operacion </span></td>
  </tr>
  <tr>
    <td width="61" height="65" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="titu_uif">Tipo de IPNP</span></td>
    <td width="86" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="titu_uif">Numero    del IPNP</span></td>
    <td width="84" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="titu_uif">Fecha    del IPNP</span></td>
    <td width="90" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="titu_uif">Numero    del IPNP que se aclara</span></td>
    <td width="79" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="titu_uif">Fecha    del IPNP que se aclara</span></td>
    <td width="81" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="titu_uif">Conclusion</span></td>
    <td width="95" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="titu_uif">Fecha    de la firma por participante</span></td>
    <td width="95" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="titu_uif">Representante</span></td>
    <td width="127" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="titu_uif">Persona    en cuyo nombre se realiza la operacion</span></td>
    <td width="121" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="titu_uif">Persona    a favor de quien se realiza la operacion</span></td>
    <td width="105" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="titu_uif">Persona    a la que se representa</span></td>
    <td width="97" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="titu_uif">Tipo    de representacion</span></td>
    <td width="70" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="titu_uif">Tipo</span></td>
    <td width="113" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="titu_uif">Numero</span></td>
    <td width="349" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="titu_uif">Apellido    paterno / Razon social</span></td>
    <td width="144" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="titu_uif">Apellido    materno</span></td>
    <td width="254" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="titu_uif">Nombres</span></td>
    <td width="79" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="titu_uif">Codigo    de Ocupacion de persona natural</span></td>
    <td width="318" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="titu_uif">Descripcion    del objeto social 
      (solo personas juridicas y otros)</span></td>
    <td width="73" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="titu_uif">Codigo    CIIU (personas juridicas)</span></td>
    <td width="60" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="titu_uif">Codigo    de Cargo</span></td>
    <td width="169" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="titu_uif">Codigo    de la Zona Registral</span></td>
    <td width="143" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="titu_uif">Numero    de la 
      Partida Registral</span></td>
    <td width="327" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="titu_uif">Tipo,    nombre y numero de la via</span></td>
    <td width="71" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="titu_uif">Departamento</span></td>
    <td width="58" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="titu_uif">Provincia</span></td>
    <td width="43" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="titu_uif">Distrito</span></td>
    <td width="80" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="titu_uif">Teléfonos</span></td>
    <td width="57" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="titu_uif">Apellido    paterno</span></td>
    <td width="57" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="titu_uif">Apellido    materno</span></td>
    <td width="63" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="titu_uif">Nombres</span></td>
    <td width="122" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="titu_uif">Monto    total de la operacion</span></td>
    <td width="121" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="titu_uif">Monto    por participante</span></td>
    <td width="117" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="titu_uif">Monto    relacionado a los tipos de fondos, bienes u otros activos</span></td>
    <td width="79" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="titu_uif">Inscripicion    registral del bien</span></td>
    <td width="71" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="titu_uif">Codigo    de la Zona Registral</span></td>
    <td width="144" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="titu_uif">Numero    de partida registral del bien materia de la operacion</span></td>
  </tr>
  <tr>
    <td height="23" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><div style="width:70px;"><span class="titu_uif">kardex</span></div></td>
    <td align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><div style="width:60px;"><span class="titu_uif">item: 1</span></div></td>
    <td align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><div style="width:70px;"><span class="titu_uif">2</span></div></td>
    <td align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><div style="width:70px;"><span class="titu_uif">3</span></div></td>
    <td width="61" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><div style="width:60px;"><span class="titu_uif">4</span></div></td>
    <td width="86" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="titu_uif">5</span></td>
    <td width="84" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="titu_uif">6</span></td>
    <td width="90" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="titu_uif">7</span></td>
    <td width="79" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="titu_uif">8</span></td>
    <td width="81" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="titu_uif">9</span></td>
    <td width="95" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="titu_uif">10</span></td>
    <td width="64" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="titu_uif">11</span></td>
    <td width="91" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="titu_uif">12</span></td>
    <td width="95" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="titu_uif">13</span></td>
    <td width="127" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="titu_uif">14</span></td>
    <td width="121" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="titu_uif">15</span></td>
    <td width="105" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="titu_uif">16</span></td>
    <td width="97" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="titu_uif">17</span></td>
    <td width="103" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="titu_uif">18</span></td>
    <td width="67" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="titu_uif">19</span></td>
    <td width="70" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="titu_uif">20</span></td>
    <td width="113" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="titu_uif">21</span></td>
    <td width="149" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="titu_uif">22</span></td>
    <td width="349" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="titu_uif">23</span></td>
    <td width="144" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="titu_uif">24</span></td>
    <td width="254" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="titu_uif">25</span></td>
    <td width="88" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="titu_uif">26</span></td>
    <td width="96" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="titu_uif">27</span></td>
    <td width="78" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="titu_uif">28</span></td>
    <td width="79" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="titu_uif">29</span></td>
    <td width="318" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="titu_uif">30</span></td>
    <td width="73" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="titu_uif">31</span></td>
    <td width="60" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="titu_uif">32</span></td>
    <td width="169" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="titu_uif">33</span></td>
    <td width="143" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="titu_uif">34</span></td>
    <td width="327" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="titu_uif">35</span></td>
    <td width="71" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="titu_uif">36</span></td>
    <td width="58" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="titu_uif">37</span></td>
    <td width="43" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="titu_uif">38</span></td>
    <td width="80" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="titu_uif">39</span></td>
    <td width="75" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="titu_uif">40</span></td>
    <td width="57" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="titu_uif">41</span></td>
    <td width="57" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="titu_uif">42</span></td>
    <td width="63" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="titu_uif">43</span></td>
    <td width="185" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="titu_uif">44</span></td>
    <td width="78" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="titu_uif">45</span></td>
    <td width="155" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="titu_uif">46</span></td>
    <td width="142" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="titu_uif">47</span></td>
    <td width="134" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="titu_uif">48</span></td>
    <td width="224" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="titu_uif">49</span></td>
    <td width="69" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="titu_uif">50</span></td>
    <td width="122" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="titu_uif">51</span></td>
    <td width="121" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="titu_uif">52</span></td>
    <td width="117" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="titu_uif">53</span></td>
    <td width="57" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="titu_uif">54</span></td>
    <td width="79" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="titu_uif">55</span></td>
    <td width="71" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="titu_uif">56</span></td>
    <td width="144" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="titu_uif">57</span></td>
  </tr>
  <?php
      
include('conexion.php');
$sqlarchi = "SELECT * FROM confinotario where idnotar='1'";
$resultarchi=mysql_query($sqlarchi,$conn);
$rowarchi = mysql_fetch_array($resultarchi);
$ano=date('Y');

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$sec=0;
$correlativo=0;

$sqlkardex = "SELECT kardex_ro.kardex, kardex_ro.idtipkar, kardex_ro.numescritura, kardex_ro.fechaescritura, kardex_ro.fechaconclusion, kardex_ro.uif, kardex_ro.codactos, 
patrimonial.importetrans, patrimonial.idmon, patrimonial.exhibiomp, patrimonial.fpago, patrimonial.idoppago, patrimonial.idtipoacto, patrimonial.kardex AS 'karpatri', kardex_ro.tipo,patrimonial.tipocambio FROM kardex_ro LEFT JOIN patrimonial 
ON patrimonial.kardex = kardex_ro.kardex AND kardex_ro.codactos=patrimonial.idtipoacto WHERE (patrimonial.idmon='1' AND patrimonial.importetrans>='7500') OR (patrimonial.idmon='2' AND patrimonial.importetrans>='2500') 
OR kardex_ro.uif='048' OR kardex_ro.uif='050' OR kardex_ro.uif='051' OR kardex_ro.uif='052' OR kardex_ro.uif='053' OR kardex_ro.uif='054' OR kardex_ro.uif='055' OR kardex_ro.uif='037' OR kardex_ro.uif='038' OR kardex_ro.uif='039'
OR kardex_ro.uif='040' OR kardex_ro.uif='041' OR kardex_ro.uif='042' OR kardex_ro.uif='043' OR kardex_ro.uif='044' OR kardex_ro.uif='045'";

$result=mysql_query($sqlkardex,$conn);
//aqui empieza el while de seleccion de kardex
while($row = mysql_fetch_array($result)) {
      
   $kardex=$row['kardex']; $idtipkar=$row['idtipkar']; $numescritura=$row['numescritura']; $fechaescritura=$row['fechaescritura']; 
  $uif=$row['uif']; $fechaconclusion=$row['fechaconclusion']; $codactos=$row['codactos']; $tipoenvio=$row['tipo']; $modalidad="U"; 
  $idtipoacto=$row['idtipoacto']; $importetotal=$row['importetrans']; $exibiomp=$row['exhibiomp'];  $tipomoneda=$row['idmon']; 
  $formadepagoo=$row['fpago'];  $tipoopera=$row['uif']; $karpatri=$row['karpatri']; 
  // tipo cambio
      if($row['tipocambio']!=''){
	  $tipca=explode(".",$row['tipocambio']);
	  $tipcambio=$tipca[0].".".substr(($tipca[1].'00'),0,2);
      }else{
	  $tipcambio='0.00'; 
	  }
      
	  
     
      
  
  
  /// tipo de kardex ///////////////////////
  switch ($idtipkar) {
    case "E":
        $idtipkarxls= "E : Escritura P&uacute;blica";
        break;
    case "T":
        $idtipkarxls= "T : Actas De Transferencia De Bienes Muebles Registrables";
        break;
    case "G":
        $idtipkarxls= "G : Constituci&oacute;n De Garant&iacute;a Mobiliaria Y Otras Afectaciones Sobre Bienes Muebles";
        break;
    }

   /// tipo de operacion ///////////////////////
   switch ($tipoopera) {
    case "001":
        $tipooperaxls= "001: Anticresis";
        break;
    case "002":
        $tipooperaxls= "002: Arrendamiento";
        break;
    case "003":
        $tipooperaxls= "003: Sub Arrendamiento";
        break;
	case "004":
        $tipooperaxls= "004: Arrendamiento Financiero (Leasing)";
        break;
    case "005":
        $tipooperaxls= "005: Anticipo De Leg&iacute;tima";
        break;
    case "006":
        $tipooperaxls= "006: Cesi&oacute;n";
        break;
	case "007":
        $tipooperaxls= "007: Cesi&oacute;n Acciones Y Derechos";
        break;
    case "008":
        $tipooperaxls= "008: Contrato De Suministro";
        break;
    case "009":
        $tipooperaxls= "009: Compraventa De Bien Mueble";
        break;
	case "010":
        $tipooperaxls= "010: Compraventa De Bien Mueble Con Arras Confirmatorias";
        break;
    case "011":
        $tipooperaxls= "011: Compraventa De Bien Mueble Con Arras De Retractaci&oacute;n";
        break;
    case "012":
        $tipooperaxls= "012: Compraventa De Bien Inmueble ";
        break;
	case "013":
        $tipooperaxls= "013: Compraventa De Bien Inmueble Con Arras Confirmatorias";
        break;
    case "014":
        $tipooperaxls= "014: Compraventa De Bien Inmueble Con Arras De Retractaci&oacute;n";
        break;
	case "015":
        $tipooperaxls= "015: Colaboraci&oacute;n Empresarial";
        break;
    case "016":
        $tipooperaxls= "016: Donaci&oacute;n";
        break;
	case "017":
        $tipooperaxls= "017: Derecho De Superficie";
        break;
    case "018":
        $tipooperaxls= "018: Fideicomiso";
        break;
	case "019":
        $tipooperaxls= "019: Garant&iacute;a Mobiliaria";
        break;
    case "020":
        $tipooperaxls= "020: Hipoteca";
        break;
	case "021":
        $tipooperaxls= "021: Uso";
        break;
    case "022":
        $tipooperaxls= "022: Usufructo";
        break;
	case "023":
        $tipooperaxls= "023: Permuta";
        break;
    case "024":
        $tipooperaxls= "024: Pr&eacute;stamo";
        break;
	case "025":
        $tipooperaxls= "025: Adjudicaci&oacute;n Por Disoluci&oacute;n De Persona Jur&iacute;dica";
        break;
    case "026":
        $tipooperaxls= "026: Levantamiento De Hipoteca";
        break;
	case "027":
        $tipooperaxls= "027: Cancelaci&oacute;n De Garant&iacute;a Mobiliaria";
        break;
    case "028":
        $tipooperaxls= "028: Cancelaci&oacute;n De Pr&eacute;stamo";
        break;
	case "029":
        $tipooperaxls= "029: Leaseback";
        break;
    case "030":
        $tipooperaxls= "030: Factoring";
        break;
	case "031":
        $tipooperaxls= "031: Underwriting";
        break;
    case "032":
        $tipooperaxls= "032: Transferencia De Derechos Mineros";
        break;
	case "033":
        $tipooperaxls= "033: Otorgamiento De Escritura P&uacute;blica";
        break;
	case "034":
        $tipooperaxls= "034: Divis&oacute;n Y Partici&oacute;n";
        break;
	case "035":
        $tipooperaxls= "035: Adjudicaciòn De Bienes";
        break;
	case "036":
        $tipooperaxls= "036: Daci&oacute;n En Pago";
        break;
	case "037":
        $tipooperaxls= "037: Constituci&oacute;n Social De Sociedad Anonima";
        break;
	case "038":
        $tipooperaxls= "038: Constituci&oacute;n Social De S.R.Ltda.";
        break;
	case "039":
        $tipooperaxls= "039: Constituci&oacute;n Social De Sociedad Civil De Responsabilidad Limitada";
        break;
	case "040":
        $tipooperaxls= "040: Constituci&oacute;n Social De E.I.R.L.";
        break;
	case "041":
        $tipooperaxls= "041: Constituci&oacute;n Social De Sociedad En Comandita";
        break;
	case "042":
        $tipooperaxls= "042: Constituci&oacute;n De Asociaci&oacute;n";
        break;
	case "043":
        $tipooperaxls= "043: Constituci&oacute;n De Fundaci&oacute;n";
        break;
	case "044":
        $tipooperaxls= "044: Constituci&oacute;n De Comit&eacute;";
        break;
	case "045":
        $tipooperaxls= "045: Aumento De Capital Social";
        break;
	case "046":
        $tipooperaxls= "046: Fusion Por Absorci&oacute;n";
        break;
	case "047":
        $tipooperaxls= "047: Establecimiento De Sucursales";
        break;
	case "048":
        $tipooperaxls= "048: Constituci&oacute;n De Sucursal De Persona Jur&iacute;dica Extranjera";
        break;
	case "049":
        $tipooperaxls= "049: Transferencia De Participaciones Sociales";
        break;
	case "050":
        $tipooperaxls= "050: Transferencia De Participaciones Sociales A Titulo Oneroso";
        break;
	case "051":
        $tipooperaxls= "051: Transferencia De Participaciones Sociales A Titulo Gratuito";
        break;
	case "052":
        $tipooperaxls= "052: Transferencia De Acciones A Titulo Oneroso";
        break;
	case "053":
        $tipooperaxls= "053: Transferencia De Acciones A Titulo Gratuito";
        break;
	case "054":
        $tipooperaxls= "054: Transferencia De Marca A Titulo Oneroso";
        break;
	case "055":
        $tipooperaxls= "055: Transferencia De Marca A Titulo Gratuito";
        break;
	case "056":
        $tipooperaxls= "056: Contrato Innominado";
        break;
	case "999":
        $tipooperaxls= "999: Otro";
        break;
    }
   

  $tiempo = explode ("-", $fechaescritura);
  $fechas = $tiempo[0] . "" . $tiempo[1] . "" . $tiempo[2];
  
  $fec_mes_next = explode ("/", $fechaha);
  $fecha_mes =  intval($fec_mes_next[1]);
  $fecha_ano =  intval($fec_mes_next[2]);
  
  if($fecha_mes<>12){
	 $mes_next=$fecha_mes+1;
	 if(strlen($mes_next)<>2){$cadena_mes="0".$mes_next;}else{$cadena_mes=$mes_next;}
	 $fecha_next="01/".$cadena_mes."/".$fecha_ano; 
	 }
  else{
	 $cadena2=$fecha_ano+1;
	 $fecha_next="01/01/".$cadena2; 
	 }

  
	  $fecha1 = explode ("/", $fechaconclusion);
	  $fec1=intval($fecha1[2].$fecha1[1].$fecha1[0]);
	
	  $fecha2 = explode ("/", $fecha_next);
	  $fec2=intval($fecha2[2].$fecha2[1].$fecha2[0]);
	  
	  
	  if($fec1==0){ $valor_conclu="NO"; }else{ $valor_conclu="SI";}
	  
	  if($valor_conclu=="NO"){ $conclu='N : No Concluido'; }
	  if($valor_conclu=="SI"){ if($fec1<$fec2){ $conclu='C : Concluido'; }else{ $conclu='N : No Concluido';} }
     
	 $opopagoxls=$row['idoppago'];
	 
	 switch ($opopagoxls) {
							case "01":
								$opagoxls= "01: A La Firma Del Contrato/Minuta";
								break;
							case "02":
								$opagoxls= "02: A La Firma Del Acta De Transferencia";
								break;
							case "03":
								$opagoxls= "03: A La Firma Del Instrumento P&uacute;blico Notarial Protocolar";
								break;
							case "04":
								$opagoxls= "04: Contra La Inscripci&oacute;n Del Bloqueo Registral";
								break;							
							case "05":
								$opagoxls= "05: Contra La Inscripci&oacute;n De La Hipoteca";
								break;							
							case "06":
								$opagoxls= "06: Con La Entrega F&iacute;sica Del Bien";
								break;
							case "07":
								$opagoxls= "07: Con Anterioridad A La Firma De La Minuta";
								break;
							case "99":
								$opagoxls= "99: Otro";
								break;
							case "":
								$opagoxls= "";
								break;
							} 
		

 if($tipoenvio=='I'){
	   
	 if(!empty($karpatri)){//Aqui pregunto si el kardex en patrimonial es diferente del vacio
		  
	 /*//////////////////////////// A PARTIR DE AQUI COMENZAMOS A CREAR LAS FILAS DE OPRACION Y LOS PARTICIPANTES //////////////////////////////////////////////*/
	
	        $tipoenvio2="I: Inicial";
			/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			$oprtunidaddepago=$row['idoppago'];
			
			if($tipoopera=='042'){
			    $monedita="";
			}else{
				
				if($importetotal!='0.00'){
				if($tipomoneda=='2'){ $monedita="USD: D&oacute;lar Estadounidense"; }
				if($tipomoneda=='1'){ $monedita="PEN: Nuevo Sol Peruano"; }
			      }else{
				   $monedita="";
				}  
			}
			//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
							
			if($oprtunidaddepago=='99'){ $detalleoppago="NO PRECISA"; }else{ $detalleoppago=""; }
		    
			if($idtipkar=='T'){
				  
		         				  
			$regis2="SELECT detallevehicular.pregistral, detallevehicular.idsedereg FROM detallevehicular WHERE detallevehicular.kardex='$kardex' 
			         AND detallevehicular.idtipacto='$idtipoacto'";
			$resregis2=mysql_query($regis2,$conn);
			$valor_detalle=mysql_num_rows($resregis2);
				

				if($valor_detalle!=0){
					 $rowregis2 = mysql_fetch_array($resregis2);
					 $nump=$rowregis2['pregistral']; $sr=$rowregis2['idsedereg'];
					 if($nump!="" && $sr!=""){
						 
						switch ($sr) {
							case "01":
								$sedereg= "01: Piura";
								break;
							case "02":
								$sedereg= "02: Chiclayo";
								break;
							case "03":
								$sedereg= "03: Moyobamba";
								break;
							case "04":
								$sedereg= "04: Iquitos";
								break;							
							case "05":
								$sedereg= "05: Trujillo";
								break;							
							case "06":
								$sedereg= "06: Pucallpa";
								break;
							case "07":
								$sedereg= "07: Huaraz";
								break;
							case "08":
								$sedereg= "08: Huancayo";
								break;
							case "09":
								$sedereg= "09: Lima";
								break;
							case "10":
								$sedereg= "10: Cusco";
								break;
							case "11":
								$sedereg= "11: Ica";
								break;
							case "12":
								$sedereg= "12: Arequipa";
								break;
							case "13":
								$sedereg= "13: Tacna";
								break;
							
							} 

						$incri="I: Inscrito"; $numpartida=strtoupper($rowregis2['pregistral']);
					 }else{$incri="N: No Inscrito"; $sedereg=""; $numpartida="";}

				 }else{$incri="N: No Inscrito"; $sedereg=""; $numpartida="";}
			
			}else{
				
			$regis="SELECT detallebienes.pregistral, detallebienes.idsedereg FROM detallebienes WHERE detallebienes.kardex='$kardex' AND detallebienes.idtipacto='$idtipoacto'";
			$resregis=mysql_query($regis,$conn);
			$valor_detalle2=mysql_num_rows($resregis);
			$rowregis = mysql_fetch_array($resregis);
			    if($valor_detalle2!=0){
					$nump2=$rowregis['pregistral']; $sr2=$rowregis['idsedereg'];
					if($nump2!="" && $sr2!="" ){
						switch ($sr2) {
							case "01":
								$sedereg= "01: Piura";
								break;
							case "02":
								$sedereg= "02: Chiclayo";
								break;
							case "03":
								$sedereg= "03: Moyobamba";
								break;
							case "04":
								$sedereg= "04: Iquitos";
								break;							
							case "05":
								$sedereg= "05: Trujillo";
								break;							
							case "06":
								$sedereg= "06: Pucallpa";
								break;
							case "07":
								$sedereg= "07: Huaraz";
								break;
							case "08":
								$sedereg= "08: Huancayo";
								break;
							case "09":
								$sedereg= "09: Lima";
								break;
							case "10":
								$sedereg= "10: Cusco";
								break;
							case "11":
								$sedereg= "11: Ica";
								break;
							case "12":
								$sedereg= "12: Arequipa";
								break;
							case "13":
								$sedereg= "13: Tacna";
								break;
							
							} 
						$incri="I: Inscrito";  $numpartida=strtoupper($rowregis['pregistral']);
						}else{ $incri="N: No Inscrito"; $sedereg=""; $numpartida="";}
					
			    }else{$incri="N: No Inscrito"; $sedereg=""; $numpartida="";}
	        }
			
			$sqlmedipago="SELECT DISTINCT detallemediopago.kardex, detallemediopago.tipacto, detallemediopago.codmepag, detallemediopago.fpago, detallemediopago.idbancos,
			              SUM(detallemediopago.importemp) AS sumamp, detallemediopago.idmon, mediospago.uif, fpago_uif.codigo FROM detallemediopago 
						  INNER JOIN mediospago ON detallemediopago.codmepag = mediospago.codmepag
						  LEFT JOIN fpago_uif ON fpago_uif.id_fpago=detallemediopago.fpago
						  WHERE detallemediopago.kardex='$kardex' AND detallemediopago.tipacto='$idtipoacto' GROUP BY detallemediopago.codmepag, detallemediopago.tipacto";

		    $sec=$sec + 1;
		    $resmp=mysql_query($sqlmedipago,$conn);
		    $valor_medio_pago=mysql_num_rows($resmp);
			if($valor_medio_pago!=0){
				while($rowmp1 = mysql_fetch_array($resmp)) {
				$correlativo=$correlativo+1;	
				$medpag_tipfondo=$rowmp1['uif'];
				switch ($medpag_tipfondo) {
							case "01":
								$mp_tf= "01: Efectivo";
								break;
							case "02":
								$mp_tf= "02: Cheque";
								break;
							case "03":
								$mp_tf= "03: Giro";
								break;
							case "04":
								$mp_tf= "04: Transferencia Bancaria";
								break;							
							case "05":
								$mp_tf= "05: Dep&oacute;sito En Cuenta";
								break;							
							case "06":
								$mp_tf= "06: Tarjeta De Cr&eacute;dito";
								break;
							case "07":
								$mp_tf= "07: Bien Mueble";
								break;
							case "08":
								$mp_tf= "08: Bien Inmueble";
								break;
							case "99":
								$mp_tf= "99: Otro";
								break;
							} 
				

				$codigomp=$rowmp1['codmepag']; $sumamp=$rowmp1['sumamp']; $money=$rowmp1['idmon']; $tpoacto=$rowmp1['tipacto']; $vacio="";                 if($tipoopera=='042'){$tipofondo='';}else{$tipofondo=$mp_tf;}
				 
				 $vaciomonto='0.00';
				if($tipoopera=='026' || $tipoopera=='027'){$formapago="";}else{
					
					$consulta="select * from fpago_uif where id_fpago=".$row['fpago']."";
					$rescon=mysql_query($consulta,$conn);
					$fila=mysql_fetch_array($rescon);
					$formapagoxls=$fila['codigo'];
					
					switch ($formapagoxls) {
							case "C":
								$formapago= "C: Al Contado";
								break;
							case "P":
								$formapago= "P: A Plazos (M&aacute;s De Una Cuota)";
								break;
							case "S":
								$formapago= "S: Saldo Pendiente De Pago (Una Cuota)";
								break;
							case "D":
								$formapago= "D: Donaciones O Anticipos";
								break;							
							case "N":
								$formapago= "N: No Aplica";
								break;							
							case "":
								$formapago= "";
								break;
							} 
					
					}
				
				echo"
<tr>
<td height='23' align='left' valign='top' style='mso-number-format:\@' bgcolor='#FFFFFF'>".$kardex."</td>
<td align='left' valign='top' bgcolor='#FFFFFF'>".substr($correlativo,0,8)."</td>
<td align='left' valign='top' bgcolor='#FFFFFF'>".substr($sec,0,8)."</td>
<td align='left' valign='top' bgcolor='#FFFFFF'>".$tipoenvio2."</td>
<td align='left' valign='top' bgcolor='#FFFFFF'>".$idtipkarxls."</td>
<td align='left' valign='top' bgcolor='#FFFFFF'>".substr($numescritura,0,6)."</td>
<td align='left' valign='top' bgcolor='#FFFFFF'>".$fechas."</td>
<td align='left' valign='top' bgcolor='#FFFFFF'>".substr($vacio,0,6)."</td>
<td align='left' valign='top' bgcolor='#FFFFFF'>".substr($vacio,0,8)."</td>
<td align='left' valign='top' bgcolor='#FFFFFF'>".$conclu."</td>
<td align='left' valign='top' bgcolor='#FFFFFF'>".substr($vacio,0,8)."</td>
<td align='left' valign='top' bgcolor='#FFFFFF'>".$modalidad."</td>
<td align='left' valign='top' bgcolor='#FFFFFF'>".substr($vacio,0,4)."</td>
<td align='left' valign='top' bgcolor='#FFFFFF'>".substr($vacio,0,1)."</td>
<td align='left' valign='top' bgcolor='#FFFFFF'>".substr($vacio,0,1)."</td>
<td align='left' valign='top' bgcolor='#FFFFFF'>".substr($vacio,0,1)."</td>
<td align='left' valign='top' bgcolor='#FFFFFF'>".substr($vacio,0,1)."</td>
<td align='left' valign='top' bgcolor='#FFFFFF'>".substr($vacio,0,1)."</td>
<td align='left' valign='top' bgcolor='#FFFFFF'>".substr($vacio,0,1)."</td>
<td align='left' valign='top' bgcolor='#FFFFFF'>".substr($vacio,0,1)."</td>
<td align='left' valign='top' bgcolor='#FFFFFF'>".substr($vacio,0,1)."</td>
<td align='left' valign='top' bgcolor='#FFFFFF'>".substr($vacio,0,20)."</td>
<td align='left' valign='top' bgcolor='#FFFFFF'>".substr($vacio,0,11)."</td>
<td align='left' valign='top' bgcolor='#FFFFFF'>".substr($vacio,0,120)."</td>
<td align='left' valign='top' bgcolor='#FFFFFF'>".substr($vacio,0,40)."</td>
<td align='left' valign='top' bgcolor='#FFFFFF'>".substr($vacio,0,40)."</td>
<td align='left' valign='top' bgcolor='#FFFFFF'>".substr($vacio,0,2)."</td>
<td align='left' valign='top' bgcolor='#FFFFFF'>".substr($vacio,0,8)."</td>
<td align='left' valign='top' bgcolor='#FFFFFF'>".substr($vacio,0,1)."</td>
<td align='left' valign='top' bgcolor='#FFFFFF'>".substr($vacio,0,3)."</td>
<td align='left' valign='top' bgcolor='#FFFFFF'>".substr($vacio,0,40)."</td>
<td align='left' valign='top' bgcolor='#FFFFFF'>".substr($vacio,0,4)."</td>
<td align='left' valign='top' bgcolor='#FFFFFF'>".substr($vacio,0,3)."</td>
<td align='left' valign='top' bgcolor='#FFFFFF'>".substr($vacio,0,2)."</td>
<td align='left' valign='top' bgcolor='#FFFFFF'>".substr($vacio,0,12)."</td>
<td align='left' valign='top' bgcolor='#FFFFFF'>".substr($vacio,0,150)."</td>
<td align='left' valign='top' bgcolor='#FFFFFF'>".substr($vacio,0,2)."</td>
<td align='left' valign='top' bgcolor='#FFFFFF'>".substr($vacio,0,2)."</td>
<td align='left' valign='top' bgcolor='#FFFFFF'>".substr($vacio,0,2)."</td>
<td align='left' valign='top' bgcolor='#FFFFFF'>".substr($vacio,0,40)."</td>
<td align='left' valign='top' bgcolor='#FFFFFF'>".substr($vacio,0,1)."</td>
<td align='left' valign='top' bgcolor='#FFFFFF'>".substr($vacio,0,40)."</td>
<td align='left' valign='top' bgcolor='#FFFFFF'>".substr($vacio,0,40)."</td>
<td align='left' valign='top' bgcolor='#FFFFFF'>".substr($vacio,0,40)."</td>
<td align='left' valign='top' bgcolor='#FFFFFF'>".$tipofondo."</td>
<td align='left' valign='top' bgcolor='#FFFFFF'>".$tipooperaxls."</td>
<td align='left' valign='top' bgcolor='#FFFFFF'>".$formapago."</td>
<td align='left' valign='top' bgcolor='#FFFFFF'>".$oprtunidaddepago."</td>
<td align='left' valign='top' bgcolor='#FFFFFF' style='mso-number-format:\@'>".substr(holaacentos(strtoupper($detalleoppago)),0,40)."</td>
<td align='left' valign='top' bgcolor='#FFFFFF'>".substr(strtoupper($vacio),0,40)."</td>
<td align='left' valign='top' bgcolor='#FFFFFF'>".$monedita."</td>
<td align='left' valign='top' bgcolor='#FFFFFF' style='mso-number-format:0.00'>".substr($importetotal,0,18)."</td>
<td align='left' valign='top' bgcolor='#FFFFFF' style='mso-number-format:0.00'>".substr($vaciomonto,0,18)."</td>
<td align='left' valign='top' bgcolor='#FFFFFF' style='mso-number-format:0.00'>".substr($importetotal,0,18)."</td>
<td align='left' valign='top' bgcolor='#FFFFFF' style='mso-number-format:0.00'>".$tipcambio."</td>
<td align='left' valign='top' bgcolor='#FFFFFF'>".$incri."</td>
<td align='left' valign='top' bgcolor='#FFFFFF'>".$sedereg."</td>
<td align='left' valign='top' bgcolor='#FFFFFF'>".substr($numpartida,0,12)."
</tr>";
				}
			}else{
				echo"
<tr>
<td height='23' align='left' valign='top' style='mso-number-format:\@' bgcolor='#993300'><span style='font-size:12px; color:#ffffff;'>".$kardex."</span></td>
<td align='left' valign='top' bgcolor='#993300'><span style='font-size:12px; color:#ffffff;'>No Tiene fila de Operacion</span></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300' style='mso-number-format:\@'></td>
<td align='left' valign='top' bgcolor='#993300' style='mso-number-format:\@'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300' style='mso-number-format:\@'></td>
<td align='left' valign='top' bgcolor='#993300' style='mso-number-format:\@'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300' style='mso-number-format:\@'></td>
<td align='left' valign='top' bgcolor='#993300' style='mso-number-format:\@'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300' style='mso-number-format:0.00'></td>
<td align='left' valign='top' bgcolor='#993300' style='mso-number-format:0.00'></td>
<td align='left' valign='top' bgcolor='#993300' style='mso-number-format:0.00'></td>
<td align='left' valign='top' bgcolor='#993300' style='mso-number-format:0.00'></td>
<td align='left' valign='top' bgcolor='#993300' style='mso-number-format:\@'></td>
<td align='left' valign='top' bgcolor='#993300' style='mso-number-format:\@'></td>
<td align='left' valign='top' bgcolor='#993300' style='mso-number-format:\@'>
</tr>";
			}
			
			$sql_contratantes="SELECT contratantesxacto.kardex, contratantesxacto.idtipoacto, contratantesxacto.uif, contratantesxacto.monto, contratantesxacto.ofondo,
			                   contratantesxacto.opago, contratantesxacto.idcontratante, cliente2.apemat, cliente2.apepat,  cliente2.prinom, cliente2.segnom, cliente2.numdoc,
							   cliente2.razonsocial, cliente2.direccion, cliente2.domfiscal, cliente2.tipper, cliente2.idtipdoc, cliente2.residente, cliente2.nacionalidad,
							   cliente2.idestcivil, cliente2.cumpclie, cliente2.idprofesion, cliente2.idcargoprofe, cliente2.actmunicipal, cliente2.idubigeo, cliente2.conyuge,
							   cliente2.idsedereg, cliente2.numpartida, cliente2.contacempresa FROM contratantesxacto
							   INNER JOIN cliente2 ON contratantesxacto.idcontratante= cliente2.idcontratante
							   WHERE contratantesxacto.kardex='$kardex' AND contratantesxacto.idtipoacto='$tpoacto' AND contratantesxacto.uif <> '' AND (contratantesxacto.uif='O' 
							   OR contratantesxacto.uif='B' OR contratantesxacto.uif='R') ORDER BY contratantesxacto.uif DESC";	
 
            $rescontra=mysql_query($sql_contratantes,$conn);
			$valor_contratantes=mysql_num_rows($rescontra);
			if($valor_contratantes!=0){
			    
				while($rowcontrata = mysql_fetch_array($rescontra)) {
				 $correlativo=$correlativo+1;
				 
				 $uif=$rowcontrata['uif']; $monto=$rowcontrata['monto'];  $numdocu=$rowcontrata['numdoc']; $tipoppersona=$rowcontrata['tipper']; $td=$rowcontrata['idtipdoc']; 
				 $ofondo=$rowcontrata['ofondo']; $idcontratantee=$rowcontrata['idcontratante']; $residente=$rowcontrata['residente']; $estado_civil=$rowcontrata['idestcivil'];
				 $cumpleclie=$rowcontrata['cumpclie']; $nacionalidad=$rowcontrata['nacionalidad']; $profe=$rowcontrata['idprofesion']; $ciiu=$rowcontrata['actmunicipal']; 
				 $cargoprofe=$rowcontrata['idcargoprofe']; $sederegparti=$rowcontrata['idsedereg']; $numpartiparti=$rowcontrata['numpartida']; $ubigeo=$rowcontrata['idubigeo']; 
				 $esposa=$rowcontrata['conyuge']; $kardexx=$rowcontrata['kardex']; $tipoactosss=$rowcontrata['idtipoacto']; $objciiu=str_replace("Ã","I",str_replace("Ã“","O",str_replace("`"," ",str_replace(")"," ",str_replace("("," ",str_replace("-"," ",str_replace("Âº"," ",str_replace(","," ",str_replace("."," ",str_replace("?"," ",str_replace("*"," ",str_replace("Ã‘","#",str_replace("Ã±","#",$rowcontrata['contacempresa'])))))))))))));
				 
				 switch ($sederegparti) {
							case "01":
								$sederegpartixls= "01: Piura";
								break;
							case "02":
								$sederegpartixls= "02: Chiclayo";
								break;
							case "03":
								$sederegpartixls= "03: Moyobamba";
								break;
							case "04":
								$sederegpartixls= "04: Iquitos";
								break;							
							case "05":
								$sederegpartixls= "05: Trujillo";
								break;							
							case "06":
								$sederegpartixls= "06: Pucallpa";
								break;
							case "07":
								$sederegpartixls= "07: Huaraz";
								break;
							case "08":
								$sederegpartixls= "08: Huancayo";
								break;
							case "09":
								$sederegpartixls= "09: Lima";
								break;
							case "10":
								$sederegpartixls= "10: Cusco";
								break;
							case "11":
								$sederegpartixls= "11: Ica";
								break;
							case "12":
								$sederegpartixls= "12: Arequipa";
								break;
							case "13":
								$sederegpartixls= "13: Tacna";
								break;
							
							} 
				 
				  
				 
                  switch ($ciiuxls) {
							case "A":
								$ciiu= "A   : Agricultura Ganaderia Caza Y Silvicultura";
								break;
							case "B":
								$ciiu= "B   : Pesca";
								break;
							case "C":
								$ciiu= "C   : Explotacion De Minas Y Canteras";
								break;
							case "D":
								$ciiu= "D   : Industrias Manufactureras";
								break;							
							case "E":
								$ciiu= "E   : Suministro De Electricidad, Gas Y Agua";
								break;							
							case "F":
								$ciiu= "F   : Construccion";
								break;
							case "G":
								$ciiu= "G   : Comercio Al Por Mayor Y Menor, Reparacion De Vehiculos Automotores, Art. Domesticos";
								break;
							case "H":
								$ciiu= "H   : Hoteles Y Restaurantes";
								break;
							case "I":
								$ciiu= "I   : Transporte,Almacenamiento Y Comunicaciones";
								break;
							case "J":
								$ciiu= "J   : Intermediacion Financiera";
								break;
							case "K":
								$ciiu= "K   : Actividades Inmobiliarias, Empresariales Y De Alquiler";
								break;
							case "L":
								$ciiu= "L   : Administracion Publica Y Defensa, Planes De Seguridad Social De Afiliacion Obligatoria";
								break;
							case "M":
								$ciiu= "M   : Ense&ntilde;anza(Privada)";
								break;
							case "N":
								$ciiu= "N   : Actividades De Servicios Sociales Y De Salud (Privada)";
								break;
							case "O":
								$ciiu= "O   : Otras Activ. De Servicios Comunitarias, Sociales Y Personales";
								break;
							case "P":
								$ciiu= "P   : Hogares Privados Con Servicio Domestico";
								break;
							case "Q":
								$ciiu= "Q   : Organizaciones Y Organos Extraterritoriales";
								break;
							} 
							
                 switch ($tdxls) {
							case "1":
								$td= "1: Documento Nacional de Identidad (DNI)";
								break;
							case "2":
								$td= "2: Carn&eacute; de extranjer&iacute;a";
								break;
							case "3":
								$td= "3: Carn&eacute; de identidad de las Fuerzas Policiales";
								break;
							case "4":
								$td= "4: Carn&eacute; de identidad de las Fuerzas Armadas";
								break;							
							case "5":
								$td= "5: Pasaporte";
								break;							
							case "6":
								$td= "6: C&eacute;dula de Ciudadan&iacute;a";
								break;
							case "7":
								$td= "7: C&eacute;dula diplom&aacute;tica de identidad";
								break;
							case "9":
								$td= "9: Otro";
								break;
							case "8":
								$td= "";
								break;
							case "10":
								$td= "";
								break;
							case "11":
								$td= "";
								break;
							} 
				 
				 switch ($estado_civilxls) {
							case "1":
								$estado_civil= "1: Soltero";
								break;
							case "2":
								$estado_civil= "2: Casado";
								break;
							case "3":
								$estado_civil= "3: Viudo";
								break;
							case "4":
								$estado_civil= "4: Divorciado";
								break;							
							case "5":
								$estado_civil= "5: Conviviente";
								break;							
							
							} 

				 if(!empty($residente)){
					 if($residente=="1"){$resi="1: Residente";}else{$resi="2: No Residente";}
					 }else{$resi="1: Residente";}
				 
					if($tipoactosss=='038'){
			         $monedita2="";
			       }else{
				
				     if($monto!=''){
				     if($tipomoneda=='2'){ $monedita2="USD: D&oacute;lar Estadounidense"; }
				     if($tipomoneda=='1'){ $monedita2="PEN: Nuevo Sol Peruano"; }
			          }else{
				        $monedita2="";
				      }  
			      }
			 
					 if($esposa!=""){
						 $sqlespo=mysql_query("select idcontratante from contratantesxacto where idcontratante='$esposa' and (kardex='$kardexx' and idtipoacto='$tipoactosss')",$conn);
						 $rowespo = mysql_fetch_array($sqlespo);
						 $esposita=$rowespo['idcontratante'];
						 if($esposita!=""){ $paricipaesposa="S: Si Participa";}else{$paricipaesposa="N: No Participa";}
					 }else{$paricipaesposa="";}

				 if($ubigeo!=""){
				 $departamentoxls=substr($ubigeo,0,2);
				 $provinciaxls=substr($ubigeo,2,2);
				 $distritoxls=substr($ubigeo,4,2);
				 
				 $con_ubigeo   = mysql_query("SELECT coddis, nomdis, nomprov, nomdpto, coddist, codprov, codpto FROM ubigeo WHERE coddis='$ubigeo'",$conn);
				 $rowubigeo    = mysql_fetch_array($con_ubigeo);
				 $departamento = $rowubigeo['codpto'].': '.$rowubigeo['nomdpto'];
				 $provincia    = $rowubigeo['codprov'].': '.$rowubigeo['nomprov'];
				 $distrito     = $rowubigeo['coddist'].': '.$rowubigeo['nomdis'];
				 /*
				 $departamento= "01: Amazonas";
				 $provincia = "01: Chachapoyas"; 
				 $distrito = "01: Chachapoyas"; 
				 */
				 
				 
				 
				 
				 
				 
				 
				 
				 /*
				  switch ($departamentoxls) {
							case "01":
								$departamento= "01: Amazonas";
								 switch ($provinciaxls) { 
									case "01": 
									$provincia = "01: Chachapoyas"; 
									  switch ($distritoxls) { 
										case "01": 
											$distrito = "01: Chachapoyas"; 
											break; 
											case "02": 
											$distrito = "02: Asuncion"; 
											break;
											case "03": 
											$distrito = "03: Balsas"; 
											break; 
											case "04": 
											$distrito = "04: Cheto"; 
											break; 
											case "05": 
											$distrito = "05: Chiliquin"; 
											break; 
											case "06": 
											$distrito = "06: Chuquibamba"; 
											break; 
											case "07": 
											$distrito = "07: Granada"; 
											break; 
											case "08": 
											$distrito = "08: Huancas"; 
											break;
											case "09": 
											$distrito = "09: La Jalca"; 
											break;
											case "10": 
											$distrito = "10: Leimebamba"; 
											break;
											case "11": 
											$distrito = "11: Levanto"; 
											break;
											case "12": 
											$distrito = "12: Magdalena"; 
											break;
											case "13": 
											$distrito = "13: Mariscal Castilla"; 
											break;
											case "14": 
											$distrito = "14: Molinopampa"; 
											break;
											break;
											case "15": 
											$distrito = "15: Montevideo"; 
											break;
											break;
											case "16": 
											$distrito = "16: Olleros"; 
											break;
											break;
											case "17": 
											$distrito = "17: Quinjalca"; 
											break;
											case "18": 
											$distrito = "18: San Francisco De Daguas"; 
											break;
											case "19": 
											$distrito = "19: San Isidro De Maino"; 
											break;
											case "20": 
											$distrito = "20: Soloco"; 
											break;
											case "21": 
											$distrito = "21: Sonche"; 
											break;
										} 
									break; 
									case "02": 
									$provincia = "02: Bagua"; 
									switch ($distritoxls) { 
										case "01": 
											$distrito = "01: La Peca"; 
											break; 
											case "02": 
											$distrito = "02: Aramango"; 
											break;
											case "03": 
											$distrito = "03: Copallin"; 
											break; 
											case "04": 
											$distrito = "04: El Parco"; 
											break; 
											case "05": 
											$distrito = "05: Imaza"; 
											break; 
									     }
									break;
									case "03": 
									$provincia = "03: Bongara";
									  switch ($distritoxls) { 
										case "01": 
											$distrito = "01: Jumbilla"; 
											break; 
											case "02": 
											$distrito = "02: Chisquilla"; 
											break;
											case "03": 
											$distrito = "03: Churuja"; 
											break; 
											case "04": 
											$distrito = "04: Corosha"; 
											break; 
											case "05": 
											$distrito = "05: Cuispes"; 
											break; 
											case "06": 
											$distrito = "06: Florida"; 
											break; 
											case "07": 
											$distrito = "07: Jazßn"; 
											break; 
											case "08": 
											$distrito = "08: Recta"; 
											break;
											case "09": 
											$distrito = "09: San Carlos"; 
											break;
											case "10": 
											$distrito = "10: Shipasbamba"; 
											break;
											case "11": 
											$distrito = "11: Valera"; 
											break;
											case "12": 
											$distrito = "12: Yambrasbamba"; 
											break;
									    }
									break; 
									case "04": 
									$provincia = "04: Condorcanqui"; 
									 switch ($distritoxls) { 
										case "01": 
											$distrito = "01: Nieva"; 
											break; 
											case "02": 
											$distrito = "02: El Cenepa"; 
											break;
											case "03": 
											$distrito = "03: Rio Santiago"; 
											break; 
									    }
									break; 
									case "05": 
									$provincia = "05: Luya"; 
									 switch ($distritoxls) { 
										case "01": 
											$distrito = "01: Lamud"; 
											break; 
											case "02": 
											$distrito = "02: Camporredondo"; 
											break;
											case "03": 
											$distrito = "03: Cocabamba"; 
											break; 
											case "04": 
											$distrito = "04: Colcamar"; 
											break; 
											case "05": 
											$distrito = "05: Conila"; 
											break; 
											case "06": 
											$distrito = "06: Inguilpata"; 
											break; 
											case "07": 
											$distrito = "07: Longuita"; 
											break; 
											case "08": 
											$distrito = "08: Lonya Chico"; 
											break;
											case "09": 
											$distrito = "09: Luya"; 
											break;
											case "10": 
											$distrito = "10: Luya Viejo"; 
											break;
											case "11": 
											$distrito = "11: Maria"; 
											break;
											case "12": 
											$distrito = "12: Ocalli"; 
											break;
											case "13": 
											$distrito = "13: Ocumal"; 
											break;
											case "14": 
											$distrito = "14: Pisuquia"; 
											break;
											break;
											case "15": 
											$distrito = "15: Providencia"; 
											break;
											case "16": 
											$distrito = "16: San Cristobal"; 
											break;
											case "17": 
											$distrito = "17: San Francisco Del Yeso"; 
											break;
											case "18": 
											$distrito = "18: San Jeronimo"; 
											break;
											case "19": 
											$distrito = "19: San Juan De Lopecancha"; 
											break;
											case "20": 
											$distrito = "20: Santa Catalina"; 
											break;
											case "21": 
											$distrito = "21: Santo Tomas"; 
											break;
											case "22": 
											$distrito = "22: Tingo"; 
											break;
											case "23": 
											$distrito = "23: Trita"; 
											break;
										} 
									break; 
									case "06": 
									$provincia = "06: Rodriguez De Mendoza"; 
									  switch ($distritoxls) { 
										case "01": 
											$distrito = "01: San Nicolas"; 
											break; 
											case "02": 
											$distrito = "02: Chirimoto"; 
											break;
											case "03": 
											$distrito = "03: Cochamal"; 
											break; 
											case "04": 
											$distrito = "04: Huambo"; 
											break; 
											case "05": 
											$distrito = "05: Limabamba"; 
											break; 
											case "06": 
											$distrito = "06: Longar"; 
											break; 
											case "07": 
											$distrito = "07: Mariscal Benavides"; 
											break; 
											case "08": 
											$distrito = "08: Milpuc"; 
											break;
											case "09": 
											$distrito = "09: Omia"; 
											break;
											case "10": 
											$distrito = "10: Santa Rosa"; 
											break;
											case "11": 
											$distrito = "11: Totora"; 
											break;
											case "12": 
											$distrito = "12: Vista Alegre"; 
											break;
									  }
									break; 
									case "07": 
									$provincia = "07: Utcubamba"; 
									 switch ($distritoxls) { 
										case "01": 
											$distrito = "01: Bagua Grande"; 
											break; 
											case "02": 
											$distrito = "02: Cajaruro"; 
											break;
											case "03": 
											$distrito = "03: Cumba"; 
											break; 
											case "04": 
											$distrito = "04: El Milagro"; 
											break; 
											case "05": 
											$distrito = "05: Jamalca"; 
											break; 
											case "06": 
											$distrito = "06: Lonya Grande"; 
											break; 
											case "07": 
											$distrito = "07: Yamon"; 
											break; 
									  }
									break; 
								} 
								break;
							case "02":
								$departamento= "02: Ancash";
								  switch ($provinciaxls) { 
									case "01": 
									$provincia = "01: Huaraz"; 
									  switch ($distritoxls) { 
										case "01": 
											$distrito = "01: Huaraz"; 
											break; 
											case "02": 
											$distrito = "02: Cochabamba"; 
											break;
											case "03": 
											$distrito = "03: Colcabamba"; 
											break; 
											case "04": 
											$distrito = "04: Huanchay"; 
											break; 
											case "05": 
											$distrito = "05: Independencia"; 
											break; 
											case "06": 
											$distrito = "06: Jangas"; 
											break; 
											case "07": 
											$distrito = "07: La Libertad"; 
											break; 
											case "08": 
											$distrito = "08: Olleros"; 
											break;
											case "09": 
											$distrito = "09: Pampas"; 
											break;
											case "10": 
											$distrito = "10: Pariacoto"; 
											break;
											case "11": 
											$distrito = "11: Pira"; 
											break;
											case "12": 
											$distrito = "12: Tarica"; 
											break;
										} 
									break; 
									case "02": 
									$provincia = "02: Aija"; 
									switch ($distritoxls) { 
										case "01": 
											$distrito = "01: Aija"; 
											break; 
											case "02": 
											$distrito = "02: Coris"; 
											break;
											case "03": 
											$distrito = "03: Huacllan"; 
											break; 
											case "04": 
											$distrito = "04: La Merced"; 
											break; 
											case "05": 
											$distrito = "05: Succha"; 
											break; 
									     }
									break;
									case "03": 
									$provincia = "03: Antonio Raymondi";
									  switch ($distritoxls) { 
										case "01": 
											$distrito = "01: Llamellin"; 
											break; 
											case "02": 
											$distrito = "02: Aczo"; 
											break;
											case "03": 
											$distrito = "03: Chaccho"; 
											break; 
											case "04": 
											$distrito = "04: Chingas"; 
											break; 
											case "05": 
											$distrito = "05: Mirgas"; 
											break; 
											case "06": 
											$distrito = "06: San Juan De Rontoy"; 
											break; 
									    }
									break; 
									case "04": 
									$provincia = "04: Asuncion"; 
									 switch ($distritoxls) { 
										case "01": 
											$distrito = "01: Chacas"; 
											break; 
											case "02": 
											$distrito = "02: Acochaca"; 
											break;
									    }
									break; 
									case "05": 
									$provincia = "05: Bolognesi"; 
									 switch ($distritoxls) { 
										case "01": 
											$distrito = "01: Chiquian"; 
											break; 
											case "02": 
											$distrito = "02: Abelardo Pardo Lezameta"; 
											break;
											case "03": 
											$distrito = "03: Antonio Raymondi"; 
											break; 
											case "04": 
											$distrito = "04: Aquia"; 
											break; 
											case "05": 
											$distrito = "05: Cajacay"; 
											break; 
											case "06": 
											$distrito = "06: Canis"; 
											break; 
											case "07": 
											$distrito = "07: Colquioc"; 
											break; 
											case "08": 
											$distrito = "08: Huallanca"; 
											break;
											case "09": 
											$distrito = "09: Huasta"; 
											break;
											case "10": 
											$distrito = "10: Huayllacayan"; 
											break;
											case "11": 
											$distrito = "11: La Primavera"; 
											break;
											case "12": 
											$distrito = "12: Mangas"; 
											break;
											case "13": 
											$distrito = "13: Pacllon"; 
											break;
											case "14": 
											$distrito = "14: San Miguel De Corpanqui"; 
											break;
											break;
											case "15": 
											$distrito = "15: Ticllos"; 
											break;
										} 
									break; 
									case "06": ///////
									$provincia = "06: Carhuaz"; 
									  switch ($distritoxls) { 
										case "01": 
											$distrito = "01: Carhuaz"; 
											break; 
											case "02": 
											$distrito = "02: Acopampa"; 
											break;
											case "03": 
											$distrito = "03: Amashca"; 
											break; 
											case "04": 
											$distrito = "04: Anta"; 
											break; 
											case "05": 
											$distrito = "05: Ataquero"; 
											break; 
											case "06": 
											$distrito = "06: Marcara"; 
											break; 
											case "07": 
											$distrito = "07: Pariahuanca"; 
											break; 
											case "08": 
											$distrito = "08: San Miguel De Aco"; 
											break;
											case "09": 
											$distrito = "09: Shilla"; 
											break;
											case "10": 
											$distrito = "10: Tinco"; 
											break;
											case "11": 
											$distrito = "11: Yungar"; 
											break;
									  }
									break; 
									case "07": 
									$provincia = "07: Carlos Fermin Fitzcarrald"; 
									 switch ($distritoxls) { 
										case "01": 
											$distrito = "01: Bagua Grande"; 
											break; 
											case "02": 
											$distrito = "02: Cajaruro"; 
											break;
											case "03": 
											$distrito = "03: Cumba"; 
											break; 
											case "04": 
											$distrito = "04: El Milagro"; 
											break; 
											case "05": 
											$distrito = "05: Jamalca"; 
											break; 
											case "06": 
											$distrito = "06: Lonya Grande"; 
											break; 
											case "07": 
											$distrito = "07: Yamon"; 
											break; 
									  }
									break; 
									case "07": 
									$provincia = "07: Carlos Fermin Fitzcarrald"; 
									 switch ($distritoxls) { 
										case "01": 
											$distrito = "01: San Luis"; 
											break; 
											case "02": 
											$distrito = "02: San Nicolas"; 
											break;
											case "03": 
											$distrito = "03: Yauya"; 
											break; 
									  }
									break; 
									case "08": 
									$provincia = "08: Casma"; 
									 switch ($distritoxls) { 
										case "01": 
											$distrito = "01: Casma"; 
											break; 
											case "02": 
											$distrito = "02: Buena Vista Alta"; 
											break;
											case "03": 
											$distrito = "03: Comandante Noel"; 
											break; 
											case "04": 
											$distrito = "04: Yautan"; 
											break; 
									  }
									break;
									case "09": 
									$provincia = "09: Corongo"; 
									 switch ($distritoxls) { 
										case "01": 
											$distrito = "01: Corongo"; 
											break; 
											case "02": 
											$distrito = "02: Aco"; 
											break;
											case "03": 
											$distrito = "03: Bambas"; 
											break; 
											case "04": 
											$distrito = "04: Cusca"; 
											break; 
											case "05": 
											$distrito = "05: La Pampa"; 
											break; 
											case "06": 
											$distrito = "06: Yanac"; 
											break; 
											case "07": 
											$distrito = "07: Yupan"; 
											break; 
									  }
									break; 
									case "10": 
									$provincia = "10: Huari"; 
									 switch ($distritoxls) { 
									    	case "01": 
											$distrito = "01: Huari"; 
											break; 
											case "02": 
											$distrito = "02: Anra"; 
											break;
											case "03": 
											$distrito = "03: Cajay"; 
											break; 
											case "04": 
											$distrito = "04: Chavin De Huantar"; 
											break; 
											case "05": 
											$distrito = "05: Huacachi"; 
											break; 
											case "06": 
											$distrito = "06: Huacchis"; 
											break; 
											case "07": 
											$distrito = "07: Huachis"; 
											break; 
											case "08": 
											$distrito = "08: Huantar"; 
											break;
											case "09": 
											$distrito = "09: Masin"; 
											break;
											case "10": 
											$distrito = "10: Paucas"; 
											break;
											case "11": 
											$distrito = "11: Ponto"; 
											break;
											case "12": 
											$distrito = "12: Rahuapampa"; 
											break;
											case "13": 
											$distrito = "13: Rapayan"; 
											break;
											case "14": 
											$distrito = "14: San Marcos"; 
											break;
											case "15": 
											$distrito = "15: San Pedro De Chana"; 
											break;
											case "16": 
											$distrito = "16: Uco"; 
											break;
									  }
									break; 
									case "08": 
									$provincia = "07: Carlos Fermin Fitzcarrald"; 
									 switch ($distritoxls) { 
										case "01": 
											$distrito = "01: Bagua Grande"; 
											break; 
											case "02": 
											$distrito = "02: Cajaruro"; 
											break;
											case "03": 
											$distrito = "03: Cumba"; 
											break; 
											case "04": 
											$distrito = "04: El Milagro"; 
											break; 
											case "05": 
											$distrito = "05: Jamalca"; 
											break; 
											case "06": 
											$distrito = "06: Lonya Grande"; 
											break; 
											case "07": 
											$distrito = "07: Yamon"; 
											break; 
									  }
									break; 
									case "08": 
									$provincia = "07: Carlos Fermin Fitzcarrald"; 
									 switch ($distritoxls) { 
										case "01": 
											$distrito = "01: Bagua Grande"; 
											break; 
											case "02": 
											$distrito = "02: Cajaruro"; 
											break;
											case "03": 
											$distrito = "03: Cumba"; 
											break; 
											case "04": 
											$distrito = "04: El Milagro"; 
											break; 
											case "05": 
											$distrito = "05: Jamalca"; 
											break; 
											case "06": 
											$distrito = "06: Lonya Grande"; 
											break; 
											case "07": 
											$distrito = "07: Yamon"; 
											break; 
									  }
									break; 
									case "08": 
									$provincia = "07: Carlos Fermin Fitzcarrald"; 
									 switch ($distritoxls) { 
										case "01": 
											$distrito = "01: Bagua Grande"; 
											break; 
											case "02": 
											$distrito = "02: Cajaruro"; 
											break;
											case "03": 
											$distrito = "03: Cumba"; 
											break; 
											case "04": 
											$distrito = "04: El Milagro"; 
											break; 
											case "05": 
											$distrito = "05: Jamalca"; 
											break; 
											case "06": 
											$distrito = "06: Lonya Grande"; 
											break; 
											case "07": 
											$distrito = "07: Yamon"; 
											break; 
									  }
									break; 
									case "08": 
									$provincia = "07: Carlos Fermin Fitzcarrald"; 
									 switch ($distritoxls) { 
										case "01": 
											$distrito = "01: Bagua Grande"; 
											break; 
											case "02": 
											$distrito = "02: Cajaruro"; 
											break;
											case "03": 
											$distrito = "03: Cumba"; 
											break; 
											case "04": 
											$distrito = "04: El Milagro"; 
											break; 
											case "05": 
											$distrito = "05: Jamalca"; 
											break; 
											case "06": 
											$distrito = "06: Lonya Grande"; 
											break; 
											case "07": 
											$distrito = "07: Yamon"; 
											break; 
									  }
									break; 
									case "08": 
									$provincia = "07: Carlos Fermin Fitzcarrald"; 
									 switch ($distritoxls) { 
										case "01": 
											$distrito = "01: Bagua Grande"; 
											break; 
											case "02": 
											$distrito = "02: Cajaruro"; 
											break;
											case "03": 
											$distrito = "03: Cumba"; 
											break; 
											case "04": 
											$distrito = "04: El Milagro"; 
											break; 
											case "05": 
											$distrito = "05: Jamalca"; 
											break; 
											case "06": 
											$distrito = "06: Lonya Grande"; 
											break; 
											case "07": 
											$distrito = "07: Yamon"; 
											break; 
									  }
									break;  
								} 
								break;
							case "03":
								$departamento= "03: Apurimac";
								break;
							case "04":
								$departamento= "04: Arequipa";
								break;							
							case "05":
								$departamento= "05: Ayacucho";
								break;							
							case "06":
								$departamento= "06: Cajamarca";
								break;
							case "07":
								$departamento= "07: Callao";
								break;
							case "08":
								$departamento= "08: Cusco";
								break;
							case "09":
								$departamento= "09: Huancavelica";
								break;
							case "10":
								$departamento= "10: Huanuco";
								break;
							case "11":
								$departamento= "11: Ica";
								break;
							case "12":
								$departamento= "12: Junin";
								break;
							case "13":
								$departamento= "13: La Libertad";
								break;
							case "14":
								$departamento= "14: Lambayeque";
								break;
							case "15":
								$departamento= "15: Lima";
								 switch ($provinciaxls) { 
									case "01": 
									$provincia = "01: Lima"; 
									  switch ($distritoxls) { 
										case "01": 
											$distrito = "01: Lima"; 
											break; 
											case "02": 
											$distrito = "02: Ancon"; 
											break;
											case "03": 
											$distrito = "03: Ate"; 
											break; 
											case "04": 
											$distrito = "04: Barranco"; 
											break; 
											case "05": 
											$distrito = "05: Bre&ntilde;a"; 
											break; 
											case "06": 
											$distrito = "06: Carabayllo"; 
											break; 
											case "07": 
											$distrito = "07: Chaclacayo"; 
											break; 
											case "08": 
											$distrito = "08: Chorrillos"; 
											break;
											case "09": 
											$distrito = "09: Cieneguilla"; 
											break;
											case "10": 
											$distrito = "10: Comas"; 
											break;
											case "11": 
											$distrito = "11: El Agustino"; 
											break;
											case "12": 
											$distrito = "12: Independencia"; 
											break;
											case "13": 
											$distrito = "13: Jesus Maria"; 
											break;
											case "14": 
											$distrito = "14: La Molina"; 
											break;
											case "15": 
											$distrito = "15: La Victoria"; 
											break;
											case "16": 
											$distrito = "16: Lince"; 
											break;
											case "17": 
											$distrito = "17: Los Olivos"; 
											break;
											case "18": 
											$distrito = "18: Lurigancho"; 
											break;
											case "19": 
											$distrito = "19: Lurin"; 
											break;
											case "20": 
											$distrito = "20: Magdalena Del Mar"; 
											break;
											case "21": 
											$distrito = "21: Pueblo Libre (Magdalena Vieja)"; 
											break;
											case "22": 
											$distrito = "22: Miraflores"; 
											break;
											case "23": 
											$distrito = "23: Pachacamac"; 
											break;
											case "24": 
											$distrito = "24: Pucusana"; 
											break;
											case "25": 
											$distrito = "25: Puente Piedra"; 
											break;
											case "26": 
											$distrito = "26: Punta Hermosa"; 
											break;
											case "27": 
											$distrito = "27: Punta Negra"; 
											break;
											case "28": 
											$distrito = "28: Rimac"; 
											break;
											case "29": 
											$distrito = "29: San Bartolo"; 
											break;
											case "30": 
											$distrito = "30: San Borja"; 
											break;
											case "31": 
											$distrito = "31: San Isidro"; 
											break;
											case "32": 
											$distrito = "32: San Juan De Lurigancho"; 
											break;
											case "33": 
											$distrito = "33: San Juan De Miraflores"; 
											break;
											case "34": 
											$distrito = "34: San Luis"; 
											break;
											case "35": 
											$distrito = "35: San Martin De Porres"; 
											break;
											case "36": 
											$distrito = "36: San Miguel"; 
											break;
											case "37": 
											$distrito = "37: Santa Anita"; 
											break;
											case "38": 
											$distrito = "38: Santa Maria Del Mar"; 
											break;
											case "39": 
											$distrito = "39: Santa Rosa"; 
											break;
											case "40": 
											$distrito = "40: Santiago De Surco"; 
											break;
											case "41": 
											$distrito = "41: Surquillo"; 
											break;
											case "42": 
											$distrito = "42: Villa El Salvador"; 
											break;
											case "43": 
											$distrito = "43: Villa Maria Del Triunfo"; 
											break;
										} 
									break; 
									case "02": 
									$provincia = "02: Barranca"; 

									switch ($distritoxls) { 
										case "01": 
											$distrito = "01: Barranca"; 
											break; 
											case "02": 
											$distrito = "02: Paramonga"; 
											break;
											case "03": 
											$distrito = "03: Pativilca"; 
											break; 
											case "04": 
											$distrito = "04: Supe"; 
											break; 
											case "05": 
											$distrito = "05: Supe Puerto"; 
											break; 
									     }
									break;
									case "03": 
									$provincia = "03: Antonio Raymondi";
									  switch ($distritoxls) { 
										case "01": 
											$distrito = "01: Llamellin"; 
											break; 
											case "02": 
											$distrito = "02: Aczo"; 
											break;
											case "03": 
											$distrito = "03: Chaccho"; 
											break; 
											case "04": 
											$distrito = "04: Chingas"; 
											break; 
											case "05": 
											$distrito = "05: Mirgas"; 
											break; 
											case "06": 
											$distrito = "06: San Juan De Rontoy"; 
											break; 
									    }
									break; 
									case "04": 
									$provincia = "04: Asuncion"; 
									 switch ($distritoxls) { 
										case "01": 
											$distrito = "01: Chacas"; 
											break; 
											case "02": 
											$distrito = "02: Acochaca"; 
											break;
									    }
									break; 
									case "05": 
									$provincia = "05: Bolognesi"; 
									 switch ($distritoxls) { 
										case "01": 
											$distrito = "01: Chiquian"; 
											break; 
											case "02": 
											$distrito = "02: Abelardo Pardo Lezameta"; 
											break;
											case "03": 
											$distrito = "03: Antonio Raymondi"; 
											break; 
											case "04": 
											$distrito = "04: Aquia"; 
											break; 
											case "05": 
											$distrito = "05: Cajacay"; 
											break; 
											case "06": 
											$distrito = "06: Canis"; 
											break; 
											case "07": 
											$distrito = "07: Colquioc"; 
											break; 
											case "08": 
											$distrito = "08: Huallanca"; 
											break;
											case "09": 
											$distrito = "09: Huasta"; 
											break;
											case "10": 
											$distrito = "10: Huayllacayan"; 
											break;
											case "11": 
											$distrito = "11: La Primavera"; 
											break;
											case "12": 
											$distrito = "12: Mangas"; 
											break;
											case "13": 
											$distrito = "13: Pacllon"; 
											break;
											case "14": 
											$distrito = "14: San Miguel De Corpanqui"; 
											break;
											break;
											case "15": 
											$distrito = "15: Ticllos"; 
											break;
										} 
									break; 
									case "06": ///////
									$provincia = "06: Carhuaz"; 
									  switch ($distritoxls) { 
										case "01": 
											$distrito = "01: Carhuaz"; 
											break; 
											case "02": 
											$distrito = "02: Acopampa"; 
											break;
											case "03": 
											$distrito = "03: Amashca"; 
											break; 
											case "04": 
											$distrito = "04: Anta"; 
											break; 
											case "05": 
											$distrito = "05: Ataquero"; 
											break; 
											case "06": 
											$distrito = "06: Marcara"; 
											break; 
											case "07": 
											$distrito = "07: Pariahuanca"; 
											break; 
											case "08": 
											$distrito = "08: San Miguel De Aco"; 
											break;
											case "09": 
											$distrito = "09: Shilla"; 
											break;
											case "10": 
											$distrito = "10: Tinco"; 
											break;
											case "11": 
											$distrito = "11: Yungar"; 
											break;
									  }
									break; 
									case "07": 
									$provincia = "07: Carlos Fermin Fitzcarrald"; 
									 switch ($distritoxls) { 
										case "01": 
											$distrito = "01: Bagua Grande"; 
											break; 
											case "02": 
											$distrito = "02: Cajaruro"; 
											break;
											case "03": 
											$distrito = "03: Cumba"; 
											break; 
											case "04": 
											$distrito = "04: El Milagro"; 
											break; 
											case "05": 
											$distrito = "05: Jamalca"; 
											break; 
											case "06": 
											$distrito = "06: Lonya Grande"; 
											break; 
											case "07": 
											$distrito = "07: Yamon"; 
											break; 
									  }
									break; 
									case "07": 
									$provincia = "07: Carlos Fermin Fitzcarrald"; 
									 switch ($distritoxls) { 
										case "01": 
											$distrito = "01: San Luis"; 
											break; 
											case "02": 
											$distrito = "02: San Nicolas"; 
											break;
											case "03": 
											$distrito = "03: Yauya"; 
											break; 
									  }
									break; 
									case "08": 
									$provincia = "08: Casma"; 
									 switch ($distritoxls) { 
										case "01": 
											$distrito = "01: Casma"; 
											break; 
											case "02": 
											$distrito = "02: Buena Vista Alta"; 
											break;
											case "03": 
											$distrito = "03: Comandante Noel"; 
											break; 
											case "04": 
											$distrito = "04: Yautan"; 
											break; 
									  }
									break;
									case "09": 
									$provincia = "09: Corongo"; 
									 switch ($distritoxls) { 
										case "01": 
											$distrito = "01: Corongo"; 
											break; 
											case "02": 
											$distrito = "02: Aco"; 
											break;
											case "03": 
											$distrito = "03: Bambas"; 
											break; 
											case "04": 
											$distrito = "04: Cusca"; 
											break; 
											case "05": 
											$distrito = "05: La Pampa"; 
											break; 
											case "06": 
											$distrito = "06: Yanac"; 
											break; 
											case "07": 
											$distrito = "07: Yupan"; 
											break; 
									  }
									break; 
									case "10": 
									$provincia = "10: Huari"; 
									 switch ($distritoxls) { 
									    	case "01": 
											$distrito = "01: Huari"; 
											break; 
											case "02": 
											$distrito = "02: Anra"; 
											break;
											case "03": 
											$distrito = "03: Cajay"; 
											break; 
											case "04": 
											$distrito = "04: Chavin De Huantar"; 
											break; 
											case "05": 
											$distrito = "05: Huacachi"; 
											break; 
											case "06": 
											$distrito = "06: Huacchis"; 
											break; 
											case "07": 
											$distrito = "07: Huachis"; 
											break; 
											case "08": 
											$distrito = "08: Huantar"; 
											break;
											case "09": 
											$distrito = "09: Masin"; 
											break;
											case "10": 
											$distrito = "10: Paucas"; 
											break;
											case "11": 
											$distrito = "11: Ponto"; 
											break;
											case "12": 
											$distrito = "12: Rahuapampa"; 
											break;
											case "13": 
											$distrito = "13: Rapayan"; 
											break;
											case "14": 
											$distrito = "14: San Marcos"; 
											break;
											case "15": 
											$distrito = "15: San Pedro De Chana"; 
											break;
											case "16": 
											$distrito = "16: Uco"; 
											break;
									  }
									break; 
									case "08": 
									$provincia = "07: Carlos Fermin Fitzcarrald"; 
									 switch ($distritoxls) { 
										case "01": 
											$distrito = "01: Bagua Grande"; 
											break; 
											case "02": 
											$distrito = "02: Cajaruro"; 
											break;
											case "03": 
											$distrito = "03: Cumba"; 
											break; 
											case "04": 
											$distrito = "04: El Milagro"; 
											break; 
											case "05": 
											$distrito = "05: Jamalca"; 
											break; 
											case "06": 
											$distrito = "06: Lonya Grande"; 
											break; 
											case "07": 
											$distrito = "07: Yamon"; 
											break; 
									  }
									break; 
									case "08": 
									$provincia = "07: Carlos Fermin Fitzcarrald"; 
									 switch ($distritoxls) { 
										case "01": 
											$distrito = "01: Bagua Grande"; 
											break; 
											case "02": 
											$distrito = "02: Cajaruro"; 
											break;
											case "03": 
											$distrito = "03: Cumba"; 
											break; 
											case "04": 
											$distrito = "04: El Milagro"; 
											break; 
											case "05": 
											$distrito = "05: Jamalca"; 
											break; 
											case "06": 
											$distrito = "06: Lonya Grande"; 
											break; 
											case "07": 
											$distrito = "07: Yamon"; 
											break; 
									  }
									break; 
									case "08": 
									$provincia = "07: Carlos Fermin Fitzcarrald"; 
									 switch ($distritoxls) { 
										case "01": 
											$distrito = "01: Bagua Grande"; 
											break; 
											case "02": 
											$distrito = "02: Cajaruro"; 
											break;
											case "03": 
											$distrito = "03: Cumba"; 
											break; 
											case "04": 
											$distrito = "04: El Milagro"; 
											break; 
											case "05": 
											$distrito = "05: Jamalca"; 
											break; 
											case "06": 
											$distrito = "06: Lonya Grande"; 
											break; 
											case "07": 
											$distrito = "07: Yamon"; 
											break; 
									  }
									break; 
									case "08": 
									$provincia = "07: Carlos Fermin Fitzcarrald"; 
									 switch ($distritoxls) { 
										case "01": 
											$distrito = "01: Bagua Grande"; 
											break; 
											case "02": 
											$distrito = "02: Cajaruro"; 
											break;
											case "03": 
											$distrito = "03: Cumba"; 
											break; 
											case "04": 
											$distrito = "04: El Milagro"; 
											break; 
											case "05": 
											$distrito = "05: Jamalca"; 
											break; 
											case "06": 
											$distrito = "06: Lonya Grande"; 
											break; 
											case "07": 
											$distrito = "07: Yamon"; 
											break; 
									  }
									break; 
									case "08": 
									$provincia = "07: Carlos Fermin Fitzcarrald"; 
									 switch ($distritoxls) { 
										case "01": 
											$distrito = "01: Bagua Grande"; 
											break; 
											case "02": 
											$distrito = "02: Cajaruro"; 
											break;
											case "03": 
											$distrito = "03: Cumba"; 
											break; 
											case "04": 
											$distrito = "04: El Milagro"; 
											break; 
											case "05": 
											$distrito = "05: Jamalca"; 
											break; 
											case "06": 
											$distrito = "06: Lonya Grande"; 
											break; 
											case "07": 
											$distrito = "07: Yamon"; 
											break; 
									  }
									break;  
								}
								break;
							case "16":
								$departamento= "16: Loreto";
								break;
							case "17":
								$departamento= "17: Madre De Dios";
								break;
							case "18":
								$departamento= "18: Moquegua";
								break;
							case "19":
								$departamento= "19: Pasco";
								break;
							case "20":
								$departamento= "20: Piura";
								break;
							case "21":
								$departamento= "21: Puno";
								break;
							case "22":
								$departamento= "22: San Martin";
								break;
							case "23":
								$departamento= "23: Tacna";
								break;
							case "24":
								$departamento= "24: Tumbes";
								break;
							case "25":
								$departamento= "25: Ucayali";
								break;
							case "99":
								$departamento= "99: Extranjero";
								break;
							} 

				 
				 */
				 
				 
				 }else{
				 $departamento="";
				 $provincia="";
				 $distrito=""; }
				 
				 $sqlcargoprofe=mysql_query("select codcargoprofe from cargoprofe where idcargoprofe='$cargoprofe'",$conn);
				 $rowcarprofe = mysql_fetch_array($sqlcargoprofe);
				 $cargoprofxls=$rowcarprofe['codcargoprofe'];
				 
				 switch ($cargoprofxls) {
							case "001":
								$cargoprof= "001: Alcalde";
								break;
							case "002":
								$cargoprof= "002: Analista";
								break;
							case "003":
								$cargoprof= "003: Apoderado";
								break;
							case "004":
								$cargoprof= "004: Asesor / Consultor";
								break;							
							case "005":
								$cargoprof= "005: Asistente";
								break;							
							case "006":
								$cargoprof= "006: Auditor";
								break;
							case "007":
								$cargoprof= "007: Auxiliar / Ayudante";
								break;
							case "008":
								$cargoprof= "008: Congresista";
								break;
							case "009":
								$cargoprof= "009: Contralor General";
								break;
							case "010":
								$cargoprof= "010: Decano";
								break;
							case "011":
								$cargoprof= "011: Diplom&aacute;tico";
								break;
							case "012":
								$cargoprof= "012: Directivo De Asociacion Deportiva";
								break;							
							case "013":
								$cargoprof= "013: Director, Subdirector, Gerente, Jefe Del Sector Privado";
								break;							
							case "014":
								$cargoprof= "014: Docente";
								break;
							case "015":
								$cargoprof= "015: Inspector";
								break;
							case "016":
								$cargoprof= "016: Intendente, Director, Gerente, Jefe De La Administraci&oacute;n P&uacute;blica";
								break;
							case "017":
								$cargoprof= "017: Interventor General De Economia De La Administraci&oacute;n P&uacute;blica";
								break;
							case "018":
								$cargoprof= "018: Juez";
								break;
							case "019":
								$cargoprof= "019: Notario P&uacute;blico";
								break;
							case "020":
								$cargoprof= "020: Practicante";
								break;							
							case "021":
								$cargoprof= "021: Prefecto";
								break;							
							case "022":
								$cargoprof= "022: Presidente De Gobierno Regional";
								break;
							case "023":
								$cargoprof= "023: Presidente De La Corte Suprema";
								break;
							case "024":
								$cargoprof= "024: Presidente De La Rep&uacute;blica";
								break;
							case "025":
								$cargoprof= "025: Presidente, Tribunal De Justicia";
								break;
							case "026":
								$cargoprof= "026: Ministro / Viceministro";
								break;
							case "027":
								$cargoprof= "027: Procurador";
								break;
							case "028":
								$cargoprof= "028: Procurador General";
								break;							
							case "029":
								$cargoprof= "029: Rector";
								break;							
							case "030":
								$cargoprof= "030: Regidores De Municipalidades";
								break;
							case "031":
								$cargoprof= "031: Sub-Prefecto";
								break;
							case "032":
								$cargoprof= "032: Superintendente De La Administraci&oacute;n P&uacute;blica";
								break;
							case "033":
								$cargoprof= "033: Vice-Presidente De La Rep&uacute;blica";
								break;
							case "034":
								$cargoprof= "034: Vocal De La Corte Superior O Suprema";
								break;
							case "998":
								$cargoprof= "998: No Declara";
								break;
							case "999":
								$cargoprof= "999: Otros  (Se&ntilde;alar)";
								break;
							case "":
								$cargoprof= "";
								break;
							
							} 
				

				 $sqlprofe=mysql_query("select codprof from profesiones where idprofesion='$profe'",$conn);
				 $rowprofe = mysql_fetch_array($sqlprofe);
				 $profecionxls=$rowprofe['codprof'];
				 
	 
				  switch ($profecionxls) {
							case "001":
								$profecion= "001: Abogado";
								break;
							case "002":
								$profecion= "002: Actor / Artista / Escritor Y Afines";
								break;
							case "003":
								$profecion= "003: Actuario";
								break;
							case "004":
								$profecion= "004: Administrador";
								break;							
							case "005":
								$profecion= "005: Aduanero/Agente De Aduanas/Inspectores De Frontera";
								break;							
							case "006":
								$profecion= "006: Aeromozo/ Azafata Y Afines";
								break;
							case "007":
								$profecion= "007: Agente / Intermediario / Corredor Inmobiliario";
								break;
							case "008":
								$profecion= "008: Agente De Bolsa";
								break;
							case "010":
								$profecion= "010: Agente De Turismo/Viajes";
								break;
							case "011":
								$profecion= "011: Agente / Intermediario / Corredor De Seguros";
								break;
							case "012":
								$profecion= "012: Agricultor / Ganadero Y Afines";
								break;							
							case "013":
								$profecion= "013: Alba&ntilde;il / Obrero / Electricista / Mecanico / Tecnico  / Otros Oficios";
								break;							
							case "014":
								$profecion= "014: Ama De Casa";
								break;
							case "015":
								$profecion= "015: Analistas / Tecnicos / Programador De Sistema Y Computaci&oacute;n";
								break;
							case "016":
								$profecion= "016: Intendente, Director, Gerente, Jefe De La Administraci&oacute;n P&uacute;blica";
								break;
							case "019":
								$profecion= "019: Arquitecto";
								break;
							case "021":
								$profecion= "021: Asistente Social";
								break;
							case "019":
								$profecion= "019: Notario P&uacute;blico";
								break;
							case "020":
								$profecion= "020: Practicante";
								break;							
							case "021":
								$profecion= "021: Prefecto";
								break;							
							case "024":
								$profecion= "024: Bacteri&oacute;logo, Farmac&oacute;logo, Bi&oacute;logo, Cient&iacute;fico Y Afines";
								break;
							case "028":
								$profecion= "028: Cambista, Compra/Venta De Moneda";
								break;
							case "036":
								$profecion= "036: Comerciante / Vendedor";
								break;
							case "037":
								$profecion= "037: Conductor/ Chofer / Taxista/ Transportista Y Afines";
								break;
							case "039":
								$profecion= "039: Constructor";
								break;
							case "040":
								$profecion= "040: Contador";
								break;
							case "041":
								$profecion= "041: Contratista";
								break;							
							case "042":
								$profecion= "042: Corte Y Confecci&oacute;n De Ropa/ Fabricante De Prendas";
								break;							
							case "044":
								$profecion= "044: Decorador, Dibujante, Publicista, Dise&ntilde;ador De Publicidad";
								break;
							case "045":
								$profecion= "045: Dentista / Odont&oacute;logo";
								break;
							case "046":
								$profecion= "046: Deportista Profesional, Atleta, Arbitro, Entrenador Deportivo";
								break;
							case "047":
								$profecion= "047: Distribuidor";
								break;
							case "048":
								$profecion= "048: Docente";
								break;
							case "049":
								$profecion= "049: Economista";
								break;
							case "051":
								$profecion= "051: Empleada (O) Del Hogar / Nana / Guardian / Portero / Personal De Limpieza Y Afines";
								break;
							case "115":
								$profecion= "115: Empresario";
								break;
							case "052":
								$profecion= "052: Empresario Exportador/ Empresario Importador";
								break;
							case "056":
								$profecion= "056: Estudiante";
								break;
							case "061":
								$profecion= "061: Ingeniero";
								break;
							case "066":
								$profecion= "066: Jubilado / Pensionista";
								break;
							case "068":
								$profecion= "068: Liquidador, Reclamaciones/Seguros";
								break;
							case "070":
								$profecion= "070: Martillero / Subastador";
								break;
							case "071":
								$profecion= "071: Mayorista, Comercio Al Por Mayor";
								break;
							case "073":
								$profecion= "073: Medico / Cirujano";
								break;
							case "075":
								$profecion= "075: Miembro De La Polic&iacute;a / Fuerzas Armadas";
								break;
							case "078":
								$profecion= "078: Enfermero / Obstetriz / Paramedico Y Afines";
								break;
							case "082":
								$profecion= "082: Periodista";
								break;
							case "085":
								$profecion= "085: Piloto ";
								break;
							case "089":
								$profecion= "089: Productor De Cine / Radio / Televisi&oacute;n / Teatro";
								break;
							case "092":
								$profecion= "092: Psic&oacute;logo/ Terapeuta";
								break;
							case "099":
								$profecion= "099: Sacerdote / Monja / Religioso";
								break;
							case "100":
								$profecion= "100: Secretaria, Recepcionista, Telefonista Y Afines";
								break;
							case "112":
								$profecion= "112: Vendedor Ambulante";
								break;
							case "113":
								$profecion= "113: Veterinario, Zo&oacute;logo, Zoot&eacute;cnico";
								break;
							case "114":
								$profecion= "114: Visitador M&eacute;dico";
								break;
							case "998":
								$profecion= "998: No Declara";
								break;
							case "999":
								$profecion= "999: Otros  (Se&ntilde;alar)";
								break;
							case "":
								$profecion= "";
								break;
							}

						 
				 $sqlnacionalidad=mysql_query("select codnacion from nacionalidades where idnacionalidad='$nacionalidad'",$conn);
				 $rownacionalidad = mysql_fetch_array($sqlnacionalidad);
				 $nacionalidadxls=$rownacionalidad['codnacion'];
				 		switch ($nacionalidadxls) {
								case "AF":
								$nacixls="AF: Afganist&aacute;n";
								break;
								case "AL":
								$nacixls="AL: Albania";
								break;
								case "DE":
								$nacixls="DE: Alemania";
								break;
								case "AD":
								$nacixls="AD: Andorra";
								break;
								case "AO":
								$nacixls="AO: Angola";
								break;
								case "AI":
								$nacixls="AI: Anguilla";
								break;
								case "AQ":
								$nacixls="AQ: Ant&aacute;rtida";
								break;
								case "AG":
								$nacixls="AG: Antigua Y Barbuda";
								break;
								case "AN":
								$nacixls="AN: Antillas Holandesas";
								break;
								case "SA":
								$nacixls="SA: Arabia Saud&iacute;";
								break;
								case "DZ":
								$nacixls="DZ: Argelia";
								break;
								case "AR":
								$nacixls="AR: Argentina";
								break;
								case "AM":
								$nacixls="AM: Armenia";
								break;
								case "AW":
								$nacixls="AW: Aruba";
								break;
								case "MK":
								$nacixls="MK: Ary Macedonia";
								break;
								case "AU":
								$nacixls="AU: Australia";
								break;
								case "AT":
								$nacixls="AT: Austria";
								break;
								case "AZ":
								$nacixls="AZ: Azerbaiy&aacute;n";
								break;
								case "BS":
								$nacixls="BS: Bahamas";
								break;
								case "BH":
								$nacixls="BH: Bahr&eacute;in";
								break;
								case "BD":
								$nacixls="BD: Bangladesh";
								break;
								case "BB":
								$nacixls="BB: Barbados";
								break;
								case "BE":
								$nacixls="BE: B&eacute;lgica";
								break;
								case "BZ":
								$nacixls="BZ: Belice";
								break;
								case "BJ":
								$nacixls="BJ: Benin";
								break;
								case "BM":
								$nacixls="BM: Bermudas";
								break;
								case "BT":
								$nacixls="BT: Bhut&aacute;n";
								break;
								case "BY":
								$nacixls="BY: Bielorrusia";
								break;
								case "BO":
								$nacixls="BO: Bolivia";
								break;
								case "BA":
								$nacixls="BA: Bosnia Y Herzegovina";
								break;
								case "BW":
								$nacixls="BW: Botsuana";
								break;
								case "BR":
								$nacixls="BR: Brasil";
								break;
								case "BN":
								$nacixls="BN: Brun&eacute;i";
								break;
								case "BG":
								$nacixls="BG: Bulgaria";
								break;
								case "BF":
								$nacixls="BF: Burkina Faso";
								break;
								case "BI":
								$nacixls="BI: Burundi";
								break;
								case "CV":
								$nacixls="CV: Cabo Verde";
								break;
								case "KH":
								$nacixls="KH: Camboya";
								break;
								case "CM":
								$nacixls="CM: Camer&uacute;n";
								break;
								case "CA":
								$nacixls="CA: Canad&aacute;";
								break;
								case "TD":
								$nacixls="TD: Chad";
								break;
								case "CL":
								$nacixls="CL: Chile";
								break;
								case "CN":
								$nacixls="CN: China";
								break;
								case "CY":
								$nacixls="CY: Chipre";
								break;
								case "VA":
								$nacixls="VA: Ciudad Del Vaticano";
								break;
								case "CO":
								$nacixls="CO: Colombia";
								break;
								case "KP":
								$nacixls="KM: Comoras";
								break;
								case "CG":
								$nacixls="CG: Congo";
								break;
								case "KP":
								$nacixls="KP: Corea Del Norte";
								break;
								case "KR":
								$nacixls="KR: Corea Del Sur";
								break;
								case "CI":
								$nacixls="CI: Costa De Marfil";
								break;
								case "CR":
								$nacixls="CR: Costa Rica";
								break;
								case "HR":
								$nacixls="HR: Croacia";
								break;
								case "CU":
								$nacixls="CU: Cuba";
								break;
								case "DK":
								$nacixls="DK: Dinamarca";
								break;
								case "DM":
								$nacixls="DM: Dominica";
								break;
								case "EC":
								$nacixls="EC: Ecuador";
								break;
								case "EG":
								$nacixls="EG: Egipto";
								break;
								case "SV":
								$nacixls="SV: El Salvador";
								break;
								case "AE":
								$nacixls="AE: Emiratos &Aacute;rabes Unidos";
								break;
								case "ER":
								$nacixls="ER: Eritrea";
								break;
								case "SK":
								$nacixls="SK: Eslovaquia";
								break;
								case "SI":
								$nacixls="SI: Eslovenia";
								break;
								case "ES":
								$nacixls="ES: Espa&ntilde;a";
								break;
								case "US":
								$nacixls="US: Estados Unidos";
								break;
								case "EE":
								$nacixls="EE: Estonia";
								break;
								case "ET":
								$nacixls="ET: Etiop&iacute;a";
								break;
								case "PH":
								$nacixls="PH: Filipinas";
								break;
								case "FI":
								$nacixls="FI: Finlandia";
								break;
								case "FJ":
								$nacixls="FJ: Fiyi";
								break;
								case "FR":
								$nacixls="FR: Francia";
								break;
								case "GA":
								$nacixls="GA: Gab&oacute;n";
								break;
								case "GM":
								$nacixls="GM: Gambia";
								break;
								case "GE":
								$nacixls="GE: Georgia";
								break;
								case "GH":
								$nacixls="GH: Ghana";
								break;
								case "GI":
								$nacixls="GI: Gibraltar";
								break;
								case "GD":
								$nacixls="GD: Granada";
								break;
								case "GR":
								$nacixls="GR: Grecia";
								break;
								case "GL":
								$nacixls="GL: Groenlandia";
								break;
								case "GP":
								$nacixls="GP: Guadalupe";
								break;
								case "GU":
								$nacixls="GU: Guam";
								break;
								case "GT":
								$nacixls="GT: Guatemala";
								break;
								case "GF":
								$nacixls="GF: Guayana Francesa";
								break;
								case "GG":
								$nacixls="GG: Guernesey";
								break;
								case "GN":
								$nacixls="GN: Guinea";
								break;
								case "GQ":
								$nacixls="GQ: Guinea Ecuatorial";
								break;
								case "GW":
								$nacixls="GW: Guinea-Bissau";
								break;
								case "GY":
								$nacixls="GY: Guyana";
								break;
								case "HT":
								$nacixls="HT: Hait&iacute;";
								break;
								case "NL":
								$nacixls="NL: Holanda O Pa&iacute;ses Bajos";
								break;
								case "HN":
								$nacixls="HN: Honduras";
								break;
								case "HK":
								$nacixls="HK: Hong Kong";
								break;
								case "HU":
								$nacixls="HU: Hungr&iacute;a";
								break;
								case "IN":
								$nacixls="IN: India";
								break;
								case "ID":
								$nacixls="ID: Indonesia";
								break;
								case "IR":
								$nacixls="IR: Ir&aacute;n";
								break;
								case "IQ":
								$nacixls="IQ: Iraq";
								break;
								case "IE":
								$nacixls="IE: Irlanda";
								break;
								case "BV":
								$nacixls="BV: Isla Bouvet";
								break;
								case "IM":
								$nacixls="IM: Isla De Man";
								break;
								case "CX":
								$nacixls="CX: Isla De Navidad";
								break;
								case "NF":
								$nacixls="NF: Isla Norfolk";
								break;
								case "IS":
								$nacixls="IS: Islandia";
								break;
								case "AX":
								$nacixls="AX: Islas Aland";
								break;
								case "KY":
								$nacixls="KY: Islas Caim&aacute;n";
								break;
								case "CC":
								$nacixls="CC: Islas Cocos";
								break;
								case "CK":
								$nacixls="CK: Islas Cook";
								break;
								case "FO":
								$nacixls="FO: Islas Feroe";
								break;
								case "GS":
								$nacixls="GS: Islas Georgias Del Sur Y Sandwich Del Sur";
								break;
								case "HM":
								$nacixls="HM: Islas Heard Y Mcdonald";
								break;
								case "FK":
								$nacixls="FK: Islas Malvinas";
								break;
								case "MP":
								$nacixls="MP: Islas Marianas Del Norte";
								break;
								case "MH":
								$nacixls="MH: Islas Marshall";
								break;
								case "PN":
								$nacixls="PN: Islas Pitcairn";
								break;
								case "SB":
								$nacixls="SB: Islas Salom&oacute;n";
								break;
								case "TC":
								$nacixls="TC: Islas Turcas Y Caicos";
								break;
								case "UM":
								$nacixls="UM: Islas Ultramarinas De Estados Unidos";
								break;
								case "VG":
								$nacixls="VG: Islas V&iacute;rgenes Brit&aacute;nicas";
								break;
								case "VI":
								$nacixls="VI: Islas V&iacute;rgenes De Los Estados Unidos";
								break;
								case "IL":
								$nacixls="IL: Israel";
								break;
								case "IT":
								$nacixls="IT: Italia";
								break;
								case "JM":
								$nacixls="JM: Jamaica";
								break;
								case "JP":
								$nacixls="JP: Jap&oacute;n";
								break;
								case "JE":
								$nacixls="JE: Jersey";
								break;
								case "JO":
								$nacixls="JO: Jordania";
								break;
								case "KZ":
								$nacixls="KZ: Kazajst&aacute;n";
								break;
								case "KE":
								$nacixls="KE: Kenia";
								break;
								case "KG":
								$nacixls="KG: Kirguist&aacute;n";
								break;
								case "KI":
								$nacixls="KI: Kiribati";
								break;
								case "KW":
								$nacixls="KW: Kuwait";
								break;
								case "LA":
								$nacixls="LA: Laos";
								break;
								case "LS":
								$nacixls="LS: Lesotho";
								break;
								case "LV":
								$nacixls="LV: Letonia";
								break;
								case "LB":
								$nacixls="LB: L&iacute;bano";
								break;
								case "LR":
								$nacixls="LR: Liberia";
								break;
								case "LY":
								$nacixls="LY: Libia";
								break;
								case "LI":
								$nacixls="LI: Liechtenstein";
								break;
								case "LT":
								$nacixls="LT: Lituania";
								break;
								case "LU":
								$nacixls="LU: Luxemburgo";
								break;
								case "MO":
								$nacixls="MO: Macao";
								break;
								case "MG":
								$nacixls="MG: Madagascar";
								break;
								case "MY":
								$nacixls="MY: Malasia";
								break;
								case "MW":
								$nacixls="MW: Malawi";
								break;
								case "MV":
								$nacixls="MV: Maldivas";
								break;
								case "ML":
								$nacixls="ML: Mal&iacute;";
								break;
								case "MT":
								$nacixls="MT: Malta";
								break;
								case "MA":
								$nacixls="MA: Marruecos";
								break;
								case "MQ":
								$nacixls="MQ: Martinica";
								break;
								case "MU":
								$nacixls="MU: Mauricio";
								break;
								case "MR":
								$nacixls="MR: Mauritania";
								break;
								case "YT":
								$nacixls="YT: Mayotte";
								break;
								case "MX":
								$nacixls="MX: M&eacute;xico";
								break;
								case "FM":
								$nacixls="FM: Micronesia";
								break;
								case "MD":
								$nacixls="MD: Moldavia";
								break;
								case "MC":
								$nacixls="MC: M&oacute;naco";
								break;
								case "MN":
								$nacixls="MN: Mongolia";
								break;
								case "MS":
								$nacixls="MS: Montserrat";
								break;
								case "MZ":
								$nacixls="MZ: Mozambique";
								break;
								case "MM":
								$nacixls="MM: Myanmar";
								break;
								case "NA":
								$nacixls="NA: Namibia";
								break;
								case "NR":
								$nacixls="NR: Nauru";
								break;
								case "NP":
								$nacixls="NP: Nepal";
								break;
								case "NI":
								$nacixls="NI: Nicaragua";
								break;
								case "NE":
								$nacixls="NE: N&iacute;ger";
								break;
								case "NG":
								$nacixls="NG: Nigeria";
								break;
								case "NU":
								$nacixls="NU: Niue";
								break;
								case "NO":
								$nacixls="NO: Noruega";
								break;
								case "NC":
								$nacixls="NC: Nueva Caledonia";
								break;
								case "NZ":
								$nacixls="NZ: Nueva Zelanda";
								break;
								case "OM":
								$nacixls="OM: Om&aacute;n";
								break;
								case "PK":
								$nacixls="PK: Pakist&aacute;n";
								break;
								case "PW":
								$nacixls="PW: Palau";
								break;
								case "PS":
								$nacixls="PS: Palestina";
								break;
								case "PA":
								$nacixls="PA: Panam&aacute;";
								break;
								case "PG":
								$nacixls="PG: Pap&uacute;a Nueva Guinea";
								break;
								case "PY":
								$nacixls="PY: Paraguay";
								break;
								case "PE":
								$nacixls="PE: Per&uacute;";
								break;
								case "PF":
								$nacixls="PF: Polinesia Francesa";
								break;
								case "PL":
								$nacixls="PL: Polonia";
								break;
								case "PT":
								$nacixls="PT: Portugal";
								break;
								case "PR":
								$nacixls="PR: Puerto Rico";
								break;
								case "QA":
								$nacixls="QA: Qatar";
								break;
								case "GB":
								$nacixls="GB: Reino Unido";
								break;
								case "CF":
								$nacixls="CF: Rep&uacute;blica Centroafricana";
								break;
								case "CZ":
								$nacixls="CZ: Rep&uacute;blica Checa";
								break;
								case "CD":
								$nacixls="CD: Rep&uacute;blica Democr&aacute;tica Del Congo";
								break;
								case "DO":
								$nacixls="DO: Rep&uacute;blica Dominicana";
								break;
								case "RE":
								$nacixls="RE: Reuni&oacute;n";
								break;
								case "RW":
								$nacixls="RW: Ruanda";
								break;
								case "RO":
								$nacixls="RO: Rumania";
								break;
								case "RU":
								$nacixls="RU: Rusia";
								break;
								case "EH":
								$nacixls="EH: Sahara Occidental";
								break;
								case "WS":
								$nacixls="WS: Samoa";
								break;
								case "AS":
								$nacixls="AS: Samoa Americana";
								break;
								case "KN":
								$nacixls="KN: San Crist&oacute;bal Y Nevis";
								break;
								case "SM":
								$nacixls="SM: San Marino";
								break;
								case "PM":
								$nacixls="PM: San Pedro Y Miquel&oacute;n";
								break;
								case "VC":
								$nacixls="VC: San Vicente Y Las Granadinas";
								break;
								case "SH":
								$nacixls="SH: Santa Helena";
								break;
								case "LC":
								$nacixls="LC: Santa Luc&iacute;a";
								break;
								case "ST":
								$nacixls="ST: Santo Tom&eacute; Y Pr&iacute;ncipe";
								break;
								case "SN":
								$nacixls="SN: Senegal";
								break;
								case "CS":
								$nacixls="CS: Serbia Y Montenegro";
								break;
								case "SC":
								$nacixls="SC: Seychelles";
								break;
								case "SL":
								$nacixls="SL: Sierra Leona";
								break;
								case "SG":
								$nacixls="SG: Singapur";
								break;
								case "SY":
								$nacixls="SY: Siria";
								break;
								case "SO":
								$nacixls="SO: Somalia";
								break;
								case "LK":
								$nacixls="LK: Sri Lanka";
								break;
								case "SZ":
								$nacixls="SZ: Suazilandia";
								break;
								case "ZA":
								$nacixls="ZA: Sud&aacute;frica";
								break;
								case "SD":
								$nacixls="SD: Sud&aacute;n";
								break;
								case "SE":
								$nacixls="SE: Suecia";
								break;
								case "CH":
								$nacixls="CH: Suiza";
								break;
								case "SR":
								$nacixls="SR: Surinam";
								break;
								case "SJ":
								$nacixls="SJ: Svalbard Y Jan Mayen";
								break;
								case "TH":
								$nacixls="TH: Tailandia";
								break;
								case "TW":
								$nacixls="TW: Taiw&aacute;n";
								break;
								case "TZ":
								$nacixls="TZ: Tanzania";
								break;
								case "TJ":
								$nacixls="TJ: Tayikist&aacute;n";
								break;
								case "TO":
								$nacixls="IO: Territorio Brit&aacute;nico Del Oc&eacute;ano &Iacute;ndico";
								break;
								case "TF":
								$nacixls="TF: Territorios Australes Franceses";
								break;
								case "TL":
								$nacixls="TL: Timor Oriental";
								break;
								case "TG":
								$nacixls="TG: Togo";
								break;
								case "TK":
								$nacixls="TK: Tokelau";
								break;
								case "TO":
								$nacixls="TO: Tonga";
								break;
								case "TT":
								$nacixls="TT: Trinidad Y Tobago";
								break;

								case "TN":
								$nacixls="TN: T&uacute;nez";
								break;
								case "TM":
								$nacixls="TM: Turkmenist&aacute;n";
								break;
								case "TR":
								$nacixls="TR: Turqu&iacute;a";
								break;
								case "TV":
								$nacixls="TV: Tuvalu";
								break;
								case "UA":
								$nacixls="UA: Ucrania";
								break;
								case "UG":
								$nacixls="UG: Uganda";
								break;
								case "UY":
								$nacixls="UY: Uruguay";
								break;
								case "UZ":
								$nacixls="UZ: Uzbekist&aacute;n";
								break;
								case "VU":
								$nacixls="VU: Vanuatu";
								break;
								case "VE":
								$nacixls="VE: Venezuela";
								break;
								case "VN":
								$nacixls="VN: Vietnam";
								break;
								case "WF":
								$nacixls="WF: Wallis Y Futuna";
								break;
								case "YE":
								$nacixls="YE: Yemen";
								break;
								case "DJ":
								$nacixls="DJ: Yibuti";
								break;
								case "ZM":
								$nacixls="ZM: Zambia";
								break;
								case "ZW":
								$nacixls="ZW: Zimbawe";
								break;
								case "":
								$nacixls="";
								break;
								}
				 
				 $fech_cumple = explode ("/", $cumpleclie);
				 $fechitacumple= $fech_cumple[2] . "/" . $fech_cumple[1] . "/" . $fech_cumple[0];
				  
				/////////////////////aqui la fecha de firma////////////////////////////
				
				$sqlfirmita=mysql_query("select fechafirma from contratantes where idcontratante='$idcontratantee' and kardex='$kardex'",$conn);
				$rowfirmita = mysql_fetch_array($sqlfirmita);
				$firmasino=$rowfirmita['fechafirma'];
				
				
				$fec_firma=explode ("/",$fecha_next);
				$fec1a=intval($fec_firma[2].$fec_firma[1].$fec_firma[0]);
				
				
				$fec_firma2=explode ("/",$firmasino); 
                $fec2b =intval( $fec_firma2[2].$fec_firma2[1].$fec_firma2[0]);
					
				if ( $fec2b < $fec1a ) {
					$fechatxt2 = explode ("/", $firmasino);
				    $firmass = $fechatxt2[2] . "/" . $fechatxt2[1] . "/" . $fechatxt2[0];
					}else{
					$firmass ='';	
					}
					
			 
				if($tipoppersona=="N"){$tp="1: Natural"; $objciiu=""; $numeruc=""; $feccumpleclie = $fechitacumple; $autografo=$firmass;  $ciius="";$codnacion=$nacixls; $numedoc=$numdocu; $apepat_empre=str_replace("Ã","I",str_replace("Ã“","O",str_replace("`"," ",str_replace(")"," ",str_replace("("," ",str_replace("-"," ",str_replace("Âº"," ",str_replace(","," ",str_replace("."," ",str_replace("?"," ",str_replace("*"," ",str_replace("Ã‘","#",str_replace("Ã±","#",$rowcontrata['apepat']))))))))))))); $apemat=str_replace("Ã","I",str_replace("Ã“","O",str_replace("`"," ",str_replace(")"," ",str_replace("("," ",str_replace("-"," ",str_replace("Âº"," ",str_replace(","," ",str_replace("."," ",str_replace("?"," ",str_replace("*"," ",str_replace("Ã‘","#",str_replace("Ã±","#",$rowcontrata['apemat']))))))))))))); $direc_per_empre=str_replace("Ã","I",str_replace("Ã“","O",str_replace("`"," ",str_replace(")"," ",str_replace("("," ",str_replace("-"," ",str_replace("Âº"," ",str_replace(","," ",str_replace("."," ",str_replace("?"," ",str_replace("*"," ",str_replace("Ã‘","#",str_replace("Ã±","#",$rowcontrata['direccion']))))))))))))); $nombres=str_replace("Ã","I",str_replace("Ã“","O",str_replace("`"," ",str_replace(")"," ",str_replace("("," ",str_replace("-"," ",str_replace("Âº"," ",str_replace(","," ",str_replace("."," ",str_replace("?"," ",str_replace("*"," ",str_replace("Ã‘","#",str_replace("Ã±","#",$rowcontrata['prinom']." ".$rowcontrata['segnom']))))))))))))); $estciv=$estado_civil; if($profecion!=''){$profis=$profecion;}else{$profis="";} if($cargoprof!=""){$cargoprofis=$cargoprof;}else{$cargoprofis="";} if($tdxls!="8"){$tipdoc=$td;}}else{$numedoc=""; $nombres=""; $codnacion=""; $estciv=""; $profis=""; $cargoprofis=""; $nombres=""; $feccumpleclie = ""; $autografo=""; }
				 
				 if($tipoppersona=="J"){$tp="3: Jur&iacute;dica"; $tipdoc=""; 
				    if($numdocu==""){$numeruc="99999999999";}else{$numeruc=$numdocu;}
				    
				 $codnacion=""; $apemat=""; $apepat_empre=str_replace("Ã","I",str_replace("Ã“","O",str_replace("`"," ",str_replace(")"," ",str_replace("("," ",str_replace("-"," ",str_replace("Âº"," ",str_replace(","," ",str_replace("."," ",str_replace("?"," ",str_replace("*"," ",str_replace("Ã‘","#",str_replace("Ã±","#",$rowcontrata['razonsocial']))))))))))))); $direc_per_empre=str_replace("Ã","I",str_replace("Ã“","O",str_replace("`"," ",str_replace(")"," ",str_replace("("," ",str_replace("-"," ",str_replace("Âº"," ",str_replace(","," ",str_replace("."," ",str_replace("?"," ",str_replace("*"," ",str_replace("Ã‘","#",str_replace("Ã±","#",$rowcontrata['domfiscal']))))))))))))); $estciv=""; $profis=""; $cargoprofis=""; $nombres="";
				 if($ciiu!=""){$ciius=$ciiu;}else{$ciius="";}
				 if($objciiu!=""){$objciiu=$objciiu;}else{$objciiu='';};
				 
				 if($tipoopera!='037' || $tipoopera!='038' || $tipoopera!='039' || $tipoopera!='040' || $tipoopera!='041' || $tipoopera!='042' || $tipoopera!='043' || $tipoopera!='044' ){  
				 if($sederegparti!="0"){$srparti=$sederegpartixls;}else{$srparti="";}
				 if($numpartiparti!=""){$nparti=$numpartiparti;}else{$nparti="";}
				 }else{$numeruc=""; $srparti=""; $nparti="";}
				 }else{
					 $srparti=""; $nparti="";
					 }
				 
				 if($uif=='R'){
				  $repre="R: Representante";
				  $sqlreprede=mysql_query("select idcontratanterp, inscrito from contratantes where idcontratante='$idcontratantee' and kardex='$kardex'",$conn);
				  $rowreprede = mysql_fetch_array($sqlreprede);
				  $representaa=$rowreprede['idcontratanterp'];
				  $inscrito=$rowreprede['inscrito'];
				 //aqui coloque 2 de no inscrito pk el sistema no tiene actualizado el inscrito y ede registral ni numeor de partida
				  if($inscrito=='1'){$inscri="1: Representante Inscrito";} if($inscrito=='0'){$inscri="2: Representante No Inscrito";} if($inscrito==''){$inscri="2: Representante No Inscrito";}

				  if($representaa!=''){
					  $sqldatouif=mysql_query("select uif from contratantesxacto where idcontratante='$representaa'",$conn);
					  $rowrepreaa = mysql_fetch_array($sqldatouif);
					  $rpa2=$rowrepreaa['uif'];
					  switch ($rpa2) {
						case "O":
							$rpa= "O: Ordenante /Propietario";
							break;
						case "B":
							$rpa= "B: Beneficiario /Adquirente";
							break;
						case "G":
							$rpa= "G: Fiador /Garante";
							break;
						case "F":
							$rpa= "F: Fiduciario";
							break;
						case "N":
							$rpa= "N: Otro";
							break;
						}
					  }else{$rpa="";}
				  }else{$repre=""; $rpa="";} 
				  
				  if($uif=='O'){$orde="O: Ordenante /Propietario"; $inscri=""; $repre=""; $rpa="";
				  }else{
					if($uif=='G'){$orde="G: Fiador /Garante"; $inscri=""; $repre=""; $rpa="";
					  }else{
						if($uif=='F'){$orde="F: Fiduciario"; $inscri=""; $repre=""; $rpa="";
						  }else{
						     if($uif=='N'){$orde="N: Otro"; $inscri=""; $repre=""; $rpa="";
							   }else{$orde="";
							   }
						   }
					   }
					}
                  if($uif=='B'){$bene="B: Beneficiario /Adquirente"; $inscri=""; $repre=""; $rpa="";}else{$bene="";} 
				  
				 /* if($uif=='O'){$orde="O: Ordenante /Propietario"; $inscri=""; $repre=""; $rpa="";}else{$orde="";}  
				  if($uif=='B'){$bene="B: Beneficiario /Adquirente"; $inscri=""; $repre=""; $rpa="";}else{$bene="";} 
				  if($uif=='G'){$orde="G: Fiador /Garante"; $inscri=""; $repre=""; $rpa="";}else{$orde="";} 
				  if($uif=='F'){$orde="F: Fiduciario"; $inscri=""; $repre=""; $rpa="";}else{$orde="";} 
				  if($uif=='N'){$orde="N: Otro"; $inscri=""; $repre=""; $rpa="";}else{$orde="";} */
							 
					    echo'
	<tr>
<td height="23"  valign="top" style="mso-number-format:\@" bgcolor="#FFFFFF">'.$kardex.'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.substr($correlativo,0,8).'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.substr($sec,0,8).'</td>
<td align="left" valign="top" bgcolor="#FFFFFF" >'.$tipoenvio2.'</td>
<td align="left" valign="top" bgcolor="#FFFFFF" >'.$idtipkarxls.'</td>
<td align="left" valign="top" bgcolor="#FFFFFF" >'.substr($numescritura,0,6).'</td>
<td align="left" valign="top" bgcolor="#FFFFFF" >'.$fechas.'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.substr($vacio,0,6).'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.substr($vacio,0,8).'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.$conclu.'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.$autografo.'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.$modalidad.'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.substr($vacio,0,4).'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.$repre.'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.$orde.'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.$bene.'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.$rpa.'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.$inscri.'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.$resi.'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.$tp.'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.$tipdoc.'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.substr($numedoc,0,20).'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.substr($numeruc,0,11).'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.strtoupper(str_replace('Ñ','#',str_replace('ñ','#',holaacentos($apepat_empre)))).'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.strtoupper(str_replace('Ñ','#',str_replace('ñ','#',holaacentos($apemat)))).'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.strtoupper(str_replace('Ñ','#',str_replace('ñ','#',holaacentos($nombres)))).'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.$codnacion.'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.$feccumpleclie.'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.$estciv.'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.$profis.'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.substr(holaacentos($objciiu),0,40).'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.$ciius.'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.$cargoprofis.'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.$srparti.'</td>
<td align="left" valign="top" bgcolor="#FFFFFF" style="mso-number-format:\@">'.substr($nparti,0,12).'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.substr(holaacentos($direc_per_empre),0,150).'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.$departamento.'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.$provincia.'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.$distrito.'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.substr($vacio,0,40).'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.$paricipaesposa.'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.substr($vacio,0,40).'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.substr($vacio,0,40).'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.substr($vacio,0,40).'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.substr($vacio,0,2).'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.$tipooperaxls.'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.substr($vacio,0,1).'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.substr($vacio,0,2).'</td>
<td align="left" valign="top" bgcolor="#FFFFFF" style="mso-number-format:\@">'.substr(strtoupper($vacio),0,40).'</td>
<td align="left" valign="top" bgcolor="#FFFFFF" style="mso-number-format:\@">'.substr(strtoupper(holaacentos($ofondo)),0,40).'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.$monedita2.'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.substr($vaciomonto,0,18).'</td>
<td align="left" valign="top" bgcolor="#FFFFFF" style="mso-number-format:0.00">'.substr($monto,0,18).'</td>
<td align="left" valign="top" bgcolor="#FFFFFF" >'.substr($vaciomonto,0,18).'</td>
<td align="left" valign="top" bgcolor="#FFFFFF" style="mso-number-format:0.00">'.$tipcambio.'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.substr($vacio,0,1).'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.substr($vacio,0,2).'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.substr($vacio,0,12).'</td>
</tr> 
	';
								}	
				
			}else{
			 echo"
<tr>
<td height='23' align='left' valign='top' style='mso-number-format:\@' bgcolor='#993300'><span style='font-size:12px; color:#ffffff;'>".$kardex."</span></td>
<td align='left' valign='top' bgcolor='#993300'><span style='font-size:12px; color:#ffffff;'>No Tiene Contratantes</span></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300' style='mso-number-format:\@'></td>
<td align='left' valign='top' bgcolor='#993300' style='mso-number-format:\@'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300' style='mso-number-format:\@'></td>
<td align='left' valign='top' bgcolor='#993300' style='mso-number-format:\@'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300' style='mso-number-format:\@'></td>
<td align='left' valign='top' bgcolor='#993300' style='mso-number-format:\@'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300' style='mso-number-format:0.00'></td>
<td align='left' valign='top' bgcolor='#993300' style='mso-number-format:0.00'></td>
<td align='left' valign='top' bgcolor='#993300' style='mso-number-format:0.00'></td>
<td align='left' valign='top' bgcolor='#993300' style='mso-number-format:0.00'></td>
<td align='left' valign='top' bgcolor='#993300' style='mso-number-format:\@'></td>
<td align='left' valign='top' bgcolor='#993300' style='mso-number-format:\@'></td>
<td align='left' valign='top' bgcolor='#993300' style='mso-number-format:\@'>
</tr>";
			}
	
				  
	 /*///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////*/
		  
	 }else{// Aqui en caso contrario el kardex no tenga patrimonial
					  
					  	  echo"
<tr>
<td height='23' align='left' valign='top' style='mso-number-format:\@' bgcolor='#993300'><span style='font-size:12px; color:#ffffff;'>".$kardex."</span></td>
<td align='left' valign='top' bgcolor='#993300'><span style='font-size:12px; color:#ffffff;'>No Tiene Patrimonial</span></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300' style='mso-number-format:\@'></td>
<td align='left' valign='top' bgcolor='#993300' style='mso-number-format:\@'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300' style='mso-number-format:\@'></td>
<td align='left' valign='top' bgcolor='#993300' style='mso-number-format:\@'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300' style='mso-number-format:\@'></td>
<td align='left' valign='top' bgcolor='#993300' style='mso-number-format:\@'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300'></td>
<td align='left' valign='top' bgcolor='#993300' style='mso-number-format:0.00'></td>
<td align='left' valign='top' bgcolor='#993300' style='mso-number-format:0.00'></td>
<td align='left' valign='top' bgcolor='#993300' style='mso-number-format:0.00'></td>
<td align='left' valign='top' bgcolor='#993300' style='mso-number-format:0.00'></td>
<td align='left' valign='top' bgcolor='#993300' style='mso-number-format:\@'></td>
<td align='left' valign='top' bgcolor='#993300' style='mso-number-format:\@'></td>
<td align='left' valign='top' bgcolor='#993300' style='mso-number-format:\@'>
</tr>";
	 }
	
	
	 
 }else{

   /*////////////////////////////// aqui cunado el tipo de envio es complementario//*/

  // if(!empty($karpatri)){//Aqui pregunto si el kardex en patrimonial es diferente del vacio
		  
	 /*//////////////////////////// A PARTIR DE AQUI COMENZAMOS A CREAR LAS FILAS DE OPRACION Y LOS PARTICIPANTES //////////////////////////////////////////////*/
	
	       $tipoenvio2="C: Complementaria";
			
			
			   $oprtunidaddepago=$opagoxls;
			   		
			if($tipoopera=='042'){
			    $monedita="";
			}else{
				
				if($importetotal!='0.00'){
				if($tipomoneda=='2'){ $monedita="USD: D&oacute;lar Estadounidense"; }
				if($tipomoneda=='1'){ $monedita="PEN: Nuevo Sol Peruano"; }
			      }else{
				   $monedita="";
				}  
			}
				
			if($oprtunidaddepago=='99'){ $detalleoppago="NO PRECISA"; }else{ $detalleoppago=""; }
		    
			if($idtipkar=='3'){
		
			$regis2="SELECT detallevehicular.pregistral, detallevehicular.idsedereg FROM detallevehicular WHERE detallevehicular.kardex='$kardex' 
			         AND detallevehicular.idtipacto='$idtipoacto'";
			$resregis2=mysql_query($regis2,$conn);
			$valor_detalle=mysql_num_rows($resregis2);
				
				if($valor_detalle!=0){
					 $rowregis2 = mysql_fetch_array($resregis2);
					 $nump=$rowregis2['pregistral']; $sr=$rowregis2['idsedereg'];
					 if($nump!="" && $sr!=""){
						 switch ($sr) {
							case "01":
								$sedereg= "01: Piura";
								break;
							case "02":
								$sedereg= "02: Chiclayo";
								break;
							case "03":
								$sedereg= "03: Moyobamba";
								break;
							case "04":
								$sedereg= "04: Iquitos";
								break;							
							case "05":
								$sedereg= "05: Trujillo";
								break;							
							case "06":
								$sedereg= "06: Pucallpa";
								break;
							case "07":
								$sedereg= "07: Huaraz";
								break;
							case "08":
								$sedereg= "08: Huancayo";
								break;
							case "09":
								$sedereg= "09: Lima";
								break;
							case "10":
								$sedereg= "10: Cusco";
								break;
							case "11":
								$sedereg= "11: Ica";
								break;
							case "12":
								$sedereg= "12: Arequipa";
								break;
							case "13":
								$sedereg= "13: Tacna";
								break;
							
							} 
						$incri="I: Inscrito";  $numpartida=$rowregis2['pregistral'];
					 }else{$incri="N: No Inscrito"; $sedereg=""; $numpartida="";}

				 }else{$incri="N: No Inscrito"; $sedereg=""; $numpartida="";}
			
			}else{
			$regis="SELECT detallebienes.pregistral, detallebienes.idsedereg FROM detallebienes WHERE detallebienes.kardex='$kardex' AND detallebienes.idtipacto='$idtipoacto'";
			$resregis=mysql_query($regis,$conn);
			$valor_detalle2=mysql_num_rows($resregis);
			$rowregis = mysql_fetch_array($resregis);
			    if($valor_detalle2!=0){
					$nump=$rowregis['pregistral']; $sr=$rowregis['idsedereg'];
					if($rowregis['pregistral']!="" && $sr=$rowregis['idsedereg']!="" ){
						$incri="I: Inscrito"; $sedereg=$rowregis['idsedereg']; $numpartida=$rowregis['pregistral'];
						}else{ $incri="N: No Inscrito"; $sedereg=""; $numpartida="";}
					
			    }else{$incri="N: No Inscrito"; $sedereg=""; $numpartida="";}
	        }
			
			$sqlmedipago="SELECT DISTINCT detallemediopago.kardex, detallemediopago.tipacto, detallemediopago.codmepag, detallemediopago.fpago, detallemediopago.idbancos,
			              SUM(detallemediopago.importemp) AS sumamp, detallemediopago.idmon, mediospago.uif, fpago_uif.codigo FROM detallemediopago 
						  INNER JOIN mediospago ON detallemediopago.codmepag = mediospago.codmepag
						  LEFT JOIN fpago_uif ON fpago_uif.id_fpago=detallemediopago.fpago
						  WHERE detallemediopago.kardex='$kardex' AND detallemediopago.tipacto='$idtipoacto' GROUP BY detallemediopago.codmepag, detallemediopago.tipacto";

		    
		    $resmp=mysql_query($sqlmedipago,$conn);
		    $valor_medio_pago=mysql_num_rows($resmp);
			if($valor_medio_pago!=0){
				while($rowmp1 = mysql_fetch_array($resmp)) {
				//$correlativo=$correlativo+1;	
				$medpag_tipfondo=$rowmp1['uif'];
				switch ($medpag_tipfondo) {
							case "01":
								$mp_tf= "01: Efectivo";
								break;
							case "02":
								$mp_tf= "02: Cheque";
								break;
							case "03":
								$mp_tf= "03: Giro";
								break;
							case "04":
								$mp_tf= "04: Transferencia Bancaria";
								break;							
							case "05":
								$mp_tf= "05: Dep&oacute;sito En Cuenta";
								break;							
							case "06":
								$mp_tf= "06: Tarjeta De Cr&eacute;dito";
								break;
							case "07":
								$mp_tf= "07: Bien Mueble";
								break;
							case "08":
								$mp_tf= "08: Bien Inmueble";
								break;
							case "99":
								$mp_tf= "99: Otro";
								break;
							} 
							
				$codigomp=$rowmp1['codmepag']; $sumamp=$rowmp1['sumamp']; $money=$rowmp1['idmon']; $tpoacto=$rowmp1['tipacto']; $vacio="";                 if($tipoopera=='042'){$tipofondo='';}else{$tipofondo=$mp_tf;}
				 
				 $vaciomonto='0.00';
				if($tipoopera=='042' || $tipoopera=='026' || $tipoopera=='027'){$formapago="";}else{
					
					$consulta="select * from fpago_uif where id_fpago=".$row['fpago']."";

					$rescon=mysql_query($consulta,$conn);
					$fila=mysql_fetch_array($rescon);
					$formapagoxls=$fila['codigo'];
					
					switch ($formapagoxls) {
							case "C":
								$formapago= "C: Al Contado";
								break;
							case "P":
								$formapago= "P: A Plazos (M&aacute;s De Una Cuota)";
								break;
							case "S":
								$formapago= "S: Saldo Pendiente De Pago (Una Cuota)";
								break;
							case "D":
								$formapago= "D: Donaciones O Anticipos";
								break;							
							case "N":
								$formapago= "N: No Aplica";
								break;							
							case "":
								$formapago= "";
								break;
							} 

					}
				
				//aqui va la estructura de la cabecera del ro
	
	              
				}
			}else{
				//echo str_pad("El Kardex Nro: ".$kardex." NO Tiene Fila de Operacion",'100'," ",STR_PAD_LEFT).chr(13).chr(10);
			}
			
			$sql_contratantes='SELECT DISTINCT contratantesxacto.kardex, kardex.codactos, contratantesxacto.idtipoacto,contratantesxacto.monto,
contratantesxacto.idcontratante, contratantesxacto.uif, contratantesxacto.ofondo, contratantesxacto.opago, contratantesxacto.idcontratante,
contratantes.fechafirma, kardex.kardex,kardex.idtipkar, kardex.numescritura, kardex.fechaescritura, kardex.fechaconclusion ,
cliente2.apemat, cliente2.apepat,  cliente2.prinom, cliente2.segnom, cliente2.numdoc,
cliente2.razonsocial, cliente2.direccion, cliente2.domfiscal, cliente2.tipper, cliente2.idtipdoc, cliente2.residente, cliente2.nacionalidad,
cliente2.idestcivil, cliente2.cumpclie, cliente2.idprofesion, cliente2.idcargoprofe, cliente2.actmunicipal, cliente2.idubigeo, cliente2.conyuge,
cliente2.idsedereg, cliente2.numpartida
FROM contratantesxacto
INNER JOIN contratantes ON contratantes.idcontratante = contratantesxacto.idcontratante
INNER JOIN cliente2 ON contratantesxacto.idcontratante= cliente2.idcontratante
LEFT JOIN kardex ON kardex.kardex= contratantesxacto.kardex
WHERE contratantes.fechafirma <> "" AND  STR_TO_DATE(contratantes.fechafirma,"%d/%m/%Y") >= STR_TO_DATE("'.$fechade.'","%d/%m/%Y") AND STR_TO_DATE(contratantes.fechafirma,"%d/%m/%Y") <= STR_TO_DATE("'.$fechaha.'","%d/%m/%Y") 
AND kardex.fechaescritura < STR_TO_DATE("'.$fechade.'","%d/%m/%Y") AND kardex.fechaescritura <> ""  AND contratantesxacto.kardex="'.$kardex.'" 
AND contratantesxacto.idtipoacto="'.$tpoacto.'" AND contratantesxacto.uif <> "" AND (contratantesxacto.uif="O" 
OR contratantesxacto.uif="B" OR contratantesxacto.uif="R") ORDER BY contratantesxacto.uif DESC';	
 
            $rescontra=mysql_query($sql_contratantes,$conn);
			$valor_contratantes=mysql_num_rows($rescontra);
			if($valor_contratantes!=0){
			    
				while($rowcontrata = mysql_fetch_array($rescontra)) {
				 $correlativo=$correlativo+1;
				 $sec=$sec + 1;
				$uif=$rowcontrata['uif']; $monto=$rowcontrata['monto'];  $numdocu=$rowcontrata['numdoc']; $tipoppersona=$rowcontrata['tipper']; $td=$rowcontrata['idtipdoc']; 
				 $ofondo=$rowcontrata['ofondo']; $idcontratantee=$rowcontrata['idcontratante']; $residente=$rowcontrata['residente']; $estado_civil=$rowcontrata['idestcivil'];
				 $cumpleclie=$rowcontrata['cumpclie']; $nacionalidad=$rowcontrata['nacionalidad']; $profe=$rowcontrata['idprofesion']; $ciiu=$rowcontrata['actmunicipal']; 
				 $cargoprofe=$rowcontrata['idcargoprofe']; $sederegparti=$rowcontrata['idsedereg']; $numpartiparti=$rowcontrata['numpartida']; $ubigeo=$rowcontrata['idubigeo']; 
				 $esposa=$rowcontrata['conyuge']; $kardexx=$rowcontrata['kardex']; $tipoactosss=$rowcontrata['idtipoacto']; $objciiu=str_replace("Ã","I",str_replace("Ã“","O",str_replace("`"," ",str_replace(")"," ",str_replace("("," ",str_replace("-"," ",str_replace("Âº"," ",str_replace(","," ",str_replace("."," ",str_replace("?"," ",str_replace("*"," ",str_replace("Ã‘","#",str_replace("Ã±","#",$rowcontrata['contacempresa'])))))))))))));
                      
					     switch ($sederegparti) {
							case "01":
								$sederegpartixls= "01: Piura";
								break;
							case "02":
								$sederegpartixls= "02: Chiclayo";
								break;
							case "03":
								$sederegpartixls= "03: Moyobamba";
								break;
							case "04":
								$sederegpartixls= "04: Iquitos";
								break;							
							case "05":
								$sederegpartixls= "05: Trujillo";
								break;							
							case "06":
								$sederegpartixls= "06: Pucallpa";
								break;
							case "07":
								$sederegpartixls= "07: Huaraz";
								break;
							case "08":
								$sederegpartixls= "08: Huancayo";
								break;
							case "09":
								$sederegpartixls= "09: Lima";
								break;
							case "10":
								$sederegpartixls= "10: Cusco";
								break;
							case "11":
								$sederegpartixls= "11: Ica";
								break;
							case "12":
								$sederegpartixls= "12: Arequipa";
								break;
							case "13":
								$sederegpartixls= "13: Tacna";
								break;
							
							} 
					    
					    switch ($ciiuxls) {
							case "A":
								$ciiu= "A   : Agricultura Ganaderia Caza Y Silvicultura";
								break;
							case "B":
								$ciiu= "B   : Pesca";
								break;
							case "C":
								$ciiu= "C   : Explotacion De Minas Y Canteras";
								break;
							case "D":
								$ciiu= "D   : Industrias Manufactureras";
								break;							
							case "E":
								$ciiu= "E   : Suministro De Electricidad, Gas Y Agua";
								break;							
							case "F":
								$ciiu= "F   : Construccion";
								break;
							case "G":
								$ciiu= "G   : Comercio Al Por Mayor Y Menor, Reparacion De Vehiculos Automotores, Art. Domesticos";
								break;
							case "H":
								$ciiu= "H   : Hoteles Y Restaurantes";
								break;
							case "I":
								$ciiu= "I   : Transporte,Almacenamiento Y Comunicaciones";
								break;
							case "J":
								$ciiu= "J   : Intermediacion Financiera";
								break;
							case "K":
								$ciiu= "K   : Actividades Inmobiliarias, Empresariales Y De Alquiler";
								break;
							case "L":
								$ciiu= "L   : Administracion Publica Y Defensa, Planes De Seguridad Social De Afiliacion Obligatoria";
								break;
							case "M":
								$ciiu= "M   : Ense&ntilde;anza(Privada)";
								break;
							case "N":
								$ciiu= "N   : Actividades De Servicios Sociales Y De Salud (Privada)";
								break;
							case "O":
								$ciiu= "O   : Otras Activ. De Servicios Comunitarias, Sociales Y Personales";
								break;
							case "P":
								$ciiu= "P   : Hogares Privados Con Servicio Domestico";
								break;
							case "Q":
								$ciiu= "Q   : Organizaciones Y Organos Extraterritoriales";
								break;
							} 
					    switch ($tdxls) {
							case "1":
								$td= "1: Documento Nacional de Identidad (DNI)";
								break;
							case "2":
								$td= "2: Carn&eacute; de extranjer&iacute;a";
								break;
							case "3":
								$td= "3: Carn&eacute; de identidad de las Fuerzas Policiales";
								break;
							case "4":
								$td= "4: Carn&eacute; de identidad de las Fuerzas Armadas";
								break;							
							case "5":
								$td= "5: Pasaporte";
								break;							
							case "6":
								$td= "6: C&eacute;dula de Ciudadan&iacute;a";
								break;
							case "7":
								$td= "7: C&eacute;dula diplom&aacute;tica de identidad";
								break;
							case "9":
								$td= "9: Otro";
								break;
							case "8":
								$td= "";
								break;
							case "10":
								$td= "";
								break;
							case "11":
								$td= "";
								break;
							} 
				 		switch ($estado_civilxls) {
							case "1":
								$estado_civil= "1: Soltero";
								break;
							case "2":
								$estado_civil= "2: Casado";
								break;
							case "3":
								$estado_civil= "3: Viudo";
								break;
							case "4":
								$estado_civil= "4: Divorciado";
								break;							
							case "5":
								$estado_civil= "5: Conviviente";
								break;							
							
							} 
							
				 if(!empty($residente)){
					 if($residente=="1"){$resi="1: Residente";}else{$resi="2: No Residente";}
					 }else{$resi="1: Residente";}
				 
					if($tipoactosss=='038'){
			         $monedita2="";
			       }else{
				
				     if($monto!=''){
				     if($tipomoneda=='2'){ $monedita2="USD: D&oacute;lar Estadounidense"; }
				     if($tipomoneda=='1'){ $monedita2="PEN: Nuevo Sol Peruano"; }
			          }else{
				        $monedita2="";
				      }  
			      }
			 
					 if($esposa!=""){
						 $sqlespo=mysql_query("select idcontratante from contratantesxacto where idcontratante='$esposa' and (kardex='$kardexx' and idtipoacto='$tipoactosss')",$conn);
						 $rowespo = mysql_fetch_array($sqlespo);
						 $esposita=$rowespo['idcontratante'];
						 if($esposita!=""){ $paricipaesposa="S: Si Participa";}else{$paricipaesposa="N: No Participa";}
					 }else{$paricipaesposa="";}


				 if($ubigeo!=""){
				 $departamentoxls=substr($ubigeo,0,2);
				 $provinciaxls=substr($ubigeo,2,2);
				 $distritoxls=substr($ubigeo,4,2);
				 
				 
				 $con_ubigeo2   = mysql_query("SELECT coddis, nomdis, nomprov, nomdpto, coddist, codprov, codpto FROM ubigeo WHERE coddis='$ubigeo'",$conn);
				 $rowubigeo2    = mysql_fetch_array($con_ubigeo2);
				 $departamento = $rowubigeo2['codpto'].': '.$rowubigeo2['nomdpto'];
				 $provincia    = $rowubigeo2['codprov'].': '.$rowubigeo2['nomprov'];
				 $distrito     = $rowubigeo2['coddist'].': '.$rowubigeo2['nomdis'];
				 
				 /*
				 
				  switch ($departamentoxls) {
							case "01":
								$departamento= "01: Amazonas";
								 switch ($provinciaxls) { 
									case "01": 
									$provincia = "01: Chachapoyas"; 
									  switch ($distritoxls) { 
										case "01": 
											$distrito = "01: Chachapoyas"; 
											break; 
											case "02": 
											$distrito = "02: Asuncion"; 
											break;
											case "03": 
											$distrito = "03: Balsas"; 
											break; 
											case "04": 
											$distrito = "04: Cheto"; 
											break; 
											case "05": 
											$distrito = "05: Chiliquin"; 
											break; 
											case "06": 
											$distrito = "06: Chuquibamba"; 
											break; 
											case "07": 
											$distrito = "07: Granada"; 
											break; 
											case "08": 
											$distrito = "08: Huancas"; 
											break;
											case "09": 
											$distrito = "09: La Jalca"; 
											break;
											case "10": 
											$distrito = "10: Leimebamba"; 
											break;
											case "11": 
											$distrito = "11: Levanto"; 
											break;
											case "12": 
											$distrito = "12: Magdalena"; 
											break;
											case "13": 
											$distrito = "13: Mariscal Castilla"; 
											break;
											case "14": 
											$distrito = "14: Molinopampa"; 
											break;
											break;
											case "15": 
											$distrito = "15: Montevideo"; 
											break;
											break;
											case "16": 
											$distrito = "16: Olleros"; 
											break;
											break;
											case "17": 
											$distrito = "17: Quinjalca"; 
											break;
											case "18": 
											$distrito = "18: San Francisco De Daguas"; 
											break;
											case "19": 
											$distrito = "19: San Isidro De Maino"; 
											break;
											case "20": 
											$distrito = "20: Soloco"; 
											break;
											case "21": 
											$distrito = "21: Sonche"; 
											break;
										} 
									break; 
									case "02": 
									$provincia = "02: Bagua"; 
									switch ($distritoxls) { 
										case "01": 
											$distrito = "01: La Peca"; 
											break; 
											case "02": 
											$distrito = "02: Aramango"; 
											break;
											case "03": 
											$distrito = "03: Copallin"; 
											break; 
											case "04": 
											$distrito = "04: El Parco"; 
											break; 
											case "05": 
											$distrito = "05: Imaza"; 
											break; 
									     }
									break;
									case "03": 
									$provincia = "03: Bongara";
									  switch ($distritoxls) { 
										case "01": 
											$distrito = "01: Jumbilla"; 
											break; 
											case "02": 
											$distrito = "02: Chisquilla"; 
											break;
											case "03": 
											$distrito = "03: Churuja"; 
											break; 
											case "04": 
											$distrito = "04: Corosha"; 
											break; 
											case "05": 
											$distrito = "05: Cuispes"; 
											break; 
											case "06": 
											$distrito = "06: Florida"; 
											break; 
											case "07": 
											$distrito = "07: Jazßn"; 
											break; 
											case "08": 
											$distrito = "08: Recta"; 
											break;
											case "09": 
											$distrito = "09: San Carlos"; 
											break;
											case "10": 
											$distrito = "10: Shipasbamba"; 
											break;
											case "11": 
											$distrito = "11: Valera"; 
											break;
											case "12": 
											$distrito = "12: Yambrasbamba"; 
											break;
									    }
									break; 
									case "04": 
									$provincia = "04: Condorcanqui"; 
									 switch ($distritoxls) { 
										case "01": 
											$distrito = "01: Nieva"; 
											break; 
											case "02": 
											$distrito = "02: El Cenepa"; 
											break;
											case "03": 
											$distrito = "03: Rio Santiago"; 
											break; 
									    }
									break; 
									case "05": 
									$provincia = "05: Luya"; 
									 switch ($distritoxls) { 
										case "01": 
											$distrito = "01: Lamud"; 
											break; 
											case "02": 
											$distrito = "02: Camporredondo"; 
											break;
											case "03": 
											$distrito = "03: Cocabamba"; 
											break; 
											case "04": 
											$distrito = "04: Colcamar"; 
											break; 
											case "05": 
											$distrito = "05: Conila"; 
											break; 
											case "06": 
											$distrito = "06: Inguilpata"; 
											break; 
											case "07": 
											$distrito = "07: Longuita"; 
											break; 
											case "08": 
											$distrito = "08: Lonya Chico"; 
											break;
											case "09": 
											$distrito = "09: Luya"; 
											break;
											case "10": 
											$distrito = "10: Luya Viejo"; 
											break;
											case "11": 
											$distrito = "11: Maria"; 
											break;
											case "12": 
											$distrito = "12: Ocalli"; 
											break;
											case "13": 
											$distrito = "13: Ocumal"; 
											break;
											case "14": 
											$distrito = "14: Pisuquia"; 
											break;
											break;
											case "15": 
											$distrito = "15: Providencia"; 
											break;
											case "16": 
											$distrito = "16: San Cristobal"; 
											break;
											case "17": 
											$distrito = "17: San Francisco Del Yeso"; 
											break;
											case "18": 
											$distrito = "18: San Jeronimo"; 
											break;
											case "19": 
											$distrito = "19: San Juan De Lopecancha"; 
											break;
											case "20": 
											$distrito = "20: Santa Catalina"; 
											break;
											case "21": 
											$distrito = "21: Santo Tomas"; 
											break;
											case "22": 
											$distrito = "22: Tingo"; 
											break;
											case "23": 
											$distrito = "23: Trita"; 
											break;
										} 
									break; 
									case "06": 
									$provincia = "06: Rodriguez De Mendoza"; 
									  switch ($distritoxls) { 
										case "01": 
											$distrito = "01: San Nicolas"; 
											break; 
											case "02": 
											$distrito = "02: Chirimoto"; 
											break;
											case "03": 
											$distrito = "03: Cochamal"; 
											break; 
											case "04": 
											$distrito = "04: Huambo"; 
											break; 
											case "05": 
											$distrito = "05: Limabamba"; 
											break; 
											case "06": 
											$distrito = "06: Longar"; 
											break; 
											case "07": 
											$distrito = "07: Mariscal Benavides"; 
											break; 
											case "08": 
											$distrito = "08: Milpuc"; 
											break;
											case "09": 
											$distrito = "09: Omia"; 
											break;
											case "10": 
											$distrito = "10: Santa Rosa"; 
											break;
											case "11": 
											$distrito = "11: Totora"; 
											break;
											case "12": 
											$distrito = "12: Vista Alegre"; 
											break;
									  }
									break; 
									case "07": 
									$provincia = "07: Utcubamba"; 
									 switch ($distritoxls) { 
										case "01": 
											$distrito = "01: Bagua Grande"; 
											break; 
											case "02": 
											$distrito = "02: Cajaruro"; 
											break;
											case "03": 
											$distrito = "03: Cumba"; 
											break; 
											case "04": 
											$distrito = "04: El Milagro"; 
											break; 
											case "05": 
											$distrito = "05: Jamalca"; 
											break; 
											case "06": 
											$distrito = "06: Lonya Grande"; 
											break; 
											case "07": 
											$distrito = "07: Yamon"; 
											break; 
									  }
									break; 
								} 
								break;
							case "02":
								$departamento= "02: Ancash";
								  switch ($provinciaxls) { 
									case "01": 
									$provincia = "01: Huaraz"; 
									  switch ($distritoxls) { 
										case "01": 
											$distrito = "01: Huaraz"; 
											break; 
											case "02": 
											$distrito = "02: Cochabamba"; 
											break;
											case "03": 
											$distrito = "03: Colcabamba"; 
											break; 
											case "04": 
											$distrito = "04: Huanchay"; 
											break; 
											case "05": 
											$distrito = "05: Independencia"; 
											break; 
											case "06": 
											$distrito = "06: Jangas"; 
											break; 
											case "07": 
											$distrito = "07: La Libertad"; 
											break; 
											case "08": 
											$distrito = "08: Olleros"; 
											break;
											case "09": 
											$distrito = "09: Pampas"; 
											break;
											case "10": 
											$distrito = "10: Pariacoto"; 
											break;
											case "11": 
											$distrito = "11: Pira"; 
											break;
											case "12": 
											$distrito = "12: Tarica"; 
											break;
										} 
									break; 
									case "02": 
									$provincia = "02: Aija"; 
									switch ($distritoxls) { 
										case "01": 
											$distrito = "01: Aija"; 
											break; 
											case "02": 
											$distrito = "02: Coris"; 
											break;
											case "03": 
											$distrito = "03: Huacllan"; 
											break; 
											case "04": 
											$distrito = "04: La Merced"; 
											break; 
											case "05": 
											$distrito = "05: Succha"; 
											break; 
									     }
									break;
									case "03": 
									$provincia = "03: Antonio Raymondi";
									  switch ($distritoxls) { 
										case "01": 
											$distrito = "01: Llamellin"; 
											break; 
											case "02": 
											$distrito = "02: Aczo"; 
											break;
											case "03": 
											$distrito = "03: Chaccho"; 
											break; 
											case "04": 
											$distrito = "04: Chingas"; 
											break; 
											case "05": 
											$distrito = "05: Mirgas"; 
											break; 
											case "06": 
											$distrito = "06: San Juan De Rontoy"; 
											break; 
									    }
									break; 
									case "04": 
									$provincia = "04: Asuncion"; 
									 switch ($distritoxls) { 
										case "01": 
											$distrito = "01: Chacas"; 
											break; 
											case "02": 
											$distrito = "02: Acochaca"; 
											break;
									    }
									break; 
									case "05": 
									$provincia = "05: Bolognesi"; 
									 switch ($distritoxls) { 
										case "01": 
											$distrito = "01: Chiquian"; 
											break; 
											case "02": 
											$distrito = "02: Abelardo Pardo Lezameta"; 
											break;
											case "03": 
											$distrito = "03: Antonio Raymondi"; 
											break; 
											case "04": 
											$distrito = "04: Aquia"; 
											break; 
											case "05": 
											$distrito = "05: Cajacay"; 
											break; 
											case "06": 
											$distrito = "06: Canis"; 
											break; 
											case "07": 
											$distrito = "07: Colquioc"; 
											break; 
											case "08": 
											$distrito = "08: Huallanca"; 
											break;
											case "09": 
											$distrito = "09: Huasta"; 
											break;
											case "10": 
											$distrito = "10: Huayllacayan"; 
											break;
											case "11": 
											$distrito = "11: La Primavera"; 
											break;
											case "12": 
											$distrito = "12: Mangas"; 
											break;
											case "13": 
											$distrito = "13: Pacllon"; 
											break;
											case "14": 
											$distrito = "14: San Miguel De Corpanqui"; 
											break;
											break;
											case "15": 
											$distrito = "15: Ticllos"; 
											break;
										} 
									break; 
									case "06": ///////
									$provincia = "06: Carhuaz"; 
									  switch ($distritoxls) { 
										case "01": 
											$distrito = "01: Carhuaz"; 
											break; 
											case "02": 
											$distrito = "02: Acopampa"; 
											break;
											case "03": 
											$distrito = "03: Amashca"; 
											break; 
											case "04": 
											$distrito = "04: Anta"; 
											break; 
											case "05": 
											$distrito = "05: Ataquero"; 
											break; 
											case "06": 
											$distrito = "06: Marcara"; 
											break; 
											case "07": 
											$distrito = "07: Pariahuanca"; 
											break; 
											case "08": 
											$distrito = "08: San Miguel De Aco"; 
											break;
											case "09": 
											$distrito = "09: Shilla"; 
											break;
											case "10": 
											$distrito = "10: Tinco"; 
											break;
											case "11": 
											$distrito = "11: Yungar"; 
											break;
									  }
									break; 
									case "07": 
									$provincia = "07: Carlos Fermin Fitzcarrald"; 
									 switch ($distritoxls) { 
										case "01": 
											$distrito = "01: Bagua Grande"; 
											break; 
											case "02": 
											$distrito = "02: Cajaruro"; 
											break;
											case "03": 
											$distrito = "03: Cumba"; 
											break; 
											case "04": 
											$distrito = "04: El Milagro"; 
											break; 
											case "05": 
											$distrito = "05: Jamalca"; 
											break; 
											case "06": 
											$distrito = "06: Lonya Grande"; 
											break; 
											case "07": 
											$distrito = "07: Yamon"; 
											break; 
									  }
									break; 
									case "07": 
									$provincia = "07: Carlos Fermin Fitzcarrald"; 
									 switch ($distritoxls) { 
										case "01": 
											$distrito = "01: San Luis"; 
											break; 
											case "02": 
											$distrito = "02: San Nicolas"; 
											break;
											case "03": 
											$distrito = "03: Yauya"; 
											break; 
									  }
									break; 
									case "08": 
									$provincia = "08: Casma"; 
									 switch ($distritoxls) { 
										case "01": 
											$distrito = "01: Casma"; 
											break; 
											case "02": 
											$distrito = "02: Buena Vista Alta"; 
											break;
											case "03": 
											$distrito = "03: Comandante Noel"; 
											break; 
											case "04": 
											$distrito = "04: Yautan"; 
											break; 
									  }
									break;
									case "09": 
									$provincia = "09: Corongo"; 
									 switch ($distritoxls) { 
										case "01": 
											$distrito = "01: Corongo"; 
											break; 
											case "02": 
											$distrito = "02: Aco"; 
											break;
											case "03": 
											$distrito = "03: Bambas"; 
											break; 
											case "04": 
											$distrito = "04: Cusca"; 
											break; 
											case "05": 
											$distrito = "05: La Pampa"; 
											break; 
											case "06": 
											$distrito = "06: Yanac"; 
											break; 
											case "07": 
											$distrito = "07: Yupan"; 
											break; 
									  }
									break; 
									case "10": 
									$provincia = "10: Huari"; 
									 switch ($distritoxls) { 
									    	case "01": 
											$distrito = "01: Huari"; 
											break; 
											case "02": 
											$distrito = "02: Anra"; 
											break;
											case "03": 
											$distrito = "03: Cajay"; 
											break; 
											case "04": 
											$distrito = "04: Chavin De Huantar"; 
											break; 
											case "05": 
											$distrito = "05: Huacachi"; 
											break; 
											case "06": 
											$distrito = "06: Huacchis"; 
											break; 
											case "07": 
											$distrito = "07: Huachis"; 
											break; 
											case "08": 
											$distrito = "08: Huantar"; 
											break;
											case "09": 
											$distrito = "09: Masin"; 
											break;
											case "10": 
											$distrito = "10: Paucas"; 
											break;
											case "11": 
											$distrito = "11: Ponto"; 
											break;
											case "12": 
											$distrito = "12: Rahuapampa"; 
											break;
											case "13": 
											$distrito = "13: Rapayan"; 
											break;
											case "14": 
											$distrito = "14: San Marcos"; 
											break;
											case "15": 
											$distrito = "15: San Pedro De Chana"; 
											break;
											case "16": 
											$distrito = "16: Uco"; 
											break;
									  }
									break; 
									case "08": 
									$provincia = "07: Carlos Fermin Fitzcarrald"; 
									 switch ($distritoxls) { 
										case "01": 
											$distrito = "01: Bagua Grande"; 
											break; 
											case "02": 
											$distrito = "02: Cajaruro"; 
											break;
											case "03": 
											$distrito = "03: Cumba"; 
											break; 
											case "04": 
											$distrito = "04: El Milagro"; 
											break; 
											case "05": 
											$distrito = "05: Jamalca"; 
											break; 
											case "06": 
											$distrito = "06: Lonya Grande"; 
											break; 
											case "07": 
											$distrito = "07: Yamon"; 
											break; 
									  }
									break; 
									case "08": 
									$provincia = "07: Carlos Fermin Fitzcarrald"; 
									 switch ($distritoxls) { 
										case "01": 
											$distrito = "01: Bagua Grande"; 
											break; 
											case "02": 
											$distrito = "02: Cajaruro"; 
											break;
											case "03": 
											$distrito = "03: Cumba"; 
											break; 
											case "04": 
											$distrito = "04: El Milagro"; 
											break; 
											case "05": 
											$distrito = "05: Jamalca"; 
											break; 
											case "06": 
											$distrito = "06: Lonya Grande"; 
											break; 
											case "07": 
											$distrito = "07: Yamon"; 
											break; 
									  }
									break; 
									case "08": 
									$provincia = "07: Carlos Fermin Fitzcarrald"; 
									 switch ($distritoxls) { 
										case "01": 
											$distrito = "01: Bagua Grande"; 
											break; 
											case "02": 
											$distrito = "02: Cajaruro"; 
											break;
											case "03": 
											$distrito = "03: Cumba"; 
											break; 
											case "04": 
											$distrito = "04: El Milagro"; 
											break; 
											case "05": 
											$distrito = "05: Jamalca"; 
											break; 
											case "06": 
											$distrito = "06: Lonya Grande"; 
											break; 
											case "07": 
											$distrito = "07: Yamon"; 
											break; 
									  }
									break; 
									case "08": 
									$provincia = "07: Carlos Fermin Fitzcarrald"; 
									 switch ($distritoxls) { 
										case "01": 
											$distrito = "01: Bagua Grande"; 
											break; 
											case "02": 
											$distrito = "02: Cajaruro"; 
											break;
											case "03": 
											$distrito = "03: Cumba"; 
											break; 
											case "04": 
											$distrito = "04: El Milagro"; 
											break; 
											case "05": 
											$distrito = "05: Jamalca"; 
											break; 
											case "06": 
											$distrito = "06: Lonya Grande"; 
											break; 
											case "07": 
											$distrito = "07: Yamon"; 
											break; 
									  }
									break; 
									case "08": 
									$provincia = "07: Carlos Fermin Fitzcarrald"; 
									 switch ($distritoxls) { 
										case "01": 
											$distrito = "01: Bagua Grande"; 
											break; 
											case "02": 
											$distrito = "02: Cajaruro"; 
											break;
											case "03": 
											$distrito = "03: Cumba"; 
											break; 
											case "04": 
											$distrito = "04: El Milagro"; 
											break; 
											case "05": 
											$distrito = "05: Jamalca"; 
											break; 
											case "06": 
											$distrito = "06: Lonya Grande"; 
											break; 
											case "07": 
											$distrito = "07: Yamon"; 
											break; 
									  }
									break;  
								} 
								break;
							case "03":
								$departamento= "03: Apurimac";
								break;
							case "04":
								$departamento= "04: Arequipa";
								break;							
							case "05":
								$departamento= "05: Ayacucho";
								break;							
							case "06":
								$departamento= "06: Cajamarca";
								break;
							case "07":
								$departamento= "07: Callao";
								break;
							case "08":
								$departamento= "08: Cusco";
								break;
							case "09":
								$departamento= "09: Huancavelica";
								break;
							case "10":
								$departamento= "10: Huanuco";
								break;
							case "11":
								$departamento= "11: Ica";
								break;
							case "12":
								$departamento= "12: Junin";
								break;
							case "13":
								$departamento= "13: La Libertad";
								break;
							case "14":
								$departamento= "14: Lambayeque";
								break;
							case "15":
								$departamento= "15: Lima";
								 switch ($provinciaxls) { 
									case "01": 
									$provincia = "01: Lima"; 
									  switch ($distritoxls) { 
										case "01": 
											$distrito = "01: Lima"; 
											break; 
											case "02": 
											$distrito = "02: Ancon"; 
											break;
											case "03": 
											$distrito = "03: Ate"; 
											break; 
											case "04": 
											$distrito = "04: Barranco"; 
											break; 
											case "05": 
											$distrito = "05: Bre&ntilde;a"; 
											break; 
											case "06": 
											$distrito = "06: Carabayllo"; 
											break; 
											case "07": 
											$distrito = "07: Chaclacayo"; 
											break; 
											case "08": 
											$distrito = "08: Chorrillos"; 
											break;
											case "09": 
											$distrito = "09: Cieneguilla"; 
											break;
											case "10": 
											$distrito = "10: Comas"; 
											break;
											case "11": 
											$distrito = "11: El Agustino"; 
											break;
											case "12": 
											$distrito = "12: Independencia"; 
											break;
											case "13": 
											$distrito = "13: Jesus Maria"; 
											break;
											case "14": 
											$distrito = "14: La Molina"; 
											break;
											case "15": 
											$distrito = "15: La Victoria"; 
											break;
											case "16": 
											$distrito = "16: Lince"; 
											break;
											case "17": 
											$distrito = "17: Los Olivos"; 
											break;
											case "18": 
											$distrito = "18: Lurigancho"; 
											break;
											case "19": 
											$distrito = "19: Lurin"; 
											break;
											case "20": 
											$distrito = "20: Magdalena Del Mar"; 
											break;
											case "21": 
											$distrito = "21: Pueblo Libre (Magdalena Vieja)"; 
											break;
											case "22": 
											$distrito = "22: Miraflores"; 
											break;
											case "23": 
											$distrito = "23: Pachacamac"; 
											break;
											case "24": 
											$distrito = "24: Pucusana"; 
											break;
											case "25": 
											$distrito = "25: Puente Piedra"; 
											break;
											case "26": 
											$distrito = "26: Punta Hermosa"; 
											break;
											case "27": 
											$distrito = "27: Punta Negra"; 
											break;
											case "28": 
											$distrito = "28: Rimac"; 
											break;
											case "29": 
											$distrito = "29: San Bartolo"; 
											break;
											case "30": 
											$distrito = "30: San Borja"; 
											break;
											case "31": 
											$distrito = "31: San Isidro"; 
											break;
											case "32": 
											$distrito = "32: San Juan De Lurigancho"; 
											break;
											case "33": 
											$distrito = "33: San Juan De Miraflores"; 
											break;
											case "34": 
											$distrito = "34: San Luis"; 
											break;
											case "35": 
											$distrito = "35: San Martin De Porres"; 
											break;
											case "36": 
											$distrito = "36: San Miguel"; 
											break;
											case "37": 
											$distrito = "37: Santa Anita"; 
											break;
											case "38": 
											$distrito = "38: Santa Maria Del Mar"; 
											break;
											case "39": 
											$distrito = "39: Santa Rosa"; 
											break;
											case "40": 
											$distrito = "40: Santiago De Surco"; 
											break;
											case "41": 
											$distrito = "41: Surquillo"; 
											break;
											case "42": 
											$distrito = "42: Villa El Salvador"; 
											break;
											case "43": 
											$distrito = "43: Villa Maria Del Triunfo"; 
											break;
										} 
									break; 
									case "02": 
									$provincia = "02: Barranca"; 
									switch ($distritoxls) { 
										case "01": 
											$distrito = "01: Barranca"; 
											break; 
											case "02": 
											$distrito = "02: Paramonga"; 
											break;
											case "03": 
											$distrito = "03: Pativilca"; 
											break; 
											case "04": 
											$distrito = "04: Supe"; 
											break; 
											case "05": 
											$distrito = "05: Supe Puerto"; 
											break; 
									     }
									break;
									case "03": 
									$provincia = "03: Antonio Raymondi";
									  switch ($distritoxls) { 
										case "01": 
											$distrito = "01: Llamellin"; 
											break; 
											case "02": 
											$distrito = "02: Aczo"; 
											break;
											case "03": 
											$distrito = "03: Chaccho"; 
											break; 
											case "04": 
											$distrito = "04: Chingas"; 
											break; 
											case "05": 
											$distrito = "05: Mirgas"; 
											break; 
											case "06": 
											$distrito = "06: San Juan De Rontoy"; 
											break; 
									    }
									break; 
									case "04": 
									$provincia = "04: Asuncion"; 
									 switch ($distritoxls) { 
										case "01": 
											$distrito = "01: Chacas"; 
											break; 
											case "02": 
											$distrito = "02: Acochaca"; 
											break;
									    }
									break; 
									case "05": 
									$provincia = "05: Bolognesi"; 
									 switch ($distritoxls) { 
										case "01": 
											$distrito = "01: Chiquian"; 
											break; 
											case "02": 
											$distrito = "02: Abelardo Pardo Lezameta"; 
											break;
											case "03": 
											$distrito = "03: Antonio Raymondi"; 
											break; 
											case "04": 
											$distrito = "04: Aquia"; 
											break; 
											case "05": 
											$distrito = "05: Cajacay"; 
											break; 
											case "06": 
											$distrito = "06: Canis"; 
											break; 
											case "07": 
											$distrito = "07: Colquioc"; 
											break; 
											case "08": 
											$distrito = "08: Huallanca"; 
											break;
											case "09": 
											$distrito = "09: Huasta"; 
											break;
											case "10": 
											$distrito = "10: Huayllacayan"; 
											break;
											case "11": 
											$distrito = "11: La Primavera"; 
											break;
											case "12": 
											$distrito = "12: Mangas"; 
											break;
											case "13": 
											$distrito = "13: Pacllon"; 
											break;
											case "14": 
											$distrito = "14: San Miguel De Corpanqui"; 
											break;
											break;
											case "15": 
											$distrito = "15: Ticllos"; 
											break;
										} 
									break; 
									case "06": ///////
									$provincia = "06: Carhuaz"; 
									  switch ($distritoxls) { 
										case "01": 
											$distrito = "01: Carhuaz"; 
											break; 
											case "02": 
											$distrito = "02: Acopampa"; 
											break;
											case "03": 
											$distrito = "03: Amashca"; 
											break; 
											case "04": 
											$distrito = "04: Anta"; 
											break; 
											case "05": 
											$distrito = "05: Ataquero"; 
											break; 
											case "06": 
											$distrito = "06: Marcara"; 
											break; 
											case "07": 
											$distrito = "07: Pariahuanca"; 
											break; 
											case "08": 
											$distrito = "08: San Miguel De Aco"; 
											break;
											case "09": 
											$distrito = "09: Shilla"; 
											break;
											case "10": 
											$distrito = "10: Tinco"; 
											break;
											case "11": 
											$distrito = "11: Yungar"; 
											break;
									  }
									break; 
									case "07": 
									$provincia = "07: Carlos Fermin Fitzcarrald"; 
									 switch ($distritoxls) { 
										case "01": 
											$distrito = "01: Bagua Grande"; 
											break; 
											case "02": 
											$distrito = "02: Cajaruro"; 
											break;
											case "03": 
											$distrito = "03: Cumba"; 
											break; 
											case "04": 
											$distrito = "04: El Milagro"; 
											break; 
											case "05": 
											$distrito = "05: Jamalca"; 
											break; 
											case "06": 
											$distrito = "06: Lonya Grande"; 
											break; 
											case "07": 
											$distrito = "07: Yamon"; 
											break; 
									  }
									break; 
									case "07": 
									$provincia = "07: Carlos Fermin Fitzcarrald"; 
									 switch ($distritoxls) { 
										case "01": 
											$distrito = "01: San Luis"; 
											break; 
											case "02": 
											$distrito = "02: San Nicolas"; 
											break;
											case "03": 
											$distrito = "03: Yauya"; 
											break; 
									  }
									break; 
									case "08": 
									$provincia = "08: Casma"; 
									 switch ($distritoxls) { 
										case "01": 
											$distrito = "01: Casma"; 
											break; 
											case "02": 
											$distrito = "02: Buena Vista Alta"; 
											break;
											case "03": 
											$distrito = "03: Comandante Noel"; 
											break; 
											case "04": 
											$distrito = "04: Yautan"; 
											break; 
									  }
									break;
									case "09": 
									$provincia = "09: Corongo"; 
									 switch ($distritoxls) { 
										case "01": 
											$distrito = "01: Corongo"; 
											break; 
											case "02": 
											$distrito = "02: Aco"; 
											break;
											case "03": 
											$distrito = "03: Bambas"; 
											break; 
											case "04": 
											$distrito = "04: Cusca"; 
											break; 
											case "05": 
											$distrito = "05: La Pampa"; 
											break; 
											case "06": 
											$distrito = "06: Yanac"; 
											break; 
											case "07": 
											$distrito = "07: Yupan"; 
											break; 
									  }
									break; 
									case "10": 
									$provincia = "10: Huari"; 
									 switch ($distritoxls) { 
									    	case "01": 
											$distrito = "01: Huari"; 
											break; 
											case "02": 
											$distrito = "02: Anra"; 
											break;
											case "03": 
											$distrito = "03: Cajay"; 
											break; 
											case "04": 
											$distrito = "04: Chavin De Huantar"; 
											break; 
											case "05": 
											$distrito = "05: Huacachi"; 
											break; 
											case "06": 
											$distrito = "06: Huacchis"; 
											break; 
											case "07": 
											$distrito = "07: Huachis"; 
											break; 
											case "08": 
											$distrito = "08: Huantar"; 
											break;
											case "09": 
											$distrito = "09: Masin"; 
											break;
											case "10": 
											$distrito = "10: Paucas"; 
											break;
											case "11": 
											$distrito = "11: Ponto"; 
											break;
											case "12": 
											$distrito = "12: Rahuapampa"; 
											break;
											case "13": 
											$distrito = "13: Rapayan"; 
											break;
											case "14": 
											$distrito = "14: San Marcos"; 
											break;
											case "15": 
											$distrito = "15: San Pedro De Chana"; 
											break;
											case "16": 
											$distrito = "16: Uco"; 
											break;
									  }
									break; 
									case "08": 
									$provincia = "07: Carlos Fermin Fitzcarrald"; 
									 switch ($distritoxls) { 
										case "01": 
											$distrito = "01: Bagua Grande"; 
											break; 
											case "02": 
											$distrito = "02: Cajaruro"; 
											break;
											case "03": 
											$distrito = "03: Cumba"; 
											break; 
											case "04": 
											$distrito = "04: El Milagro"; 
											break; 
											case "05": 
											$distrito = "05: Jamalca"; 
											break; 
											case "06": 
											$distrito = "06: Lonya Grande"; 
											break; 
											case "07": 
											$distrito = "07: Yamon"; 
											break; 
									  }
									break; 
									case "08": 
									$provincia = "07: Carlos Fermin Fitzcarrald"; 
									 switch ($distritoxls) { 
										case "01": 
											$distrito = "01: Bagua Grande"; 
											break; 
											case "02": 
											$distrito = "02: Cajaruro"; 
											break;
											case "03": 
											$distrito = "03: Cumba"; 
											break; 
											case "04": 
											$distrito = "04: El Milagro"; 
											break; 
											case "05": 
											$distrito = "05: Jamalca"; 
											break; 
											case "06": 
											$distrito = "06: Lonya Grande"; 
											break; 
											case "07": 
											$distrito = "07: Yamon"; 
											break; 
									  }
									break; 
									case "08": 
									$provincia = "07: Carlos Fermin Fitzcarrald"; 
									 switch ($distritoxls) { 
										case "01": 
											$distrito = "01: Bagua Grande"; 
											break; 
											case "02": 
											$distrito = "02: Cajaruro"; 
											break;
											case "03": 
											$distrito = "03: Cumba"; 
											break; 
											case "04": 
											$distrito = "04: El Milagro"; 
											break; 
											case "05": 
											$distrito = "05: Jamalca"; 
											break; 
											case "06": 
											$distrito = "06: Lonya Grande"; 
											break; 
											case "07": 
											$distrito = "07: Yamon"; 
											break; 
									  }
									break; 
									case "08": 
									$provincia = "07: Carlos Fermin Fitzcarrald"; 
									 switch ($distritoxls) { 
										case "01": 
											$distrito = "01: Bagua Grande"; 
											break; 
											case "02": 
											$distrito = "02: Cajaruro"; 
											break;
											case "03": 
											$distrito = "03: Cumba"; 
											break; 
											case "04": 
											$distrito = "04: El Milagro"; 
											break; 
											case "05": 
											$distrito = "05: Jamalca"; 
											break; 
											case "06": 
											$distrito = "06: Lonya Grande"; 
											break; 
											case "07": 
											$distrito = "07: Yamon"; 
											break; 
									  }
									break; 
									case "08": 
									$provincia = "07: Carlos Fermin Fitzcarrald"; 
									 switch ($distritoxls) { 
										case "01": 
											$distrito = "01: Bagua Grande"; 
											break; 
											case "02": 
											$distrito = "02: Cajaruro"; 
											break;
											case "03": 
											$distrito = "03: Cumba"; 
											break; 
											case "04": 
											$distrito = "04: El Milagro"; 
											break; 
											case "05": 
											$distrito = "05: Jamalca"; 
											break; 
											case "06": 
											$distrito = "06: Lonya Grande"; 
											break; 
											case "07": 
											$distrito = "07: Yamon"; 
											break; 
									  }
									break;  
								}
								break;
							case "16":
								$departamento= "16: Loreto";
								break;
							case "17":
								$departamento= "17: Madre De Dios";
								break;
							case "18":
								$departamento= "18: Moquegua";
								break;
							case "19":
								$departamento= "19: Pasco";
								break;
							case "20":
								$departamento= "20: Piura";
								break;
							case "21":
								$departamento= "21: Puno";
								break;
							case "22":
								$departamento= "22: San Martin";
								break;
							case "23":
								$departamento= "23: Tacna";
								break;
							case "24":
								$departamento= "24: Tumbes";
								break;
							case "25":
								$departamento= "25: Ucayali";
								break;
							case "99":
								$departamento= "99: Extranjero";
								break;
							} 
*/
				 
				 }else{
				 $departamento="";
				 $provincia="";
				 $distrito=""; }
				 
				 $sqlcargoprofe=mysql_query("select codcargoprofe from cargoprofe where idcargoprofe='$cargoprofe'",$conn);
				 $rowcarprofe = mysql_fetch_array($sqlcargoprofe);
				 $cargoprofxls=$rowcarprofe['codcargoprofe'];
				 
				 switch ($cargoprofxls) {
							case "001":
								$cargoprof= "001: Alcalde";
								break;
							case "002":
								$cargoprof= "002: Analista";
								break;
							case "003":
								$cargoprof= "003: Apoderado";
								break;
							case "004":
								$cargoprof= "004: Asesor / Consultor";
								break;							
							case "005":
								$cargoprof= "005: Asistente";
								break;							
							case "006":
								$cargoprof= "006: Auditor";
								break;
							case "007":
								$cargoprof= "007: Auxiliar / Ayudante";
								break;
							case "008":
								$cargoprof= "008: Congresista";
								break;
							case "009":
								$cargoprof= "009: Contralor General";
								break;
							case "010":
								$cargoprof= "010: Decano";
								break;
							case "011":
								$cargoprof= "011: Diplom&aacute;tico";
								break;
							case "012":
								$cargoprof= "012: Directivo De Asociacion Deportiva";
								break;							
							case "013":
								$cargoprof= "013: Director, Subdirector, Gerente, Jefe Del Sector Privado";
								break;							
							case "014":
								$cargoprof= "014: Docente";
								break;
							case "015":
								$cargoprof= "015: Inspector";
								break;
							case "016":
								$cargoprof= "016: Intendente, Director, Gerente, Jefe De La Administraci&oacute;n P&uacute;blica";
								break;
							case "017":
								$cargoprof= "017: Interventor General De Economia De La Administraci&oacute;n P&uacute;blica";
								break;
							case "018":
								$cargoprof= "018: Juez";
								break;
							case "019":
								$cargoprof= "019: Notario P&uacute;blico";
								break;
							case "020":
								$cargoprof= "020: Practicante";
								break;							
							case "021":
								$cargoprof= "021: Prefecto";
								break;							
							case "022":
								$cargoprof= "022: Presidente De Gobierno Regional";
								break;
							case "023":
								$cargoprof= "023: Presidente De La Corte Suprema";
								break;
							case "024":
								$cargoprof= "024: Presidente De La Rep&uacute;blica";
								break;
							case "025":
								$cargoprof= "025: Presidente, Tribunal De Justicia";
								break;
							case "026":
								$cargoprof= "026: Ministro / Viceministro";
								break;
							case "027":
								$cargoprof= "027: Procurador";
								break;
							case "028":
								$cargoprof= "028: Procurador General";
								break;							
							case "029":
								$cargoprof= "029: Rector";
								break;							
							case "030":
								$cargoprof= "030: Regidores De Municipalidades";
								break;
							case "031":
								$cargoprof= "031: Sub-Prefecto";
								break;
							case "032":
								$cargoprof= "032: Superintendente De La Administraci&oacute;n P&uacute;blica";
								break;
							case "033":
								$cargoprof= "033: Vice-Presidente De La Rep&uacute;blica";
								break;
							case "034":
								$cargoprof= "034: Vocal De La Corte Superior O Suprema";
								break;
							case "998":
								$cargoprof= "998: No Declara";
								break;
							case "999":
								$cargoprof= "999: Otros  (Se&ntilde;alar)";
								break;
							case "":
								$cargoprof= "";
								break;
							
							} 
				 
				 $sqlprofe=mysql_query("select codprof from profesiones where idprofesion='$profe'",$conn);
				 $rowprofe = mysql_fetch_array($sqlprofe);
				 $profecionxls=$rowprofe['codprof'];
				 
				 
				  switch ($profecionxls) {
							case "001":
								$profecion= "001: Abogado";
								break;
							case "002":
								$profecion= "002: Actor / Artista / Escritor Y Afines";
								break;
							case "003":
								$profecion= "003: Actuario";
								break;
							case "004":
								$profecion= "004: Administrador";
								break;							
							case "005":
								$profecion= "005: Aduanero/Agente De Aduanas/Inspectores De Frontera";
								break;							
							case "006":
								$profecion= "006: Aeromozo/ Azafata Y Afines";
								break;
							case "007":
								$profecion= "007: Agente / Intermediario / Corredor Inmobiliario";
								break;
							case "008":
								$profecion= "008: Agente De Bolsa";
								break;
							case "010":
								$profecion= "010: Agente De Turismo/Viajes";
								break;
							case "011":
								$profecion= "011: Agente / Intermediario / Corredor De Seguros";
								break;
							case "012":
								$profecion= "012: Agricultor / Ganadero Y Afines";
								break;							
							case "013":
								$profecion= "013: Alba&ntilde;il / Obrero / Electricista / Mecanico / Tecnico  / Otros Oficios";
								break;							
							case "014":
								$profecion= "014: Ama De Casa";
								break;
							case "015":
								$profecion= "015: Analistas / Tecnicos / Programador De Sistema Y Computaci&oacute;n";
								break;
							case "016":
								$profecion= "016: Intendente, Director, Gerente, Jefe De La Administraci&oacute;n P&uacute;blica";
								break;
							case "019":
								$profecion= "019: Arquitecto";
								break;
							case "021":
								$profecion= "021: Asistente Social";
								break;
							case "019":
								$profecion= "019: Notario P&uacute;blico";
								break;
							case "020":
								$profecion= "020: Practicante";
								break;							
							case "021":
								$profecion= "021: Prefecto";
								break;							
							case "024":
								$profecion= "024: Bacteri&oacute;logo, Farmac&oacute;logo, Bi&oacute;logo, Cient&iacute;fico Y Afines";
								break;
							case "028":
								$profecion= "028: Cambista, Compra/Venta De Moneda";
								break;
							case "036":
								$profecion= "036: Comerciante / Vendedor";
								break;
							case "037":
								$profecion= "037: Conductor/ Chofer / Taxista/ Transportista Y Afines";
								break;
							case "039":
								$profecion= "039: Constructor";
								break;
							case "040":
								$profecion= "040: Contador";
								break;
							case "041":
								$profecion= "041: Contratista";
								break;							
							case "042":
								$profecion= "042: Corte Y Confecci&oacute;n De Ropa/ Fabricante De Prendas";
								break;							
							case "044":
								$profecion= "044: Decorador, Dibujante, Publicista, Dise&ntilde;ador De Publicidad";
								break;
							case "045":
								$profecion= "045: Dentista / Odont&oacute;logo";
								break;
							case "046":
								$profecion= "046: Deportista Profesional, Atleta, Arbitro, Entrenador Deportivo";
								break;
							case "047":
								$profecion= "047: Distribuidor";
								break;
							case "048":
								$profecion= "048: Docente";
								break;
							case "049":
								$profecion= "049: Economista";
								break;
							case "051":
								$profecion= "051: Empleada (O) Del Hogar / Nana / Guardian / Portero / Personal De Limpieza Y Afines";
								break;
							case "115":
								$profecion= "115: Empresario";
								break;
							case "052":
								$profecion= "052: Empresario Exportador/ Empresario Importador";
								break;
							case "056":
								$profecion= "056: Estudiante";
								break;
							case "061":
								$profecion= "061: Ingeniero";
								break;
							case "066":
								$profecion= "066: Jubilado / Pensionista";
								break;
							case "068":
								$profecion= "068: Liquidador, Reclamaciones/Seguros";
								break;
							case "070":
								$profecion= "070: Martillero / Subastador";
								break;
							case "071":
								$profecion= "071: Mayorista, Comercio Al Por Mayor";
								break;
							case "073":
								$profecion= "073: Medico / Cirujano";
								break;
							case "075":
								$profecion= "075: Miembro De La Polic&iacute;a / Fuerzas Armadas";
								break;
							case "078":
								$profecion= "078: Enfermero / Obstetriz / Paramedico Y Afines";
								break;
							case "082":
								$profecion= "082: Periodista";
								break;
							case "085":
								$profecion= "085: Piloto ";
								break;
							case "089":
								$profecion= "089: Productor De Cine / Radio / Televisi&oacute;n / Teatro";
								break;
							case "092":
								$profecion= "092: Psic&oacute;logo/ Terapeuta";
								break;
							case "099":
								$profecion= "099: Sacerdote / Monja / Religioso";
								break;
							case "100":
								$profecion= "100: Secretaria, Recepcionista, Telefonista Y Afines";
								break;
							case "112":
								$profecion= "112: Vendedor Ambulante";
								break;
							case "113":
								$profecion= "113: Veterinario, Zo&oacute;logo, Zoot&eacute;cnico";
								break;
							case "114":
								$profecion= "114: Visitador M&eacute;dico";
								break;
							case "998":
								$profecion= "998: No Declara";
								break;
							case "999":
								$profecion= "999: Otros  (Se&ntilde;alar)";
								break;
							case "":
								$profecion= "";
								break;
							}
				 
				 				 
				 $sqlnacionalidad=mysql_query("select codnacion from nacionalidades where idnacionalidad='$nacionalidad'",$conn);
				 $rownacionalidad = mysql_fetch_array($sqlnacionalidad);
				 $nacionalidadxls=$rownacionalidad['codnacion'];
				 

								switch ($nacionalidadxls) {
								case "AF":
								$nacixls="AF: Afganist&aacute;n";
								break;
								case "AL":
								$nacixls="AL: Albania";
								break;
								case "DE":
								$nacixls="DE: Alemania";
								break;
								case "AD":
								$nacixls="AD: Andorra";
								break;
								case "AO":
								$nacixls="AO: Angola";
								break;
								case "AI":
								$nacixls="AI: Anguilla";
								break;
								case "AQ":
								$nacixls="AQ: Ant&aacute;rtida";
								break;
								case "AG":
								$nacixls="AG: Antigua Y Barbuda";
								break;
								case "AN":
								$nacixls="AN: Antillas Holandesas";
								break;
								case "SA":
								$nacixls="SA: Arabia Saud&iacute;";
								break;
								case "DZ":
								$nacixls="DZ: Argelia";
								break;
								case "AR":
								$nacixls="AR: Argentina";
								break;
								case "AM":
								$nacixls="AM: Armenia";
								break;
								case "AW":
								$nacixls="AW: Aruba";
								break;
								case "MK":
								$nacixls="MK: Ary Macedonia";
								break;
								case "AU":
								$nacixls="AU: Australia";
								break;
								case "AT":
								$nacixls="AT: Austria";
								break;
								case "AZ":
								$nacixls="AZ: Azerbaiy&aacute;n";
								break;
								case "BS":
								$nacixls="BS: Bahamas";
								break;
								case "BH":
								$nacixls="BH: Bahr&eacute;in";
								break;
								case "BD":
								$nacixls="BD: Bangladesh";
								break;
								case "BB":
								$nacixls="BB: Barbados";
								break;
								case "BE":
								$nacixls="BE: B&eacute;lgica";
								break;
								case "BZ":
								$nacixls="BZ: Belice";
								break;
								case "BJ":
								$nacixls="BJ: Benin";
								break;
								case "BM":
								$nacixls="BM: Bermudas";
								break;
								case "BT":
								$nacixls="BT: Bhut&aacute;n";
								break;
								case "BY":
								$nacixls="BY: Bielorrusia";
								break;
								case "BO":
								$nacixls="BO: Bolivia";
								break;
								case "BA":
								$nacixls="BA: Bosnia Y Herzegovina";
								break;
								case "BW":
								$nacixls="BW: Botsuana";
								break;
								case "BR":
								$nacixls="BR: Brasil";
								break;
								case "BN":
								$nacixls="BN: Brun&eacute;i";
								break;
								case "BG":
								$nacixls="BG: Bulgaria";
								break;
								case "BF":
								$nacixls="BF: Burkina Faso";
								break;
								case "BI":
								$nacixls="BI: Burundi";
								break;
								case "CV":
								$nacixls="CV: Cabo Verde";
								break;
								case "KH":
								$nacixls="KH: Camboya";
								break;
								case "CM":
								$nacixls="CM: Camer&uacute;n";
								break;
								case "CA":
								$nacixls="CA: Canad&aacute;";
								break;
								case "TD":
								$nacixls="TD: Chad";
								break;
								case "CL":
								$nacixls="CL: Chile";
								break;
								case "CN":
								$nacixls="CN: China";
								break;
								case "CY":
								$nacixls="CY: Chipre";
								break;
								case "VA":
								$nacixls="VA: Ciudad Del Vaticano";
								break;
								case "CO":
								$nacixls="CO: Colombia";
								break;
								case "KP":
								$nacixls="KM: Comoras";
								break;
								case "CG":
								$nacixls="CG: Congo";
								break;
								case "KP":
								$nacixls="KP: Corea Del Norte";
								break;
								case "KR":
								$nacixls="KR: Corea Del Sur";
								break;
								case "CI":
								$nacixls="CI: Costa De Marfil";
								break;
								case "CR":
								$nacixls="CR: Costa Rica";
								break;
								case "HR":
								$nacixls="HR: Croacia";
								break;
								case "CU":
								$nacixls="CU: Cuba";
								break;
								case "DK":
								$nacixls="DK: Dinamarca";
								break;
								case "DM":
								$nacixls="DM: Dominica";
								break;
								case "EC":
								$nacixls="EC: Ecuador";
								break;
								case "EG":
								$nacixls="EG: Egipto";
								break;
								case "SV":
								$nacixls="SV: El Salvador";
								break;
								case "AE":
								$nacixls="AE: Emiratos &Aacute;rabes Unidos";
								break;
								case "ER":
								$nacixls="ER: Eritrea";
								break;
								case "SK":
								$nacixls="SK: Eslovaquia";
								break;
								case "SI":
								$nacixls="SI: Eslovenia";
								break;
								case "ES":
								$nacixls="ES: Espa&ntilde;a";
								break;
								case "US":
								$nacixls="US: Estados Unidos";
								break;
								case "EE":
								$nacixls="EE: Estonia";
								break;
								case "ET":
								$nacixls="ET: Etiop&iacute;a";
								break;
								case "PH":
								$nacixls="PH: Filipinas";
								break;
								case "FI":
								$nacixls="FI: Finlandia";
								break;
								case "FJ":
								$nacixls="FJ: Fiyi";
								break;
								case "FR":
								$nacixls="FR: Francia";
								break;
								case "GA":
								$nacixls="GA: Gab&oacute;n";
								break;
								case "GM":
								$nacixls="GM: Gambia";
								break;
								case "GE":
								$nacixls="GE: Georgia";
								break;
								case "GH":
								$nacixls="GH: Ghana";
								break;
								case "GI":
								$nacixls="GI: Gibraltar";
								break;
								case "GD":
								$nacixls="GD: Granada";
								break;
								case "GR":
								$nacixls="GR: Grecia";
								break;
								case "GL":
								$nacixls="GL: Groenlandia";
								break;
								case "GP":
								$nacixls="GP: Guadalupe";
								break;
								case "GU":
								$nacixls="GU: Guam";
								break;
								case "GT":
								$nacixls="GT: Guatemala";
								break;
								case "GF":
								$nacixls="GF: Guayana Francesa";
								break;
								case "GG":
								$nacixls="GG: Guernesey";
								break;
								case "GN":
								$nacixls="GN: Guinea";
								break;
								case "GQ":
								$nacixls="GQ: Guinea Ecuatorial";
								break;
								case "GW":
								$nacixls="GW: Guinea-Bissau";
								break;
								case "GY":
								$nacixls="GY: Guyana";
								break;
								case "HT":
								$nacixls="HT: Hait&iacute;";
								break;
								case "NL":
								$nacixls="NL: Holanda O Pa&iacute;ses Bajos";
								break;
								case "HN":
								$nacixls="HN: Honduras";
								break;
								case "HK":
								$nacixls="HK: Hong Kong";
								break;
								case "HU":
								$nacixls="HU: Hungr&iacute;a";
								break;
								case "IN":
								$nacixls="IN: India";
								break;
								case "ID":
								$nacixls="ID: Indonesia";
								break;
								case "IR":
								$nacixls="IR: Ir&aacute;n";
								break;
								case "IQ":
								$nacixls="IQ: Iraq";
								break;
								case "IE":
								$nacixls="IE: Irlanda";
								break;
								case "BV":
								$nacixls="BV: Isla Bouvet";
								break;
								case "IM":
								$nacixls="IM: Isla De Man";
								break;
								case "CX":
								$nacixls="CX: Isla De Navidad";
								break;
								case "NF":
								$nacixls="NF: Isla Norfolk";
								break;
								case "IS":
								$nacixls="IS: Islandia";
								break;
								case "AX":
								$nacixls="AX: Islas Aland";
								break;
								case "KY":
								$nacixls="KY: Islas Caim&aacute;n";
								break;
								case "CC":
								$nacixls="CC: Islas Cocos";
								break;
								case "CK":
								$nacixls="CK: Islas Cook";
								break;
								case "FO":
								$nacixls="FO: Islas Feroe";
								break;
								case "GS":
								$nacixls="GS: Islas Georgias Del Sur Y Sandwich Del Sur";
								break;
								case "HM":
								$nacixls="HM: Islas Heard Y Mcdonald";
								break;
								case "FK":
								$nacixls="FK: Islas Malvinas";
								break;
								case "MP":
								$nacixls="MP: Islas Marianas Del Norte";
								break;
								case "MH":
								$nacixls="MH: Islas Marshall";
								break;
								case "PN":
								$nacixls="PN: Islas Pitcairn";
								break;
								case "SB":
								$nacixls="SB: Islas Salom&oacute;n";
								break;
								case "TC":
								$nacixls="TC: Islas Turcas Y Caicos";
								break;
								case "UM":
								$nacixls="UM: Islas Ultramarinas De Estados Unidos";
								break;
								case "VG":
								$nacixls="VG: Islas V&iacute;rgenes Brit&aacute;nicas";
								break;
								case "VI":
								$nacixls="VI: Islas V&iacute;rgenes De Los Estados Unidos";
								break;
								case "IL":
								$nacixls="IL: Israel";
								break;
								case "IT":
								$nacixls="IT: Italia";
								break;
								case "JM":
								$nacixls="JM: Jamaica";
								break;
								case "JP":
								$nacixls="JP: Jap&oacute;n";
								break;
								case "JE":
								$nacixls="JE: Jersey";
								break;
								case "JO":
								$nacixls="JO: Jordania";
								break;
								case "KZ":
								$nacixls="KZ: Kazajst&aacute;n";
								break;
								case "KE":
								$nacixls="KE: Kenia";
								break;
								case "KG":
								$nacixls="KG: Kirguist&aacute;n";
								break;
								case "KI":
								$nacixls="KI: Kiribati";
								break;
								case "KW":
								$nacixls="KW: Kuwait";
								break;
								case "LA":
								$nacixls="LA: Laos";
								break;
								case "LS":
								$nacixls="LS: Lesotho";
								break;
								case "LV":
								$nacixls="LV: Letonia";
								break;
								case "LB":
								$nacixls="LB: L&iacute;bano";
								break;
								case "LR":
								$nacixls="LR: Liberia";
								break;
								case "LY":
								$nacixls="LY: Libia";
								break;
								case "LI":
								$nacixls="LI: Liechtenstein";
								break;
								case "LT":
								$nacixls="LT: Lituania";
								break;
								case "LU":
								$nacixls="LU: Luxemburgo";
								break;
								case "MO":
								$nacixls="MO: Macao";
								break;
								case "MG":
								$nacixls="MG: Madagascar";
								break;
								case "MY":
								$nacixls="MY: Malasia";
								break;
								case "MW":
								$nacixls="MW: Malawi";
								break;
								case "MV":
								$nacixls="MV: Maldivas";
								break;
								case "ML":
								$nacixls="ML: Mal&iacute;";
								break;
								case "MT":
								$nacixls="MT: Malta";
								break;
								case "MA":
								$nacixls="MA: Marruecos";
								break;
								case "MQ":
								$nacixls="MQ: Martinica";
								break;
								case "MU":
								$nacixls="MU: Mauricio";
								break;
								case "MR":
								$nacixls="MR: Mauritania";
								break;
								case "YT":
								$nacixls="YT: Mayotte";
								break;
								case "MX":
								$nacixls="MX: M&eacute;xico";
								break;
								case "FM":
								$nacixls="FM: Micronesia";
								break;
								case "MD":
								$nacixls="MD: Moldavia";
								break;
								case "MC":
								$nacixls="MC: M&oacute;naco";
								break;
								case "MN":
								$nacixls="MN: Mongolia";
								break;
								case "MS":
								$nacixls="MS: Montserrat";
								break;
								case "MZ":
								$nacixls="MZ: Mozambique";
								break;
								case "MM":
								$nacixls="MM: Myanmar";
								break;
								case "NA":
								$nacixls="NA: Namibia";
								break;
								case "NR":
								$nacixls="NR: Nauru";
								break;
								case "NP":
								$nacixls="NP: Nepal";
								break;
								case "NI":
								$nacixls="NI: Nicaragua";
								break;
								case "NE":
								$nacixls="NE: N&iacute;ger";
								break;
								case "NG":
								$nacixls="NG: Nigeria";
								break;
								case "NU":
								$nacixls="NU: Niue";
								break;
								case "NO":
								$nacixls="NO: Noruega";
								break;
								case "NC":
								$nacixls="NC: Nueva Caledonia";
								break;
								case "NZ":
								$nacixls="NZ: Nueva Zelanda";
								break;
								case "OM":
								$nacixls="OM: Om&aacute;n";
								break;
								case "PK":
								$nacixls="PK: Pakist&aacute;n";
								break;
								case "PW":
								$nacixls="PW: Palau";
								break;
								case "PS":
								$nacixls="PS: Palestina";
								break;
								case "PA":
								$nacixls="PA: Panam&aacute;";
								break;
								case "PG":
								$nacixls="PG: Pap&uacute;a Nueva Guinea";
								break;
								case "PY":
								$nacixls="PY: Paraguay";
								break;
								case "PE":
								$nacixls="PE: Per&uacute;";
								break;
								case "PF":
								$nacixls="PF: Polinesia Francesa";
								break;
								case "PL":
								$nacixls="PL: Polonia";
								break;
								case "PT":
								$nacixls="PT: Portugal";
								break;
								case "PR":
								$nacixls="PR: Puerto Rico";
								break;
								case "QA":
								$nacixls="QA: Qatar";
								break;
								case "GB":
								$nacixls="GB: Reino Unido";
								break;
								case "CF":
								$nacixls="CF: Rep&uacute;blica Centroafricana";
								break;
								case "CZ":
								$nacixls="CZ: Rep&uacute;blica Checa";
								break;
								case "CD":
								$nacixls="CD: Rep&uacute;blica Democr&aacute;tica Del Congo";
								break;
								case "DO":
								$nacixls="DO: Rep&uacute;blica Dominicana";
								break;
								case "RE":
								$nacixls="RE: Reuni&oacute;n";
								break;
								case "RW":
								$nacixls="RW: Ruanda";
								break;
								case "RO":
								$nacixls="RO: Rumania";
								break;
								case "RU":
								$nacixls="RU: Rusia";
								break;
								case "EH":
								$nacixls="EH: Sahara Occidental";
								break;
								case "WS":
								$nacixls="WS: Samoa";
								break;
								case "AS":
								$nacixls="AS: Samoa Americana";
								break;
								case "KN":
								$nacixls="KN: San Crist&oacute;bal Y Nevis";
								break;
								case "SM":
								$nacixls="SM: San Marino";
								break;
								case "PM":
								$nacixls="PM: San Pedro Y Miquel&oacute;n";
								break;
								case "VC":
								$nacixls="VC: San Vicente Y Las Granadinas";
								break;
								case "SH":
								$nacixls="SH: Santa Helena";
								break;
								case "LC":
								$nacixls="LC: Santa Luc&iacute;a";
								break;
								case "ST":
								$nacixls="ST: Santo Tom&eacute; Y Pr&iacute;ncipe";
								break;
								case "SN":
								$nacixls="SN: Senegal";
								break;
								case "CS":
								$nacixls="CS: Serbia Y Montenegro";
								break;
								case "SC":
								$nacixls="SC: Seychelles";
								break;
								case "SL":
								$nacixls="SL: Sierra Leona";
								break;
								case "SG":
								$nacixls="SG: Singapur";
								break;
								case "SY":
								$nacixls="SY: Siria";
								break;
								case "SO":
								$nacixls="SO: Somalia";
								break;
								case "LK":
								$nacixls="LK: Sri Lanka";
								break;
								case "SZ":
								$nacixls="SZ: Suazilandia";
								break;
								case "ZA":
								$nacixls="ZA: Sud&aacute;frica";
								break;
								case "SD":
								$nacixls="SD: Sud&aacute;n";
								break;
								case "SE":
								$nacixls="SE: Suecia";
								break;
								case "CH":
								$nacixls="CH: Suiza";
								break;
								case "SR":
								$nacixls="SR: Surinam";
								break;
								case "SJ":
								$nacixls="SJ: Svalbard Y Jan Mayen";
								break;
								case "TH":
								$nacixls="TH: Tailandia";
								break;
								case "TW":
								$nacixls="TW: Taiw&aacute;n";
								break;
								case "TZ":
								$nacixls="TZ: Tanzania";
								break;
								case "TJ":
								$nacixls="TJ: Tayikist&aacute;n";
								break;
								case "TO":
								$nacixls="IO: Territorio Brit&aacute;nico Del Oc&eacute;ano &Iacute;ndico";
								break;
								case "TF":
								$nacixls="TF: Territorios Australes Franceses";
								break;
								case "TL":
								$nacixls="TL: Timor Oriental";
								break;
								case "TG":
								$nacixls="TG: Togo";
								break;
								case "TK":
								$nacixls="TK: Tokelau";
								break;
								case "TO":
								$nacixls="TO: Tonga";
								break;
								case "TT":
								$nacixls="TT: Trinidad Y Tobago";
								break;
								case "TN":
								$nacixls="TN: T&uacute;nez";
								break;
								case "TM":
								$nacixls="TM: Turkmenist&aacute;n";
								break;
								case "TR":
								$nacixls="TR: Turqu&iacute;a";
								break;
								case "TV":
								$nacixls="TV: Tuvalu";
								break;
								case "UA":
								$nacixls="UA: Ucrania";
								break;
								case "UG":
								$nacixls="UG: Uganda";
								break;
								case "UY":
								$nacixls="UY: Uruguay";
								break;
								case "UZ":
								$nacixls="UZ: Uzbekist&aacute;n";
								break;
								case "VU":
								$nacixls="VU: Vanuatu";
								break;
								case "VE":
								$nacixls="VE: Venezuela";
								break;
								case "VN":
								$nacixls="VN: Vietnam";
								break;
								case "WF":
								$nacixls="WF: Wallis Y Futuna";
								break;
								case "YE":
								$nacixls="YE: Yemen";
								break;
								case "DJ":
								$nacixls="DJ: Yibuti";
								break;
								case "ZM":
								$nacixls="ZM: Zambia";
								break;
								case "ZW":
								$nacixls="ZW: Zimbawe";
								break;
								case "":
								$nacixls="";
								break;
								}
				 $fech_cumple = explode ("/", $cumpleclie);
				 $fechitacumple= $fech_cumple[2] . "" . $fech_cumple[1] . "" . $fech_cumple[0];
				  
				/////////////////////aqui la fecha de firma////////////////////////////
				
				$sqlfirmita=mysql_query("select fechafirma from contratantes where idcontratante='$idcontratantee' and kardex='$kardex'",$conn);
				$rowfirmita = mysql_fetch_array($sqlfirmita);
				$firmasino=$rowfirmita['fechafirma'];
				
				
				$fec_firma=explode ("/",$fecha_next);
				$fec1a=intval($fec_firma[2].$fec_firma[1].$fec_firma[0]);
				
				
				$fec_firma2=explode ("/",$firmasino); 
                $fec2b =intval( $fec_firma2[2].$fec_firma2[1].$fec_firma2[0]);
					
				if ( $fec2b < $fec1a ) {
					$fechatxt2 = explode ("/", $firmasino);
				    $firmass = $fechatxt2[2] . "/" . $fechatxt2[1] . "/" . $fechatxt2[0];
					}else{
					$firmass ='';	
					}
				
								 
				if($tipoppersona=="N"){$tp="1: Natural"; $objciiu=""; $numeruc=""; $feccumpleclie = $fechitacumple; $autografo=$firmass;  $ciius="";$codnacion=$nacixls; $numedoc=$numdocu; $apepat_empre=str_replace("Ã","I",str_replace("Ã“","O",str_replace("`"," ",str_replace(")"," ",str_replace("("," ",str_replace("-"," ",str_replace("Âº"," ",str_replace(","," ",str_replace("."," ",str_replace("?"," ",str_replace("*"," ",str_replace("Ã‘","#",str_replace("Ã±","#",$rowcontrata['apepat']))))))))))))); $apemat=str_replace("Ã","I",str_replace("Ã“","O",str_replace("`"," ",str_replace(")"," ",str_replace("("," ",str_replace("-"," ",str_replace("Âº"," ",str_replace(","," ",str_replace("."," ",str_replace("?"," ",str_replace("*"," ",str_replace("Ã‘","#",str_replace("Ã±","#",$rowcontrata['apemat']))))))))))))); $direc_per_empre=str_replace("Ã","I",str_replace("Ã“","O",str_replace("`"," ",str_replace(")"," ",str_replace("("," ",str_replace("-"," ",str_replace("Âº"," ",str_replace(","," ",str_replace("."," ",str_replace("?"," ",str_replace("*"," ",str_replace("Ã‘","#",str_replace("Ã±","#",$rowcontrata['direccion']))))))))))))); $nombres=str_replace("Ã","I",str_replace("Ã“","O",str_replace("`"," ",str_replace(")"," ",str_replace("("," ",str_replace("-"," ",str_replace("Âº"," ",str_replace(","," ",str_replace("."," ",str_replace("?"," ",str_replace("*"," ",str_replace("Ã‘","#",str_replace("Ã±","#",$rowcontrata['prinom']." ".$rowcontrata['segnom']))))))))))))); $estciv=$estado_civil; if($profecion!=''){$profis=$profecion;}else{$profis="998";} if($cargoprof!=""){$cargoprofis=$cargoprof;}else{$cargoprofis="";} if($td!="8"){$tipdoc=$td;}}else{$numedoc=""; $nombres=""; $codnacion=""; $estciv=""; $profis=""; $cargoprofis=""; $nombres=""; $feccumpleclie = ""; $autografo=""; }
				 
				 if($tipoppersona=="J"){$tp="3: Jur&iacute;dica"; $tipdoc=""; 
				    if($numdocu==""){$numeruc="99999999999";}else{$numeruc=$numdocu;}
				    
				 $codnacion=""; $apemat=""; $apepat_empre=str_replace("Ã","I",str_replace("Ã“","O",str_replace("`"," ",str_replace(")"," ",str_replace("("," ",str_replace("-"," ",str_replace("Âº"," ",str_replace(","," ",str_replace("."," ",str_replace("?"," ",str_replace("*"," ",str_replace("Ã‘","#",str_replace("Ã±","#",$rowcontrata['razonsocial']))))))))))))); $direc_per_empre=str_replace("Ã","I",str_replace("Ã“","O",str_replace("`"," ",str_replace(")"," ",str_replace("("," ",str_replace("-"," ",str_replace("Âº"," ",str_replace(","," ",str_replace("."," ",str_replace("?"," ",str_replace("*"," ",str_replace("Ã‘","#",str_replace("Ã±","#",$rowcontrata['domfiscal']))))))))))))); $estciv=""; $profis=""; $cargoprofis=""; $nombres="";
				 if($ciiu!=""){$ciius=$ciiu;}else{$ciius="";}
				 if($objciiu!=""){$objciiu=$objciiu;}else{$objciiu='';};
				 
				 if($tipoopera!='037' || $tipoopera!='038' || $tipoopera!='039' || $tipoopera!='040' || $tipoopera!='041' || $tipoopera!='042' || $tipoopera!='043' || $tipoopera!='044' ){  
				 if($sederegparti!="0"){$srparti=$sederegpartixls;}else{$srparti="";}
				 if($numpartiparti!=""){$nparti=$numpartiparti;}else{$nparti="";}
				 }else{$numeruc=""; $srparti=""; $nparti="";}
				 }else{
					 $srparti=""; $nparti="";
					 }
				 
				 if($uif=='R'){
				  $repre="R: Representante";
				  $sqlreprede=mysql_query("select idcontratanterp, inscrito from contratantes where idcontratante='$idcontratantee' and kardex='$kardex'",$conn);
				  $rowreprede = mysql_fetch_array($sqlreprede);
				  $representaa=$rowreprede['idcontratanterp'];
				  $inscrito=$rowreprede['inscrito'];
				 //aqui coloque 2 de no inscrito pk el sistema no tiene actualizado el inscrito y ede registral ni numeor de partida
				  if($inscrito=='1'){$inscri="1: Representante Inscrito";} if($inscrito=='0'){$inscri="2: Representante No Inscrito";} if($inscrito==''){$inscri="2: Representante No Inscrito";}

				  if($representaa!=''){
					  $sqldatouif=mysql_query("select uif from contratantesxacto where idcontratante='$representaa'",$conn);
					  $rowrepreaa = mysql_fetch_array($sqldatouif);
					  $rpa=$rowrepreaa['uif'];
					  switch ($rpa) {
						case "O":
							$rpa= "O: Ordenante /Propietario";
							break;
						case "B":
							$rpa= "B: Beneficiario /Adquirente";
							break;
						case "G":
							$rpa= "G: Fiador /Garante";
							break;
						case "F":
							$rpa= "F: Fiduciario";
							break;
						case "N":
							$rpa= "N: Otro";
							break;
							
						}
					  }else{$rpa="";}
				  }else{$repre=""; $rpa="";} 
				  
				   switch ($uif) {
						case "O":
							$orde= "O: Ordenante /Propietario"; $inscri=""; $repre=""; $rpa=""; $bene="";
							break;
						case "B":
							$bene= "B: Beneficiario /Adquirente"; $inscri=""; $repre=""; $rpa=""; $orde="";
							break;
						case "G":
							$orde= "G: Fiador /Garante"; $inscri=""; $repre=""; $rpa=""; $bene="";
							break;
						case "F":
							$orde= "F: Fiduciario"; $inscri=""; $repre=""; $rpa=""; $bene="";
							break;
						case "N":
							$orde= "N: Otro"; $inscri=""; $repre=""; $rpa=""; $bene="";
							break;
						}  
				
				  if($uif=='O'){$orde="O: Ordenante /Propietario"; $inscri=""; $repre=""; $rpa="";
				  }else{
					if($uif=='G'){$orde="G: Fiador /Garante"; $inscri=""; $repre=""; $rpa="";
					  }else{
						if($uif=='F'){$orde="F: Fiduciario"; $inscri=""; $repre=""; $rpa="";
						  }else{
						     if($uif=='N'){$orde="N: Otro"; $inscri=""; $repre=""; $rpa="";
							   }else{$orde="";
							   }
						   }
					   }
					}        
					
				    if($uif=='B'){$bene="B: Beneficiario /Adquirente"; $inscri=""; $repre=""; $rpa="";}else{$bene="";} 	
					  
				  /*if($uif=='B'){$bene="B: Beneficiario /Adquirente"; $inscri=""; $repre=""; $rpa="";}else{$bene="";} 
				  if($uif=='G'){$orde="G: Fiador /Garante"; $inscri=""; $repre=""; $rpa="";}else{$orde="";} 
				  if($uif=='F'){$orde="F: Fiduciario"; $inscri=""; $repre=""; $rpa="";}else{$orde="";} 
				  if($uif=='N'){$orde="N: Otro"; $inscri=""; $repre=""; $rpa="";}else{$orde="";}*/
							 
					    echo'
	<tr>
<td height="23" align="left" valign="top" style="mso-number-format:\@" bgcolor="#FFFFFF">'.$kardex.'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.substr($correlativo,0,8).'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.substr($sec,0,8).'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.$tipoenvio2.'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.$idtipkarxls.'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.substr($numescritura,0,6).'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.$fechas.'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.substr($vacio,0,6).'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.substr($vacio,0,8).'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.$conclu.'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.$autografo.'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.$modalidad.'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.substr($vacio,0,4).'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.$repre.'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.$orde.'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.$bene.'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.$rpa.'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.$inscri.'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.$resi.'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.$tp.'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.$tipdoc.'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.substr($numedoc,0,20).'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.substr($numeruc,0,11).'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.strtoupper(str_replace('Ñ','#',str_replace('ñ','#',holaacentos($apepat_empre)))).'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.strtoupper(str_replace('Ñ','#',str_replace('ñ','#',holaacentos($apemat)))).'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.strtoupper(str_replace('Ñ','#',str_replace('ñ','#',holaacentos($nombres)))).'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.$codnacion.'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.$feccumpleclie.'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.$estciv.'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.$profis.'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.substr(holaacentos($objciiu),0,40).'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.$ciius.'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.$cargoprofis.'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.$srparti.'</td>
<td align="left" valign="top" bgcolor="#FFFFFF" style="mso-number-format:\@">'.substr($nparti,0,12).'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.substr(holaacentos($direc_per_empre),0,150).'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.$departamento.'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.$provincia.'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.$distrito.'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.substr($vacio,0,40).'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.$paricipaesposa.'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.substr($vacio,0,40).'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.substr($vacio,0,40).'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.substr($vacio,0,40).'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.substr($vacio,0,2).'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.$tipooperaxls.'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.substr($vacio,0,1).'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.substr($vacio,0,2).'</td>
<td align="left" valign="top" bgcolor="#FFFFFF" style="mso-number-format:\@">'.substr(strtoupper($vacio),0,40).'</td>
<td align="left" valign="top" bgcolor="#FFFFFF" style="mso-number-format:\@">'.substr(strtoupper(holaacentos($ofondo)),0,40).'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.$monedita2.'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.substr($vaciomonto,0,18).'</td>
<td align="left" valign="top" bgcolor="#FFFFFF" style="mso-number-format:0.00">'.substr($monto,0,18).'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.substr($vaciomonto,0,18).'</td>
<td align="left" valign="top" bgcolor="#FFFFFF" style="mso-number-format:0.00">'.$tipcambio.'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.substr($vacio,0,1).'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.substr($vacio,0,2).'</td>
<td align="left" valign="top" bgcolor="#FFFFFF">'.substr($vacio,0,12).'</td>
</tr> 
	';
							  
								}	
				
			}else{
			 //echo str_pad("El Kardex Nro: ".$kardex." NO Tiene Contrantates",'60'," ",STR_PAD_LEFT).chr(13).chr(10);
			}
	
				  
	 /*///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////*/
		  
	 //}else{// Aqui en caso contrario el kardex no tenga patrimonial
					  
					//   echo str_pad("El Kardex Nro: ".$kardex." NO Tiene Patrimonial",'60'," ",STR_PAD_LEFT).chr(13).chr(10);
	// }

  ///////////////////////////////////////////////////////////////////////////////////
 }
  
}//aqui termina el while de seleccion de kardex

mysql_free_result($result);
mysql_close($conn);  
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////                                
     
                
?>
</table> 
		
    </div>
	
</body>
</html>
