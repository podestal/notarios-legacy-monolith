<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="tcal.css" />
<script type="text/javascript" src="tcal.js"></script> 

<!--<script language="JavaScript" type="text/javascript" src="ajax2.js"></script>
<script language="JavaScript" type="text/javascript" src="includes/script1.js"></script>-->

<script language="JavaScript" type="text/javascript" src="js/prototype.js"></script>
<script language="JavaScript" type="text/javascript" src="ajax/alfabeticos/escrituras.js"></script>

<title>Documento sin t&iacute;tulo</title>
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
</head>

<body>
<div class="frmcrono">
  <table width="900" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="30" bgcolor="#264965"><table width="900" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="33" height="30"><img src="iconos/newproto.png" alt="" width="26" height="26" /></td>
          <td width="354"><span class="titulosprincipales">Indice Alfabetico de Escrituras Públicas</span></td>
          <td width="484" align="left"><table width="454" border="0" align="right" cellpadding="0" cellspacing="0">
            <tr>
              <td width="239" height="30">&nbsp;</td>
              <td width="80">&nbsp;</td>
              <td width="17">&nbsp;</td>
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
          <td width="824" height="18"><form id="frmescri" name="frmescri" method="post" action="excel/alfabetico/reporteAlfaEscrituras.php" target="_blank">
            <table width="836" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="53"><span class="Estilo7">De Fecha </span></td>
                <td width="184"><span class="Estilo7">
                  <label>
                  <input name="fechade" type="text" class="tcal" id="fechade" readonly="readonly"/>
                  </label>
                </span></td>
                <td width="31"><span class="Estilo7">a</span></td>
                <td width="38"><span class="Estilo7">Fecha</span></td>
                <td width="159"><label>
                  <input name="fechaa" type="text" class="tcal" id="fechaa" readonly="readonly"/>
                </label></td>
                <td width="306"><a href="#" onclick="buscar_escrituras(1)"><img src="iconos/buscarclie.png" width="72" height="29" border="0" /></a></td>
                <td width="32"></td>
                <!--<td><a href="#" onclick="pdfAlfa(document.getElementById('fechade').value,document.getElementById('fechaa').value);"><img src="iconos/icon_pdf.png" alt="" width="33" height="31" border="0" /></a></td>-->
                <!--<td width="33"><a href="#" onclick="pdf_escrituras()"><img src="iconos/icon_pdf.png" alt="" width="33" height="31" border="0" /></a></td>-->
                <!-- <td width="33"><input type="IMAGE" src="iconos/icon_pdf.png" onclick="validar_fechas()" alt="" width="33" height="31" border="0" value="fas" name="enviarrr"/></td> -->
                <td width="33">
                  <input type="submit"  onclick="validar_fechas()" alt="" width="33" height="31" border="0" value="WORD" name="enviarrr" style="background:url(iconos/word2.png);background-size:33px;background-repeat:no-repeat;color:transparent;padding:.7em;border:none;border-radius:5px;cursor:pointer;font-size:.85em;"/>
                </td>
                <td width="33">
                  <input type="submit"  onclick="validar_fechas()" alt="" width="33" height="31" border="0" value="EXCEL" name="enviarrr" style="background:url(iconos/excel2.png);background-size:33px;background-repeat:no-repeat;color:transparent;padding:.7em;border:none;border-radius:5px;cursor:pointer;font-size:.85em;"/>
                </td>
              </tr>
            </table>
                    </form>          </td>
        </tr>
        <tr>
          <td height="9">---------------------------------------------------------------------------------------------------------------------------------------------</td>
        </tr>
       <tr>
          <td><div id="lst_escrituras"></div></td>
        </tr>
      </table></td>
    </tr>
  </table>
</div>
</body>

</html>
