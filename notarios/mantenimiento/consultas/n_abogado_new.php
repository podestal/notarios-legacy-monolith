	<link rel="stylesheet" href="../../stylesglobal.css">	  
<?php

	include("../../extraprotocolares/view/funciones.php");
    
    $conexion = Conectar();
	
	$sql_idcli = "SELECT idabogado FROM tb_abogado ORDER BY CAST(tb_abogado.idabogado AS SIGNED) DESC";
	
	$exe_idcli = mysql_query($sql_idcli, $conexion);
	
	$row_lastcli = mysql_fetch_array($exe_idcli);
		
	$id_cli = $row_lastcli[0]+1;
	
	$idabogado = correlativo_numero10($id_cli); 
	?>


    <form id="frm_nabogado" name="frm_nabogado" style="width:100%"/>
    <table width="584" height="320" cellpadding="0" cellspacing="0">
        <tr height="35" style="background-color:#264965">
            <td colspan="6" align="center"><span class='submenutitu' style="font-size:14px">Nuevo Abogado</span></td>
        </tr>
        <tr>
  	<th width="21%" align="right"><span class="titubuskar0">Nombre: </span></th>
    <td colspan="3"><input type="text" size="50" class="Estilo7" style="background-color:#FFFFFF;text-transform:uppercase; font-family:Verdana, Geneva, sans-serif; font-size:11px;" name="razonsocial" id="razonsocial"/><span style="color:red; margin-left:5px">(*)</span></td>
    
  </tr>
  <tr>
  	<th align="right"><span class="titubuskar0">Direccion:</span></th>
    <td colspan="3"><span class=""><input type="text" size="50" class="Estilo7"  style="background-color:#FFFFFF;text-transform:uppercase; font-family:Verdana, Geneva, sans-serif; font-size:11px;" name="direccion" id="direccion"/></span></td>
    
  </tr>
  <tr>
  	<th align="right"><span class="titubuskar0">Telefonos:</span></th>
    <td width="35%"><span class=""><input type="text" size="30" class="Estilo7"  style="background-color:#FFFFFF;text-transform:uppercase; font-family:Verdana, Geneva, sans-serif; font-size:11px;" name="telefono" id="telefono"/></span></td>
    <td width="22%" align="right"><strong>Documento:</strong></td>
    <td width="22%"><input type="text" size="30" class="Estilo7"  style="background-color:#FFFFFF;text-transform:uppercase; font-family:Verdana, Geneva, sans-serif; font-size:11px;" name="documento" id="documento"/></td>
    
  </tr>
  
  <tr>
  	<th align="right"><span class="titubuskar0">Fax: </span></th>
    <td colspan="3"><span class=""><input type="text" size="30" class="Estilo7"  style="background-color:#FFFFFF;text-transform:uppercase; font-family:Verdana, Geneva, sans-serif; font-size:11px;" name="fax" id="fax"/></span></td>
    
  </tr>
    
  <tr>
  	<th align="right"><span class="titubuskar0">Matricula: </span></th>
    <td><span class=""><input type="text" size="20" class="Estilo7" style="background-color:#FFFFFF;text-transform:uppercase; font-family:Verdana, Geneva, sans-serif; font-size:11px;" name="matricula" id="matricula"/></span></td>
    <td align="right"><span class="titubuskar0"><strong>Sede Colegio:</strong></span></td>
    <td><input type="text" size="20" class="Estilo7" style="background-color:#FFFFFF;text-transform:uppercase; font-family:Verdana, Geneva, sans-serif; font-size:11px;" name="sede_colegio" id="sede_colegio"/></td>
    
  </tr>

        
      <tr height="40">
			<td colspan="6" align="center">
            	<input type="button" value="Grabar" onClick="registrar_abogado()" class="Estilo7" tabindex="13" />
            </td>
        </tr>
        
    </table>
    </form>

	<span class='submenutitu' style="position:relative; top:-315px; left:560px; cursor:pointer; font-size:14px" title="Cerrar" onClick="cerrar_nabogado()">x</span></div>
     <span style="color:red; font-size:8px; position:relative; left:429px; top:-30px">(*)Campos Obligatorios</span>