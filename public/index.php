<?php

    use core\classes\Database;
    use core\classes\Store;

    // Open Session 
    session_start();
    
    // Carrega todas as classes do projecto
    require_once('../vendor/autoload.php');

    // Carrega as rotas
    require_once('../core/rotas.php');

    // $bd = new Database();
    // $cliente = $bd->Select("SELECT * FROM clientes");
    // echo '<pre>';
    // print_r($cliente);
?>