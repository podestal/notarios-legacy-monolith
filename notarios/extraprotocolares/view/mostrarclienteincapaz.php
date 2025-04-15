<?php 
require_once("../../includes/combo.php")  	  ;
?>
        <table>
<tr>
<td colspan="5"><input name="nrepresentante" type="text" id="nrepresentante" style="text-transform:uppercase" size="80" maxlength="500" placeholder="nombre y apellido del representado" onkeypress="return tabulador(this, event);return soloLetras(event)"  value="<?php echo $row['nombre'];?>"/>
          
          </td>
          </tr>
       
        <tr>
          <td colspan="6"><span class="camposss">y declara bajo responsabilidad que el(la) incapaz es el(la) titular del documento con el que se ha presentado, y que sus datos personales son:</span></td>
          </tr>
        <tr>
          <td><span class="camposss">Nacionalidad:</span></td>
          <td colspan="2"><?php 
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT nacionalidades.idnacionalidad AS 'id', nacionalidades.descripcion AS 'des'
FROM nacionalidades
ORDER BY nacionalidades.desnacionalidad ASC "; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "150"; 
			$oCombo->name       = "nacionalidad";
			$oCombo->style      = "camposss"; 
			$oCombo->click      = "//selectAsunto(this.value);";   
			$oCombo->selected   =  $row['nacionalidad'];
			$oCombo->Show();
			$oCombo->oDesCon(); 
?>          </td>
          <td align="right"><span class="camposss">Estado civil</span></td>
          <td><?php 
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT tipoestacivil.idestcivil AS 'id', tipoestacivil.desestcivil AS 'des'
FROM tipoestacivil
ORDER BY tipoestacivil.desestcivil ASC "; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "200"; 
			$oCombo->name       = "ecivil";
			$oCombo->style      = "camposss"; 
			$oCombo->click      = "//selectAsunto(this.value);";   
			$oCombo->selected   =  $row['idestcivil'];
			$oCombo->Show();
			$oCombo->oDesCon();
?>          </td>
          <td>&nbsp;</td>
          </tr>
        <tr>
          <td><span class="camposss">Domiciliado:</span></td>
          <td colspan="5"><input name="direccion" type="text" id="direccion" style="text-transform:uppercase" size="100" maxlength="3000" placeholder="direccion" onkeypress="return tabulador(this, event);" onKeyUp="direccion();"  value="<?php echo $row['direccion'];?>"/>
         
          </td>
          </tr>
          <tr>
          	<td><span class="camposss">Partida electronica:</span></td>
              <td colspan="5"><input name="pelectronica" type="text" id="pelectronica" style="text-transform:uppercase" onkeypress="return tabulador(this, event);" size="50"/>
          
          </td>
          </tr>
        <tr>
          <td><span class="camposss">Zona:</span></td>
          <td colspan="5">
           
         
            <table width="522" border="0" cellspacing="0" cellpadding="0">
            
            
      <?php 
		  
		  $sql1=mysql_query("select coddis,concat(nomdis,' ',nomprov,' ',nomdpto) as descripcion from ubigeo where coddis='".$row['idubigeo']."'",$conn);
		$res=mysql_fetch_assoc($sql1);
		  
		  ?>
          
          
              <tr>
                <td width="428"><input name="ubigen" type="text" id="ubigen" size="60" onKeyUp="return validacion4(this)"  value="<?php echo $res['descripcion'];?>"/></td>
				<td width="105"><input name="idzona" type="hidden" id="idzona" size="15" value="<?php echo $res['coddis'];?>"/>
                <td width="94"><a href="#" onclick="mostrar_desc('buscaubi')"><img src="../../iconos/seleccionar.png" alt="" width="94" height="29" border="0" /></a></td>
              </tr>
            </table><div id="buscaubi" style="position:absolute; display:none; width:637px; height:223px; left: 67px; top: 346px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
              <table width="637" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="24" height="29">&nbsp;</td>
                  <td width="585" class="camposss">Seleccionar Zona:</td>
                  <td width="28"><a href="#" onclick="ocultar_desc('buscaubi')"><img src="../../iconos/cerrar.png" width="21" height="20" border="0" /></a></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td><label>
                    <input name="_buscaubi" style="text-transform:uppercase; background:#FFF;" type="text" id="_buscaubi" size="65" onkeypress="buscaubigeos()" />
                  </label></td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td><div id="resulubi" style="width:585px; height:150px; overflow:auto"></div></td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
              </table>
          </div></td>
        </tr>
        
          
</table>