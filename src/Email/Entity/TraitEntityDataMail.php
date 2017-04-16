<?php
/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 28/09/16 às 21:01
 */

namespace Email\Entity;


trait TraitEntityDataMail
{
    /** Atributos Default */
    private $nome;
    /**
     * @var string $lojaNome
     */
    private $lojaNome;
    /**
     * @var string $email
     */
    private $email;
    /**
     * @var string $senha
     */
    private $senha;
    /**
     * @var string $hash
     */
    private $hash;
    /**
     * @var string $linkLoja
     */
    private $linkLoja;
    /**
     * @var string $aceitar
     */
    private $aceitar;
    /**
     * @var string $recusar
     */
    private $recusar;

    /**
     * Atributos -> Sem uso de Themes e Layout
     * @var string $nomeResponsavel -> Referente Contato Loja
     */
    private $nomeResponsavel;
    /**
     * Atributos -> Sem uso de Themes e Layout
     * @var string $telefone -> Referente Contato Loja
     */
    private $telefone;

    /**
     * Atributos -> Sem uso de Themes e Layout
     * @var string $pedido -> Referente Contato Loja
     */
    private $pedido;
    /**
     * Atributos -> Sem uso de Themes e Layout
     * @var string $mensagem -> Referente Contato Loja
     */
    private $mensagem;

    /**
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param string $nome
     * @return $this
     */
    public function setNome(string $nome)
    {
        $this->nome = $nome;
        return $this;
    }

    /**
     * @return string
     */
    public function getLojaNome()
    {
        return $this->lojaNome;
    }

    /**
     * @param string $lojaNome
     * @return $this
     */
    public function setLojaNome(string $lojaNome)
    {
        $this->lojaNome = $lojaNome;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return $this
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * @param string $senha
     * @return $this
     */
    public function setSenha(string $senha)
    {
        $this->senha = $senha;
        return $this;
    }

    /**
     * @return string
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * @param string $hash
     * @return $this
     */
    public function setHash(string $hash)
    {
        $this->hash = $hash;
        return $this;
    }

    /**
     * @return string
     */
    public function getLinkLoja()
    {
        return $this->linkLoja;
    }

    /**
     * @param string $linkLoja
     * @return $this
     */
    public function setLinkLoja(string $linkLoja)
    {
        $this->linkLoja = $linkLoja;
        return $this;
    }

    /**
     * @return string
     */
    public function getAceitar()
    {
        return $this->aceitar;
    }

    /**
     * @param string $aceitar
     * @return $this
     */
    public function setAceitar(string $aceitar)
    {
        $this->aceitar = $aceitar;
        return $this;
    }

    /**
     * @return string
     */
    public function getRecusar()
    {
        return $this->recusar;
    }

    /**
     * @param string $recusar
     * @return $this
     */
    public function setRecusar(string $recusar)
    {
        $this->recusar = $recusar;
        return $this;
    }

    /**
     * @return string
     */
    public function getNomeResponsavel()
    {
        return $this->nomeResponsavel;
    }

    /**
     * @param string $nomeResponsavel
     * @return $this
     */
    public function setNomeResponsavel(string $nomeResponsavel)
    {
        $this->nomeResponsavel = $nomeResponsavel;
        return $this;
    }

    /**
     * @return string
     */
    public function getTelefone()
    {
        return $this->telefone;
    }

    /**
     * @param string $telefone
     * @return $this
     */
    public function setTelefone(string $telefone)
    {
        $this->telefone = $telefone;
        return $this;
    }

    /**
     * @return string
     */
    public function getPedido()
    {
        return $this->pedido;
    }

    /**
     * @param string $pedido
     * @return $this
     */
    public function setPedido(string $pedido)
    {
        $this->pedido = $pedido;
        return $this;
    }

    /**
     * @return string
     */
    public function getMensagem()
    {
        return $this->mensagem;
    }

    /**
     * @param string $mensagem
     * @return $this
     */
    public function setMensagem(string $mensagem)
    {
        $this->mensagem = $mensagem;
        return $this;
    }

}