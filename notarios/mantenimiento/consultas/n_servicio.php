	<link rel="stylesheet" href="../../stylesglobal.css">	  

	<?php

	include("../../extraprotocolares/view/funciones.php");
    
    $conexion = Conectar();
	
	$sql_idservicio =  "SELECT
					    servicios.id_servicio,
						servicios.descrip,
						servicios.tipo,
						servicios.precio1,
						servicios.precio2,
						servicios.grupo
						FROM
						servicios
						order by cast(servicios.id_servicio as signed) desc";
	
	$exe_idservicio = mysql_query($sql_idservicio, $conexion);
	
	$row_lastservicio = mysql_fetch_array($exe_idservicio);
		
	$id_servicio = $row_lastservicio[0]+1;
	
	?>

    <form id="frm_nservicio" name="frm_nservicio" style="width:100%"/>
    <table width="584" height="320" cellpadding="0" cellspacing="0">
        <tr height="35" style="background-color:#264965">
            <td colspan="4" align="center"><span class='submenutitu' style="font-size:14px">Nuevo Servicio</span></td>
        </tr>
        <tr height="35">
        	<td width="98"><span class='titubuskar0' style="margin-left:8px">Tipo</span></td>
            <td width="208">
            	<select id="n_tipserv" name="n_tipserv" class="Estilo7" style="width:100px" tabindex="1">
                	<option value="0">--Elegir Tipo--</option>
                    <option value="N">Notarial</option>
                    <option value="E">Egresos</option>
                </select>
                <span style="color:red; margin-left:5px; font-size:12px">(*)</span>
            </td>
            <td width="83"><span class='titubuskar0'>Código</span></td>
            <td width="193"><input id="n_cod" name="n_cod" type="text" class="Estilo7" style="width:100px; background-color:#CCC" value="<?php echo $id_servicio; ?>" readonly /></td>
        </tr>
        
     <tr height="35">
	 
	 <!--
        	<td width="98"><span class='titubuskar0' style="margin-left:8px">Presupuesto</span></td>
            <td colspan="3">
            	<input id="n_incpre" name="n_incpre" type="checkbox" value="" class="Estilo7" onClick="validacheck()"/><span style="color:red; margin-left:5px; font-size:10px;vertical-align:top;">Incluir en el presupuesto</span>
            </td>
			
			-->
			
			<td width="98"></td>
            <td colspan="3">
            	<input id="n_incpre" name="n_incpre" type="hidden" value="" class="Estilo7" onClick="validacheck()"/><span style="color:red; margin-left:5px; font-size:10px;vertical-align:top;"></span>
            </td>
			
			
        </tr>     
        
        <tr height="35">
        	<td width="98"><span class='titubuskar0' style="margin-left:8px">Descripción</span></td>
            <td colspan="3">
            	<input id="n_desc" name="n_desc" type="text" class="Estilo7" style="width:390px; text-transform:uppercase" maxlength="150" tabindex="2"/><span style="color:red; margin-left:5px; font-size:12px">(*)</span>
            </td>
        </tr>
        
        
        
        <tr height="35">
        	<td width="98"><span class='titubuskar0' style="margin-left:8px">Precio 1</span></td>
            <td width="208">
            	<input id="n_precio1" name="n_precio1" type="text" class="Estilo7" style="width:100px; text-transform:uppercase" maxlength="20" tabindex="3" onChange="currency(this.id, this.value)" onKeyPress="return numerosdecimales(event);" value="0.00"/><span style="color:red; margin-left:5px; font-size:12px">(*)</span>
            </td>
			
			<!--
            <td width="83"><span class="titubuskar0">Precio 2</span></td>
            <td width="193"><input id="n_precio2" name="n_precio2" type="text" class="Estilo7" style="width:100px; text-transform:uppercase" maxlength="2s0" tabindex="4" onChange="currency(this.id, this.value)" onKeyPress="return numerosdecimales(event);" value="0.00"/></td>
			-->
			
			
			<td width="83"></td>
            <td width="193"><input id="n_precio2" name="n_precio2" type="hidden" class="Estilo7" style="width:100px; text-transform:uppercase" maxlength="2s0" tabindex="4" onChange="currency(this.id, this.value)" onKeyPress="return numerosdecimales(event);" value="0.00"/></td>
			
        </tr>
        <tr height="35">
        	<td width="98"><span class='titubuskar0' style="margin-left:8px">Abrev.</span></td>
            <td width="208">
            	<input id="n_abrev" name="n_abrev" type="text" class="Estilo7" style="width:100px; text-transform:uppercase" maxlength="50" tabindex="5"/>
            </td>
			
			<!--
            <td width="83"><span class='titubuskar0'>Grupo</span></td>
            <td width="193"><input id="n_grupo" name="n_grupo" type="text" class="Estilo7" style="width:100px; text-transform:uppercase" maxlength="50" tabindex="6"/></td>
      -->
	  
	  <td width="83"></td>
            <td width="193"><input id="n_grupo" name="n_grupo" type="hidden" class="Estilo7" style="width:100px; text-transform:uppercase" maxlength="50" tabindex="6"/></td>
	  
	  
	    </tr>
        <tr height="35">
		
		<!--
		
        	<td width="98"><span class='titubuskar0' style="margin-left:8px">kardex</span></td>
            <td width="208">
            	<input id="n_kardex" name="n_kardex" type="text" class="Estilo7" style="width:100px; text-transform:uppercase" maxlength="50" tabindex="7"/>
            </td>
			-->
			
			<td width="98"></td>
            <td width="208">
            	<input id="n_kardex" name="n_kardex" type="hidden" class="Estilo7" style="width:100px; text-transform:uppercase" maxlength="50" tabindex="7"/>
            </td>
			
			<!--
            <td width="83"><span class='titubuskar0'>Infrrpp</span></td>
            <td width="193"><input id="n_inf" name="n_inf" type="text" class="Estilo7" style="width:100px; text-transform:uppercase" maxlength="50" tabindex="8"/></td>
        -->
		
		
		<td width="83"></td>
            <td width="193"><input id="n_inf" name="n_inf" type="hidden" class="Estilo7" style="width:100px; text-transform:uppercase" maxlength="50" tabindex="8"/></td>
		
		
		</tr>
        <tr height="35">
        	<td width="98"><span class='titubuskar0' style="margin-left:8px">Area</span></td>
            <td width="208">
            	<input id="n_area" name="n_area" type="text" class="Estilo7" style="width:100px; text-transform:uppercase" maxlength="50" tabindex="9"/>
            </td>
			
			<!--
            <td width="83"><span class='titubuskar0'>Set Area</span></td>
            <td width="193"><input id="n_sarea" name="n_sarea" type="text" class="Estilo7" style="width:100px; text-transform:uppercase" maxlength="50" tabindex="10"/></td>
       -->
	   
	   
	   <td width="83"></td>
            <td width="193"><input id="n_sarea" name="n_sarea" type="hidden" class="Estilo7" style="width:100px; text-transform:uppercase" maxlength="50" tabindex="10"/></td>
	   
	   
	   
	    </tr>
        <tr height="35">
		
		<!--
		
        	<td width="98"><span class='titubuskar0' style="margin-left:8px">Porcentaje</span></td>
            <td width="208">
            	<input id="n_porcentaje" name="n_porcentaje" type="text" class="Estilo7" style="width:100px; text-transform:uppercase" onkeypress="return numerosdecimales(event);" onChange="currency(this.id, this.value)" value="0.00"  maxlength="50" tabindex="11"/>
            </td>
            <td width="83"><span class='titubuskar0'>Cta. Servicio</span></td>
            <td width="193">
                <input id="n_cuenta" name="n_cuenta" type="text" class="Estilo7" style="width:100px; text-transform:uppercase" maxlength="50" tabindex="12"/>
            </td>
			
			-->
			
			
			
			<td width="98"></td>
            <td width="208">
            	<input id="n_porcentaje" name="n_porcentaje" type="hidden" class="Estilo7" style="width:100px; text-transform:uppercase" onkeypress="return numerosdecimales(event);" onChange="currency(this.id, this.value)" value="0.00"  maxlength="50" tabindex="11"/>
            </td>
            <td width="83"></td>
            <td width="193">
                <input id="n_cuenta" name="n_cuenta" type="hidden" class="Estilo7" style="width:100px; text-transform:uppercase" maxlength="50" tabindex="12"/>
            </td>
			
			
			
        </tr>
        <tr height="40">
			<td colspan="4" align="center">
            	<input type="button" value="Grabar" onClick="registrar_servicio()" class="Estilo7" tabindex="13" />
            </td>
        </tr>
        
    </table>
    </form>

	<span class='submenutitu' style="position:relative; top:-315px; left:560px; cursor:pointer; font-size:14px" title="Cerrar" onClick="cerrar_nservicio()">x</span></div>
    
    <span style="color:red; font-size:8px; position:relative; left:398px; top:-30px">(*)Campos Obligatorios</span>	
