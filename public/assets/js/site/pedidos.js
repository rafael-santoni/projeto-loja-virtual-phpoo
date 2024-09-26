(function() {

    var main_content = $("#main_content");
    var btn_ver_pedido = main_content.find(".btn-ver-pedido");

    btn_ver_pedido.on("click", function(event) {

        event.preventDefault();

        var id = $(this).attr("data-id");

        $.ajax({
            url: "/pedidos/show/"+id,
            type: "POST",
            // dataType: "json",
            success: function(retorno) {
                console.log(retorno);

                var pedido = "<table class='ui very basic collapsing celled table'>";
				pedido += "<thead>";
				pedido += "<tr><th></th>";
				pedido += "<th>Produto</th>";
				pedido += "<th>Valor</th>";
				pedido += "<th>Qtde</th>";
				pedido += "<th>Subtotal</th>";
				pedido += "</tr>";
				pedido += "</thead>";

				pedido += "<tbody>";

            }
        });

    });

})();
