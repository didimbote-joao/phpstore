<?php

    // Coleção de rotas
    $rotas = [
        'inicio' => 'main@index',
        'loja' => 'main@loja',
        
        // clientes
        'carrinho' => 'main@carrinho',

        'novo_cliente' => 'main@novo_cliente',
        'criar_cliente' => 'main@criar_cliente', 
    ];

    // Define ação por defeito
    $acao = 'inicio';

    // Verifica se existe uma ação na query string
    if (isset($_GET['a'])) {
       // Verifica se ação existe na query
       if (!key_exists($_GET['a'], $rotas)) {
            $acao = 'inicio';
       } else {
        $acao = $_GET['a'];
       }
    }

    // Trata da definição da rota
    $partes = explode('@', $rotas[$acao]);
    $controlador = 'core\\controllers\\'.ucfirst($partes[0]);
    $metodo = $partes[1];

    $ctr = new $controlador();
    $ctr->$metodo();

?>