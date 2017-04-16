<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Ticket'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="ticket index large-9 medium-8 columns content">
    <h3><?= __('Ticket') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('id_shop_default') ?></th>
                <th scope="col"><?= $this->Paginator->sort('id_cliente_default') ?></th>
                <th scope="col"><?= $this->Paginator->sort('id_prioridade_default') ?></th>
                <th scope="col"><?= $this->Paginator->sort('id_departamento_default') ?></th>
                <th scope="col"><?= $this->Paginator->sort('id_status_departamento_default') ?></th>
                <th scope="col"><?= $this->Paginator->sort('id_status_cliente_default') ?></th>
                <th scope="col"><?= $this->Paginator->sort('hash') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ip') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ticket as $ticket): ?>
            <tr>
                <td><?= $this->Number->format($ticket->id) ?></td>
                <td><?= $this->Number->format($ticket->id_shop_default) ?></td>
                <td><?= $this->Number->format($ticket->id_cliente_default) ?></td>
                <td><?= $this->Number->format($ticket->id_prioridade_default) ?></td>
                <td><?= $this->Number->format($ticket->id_departamento_default) ?></td>
                <td><?= $this->Number->format($ticket->id_status_departamento_default) ?></td>
                <td><?= $this->Number->format($ticket->id_status_cliente_default) ?></td>
                <td><?= h($ticket->hash) ?></td>
                <td><?= h($ticket->ip) ?></td>
                <td><?= h($ticket->created) ?></td>
                <td><?= h($ticket->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $ticket->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $ticket->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $ticket->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ticket->id)]) ?>
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
