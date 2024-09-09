$(document).ready(function() {

    var main_content = $("#main_content");
    var btn_calcular_frete = main_content.find("#btn-calcular-frete");
    var input_frete = main_content.find("#input-frete");
    var mensagem_frete = main_content.find(".mensagem-frete");

    btn_calcular_frete.on("click", function(event) {

        event.preventDefault();

        var frete = input_frete.val();

        $.ajax({
            url: "/frete/calcular",
            type: "POST",
            data: "frete=" + frete,
            dataType: "json",
            beforeSend: function() {
                mensagem_frete.html("Calculando o frete");
            },
            success: function(retorno) {
                console.log(retorno);
            }
        });

    });

});
