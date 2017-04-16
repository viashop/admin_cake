<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $statusCliente->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $statusCliente->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Status Cliente'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="statusCliente form large-9 medium-8 columns content">
    <?= $this->Form->create($statusCliente) ?>
    <fieldset>
        <legend><?= __('Edit Status Cliente') ?></legend>
        <?php
            echo $this->Form->input('status');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
