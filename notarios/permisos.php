<?php 
session_start();

include('conexion.php');
$sql=mysql_query("SELECT * FROM libros order by id_lib desc LIMIT 1",$conn)  or die(mysql_error());
$row = mysql_fetch_array($sql);

$numero=$row['id_lib'];
$suma= $numero + 1;
$cantidad= strlen($suma);
							 switch ($cantidad) {
							case "1":
		 					$correlativo="00000".$suma;
							break;
							case "2":
								$correlativo="0000".$suma;	
							break;
							case "3":
							$correlativo="000".$suma;
							break;
							case "4":
								$correlativo="00".$suma;	
							break;
							case "5":
							$correlativo="0".$suma;
							break;
							case "6":
								$correlativo=$suma;	
							break;
							
						}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Libros</title>
<script language="JavaScript" type="text/javascript" src="ajax.js"></script>
<style type="text/css">
<!--
.Estilo1 {color: #000033}
.Estilo2 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 16px;
}
.Estilo10 {color: #333333; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; }
.Estilo11 {color: #333333}
.Estilo12 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.Estilo14 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; }
.Estilo16 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; }
-->
</style>
</head>

<body>
<form id="formulario" name="formulario" method="post" action="grabalibros.php">

<table width="772" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
<th height="28" colspan="11" align="right" scope="col"><div align="left" class="Estilo1 Estilo2">Permisos de Viaje</div></th>
    </tr>
    <tr>
<td width="70" height="30" align="right" class="Estilo10">Control</td>
      <td width="42">&nbsp;</td>
      <td width="154"><label>
        <input type="text" name="codigo" id="codigo" readonly="readonly" value="<?php echo $correlativo; ?>" />
      </label></td>
      <td width="42">&nbsp;</td>
      <td width="126" align="right" class="Estilo10"><span class="Estilo11 Estilo12">Responsable</span></td>
      <td width="11" align="left" class="Estilo10">&nbsp;</td>
      <td colspan="5" align="left" class="Estilo10"><input type="text" name="usuario" id="usuario" value="<?php echo "".$_SESSION["nombre"].""; ?>" readonly="readonly" /></td>
    </tr>
    <tr>
      <td height="28" align="right"><span class="Estilo10">Fecha de ingreso</span></td>
      <td>&nbsp;</td>
      <td><label></label>
      <input name="fecha_indi" type="text" readonly="readonly" value="<?php echo date("d/m/Y") ?>" style="font-family:Calibri; font-size:12px; color:#666666;" maxlength="10" /></td>
      <td width="42">&nbsp;</td>
      <td align="right" class="Estilo10">Tipo de Permiso</td>
      <td align="center" valign="top" class="Estilo10">&nbsp;</td>
      <td width="23" align="center" class="Estilo10"><label>
        <input type="radio" name="radio" id="radio" value="radio" />
      </label></td>
      <td width="49" align="center" class="Estilo10">Interior</td>
      <td width="63" align="center" class="Estilo10">&nbsp;</td>
      <td width="20" align="center" class="Estilo10"><input type="radio" name="radio" id="radio2" value="radio" /></td>
      <td width="172" align="center" class="Estilo10"><div align="left">Exterior</div></td>
    </tr>
    <tr>
      <td height="19" align="right">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td width="42">&nbsp;</td>
      <td colspan="7" align="center" valign="top" class="Estilo10">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="11" align="right"><table width="743" border="0" align="left" cellpadding="0" cellspacing="0">
        <tr>
          <th width="91" height="33" scope="col"><div align="left" class="Estilo14">Referencia:</div></th>
          <th width="12" scope="col">&nbsp;</th>
          <th width="640" scope="col"><div align="left">
            <input name="textfield" type="text" id="textfield" size="50" />
          </div></th>
        </tr>
        <tr>
          <td height="31" colspan="3" align="left"><img src="imagenes/btn.jpg" width="500" height="46" /></td>
          </tr>

        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table></td>
    </tr>
    
    <tr>
      <td height="28" align="right">&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="9"><label>
        <input type="submit" name="bt1" id="bt1" value="Grabar" />
        <input type="submit" name="bt2" id="bt2" value="Cancelar" />
      </label></td>
    </tr>
  </table>
</form>
</body>
</html>
