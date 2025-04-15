  
  <form id="frm_pago" name="frm_pago">
        <table width="752">
                <tr>
                    <td width="135"><span class="camposss">Servicio:</span></td>
                    <td colspan="3"><div id="slc_serv"></div></td>
                    <td width="123"><span class="camposss" style="margin-left:55px">Tipo:</span></td>
                    <td width="225"><div id="slc_tipserv"></div>
                  </td>
                </tr>
                <tr height="40">
                    <td><span class="camposss">Precio: &nbsp;(S/.)</span></td>
                    <td width="125">
                    <div id="div_precio">
                    <input id="precio" name="precio" type="text" class="camposss" style="width:100px"  value="0.00" maxlength="6" onchange="currency(this.value);"  />
                    </div>
                    </td>
                    <td colspan="4">
                    	<table width="358">
                        	<tr>
                            	<td width="59"><div id="div_numero"></div></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td><span class="camposss">Cantidad:</span></td>
                    <td colspan="5"><input id="cantidad" name="cantidad" type="text" class="camposss" style="width:100px" onKeyPress="return isNumberKey(event)"  value="0" maxlength="9"/></td>
                </tr>
                <tr>
                    <td colspan="6">----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</td>
                </tr>
                <tr>
                    <td colspan="6">
                        <table width="768"  height="41">
                                <tr>
                                    <td width="640">&nbsp;</td>
                                    <td width="47">
                                    </td>
                                    <td width="41">
                                    <div style="border: 1px solid #79B7E7; border-radius: 3px ; background-color:#DDECF7; padding:6px; width:30px; cursor:pointer" title="Agregar" onClick="myCreateFunction()">
                                    <img style="margin-left:6px" src="../../images/success.png" width="20" height="20"  /></div>
                                    <!--<div style="border: 1px solid #79B7E7; border-radius: 3px ; background-color:#DDECF7; padding:6px; width:30px; cursor:pointer" title="Cerrar" onClick="cerrar_servicio()"><img style="margin-left:4px" src="../../images/delete.png" width="20" height="20" /></div>--></td>
                                </tr>
                        </table>	
                    </td>
                 </tr>
        </table>
  </form>