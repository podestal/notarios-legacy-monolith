<?php 
session_start();

include("../../conexion.php");
	require_once("../../includes/barramenu.php") ;
	require_once("../../includes/gridView.php")  ;
	require_once("../../includes/combo.php")  	  ;
	$oBarra = new BarraMenu() 				  ;
	$Grid1 = new GridView()					  ;
	$oCombo = new CmbList()  				  ;	
	
$id_cambio  = $_REQUEST['id_cambio'];
$id_solicitante	= $_REQUEST['id_solicitante'];
$num_crono = $_REQUEST['num_crono'];


$consulcontcambio = mysql_query("SELECT cambio_caracter.id_cambio,cambio_caracter.num_crono,ccaracter_solicitantes.* 
FROM ccaracter_solicitantes
INNER JOIN cambio_caracter ON cambio_caracter.id_cambio = ccaracter_solicitantes.id_cambio
 WHERE ccaracter_solicitantes.id_cambio='$id_cambio'", $conn) or die(mysql_error());
$rowccambio = mysql_fetch_array($consulcontcambio);



$numcro = $rowccambio['id_cambio'];
$numcrono2 = $rowccambio['num_crono'];
$numcronoShow = substr($numcrono2,5,6).'-'.substr($numcrono2,0,4);



#####
$numpermiso = "01-2013.odt";	
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cambio de Caracteristicas</title>
<link href="../../includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../../tcal.css" />
<link href="../../includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../../includes/css/uniform.default.min.css" />
<link rel="stylesheet" type="text/css" href="../../tcal.css" />
<link rel="stylesheet" type="text/css" href="../includes/css/CambioCaracVie.css" />

<script type="text/javascript" src="../../tcal.js"></script> 
<script type="text/javascript" src="../includes/Mantenimientos.js"></script> 
<script src="../../includes/jquery-1.8.3.js"></script>
<script src="../../includes/js/jquery-ui-notarios.js"></script>
<script src="../../includes/jquery.uniform.min.js"></script>
<script src="../../includes/maskedinput.js"></script>
<script type="text/javascript" src="../../tcal.js"></script> 
<script type="text/javascript" src="../includes/js/CambioCaracVie.js"></script> 
<script type="text/javascript">

	function fVisualDocument()
	{
		var valid_numcrono = document.getElementById('num_crono').value;
		if(valid_numcrono==''){alert('Debe guardar los datos primero');return;}
		var _num_crono = document.getElementById('muesnumcrono').value;
		
		var _usuario_imprime = '<?php echo $_SESSION["apepat_usu"].' '.$_SESSION["nom1_usu"]; ?>';
		var _nom_notario     = 'NOMBRE DEL NOTARIO';

		window.open("genera_cambio.php?num_crono="+_num_crono+"&usuario_imprime="+_usuario_imprime+"&nom_notario="+_nom_notario);				
	}
	

	function ocultar_desc(objac2)
		{
			if(document.getElementById(objac2).style.display=="")
				document.getElementById(objac2).style.display="none";
			else
				document.getElementById(objac2).style.display="none";
		}	
	
	function mostrar_desc(objac)
		{
			if(document.getElementById(objac).style.display=="none")
				document.getElementById(objac).style.display=""
			else
				document.getElementById(objac).style.display="";
		}
		
	function validacion()
	{
		
		if	(!$('#tipdoc').val())
		{alert("debe seleccionar tipo de documento");
		}else if($('#tipdoc').val()==01)
		{
			$("#num_docu").attr("maxlength", 8);
		}else if($('#tipdoc').val()==08)
		{
			$("#num_docu").attr("maxlength", 11);
		}
	}
	function editcontcambios()
	{
		var _id_cambio 		= document.getElementById('id_cambio').value;
		var _nombre 		= document.getElementById('nombre');
		var _tipdoc			= document.getElementById('tipdoc');
		var _num_docu 		= document.getElementById('num_docu');
		var _direccion 		= document.getElementById('direccion');
		var _ecivil 		= document.getElementById('ecivil');
		var _id_solicitante = document.getElementById('id_solicitante').value;
		var _representante 	= document.getElementById('representacion').value;
		var _poder_inscrito = document.getElementById('poder_inscrito').value;
		var _int_legitimo 	= document.getElementById('int_legitimo').value;
		
		
		if( _nombre.value == '' || _tipdoc.value == '' || _num_docu.value == '' || _direccion.value == '' || _ecivil.value == '')
		
		{alert('Faltan ingresar datos');return;}
		else{
		   grabarclientecambio2();
		  // alert("Cliente grabado satisfactoriamente");
		     ocultar_desc('div_newsolicitante');
			 mostrar_desc('llamaphp');
			 $("#contienepersona").removeAttr("style","display:none");
			 
			$('#llamaphp').load('list_cambios.php?id_cambio='+_id_cambio);
			
			}
		
	}
	
	function grabarclientecambio2()
	{
	//var divResultado = document.getElementById('datos');
	var id_cambio = document.getElementById('id_cambio').value;
	var nombre = document.getElementById('nombre').value;
	var tipdoc=document.getElementById('tipdoc').value;
	var num_docu=document.getElementById('num_docu').value;
	var direccion=document.getElementById('direccion').value;
	var ecivil=document.getElementById('ecivil').value;
	var representacion=document.getElementById('representacion').value;
	var poder_inscrito=document.getElementById('poder_inscrito').value;
	var int_legitimo=document.getElementById('int_legitimo').value;


	ajax = objetoAjax();

	ajax.open("POST","../model/edita_clientecambio.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 && ajax.status==200) {

			//divResultado.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");

	ajax.send("id_cambio="+id_cambio+"&nombre="+nombre+"&tipdoc="+tipdoc+"&num_docu="+num_docu+"&direccion="+direccion
	+"&ecivil="+ecivil+"&representacion="+representacion+"&poder_inscrito="+poder_inscrito+"&int_legitimo="+int_legitimo);


	}

	

</script> 
</head>
<body style="font-size:62.5%;">
<div id="carta_content">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
	<td width="24%">
     <?php
				$oBarra->Graba        = "1"               ;
				$oBarra->GrabaClick   = "fGraba2();"      ;
				$oBarra->Impri        = "1"               ;
				$oBarra->ImpriClick   = "fImprimir();"    ;
				$oBarra->clase        = "css"      		  ; 
				$oBarra->widthtxt     = "20"			  ; 
				$oBarra->Show()  						  ; 
				?>
    </td>
	<td width="76%"><div id="verdocumen"><button title="visualizar" type="button" name="btnver"    id="btnver" value="visualizar" onclick="fVisualDocument();" ><img align="absmiddle" src="../../images/block.png" width="15" height="15" />Ver</button></div></td>
</tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
  <tr>
    <td colspan="2"><table  width="100%"><input name="usuario_imprime" type="hidden" id="usuario_imprime" value="<?php echo $_SESSION["apepat_usu"].' '.$_SESSION["nom1_usu"]; ?>" />
      <tr>
        <td colspan="6"><div id="muesguarda" title="Confirmacion" style="display:none">Desea guardar los datos..?</div><div id="confirmaGuarda"></div></td>
        </tr>
      <tr>
        <td width="14%"><span class="camposss">Nro Cronologico:</span></td>
        <td width="16%"><div id="resul_cambio" style="width:100px;"><input name="num_crono" type="hidden" id="num_crono" size="15" readonly="readonly" placeholder="Autogenerado" /><input name="id_cambio" type="hidden" id="id_cambio" /><input name='muesnumcrono' type='text' id='muesnumcrono' style='font-family:Calibri; font-size:16px; color:#003366; border:none;' value="<?php echo $numcronoShow; ?>" size='8' ></div></td>
        <td width="17%"><span class="camposss">Fecha ingreso:</span></td>
        <td width="33%"><input name="fec_ingreso" type="text" id="fec_ingreso" style="text-transform:uppercase" value="<?php echo date("d/m/Y"); ?>" size="15" class="tcal" /></td>
        <td width="17%"><span class="camposss"># Formulario:</span></td>
        <td width="36%"><input name="num_formu" type="text" id="num_formu" style="text-transform:uppercase" size="15" /></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2"><!--<span class="camposss">Tipo de persona</span>--></td>
  </tr>
  <tr>
    <td colspan="2">
    <fieldset id="field_remitente">
    <legend><span class="camposss">PERSONA<button style="font-size:80.5%;" onClick="agregarpersona();" title="Agregar" type="button" name="addpersona"    id="addpersona" value="Agregar" ><img src="../../images/newuser.png" alt="" width="15" height="15" align="absmiddle" />Agregar</button>
    </span>
    </legend>
    <div id="div_editsolicitante">
    <table  width="100%">
        <tr>
          <td colspan="2">
          	
            <table width="100%" height="100%">
          	<tr>
            	<td width="10%"><span class="camposss">Solicitante:</span></td>
          <td colspan="3"><input name="nombre" type="text" id="nombre" style="text-transform:uppercase" size="60" maxlength="500"  value="<?php echo $rowccambio['descri_solicitante']; ?>"/></td>
          </tr>
        <tr>
          <td><span class="camposss">Identificado con:</span> </td>
          <td width="14%"><?php 
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT tipodocumento.codtipdoc AS 'id', tipodocumento.destipdoc AS 'des'
FROM tipodocumento
ORDER BY tipodocumento.destipdoc ASC"; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "150"; 
			$oCombo->name       = "tipdoc";
			$oCombo->style      = "camposss"; 
			//$oCombo->click      = "//selectAsunto(this.value);";   
			$oCombo->click      = "validacion()"; 
			$oCombo->selected   =  $rowccambio['tipdoc_solicitante'];
			$oCombo->Show();
			$oCombo->oDesCon(); 
?></td>
          <td width="12%" align="right"><span class="camposss">Nro:</span></td>
          <td width="64%"><input name="num_docu" type="text" id="num_docu" style="text-transform:uppercase" onKeyPress="//fShowDatosProvee(event);" size="16" value="<?php echo $rowccambio['numdocu_solicitante'];?>" /></td>
          </tr>
        <tr>
          <td><span class="camposss">Domicilio:</span> </td>
          <td colspan="3"><input name="direccion" type="text" id="direccion" style="text-transform:uppercase" size="60" maxlength="500" value="<?php echo $rowccambio['domic_solicitante'];?>" /></td>
        </tr>
        <tr>
          <td><span class="camposss">Estado civil:</span></td>
          <td colspan="3"><?php 
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
			$oCombo->selected   =  $rowccambio['ecivil_solicitante'];
			$oCombo->Show();
			$oCombo->oDesCon(); 
?></td>
        </tr>
        <tr>
          <td colspan="4">
            <input name="c_nombre" style="text-transform:uppercase" type="hidden" id="c_nombre" size="60" />
            <input name="c_tipdoc" type="hidden" id="c_tipdoc" size="60" />
            <input name="c_numdoc" type="hidden" id="c_numdoc" style="text-transform:uppercase" onKeyPress="//fShowDatosProvee(event);" size="15" />
            <input name="id_solicitante" type="hidden" id="id_solicitante" />
            </td>
    
            </tr>
          </table>
            
          </td>
        </tr>
        <tr>
          <td colspan="4"><span class="camposss">Quien manifesto actuar por su propio derecho, o en representacion de :</span></td>
        </tr>
        <tr>
          <td colspan="4"><input name="representacion" type="text" id="representacion" style="text-transform:uppercase" size="100" maxlength="500" value="<?php echo $rowccambio['representante'];?>" /></td>
          </tr>
        <tr>
          <td width="16%"><span class="camposss">Segun poder inscrito en :</span></td>
          <td width="84%" colspan="3"><input name="poder_inscrito" type="text" id="poder_inscrito" style="text-transform:uppercase" size="84" maxlength="100" value="<?php echo $rowccambio['poder_inscrito'];?>"/></td>
          </tr>
        <tr>
          <td><span class="camposss">O tercero con interes legitimo segun</span></td>
          <td colspan="3"><input name="int_legitimo" type="text" id="int_legitimo" style="text-transform:uppercase" size="84" maxlength="100" value="<?php echo $rowccambio['tercero'];?>"/></td>
          </tr>
          <tr>
          <td><button title="grabar" type="button" name="Grabar"   id="Grabar"   value="Grabar" onclick="editcontcambios()"   ><img src="../../images/save.png" width="17" height="17" align="absmiddle" /> Guardar</button></td>
    	  <td width="76%"><button title="visualizar" type="button" name="btnver"    id="btnver" value="visualizar" onclick="ggpcambiocarac3()" ><img align="absmiddle" src="../../images/block.png" width="15" height="15" />Ver</button></td>
          </tr>
        </table>
        </div>
        <div id="contienepersona">
        	
   			 <table width="880" border="1" cellpadding="0" cellspacing="0" bordercolor="#333333" bgcolor="#CCCCCC">
            <tr>
              <td width="20" align="center"><span class="titubuskar0">Nro</span></td>
              <td width="90" align="center"><span class="titubuskar0">Documento</span></td>
              <td width="150" align="center"><span class="titubuskar0">Solicitante</span></td>
              <td width="150" align="center"><span class="titubuskar0">Domicilio</span></td>


          	  </tr>
          </table>
          <div id="llamaphp">
    
          </div>
        </div>
    </fieldset>  
      </td>
    </tr>
  <tr>
    <td colspan="2">
    <fieldset id="field_destinatario">
    <legend><span class="camposss">CAMBIO DE CARACTERISTICAS</span></legend>
    <table  width="100%">
        <tr>
          <td width="66%" rowspan="3" valign="top"><div id="div_cambiocar" style='border: 1px solid #264965;border-radius: 5px;width:520px; height:150px;'></div></td>
          <td width="8%"><span class="camposss">Agregar:</span></td>
          <td width="26%"><?php 
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT detalle_cambios.id_cambio AS 'id', CONCAT(detalle_cambios.id_cambio,' - ',detalle_cambios.des_cambio) AS 'des'
FROM detalle_cambios ORDER BY detalle_cambios.id_cambio ASC"; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "200"; 
			$oCombo->name       = "detalle_cambios";
			$oCombo->style      = "camposss"; 
			$oCombo->click      = "//selectAsunto(this.value);";   
			$oCombo->selected   =  "01";
			$oCombo->Show();
			$oCombo->oDesCon(); 
?></td>
          </tr>
        <tr>
          <td colspan="2"><button title="Añadir" type="button" name="anadir"    id="anadir" value="anadir" onclick="fAddDetalle();" ><img src="../../images/obs.png" width="18" height="18" align="absmiddle" /> Añadir</button>&nbsp;&nbsp;<button title="Crear Bloque" type="button" name="eliminar"    id="eliminar" value="eliminar" onclick="fElimDetalle();" ><img src="../../images/delete.png" width="18" height="18" align="absmiddle" /> Eliminar</button></td>
          </tr>
        <tr>
          <td colspan="2" valign="top"><div id="div_muesresul"></div></td>
          </tr>
        </table>
    </fieldset>
    
    </td>
    </tr>
  <tr>
    <td colspan="2">
    </td>
    </tr>
  <tr>
    <td height="30" colspan="2" align="right" >&nbsp;</td>
  </tr>
  <tr>
    <td width="70" height="30" align="right" valign="top"><span class="camposss">Observaciones: </span></td>
    <td width="587"><textarea name="observacion" style="text-transform:uppercase;" id="observacion" cols="100" rows="3"></textarea></td>
  </tr>
</table>
</div>
</body>
</html>