(function() {

    var main_content = $("#main_content");
    var btn_ver_pedido = main_content.find(".btn-ver-pedido");

    btn_ver_pedido.on("click", function(event) {

        event.preventDefault();

        var id = $(this).attr("data-id");

        $.ajax({
            url: "/pedidos/show/"+id,
            type: "POST",
            dataType: "json",
            success: function(retorno) {
                // console.log(retorno);

                var pedido = "<table class='ui very basic collapsing celled table'>";

				pedido += "<thead>";
				  pedido += "<tr>";
				    pedido += "<th></th>";
				    pedido += "<th>Produto</th>";
				    pedido += "<th>Valor</th>";
				    pedido += "<th>Qtde</th>";
				    pedido += "<th>Subtotal</th>";
				  pedido += "</tr>";
				pedido += "</thead>";

                numeral.language('pt-br');

				pedido += "<tbody>";

                $.each(retorno, function(key, value) {
                    pedido += "<tr>";
                      pedido += "<td><img src='"+value.produtos.produto_foto+"' width='30' height='30' /></td>";
                      pedido += "<td>"+value.produtos.produto_nome+"</td>";
                      pedido += "<td>"+numeral(value.valor).format("$0,0.00")+"</td>";
                      pedido += "<td>"+value.qtd+"</td>";
                      pedido += "<td>"+numeral(value.subtotal).format("$0,0.00")+"</td>";
                    pedido += "</tr>";
                });

                pedido += "</tbody>";

				pedido += "</table>";

                alertHTML('<h2>Meu Pedido</h2>', pedido, 'ver-pedidos');

            }
        });

    });

})();
