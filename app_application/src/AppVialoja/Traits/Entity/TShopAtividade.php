<?php
/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 18/10/16 às 17:24
 */

namespace AppVialoja\Traits\Entity;


trait TShopAtividade
{

    private $id_atividade;
    private $id_shop_default;
    private $position;
    private $ativo;

    /**
     * @return int
     */
    public function getIdAtividade()
    {
        return $this->id_atividade;
    }

    /**
     * @param int $id_atividade
     * @return TShopAtividade
     */
    public function setIdAtividade(int $id_atividade)
    {
        $this->id_atividade = $id_atividade;
        return $this;
    }

    /**
     * @return int
     */
    public function getIdShopDefault()
    {
        return $this->id_shop_default;
    }

    /**
     * @param int $id_shop_default
     * @return TShopAtividade
     */
    public function setIdShopDefault(int $id_shop_default)
    {
        $this->id_shop_default = $id_shop_default;
        return $this;
    }

    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param int $position
     * @return TShopAtividade
     */
    public function setPosition(int $position)
    {
        $this->position = $position;
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
     * @return TShopAtividade
     */
    public function setAtivo(int $ativo)
    {
        $this->ativo = $ativo;
        return $this;
    }


}

