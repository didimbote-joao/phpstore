<?php

    namespace core\controllers;

    use core\classes\Database;
    use core\classes\EnviarEmail;
    use core\classes\Store;
    use core\models\Clientes;
    use core\models\Produtos;

    class Carrinho{

        // ======================================================================
        public function adicionar_carrinho(){
            // Vai buscar o id do produto a query string
            $id_produto = $_GET['id_produto'];

            //adiciona/gestao da variavel de SESSAO do carrinho

            /*
                1. Puxar o array do carrinho da sessao para o PHP (interior do codigo)
                2. Vou adicionar/gerir o array do carrinho
                3. Recolocar o array sessao
            */

            $carrinho = [];
            if (isset($_SESSION['carrinho'])) {
                $carrinho = $_SESSION['carrinho'];
            }

            // Adicionar o produto ao carrinho
            if (key_exists($id_produto, $carrinho)) {
                # Ja existe o produto no carrinho
                $carrinho[$id_produto];
            } else{
                // Adiciona o novo produto ao carrinho
                array_push($carrinho, [$id_produto=>1]);
            }

            // Actualiza os dados do carrinho na SESSAO
            $_SESSION['carrinho'] = $carrinho;

            // Devolve a resposta (numero de produtos no carrinho)
            $total_quantidade = 0;
            foreach ($carrinho as $produto_quantidade) {
                $total_quantidade += $produto_quantidade;
            }

            echo 'Adicionado o produto ' . $id_produto . ' ao carrinho';
        }
        // ======================================================================
        public function carrinho(){
            // Apresenta a pagina do carrinho 
            Store::Layout([
                'layouts/html_header',
                'layouts/header',
                'carrinho',
                'layouts/footer',
                'layouts/html_footer'
            ]);
        }
    }

?>