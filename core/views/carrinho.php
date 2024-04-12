<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h3>Carrinho</h3>
            <a href="?a=limpar_carrinho" class="btn btn-sm btn-primary">Limpar carrinho</a>

            <div class="container">
                <div class="row">
                    <div class="col">
                        
                        <?php if($carrinho == null): ?>
                            <p>Carrinho vazio</p>
                            <a href="?a=loja" class="btn btn-sm btn-primary">Loja</a>
                        <?php else:?>
                            <pre>
                                <?php
                                    print_r($_SESSION);
                                ?>
                            </pre>
                        <?php endif;?>
                     </div>
                </div>
            </div>
        </div>
    </div>
</div>