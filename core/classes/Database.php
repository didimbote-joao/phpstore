<?php

    namespace core\classes;
    use Exception;
    use PDO;
    use PDOException;

    class Database
    {
       private $ligacao;

       // ==================================================
       private function ligar()
       {
            $this->ligacao = new PDO(
                'mysql:'.
                'host='.MYSQL_SERVER.';'.
                'dbname='.MYSQL_DATABASE.';'.
                'charset='.MYSQL_CHARSET,
                MYSQL_USER,
                MYSQL_PASS,
                array(PDO::ATTR_PERSISTENT => true)
            );

            // debug (vai permitir que o sistema apresente informacoes de erro)
            $this->ligacao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
       }

       // ==================================================
       private function desligar()
       {
        $this->ligacao = null;
       }

       // ==================================================
       // CRUD
       // ==================================================

       public function Select($sql, $parametros = null){
            // Executa funcao de pesquisa de SQL

            // Limpa espacos no inicio e final da string
            $sql = trim($sql);

            // Verifica se e' uma instrucao SELECT
            if (!preg_match("/^SELECT/i", $sql)) {
                throw new Exception ('Base de Dados - Não é uma instrução SELECT.');
                // die('Base de Dados - Não é uma instrução SELECT.');
            }

            // Liga a conexao
            $this->ligar();

            // Variavel para Devolver resultado do SELECT
            $resultados = null;

            // Comunicacao com a base de dados
            try {
                // Comunica com a BD
                if (!empty($parametros)) {
                    $executar = $this->ligacao->prepare($sql);
                    $executar->execute($parametros);
                    $resultados = $executar->fetchAll(PDO::FETCH_CLASS);
                }
                else {
                    $executar = $this->ligacao->prepare($sql);
                    $executar->execute();
                    $resultados = $executar->fetchAll(PDO::FETCH_CLASS);
                }
            } catch (PDOException $e) {
                // Caso exista erro
                return false;   
            }

            // Fecha a conexao
            $this->desligar();

            // Devolve os resultados obtidos
            return $resultados;
       }
       
       // ==================================================

        public function Insert($sql, $parametros = null){
            // Executa funcao de pesquisa de SQL
            $sql = trim($sql);
            // Verifica se e' uma instrucao INSERT
            if (!preg_match("/^INSERT/i", $sql)) {
                throw new Exception ('Base de Dados - Não é uma instrução INSERT.');
                // die('Base de Dados - Não é uma instrução SELECT.');
            }

            // Liga a conexao
            $this->ligar();

            // Comunicacao com a base de dados
            try {
                // Comunica com a BD
                if (!empty($parametros)) {
                    $executar = $this->ligacao->prepare($sql);
                    $executar->execute($parametros);
                }
                else {
                    $executar = $this->ligacao->prepare($sql);
                    $executar->execute();
                }
            } catch (PDOException $e) {
                // Caso exista erro
                return false;   
            }

            // Fecha a conexao
            $this->desligar();
       }

       // ==================================================
       public function Update($sql, $parametros = null){
        // Executa funcao de pesquisa de SQL
            $sql = trim($sql);
            // Verifica se e' uma instrucao UPDATE
            if (!preg_match("/^UPDATE/i", $sql)) {
                throw new Exception ('Base de Dados - Não é uma instrução UPDATE.');
                // die('Base de Dados - Não é uma instrução SELECT.');
            }

            // Liga a conexao
            $this->ligar();

            // Comunicacao com a base de dados
            try {
                // Comunica com a BD
                if (!empty($parametros)) {
                    $executar = $this->ligacao->prepare($sql);
                    $executar->execute($parametros);
                }
                else {
                    $executar = $this->ligacao->prepare($sql);
                    $executar->execute();
                }
            } catch (PDOException $e) {
                // Caso exista erro
                return false;   
            }

            // Fecha a conexao
            $this->desligar();
       }

       // ==================================================
       public function Delete($sql, $parametros = null){
        // Executa funcao de pesquisa de SQL
            $sql = trim($sql);
            // Verifica se e' uma instrucao DELETE
            if (!preg_match("/^DELETE/i", $sql)) {
                throw new Exception ('Base de Dados - Não é uma instrução DELETE.');
                // die('Base de Dados - Não é uma instrução SELECT.');
            }

            // Liga a conexao
            $this->ligar();

            // Comunicacao com a base de dados
            try {
                // Comunica com a BD
                if (!empty($parametros)) {
                    $executar = $this->ligacao->prepare($sql);
                    $executar->execute($parametros);
                }
                else {
                    $executar = $this->ligacao->prepare($sql);
                    $executar->execute();
                }
            } catch (PDOException $e) {
                // Caso exista erro
                return false;   
            }

            // Fecha a conexao
            $this->desligar();
       }

       // ==================================================
       // GENERICA
       // ==================================================
       public function Statement($sql, $parametros = null){
        // Executa funcao de pesquisa de SQL
            $sql = trim($sql);
            // Verifica se e' uma instrucao diferente das anteriores
            if (preg_match("/^(SELECT|INSERT|UPDATE|DELETE/i", $sql)) {
                throw new Exception ('Base de Dados - Instrução errada.');
                // die('Base de Dados - Não é uma instrução SELECT.');
            }

            // Liga a conexao
            $this->ligar();

            // Comunicacao com a base de dados
            try {
                // Comunica com a BD
                if (!empty($parametros)) {
                    $executar = $this->ligacao->prepare($sql);
                    $executar->execute($parametros);
                }
                else {
                    $executar = $this->ligacao->prepare($sql);
                    $executar->execute();
                }
            } catch (PDOException $e) {
                // Caso exista erro
                return false;   
            }

            // Fecha a conexao
            $this->desligar();
       }
    }
?>