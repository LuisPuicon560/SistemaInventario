<?php
// Datos

$token = file_get_contents('../entrada/nuevo_token.txt');
$fecha =$_POST['fecha'];

// Iniciar llamada a API
$curl = curl_init();

curl_setopt_array($curl, array(
  // para usar la api versión 2
  CURLOPT_URL => 'https://api.apis.net.pe/v2/sunat/tipo-cambio?date=' . $fecha,
  // para usar la api versión 1
  // CURLOPT_URL => 'https://api.apis.net.pe/v1/tipo-cambio-sunat?fecha=' . $fecha,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_SSL_VERIFYPEER => 0,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 2,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Referer: https://apis.net.pe/tipo-de-cambio-sunat-api',
    'Authorization: Bearer ' . $token
  ),
));

$response = curl_exec($curl);

curl_close($curl);

// Datos listos para usar
$tipoCambioSunat = json_decode($response, true);

// Comprobar si la respuesta tiene la clave 'precioVenta'
if (isset($tipoCambioSunat['precioVenta'])) {
    header('Content-Type: application/json');
    echo json_encode(array('precioVenta' => $tipoCambioSunat['precioVenta']));
} else {
    header('Content-Type: application/json');
    echo json_encode(array('error' => 'La respuesta de la API no contiene la información esperada.'));
}