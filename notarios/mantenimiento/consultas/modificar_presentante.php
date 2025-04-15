	<link rel="stylesheet" href="../../stylesglobal.css">	  

<?php

	include("../../extraprotocolares/view/funciones.php");
    
    $conexion = Conectar();
	
	$idPresentante = $_REQUEST['idPresentante'];
	
	$sql =    "SELECT * FROM presentante WHERE idPresentante='$idPresentante'";
						
	 $exe_nabogado = mysql_query($sql, $conexion);
						
	 $data = mysql_fetch_array($exe_nabogado);

	
	?>
     
    <form id="frm_mpresentante" name="frm_mpresentante" style="width:100%"/ onsubmit="return false;">
    <table width="584" height="320" cellpadding="0" cellspacing="0">
        <tr height="35" style="background-color:#264965">
            <td colspan="6" align="center"><span class='submenutitu' style="font-size:14px">Modificar Presentante</span></td>
        </tr>
        <tr>
       <th align="right" width="30%"><span class="titubuskar0">DNI:</span></th>
    <td colspan="3"><span class=""><input type="text" maxlength="8" value="<?php echo $data['numeroDocumento']; ?>" size="10"  class="Estilo7"  style="background-color:#FFFFFF;text-transform:uppercase; font-family:Verdana, Geneva, sans-serif; font-size:11px;" name="dni"  id="txtDni"/></span><span style="color:red; margin-left:5px">(*)</span>
      <input type="text" name="" id="txtImgCaptcha" size="5"  maxlength="4">
      <img src="../../reniec_sunat/generate_captcha_reniec.php" width="100" height="31">
      <button id="btnBuscarDniReniec" onClick="buscarDniReniec()" >Buscar DNI</button>
    </td>
    
  </tr>
  <tr>
    <th align="right" width="30%"><span class="titubuskar0">Apellido Paterno:</span></th>
    <td colspan="3"><span class=""><input type="text" value="<?php echo $data['apellidoPaterno']; ?>" size="50" class="Estilo7"  style="background-color:#FFFFFF;text-transform:uppercase; font-family:Verdana, Geneva, sans-serif; font-size:11px;" name="apellidoPaterno" id="txtApellidoPaterno"/></span><span style="color:red; margin-left:5px">(*)</span></td>
    
  </tr>

  <tr>
    <th align="right" width="30%"><span class="titubuskar0">Apellido Materno: </span></th>
    <td colspan="3"><span class=""><input type="text" value="<?php echo $data['apellidoMaterno']; ?>" size="30" class="Estilo7"  style="background-color:#FFFFFF;text-transform:uppercase; font-family:Verdana, Geneva, sans-serif; font-size:11px;" name="apellidoMaterno" id="txtApellidoMaterno"/></span><span style="color:red; margin-left:5px">(*)</span></td>
    
  </tr>

  <tr>
    <th align="right"><span class="titubuskar0">Primer Nombre:</span></th>
    <td width="35%"><span class=""><input type="text" value="<?php echo $data['primerNombre']; ?>" size="10" class="Estilo7"   style="background-color:#FFFFFF;text-transform:uppercase; font-family:Verdana, Geneva, sans-serif; font-size:11px;" name="primerNombre" id="txtPrimerNombre"/></span><span style="color:red; margin-left:5px">(*)</span></td>
    
    <td width="22%" align="right"><strong>Segundo Nombre:</strong></td>
    <td width="22%"><input type="text" value="<?php echo $data['segundoNombre']; ?>" size="10" class="Estilo7"  style="background-color:#FFFFFF;text-transform:uppercase; font-family:Verdana, Geneva, sans-serif; font-size:11px;" name="segundoNombre" id="txtSegundoNombre"/></td>

    
    
  </tr>

   <tr>
    <th align="right" width="30%"><span class="titubuskar0">Tercer Nombre: </span></th>
    <td colspan="3"><span class=""><input type="text" value="<?php echo $data['tercerNombre']; ?>" size="10" class="Estilo7"  style="background-color:#FFFFFF;text-transform:uppercase; font-family:Verdana, Geneva, sans-serif; font-size:11px;" name="tercerNombre" id="txtTercerNombre"/></span></td>
    
  </tr>
        
      <tr height="40">
			<td colspan="6" align="center"><input type="button" value="Modificar" class="Estilo7" style="width:70px" onClick="actualizar_presentante('<?php echo $idPresentante; ?>')"/></td>
        </tr>
        
    </table>
    </form>

	<span class='submenutitu' style="position:relative; top:-315px; left:560px; cursor:pointer; font-size:14px" title="Cerrar" onClick="cerrar_mpresentante()">x</span></div>
     <span style="color:red; font-size:8px; position:relative; left:429px; top:-30px">(*)Campos Obligatorios</span>