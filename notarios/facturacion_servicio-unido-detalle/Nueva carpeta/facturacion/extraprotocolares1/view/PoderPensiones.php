<?php 
	include("../../conexion.php");
	
	require_once("../../includes/barramenu.php") ;
	require_once("../../includes/gridView.php")  ;
	require_once("../../includes/combo.php")  	  ;
	$oBarra = new BarraMenu() 				  ;
	$Grid1 = new GridView()					  ;
	$oCombo = new CmbList()  				  ;	
	
	$id_poder = $_REQUEST["id_poder"];
	
	$consulpoderes = mysql_query("SELECT * FROM poderes_pension WHERE poderes_pension.id_poder='$id_poder'", $conn) or die(mysql_error());
	$rowpoderes = mysql_fetch_array($consulpoderes);
		
?>
<script type="text/javascript" src="../../tcal.js"></script> 
<link rel="stylesheet" type="text/css" href="../../tcal.css" />

<script type="text/javascript">

$(document).ready(function(){ 
	
	 $("input, textarea").uniform();
	})
	
	
	function fguardaPPensiones(){ fsavePoderPensiones();}

</script>
    <table  width="100%">
        <tr>
          <td colspan="5"><input name="p_numformu" type="hidden" id="p_numformu" style="text-transform:uppercase" size="10" />
            <input name="p_crono" type="hidden" id="p_crono" style="text-transform:uppercase" size="15" />
           
            <input name="p_fecha" type="hidden" id="p_fecha" style="text-transform:uppercase" size="15" />
            <input name="p_domicilio" type="hidden" id="p_domicilio" style="text-transform:uppercase" size="60" />
            <input name="p_observ" type="hidden" id="p_observ" style="text-transform:uppercase" size="15" />
            <input name="id_poder" type="hidden" id="id_poder"  value="<?php echo $id_poder; ?>"/>
            <input name="id_pension" type="hidden" id="id_pension" />
            <input name="p_anopension" type="hidden" id="p_anopension" />
            <input name="p_mespension" type="hidden" id="p_mespension" /> 
           </td>
          </tr>
        <tr>
          <td width="29%" align="right"><span class="camposss">Monto de la pensión:</span></td>
          <td width="71%" colspan="4"><input name="p_pension" type="text" id="p_pension" style="text-transform:uppercase; text-align:right;" value="<?php if(!empty($rowpoderes['p_pension'])){echo $rowpoderes['p_pension'];}else {echo "0.00";} ?>" size="7" maxlength="50" /></td>
        </tr>
        <tr>
          <td colspan="5"><span class="camposss">La ONP, administra, durante el periodo en que se otorga el presente poder:</span></td>
          </tr>
        <tr>
          <td align="right"><span class="camposss">Plazo del poder:</span></td>
          <td colspan="4"><input name="p_plazopoder" type="text" id="p_plazopoder" style="text-transform:uppercase" value="<?php echo $rowpoderes['p_plazopoder']; ?>" size="15" maxlength="50" /></td>
          </tr>
        <tr>
          <td align="right"><span class="camposss">Fecha emision</span></td>
          <td colspan="4"><input name="p_fecotor" type="text" class="tcal" id="p_fecotor" style="text-transform:uppercase" value="<?php if(!empty($rowpoderes['p_fecotor'])){echo $rowpoderes['p_fecotor'];}else {echo date("d/m/Y");} ?>" size="7" maxlength="20"/></td>
          </tr>
        <tr>
          <td align="right"><span class="camposss">Fecha vencimiento</span></td>
          <td colspan="4"><input name="p_fecvcto" type="text" class="tcal" id="p_fecvcto" style="text-transform:uppercase" value="<?php if(!empty($rowpoderes['p_fecvcto'])){echo $rowpoderes['p_fecvcto'];}else {echo date("d/m/Y");} ?>" size="7" maxlength="20" /></td>
          </tr>
        <tr>
          <td align="right"><span class="camposss">Prestacion autorizada</span></td>
          <td colspan="4"><input name="p_presauto" type="text" id="p_presauto" style="text-transform:uppercase" value="<?php echo $rowpoderes['p_presauto']; ?>" size="30" maxlength="200" /></td>
          </tr>
        </table>  
