<?php 
include("conexion.php");
$codigo=$_POST['idusu'];

$consulta=mysql_query("SELECT * from usuarios where idusuario='$codigo'", $conn) or die(mysql_error());

$row = mysql_fetch_array($consulta);

$sql=mysql_query("SELECT * FROM cargousu",$conn);
$sql2=mysql_query("SELECT * FROM ubigeo",$conn);

?>

<form id="frmeditusu" name="frmeditusu" method="post" action="grabar_editusu.php">
  <table width="305" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="38" colspan="2"><span class="editcam">Editar Usuario
        <label>
        <input type="hidden" name="idusuario" value="<?php echo $row['idusuario']; ?>" id="idusuario" />
        </label>
      </span></td>
    </tr>
    <tr>
      <td width="108" height="25"><span class="editcampp">Usuario : </span></td>
      <td width="197" height="25"><input name="loginusuario" type="text" id="loginusuario" style="background:#FFFFFF; text-transform:uppercase; " value="<?php echo $row['loginusuario']; ?>" maxlength="30" readonly="readonly" /></td>
    </tr>
    <tr>
      <td height="25"><span class="editcampp">Ape. Paterno : </span></td>
      <td height="25"><input name="apepat" type="text" id="apepat" style="background:#FFFFFF; text-transform:uppercase; border:#CCCCCC;" value="<?php echo $row['apepat']; ?>" maxlength="100" onkeypress="return soloLetras(event)" /></td>
    </tr>
    <tr>
      <td height="25"><span class="editcampp">Ape. Materno : </span></td>
      <td height="25"><input name="apemat" type="text" id="apemat" style="background:#FFFFFF;text-transform:uppercase;" value="<?php echo $row['apemat']; ?>" maxlength="100" onkeypress="return soloLetras(event)" /></td>
    </tr>
    <tr>
      <td height="25"><span class="editcampp">1º Nombre</span><span class="editcampos"> : </span></td>
      <td height="25"><input name="prinom" type="text" id="prinom" style="background:#FFFFFF;text-transform:uppercase;" value="<?php echo $row['prinom']; ?>" maxlength="100" onkeypress="return soloLetras(event)" /></td>
    </tr>
    <tr>
      <td height="25"><span class="editcampp">2º Nombre : </span></td>
      <td height="25"><input name="segnom" type="text" id="segnom" style="background:#FFFFFF;text-transform:uppercase" value="<?php echo $row['segnom']; ?>" maxlength="100" onkeypress="return soloLetras(event)"/></td>
    </tr>
    <tr>
      <td height="25"><span class="editcampp">Fecha de Naci. : </span></td>
      <td height="25"><input name="fecnac" value="<?php echo $row['fecnac']; ?>" style="background:#FFFFFF" type="text" id="fecnac" size="12" class="tcal" maxlength="10" onkeypress="return validar(event)" /></td>
    </tr>
    <tr>
      <td height="25"><span class="editcampp">Domicilio :</span></td>
      <td height="25"><input  name="domicilio" type="text" id="domicilio" style="background:#FFFFFF; text-transform:uppercase" value="<?php echo $row['domicilio']; ?>" maxlength="100" onkeypress="return soloLetras(event)"/></td>
    </tr>
    <tr>
      <td height="25"><span class="editcampp">Teléfono : </span></td>
      <td height="25"><input name="telefono" type="text" id="telefono" style="background:#FFFFFF" value="<?php echo $row['telefono']; ?>" size="15" maxlength="15" onkeypress="return validar(event)" /></td>
    </tr>
    <tr>
      <td height="25"><span class="editcampp">Cargo : </span></td>
      <td height="25"><select name="idcargo" id="idcargo">
      <?php 
	  
	  
	  $car=$row['idcargo'];
	  //echo $row6['descargo'];
	  if ($row['idcargo']=='1'){
		  
		  echo"<option value='1' selected='selected'>ADMINISTRADOR</option><br><option value='2'>EMPLEADO(A)</option>";
		  }
	  elseif($row['idcargo']=='2'){
		  echo"<option value='2' selected='selected'>EMPLEADO(A)</option><br><option value='1'>ADMINISTRADOR</option>";
		  
		  }

	   ?>
      </select></td>
    </tr>
    <tr>
      <td height="25"><span class="editcampp">DNI : </span></td>
      <td height="25"><input name="dni" type="text" id="dni" style="background:#FFFFFF" value="<?php echo $row['dni']; ?>" size="15" maxlength="15" onkeypress="return validar(event)" /></td>
    </tr>
    <tr>
      <td height="31">&nbsp;</td>
      <td height="31"><label>
        <input type="submit" name="button" id="button" value="Grabar" />
      </label></td>
    </tr>
  </table>
</form>
