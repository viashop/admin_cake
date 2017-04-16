<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Status Departamento'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Sh Ticket'), ['controller' => 'ShTicket', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Sh Ticket'), ['controller' => 'ShTicket', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="statusDepartamento form large-9 medium-8 columns content">
    <?= $this->Form->create($statusDepartamento) ?>
    <fieldset>
        <legend><?= __('Add Status Departamento') ?></legend>
        <?php
            echo $this->Form->input('status');
            echo $this->Form->input('sh_ticket._ids', ['options' => $shTicket]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
