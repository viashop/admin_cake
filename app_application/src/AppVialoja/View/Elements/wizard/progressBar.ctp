<div id="progressBar" class="step_one">
    <div class="progressContainer">
        <div class="start-bg"></div>
        <div class="finish-bg"></div>
        <div class="container">
            <ul class="steps">

                <?php
                $progress = isset( $this->request->pass['0'] ) ? $this->request->pass['0'] : 2;
                ?>

                <li class=" <?php
                if ($progress=='passo-1') {
                    echo 'active';
                }
                ?>">
                    <span class="icon-wizard step-number">01</span>
                    <a href="#"><strong>Configuração de usuário</strong></a>
                    <i class="icon-wizard step-arrow"></i>
                </li>

                <li class=" <?php
                if ($progress=='passo-2') {
                    echo 'active';
                }
                ?>">
                    <span class="icon-wizard step-number">02</span>
                    <a href="#"><strong>Configuração da loja</strong></a>
                    <i class="icon-wizard step-arrow"></i>
                </li>

                <li class=" <?php
                if ($progress=='passo-3') {
                    echo 'active';
                }
                ?>">
                    <span class="icon-wizard step-number">03</span>
                    <a href="#"><strong>Formas de envio</strong></a>
                    <i class="icon-wizard step-arrow"></i>
                </li>

                <li class=" <?php
                if ($progress=='passo-4') {
                    echo 'active';
                }
                ?>">
                    <span class="icon-wizard step-number">04</span>
                    <a href="#"><strong>Formas de pagamento</strong></a>
                    <i class="icon-wizard step-arrow"></i>
                </li>

                <li class=" <?php
                if ($progress=='passo-5') {
                    echo 'active';
                }
                ?>">
                    <span class="icon-wizard step-number">05</span>
                    <a href="#"><strong>Resumo do cadastro</strong></a>
                    <i class="icon-wizard step-arrow"></i>
                </li>
            </ul>
        </div>
    </div>
</div>