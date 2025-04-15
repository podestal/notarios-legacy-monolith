<?php
	require_once('conexion.php');
	
	$query_moneda = "Select * from monedas";
	$moneda = mysql_query($query_moneda,$conn);
	$row_moneda = mysql_fetch_array($moneda);
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
</head>

<body>
<form action="" method="post">
<table width="274" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="72" height="31">Descripcion</td>
    <td width="202"><label>
      <input type="text" name="descrip" id="descrip" />
    </label></td>
  </tr>
  <tr>
    <td height="32">Simbolo</td>
    <td><label>
      <input type="text" name="simbolo" id="simbolo" />
    </label></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><label>
      <input type="submit" name="submit" id="submit" value="Grabar" />
    </label></td>
  </tr>
</table>
<p>&nbsp;</p>
<table width="200" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>ID</td>
    <td>Descripcion</td>
    <td>Simbolo</td>
    </tr>
  <tr>
  <?php
  		do{
			$id = $row_moneda['idmon'];
			$descrip = $row_moneda['desmon'];
			$simbolo = $row_moneda['simbolo'];
  ?>
    <td><?php echo $id; ?></td>
    <td><?php echo $descrip; ?></td>
    <td><?php echo $simbolo; ?></td>
   <?php
   		}while($row_moneda = mysql_fetch_array($moneda));
   ?>
  </tr>
</table>
<p>&nbsp;</p>
</form>
</body>
</html>
