<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="tcal.css" />
<script type="text/javascript" src="tcal.js"></script> 
<!--<script language="JavaScript" type="text/javascript" src="ajax2.js"></script>
<script language="JavaScript" type="text/javascript" src="includes/script1.js"></script>-->
<script language="JavaScript" type="text/javascript" src="js/prototype.js" ></script>
<script language="JavaScript" type="text/javascript" src="ajax/indices/protestos.js" ></script>
<script language="JavaScript" type="text/javascript" src="pdf_crono/escritura_ep.js" ></script>

<title>Indice Cronologico de Protestos</title>
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
          <td width="33" height="30"><img src="iconos/newproto.png" alt="" width="26" height="26" /></td>
          <td width="354"><span class="titulosprincipales">Indice Cronológico de  Protestos</span></td>
          <td width="484" align="left"><table width="454" border="0" align="right" cellpadding="0" cellspacing="0">
            <tr>
              <td width="239" height="30">&nbsp;</td>
              <td width="80">&nbsp;</td>
              <td width="17"><span class="line">|</span></td>
              <td width="118">&nbsp;</td>
            </tr>
          </table></td>
          <td width="29">&nbsp;</td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td height="19">&nbsp;</td>
    </tr>
    <tr>
      <td align="center"><table width="863" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="824" height="18"><form id="frmescri" name="frmescri" method="post" action="excel/reportCronoProtestos.php">
            <table width="834" border="0" cellspacing="0" cellpadding="0">
              <tr>
                 <td width="113" height="33"><span class="Estilo7">Tipo de Fecha </span></td>
                 <td width="59"><span class="Estilo7">Constancia</span></td>
                 <td width="44"><input id="fec_cons" name="fec_cons" type="checkbox" onClick="limpiar_checks(this.id)"></td>
                 <td width="77"><span class="Estilo7">Notificacion</span></td>
          		 <td width="52"><input id="fec_not" name="fec_not" type="checkbox" onClick="limpiar_checks(this.id)"></td>
                 <td width="48"><span class="Estilo7">Ingreso</span></td>
          		 <td width="24"><input id="fec_ing" name="fec_ing" type="checkbox" onClick="limpiar_checks(this.id)"></td>
              </tr>
              
              <tr>
                <td width="113"><span class="Estilo7">Desde</span></td>
                <td colspan="3"><span class="Estilo7"><input name="fechade" type="text" class="tcal" id="fechade" maxlength="12" readonly="readonly" /></span></td>
                <td><span class="Estilo7">Hasta</span></td>
                <td colspan="2">&nbsp;</td>
                <td width="173"><input name="fechaa" type="text" class="tcal" id="fechaa" maxlength="12" readonly="readonly"/></td>
                <td width="95"><a href="#" onclick="buscar_protesto(1)"><img src="iconos/buscarclie.png" width="72" height="29" border="0" /></a></td>
               
                <!--<td width="17"><img src="iconos/impresora.png" alt="" width="33" height="31" border="0" /></td><td width="132"><a href="#" onclick="pdf_protesto()"><img src="iconos/icon_pdf.png" alt="" width="33" height="31" border="0" /></a></td>-->
                <td width="33"><input type="IMAGE" src="iconos/icon_pdf.png" onclick="validar_fechas()" alt="" width="33" height="31" border="0" value="fas" name="enviarrr"/></a></td>
              </tr>
            </table>
                    </form>          </td>
        </tr>
        <tr>
          <td height="9">---------------------------------------------------------------------------------------------------------------------------------------------</td>
        </tr>
        <tr>
          <td><div id="lista_protestos" style="height:600px;"></div></td>
        </tr>
      </table></td>
    </tr>
  </table>
</div>
</body>

</html>
