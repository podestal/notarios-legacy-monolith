	<link rel="stylesheet" href="../../stylesglobal.css">	  

	<?php

	include("../../extraprotocolares/view/funciones.php");
    
    $conexion = Conectar();
	
	$id_servicio = $_REQUEST['id_servicio'];
	
	$sql_nservicio =    "SELECT
						servicios.id_servicio,
						servicios.descrip,
						servicios.tipo,
						servicios.precio1,
						servicios.precio2,
						servicios.grupo,
						servicios.codigo,
						servicios.abrev,
						servicios.porcentaje,
						servicios.kardex,
						servicios.infrrpp,
						servicios.activo,
						servicios.area1,
						servicios.serarea,
						servicios.ctaserv
						FROM
						servicios
						where servicios.id_servicio=$id_servicio";
						
	 $exe_nservicio = mysql_query($sql_nservicio, $conexion);
						
	 while($servicio = mysql_fetch_array($exe_nservicio)){
        		$arr_servicio[0] = $servicio["id_servicio"]; 
        		$arr_servicio[1] = $servicio["descrip"];         
                $arr_servicio[2] = $servicio["tipo"]; 
        		$arr_servicio[3] = $servicio["precio1"]; 
                $arr_servicio[4] = $servicio["precio2"]; 
                $arr_servicio[5] = $servicio["grupo"]; 
                $arr_servicio[6] = $servicio["codigo"]; 
        		$arr_servicio[7] = $servicio["abrev"]; 
        		$arr_servicio[8] = $servicio["porcentaje"]; 
        		$arr_servicio[9] = $servicio["kardex"]; 
        		$arr_servicio[10] = $servicio["infrrpp"]; 
                $arr_servicio[11] = $servicio["activo"]; 
                $arr_servicio[12] = $servicio["area1"]; 
                $arr_servicio[13] = $servicio["serarea"]; 
                $arr_servicio[14] = $servicio["ctaserv"]; 
	}
	
	?>

    <form id="frm_mservicio" name="frm_mservicio" style="width:100%"/>
    <table width="584" height="320" cellpadding="0" cellspacing="0">
        <tr height="35" style="background-color:#264965">
            <td colspan="4" align="center"><span class='submenutitu' style="font-size:14px">Modificar Servicio</span></td>
        </tr>
        <tr height="35">
        	<td width="98"><span class='titubuskar0' style="margin-left:8px">Tipo</span></td>
            <td width="208">
            	<select id="m_tipserv" name="m_tipserv" class="Estilo7" style="width:100px" tabindex="1">
                	<option value="0">--Elegir Tipo--</option>
                    <option value="N"
                    <?php if( $arr_servicio[2] =="N"){echo "selected='selected'";}?>
                    >Notarial</option>
                    <option value="E"
                    <?php if( $arr_servicio[2] =="E"){echo "selected='selected'";}?>
                    >Egresos</option>
                </select>
                <span style="color:red; margin-left:5px; font-size:12px">(*)</span>
            </td>
            <td width="83"><span class='titubuskar0'>Código</span></td>
            <td width="193"><input id="m_cod" name="m_cod" type="text" class="Estilo7" style="width:100px; background-color:#CCC" value="<?php echo $id_servicio; ?>" readonly /></td>
        </tr>
        
          <tr height="35">
		  
		  <!--
        	<td width="98"><span class='titubuskar0' style="margin-left:8px">Presupuesto</span></td>
            <td colspan="3">
            	<input id="m_incpre" name="m_incpre" type="checkbox" value="" class="Estilo7" onClick="validacheck2()"/><span style="color:red; margin-left:5px; font-size:10px;vertical-align:top;">Incluir en el presupuesto</span>
            </td>
			-->
			
			
			<td width="98"></td>
            <td colspan="3">
				
			</td>
			
        </tr>   
        
        <tr height="35">
        	<td width="98"><span class='titubuskar0' style="margin-left:8px">Descripción</span></td>
            <td colspan="3">
            	<input id="m_desc" name="m_desc" type="text" class="Estilo7" style="width:390px; text-transform:uppercase" maxlength="150" tabindex="2" value="<?php echo $arr_servicio[1]; ?>"/><span style="color:red; margin-left:5px; font-size:12px">(*)</span>
            </td>
        </tr>
        <tr height="35">
        	<td width="98"><span class='titubuskar0' style="margin-left:8px">Precio 1</span></td>
            <td width="208">
            	<input id="m_precio1" name="m_precio1" type="text" class="Estilo7" style="width:100px; text-transform:uppercase" maxlength="20" tabindex="3" onChange="currency(this.id, this.value)" onKeyPress="return numerosdecimales(event);" value="<?php echo $arr_servicio[3]; ?>" /><span style="color:red; margin-left:5px; font-size:12px">(*)</span>
            </td>
			
			<!--
			
            <td width="83"><span class="titubuskar0">Precio 2</span></td>
            <td width="193"><input id="m_precio2" name="m_precio2" type="text" class="Estilo7" style="width:100px; text-transform:uppercase" maxlength="2s0" tabindex="4" onChange="currency(this.id, this.value)" onKeyPress="return numerosdecimales(event);" value="<?phpecho $arr_servicio[4]; ?>"/></td>
			
			-->
			
			
			<td width="83"></td>
            <td width="193"><input id="m_precio2" name="m_precio2" type="hidden" class="Estilo7" style="width:100px; text-transform:uppercase" maxlength="2s0" tabindex="4" onChange="currency(this.id, this.value)" onKeyPress="return numerosdecimales(event);" value="<?phpecho $arr_servicio[4]; ?>"/></td>
			
			
			
			
			
			
			
        </tr>

		<tr height="35">
        	<td width="98"><span class='titubuskar0' style="margin-left:8px">Abrev.</span></td>
            <td width="208">
            	<input id="m_abrev" name="m_abrev" type="text" class="Estilo7" style="width:100px; text-transform:uppercase" maxlength="50" tabindex="5" value="<?php echo $arr_servicio[7]; ?>"/>
            </td>
			
			
			
			<!--
            <td width="83"><span class='titubuskar0'>Grupo</span></td>
            <td width="193"><input id="m_grupo" name="m_grupo" type="text" class="Estilo7" style="width:100px; text-transform:uppercase" maxlength="50" tabindex="6" value="<?phpecho $arr_servicio[5]; ?>"/></td>
			-->
			
			
			
			<td width="83"></td>
            <td width="193"><input id="m_grupo" name="m_grupo" type="hidden" class="Estilo7" style="width:100px; text-transform:uppercase" maxlength="50" tabindex="6" value="<?php echo $arr_servicio[5]; ?>"/></td>
			
			
			
			
        </tr>
		
		
		
	
		
		<!--
        <tr height="35" >
        	<td width="98" ><span class='titubuskar0' style="margin-left:8px">kardex</span></td>
            <td width="208">
            	<input id="m_kardex" name="m_kardex" type="text" class="Estilo7" style="width:100px; text-transform:uppercase" maxlength="50" tabindex="7" value="<?phpecho $arr_servicio[9]; ?>"/>
            </td>
            <td width="83"><span class='titubuskar0'>Infrrpp</span></td>
            <td width="193"><input id="m_inf" name="m_inf" type="text" class="Estilo7" style="width:100px; text-transform:uppercase" maxlength="50" tabindex="8" value="<?phpecho $arr_servicio[10]; ?>/></td>
        </tr>
		
		-->
		
		
		
		
		<tr height="35" >
        	<td width="98" ></td>
            <td width="208">
            	<input id="m_kardex" name="m_kardex" type="hidden" class="Estilo7" style="width:100px; text-transform:uppercase" maxlength="50" tabindex="7" value="<?php echo $arr_servicio[9]; ?>"/>
            </td>
            <td width="83"></td>
            <td width="193"><input id="m_inf" name="m_inf" type="hidden" class="Estilo7" style="width:100px; text-transform:uppercase" maxlength="50" tabindex="8" value="<?php echo $arr_servicio[10]; ?>"/></td>
        </tr>
		
		
		
		
		
		
		
        <tr height="35">
        	<td width="98"><span class='titubuskar0' style="margin-left:8px">Area</span></td>
            <td width="208">
            	<input id="m_area" name="m_area" type="text" class="Estilo7" style="width:100px; text-transform:uppercase" maxlength="50" tabindex="9" value="<?php echo $arr_servicio[12]; ?>"/>
            </td>
			<!--
            <td width="83"><span class='titubuskar0'>Set Area</span></td>
            <td width="193"><input id="m_sarea" name="m_sarea" type="text" class="Estilo7" style="width:100px; text-transform:uppercase" maxlength="50" tabindex="10" value="<?phpecho $arr_servicio[13]; ?>"/></td>
			
			-->
			
			<td width="83"></td>
            <td width="193"><input id="m_sarea" name="m_sarea" type="hidden" class="Estilo7" style="width:100px; text-transform:uppercase" maxlength="50" tabindex="10" value="<?php echo $arr_servicio[13]; ?>"/></td>
			
			
			
        </tr>
	
	
	<!--
        <tr height="35">
        	<td width="98"><span class='titubuskar0' style="margin-left:8px">Porcentaje</span></td>
            <td width="208">
            	<input id="m_porcentaje" name="m_porcentaje" type="text" class="Estilo7" style="width:100px; text-transform:uppercase" onkeypress="return numerosdecimales(event);" onChange="currency(this.id, this.value)" value="<?phpecho $arr_servicio[8]; ?>"  maxlength="50" tabindex="11" />
            </td>
            <td width="83"><span class='titubuskar0'>Cta. Servicio</span></td>
            <td width="193">
                <input id="m_cuenta" name="m_cuenta" type="text" class="Estilo7" style="width:100px; text-transform:uppercase" value="<?phpecho $arr_servicio[14]; ?>" maxlength="50" tabindex="12"/>
            </td>
        </tr>
		
		-->
	
	        <tr height="35">
        	<td width="98"></td>
            <td width="208">
            	<input id="m_porcentaje" name="m_porcentaje" type="hidden" class="Estilo7" style="width:100px; text-transform:uppercase" onkeypress="return numerosdecimales(event);" onChange="currency(this.id, this.value)" value="<?phpecho $arr_servicio[8]; ?>"  maxlength="50" tabindex="11" />
            </td>
            <td width="83"></td>
            <td width="193">
                <input id="m_cuenta" name="m_cuenta" type="hidden" class="Estilo7" style="width:100px; text-transform:uppercase" value="<?phpecho $arr_servicio[14]; ?>" maxlength="50" tabindex="12"/>
            </td>
        </tr>
	
	
	
		
		
        <tr height="40">
			<td colspan="4" align="center">
            	<input type="button" value="Modificar" onClick="mod_servicio('<?php echo $arr_servicio[0];?>')" class="Estilo7" tabindex="13" />
            </td>
        </tr>
        
    </table>
    </form>

	<span class='submenutitu' style="position:relative; top:-315px; left:560px; cursor:pointer; font-size:14px" title="Cerrar" onClick="cerrar_mservicio()">x</span>
	
	
	<a onclick="cerrar_mservicio()" >
				<img src="../../iconos/cerrar.png" width="22" height="22" border="0" title="Cerrar"/>
    </a>
	
	
	</div>
    
    <span style="color:red; font-size:8px; position:relative; left:398px; top:-30px">(*)Campos Obligatorios</span>	
