<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Reporte de Comprobantes</title>
<link href="../../includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../../tcal.css" />
<link href="../../includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../../includes/css/uniform.default.min.css" />
<link rel="stylesheet" type="text/css" href="../../tcal.css" />

<script type="text/javascript" src="../../tcal.js"></script> 
<script type="text/javascript" src="../includes/Mantenimientos.js"></script> 
<script src="../../includes/jquery-1.8.3.js"></script>
<script src="../../includes/js/jquery-ui-notarios.js"></script>
<script src="../../includes/jquery.uniform.min.js"></script>
<script src="../../includes/maskedinput.js"></script>
<script type="text/javascript" src="../../tcal.js"></script> 

<script type="text/javascript" src="../../js/prototype.js"></script>
<script type="text/javascript" src="../Ajax/reporte_egreso.js" ></script>


<style type="text/css">
<!--
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
-->
</style>
</head>

<body>
<div class="frmcrono">
  <table width="900" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="30" bgcolor="#264965"><table width="900" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="33" height="30"><img src="../../iconos/newproto.png" alt="" width="26" height="26" /></td>
          <td width="354"><span class="titulosprincipales">Reporte de Egresos</span></td>
          <td width="484" align="left"><table width="454" border="0" align="right" cellpadding="0" cellspacing="0">
            <tr>
              <td width="398" height="30">&nbsp;</td>
              <td width="10"><span class="line">|</span></td>
              <td width="46"><a onClick="retorna();" target="ncartas" style="cursor:pointer"><img src="../../images/back.png" width="20" height="18" border="0" title="Restaurar"/></a></td>
            </tr>
          </table></td>
          <td width="29"></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td height="19">&nbsp;</td>
    </tr>
    <tr>
      <td align="center"><table width="863" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="824" height="18">
          <form id="frm_fechas" name="frm_fechas" method="post" action="">
            <table width="834" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="51"><span class="Estilo7">De Fecha </span></td>
                <td width="164"><span class="Estilo7">
                  <label>
                  <input name="fechade" type="text" class="tcal" id="fechade" readonly />
                  </label>
                </span></td>
                <td width="31" align="center">a</td>
                <td width="37"><span class="Estilo7">Fecha</span></td>
                <td width="165"><label>
                  <input name="fechaa" type="text" class="tcal" id="fechaa" readonly />
                </label></td>
                <td width="121"><a href="#" onclick="listar_reporte_e(1)"><img src="../../iconos/buscarclie.png" width="72" height="29" border="0" /></a></td>
                
                <td width="223">
                	<select id="filtro_e" name="filtro_e" onChange="listar_reporte_e(1)" class="Estilo12">
                    	<option value="0">--Todos--</option>
                        <option value="1">Facturas, Boletas, Notas de Crédito</option>
                        <option value="2">Recibo</option>
                    </select>
                </td>
                
                <td width="34"><a href="#" onClick="pdf_reporte()"><img src="../../iconos/icon_pdf.png" alt="" width="33" height="31" border="0" /></a></td>
                <td width="8">&nbsp;</td>
              </tr>
            </table>
           </form>
           </td>
        </tr>
        <tr height="35">
        	<td colspan="9"><img src="../../images/line.png" width="100%" height="8px">
            </td>
        </tr>
        <tr>
          <td><div id="list_reporte_e"></div></td>
        </tr>
      </table></td>
    </tr>
  </table>
</div>
</body>

</html>
