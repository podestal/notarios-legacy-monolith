<?php 

include("conexion.php");
require_once("../../includes/combo.php")  	  ;

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
<td colspan="5"><input name="nrepresentante" type="text" id="nrepresentante" style="text-transform:uppercase" size="80" maxlength="500" placeholder="nombre y apellido del representado" onkeypress="return tabulador(this, event);return soloLetras(event)"  value="<?php echo $nombre;?>"/>
          
          </td>
          </tr>
       
        <tr>
          <td colspan="6"><span class="camposss">y declara bajo responsabilidad que el(la) incapaz es el(la) titular del documento con el que se ha presentado, y que sus datos personales son:</span></td>
          </tr>
        <tr>
          <td><span class="camposss">Nacionalidad:</span></td>
          <td colspan="2"><?php 
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT nacionalidades.idnacionalidad AS 'id', nacionalidades.descripcion AS 'des'
FROM nacionalidades
ORDER BY nacionalidades.desnacionalidad ASC "; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "150"; 
			$oCombo->name       = "nacionalidad";
			$oCombo->style      = "camposss"; 
			$oCombo->click      = "//selectAsunto(this.value);";   
			$oCombo->selected   = $nacionalidad;
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
			$oCombo->size       = "150"; 
			$oCombo->name       = "ecivil";
			$oCombo->style      = "camposss"; 
			$oCombo->click      = "//selectAsunto(this.value);";   
			$oCombo->selected   =  $idestcivil;
			$oCombo->Show();
			$oCombo->oDesCon(); 
?>          </td>
          <td>&nbsp;</td>
          </tr>
        <tr>
          <td><span class="camposss">Domiciliado:</span></td>
          <td colspan="5"><input name="direccion" type="text" id="direccion" style="text-transform:uppercase" size="100" maxlength="3000" placeholder="direccion" onkeypress="return tabulador(this, event);" onKeyUp="direccion();"  value="<?php echo $direccion;?>"/>
         
          </td>
          </tr>
          <tr>
          	<td><span class="camposss">Partida electronica:</span></td>
              <td colspan="5"><input name="pelectronica" type="text" id="pelectronica" style="text-transform:uppercase" onkeypress="return tabulador(this, event);" size="50"/>
          
          </td>
          </tr>
        <tr>
          <td><span class="camposss">Zona:</span></td>
          <td colspan="5">
           
         
            <table width="522" border="0" cellspacing="0" cellpadding="0">
            
            
      <?php 
		  
		  $sql1=mysql_query("select coddis,concat(nomdis,' ',nomprov,' ',nomdpto) as descripcion from ubigeo where coddis='".$idubigeoos."'",$conn);
		$res=mysql_fetch_assoc($sql1);
		  
		  ?>
          
          
              <tr>
                <td width="428"><input name="ubigen" type="text" id="ubigen" size="60" onKeyUp="return validacion4(this)"  value="<?php echo $res['descripcion'];?>"/></td>
				<td width="105"><input name="idzona" type="hidden" id="idzona" size="15" value="<?php echo $res['coddis'];?>"/>
                <td width="94"><a href="#" onclick="mostrar_desc('buscaubi')"><img src="../../iconos/seleccionar.png" alt="" width="94" height="29" border="0" /></a></td>
              </tr>
            </table><div id="buscaubi" style="position:absolute; display:none; width:637px; height:223px; left: 67px; top: 346px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
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