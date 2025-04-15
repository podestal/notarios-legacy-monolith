<?php 
include("../../conexion.php");
	
	$id_poder = $_REQUEST["id_poder"];
	
	$consulpoderes = mysql_query("SELECT * FROM poderes_essalud WHERE poderes_essalud.id_poder='$id_poder'", $conn) or die(mysql_error());
	$rowpoderes = mysql_fetch_array($consulpoderes);
	
?>

<script type="text/javascript" src="../../tcal.js"></script> 
<link rel="stylesheet" type="text/css" href="../../tcal.css" />
<script type="text/javascript">

$(document).ready(function(){ 

	$("input, textarea").uniform();
	
	})

	function fguardaPEssalud(){ fsavePoderEssalud();	}

	function pasadatos()
	{
		$("#div_pessalud").dialog("close");
		$("#div_pessalud").remove();
	}
</script>
    <table  width="100%">
        <tr>
          <td colspan="2"><input name="e_numformu" type="hidden" id="e_numformu" style="text-transform:uppercase" size="10" />
                <input name="e_crono" type="hidden" id="e_crono" style="text-transform:uppercase" size="15" />                            <input name="e_fecha" type="hidden" id="e_fecha" style="text-transform:uppercase" size="15" />
                <input name="e_domicilio" type="hidden" id="e_domicilio" style="text-transform:uppercase" size="60" />
                <input name="e_montototal" type="hidden" id="e_montototal" style="text-transform:uppercase" value="0.00" size="15"  />
                <input name="id_poder" type="hidden" id="id_poder"  value="<?php echo $id_poder; ?>"/>
                <input name="id_essalud" type="hidden" id="id_essalud" /></td>
        </tr>
        <tr>
          <td width="45%" align="right"><span class="camposss">Sepelio: S/.</span></td>
          <td width="55%"><input name="e_montosep" type="text" id="e_montosep" style="text-transform:uppercase; text-align:right;" value="<?php if(!empty($rowpoderes['e_montosep'])){echo $rowpoderes['e_montosep'];}else {echo "0.00";} ?>" size="7" maxlength="50" /></td>
        </tr>
        <tr>
          <td align="right"><span class="camposss"> Maternidad: S/.</span></td>
          <td><input name="e_montomater" type="text" id="e_montomater" style="text-transform:uppercase; text-align:right;" value="<?php if(!empty($rowpoderes['e_montomater'])){echo $rowpoderes['e_montomater'];}else {echo "0.00";} ?>" size="7" maxlength="50"  /></td>
          </tr>
        <tr>
          <td align="right"><span class="camposss">Lactancia: S/.</span></td>
          <td><input name="e_montolact" type="text" id="e_montolact" style="text-transform:uppercase; text-align:right;" value="<?php if(!empty($rowpoderes['e_montolact'])){echo $rowpoderes['e_montolact'];}else {echo "0.00";} ?>" size="7" maxlength="50"   /></td>
        </tr>
        <tr>
          <td align="right"><span class="camposss">Plazo del poder: </span></td>
          <td><input name="e_plazopoder" type="text" id="e_plazopoder" style="text-transform:uppercase" value="<?php echo $rowpoderes['e_plazopoder']; ?>" size="15" maxlength="50" /></td>
        </tr>
        <tr>
          <td align="right"><span class="camposss">Fecha emision: </span></td>
          <td><input name="e_fecotor" type="text" class="tcal" id="e_fecotor" style="text-transform:uppercase" value="<?php if(!empty($rowpoderes['e_fecotor'])){echo $rowpoderes['e_fecotor'];}else {echo date("d/m/Y");} ?>" size="9" maxlength="20" /></td>
          </tr>
        <tr>
          <td align="right"><span class="camposss">Fecha  vencimiento: </span></td>
          <td><input name="e_fecvcto" type="text" class="tcal" id="e_fecvcto" style="text-transform:uppercase" value="<?php if(!empty($rowpoderes['e_fecvcto'])){echo $rowpoderes['e_fecvcto'];}else {echo date("d/m/Y");} ?>" size="9" maxlength="20" /></td>
        </tr>
        <tr>
          <td align="right"><span class="camposss">Prestacion autorizada: </span></td>
          <td><input name="e_presauto" type="text" id="e_presauto" style="text-transform:uppercase" value="<?php echo $rowpoderes['e_presauto']; ?>" size="30" maxlength="200" /></td>
        </tr>
        <tr>
          <td align="right"><span class="camposss">Monto Pension: S/.</span></td>
          <td><input name="e_monto" type="text" id="e_monto" style="text-transform:uppercase; text-align:right;" value="<?php if(!empty($rowpoderes['e_monto'])){echo $rowpoderes['e_monto'];}else {echo "0.00";} ?>" size="7" maxlength="50" /></td>
        </tr>
        <tr>
          <td colspan="2" align="center" >
          <fieldset style="width:90%; padding:0px; margin:0px;">
          <legend style="padding:0px; margin:0px;"><span  style="padding:0px; margin:0px;"> Indicaciones </span></legend>
          <span class="camposss" style="padding:0px; margin:0px;"><ul style="text-align:left;">
          							<li>Seleccionar fecha de vencimiento</li>
                                    <li>Ingresar solo un concepto: Monto de sepelio, o monto de maternidad, o monto de lactancia</li>
                                    <li>Ingresar monto sin comas</li>
                                </ul>
          </span>
          </fieldset>
          </td>
        </tr>
        </table>
