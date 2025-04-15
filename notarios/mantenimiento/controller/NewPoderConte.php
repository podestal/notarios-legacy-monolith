<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../../includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../../tcal.css" />
<script src="../../includes/js/jquery-1.9.0.js"></script>
<script src="../../includes/js/jquery-ui-notarios.js"></script>
<script type="text/javascript" src="../../tcal.js"></script> 
<script language="JavaScript" type="text/javascript" src="../../ajax2.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/script1.js"></script>
<script language="JavaScript" type="text/javascript" src="../includes/ext_script1.js"></script>

<title>Nuevo tipo kardex</title>
<script type="text/javascript">
$(document).ready(function(){ 
	 //$("button").button();
	 $("#dialog").dialog();	
	})

function valfguardaTipKar()
{
 fguardaSello();
 	
}


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


///#=== SELLOS GUARDAR
//Guarda nuevos datos del SELLO
function fguardaSello()
{	
	var _dessello = document.getElementById('dessello').value;
	var _contenido = document.getElementById('contenido').value;
	
	ajax=objetoAjax();

	ajax.open("POST", "../model/savePoderConte.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			alert('Se guardo satisfactoriamente');
			window.parent.document.location.reload();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("dessello="+_dessello+"&contenido="+_contenido);

}

</script>
<style type="text/css">
<!--
.line {color: #FFFFFF}
.Estilo7 {font-family: Calibri; font-size: 13px; font-style: italic; }
.Estilo14 {font-family: Calibri; font-size: 12px; color: #333333; font-weight: bold; }
.Estilo12 {font-family: Calibri; font-size: 12px; color: #333333; font-style: italic; }
-->
body{ font-family: Arial, Helvetica, sans-serif; font-size:12px; font-weight: bold; margin-bottom:50px;}
.cajas{ margin-bottom:25px;}
</style>
</head>

<body>
<div class="nuevo">
<form id="frmescri" name="frmescri" method="post" action="">
            <table width="100%" border="0">
              <tr>
                <td colspan="3" valign="top"><span class="">Descripcion: </span></td>
                <td width="685"><label>
                  <input style="text-transform:uppercase;" name="dessello" type="text" class="text ui-widget-content ui-corner-all" id="dessello" size="40" />
                  <span class="Estilo7">
                  <input name="idtipkar" type="hidden" class="text ui-widget-content ui-corner-all" id="idtipkar" size="10" maxlength="1" />
                </span></label></td>
                </tr>
              <tr>
                <td width="90" valign="top"><span class="">Contenido:</span></td>
                <td colspan="3"><label for="contenido"></label>
                <textarea name="contenido" id="contenido" cols="40" rows="4" class="text ui-widget-content ui-corner-all"></textarea></td>
              </tr>
                <tr>
                <td align="center" colspan="4"><button type="button" name="guarda" id="guarda" onClick="valfguardaTipKar();"  ><img src="../../images/nuevo.gif" width="12" height="12" alt="" />Guardar</button></td>
                </tr>
              
            </table>
            </form>
</div>
</body>

</html>
