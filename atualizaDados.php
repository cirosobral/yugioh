<?php

// CONTÉM PSEUDO-CÓDIGO (APENAS PARA ILUSTRAÇÃO) - NÃO VAI RODAR

$data_atualizacao = BD::get('data_atualização')

if ($data_atualizacao < date("Y-m-d H:i:s")) {
    $api_url = 'https://db.ygoprodeck.com/api/v7/cardinfo.php';

    // Read JSON file
    $json_data = file_get_contents($api_url);

    // Decode JSON data into PHP array
    $response_data = json_decode($json_data);

    BD::save($response_data->data);
}