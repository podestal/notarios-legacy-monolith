	<?php 
	
	$id_cliente = $_REQUEST['id'];
	
	?>
    
    <table width="300px">
    		<tr>
            	<td colspan="2" align="center">
                <table width="287">
                    <tr>
                        <td width="84"></td>
                    	<td width="145"><span class="Estilo7">Ingrese sus datos</span></td>
                        <td width="42"><span onClick="cerrar_login()" style="margin-left:30px; cursor:pointer" title="Cerrar">X</span></td>
                    </tr>

                </table>
              </td>
            </tr>
            <tr>
            	<td width="84"><span class="Estilo7" style="font-size:12px; margin-left:10px">Usuario</span></td>
                <td width="204"><input id="usuario" name="usuario" class="Estilo7" type="text" maxlength="20" size="20"/></td>
            </tr>
            <tr>
            	<td><span class="Estilo7" style="font-size:12px; margin-left:10px">Contraseña</span></td>
                <td><input id="clave" name="clave" class="Estilo7" type="password"  maxlength="20" size="20"/></td>
            </tr>
            <tr>
            	<td colspan="2" align="center">
                	<input onClick="login('<?php echo $id_cliente;?>');" type="button" value="Login" size="15" style="font-family:Verdana, Geneva, sans-serif; font-size:12px"/>
                </td>
            </tr>
    </table>