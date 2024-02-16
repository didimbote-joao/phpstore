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
            $id_produto = $_GET['id_produto'];
            $_SESSION['teste'] = $id_produto;
            echo 'Adicionado ' . $id_produto . ' ao carrinho';
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