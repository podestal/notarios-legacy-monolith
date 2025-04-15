<?php
include("../../conexion.php");
	require_once("../../includes/barramenu.php") ;
	require_once("../../includes/gridView.php")  ;
	require_once("../../includes/combo.php")  	 ;
	$oBarra = new BarraMenu() 				     ;
	$Grid1 = new GridView()					     ;
	$oCombo = new CmbList()  				     ;	

$id_viaje        = $_REQUEST["id_viaje"];
$id_contratante  = $_REQUEST["id_contratante"];

$consulpartici = mysql_query("SELECT * FROM viaje_contratantes WHERE viaje_contratantes.id_viaje='$id_viaje' AND viaje_contratantes.id_contratante = '$id_contratante'", $conn) or die(mysql_error());
$rowpart = mysql_fetch_array($consulpartici);
	
?>
<script type="text/javascript" src="../includes/Mantenimientos.js"></script> 
<script type="text/javascript">
$(document).ready(function(){ 
	
		var _evalMenor = '<?php echo $rowpart['c_condicontrat']; ?>';
	
		if(_evalMenor=="002") // menor
		{
			$(".div_menorMuesData").removeAttr("style","display:none");			
		}
			else
			{
				$(".div_menorMuesData").attr("style","display:none");
			}
	
		
		$("#_selUbieclient").live("click", function(){
				$("#buscaubisccnt").val("");
				$("#buscaubisccnt").focus();
				$("#resulubisccnt").html("");
			})
			
		$("#_selProfeclient").live("click", function(){
				$("#buscaprofescnt").val("");
				$("#buscaprofescnt").focus();
				$("#resulprofesionescnt").html("");
			})
			
		$("#_selCargoclient").live("click", function(){
				$("#buscacargoosscnt").val("");
				$("#buscacargoosscnt").focus();
				$("#resulcargitocnt").html("");
			})
		
	
	
	})

	function evaleditParticipante(){ feditaCondiciones();}
	
	function fcerrardivedicion()
	{
		$("#div_editparti").dialog("close");
		$("#div_editparti").remove();	
	}

// *********************************************************************************************************
// *********************************************************************************************************

// Actualiza Datos Cliente:

function ggcliecnt()
{	
	c_descontrat();
	napepatcnt(),
	napematcnt();
	nprinomcnt();
	nsegnomcnt();
	ndireccioncnt();
	ggcliecntresult();
}	

function ggcliecntresult()
{	
	var numdoccnt		= $("#numdoccnt").val(); 
	var apepatcnt		= $("#apepatcnt").val(); 
	var apematcnt		= $("#apematcnt").val(); 
	var prinomcnt		= $("#prinomcnt").val(); 
	var segnomcnt		= $("#segnomcnt").val(); 
	var direccioncnt	= $("#direccioncnt").val(); 
	var emailcnt		= $("#emailcnt").val(); 
	var telfijocnt		= $("#telfijocnt").val(); 
	var telcelcnt		= $("#telcelcnt").val(); 
	var teloficnt		= $("#teloficnt").val(); 
	var sexocnt			= $("#sexocnt").val(); 
	var idestcivilcnt	= $("#idestcivilcnt").val();
	var nacionalidadcnt	= $("#nacionalidadcnt").val(); 
	var idprofesioncnt	= $("#idprofesioncnt").val(); 
	var idcargoocnt		= $("#idcargoocnt").val(); 
	var cumpcliecnt		= $("#cumpcliecnt").val(); 
	var natpercnt		= $("#natpercnt").val(); 
	var codubisccnt		= $("#codubisccnt").val(); 
	var nomprofesionescnt = $("#nomprofesionescnt").val(); 
	var nomcargosscnt	= $("#nomcargosscnt").val(); 
	var ubigensccnt		= $("#ubigensccnt").val(); 
	var residentecnt	= $("#residentecnt").val(); 
	var docpaisemicnt	= $("#docpaisemicnt").val(); 
	var codcliecnt		= $("#codcliecnt").val(); 
	var cconyugecnt		= $("#cconyugecnt").val(); 

	var data = {
				numdoccnt : numdoccnt,
				apepatcnt : apepatcnt,
				apematcnt : apematcnt,
				prinomcnt : prinomcnt,
				segnomcnt : segnomcnt,
				direccioncnt : direccioncnt,
				emailcnt : emailcnt,
				telfijocnt : telfijocnt,
				telcelcnt : telcelcnt,
				teloficnt : teloficnt,
				sexocnt : sexocnt,
				idestcivilcnt : idestcivilcnt,
				nacionalidadcnt : nacionalidadcnt,
				idprofesioncnt : idprofesioncnt,
				idcargoocnt : idcargoocnt,
				cumpcliecnt : cumpcliecnt,
				natpercnt : natpercnt,
				codubisccnt : codubisccnt,
				nomprofesionescnt : nomprofesionescnt,
				nomcargosscnt : nomcargosscnt,
				ubigensccnt : ubigensccnt,
				residentecnt : residentecnt,
				docpaisemicnt : docpaisemicnt,
				codcliecnt : codcliecnt,
				cconyugecnt : cconyugecnt
		}
		
		$.getJSON("../model/grabar_clientecntViaje.php", data, function(respuesta){
				var _Datos = respuesta;
				
				$("#c_codcontrat").val(_Datos[0].numdoc);
				$("#c_descontrat").val(_Datos[0].nombre);
				alert("Se actualizo el cliente");
				ActDivContratantes();
				$("#div_editdatosCLient").dialog("destroy").remove();
			})	

}	

	function mostrar_desc(objac)
		{
			if(document.getElementById(objac).style.display=="none")
				{document.getElementById(objac).style.display="";}
			else
				{document.getElementById(objac).style.display="";}
		}
	
	function ocultar_desc(objac2)
		{
			if(document.getElementById(objac2).style.display=="")
				{document.getElementById(objac2).style.display="none";}
			else
				{document.getElementById(objac2).style.display="none";}
		}	

	// UBIGEOS
	function buscaubigeossccnt()
		{ 	
			var _buscaubisccnt = $("#buscaubisccnt").val();
			$("#resulubisccnt").load("../model/buscarubigeosccnt.php",{ buscaubisccnt : _buscaubisccnt});
		}
	
		
	function mostrarubigeoosccnt(id,name)
		{
			$("#ubigensccnt").val(id);
			$("#codubisccnt").val(name);
			ocultar_desc('div_buscaubisccnt');  
		}
		
	// PROFESIONES
	function buscaprofesionescnt()
		{ 	
			var _buscaprofescnt = $("#buscaprofescnt").val();
			$("#resulprofesionescnt").load("../model/buscaprofesionnescnt.php",{ buscaprofescnt : _buscaprofescnt});
		}	
		
	function mostrarprofesionesscnt(id,name)
		{
			$("#idprofesioncnt").val(id);
			$("#nomprofesionescnt").val(name);
			ocultar_desc('buscaprofecnt');  
		}
		
	function buscacarguitosscnt()
		{ 	
			var _buscacargoosscnt = $("#buscacargoosscnt").val();
			$("#resulcargitocnt").load("../model/buscacargoscnt.php",{ buscacargoosscnt : _buscacargoosscnt});
		}
		
	function mostrarcargooscnt(id,name)
		{
			$("#idcargoocnt").val(id);
			$("#nomcargosscnt").val(name);
			ocultar_desc('buscacargooocnt');       
		}	
		
		
	function ActDivContratantes()
	{
		var _id_viaje = $("#id_viaje").val()
		$("#div_participantes").load("PermiParticipantes.php", {id_viaje : _id_viaje}, function(){
					
			});
	}

	function c_descontrat(){
 	valord=document.getElementById('c_descontrat').value;
 	textod=valord.replace(/&/g,"*");
 	document.getElementById('nc_descontrat').value=textod;
	}
	function napepatcnt(){
 	valord=document.getElementById('napepatcnt').value;
 	textod=valord.replace(/&/g,"*");
 	document.getElementById('apepatcnt').value=textod;
	}
	function napematcnt(){
 	valord=document.getElementById('napematcnt').value;
 	textod=valord.replace(/&/g,"*");
 	document.getElementById('apematcnt').value=textod;
	}
	function nprinomcnt(){
 	valord=document.getElementById('nprinomcnt').value;
 	textod=valord.replace(/&/g,"*");
 	document.getElementById('prinomcnt').value=textod;
	}
	function nsegnomcnt(){
 	valord=document.getElementById('nsegnomcnt').value;
 	textod=valord.replace(/&/g,"*");
 	document.getElementById('segnomcnt').value=textod;
	}
	function ndireccioncnt(){
 	valord=document.getElementById('ndireccioncnt').value;
 	textod=valord.replace(/&/g,"*");
 	document.getElementById('direccioncnt').value=textod;
	}
	
	function fActiva_repre(){
	
	var _swtrepre = document.getElementById('chk_repre').checked;

		if (_swtrepre == true)
			{  
			  document.getElementById('div_Data_Apoderado').style.display   = '';
			  fshowData_Apoderado();
			  
			} 
			else{
					document.getElementById('div_Data_Apoderado').style.display   = 'none';
				  	document.getElementById('div_Data_Apoderado').innerHTML = "";
				}	
}
	
	// MUESTRA EL NUEVO DIV DE DATOS DEL APODERADO:
function fshowData_Apoderado()
	{	
		var _id_viaje  = document.getElementById('id_viaje').value;
		var _apoderado = fShowAjaxDato('../includes/showApoderado.php?id_viaje='+_id_viaje);
		
		document.getElementById('div_Data_Apoderado').innerHTML  ="<table><tr><td align='right'>Repres. a:</td><td>" + _apoderado + "</td><td colspan='3' align='center'><input type='checkbox' name='chk_ambos' id='chk_ambos' onclick='fSelectRepresenta()' /> Ambos padres </td></tr><tr><td>Partida Electr. N°:</td><td><input name='partida_numero' type='text'  id='partida_numero'/></td><td>Sede Registral:</td><td><input name='sede_registral_a' type='text'  id='sede_registral_a'/></td></tr></table>";		
	}	

// EVALUA CHECK DE AMBOS PADRES
function fSelectRepresenta(){
	
		var _chk_ambos = document.getElementById('chk_ambos').checked;
			if (_chk_ambos == true)
				{  
					document.getElementById('codi_apoderado').selectedIndex = 0 ;
				} 

}

</script>
<form id="frmescri" name="frmescri" method="post" action="">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="110" height="45" valign="bottom"><span class="camposss">Nro Docum: </span></td>
                <td width="251" height="45" valign="bottom"><span id="sprytextfield1">
                  <label></label>
                  <span class="textfieldRequiredMsg"><span class="titus33">
                  <input name="c_codcontrat" type="text"  id="c_codcontrat" style="text-transform:uppercase;"  value="<?php echo $rowpart['c_codcontrat']; ?>" readonly="readonly" />
                  </span></span></span></td>
                
              </tr>
              <tr>
                <td height="27"><span class="camposss">Nombres y Ape.: </span></td>
                <td height="27"><span class="titus33">
     <input name="c_descontrat" type="text"  id="c_descontrat" style="text-transform:uppercase;"  onkeyup="hola();"  value="<?php
				  	$c_desc = $rowpart['c_descontrat'];
					$textorpat=str_replace("?","'",$c_desc);
					$textoamperpat=str_replace("*","&",$textorpat);
					echo strtoupper($textoamperpat);
				    ?>" size="40" readonly="readonly" />
                    <input type="hidden" name="nc_descontrat" id="nc_descontrat" />
                </span></td>
              </tr>
              <tr>
                <td height="28"><span class="camposss">Firma</span>: </td>
                <td height="28"><span id="sprytextfield5">
                <select name="c_fircontrat" id="c_fircontrat">
                  <option value="SI" <?php if($rowpart['c_fircontrat']=="SI"){echo "selected";} ?> >SI</option>
                  <option value="NO" <?php if($rowpart['c_fircontrat']=="NO"){echo "selected";} ?> >NO</option>
                  <option value="HUELLA" <?php if($rowpart['c_fircontrat']=="HUELLA"){echo "selected";} ?> >HUELLA</option>
                </select>
                </span></td>
              </tr>
              <tr>
                <td height="28"><span class="camposss">Condicion: </span></td>
                <td height="28"><?php
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT c_condiciones.id_condicion AS 'id', c_condiciones.des_condicion AS 'des' FROM c_condiciones WHERE c_condiciones.Swt_condicion = 'V' ORDER BY des_condicion ASC"; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "150"; 
			$oCombo->name       = "c_condicontrat";
			$oCombo->style      = "camposss"; 
			$oCombo->click      = "//funcionprueba()";   
			$oCombo->selected   = $rowpart['c_condicontrat'];
			$oCombo->Show();
			$oCombo->oDesCon(); 
?></td>
              </tr>
              <tr>
                <td height="28"><div class="div_menorMuesData" style="display:none;">Edad:</div></td>
                <td height="28"><div class="div_menorMuesData" id="div_emenor3" style="display:none;">
                  <input name="edad_menor2" type="text" id="edad_menor3" style="text-transform:uppercase;" size="3" placeholder="edad" value="<?php echo $rowpart['edad']; ?>" />
                  <select style="text-transform:uppercase;" name="condi_edad2" id="condi_edad3">
                    <option value="1" <?php if($rowpart['condi_edad']=="1"){echo "selected";} ?> >años</option>
                    <option value="2" <?php if($rowpart['condi_edad']=="2"){echo "selected";} ?> >meses</option>
                    <option value="3" <?php if($rowpart['condi_edad']=="3"){echo "selected";} ?> >dias</option>
                  </select>
                </div></td>
              </tr>
              <tr>
                <td height="28" align="right"><div id="div_represen_2">
                <?php 
				 
				 if($rowpart['codi_podera']!=""){				 
					 echo'<table  width="100%">
  <tr>
    <td width="4%" align="right"><input  onClick="fActiva_repre();" checked  type="checkbox" name="chk_repre" id="chk_repre"></td>
</td>
  </tr>
</table>
'; 
					 }else{
						 echo'<table  width="100%">
  <tr>

    <td width="4%" align="right"><input  onClick="fActiva_repre();"   type="checkbox" name="chk_repre" id="chk_repre"></td>
    
  </tr>
</table>
'; 
						 
						 }
				 ?>
                </div></td>
                <td height="28"><div id="div_represen">Representación de
                  <?php 
				 
				 if($rowpart['codi_podera']!=""){	
				 $valor = $rowpart['codi_podera'];
		$query = 'SELECT cliente.nombre from cliente where numdoc = "'.$valor.'" ';
		$result = mysql_query($query);
		$row = mysql_fetch_array($result);
				 	echo $row["nombre"];	
				 }if($rowpart['codi_podera']=="AMBOS"){
				 		echo "REPRESENTA AMBOS PADRES";}
				 ?>
                </div><div id="div_emenor" style="display:none;"><input name="edad_menor" type="text" id="edad_menor" style="text-transform:uppercase;" size="3" placeholder="edad" /><select style="text-transform:uppercase;" name="condi_edad" id="condi_edad">
            <option value="1">años</option>
            <option value="2">meses</option>
            <option value="3">dias</option>
          </select><span style="color:#F00; font-size:20px"><strong> *</strong></span></div></td>
              </tr>
              <tr>
                <td height="28" align="right">&nbsp;</td>
                <td height="28"><div id="div_codtestigo" style="display:none;"></div><div id="div_codpoderdante" style="display:none;"></div><div id="div_Data_Apoderado" style="display:none;"></div></td>

              </tr>
              <tr>
                <td colspan="2"><label><input type="hidden" name="id_viaje" id="id_viaje" value="<?php echo $rowpart['id_viaje']; ?>" />
                  <input type="hidden" name="id_contratante" id="id_contratante" value="<?php echo $rowpart['id_contratante']; ?>" />
                </label></td>
              </tr>
          </table>
            </form>