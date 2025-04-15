<?php
$idsello = $_REQUEST["idsello"];
$dessello = $_REQUEST["dessello"];
$contenido = $_REQUEST["contenido"];
?>
<!DOCTYPE html>
<html lang="es">
<head>
<title>Editar tipo de Kardex</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../../includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../../tcal.css" />
<!--<link rel="stylesheet" href="../../css/uniform.default.css" type="text/css" media="screen">-->
<!--<script src="../../jquery.uniform.js" type="text/javascript" charset="utf-8"></script>-->
<script src="../../includes/js/jquery-1.9.0.js"></script>
<script src="../../includes/js/jquery-ui-notarios.js"></script>
<script type="text/javascript" src="../../tcal.js"></script> 
<script language="JavaScript" type="text/javascript" src="../../ajax2.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/script1.js"></script>
<script language="JavaScript" type="text/javascript" src="../includes/ext_script1.js"></script>


<script type="text/javascript">
$(document).ready(function(){ 
	 //$("input, textarea, select, button").uniform();
	 //$("button").button();
	 $("#dialog").dialog();	
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
	return xmlhttp;
}



//Edita datos del tipo de kardex
function feditaSello()
{	
var _idsello   = document.getElementById('idsello').value;	
var _dessello  = document.getElementById('dessello').value;	
var _contenido = document.getElementById('contenido').value;	 				 
	
	ajax=objetoAjax();

	ajax.open("POST", "../model/editPoderConte.php",true);	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			
			alert('Se actualizo satisfactoriamente');
			window.parent.document.location.reload();
			
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("idsello="+_idsello+"&dessello="+_dessello+"&contenido="+_contenido);

}



</script>
<style type="text/css">
<!--
.line {color: #FFFFFF}
.Estilo7 {font-family: Calibri; font-size: 13px; font-style: italic; }
.Estilo14 {font-family: Calibri; font-size: 12px; color: #333333; font-weight: bold; }
.Estilo12 {font-family: Calibri; font-size: 12px; color: #333333; font-style: italic; }
-->
.line {color: #FFFFFF}
.Estilo7 {font-family: Calibri; font-size: 13px; font-style: italic; }
.Estilo14 {font-family: Calibri; font-size: 12px; color: #333333; font-weight: bold; }
.Estilo12 {font-family: Calibri; font-size: 12px; color: #333333; font-style: italic; }
body{ font-family: Arial, Helvetica, sans-serif; font-size:12px; font-weight: bold; margin-bottom:50px;}
.cajas{ margin-bottom:25px;}

</style>
</head>

<body>
<div class="nuevo">
<form id="frmescri" name="frmescri" method="post" action="">
            <table width="100%" border="0" >
              <tr>
                <td width="87" align="right"><span class="">Descripcion:</span></td>
                <td><span class="Estilo7">
                  <label>
                  <input name="dessello" type="text" class="text ui-widget-content ui-corner-all" id="dessello" value="<?php echo $dessello ?>" size="40" readonly="readonly" />
                  </label>
                <input name="idsello" id="idsello" type="hidden" value="<?php echo $idsello ?>" />
                </span></td>
              </tr>
              <tr>
                <td width="87" align="right"><span class="">Contenido:</span></td>
                <td><textarea style="text-transform:uppercase;" name="contenido" id="contenido" cols="30" rows="4" class="text ui-widget-content ui-corner-all"><?php echo $contenido ?></textarea></td>
                </tr>
                <tr>
                <td align="left" colspan="2"><button type="button" name="guarda" id="guarda" onClick="feditaSello();"  ><img src="../images/nuevo.gif" width="12" height="12" alt="" />Actualizar</button></td>
                </tr>
              
            </table>
            </form>
</div>
</body>

</html>
