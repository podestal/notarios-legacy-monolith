<?php
require_once("../includes/combo.php")    ; 

$idcondicion = $_REQUEST["idcondicion"];
$idtipoacto  = $_REQUEST["idtipoacto"];
$condicion 	 = $_REQUEST["condicion"];
$parte 	     = $_REQUEST["parte"];
$uif 	     = $_REQUEST["uif"];
$formulario  = $_REQUEST["formulario"];
$montop      = $_REQUEST["montop"];

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
	 document.getElementById('idtipoacto').value='<?php echo $idtipoacto ?>';
	})

function evalfeditaActos()
{
	feditaCondiciones();

}

</script>
<style type="text/css">
<!--
.line {color: #FFFFFF}
.Estilo7 {font-family: Calibri; font-size: 13px; font-style: italic; }
.Estilo14 {font-family: Calibri; font-size: 12px; color: #333333; font-weight: bold; }
.Estilo12 {font-family: Calibri; font-size: 12px; color: #333333; font-style: italic; }
-->
</style>

<style type="text/css">
body{ font-family: Arial, Helvetica, sans-serif; font-size:12px; font-weight: bold;}


</style>
</head>

<body >
<div >
<form id="frmescri" name="frmescri" method="post" action="">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="170" height="40" align="right"><span class="camposss">Id. Condicion : </span></td>
                <td width="308" height="40">
                  <input class="cajas" name="idcondicion" type="text"  id="idcondicion" style="text-transform:uppercase;"  value="<?php echo $idcondicion; ?>" readonly="readonly" />
                  </td>
                
              </tr>
              <tr>
                <td height="25" align="right"><span class="camposss">Id Tipo Acto: </span></td>
                <td height="25"><span style="width:100px; font:Calibri; font-size:11px; color:#FF3300; margin-bottom:25px;">
                  <?php 
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT tiposdeacto.idtipoacto AS 'id', tiposdeacto.desacto AS 'des' FROM tiposdeacto"; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "250"; 
			$oCombo->name       = "idtipoacto";
			$oCombo->click      = "//funcionprueba()";   
			$oCombo->selected   =  $variable;
			$oCombo->Show();
			$oCombo->oDesCon(); 
?>
                </span></td>
              </tr>
              <tr>
                <td height="31" align="right"><span class="camposss">Condicion</span> : </td>
                <td height="31"><span id="sprytextfield5">
                <label>
                  <input class="cajas" type="text" name="condicion" style="text-transform:uppercase;" id="condicion" value="<?php echo $condicion ?>" />
                </label>
                </span></td>
              </tr>
              <tr>
                <td height="29" align="right"><span class="camposss">Parte</span>:</td>
                <td height="29"><label><span style="width:100px; font:Calibri; font-size:11px; color:#FF3300;">
                <input class="cajas" type="text" name="parte" style="text-transform:uppercase;" id="parte" value="<?php echo $parte ?>" />
                </span></label></td>
              </tr>
              <tr>
                <td height="31" align="right"><span class="camposss">UIF:</span></td>
                <td height="31"><label>
                  <input class=" cajas" type="text" name="uif" style="text-transform:uppercase;" id="uif" value="<?php echo $uif ?>" />
                </label></td>
              </tr>
              <tr>
                <td height="28" align="right"><span class="camposss">Formulario:</span></td>
                <td height="28">
                  <select name="formulario" id="formulario">
                    <option value="1" <?php if($formulario=='1') {echo 'selected';} ?>>SI</option>
                    <option value="" <?php if($formulario=='') {echo 'selected';} ?>>NO</option>
                  </select></td>
              </tr>
              <tr>
                <td height="40" align="right"><span class="camposss">Monto Partic.:</span></td>
                <td height="40"><select name="montop" id="montop">
                  <option value="1" <?php if($montop=='1') {echo 'selected';} ?>>SI</option>
                  <option value="" <?php if($montop=='') {echo 'selected';} ?>>NO</option>
                </select></td>
              </tr>
              <!-- <tr>
                <td height="28">Formulario:</td>
                <td height="28"><input type="text" name="formulario" style="text-transform:uppercase;" id="formulario" value="<?php echo $formulario ?>" /></td>
              </tr> -->
              <tr>
                <td height="28" colspan="2"align="center"><button  class="cajas" type="button" name="guarda" id="guarda" onClick="evalfeditaActos();"  ><img src="../images/save.png" width="12" height="12" alt="" />Actualizar</button>                </td>
              </tr>
          </table>
  </form>
</div>
</body>

</html>
