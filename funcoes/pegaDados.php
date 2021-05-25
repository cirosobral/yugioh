<?php

function pegaDados($busca)
{
    $api_url = "https://db.ygoprodeck.com/api/v7/cardinfo.php?fname=$busca";
    
    // Read JSON file
    $json_data = file_get_contents($api_url);
    
    // Decode JSON data into PHP array
    $response_data = json_decode($json_data);
    
    // All user data exists in 'data' object
    $cards = $response_data->data;
    
    // Print data if need to debug
    // print_r($cards);
    
    return $cards;
}