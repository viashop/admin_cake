<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Admin'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="admin form large-9 medium-8 columns content">
    <?= $this->Form->create($admin) ?>
    <fieldset>
        <legend><?= __('Add Admin') ?></legend>
        <?php
            echo $this->Form->input('id_shop_default');
            echo $this->Form->input('id_cliente_default');
            echo $this->Form->input('id_prioridade_default');
            echo $this->Form->input('id_departamento_default');
            echo $this->Form->input('id_status_departamento_default');
            echo $this->Form->input('id_status_cliente_default');
            echo $this->Form->input('leitura_departamento');
            echo $this->Form->input('leitura_cliente');
            echo $this->Form->input('ultima_acao');
            echo $this->Form->input('hash');
            echo $this->Form->input('ip');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
