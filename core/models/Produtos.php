<?php
    namespace core\models;
    use core\classes\Database;
    use core\classes\Store;

    class Produtos{
        // ===============================================================
        public function listar_produto_visivel(){
            // Buscar todas as informações dos produtos da base dados
            $bd = new Database();
            $produtos = $bd->Select("
            SELECT * FROM produtos
            WHERE visivel = 1 ");

            return $produtos;
        }
    }
?>