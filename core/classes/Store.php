<?php
    namespace core\classes;
    use Exception;
    
    class Store{
        // ======================================================================
       public static function Layout($estruturas, $dados = null){
            // Verefica se estruturas é um array
            if (!is_array($estruturas)) {
                throw new Exception("Coleção de estrutua inválido");
            }

            // Trata as Variaveis
            if (!empty($dados) && is_array($dados)) {
                extract($dados);
            }

            // Apresenta as views da aplicacao
            foreach($estruturas as $estrutura){
                include("../core/views/$estrutura.php");
            }
       }

       // ======================================================================
       public static function clientelogado(){
            // Verifica se existe um cliente com sessao
            return isset($_SESSION['cliente']);
       }

       // ======================================================================
       public static function criarHash($numero_caracteres = 12){
        // Criar hashes
            $caracteres = '0123456789abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            return substr(str_shuffle($caracteres), 0, $numero_caracteres); 
       }

       // ======================================================================
       public static function redirect($rota =''){
            // Faz o redirecionamento 
            header("Location: " . BASE_URL . "?a=$rota");
       }
    }
?>