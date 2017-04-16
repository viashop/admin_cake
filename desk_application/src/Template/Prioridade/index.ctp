<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Prioridade'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Sh Ticket'), ['controller' => 'ShTicket', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Sh Ticket'), ['controller' => 'ShTicket', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="prioridade index large-9 medium-8 columns content">
    <h3><?= __('Prioridade') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('prioridade') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($prioridade as $prioridade): ?>
            <tr>
                <td><?= $this->Number->format($prioridade->id) ?></td>
                <td><?= h($prioridade->prioridade) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $prioridade->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $prioridade->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $prioridade->id], ['confirm' => __('Are you sure you want to delete # {0}?', $prioridade->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
