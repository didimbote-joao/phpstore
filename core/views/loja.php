<?php //$produto = $produtos[0]; ?>

<div class="container espaco-fundo">
   <!-- Titulo -->
    <div class="row">
        <div class="col-12 text-center my-3">
            <a href="?a=loja&c=todos" class="btn btn-primary">Produtos</a>
            <a href="?a=loja&c=homem" class="btn btn-warning">Homem</a>
            <a href="?a=loja&c=mulher" class="btn btn-success">Mulher</a>
        </div>
    </div>
    <!-- Produtos -->
    
    <div class="row">
    <?php foreach($produtos as $produto): ?>
        <div class="col-sm-4 col-6 p-2">
            <div class="text-center p-3 box-produto">
                <img class="img-fluid" src="assets/images/produtos/<?= $produto->imagem;?>" >
               <p><?=$produto->nome_produto;?></p>
               <p><?=$produto->preco;?></p>
               <div>
                <button>Adicionar ao carrinho</button>
               </div>
            </div>
        </div>
        <?php endforeach;?>
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