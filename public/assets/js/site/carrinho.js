$(document).ready(function() {

    var main_content = $("#main_content");
    var center_content = main_content.find(".center_content");
    var shopping_cart = main_content.find(".shopping_cart");
    var products_cart = shopping_cart.find("#products_cart");
    var price_cart = shopping_cart.find(".price");
    var btn_add_carrinho = center_content.find(".btn-add-carrinho");

    function totalProdutosCarrinho() {
        return $.ajax({
            url: "/carrinho/get",
            dataType: "json",
            success: function(retorno) {
                numeral.language("pt-br");
                products_cart.html(retorno.numeroProdutosCarrinho);
                price_cart.html(numeral(retorno.valorProdutosCarrinho).format("$0,0.00"));
            }
        });
    }

    btn_add_carrinho.on("click", function(event) {

        event.preventDefault();

        var idProduto = $(this).attr("data-id");

        $.ajax({
            url:"/carrinho/add/"+idProduto,
            type: "POST",
            success: function() {
                totalProdutosCarrinho();
            }
        });

    });

});
