<?php
    namespace core\models;
    use core\classes\Database;
    use core\classes\Store;

    class Clientes{
        // ========================================================================
        public function verificar_email($email){
           // Verifica se ja existe outra conta com o mesmo email
           $bd = new Database();
            $parametros = [':email' => strtolower(trim($email))];
            $resultados = $bd->Select(("
                SELECT email FROM clientes WHERE email = :email"), 
                $parametros);
            
            // Se o cliente ja existe 
            if (count($resultados) != 0) {
                return true;
            }else{
                return false;
            }
        }

        // ========================================================================
        public function registar_cliente(){
            // Regista novo cliente
            $bd = new Database();

            // Criar hashes
            $purl = Store::criarHash();
            // echo $purl;

            $parametros = [
                ':email' => strtolower(trim($_POST['text_email'])),
                ':senha' => password_hash($_POST['text_senha2'], PASSWORD_DEFAULT),
                ':nome_completo' => trim($_POST['text_nome_completo']),
                ':morada' => trim($_POST['text_morada']),
                ':cidade' => trim($_POST['text_cidade']),
                ':telefone' => trim($_POST['text_telefone']),
                ':purl' => $purl,
                ':activo' => 0
            ];

            // Inserindo dados na base de dados
            $bd->Insert("
                INSERT INTO clientes VALUES(
                0,
                :email, 
                :senha, 
                :nome_completo, 
                :morada, 
                :cidade, 
                :telefone, 
                :purl, 
                :activo,
                NOW(),
                NOW(),
                NULL)", $parametros
            );
            // Retorna o purl
            return $purl;
        }
    }
?>