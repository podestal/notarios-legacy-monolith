<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Anulacion de Pagos</title>
<style type="text/css">
div.frmcartas
{ 
  background-color: #ffffff;
border: 4px solid #264965;  

-moz-border-radius: 13px;
-webkit-border-radius: 13px;
border-radius: 13px;
-moz-box-shadow: 0px 0px 5px #000000;
-webkit-box-shadow: 0px 0px 5px #000000;
box-shadow: 0px 0px 5px #000000;
width:900px; height:850px;
}

.titulosprincipales {
	font-family: Calibri;
	font-size: 18px;
	color: #FF9900;
	font-style: italic;
}
.line {color: #FFFFFF}
</style>
</head>

<body>
<div class="frmcartas">
  <table width="900" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="30" bgcolor="#264965"><table width="900" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="33" height="30"><img src="../../iconos/newproto.png" alt="" width="26" height="26" /></td>
          <td width="328"><span class="titulosprincipales">Edición de Egresos</span></td>
          <td width="510" align="left"><table width="454" border="0" align="right" cellpadding="0" cellspacing="0">
            <tr>
              <td width="412" height="30">&nbsp;</td>
              <td width="10"><span class="line">|</span></td>
             <!-- <td width="22"><a href="anula_egreso.php" target="ncartas"><img src="../../images/back.png" width="20" height="18" border="0" title="Regresar"/></a></td>-->
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
      <td align="center" valign="top">
      <!--<iframe name="ncartas" src="AnulDocumenVie.php" frameborder="0" width="880" height="800" allowtransparency="true" scrolling="auto"></iframe>-->
      <table width="880" height="800" border="0" cellpadding="0" cellspacing="0">
      	<tr>
        	<td valign="top">
            	<?php include ("AnulDocumenVie_egreso.php")?> 
            </td>
        </tr>
      </table>
      </td>
    </tr>
  </table>
</div>
</body>
</html>
