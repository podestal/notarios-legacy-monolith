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
	})

	function evalTipActo()
	{
		fguardaTipActo();
	}


</script>
<style type="text/css">
<!--
.line {color: #FFFFFF}
.Estilo7 {font-family: Calibri; font-size: 13px; font-style: italic; }
.Estilo14 {font-family: Calibri; font-size: 12px; color: #333333; font-weight: bold; }
.Estilo12 {font-family: Calibri; font-size: 12px; color: #333333; font-style: italic; }
body{ font-family: Arial, Helvetica, sans-serif; font-size:12px; font-weight: bold; margin-bottom:50px;}

-->
</style>
</head>

<body>
<div class="nuevo">
<form id="frmescri" name="frmescri" method="post" action="">
<input type="hidden" name="idtipoacto"  id="idtipoacto" />
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="212" height="22" align="right"><span class="camposss" >Nombre Acto: </span></td>
                <td width="193" height="22"><input type="text" name="desacto" style="text-transform:uppercase;" id="desacto" class="cajas"/></td>
                <td width="13" rowspan="5" align="center" valign="middle"></td>
                <td width="273" height="22" align="right" class="camposss">Umbral: </td>
                <td width="590" height="22"><span id="sprytextfield2">
                <label>
                  <input type="text" name="umbral" id="umbral"  class="cajas"/>
                  </label>
                </span></td>
              </tr>
              <tr>
                <td height="22" align="right"><span class="camposss">Cod. Sunat: </span></td>
                <td height="22"><input class="cajas" type="text" name="actosunat" style="text-transform:uppercase;" id="actosunat" /></td>
                <td height="22" align="right" class="camposss">Impuestos: </td>
                <td height="22"><span id="sprytextfield4">
                <label>
                  <input class="cajas" type="text" style="text-transform:uppercase;" name="impuestos" id="impuestos" />
                  </label>
                </span></td>
              </tr>
              <tr>
                <td height="22" align="right"><span class="camposss">Cod. Kardex: </span></td>
                <td height="22"><span style="width:100px; font:Calibri; font-size:11px; color:#FF3300;">
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
                </span></td>
                <td height="22" align="right" class="camposss">Calculo Notarial: </td>
                <td height="22"><label>
                  <input class="cajas" type="text" name="idcalnot" id="idcalnot" style="text-transform:uppercase;"/>
                </label></td>
              </tr>
              <tr>
                <td height="28" align="right"><span class="camposss">Cod. UIF: </span></td>
                <td height="28"><input  class="cajas"type="text" name="actouif" style="text-transform:uppercase;" id="actouif" /></td>
                <td height="28" align="right" class="camposss">Calculo Registral: </td>
                <td height="28"><span id="sprytextfield6">
                <label>
                  <input class="cajas" name="idecalreg" type="text" id="idecalreg" size="15" />
                  </label>
                </span></td>
              </tr>
              <tr>
                <td align="right">&nbsp;</td>
                <td><label></label></td>
                <td align="right" class="camposss">Modelo: </td>
                <td><label>
                  <input class="cajas" name="idmodelo" type="text" id="idmodelo" size="15" />
                </label></td>
              </tr>
              <tr>
                <td height="28" colspan="5" align="center"><button type="button" name="guarda" id="guarda" onClick="evalTipActo();"  ><img src="../images/save.png" width="12" height="12" alt="" />Grabar</button></td>
              </tr>
          </table>
            </form>
</div>
</body>

</html>
