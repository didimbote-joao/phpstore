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
                echo isset($_SESSION['carrinho']) ? count($_SESSION['carrinho']) : '';
                return;
            }

            // Define o id do produto
            $id_produto = $_GET['id_produto'];

            // Verifica se o produto existe e se tem stock
            $produto = new Produtos();
            $resultados = $produto->verificar_stock_produto($id_produto);
            if (!$resultados) {
                // Verifica se existe sessao carrinho e retorna seu valor ou vazio caso nao exista
                echo isset($_SESSION['carrinho']) ? count($_SESSION['carrinho']) : '';
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
            
            if (!isset($_SESSION['carrinho']) || count($_SESSION['carrinho']) == 0) {
                $dados = [
                    'carrinho' => null,
                ];
            } else{

                 /*
                    Ir buscar a bd os dados dos produtos existentes no carrinho
                    criar um ciclo que constroi a estrutura dos dados para ocarrinho
                    */

                $ids = [];
                // busca simultaneamente a chave e o seu valor (id_produto e a qtd)
                foreach($_SESSION['carrinho'] as $key=>$value){
                    array_push($ids, $key);
                }

                $ids = implode(",", $ids);
                $produto = new Produtos();
                $resultados = $produto->buscar_produto_por_id($ids);

                Store::print_data($resultados);
                
                $dados = [
                    'carrinho' => 1,
                ];
            }
            
            // Apresenta a pagina do carrinho 
            Store::Layout([
                'layouts/html_header',
                'layouts/header',
                'carrinho',
                'layouts/footer',
                'layouts/html_footer'
            ], $dados);
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