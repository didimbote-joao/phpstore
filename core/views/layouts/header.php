<?php 
    use core\classes\Store;
    
    // Total de produtos no carrinho
    $total_produto = 0;
    if (isset($_SESSION['carrinho'])) {
        foreach($_SESSION['carrinho'] as $quantidade){
            $total_produto += $quantidade;
        }
    }
?>

<div class="container-fluid navegacao">
    <div class="row">
        <div class="col-6 p-3 ">
           <a href="?a=inicio">
                <h3><?=APP_NAME;?></h3>
           </a> 
        </div>
        <div class="col-6 p-3 text-end">
            <a href="?a=inicio" class="nav-item">Inicio</a>
            <a href="?a=loja" class="nav-item">Loja</a>

            <!-- Verifica se existe cliente na sessao -->

            <?php if (Store::clientelogado()): ?>
                <!-- <a href="" class="nav-item">A minha conta</a> -->
                <i class="fas fa-user"></i> <?=$_SESSION['usuario'];?>
                <a href="?a=logout" class="nav-item"><i class="fas fa-sign-out-alt"></i></a>
            <?php else: ?>
                <a href="?a=login" class="nav-item">Login</a>
                <a href="?a=novo_cliente" class="nav-item">Criar conta</a>

            <?php endif;?>
            <a href="?a=carrinho"><i class="fa-solid fa-cart-shopping"></i></a>
            <!-- Condicao para apresentar a quantidade no carrinho-->
            <span class="bagde bg-warning" id="carrinhooo"><?= $total_produto == 0 ? '' : $total_produto  ?></span>
        </div>
    </div>
</div>