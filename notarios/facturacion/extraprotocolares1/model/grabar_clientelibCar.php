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
$apepat=strtoupper($cabioapostroa);

$apemattexto=strtoupper($_POST['apemat']);
$cabioapostrom=str_replace("'","?",$apemattexto);
$apemat=strtoupper($cabioapostrom);

$prinomp=strtoupper($_POST['prinom']);
$cabioapostrop=str_replace("'","?",$prinomp);
$prinom=strtoupper($cabioapostrop);

$segnomp=strtoupper($_POST['segnom']);
$cabioapostromm=str_replace("'","?",$segnomp);
$segnom=strtoupper($cabioapostromm);

$nombre=$apepat." ".$apemat.", ".$prinom." ".$segnom;

$direccionpp=strtoupper($_POST['direccion']);
$cabioapostropp=str_replace("'","?",$direccionpp);
$direccion=strtoupper($cabioapostropp);

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
$cconyuge	    = "0";
$ubigensc		= $_POST['ubigensc'];
$residente		= $_POST['residente'];
$docpaisemi		= $_POST['docpaisemi'];

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


$grabarclientesc="INSERT INTO cliente (idcliente, tipper, apepat, apemat, prinom, segnom, nombre, direccion, idtipdoc, numdoc, email, telfijo, telcel, telofi, sexo, idestcivil, natper, conyuge, nacionalidad, idprofesion, detaprofesion, idcargoprofe, profocupa, dirfer, idubigeo, cumpclie, fechaing, razonsocial, domfiscal, telempresa, mailempresa, contacempresa, fechaconstitu, idsedereg, numregistro, numpartida, actmunicipal, tipocli, impeingre, impnumof, impeorigen, impentidad, impremite, impmotivo,residente,docpaisemi) VALUES ('$ncliente','$tipper','$apepat','$apemat','$prinom','$segnom','$nombre','$direccion','$idtipdoc','$numdoc','$email','$telfijo','$telcel','$telofi','$sexo','$idestcivil','$natper','$cconyuge','$nacionalidad','$idprofesiioon','$nomprofesiones','$idcargoosss','$profocupa','',$idubigeoos,'$cumpclie','','','','','','','',1,'','','','0','','','','','','','$residente','$docpaisemi')";
mysql_query($grabarclientesc,$conn) or die(mysql_error());



?>

<table width="684" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="33">&nbsp;</td>
    <td width="651"><table width="640" border="0" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
      <tr>
        <td height="30" ><span class="camposss">Ape.Paterno</span></td>
        <td width="153" height="30"><input type="text" name="apepat"  style="text-transform:uppercase"  id="apepat" value="<?php 
						  $textorpat=str_replace("?","'",$apepat);
						  $textoamperpat=str_replace("*","&",$textorpat);
						  echo strtoupper($textoamperpat);   
		?>" /></td>
        <td width="92" height="30" ><span class="camposss">Ape.Materno</span></td>
        <td width="171" height="30" ><input type="text" name="apemat"  style="text-transform:uppercase" id="apemat" value="<?php echo $apemat; ?>" /></td>
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
        <td height="30"><input type="text" name="prinom"  style="text-transform:uppercase"  id="prinom" value="<?php
					      $textorpri=str_replace("?","'",$prinom);
		 				  $textoamperpri=str_replace("*","&",$textorpri);
						  echo strtoupper($textoamperpri); ?>" /></td>
        <td height="30" ><span class="camposss">2do Nombre</span></td>
        <td height="30" ><input type="text" name="segnom" id="segnom"  style="text-transform:uppercase" value="<?php echo $segnom; ?>"  /></td>
        <td height="30" >&nbsp;</td>
      </tr>
      <tr>
        <td height="30" ><span class="camposss">Dirección</span></td>
        <td height="30" colspan="3"><input name="direccion" type="text" id="direccion"  style="text-transform:uppercase" value="<?php 
				$textordir=str_replace("?","'",$direccion);
		 		$textoamperdir=str_replace("*","&",$textordir);
		 		echo strtoupper($textoamperdir);
		  ?>" size="60" /></td>
        <td height="30" >&nbsp;</td>
      </tr>
      <tr>
        <td width="100" height="30" >Telefono</td>
        <td height="30"><input name="telfijo" type="text" id="telfijo" style="text-transform:uppercase;" size="10"  value="<?php echo $telfijo; ?>" /></td>
        <td height="30">&nbsp;</td>
        <td height="30">&nbsp;</td>
        <td width="124" height="30" >&nbsp;</td>
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
