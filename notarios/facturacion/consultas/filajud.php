   <?php
  
   include("../../extraprotocolares/view/funciones.php");
	
   $conexion = Conectar(); 
  	
   $doic = $_REQUEST['doic'];
   $sdoic = $_REQUEST['sdoic'];
   
   $sql_tipdocumento = "SELECT
						 tipodocumento.idtipdoc,
						 tipodocumento.codtipdoc,
						 tipodocumento.destipdoc
						 FROM
						 tipodocumento";		
					  
	$exe_tipdocumento = mysql_query($sql_tipdocumento, $conexion);
	
	$i=0;
	
	
   
   ?>
   <form id="frm_juridica" name="frm_juridica"/>    
   <table width="520" style="width:500px;" border="1">
   <tr height="35">
        <td width="111"><span class="camposss" style="color:white">Razón Social:</span></td>
        <td colspan="3"><input id="razon" name="razon" type="text" class="camposss" style="width:345px; height:14px; text-transform:uppercase" maxlength="80" onkeyup="cambiarazon();"/><input id="n_razon" name="n_razon" type="hidden" class="camposss" style="width:345px; height:14px; text-transform:uppercase" maxlength="80"/><span style="color:red; margin-left:5px">(*)</span></td>
    </tr>
    <tr height="35">
        <td><span class="camposss" style="color:white;">Dirección:</span></td>
        <td colspan="3"><input id="fiscal" name="fiscal" type="text" class="camposss" style="width:345px; height:14px; text-transform:uppercase" maxlength="80" onkeyup="cambiardireccionj();"/><input id="n_fiscal" name="n_fiscal" type="hidden" class="camposss" style="width:345px; height:14px; text-transform:uppercase" maxlength="80"/></td>
    </tr>
    <tr height="35">
        <td><span class="camposss" style="color:white">Email:</span></td>
        <td colspan="3"><input id="n_mail" name="n_mail" type="text" class="camposss" style="width:345px; height:14px" maxlength="50"/></td>
    </tr>
   <tr height="35">
        <td width="111" height="25"><span class="camposss" style="color:white">Telf. de oficina:</span></td>
  <td width="126"><input id="n_teleofi" name="n_teleofi" type="text" class="camposss" style="width:100px; height:14px" maxlength="7" onkeypress="return isNumberKey(event);"/></td>
        <td width="106"><span class="camposss" style="color:white; ">Celular:</span></td>
        <td width="129"><input id="n_celj" name="n_celj" type="text" class="camposss" style="width:100px; height:14px" maxlength="9" onkeypress="return isNumberKey(event);"/></td>
    </tr>  
	<tr height="35">
    	<td><span class="camposss" style="color:white">Tipo Documento:</span></td>
        <td>
        	<select id="n_tipdocu" name="n_tipdocu" type="text" class="camposss" style="width:105px" onchange="cambiar_doic('n_doicj', this.value)">
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
            <span style="color:red; margin-left:5px">(*)</span>
        </td>
        <td><span class="camposss" style="color:white;">RUC:</span></td>
        <td><input id="n_doicj" name="n_doicj" type="text" class="camposss" style="width:100px; height:14px" onkeypress="return isNumberKey(event);" value="<?php echo $doic; ?>"/><span style="color:red; margin-left:5px">(*)</span></td>
    </tr>
    <tr height="35">
        <td><span class="camposss" style="color:white">Fec. Constitución:</span></td>
        <td><input id="n_feccons" name="n_feccons" type="text" style="width:100px; height:14px" maxlength="20" readonly="readonly"/>
        <input id="per_juridica" name="per_juridica" type="hidden" value="J"/></td>
        <td></td>
        <td></td>
    </tr>
    <tr height="35">
        <td><span class="camposss" style="color:white;">Ubigeo:</span></td>
        <td colspan="3"><input id="n_ubigeoj" name="n_ubigeoj" type="text" class="camposss" style="width:300px; height:14px; text-transform:uppercase;"  maxlength="20"/><span style="color:red; margin-left:5px">(*)</span>
        <input id="n_idubigeoj" name="n_idubigeoj" type="hidden"/></td>
    </tr>

    </table>
    </form>