<?php
$idkar = $_REQUEST["idkar"];
$tipkar = $_REQUEST["tipkar"];
$nomtipkar = $_REQUEST["nomtipkar"];
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

</script>
<style type="text/css">
<!--
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
<div class="nuevo">
<form id="frmescri" name="frmescri" method="post" action="">
            <table width="100%" border="0" >
              <tr>
                <td width="87" valign="top"><span class="">Id. Kardex:</span></td>
                <td width="155"><span class="Estilo7">
                  <label>
                  <input name="idtipkar" type="text" class="cajas" id="idtipkar" value="<?php echo $idkar ?>" size="10" maxlength="1" readonly="readonly" />
                  </label>
                </span></td>
                <td width="54" valign="top"><span class="">Tipo: </span></td>
                <td><label>
                  <input name="tipkar" type="text"  id="tipkar" class="cajas" value="<?php echo $tipkar ?>" size="10" maxlength="1" />
                </label></td>
                </tr>
              <tr>
                <td width="87" valign="top"><span class="">Descripcion:</span></td>
                <td colspan="3"><span class="Estilo7">
                  <label>
                    <input name="nomtipkar" type="text"  id="nomtipkar" class="cajas" value="<?php echo $nomtipkar ?>" size="40" maxlength="50" />
                    </label>
                </span></td>
                </tr>
                <tr>
                <td align="left" colspan="4" valign="top"><button type="button" name="guarda" id="guarda" onClick="feditaTipKar();"  ><img src="../images/nuevo.gif" width="12" height="12" alt="" />Actualizar</button></td>
                </tr>
              
            </table>
            </form>
</div>
</body>

</html>
