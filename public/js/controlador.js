function carrinhoRemoverProduto(pedidoId, produtoId, id){
    $('#form_remover_produto input[name = "produto_id"]').val(produtoId);
    $('#form_remover_produto input[name = "pedido_id"]').val(pedidoId);
    $('#form_remover_produto input[name = "item"]').val(id);
    $('#form_remover_produto').submit();
}

function carrinhoAdicionarProduto(id) {
    $('#form_adicionar_produto input[name = "id"]').val(id);
    $('#form_adicionar_produto').submit();

}