<link href="../../includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../../tcal.css" />

<script src="../../includes/jquery-1.8.3.js"></script>
<script type="text/javascript" src="../../tcal.js"></script> 

<script type="text/javascript">

$(document).ready(function(){ 

	$.getScript("../../includes/jquery-1.8.3.js");
	/*$.getScript("../../includes/maskedinput.js", function(){
		$("#fechade").mask("99/99/9999",{placeholder:"_"});
		$("#fechaa").mask("99/99/9999",{placeholder:"_"});
	}); */
	
	$.getScript("../../includes/js/jquery-ui-notarios.js", function(){
		$("#fechade").datepicker({ dateFormat: "dd/mm/yy" });
		$("#fechaa").datepicker({ dateFormat: "dd/mm/yy" });
	});
	
	
	
	 
	
	

})

function Imprime(_id,_numdoc)
{
	var _usuario_imprime = '<?php echo $_SESSION["apepat_usu"].' '.$_SESSION["nom1_usu"]; ?>';
	
	if (confirm('Desea Imprimir el comprobante.. '+_numdoc+' ?'))
	{
		window.open('../Reportes/impresion_factura.php?id_regventas='+_id,"Impresion de Factura","status=1,scrollbars=1, menubar=0,resizable=0,width=350,height=250");	
	}
}

</script>

<input name="txtfilas" type="hidden" class="tcal" id="txtfilas" maxlength="12" />
  <table width="900" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="19">&nbsp;</td> 
    </tr>
    <tr>
      <td align="center"><table width="863" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="824" height="18"><form id="frmescri" name="frmescri" method="post" action="">
            <table width="834" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="86"><span class="Estilo7">De Fecha </span></td>
                <td width="154"><span class="Estilo7">
                  <label>
                  <input name="fechade" type="text" class="tcal" id="fechade" size="15" maxlength="12" />
                  </label>
                </span></td>
                <td width="42"><span class="Estilo7">a</span></td>
                <td width="53"><span class="Estilo7">Fecha</span></td>
                <td width="172"><label>
                  <input name="fechaa" type="text" class="tcal" id="fechaa" size="15" maxlength="12" />
                </label></td>
                <td width="287"><a href="#" onclick="buscaComprobante222()"><img src="../../iconos/buscarclie.png" width="72" height="29" border="0" /></a></td>
                <td width="36">&nbsp;</td>
                <td width="4">&nbsp;</td>
              </tr>
            </table>
                    </form>          </td>
        </tr>
        <tr>
          <td height="9">---------------------------------------------------------------------------------------------------------------------------------------------</td>
        </tr>
        <tr>
          <td height="22"><table id="tabComprob" width="834" border="1" cellpadding="0" cellspacing="0" bordercolor="#333333">
            <tr>
              <td width="70" height="19" bgcolor="#CCCCCC"><span class="Estilo14">Fec.Emision</span></td>
              <td width="70" bgcolor="#CCCCCC"><span class="Estilo14">Fec.Pago</span></td>
              <td width="60" bgcolor="#CCCCCC"><span class="Estilo14">Tipo</span></td>
              <td width="30" bgcolor="#CCCCCC"><span class="Estilo14">Serie</span></td>
              <td width="50" bgcolor="#CCCCCC"><span class="Estilo14">N.Doc.</span></td>
              <td width="120" bgcolor="#CCCCCC"><span class="Estilo14">Cliente</span></td>
              <td width="50" align="right" bgcolor="#CCCCCC"><span class="Estilo14">Base Imp.</span></td>
              <td width="50" align="right" bgcolor="#CCCCCC"><span class="Estilo14">I.G.V.</span></td>
              <td width="50" align="right" bgcolor="#CCCCCC"><span class="Estilo14">Imp. Total</span></td>
              <td width='10' align="right" bgcolor="#CCCCCC"><span class="Estilo14">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td><div id="buscacomprobantes" style="height:250px; overflow:auto;"></div></td>
        </tr>
      </table></td>
    </tr>
  </table>

