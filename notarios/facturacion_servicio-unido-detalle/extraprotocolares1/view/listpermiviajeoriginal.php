<?php 
include("../../conexion.php");

$sql =mysql_query("SELECT * FROM ingreso_cartas",$conn) or die(mysql_error());

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../../includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../../tcal.css" />
<link href="../../includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../../includes/css/uniform.default.min.css" />



<script language="JavaScript" type="text/javascript" src="../../ajax.js"></script>
<script type="text/javascript" src="../../tcal.js"></script> 
<script type="text/javascript" src="../includes/Mantenimientos.js"></script> 
<script src="../../js/jquery.min.js" type="text/javascript" charset="utf-8"></script>
<script src="../../includes/jquery-1.8.3.js"></script>
<script src="../../includes/js/jquery-ui-notarios.js"></script>
<script src="../../includes/jquery.uniform.min.js"></script>
<script type="text/javascript" src="../../tcal.js"></script> 


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
.titubuskar0 {font-family: Calibri; font-size: 12px; font-style: italic; font-weight: bold; color: #333333; }
.titubuskar1 {color: #333333}
.reskar2 {font-family: Calibri; font-size: 13px; font-weight: bold; font-style: italic; color: #003366; }
.reskar {font-size: 12px; font-style: italic; color: #333333; font-family: Calibri;}
-->
</style>

<script type="text/javascript">
$(document).ready(function(){
cargakardex(0)
	});
	
function cargakardex(limite)
{
	
	<?php 

if(isset($_REQUEST['val'])=='10'){ 
     $numformu=$_REQUEST['numformu'];
	 $participante=$_REQUEST['participante'];
	 $rango1=$_REQUEST['rango1'];
	 $rango2=$_REQUEST['rango2'];
	 $tippersona=$_REQUEST['tippersona'];
	 $nrocontrol=$_REQUEST['nrocontrol'];
	 $i=$_REQUEST['pagina'];
	 $estado=$_REQUEST['estado'];
	 $resultados=$_REQUEST['resultados'];
	 
	 
	 
}else{
  
	 $numformu="";
	 $participante="";
	 $rango1="";
	 $rango2="";
	 $tippersona="";
	 $nrocontrol="";
	 $i="";
	 $estado="";
	 $resultados="";
}
	 
	 
?>
	/*var url="busqueda_viajes.php";
	$.post(url,{estado : "1",limite: limite},function (responseText){
		    $("#bkardex").html(responseText);
			
	  });*/
	  
	var url="busqueda_viajes.php?&numformu=<?php echo $numformu; ?>&participante=<?php echo $participante; ?>&rango1=<?php echo $rango1; ?>&rango2=<?php echo $rango2; ?>&tippersona=<?php echo $tippersona; ?>&nrocontrol=<?php echo $nrocontrol; ?>&resultados=<?php echo $resultados; ?>&pagina=<?php echo $i; ?>";
	$.post(url,{estado : "<?PHP if(isset($_REQUEST['val'])=='10'){echo $estado=$_REQUEST['estado'];}else{echo 1;}?>",limite: limite},function (responseText){
		    $("#bkardex").html(responseText);
	  });  
}



function buscaPERMIVIAJE(){
	
	var _numformu 		= $('#numformu').val();
	var _participante	= $('#participante').val();
	var _rango1		    = $('#rango1').val();
	var _rango2  	    = $('#rango2').val();
	var _tippersona     = $('#tippersona').val();
	var _nro			= $('#nrocontrol').val();
	var _resultado       = $("input[name='opcion']:checked").val()
 	//var porNombre			= $('#opcion').val();
	//alert($("input[name='opcion']:checked").val());

	/*var porNombre=document.getElementsByName("opcion");
	if(porNombre!=""){
        for(var i=0;i<porNombre.length;i++)
        {
            if(porNombre[i].checked)
                resultado=porNombre[i].value;
        }
	}
    alert(resultado);*/

   
	<!-- capturamos el valor del option-->
	/*var porNombre=document.getElementsByName("opcion"); 
	for(var i=0;i<porNombre.length;i++) { 
    if(porNombre[i].checked) 
	 _resultado=porNombre[i].value; 
     } */
	//alert(resultado);
    <!-- finalizamos la optencion del opcion como resultado-->
	
	//exit();
	
	
	
		if(_numformu=='' && _participante=='' && _rango1=='' && _rango2=='' &&  _tippersona=='' && _nro=='')
	{
		  
		var limite     = 0;
		//var _estado    = "1";	
		<?php if(isset($_REQUEST['val'])=='10'){ ?>
		
		var _estado    = <?php echo $_REQUEST['estado'];?>;	
		<?php }else{?>
		var _estado    = "1";	
		<?php }?> 
	}
	else if(_numformu!='' || _participante!='' || _rango1!='' || _rango2!='' ||  _tippersona!='' || _nro!=''){
		var limite     = 0;
		var _estado    = "2"; 
		
		}
	
	var _data = 
	{
		numformu 		: _numformu,
		participante	: _participante,
		rango1			: _rango1,
		rango2   		: _rango2,
		tippersona		: _tippersona,
		nrocontrol		: _nro,
		resultados      : _resultado,
		estado			: _estado,
		limite          : limite
	}
	$('#bkardex').load("busqueda_viajes.php",_data);
	
	return false;
	
	}


 /*  function fbuscanumformu(f){if (isNaN(f)) {
alert("Este campo debe tener sólo números.");
document.getElementById('numformu').value="";
document.getElementById('numformu').focus();
return (false);

 }
 }*/
 
 
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
<table width="858" border="0" cellspacing="0" cellpadding="0">
<tr>
  <td width="20"><table width="858" border="0" cellspacing="0" cellpadding="0">
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr>
      <td width="20"><span class="reskar2">Busqueda Por:</span></td>
      <td width="58">&nbsp;</td>
      <td width="25">&nbsp;</td>
      <td width="62" align="right">&nbsp;</td>
      <td width="72">&nbsp;</td>
    </tr>
    <tr>
      <td><form name="frmbuscakardex" method="post" action="">
        <table width="837" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="62" align="right"><span class="titubuskar0">N° Crono :</span></td>
            
            <td width="72"><span class="titubuskar0">
              <input name="numformu" type="text" id="numformu" size="12"   onKeyUp="return validacion3(this)" />
        <!--onkeypress="return aceptNum(event)"-->
		
            </span></td>
            <td width="22">&nbsp;</td>
               <td width="126"><span class="titubuskar0">
            <select name="tippersona" id="tippersona" class="input-mediun" 		onchange="buscaPERMIVIAJE()">
            <option value ="" selected="selected">TIPO PERMISO</option>
            <option value="001">Interior</option>
            <option value="002">Exterior</option>
          </select>
            </span></td>
            <td width="124" align="right"><span class="titubuskar0">
             Nombre Participante :</span></td>
            <td width="202"><label>
                           <input style="text-transform:uppercase;" name="participante2" type="text" id="participante" size="30" onkeypress="return soloLetras(event)" />
            </label></td>
            
             <td width="89" align="right"><span class="titubuskar0">
             Nro Control :</span></td>
            <td width="140"><label>
                           <input style="text-transform:uppercase;" name="nrocontrol" type="text" id="nrocontrol" size="10" onkeyup="fbuscanrocontrol(this.value)"  />
            </label></td>
            
          </tr>
          <tr>
            <td width="62">&nbsp;</td>
            <td width="72">&nbsp;</td>
            <td width="22"><span class="titubuskar0">
       
            </span></td>
            
          </tr>
        </table>
        
        <table>
        <tr>
          <td width="160"><span class="reskar2">Busqueda por Fecha Crono.:</span></td>
      	</tr>
      </table>
      
      <table width="867">
           <tr>
         
         
            <td width="103" align="right"><span class="titubuskar0">Desde:</span></td>
            <td width="88"><span class="titubuskar0">
              <input name="rango1" type="text" id="rango1" class="tcal" style="text-transform:uppercase"  size="10"  onKeyUp = "this.value=formateafecha(this.value);"/>
            </span></td>
            <td width="10">&nbsp;</td>
            <td width="53" align="center"><span class="titubuskar0">Hasta</span></td>
            <td width="120"><input name="rango2" type="text" id="rango2" class="tcal" style="text-transform:uppercase"  size="10" onkeyup = "this.value=formateafecha(this.value);"/></td>
            <td width="120"><span class="titubuskar0">Fecha.Ingreso</span><input type="radio" name="opcion" id="opcion" value="1"><span class="titubuskar0">Fecha.Crono</span> <input type="radio" name="opcion" id="opcion" value="2">
</td>
            <td width="120">
</td>
               <td width="201" align="left"><label><a onclick="buscaPERMIVIAJE()"><img src="../../iconos/buscarclie.png" width="72" height="29" border="0" /></a>
            </label></td>
            
           </tr>
      </table>
      </form></td>
    </tr>
    <tr>
      <td colspan="2">----------------------------------------------------------------------------------------------------------------------------------------------------</td>
    </tr>
    <tr>
      <td colspan="2"><div id="gennn" style="width:860px; height:690px; overflow:auto;">
        <table width="200" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><table width="880" border="1" cellpadding="0" cellspacing="0" bordercolor="#333333" bgcolor="#CCCCCC">
              <tr>
                <td width="30" align="center"><span class="titubuskar0">Nro Control</span></td>
                <td width="60" align="center"><span class="titubuskar0">Cronologico</span></td>
                <td width="236" style="max-width:150px;" align="center"><span class="titubuskar0">Participante de referencia</span></td>
                <td width="86" align="center"><span class="titubuskar0">Fecha Crono.</span></td>
                <td width="150" align="center"><span class="titubuskar0">Tip.Permiso</span></td>
                <td width="86" align="center"><span class="titubuskar0">Fec. Ingreso</span></td>
                <td width="86" align="center"><span class="titubuskar0">Descripcion</span></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td><div id="bkardex">

            </div></td>
          </tr>
        </table>
      </div></td>
    </tr>
  </table>    <span class="reskar2"></span></td>
</tr>
</table>
</body>
</html>



