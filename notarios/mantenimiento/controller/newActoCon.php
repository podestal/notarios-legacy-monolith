<?php
require_once("../includes/combo.php")    ; 

?>
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

<title>Nuevo tipo de Acto</title>
<script type="text/javascript">
$(document).ready(function(){ 
	 $("button").button();
	 $("#dialog").dialog();	
	})

///objeto ajax
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

function fguardaActo()
{
 fguardaCondicion();
}

function evaltipoacto(_obj)
{	
	divResultado = document.getElementById('idtipactoc');
		
	var _id =_obj;
	
	ajax=objetoAjax();

	ajax.open("POST","comboAct.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {

			divResultado.innerHTML = ajax.responseText;
			document.getElementById('idtipoacto').selectedIndex='1';
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("id="+_id);
}


</script>
<style type="text/css">
<!--
.line {color: #FFFFFF}
.Estilo7 {font-family: Calibri; font-size: 13px; font-style: italic; }
.Estilo14 {font-family: Calibri; font-size: 12px; color: #333333; font-weight: bold; }
.Estilo12 {font-family: Calibri; font-size: 12px; color: #333333; font-style: italic; }
-->
body{ font-family: Arial, Helvetica, sans-serif; font-size:12px; font-weight: bold; }

</style>
</head>

<body>
<div class="nuevo">
<form id="frmescri" name="frmescri" method="post" action="">
<input name="idcondicion" type="hidden"  id="idcondicion" />
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="27" align="right">Tipo Kardex:</td>
                <td height="27" valign="top"><span style="width:100px; font:Calibri; font-size:11px; color:#FF3300;">
                  <?php 
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT tipokar.idtipkar AS 'id', tipokar.nomtipkar AS 'des' FROM tipokar"; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "250"; 
			$oCombo->name       = "idtipkar";
			$oCombo->style      = "camposss"; 
			$oCombo->click      = "evaltipoacto(this.value)";   
			$oCombo->selected   =  $variable;
			$oCombo->Show();
			$oCombo->oDesCon(); 
?>
                </span></td>
              </tr>
              <tr>
                <td width="110" height="21" align="right"><span class="camposss">Id Tipo Acto: </span></td>
                <td width="251" height="21" valign="top"><span style="width:100px; font:Calibri; font-size:11px; color:#FF3300;">
                <div id ="idtipactoc" ></div>
                </span></td>
              </tr>
              <tr>
                <td height="35" align="right"><span class="camposss">Condicion</span> : </td>
                <td height="35"><span id="sprytextfield5">
                <label>
                  <input class="cajas"type="text" name="condicion" style="text-transform:uppercase;" id="condicion"/>
                  </label>
                </span></td>
              </tr>
              <tr>
                <td height="33" align="right"><span class="camposss">Parte: </span></td>
                <td height="33"><label><span style="width:100px; font:Calibri; font-size:11px; color:#FF3300;">
                <input class="cajas" type="text" name="parte" style="text-transform:uppercase;" id="parte" />
                </span></label></td>
              </tr>
              <tr>
                <td height="28" align="right"><span class="camposss">UIF:</span></td>
                <td height="28"><label>
                  <input class="cajas" type="text" name="uif" style="text-transform:uppercase;" id="uif" />
                </label></td>
              </tr>
              <tr>
                <td height="28" align="right"><span class="camposss">Formulario:</span></td>
                <td height="28"><label for="formulario3"></label>
                  <select name="formulario" id="formulario">
                    <option value="1" selected>SI</option>
                    <option value="" >NO</option>
                </select></td>
              </tr>
              <tr>
                <td height="40" align="right"><span class="camposss">Monto Partic.:</span></td>
                <td height="40"><select name="montop" id="montop">
                <option value="1" selected>SI</option>
                    <option value="" >NO</option>
                </select></td>
              </tr>
            <!--  <tr>
                <td height="28">Formulario:</td>
                <td height="28"><input type="text" name="formulario" style="text-transform:uppercase;" id="formulario" /></td>
              </tr> -->
              <tr>
                <td height="28" colspan="2" align="center"><button type="button" name="guarda" id="guarda" onClick="fguardaActo();"  ><img src="../images/save.png" width="12" height="12" alt="" />Guardar</button></td>
              </tr>
          </table>
            </form>
</div>
</body>

</html>
