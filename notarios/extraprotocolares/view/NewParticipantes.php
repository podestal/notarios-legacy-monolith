<?php
include("../../conexion.php");
	require_once("../../includes/barramenu.php") ;
	require_once("../../includes/gridView.php")  ;
	require_once("../../includes/combo.php")  	 ;
	$oBarra = new BarraMenu() 				     ;
	$Grid1 = new GridView()					     ;
	$oCombo = new CmbList()  				     ;	

$id_viaje = $_REQUEST["id_viaje"];
$id_contratante  = $_REQUEST["id_contratante"];

$consulpartici = mysql_query("SELECT * FROM viaje_contratantes WHERE viaje_contratantes.id_viaje='$id_viaje' AND viaje_contratantes.id_contratante = '$id_contratante'", $conn) or die(mysql_error());
$rowpart = mysql_fetch_array($consulpartici);
	
?>
<!DOCTYPE html>
<html lang="es">
<head>
<title>Editar Participante</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="../includes/Mantenimientos.js"></script> 

<script type="text/javascript">
       $(document).ready(function(){ 
		})	

	function evalGuardaParticipante(){	fAddCondiciones(); }
	
	function fcerrardivedicion2()
	{
		$("#div_newpartic").dialog("close");
		$("#div_newpartic").remove();	
	}


	function fShowDatosProveeClick()
	{
	$('<div id="div_addParticipante" title="div_addParticipante"></div>').load('AddParticipante.php')
	.dialog({
					autoOpen : true,
					position :["center","top"],
					width    : 550,
					height   : 250,
					modal : false,
					resizable : false,
					buttons: [{id: "btnaceptar", text: "Aceptar",click: function() {pasadatos();$(this).dialog("close");$("#div_addParticipante").remove(); }},
					{text: "Cancelar",click: function() { $(this).dialog("close");$("#div_addParticipante").remove(); }}],
					title:'Ayuda Cartas'
					
					}).width(550).height(250);	
					$(".ui-dialog-titlebar").hide();
	
		
	}
</script>
<style type="text/css">
<!--
.line {color: #FFFFFF}
.Estilo7 {font-family: Calibri; font-size: 13px; font-style: italic; }
.Estilo14 {font-family: Calibri; font-size: 12px; color: #333333; font-weight: bold; }
.Estilo12 {font-family: Calibri; font-size: 12px; color: #333333; font-style: italic; }
-->
</style>
</head>

<body>

<form id="frmescri" name="frmescri" method="post" action="">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="110" height="45" valign="bottom"><span class="camposss">Documento : </span></td>
                <td width="251" height="45" valign="bottom"><span id="sprytextfield1">
                <label></label>
                  <span class="textfieldRequiredMsg"><span class="titus33">
                  <input name="c_codcontrat" type="text" id="c_codcontrat" style="text-transform:uppercase;" readonly="readonly" placeholder="N. Documento" />
                  <a href="#" onClick="fShowDatosProveeClick()"> <img src="../../images/search.png" width="15" height="15" alt="" title="Buscar" /></a></span></span></span></td>
                
              </tr>
              <tr>
                <td height="27"><span class="camposss">Descripcion: </span></td>
                <td height="27"><span class="titus33">
                  <input name="c_descontrat" type="text"  id="c_descontrat" style="text-transform:uppercase;" size="40" readonly="readonly" placeholder="Apellidos y Nombres" />
                </span></td>
              </tr>
              <tr>
                <td height="28"><span class="camposss">Firma</span>: </td>
                <td height="28"><span id="sprytextfield5">
                <label>
                  <input name="c_fircontrat" type="text" id="c_fircontrat" style="text-transform:uppercase;" size="10" placeholder="SI/NO" />
                  </label>
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
			$oCombo->Show();
			$oCombo->oDesCon(); 
?></td>
              </tr>
                           <tr>
                <td height="28">&nbsp;</td>
                <td height="28"><label><input type="hidden" name="id_viaje" id="id_viaje" value="<?php echo $rowpart['id_viaje']; ?>" />
                  <input type="hidden" name="id_contratante" id="id_contratante" value="<?php echo $rowpart['id_contratante']; ?>" />
                </label></td>
              </tr>
              <tr>
                <td height="28" colspan="2" align="left"><button type="button" name="guarda" id="guarda" onClick="evalGuardaParticipante();"  ><img src="../../images/save.png" width="12" height="12" alt="" />Guardar</button></td>
              </tr>
          </table>
            </form>
            
</body>

</html>
