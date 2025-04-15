<style type="text/css">
.btnpatrimonial {color: #FFFFFF; font-family: Calibri; font-style: italic; font-weight: bold; }
.titupatrimo {font-size: 12; font-style: italic; font-family: Calibri;}

</style>
<link rel="stylesheet" type="text/css" href="tcal.css" />
<script type="text/javascript" src="tcal.js"></script>

<script language="JavaScript" type="text/javascript" src="js/prototype.js" ></script>
<script language="javascript" >
function IsNumeric(valor) 
{ 
var log=valor.length; var sw="S"; 
for (x=0; x<log; x++) 
{ v1=valor.substr(x,1); 
v2 = parseInt(v1); 
//Compruebo si es un valor numérico 
if (isNaN(v2)) { sw= "N";} 
} 
if (sw=="S") {return true;} else {return false; } 
} 
var primerslap=false; 
var segundoslap=false; 
function formateafecha(fecha) 
{ 
var long = fecha.length; 
var dia; 
var mes; 
var ano; 
if ((long>=2) && (primerslap==false)) { dia=fecha.substr(0,2); 
if ((IsNumeric(dia)==true) && (dia<=31) && (dia!="00")) { fecha=fecha.substr(0,2)+"/"+fecha.substr(3,7); primerslap=true; } 
else { fecha=""; primerslap=false;} 
} 
else 
{ dia=fecha.substr(0,1); 
if (IsNumeric(dia)==false) 
{fecha="";} 
if ((long<=2) && (primerslap=true)) {fecha=fecha.substr(0,1); primerslap=false; } 
} 
if ((long>=5) && (segundoslap==false)) 
{ mes=fecha.substr(3,2); 
if ((IsNumeric(mes)==true) &&(mes<=12) && (mes!="00")) { fecha=fecha.substr(0,5)+"/"+fecha.substr(6,4); segundoslap=true; } 
else { fecha=fecha.substr(0,3);; segundoslap=false;} 
} 
else { if ((long<=5) && (segundoslap=true)) { fecha=fecha.substr(0,4); segundoslap=false; } } 
if (long>=7) 
{ ano=fecha.substr(6,4); 
if (IsNumeric(ano)==false) { fecha=fecha.substr(0,6); } 
else { if (long==10){ if ((ano==0) || (ano<1900) || (ano>2100)) { fecha=fecha.substr(0,6); } } } 
} 
if (long>=10) 
{ 
fecha=fecha.substr(0,10); 
dia=fecha.substr(0,2); 
mes=fecha.substr(3,2); 
ano=fecha.substr(6,4); 
// Año no viciesto y es febrero y el dia es mayor a 28 
if ( (ano%4 != 0) && (mes ==02) && (dia > 28) ) { fecha=fecha.substr(0,2)+"/"; } 
} 
return (fecha); 
}

function activaotro(){
	
document.getElementById('div_otroidoppago2').style.display="";
}

</SCRIPT>
<?php session_start();

// cklas
include("conexion.php")					  ;
require_once("includes/combo.php")  	  ;

//clase combo aumenta el tiempo de carga en la pagina, se recomienda cambiarlo por html + php
$oCombo = new CmbList()  				  ;



$itemmp  = $_POST['itemmp'];
$idtacto = $_POST['idtacto'];
$kardex  = $_POST['kardex'];


$_SESSION['actopatri']=$_POST['idtacto'];
//$_SESSION['varitem']=$_REQUEST['realitemmp'];
$_SESSION['varitem']=$_REQUEST['itemmp'];

//para otro
$sqlotro=mysql_query("SELECT idoppago FROM patrimonial where kardex='$kardex' and idtipoacto='".$_SESSION['actopatri']."' and itemmp='".$_REQUEST['itemmp']."'",$conn);
$otro = mysql_fetch_array($sqlotro);


// para vehicular:
$sqltpagov = mysql_query("SELECT * FROM mediospago",$conn) or die(mysql_error());
$sqlmonv   = mysql_query("SELECT * FROM monedas",$conn) or die(mysql_error()); 

$consulvehic = mysql_query("SELECT * FROM detallevehicular WHERE detallevehicular.kardex='".$kardex."' AND detallevehicular.idtipacto='".$idtacto."'", $conn) or die(mysql_error());

$rowvehi = mysql_fetch_array($consulvehic);

//////////////////

$sqlxxx=mysql_query("SELECT * FROM detalle_actos_kardex where kardex='".$kardex."' and idtipoacto='".$idtacto."'",$conn) or die(mysql_error()); 
$rowdetaacto = mysql_fetch_array($sqlxxx);

$sqlmon=mysql_query("SELECT * FROM monedas",$conn) or die(mysql_error()); 

// sedes registrales
$sqlsedess=mysql_query("SELECT * FROM sedesregistrales",$conn) or die(mysql_error()); 


$sqloporpago = mysql_query("SELECT * FROM oporpago",$conn) or die(mysql_error());

$sqlpatrimonio = mysql_query("SELECT * FROM patrimonial WHERE patrimonial.itemmp='".$itemmp."'", $conn) or die(mysql_error());
$rowpat = mysql_fetch_array($sqlpatrimonio);

$sqldetallebien = mysql_query("SELECT * FROM detallebienes WHERE detallebienes.kardex='".$kardex."' AND detallebienes.idtipacto = '".$idtacto."'", $conn) or die(mysql_error());
$rowdbien = mysql_fetch_array($sqldetallebien);

$sqltbienn   = mysql_query("SELECT * FROM tipobien",$conn) or die(mysql_error());

// ubigeo:
$consulbienubi=mysql_query("SELECT CONCAT(ubigeo.nomdpto,'/',ubigeo.nomprov,'/',ubigeo.nomdis) 
FROM ubigeo
INNER JOIN detallebienes ON detallebienes.coddis = ubigeo.coddis
WHERE detallebienes.coddis = '".$rowdbien['coddis']."'", $conn) or die(mysql_error());
$rowubigeo = mysql_fetch_array($consulbienubi);

?>

<table width="718" border="1" cellpadding="0" cellspacing="0" bordercolor="#333333">
                                    <tr>
                                      <td width="236" height="35" align="center" bgcolor="#666666"><a onClick="validarpago2()"><span class="btnpatrimonial">Medio de Pago/Tipo de fondo</span></a></td>
                                      <td width="215" align="center" bgcolor="#666666"><a onClick="validarbien2()"><span class="btnpatrimonial">Información del Bien</span></a></td>
                                      
                                    </tr>
                                    <tr>
                                      <td height="312" colspan="3" valign="top">
                                        <div id="vpago2" style="display:">
                                            <table width="700" border="0" cellspacing="0" cellpadding="0">
                                           <!-- <tr><td><a href="#" onClick="refreshvpago();">Nuevo</a>&nbsp;&nbsp;<a href="#" onClick="listavpago();">Listar</a></td></tr> -->
                                              <tr>
                                                <td><table width="705" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                      <td height="19">&nbsp;</td>
                                                      <td width="131" height="19">&nbsp;</td>
                                                      <td width="270" height="19"><label>
                                                        <input type="hidden" name="idttiippooacto2" id="idttiippooacto2" value="<?php echo $rowpat['idtipoacto']; ?>" />
                                                        <input type="hidden" name="itemmp3" id="itemmp3" value="<?php echo $rowpat['itemmp']; ?>" />
                                                      </label></td>
                                                      <td width="113" height="19"><div id="cumbral2"></div></td>
                                                      <td width="176" height="19">&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td height="19">&nbsp;</td>
                                                      <td height="30" align="center"><span class="titupatrimo">Forma de Pago:</span></td>
                                                      <td height="30"><?php /*
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT fpago_uif.id_fpago AS 'id', fpago_uif.descripcion AS 'des'
FROM fpago_uif"; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "130"; 
			$oCombo->name       = "fpago3";
			$oCombo->style      = ""; 
			$oCombo->click      = "//selectAsunto(this.value);";   
			$oCombo->selected   =  $rowpat['fpago'];
			$oCombo->Show();
			$oCombo->oDesCon(); */
			
			echo "<select name='fpago3'  id='fpago3' onchange='selectAsunto(this.value);' style='width:130px'>";
echo "<option value=''></option>";	
$combo1 = mysql_query( "SELECT fpago_uif.id_fpago AS 'id', fpago_uif.descripcion AS 'des'
FROM fpago_uif group by fpago_uif.id_fpago",$conn);
			while ($rs1=mysql_fetch_assoc($combo1)){
				echo "<option value='".$rs1['id']."'";
				
			if($rs1['id']==$rowpat['fpago']){
				 echo "selected='selected'";
			}
			echo ">".$rs1['des']."</option>";
			}
			echo "</select>";
			
?></td>
                                                      <td height="30"><span class="titupatrimo">Oport. de Pago</span></td>
                                                      <td height="30"><?php /*
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT oporpago.codoppago AS 'id', oporpago.desoppago AS 'des' 
FROM oporpago"; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "130"; 
			$oCombo->name       = "idoppago2";
			$oCombo->style      = ""; 
			$oCombo->click      = "eval_idoppago2(this.value);";   
			$oCombo->selected   =  $rowpat['idoppago'];
			$oCombo->Show();
			$oCombo->oDesCon(); */
			
			echo "<select name='idoppago2' id='idoppago2' onchange='eval_idoppago2(this.value);' style='width:130px'>";
			echo "<option value=''></option>";
			$combo2 = mysql_query( "SELECT oporpago.codoppago AS 'id', oporpago.desoppago AS 'des' 
FROM oporpago",$conn);
			while ($rs2=mysql_fetch_assoc($combo2)){
								

			echo "<option value='".$rs2['id']."'";
			if($rs2['id']==$rowpat['idoppago']){
				echo "selected='selected'";
			}
			echo ">".$rs2['des']."</option>";
			}
			echo "</select>";


if($otro['idoppago']==99){
	


echo '<a href="#" onClick="activaotro()"><img src="iconos/edit_x.png" width="21" height="20" border="0" /></a>';

} ?>

<div id="div_otroidoppago2" style="display:none; width:350px; height:71px; border:#003366 solid 1px; background:#CCCCCC; position:absolute; left: 450px; top: 100px; z-index:200">
                                                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                <tr>
                                                                  <td width="79">&nbsp;</td>
                                                                  <td width="269" align="right"><a href="#" onClick="ocultar_desc('div_otroidoppago2')"><img src="iconos/cerrar.png" width="21" height="20" border="0" /></a></td>
                                                                </tr>
                                                                <tr>
                                                                  <td>                                                                    Descripcion</td>
                                                                  <td><span class="titupatrimo">
                                                                    <input name="otroidoppago2" style="background:#FFFFFF; text-transform:uppercase;" type="text" id="otroidoppago2" size="35" value="<?php echo $rowpat['des_idoppago']; ?>" />
                                                                  </span></td>
                                                                </tr>
                                                                <tr>
                                                                  <td colspan="2">&nbsp;</td>
                                                                </tr>
                                                              </table>
                                                          </div></td>
                                                    </tr>
                                                    <tr>
                                                      <td height="19">&nbsp;</td>
                                                      <td height="30" align="center"><span class="titupatrimo">Tipo de Acto:</span></td>
                                                      <td height="30"><div id="tpacto2" style="display:"><input name="tipoactopatriDes" type="text" id="tipoactopatriDes" style="background:#FFFFFF" value="<?php echo $rowdetaacto['desacto']; ?>" size="30" readonly="readonly" /><input type="hidden" name="tipoactopatrix" id="tipoactopatrix" value="<?php echo $rowdetaacto['idtipoacto']; ?>" /></div></td>
                                                      <td height="30" class="titupatrimo">Fecha Minuta</td>
                                                      <td height="30"><label>
                                                        <input name="nnminuta2" type="text"  class="tcal" id="nnminuta2" size="10" value="<?php echo $rowpat['nminuta']; ?>" />
                                                      </label></td>
                                                    </tr>
                                                    <tr>
                                                      <td width="15" height="30">&nbsp;</td>
                                                      <td height="30" align="center"><span class="titupatrimo">Importe de laTransaccion:</span></td>
                                                      <td height="30"><span class="titupatrimo">
                                                        <label></label>
                                                        <input style="text-align:right;" name="imptrans2"  type="text" id="imptrans2" size="15" value="<?php echo $rowpat['importetrans']; ?>" onkeypress="return NumCheck(event, this);" />
                                                      </span></td>
                                                      <td height="30"><span class="titupatrimo">Tipo Moneda</span></td>
                                                      <td height="30"><span class="titupatrimo">
                                                        <?php /*
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT monedas.idmon AS 'id', monedas.desmon AS 'des'
FROM monedas"; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "130"; 
			$oCombo->name       = "tipomoneda2";
			$oCombo->style      = ""; 
			$oCombo->click      = "//selectAsunto(this.value);";   
			$oCombo->selected   =  $rowpat['idmon'];
			$oCombo->Show();
			$oCombo->oDesCon(); */
			
			echo "<select name='tipomoneda2' id='tipomoneda2' onchange='selectAsunto(this.value);' style='width:130px'>";
			echo "<option value=''></option>";
			$combo3 = mysql_query( "SELECT monedas.idmon AS 'id', monedas.desmon AS 'des'
FROM monedas group by monedas.idmon",$conn);
			while ($rs3=mysql_fetch_assoc($combo3)){
			
			echo "<option value='".$rs3['id']."'";
			
			if($rs3['id']==$rowpat['idmon']){
				echo " selected='selected' ";
			}
			
			echo ">".$rs3['des']."</option>";
			}
			echo "</select>";			
?>                                            </span></td>
                                                    </tr>
                                                    <tr>
                                                      <td height="30">&nbsp;</td>
                                                      <td height="30" align="center"><span class="titupatrimo">Exhibio medio de pago</span></td>
                                                      <td height="30"><span class="titupatrimo">
                                                        <label></label>
                                                        <select name="exibio2" id="exibio2" onChange="vermedio(this.value)">
                                                          <option <?php if($rowpat['exhibiomp']=="SI") echo "selected"; ?> value="SI">SI</option>
                                                          <option <?php if($rowpat['exhibiomp']=="NO") echo "selected"; ?> value="NO" >NO</option>
                                                        </select>
                                                      </span></td>
                                                      <td height="30"><span class="titupatrimo">Tipo de Cambio</span></td>
                                                      <td height="30"><span class="titupatrimo">
                                                        <input name="tipcambio2" style="background:#FFFFFF; text-align:right;" type="text" id="tipcambio2" size="10" value="<?php echo $rowpat['tipocambio']; ?>" onkeypress="return NumCheck(event, this);" onkeyup="validar_tc(this.value)"/>
                                                      </span> <a href="http://www.sbs.gob.pe/principal/categoria/tipo-de-cambio/147/c-147" target="_blank" onclick="window.open(this.href,this.target,'width=400,height=400,top=200,left=200,toolbar=no,location=no,status=no,menubar=no');return false;">Consultar</a>  </td>
                                                    </tr>
                                                    <tr>
                                                      <td height="30" rowspan="2">&nbsp;</td>
                                                      <td height="30" align="center">&nbsp;</td>
                                                      <td height="30"><div id="ittmp2"></div></td>
                                                      <td height="30">&nbsp;</td>
                                                      <td height="0"><div id="gbrmp2" style="display:"><a href="#" onClick="grabarmediopago3()"><img src="iconos/grabar.png" width="94" height="29" border="0" /></a></div>
                                                          <div id="editmp2" style="display:none"><a href="#" onClick="editarmediopago()"><img src="iconos/grabarmodi.png" width="94" height="29" border="0" /></a></div></td>
                                                    </tr>
                                                    <tr>
                                                      <td height="30" colspan="5"><div id="newpagoo2" style="display:none;">
                                                          <table width="671" border="0" align="center" cellpadding="0" cellspacing="0">
                                                            <tr>
                                                              <td width="101" height="34"><a href="#" onClick="mmmppp2()"><img src="iconos/neww2.png" width="94" height="29" border="0" /></a></td>
                                                              <td width="570"><a href="#" onClick="mostrar_desc('listmedpago2');ocultar_desc('regmedpago2')"><img src="iconos/neww3.png" width="94" height="29" border="0" /></a></td>
                                                            </tr>
                                                            <tr>
                                            <td colspan="2"><div id="regmedpago2" style="display:none; border: #003366 solid 1px; background-color:#CCCCCC; position:absolute; width: 729px; left: 5px; top: 224px; height: 189px;">
                                                      <table width="726" border="0" cellspacing="0" cellpadding="0">
                                                            <tr>
                                                                      <td>&nbsp;</td>
                                                                      <td height="30" colspan="3" class="Estilo23 Estilo43">Nuevo Medio de Pago/Tipo de fondo</td>
                                                                      <td height="30"><table width="200" border="0" cellpadding="0" cellspacing="0">
                                                                  <tr>
                                                                            <td width="176">&nbsp;</td>
                                                                            <td width="24"><a href="#" onClick="ocultar_desc('regmedpago2')"><img src="iconos/cerrar.png" alt="" width="21" height="20" border="0" /></a></td>
                                                                        </tr>
                                                                      </table></td>
                                                                </tr>
                                                                    <tr>
                                                                      <td width="15">&nbsp;</td>
                                                                      <td width="150" height="30"><span class="titupatrimo">M. Pago/T. fondo</span></td>
                                                                      <td width="250" height="30"><?php /*
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT mediospago.codmepag AS 'id', mediospago.desmpagos AS 'des' 
FROM mediospago ORDER BY des ASC"; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "130"; 
			$oCombo->name       = "mediopago3";
			$oCombo->style      = ""; 
			$oCombo->click      = "//selectAsunto(this.value);";   
			//$oCombo->selected   =  $rowpat['fpago'];
			$oCombo->Show();
			$oCombo->oDesCon(); */
			
			echo "<select name='mediopago3'  id='mediopago3' onchange='selectAsunto(this.value);' style='width:130px'>";
			echo "<option value=''></option>";
			$combo4 = mysql_query( "SELECT mediospago.codmepag AS 'id', mediospago.desmpagos AS 'des', mediospago.sunat 
FROM mediospago ORDER BY des ASC",$conn);
			while ($rs4=mysql_fetch_assoc($combo4)){
			
			echo "<option value='".$rs4['id']."'";
			
			if($rs4['id']==$rowpat['fpago']){
				echo " selected='selected' ";
			}
			
      echo ">".$rs4['sunat']." - ".$rs4['des']."</option>";
			
			
			}
			echo "</select>";				
?></td>
                                                                      <td width="170" height="30"><span class="titupatrimo">Importe M. Pago/T. fondo</span></td>
                                                                      <td width="206" height="30"><span class="titupatrimo">
                                                                    <label></label>
                                                                        <input name="impmediopago3" style="background:#FFFFFF; text-align:right;" type="text" id="impmediopago3" size="20" />
                                                                      </span></td>
                                                                </tr>
                                                                    <tr>
                                                                      <td>&nbsp;</td>
                                                                      <td height="30"><span class="titupatrimo">Entidad Financiera</span></td>
                                                                      <td height="30">
                                                                      <input name="itemmpxx" type="hidden" id="itemmpxx" value="<?php echo $_REQUEST['realitemmp']; ?>" />
																	  <?php /*
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT bancos.idbancos AS 'id', bancos.desbanco AS 'des' 
FROM bancos ORDER BY des ASC"; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "130"; 
			$oCombo->name       = "entidadfinanciera3";
			$oCombo->style      = ""; 
			$oCombo->click      = "//selectAsunto(this.value);";   
			//$oCombo->selected   =  $rowpat['fpago'];
			$oCombo->Show();
			$oCombo->oDesCon(); */
			
			echo "<select name='entidadfinanciera3' id='entidadfinanciera3' onchange='selectAsunto(this.value);' style='width:130px'>";
			echo "<option value=''></option>";
			$combo5 = mysql_query( "SELECT bancos.idbancos AS 'id', bancos.desbanco AS 'des' 
FROM bancos ORDER BY des ASC",$conn);
			while ($rs5=mysql_fetch_assoc($combo5)){
			
			echo "<option value='".$rs5['id']."'";
			if($rs5['id']==$rowpat['fpago']){
				echo " selected='selected' ";
			}
			echo ">".$rs5['des']."</option>";
			}
			echo "</select>";			
?></td>
                                                                      <td height="30" class="titupatrimo">Fecha de Operación</td>
                                                                      <td height="30"><label><span class="titupatrimo">
                                                                      <input name="fechaoperacion3" style="background:#FFFFFF" type="text" id="fechaoperacion3" class="tcal" size="20" />
                                                                      </span></label></td>
                                                                    </tr>
                                                                    <tr>
                                                                      <td>&nbsp;</td>
                                                                      <td height="30"><span class="titupatrimo">Tipo Moneda</span></td>
                                                                    <td height="30"><?php /*
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT monedas.idmon AS 'id', monedas.desmon AS 'des' 
FROM monedas WHERE monedas.idmon<>'3'"; //  
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "130"; 
			$oCombo->name       = "idmon_mp3";
			$oCombo->style      = ""; 
			$oCombo->click      = "//selectAsunto(this.value);";   
			$oCombo->selected   = "2";
			$oCombo->Show();
			$oCombo->oDesCon(); */
			
			echo "<select name='idmon_mp3'  id='idmon_mp3' onchange='selectAsunto(this.value);' style='width:130px'>";
			echo "<option value=''></option>";
			$combo6 = mysql_query( "SELECT monedas.idmon AS 'id', monedas.desmon AS 'des' 
FROM monedas WHERE monedas.idmon<>'3'",$conn);
			while ($rs6=mysql_fetch_assoc($combo6)){
			
			echo "<option value='".$rs6['id']."'";
			
			if($rs6['id']==2){
				echo " selected='selected' ";
			}
			
			echo ">".$rs6['des']."</option>";
			}
			echo "</select>";			
?></td>
                                                                      <td height="30">&nbsp;</td>
                                                                      <td height="30">&nbsp;</td>
                                                                    </tr>
                                                                    <tr>
                                                                      <td>&nbsp;</td>
                                                                      <td height="30"><span class="titupatrimo">Documentos</span></td>
                                                                      <td height="30" colspan="2"><span class="titupatrimo">
                                                                        <input name="documentos3" style="background:#FFFFFF" type="text" id="documentos3" size="50" />
                                                                      </span></td>
                                                                      <td height="30"><span class="titupatrimo"><a href="#" onClick="newgbrmp2()"><img src="iconos/grabar.png" width="94" height="29" border="0" /></a></span></td>
                                                                    </tr>
                                                              </table>
                                                              </div>
                                                            <div id="listmedpago2" style="display:none; width:680px; height:100px; overflow:auto;"></div>
                                                            <!-- DIV ACTUALIZAR MEDIO DE PAGO -->
                                                            <div id="vermediopagoedit2" style="display:none; border: #003366 solid 1px; background-color:#CCCCCC; position:absolute; width: 729px; left: 5px; top: 224px; height: 189px;"></div>
                                                           
                                                            </td>
                                                            </tr>
                                                          </table>
                                                      </div></td>
                                                    </tr>
                                                </table></td>
                                              </tr>
                                              <tr>
                                                <td>&nbsp;</td>
                                              </tr>
                                            </table>
                                        </div>
                                        <div id="vbien2" style="display:none">
                                            <table width="710" border="0" cellspacing="0" cellpadding="0">
                                              <tr>
                                                <td width="18">&nbsp;</td>
                                                <td width="692"><img src="iconos/biennes.png" alt="" width="181" height="25" border="0" usemap="#Map_listado" /></td>
                                              </tr>
                                              <tr>
                                                <td>&nbsp;</td>
                                                <td><div id="newbiennnes2" style="display:none">
                                                  <table width="680" border="0" align="center" cellpadding="0" cellspacing="0">
                                                      <tr>
                                                        <td height="19"><input name="itemmp4" type="hidden" id="itemmp4" value="<?php echo $rowdbien['itemmp']; ?>" /></td>
                                                        <td height="19">&nbsp;</td>
                                                        <td height="19">&nbsp;</td>
                                                        <td height="19">&nbsp;</td>
                                                      </tr>
                                                      <tr>
                                                        <td width="135" height="30"><span class="titupatrimo">Tipo</span></td>
                                                        <td width="208" height="30"><span class="titupatrimo">
                                                        <?php /*
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT tipbien.des_tipbien AS 'id', tipbien.des_tipbien AS 'des' FROM tipbien"; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "150"; 
			$oCombo->name       = "tipob2";
			$oCombo->style      = ""; 
			$oCombo->click      = "//selectAsunto(this.value);";   
			//$oCombo->selected   =  $rowdbien['tipob'];
			$oCombo->Show();
			$oCombo->oDesCon(); */
			echo "<select name='tipob2' id='tipob2' onchange='selectAsunto(this.value);' style='width:150px'>";
			echo "<option value=''></option>";
			$combo7 = mysql_query( "SELECT tipbien.des_tipbien AS 'id', tipbien.des_tipbien AS 'des' FROM tipbien",$conn);
			while ($rs7=mysql_fetch_assoc($combo7)){
			
			echo "<option value='".$rs7['id']."'";
			
			if($rs7['id']==$rowdbien['tipob']){
				echo " selected='selected' ";
			}
			echo ">".$rs7['des']."</option>";
			}
			echo "</select>";	
?>
                                                        </span></td>
                                                        <td width="118" height="30"><span class="titupatrimo">Partida Registral</span></td>
                                                        <td width="219" height="30"><span class="titupatrimo"><input name="pregis3" type="text" id="pregis3" size="20"  /></span></td>
                                                      </tr>
                                                      <tr>
                                                        <td height="30"><span class="titupatrimo">Bien-Acto Jurídico</span></td>
                                                        <td height="30"><span class="titupatrimo">
                                                        <?php /*
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT tipobien.idtipbien AS 'id', tipobien.desestcivil AS 'des' 
FROM tipobien ORDER BY tipobien.desestcivil ASC"; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "150"; 
			$oCombo->name       = "tipobien2";
			$oCombo->style      = ""; 
			$oCombo->click      = "enviarvalore3(this.value);";   
			//$oCombo->selected   = $rowdbien['idtipbien'];
			$oCombo->Show();
			$oCombo->oDesCon(); */
			echo "<select name='tipobien2' id='tipobien2' onchange='enviarvalore3(this.value);' style='width:130px;'>";
			echo "<option value=''></option>";
			$combo8 = mysql_query( "SELECT tipobien.idtipbien AS 'id', tipobien.desestcivil AS 'des' 
FROM tipobien ORDER BY tipobien.desestcivil ASC",$conn);
			while ($rs8=mysql_fetch_assoc($combo8)){
			
			echo "<option value='".$rs8['id']."'";
			
			if($rs8['id']==$rowdbien['idtipbien']){
				echo " selected='selected' ";
			}
			echo ">".$rs8['des']."</option>";
			}
			echo "</select>";	
?>
                                                        </span></td>
                                                        <td height="30"><span class="titupatrimo">Sede Registral</span></td>
                                                        <td height="30"><span class="titupatrimo">
<?php /*
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT sedesregistrales.idsedereg AS 'id', sedesregistrales.dessede AS 'des'
FROM sedesregistrales"; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "150"; 
			$oCombo->name       = "idsedereg3";
			$oCombo->style      = "camposss"; 
			$oCombo->click      = "//selectAsunto(this.value);";   
			//$oCombo->selected   =  $rowdbien['idsedereg'];
			$oCombo->Show();
			$oCombo->oDesCon(); */
			echo "<select name='idsedereg3' id='idsedereg3' onchange='selectAsunto(this.value);' style='width:150px'>";
			echo "<option value=''></option>";
			$combo9 = mysql_query( "SELECT sedesregistrales.idsedereg AS 'id', sedesregistrales.dessede AS 'des'
FROM sedesregistrales",$conn);
			while ($rs9=mysql_fetch_assoc($combo9)){
			
			echo "<option value='".$rs9['id']."'";
			
			if($rs9['id']==$rowdbien['idsedereg']){
				echo " selected='selected' ";
			}
			
			echo ">".$rs9['des']."</option>";
			}
			echo "</select>";	
?>
                                                        </span></td>
                                                        <td height="30">&nbsp;</td>
                                                      </tr>

  <!-- <tr>
    <td colspan="4">
      <table id="predio" style="display:none;width:100%;border:1px solid black; border-radius:5px;padding-bottom:.5em">
          <thead>
            <tr>
              <th colspan="5" class="titupatrimo">DATOS DEL PREDIO</th>
            </tr>
          </thead>
          <tbody>
              <tr>
                <td class="titupatrimo">TIPO DE VIA</td>
                <td class="titupatrimo"><input type="text"></td>
                <td class="titupatrimo">LOTE</td>
                <td class="titupatrimo"><input type="text"></td>

              </tr>
              <tr>
              <td class="titupatrimo">NOMBRE DE VIA</td>
                <td class="titupatrimo"><input type="text"></td>
                <td class="titupatrimo">MANZANA</td>
                <td class="titupatrimo"><input type="text"></td>
                
              </tr>

              <tr>
                <td class="titupatrimo">NUMERO</td>
                <td class="titupatrimo"><input type="text"></td>
                
                
              </tr>
          </tbody>
      </table>
    </td>
  </tr> -->

                                                      <tr>
                                                        <td height="30"><span class="titupatrimo">Ubigeo</span></td>
                                                        <td height="30" colspan="2"><input name="ubigens2" type="text" id="ubigens2"  size="45" /></td>
                                                        <td height="30"><a id="_busUbiPatr2" href="#" onClick="mostrar_desc('buscaubis3')"><img src="iconos/seleccionar.png" width="94" height="29" border="0" /></a>
                                                            <div id="buscaubis3" style="position:absolute; display:none; width:637px; height:223px; left: 14px; top: 162px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
                                                              <table width="637" border="0" cellspacing="0" cellpadding="0">
                                                                <tr>
                                                                  <td width="24" height="29">&nbsp;</td>
                                                                  <td width="585" class="titupatrimo">Seleccionar Ubigeo:</td>
                                                                  <td width="28"><a href="#" onClick="ocultar_desc('buscaubis3')"><img src="iconos/cerrar.png" width="21" height="20" border="0" /></a></td>
                                                                </tr>
                                                                <tr>
                                                                  <td>&nbsp;</td>
                                                                  <td><label>
                                                                    <input name="buscaubisx" type="text" style="background:#FFFFFF; text-transform:uppercase;" id="buscaubisx" size="60"  onkeyup="buscaubigeoss3()" />
                                                                  </label></td>
                                                                  <td>&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                  <td>&nbsp;</td>
                                                                  <td><div id="resulubis3" style="width:585px; height:150px; overflow:auto"></div></td>
                                                                  <td>&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                  <td>&nbsp;</td>
                                                                  <td>&nbsp;</td>
                                                                  <td>&nbsp;</td>
                                                                </tr>
                                                              </table>
                                                            </div>
                                                          <input name="codubis2" type="hidden" id="codubis2" size="15" /></td>
                                                      </tr>
                                                      <tr>
                                                        <td height="15"><span class="titupatrimo">Fecha de Add. o Cons.</span></td>
                                                        <td height="15"><span class="titupatrimo">
                                                          <label></label>
                                                          <label>
                                                          <input type="text" name="fechaconst2"  class="tcal" id="fechaconst2" onKeyUp = "this.value=formateafecha(this.value);"   />
                                                          </label>
                                                        </span></td>
                                                        <td height="30" align="center">&nbsp;</td>
                                                        <td height="30"><a href="#" id="_saveNewBien2"><img src="iconos/grabar.png" width="94" height="29" border="0" /></a></td>
                                                      </tr>
                                                      <tr>

                                                        <td height="15"><div id="vterrestres3" style="display:none; width:691px; height:83px; border:#003366 solid 1px; background:#CCCCCC; position:absolute; left: 21px; top: 250px; z-index:2000;">
                                                            <table width="671" border="0" cellspacing="0" cellpadding="0">
                                                              <tr>
                                                                <td width="26" >&nbsp;</td>
                                                                <td width="118">&nbsp;</td>
                                                                <td width="138">&nbsp;</td>
                                                                <td width="135">&nbsp;</td>
                                                                <td width="254" align="right"><a href="#" onClick="ocultar_desc('vterrestres3')"><img src="iconos/cerrar.png" width="21" height="20" border="0" /></a></td>
                                                              </tr>
                                                              <tr>
                                                                <td><label></label></td>
                                                                <td class="titupatrimo"><input type="radio" name="radio3" id="radio3" value="P" onClick="selecpsm(this.value)" />
                                                                  N° de Placa </td>
                                                                <td class="titupatrimo"><input type="radio" name="radio3" id="radio4" value="S" onClick="selecpsm(this.value)" />
                                                                  N° de Serie</td>
                                                                <td class="titupatrimo"><input type="radio" name="radio3" id="radio5" value="M" onClick="selecpsm(this.value)" />
                                                                  N° de Motor</td>
                                                              <td><label>
                                                                  <input class="text" type="text" name="npsm3" style="background:#FFFFFF; text-transform:uppercase;" id="npsm3" value="<?php echo $rowdbien['npsm']; ?>" />
                                                                </label></td>
                                                              </tr>
                                                              <tr>
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                                <td><label>
                                                                  <input type="hidden" name="tpsm3" id="tpsm3" value="<?php echo $rowdbien['tpsm']; ?>" />
                                                                </label></td>
                                                              </tr>
                                                            </table>
                                                        </div>
                                                            <div id="mequipos3" style="display:none; width:674px; height:71px; border:#003366 solid 1px; background:#CCCCCC; position:absolute; left: 25px; top: 250px; z-index:2000;">
                                                              <table width="661" border="0" cellspacing="0" cellpadding="0">
                                                                <tr>
                                                                  <td width="32">&nbsp;</td>
                                                                  <td width="101">&nbsp;</td>
                                                                  <td width="128">&nbsp;</td>
                                                                  <td width="55">&nbsp;</td>
                                                                  <td width="345" align="right"><a href="#" onClick="ocultar_desc('mequipos3')"><img src="iconos/cerrar.png" width="21" height="20" border="0" /></a></td>
                                                                </tr>
                                                                <tr>
                                                                  <td><label></label></td>
                                                                  <td colspan="3" align="center" class="titupatrimo"> N° de Serie para Maquinaris y Equipos</td>
                                                                  <td><label>
                                                                    <input class="text" type="text" name="smaquiequipo3" style="background:#FFFFFF; text-transform:uppercase;" id="smaquiequipo3" value="<?php echo $rowdbien['smaquiequipo']; ?>" />
                                                                  </label></td>
                                                                </tr>
                                                                <tr>
                                                                  <td>&nbsp;</td>
                                                                  <td>&nbsp;</td>
                                                                  <td>&nbsp;</td>
                                                                  <td>&nbsp;</td>
                                                                  <td>&nbsp;</td>
                                                                </tr>
                                                              </table>
                                                            </div>
                                                          <div id="oespecificos3" style="display:none; width:652px; height:71px; border:#003366 solid 1px; background:#CCCCCC; position:absolute; left: 23px; top: 250px; z-index:2000;">
                                                              <table width="629" border="0" cellspacing="0" cellpadding="0">
                                                                <tr>
                                                                  <td width="69">&nbsp;</td>
                                                                  <td width="55">&nbsp;</td>
                                                                  <td width="120">&nbsp;</td>
                                                                  <td width="190">&nbsp;</td>
                                                                  <td width="195" align="right"><a href="#" onClick="ocultar_desc('oespecificos3')"><img src="iconos/cerrar.png" width="21" height="20" border="0" /></a></td>
                                                                </tr>
                                                                <tr>
                                                                  <td><label></label></td>
                                                                  <td colspan="3" align="center" class="titupatrimo"> Detalle del bien materia del acto juridico</td>
                                                                  <td><label>
                                                                    <input class="text" type="text" name="oespecific2" style="background:#FFFFFF; text-transform:uppercase;" id="oespecific2" value="<?php echo $rowdbien['oespecific']; ?>" />
                                                                  </label></td>
                                                                </tr>
                                                                <tr>
                                                                  <td>&nbsp;</td>
                                                                  <td>&nbsp;</td>
                                                                  <td>&nbsp;</td>
                                                                  <td>&nbsp;</td>
                                                                  <td>&nbsp;</td>
                                                                </tr>
                                                              </table>
                                                          </div>
<div id="predio3" style="display:none; width:650px; height:450px; border:#003366 solid 1px; background:#CCCCCC; position:absolute; left: 23px; top: -10px; z-index:2000;">                          
      <table >
          <thead>
            <tr>
              <td width="69">&nbsp;</td>
              <td colspan="3"  class="titupatrimo">DATOS DAAAEL PREDIO</td>
            
              <td width="195" align="right"><a href="#" onClick="ocultar_desc('predio3')"><img src="iconos/cerrar.png" width="21" height="20" border="0" /></a></td>
            </tr>
          </thead>
          <tbody>
              
              <tr>
				<td class="titupatrimo">TIPO DE ZONA</td>
				<td colspan="3" class="titupatrimo">
					<select name="txtTipoZonaPredio3" id="txtTipoZonaPredio3">
						<option value="0" selected>.::Seleccione::.</option>
						<option value="URB.">URBANIZACION</option>
						<option value="BAR.">BARRIO</option>
						<option value="VLL.">VILLA</option>
					</select>			
				</td>  
              </tr>
              <tr>
              	<td class="titupatrimo">ZONA</td>
                <td colspan="3" class="titupatrimo"><input style="width:98%;background:white" type="text" id="txtZonaPredio3" name="txtZonaPredio3"></td>  
              </tr>
              <tr>
              	<td class="titupatrimo">DENOMINACION</td>
                <td colspan="3" class="titupatrimo"><input style="width:98%;background:white" type="text" id="txtDenominacionPredio3" name="txtDenominacionPredio3"></td>  
              </tr>
			  <tr>
			  	<td class="titupatrimo" width="200px">TIPO DE VIA *</td>
                <td class="titupatrimo">
					<select name="txtTipoViaPredio3" id="txtTipoViaPredio3">
						<option value="0" selected>.::Seleccione::.</option>
						<option value="AV.">AVENIDA</option>
						<option value="JR.">JIRON</option>
						<option value="CAL.">CALLE</option>
						<option value="PQ.">PARQUE</option>
						<option value="CAR.">CARRETERA</option>
						<option value="PRO.">PROLONGACION</option>
						<option value="PJ.">PASAJE</option>
						<option value="PZA.">PLAZA</option>
						<option value="GAL.">GALERIA</option>
						<option value="ALM.">ALAMEDA</option>
						<option value="BLV.">BULEVAR</option>
						<option value="BL.">BLOQUE</option>
						<option value="MLC.">MALECON.</option>
						<option value="VIA.">VIA.</option>
						<option value="OVL.">OVALO.</option>
					</select>			
				</td>
			  </tr>
              <tr>
              	<td class="titupatrimo">NOMBRE DE VIA </td>
                <td colspan="3" class="titupatrimo"><input style="width:98%;background:white" type="text" id="txtNombreViaPredio3" name="txtNombreViaPredio3"></td>
				   
              </tr>
			  
              <tr>
                <td class="titupatrimo">NUMERO</td>
                <td class="titupatrimo"><input type="text" id="txtNumeroPredio3" style="background:white" name="txtNumeroPredio3"></td>
				<td class="titupatrimo">MANZANA</td>
                <td class="titupatrimo"><input type="text" id="txtManzanaPredio3" style="background:white" name="txtManzanaPredio3"></td>                             
              </tr>
			  <tr>
			  	<td class="titupatrimo">LOTE</td>
                <td class="titupatrimo"><input type="text" id="txtLotePredio3" style="background:white" name="txtLotePredio3"></td>
              </tr>
			  <tr>
			  		<td class="titupatrimo">&nbsp;</td>
					  <td class="titupatrimo"><a href="#" onclick="get_predios(3)"><img src="iconos/buscarclie.png" width="94" height="29" border="0" /></a></td>
					  <td class="titupatrimo">&nbsp;</td>
				  	<td class="titupatrimo"><a href="#" onclick="set_predios('<?php echo $kardex?>',3)"><img src="iconos/grabar.png" width="94" height="29" border="0" /></a></td>
              </tr>
          </tbody>
      </table>
      <table border="1" style="width:98%; border-radius:5px;margin:5px;font-size:.9em" cellspacing="0" cellpadding="0">
          
          <thead>
              <tr>
                <td class="titupatrimo">N°</td>
                <td class="titupatrimo">TIPO DE ZONA</td>
                <td class="titupatrimo">ZONA</td>
                <td class="titupatrimo">DENOMINACION</td>
                <td class="titupatrimo">TIPO DE VIA</td>
                <td class="titupatrimo">NOMBRE DE VIA</td>
                <td class="titupatrimo">NUMERO</td>
                <td class="titupatrimo">MANZANA</td>
                <td class="titupatrimo">LOTE</td>
              </tr>
          </thead>
          <tbody id="tblPredios3" class="text-center" style="background:white;font-size:.83em">

          </tbody>
      </table>
</div>
                                                        </td>
                                                        <td height="15">&nbsp;</td>
                                                        <td height="30">&nbsp;</td>
                                                        <td height="15">&nbsp;</td>
                                                      </tr>
                                                  </table>
                                          </div>
                                                    <div id="listbiennes2" style="display:"></div></td> <!-- DIV ACTUALIZAR BIENES -->
                                                            <div id="verbienesedit2" style="display:none; border: #003366 solid 1px; background-color:#CCCCCC; position:absolute; width: 729px; left: 5px; top: 224px; height: 189px;"></div><input name="detbienx2" type="hidden" id="detbienx2" />
                                              </tr>
                                            </table>
                                      </div>
                                      <div id="vvehicular2" style="display:none">
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                              <tr>
                                                <td width="10">&nbsp;</td>
                                                <td width="692"><a id="_newVehiculo2" onclick="agregarVehiculo2();" href="#">Nuevo </a>&nbsp;&nbsp;&nbsp;&nbsp;<a id="_listVehiculo2" onclick="listarVehiculos2();" href="#">Listado </a></td>
                                              </tr>
                                              <tr>
                                                <td>&nbsp;</td>
                                                <td><div id="newvehiculo2" style="display:none">
                                                  <table width="700" border="0" align="left" cellpadding="0" cellspacing="0">
                                                      <tr>
                                                        <td height="19" align="right"><span class="titupatrimo">Tipo:</span></td>
                                                        <td height="19"><?php /*
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT det_placa.id_placa AS 'id', det_placa.descripcion AS 'des'
FROM det_placa"; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "100"; 
			$oCombo->name       = "idplacav2";
			$oCombo->style      = ""; 
			$oCombo->click      = "//selectAsunto(this.value);";   
			//$oCombo->selected   =  $rowvehi['idplaca'];
			$oCombo->Show();
			$oCombo->oDesCon(); */
			echo "<select name='idplacav2' id='idplacav2' onchange='isConsultSunarp2()' style='width:100px'>";
			echo "<option value=''></option>";
			$combo10 = mysql_query( "SELECT det_placa.id_placa AS 'id', det_placa.descripcion AS 'des'
FROM det_placa",$conn);
			while ($rs10=mysql_fetch_assoc($combo10)){
			
			echo "<option value='".$rs10['id']."'";
			if($rs10['id']==$rowvehi['idplaca']){
				echo " selected='selected' ";
			}
			
			echo ">".$rs10['des']."</option>";
			}
			echo "</select>";	
?></td>
                                                        <td height="15" align="right"><span class="titupatrimo">Carroceria :</span></td>
                                                        <td height="15"><input type="text" name="carroceriav2" style="background:#FFFFFF; text-transform:uppercase;"  id="carroceriav2" /></td>
                                                      </tr>
                                                      <tr>
                                                        <td height="19" align="right"><span class="titupatrimo">N. aaPlaca / Poliza :</span></td>
                                                        <td height="19"><input name="numplacav2" type="text" id="numplacav2" style="background:#FFFFFF; text-transform:uppercase;" size="15" />
                                                        <span style="color:#F00">*</span>
                                                        <!-- <a href="javascript:;" id="btn-consult-sunarp2" onclick="consultSunarp2()" style="display:none;"><img src="iconos/buscarclie.png" width="72" height="29" border="0"></a> -->
                                                        <a href="javascript:;" id="btn-consult-sunarp2" onclick="consultar_placa()" style="display:none;"><img src="iconos/buscarclie.png" width="72" height="29" border="0"></a>
                                                        </td>
                                                       
                                                        <td height="19" align="right"><span class="titupatrimo">Color :</span></td>
                                                        <td height="19"><span class="titupatrimo">
                                                          <input type="text" name="colorv2" style="background:#FFFFFF; text-transform:uppercase;"  id="colorv2" />
                                                        </span></td>
                                                      </tr>
                                                      <tr>
                                                        <td width="125" height="30" align="right"><span class="titupatrimo">Clase :</span></td>
                                                        <td width="186" height="30"><span class="titupatrimo">
                                                        <label></label>
                                                        <input type="text" name="clasev2" style="background:#FFFFFF; text-transform:uppercase;"  id="clasev2" />
                                                        </span></td>
                                                        <td width="113" height="30" align="right"><span class="titupatrimo">Motor :</span></td>
                                                        <td width="276" height="30">
                                                          <input type="text" name="motorv2" style="background:#FFFFFF; text-transform:uppercase;"  id="motorv2" /></td>
                                                      </tr>
                                                      <tr>
                                                        <td height="30" align="right"><span class="titupatrimo">Marca :</span></td>
                                                        <td height="30"><span class="titupatrimo">
                                                        <label></label>
                                                        <input type="text" name="marcav2" style="background:#FFFFFF; text-transform:uppercase;"  id="marcav2" />
                                                        </span></td>
                                                        <td height="30" align="right"><span class="titupatrimo">Cilindros :</span></td>
                                                        <td height="30"><span class="titupatrimo">
                                                          <input name="numcilv2" type="text"  id="numcilv2" style="background:#FFFFFF" size="5" />
                                                        </span></td>
                                                      </tr>
                                                      <tr>
                                                        <td height="30" align="right"><span class="titupatrimo">Año Fabric.:</span></td>
                                                        <td height="30"><input name="anofabv2" type="text"  id="anofabv2" style="background:#FFFFFF" size="10" /></td>
                                                        <td height="30" align="right"><span class="titupatrimo">Serie Nro.:</span></td>
                                                        <td height="30"><span class="titupatrimo">
                                                          <input type="text" name="numseriev2" style="background:#FFFFFF"  id="numseriev2" />
                                                        </span></td>
                                                      </tr>
                                                      <tr>
                                                        <td height="15" align="right"><span class="titupatrimo">Modelo :</span></td>

                                                        <td height="15"><span class="titupatrimo">
                                                          <label></label>
                                                        <label>
                                                          <input type="text" name="modelov2" style="background:#FFFFFF; text-transform:uppercase;"  id="modelov2" />
                                                          </label>
                                                        </span></td>
                                                        <td height="30" align="right"><span class="titupatrimo">Ruedas :</span></td>
                                                        <td height="30"><span class="titupatrimo">
                                                          <input name="numruedav2" type="text"  id="numruedav2" style="background:#FFFFFF" size="5" />
                                                        </span></a></td>
                                                      </tr>
                                                      <tr>
                                                        <td height="15" align="right"><span class="titupatrimo">Combustible :</span></td>
                                                        <td height="15"><input type="text" name="combustiblev2" style="background:#FFFFFF; text-transform:uppercase;"  id="combustiblev2" /></td>
                                                        <td height="15" align="right"><span class="titupatrimo">Fec. Inscripcion :</span></td>
                                                        <td height="15"><input name="fecinscv2" type="text" class="tcal" id="fecinscv2" style="background:#FFFFFF" size="10" /></td>
                                                      </tr>
                                                       <tr>
                                                        <td height="15" align="right"><span class="titupatrimo">Partida Registral:</span></td>
                                                        <td height="15"><input type="text" size="20" id="pregis_vehi_2" style="background:#FFFFFF; text-transform:uppercase;" name="pregis_vehi_2" class="text" maxlength="50"></td>
                                                        
                                                        <td height="30" align="right"><span class="titupatrimo">Sede Registral:</span></td>
                                                        <td height="30"><?php /* 
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT sedesregistrales.idsedereg AS 'id', sedesregistrales.dessede AS 'des' FROM sedesregistrales"; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "120"; 
			$oCombo->name       = "idsedereg2_vehi_2";
			$oCombo->style      = ""; 
			$oCombo->click      = "//selectAsunto(this.value);";   
			//$oCombo->selected   =  $rowvehi['idplaca'];
			$oCombo->Show();
			$oCombo->oDesCon(); */
			echo "<select name='idsedereg2_vehi_2' id='idsedereg2_vehi_2' onchange='selectAsunto(this.value);' style='width:120px'>";
			echo "<option value=''></option>";
			$combo11 = mysql_query( "SELECT sedesregistrales.idsedereg AS 'id', sedesregistrales.dessede AS 'des' FROM sedesregistrales",$conn);
			while ($rs11=mysql_fetch_assoc($combo11)){
			
			echo "<option value='".$rs11['id']."'";
			
			if($rs11['id']==$rowvehi['idplaca']){
				echo " selected='selected' ";
			}
			
			echo ">".$rs11['des']."</option>";
			}
			echo "</select>";	
?></td>
                                                      </tr>


                                                      <tr>
                                                        <td height="15"></td>
                                                        <td height="15">&nbsp;</td>
                                                        <td height="30">&nbsp;</td>
                                                        <td height="15"><a href="#" onclick="gbvehicular2()"><img src="iconos/grabar.png" alt="" width="94" height="29" border="0" />
                                                          <input name="kardexvehi2" type="hidden" id="kardexvehi2" size="15"  />
                                                        <input name="idtipactov2" type="hidden" id="idtipactov2" size="15"  />
                                                        <input name="detvehx2" type="hidden" id="detvehx2" size="15"  />
                                                        </a></td>
                                                      </tr>
                                                  </table>
                                </div>
                                                    </td> <!-- DIV ACTUALIZAR BIENES -->
                                                            <div id="vervehiedit" style="display:none; border: #003366 solid 1px; background-color:#CCCCCC; position:absolute; width: 729px; left: 5px; top: 224px; height: 189px;"></div><input name="detbienx" type="hidden" id="detbienx" />
                                              </tr>
                                              <tr>
                                              	<td colspan="2"><div id="listvehiculos2" style="display:none">Listado de Vehiculos</div>
                                              	</td>
                                              </tr>
                                            </table>
                                      </div>
                                      </td>
                                  </tr>
                                </table>



<script>
  console.log(tipobien2)
  tipobien2.addEventListener('change',()=>{
        let predio = document.getElementById('predio');
        predio.style.display='block';
  })
  
</script>