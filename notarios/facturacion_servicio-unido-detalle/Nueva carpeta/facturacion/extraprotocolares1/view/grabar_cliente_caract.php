<?php 

include("conexion.php");

$tipper=$_POST['tipoper'];
$apepat=strtoupper(str_replace("ñ","Ñ",$_POST['apepat']));
$apemat=strtoupper(str_replace("ñ","Ñ",$_POST['apemat']));
$prinom=strtoupper(str_replace("ñ","Ñ",$_POST['prinom']));
$segnom=strtoupper(str_replace("ñ","Ñ",$_POST['segnom']));
$nombre=strtoupper($apepat." ".$apemat.", ".$prinom." ".$segnom);
$direccion=strtoupper(str_replace("ñ","Ñ",$_POST['direccion']));
$idtipdoc=intval("1");
$numdoc=$_POST['numdoc'];
$email=$_POST['email'];
$telfijo=$_POST['telfijo'];
$telcel=$_POST['telcel'];
$telofi=$_POST['telofi'];
$sexo=$_POST['sexo'];
$idestcivil=intval($_POST['idestcivil']);
$natper=$_POST['natper'];
$nacionalidad=intval($_POST['nacionalidad']);
$idprofesion=intval($_POST['idprofesion']);
$idcargoo=intval($_POST['idcargoo']);
$cumpclie=$_POST['cumpclie'];
$codubisc=$_POST['codubisc'];
$nomprofesiones=$_POST['nomprofesiones'];
$profocupa=$_POST['nomcargoss'];
$cconyuge="0";
$ubigensc=$_POST['ubigensc'];
$residente=$_POST['residente'];
$docpaisemi=$_POST['docpaisemi'];

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


<!-- aca empieza la webada-->
	<table>
        <tr>
          <td width="14%"><span class="camposss">Solicitante:</span></td>
          <td colspan="3"><input name="representacion" type="text" id="representacion" style="text-transform:uppercase" size="100" maxlength="400" onkeypress="return soloLetras(event)" value="<?php echo $apepat." ".$apemat.", ".$prinom." ".$segnom;?>"/>
            
            </td>
        </tr>
      
        <tr>
          <td><span class="camposss">Domicilio:</span></td>
          <td colspan="3"><input name="ndomic_solic" type="text" id="ndomic_solic" style="text-transform:uppercase" size="100" maxlength="2000"  placeholder="Direccion" onKeyUp="domicilio();" value="<?php echo $direccion;?>"/>
                    <input type="hidden" name="domic_solic" style="text-transform:uppercase" id="domic_solic" />
          </td>
          </tr>
        <tr>
        <?php 
		$sql1=mysql_query("select coddis,concat(nomdis,' ',nomprov,' ',nomdpto) as descripcion from ubigeo  where coddis='".$codubisc."'",$conn);
		$res1=mysql_fetch_assoc($sql1);
		?>
          <td><span class="camposss">Distrito:</span></td>
          <td colspan="3"><input name="distrito_solic" value="<?php echo $row['coddis'];?>" type="hidden" id="distrito_solic" size="15" />
            <table width="522" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="428"><input name="ubigen" type="text" value="<?php echo $row['descripcion'];?>" id="ubigen" size="60" onKeyUp="return validacion4(this)"  /></td>
                <td width="94"><a href="#" onclick="mostrar_desc('buscaubi')"><img src="../../iconos/seleccionar.png" alt="" width="94" height="29" border="0" /></a></td>
              </tr>
            </table><div id="buscaubi" style="position:absolute; display:none; width:637px; height:223px; left: 60px; top: 232px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
              <table width="637" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="24" height="29">&nbsp;</td>
                  <td width="585" class="camposss">Seleccionar Zona:</td>
                  <td width="28"><a href="#" onclick="ocultar_desc('buscaubi')"><img src="../../iconos/cerrar.png" width="21" height="20" border="0" /></a></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td><label>
                    <input name="_buscaubi" style="text-transform:uppercase; background:#FFF; text-transform:uppercase" type="text" id="_buscaubi" size="65" onkeypress="buscaubigeos()" />
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
           <tr>
    <td height="30" align="left"><span class="camposss">Prof./Ocupaciòn :</span></td>
    <td height="30" colspan="3"><table width="466" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="254"><label>
          <input name="profesion" value="<?php echo $profocupa;?>" style="text-transform:uppercase"  type="text" id="nomprofesionesc" size="40"   />
           <input name="nomprofesionesc" value="<?php echo $idprofesion;?>" style="text-transform:uppercase"  type="hidden" id="nomprofesionesc" size="40"   />
        </label></td>
        <td width="118"><a id="limprofe" href="#" onclick="mostrar_desc('buscaprofec');focusprofec()"><img src="../../iconos/seleccionar.png" width="94" height="29" border="0" /></a>
        
          <td width="94"><div id="buscaprofec" style="position:absolute; display:none; width:637px; height:223px; left: 50px; top: 296px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
            <table width="637" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="24" height="29">&nbsp;</td>
            <td width="585"><strong><span class="camposss">Seleccionar Profesion:</span></strong></td>
            <td width="28"><a href="#" onclick="ocultar_desc('buscaprofec')"><img src="../../iconos/cerrar.png" width="21" height="20" border="0" /></a></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><label>
              <input name="buscaprofesc" type="text" id="buscaprofesc"  style="background:#FFFFFF; text-transform:uppercase" size="50" onkeypress="buscaprofesionesc()" />
            </label></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><div id="resulprofesionesc" style="width:585px; height:150px; overflow:auto"></div></td>
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

    <td height="30" align="left"><span class="camposss">Estado Civil :</span></td>
    <td height="30">
         <?php
	   	  $civil=mysql_query("SELECT * FROM tipoestacivil where idestcivil='".$idestcivil."'",$conn) or die(mysql_error());
		  $rowcicil=mysql_fetch_array($civil);
		
		?>
    <input name="estado" type="text" id="estado" value="<?php echo $rowcicil['desestcivil'];?>" style="background:#FFFFFF; text-transform:uppercase" size="50" onkeypress="buscaprofesionesc()" />
    <input name="idestcivil" type="hidden" id="idestcivil" value="<?php echo $rowcicil['idestcivil'];?>" style="background:#FFFFFF; text-transform:uppercase" size="50" onkeypress="buscaprofesionesc()" />
</td>
  </tr>
  <tr>

    <td height="30" align="left"><span class="camposss">Sexo :</span></td>
    <td height="30">
    
    <?php 
	
	if($sexo=="M"){
		$nomsexo="MASCULINO";
	}else if($sexo=="F"){
		$nomsexo="FEMENINO";
	}
	
	?>
    <input name="estado" type="text" id="estado" value="<?php echo $nomsexo;?>" style="background:#FFFFFF; text-transform:uppercase" size="50" onkeypress="buscaprofesionesc()" />
   
    <input name="sexo" type="hidden" id="sexo" value="<?php echo $sexo;?>" style="background:#FFFFFF; text-transform:uppercase" size="50" onkeypress="buscaprofesionesc()" />

          <input type="hidden" name="poder_inscrito" id="poder_inscrito" />
</td>

  </tr>
</table>
