<table  width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="33"><span class="camposss">Remitente:</span></td>
    <td colspan="3"><input name="remitente2" type="text" id="remitente2" style="text-transform:uppercase" size="60" onkeypress="return tabulador(this, event);return soloLetrasynumeros(event)" onKeyUp="remitente1();" maxlength="400" value="<?php  $textonombre=str_replace("?","'",$row['nombre']);
		 $textoampnombre=str_replace("*","&",$textonombre);
		 echo strtoupper($textoampnombre);
 ?>"/> 
      <input type="hidden" name="remitente" id="remitente" value="<?php echo $row['nombre'];?>" ></td>
  </tr>
  <tr>
    <td><span class="camposss">Direccion:</span></td>
    <td colspan="3"><input name="direccion_remi1" style="text-transform:uppercase" type="text" id="direccion_remi1" size="60" onkeypress="return tabulador(this, event);return soloLetrasynumeros(event)"  onKeyUp="direccion_remi2();" maxlength="300" value="<?php  $textordir=str_replace("?","'",$row['direccion']);
		 $textoamperdir=str_replace("*","&",$textordir);
		 echo strtoupper($textoamperdir);
 ?>"/>
      <input type="hidden" name="direccion_remi" id="direccion_remi" value="<?php  echo $row['direccion'];
		 
 ?>" ></td>
  </tr>
</table>

