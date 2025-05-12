<?php
// Datos de pedo en apis.net
// datos
if ($_POST['n_info'] === 'dni') {
    $token = file_get_contents('../entrada/nuevo_token.txt');
    $dni = $_POST['n_documento'];

    // Iniciar llamada a API
    $curl = curl_init();


    // Buscar dni
    curl_setopt_array($curl, array(
        // para user api versión 2
        CURLOPT_URL => 'https://api.apis.net.pe/v2/reniec/dni?numero=' . $dni,
        // para user api versión 1
        // CURLOPT_URL => 'https://api.apis.net.pe/v1/dni?numero=' . $dni,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 2,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Referer: https://apis.net.pe/consulta-dni-api',
            'Authorization: Bearer ' . $token
        ),
    ));


    $response = curl_exec($curl);

    curl_close($curl);
    // Datos listos para usar
    $persona = json_decode($response);
    header('Content-Type: application/json');
    echo json_encode($persona);
} else if ($_POST['n_info'] === 'ruc') {
    $token = file_get_contents('../entrada/nuevo_token.txt');
    $ruc = $_POST['n_documento'];

    // Iniciar llamada a API
    $curl = curl_init();

    // Buscar ruc sunat
    curl_setopt_array($curl, array(
        // para usar la versión 2
        CURLOPT_URL => 'https://api.apis.net.pe/v2/sunat/ruc?numero=' . $ruc,
        // para usar la versión 1
        // CURLOPT_URL => 'https://api.apis.net.pe/v1/ruc?numero=' . $ruc,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Referer: http://apis.net.pe/api-ruc',
            'Authorization: Bearer ' . $token
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    // Datos listos para usar
    $persona = json_decode($response);
    header('Content-Type: application/json');
    echo json_encode($persona);
} else {
    echo 'error de recibir datos del ajax al api';
}
