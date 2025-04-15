<?php



$GET_DATA_JSON  = json_decode(file_get_contents('php://input'), true);

$dni = $GET_DATA_JSON['dni'];
//$token = '88291cd82d6815f4e4fd5c2e6b92f808';
$token = 'cGVydWRldnMucHJvZHVjdGlvbi5maXRjb2RlcnMuNjcwM2Y2MmU5ZmE0MTczZjYxMzIwM2Nj';

//$url = 'https://consulta.api-peru.com/api/dni/'.$dni.'/'.$token.'/json';
$url = 'https://api.perudevs.com/api/v1/dni/complete?document='.$dni.'&key='.$token;

$dataJson = json_decode(file_get_contents($url), true);
echo json_encode($dataJson);


?>