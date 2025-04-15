<?php
	
	include("../../extraprotocolares/view/funciones.php");
	
	$doic = $_REQUEST['doic'];
	$sdoic = $_REQUEST['sdoic'];
	
	$conexion = Conectar();
	
	$sql_tipdocumento = "SELECT
						 tipodocumento.idtipdoc,
						 tipodocumento.codtipdoc,
						 tipodocumento.destipdoc
						 FROM
						 tipodocumento";		
					  
	$exe_tipdocumento = mysql_query($sql_tipdocumento, $conexion);
	
	$i=0;
	
	
		
	$sql_nac = "SELECT
				nacionalidades.idnacionalidad as id,
				nacionalidades.codnacion as cod,
				nacionalidades.desnacionalidad as nacionalidad,
				nacionalidades.descripcion as des
				FROM
				nacionalidades";
		
	$res_nac = mysql_query($sql_nac, $conexion);
	
	$sql_civil =   "SELECT
					tipoestacivil.idestcivil as id,
					tipoestacivil.codestcivil as cod_est,
					tipoestacivil.desestcivil as des
					FROM
					tipoestacivil";
		
	$res_civil = mysql_query($sql_civil, $conexion);
	
?>
    <form id="frm_natural" name="frm_natural"/>    
    <table style="width:550px;  height:240px" border="1" align="center">        
     <tr height="30">
        <td width="101"><span class="camposss" style="color:white">Apellido Paterno:</span></td>
        <td width="137" align="left"><span style="color:red; margin-left:5px"><span class="camposss" style="color:white; margin-left:10px">
          <input id="n_apepat" name="n_apepat" type="text" class="camposss" style="width:100px; height:16px; text-transform:uppercase" maxlength="20" onkeypress="return soloLetras(event)"/>
        </span>(*)</span></td>
        <td width="112"><span class="camposss" style="color:white; margin-left:10px">
      Apellido Mat.:</span></td>
        <td width="122" align="left"><span class="camposss" style="color:white; margin-left:10px">
          <input id="n_apemat" name="n_apemat" type="text" class="camposss" style="width:100px; height:16px; text-transform:uppercase" maxlength="20" onkeypress="return soloLetras(event)"/>
        </span></td>
    </tr>
	<tr height="30">
        <td><span class="camposss" style="color:white">Primer Nombre:</span></td>
        <td><span style="color:red; margin-left:5px">
          <input id="n_prinom" name="n_prinom" type="text" class="camposss" style="width:100px; height:16px; text-transform:uppercase" maxlength="20" onkeypress="return soloLetras(event)"/>
        (*)</span></td>
        <td><span class="camposss" style="color:white; margin-left:10px">Segundo Nombre:</span></td>
        <td><input id="n_segnom" name="n_segnom" type="text" class="camposss" style="width:100px; height:16px; text-transform:uppercase" maxlength="20" onkeypress="return soloLetras(event)"/></td>
    </tr>
   <tr height="30">
	   <td><span class="camposss" style="color:white">Tipo Documento:</span></td>
        <td>
        	<select id="n_tipdocu" name="n_tipdocu" type="text" class="camposss" style="width:105px" onchange="cambiar_doic('n_doicn', this.value)">
                <option value="">--Tipo Documento--</option>
                <?php 
				while($tipdocumento = mysql_fetch_array($exe_tipdocumento, MYSQL_ASSOC))
					{
						if($tipdocumento["idtipdoc"]==$sdoic){
								echo '<option value="'.$tipdocumento["idtipdoc"].'" selected="selected">'.$tipdocumento["destipdoc"].'</option>';
							}else{
								echo '<option value="'.$tipdocumento["idtipdoc"].'">'.$tipdocumento["destipdoc"].'</option>';
								}
					}
								?>             
            </select>
            <span style="color:red; margin-left:5px">(*)</span></td>
        <td><span class="camposss" style="color:white; margin-left:10px">Nº Documento:</span></td>
        <td><input id="n_doicn" name="n_doicn" type="text" class="camposss" style="width:100px; height:16px" onkeypress="return isNumberKey(event);" value="<?php echo $doic; ?>" maxlength="20"/><span style="color:red; margin-left:5px">(*)</span></td>
        
    </tr>
    <tr height="30">
        <td><span class="camposss" style="color:white;">Dirección:</span></td>
        <td colspan="3"><input id="dir" name="dir" type="text" class="camposss" style="width:360px; height:16px; text-transform:uppercase" maxlength="80" onkeyup="cambiardireccionn();"/><input id="n_dir" name="n_dir" type="hidden" class="camposss" style="width:360px; height:16px; text-transform:uppercase" maxlength="80"/></td>
    </tr>
    <tr height="30">
        <td><span class="camposss" style="color:white">Email:</span></td>
        <td colspan="3"><input id="n_email" name="n_email" type="text" class="camposss" style="width:360px; height:16px" maxlength="50"/></td>
    </tr>
    <tr height="30">
        <td><span class="camposss" style="color:white">Ubigeos:</span></td>
        <td colspan="3"><input id="n_ubigeon" name="n_ubigeon" type="text" class="camposss" style="width:300px; height:16px; text-transform:uppercase" maxlength="20"/><span style="color:red; margin-left:5px">(*)</span>
        <input id="n_idubigeon" name="n_idubigeon" type="hidden"/>
        </td>
    </tr>
	<tr height="30">
    	<td><span class="camposss" style="color:white;">Telefono:</span></td>
        <td><input id="n_telf" name="n_telf" type="text" class="camposss" style="width:100px; height:16px" maxlength="7" onkeypress="return isNumberKey(event);"/></td>
        <td><span class="camposss" style="color:white; margin-left:10px">Celular:</span></td>
        <td><input id="n_celn" name="n_celn" type="text" class="camposss" style="width:100px; height:16px" maxlength="9" onkeypress="return isNumberKey(event);"/></td>
    </tr>
	<tr height="30">
    	<td><span class="camposss" style="color:white;">Sexo:</span></td>
        <td>
        <select id="n_sexo" name="n_sexo" class="camposss" style="width:105px">
        	<option value="">--Genero--</option>
            <option value="M">Masculino</option>
            <option value="F">Femenino</option>
        </select>
        </td>
        <td><span class="camposss" style="color:white; margin-left:10px">Estado Civil:</span></td>
        <td>
        
        <select id="n_civil" name="n_civil" class="camposss" style="width:105px">
        	<option value="">--Est. Civil--</option>
        	<?php 
			while($civil = mysql_fetch_array($res_civil, MYSQL_ASSOC))
			{?>
			<option value="<?php echo $civil["id"]; ?>"><?php echo $civil["des"]; ?></option>
			<?php }?>    
        </select>
        
        </td>
    </tr>
    <tr height="30">
	    <td><span class="camposss" style="color:white; ">Nacionalidad:</span></td>
        <td>
        <select id="n_nac" name="n_nac" class="camposss" style="width:105px">
        	<option value="">--Países--</option>
        	<?php 
			while($nac = mysql_fetch_array($res_nac, MYSQL_ASSOC))
			{?>
			<option value="<?php echo $nac["id"]; ?>"><?php echo $nac["nacionalidad"]; ?></option>
			<?php }?>    
        </select>
        </td>
        <td><span class="camposss" style="color:white; margin-left:10px">Fecha de Nac.</span></td>
        <td>
        <input id="n_fecnac" name="n_fecnac" type="text" style="width:100px; height:16px" maxlength="20" readonly="readonly"/>
        </td>
    </tr>
	<tr height="30">
    	<td><span class="camposss" style="color:white;">Natural de:</span></td>
        <td><input id="n_natde" name="n_natde" type="text" class="camposss" style="width:100px; height:16px" maxlength="20" onkeypress="return soloLetras(event)"/></td>
        <td><span class="camposss" style="color:white; margin-left:10px">Residente de:</span></td>
        <td colspan="3">
		<input id="n_resde" name="n_resde" class="camposss" type="checkbox"  value="1">
        <input id="per_natural" name="per_natural" type="hidden" value="N"/>
        </td>
    </tr>
    </table>
    </form>