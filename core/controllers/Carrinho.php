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

            if (!isset($_GET['id_produto'])) {
                header('Location: ' . BASE_URL . 'index.php?a-loja');
                return;
            }

            // Define o id do produto
            $id_produto = $_GET['id_produto'];

            // Verifica se o produto existe e se tem stock
            $produto = new Produtos();
            $resultados = $produto->verificar_stock_produto($id_produto);
            if (!$resultados) {
                header('Location: ' . BASE_URL . 'index.php?a-loja');
                return;
            }
            $carrinho = [];
            if (isset($_SESSION['carrinho'])) {
                $carrinho = $_SESSION['carrinho'];
            }

            // Adicionar o produto ao carrinho
            if (key_exists($id_produto, $carrinho)) {
                # Ja existe o produto no carrinho
                $carrinho[$id_produto] = $carrinho[$id_produto] + 1;
            } else{
                // Adiciona o novo produto ao carrinho
                $carrinho[$id_produto] = 1;
            }

            // Actualiza os dados do carrinho na SESSAO
            $_SESSION['carrinho'] = $carrinho;

            // Devolve a resposta (numero de produtos no carrinho)
            $total_produtos = 0;
            foreach ($carrinho as $produto_quantidade) {
                $total_produtos += $produto_quantidade;
            }

            echo $total_produtos;
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

        // ======================================================================
        public function limpar_carrinho(){
            // Eliminar a sessao do carrinho
            unset($_SESSION['carrinho']);
            // refrescar a pagina
            $this->carrinho();
        }
    }
?>