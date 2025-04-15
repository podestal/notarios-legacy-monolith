<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Reporte de Comprobantes - Pendientes de Pago</title>
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
<script type="text/javascript" src="../Ajax/rep_pendientes.js" ></script>

<script type="text/javascript">
function validaPDF(){
	pdf();
	
	}
</script>
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
          <td width="354"><span class="titulosprincipales">Reporte de Comprobantes Pendientes de Pago</span></td>
          <td width="484" align="left"><table width="454" border="0" align="right" cellpadding="0" cellspacing="0">
            <tr>
              <td width="392" height="30">&nbsp;</td>
              <td width="12"><span class="line">|</span></td>
              <td width="50"><a onClick="retorna();" style="cursor:pointer" target="ncartas"><img src="../../images/back.png" width="20" height="18" border="0" title="Restaurar"/></a></td>
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
                <td width="62"><span class="Estilo7">De Fecha </span></td>
                <td width="178"><span class="Estilo7">
                  <label>
                  <input name="fechade" type="text" class="tcal" id="fechade" maxlength="12" readonly />
                  </label>
                </span></td>
                <td width="42"><span class="Estilo7">a</span></td>
                <td width="53"><span class="Estilo7">Fecha</span></td>
                <td width="182"><label>
                  <input name="fechaa" type="text" class="tcal" id="fechaa" maxlength="12" readonly />
                </label></td>
                <td width="276"><a href="#" onclick="listar_rep_pendientes(1)"><img src="../../iconos/buscarclie.png" width="72" height="29" border="0" /></a></td>
                <td width="37"><a href="#" onClick="pdf_pendientes()" ><img src="../../iconos/icon_pdf.png" alt="" width="33" height="31" border="0" /></a></td>
                <td width="4">&nbsp;</td>
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
          <td><div id="list_pendientes"></div></td>
        </tr>
      </table></td>
    </tr>
  </table>
</div>
</body>
</html>


