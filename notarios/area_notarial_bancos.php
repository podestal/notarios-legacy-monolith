<?php 
session_start();
if (empty($_SESSION["id_usu"])) 
  {
    ?>
		<script type="text/javascript">window.location="index.php"; </script> 
<?php  
  }

function actual_date()  
{  
    $week_days = array ("Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado");  
    $months = array ("", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");  
    $year_now = date ("Y");  
    $month_now = date ("n");  
    $day_now = date ("j");  
    $week_day_now = date ("w");  
    $date = $week_days[$week_day_now] . ", " . $day_now . " de " . $months[$month_now] . " de " . $year_now;   
    return $date;    
}  

?>
<?php
include("conexion.php");

## Gestiona permisos segun el usuario:
$idusuario = $_SESSION['id_usu'];

$sqlupermi  = mysql_query("SELECT * FROM permisos_usuarios where idusuario = '$idusuario'",$conn) or die(mysql_error());

$row= mysql_fetch_array($sqlupermi);

//var_dump($Arraymenu);

// Busca menus:


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sistema Informático Notarial </title>

<link href="css/styles.css" type="text/css" media="all" rel="stylesheet" />
	<link href="css/skitter.styles.css" type="text/css" media="all" rel="stylesheet" />
	<link href="css/highlight.black.css" type="text/css" media="all" rel="stylesheet" />
	<link href="css/sexy-bookmarks-style.css" type="text/css" media="all" rel="stylesheet" />
	
	<script src="js/jquery-1.6.3.min.js"></script>
	<script src="js/jquery.easing.1.3.js"></script>
	<script src="js/jquery.animate-colors-min.js"></script>
	
	<script src="js/jquery.skitter.min.js"></script>
	<script src="js/highlight.js"></script>
	<script src="js/sexy-bookmarks-public.js"></script>
	
	<script>
	
	$(document).ready(function() {
		
		var options = {};
	
		if (document.location.search) {
			var array = document.location.search.split('=');
			var param = array[0].replace('?', '');
			var value = array[1];
			
			if (param == 'animation') {
				options.animation = value;
			}
			else if (param == 'type_navigation') {
				if (value == 'dots_preview') {
					$('.border_box').css({'marginBottom': '0px'});
					options['dots'] = true;
					options['preview'] = true;
				}
				else {
					options[value] = true;
					if (value == 'dots') $('.border_box').css({'marginBottom': '0px'});
				}
			}
		}
		
		$('.box_skitter_large').skitter(options);
		
		// Highlight
		$('pre.code').highlight({source:1, zebra:1, indent:'space', list:'ol'});
		
		asigna_permisos();	
		
	});
	
	function asigna_permisos(_obj)
	{
		var _protocolares 		= '<?php echo $protocolares; ?>';
		var _extraprotocolares  = '<?php echo $extraprotocolares; ?>';
		var _reportes 			= '<?php echo $reportes; ?>';
		var _caja 				= '<?php echo $caja; ?>';
		var _usuarios 			= '<?php echo $usuarios; ?>';
		var _herramientas 		= '<?php echo $herramientas; ?>';
		var _configuracion 		= '<?php echo $configuracion; ?>';
		
		// asigna permiso a protocolares:
		if(_obj=='protocolares' && _protocolares=='1')
		{
			return("Protocolares");
		}else if(_obj=='protocolares' && _protocolares=='0'){return("");}
		
		// asigna permiso a extraprotocolares
		if(_obj=='extraprotocolares' && _extraprotocolares=='1')
		{
			return("Extraprotocolares");
		}else if(_obj=='extraprotocolares' && _extraprotocolares=='0'){return("");}
		
		// asigna permiso a reportes
		if(_obj=='reportes' && _reportes=='1')
		{
			return("Reportes");
		}else if(_obj=='reportes' && _reportes=='0'){return("");}
		
		// asigna permiso a Caja
		if(_obj=='caja' && _caja=='1')
		{
			return("Caja");
		}else if(_obj=='caja' && _caja=='0'){return("");}
		
		// asigna permiso a menu Usuarios
		if(_obj=='usuarios' && _usuarios=='1')
		{
			return("Usuarios");
		}else if(_obj=='usuarios' && _usuarios=='0'){return("");}
		
		// asigna permiso a Herramientas
		if(_obj=='herramientas' && _herramientas=='1')
		{
			return("Herramientas");
		}else if(_obj=='herramientas' && _herramientas=='0'){return("");}
		
		// asigna permiso a Herramientas
		if(_obj=='configuracion' && _configuracion=='1')
		{
			return("Configuracion");
		}else if(_obj=='configuracion' && _configuracion=='0'){return("");}

	}
	
	
	</script>
    <script type="text/javascript" src="stmenu.js"></script>
<style type="text/css">
<!--
body {
	background-image: url(imagenes/fnd.jpg);
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.fecha {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #FFFFFF;
}


a.menu:link {
	font-family: Calibri;
	font-size: 12px;
	color:#ffffff;
	text-decoration:none;
}
a.menu:hover {
	font-family: Calibri;
	font-size: 12px;
	color:#FF9900;
	text-decoration:underline;
}
a.menu:visited {
	font-family: Calibri;
	font-size: 12px;
	color:#ffffff;
	text-decoration:none;
}
.style5 {
	font-family: Calibri;
	font-style: italic;
	font-size: 18px;
}
div.marco
{ 
  background-color: #ffffff; border: 2px solid #cccccc;  

-moz-border-radius: 15px;
-webkit-border-radius: 15px;
border-radius: 15px;
-moz-box-shadow: 0px 0px 7px #000000;
-webkit-box-shadow: 0px 0px 7px #000000;
box-shadow: 0px 0px 7px #000000;
width:1050px; height:860px;
}

.usuario {
	font-family: Calibri;
	font-size: 12px;
	color:#ffffff;
	text-decoration:none;
}
div.fndmenu{ width:950px; height:31px;
background-color: #D4D1C0;"
border: 1px solid ##D4D1C0;  

-moz-border-radius: 8px;
-webkit-border-radius: 8px;
border-radius: 8px;
-moz-box-shadow: 0px 0px 7px #000000;
-webkit-box-shadow: 0px 0px 7px #000000;
box-shadow: 0px 0px 7px #000000;}

a.menu2:link {
	font-family: Verdana;
	font-size: 12px;
	color:#333333;
	text-decoration:none;
}
a.menu2:hover {
	font-family: Verdana;
	font-size: 12px;
	color:#003366;
	text-decoration:underline;
}
a.menu2:visited {
	font-family: Verdana;
	font-size: 12px;
	color:#333333;
	text-decoration:none;
}
.Estilo3 {font-size: 12px}
div.fndmenu1 {width:950px; height:31px;
background-color: #D4D1C0;"
border: 1px solid ##D4D1C0;  

-moz-border-radius: 8px;
-webkit-border-radius: 8px;
border-radius: 8px;
-moz-box-shadow: 0px 0px 7px #000000;
-webkit-box-shadow: 0px 0px 7px #000000;
box-shadow: 0px 0px 7px #000000;}
-->
</style>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script type="text/javascript">
        $(function() {
          if ($.browser.msie && $.browser.version.substr(0,1)<7)
          {
			$('li').has('ul').mouseover(function(){
				$(this).children('ul').show();
				}).mouseout(function(){
				$(this).children('ul').hide();
				})
          }
        });        
    </script>
	
<style>
/* Main menu */

#menu
{
	width: 950px;
	margin: 0;
	padding: 10px 0 0 0;
	list-style: none;  
	background: #111;
	background: -moz-linear-gradient(#444, #111); 
    background: -webkit-gradient(linear,left bottom,left top,color-stop(0, #111),color-stop(1, #444));	
	background: -webkit-linear-gradient(#444, #111);	
	background: -o-linear-gradient(#444, #111);
	background: -ms-linear-gradient(#444, #111);
	background: linear-gradient(#444, #111);
	-moz-border-radius: 50px;
	border-radius: 50px;
	-moz-box-shadow: 0 2px 1px #9c9c9c;
	-webkit-box-shadow: 0 2px 1px #9c9c9c;
	box-shadow: 0 2px 1px #9c9c9c;
}

#menu li
{
	float: left;
	padding: 0 0 10px 0;
	position: relative;
	line-height: 0;
}

#menu a 
{
	float: left;
	height: 25px;
	padding: 0 25px;
	color: #999;
	text-transform: uppercase;
	font: bold 12px/25px Arial, Helvetica;
	text-decoration: none;
	text-shadow: 0 1px 0 #000;
}

#menu li:hover > a
{
	color: #fafafa;
}

*html #menu li a:hover /* IE6 */
{
	color: #fafafa;
}

#menu li:hover > ul
{
	display: block;
}

/* Sub-menu */

#menu ul
{
    list-style: none;
    margin: 0;
    padding: 0;    
    display: none;
    position: absolute;
    top: 35px;
    left: 0;
    z-index: 99999;    
    background: #444;
    background: -moz-linear-gradient(#444, #111);
    background: -webkit-gradient(linear,left bottom,left top,color-stop(0, #111),color-stop(1, #444));
    background: -webkit-linear-gradient(#444, #111);    
    background: -o-linear-gradient(#444, #111);	
    background: -ms-linear-gradient(#444, #111);	
    background: linear-gradient(#444, #111);
    -moz-box-shadow: 0 0 2px rgba(255,255,255,.5);
    -webkit-box-shadow: 0 0 2px rgba(255,255,255,.5);
    box-shadow: 0 0 2px rgba(255,255,255,.5);	
    -moz-border-radius: 5px;
    border-radius: 5px;
}

#menu ul ul
{
  top: 0;
  left: 190px;
}

#menu ul li
{
    float: none;
    margin: 0;
    padding: 0;
    display: block;  
    -moz-box-shadow: 0 1px 0 #111111, 0 2px 0 #777777;
    -webkit-box-shadow: 0 1px 0 #111111, 0 2px 0 #777777;
    box-shadow: 0 1px 0 #111111, 0 2px 0 #777777;
}

#menu ul li:last-child
{   
    -moz-box-shadow: none;
    -webkit-box-shadow: none;
    box-shadow: none;    
}

#menu ul a
{    
    padding: 10px;
	height: 10px;
	width: 220px;
	height: auto;
    line-height: 1;
    display: block;
    white-space: nowrap;
    float: none;
	text-transform: none;
}

*html #menu ul a /* IE6 */
{    
	height: 10px;
}

*:first-child+html #menu ul a /* IE7 */
{    
	height: 10px;
}

#menu ul a:hover
{
    background: #0186ba;
	background: -moz-linear-gradient(#04acec,  #0186ba);	
	background: -webkit-gradient(linear, left top, left bottom, from(#04acec), to(#0186ba));
	background: -webkit-linear-gradient(#04acec,  #0186ba);
	background: -o-linear-gradient(#04acec,  #0186ba);
	background: -ms-linear-gradient(#04acec,  #0186ba);
	background: linear-gradient(#04acec,  #0186ba);
}

#menu ul li:first-child > a
{
    -moz-border-radius: 5px 5px 0 0;
    border-radius: 5px 5px 0 0;
}

#menu ul li:first-child > a:after
{
    content: '';
    position: absolute;
    left: 30px;
    top: -8px;
    width: 0;
    height: 0;
    border-left: 5px solid transparent;
    border-right: 5px solid transparent;
    border-bottom: 8px solid #444;
}

#menu ul ul li:first-child a:after
{
    left: -8px;
    top: 12px;
    width: 0;
    height: 0;
    border-left: 0;	
    border-bottom: 5px solid transparent;
    border-top: 5px solid transparent;
    border-right: 8px solid #444;
}

#menu ul li:first-child a:hover:after
{
    border-bottom-color: #04acec; 
}

#menu ul ul li:first-child a:hover:after
{
    border-right-color: #04acec; 
    border-bottom-color: transparent; 	
}


#menu ul li:last-child > a
{
    -moz-border-radius: 0 0 5px 5px;
    border-radius: 0 0 5px 5px;
}

/* Clear floated elements */
#menu:after 
{
	visibility: hidden;
	display: block;
	font-size: 0;
	content: " ";
	clear: both;
	height: 0;
}

* html #menu             { zoom: 1; } /* IE6 */
*:first-child+html #menu { zoom: 1; } /* IE7 */
</style>

<!-- AdPacks -->
<style>
#adpacks-wrapper{font-family: Arial, Helvetica;width:280px;position: fixed;_position:absolute;bottom: 0;right: 20px;z-index: 9999;background: #eaeaea;padding: 10px;-moz-box-shadow: 0 0 15px #444;-webkit-box-shadow: 0 0 15px #444;box-shadow: 0 0 15px #444;}
body .adpacks{background:#fff;padding:15px;margin:15px 0 0;border:3px solid #eee;}
body .one .bsa_it_ad{background:transparent;border:none;font-family:inherit;padding:0;margin:0;}
body .one .bsa_it_ad .bsa_it_i{display:block;padding:0;float:left;margin:0 10px 0 0;}
body .one .bsa_it_ad .bsa_it_i img{padding:0;border:none;}
body .one .bsa_it_ad .bsa_it_t{padding: 0 0 6px 0; font-size: 11px;}
body .one .bsa_it_p{display:none;}
body #bsap_aplink,body #bsap_aplink:hover{display:block;font-size:9px;margin: -15px 0 0 0;text-align:right;}
body .one .bsa_it_ad .bsa_it_d{font-size: 11px;}
body .one{overflow: hidden}
</style>



</head>

<body>
<table width="950" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <th width="950" align="left" scope="col"><table width="950" height="134" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="134"><img src="imagenes/header.png" width="727" height="133" /></td>
        <td width="4" align="center">&nbsp;</td>
        <td width="217" valign="bottom" background="iconos/menuicon.png"><table width="216" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="182" height="28" align="right"><span class="usuario"><em><?php echo $_SESSION["nom1_usu"]." ".$_SESSION["nom2_usu"]." ".$_SESSION["apepat_usu"]." ".$_SESSION["apemat_usu"];
	   ?></em></span></a></td>
            <td width="34" height="32" align="center"><img src="iconos/usuario.png" width="27" height="27" /></td>
          </tr>
          <tr>
            <td height="28" align="right"><a href="pass.php" class="menu Estilo3" target="principal"><em>Cambiar Contraseña</em></a></td>
            <td height="26" align="center"><img src="iconos/llave.png" width="23" height="23" /></td>
          </tr>
          
          <tr>
            <td height="14" align="right"><a href="salir.php" class="menu"><em>Cerrar Sesión</em></a></td>
            <td height="6" align="center"><img src="iconos/salir.png" width="23" height="23" /></td>
          </tr>
          <tr>
            <td height="14" align="right">&nbsp;</td>
            <td height="5" align="center">&nbsp;</td>
          </tr>
          
        </table></td>
      </tr>
    </table></th>
  </tr>
  <tr>
    <td height="35"><table width="950" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="642" align="left" style="color:#FF9900; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:14px;" scope="col"><span class="style5">Colegio de Notarios de Lima</span></td>
        <td width="308" align="left" style="color:#FF9900; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:14px;" scope="col"><span class="fecha"><?php echo actual_date();  ?></span></td>
      </tr>

    </table></td>
  </tr>
  <tr>
    <td height="35" align="center"><table width="1035" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="1035" height="35" align="center" valign="top">
        <!--*************** INICIO MENU *********************-->
        
        <table width="1029" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="1029" height="35" valign="top">
    <ul id="menu">
       <li><a href="nodisponible.html" target="principal">Protocolares</a>
         <ul>
         <li>
				<a href="nodisponible.html" target="principal">Kardex</a>
				<ul>
                <?php

			 if($row['kardex'] == '1')
                     {
						 
					echo '<li><a href="frmprotocolares.php?te=0" target="principal">Escrituras</a></li>';
					
				     }else{
				echo '<li><a href="nodisponible.html" target="principal">Escrituras</a></li>';
					}
					
			if($row['kardex'] == '1')
                     {
					echo '<li><a href="frmprotocolares.php?te=1" target="principal"> Bcp</a></li>';
					
				     }else{
				echo '<li><a href="nodisponible.html" target="principal"> BCP</a></li>';
					}		
			
			if($row['kardex'] == '1')
                     {
					echo '<li><a href="frmprotocolares.php?te=2" target="principal"> Scotiabank</a></li>';
					
				     }else{
				echo '<li><a href="nodisponible.html" target="principal"> Scotiabank</a></li>';
					}
					if($row['kardex'] == '1')
                     {
					echo '<li><a href="frmprotocolares.php?te=3" target="principal"> Continental </a></li>';
					
				     }else{
				echo '<li><a href="nodisponible.html" target="principal"> Continental </a></li>';
					}	
					if($row['kardex'] == '1')
                     {
					echo '<li><a href="frmprotocolares.php?te=4" target="principal"> Interbank </a></li>';
					
				     }else{
				echo '<li><a href="nodisponible.html" target="principal"> Interbank </a></li>';
					}		
					
					if($row['kardex'] == '1')
                     {
					echo '<li><a href="frmprotocolares.php?te=5" target="principal"> Otros </a></li>';
					
				     }else{
				echo '<li><a href="nodisponible.html" target="principal"> Otros </a></li>';
					}		
					 
				
				?>
				</ul>
			</li>
         
         
         
			<?php 
             if($row['kardex'] == '1')
              {
              //echo '<li><a href="frmprotocolares.php" target="principal">Escrituras</a></li>';
			  echo '<li><a href="frmprotocolares2.php" target="principal">No Contenciosos</a></li>';
			  echo '<li><a href="frmprotocolares3.php" target="principal">Transferencias vehiculares</a></li>';
			  echo '<li><a href="frmprotocolares4.php" target="principal">Garantias Mobiliarias</a></li>';
			  echo '<li><a href="frmprotocolares5.php" target="principal">Testamentos</a></li>';
			  }else{
			//	echo '<li><a href="nodisponible.html" target="principal">Escrituras</a></li>';
				echo '<li><a href="nodisponible.html" target="principal">No Contenciosos</a></li>';
			  echo '<li><a href="nodisponible.html" target="principal">Transferencias vehiculares</a></li>';
			  echo '<li><a href="nodisponible.html" target="principal">Garantias Moviliarias</a></li>';
			  echo '<li><a href="nodisponible.html" target="principal">Testamentos</a></li>';
				}
				
			if($row['protesto'] == '1')
              {
                    echo'<li><a href="protestos.php" target="principal">Protestos</a></li>';
			  }else{
				    echo'<li><a href="nodisponible.html" target="principal">Protestos</a></li>';
				  }
            ?>  
         </ul>
       </li>
	   <li><a href="nodisponible.html" target="principal">Extraprotocolares</a>
		<ul>
        <?php 
		   if($row['pviaje'] == '1')
              {
                    echo'<li><a href="extraprotocolares/view/PViajeVie.php" target="principal">Cert. Autorizacion de Viaje</a></li>';
			  }else{
				    echo'<li><a href="nodisponible.html" target="principal">Cert. Autorizacion de Viaje</a></li>';
				  }
		 
		  if($row['poder'] == '1')
              {
                    echo'<li><a href="extraprotocolares/view/PoderesVie.php" target="principal">Poderes Fuera de Registro</a></li>';
			  }else{
				    echo'<li><a href="nodisponible.html" target="principal">Poderes Fuera de Registro</a></li>';
				  }		  
				  
		  if($row['cartas'] == '1')
              {
                    echo'<li><a href="extraprotocolares/view/CartasVie.php" target="principal">Cartas Notariales</a></li>';
			  }else{
				    echo'<li><a href="nodisponible.html" target="principal">Cartas Notariales</a></li>';
				  }	
				  
		  if($row['libros'] == '1')
              {
                    echo'<li><a href="extraprotocolares/view/libros.php" target="principal">Cert. Apertura de Libros</a></li>';
			  }else{
				    echo'<li><a href="nodisponible.html" target="principal">Cert. Apertura de Libros</a></li>';
				  }
				  
		  if($row['capaz'] == '1')
              {
                    echo'<li><a href="extraprotocolares/view/CertPCapazVie.php" target="principal">Cert. Supervivencia Persona Capaz</a></li>';
			  }else{
				    echo'<li><a href="nodisponible.html" target="principal">Cert. Supervivencia Persona Capaz</a></li>';
				  }
		 
		 if($row['incapaz'] == '1')
              {
                    echo'<li><a href="extraprotocolares/view/CertPIncapazVie.php" target="principal">Cert. Supervivencia Persona Incapaz</a></li>';
			  }else{
				    echo'<li><a href="nodisponible.html" target="principal">Cert. Supervivencia Persona Incapaz</a></li>';
				  }
		 if($row['domiciliario'] == '1')
              {
                    echo'<li><a href="extraprotocolares/view/CDomiciliarioVie.php" target="principal">Certificado Domiciliario</a></li>';
			  }else{
				    echo'<li><a href="nodisponible.html" target="principal">Certificado Domiciliario</a></li>';
				  }
				  
		if($row['caracteristicas'] == '1')
              {
                    echo'<li><a href="extraprotocolares/view/CCaracteristicasVie.php" target="principal">Cambio de Caracteristicas</a></li>';
			  }else{
				    echo'<li><a href="nodisponible.html" target="principal">Cambio de Caracteristicas</a></li>';
				  }
				  
		?>
        
        </ul>
	<li>
    <li>
		<a href="nodisponible.html" target="principal">Reportes</a>
		<ul>
			<li><a href="nodisponible.html" target="principal">Indices Cronologicos</a>
                <ul>
                <?php
					if($row['indicronoep'] == '1')
                     {
					echo'<li><a href="indicecroesrituras.php" target="principal">Escrituras Publicas</a></li>';
				     }else{
					 echo'<li><a href="nodisponible.html" target="principal">Escrituras Publicas</a></li>'; 
					 }
					
					if($row['indicrononc'] == '1')
                     {
					echo'<li><a href="indicecronoconten.php" target="principal">Asuntos No Contenciosos</a></li>';
				     }else{
					 echo'<li><a href="nodisponible.html" target="principal">Asuntos No Contenciosos</a></li>'; 
					 }
					 
					 if($row['indicronotv'] == '1')
                     {
					echo'<li><a href="indicecrovehicular.php" target="principal">Transferencias Vehiculares</a></li>';
				     }else{
					 echo'<li><a href="nodisponible.html" target="principal">Transferencias Vehiculares</a></li>'; 
					 }  
					
					if($row['indicronogm'] == '1')
                     {
					echo'<li><a href="indicecrogarantias.php" target="principal">Garantias Mobiliarias</a></li>';
				     }else{
					 echo'<li><a href="nodisponible.html" target="principal">Garantias Mobiliarias</a></li>'; 
					}
					
					if($row['indicronotest'] == '1')
                     {
					echo'<li><a href="indicecrotestamentos.php" target="principal">Testamentos</a></li>';
				     }else{
					 echo'<li><a href="nodisponible.html" target="principal">Testamentos</a></li>'; 
					}
					
					if($row['indicronoprot'] == '1')
                     {
					echo'<li><a href="indicecronoprote.php" target="principal">Protestos</a></li>';
				     }else{
					 echo'<li><a href="nodisponible.html" target="principal">Protestos</a></li>'; 
					}
					
					if($row['infocamacome'] == '1')
                     {
					echo'<li><a href="indicecronocamara.php" target="principal">Informe a la camara de comercio</a></li>';
				     }else{
					 echo'<li><a href="nodisponible.html" target="principal">Informe a la camara de comercio</a></li>'; 
					}
					
					if($row['indicronocar'] == '1')
                     {
					echo'<li><a href="indicecronocartas.php" target="principal">Cartas Notariales</a></li>';
				     }else{
					 echo'<li><a href="nodisponible.html" target="principal">Cartas Notariales</a></li>'; 
					}
					
					if($row['indicronolib'] == '1')
                     {
					echo'<li><a href="indicecrolibros.php" target="principal">Certificacion de Apertura de Libros</a></li>';
				     }else{
					 echo'<li><a href="nodisponible.html" target="principal">Certificacion de Apertura de Libros</a></li>'; 
					}
                    
                    if($row['indicronovia'] == '1')
                     {
					echo'<li><a href="indicecronoviaje.php" target="principal">Permisos de Viaje al Interior / Exterior</a></li>';
				     }else{
					 echo'<li><a href="nodisponible.html" target="principal">Permisos de Viaje al Interior / Exterior</a></li>'; 
					}
					
					if($row['indicronopod'] == '1')
                     {
					echo'<li><a href="indicecronopoder.php" target="principal">Poderes Fuera de Registro</a></li>';
				     }else{
					 echo'<li><a href="nodisponible.html" target="principal">Poderes Fuera de Registro</a></li>'; 
					}
					
					if($row['indicronocapaz'] == '1')
                     {
					echo'<li><a href="indicecronoCPcapaz.php" target="principal">Cert. Supervivencia Persona Capaz</a></li>';
				     }else{
					 echo'<li><a href="nodisponible.html" target="principal">Cert. Supervivencia Persona Capaz</a></li>'; 
					}
                    
                    if($row['indicronoincapaz'] == '1')
                     {
					echo'<li><a href="indicecronoCPincapaz.php" target="principal">Cert. Supervivencia Persona Incapaz</a></li>';
				     }else{
					 echo'<li><a href="nodisponible.html" target="principal">Cert. Supervivencia Persona Incapaz</a></li>'; 
					}                  
                ?>    
				</ul>
            </li>
			<li>
				<a href="nodisponible.html" target="principal">Indices Alfabeticos</a>
				<ul>
                <?php
					if($row['alfaep'] == '1')
                     {
					echo'<li><a href="indicecroesriturasalfa.php" target="principal">Escrituras Publicas</a></li>';
				     }else{
					 echo'<li><a href="nodisponible.html" target="principal">Escrituras Publicas</a></li>'; 
					}
					
					if($row['alfagm'] == '1')
                     {
					echo'<li><a href="indicecrogarantiasalfa.php" target="principal">Garantias Mobiliarias</a></li>';
				     }else{
					 echo'<li><a href="nodisponible.html" target="principal">Garantias Mobiliarias</a></li>'; 
					}
					
					if($row['alfanc'] == '1')
                     {
					echo'<li><a href="indicecronocontenalfa.php" target="principal">Asuntos No Contenciosos</a></li>';
				     }else{
					 echo'<li><a href="nodisponible.html" target="principal">Asuntos No Contenciosos</a></li>'; 
					}
					
					if($row['alfatv'] == '1')
                     {
					echo'<li><a href="indicecrovehicularalfa.php" target="principal">Transferencias Vehiculares</a></li>';
				     }else{
					 echo'<li><a href="nodisponible.html" target="principal">Transferencias Vehiculares</a></li>'; 
					}
					
					if($row['alfatesta'] == '1')
                     {
					echo'<li><a href="indicecrotestamentosalfa.php" target="principal">Testamentos</a></li>';
				     }else{
					 echo'<li><a href="nodisponible.html" target="principal">Testamentos</a></li>'; 
					}
				?>
				</ul>
			</li>
			<li>
				<a href="nodisponible.html" target="principal">Archivos PDT Notaria</a>
				<ul> 
                <?php
					if($row['pdtep'] == '1')
                     {
					echo'<li><a href="exportarpdtescrituras.php" target="principal">Archivos PDT Escrituras</a></li>';
				     }else{
					 echo'<li><a href="nodisponible.html" target="principal">Archivos PDT Escrituras</a></li>'; 
					}
					
					if($row['pdtgm'] == '1')
                     {
					echo'<li><a href="exportarpdtgarantias.php" target="principal">Archivos PDT Garantias</a></li>';
				     }else{
					 echo'<li><a href="nodisponible.html" target="principal">Archivos PDT Garantias</a></li>'; 
					}
					
					if($row['pdtveh'] == '1')
                     {
					echo'<li><a href="exportarpdtvehicular1.php" target="principal">Archivos PDT Vehiculares</a></li>';
				     }else{
					 echo'<li><a href="nodisponible.html" target="principal">Archivos PDT Vehiculares</a></li>'; 
					}
					
					if($row['pdtlib'] == '1')
                     {
					echo'<li><a href="exportarpdtlibros.php" target="principal">Archivo PDT Libros</a></li>';
				     }else{
					 echo'<li><a href="nodisponible.html" target="principal">Archivo PDT Libros</a></li>'; 
					}
					
                    
				?>
				 </ul>	
                    </li>
                    <?php
					if($row['ro'] == '1')
                     {
					echo'<li><a href="mantenimiento/view/Registrouif.php" target="principal">Registro de Operaciones UIF</a></li>';
				     }else{
					 echo'<li><a href="nodisponible.html" target="principal">Registro de Operaciones UIF</a></li>'; 
					}
                    if($row['reportuif'] == '1')
                     {
					echo'<li><a href="reportes/IAOC_Report.php" target="principal">Reporte UIF- IAOC</a></li>';
				     }else{
					 echo'<li><a href="nodisponible.html" target="principal">Reporte UIF- IAOC</a></li>'; 
					}
                    if($row['reportpendfirma'] == '1')
                     {
					echo'<li><a href="reportes/PendFirma_Report.php" target="principal">Report.Pend.Conclusion Firma</a></li>';
				     }else{
					 echo'<li><a href="nodisponible.html" target="principal">Report.Pend.Conclusion Firma</a></li>'; 
					}
                    
                    ?>
                    </ul>
                </li>
	<li>
		<a href="nodisponible.html" target="principal">Caja</a>
				<ul>
                
                <li>
				<a href="nodisponible.html" target="principal">Egresos</a>
				<ul>
                <?php

			 if($row['egreso'] == '1')
                     {
					echo'<li><a href="facturacion/view/Egresos.php" target="principal">Generar Egresos</a></li>';
				     }else{
					 echo'<li><a href="nodisponible.html" target="principal">Generar Egresos</a></li>'; 
					}
					if($row['egreso'] == '1')
                     {
					echo'<li><a href="facturacion/view/anula_egreso.php" target="principal">Edición de Egresos</a></li>';
				     }else{
					 echo'<li><a href="nodisponible.html" target="principal">Edición de Egresos</a></li>'; 
					}
					
					if($row['egreso'] == '1')
                     {
					echo'<li><a href="facturacion/view/comprob_Rpt_egresos.php" target="principal">Reporte de Egresos</a></li>';
				     }else{
					 echo'<li><a href="nodisponible.html" target="principal">Reporte de Egresos</a></li>'; }
					 
				
				?>
				</ul>
			</li>
                
                
                <?php
				    if($row['emicompro'] == '1')
                     {
					echo'<li><a href="facturacion/view/ComprobantesVie.php" target="principal">Emision de Comprobantes</a></li>';
				     }else{
					 echo'<li><a href="nodisponible.html" target="principal">Emision de Comprobantes</a></li>'; 
					}
					if($row['anucompro'] == '1')
                     {
					echo'<li><a href="facturacion/view/AnulPagosVie.php" target="principal">Edición de Comprobantes</a></li>';
				     }else{
					 echo'<li><a href="nodisponible.html" target="principal">Edición de Comprobantes</a></li>'; 
					}
					if($row['cancelcompro'] == '1')
                     {
					echo'<li><a href="facturacion/view/CancDocsVie.php" target="principal">Cancelacion de Comprobantes</a></li>';
				     }else{
					 echo'<li><a href="nodisponible.html" target="principal">Cancelacion de Comprobantes</a></li>'; 
					}
					if($row['reportcomproemi'] == '1')
                     {
					echo'<li><a href="facturacion/view/Comprob_Rpt.php" target="principal">Reporte de Comprobantes emitidos</a></li>';
				     }else{
					 echo'<li><a href="nodisponible.html" target="principal">Reporte de Comprobantes emitidos</a></li>'; }
					 
					?>
					               
                    
                    
                    
                    
				    
					  <ul>
                      <?php
					     if($row['pendpago'] == '1')
							 {
							echo'<li><a href="facturacion/view/Comprob_Rpt_Pend.php" target="principal">Pendientes de Pago</a></li>';
							 }else{
							 echo'<li><a href="nodisponible.html" target="principal">Pendientes de Pago</a></li>'; 
							}	
						if($row['cancelados'] == '1')
							 {
							echo'<li><a href="facturacion/view/Comprob_Rpt_Canc.php" target="principal">Cancelados</a></li>';
							 }else{
							 echo'<li><a href="nodisponible.html" target="principal">Cancelados</a></li>'; 
							}
						
						
						?>
					 </ul>
					
					</li>
				</ul>
	</li>
    <li>
			<a href="nodisponible.html" target="principal">Usuarios</a>
					 <ul>
                     <?php
					   if($row['manteusu'] == '1')
							 {
							echo'<li><a href="new_usuarios.php" target="principal">Mantenimiento</a></li>';
							 }else{
							 echo'<li><a href="nodisponible.html" target="principal">Mantenimiento</a></li>'; 
							}
					 
						if($row['permiusu'] == '1')
							 {
							echo'<li><a href="mantenimiento/view/PermiUsuarios.php" target="principal">Permisos</a></li>';
							 }else{
							 echo'<li><a href="nodisponible.html" target="principal">Permisos</a></li>'; 
							}
						?>
					</ul>
	 </li>
     <li>
		<a href="nodisponible.html" target="principal">Herramientas</a>
					<ul>
                    <?php
					     if($row['tipoacto'] == '1')
							 {
							echo'<li><a href="mantenimiento/view/tipoactovie.php" target="principal">Tipos de Acto</a></li>';
							 }else{
							 echo'<li><a href="nodisponible.html" target="principal">Tipos de Acto</a></li>'; 
						 }
						 if($row['mant_abogado'] == '1')
							 {
							echo'<li><a href="mantenimiento/view/mant_abogado.php" target="principal">Mantenimiento de Abogados</a></li>';
							 }else{
							 echo'<li><a href="nodisponible.html" target="principal">Mantenimiento de Abogados</a></li>'; 
						 }
						 if($row['mantecondi'] == '1')
							 {
							echo'<li><a href="mantenimiento/view/ActoConVie.php" target="principal">Mantenimientos de Condiciones</a></li>';
							 }else{
							 echo'<li><a href="nodisponible.html" target="principal">>Mantenimientos de Condiciones</a></li>'; 
						 }
						if($row['manteclie'] == '1')
							 {
							echo'<li><a href="mantenimiento/view/clientVie.php" target="principal">Mantenimiento de Clientes</a></li>';
							 }else{
							 echo'<li><a href="nodisponible.html" target="principal">Mantenimiento de Clientes</a></li>'; 
						 }
						if($row['manteimpe'] == '1')
							 {
							echo'<li><a href="mantenimiento/view/ImpedidosVie.php" target="principal">Mantenimiento de Impedidos</a></li>';
							 }else{
							 echo'<li><a href="nodisponible.html" target="principal">Mantenimiento de Impedidos</a></li>'; 
						 }
						if($row['sellocartas'] == '1')
							 {
							echo'<li><a href="mantenimiento/view/tipoSellos.php" target="principal">Mantenimiento Sellos de Cartas</a></li>';
							 }else{
							 echo'<li><a href="nodisponible.html" target="principal">Mantenimiento Sellos de Cartas</a></li>'; 
						 }
						if($row['helpprot'] == '1')
							 {
							echo'<li><a href="mantenimiento/view/tipoProtestos.php" target="principal">Mantenimiento Ayuda de Protestos</a></li>';
							 }else{
							 echo'<li><a href="nodisponible.html" target="principal">Mantenimiento Ayuda de Protestos</a></li>'; 
						 }
						if($row['contpod'] == '1')
							 {
							echo'<li><a href="mantenimiento/view/PoderesConte.php" target="principal">Mant.de Contenido Poderes</a></li>';
							 }else{
							 echo'<li><a href="nodisponible.html" target="principal">Mant.de Contenido Poderes</a></li>'; 
						 }
						if($row['manteservi'] == '1')
							 {
							echo'<li><a href="mantenimiento/view/contServicios.php" target="principal">Mantenimiento de Servicios</a></li>';
							 }else{
							 echo'<li><a href="nodisponible.html" target="principal">Mantenimiento de Servicios</a></li>'; 
						 }
						
						if($row['asignaregis'] == '1')
							 {
							echo'<li><a href="mantenimiento/view/AsignaKardex.php" target="principal">Asignacion de Kardex</a></li>
						<li><a href="mantenimiento/view/AsignaViaje.php" target="principal">Asignacion de Viajes</a></li>
						<li><a href="mantenimiento/view/AsignaPoderes.php" target="principal">Asignacion de Poderes</a></li>
						<li><a href="mantenimiento/view/AsignaCartas.php" target="principal">Asignacion de Cartas Notariales</a></li>
						<li><a href="mantenimiento/view/AsignaLibros.php" target="principal">Asignacion de Libros</a></li>
						<li><a href="mantenimiento/view/AsignaPCapaz.php" target="principal">Asignacion de Certif. de Supervivencia</a></li>
						<li><a href="mantenimiento/view/AsignaDomiciliario.php" target="principal">Asignacion de Certificado Domiciliario</a></li>
						<li><a href="mantenimiento/view/AsignaCaracteristicas.php" target="principal">Asignacion de Cambio de Caracterist.</a></li>';
							 }else{
							 echo'<li><a href="nodisponible.html" target="principal">Asignacion de Kardex</a></li>
						<li><a href="nodisponible.html" target="principal">Asignacion de Viajes</a></li>
						<li><a href="nodisponible.html" target="principal">Asignacion de Poderes</a></li>
						<li><a href="nodisponible.html" target="principal">Asignacion de Cartas Notariales</a></li>
						<li><a href="nodisponible.html" target="principal">Asignacion de Libros</a></li>
						<li><a href="nodisponible.html" target="principal">Asignacion de Certif. de Supervivencia</a></li>
						<li><a href="nodisponible.html" target="principal">Asignacion de Certificado Domiciliario</a></li>
						<li><a href="nodisponible.html" target="principal">Asignacion de Cambio de Caracterist.</a></li>'; 
						 }
						if($row['tipo_cambio'] == '1')
							 {
							echo'<li><a href="mantenimiento/view/Tipo_cambio.php" target="principal">Tipo de Cambio</a></li>';
							 }else{
							 echo'<li><a href="nodisponible.html" target="principal">Tipo de Cambio</a></li>'; 
						 }
						
						if($row['seriescaja'] == '1')
							 {
							echo'<li><a href="facturacion/view/Serie_ini.php" target="principal">Series Iniciales</a></li>';
							 }else{
							 echo'<li><a href="nodisponible.html" target="principal">Series Iniciales</a></li>'; 
						 }
						
						
						?>
					</ul>
	</li>  
     <li>
		<a href="nodisponible.html" target="principal">Configuracion</a>
				<ul>
                <?php
				    if($row['datonot'] == '1')
							 {
							echo'<li><a href="confinotaria.php" target="principal">Datos del Notario</a></li>';
							 }else{
							 echo'<li><a href="nodisponible.html" target="principal">Datos del Notario</a></li>'; 
					}
					 if($row['editdatonot'] == '1')
							 {
							echo'<li><a href="editarconfinotaria.php" target="principal">Edicion de Datos</a></li>';
							 }else{
							 echo'<li><a href="nodisponible.html" target="principal">Edicion de Datos</a></li>'; 
					}
					 if($row['regserver'] == '1')
							 {
							echo'<li><a href="registroservidor.php" target="principal">Registrar Servidor</a></li>';
							 }else{
							 echo'<li><a href="nodisponible.html" target="principal">Registrar Servidor</a></li>'; 
					}
					 if($row['editserver'] == '1')
							 {
							echo'<li><a href="editarservidor.php" target="principal">Editar Servidor</a></li>';
							 }else{
							 echo'<li><a href="nodisponible.html" target="principal">Editar Servido</a></li>'; 
					}
					if($row['editserver'] == '1')
							 {
							echo'<li><a href="backup_fusion.php" target="principal">Backup Servidor</a></li>';
							 }else{
							 echo'<li><a href="backup_fusion.php" target="principal">Backup Servido</a></li>'; 
					}
					
				/*	if($row['editserver'] == '1')
							 {
							echo'<li><a href="restore.php" target="principal">Restaurar Servidor</a></li>';
							 }else{
							 echo'<li><a href="restore.php" target="principal">Restaurar Servido</a></li>'; 
					}*/
					
					?>
				</ul>
	</li>
</ul>
</td>
  </tr>
</table>
        <!-- *************** FIN MENU   ******************** -->
        
        </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td><iframe name="principal" id="principal" frameborder="0"  allowtransparency="true" width="1024" height="900"></iframe>      </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>


</body>
</html>
