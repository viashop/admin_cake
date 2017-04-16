<?php
/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 16/10/16 às 18:12
 */

namespace AppVialoja\Traits\Entity;


trait TWizard
{
     private $passo;

    /**
     * @return mixed
     */
    public function getPasso()
    {
        return $this->passo;
    }

    /**
     * @param mixed $passo
     */
    public function setPasso(int $passo)
    {
        $this->passo = $passo;
    }


}