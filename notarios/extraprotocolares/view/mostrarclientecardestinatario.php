<table  width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="33"><span class="camposss">Nombre:</span></td>
    <td colspan="3"><input name="destinatario2" type="text" id="destinatario2" style="text-transform:uppercase" size="60" onkeypress="return tabulador(this, event);return soloLetrasynumeros(event)" onKeyUp="destinatario1();" maxlength="400" value="<?php  $textonombre=str_replace("?","'",$row['nombre']);
		 $textoampnombre=str_replace("*","&",$textonombre);
		 echo strtoupper($textoampnombre);
 ?>"/> 
      <input type="hidden" name="remitente" id="remitente" value="<?php echo $row['nombre'];?>" ></td>
  </tr>
  <tr>
    <td><span class="camposss">Dir. Destino:</span></td>
    <td colspan="3"><input name="dirdestino2" style="text-transform:uppercase" type="text" id="dirdestino2" size="60" onkeypress="return tabulador(this, event);return soloLetrasynumeros(event)"  onKeyUp="dirdestinatario1();" maxlength="300" value="<?php  $textordir=str_replace("?","'",$row['direccion']);
		 $textoamperdir=str_replace("*","&",$textordir);
		 echo strtoupper($textoamperdir);
 ?>"/>
      <input type="hidden" name="direccion_remi" id="direccion_remi" value="<?php  echo $row['direccion'];
		 
 ?>" ></td>
  </tr>
</table>

