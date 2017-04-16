<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Admin'), ['action' => 'edit', $admin->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Admin'), ['action' => 'delete', $admin->id], ['confirm' => __('Are you sure you want to delete # {0}?', $admin->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Admin'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Admin'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="admin view large-9 medium-8 columns content">
    <h3><?= h($admin->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Hash') ?></th>
            <td><?= h($admin->hash) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ip') ?></th>
            <td><?= h($admin->ip) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($admin->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id Shop Default') ?></th>
            <td><?= $this->Number->format($admin->id_shop_default) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id Cliente Default') ?></th>
            <td><?= $this->Number->format($admin->id_cliente_default) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id Prioridade Default') ?></th>
            <td><?= $this->Number->format($admin->id_prioridade_default) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id Departamento Default') ?></th>
            <td><?= $this->Number->format($admin->id_departamento_default) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id Status Departamento Default') ?></th>
            <td><?= $this->Number->format($admin->id_status_departamento_default) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id Status Cliente Default') ?></th>
            <td><?= $this->Number->format($admin->id_status_cliente_default) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($admin->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($admin->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Leitura Departamento') ?></h4>
        <?= $this->Text->autoParagraph(h($admin->leitura_departamento)); ?>
    </div>
    <div class="row">
        <h4><?= __('Leitura Cliente') ?></h4>
        <?= $this->Text->autoParagraph(h($admin->leitura_cliente)); ?>
    </div>
    <div class="row">
        <h4><?= __('Ultima Acao') ?></h4>
        <?= $this->Text->autoParagraph(h($admin->ultima_acao)); ?>
    </div>
</div>
