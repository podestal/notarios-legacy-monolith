<style type="text/css">
.Estilo31 {font-family: Calibri; font-size: 13px; font-style: italic; }
</style>

<?php
include('conexion.php');
//$contratante=$_POST['contrataxxx'];

$contratante=$_POST['contrata'];
$sql=mysql_query("select * from renta where idcontratante='$contratante'",$conn);
$resul=mysql_fetch_array($sql);

if(!empty($resul)){
	
	echo'<table width="697" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="24" colspan="3"><span class="Estilo31">Presentó Comunicación con Cáracter de DECLARACIÓN JURADA indicando:
      <label>
        <input name="pregu1" value="'.$resul['pregu1'].'" type="hidden" id="pregu1" size="5" />
        <input name="pregu2"  value="'.$resul['pregu2'].'" type="hidden" id="pregu2" size="5" />
        <input name="pregu3"  value="'.$resul['pregu3'].'" type="hidden" id="pregu3" size="5" />
      </label>
    </span></td>
  </tr>
  <tr>
    <td width="378" height="21"><span class="Estilo31">¿La enajenación generó renta de 3ra Categoría?</span></td>
    <td width="120"><span class="Estilo31">';
	if($resul['pregu1']=='1'){
     echo' <input type="radio" checked name="radio"  value="1" onClick="formulita(1)" />
      Si
        <input type="radio" name="radio" value="0" onClick="formulita(0)" />
      No </span>'; 
	}else{
		
		echo' <input type="radio"  name="radio"  value="1" onClick="formulita(1)" />
      Si
        <input type="radio" checked name="radio" value="0" onClick="formulita(0)" />
      No </span>'; 
		
		}
	
	echo'  </td>
    <td width="199" rowspan="3"><div id="formulinn">';
	if($resul['pregu3']=='0'){
		echo'<a href="#" onClick="validarformul()"><img src="iconos/ingresarformulario.png" border="0"/></a>';
	}else{
		echo '';
		}
	echo'</div></td>
  </tr>
  <tr>
    <td><span class="Estilo31">¿El bien enajenado era la casa habitación del enajenante?</span></td>
    <td><span class="Estilo31">';
	if($resul['pregu2']=='1'){
     echo'<input type="radio" checked name="radio2" id="rtm3" value="1" onClick="formulita1(1)" />
      Si
      <label>
        <input type="radio" name="radio2" id="rtm4" value="0"  onclick="formulita1(0)"/>
      </label>
      No </span>'; 
	}else{
		
		echo'<input type="radio"  name="radio2" id="rtm3" value="1" onClick="formulita1(1)" />
      Si
      <label>
        <input type="radio" checked name="radio2" id="rtm4" value="0"  onclick="formulita1(0)"/>
      </label>
      No </span>'; 
		
		}
	
	echo'
	
      </td>
  </tr>
  <tr>
    <td><span class="Estilo31">¿El impuesto por pagar es cero?</span></td>
    <td>';
	if($resul['pregu3']=='1'){
     echo'<span class="Estilo31">
	      <input type="radio" checked name="radio3" id="rtm5" value="1" onClick="formulita2(1)" />
      Si
      <label>
        <input type="radio" name="radio3" id="rtm6" value="0" onClick="formulita2(0)" />
      </label>
      No </span>'; 
	}else{
		
		echo'<span class="Estilo31">
	      <input type="radio" name="radio3" id="rtm5" value="1" onClick="formulita2(1)" />
      Si
      <label>
        <input type="radio" checked name="radio3" id="rtm6" value="0" onClick="formulita2(0)" />
      </label>
      No </span>'; 
		
		}
	
	echo'

	</td>
  </tr>
  <tr>
    <td colspan="3"><table width="697" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="78" height="31">&nbsp;</td>
        <td width="301">&nbsp;</td>
        <td width="101"><a href="#" onclick="grabar_renta_edit()"><img src="iconos/grabar.png" alt="" width="94" height="29" border="0" /></a></td>
        <td width="217"><div id="rptf"><input name="idrenta" id="idrenta" value="'.$resul['idrenta'].'" type="hidden" />Preguntas grabadas</div></td>
      </tr>
    </table></td>
  </tr>
</table>';

}else{
echo'<table width="697" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="24" colspan="3"><span class="Estilo31">Presentó Comunicación con Cáracter de DECLARACIÓN JURADA indicando:
      <label>
        <input name="pregu1" type="hidden" id="pregu1" size="5" />
        <input name="pregu2" type="hidden" id="pregu2" size="5" />
        <input name="pregu3" type="hidden" id="pregu3" size="5" />
      </label>
    </span></td>
  </tr>
  <tr>
    <td width="378" height="21"><span class="Estilo31">¿La enajenación generó renta de 3ra Categoría?</span></td>
    <td width="120"><span class="Estilo31">
      <input type="radio" name="radio"  value="1" onClick="formulita(1)" />
      Si
      <label>
        <input type="radio" name="radio" value="0" onClick="formulita(0)" />
      </label>
      No </span></td>
    <td width="199" rowspan="3"><div id="formulinn"> </div></td>
  </tr>
  <tr>
    <td><span class="Estilo31">¿El bien enajenado era la casa habitación del enajenante?</span></td>
    <td><span class="Estilo31">
      <input type="radio" name="radio2" id="rtm3" value="1" onClick="formulita1(1)" />
      Si
      <label>
        <input type="radio" name="radio2" id="rtm4" value="0"  onclick="formulita1(0)"/>
      </label>
      No </span></td>
  </tr>
  <tr>
    <td><span class="Estilo31">¿El impuesto por pagar es cero?</span></td>
    <td><span class="Estilo31">
      <input type="radio" name="radio3" id="rtm5" value="1" onClick="formulita2(1)" />
      Si
      <label>
        <input type="radio" name="radio3" id="rtm6" value="0" onClick="formulita2(0)" />
      </label>
      No </span></td>
  </tr>
  <tr>
    <td colspan="3"><table width="697" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="78" height="31">&nbsp;</td>
        <td width="301">&nbsp;</td>
        <td width="101"><div id="gbr"><a href="#" onclick="grabar_renta()"><img src="iconos/grabar.png" alt="" width="94" height="29" border="0" /></a></div><div id="gbr2" style="display:none"><a href="#" onclick="grabar_renta_edit()"><img src="iconos/grabar.png" alt="" width="94" height="29" border="0" /></a></div></td>
        <td width="217"><div id="rptf"></div></td>
      </tr>
    </table></td>
  </tr>
</table>';
}
?>