<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h3>Carrinho</h3>
            <button onclick="limpar_carrinho()">Limpar</button>
            <pre>
                <?php
                    print_r($_SESSION);
                ?>
            </pre>
        </div>
    </div>
</div>