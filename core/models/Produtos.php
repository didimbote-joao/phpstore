<?php
    namespace core\models;
    use core\classes\Database;
    use core\classes\Store;

    class Produtos{
        // ===============================================================
        
        public function listar_produto_visivel($categoria){
            // Buscar todas as informações dos produtos disponiveis da base dados
           
            $bd = new Database();

            // Buscar a lista de categorias dos produtos
            $categorias = $this->lista_categoria();

            //Construção da query select
            $sql = "SELECT * FROM produtos WHERE visivel = 1 ";

            if (in_array($categoria, $categorias)) {
                $sql .= "AND categoria = '$categoria'";
            }

            $produtos = $bd->Select($sql);
            return $produtos;
        }

        // ===============================================================
        public function lista_categoria(){
            // Devolve a lista de categoria da tabela produto

            $bd = new Database();

            $resultados =$bd->Select("SELECT DISTINCT categoria FROM produtos");

            // Array criado pra armazenar o resultado do select
            $categorias = [];

            // Atribuindo os valores do select para a categorias
            foreach ($resultados as $resultado) {
                array_push($categorias, $resultado->categoria);
            }
            
            // Retornando as categorias
            return $categorias;
        }
    }
?>