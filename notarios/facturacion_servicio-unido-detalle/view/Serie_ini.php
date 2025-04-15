<?php
	include("../../conexion.php");
	require_once("../../includes/barramenu.php") ;
	require_once("../../includes/gridView.php")  ;
	require_once("../../includes/combo.php")  	 ;
	$oBarra = new BarraMenu() 				     ;
	$Grid1 = new GridView()					     ;
	$oCombo = new CmbList()  				     ;	
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Generar Bloque de Kardex</title>
<link href="../../includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../../tcal.css" />
<link href="../../includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../../includes/css/uniform.default.min.css" />
<link rel="stylesheet" type="text/css" href="../../tcal.css" />

<script type="text/javascript" src="../../tcal.js"></script> 
<script type="text/javascript" src="../includes/ext_script1.js"></script> 
<script src="../../includes/jquery-1.8.3.js"></script>
<script src="../../includes/js/jquery-ui-notarios.js"></script>
<script src="../../includes/jquery.uniform.min.js"></script>
<script src="../../includes/maskedinput.js"></script>
<script type="text/javascript" src="../../tcal.js"></script> 

<script type="text/javascript">
     $(document).ready(function(){ 
	 
	 $("#div_genkar").dialog({height:300, width:500,position :["center","top"], style: "margin:0px; padding:0px; float:none;",  resizable:false,title:'Series Iniciales'}); 
	 
			 $("input, textarea").uniform();
			 $("button").button();
			 $("#dialog").dialog();
			 $(".ui-dialog-titlebar").hide();
			 
	})

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
	return xmlhttp;}

function fShowAjaxDato(url){
		
		   _ajax = objetoAjax();
		    var _pag = '';
		    _ajax.open('GET', url,false);
		    _ajax.onreadystatechange = function(){
				
		    if(_ajax.readyState==4 && _ajax.status==200)
			{ 
		     _pag = _ajax.responseText;

			 }
		  }
	  _ajax.send(null);
	  return _pag; 
	  			 
	}

	function cerrar2(){ $("#div_genkar").dialog("close");	}	
	
	function fSavetcambio()
	{
		var _tipdocu    = $("#tipdocu").val();
		var _seriedoc   = $("#seriedoc").val();
		var _numdocumen = $("#numdocumen").val();
		
		var _data = {
						tipdocu    : _tipdocu,
						seriedoc   : _seriedoc,
						numdocumen : _numdocumen
				    }

				if(confirm("Esta cambiando Datos Iniciales del Sistema \nDesea continuar...?"))
				{
					$.post("../model/SavetSerie_ini.php",_data,function(){alert('Se actualizaron los datos Satisfactoriamente');});	
				}
	}
	

	function NumCheck(e, field) 
	{
		key = e.keyCode ? e.keyCode : e.which
		// backspace
		if (key == 8) return true
		if(key==13){
		//document.getElementById("bpag").focus();
		}
		// 0-9
		if (key > 47 && key < 58) {
		if (field.value == "") return true
		regexp = /.[0-9]{*}$/
		return !(regexp.test(field.value))
		}
		// .
		if (key == 46) {
		if (field.value == "") return false
		regexp = /^[0-9]+$/
		return regexp.test(field.value)
		}
		// other key
		return false
}

function selectFactIni()
	{	
		// ESCOGE EL CORRELATIVO DEL DOCUMENTO SELECCIONADO DE LA BD
		var _tipdocu = $('#tipdocu').val();
		
		var _documen = fShowAjaxDato('../includes/DocumenIni.php?tipdocu='+_tipdocu);
		var _serie   = fShowAjaxDato('../includes/SerieIni.php?tipdocu='+_tipdocu);
		
		document.getElementById('numdocumen').value = _documen;
		document.getElementById('seriedoc').value   = _serie;
	}

</script>
<style type="text/css">
div.div_genkar
{ 
  background-color: #ffffff;
border: 4px solid #264965;  

-moz-border-radius: 13px;
-webkit-border-radius: 13px;
border-radius: 13px;
-moz-box-shadow: 0px 0px 5px #000000;
-webkit-box-shadow: 0px 0px 5px #000000;
box-shadow: 0px 0px 5px #000000;
width:400px; height:200px;
float:left;
margin-left:30%;
margin-top:10px;
}
.GridPar
{
	border:0px;
	border-spacing:0px;
	border-collapse:0px;
	font:Arial, Helvetica, sans-serif;
	font-size:11px;
	color:#300;
	cursor:pointer;
	background-color:#FFFFFF;
}
.GridImp
{
	border:0px;
	border-spacing:0px;
	border-collapse:0px;
	font:Arial, Helvetica, sans-serif;
	font-size:11px;
	color:#300;
	cursor:pointer;
	background-color:#E8E8E8;
}
.GridCab
{
	font-size:17px;
	
	
}
<!-- end table -->

.titulosprincipales {
	font-family: Calibri;
	font-size: 18px;
	color: #FF9900;
	font-style: italic;
}
.line {color: #FFFFFF}

<!--
.Estilo7 {font-family: Calibri; font-size: 13px; font-style: italic; }
.Estilo14 {font-family: Calibri; font-size: 12px; color: #333333; font-weight: bold; }
.Estilo12 {font-family: Calibri; font-size: 12px; color: #333333; font-style: italic; }
-->
.camposss {font-family: Calibri; font-style: italic; font-size: 14px; color: #333333; }
</style>
</head>

<body style="font-size:62.5%;">
<div id="div_genkar" style="background-color: #ffffff;
border: 4px solid #264965;  
-moz-border-radius: 13px;
-webkit-border-radius: 13px;
border-radius: 13px;
-moz-box-shadow: 0px 0px 5px #000000;
-webkit-box-shadow: 0px 0px 5px #000000;
box-shadow: 0px 0px 5px #000000;
width:400; height:200;">
  <table width="100%" height="100%"  border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="30" bgcolor="#264965"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="33" height="30"><img src="../../iconos/newproto.png" alt="" width="26" height="26" /></td>
          <td width="328"><span class="titulosprincipales">Series Iniciales</span></td>
          <td >&nbsp;</td>
          <td width="29"><a  onClick="cerrar2()" id="btncerrar" href="#"><img id="btncerrar" src="../../iconos/cerrar.png" width="21" height="20" border="0" /></a></td>
        </tr>
      </table></td>
    </tr>
      <td valign="top"><form id="frmescri" name="frmescri" method="post" action="">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td colspan="2"><input type="hidden" id="txtfilas" name="txtfilas" value="" /></td></tr>
              <tr>
                <td width="193" height="22" align="right" ><span class="camposss">Tipo Documento: </span></td>
                <td width="250" height="22" valign="bottom"><?php 
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT tip_documen.id_documen AS 'id', tip_documen.des_docum AS 'des' FROM tip_documen ORDER BY tip_documen.des_docum ASC"; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "150"; 
			$oCombo->name       = "tipdocu";
			$oCombo->style      = "camposss"; 
			$oCombo->click      = "selectFactIni();";   
			$oCombo->selected   =  $variable;
			$oCombo->Show();
			$oCombo->oDesCon(); 
?>
                </td>
                
<tr>
                      <td width="45%" align="right"><span class="camposss">Num. Serie: </span></td>
                      <td width="55%"><input name="seriedoc" type="text" id="seriedoc" style="text-transform:uppercase"  size="5" maxlength="15" /></td>
              </tr>
              <tr>
                <td height="28" align="right"><span class="camposss">Num. Documento: </span> </td>
                <td height="28"><input name="numdocumen" type="text" id="numdocumen" style="text-transform:uppercase"  size="10" maxlength="15" /></td>
              </tr>
              <tr>
                <td colspan="2">&nbsp;</td>
              </tr>
              <tr>
                <td align="center" colspan="2"><button  type="button" name="generar"    id="generar" value="anadir" onclick="fSavetcambio();" ><img src="../../images/success.png" width="14" height="14" align="absmiddle" /> Registrar</button></td>
              </tr>
              <tr>
                <td align="center" colspan="2">&nbsp;</td>
              </tr>
          </table>
        </form></td>
    </tr>
  </table>
</div>
</body>
</html>
