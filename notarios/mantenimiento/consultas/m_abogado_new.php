	<link rel="stylesheet" href="../../stylesglobal.css">	  

<?php

	include("../../extraprotocolares/view/funciones.php");
    
    $conexion = Conectar();
	
	$idabogado = $_REQUEST['idabogado'];
	
	$sql_nabogado =    "SELECT * FROM tb_abogado WHERE idabogado='$idabogado'";
						
	 $exe_nabogado = mysql_query($sql_nabogado, $conexion);
						
	 $abogado = mysql_fetch_array($exe_nabogado);

	
	?>
    <form id="frm_mabogado" name="frm_mabogado" style="width:100%"/>
    <table width="584" height="320" cellpadding="0" cellspacing="0">
        <tr height="35" style="background-color:#264965">
            <td colspan="6" align="center"><span class='submenutitu' style="font-size:14px">Modificar Abogado</span></td>
        </tr>
        <tr>
  	<th width="21%" align="right"><span class="titubuskar0">Nombre: </span></th>
    <td colspan="3"><input name="razonsocial" type="text" class="Estilo7" id="razonsocial" style="background-color:#FFFFFF;text-transform:uppercase; font-family:Verdana, Geneva, sans-serif; font-size:11px;" value="<?php echo $abogado['razonsocial']?>" size="50"/><span style="color:red; margin-left:5px">(*)</span></td>
    
  </tr>
  <tr>
  	<th align="right"><span class="titubuskar0">Direccion:</span></th>
    <td colspan="3"><span class=""><input type="text" size="50" class="Estilo7"  style="background-color:#FFFFFF;text-transform:uppercase; font-family:Verdana, Geneva, sans-serif; font-size:11px;" name="direccion" id="direccion" value="<?php echo $abogado['direccion']?>"/></span></td>
    
  </tr>
  <tr>
  	<th align="right"><span class="titubuskar0">Telefonos:</span></th>
    <td width="35%"><span class=""><input type="text" size="30" class="Estilo7"  style="background-color:#FFFFFF;text-transform:uppercase; font-family:Verdana, Geneva, sans-serif; font-size:11px;" name="telefono" id="telefono" value="<?php echo $abogado['telefono']?>"/></span></td>
    <td width="22%" align="right"><strong>Documento:</strong></td>
    <td width="22%"><input type="text" size="30" class="Estilo7"  style="background-color:#FFFFFF;text-transform:uppercase; font-family:Verdana, Geneva, sans-serif; font-size:11px;" name="documento" id="documento" value="<?php echo $abogado['documento']?>"/></td>
    
  </tr>
  
  <tr>
  	<th align="right"><span class="titubuskar0">Fax: </span></th>
    <td colspan="3"><span class=""><input type="text" size="30" class="Estilo7"  style="background-color:#FFFFFF;text-transform:uppercase; font-family:Verdana, Geneva, sans-serif; font-size:11px;" name="fax" id="fax" value="<?php echo $abogado['fax']?>"/></span></td>
    
  </tr>
    
  <tr>
  	<th align="right"><span class="titubuskar0">Matricula: </span></th>
    <td><span class=""><input type="text" size="20" class="Estilo7" style="background-color:#FFFFFF;text-transform:uppercase; font-family:Verdana, Geneva, sans-serif; font-size:11px;" name="matricula" id="matricula" value="<?php echo $abogado['matricula']?>"/></span></td>
    <td align="right"><span class="titubuskar0"><strong>Sede Colegio:</strong></span></td>
    <td><input type="text" size="20" class="Estilo7" style="background-color:#FFFFFF;text-transform:uppercase; font-family:Verdana, Geneva, sans-serif; font-size:11px;" name="sede_colegio" id="sede_colegio" value="<?php echo $abogado['sede_colegio']?>"/></td>
    
  </tr>

        
      <tr height="40">
			<td colspan="6" align="center"><input type="button" value="Modificar" class="Estilo7" style="width:70px" onClick="mod_impedido('<?php echo $idabogado; ?>')"/></td>
        </tr>
        
    </table>
    </form>

	<span class='submenutitu' style="position:relative; top:-315px; left:560px; cursor:pointer; font-size:14px" title="Cerrar" onClick="cerrar_mabogado()">x</span></div>
     <span style="color:red; font-size:8px; position:relative; left:429px; top:-30px">(*)Campos Obligatorios</span>