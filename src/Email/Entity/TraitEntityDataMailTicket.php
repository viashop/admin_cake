<?php
/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 28/09/16 às 21:02
 */

namespace Email\Entity;


trait TraitEntityDataMailTicket
{

    /**
     * @var string
     */
    private $text;
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $hash;
    /**
     * @var string
     */
    private $nome;
    /**
     * @var string
     */
    private $nomeLoja;
    /**
     * @var string
     */
    private $linkLoja;
    /**
     * @var string
     */
    private $mensagem;
    /**
     * @var int
     */
    private $departamento;
    /**
     * @var int
     */
    private $prioridade;

    /**
     * @var int
     */
    private $status;
    /**
     * @var string
     */
    private $url;
    /**
     * @var string
     */
    private $msDetalhe;
    /**
     * @var string
     */
    private $funcao;
    /**
     * @var string
     */
    private $assunto;
    /**
     * @var string
     */
    private $resposta;
    /**
     * @var string
     */
    private $saudacaoAdmin = null;

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     * @return $this
     */
    public function setText(string $text)
    {
        $this->text = $text;
        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setId(int $id)
    {
        $this->id = $id;
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
    public function getNomeLoja()
    {
        return $this->nomeLoja;
    }

    /**
     * @param string $nomeLoja
     * @return $this
     */
    public function setNomeLoja(string $nomeLoja)
    {
        $this->nomeLoja = $nomeLoja;
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

    /**
     * @return int
     */
    public function getDepartamento()
    {
        return $this->departamento;
    }

    /**
     * @param int $departamento
     * @return $this
     */
    public function setDepartamento(int $departamento)
    {
        $this->departamento = $departamento;
        return $this;
    }

    /**
     * @return int
     */
    public function getPrioridade()
    {
        return $this->prioridade;
    }

    /**
     * @param int $prioridade
     * @return $this
     */
    public function setPrioridade(int $prioridade)
    {
        $this->prioridade = $prioridade;
        return $this;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $status
     * @return $this
     */
    public function setStatus(int $status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return $this
     */
    public function setUrl(string $url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return string
     */
    public function getMsDetalhe()
    {
        return $this->msDetalhe;
    }

    /**
     * @param string $msDetalhe
     * @return $this
     */
    public function setMsDetalhe(string $msDetalhe)
    {
        $this->msDetalhe = $msDetalhe;
        return $this;
    }

    /**
     * @return string
     */
    public function getFuncao()
    {
        return $this->funcao;
    }

    /**
     * @param string $funcao
     * @return $this
     */
    public function setFuncao(string $funcao)
    {
        $this->funcao = $funcao;
        return $this;
    }

    /**
     * @return string
     */
    public function getAssunto()
    {
        return $this->assunto;
    }

    /**
     * @param string $assunto
     * @return $this
     */
    public function setAssunto(string $assunto)
    {
        $this->assunto = $assunto;
        return $this;
    }

    /**
     * @return string
     */
    public function getResposta()
    {
        return $this->resposta;
    }

    /**
     * @param string $resposta
     * @return $this
     */
    public function setResposta(string $resposta)
    {
        $this->resposta = $resposta;
        return $this;
    }

    /**
     * @return string
     */
    public function getSaudacaoAdmin()
    {
        return $this->saudacaoAdmin;
    }

    /**
     * @param string $saudacaoAdmin
     * @return $this
     */
    public function setSaudacaoAdmin(string $saudacaoAdmin)
    {
        $this->saudacaoAdmin = $saudacaoAdmin;
        return $this;
    }

}