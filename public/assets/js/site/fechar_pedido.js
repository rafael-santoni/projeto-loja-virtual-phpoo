$(document).ready(function() {

    var main_content = $("#main_content");
    var center_content = main_content.find(".center_content");
    var btn_fechar_pedido = center_content.find("#btn-fechar-pedido");
    var input_frete = center_content.find("#input-frete");

    btn_fechar_pedido.on("click", function(event) {

        event.preventDefault();

        $.ajax({
            url: "/checkout",
            dataType: "json",
            beforeSend: function() {
                $(btn_fechar_pedido).text("Fechando pedido...");
            },
            success: function(retorno) {
                console.log(retorno);

                if(retorno == "empty") {

                    $(btn_fechar_pedido).text("Fechar Pedido");
                    alert("Você precisa ter algum produto no carrinho para fechar o pedido!");


                }

                if(retorno == "notLoggedIn") {

                    $(btn_fechar_pedido).text("Fechar Pedido");
                    alert("Você precisa estar logado para finalizar a compra!");
                    window.location.href = '/login';

                }

                if(retorno == "frete") {

                    $(btn_fechar_pedido).text("Fechar Pedido");
                    alert("Você precisa calcular o frete para finalizar a compra!");
                    $(input_frete).focus();

                }

                if(retorno.redirecionar == "sim") {
                    window.location.href = retorno.url;
                }

            }
        });

    });

});
