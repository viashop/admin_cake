<?php
/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 17/10/16 às 14:54
 */

namespace AppVialoja\Traits\Entity;


trait TCliente
{

    private $id_cliente;
    private $id_shop_grupo;
    private $id_shop;
    private $id_grupo;
    private $id_default_grupo;
    private $tipo_cadastro;
    private $id_sexo;
    private $nome;
    private $email;
    private $senha;
    private $nivel;
    private $ativo;
    private $cpf;
    private $rg;
    private $cnpj;
    private $razao_social;
    private $info_tributo;
    private $telefone_celular;
    private $telefone_residencial;
    private $telefone_comercial;
    private $data_nasc;
    private $ie;
    private $responsavel;
    private $aliases;
    private $receber_ofertas_shopping;
    private $ip;
    private $security_key;
    private $ultima_troca_senha;
    private $conta_auto_login;
    private $black_list;
    private $data_black_list;
    private $boletim_shopping;
    private $up_nivel_validar;

    /**
     * @return int
     */
    public function getIdCliente()
    {
        return $this->id_cliente;
    }

    /**
     * @param int $id_cliente
     * @return TCliente
     */
    public function setIdCliente(int $id_cliente)
    {
        $this->id_cliente = $id_cliente;
        return $this;
    }

    /**
     * @return int
     */
    public function getIdShopGrupo()
    {
        return $this->id_shop_grupo;
    }

    /**
     * @param int $id_shop_grupo
     * @return TCliente
     */
    public function setIdShopGrupo(int $id_shop_grupo)
    {
        $this->id_shop_grupo = $id_shop_grupo;
        return $this;
    }

    /**
     * @return int
     */
    public function getIdShop()
    {
        return $this->id_shop;
    }

    /**
     * @param int $id_shop
     * @return TCliente
     */
    public function setIdShop(int $id_shop)
    {
        $this->id_shop = $id_shop;
        return $this;
    }

    /**
     * @return int
     */
    public function getIdGrupo()
    {
        return $this->id_grupo;
    }

    /**
     * @param int $id_grupo
     * @return TCliente
     */
    public function setIdGrupo(int $id_grupo)
    {
        $this->id_grupo = $id_grupo;
        return $this;
    }

    /**
     * @return int
     */
    public function getIdDefaultGrupo()
    {
        return $this->id_default_grupo;
    }

    /**
     * @param int $id_default_grupo
     * @return TCliente
     */
    public function setIdDefaultGrupo(int $id_default_grupo)
    {
        $this->id_default_grupo = $id_default_grupo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTipoCadastro()
    {
        return $this->tipo_cadastro;
    }

    /**
     * @param mixed $tipo_cadastro
     * @return TCliente
     */
    public function setTipoCadastro($tipo_cadastro)
    {
        $this->tipo_cadastro = $tipo_cadastro;
        return $this;
    }

    /**
     * @return int
     */
    public function getIdSexo()
    {
        return $this->id_sexo;
    }

    /**
     * @param int $id_sexo
     * @return TCliente
     */
    public function setIdSexo(int $id_sexo)
    {
        $this->id_sexo = $id_sexo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     * @return TCliente
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
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
     * @return TCliente
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * @param mixed $senha
     * @return TCliente
     */
    public function setSenha($senha)
    {
        $this->senha = $senha;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNivel()
    {
        return $this->nivel;
    }

    /**
     * @param mixed $nivel
     * @return TCliente
     */
    public function setNivel(int $nivel)
    {
        $this->nivel = $nivel;
        return $this;
    }

    /**
     * @return int
     */
    public function getAtivo()
    {
        return $this->ativo;
    }

    /**
     * @param int $ativo
     * @return TCliente
     */
    public function setAtivo(int $ativo)
    {
        $this->ativo = $ativo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * @param mixed $cpf
     * @return TCliente
     */
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRg()
    {
        return $this->rg;
    }

    /**
     * @param mixed $rg
     * @return TCliente
     */
    public function setRg($rg)
    {
        $this->rg = $rg;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCnpj()
    {
        return $this->cnpj;
    }

    /**
     * @param mixed $cnpj
     * @return TCliente
     */
    public function setCnpj($cnpj)
    {
        $this->cnpj = $cnpj;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRazaoSocial()
    {
        return $this->razao_social;
    }

    /**
     * @param mixed $razao_social
     * @return TCliente
     */
    public function setRazaoSocial($razao_social)
    {
        $this->razao_social = $razao_social;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getInfoTributo()
    {
        return $this->info_tributo;
    }

    /**
     * @param mixed $info_tributo
     * @return TCliente
     */
    public function setInfoTributo($info_tributo)
    {
        $this->info_tributo = $info_tributo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTelefoneCelular()
    {
        return $this->telefone_celular;
    }

    /**
     * @param mixed $telefone_celular
     * @return TCliente
     */
    public function setTelefoneCelular($telefone_celular)
    {
        $this->telefone_celular = $telefone_celular;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTelefoneResidencial()
    {
        return $this->telefone_residencial;
    }

    /**
     * @param mixed $telefone_residencial
     * @return TCliente
     */
    public function setTelefoneResidencial($telefone_residencial)
    {
        $this->telefone_residencial = $telefone_residencial;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTelefoneComercial()
    {
        return $this->telefone_comercial;
    }

    /**
     * @param mixed $telefone_comercial
     * @return TCliente
     */
    public function setTelefoneComercial($telefone_comercial)
    {
        $this->telefone_comercial = $telefone_comercial;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDataNasc()
    {
        return $this->data_nasc;
    }

    /**
     * @param mixed $data_nasc
     * @return TCliente
     */
    public function setDataNasc($data_nasc)
    {
        $this->data_nasc = $data_nasc;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIe()
    {
        return $this->ie;
    }

    /**
     * @param mixed $ie
     * @return TCliente
     */
    public function setIe($ie)
    {
        $this->ie = $ie;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getResponsavel()
    {
        return $this->responsavel;
    }

    /**
     * @param mixed $responsavel
     * @return TCliente
     */
    public function setResponsavel($responsavel)
    {
        $this->responsavel = $responsavel;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAliases()
    {
        return $this->aliases;
    }

    /**
     * @param mixed $aliases
     * @return TCliente
     */
    public function setAliases($aliases)
    {
        $this->aliases = $aliases;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getReceberOfertasShopping()
    {
        return $this->receber_ofertas_shopping;
    }

    /**
     * @param mixed $receber_ofertas_shopping
     * @return TCliente
     */
    public function setReceberOfertasShopping($receber_ofertas_shopping)
    {
        $this->receber_ofertas_shopping = $receber_ofertas_shopping;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @param mixed $ip
     * @return TCliente
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSecurityKey()
    {
        return $this->security_key;
    }

    /**
     * @param mixed $security_key
     * @return TCliente
     */
    public function setSecurityKey($security_key)
    {
        $this->security_key = $security_key;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUltimaTrocaSenha()
    {
        return $this->ultima_troca_senha;
    }

    /**
     * @param mixed $ultima_troca_senha
     * @return TCliente
     */
    public function setUltimaTrocaSenha($ultima_troca_senha)
    {
        $this->ultima_troca_senha = $ultima_troca_senha;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getContaAutoLogin()
    {
        return $this->conta_auto_login;
    }

    /**
     * @param mixed $conta_auto_login
     * @return TCliente
     */
    public function setContaAutoLogin($conta_auto_login)
    {
        $this->conta_auto_login = $conta_auto_login;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBlackList()
    {
        return $this->black_list;
    }

    /**
     * @param mixed $black_list
     * @return TCliente
     */
    public function setBlackList($black_list)
    {
        $this->black_list = $black_list;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDataBlackList()
    {
        return $this->data_black_list;
    }

    /**
     * @param mixed $data_black_list
     * @return TCliente
     */
    public function setDataBlackList($data_black_list)
    {
        $this->data_black_list = $data_black_list;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBoletimShopping()
    {
        return $this->boletim_shopping;
    }

    /**
     * @param mixed $boletim_shopping
     * @return TCliente
     */
    public function setBoletimShopping($boletim_shopping)
    {
        $this->boletim_shopping = $boletim_shopping;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUpNivelValidar()
    {
        return $this->up_nivel_validar;
    }

    /**
     * @param mixed $up_nivel_validar
     * @return TCliente
     */
    public function setUpNivelValidar($up_nivel_validar)
    {
        $this->up_nivel_validar = $up_nivel_validar;
        return $this;
    }

}
