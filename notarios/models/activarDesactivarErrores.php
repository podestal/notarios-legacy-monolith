<?php
    include('../conexion.php');
    
    $inputsErrores = $_POST['datosSerializados'];
    $inputsErroresDecode = json_decode($inputsErrores,true);   
    $arrErrores = explode(',',$inputsErroresDecode['txtIdsErrores']);
 
    
    for ($i=0; $i < count($arrErrores); $i++) { 

        $error= 0;
        $idError = $arrErrores[$i];
        if(($inputsErroresDecode['txtError'.$arrErrores[$i]])==1){$error=1;}else{$error=$error;}
        $txtError = $error;

        $queryErrores = "UPDATE errores set estado = $txtError where id_error = $idError";
        $resultErrores = mysql_query($queryErrores, $conn) or die(mysql_error());
    }

echo json_encode('ACTUALIZADO');

?>