<?php
	include("../conexion.php");

    $consultaSQL="SELECT * FROM errores";
    $resultErrores = mysql_query($consultaSQL, $conn) or die(mysql_error());
    $arrErrores = array();

    while($row1 = mysql_fetch_assoc($resultErrores)){
        $arrErrores[] = array(
            'id_error' => $row1['id_error'],
            'descripcion' => $row1['descripcion'],
            'estado' => $row1['estado'],
        ); 
    }
    // print_r($arrErrores);

?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Activar/Desactivar errores</title>
<link href="../includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../tcal.css" />
<link href="../includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../includes/css/uniform.default.min.css" />
<link rel="stylesheet" type="text/css" href="../tcal.css" />

<script type="text/javascript" src="../tcal.js"></script> 
<script type="text/javascript" src="../includes/ext_script1.js"></script> 
<script src="../includes/jquery-1.8.3.js"></script>
<script src="../includes/js/jquery-ui-notarios.js"></script>
<script src="../includes/jquery.uniform.min.js"></script>
<script src="../includes/maskedinput.js"></script>
<script type="text/javascript" src="../tcal.js"></script> 
<script type="text/javascript" src="func_ini_sisnot.js"></script>

<script type="text/javascript">
     $(document).ready(function(){ 
		 $("input, textarea").uniform();
		 $("button").button();
		 $("#dialog").dialog();
		 $(".ui-dialog-titlebar").hide();
	})
</script>
<style type="text/css">
    div.div_genkar{ 
        background-color: #ffffff;border: 4px solid #264965;-moz-border-radius: 5px;
        -webkit-border-radius: 5px;border-radius: 5px;-moz-box-shadow: 0px 0px 5px #000000;-webkit-box-shadow: 0px 0px 5px #000000;box-shadow: 0px 0px 5px #000000;width:550px; height:300px;float:left;margin-left:30%;margin-top:10px;
    }
    .titulosprincipales {
        font-family: Verdana;font-size: 14px;color: #F90;font-style: italic;	
    }
    .line {color: #FFFFFF}
    .Estilo7 {font-family: Calibri; font-size: 13px; font-style: italic; }
    .Estilo14 {font-family: Calibri; font-size: 12px; color: #333333; font-weight: bold; }
    .Estilo12 {font-family: Calibri; font-size: 12px; color: #333333; font-style: italic; }
    .camposss {font-family: Verdana; font-size: 11px; color: #333333; }
    body{ font-family: Arial, Helvetica, sans-serif; font-size:12px; font-weight: bold; margin-bottom:50px;}
    .cajas{ margin-bottom:25px;}
</style>
</head>

<body  style="font-size:62.5%;">
<div class="div_genkar">
    <table width="553" height="100%"  border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="553" height="30" bgcolor="#264965">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="22" height="30">&nbsp;</td>
                    <td width="516" align="center" valign="middle"><span class="titulosprincipales">Activar / Desactivar errores de usuarios</span></td>
                    <td width="20">&nbsp;</td>
                </tr>
            </table>
        </td>
    </tr>
        <td valign="top">
            <form action = "../models/activarDesactivarErrores.php"  method="POST" id="formActivarDesactivarErrores">
                <table width="550" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td colspan="4"></td>
                    </tr>
                    <tr>
                        <td height="22" colspan="2" align="right" bgcolor="#FFFFFF" >&nbsp;</td>
                        <td height="28" colspan="2" bgcolor="#FFFFFF">&nbsp;</td>
                    </tr>
                    <tr>
                        <?php
                            $ids = array();
                            for ($i=0; $i < count($arrErrores); $i++) { 
                                
                                if($arrErrores[$i]['estado']==1){
                                    $checked = 'checked="checked"';
                                }
                                if($arrErrores[$i]['estado']==0){
                                    $checked = '';
                                }
                                $ids[] = $arrErrores[$i]['id_error'];
                             
                                echo '<td width="56" height="33" align="right" bgcolor="#FFFFFF">
                                    <input id="txtError'.$arrErrores[$i]['id_error'].'"  name="txtError'.$arrErrores[$i]['id_error'].'" type="checkbox" value="'.$arrErrores[$i]['estado'].'" '.$checked.' class="Estilo7" style="width:30px"/>
                                </td>
                                <td width="244" align="left" bgcolor="#FFFFFF">
                                    <span class="camposss">'.$arrErrores[$i]['descripcion'].'</span>
                                </td>';
                            }
                        ?>
                        
                    </tr>
                    <tr>
                        <input type="hidden" value="<?php echo implode(',',$ids)?>" id="txtIdsErrores" name="txtIdsErrores">
                        <td height="97" colspan="4" align="center"  ><button  type="submit"    id="btnActivarDesactivarErrores">Grabar Cambios</button></td>
                    </tr>
                </table>
            </form>
        </td>
    </table>
</div>
<script>
    
    document.addEventListener('DOMContentLoaded',()=>{

        let btn=document.getElementById('btnActivarDesactivarErrores');
        btn.addEventListener('click', function(e){
            e.preventDefault();
         
            let url=document.getElementById('formActivarDesactivarErrores').action;
            let form=document.getElementById('formActivarDesactivarErrores');
            let datos=form.querySelectorAll('input,select,textarea');

            activar_desactivar_errores(url,form,datos);

        })
    })

    function activar_desactivar_errores(url,form,datos){
        console.log(datos)

        let inputs = {};
        for(const item of datos){
            let name=item.name;
            let value=item.value;
            let check = item.checked
            inputs[name] = value;
            if(item.type=='checkbox'){
                inputs[name] = check;
            }
        }

        const datosSerializados=JSON.stringify(inputs);
    //    console.log(datosSerializados);return false;
       const request=new XMLHttpRequest();
       request.open('POST',url,true);
       request.setRequestHeader('Content-Type','application/x-www-form-urlencoded;charset=UTF-8');
       request.send('datosSerializados='+datosSerializados);

       request.onload=function(){
           if (request.status>=200 && request.status<400) {
               let data=request.responseText;
                console.log(data)
                alert(data)
           } else {
                console.log(request.responseText);
           }
       }
       request.onerror = function(){
           console.log('ERROR DE SERVIDOR')   
       }
    }
</script>
</body>
</html>
