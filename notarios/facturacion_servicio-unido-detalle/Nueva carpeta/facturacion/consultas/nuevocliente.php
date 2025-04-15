<?php

$sdoic = $_REQUEST['sdoic'];

?>
<table cellpadding="0" cellspacing="0" border="0" width="600" height="470">
	<tr>
    	<td height="40" colspan="4" align="center">
        	<table width="590">
                <tr>
                <td width="564" align="center"><span class="camposss" style="margin-left:20px; color:white">
                  <input type="hidden" name="n_tippersona" id="n_tippersona" value="<?php echo $sdoic;?>" />
                Registrar Nuevo Cliente</span></td>
                <td width="14"><div class="camposss" style="cursor:pointer; color:white " onclick="cerrar_ncliente()" title="Cerrar">X</div></td>
                </tr>
        	
            </table>
        </td>
    </tr>
    <tr>
    	<td height="40" colspan="4" align="center"></td>
    </tr>
    <tr>
    	<td align="center"><div id="fila_natural"></div></td>
    </tr>
    <tr>
    	<td align="center"><div id="fila_juridica"></div></td>
    </tr>
        <tr height="30">
        <td height="55" colspan="4" align="center">
        <div id="btn_ncliente" name="btn_ncliente" style="display:none">
        <input  type="button" value="Grabar" class="camposss" onClick="grabar_cliente()" style="margin-left:220px; width:80px "/> 
        <span style="color:red; font-size:10px; margin-left:110px">(*)Campos Obligatorios</span>	
        </div>
        </td>
    </tr>
    
</table>

