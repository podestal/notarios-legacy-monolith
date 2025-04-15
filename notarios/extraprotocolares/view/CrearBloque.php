<?php
include("../../conexion.php");
	require_once("../../includes/barramenu.php") ;
	require_once("../../includes/gridView.php")  ;
	require_once("../../includes/combo.php")  	 ;
	$oBarra = new BarraMenu() 				     ;
	$Grid1 = new GridView()					     ;
	$oCombo = new CmbList()  				     ;	

?>
<script type="text/javascript" src="../includes/Mantenimientos.js"></script> 
<script type="text/javascript" src="../../tcal.js"></script> 
<link rel="stylesheet" type="text/css" href="../../tcal.css" />
<script type="text/javascript">
       $(document).ready(function(){ 
	   		$("#fec_ingreso").mask("99/99/9999",{placeholder:"_"}); 
	})

	function fcrearBloque()
	{
		var _remitente    = document.getElementById('remitente2');
		var _fec_ingreso  = document.getElementById('fec_ingreso');
		var _num_cartas   = document.getElementById('num_cartas');
		
		if(_remitente.value=='' || _fec_ingreso.value=='' ||_num_cartas.value=='')
		{alert('Falta ingresar datos');return;}
		fcreaBloque();
	}


	function fcerrardivedicion()
	{
		$("#div_editparti").dialog("close");
		$("#div_editparti").remove();	
	}

    function fShowDatosClick() 
		{			
					var _numdoc		= document.getElementById('idremitente').value;
					var _remitente  = document.getElementById('remitente2');
					
					var _des = fShowAjaxDato('../includes/remitente.php?numdoc='+_numdoc);
					document.getElementById('remitente2').value = _des;
					
					if(_remitente==''){alert('No se encuentra registrado');return;}
		}		


</script>
<form id="frmescri" name="frmescri" method="post" action="">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="25" colspan="2" align="center" valign="top"><span class="camposss">.:: Creacion de bloque ::.</span></td>
              </tr>
              <tr>
                <td width="110" height="22" valign="bottom"><span class="camposss">Nro de Cartas : </span></td>
                <td width="251" height="22" valign="bottom"><span id="sprytextfield1">
                <label></label>
                  <span class="textfieldRequiredMsg"><span class="titus33">
                  <input name="num_cartas" type="text"  id="num_cartas" style="text-transform:uppercase;" size="5" />
                  </span></span></span></td>
                
              </tr>
              <tr>
                <td height="27" colspan="2" align="left"><fieldset>
                  <legend><span class="camposss">Remitente</span></legend>
                  <table  width="100%">
                    <tr>
                      <td width="30%"><span class="camposss">N.documento :</span></td>
                      <td width="70%"><input name="idremitente" type="text" id="idremitente" style="text-transform:uppercase" size="15" onkeypress="fShowDatosProvee(event);" />
                         <a href="#" onClick="fShowDatosClick()"> <img src="../../images/search.png" width="15" height="15" alt="" /></a></td>
                    </tr>
                    <tr>
                      <td><span class="camposss">Remitente:</span> </td>
                      <td><span class="titus33">
                        <input name="remitente2" type="text"  id="remitente2" style="text-transform:uppercase;" size="40" maxlength="200" />
                      </span></td>
                    </tr>
                  </table>
                </fieldset></td>
              </tr>
              <tr>
                <td height="28"><span class="camposss">Fec Ingreso</span>: </td>
                <td height="28"><span id="sprytextfield5">
                <label>
                  <input name="fec_ingreso" type="text" id="fec_ingreso" style="text-transform:uppercase;" size="15" value="<?php echo date("d/m/Y"); ?>" class="tcal" />
                  </label>
                </span></td>
              </tr>
              <tr>
                <td colspan="2"><label><input type="hidden" name="campo1" id="campo1" />
                  <input type="hidden" name="campo2" id="campo2" />
                </label></td>
              </tr>
          </table>
</form>