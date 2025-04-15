<?php
require_once("../includes/combo.php")    ; 

$idtipoacto = $_REQUEST["idtipoacto"];
$actosunat 	= $_REQUEST["actosunat"];
$actouif 	= $_REQUEST["actouif"];
$idtipkar 	= $_REQUEST["idtipkar"];
$desacto 	= $_REQUEST["desacto"];
$umbral 	= $_REQUEST["umbral"];
$impuestos 	= $_REQUEST["impuestos"];
$idcalnot 	= $_REQUEST["idcalnot"];
$idecalreg 	= $_REQUEST["idecalreg"];
$idmodelo 	= $_REQUEST["idmodelo"];
?>
<!DOCTYPE html>
<html lang="es">
<head>
<title>Editar Actos</title>
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
	 $("button").button();
	 $("#dialog").dialog();
	 document.getElementById('idtipkar').value='<?php echo $idtipkar ?>';
	})

function evalfeditaActos()
{
	feditaActos();
}

</script>
<style type="text/css">
<!--
.line {color: #FFFFFF}
.Estilo7 {font-family: Calibri; font-size: 13px; font-style: italic; }
.Estilo14 {font-family: Calibri; font-size: 12px; color: #333333; font-weight: bold; }
.Estilo12 {font-family: Calibri; font-size: 12px; color: #333333; font-style: italic; }
-->
body{ font-family: Arial, Helvetica, sans-serif; font-size:12px; font-weight: bold; margin-bottom:50px;}
</style>
</head>

<body>
<div class="nuevo">
<form id="frmescri" name="frmescri" method="post" action="">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="99" height="22" align="right"><span class="">Nombre Acto:</span></td>
                <td width="171" height="22"><span id="sprytextfield1">
                <label></label>
                <input class="cajas" type="text" name="desacto" style="text-transform:uppercase;" id="desacto" value="<?php echo $desacto ?>" />
                </span></td>
                <td width="55" rowspan="5" align="center" valign="middle"></td>
                <td width="139" height="22" align="right" class="camposss">Umbral : </td>
                <td height="22"><span id="sprytextfield2">
                  <input class="cajas" type="text" name="umbral" id="umbral" value="<?php echo $umbral ?>"  />
                </span></td>
              </tr>
              <tr>
                <td height="22"  align="right"><span class="camposss">Cod. Acto :</span></td>
                <td height="22"><span class="titus33">
                  <input class="cajas"type="text" name="idtipoacto"  id="idtipoacto" style="text-transform:uppercase;"  value="<?php echo $idtipoacto; ?>" />
                </span></td>
                <td height="22" align="right" class="camposss">Impuestos : </td>
                <td height="22"><span id="sprytextfield4">
                <label>
                  <input  class="cajas" type="text" style="text-transform:uppercase;" name="impuestos" id="impuestos" value="<?php echo $impuestos ?>" />
                  </label>
                </span></td>
              </tr>
              <tr>
                <td height="22" align="right"><span class="camposss">Cod. Sunat</span> : </td>
                <td height="22"><input class="cajas" type="text" name="actosunat" style="text-transform:uppercase;" id="actosunat" value="<?php echo $actosunat ?>" /></td>
                <td height="22" align="right" class="camposss">Calculo Notarial : </td>
                <td height="22"><label>
                  <input class="cajas" type="text" name="idcalnot" id="idcalnot" style="text-transform:uppercase;" value="<?php echo $idcalnot ?>" />
                </label></td>
              </tr>
              <tr>
                <td height="22" align="right"><span class="camposss">Cod. Kardex : </span></td>
<td height="22"><label><span style="width:100px; font:Calibri; font-size:11px; color:#FF3300;">
                  
                   <?php 

			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT tipokar.idtipkar AS 'id', tipokar.nomtipkar AS 'nombre' FROM tipokar"; 
			$oCombo->value      = "id";
			$oCombo->text       = "nombre";
			$oCombo->size       = "150"; 
			$oCombo->name       = "idtipkar";
			$oCombo->style      = "camposss"; 
			$oCombo->click      = "//funcionprueba()";   
			$oCombo->selected   =  $variable;
			$oCombo->Show();
			$oCombo->oDesCon(); 
?>
                  
                </span></label></td>
                <td height="22" align="right" class="camposss">Calculo Registral : </td>
                <td height="22"><span id="sprytextfield6">
                <label>
                  <input class="cajas" name="idecalreg" type="text" id="idecalreg" size="15" value="<?php echo $idecalreg ?>" />
                  </label>
                </span></td>
              </tr>
              <tr>
                <td align="right"><span class="camposss">Cod. UIFt: </span></td>
                <td><input class="cajas" type="text" name="actouif" style="text-transform:uppercase;" id="actouif" value="<?php echo $actouif ?>" />                  <label></label></td>
                <td align="right" class="camposss">Modelo : </td>
                <td><label>
                  <input class="cajas" name="idmodelo" type="text" id="idmodelo" size="15" value="<?php echo $idmodelo ?>" />
                </label></td>
              </tr>
              <tr>
                <td height="28" colspan="5" align="center"><button type="button" name="guarda" id="guarda" onClick="evalfeditaActos();"  ><img src="../images/save.png" width="12" height="12" alt="" />Actualizar</button></td>
              </tr>
</table>
            </form>
</div>
</body>

</html>
