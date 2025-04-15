<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<script language="JavaScript" type="text/javascript" src="ajax.js"></script>
<script type="text/javascript">
jQuery(document).ready(function($) {
 
    $('#tabs .tabscontent>div').not('div:first').hide();
    $('#tabs ul li:first,#tabs .tabscontent>div:first').addClass('active');
 
    $('#tabs ul li a').click(function(){
 
        var currentTab = $(this).parent();
        if(!currentTab.hasClass('active')){
            $('#tabs ul li').removeClass('active');             
 
            $('#tabs .tabscontent>div').slideUp('fast').removeClass('active');
 
            var currentcontent = $($(this).attr('href'));
            currentcontent.slideDown('fast', function() {
                currentTab.addClass('active');
                currentcontent.addClass('active');
            });
        }
        return false;                           
    });
});

function permi_user(id){
	document.getElementById('idusu').value=id;
	mostrarpermiusux();
	
	}
</script>
<style type="text/css">
.titusss {	font-family: Calibri;
	font-size: 16px;
	color: #333333;
	font-weight: bold;
}
.titus34 {	font-family:Verdana, Geneva, sans-serif;
	font-size: 12px;
	color: #333333;
	
}
* { box-sizing: border-box;}
body{font-size:11px;font-family:Verdana, Geneva, sans-serif;}
a{ color: #000; text-decoration: none;}
.content *:first-child {margin-top: 0;}
.content *:last-child {margin-bottom: 0;}
 
/*clearfix*/
.clearfix:before, .clearfix:after { display: table; content: ""; }
.clearfix:after { clear: both; }
.clearfix { zoom: 1; }
 
/*tabs ul*/
.tabs ul{
    margin: 0;padding: 0;
}
 
/*tabs li*/
.tabs li { 
    position: relative; 
    display: inline-block; 
    margin: 1px .2em 0 0; 
    padding: 0;
    list-style: none; white-space: nowrap;
}
 
.tabs li.active a{
    position: relative;
    z-index: 10;
    margin-bottom: -1px;
    padding-bottom: 6px;
    background: #FAFAFA;
    box-shadow: 0 0 8px rgba(0, 0, 0, .2);
	font-family:Verdana, Geneva, sans-serif;
	font-size:15px;
	font:bold;
	color:#036;
}
 
/*tabs a*/
.tabs a{
    display: inline-block;
    margin-bottom: -5px;
    padding: 5px;
    padding-bottom: 10px;
    border: 1px solid #DFDFDF;
    border-bottom: none;
    border-radius: 5px 5px 0 0;
    background: #F3F3F3;
	font-family:Verdana, Geneva, sans-serif;
	font-size:13px;
	color:#036;
	
}
 
/*content*/
.tabs .tabscontent {
    position: relative;
    display: block;
    float: left; 
    border: 1px solid #DFDFDF;
    border-radius: 5px;
    background: #F3F3F3;
    box-shadow: 0 0 10px rgba(0, 0, 0, .2);
}
.tabs .tabscontent .active{
    position: relative;
    z-index: 200;
    display: inline-block;
    border-radius: 5px;
    background: #FAFAFA;
}
 
/*first tab with border-radius 0*/
.tabs .tabscontent:first-child,
.tabs .tabscontent .active:first-child {
    border-top-left-radius: 0;
}
 
.tabs .content{
    padding: 20px;
}
</style>

</head>

<body>
<table width="836" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="3"><table width="833" border="0" align="left" cellpadding="0" cellspacing="0">
      <tr>
        <td width="833"></td>
      </tr>
      <tr>
        <td></td>
      </tr>
      <tr>
        <td></td>
      </tr>
      <tr>
        <td></td>
      </tr>
      <tr>
        <td></td>
      </tr>
      <tr>
        <td></td>
      </tr>
      <tr>
        <td></td>
      </tr>
      <tr>
        <td></td>
      </tr>
      <tr>
        <td height="19" bgcolor="#FFFFFF"><table width="823" border="1" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC">
          <tr>
            <td width="264" height="40" align="center" bgcolor="#D6D6D6" class="titusss">Apellidos y Nombres</td>
            <td width="135" align="center" bgcolor="#D6D6D6" class="titusss">Tipo Usuario</td>
            <td width="156" align="center" bgcolor="#D6D6D6" class="titusss">Usuario</td>
            <td width="118" align="center" bgcolor="#D6D6D6" class="titusss">Estado</td>
            <td width="138" align="center" bgcolor="#D6D6D6" class="titusss">Permisos
              <label for="idusu"></label>
              <input type="hidden" name="idusu" id="idusu" /></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="11" bgcolor="#FFFFFF"><div id="resultado" style="width:820px; height:200px; overflow:auto; background:#E5E5E5">
          <?php 
include("conexion.php");


$consulta = mysql_query("SELECT * FROM usuarios", $conn) or die(mysql_error());

while($row = mysql_fetch_array($consulta)){
echo "<table width='773' border='1' cellpadding='0' cellspacing='0' bordercolor='#CCCCCC'>
  <tr> 
    <td width='264' height='31' class='titus34'>".strtoupper($row['apepat']." ".$row['apemat'].",".$row['prinom']." ".$row['segnom'])."</td>
    <td width='135' align='center' class='titus34'>";

     $cargos="select * from cargousu where idcargo='".$row['idcargo']."'";
     $rpta = mysql_query($cargos, $conn) or die(mysql_error());
     $row3 = mysql_fetch_array($rpta);
     echo $row3['descargo'];


echo"</td> 
    <td width='156' align='center' class='titus34'>".$row['loginusuario']."</td>
    <td width='118' align='center' class='titus34'>"; if ($row['estado']==0)
	{echo "INHABILITADO";}else{echo "HABILITADO";} echo "</td>
    <td width='88' align='center'>"; 
	if ($row['estado']==0)
	{echo "<img src='iconos/edit_x.fw2.fw.png' width='34' height='27' />";
	}else{echo "<a href='ver_permi_usux.php?idusu=".$row['idusuario']."' target='tabspermi'><img  src='iconos/edit_x.png' width='34' height='27'/></a>";
	} echo "</td>
  </tr>
</table>

";
}

?>
        </div></td>
      </tr>
      <tr>
        <td height="12" bgcolor="#FFFFFF"><hr style="color: #036;" /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="460" colspan="3"><iframe name="tabspermi" src="blanco.php" frameborder="0" width="835" height="460" allowtransparency="true" scrolling="auto"></iframe></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>