<?php
/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.0
 * Date: 05/10/16 às 22:15
 */

namespace Lib;


class CalculaTempoDatetime
{

    private $diff;
    private $ano;
    private $mes;
    private $dia;
    private $hora;
    private $minuto;
    private $segundo;

    /**
     * Retorna o calculo de diferença entre datas
     * @param string $date
     * @return mixed
     */
    public function calculaTempo($date='')
    {
        $date_time  = new \DateTime(date('Y-m-d H:i:s'));
        $this->diff = $date_time->diff( new \DateTime($date) );
        return self::retornaCalculoTempo();
    }

    private function calculaAno()
    {

        $ano = (int) $this->diff->format('%Y');
        if ($ano <=1)
            $this->ano = $ano . ' ano atrás';
        else
            $this->ano = $ano . ' anos atrás';

    }

    private function calculaMes()
    {

        $mes = (int) $this->diff->format('%m');
        if ($mes <=1)
            $this->mes = $mes . ' mes atrás';
        else
            $this->mes = $mes . ' meses atrás';

    }

    private function calculaDia()
    {

        $dia = (int) $this->diff->format('%d');
        if ($dia <=1)
            $this->dia = $dia . ' dia atrás';
        else
            $this->dia = $dia . ' dias atrás';

    }

    private function calculaHora()
    {

        $hora = (int) $this->diff->format('%H');
        if ($hora <=1)
            $this->hora = $hora . ' hora atrás';
        else
            $this->hora = $hora . ' horas atrás';

    }

    private function calculaMinuto()
    {

        $minuto = (int) $this->diff->format('%i');
        if ($minuto <=1)
            $this->minuto = $minuto . ' minuto atrás';
        else
            $this->minuto = $minuto . ' minutos atrás';

    }

    private function calculaSegundo()
    {

        $segundo = (int) $this->diff->format('%s');
        if ($segundo <=1)
            $this->segundo = $segundo . ' segundo atrás';
        else
            $this->segundo = $segundo . ' segundos atrás';

    }

    private function retornaCalculoTempo()
    {

        self::calculaAno();
        self::calculaMes();
        self::calculaDia();
        self::calculaHora();
        self::calculaMinuto();
        self::calculaSegundo();

        if( intval($this->ano) > 0 )
            return $this->ano;

        if( intval($this->mes) > 0 )
            return $this->mes;

        if( intval($this->dia) > 0 )
            return $this->dia;

        if( intval($this->hora) > 0 )
            return $this->hora;

        if( intval($this->minuto) > 0 )
            return $this->minuto;

        if( intval($this->segundo) > 0 )
            return $this->segundo;

    }

}