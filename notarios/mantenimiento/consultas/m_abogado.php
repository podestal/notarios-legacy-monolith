	<link rel="stylesheet" href="../../stylesglobal.css">	  

	<?php

	include("../../extraprotocolares/view/funciones.php");
    
    $conexion = Conectar();
	
	$id_servicio = $_REQUEST['id_servicio'];
	
	$sql_nservicio =    "SELECT * FROM estudioabogado WHERE idest='$id_servicio'";
						
	 $exe_nservicio = mysql_query($sql_nservicio, $conexion);
						
	 $servicio = mysql_fetch_array($exe_nservicio);

	
	?>

    <form id="frm_mservicio" name="frm_mservicio" style="width:100%"/>
      <table width="584" height="320" cellpadding="0" cellspacing="0">
        <tr height="35" style="background-color:#264965">
            <td colspan="4" align="center"><span class='submenutitu' style="font-size:14px">Nuevo Abogado Externo</span></td>
        </tr>
        
          <tr>
  	<th width="21%"><span class="titubuskar0">Nombre</span></th>
    <td width="79%"><input type="text" size="50" class="Estilo7" style="background-color:#FFFFFF;text-transform:uppercase; font-family:Verdana, Geneva, sans-serif; font-size:11px;" name="nombremab" id="nombremab" value="<?php echo $servicio['nombre']?>"/></td>
    
  </tr>
  <tr>
  	<th><span class="titubuskar0">Direccion</span></th>
    <td><span class=""><input type="text" size="50" class="Estilo7"  style="background-color:#FFFFFF;text-transform:uppercase; font-family:Verdana, Geneva, sans-serif; font-size:11px;" name="direccionmab" id="direccionmab" value="<?php echo $servicio['direccion']?>"/></span></td>
    
  </tr>
  <tr>
  	<th><span class="titubuskar0">Telefonos</span></th>
    <td><span class=""><input type="text" size="30" class="Estilo7"  style="background-color:#FFFFFF;text-transform:uppercase; font-family:Verdana, Geneva, sans-serif; font-size:11px;" name="telmab" id="telmab" value="<?php echo $servicio['telefono']?>"/></span></td>
    
  </tr>
  
  <tr>
  	<th><span class="titubuskar0">Colegiatura</span></th>
    <td><span class=""><input type="text" size="30" class="Estilo7"  style="background-color:#FFFFFF;text-transform:uppercase; font-family:Verdana, Geneva, sans-serif; font-size:11px;" name="colegmab" id="colegmab" value="<?php echo $servicio['colegiatura']?>"/></span></td>
    
  </tr>
    
  <tr>
  	<th><span class="titubuskar0">Correo</span></th>
    <td><span class=""><input type="text" size="50" class="Estilo7" style="background-color:#FFFFFF;text-transform:uppercase; font-family:Verdana, Geneva, sans-serif; font-size:11px;" name="correomab" id="correomab" value="<?php echo $servicio['correo']?>"/></span></td>
    
  </tr>

        
      <tr height="40">
			<td colspan="4" align="center">
            	<input type="button" value="Modificar" onClick="mod_servicio('<?php echo $servicio['idest'];?>')" class="Estilo7" tabindex="13" />
            </td>
        </tr>
        
    </table>
    </form>

	<span class='submenutitu' style="position:relative; top:-315px; left:560px; cursor:pointer; font-size:14px" title="Cerrar" onClick="cerrar_mservicio()">x</span></div>
    
    <span style="color:red; font-size:8px; position:relative; left:398px; top:-30px">(*)Campos Obligatorios</span>	
