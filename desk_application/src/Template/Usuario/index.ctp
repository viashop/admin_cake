<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Usuario'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="usuario index large-9 medium-8 columns content">
    <h3><?= __('Usuario') ?></h3>
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
            <?php foreach ($usuario as $usuario): ?>
            <tr>
                <td><?= $this->Number->format($usuario->id) ?></td>
                <td><?= $this->Number->format($usuario->id_shop_default) ?></td>
                <td><?= $this->Number->format($usuario->id_cliente_default) ?></td>
                <td><?= $this->Number->format($usuario->id_prioridade_default) ?></td>
                <td><?= $this->Number->format($usuario->id_departamento_default) ?></td>
                <td><?= $this->Number->format($usuario->id_status_departamento_default) ?></td>
                <td><?= $this->Number->format($usuario->id_status_cliente_default) ?></td>
                <td><?= h($usuario->hash) ?></td>
                <td><?= h($usuario->ip) ?></td>
                <td><?= h($usuario->created) ?></td>
                <td><?= h($usuario->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $usuario->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $usuario->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $usuario->id], ['confirm' => __('Are you sure you want to delete # {0}?', $usuario->id)]) ?>
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
