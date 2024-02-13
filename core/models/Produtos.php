<?php
    namespace core\models;
    use core\classes\Database;
    use core\classes\Store;

    class Produtos{
        // ===============================================================
        public function listar_produto_visivel($categoria){
            // Buscar todas as informações dos produtos da base dados
            $bd = new Database();

            //Construção da query select
            $sql = "SELECT * FROM produtos WHERE visivel = 1 ";

            if ($categoria == 'homem' || $categoria == 'mulher') {
                $sql .= "AND categoria = '$categoria'";
            }
            
            $produtos = $bd->Select($sql);

            return $produtos;
        }
    }
?>