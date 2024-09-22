(function() {

    var main_content = $("#main_content");
    var center_content = main_content.find(".center_content");
    var message = center_content.find("#message");
    var email = center_content.find("#email_esqueci_senha");
    var btn_esqueci_senha = center_content.find("#btn-esqueci-senha");

    btn_esqueci_senha.on("click", function(event) {

        event.preventDefault();

        var emailEsqueciSenha = email.val();

        $.ajax({
            url: "/esqueci/send",
            data: "email="+emailEsqueciSenha,
            type: "POST",
            beforeSend: function() {
                message.html("Recuperando dados, aguarde...");
            },
            success: function(retorno) {

                if(retorno == "enviado") {

                    message.html("");
                    alert("Enviado o email para redefinir a senha com sucesso!");

                }

                if(retorno == "user" || retorno == "erroValidate") {

                    message.html("");
                    location.reload();

                }

            }
        });

    });

})();
