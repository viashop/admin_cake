<?php
/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 27/09/16 às 01:18
 */

namespace AppVialoja\Traits\Entity;


trait TShopEnvio
{

    private $id_envio;
    private $ativo;
    private $limite_peso;

    /**
     * @return mixed
     */
    public function getIdEnvio()
    {
        return $this->id_envio;
    }

    /**
     * @param mixed $id_envio
     * @return $this
     */
    public function setIdEnvio($id_envio)
    {
        $this->id_envio = $id_envio;
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
     * @param string $ativo
     * @return $this
     */
    public function setAtivo(string $ativo)
    {
        $this->ativo = $ativo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLimitePeso()
    {
        return $this->limite_peso;
    }

    /**
     * @param int $limite_peso
     * @return $this
     */
    public function setLimitePeso(int $limite_peso)
    {
        $this->limite_peso = $limite_peso;
        return $this;
    }

}