    
    
    <table>
         <tr>
            <td>
                <table width="726" height="29">
                    <tr>
                        <td width="100">
                            <span class="camposss">Kardex Conexo:</span>
                        </td>
                        <td width="121">
                            <input id="n_kardconex" name="n_kardconex" type="text" style="width:100px" class="camposss"/>
                        </td>
                       <td width="52">
                            <span class="camposss">Notaria:</span>
                        </td>
                        <td width="275">
                            <select id="n_notaria" name="n_notaria" class="camposss" style="width:270px">
                                <option value="0">--Escoger Notaria--</option>
                                <?php for($i=0; $i<count($arr_notarias); $i++){?>
                                <option
                                value="<?php echo $arr_notarias[$i][0] ?>"><?php echo $arr_notarias[$i][1] ?></option>
                                <?php }?>
                            </select>
                        </td>
                        <td width="154">
                            <input value="GRABAR CAMBIOS" type="button" style="width:150px; font-size:12px;" class="camposss" onClick="grabar_cambios()"/>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table cellpadding="0" cellspacing="0">
                    <tr>
                        <td>
                            <ul class="tabs" style="width:711px; cursor:pointer; font-size:14px; font-weight:bold">
                                <li id="celda1" onClick="menus_editar(1,'<?php echo $arr_kardex[1]; ?>')" onMouseOver="cambiar_celda(this.id)" onMouseOut="restaurar_celda(this.id)" style="width:120px; text-align:center">Contratantes</li>
                                <li id="celda2" onClick="menus_editar(2,'<?php echo $arr_kardex[1]; ?>')" onMouseOver="cambiar_celda(this.id)" onMouseOut="restaurar_celda(this.id)" style="width:120px; text-align:center">Facturación</li>
                                <li id="celda3" onClick="menus_editar(3,'<?php echo $arr_kardex[1]; ?>')" onMouseOver="cambiar_celda(this.id)" onMouseOut="restaurar_celda(this.id)" style="width:120px; text-align:center">Escrituración</li>
                                <li id="celda4" onClick="menus_editar(4,'<?php echo $arr_kardex[1]; ?>')" onMouseOver="cambiar_celda(this.id)" onMouseOut="restaurar_celda(this.id)" style="width:150px; text-align:center">Registros Públicos</li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div id="menus" class="Contenedor1" style="min-height:220px; width:710px"></div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table>
                    <tr>
                        <td>
                            <input value="GENERAR DOCUMENTO" type="button" style="width:140px; font-size:12px;" class="camposss"/>
                        </td>
                        <td>
                            <input value="VER" type="button" style="width:140px; font-size:12px;" class="camposss"/>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>