function adicionar_carrinho(id_produto) {
    // console.log(id_produto);

    // Informa ao AXIO para trabalhar com toda legitimidade
    axios.defaults.withCredentials = true;

    // Chamada de AXAX (pedido)
    axios.get("?a=adicionar_carrinho&id_produto=" + id_produto)
        //resposta
        .then(function(response){
            // console.log(response.data)
            var total_produtos = response.data;

            document.getElementById('carrinhooo').innerText = total_produtos;
        })
}