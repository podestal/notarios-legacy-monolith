<?php
	include("../../conexion.php");
	require_once("../../includes/barramenu.php") ;
	require_once("../../includes/gridView.php")  ;
	require_once("../../includes/combo.php")  	 ;
	$oBarra = new BarraMenu() 				     ;
	$Grid1 = new GridView()					     ;
	$oCombo = new CmbList()  				     ;	
	
	mysql_query("truncate kardex_ro",$conn);
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Generar Bloque de Kardex</title>
<link href="../../includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../../tcal.css" />
<link href="../../includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../../includes/css/uniform.default.min.css" />
<link rel="stylesheet" type="text/css" href="../../tcal.css" />

<script type="text/javascript" src="../../tcal.js"></script> 
<script type="text/javascript" src="../includes/ext_script1.js"></script> 
<script src="../../includes/jquery-1.8.3.js"></script>
<script src="../../includes/js/jquery-ui-notarios.js"></script>
<script src="../../includes/jquery.uniform.min.js"></script>
<script src="../../includes/maskedinput.js"></script>
<script type="text/javascript" src="../../tcal.js"></script> 
<script type="text/javascript" src="funciones_ro.js"></script>

<script type="text/javascript">

     $(document).ready(function(){ 
		 $("input, textarea").uniform();
		 $("button").button();
		 $("#dialog").dialog();
		 $(".ui-dialog-titlebar").hide();
	})
	
	function fShowRO()
	{
		var _desde    = document.getElementById('fec_desde').value;
		var _hasta    = document.getElementById('fec_hasta').value;
		var _idkardex = document.getElementById('id_kardex').value;
		
		window.open('../includes/list_error_ro.php?initialDate='+_desde+'&finalDate='+_hasta);			
	}	
	

  function validationRo(){

    var  vinitialDate    = document.getElementById('fec_desde').value;
    var  vfinalDate    = document.getElementById('fec_hasta').value;


    $.ajax({
      url:'../includes/generate_ro.php',
      data:{initialDate:vinitialDate,finalDate:vfinalDate},
      dataType:'json',
      type:'GET',
      success:function(response){

      }

    });


  }



</script>
<style type="text/css">
div.div_genkar
{ 
background-color: #ffffff;
border: 4px solid #264965;  

-moz-border-radius: 5px;
-webkit-border-radius: 5px;
border-radius: 5px;
-moz-box-shadow: 0px 0px 5px #000000;
-webkit-box-shadow: 0px 0px 5px #000000;
box-shadow: 0px 0px 5px #000000;
width:550px; height:300px;
float:left;
margin-left:30%;
margin-top:10px;
}

div.div_errores
{ 
background-color: #ffffff;
border: 4px solid #264965;  

-moz-border-radius: 5px;
-webkit-border-radius: 5px;
border-radius: 5px;
-moz-box-shadow: 0px 0px 5px #000000;
-webkit-box-shadow: 0px 0px 5px #000000;
box-shadow: 0px 0px 5px #000000;
width:550px; height:300px;
float:left;
margin-left:30%;
margin-top:10px;
overflow-y: scroll;
}

.titulosprincipales {
	font-family: Verdana;
	font-size: 14px;
	color: #F90;
	font-style: italic;	
}
.line {color: #FFFFFF}

<!--
.Estilo7 {font-family: Calibri; font-size: 13px; font-style: italic; }
.Estilo14 {font-family: Calibri; font-size: 12px; color: #333333; font-weight: bold; }
.Estilo12 {font-family: Calibri; font-size: 12px; color: #333333; font-style: italic; }
-->
.camposss {font-family: Verdana; font-size: 11px; color: #333333; }
body{ font-family: Arial, Helvetica, sans-serif; font-size:12px; font-weight: bold; margin-bottom:50px;}
.cajas{ margin-bottom:25px;}
</style>
</head>

<body onLoad="reiniciar();" style="font-size:62.5%;">
<div class="div_genkar">
  <table width="553" height="100%"  border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="553" height="30" bgcolor="#264965">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="28" height="30">&nbsp;</td>
            <td width="333"><span class="titulosprincipales">Informacion requerida para UIF</span></td>
            <td width="163" >&nbsp;</td>
            <td width="29">&nbsp;</td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td valign="top">
            <table width="550" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td colspan="2"></td></tr>
              <tr>
                <td height="22" align="right" bgcolor="#FFFFFF" >&nbsp;</td>
                <td height="28" bgcolor="#FFFFFF">&nbsp;</td>
              </tr>
              <tr>
                <td width="228" height="33" align="right" bgcolor="#FFFFFF" ><span class="camposss">Desde : </span></td>
                
                
                      <td width="323" height="33" bgcolor="#FFFFFF"><span id="sprytextfield5">
                <label>
                  &nbsp;<input name="fec_desde" type="text" id="fec_desde" style="text-transform:uppercase; margin-left:15px; background:#FFF" size="10" value="<?php echo date("d/m/Y"); ?>" class="tcal" />
                  </label>
                <input name="id_kardex" type="hidden" id="id_kardex"  />
                </span></td>
                
                
                
              </tr>
         
              <tr>
                <td height="34" align="right" bgcolor="#FFFFFF" ><span class="camposss">Hasta :</span></td>
                <td height="34" bgcolor="#FFFFFF"><span id="sprytextfield5">
                <label>
                  &nbsp;<input name="fec_hasta" type="text" id="fec_hasta" style="text-transform:uppercase; margin-left:15px; background:#FFF" size="10" value="<?php echo date("d/m/Y"); ?>" class="tcal" />
                </label>
                </span></td>
              <tr>
                <td height="80" colspan="2" align="center"><span class="camposss">Orden Cronologico:</span>
				<input id="m_form"  name="m_form" type="checkbox"  value="1" class="Estilo7" style="width:30px"/>
                  <table width="224" border="0" align="center" cellpadding="1" cellspacing="1">
                    <tr>
                      <td width="220"></td>
                    </tr>
                </table></td>
              </tr>
             
              <tr>
              <td height="97" colspan="2" align="center"  >
               <button  type="x" name="generar"    id="generar" value="" onClick="fShowRO();" >Generar RO</button>
                </td>
              </tr>
          </table>

        </td>
    </tr>
  </table>
</div>


</body>
</html>
