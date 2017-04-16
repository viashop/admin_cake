$(document).ready(function() {
   //definir evento "onclick" do elemento (botao) ID butEnviar 
   $('#enviar_cep').submit(function(e) {

      e.preventDefault();

      //capturar o valor dos campos do fomulario
      var cep = $('input[name="cep"]').val();
      var preco = $('input[name="preco"]').val();
      var peso = $('input[name="peso"]').val();
      var altura = $('input[name="altura"]').val();
      var largura = $('input[name="largura"]').val();
      var comprimento = $('input[name="comprimento"]').val();
      var produto = $('input[name="produto"]').val();
      var loja = $('input[name="loja"]').val();

      var loading = $(
         '<div class="borda-alpha"><img id="loading" alt="Carregando" title="Carregando" src="/superstore/skin/frontend/default/ves_superstore/images/ajax-loader.gif" /> Aguarde...</div>'
      ).appendTo('div#saida').hide()

      loading.ajaxStart(function() {
         $(this).show();
      });

      loading.ajaxStop(function() {
         $(this).hide();
      });

      //usar o metodo ajax da biblioteca jquery para postar os dados em processar.php
      $.ajax({
         "url": "/cep/calcular/frete",
         "dataType": "html",
         "cache": false,
         "timeout": 8000,
         "data": {
            "cep": cep,
            "preco": preco,
            "peso": peso,
            "altura": altura,
            "largura": largura,
            "comprimento": comprimento,
            "produto": produto,
            "loja": loja
         },
         "success": function(response) {
            //em caso de sucesso, a div ID=saida recebe o response do post
            $("div#saida").html(response);
         }

      });

   });

});
