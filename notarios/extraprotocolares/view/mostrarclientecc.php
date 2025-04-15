<table width="100%">
        <tr>
          <td width="8%"><span class="camposss">Solicitante:</span></td>
          <td colspan="3"><input name="nombre" type="text" id="nombre" style="text-transform:uppercase" value="<?php echo $row['nombre']; ?>" size="60" maxlength="400" onkeypress="return soloLetras(event)"/>
            </td>
          </tr>
        
        <tr>
          <td><span class="camposss">Domicilio:</span> </td>
          <td colspan="3"><input name="direccion" type="text" id="direccion" style="text-transform:uppercase" value="<?php echo $row['direccion']; ?>" size="60" maxlength="2000" /></td>
        </tr>
        <tr>
          <td><span class="camposss">Distrito:</span></td>
          <td colspan="3"><?php /*
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT ubigeo.coddis AS 'id', CONCAT(ubigeo.nomdis,'/', ubigeo.nomprov,'/',ubigeo.nomdpto)  AS 'descripcion' FROM ubigeo
ORDER BY ubigeo.nomdis ASC
"; 
			$oCombo->value      = "id";
			$oCombo->text       = "descripcion";
			$oCombo->size       = "150"; 
			$oCombo->name       = "distrito_solic";
			$oCombo->style      = "camposss"; 
			$oCombo->click      = "//selectzona(this.value);";   
			$oCombo->selected   =  $rowpart['ubigeo'];
			$oCombo->Show();
			$oCombo->oDesCon(); */
?>
            <span class="camposss">
            <input name="distrito_solic" type="hidden" id="distrito_solic" value="<?php echo $row['ubigeo']; ?>" size="15" />
            </span>
            <?php 
		  
		  $consulubigeo= mysql_query("SELECT * FROM ubigeo where coddis like '%".$row['idubigeo']."%'", $conn) or die(mysql_error());
		  $rowubbi=mysql_fetch_array($consulubigeo);
        
		  
		  ?><div id="buscaubi" style="position:absolute; display:none; width:637px; height:223px; left: 28px; top: 335px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
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
          </div>
            <table width="522" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="428"><input name="ubigen" type="text" id="ubigen" value="<?php echo $rowubbi['nomdpto']."/".$rowubbi['nomprov']."/".$rowubbi['nomdis']; ?>"  size="60" onKeyUp="return validacion4(this)"  disabled/></td>
                <td width="94"><a href="#" onclick="mostrar_desc('buscaubi')"><img src="../../iconos/seleccionar.png" width="94" height="29" border="0" /></a></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td><span class="camposss">Estado civil:</span></td>
          <td colspan="3"><?php 

			
			echo "<select name='ecivil' id='ecivil' onchange='selectAsunto(this.value);' style='width:100px'>";
			$combo10 = mysql_query( "SELECT tipoestacivil.idestcivil AS 'id', tipoestacivil.desestcivil AS 'des'
FROM tipoestacivil
where tipoestacivil.idestcivil='".$row['idestcivil']."'
ORDER BY tipoestacivil.desestcivil ASC",$conn);
			while ($rs10=mysql_fetch_assoc($combo10)){
			if($rs10['id']==$row['idestcivil']){
				echo "<option value='".$rs10['id']."' selected='selected'>".$rs10['des']."</option>";
			}
			echo "<option value='".$rs10['id']."'>".$rs10['des']."</option>";
			}
			echo "</select>";	
?></td>
</tr>
</table>