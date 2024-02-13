<?php //$produto = $produtos[0]; ?>

<div class="container espaco-fundo">
   <!-- Titulo -->
    <div class="row">
        <div class="col-12 text-center my-3">
            <a href="?a=loja&c=todos" class="btn btn-primary">Produtos</a>
            <?php foreach ($categorias as $categoria):?>
                <a href="?a=loja&c=<?=$categoria?>" class="btn btn-primary">
                    <?=ucfirst($categoria);?>
                </a>
            <?php endforeach;?>
        </div>
    </div>
    <!-- Final titulo -->
    
    <!-- Exibe Produtos -->
    
    <div class="row">
        <?php if(count($produtos) == 0):?>
            <h3>Nao tem produtos</h3>
        <?php else:?>
        
            <?php foreach($produtos as $produto): ?>
            <div class="col-sm-4 col-6 p-2">
                <div class="text-center p-3 box-produto">
                    <img class="img-fluid" src="assets/images/produtos/<?= $produto->imagem;?>" >
                <p><?=$produto->nome_produto;?></p>
                <p><?=$produto->preco;?></p>
                <div>
                    <button class="btn btn-success">Adicionar ao carrinho</button>
                </div>
                </div>
            </div>
        <?php endforeach;?>
        <?php endif;?>
    </div>
</div>

<!-- 
[id_produto] => 1
[categoria] => Homem
[nome_produto] => Camisa azul
[descricao] => No âmbito do Sistema Único de Saúde, as transferências de uma unidade hospitalar para outra são intermediadas por centrais reguladoras que alocam os pacientes nas vagas disponíveis. 
[imagem] => camisa_azul.png
[preco] => 2300.50
[stock] => 100
[visivel] => 1
[created_at] => 2024-02-12 18:39:07
[updated_at] => 2024-02-12 18:41:58
[deleted_at] =>
 -->