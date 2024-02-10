<?php

    namespace core\controllers;

    use core\classes\Database;
use core\classes\EnviarEmail;
use core\classes\Store;
use core\models\Clientes;

    class Main{
        public function index(){
            
            // Apresenta o inicio da pagina
            Store::Layout([
                'layouts/html_header',
                'layouts/header',
                'inicio',
                'layouts/footer',
                'layouts/html_footer'
            ]);
        }

        // ======================================================================
        public function loja(){
             // Apresenta a loja 
             Store::Layout([
                'layouts/html_header',
                'layouts/header',
                'loja',
                'layouts/footer',
                'layouts/html_footer'
            ]);
        }

        // ======================================================================
        public function novo_cliente(){

            // Verifica se ja existe sessao aberta
            if (Store::clientelogado()) {
                $this->index();
                return;
            }
            
            // Apresenta a pagina para criar novo cliente
             Store::Layout([
                'layouts/html_header',
                'layouts/header',
                'criar_cliente',
                'layouts/footer',
                'layouts/html_footer'
            ]);
        
        }

        // ======================================================================
        public function criar_cliente(){
            // Verifica se ja existe sessao
            if (Store::clientelogado()) {
                $this->index();
                return;
            }

            // Verifica se houve submissao de formulario
            if ($_SERVER['REQUEST_METHOD'] != 'POST') {
                $this->index();
                return;   
            }
            
            // Criacao do novo cliente

            // Verificar se senha1 = senha 2
            if($_POST['text_senha1'] != $_POST['text_senha2']){
                // as passwords sao diferentes
                $_SESSION['erro'] = 'As senhas nao sao iguais';
                $this->novo_cliente();
                return;
            }
            
            // Verifica na base de dados se existe outra conta com o mesmo email
            $cliente = new Clientes();
            if ($cliente->verificar_email($_POST['text_email'])) {
                $_SESSION['erro'] = 'Email registrada noutra conta';
                $this->novo_cliente();
                return;
            }

            // Inserir cliente e retornar o seu purl
            $email_cliente = strtolower(trim($_POST['text_email']));
            $purl = $cliente->registar_cliente();

            // Criar um link purl para enviar por email
            //$link_purl = "http://localhost/phpstore/public/?a=confirmar_email&purl=$purl";

            // Envio do email do cliente
            $email = new EnviarEmail();
            $resultado = $email->enviar_email_confirmacao_novoCliente($email_cliente, $purl);

            if ($resultado) {
                echo 'Email enviado';
            }else{
                echo 'Aconteceu algum erro';
            }
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