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

<title>Reporte Estadistico UIF-IAOC</title>
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

$(document).ready(function(){ 

// Inicia sin el check de no corre:
//EvalNoCorre_2();

});

// Inicia sin el check de no corre:
function EvalNoCorre_2()
{
	var fechade = document.getElementById('fechade').value;
	var fechaa  = document.getElementById('fechaa').value; 
	var _swtnocorre = document.getElementById('chk_nocorre').checked;
	var nc = ""; 
    $("#buscaviaje").load('buscaviaje.php',{ fechade: fechade, fechaa: fechaa, nocorre : nc });	
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

// BUSQUEDA DE VIAJES EN INDICE DE VIAJES:
function buscaviaje(){

	divResultado = document.getElementById('buscaviaje');
	
	var _cmb_anio = document.getElementById('cmb_anio').value;
	
	if(_cmb_anio == "" )
	{
		alert("Debe ingresar un año");return;	
	}
	divResultado.innerHTML= '<img src="../loading.gif">';
    
	ajax = objetoAjax();

	ajax.open("POST", "busca_iaoc.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divResultado.innerHTML = ajax.responseText
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("anio="+_cmb_anio)
}

// INDICE CARTAS
function pdfgmovi(_cmb_anio){
	
	var _cmb_anio = document.getElementById('cmb_anio').value;
	if(_cmb_anio == "" )
	{
		alert("Debe ingresar un año");return;	
	}

	ajax=objetoAjax();
	ajax.open("POST", "PDF_IAOC.php",true);
	
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {
			window.open("PDF_IAOC.php?anio="+_cmb_anio); 
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("anio="+_cmb_anio);
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
          <td width="354"><span class="titulosprincipales">Reporte Estadistico UIF-IAOC</span></td>
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
                <td width="57"><span class="Estilo7">Periodo </span></td>
                <td width="178"><span class="Estilo7">
                  <label>
                    <select name="cmb_anio" id="cmb_anio">
                      <option value="">Seleccione</option>
                      <!-- <option value="2012">2012</option>
                      <option value="2013">2013</option>
                      <option value="2014">2014</option>
                      <option value="2015">2015</option> -->
					            <option value="<?php echo date('Y')-4?>"><?php echo date('Y')-4?></option>
					            <option value="<?php echo date('Y')-3?>"><?php echo date('Y')-3?></option>
					            <option value="<?php echo date('Y')-2?>"><?php echo date('Y')-2?></option>
					            <option value="<?php echo date('Y')-1?>"><?php echo date('Y')-1?></option>
					            <option value="<?php echo date('Y')?>"><?php echo date('Y')?></option>
                      
                  </select>
                    </label>
                </span></td>
                <td width="136"><a href="#" onclick="buscaviaje()"><img src="../iconos/buscarclie.png" width="72" height="29" border="0" /></a></td>
                <td width="123"></td>
                <td width="37"><!--<img src="iconos/impresora.png" alt="" width="33" height="31" border="0" />--></td><td width="33"><a href="#" onclick="pdfgmovi(document.getElementById('cmb_anio').value);"><img src="../iconos/icon_pdf.png" alt="" width="33" height="31" border="0" /></a></td>
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
                <td width="81" bgcolor="#CCCCCC"  align="center"><span class="Estilo14">Mes</span></td>
				<td width="140" bgcolor="#CCCCCC" align="center"><span class="Estilo14">Cant. Opera.</span></td>
				<td width="140" bgcolor="#CCCCCC" align="center"><span class="Estilo14">Opera. Soles</span></td>
                <td width="140" bgcolor="#CCCCCC" align="center"><span class="Estilo14">Opera. Dolares</span></td>
                <td width="150" bgcolor="#CCCCCC" align="center"><span class="Estilo14">Monto Soles</span></td>
                <td width="73" bgcolor="#CCCCCC" align="center"><span class="Estilo14">Monto Dolares</span></td>
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
