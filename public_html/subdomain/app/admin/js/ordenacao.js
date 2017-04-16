function Ordenar(elemento_pai, elemento_mover, elemento_nome, url_save) {
  this.init(elemento_pai, elemento_mover, elemento_nome, url_save);
}

Ordenar.prototype.init = function(elemento_pai, elemento_mover, elemento_nome, url_save) {
  this.elemento_pai = elemento_pai;
  this.elemento_mover = elemento_mover;
  this.elemento_nome = elemento_nome;
  this.url_save = url_save;
  this.posicoes_iniciais = '';
  this.posicoes = '';

  /*
   * Popula posicoes_iniciais com os id´s dos elementos na ordem inicial.
   */ 
  for(i = 0; i < $(this.elemento_mover).length; i++) {
    this.posicoes_iniciais += $(this.elemento_mover)[i].getAttribute('data-id') + ( (i+1 == $(this.elemento_mover).length) ? "" : ',');
  }
  this.posicoes = this.posicoes_iniciais;

}

/*
 * Instancia novo sortable para o elemento_pai.
 */
Ordenar.prototype.sortable = function() {
  var self = this;
  $(this.elemento_pai).sortable({
    cursor: 'move',
    placeholder: 'placeholder-drag',
    update: function() {
      self.registraAlteracao();
    }
  });
}

/*
 * Destroy puglin sortable.
 */
Ordenar.prototype.destroySortable = function() {
  $(this.elemento_pai).sortable('destroy');
}

/*
 * Faz ordenacao dos elementos_mover em ordem alfabetica, de acordo com elemento_nome
 */
Ordenar.prototype.ordenaAlfabetica = function() {
  var cont = 0,
      itens_nomes = new Array();

  for(i = 0; i < $(this.elemento_mover).length; i++) {
    itens_nomes[i] = $(this.elemento_nome).eq(i).html().toLowerCase() + '---' + $(this.elemento_nome).eq(i).attr('href');
  }
  itens_nomes.sort();

  while(cont < itens_nomes.length) {
    for(i = 0; i < itens_nomes.length; i++) {
      if(itens_nomes[cont] === undefined || $(this.elemento_nome).eq(i) === undefined) {
        cont = itens_nomes.length;
        break;
      } else {
        if(itens_nomes[cont] == $(this.elemento_nome).eq(i).html().toLowerCase() + '---' + $(this.elemento_nome).eq(i).attr('href')) {
            $(this.elemento_pai).append($(this.elemento_mover).eq(i));
            cont++;
        }
      }
    }
  }
  this.registraAlteracao();
}

/*
 * Atualiza posicoes com a sequencia de id atualiza conforme arvore DOM.
 */
Ordenar.prototype.registraAlteracao = function() {
  this.posicoes = "";

  for(i = 0; i < $(this.elemento_mover).length; i++) {
    this.posicoes += $(this.elemento_mover)[i].getAttribute('data-id') + ( (i+1 == $(this.elemento_mover).length) ? "" : ',');
  }
}

/*
 * Recebe funcao como parametro e executa quando tiver o response.
 */
Ordenar.prototype.salva = function(fnSalvar) {
  if(this.posicoes_iniciais != this.posicoes) {
    var self = this;
    
    $.post(this.url_save, { posicoes: this.posicoes },
      function(data) {
        if(data.estado == 'SUCESSO') {
          // Atualiza posicoes_inicias quando é salvo.
          self.posicoes_iniciais = self.posicoes;
        } 
        fnSalvar(data);
      }, 'json')
      .fail(function() {
        fnSalvar(
          {
            estado: 'ERRO',
            mensagem: 'Não foi possível salvar alterações. Por favor, entre em contato com nossa equipe de suporte'
          }
        );
      });
  } else {
    fnSalvar({ estado: 'SUCESSO', mensagem: 'Não foi feita nenhuma alteração.' })
  }
}
