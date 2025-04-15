<?php
include("../../conexion.php");
	require_once("../../includes/barramenu.php") ;
	require_once("../../includes/gridView.php")  ;
	require_once("../../includes/combo.php")  	 ;
	$oBarra = new BarraMenu() 				     ;
	$Grid1 = new GridView()					     ;
	$oCombo = new CmbList()  				     ;	

$id_poder    = $_REQUEST["id_poder"];
$id_contrata = $_REQUEST["id_contrata"];

$consulcontrat = mysql_query("SELECT * FROM poderes_contratantes WHERE poderes_contratantes.id_poder='$id_poder' AND poderes_contratantes.id_contrata = '$id_contrata'", $conn) or die(mysql_error());
$rowpart = mysql_fetch_array($consulcontrat);
	
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

	function evalGuardaContratante(){ fAddContratantesPoder();}
	
	function fcerrardivedicion3()
	{
		$("#div_newcontra").dialog("close");
		$("#div_newcontra").remove();	
	}


function soloLetras(e){
 key = e.keyCode || e.which;
 tecla = String.fromCharCode(key).toLowerCase();
 letras = " áéíóúabcdefghijklmnñopqrstuvwxyz-:/._";
 especiales = [8,37,39,46];

 tecla_especial = false
 for(var i in especiales){
     if(key == especiales[i]){
  tecla_especial = true;
  break;
            } 
 }
 
        if(letras.indexOf(tecla)==-1 && !tecla_especial)
     return false;
     }
 

function solonumeros(e){
 key = e.keyCode || e.which;
 tecla = String.fromCharCode(key).toLowerCase();
 nume = " 0123456789*+\-:/_,;.^()|$#%";
 especiales = [8,37,39,46];

 tecla_especial = false
 for(var i in especiales){
     if(key == especiales[i]){
  tecla_especial = true;
  break;
            } 
 }
 
        if(nume.indexOf(tecla)==-1 && !tecla_especial)
     return false;
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
                <td width="110" height="45" valign="bottom"><span class="camposss">Codigo : </span></td>
                <td width="251" height="45" valign="bottom"><span id="sprytextfield1">
                <label></label>
                  <span class="textfieldRequiredMsg"><span class="titus33">
                  <input name="c_codcontrat" type="text"  id="c_codcontrat" style="text-transform:uppercase;" />
                  </span></span></span></td>
                
              </tr>
              <tr>
                <td height="27"><span class="camposss">Descripcion: </span></td>
                <td height="27"><span class="titus33">
                  <input name="c_descontrat" type="text"  id="c_descontrat" style="text-transform:uppercase;" size="40" placeholder="Apellidos y Nombres" />
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
			$oCombo->dataSource = "SELECT c_condiciones.id_condicion AS 'id', c_condiciones.des_condicion AS 'des' FROM c_condiciones 
 WHERE c_condiciones.swt_condicion='P'
 ORDER BY des_condicion ASC"; 
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
                <td height="28"><label><input type="hidden" name="id_poder" id="id_poder" value="<?php echo $rowpart['id_poder']; ?>" />
                  <input type="hidden" name="id_contrata" id="id_contrata" value="<?php echo $rowpart['id_contrata']; ?>" />
                </label></td>
              </tr>
              <tr>
                <td height="28" colspan="2" align="left"><button type="button" name="guarda" id="guarda" onClick="evalGuardaContratante();"  ><img src="../../images/save.png" width="12" height="12" alt="" />Guardar</button></td>
              </tr>
          </table>
            </form>
            
</body>

</html>
