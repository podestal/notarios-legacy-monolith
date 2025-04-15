<?php 
session_start();

	include("../../conexion.php");
	
	require_once("../../includes/barramenu.php") ;
	require_once("../../includes/gridView.php")  ;
	require_once("../../includes/combo.php")  	  ;
	$oBarra = new BarraMenu() 				  ;
	$Grid1 = new GridView()					  ;
	$oCombo = new CmbList()  				  ;	
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Ingreso de poderes</title>
<link href="../../includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../../tcal.css" />
<link href="../../includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../../includes/css/uniform.default.min.css" />
<link rel="stylesheet" type="text/css" href="../../tcal.css" />
<link rel="stylesheet" href="../../css/uniform.default.css" type="text/css" media="screen">
<link rel="stylesheet" type="text/css" href="../includes/css/IngPoderesVie.css" />

<script type="text/javascript" src="../../tcal.js"></script> 
<script type="text/javascript" src="../includes/Mantenimientos.js"></script> 
<script src="../../includes/jquery-1.8.3.js"></script>
<script src="../../includes/js/jquery-ui-notarios.js"></script>
<script src="../../includes/jquery.uniform.min.js"></script>
<script src="../../includes/maskedinput.js"></script>
<script type="text/javascript" src="../../tcal.js"></script> 
<script type="text/javascript" src="../includes/js/IngPoderesVie.js"></script> 

<script type="text/javascript">

// #= Imprime Ingreso poderes.
	function fImprimir()
	{
		var _tip_poder = document.getElementById('id_asunto').value;
		
		var _id_poder = document.getElementById('id_poder').value;
		if(_id_poder == ''){alert('Debe guardar los datos primero');return;}
	
		var _usuario_imprime = '<?php echo $_SESSION["apepat_usu"].' '.$_SESSION["nom1_usu"]; ?>';
		var _nom_notario     = 'NOMBRE DEL NOTARIO';
		
		_data = {
					id_poder : _id_poder,
					usuario_imprime : _usuario_imprime,
					nom_notario : _nom_notario	
				}
		
		// #= PENSION ONP:	
		if(_tip_poder=='003')
			{		
				$.post("../../reportes_word/generador_poderONP.php",_data,function(_respuesta){
							alert(_respuesta);
						});
			}
			
		// #= PODER ESSALUD:		
		else if(_tip_poder=='004')
			{		
				$.post("../../reportes_word/generador_poder_essalud.php",_data,function(_respuesta){
							alert(_respuesta);
						});			
			}	
			
		// #= PODER FUERA DE REGISTRO:			
		else if(_tip_poder=='002')
			{
				$.post("../../reportes_word/generador_poder_fueraregistro.php",_data,function(_respuesta){
							alert(_respuesta);
						});
			}			
	
	}
	
	
	function fNoCorrePoder()
	{
		
		var _id_poder = document.getElementById('id_poder');
		if(_id_poder.value==''){alert('No se ha grabado el Poder');return;}
		
		else
		{
			$( "#mues_nocorre" ).dialog({
				resizable: false,
				height:140,
				position :["center","top"],
				modal: true,
				buttons: {
					"Aceptar": function() { fevalNocorre();
					},
					"Cancelar": function() {
						$( this ).dialog( "close" );
					}
				}
			});
		}	
	}

	function fevalNocorre()
	{
		fNocorreActionPoder();
		$("#mues_nocorre").dialog("close");
	}

function fVisualDocument()
	{
		var _tip_poder = document.getElementById('id_asunto').value;

		var _id_poder = document.getElementById('id_poder').value;
		if(_id_poder == ''){alert('Debe guardar los datos primero');return;}
	
		var _usuario_imprime = '<?php echo $_SESSION["apepat_usu"].' '.$_SESSION["nom1_usu"]; ?>';
		var _nom_notario     = 'NOMBRE DEL NOTARIO';
		
		
//AjaxReturn('../../reportes_word/generador_permiviaje_interior.php?id_viaje='+_id_viaje+'&usuario_imprime='+_usuario_imprime+'&nom_notario='+_nom_notario);
		window.open("genera_poder.php?id_poder="+_id_poder+"&usuario_imprime="+_usuario_imprime+"&nom_notario="+_nom_notario);
			
	}
// #################################
// #= IMPRIME DESDE PRINCIPAL.
	//function fImprimir()
		//{}
		
		function fbuscanrocontrol(numero){
    if (!/^([0-9])*$/.test(numero))
      alert("El valor " + numero + " no es un número");

  }
  
  function buscanomparticipante(numero){
    if (!/^([0-9])*$/.test(numero))
      alert("El valor " + numero + " no es un número");

  } 
  
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
 
 
 var nav4 = window.Event ? true : false;
function aceptNum(evt){
var key = nav4 ? evt.which : evt.keyCode;
return (key <= 13 || (key>= 48 && key <= 57));
}


/*no valida otros caracteres*/

var r={'special':/[\W]/g}
function valid(o,w){
o.value = o.value.replace(r[w],'');

}


function isNumberKey(evt)
     {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
           return true;
 
        return false;
     }


function validacion3() {
 
   // var er_cp = /(^([0-9]{5,5})|^)$/                
    var er_telefono = /(^([0-9\s\+\-]+)|^)$/           
 
  
    if( !er_telefono.test(frmbuscakardex.tel_comu.value) ) {
        alert('Caracter Incorrecto.')
        return false
    }
 
  
    return false           
}



function validacion4() {
 
   // var er_cp = /(^([0-9]{5,5})|^)$/                
    var er_telefono = /(^([A-Z\s\+\-]+)|^)$/           
 
  
    if( !er_telefono.test(frmbuscakardex.lugar_formuG.value) ) {
        alert('Caracter Incorrecto.')
        return false
    }
 
  
    return false           
}
</script>
</head>

<body onLoad="fini();" style="font-size:62.5%;">
<form id="form_poderes"  name="frmbuscakardex" action="IngPoderesVie.php" method="post" >
<div id="permisos_viaje">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
	<td>
     <?php
				$oBarra->Graba        = "1"               ;
				$oBarra->GrabaClick   = "fGraba();"       ;
				$oBarra->Genera       = "1"               ;
				$oBarra->GeneraClick  = "fGenerar();"     ;
				$oBarra->Impri        = "1"               ;
				$oBarra->ImpriClick   = "fImprimir();"    ;
				$oBarra->clase        = "css"      		  ; 
				$oBarra->widthtxt     = "20"			  ; 
				$oBarra->Show()  						  ; 
				?>
    </td>
    
    <td width="27%" align="left"><div id="verdocumen"><button title="visualizar" type="button" name="btnver"    id="btnver" value="visualizar" onclick="fVisualDocument();" ><img align="absmiddle" src="../../images/block.png" width="15" height="15" />Ver Doc.</button></div></td>
    <td width="33%" align="left"><div id="div_muesStatusNC"></div></td>
      </td><td width="11%" align="left"> <button title="No corre" type="button" name="nocorre"    id="nocorre" value="no corre" onclick="fNoCorrePoder();" ><img align="absmiddle" src="../../images/block.png" width="15" height="15" />No Corre</button></td>
</tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
  <tr>
    <td>
    <fieldset id="cabecera">
    <legend></legend>
    <table  width="100%">
        <tr>
          <td colspan="4"><table  width="100%">
            <tr>
              <td colspan="6"><div id="muesguarda" title="Confirmacion" style="display:none">Desea guardar el Poder..?</div><div id="confirmaGuarda"></div></td>
            </tr>
            <tr>
              <td width="14%"><span class="camposss">Nro. Control:</span></td>
              <td width="17%"><div id="resul_poder" style="width:100px;">
                <input id="id_poder" name="id_poder" type="hidden"  />
                </div><input name="num_kardex" type="hidden" id="num_kardex" size="15" readonly  placeholder="Autogenerado"/></td>
              <td width="20%" align="right"><span class="camposss">
                Hora:</span></td>
              <td width="27%"><input name="hora_recep" type="text" id="hora_recep" style="text-transform:uppercase" onkeypress="return solonumeros(event)" value="<?php echo date("H:i"); ?>" size="10" maxlength="10"  />
                <input name="nom_recep" type="hidden" id="nom_recep" style="text-transform:uppercase" size="15" /></td>
              <td width="6%">&nbsp;</td>
              <td width="16%">&nbsp;</td>
            </tr>
          </table></td>
          </tr>
        <tr>
          <td width="19%"><span class="camposss">Tipo Poder:</span></td>
          <td colspan="3"><input name="idasunto" type="hidden" id="idasunto" style="text-transform:uppercase" size="2" readonly /><input name="des_asunto" type="hidden" id="des_asunto" style="text-transform:uppercase" size="2" readonly />&nbsp;
            <?php 
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT poderes_asunto.id_asunto AS 'id', poderes_asunto.des_asunto AS 'des'
FROM poderes_asunto 
WHERE poderes_asunto.conte_asunto != 'F'
ORDER BY poderes_asunto.des_asunto ASC"; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "250"; 
			$oCombo->name       = "id_asunto";
			$oCombo->style      = "camposss"; 
			$oCombo->click      = "selectAsunto(this.value);";   
			$oCombo->selected   =  $variable;
			$oCombo->Show();
			$oCombo->oDesCon(); 
?>
</td>
          </tr>
        <tr>
          <td><span class="camposss">Fec. Ingreso</span></td>
          <td width="10%"><input name="fec_ingreso" type="text" class="tcal" id="fec_ingreso" style="text-transform:uppercase" onKeyUp = "this.value=formateafecha(this.value);" value="<?php echo date("d/m/Y"); ?>" size="10" maxlength="10" /></td>
          <td width="14%" align="right"><span class="camposss">Referencia:</span></td>
          <td width="57%"><input name="referencia" type="text" id="referencia" style="text-transform:uppercase" size="50" maxlength="900" onkeypress="return soloLetras(event)"/></td>
          </tr>
        <tr>
          <td><span class="camposss">Comunicarse con:</span></td>
          <td><input name="nom_comuni" type="text" id="nom_comuni" style="text-transform:uppercase" size="30" maxlength="400" onkeypress="return soloLetras(event)"  /></td>
          <td align="right"><span class="camposss">Telefono:</span></td>
          <td><input name="telf_comuni" type="text" id="telf_comuni" style="text-transform:uppercase" size="10" onkeypress="return solonumeros(event)" maxlength="15" /></td>
        </tr>
        <tr>
          <td><span class="camposss">Email:</span></td>
          <td><input name="email_comuni" type="text"  id="email_comuni"  size="30" maxlength="400" placeholder="ejemplo@dominio.com" /></td>
          <td></td>
          <td><input name="documento" type="hidden" id="documento" style="text-transform:uppercase" value="0.00" size="20" /></td>
        </tr>
        <tr>
          <td><span class="camposss">Responsable Not.</span></td>
          <td colspan="3">
<input name="id_respon" type="text" id="id_respon" style="text-transform:uppercase" value="<?php echo $_SESSION["apepat_usu"].' '.$_SESSION["nom1_usu"]; ?>" size="60" readonly maxlength="400" onkeypress="return soloLetras(event)" />
&nbsp;
            <input name="des_respon" type="hidden" id="des_respon" style="text-transform:uppercase" value="<?php echo $_SESSION["apepat_usu"].' '.$_SESSION["nom1_usu"]; ?>" size="25" /></td>
          </tr>
        <tr>
          <td valign="top"></td>
          <td colspan="3">
            <input name="doc_presen" type="hidden" id="doc_presen" /></td>
        </tr>
        <tr>
          <td valign="top"></td>
          <td><input name="fec_ofre" type="hidden" id="fec_ofre" style="text-transform:uppercase" value="<?php echo date("d/m/Y"); ?>" size="15" class="tcal" /></td> 
          <td></td>
          <td><input name="hora_ofre" type="hidden" id="hora_ofre" style="text-transform:uppercase" value="<?php echo date("H:i"); ?>" size="10" /></td>
        </tr>
        <tr>
          <td colspan="4" align="center">
          <div id="btn_poderes" style="display:none">
           <button title="Contratantes" type="button" name="btncontratantes"    id="btncontratantes" value="contratantes" onclick="fmuesContratantes();" ><img src="../../images/newuser.png" width="20" height="20" align="absmiddle" />&nbsp; Participantes</button>  &nbsp;&nbsp;
            
            <button title="essalud" type="button" name="btnessalud"    id="btnessalud" value="essalud" onclick="fmuesEssalud();" ><img src="../../images/health.png" width="20" height="20" align="absmiddle" />&nbsp; Essalud</button> &nbsp;&nbsp;
            
             <button title="Pensiones" type="button" name="btnpensiones"    id="btnpensiones" value="pensiones" onclick="fmuesPensiones();" ><img src="../../images/pay.png" width="20" height="20" align="absmiddle" />&nbsp; Pensiones</button> &nbsp;&nbsp;
            
                      <button title="Observacion" type="button" name="btnobs"    id="btnobs" value="observacion" onclick="fmuesObservacion();" ><img src="../../images/obs.png" width="20" height="20" align="absmiddle" /> Formato libre</button>
                </div>     
                      </td>
          </tr>
        </table>
    </fieldset>  
      </td>
    </tr>
  <tr>
    <td height="30" >
    <input name="num_cronoG" type="hidden" id="num_cronoG" />
    <input name="fecha_cronoG" type="hidden" id="fecha_cronoG" />
    <input name="num_formuG" type="hidden" id="num_formuG" />
    <input name="lugar_formuG" type="hidden" id="lugar_formuG" />
    <input name="observacionG" type="hidden" id="observacionG" />
    </td>
  </tr>
</table>
</div>
</form>
</body>
</html>