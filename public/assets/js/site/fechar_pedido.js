$(document).ready(function() {

    var main_content = $("#main_content");
    var center_content = main_content.find(".center_content");
    var btn_fechar_pedido = center_content.find("#btn-fechar-pedido");

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
            }
        });

    });

});
