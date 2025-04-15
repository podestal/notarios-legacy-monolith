<?php 
include("../../conexion.php");
	require_once("../../includes/barramenu.php") ;
	require_once("../../includes/gridView.php")  ;
	require_once("../../includes/combo.php")  	  ;
	$oBarra = new BarraMenu() 				  ;
	$Grid1 = new GridView()					  ;
	$oCombo = new CmbList()  				  ;	

?>
<table width="674" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="21">&nbsp;</td>
    <td width="653"><table width="647" border="0" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
      <tr>
        <td height="30" ><span class="camposss">Ape.Paterno</span></td>
        <td width="159" height="30"><input type="text" name="apepat" style="text-transform:uppercase"   id="apepat" value="<?php echo str_replace("*","&",str_replace("?","'",strtoupper($row['apepat']))); ?>" /></td>
        <td width="95" height="30" ><span class="camposss">1er Nombre</span></td>
        <td width="163" height="30" ><input type="text" name="prinom" style="text-transform:uppercase" id="prinom" value="<?php echo str_replace("*","&",str_replace("?","'",strtoupper($row['prinom']))); ?>" /></td>
        <td width="127" height="30" >
    <div id="menucondicion" class="menucondicion" style="display:none; z-index:3;" >
                                <table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr>
                                    <td height="29" colspan="2" class="style30"><table width="196" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                          <td width="16">&nbsp;</td>
                                          <td width="180"><span class="titulomenuacto">Seleccione Condición(es)</span></td>
                                        </tr>
                                    </table></td>
                                    <td width="45" align="right" valign="middle">&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td height="50" colspan="3"><table width="750" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="25">&nbsp;</td>
    <td width="725"><div id="tipocondicion" class="tipoacto" style="overflow:auto;"></div></td>
  </tr>
</table></td>
                                  </tr>
                                  <tr>
                                    <td width="620" height="10">&nbsp;</td>
                                    <td width="95"><a href='#' onClick="ocultar_desc('menucondicion');mostrar_desc('validarrepre')"><img src="../../iconos/aceptar.png" width="95" height="29" border="0" /></a></td>
                                    <td height="10">&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td colspan="3" align="center" valign="middle"></td>
                                  </tr>
                                  <tr></tr>
                                </table>
          </div>    <div id="menucondicionk" class="menucondicion" style="display:none; z-index:4;" >
                                <table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr>
                                    <td height="29" colspan="2" class="style30"><table width="196" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                          <td width="16">&nbsp;</td>
                                          <td width="180"><span class="titulomenuacto">Quitar Condición(es)</span></td>
                                        </tr>
                                    </table></td>
                                    <td width="45" align="right" valign="middle">&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td height="50" colspan="3"><table width="750" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="25">&nbsp;</td>
    <td width="725"><div id="tipocondicionk" class="tipoacto" style="overflow:auto;"></div></td>
  </tr>
</table></td>
                                  </tr>
                                  <tr>
                                    <td width="620" height="10">&nbsp;</td>
                                    <td width="95"><a href='#' onClick="ocultar_desc('menucondicionk')"><img src="../../iconos/aceptar.png" width="95" height="29" border="0" /></a></td>
                                    <td height="10">&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td colspan="3" align="center" valign="middle"></td>
                                  </tr>
                                  <tr></tr>
                                </table>
    </div>
          <input type="hidden" name="docum" style="text-transform:uppercase" id="docum" value="<?php echo strtoupper($row['numdoc']); ?>" /></td>
        </tr>
      <tr>
        <td height="30" ><span class="camposss">Ape.Materno</span></td>
        <td height="30"><input type="text" name="apemat" style="text-transform:uppercase" id="apemat" value="<?php echo str_replace("*","&",str_replace("?","'",strtoupper($row['apemat']))); ?>" /></td>
        <td height="30" ><span class="camposss">2do Nombre</span></td>
        <td height="30" ><input type="text" name="segnom" style="text-transform:uppercase" id="segnom" value="<?php echo str_replace("*","&",str_replace("?","'",strtoupper($row['segnom']))); ?>"  /></td>
        <td height="30" >&nbsp;</td>
      </tr>
      <tr>
        <td height="30" ><span class="camposss">Dirección</span></td>
        <td height="30" colspan="3"><input name="dir" type="text" style="text-transform:uppercase" id="dir" value="<?php echo str_replace("*","&",str_replace("?","'",utf8_decode(strtoupper($row['direccion'])))); ?>" size="60" /></td>
        <td height="30" >&nbsp;</td>
      </tr>
      <tr>
        <td width="103" height="30" ><span class="camposss">Telefono</span></td>
        <td height="30"><input name="telfijo" type="text" id="telfijo" style="text-transform:uppercase;" size="10" value="<?php echo strtoupper($row['telfijo']); ?>" /></td>
        <td height="30">&nbsp;</td>
        <td height="30">&nbsp;</td>
        <td height="30" >&nbsp;</td>
      </tr>
      <tr>
        <td height="30" colspan="5" ><table width="44" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="44"><label><span class="camposss">
              <input type="hidden" name="codclie" id="codclie" value="<?php echo $row['idcliente']; ?>"   />
              </span></label></td>
            </tr>
          </table></td>
      </tr>
    </table></td>
  </tr>
</table>


