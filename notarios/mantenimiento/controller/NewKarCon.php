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
 fguardaTipKar();
 	
}

</script>
<style type="text/css">
<!--
.formu{ height:200px; width:400px;}
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
<div  >
<form id="frmescri" name="frmescri" method="post" action="">
<table  width="100%"  border="0">
              <tr>
                <td height="49" colspan="3" valign="top">Tipo: </td>
                <td width="922" align="left"><label>
                  <input name="tipkar" type="text" class="cajas" id="tipkar" size="10" maxlength="1" />
                  <span class="Estilo7">
                  <input name="idtipkar" type="hidden" class="cajas" id="idtipkar" size="10" maxlength="1" />
                </span></label></td>
              </tr>
              <tr>
                <td width="73" valign="top">Descripcion:</td>
                <td colspan="3"><span class="">
                  <label>
                    <input name="nomtipkar" type="text" class="cajas" id="nomtipkar" size="40" maxlength="50" />
                </label>
                </span></td>
              </tr>
                <tr>
                <td height="83" colspan="4" align="center" valign="top"><button type="button" name="guarda" id="guarda" onClick="fguardaTipKar();"  ><img src="../images/nuevo.gif" width="12" height="12" alt="" />Guardar</button></td>
              </tr>
              
            </table>
            </form>
</div>
</body>

</html>
