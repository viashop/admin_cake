<?php
/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 27/09/16 às 01:08
 */

namespace AppVialoja\Traits\Entity;


trait TShop
{

    private $id_shop;
    private $id_shop_grupo;
    private $id_plano;
    private $id_cliente;
    private $loja_tipo;
    private $nome_loja;
    private $descricao;
    private $loja_razao_social;
    private $loja_nome_responsavel;
    private $loja_cnpj;
    private $loja_cpf;
    private $email;
    private $telefone;
    private $id_categoria;
    private $id_theme;
    private $logo;
    private $logo_social;
    private $favicon;
    private $background;
    private $modo;
    private $copiar_dados;
    private $ativo;
    private $habilitar_mobile;
    private $manutencao;
    private $numero_pedido;
    private $numero_minimo_pedido;
    private $pedido_valor_minimo;
    private $valor_produto_restrito;
    private $gerenciar_cliente;
    private $comentarios_produtos;
    private $blog;
    private $preferencia_url_dominio;
    private $ativar_novos_planos;
    private $conta_cancelada;

    /**
     * @return mixed
     */
    public function getIdShop()
    {
        return $this->id_shop;
    }

    /**
     * @param int $id_shop
     * @return $this
     */
    public function setIdShop(int $id_shop)
    {
        $this->id_shop = $id_shop;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdShopGrupo()
    {
        return $this->id_shop_grupo;
    }

    /**
     * @param int $id_shop_grupo
     * @return $this
     */
    public function setIdShopGrupo(int $id_shop_grupo)
    {
        $this->id_shop_grupo = $id_shop_grupo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdPlano()
    {
        return $this->id_plano;
    }

    /**
     * @param int $id_plano
     * @return $this
     */
    public function setIdPlano(int $id_plano)
    {
        $this->id_plano = $id_plano;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdCliente()
    {
        return $this->id_cliente;
    }

    /**
     * @param int $id_cliente
     * @return $this
     */
    public function setIdCliente(int $id_cliente)
    {
        $this->id_cliente = $id_cliente;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLojaTipo()
    {
        return $this->loja_tipo;
    }

    /**
     * @param mixed $loja_tipo
     * @return $this
     */
    public function setLojaTipo($loja_tipo)
    {
        $this->loja_tipo = $loja_tipo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNomeLoja()
    {
        return $this->nome_loja;
    }

    /**
     * @param mixed $nome_loja
     * @return $this
     */
    public function setNomeLoja($nome_loja)
    {
        $this->nome_loja = $nome_loja;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @param mixed $descricao
     * @return $this
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLojaRazaoSocial()
    {
        return $this->loja_razao_social;
    }

    /**
     * @param mixed $loja_razao_social
     * @return $this
     */
    public function setLojaRazaoSocial($loja_razao_social)
    {
        $this->loja_razao_social = $loja_razao_social;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLojaNomeResponsavel()
    {
        return $this->loja_nome_responsavel;
    }

    /**
     * @param mixed $loja_nome_responsavel
     * @return $this
     */
    public function setLojaNomeResponsavel($loja_nome_responsavel)
    {
        $this->loja_nome_responsavel = $loja_nome_responsavel;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLojaCnpj()
    {
        return $this->loja_cnpj;
    }

    /**
     * @param mixed $loja_cnpj
     * @return $this
     */
    public function setLojaCnpj($loja_cnpj)
    {
        $this->loja_cnpj = $loja_cnpj;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLojaCpf()
    {
        return $this->loja_cpf;
    }

    /**
     * @param mixed $loja_cpf
     * @return $this
     */
    public function setLojaCpf($loja_cpf)
    {
        $this->loja_cpf = $loja_cpf;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTelefone()
    {
        return $this->telefone;
    }

    /**
     * @param mixed $telefone
     * @return $this
     */
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdCategoria()
    {
        return $this->id_categoria;
    }

    /**
     * @param mixed $id_categoria
     * @return $this
     */
    public function setIdCategoria($id_categoria)
    {
        $this->id_categoria = $id_categoria;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdTheme()
    {
        return $this->id_theme;
    }

    /**
     * @param mixed $id_theme
     * @return $this
     */
    public function setIdTheme($id_theme)
    {
        $this->id_theme = $id_theme;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * @param mixed $logo
     * @return $this
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLogoSocial()
    {
        return $this->logo_social;
    }

    /**
     * @param mixed $logo_social
     * @return $this
     */
    public function setLogoSocial($logo_social)
    {
        $this->logo_social = $logo_social;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFavicon()
    {
        return $this->favicon;
    }

    /**
     * @param mixed $favicon
     * @return $this
     */
    public function setFavicon($favicon)
    {
        $this->favicon = $favicon;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBackground()
    {
        return $this->background;
    }

    /**
     * @param mixed $background
     * @return $this
     */
    public function setBackground($background)
    {
        $this->background = $background;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getModo()
    {
        return $this->modo;
    }

    /**
     * @param mixed $modo
     * @return $this
     */
    public function setModo($modo)
    {
        $this->modo = $modo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCopiarDados()
    {
        return $this->copiar_dados;
    }

    /**
     * @param mixed $copiar_dados
     * @return $this
     */
    public function setCopiarDados($copiar_dados)
    {
        $this->copiar_dados = $copiar_dados;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAtivo()
    {
        return $this->ativo;
    }

    /**
     * @param mixed $ativo
     * @return $this
     */
    public function setAtivo($ativo)
    {
        $this->ativo = $ativo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHabilitarMobile()
    {
        return $this->habilitar_mobile;
    }

    /**
     * @param mixed $habilitar_mobile
     * @return $this
     */
    public function setHabilitarMobile($habilitar_mobile)
    {
        $this->habilitar_mobile = $habilitar_mobile;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getManutencao()
    {
        return $this->manutencao;
    }

    /**
     * @param mixed $manutencao
     * @return $this
     */
    public function setManutencao($manutencao)
    {
        $this->manutencao = $manutencao;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNumeroPedido()
    {
        return $this->numero_pedido;
    }

    /**
     * @param mixed $numero_pedido
     * @return $this
     */
    public function setNumeroPedido($numero_pedido)
    {
        $this->numero_pedido = $numero_pedido;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNumeroMinimoPedido()
    {
        return $this->numero_minimo_pedido;
    }

    /**
     * @param mixed $numero_minimo_pedido
     * @return $this
     */
    public function setNumeroMinimoPedido($numero_minimo_pedido)
    {
        $this->numero_minimo_pedido = $numero_minimo_pedido;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPedidoValorMinimo()
    {
        return $this->pedido_valor_minimo;
    }

    /**
     * @param mixed $pedido_valor_minimo
     * @return $this
     */
    public function setPedidoValorMinimo($pedido_valor_minimo)
    {
        $this->pedido_valor_minimo = $pedido_valor_minimo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValorProdutoRestrito()
    {
        return $this->valor_produto_restrito;
    }

    /**
     * @param mixed $valor_produto_restrito
     * @return $this
     */
    public function setValorProdutoRestrito($valor_produto_restrito)
    {
        $this->valor_produto_restrito = $valor_produto_restrito;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGerenciarCliente()
    {
        return $this->gerenciar_cliente;
    }

    /**
     * @param mixed $gerenciar_cliente
     * @return $this
     */
    public function setGerenciarCliente($gerenciar_cliente)
    {
        $this->gerenciar_cliente = $gerenciar_cliente;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getComentariosProdutos()
    {
        return $this->comentarios_produtos;
    }

    /**
     * @param mixed $comentarios_produtos
     * @return $this
     */
    public function setComentariosProdutos($comentarios_produtos)
    {
        $this->comentarios_produtos = $comentarios_produtos;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBlog()
    {
        return $this->blog;
    }

    /**
     * @param mixed $blog
     * @return $this
     */
    public function setBlog($blog)
    {
        $this->blog = $blog;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPreferenciaUrlDominio()
    {
        return $this->preferencia_url_dominio;
    }

    /**
     * @param mixed $preferencia_url_dominio
     * @return $this
     */
    public function setPreferenciaUrlDominio($preferencia_url_dominio)
    {
        $this->preferencia_url_dominio = $preferencia_url_dominio;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAtivarNovosPlanos()
    {
        return $this->ativar_novos_planos;
    }

    /**
     * @param mixed $ativar_novos_planos
     * @return $this
     */
    public function setAtivarNovosPlanos($ativar_novos_planos)
    {
        $this->ativar_novos_planos = $ativar_novos_planos;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getContaCancelada()
    {
        return $this->conta_cancelada;
    }

    /**
     * @param mixed $conta_cancelada
     * @return $this
     */
    public function setContaCancelada($conta_cancelada)
    {
        $this->conta_cancelada = $conta_cancelada;
        return $this;
    }

}