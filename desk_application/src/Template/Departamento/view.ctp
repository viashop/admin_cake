<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Ticket Departamento'), ['action' => 'edit', $Departamento->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Ticket Departamento'), ['action' => 'delete', $Departamento->id], ['confirm' => __('Are you sure you want to delete # {0}?', $Departamento->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Ticket Departamento'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Ticket Departamento'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="Departamento view large-9 medium-8 columns content">
    <h3><?= h($Departamento->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Departamento') ?></th>
            <td><?= h($Departamento->departamento) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email Departamento') ?></th>
            <td><?= h($Departamento->email_departamento) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($Departamento->id) ?></td>
        </tr>
    </table>
</div>
