<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Status Departamento'), ['action' => 'edit', $statusDepartamento->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Status Departamento'), ['action' => 'delete', $statusDepartamento->id], ['confirm' => __('Are you sure you want to delete # {0}?', $statusDepartamento->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Status Departamento'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Status Departamento'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Sh Ticket'), ['controller' => 'ShTicket', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Sh Ticket'), ['controller' => 'ShTicket', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="statusDepartamento view large-9 medium-8 columns content">
    <h3><?= h($statusDepartamento->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= h($statusDepartamento->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($statusDepartamento->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Sh Ticket') ?></h4>
        <?php if (!empty($statusDepartamento->sh_ticket)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Id Shop Default') ?></th>
                <th scope="col"><?= __('Id Cliente Default') ?></th>
                <th scope="col"><?= __('Id Prioridade Default') ?></th>
                <th scope="col"><?= __('Id Departamento Default') ?></th>
                <th scope="col"><?= __('Id Status Departamento Default') ?></th>
                <th scope="col"><?= __('Id Status Cliente Default') ?></th>
                <th scope="col"><?= __('Leitura Departamento') ?></th>
                <th scope="col"><?= __('Leitura Cliente') ?></th>
                <th scope="col"><?= __('Ultima Acao') ?></th>
                <th scope="col"><?= __('Hash') ?></th>
                <th scope="col"><?= __('Ip') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($statusDepartamento->sh_ticket as $shTicket): ?>
            <tr>
                <td><?= h($shTicket->id) ?></td>
                <td><?= h($shTicket->id_shop_default) ?></td>
                <td><?= h($shTicket->id_cliente_default) ?></td>
                <td><?= h($shTicket->id_prioridade_default) ?></td>
                <td><?= h($shTicket->id_departamento_default) ?></td>
                <td><?= h($shTicket->id_status_departamento_default) ?></td>
                <td><?= h($shTicket->id_status_cliente_default) ?></td>
                <td><?= h($shTicket->leitura_departamento) ?></td>
                <td><?= h($shTicket->leitura_cliente) ?></td>
                <td><?= h($shTicket->ultima_acao) ?></td>
                <td><?= h($shTicket->hash) ?></td>
                <td><?= h($shTicket->ip) ?></td>
                <td><?= h($shTicket->created) ?></td>
                <td><?= h($shTicket->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'ShTicket', 'action' => 'view', $shTicket->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ShTicket', 'action' => 'edit', $shTicket->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ShTicket', 'action' => 'delete', $shTicket->id], ['confirm' => __('Are you sure you want to delete # {0}?', $shTicket->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
