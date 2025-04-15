<?php 
session_start();

	include("../../conexion.php");
	
	require_once("../../includes/barramenu.php") ;
	require_once("../../includes/gridView.php")  ;
	require_once("../../includes/combo.php")  	 ;
	$oBarra = new BarraMenu() 				     ;
	$Grid1  = new GridView()					 ;
	$oCombo = new CmbList()  				     ;	
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Ingreso de permisos de viaje</title>
<link href="../../includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../../tcal.css" />
<link href="../../includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../../includes/css/uniform.default.min.css" />
<link rel="stylesheet" type="text/css" href="../../tcal.css" />
<link rel="stylesheet" type="text/css" href="../includes/css/PermiviajeVie.css" />

<script type="text/javascript" src="../../tcal.js"></script> 
<script type="text/javascript" src="../includes/Mantenimientos.js"></script> 
<script src="../../includes/jquery-1.8.3.js"></script>
<script src="../../includes/js/jquery-ui-notarios.js"></script>
<script src="../../includes/jquery.uniform.min.js"></script>
<script src="../../includes/maskedinput.js"></script>
<script type="text/javascript" src="../../tcal.js"></script> 
<script type="text/javascript" src="../includes/js/PermiviajeVie.js"></script> 

<script type="text/javascript">

// #= Imprime Permiso Viaje.
	function fImprimir()
	{  
		var _tip_permi = document.getElementById('idasunto').value;
		var _id_viaje  = document.getElementById('id_viaje').value;
		if(_id_viaje==''){alert('Debe guardar los datos primero');return;}
		var _usuario_imprime = '<?php echo $_SESSION["apepat_usu"].' '.$_SESSION["nom1_usu"]; ?>';
		var _nom_notario     = 'Nombre del notario';
		
		
		_data = {
					id_viaje : _id_viaje,
					usuario_imprime : _usuario_imprime,
					nom_notario : _nom_notario	
					
				}
	// #= Evalua el tipo de Permiso:	
	if(_tip_permi=='001')
		{
			
			$.post("../../reportes_word/generador_permiviaje_interior.php",_data,function(_respuesta){
			alert(_respuesta);
						});
		}
	else if(_tip_permi=='002')
		{
			$.post("../../reportes_word/generador_permiviaje_exterior.php",_data,function(_respuesta){
			alert(_respuesta);
			});
		}
	
	}
		function fNoCorreViaje()
	{ //alert('dasd');
		var _id_viaje = document.getElementById('id_viaje');
		if(_id_viaje.value==''){alert('No se ha grabado el permiso');return;}
		
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
						$(this).dialog("destroy").remove();
					}
				}
			});
		}	
	}

	function fevalNocorre()
	{
		fNocorreAction();
		$("#mues_nocorre").dialog("close");
	}


	function fVisualDocument()
	{
		var _tip_permi = $("#idasunto").val();
		var _id_viaje  = $("#id_viaje").val();
		
		if(_id_viaje==''){alert('Debe guardar los datos primero');return;}
		
		var _usuario_imprime = '<?php echo $_SESSION["apepat_usu"].' '.$_SESSION["nom1_usu"]; ?>';
		var _nom_notario     = 'NOMBRE DEL NOTARIO';
		var _numdocu         = '<?php echo $numpermiso; ?>';
		
//AjaxReturn('../../reportes_word/generador_permiviaje_interior.php?id_viaje='+_id_viaje+'&usuario_imprime='+_usuario_imprime+'&nom_notario='+_nom_notario);

		if(_tip_permi=='001')
		{
			window.open("genera_permiviaje.php?id_viaje="+_id_viaje+"&usuario_imprime="+_usuario_imprime+"&nom_notario="+_nom_notario+"&numdocu="+_numdocu);
		}
		if(_tip_permi=='002')
		{
			window.open("genera_permiviaje.php?id_viaje="+_id_viaje+"&usuario_imprime="+_usuario_imprime+"&nom_notario="+_nom_notario+"&numdocu="+_numdocu);
		}
		
		
			
	}
// ################################
	function CreateObjectAjax(){
		var xmlhttp=false;
		try {
			xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try {
			   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (E) {
				xmlhttp = false;
			}
		}
	
		if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
			xmlhttp = new XMLHttpRequest();
		}
		return xmlhttp; }
		
	function AjaxReturn(url,_nom){
		  ajax = CreateObjectAjax();
		  var _pag = '';
		    ajax.open('GET', url,true);
		    ajax.onreadystatechange = function(){
		    if(ajax.readyState == 4 && ajax.status==200)
			{
				if(ajax.responseText=='' )
					{
						alert('Generado Correctamente..!');
						// #= Evalua el tipo de Permiso:	
						if(_tip_permi=='001')
							{
								window.open('../../reportes_word/generador_permiviaje_interior.php?id_viaje='+_id_viaje+'&usuario_imprime='+_usuario_imprime+'&nom_notario='+_nom_notario,'_blank','toolbars=no, scrollbars=no, menubar=no, resizable=no, width=300, height=250');	
							}
						else if(_tip_permi=='002')
							{
								window.open('../../reportes_word/generador_permiviaje_exterior.php?id_viaje='+_id_viaje+'&usuario_imprime='+_usuario_imprime+'&nom_notario='+_nom_notario,'_blank','toolbars=no, scrollbars=no, menubar=no, resizable=no, width=300, height=250');			
							}
						
					}
		     _pag = ajax.responseText;
		    }
		  }
	  ajax.send(null);
	}	

function maxLengthX(e,obj,num) {
    k = (document.all) ? e.keyCode : e.which;
    if (k==8 || k==0){ return true; }
    else{ return obj.value.length<num; }
}



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
		document.getElementById('tel_comu').value='';
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

<body style="font-size:62.5%;">
<form id="form_permisos" name="frmbuscakardex"  action="PermiviajeVie.php" method="post" >
<div id="permisos_viaje">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
	<td width="35%">
    <?php 
				$oBarra->Graba        = "1"                  ;
				$oBarra->GrabaClick   = "fGraba();"          ;
				$oBarra->Genera       = "1"                  ;
				$oBarra->GeneraClick  = "fGenerar();"        ;
				$oBarra->Impri        = "1"                  ;
				$oBarra->ImpriClick   = "fImprimir();"       ;
				$oBarra->clase        = "css"      		     ; 
				$oBarra->widthtxt   = "20"				     ; 
				$oBarra->Show()  						     ; 
	?>
    </td>	
              
    <td width="21%" align="left"><div id="verdocumen"><button title="visualizar" type="button" name="btnver"    id="btnver" value="visualizar" onclick="fVisualDocument();" ><img align="absmiddle" src="../../images/block.png" width="15" height="15" />Ver Doc.</button></div></td>
    <td width="33%" align="left"><div id="div_muesStatusNC"></div></td>   
      <td width="11%" align="left"> <button title="No corre" type="button" name="nocorre"    id="nocorre" value="no corre" onclick="fNoCorreViaje();" ><img align="absmiddle" src="../../images/block.png" width="15" height="15" />No Corre</button></td>
    
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
            
              <td colspan="6"><div id="muesguarda" title="Confirmacion" style="display:none">Desea guardar el Permiso..?</div><div id="confirmaGuarda"></div><div id="mueselim" title="Confirmacion" style="display:none">Desea eliminar el Permiso..?</div><div id="confirmaElimina"></div></td>

            </tr>
            <tr>
              <td width="13%"><span class="camposss">Nro Control:</span></td>
              <td width="20%"><div id="resul_crono" style="width:100px;"><input name="id_viaje" type="hidden" id="id_viaje" /></div><input name="numkardex" type="hidden" id="numkardex" size="15" readonly  />
                <span style="width:100px;">
                <input name="codkardex" type="hidden" id="codkardex" />
                </span></td>
              <td width="11%" align="left"><span class="camposss">Encargado:</span></td>
              <td width="36%"><input name="recepcionado" type="text" id="recepcionado" style="text-transform:uppercase" value="<?php echo $_SESSION["apepat_usu"].' '.$_SESSION["nom1_usu"]; ?>" size="40" onkeypress="return soloLetras(event)" readonly /></td>
              <td width="5%"><span class="camposss">Hora:</span></td>
              <td width="15%"><input name="horarecep" type="text" id="horarecep" style="text-transform:uppercase" value="<?php echo date("H:i"); ?>" size="10" maxlength="5" onkeypress="return solonumeros(event)" /></td>
            </tr>
          </table></td> 
          </tr>
        <tr>
          <td width="11%"><span class="camposss">Tipo Permiso:</span></td>
          <td colspan="3">&nbsp;<?php 
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT asunto_viaje.cod_asunto AS 'id', asunto_viaje.des_asunto AS 'des' FROM asunto_viaje"; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "180"; 
			$oCombo->name       = "idasunto";
			$oCombo->style      = "camposss"; 
			$oCombo->click      = "//funcionprueba()";   
			$oCombo->Show();
			$oCombo->oDesCon(); 
?></td>
          </tr>
        <tr>
          <td><span class="camposss">Fec. Ingreso:</span></td> 
          <td width="22%"><input name="fecingreso" type="text" class="tcal" id="fecingreso" style="text-transform:uppercase"   onKeyUp = "this.value=formateafecha(this.value);" value="<?php echo date("d/m/Y"); ?>" size="10" maxlength="10"/></td>
          <td width="11%"><span class="camposss">Referencia:</span> </td>
          <td width="56%"><input name="referencia" type="text" id="referencia" style="text-transform:uppercase" size="50" maxlength="200" /></td>
          </tr>
        <tr>
          <td><span class="camposss">Comunicarse con:</span> </td>
          <td><input name="nom_comu" type="text" id="nom_comu" style="text-transform:uppercase" size="30" maxlength="400" onkeypress="return soloLetras(event)"/></td>
          <td><span class="camposss">Telefono:</span> </td>
          <td><input name="tel_comu" type="text" id="tel_comu" style="text-transform:uppercase" size="15"  onkeypress="return solonumeros(event)" maxlength="11" /></td>
        </tr>
        <tr>
          <td><span class="camposss">Email:</span></td>
          <td><input name="email_comu"  type="text" id="email_comu" size="30" maxlength="200" placeholder="correo@dominio.com" /></td>
          <td></td>
          <td><input name="doc_comu" style="text-transform:uppercase" type="hidden" id="doc_comu" size="20" /></td>
        </tr>
        <tr>
          <td><span class="camposss">Viaja a:</span></td>
          <td colspan="3"><input name="lugar_formuG" type="text" id="lugar_formuG" style="text-transform:uppercase" size="90" maxlength="250" onkeypress="return soloLetras(event)" /></td>
          </tr>
        <tr>
          <td valign="top"><span class="camposss">Observaciones:</span></td>
          <td colspan="3"><textarea onkeypress="return maxLengthX(event,this,1000);" name="observacionG" style="text-transform:uppercase;" id="observacionG" cols="100" rows="3"></textarea></td>
          </tr>
        <tr>
          <td colspan="2" align="center">
          <div id="mues_btnparticipantes"><button title="Contratantes" type="button" name="btncontratantes"    id="btncontratantes" value="contratantes" onclick="fmuesContratantes();" ><img src="../../images/newuser.png" width="20" height="20" align="absmiddle" />&nbsp; Participantes</button></div>
          </td>
          <td colspan="2" align="center"><!--<button title="Observacion" type="button" name="btnobs"    id="btnobs" value="observacion" onclick="fmuesObservacion();" ><img src="../../images/obs.png" width="20" height="20" align="absmiddle" />&nbsp; Observacion</button>-->
            <table width="547" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="547" height="21"><span style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:#036"><strong>Informacion de Ingreso de Participantes..!</strong></span><br>
                  <span style="font-family:Verdana, Geneva, sans-serif; font-size:10px; color:#333"> 1.- Al ingresar a los participantes, primero debe ingresar AL PADRE y/o a LA MADRE.<br>
                  2.- Luego ingresar al APODERADO  si fuera el caso<br>3.- finalmente agregar al HIJO o HIJOS</span> </td>
              </tr>
            </table></td>
          </tr>
        </table>
    </fieldset>  
      </td>
    </tr>
  <tr>
    <td height="30" >
    <input name="num_cronoG" type="hidden" id="num_cronoG" />
    <input name="fecha_cronoG" type="hidden" id="fecha_cronoG" />
    <input name="num_formuG" type="hidden" id="num_formuG" /></td>
  </tr>
</table>
</div>
</form>
</body>
</html>