
<!-- aca empieza la webada-->
	<table>
        <tr>
          <td width="146"><span class="camposss">Cliente</span></td>
          <td><input name="representacion" type="text" id="representacion"  style="text-transform:uppercase" size="84" maxlength="400" value="<?php echo $row['prinom'].' '.$row['segnom'].' '.$row['apepat'].' '.$row['apemat'];?>" />
          
            </td>
        </tr>
      
     <tr>
          <td><span class="camposss">Nro de partida <br />
Electronica:</span></td>
          <td colspan="5"><input name="poder_inscrito" type="text" id="poder_inscrito" style="text-transform:uppercase" size="84" maxlength="400"  onKeyUp="return validacion3(this)" value="<?php echo $row['numpartida'];?>" /></td>
          </tr>
        <tr>
</table>
