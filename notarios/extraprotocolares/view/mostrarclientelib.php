<?php 
include("../../conexion.php");
	require_once("../../includes/barramenu.php") ;
	require_once("../../includes/gridView.php")  ;
	require_once("../../includes/combo.php")  	  ;
	$oBarra = new BarraMenu() 				  ;
	$Grid1 = new GridView()					  ;
	$oCombo = new CmbList()  				  ;
	
	// 
	$sqlconyuge  = mysql_query("SELECT cliente.nombre FROM cliente WHERE cliente.idcliente = '$row[17]'", $conn) or die(mysql_error());
	$row_conyuge = mysql_fetch_array($sqlconyuge);	
	$conyuge_imprime = $row_conyuge[0];

?>
<table width="674" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="21">&nbsp;</td>
    <td width="653"><table width="647" border="0" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
      <tr  bordercolor="#000000">
        <td height="30"><strong>Condicion</strong></td>
        <td height="30"><strong><?php 

			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT c_condiciones.id_condicion AS 'id', c_condiciones.des_condicion AS 'des' FROM c_condiciones WHERE c_condiciones.Swt_condicion = 'V' ORDER BY des_condicion ASC"; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "120"; 
			$oCombo->name       = "c_condicontrat";
			$oCombo->style      = "camposss"; 
			$oCombo->click      = "fEvalCondicion();";   
			$oCombo->Show();
			$oCombo->oDesCon(); 
?></strong><span style="color:#F00; font-size:20px"><strong> *</strong></span>
          </td>
        <td height="30"><strong>Firma</strong></td>
        <td width="151" height="30"><strong>
<select name="c_fircontrat" id="c_fircontrat">
            <option value="SI" selected="selected">SI</option>
            <option value="NO">NO</option>
            <option value="HUELLA">HUELLA</option>
          </select>  </strong>        <span style="color:#F00; font-size:20px"><strong> *</strong></span>
</td>
        <td width="44" align="right"><div id="div_represen_2"><input type="checkbox" name="chk_repre" id="chk_repre" onclick="fActiva_repre();" /></div></td>
        <td height="30" ><div id="div_represen">Representación</div><div id="div_emenor" style="display:none;"><input name="edad_menor" type="text" id="edad_menor" style="text-transform:uppercase;" size="3" placeholder="edad" /><select style="text-transform:uppercase;" name="condi_edad" id="condi_edad">
            <option value="1">años</option>
            <option value="2">meses</option>
            <option value="3">dias</option>
          </select><span style="color:#F00; font-size:20px"><strong> *</strong></span></div></td>
      </tr>
      <tr  bordercolor="#000000">
        <td height="19" colspan="6"><div id="div_codtestigo" style="display:none;"></div><div id="div_codpoderdante" style="display:none;"></div><div id="div_Data_Apoderado" style="display:none;"></div></td>
        </tr>
      <tr bordercolor="#000000">
        <td height="19" colspan="5"  ><hr></td>
        <td height="19" >&nbsp;</td>
      </tr>
      <tr>
        <td height="30" ><span class="camposss">Ape.Paterno</span></td>
        <td width="190" height="30"><input name="napepat3" type="text"   id="napepat3" style="text-transform:uppercase" onkeyup="apepat3();" value="<?php
		$apepat = $row['apepat'];
		$textorpat=str_replace("?","'",$apepat);
		$textoamperpat1=str_replace("*","&",$textorpat);
		echo strtoupper($textoamperpat1); 
		 ?>" readonly="readonly" />
         <input type="hidden" name="apepat2" id="apepat2"/></td>
        <td width="82" height="30" >Ape.Materno</td>
        <td height="30" colspan="2" ><input name="napemat3" type="text" id="napemat3"  style="text-transform:uppercase" onkeyup="apemat3();" value="<?php
		$apemat = $row['apemat'];
		$textorpat=str_replace("?","'",$apemat);
		$textoamperpat1=str_replace("*","&",$textorpat);
		echo strtoupper($textoamperpat1);   ?>" readonly="readonly" /><input type="hidden" name="apemat2" id="apemat2"/></td>
        <td width="93" height="30" >
          <div id="menucondicion" class="menucondicion" style="display:none; z-index:3;" >
            <table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td height="29" colspan="2" class="style30"><table width="196" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="16">&nbsp;</td>
                    <td width="180"><span class="titulomenuacto">Seleccione Condición(es)</span></td>
                    </tr>
                  </table></td>
                <td width="45" align="right" valign="middle">&nbsp;</td>
                </tr>
              <tr>
                <td height="50" colspan="3"><table width="750" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="25">&nbsp;</td>
                    <td width="725"><div id="tipocondicion" class="tipoacto" style="overflow:auto;"></div></td>
                    </tr>
  </table></td>
                </tr>
              <tr>
                <td width="620" height="10">&nbsp;</td>
                <td width="95"><a href='#' onClick="ocultar_desc('menucondicion');mostrar_desc('validarrepre')"><img src="../../iconos/aceptar.png" width="95" height="29" border="0" /></a></td>
                <td height="10">&nbsp;</td>
                </tr>
              <tr>
                <td colspan="3" align="center" valign="middle"></td>
                </tr>
              <tr></tr>
              </table>
            </div>    <div id="menucondicionk" class="menucondicion" style="display:none; z-index:4;" >
              <table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td height="29" colspan="2" class="style30"><table width="196" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="16">&nbsp;</td>
                      <td width="180"><span class="titulomenuacto">Quitar Condición(es)</span></td>
                      </tr>
                  </table></td>
                  <td width="45" align="right" valign="middle">&nbsp;</td>
                </tr>
                <tr>
                  <td height="50" colspan="3"><table width="750" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="25">&nbsp;</td>
                      <td width="725"><div id="tipocondicionk" class="tipoacto" style="overflow:auto;"></div></td>
                      </tr>
  </table></td>
                </tr>
                <tr>
                  <td width="620" height="10">&nbsp;</td>
                  <td width="95"><a href='#' onClick="ocultar_desc('menucondicionk')"><img src="../../iconos/aceptar.png" width="95" height="29" border="0" /></a></td>
                  <td height="10">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="3" align="center" valign="middle"></td>
                </tr>
                <tr></tr>
                </table>
              </div>
          <input type="hidden" name="segnom" style="text-transform:uppercase" id="segnom" value="<?php echo strtoupper($row['segnom']); ?>"  />
          <input type="hidden" name="apemat" style="text-transform:uppercase" id="apemat" value="<?php echo strtoupper($row['apemat']); ?>" />
          <input type="hidden" name="docum" style="text-transform:uppercase" id="docum" value="<?php echo strtoupper($row['numdoc']); ?>" /></td>
        </tr>
      <tr>
        <td height="30" ><span class="camposss">1er Nombre</span></td>
        <td height="30"><input name="nprinom3" type="text" id="nprinom3" style="text-transform:uppercase" onkeyup="prinom3();" value="<?php 
		$prinom = $row['prinom'];
		$textorpat=str_replace("?","'",$prinom);
		$textoamperpat3=str_replace("*","&",$textorpat);
		echo strtoupper($textoamperpat3); ?>" readonly="readonly" /><input type="hidden" name="prinom2" id="prinom2"/></td>
        <td height="30" >2do Nombre</td>
        <td height="30" colspan="2" ><input name="nsegnom3" type="text" id="nsegnom3"  style="text-transform:uppercase" onkeyup="segnom3();" value="<?php
        $segnom = $row['segnom'];
		$textorpat=str_replace("?","'",$segnom);
		$textoamperpat3=str_replace("*","&",$textorpat);
		echo strtoupper($textoamperpat3); ?>" readonly="readonly"
          />
        <input type="hidden" name="segnom3" id="segnom3"/></td>
        <td height="30" >&nbsp;</td>
      </tr>
      <tr>
        <td height="30" ><div class="ocultarX"><span class="camposss">Dirección</span></div></td>
        <td height="30" colspan="4"><div class="ocultarX"><input name="ndireccion3" type="text" id="ndireccion3" style="text-transform:uppercase" onkeyup="direccion3();" value="<?php 
		$direccion = $row['direccion'];
		$textorpat=str_replace("?","'",$direccion);
		$textoamperpat4=str_replace("*","&",$textorpat);
		echo strtoupper($textoamperpat4); ?>" size="60" readonly="readonly" />
        <input type="hidden" name="direccion3" id="direccion3"/></div></td>
        <td height="30" >&nbsp;</td>
      </tr>
      <tr>
        <td height="30" ><div class="ocultarX">Ubigeo:</div></td>
        <td height="30" colspan="4"><div class="ocultarX">
          <?php
		 $consulubigeo= mysql_query("SELECT * FROM ubigeo where coddis='".$row['idubigeo']."'", $conn) or die(mysql_error());
		  $rowubbi=mysql_fetch_array($consulubigeo);
		
?><input name="idzona" type="text" id="idzona" readonly="readonly" value="<?php echo $rowubbi['nomdis']."/".$rowubbi['nomprov']."/".$rowubbi['nomdpto']; ?>"  size="50" /></div></td>
        <td height="30" >&nbsp;</td>
      </tr>
      <tr>
        <td height="28" ><div class="ocultarX">Estado civil:</div></td>
        <td height="28"><div class="ocultarX">
<?php 
		
		$consulcivill=mysql_query("Select * from tipoestacivil where idestcivil='".$row['idestcivil']."'", $conn) or die(mysql_error());

$rowestcivil = mysql_fetch_array($consulcivill);

			
?>
          <label for="ecivil"></label>
          <input name="ecivil" type="text" id="ecivil" value="<?php echo $rowestcivil['desestcivil']; ?>" size="30" readonly="readonly" />
        </div></td>
        <td height="28" align="right" >Sexo:</td>
        <td height="28" >
<?php 
		
		  if($row['sexo']=='M'){
			  
			  $sexito="MASCULINO";
			  }else{
				$sexito="FEMENINO";
				  }
			
?>
          <input type="text" name="segnom3" id="segnom3" readonly="readonly" value="<?php echo $sexito; ?>" />

</td>
        <td height="28" >&nbsp;</td>
        <td height="28" >&nbsp;</td>
      </tr>
      <tr>
        <td width="87" height="30" ><div class="ocultarX">Nacionalidad:</div> </td>
        <td height="30"><div class="ocultarX">
<?php 
			
			$consulnaci=mysql_query("Select * from nacionalidades where idnacionalidad='".$row['nacionalidad']."'", $conn) or die(mysql_error());

$rownaci = mysql_fetch_array($consulnaci);
?>
          <label for="nacionalidad"></label>
          <input name="nacionalidad" type="text" id="nacionalidad" value="<?php echo $rownaci['descripcion']; ?>" size="30" readonly="readonly" />

</div></td>
        <td height="30" colspan="3"><?php echo " CASADO CON: ". $conyuge_imprime; ?></td>
        <td height="30" >&nbsp;</td>
      </tr>
      <tr>
        <td height="30" colspan="6" ><table width="44" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="44"><label><span class="camposss">
              <input type="hidden" name="codclie" id="codclie" value="<?php echo $row['idcliente']; ?>"   />
              </span></label></td>
            </tr>
          </table></td>
      </tr>
    </table></td>
  </tr>
</table>


