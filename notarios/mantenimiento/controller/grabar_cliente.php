<?php 

include("../../conexion.php");

$tipper= strtoupper($_POST['tipoper']);
 $apepat= strtoupper($_POST['apepat']);
$apemat= strtoupper($_POST['apemat']);
$prinom= strtoupper($_POST['prinom']);
$segnom= strtoupper($_POST['segnom']);
$nombre=$apepat." ".$apemat.", ".$prinom." ".$segnom;
$direccion= strtoupper($_POST['direccion']);
$idtipdoc=intval($_POST['tipodoc']);
$numdoc=$_POST['numdoc'];
$email= strtoupper($_POST['email']);
$telfijo=$_POST['telfijo'];
$telcel=$_POST['telcel'];
$telofi=$_POST['telofi'];
$sexo=$_POST['sexo'];
$idestcivil=intval($_POST['idestcivil']);
$natper= strtoupper($_POST['natper']);
$nacionalidad=intval($_POST['nacionalidad']);
$idprofesion=intval($_POST['idprofesion']);
$idcargoo=intval($_POST['idcargoo']);
 $cumpclie=$_POST['cumpclie'];
$codubisc=$_POST['codubisc'];
$nomprofesiones=$_POST['nomprofesiones'];
$profocupa=$_POST['nomcargoss'];
$cconyuge=$_POST['cconyuge'];
$ubigensc=$_POST['ubigensc'];
$residente=$_POST['residente'];
$docpaisemi=$_POST['docpaisemi'];
$tipocli=$_POST['tipocli'];

 $nrooficio=$_REQUEST['nrooficio'];
 $origenoficio=$_POST['origenoficio'];
 $entidad=$_POST['entidad'];
 $remitente=$_POST['remitente'];
 $motivo=$_POST['motivo'];

//exit();
if($tipocli!=""){
  $tipocli1=$tipocli;
}else{
  $tipocli1=0;
}



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

 $grabarclientesc="
INSERT INTO cliente 
(idcliente, tipper, apepat, apemat, prinom, segnom, 
nombre, direccion, idtipdoc, numdoc, email, telfijo,
 telcel, telofi, sexo, idestcivil, natper, conyuge, nacionalidad, idprofesion, detaprofesion, idcargoprofe, profocupa, dirfer, idubigeo, cumpclie, fechaing, razonsocial, domfiscal, telempresa, mailempresa, contacempresa, fechaconstitu, idsedereg, numregistro, numpartida, actmunicipal, tipocli, impeingre, impnumof, impeorigen, impentidad, impremite, impmotivo,residente,docpaisemi) 
VALUES 
('$ncliente','$tipper','$apepat','$apemat','$prinom','$segnom',
'$nombre','$direccion','$idtipdoc','$numdoc','$email','$telfijo',
'$telcel','$telofi','$sexo','$idestcivil','$natper','$cconyuge','$nacionalidad','$idprofesiioon','$nomprofesiones','$idcargoosss','$profocupa','','$idubigeoos','','$cumpclie','','','','','','',1,'','','','$tipocli1','','$nrooficio','$origenoficio','$entidad','$remitente','$motivo','$residente','$docpaisemi')";


mysql_query($grabarclientesc,$conn) or die(mysql_error());


if ($cconyuge!=""){

$grabarconyugee="update cliente set conyuge='$ncliente' where idcliente='$cconyuge'";
mysql_query($grabarconyugee,$conn) or die(mysql_error());

}

?>

<table width="684" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="33">&nbsp;</td>
    <td width="651"><table width="640" border="0" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
      <tr>
        <td height="30" ><span class="camposss">Ape.Paterno</span></td>
        <td width="153" height="30"><input type="text" name="apepat"  style="text-transform:uppercase"  id="apepat" value="<?php echo $apepat; ?>" /></td>
        <td width="92" height="30" ><span class="camposss">Ape. Materno</span></td>
        <td width="171" height="30" ><input type="text" name="apemat"  style="text-transform:uppercase" id="apemat" value="<?php echo $apemat; ?>" /></td>
        <td height="30" ><a  onClick="validar2()"><img src="../../iconos/condicion.png" width="120" height="29" border="0" /></a>
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
                                    <td width="95"><a href='#' onClick="ocultar_desc('menucondicion')"><img src="iconos/aceptar.png" width="95" height="29" border="0" /></a></td>
                                    <td height="10">&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td colspan="3" align="center" valign="middle"></td>
                                  </tr>
                                  <tr></tr>
                                </table>
          </div>    </td>
      </tr>
      <tr>
        <td height="30" ><span class="camposss">1er Nombre</span></td>
        <td height="30"><input type="text" name="prinom"  style="text-transform:uppercase"  id="prinom" value="<?php echo $prinom; ?>" /></td>
        <td height="30" ><span class="camposss">2do Nombre</span></td>
        <td height="30" ><input type="text" name="segnom" id="segnom"  style="text-transform:uppercase" value="<?php echo $segnom; ?>"  /></td>
        <td height="30" ><a onClick="validarcontra()"><img src="../../iconos/contratante.png" width="120" height="29" border="0" /></a></td>
      </tr>
      <tr>
        <td width="100" height="30" ><span class="camposss">Dirección</span></td>
        <td height="30" colspan="3">
          <input name="direccion" type="text" id="direccion"  style="text-transform:uppercase" value="<?php echo $direccion; ?>" size="60" >        </td>
        <td width="124" height="30" ><label><a href="#" onclick="clienteeditado()"><img src="../../iconos/editacontratantes.png" width="120" height="29" border="0" /></a></label></td>
      </tr>
      <tr>
        <td height="30" colspan="5" ><table width="632" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="102"><span class="camposss">Firma</span></td>
            <td width="155"><input name="fir" type="checkbox" id="fir" onClick="mostrarfirma(this.checked, this.value)" value="1" checked="checked" /></td>
            <td width="122"><span class="camposss">Incluir en el Indice</span></td>
            <td width="78"><label>
              <input name="inde" type="checkbox" id="inde" checked="checked" value="1" onClick="mostrarindice(this.checked, this.value)" />
            </label></td>
            <td width="175"><label>
              <input type="hidden" name="representaa" id="representaa" />
              <input name="codcon" type="hidden" id="codcon" size="20" />
            </label></td>
          </tr>
        </table></td>
        </tr>
      <tr>
        <td height="30" colspan="5" ><span class="camposss">Tipo de Representación:
            <input type="hidden" name="firma" id="firma" value="1" />        
            <label>
          <input type="hidden" name="indice" id="indice" value="1" />
          </label>
          <label>
          <input type="hidden" name="repre" id="repre" value="0"  />
          </label>
          <input type="hidden" name="codclie" id="codclie" value="<?php echo $ncliente; ?>"   />
        </span></td>
        </tr>
      <tr>
        <td height="30" colspan="5" ><table width="650" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="172">
<input name="radio" type="radio" id="radio" value="0" checked onclick="buttons(0)" />            
<span class="camposss">Derecho Propio</span></td>
            <td width="159"><input type="radio" name="radio" id="radio2" value="1" onclick="buttons23(1)" />
              <span class="camposss">Representante</span>
                <div id="representante" class="representante" style="display:none; z-index:2;" >
                  <table width="604" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="201" height="29" class="style30"><table width="196" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="16">&nbsp;</td>
                            <td width="180"><span class="titulomenuacto">Contratantes</span></td>
                          </tr>
                      </table></td>
                      <td width="403" align="right" valign="middle"><a href="#" onClick="ocultar_desc('representante')"><img src='iconos/cerrar.png' width='21' height='20' border='0' /></a></td>
                    </tr>
                    <tr>
                      <td height="25" colspan="2"><div id="contratan" class="allcontrata"></div></td>
                    </tr>
                    <tr>
                      <td height="25" colspan="2"><table width="600" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="69"><span class="titulomenuacto">Facultades:</span></td>
                          <td width="531"><label>
                            <input name="facultades" type="text" id="facultades" size="70" />
                          </label></td>
                        </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td colspan="2" align="center" valign="middle"></td>
                    </tr>
                  </table>
                </div></td>
            <td width="309"><input type="radio" name="radio" id="radio3" value="2" onclick="buttons23(2)" />
              <span class="camposss">Por Derecho Propio y Representación</span></td>
            </tr>
        </table></td>
        </tr>
    </table></td>
  </tr>
</table>


