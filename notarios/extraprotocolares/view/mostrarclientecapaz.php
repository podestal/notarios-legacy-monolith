<?php 
require_once("../../includes/combo.php")  	  ;
?>
        <table>
        <tr>
                   
 
          <td colspan="4"><input name="nombre1" type="text" id="nombre1" style="text-transform:uppercase" size="100" maxlength="400" onKeyUp="editnombre();"  onkeypress="return tabulador(this, event);return soloLetras(event)" value="<?php echo $row['nombre']?>" />
          <input type="hidden" name="nombre1" style="text-transform:uppercase" id="nombre1" value="<?php echo $row['nombre']?>" /></td>
          </tr>
        <tr>
          <td colspan="4"><span class="camposss">quien presente ante mi el dia de hoy, manifiesta ser:</span></td>
          </tr>
        <tr>
          <td><span class="camposss">de nacionalidad </span>           </td>
          <td><?php 
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT nacionalidades.idnacionalidad AS 'id', nacionalidades.descripcion AS 'des'
FROM nacionalidades
ORDER BY nacionalidades.desnacionalidad ASC "; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "200"; 
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
?>            </td>
          </tr>
          <tr>
    <td height="30" align="left"><span class="camposss">Prof./Ocupaciòn :</span></td>
    <td height="30" colspan="3"><table width="466" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="254"><label>
          <input name="nomprofesiones" style="text-transform:uppercase"  type="text" id="nomprofesiones" size="40" />
        </label></td>
        <td width="118"><a id="limprofe" href="#" onclick="mostrar_desc('buscaprofe');focusprofe()"><img src="../../iconos/seleccionar.png" width="94" height="29" border="0" /></a>
        
          <td width="94"><div id="buscaprofe" style="position:absolute; display:none; width:637px; height:223px; left: 19px; top: 256px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
            <table width="637" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="24" height="29">&nbsp;</td>
            <td width="585"><strong><span class="camposss">Seleccionar Profesion:</span></strong></td>
            <td width="28"><a href="#" onclick="ocultar_desc('buscaprofe')"><img src="../../iconos/cerrar.png" width="21" height="20" border="0" /></a></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><label>
              <input name="buscaprofes" type="text" id="buscaprofes"  style="background:#FFFFFF; text-transform:uppercase;" size="50" onkeypress="buscaprofesiones()" />
            </label></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><div id="resulprofesiones" style="width:585px; height:150px; overflow:auto"></div></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
  </div>
        
        </td>
      </tr>
    </table></td>
          </tr>
        <tr>
          <td colspan="4"><span class="camposss">y domiciliar en:    </span>
          
          
            <input name="ndireccion" type="text" id="ndireccion" style="text-transform:uppercase" size="84" maxlength="1000" placeholder="direccion" onKeyUp="editdireccion();" value="<?php echo $row['direccion']?>" /><input type="hidden" name="direccion" style="text-transform:uppercase" id="direccion" value="<?php echo $row['direccion']?>"  /></td>
        </tr>
        
        
        
        <tr>
    <td height="30" align="left"><span class="camposss">Zona:</span></td>
    <td height="30" colspan="3"><table width="515" border="0" cellspacing="0" cellpadding="0">
      <tr>
      
      <?php 
		  
		  $sql1=mysql_query("select coddis,concat(nomdis,' ',nomprov,' ',nomdpto) as descripcion from ubigeo where coddis='".$row['idubigeo']."'",$conn);
		$res=mysql_fetch_assoc($sql1);
		  
		  ?>
          
        <td width="360"><input name="ubigen" type="text" id="ubigen" size="60" onKeyUp="return validacion5(this)"  value="<?php echo $res['descripcion'];?>" /></td>
        <td width="105"><input name="idzona" type="hidden" id="idzona" size="15" value="<?php echo $res['coddis'];?>" />
          <a href="#" onclick="mostrar_desc('buscaubi')"><img src="../../iconos/seleccionar.png" width="94" height="29" border="0" /></a>
        <td width="1"><div id="buscaprofe" style="position:absolute; display:none; width:637px; height:223px; left: 36px; top: 305px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
            <table width="637" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="24" height="29">&nbsp;</td>
            <td width="585"><strong><span class="camposss">Seleccionar Profesion:</span></strong></td>
            <td width="28"><a href="#" onclick="ocultar_desc('buscaprofe')"><img src="../../iconos/cerrar.png" width="21" height="20" border="0" /></a></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><label>
              <input name="buscaprofes" type="text" id="buscaprofes"  style="background:#FFFFFF; text-transform:uppercase" size="50" onkeypress="buscaprofesiones()" />
            </label></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><div id="resulprofesiones" style="width:585px; height:150px; overflow:auto"></div></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
  </div>
        
        </td>
      </tr>
    </table></td>
          </tr>
        
        
        <tr>
          <td colspan="4"><table width="522" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td width="428">&nbsp;</td>
                <td width="94"><a href="#" onclick="mostrar_desc('buscaubi')"></a></td>
              </tr>
        </table>



            <div id="buscaubi" style="position:absolute; display:none; width:637px; height:223px; left: 67px; top: 346px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
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