<?php

if (isset($frete_gratis)) {

    echo '<ul class="borda-alpha" style="">'. PHP_EOL;
    echo '<li class="frete-gratis">Produto com Frete Grátis<li>'. PHP_EOL;
    echo '</ul>'. PHP_EOL;

    die();

}


if (count($arr_return_frete) > 0) {

    $envio_correios = \Lib\Tools::getArrayKeySpecific('envio_correios', $arr_return_frete);
    $envio_motoboy = \Lib\Tools::getArrayKeySpecific('envio_motoboy', $arr_return_frete);
    $envio_pessoalmente = \Lib\Tools::getArrayKeySpecific('envio_pessoalmente', $arr_return_frete);
    $envio_transportadora =  \Lib\Tools::getArrayKeySpecific('envio_transportadora', $arr_return_frete);
    $envio_personalizado =  \Lib\Tools::getArrayKeySpecific('envio_personalizado', $arr_return_frete);

    if (count($envio_correios)>0 
        || count($envio_motoboy)>0 
        || count($envio_pessoalmente)>0 
        || count($envio_transportadora)>0 || count($envio_personalizado)>0) {


        echo '<ul class="borda-alpha" style="">'. PHP_EOL;
        echo '<li class="borda-botton"><li>';

        if ( \Lib\Validate::isNotNull($envio_formas) && count($envio_correios) > 0 ) {

            foreach ($envio_correios as $key => $servico) {

                foreach ($envio_formas as $key => $forma) {

                    if ($forma['ShopEnvioCorreios']['codigo_servico'] == $servico->Codigo) {
                        $taxa_tipo = $forma['ShopEnvioCorreios']['taxa_tipo'];
                        $taxa_valor = $forma['ShopEnvioCorreios']['taxa_valor'];
                        $prazo_adicional = $forma['ShopEnvioCorreios']['prazo_adicional'];
                        $nome = $forma['CodigoCorreios']['nome'];
                    }
                    
                }

                echo '<li class="borda-botton">';

                if($servico->Erro == 0) {    

                    printf('<span class="nome cor-secundaria">%s</span> ', $nome);

                    $prazo = $servico->PrazoEntrega + 1;
                    if ($prazo_adicional > 0) {
                        $prazo += $prazo_adicional;
                    }

                    if ( $prazo <= 1) {
                        printf('<span class="prazo">Dia da Postagem + %s dia útil</span>', $prazo);
                    } else {
                        printf('<span class="prazo">Dia da Postagem + %s dias úteis</span>', $prazo);
                    } 

                    if ($taxa_tipo == 'fixo') {
                        $valor_final = floatval($servico->Valor) + $taxa_valor;
                    } else {

                        $valor = floatval( $servico->Valor );
                        $percentual   = ( $taxa_valor / 100.0 );
                        $valor_final += ( $percentual * $valor );

                    }                           

                    printf('<span class="valor cor-principal"><strong>R$ </strong>%s</span>', \Lib\Tools::convertToDecimalBR( $valor_final ) );
                                         
                } else {

                   

                }

                echo '</li>';

            }

        }


        /**
         * Frete MotoBoy
         */
        if ( \Lib\Validate::isNotNull($envio_motoboy) ) {

            foreach ($envio_motoboy as $key => $envio) {
                
                $prazo = $envio['ShopEnvioMotoboy']['prazo_entrega'];

                echo '<li class="borda-botton">
                    <span class="nome cor-secundaria">MotoBoy</span>' . PHP_EOL;

                if ( $prazo <= 1) {
                    printf('<span class="prazo">%s dia</span>', $prazo);
                } else {
                    printf('<span class="prazo">%s dias</span>', $prazo);
                }
                    
                echo '<span class="valor cor-principal">R$ '. \Lib\Tools::convertToDecimalBR( $envio['ShopEnvioMotoboy']['valor'] ) .'</span>
                </li>' . PHP_EOL;

            }

        }


        if ( \Lib\Validate::isNotNull($envio_pessoalmente) ) {

            foreach ($envio_pessoalmente as $retirada) {  

                echo '<li class="borda-botton">
                    <span class="nome cor-secundaria">Retirar Pessoalmente</span>
                    <span class="regiao cor-principal"><i style="font-size:12px; font-weight:normal;"> ('. $retirada['ShopEnvioPessoalmente']['regiao'] .')</i></span>
                    <span class="prazo"><strong>R$ 0,00</strong></span> 
                </li>' . PHP_EOL;

            }

        }

        if ( \Lib\Validate::isNotNull($envio_transportadora) ) {

            $calc_kg_adicional_personalizado = false;

            if (array_key_exists('calcular_kg_adicional', $envio_transportadora)){

                $calc_kg_adicional_personalizado = true;

                foreach ($envio_transportadora as $key => $envio) {

                    if ($key !== 'calcular_kg_adicional' && !empty($envio['ShopEnvioTransportadora']['peso_final'])) {

                        $valor = 0;
                        if ( !empty($envio['ShopEnvioTransportadora']['kg_adicional']) ) {

                            $peso_final = $envio['ShopEnvioTransportadora']['peso_final'];              
                            $valor = $envio['ShopEnvioTransportadora']['valor'];                
                            $peso  = round( floatval( \Lib\Tools::getValue('peso') ) );
                            $valor += ( $envio['ShopEnvioTransportadora']['kg_adicional'] * ( $peso - $peso_final ) );

                        }

                        echo '<li class="borda-botton">
                    
                        <span class="nome cor-secundaria">Transportadora

                        <i style="font-size:12px; font-weight:normal;"> ('. $envio['ShopEnvioTransportadora']['regiao'] .')
                        </i></span>' . PHP_EOL;

                        $prazo_entrega = $envio['ShopEnvioTransportadora']['prazo_entrega'];

                        if ( $prazo_entrega <= 1) {
                            printf('<span class="prazo">%s dia</span>', $prazo_entrega);
                        } else {
                            printf('<span class="prazo">%s dias</span>', $prazo_entrega);
                        }

                        printf('<span class="valor cor-principal"><strong>R$ </strong>%s</span>', \Lib\Tools::convertToDecimalBR( $envio['ShopEnvioTransportadora']['valor'] ) );
                       
                        
                        echo '</li>';

                    }

                }

            }


            if ($calc_kg_adicional_personalizado === false ) {

                foreach ($envio_transportadora as $key => $envio) {

                    echo '<li class="borda-botton">

                    <span class="nome cor-secundaria">Transportadora

                    <i style="font-size:12px; font-weight:normal;"> ('. $envio['ShopEnvioTransportadora']['regiao'] .')</i></span>' . PHP_EOL;
                    
                    
                    $prazo_entrega = $envio['ShopEnvioTransportadora']['prazo_entrega'];

                    if ( $prazo_entrega <= 1) {
                        printf('<span class="prazo">%s dia</span>', $prazo_entrega);
                    } else {
                        printf('<span class="prazo">%s dias</span>', $prazo_entrega);
                    }

                    printf('<span class="valor cor-principal"><strong>R$ </strong>%s</span>', \Lib\Tools::convertToDecimalBR( $envio['ShopEnvioTransportadora']['valor'] ) );
                    
                    echo '</li>';

                }

            }

        }


        //Fora da faixa de Cep, efetuar calculo por preco por kg adcional
        if ( \Lib\Validate::isNotNull($envio_personalizado) ) {
    
            $calc_kg_adicional_personalizado = false;

            if (array_key_exists('calcular_kg_adicional', $envio_personalizado)){

                $calc_kg_adicional_personalizado = true;    

                foreach ($envio_personalizado as $key => $envio) {
                
                    if ($key !== 'calcular_kg_adicional' && !empty($envio['ShopEnvioPersonalizadoPeso']['peso_fim'])) {

                        echo '<li class="borda-botton">
                            <span class="nome cor-secundaria">'. $envio['ShopEnvioPersonalizado']['nome'] .'<i style="font-size:12px; font-weight:normal;"> ('. $envio['ShopEnvioPersonalizadoRegiao']['nome'] .'
                            )</i></span>' . PHP_EOL;


                        /**
                         * Acrescenta ao frete 
                         * definido em personalização
                         */                 
                        $prazo_entrega = $envio['ShopEnvioPersonalizadoFaixa']['prazo_entrega'];

                        if ($envio['ShopEnvioPersonalizado']['prazo_adicional'] > 0) {

                            $prazo_entrega += $envio['ShopEnvioPersonalizado']['prazo_adicional'];

                        }

                        if ( $prazo_entrega <= 1) {
                            printf('<span class="prazo">%s dia</span>', $prazo_entrega);
                        } else {
                            printf('<span class="prazo">%s dias</span>', $prazo_entrega);
                        }    

                        $valor = 0;
                        if ( !empty($envio['ShopEnvioPersonalizadoRegiao']['kg_adicional']) ) {

                            $peso_fim = $envio['ShopEnvioPersonalizadoPeso']['peso_fim'];               
                            $valor = $envio['ShopEnvioPersonalizadoPeso']['valor'];             
                            $peso  = round( floatval( \Lib\Tools::getValue('peso') ) );
                            $valor += ( $envio['ShopEnvioPersonalizadoRegiao']['kg_adicional'] * ( $peso - $peso_fim ) );

                        }

                        /**
                         * Acrescenta ao frete 
                         * definido em personalização
                         */
                        if (!empty($envio['ShopEnvioPersonalizado']['taxa_valor'])) {

                            if ($envio['ShopEnvioPersonalizado']['taxa_tipo'] == 'fixo') {

                                $valor += $envio['ShopEnvioPersonalizado']['taxa_valor'];

                            } elseif ($envio['ShopEnvioPersonalizado']['taxa_tipo'] == 'porcentagem') {

                                $percentual = ( $envio['ShopEnvioPersonalizado']['taxa_valor'] / 100.0 );
                                $valor += ( $percentual * $valor );

                            }

                        }

                        /**
                         * Preço por KG adicional
                         * Valor que será pago por KG adicional que ultrapassar o limite de peso desta configuração
                         */                         
                        printf('<span class="valor cor-principal"><strong>R$ </strong>%s</span>', \Lib\Tools::convertToDecimalBR( $valor ) );

                        
                        
                        echo '</li>';

                    }

                    $envio_personalizado = null;

                }
                
            }

            //Dentro da Faixa de Peso
            if ($calc_kg_adicional_personalizado === false) {

                foreach ($envio_personalizado as $key => $envio) {

                    echo '<li class="borda-botton">
                            <span class="nome cor-secundaria">'. $envio['ShopEnvioPersonalizado']['nome'] .'<i style="font-size:12px; font-weight:normal;"> ('. $envio['ShopEnvioPersonalizadoRegiao']['nome'] .')
                            </i></span>' . PHP_EOL; 



                    /**
                     * Acrescenta ao frete 
                     * definido em personalização
                     */                 
                    $prazo_entrega = $envio['ShopEnvioPersonalizadoFaixa']['prazo_entrega'];

                    if ($envio['ShopEnvioPersonalizado']['prazo_adicional'] > 0) {
                        $prazo_entrega += $envio['ShopEnvioPersonalizado']['prazo_adicional'];
                    }

                    if ( $prazo_entrega <= 1) {
                        printf('<span class="prazo">%s dia</span>', $prazo_entrega);
                    } else {
                        printf('<span class="prazo">%s dias</span>', $prazo_entrega);
                    }


                    $valor = $envio['ShopEnvioPersonalizadoPeso']['valor'];

                    /**
                     * Acrescenta ao frete 
                     * definido em personalização
                     */
                    if (!empty($envio['ShopEnvioPersonalizado']['taxa_valor'])) {

                        if ($envio['ShopEnvioPersonalizado']['taxa_tipo'] == 'fixo') {

                            $valor += $envio['ShopEnvioPersonalizado']['taxa_valor'];

                        } elseif ($envio['ShopEnvioPersonalizado']['taxa_tipo'] == 'porcentagem') {

                            $percentual = ( $envio['ShopEnvioPersonalizado']['taxa_valor'] / 100.0 );
                            $valor += ( $percentual * $valor );

                        }

                    }

                    printf('<span class="valor cor-principal"><strong>R$ </strong>%s</span>', \Lib\Tools::convertToDecimalBR( $valor ) );
                    
                    echo '</li>';

                }

            }

        }


        echo '</ul>'. PHP_EOL;

    }


}


echo '<div class="row borda-info">
    <div class="col-md-1"><i class="fa fa-info-circle fa-3x"></i></div>
    <div class="col-md-11">Para fins de contagem do prazo de entrega, sábados, domingos e feriados não são considerados dias úteis. Postagens ocorridas aos sábados, domingos, feriados e depois do horário limite de postagem (DH), considerar o próximo dia útil como o "Dia da Postagem". Preço(s) estimado(s) para uma (01) unidade e suas respectivas medidas.</div>
</div>'. PHP_EOL;
