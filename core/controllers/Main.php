<?php

    namespace core\controllers;

    use core\classes\Database;
    use core\classes\EnviarEmail;
    use core\classes\Store;
    use core\models\Clientes;
    use core\models\Produtos;

class Main
{
    // ======================================================================
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

        // Carrega os produtos para apresentar na loja
        $produtos = new Produtos();

        // Analisa que categoria mostrar
        $categoria = 'todos';

        if (isset($_GET['c'])) {
            $categoria = $_GET['c'];
        }
        // if ($_GET['c']) {
        //     $categoria = $_GET['c'];
        // }

        // Busca informações à base de dados
        $listar_produtos = $produtos->listar_produto_visivel($categoria);
        $lista_categorias = $produtos->lista_categoria();
        
        $dados = [
            'produtos' => $listar_produtos,
            'categorias' => $lista_categorias
        ];
       
        // Store::print_data($listar_produtos);

        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'loja',
            'layouts/footer',
            'layouts/html_footer'
        ], $dados);
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
        if ($_POST['text_senha1'] != $_POST['text_senha2']) {
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
            // Conta criada com sucesso, apresenta mensagem para informar o email 
            Store::Layout([
                'layouts/html_header',
                'layouts/header',
                'criar_cliente_sucesso',
                'layouts/footer',
                'layouts/html_footer'
            ]);
            return;
        } else {
            echo 'Aconteceu algum erro';
        }
    }

    // ======================================================================
    public function confirmar_email(){
        // Verifica se ja existe sessao
        if (Store::clientelogado()) {
            $this->index();
            return;
        }

        // Verefica se existe na query string um purl
        if (!isset($_GET['purl'])) {
            $this->index();
            return;
        }

        $purl = $_GET['purl'];

        // Verifica se o purl e' valido 
        if (strlen($purl) != 12) {
            $this->index();
            return;
        }

        $cliente = new Clientes();
        $resultado = $cliente->validar_email($purl);

        if ($resultado) {
            // Conta confirmada com sucesso, apresenta mensagem de email confirmado
            Store::Layout([
                'layouts/html_header',
                'layouts/header',
                'conta_confirmada_sucesso',
                'layouts/footer',
                'layouts/html_footer'
            ]);
            return;
        } else {
            // Redirecionar o cliente para a pagina inicial
            Store::redirect();
        }
    }

    // ======================================================================
    public function login(){
        // Verifica se ja existe cliente logado
        if (Store::clientelogado()) {
            Store::redirect();
            return;
        }

        // Apresenta o layout de login
        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'login_frm',
            'layouts/footer',
            'layouts/html_footer'
        ]);
    }

    // ======================================================================
    public function login_submit(){
        // Verifica se ja existe um cliente logado
        if (Store::clientelogado()) {
            Store::redirect();
            return;
        }
       
        // verefica se foi efectua um POST do login
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            Store::redirect();
            return;
        }

        // Verifica se o login e' valido

        if (
            !isset($_POST['text_email']) ||
            !isset($_POST['text_password']) ||
            !filter_var(trim($_POST['text_email']), FILTER_VALIDATE_EMAIL)
        ) {
            # Erro de preenchimento de formulario
            $_SESSION['erro'] = 'Login inválido';
            Store::redirect('login');
            return;
        }

        // Prepara os dados para o model
        $usuario = trim(strtolower($_POST['text_email']));
        $senha = trim($_POST['text_password']);

        // Carrega o Model e verifica se o login é válido
        $cliente = new Clientes();
        $resultado = $cliente->validar_login($usuario, $senha);
        
        // Verifica o resultado
        if (is_bool($resultado)) {
            // Email ou senha incorrecta
            $_SESSION['erro'] = 'Login inválido';
            Store::redirect('login');
            return;
        }else{
            // O login é válido. Coloca os dados na sessão
            $_SESSION['cliente'] = $resultado->id_cliente;
            $_SESSION['usuario'] = $resultado->email;
            $_SESSION['nome_cliente'] = $resultado->nome_completo;

            // Redireccionar para a loja
            Store::redirect();
            return;
        }
    }

    // ======================================================================
    public function logout(){
        // Remove/Encerra a sessão
        unset($_SESSION['cliente'] );
        unset($_SESSION['usuario'] );
        unset($_SESSION['nome_cliente'] );

        // Redireccionar para a loja
        Store::redirect();
        return;
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
