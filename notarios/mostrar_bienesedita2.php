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
</SCRIPT>
<?php 
include("conexion.php");
require_once("includes/combo.php")  	  ;
$oCombo = new CmbList()  				  ;

//$codmpago=$_POST['codmpago'];
$detbien=$_POST['detbien'];

$sqltbienn   = mysql_query("SELECT * FROM tipobien",$conn) or die(mysql_error());

$sqltpago=mysql_query("SELECT * FROM detallebienes",$conn) or die(mysql_error()); 

$sqlbancos=mysql_query("SELECT * FROM bancos",$conn) or die(mysql_error()); 


$consulbienes=mysql_query("SELECT * FROM detallebienes where detallebienes.detbien='$detbien'", $conn) or die(mysql_error());

$rowmbien = mysql_fetch_array($consulbienes);

// ubigeo:
$consulbienubi=mysql_query("SELECT CONCAT(ubigeo.nomdpto,'/',ubigeo.nomprov,'/',ubigeo.nomdis) 
FROM ubigeo
INNER JOIN detallebienes ON detallebienes.coddis = ubigeo.coddis
WHERE detallebienes.coddis = '".$rowmbien['coddis']."'", $conn) or die(mysql_error());
$rowubigeo = mysql_fetch_array($consulbienubi);

//para otrobien
$sqlotrobien=mysql_query("SELECT idtipbien FROM detallebienes WHERE detbien='$detbien'",$conn);
$otrobien = mysql_fetch_array($sqlotrobien);


?>
<style type="text/css">
.titupatrimo {font-size: 12; font-style: italic; font-family: Calibri;}
</style>

<table width="680" border="0" align="center" cellpadding="0" cellspacing="0">
                                                      <tr>
                                                        <td height="19">&nbsp;</td>
                                                        <td height="19">&nbsp;</td>
                                                        <td height="19">&nbsp;</td>
                                                        <td height="19" align="right"><a href="#" onClick="ocultar_desc('verbienesedit2');fDest_DivBienesedita();"><img src="iconos/cerrar.png" width="21" height="20" border="0" /></a></td>
                                                      </tr>
                                                      <tr>
                                                        <td width="135" height="30"><span class="titupatrimo">Tipo</span></td>
                                                        <td width="208" height="30"><span class="titupatrimo">
                                                          <label></label>
                                                          <label>
                                                            <?php 
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT tipbien.des_tipbien AS 'id', tipbien.des_tipbien AS 'des' FROM tipbien"; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "150"; 
			$oCombo->name       = "tipob2";
			$oCombo->style      = ""; 
			$oCombo->click      = "";   
			$oCombo->selected   =  $rowmbien['tipob'];
			$oCombo->Show();
			$oCombo->oDesCon(); 
?>
                                                          </label>
                                                        </span></td>
                                                        <td width="118" height="30"><span class="titupatrimo">Partida Registral</span></td>
                                                        <td width="219" height="30"><span class="titupatrimo">
                                                          <label></label>
                                                        <input name="pregis5" style="background:#FFFFFF" type="text" id="pregis5" size="20"  value="<?php echo $rowmbien['pregistral']; ?>" />
                                                        </span></td>
                                                      </tr>
                                                      <tr>
                                                        <td height="30"><span class="titupatrimo">Bien-Acto Jurídico</span></td>
                                                        <td height="30"><span class="titupatrimo">
                                                          <label></label>
                                                          <?php 
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT tipobien.idtipbien AS 'id', tipobien.desestcivil AS 'des' 
FROM tipobien ORDER BY tipobien.desestcivil ASC"; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "150"; 
			$oCombo->name       = "tipobien2";
			$oCombo->style      = ""; 
			$oCombo->click      = "enviarvalores2(this.value,document.getElementById('codkardex').value);";   
			$oCombo->selected   = $rowmbien['idtipbien'];
			$oCombo->Show();
			$oCombo->oDesCon(); 
			
			
if($otrobien[0]==10){
	
echo '<a href="#" id="activaotrobien" onClick="activaotrobien()"><img src="iconos/edit_x.png" width="21" height="20" border="0" /></a>';

}else if($otrobien[0]==5){
	
echo '<a href="#" id="activaotrobienm" onClick="activaotrobienm()"><img src="iconos/edit_x.png" width="21" height="20" border="0" /></a>';

}else if($otrobien[0]==8){
	
echo '<a href="#" id="activaotrobienv" onClick="activaotrobienv()"><img src="iconos/edit_x.png" width="21" height="20" border="0" /></a>';

}
	echo '<a href="#" id="activaotrobien" style="display:none" onClick="activaotrobien()"><img src="iconos/edit_x.png" width="21" height="20" border="0" /></a>';
			echo '<a href="#" id="activaotrobienm" style="display:none" onClick="activaotrobienm()"><img src="iconos/edit_x.png" width="21" height="20" border="0" /></a>';
			echo '<a href="#" id="activaotrobienv" style="display:none" onClick="activaotrobienv()"><img src="iconos/edit_x.png" width="21" height="20" border="0" /></a>';		
?>
                                                        </span></td>
                                                        <td height="30"><span class="titupatrimo">Sede Registral</span></td>
                                                        <td height="30"><span class="titupatrimo">
                                                          
                                                        
                             <select name="idsederegGG" id="idsederegGG">
                             
                                   <?php 
								   
								   $regissss=mysql_query("SELECT * FROM sedesregistrales where idsedereg='".$rowmbien['idsedereg']."'", $conn) or die(mysql_error());
			$rowwbien=mysql_fetch_array($regissss);
			
			if(!empty($rowwbien)){
				echo'<option value="'.$rowwbien['idsedereg'].'" selected="selected">"'.$rowwbien['dessede'].'"</option>';

				}else{
					echo'<option value="" selected="selected">SELECCIONAR</option>';
					}
			
			
			$regissss2=mysql_query("SELECT * FROM sedesregistrales", $conn) or die(mysql_error());
			while($rowwbien2=mysql_fetch_array($regissss2)){
				
				echo'<option value="'.$rowwbien2['idsedereg'].'">"'.$rowwbien2['dessede'].'"</option>';
				
				}
			
?>                       
                              </select>
                                                        </span></td>
                                                      </tr>
                                                      <tr>
                                                        <td height="30"><span class="titupatrimo">Ubigeo</span></td>
                                                        <td height="30" colspan="2"><input name="ubigens2" type="text" id="ubigens2"  size="45" value="<?php echo $rowubigeo[0];  ?>" /></td>
                                                        <td height="30"><a id="_busUbiEditBien" href="#" onClick="mostrar_desc('buscaubis2')"><img src="iconos/seleccionar.png" width="94" height="29" border="0" /></a>
                                                            <div id="buscaubis2" style="position:absolute; display:none; width:637px; height:223px; left: 14px; top: 125px; z-index:20; background:#CCCCCC; border: 1px solid #333333; border: 1px solid #264965; -moz-border-radius: 13px; -webkit-border-radius: 13px; border-radius: 13px; -moz-box-shadow: 0px 0px 5px #000000; -webkit-box-shadow: 0px 0px 5px #000000; box-shadow: 0px 0px 5px #000000;">
                                                              <table width="637" border="0" cellspacing="0" cellpadding="0">
                                                                <tr>
                                                                  <td width="24" height="29">&nbsp;</td>
                                                                  <td width="585" class="titupatrimo">Seleccionar Ubigeo:</td>
                                                                  <td width="28"><a id="_CloseUbiEditBien"  href="#" onClick="ocultar_desc('buscaubis2')"><img src="iconos/cerrar.png" width="21" height="20" border="0" /></a></td>
                                                                </tr>
                                                                <tr>
                                                                  <td>&nbsp;</td>
                                                                  <td><label>
                                                                    <input name="buscaubis22" type="text" style="background:#FFFFFF; text-transform:uppercase" id="buscaubis22" size="60"  onkeyup="buscaubigeoss2()" />
                                                                  </label></td>
                                                                  <td>&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                  <td>&nbsp;</td>
                                                                  <td><div id="resulubis2" style="width:585px; height:150px; overflow:auto"></div></td>
                                                                  <td>&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                  <td>&nbsp;</td>
                                                                  <td>&nbsp;</td>
                                                                  <td>&nbsp;</td>
                                                                </tr>
                                                              </table>
                                                            </div>
                                                          <input name="codubis2" type="hidden" id="codubis2" size="15" value="<?php echo $rowmbien['coddis']; ?>" /></td>
                                                      </tr>
                                                      <tr>
                                                        <td height="15"><span class="titupatrimo">Fecha de Add. o Cons.</span></td>
                                                        <td height="15"><span class="titupatrimo">
                                                        
                                                          <label>
                                                          <input type="text" name="fechaconst2"  class="tcal" id="fechaconst2"  value="<?php echo $rowmbien['fechaconst'];  ?>" onKeyUp = "this.value=formateafecha(this.value);"  >
                                                          </label>
                                                        </span></td>
                                                        <td height="30" align="center">&nbsp;</td>
                                                        <td height="30">&nbsp;</td>
                                                      </tr>
                                                      <tr>
                                                        <td height="15" align="right"><div id="vterrestres22" style="display:none; width:691px; height:83px; border:#003366 solid 1px; background:#CCCCCC; position:absolute; left: 7px; top: 68px;">
                                                            <table width="671" border="0" cellspacing="0" cellpadding="0">
                                                              <tr>
                                                                <td width="26" >&nbsp;</td>
                                                                <td width="118">&nbsp;</td>
                                                                <td width="138">&nbsp;</td>
                                                                <td width="135">&nbsp;</td>
                                                                <td width="254" align="right"><a href="#" onClick="ocultar_desc('vterrestres22')"><img src="iconos/cerrar.png" width="21" height="20" border="0" /></a></td>
                                                              </tr>
                                                              <tr>
                                                                <td></td>
                                                                <td colspan="3" class="titupatrimo"><?php if($rowmbien['tpsm']=='P'){
					echo'<input type="radio" name="radio3" id="radio3" checked="checked" value="P" onClick="selecpsm2(this.value)" />
                                                                  N° de Placa 
                                                                <input type="radio" name="radio3" id="radio4" value="S" onClick="selecpsm2(this.value)" />
                                                                  N° de Serie
                                                                <input type="radio" name="radio3" id="radio5" value="M" onClick="selecpsm2(this.value)" />N° de Motor';

					}
					if($rowmbien['tpsm']=='S'){
					echo'<input type="radio" name="radio3" id="radio3" value="P" onClick="selecpsm2(this.value)" />
                                                                  N° de Placa 
                                                               <input type="radio" name="radio3" id="radio4" checked="checked" value="S" onClick="selecpsm2(this.value)" />
                                                                  N° de Serie
                                                                <input type="radio" name="radio3" id="radio5" value="M" onClick="selecpsm2(this.value)" />N° de Motor';

					}
					if($rowmbien['tpsm']=='M'){
					echo'<input type="radio" name="radio3" id="radio3" value="P" onClick="selecpsm2(this.value)" />
                                                                  N° de Placa 
																  <input type="radio" name="radio3" id="radio4"  value="S" onClick="selecpsm2(this.value)" />
                                                                  N° de Serie
                                                                <input type="radio" name="radio3" checked="checked" id="radio5" value="M" onClick="selecpsm2(this.value)" />N° de Motor';

					}
					if($rowmbien['tpsm']==''){
					echo'<input type="radio" name="radio3" id="radio3" value="P" onClick="selecpsm2(this.value)" />
                                                                  N° de Placa<input type="radio" name="radio3" id="radio4"  value="S" onClick="selecpsm2(this.value)" />
                                                                  N° de Serie<input type="radio" name="radio3"  id="radio5" value="M" onClick="selecpsm2(this.value)" />N° de Motor';
					}
																
																 ?></td>
                                                                <td><label>
                                                                  <input type="text" name="npsm2" style="background:#FFFFFF; text-transform:uppercase" id="npsm2" value="<?php echo $rowmbien['npsm'];  ?>" />
                                                                </label></td>
                                                              </tr>
                                                              <tr>
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                                <td><label>
                                                                  <input type="hidden" name="tpsm2" id="tpsm2" />
                                                                </label></td>
                                                              </tr>
                                                            </table>
                                                        </div>
                                                            <div id="mequipos22" style="display:none; width:674px; height:71px; border:#003366 solid 1px; background:#CCCCCC; position:absolute; left: 9px; top: 99px;">
                                                              <table width="661" border="0" cellspacing="0" cellpadding="0">
                                                                <tr>
                                                                  <td width="32">&nbsp;</td>
                                                                  <td width="101">&nbsp;</td>
                                                                  <td width="128">&nbsp;</td>
                                                                  <td width="55">&nbsp;</td>
                                                                  <td width="345" align="right"><a href="#" onClick="ocultar_desc('mequipos22')"><img src="iconos/cerrar.png" width="21" height="20" border="0" /></a></td>
                                                                </tr>
                                                                <tr>
                                                                  <td><label></label></td>
                                                                  <td colspan="3" align="center" class="titupatrimo"> N° de Serie para Maquinaris y Equipos</td>
                                                                  <td><label>
                                                                    <input type="text" name="smaquiequipo2" style="background:#FFFFFF; text-transform:uppercase" id="smaquiequipo2" value="<?php echo $rowmbien['smaquiequipo'];  ?>" />
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
                                                          <div id="oespecificos22" style="display:none; width:652px; height:71px; border:#003366 solid 1px; background:#CCCCCC; position:absolute; left: 10px; top: 115px;">
                                                              <table width="629" border="0" cellspacing="0" cellpadding="0">
                                                                <tr>
                                                                  <td width="69">&nbsp;</td>
                                                                  <td width="55">&nbsp;</td>
                                                                  <td width="120">&nbsp;</td>
                                                                  <td width="190">&nbsp;</td>
                                                                  <td width="195" align="right"><a href="#" onClick="ocultar_desc('oespecificos22')"><img src="iconos/cerrar.png" width="21" height="20" border="0" /></a></td>
                                                                </tr>
                                                                <tr>
                                                                  <td><label></label></td>
                                                                  <td colspan="3" align="center" class="titupatrimo"> Detalle del bien materia del acto juridico</td>
                                                                  <td><label>
                                                                    <input type="text" name="oespecific2" style="background:#FFFFFF; text-transform:uppercase" id="oespecific2" value="<?php echo $rowmbien['oespecific']; ?>"  />
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
<div id="predio22" style="display:none; width:650px; height:450px; border:#003366 solid 1px; background:#CCCCCC; position:absolute; left: 23px; top: -10px; z-index:2000;">                          
      <table >
          <thead>
            <tr>
              <td width="69">&nbsp;</td>
              <td colspan="3"  class="titupatrimo">DATOS DEL PREDIO</td>
            
              <td width="195" align="right"><a href="#" onClick="ocultar_desc('predio22')"><img src="iconos/cerrar.png" width="21" height="20" border="0" /></a></td>
            </tr>
          </thead>
          <tbody>
              
              <tr>
				<td class="titupatrimo">TIPO DE ZONA</td>
				<td colspan="3" class="titupatrimo">
					<select name="txtTipoZonaPredio22" id="txtTipoZonaPredio22">
						<option value="0" selected>.::Seleccione::.</option>
						<option value="URB.">URBANIZACION</option>
						<option value="BAR.">BARRIO</option>
						<option value="VLL.">VILLA</option>
					</select>			
				</td>  
              </tr>
              <tr>
              	<td class="titupatrimo">ZONA</td>
                <td colspan="3" class="titupatrimo"><input style="width:98%;background:white" type="text" id="txtZonaPredio22" name="txtZonaPredio22"></td>  
              </tr>
              <tr>
              	<td class="titupatrimo">DENOMINACION</td>
                <td colspan="3" class="titupatrimo"><input style="width:98%;background:white" type="text" id="txtDenominacionPredio22" name="txtDenominacionPredio22"></td>  
              </tr>
			  <tr>
			  	<td class="titupatrimo" width="200px">TIPO DE VIA *</td>
                <td class="titupatrimo">
					<select name="txtTipoViaPredio22" id="txtTipoViaPredio22">
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
                <td colspan="3" class="titupatrimo"><input style="width:98%;background:white" type="text" id="txtNombreViaPredio22" name="txtNombreViaPredio22"></td>
				   
              </tr>
			  
              <tr>
                <td class="titupatrimo">NUMERO</td>
                <td class="titupatrimo"><input type="text" id="txtNumeroPredio22" style="background:white" name="txtNumeroPredio22"></td>
				<td class="titupatrimo">MANZANA</td>
                <td class="titupatrimo"><input type="text" id="txtManzanaPredio22" style="background:white" name="txtManzanaPredio22"></td>                             
              </tr>
			  <tr>
			  	<td class="titupatrimo">LOTE</td>
                <td class="titupatrimo"><input type="text" id="txtLotePredio22" style="background:white" name="txtLotePredio22"></td>
              </tr>
			  <tr>
			  		<td class="titupatrimo">&nbsp;</td>
					  <td class="titupatrimo"><a href="#" onclick="get_predios(2)"><img src="iconos/buscarclie.png" width="94" height="29" border="0" /></a></td>
					  <td class="titupatrimo">&nbsp;</td>
				  	<td class="titupatrimo"><a href="#" onclick="set_predios(document.getElementById('codkardex').value,2)"><img src="iconos/grabar.png" width="94" height="29" border="0" /></a></td>
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
          <tbody id="tblPredios22" class="text-center" style="background:white;font-size:.83em">

          </tbody>
      </table>
</div>  
                                                      
                                                        </td>
                                                        <td height="15">&nbsp;</td>
                                                        <td height="30">&nbsp;</td>
                                                        <td height="15" align="center"><a href="#" onclick="gbienesedit()"><img src="iconos/grabar.png" alt="" width="94" height="29" border="0" /></a></td>
                                                      </tr>
</table>
