<?php
include("../../conexion.php");
require_once("../includes/combo.php")    ; 

$idimpedido = $_REQUEST["idimpedido"];
$idcliente 	= $_REQUEST["idcliente"];
$descli 	= $_REQUEST["descli"];
$fechaing 	= $_REQUEST["fechaing"];
$oficio 	= $_REQUEST["oficio"];
$origen 	= $_REQUEST["origen"];
$motivo 	= $_REQUEST["motivo"];
$pep 	    = $_REQUEST["pep"];
$laft 	    = $_REQUEST["laft"];


# Consulta los nuevos datos: 
$consulimpedido = mysql_query("SELECT cliente.impentidad, cliente.impremite FROM cliente WHERE cliente.idcliente = '$idcliente'", $conn) or die(mysql_error());

$row = mysql_fetch_array($consulimpedido);

$entidad = $row[0];
$remite = $row[1];

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
	 //$("button").button();
	 $("#dialog").dialog();
	 //document.getElementById('idtipkar').value='<?php echo $idtipkar ?>';
	})

function evalfeditImpedido()
{
	feditImpedido();
	//{window.parent.document.getElementById('Refresh').focus();}
	//window.location.reload();
	//window.parent.document.location.reload();
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
</head>

<body>
<div class="nuevo">
<form id="frmescri" name="frmescri" method="post" action="">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="140" height="27" valign="center" align="right"><span class="camposss">Cod. Impedido : </span></td>
                <td width="298" height="27" ><span id="sprytextfield1">
                <label></label>
                  <span class="textfieldRequiredMsg"><span class="titus33">
                  <input name="idimpedido" type="text"  id="idimpedido" style="text-transform:uppercase;"  value="<?php echo $idimpedido; ?>" size="15" readonly="readonly" />
                  </span></span></span></td>
               
              </tr>
             
              <tr>
                <td height="27" align="right" valign="top"><span class="camposss">Cod. Cliente : </span></td>
                <td height="27"><span id="sprytextfield3">
                <label>
                  <input name="idcliente" type="text" id="idcliente" style="text-transform:uppercase;" value="<?php echo $idcliente ?>" size="15" readonly="readonly" />
                  </label>
                </span></td>
              </tr>
              <tr>
                <td height="28" align="right" valign="top"><span class="camposss">Cliente</span> : </td>
                <td height="28"><span id="sprytextfield5">
                <label>
                  <input name="descliente" type="text" id="descliente" style="text-transform:uppercase;" value="<?php echo $descli ?>" size="40" readonly="readonly" />
                  </label>
                </span></td>
              </tr>
              <tr>
                <td height="28" align="right" valign="top"><span class="camposss">Fecha Ing. : </span></td>
                <td height="28"><input name="fechaing" type="text" id="fechaing" style="text-transform:uppercase;" value="<?php echo $fechaing ?>" size="10" /></td>
              </tr>
              <tr>
                <td height="28" align="right" valign="top"><span class="camposss">Oficio :</span></td>
                <td height="28"><label>
                  <input name="oficio" type="text" id="oficio" style="text-transform:uppercase;" value="<?php echo $oficio ?>" size="10" />
                </label></td>
              </tr>
              <tr>
                <td height="28" align="right" valign="top"><span class="camposss">Origen : </span></td>
                <td height="28"><label>
                  <input name="origen" type="text" id="origen" value="<?php echo $origen ?>" size="30"   />
                </label></td>
              </tr>
              <tr>
                <td height="28" align="right" valign="top"><span class="camposss">Entidad : </span></td>
                <td height="28"><input name="entidad" type="text" id="entidad" value="<?php echo $entidad ?>" size="30"   /></td>
              </tr>
              <tr>
                <td height="28" align="right" valign="top"><span class="camposss">Remite : </span></td>
                <td height="28"><input name="remite" type="text" id="remite" value="<?php echo $remite ?>" size="30"   /></td>
              </tr>
              <tr>
                <td height="28" align="right" valign="top"> Motivo :</td>
                <td height="28"><label for="motivo"></label>
                <textarea name="motivo" id="motivo" cols="30" rows="3"><?php echo $motivo ?></textarea><input name="pep" type="hidden" id="pep" style="text-transform:uppercase;" value="<?php echo $pep ?>" size="10" /><input name="laft" type="hidden" id="laft" style="text-transform:uppercase;" value="<?php echo $laft ?>" size="10" /></td>
              </tr>
             <!-- <tr>
                <td height="28" align="right">Pep : </td>
                <td height="28"><input name="pep" type="text" id="pep" style="text-transform:uppercase;" value="<?php echo $pep ?>" size="10" /></td>
              </tr>
              <tr>
                <td height="28" align="right">Laft : </td>
                <td height="28"><input name="laft" type="text" id="laft" style="text-transform:uppercase;" value="<?php echo $laft ?>" size="10" /></td>
              </tr> -->
              <tr>
                <td height="28" colspan="2" align="center"><button type="button" name="guarda" id="guarda" onClick="evalfeditImpedido();"  ><img src="../images/save.png" width="12" height="12" alt="" />Actualizar</button></td>
              </tr>
          </table>
            </form>
</div>
</body>

</html>
