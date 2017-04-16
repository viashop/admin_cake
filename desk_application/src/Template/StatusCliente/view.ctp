<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Status Cliente'), ['action' => 'edit', $statusCliente->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Status Cliente'), ['action' => 'delete', $statusCliente->id], ['confirm' => __('Are you sure you want to delete # {0}?', $statusCliente->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Status Cliente'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Status Cliente'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="statusCliente view large-9 medium-8 columns content">
    <h3><?= h($statusCliente->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= h($statusCliente->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($statusCliente->id) ?></td>
        </tr>
    </table>
</div>
