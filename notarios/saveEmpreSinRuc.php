<?php 

include("conexion.php");

$tipper				= $_POST['tipoper'];
$razonsocial		= $_POST['razonsocial_sr'];
$domfiscal			= $_POST['domfiscal_sr'];
$telempresa			= $_POST['telempresa_sr'];
$mailempresa		= $_POST['mailempresa_sr'];
$contacempresa		= $_POST['contacempresa_sr'];
$idtipdoc			= intval("10");
$numdoc				= $_POST['numdoc']; // A EVALUAR PARA REALIZAR LA ACCION
$fechaconstitu		= $_POST['fechaconstitu_sr'];
$numregistro		= $_POST['numregistro_sr'];
$numpartida			= $_POST['numpartida_sr'];
$actmunicipal		= $_POST['actmunicipal_sr'];
$codubi				= $_POST['codubi_sr'];
$idsedereg3			= $_POST['idsedereg3_sr'];
$_eval_idcliente	= $_POST['_eval_idcliente'];

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

if($numdoc=='')
{
	$grabarempresac="INSERT INTO cliente (idcliente, tipper, apepat, apemat, prinom, segnom, nombre, direccion, idtipdoc, numdoc, email, telfijo, telcel, telofi, sexo, idestcivil, natper, conyuge, nacionalidad, idprofesion, detaprofesion, idcargoprofe, profocupa, dirfer, idubigeo, cumpclie, fechaing, razonsocial, domfiscal, telempresa, mailempresa, contacempresa, fechaconstitu, idsedereg, numregistro, numpartida, actmunicipal, tipocli, impeingre, impnumof, impeorigen, impentidad, impremite, impmotivo,residente,docpaisemi) VALUES ('$ncliente','$tipper','','','','','','','$idtipdoc','','','','','','',0,'','','0',0,'','0','','','$codubi','','','$razonsocial','$domfiscal','$telempresa','$mailempresa','$contacempresa','$fechaconstitu','$idsedereg3','$numregistro','$numpartida','$actmunicipal','0','','','','','','','','')";
	mysql_query($grabarempresac,$conn) or die(mysql_error());
}
else if($numdoc != '')
{
	$editempresac="UPDATE cliente SET  numdoc = '$numdoc' WHERE idcliente = '$_eval_idcliente' ";
	mysql_query($editempresac,$conn) or die(mysql_error());	
}

//echo "<strong>Grabado. ID: ".$ncliente."</strong>";

?>
<table width="684" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="33">&nbsp;</td>
    <td width="651"><table width="640" border="0" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
      <tr>
        <td width="116" height="30" ><span class="camposss">Razón Social</span></td>
        <td width="396" height="30"><input name="apepat" type="text" id="apepat"   style="text-transform:uppercase" value="<?php echo $razonsocial; ?>" size="45" /></td>
        <td width="138" height="30" ><a onClick="validar2()"><img src="iconos/condicion.png" width="120" height="29" border="0" /></a>
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
        <td height="30" ><span class="camposss">Domicilio Fiscal</span></td>
        <td height="30"><input name="direccion"  style="text-transform:uppercase" type="text" id="direccion" value="<?php echo $domfiscal; ?>" size="60" /></td>
        <td height="30" ><a onClick="validarcontra()"><img src="iconos/contratante.png" width="120" height="29" border="0" /></a></td>
      </tr>
      
      <tr>
        <td height="30" colspan="3" ><table width="649" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="117"><span class="camposss">Incluir en el Indice</span></td>
            <td width="137"><input name="inde" type="checkbox" id="inde" checked="checked" value="1" onclick="mostrarindice(this.checked, this.value)" /></td>
            <td width="213">&nbsp;</td>
            <td width="45"><label></label></td>
            <td width="137"><label>
              <input type="hidden" name="representaa" id="representaa" />
            </label></td>
          </tr>
        </table></td>
        </tr>
      <tr>
        <td height="30" colspan="3" ><span class="camposss">
          <label>
          <input type="hidden" name="indice" id="indice" value="1" />
            </label>
          <label>
          <input type="hidden" name="repre" id="repre" value="0"  />
          </label>
          <input type="hidden" name="codclie" id="codclie" value="<?php echo $ncliente; ?>"   />
          <input name="codcon" type="hidden" id="codcon" size="20" />
          <input name="firma" type="hidden" id="firma" onclick="mostrarfirma(this.checked, this.value)" value="0" />
        </span></td>
        </tr>
      <tr>
        <td height="30" colspan="3" ><table width="650" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="172">
<input name="radio" type="hidden" id="radio" value="0" checked onclick="buttons(0)" /></td>
            <td width="159"><input type="hidden" name="radio" id="radio2" value="1" onclick="buttons23(1)" />
              <div id="representante" class="representante" style="display:none; z-index:2;" >
                  <table width="604" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="201" height="29" class="style30"><table width="196" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="16">&nbsp;</td>
                            <td width="180"><span class="titulomenuacto">Contratantes</span></td>
                          </tr>
                      </table></td>
                      <td width="403" align="right" valign="middle"><a href='#' onClick='ocultar_desc('representante')'><img src='iconos/cerrar.png' width='21' height='20' border='0' /></td>
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
            <td width="309"><input type="hidden" name="radio" id="radio3" value="2" onclick="buttons23(2)" /></td>
            </tr>
        </table></td>
        </tr>
    </table></td>
  </tr>
</table>