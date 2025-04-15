

<form id="frm_recojo" name="frm_recojo">
<table width="322" cellpadding="0" cellspacing="0" >
    <tr height="35">
        <td colspan="2" align="center">
            <span class="titubuskar0">Datos del Recojo</span>
        </td>
    </tr>
    <tr>
        <td>
            <table width="312" height="132">
                <tr height="30">
                    <td width="86">
                        <span class="reskar" style="margin-left:10px">Cliente</span></td>
                    <td width="214">
                        <input id="l_cliente" name="l_cliente" type="text" maxlength="100" tabindex="2" style="width:200px;  text-transform:uppercase" class="reskar"/>
                    </td>
                </tr>
                <tr height="30">
                    <td>
                        <span class="reskar" style="margin-left:10px">DOI</span>
                    </td>
                    <td>
                        <input id="l_doi" name="l_doi" type="text" maxlength="11" tabindex="3" style="width:100px" class="reskar" onKeyPress="return isNumberKey(event);" />
                        <select id="l_anio" name="l_anio" class="reskar" style="width:100px">
                        	<?php for($i=2015; $i>=1999; $i--){ ?>
                        	<option
                            <?php if($i==2014){echo "selected='selected'";} ?>
                            ><?php echo $i; ?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr height="30">
                    <td>
                        <span class="reskar" style="margin-left:10px">Fecha</span>
                    </td>
                    <td>
                        <input id="l_fecha" name="l_fecha" type="text" readonly tabindex="4" style="width:80px" class="reskar"/>
                    </td>
                </tr>
                <tr height="30">
                    <td>
                        <span class="reskar" style="margin-left:10px">Comprobante</span>
                    </td>
                    <td>
                        <input id="l_comprobante" name="l_comprobante" type="text" maxlength="15" tabindex="5" style="width:100px; text-transform:uppercase" class="reskar"/>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
    	<td align="center">
            <input style="width:80px; " type="button" value="Grabar" onClick="recoger_libro()" class="buttonlibro" />
        </td>
    </tr>
    <tr height="10">
    	<td></td>
    </tr>
</table>
</form>

<div style="position:absolute; left:299px; top:8px; font-size:14px; cursor:pointer" onClick="cerrar_recoger()">x</div>