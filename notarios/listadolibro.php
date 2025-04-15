<?php 
include("conexion.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link href="includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="tcal.css" />
<link href="includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="includes/css/uniform.default.min.css" />



<script language="JavaScript" type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="tcal.js"></script> 
<script src="includes/jquery-1.8.3.js"></script>
<script src="includes/js/jquery-ui-notarios.js"></script>
<script src="includes/jquery.uniform.min.js"></script>
<script type="text/javascript" src="tcal.js"></script> 
<script language="JavaScript" type="text/javascript" src="ajaxlibro.js"></script>
<script type="text/javascript" charset="utf-8">

      $(function(){
        $("input, textarea, select, button").uniform();
      });
    </script>
<title>Untitled Document</title>
<style type="text/css">
<!--
.titubuskar {
	font-family: Calibri;
	font-size: 12px;
	font-weight: bold;
	font-style: italic;
	color: #003366;
}
.titubuskar0 {font-family: Calibri; font-size: 12px; font-style: italic; color: #333333; }
.titubuskar1 {color: #333333}
.reskar2 {font-family: Calibri; font-size: 13px; font-weight: bold; font-style: italic; color: #003366; }
.reskar {font-size: 12px; font-style: italic; color: #333333; font-family: Calibri;}
-->
</style>
<script type="text/javascript">

$(document).ready(function()
{
cargakardex(0)
	});
	



	function cargakardex(limite)
{
	
	
	
	<?php 

if(isset($_REQUEST['val'])=='10'){ 
  $descrio 			= $_REQUEST['descrio'];
	$dnilib 			= $_REQUEST['dnilib'];
	$crono				= $_REQUEST['crono'];
	$rangof1 	 		= $_REQUEST['rangof1'];
	$rangof2  			= $_REQUEST['rangof2'];
	 $i=$_REQUEST['pagina'];
	 $estado=$_REQUEST['estado'];
	 
	 
	 
}else{
  
	$descrio 			= "";
	$dnilib 			= "";
	$crono				= "";
	$rangof1 	 		= "";
	$rangof2  			= "";
	 $i="";
	 $estado="";
}
	 
	 
?>

	/*var url="busqueda_libro.php";
	$.post(url,{estado : "1",limite: limite},function (responseText){
		    $("#blibro").html(responseText);
	  });*/
	  
	   var url="busqueda_libro.php?&descrio=<?php echo $descrio; ?>&dnilib=<?php echo $dnilib; ?>&crono=<?php echo $crono; ?>&rangof1=<?php echo $rangof1; ?>&rangof2=<?php echo $rangof2; ?>&pagina=<?php echo $i; ?>";
	$.post(url,{estado : "<?PHP if(isset($_REQUEST['val'])=='10'){echo $estado=$_REQUEST['estado'];}else{echo 1;}?>",limite: limite},function (responseText){
		    $("#blibro").html(responseText);
	  });     
}

function buscaruc() 
{
	
  var _descrio	 = $('#descrio').val();
  var _dnilib 	 = $('#dnilib').val();
  var _crono 	 = $('#crono').val();
  var _rangof1 	 = $('#rangof1').val();
  var _rangof2   = $('#rangof2').val();
  // var _tipolibro   = $('#tipolibro').val();
  
  
	 
	 
	 if(_descrio=='' && _dnilib=='' && _crono=='' && _rangof1=='' && _rangof2=='' )
	{
		var limite     = 0;
		//var _estado    = "1";	 
		<?php if(isset($_REQUEST['val'])=='10'){ ?>
		
		var _estado    = <?php echo $_REQUEST['estado'];?>;	
		<?php }else{?>
		var _estado    = "1";	
		<?php }?>  	 
	}
	else if(_descrio!='' || _dnilib!='' || _crono!='' || _rangof1!='' || _rangof2!='' ){
		var limite     = 0;
		var _estado    = "2"; 
		
		}
		
	 var _data =
	 {
		descrio 		: _descrio,
		dnilib   		: _dnilib,
		crono 			: _crono,
		rangof1    		: _rangof1,
		rangof2 		: _rangof2,
	//	tipolibro 		: _tipolibro,
		estado			: _estado,
		limite			: limite
	 }
	 $('#blibro').load("busqueda_libro.php",_data);
	 return false;
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
 letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
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
 letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
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
 
  
    if( !er_telefono.test(frmbuscakardex.numformu.value) ) {
        alert('Caracter Incorrecto.')
        return false
    }
 
  
    return false           
}
</script>
</head>

<body>
<table width="773" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="726" height="25"><span class="reskar2">Busqueda Por:</span></td>
    <td width="47" rowspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td><form name="frmbuscakardex" method="post" action="">
      <table width="772"  border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="105" align="right"><span class="titubuskar0">Empresa/Cliente </span></td>
          <td width="163"><input  name="descrio" type="text" id="descrio" size="20" onkeypress="return soloLetras(event)"/></td>
          <td width="87" align="right"><span class="titubuskar0">Dni/Ruc</span></td>
          <td width="163"><input name="dnilib" type="text" id="dnilib" size="20" onKeyUp="return validacion3(this)" /></td>
          <td width="94" align="right"><span class="titubuskar0">N° Cronologico</span></td>
          <td width="160"><span class="titubuskar0">
            <input name="crono" type="text" id="crono" size="20" onKeyUp="return validacion3(this)" />
            </span></td>
        </tr>
        </table>
    </form>   </td>
  </tr>
  <tr>
    <td colspan="2">
    	<table width="576" border="0" cellspacing="0" cellpadding="0">
<tr>
  <td width="193">&nbsp;  </td>
</tr>
      </table>
     <table>
        <tr>
          <td width="137"><span class="reskar2">Busqueda por fecha:</span></td>
      </tr></table>
      <table>
           <tr>
          <td width="56" align="right"><span class="titubuskar0">Desde</span></td>
            
            <td width="85"><span class="titubuskar0">
              <input name="rangof1" type="text" id="rangof1" class="tcal" style="text-transform:uppercase"  size="10" onKeyUp = "this.value=formateafecha(this.value);" />
            </span></td>
            <td width="63" align="center"><span class="titubuskar0">Hasta</span></td>
            <td width="84"><label>
              <!--input name="nomcontratante" type="text" id="nomcontratante" size="40" onkeypress="buscakardexc()">-->
              <input name="rangof2" type="text" id="rangof2" class="tcal" style="text-transform:uppercase"  size="10"  onKeyUp = "this.value=formateafecha(this.value);"/>
            </label></td>
               <td width="375"><label><a onclick="buscaruc()"><img src="iconos/buscarclie.png" width="72" height="29" border="0" /></a>
            </label></td>
           </tr>
      </table>
    </td>
  </tr>
  
  <tr>
    <td colspan="2"><div id="gennn" style="width:850px; height:690px; overflow:auto;">
      <table width="822" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="834"><table width="823" border="1" cellpadding="0" cellspacing="0" bordercolor="#333333" bgcolor="#CCCCCC">
            <tr>
              <td width="79" align="center"><span class="titubuskar0">N° Cronologico</span></td>
              <td width="84" align="center"><span class="titubuskar0">Fecha </span></td>
              <td width="153" align="center"><span class="titubuskar0">Empresa / Cliente</span></td>
              <td width="116" align="center"><span class="titubuskar0">Tipo Libro</span></td>
              <td width="101" align="center"><span class="titubuskar0">N° de Libro</span></td>
              <td width="68" align="center"><span class="titubuskar0">N° de Folio</span></td>
              <td width="101" align="center"><span class="titubuskar0">Tipo de Folio</span></td>
              <td width="73" align="center"><span class="titubuskar0">DNI / RUC</span></td>
              <td width="28" align="center">&nbsp;</td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td><div id="blibro" style="width:848px">
           
          </div></td>
        </tr>
      </table>
    </div></td>
  </tr>
</table>

</body>
</html>



