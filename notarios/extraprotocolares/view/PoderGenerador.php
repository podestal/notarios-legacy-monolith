<?php 
	include("../../conexion.php");
	
	require_once("../../includes/barramenu.php") ;
	require_once("../../includes/gridView.php")  ;
	require_once("../../includes/combo.php")  	  ;
	$oBarra = new BarraMenu() 				  ;
	$Grid1 = new GridView()					  ;
	$oCombo = new CmbList()  				  ;	
	
	$id_poder = $_REQUEST["id_poder"];	
	
	$consulpoderes = mysql_query("SELECT * FROM poderes_fuerareg WHERE poderes_fuerareg.id_poder='$id_poder'", $conn) or die(mysql_error());
	$rowpoderes = mysql_fetch_array($consulpoderes);

?>

<script type="text/javascript">

	$(document).ready(function(){ 
		$("input, textarea").uniform();
	})

	function fguardaPFueraReg()
	{
		 fsavePoderFRegistro();	
	}
	
	function selectDetPoder(_obj)
	{
		var _detalle = fShowAjaxDato('../includes/busContePoder.php?idasunto='+_obj);
		document.getElementById('f_solicita').value = _detalle;	
	}	


// *****************
function maxLengthX(e,obj,num) {
    k = (document.all) ? e.keyCode : e.which;
    if (k==8 || k==0){ return true; }
    else{ return obj.value.length<num; }
}

</script>
    <table  width="100%">
        <tr>
          <td colspan="5"><input name="f_numformu" type="hidden" id="f_numformu" style="text-transform:uppercase" size="10" />
            <input name="f_crono" type="hidden" id="f_crono" style="text-transform:uppercase" size="15" />
            
            <input name="f_fecha" type="hidden" id="f_fecha" style="text-transform:uppercase" size="15" /></td>
          </tr>
        <tr>
          <td width="14%"><span class="camposss">Seleccione tipo</span></td>
          <td width="86%" colspan="4"><?php 
			$oCombo = new CmbList()  ;		
			
			//WHERE (contenidopoderes.conte_asunto ='E' OR contenidopoderes.conte_asunto ='C') OR contenidopoderes.conte_asunto='F'			 		
			$oCombo->dataSource = "SELECT contenidopoderes.id_asunto AS 'id', contenidopoderes.des_asunto AS 'des'
FROM contenidopoderes 
ORDER BY contenidopoderes.des_asunto ASC"; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "200"; 
			$oCombo->name       = "id_tipo";
			$oCombo->style      = "camposss"; 
			$oCombo->click      = "selectDetPoder(this.value);";   
			$oCombo->selected   =  $rowpoderes['id_tipo'];
			$oCombo->Show();
			$oCombo->oDesCon(); 
?></td>
          </tr>
        <tr>
          <td colspan="5">
          <div id="div_fueraregistro">
            <table width="100%" border="0">
              <tr>
                <td><span class="camposss">Plazo del poder:</span></td>
          <td colspan="4"><input name="f_plazopoder" type="text" id="f_plazopoder" style="text-transform:uppercase" value="<?php echo $rowpoderes['f_plazopoder']; ?>" size="15" maxlength="30" /></td>
          </tr>
        <tr>
          <td><span class="camposss">Fecha de otorgamiento</span></td>
          <td><input name="f_fecotor" type="text" class="tcal" id="f_fecotor" style="text-transform:uppercase" value="<?php if(!empty($rowpoderes['f_fecotor'])){echo $rowpoderes['f_fecotor'];}else {echo date("d/m/Y");} ?>" size="15" maxlength="20"/></td>
          <td><span class="camposss">Fecha de vencimiento</span></td>
          <td colspan="2"><input name="f_fecvcto" type="text" class="tcal" id="f_fecvcto" style="text-transform:uppercase" value="<?php if(!empty($rowpoderes['f_fecvcto'])){echo $rowpoderes['f_fecvcto'];}else {echo date("d/m/Y");} ?>" size="15" maxlength="20" /></td>
          </tr>
        <tr>
          <td></td>
          <td colspan="4"><input name="f_observ" type="hidden" id="f_observ" style="text-transform:uppercase" size="30" value="<?php echo $rowpoderes['f_observ']; ?>" />
            <input name="f_presauto" type="hidden" id="f_presauto" style="text-transform:uppercase" size="15" /></td>
          </tr>
        <tr>
          <td valign="top"><span class="camposss">Solicita:</span></td>
          <td colspan="4"><label for="f_solicita"></label>
            <textarea onkeypress="return maxLengthX(event,this,2500);" name="f_solicita" id="f_solicita" cols="80" rows="7" style="text-transform:uppercase"><?php echo $rowpoderes['f_solicita']; ?></textarea></td>
          </tr>
            </table>
          	
          </div>
          </td>
        </tr>
        </table>