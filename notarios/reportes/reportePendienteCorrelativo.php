<?php

require_once("../includes/combo.php")  	  ;
$oCombo = new CmbList()  				  ;	

?>	
<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../tcal.css" />
<script type="text/javascript" src="../tcal.js"></script> 
<script language="JavaScript" type="text/javascript" src="../ajax2.js"></script>
<script language="JavaScript" type="text/javascript" src="../includes/script1.js"></script>
<script src="../includes/jquery-1.8.3.js"></script>
<script src="../includes/js/jquery-ui-notarios.js"></script>

<title>Reporte correlativo documentos</title>
<style type="text/css">

.line {color: #FFFFFF}
.titulosprincipales {	font-family: Calibri;
	font-size: 18px;
	color: #FF9900;
	font-style: italic;
}
div.frmcrono {  background-color: #ffffff;
border: 4px solid #264965;  

-moz-border-radius: 13px;
-webkit-border-radius: 13px;
border-radius: 13px;
-moz-box-shadow: 0px 0px 5px #000000;
-webkit-box-shadow: 0px 0px 5px #000000;
box-shadow: 0px 0px 5px #000000;
width:900px; height:800px;
}
.Estilo7 {font-family: Calibri; font-size: 13px; font-style: italic; }
.Estilo14 {font-family: Calibri; font-size: 12px; color: #333333; font-weight: bold; }
.Estilo12 {font-family: Calibri; font-size: 12px; color: #333333; font-style: italic; }

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

// BUSQUEDA DE VIAJES EN INDICE DE VIAJES:
function buscarPendienteCorrelativo(){

	divResultado = document.getElementById('buscaviaje');
	
	var _cmb_tipkar = document.getElementById('cmb_tipkar').value;
	
	var _fechade = document.getElementById('fechade').value; 
	var _fechaa  = document.getElementById('fechaa').value; 
	
	if(_fechade == "" || _fechaa == "")
	{
		alert("Debe seleccionar un rango de Fechas válido");return;	
	}	
    divResultado.innerHTML= '<img src="../loading.gif">';
	
	ajax = objetoAjax();

	ajax.open("POST", "buscar_pendiente_correlativo.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divResultado.innerHTML = ajax.responseText
      console.log(ajax.responseText)
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("tipokar="+_cmb_tipkar+"&fechade="+_fechade+"&fechaa="+_fechaa)
}

// INDICE CARTAS


function abrirPdf(kardex,dir,anio){
	
	let url = '../abrir_documento_pdf.php?kardex='+kardex+'&directorio='+dir+'&anio='+anio;

	window.location.href = url
}

</script>

</head>

<body>
<div class="frmcrono">
  <table width="900" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="30" bgcolor="#264965"><table width="900" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="33" height="30"><img src="../iconos/newproto.png" alt="" width="26" height="26" /></td>
          <td width="354"><span class="titulosprincipales">Reporte Pendientes de Número de escritura / Acta notarial / Formulario registral</span></td>
          <td width="484" align="left"><table width="454" border="0" align="right" cellpadding="0" cellspacing="0">
            <tr>
              <td width="239" height="30">&nbsp;</td>
              <td width="80">&nbsp;</td>
              <td width="17"><span class="line">|</span></td>
              <td width="118">&nbsp;</td>
            </tr>
          </table></td>
          <td width="29"><img src="../iconos/cerrar.png" width="21" height="20" /></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td height="19">&nbsp;</td>
    </tr>
    <tr>
      <td align="center"><table width="863" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="824" height="18"><form id="frmescri" name="frmescri" method="post" action="">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="57"><span class="Estilo7">Tipo </span></td>
                <td width="178"><span class="Estilo7">
                  <?php 
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT tipokar.idtipkar AS 'id', tipokar.nomtipkar AS 'des' FROM tipokar ORDER BY tipokar.nomtipkar"; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "250"; 
			$oCombo->name       = "cmb_tipkar";
			$oCombo->style      = "camposss"; 
			$oCombo->click      = "//selectAsunto(this.value);";   
			$oCombo->selected   =  $variable;
			$oCombo->Show();
			$oCombo->oDesCon(); 
?>
                </span></td>
                <td width="87"><span class="Estilo7">De Fecha: </span></td>
                <td width="155"><span class="Estilo7">
                  <label>
                  <input name="fechade" type="text" class="tcal" id="fechade" maxlength="12" />
                  </label>
                </span></td>
                <td><span class="Estilo7">a</span></td>
                <td width="183"><label>
                  <input name="fechaa" type="text" class="tcal" id="fechaa" maxlength="12" />
                </label></td>
                <td width="136"><a href="#" onclick="buscarPendienteCorrelativo()"><img src="../iconos/buscarclie.png" width="72" height="29" border="0" /></a></td>
                <td width="123"></td>
                <td width="37"><!--<img src="iconos/impresora.png" alt="" width="33" height="31" border="0" />--></td><td width="33"><a href="#" onclick="pdfgmovifir2();"></a></td>
              </tr>
            </table>
                    </form>          </td>
        </tr>
        <tr>
          <td height="9">---------------------------------------------------------------------------------------------------------------------------------------------</td>
        </tr>
        <tr>
          <td height="22"><table width="834" border="1" cellpadding="0" cellspacing="0" bordercolor="#333333"><!--<td width="70" height="19" bgcolor="#CCCCCC"><span class="Estilo14">Numero</span></td>-->
            <tr>
                <td width="100" bgcolor="#CCCCCC"  align="center"><span class="Estilo14">Tipo</span></td>

                <td width="93" bgcolor="#CCCCCC" align="center"><span class="Estilo14">Num.Escritura</span></td> 
                <td width="93" bgcolor="#CCCCCC" align="center"><span class="Estilo14">Escaneo</span></td> 
              </tr>
          </table></td>
        </tr>
        <tr>
          <td><div id="buscaviaje" style="height:600px; overflow:auto;"></div></td>
        </tr>
      </table></td>
    </tr>
  </table>
</div>
</body>

</html>
