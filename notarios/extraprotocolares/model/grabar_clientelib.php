<?php 

include("../../conexion.php");

	require_once("../../includes/barramenu.php") ;
	require_once("../../includes/gridView.php")  ;
	require_once("../../includes/combo.php")  	 ;
	$oBarra = new BarraMenu() 				     ;
	$Grid1  = new GridView()					 ;
	$oCombo = new CmbList()  				     ;	


$tipper  = $_POST['tipoper'];
$apepatexto=strtoupper($_POST['apepat']);
$cabioapostroa=str_replace("'","?",$apepatexto);
$apepat=addslashes(strtoupper($cabioapostroa));

$apemattexto=strtoupper($_POST['apemat']);
$cabioapostrom=str_replace("'","?",$apemattexto);
$apemat=addslashes (strtoupper($cabioapostrom));

$prinomp=strtoupper($_POST['prinom']);
$cabioapostrop=str_replace("'","?",$prinomp);
$prinom=addslashes (strtoupper($cabioapostrop));

$segnomp=strtoupper($_POST['segnom']);
$cabioapostromm=str_replace("'","?",$segnomp);
$segnom=addslashes (strtoupper($cabioapostromm));

$nombre=addslashes($apepat." ".$apemat.", ".$prinom." ".$segnom);

$direccionpp=strtoupper($_POST['direccion']);
$cabioapostropp=str_replace("'","?",$direccionpp);
$direccion=addslashes (strtoupper($cabioapostropp));

$idtipdoc = intval($_POST['idtipdoc']);
$numdoc	  = $_POST['numdoc'];
$email	  = $_POST['email'];
$telfijo  = $_POST['telfijo'];
$telcel   = $_POST['telcel'];
$telofi   = $_POST['telofi'];
$sexo	  = $_POST['sexo'];
$idestcivil = intval($_POST['idestcivil']);
$natper = $_POST['natper'];
$nacionalidad = intval($_POST['nacionalidad']);
$idprofesion  = intval($_POST['idprofesion']);
$idcargoo	  = intval($_POST['idcargoo']);
$cumpclie	  = $_POST['cumpclie'];
$codubisc	  = $_POST['codubisc'];
$nomprofesiones = $_POST['nomprofesiones'];
$profocupa	    = $_POST['nomcargoss'];
$cconyuge	    = $_POST['cconyuge'];
$ubigensc		= $_POST['ubigensc'];
$residente		= $_POST['residente'];
$docpaisemi		= $_POST['docpaisemi'];

$anioPersona = explode('/',$cumpclie);
$edad = date('Y')-$anioPersona[2]; 

if ($nomprofesiones==""){
$idprofesiioon=0;
}else{
$idprofesiioon=$idprofesion;
}

if ($profocupa==""){
$idcargoosss=0;
}else{
$idcargoosss=$idcargoo;
}


if ($ubigensc==""){
$idubigeoos=0;
}else{
$idubigeoos=$codubisc;
}
$idprofesion2 = $_POST['idprofesion'];

if ($idprofesion2==""){
$idprofesion=0;
}else{
$idprofesion=$idprofesion2;
}

$detprofesion2 = $_POST['detprofesion'];
if ($detprofesion2==""){
$detprofesion="";
}else{
$detprofesion=$detprofesion2;
}

$consulclien=mysql_query("Select * from cliente order by idcliente DESC LIMIT 1", $conn) or die(mysql_error());

$rowclin = mysql_fetch_array($consulclien);

$numeroc=$rowclin['idcliente'];
$sumac= intval($numeroc) + 1;
$cantidadc= strlen($sumac);


 switch ($cantidadc) {
	case "1":
	$ncliente="000000000".$sumac;
	break;
	case "2":
	$ncliente="00000000".$sumac;	
	break;
	case "3":
	$ncliente="0000000".$sumac;
	break;
	case "4":
	$ncliente="000000".$sumac;	
	break;
	case "5":
	$ncliente="00000".$sumac;
	break;
	case "6":
	$ncliente="0000".$sumac;	
	break;		
	case "7":
	$ncliente="000".$sumac;	
	break;	
	case "8":
	$ncliente="00".$sumac;	
	break;	
	case "9":
	$ncliente="0".$sumac;	
	break;
	case "10":
	$ncliente=$sumac;	
	break;			
}


$grabarclientesc="INSERT INTO cliente (idcliente, tipper, apepat, apemat, prinom, segnom, nombre, direccion, idtipdoc, numdoc, email, telfijo, telcel, telofi, sexo, idestcivil, natper, conyuge, nacionalidad, idprofesion, detaprofesion, idcargoprofe, profocupa, dirfer, idubigeo, cumpclie, fechaing, razonsocial, domfiscal, telempresa, mailempresa, contacempresa, fechaconstitu, idsedereg, numregistro, numpartida, actmunicipal, tipocli, impeingre, impnumof, impeorigen, impentidad, impremite, impmotivo,residente,docpaisemi) VALUES ('$ncliente','$tipper','$apepat','$apemat','$prinom','$segnom','$nombre','$direccion','$idtipdoc','$numdoc','$email','$telfijo','$telcel','$telofi','$sexo','$idestcivil','$natper','$cconyuge','$nacionalidad','$idprofesion','$detprofesion','$idcargoosss','$profocupa','','$idubigeoos','$cumpclie','','','','','','','',1,'','','','0','','','','','','','$residente','$docpaisemi')";
mysql_query($grabarclientesc,$conn) or die(mysql_error());



?>
<style type="text/css">
</style>


<table width="684" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="18">&nbsp;</td>
    <td width="666"><table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
      <tr>
        <td height="30" ><strong>Condicion</strong></td>
        <td height="30"><!--<input name="c_fircontrat" type="text" id="c_fircontrat" style="text-transform:uppercase;" size="10" placeholder="SI/NO" />-->
          <?php 

			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT c_condiciones.id_condicion AS 'id', c_condiciones.des_condicion AS 'des' FROM c_condiciones WHERE c_condiciones.Swt_condicion = 'V' ORDER BY des_condicion ASC"; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "140"; 
			$oCombo->name       = "c_condicontrat";
			$oCombo->style      = "camposss"; 
			$oCombo->click      = "fEvalCondicion()";   
			//$oCombo->selected   = $rowpart['c_condicontrat'];
			$oCombo->Show();
			$oCombo->oDesCon(); 
?><span style="color:#F00; font-size:20px"><strong> *</strong></span></td>
        <td height="30" ><strong>Firma</strong></td>
        <td width="126" height="30" ><select name="c_fircontrat" id="c_fircontrat">
          <option value="SI" selected="selected">SI</option>
            <option value="NO">NO</option>
              <option value="HUELLA">HUELLA</option>
        </select><span style="color:#F00; font-size:20px"><strong> *</strong></span></td>
        <td width="38" align="right" ><div id="div_represen_2"><input type="checkbox" name="chk_repre" id="chk_repre" onclick="fActiva_repre();" /></div></td>
        <td height="30" ><div id="div_represen">Representación</div><div id="div_emenor" style="display:none;"><input name="edad_menor" type="text" id="edad_menor" style="text-transform:uppercase;" size="3" placeholder="edad" value="<?php echo $edad;?>" /><select style="text-transform:uppercase;" name="condi_edad" id="condi_edad">
            <option value="1">años</option>
            <option value="2">meses</option>
            <option value="3">dias</option>
          </select><span style="color:#F00; font-size:20px"><strong> *</strong></span></div></td>
      </tr>
      <tr>
        <td height="19" colspan="6" ><div id="div_codtestigo" style="display:none;"></div><div id="div_codpoderdante" style="display:none;"></div><div id="div_Data_Apoderado" style="display:none;"></div></td>
        </tr>
      <tr>
        <td height="19" colspan="5" ><hr></td>
        <td height="19" >&nbsp;</td>
      </tr>
      <tr>
        <td height="30" ><span class="camposss">Ape.Paterno</span></td>
        <td width="207" height="30"><input name="napepat2"  type="text"  id="napepat2"  style="text-transform:uppercase"  onkeyup="napepat2();" value="<?php 
		                  $textorpat=str_replace("?","'",$apepat);
						  $textoamperpat=str_replace("*","&",$textorpat);
						  $textito1=str_replace('¿','"',$textoamperpat);
						  $textito2=str_replace("QQ11QQ","#",$textito1);
						   $textito3=str_replace("QQ22KK","°",$textito2);
						  echo stripslashes(strtoupper($textito3));  
						 ?>" readonly="readonly" /><input type="hidden" name="apepat2" id="apepat2"/></td>
        <td width="82" height="30" >Ape.Materno</td>
        <td height="30" colspan="2" ><input name="napemat2" type="text" id="napemat2"  style="text-transform:uppercase"  onkeyup="napemat2();" value="<?php 
						  $textormat=str_replace("?","'",$apemat);
						  $textoampermat=str_replace("*","&",$textormat);
						  $textito4=str_replace('¿','"',$textoampermat);
						  $textito5=str_replace("QQ11QQ","#",$textito4);
						   $textito6=str_replace("QQ22KK","°",$textito5); 
						  echo stripslashes(strtoupper($textito6));?>" readonly="readonly" /><input type="hidden" name="apemat2" id="apemat2"/></td>
        <td height="30" ><div id="menucondicion" class="menucondicion" style="display:none; z-index:3;" >
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
                                    <td width="95"><a href='#' onClick="ocultar_desc('menucondicion');mostrar_desc('validarrepre')"><img src="iconos/aceptar.png" width="95" height="29" border="0" /></a></td>
                                    <td height="10">&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td colspan="3" align="center" valign="middle"></td>
                                  </tr>
                                  <tr></tr>
                                </table>
          </div>
          <input type="hidden" name="docum" style="text-transform:uppercase" id="docum" value="<?php echo $numdoc; ?>" /></td>
      </tr>
      <tr>
        <td height="30" ><span class="camposss">1er Nombre</span></td>
        <td height="30"><input name="nprinom2" type="text"  id="nprinom2"  style="text-transform:uppercase"  onkeyup="prinom2();" value="<?php 	
				$textorpri=str_replace("?","'",$prinom);
		 		$textoamperpri=str_replace("*","&",$textorpri);
				 $textito7=str_replace('¿','"',$textoamperpri);
				 $textito8=str_replace("QQ11QQ","#",$textito7);
				 $textito9=str_replace("QQ22KK","°",$textito8); 
				echo stripslashes(strtoupper($textito9)); ?>" readonly="readonly" /><input type="hidden" name="prinom2" id="prinom2"/></td>
        <td height="30" >2do Nombre</td>
        <td height="30" colspan="2" ><input name="nsegnom2" type="text" id="nsegnom2"  style="text-transform:uppercase"  onkeyup="segnom2();" value="<?php 
				$textorpri=str_replace("?","'",$segnom);
				$textoamperpri=str_replace("*","&",$textorpri);
				 $textito10=str_replace('¿','"',$textoamperpri);
				 $textito11=str_replace("QQ11QQ","#",$textito10);
				 $textito12=str_replace("QQ22KK","°",$textito11); 
				echo stripslashes(strtoupper($textito12)); ?>" readonly="readonly"  /><input type="hidden" name="segnom2" id="segnom2"/>
                </td>
        <td height="30" >&nbsp;</td>
      </tr>
      <tr>
        <td height="30" ><div class="ocultarX"><span class="camposss">Dirección</span></div></td>
        <td height="30" colspan="4"><div class="ocultarX"><input name="ndireccion2" type="text" id="ndireccion2" style="text-transform:uppercase"  onkeyup="direc2();" value="<?php  
				$textordir=str_replace("?","'",$direccion);
		 		$textoamperdir=str_replace("*","&",$textordir);
				 $textito13=str_replace('¿','"',$textoamperdir);
				 $textito14=str_replace("QQ11QQ","#",$textito13);
				 $textito15=str_replace("QQ22KK","°",$textito14); 
				echo stripslashes(strtoupper($textito15)); ?>" size="60" readonly="readonly" />
              <input type="hidden" name="direccion2" id="direccion2"/>
                </div></td>
        <td height="30" >&nbsp;</td>
      </tr>
      <tr>
        <td width="89" height="30" ><div class="ocultarX">Ubigeo:</div></td>
        <td height="30" colspan="4"><div class="ocultarX"><?php 
			$consulubi=mysql_query("Select * from ubigeo where coddis='".$codubisc."'", $conn) or die(mysql_error());

$rowubige = mysql_fetch_array($consulubi);

?>
  <input name="idzona" type="text" id="idzona" value="<?php echo $rowubige['nomdis']."/".$rowubige['nomprov']."/".$rowubige['nomdpto'];?>" size="50" readonly="readonly" />
        </div></td>
        <td width="124" height="30" >&nbsp;</td>
      </tr>
      <tr>
        <td height="30" ><div class="ocultarX">Estado civil:</div></td>
        <td height="30"><div class="ocultarX"><?php 
		
		$consulcivill=mysql_query("Select * from tipoestacivil where idestcivil='".$idestcivil."'", $conn) or die(mysql_error());

$rowestcivil = mysql_fetch_array($consulcivill);

			
?>
          <label for="ecivil"></label>
          <input name="ecivil" type="text" id="ecivil" value="<?php echo $rowestcivil['desestcivil']; ?>" size="30" readonly="readonly" />
        </div></td>
        <td height="30" align="right">Sexo:</td>
        <td height="30" colspan="2"><?php 
		
		  if($sexo=='M'){
			  
			  $sexito="MASCULINO";
			  }else{
				$sexito="FEMENINO";
				  }
			
?>
          <input type="text" name="segnom3" id="segnom3" readonly="readonly" value="<?php echo $sexito; ?>" />
          <!--<input type="text" name="segnom2" id="segnom2"  style="text-transform:uppercase" value="<?php if($sexo=='M'){echo "Masculino";}else{echo "Femenino";} ?>"  />--></td>
        <td height="30" >&nbsp;</td>
      </tr>
      <tr>
        <td height="30" ><div class="ocultarX">Nacionalidad:</div> </td>
        <td height="30"><div class="ocultarX"><?php 
			
			$consulnaci=mysql_query("Select * from nacionalidades where idnacionalidad='".$nacionalidad."'", $conn) or die(mysql_error());

$rownaci = mysql_fetch_array($consulnaci);
?>
          <label for="nacionalidad"></label>
          <input name="nacionalidad" type="text" id="nacionalidad" value="<?php echo $rownaci['descripcion']; ?>" size="30" readonly="readonly" />
        </div></td>
        <td height="30">&nbsp;</td>
        <td height="30" colspan="2">&nbsp;</td>
        <td height="30" >&nbsp;</td>
      </tr>
      <tr>
        <td height="30" colspan="6" ><table width="175" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="175"><label><span class="camposss">
              <input type="hidden" name="codclie" id="codclie" value="<?php echo $ncliente; ?>"   />
              </span></label></td>
            </tr>
          </table></td>
      </tr>
    </table></td>
  </tr>
</table>
