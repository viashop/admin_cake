<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Status Departamento'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Sh Ticket'), ['controller' => 'ShTicket', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Sh Ticket'), ['controller' => 'ShTicket', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="statusDepartamento index large-9 medium-8 columns content">
    <h3><?= __('Status Departamento') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($statusDepartamento as $statusDepartamento): ?>
            <tr>
                <td><?= $this->Number->format($statusDepartamento->id) ?></td>
                <td><?= h($statusDepartamento->status) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $statusDepartamento->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $statusDepartamento->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $statusDepartamento->id], ['confirm' => __('Are you sure you want to delete # {0}?', $statusDepartamento->id)]) ?>
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
