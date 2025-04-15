<?php 

include("../../conexion.php");

	require_once("../../includes/barramenu.php") ;
	require_once("../../includes/gridView.php")  ;
	require_once("../../includes/combo.php")  	 ;
	$oBarra = new BarraMenu() 				     ;
	$Grid1  = new GridView()					 ;
	$oCombo = new CmbList()  				     ;	


$tipper   = $_POST['tipoper'];
$apepatexto=strtoupper($_POST['apepat']);
$cabioapostroa=str_replace("'","?",$apepatexto);
$apepat=addslashes(strtoupper($cabioapostroa));

$apemattexto=strtoupper($_POST['apemat']);
$cabioapostrom=str_replace("'","?",$apemattexto);
$apemat=addslashes(strtoupper($cabioapostrom));

$prinomp=strtoupper($_POST['prinom']);
$cabioapostrop=str_replace("'","?",$prinomp);
$prinom=addslashes(strtoupper($cabioapostrop));

$segnomp=strtoupper($_POST['segnom']);
$cabioapostromm=str_replace("'","?",$segnomp);
$segnom=addslashes(strtoupper($cabioapostromm));

$nombre=addslashes($apepat." ".$apemat.", ".$prinom." ".$segnom);

$direccionpp=strtoupper($_POST['direccion']);
$cabioapostropp=str_replace("'","?",$direccionpp);
$direccion=addslashes(strtoupper($cabioapostropp));
$idtipdoc = intval("1");
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
$idtipdoc 		= $_POST['idtipdoc'];
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
$idprofesion = $_POST['idprofesion'];
$nomprofesiones = $_POST['nomprofesiones'];
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


$grabarclientesc="INSERT INTO cliente (idcliente, tipper, apepat, apemat, prinom, segnom, nombre, direccion, idtipdoc, numdoc, email, telfijo, telcel, telofi, sexo, idestcivil, natper, conyuge, nacionalidad, idprofesion, detaprofesion, idcargoprofe, profocupa, dirfer, idubigeo, cumpclie, fechaing, razonsocial, domfiscal, telempresa, mailempresa, contacempresa, fechaconstitu, idsedereg, numregistro, numpartida, actmunicipal, tipocli, impeingre, impnumof, impeorigen, impentidad, impremite, impmotivo,residente,docpaisemi) VALUES ('$ncliente','$tipper','$apepat','$apemat','$prinom','$segnom','$nombre','$direccion','$idtipdoc','$numdoc','$email','$telfijo','$telcel','$telofi','$sexo','$idestcivil','$natper','$cconyuge','$nacionalidad','$idprofesiioon','$nomprofesiones','$idcargoosss','$profocupa','','$idubigeoos','$cumpclie','','','','','','','',1,'','','','0','','','','','','','$residente','$docpaisemi')";
mysql_query($grabarclientesc,$conn) or die(mysql_error());



?>

<table width="684" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="20">&nbsp;</td>
    <td width="664"><table width="640" border="0" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
      <tr>
        <td height="30" ><span class="camposss">Ape.Paterno</span></td>
        <td width="153" height="30"><input name="napepat1" type="text"  id="napepat1"  style="text-transform:uppercase"  onkeyup="apepaterno1();" value="<?php 
						  $textorpat=str_replace("?","'",$apepat);
						  $textoamperpat=str_replace("*","&",$textorpat);
						  echo strtoupper($textoamperpat); ?>" readonly="readonly" />
            <input type="hidden" id="apepat1" name="apepat1" />
                          </td>
        <td width="92" height="30" ><span class="camposss">Ape.Materno</span></td>
        <td width="171" height="30" ><input name="napemat1" type="text"  id="napemat1"  style="text-transform:uppercase" onkeyup="apematerno1();"value="<?php 
						  $textormat=str_replace("?","'",$apemat);
						  $textoampermat=str_replace("*","&",$textormat);
						  echo strtoupper($textoampermat); 
						  ?>" readonly="readonly" />
            <input type="hidden" id="apemat1" name="apemat1" />
                          </td>
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
          <input type="hidden" name="apemat"  style="text-transform:uppercase" id="apemat" value="<?php echo $apemat; ?>" />
          <input type="hidden" name="docum" style="text-transform:uppercase" id="docum" value="<?php echo $numdoc; ?>" /></td>
      </tr>
      <tr>
        <td height="30" ><span class="camposss">1er Nombre</span></td>
        <td height="30"><input name="nprinom1" type="text"  id="nprinom1"  style="text-transform:uppercase" onkeyup="prinombre1();" value="<?php 
		 				  $textorpri=str_replace("?","'",$prinom);
		 				  $textoamperpri=str_replace("*","&",$textorpri);
						  echo strtoupper($textoamperpri);
						  ?>" readonly="readonly" />
            <input type="hidden" id="prinom1" name="prinom1" />
                          </td>
        <td height="30" ><span class="camposss">2do Nombre</span></td>
        <td height="30" ><input name="segnom" type="text" id="segnom"  style="text-transform:uppercase" value="<?php echo $segnom; ?>" readonly="readonly"  /></td>
        <td height="30" >&nbsp;</td>
      </tr>
      <tr>
        <td height="30" ><span class="camposss">Dirección</span></td>
        <td height="30" colspan="3"><input name="ndireccion1" type="text" id="ndireccion1"  style="text-transform:uppercase"  onkeyup="direccion1();" value="<?php 
						 $textordir=str_replace("?","'",$direccion);
		 				 $textoamperdir=str_replace("*","&",$textordir);
		 				 echo strtoupper($textoamperdir);
						 ?>" size="60" readonly="readonly" />
            <input type="hidden" name="direccion1" id="direccion1" />
                         </td>
        <td height="30" >&nbsp;</td>
      </tr>
      <tr>
        <td width="100" height="30" >Firma</td>
        <td height="30">
          <!--<input name="c_fircontrat" type="text" id="c_fircontrat" style="text-transform:uppercase;" size="10" placeholder="SI/NO" />--><select name="c_fircontrat" id="c_fircontrat">
          <option value="SI" selected="selected">SI</option>
          <option value="NO" >NO</option>
        </select><span style="color:#F00; font-size:20px"><strong> *</strong></span></td>
        <td height="30">Condicion</td>
        <td height="30"><?php 

			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT c_condiciones.id_condicion AS 'id', c_condiciones.des_condicion AS 'des' FROM c_condiciones 
 WHERE c_condiciones.swt_condicion='P'
 ORDER BY des_condicion ASC"; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "140"; 
			$oCombo->name       = "c_condicontrat";
			$oCombo->style      = "camposss"; 
			$oCombo->click      = "fEvalCondi()";   
			//$oCombo->selected   = $rowpart['c_condicontrat'];
			$oCombo->Show();
			$oCombo->oDesCon(); 
?><span style="color:#F00; font-size:20px"><strong> *</strong></span></td>
        <td width="124" height="30" >&nbsp;</td>
      </tr>
      <tr>
        <td height="30" >&nbsp;</td>
        <td height="30">&nbsp;</td>
        <td height="30" colspan="2">
        <label id="labelcod1" style="display:none;">Cod. Asegurado:</label><label id="labelcod2" style="display:none;">Cod.Pensionista:</label>
 		<div id="div_codasegurado" style="display:none;">  <input name="codi_asegurado" type="text" id="codi_asegurado" style="text-transform:uppercase;" size="20" /></div>
        <div id="div_codtestigo" style="display:none;"></div></td>
        <td height="30" >&nbsp;</td>
      </tr>
      <tr>
        <td height="30" colspan="5" ><table width="175" border="0" cellspacing="0" cellpadding="0">
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
