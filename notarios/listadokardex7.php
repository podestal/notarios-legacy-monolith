<?php 
include("conexion.php");


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script language="JavaScript" type="text/javascript" src="ajax.js?j=6"></script>


<link rel="stylesheet" type="text/css" href="tcal.css" />
<script type="text/javascript" src="tcal.js"></script> 
<script type="text/javascript" charset="utf-8">
      
</script><script language="JavaScript" type="text/javascript" src="ajax/protocolares/kardex.js" ></script>

<title>Untitled Document</title>
<style type="text/css">
<!--
.titubuskar {
	font-family: Calibri;
	font-size: 12px;
	font-weight: bold;
	
	color: #003366;
}
.titubuskarrct {font-family: Verdana; font-size: 10px;  font-weight: bold; color: #FFF; }
.titubuskar0 {font-family: Verdana; font-size: 11px; color: #333333; }
.titubuskar1 {color: #333333}
.reskar2 {font-family: Verdana; font-size: 12px; font-weight: bold; color: #003366; }
.reskar {font-size: 12px;  color: #333333; font-family: Calibri;}
.titubuskar01 {font-family: Calibri; font-size: 12px;  color: #333333; }
.lineass {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 36px;
	color: #999;
}
.combo{
border:solid 1px #069; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#036; text-transform:uppercase;	
}
-->
</style>
<style type="text/css">
<!--
.titubuskar {
	font-family: Calibri;
	font-size: 12px;
	font-weight: bold;
	
	color: #003366;
}
.titubuskar0 {font-family: Verdana; font-size: 10px;  font-weight: bold; color: #000; }

.titubuskarrct {font-family: Verdana; font-size: 10px;  font-weight: bold; color: #FFF; }
.titubuskar1 {color: #000}
.reskar2 {font-family: Verdana; font-size: 10px; font-weight: bold;  color: #003366; }
.reskar {font-size: 10px;  color: #333333; font-family: Verdana;}
.buttonlibro{font-family:Verdana; font-size:12px;  height:26px; background-color:#315A82; border:none; border-radius:1px; color:#fff;}

body {
	background-color: #FFF;
}
-->
</style>
<script type="text/javascript">
<!--$(document).ready(function(){ -->

<!--cargakardex(0)-->
<!--});-->

function inconcluso(isChecked){
		//esta funcion chequea si el check esta chekqueado
	if(isChecked){

		document.getElementById('rangof1').value='';
		document.getElementById('rangof2').value='';	
		document.getElementById('radio7').value='';
		document.getElementById('inconcluso').value='1';
		document.getElementById('concluso').value='0';
		document.getElementById('concluso').checked='';
		
	}else{
		
		document.getElementById('inconcluso').value='0';
		
	}
		
}

function concluso(isChecked){
		//esta funcion chequea si el check esta chekqueado
	if(isChecked){
		document.getElementById('concluso').value='1';
		document.getElementById('inconcluso').value='0';
		document.getElementById('inconcluso').checked='';	
		document.getElementById('noescriturado').value='0';
		document.getElementById('noescriturado').checked='';
		document.getElementById('escriturado').value='0';
		document.getElementById('escriturado').checked='';	
	}else{
		document.getElementById('concluso').value='0';
	}		
}

function noescriturado(isChecked){
		//esta funcion chequea si el check esta chekqueado
	if(isChecked){
		document.getElementById('noescriturado').value='1';
		document.getElementById('escriturado').value='0';	
		document.getElementById('escriturado').checked='';	
		document.getElementById('concluso').value='0';
		document.getElementById('concluso').checked='';		
	}else{
		document.getElementById('noescriturado').value='0';
	}		
}

function escriturado(isChecked){
 	
}

function pagado(isChecked){
		//esta funcion chequea si el check esta chekqueado
	if(isChecked){
		document.getElementById('pagado').value='1';
		document.getElementById('nopagado').value='0';	
		document.getElementById('nopagado').checked='';		
	}else{
		document.getElementById('pagado').value='0';
	}		
}

function nopagado(isChecked){
		//esta funcion chequea si el check esta chekqueado
	if(isChecked){
		document.getElementById('nopagado').value='1';
		document.getElementById('pagado').value='0';	
		document.getElementById('pagado').checked='';	
		document.getElementById('saldo').value='0';	
		document.getElementById('saldo').checked='';		
	}else{
		document.getElementById('nopagado').value='0';
	}		
}

function saldo(isChecked){
		//esta funcion chequea si el check esta chekqueado
	if(isChecked){
		document.getElementById('saldo').value='1';
		document.getElementById('nopagado').value='0';	
		document.getElementById('nopagado').checked='';		
	}else{
		document.getElementById('saldo').value='0';
	}		
}

function estado(valor){
document.getElementById('opcionradio').value=valor;

}

function nopresentado(isChecked){
	if(isChecked){
		document.getElementById('nopresentado').value='1';
	}else{
		document.getElementById('nopresentado').value='0';
	}


}

function retenido(isChecked){
	if(isChecked){
		document.getElementById('retenido').value='1';
	}else{
		document.getElementById('retenido').value='0';
	}


}

function desistido(isChecked){
	if(isChecked){
		document.getElementById('desistido').value='1';
	}else{
		document.getElementById('desistido').value='0';
	}
} 
function cargakardexava2(pag)
{
	buscarkardexavanzada3(pag); 
}

function cargakardexava2e(){
	
	document.formu.submit();	
}
function send(e){ 
	   
	tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==13)
	{
		buscarkardexavanzada3(1);
	} 
} 
</script>
</head>

<body >
<form method="post" id="formu" name="formu" action="excel/reportAvanzada.php">
<table width="100%;">
<tr>
	<td width="100%">
    <table width="100%">
    	<tr>
        	<td width="8%" align="left">
            	<span class="titubuskar0">TIPO KARDEX</span>
            </td>
        	<td width="14%" align="center">
            	<select name="idtipkar" id="idtipkar" class="combo" style="width:102%;">
            		<option value="" selected="selected">SELECCIONE KARDEX</option>
					<?php
                  	$sql = mysql_query("SELECT * FROM tipokar",$conn) or die(mysql_error());
                  	while($row=mysql_fetch_array($sql)){
                 		echo "<option value = ".$row["idtipkar"].">".nl2br($row["nomtipkar"])."</option>";  		  
				  	}
                ?>
                </select>
            </td>
        	<td width="8%" align="center">
            	<span class="titubuskar0">KARDEX</span>
            </td>
        	<td width="10%" align="center">
            	<input type="text" style="width:100%;" onKeyPress="send(event);" name="codkardex" id="codkardex" value="" />
            </td>
        	<td width="8%" align="center">
            	<span class="titubuskar0">CONTRATO</span>
            </td>
        	<td width="14%" align="center">
            	<select name="idtipoacto" id="idtipoacto" style="border:solid 1px #069; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#036; text-transform:uppercase; width:102%;">
                    <option value="" selected="selected">SELECCIONE CONTRATO</option>
                    <?php
                  	$sql = mysql_query("SELECT * FROM tiposdeacto order by desacto asc",$conn) or die(mysql_error());
                  
                 	while($row=mysql_fetch_array($sql)){
                      
						if($row["idtipkar"]==1){			  
						  $val=" (E.P)";
						}else if($row["idtipkar"]==2){
						  $val=" (NC)";
						}else if($row["idtipkar"]==3){
						  $val=" (T.V)";
						}else if($row["idtipkar"]==4){
						  $val=" (G.M)";
						}else if($row["idtipkar"]==5){
						  $val=" (TEST.)";
						}
                  
                  	echo "<option value = ".$row["idtipoacto"].">".($row["desacto"]).$val."</option>";  
                 	}
                ?>        
         		</select>
            </td>
        	<td width="8%" align="center">
            	<span class="titubuskar0">RESPONSABLE</span>
            </td>
        	<td width="16%" align="center">
            
			<select name="responsable" id="responsable" class="combo" style="width:102%;">
        			<option value="" selected="selected">SELECCIONE USUARIO</option>
          			<?php
		  			$sql2 = mysql_query("
                            SELECT 
                                                          u.idusuario AS iduser,
                                                          TRIM(
                                                            CONCAT(
                                                              IFNULL(u.`apepat`, ''),
                                                              ' ',
                                                              IFNULL(u.`apemat`, ''),
                                                              ' ',
                                                              IFNULL(u.`prinom`, ''),
                                                              ' ',
                                                              IFNULL(u.`segnom`, '')
                                                            )
                                                          ) AS usuario 
                                                        FROM
                                                          usuarios u 
                                                          INNER JOIN permisos_usuarios p 
                                                            ON u.`idusuario` = p.`idusuario` 
                                                        WHERE  TRIM(
                                                            CONCAT(
                                                              IFNULL(u.`apepat`, ''),
                                                              ' ',
                                                              IFNULL(u.`apemat`, ''),
                                                              ' ',
                                                              IFNULL(u.`prinom`, ''),
                                                              ' ',
                                                              IFNULL(u.`segnom`, '')
                                                            )
                                                          ) != '' 
                                                               AND p.userresponsable='1'  

                                                        GROUP BY u.`idusuario` 
                                                        ORDER BY usuario ASC

                        ",$conn) or die(mysql_error());
		  			while($row2=mysql_fetch_array($sql2)){
		  				echo "<option  value = ".$row2["iduser"].">".$row2["usuario"]."</option>";  
		  			}
					?>
        		</select>


            </td>
        	<td width="7%" align="right">
            	<a id="boton" onclick="cargakardexava2(1);" style="cursor:pointer;"><img src="iconos/buscarclie.png" width="72" height="26" border="0" /></a>
            </td>
        	<td width="7%" align="right" style="display: none;">
            	<a id="boton" onclick="cargakardexava2e();" style="cursor:pointer;"><img src="iconos/exportar.png" width="72" height="26" border="0" /></a>
	
            </td>
        </tr>
     
        <tr>        	
        	<td align="left">
            	<span class="titubuskar0">D.N.I / R.U.C</span>
            </td>
            <td align="center">
            	<input id="numdoc" name="numdoc" style="text-transform:uppercase; width:100%; border:solid 1px #069; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#036" type="text"  maxlength="200" onKeyPress="send(event);" onclick="limpiarkardex();"  />
            </td>
            <td align="center">
            	<span class="titubuskar0">CLIENTE</span>
            </td>
            <td colspan="3" align="center">
            	<input id="nombre" name="nombre" style="text-transform:uppercase; width:100%; border:solid 1px #069; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#036" type="text"  maxlength="200"onKeyPress="send(event);" onclick="limpiarkardex();"  />
            </td>
        	<td align="right" colspan="4">
            
            	<select name="radio7" id="radio7" style="border:solid 1px #069; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#036; text-transform:uppercase; width:36%;">
                 	<option value="" selected="selected">RANGO DE FECHA</option>
                    <option value="1" selected="true">Fec. Ingreso</option>
                    <option value="2" >Fec. Escritura</option>
                    <option value="3">Fec. Conclusion</option>
                </select>
                &nbsp;&nbsp;&nbsp;
            	<span id="desde" class="titubuskar0">desde </span>&nbsp;
         		<input name="rangof1" type="text" id="rangof1" class="tcal" style="border:solid 1px #069; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#036; text-transform:uppercase;width:70px;" autocomplete="off" value="01/01/2019"  />
         		&nbsp;

            <?php
              $hoy = getdate();
             
              $dia=$hoy["mday"]."/".$hoy["mon"]."/".$hoy["year"];
              
             ?>

         		<span id="hasta" class="titubuskar0">hasta</span>&nbsp;
         		<input name="rangof2" type="text" id="rangof2" class="tcal" style="border:solid 1px #069; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#036; text-transform:uppercase;width:70px;"  autocomplete="off" value="<?php echo $dia?>"/>
            </td>
        </tr>
        
        <tr>
        	<td align="left">
            	<span class="titubuskar0">ESTUDIO</span>
            </td> 
        	<td align="center">
            	<select name="estudio" id="estudio" style="border:solid 1px #069; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#036; text-transform:uppercase; width:102%;">
                <option value="" selected="selected">SELECCIONE ESTUDIO</option>
                <?php
                $sql6 = mysql_query("SELECT * FROM estudioabogado",$conn) or die(mysql_error());
                while($row6=mysql_fetch_array($sql6)){
                	echo "<option  value = ".$row6["idest"].">".$row6["nombre"]."</option>";  
				}
                ?>
                </select>
            </td> 
        	   <td align="center">
            	<span class="titubuskar0">RR.PP</span>
            </td> 
            <td align="center">
              <select name="est_rrpp" id="est_rrpp" style="border:solid 1px #069; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#036; text-transform:uppercase; width:102%;">
                <option value="" selected="selected">ESTADO</option>
                <?php
                $sql5 = mysql_query("SELECT * FROM estadoregistral",$conn) or die(mysql_error());
                while($row5=mysql_fetch_array($sql5)){
                  echo "<option  value = ".$row5[0].">".$row5[1]."</option>";  
                }
                ?>
                </select>
            </td>
           
           <td></td>
           
           <td></td>

            <td align="center">
              
            </td> 
            <td>
              
            </td>

            <td align="center">
              <span class="titubuskar0">EMPRESA CONSTRUCTORA</span>
            </td> 
            <td>
              <input type="text" style="text-transform: uppercase;" id="empresacons" name="empresacons">
            </td>
          </tr>
        	
          <tr>
           
            <td align="center" colspan="2">
            	
         		<input type="checkbox" value="0" name="nopresentado" id="nopresentado" onclick="nopresentado(this.checked);" />&nbsp;
                <span class="titubuskar0">SIN PRESENTAR A RR.PP</span>
            </td>            
            <td align="center">
            	
         		<input type="checkbox" value="0" name="pagado" id="pagado" onclick="pagado(this.checked);" />&nbsp;
                <span class="titubuskar0">CON PAGOS</span>
            </td>
            <td align="center">
            	
         		<input type="checkbox" value="0" name="nopagado" id="nopagado" onclick="nopagado(this.checked);" />&nbsp;
                <span class="titubuskar0">SIN PAGOS</span>
            </td>
            <td align="right" colspan="2">
            	
        		<input type="checkbox" value="0" name="saldo" id="saldo" onclick="saldo(this.checked);" />&nbsp;
                <span class="titubuskar0">CON SALDOS PENDIENTES</span>
            </td>
        </tr>
        
        <tr>
        	<td align="left">            
        		<input type="checkbox"  value="0" name="retenido" id="retenido"  onclick="retenido(this.checked);"/>&nbsp;
        		<span class="titubuskar0">RETENIDO</span>
            </td>
        	<td align="center">            	
        		<input type="checkbox" value="0" name="desistido" id="desistido" onclick="desistido(this.checked);" />&nbsp;
                <span class="titubuskar0">DESISTIDO</span>
            </td>
        	<td align="center" colspan="2">            	
         		<input type="checkbox"  name="escriturado" id="escriturado"  onchange="escriturado(this)" />
        		<span class="titubuskar0">ESCRITURADOS</span>
            </td>
        	<td align="center" colspan="2"> 
         		<input type="checkbox" value="0" name="noescriturado" id="noescriturado" onclick="noescriturado(this.checked);" />&nbsp;
                <span class="titubuskar0">NO ESCRITURADOS</span>
            </td>
        	<td align="center" colspan="2"> 
         		<input type="checkbox" value="0" name="cocluso" id="concluso" onclick="concluso(this.checked);" />&nbsp;
                <span class="titubuskar0">CONCLUIDOS</span>
            </td>        	
        	
        	<td align="left" colspan="2">            	
         		<input type="checkbox" value="0" name="incocluso" id="inconcluso" onclick="inconcluso(this.checked);" />&nbsp;
                <span class="titubuskar0">NO CONCLUIDOS</span>
            </td>
        </tr>
        
    </table>
    
</td>

</tr>
</table>
</form>

<div id="gennn" style="width:100%; height:1100px; overflow:auto;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td><div id="bkardex"></div></td>
    </tr>
  </table>
</div>

</body>
</html>



