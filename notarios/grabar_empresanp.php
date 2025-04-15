<style type="text/css">
.camposss {font-family: Calibri; font-style: italic; font-size: 14px; color: #333333; }
</style>

<?php 
	include("conexion.php");
	require_once("barramenu.php") ;
	require_once("includes/gridView.php")  ;
	require_once("includes/combo.php")  	  ;
	$oBarra = new BarraMenu() 				  ;
	$Grid1 = new GridView()					  ;
	$oCombo = new CmbList()  				  ;	

?>
<?php 

include("conexion.php");

$tipper=$_POST['tipoper'];
$razonsocialtexto=$_POST['razonsocial'];
$referenciatexto=$_POST['nreferencia'];
$cabioapostro=str_replace("'","?",$razonsocialtexto);
$aaaa=str_replace("ñ","Ñ",$cabioapostro);
$razonsocial=strtoupper($aaaa);

$domfiscaltexto=$_POST['domfiscal'];
$cabioapostro2=str_replace("'","?",$domfiscaltexto);
$bbb=str_replace("ñ","Ñ",$cabioapostro2);
$domfiscal=strtoupper($bbb);


$telempresa=$_POST['telempresa'];
$mailempresa=$_POST['mailempresa'];
$contacempresa=strtoupper($_POST['contacempresa']);
$idtipdoc=intval($_POST['tipodoc']);
$numdoc=$_POST['numdoc'];
$fechaconstitu=$_POST['fechaconstitu'];
$numregistro=$_POST['numregistro'];
$numpartida=$_POST['numpartida'];
$actmunicipal=strtoupper($_POST['actmunicipal']);
$codubi=$_POST['codubi'];
$idsedereg3=$_POST['idsedereg3'];

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

$grabarempresac="INSERT INTO cliente (idcliente, tipper, apepat, apemat, prinom, segnom, nombre, direccion, idtipdoc, numdoc, email, telfijo, telcel, telofi, sexo, idestcivil, natper, conyuge, nacionalidad, idprofesion, detaprofesion, idcargoprofe, profocupa, dirfer, idubigeo, cumpclie, fechaing, razonsocial, domfiscal, telempresa, mailempresa, contacempresa, fechaconstitu, idsedereg, numregistro, numpartida, actmunicipal, tipocli, impeingre, impnumof, impeorigen, impentidad, impremite, impmotivo,residente,docpaisemi) VALUES ('$ncliente','$tipper','','','','','','','$idtipdoc','$numdoc','','','','','',0,'','','0',0,'','0','','','$codubi','','','$razonsocial','$domfiscal','$telempresa','$mailempresa','$contacempresa','$fechaconstitu','$idsedereg3','$numregistro','$numpartida','$actmunicipal','0','','','','','','','','')";
mysql_query($grabarempresac,$conn) or die(mysql_error());
 
?>

<table width="684" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="33">&nbsp;</td>
    <td width="651"><table width="640" border="0" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
      <tr>
        <td height="30" ><span class="camposss">Razón Social</span></td>
        <td height="30"><input name="apepat" type="text"  style="text-transform:uppercase"   id="apepat" value="<?php echo $razonsocial; ?>" size="60" /></td>
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
                                    <td width="95"><a href='#' onClick="ocultar_desc('menucondicion')"><img src="../../iconos/aceptar.png" width="95" height="29" border="0" /></a></td>
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
        <td height="30" ><input type="hidden" name="docum" style="text-transform:uppercase" id="docum" value="<?php echo strtoupper($numdoc); ?>" /></td>
      </tr>
      <tr>
        <td width="112" height="30" ><span class="camposss">Condicion</span></td>
        <td height="30"><?php 

			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT c_protesto.id_condicionp AS 'id', c_protesto.des_condicionp AS 'des' FROM c_protesto 
 ORDER BY des_condicionp ASC"; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "160"; 
			$oCombo->name       = "c_condicontrat";
			$oCombo->style      = "camposss"; 
			$oCombo->click      = "//fEvalCondi()";   
			$oCombo->Show();
			$oCombo->oDesCon(); 
?><span style="color:#F00; font-size:20px"><strong> *</strong></span></td>
        <td width="126" height="30" >&nbsp;</td>
      </tr>
      
      <tr>
        <td height="30" colspan="3" ><span class="camposss">
          <input type="hidden" name="codclie" id="codclie" value="<?php echo $row['idcliente']; ?>"   />
          </span></td>
      </tr>
    </table></td>
  </tr>
</table>