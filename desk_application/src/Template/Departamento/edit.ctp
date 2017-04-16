<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <?= $this->Html->link(__('Lista Departamentos'), ['action' => 'index']) ?>
    <br />
    <br />
</nav>


<div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title"><?= __('Cadastrar Departamento') ?></h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <?= $this->Form->create($Departamento) ?>
      <div class="box-body">
        <div class="form-group">
          <?= $this->Form->input('departamento', array('class' => 'form-control input-lg')); ?>
        </div>
        <div class="form-group">
          <?= $this->Form->input('email_departamento', array(
                          'type' => 'email',
                          'class' => 'form-control input-lg',
                          'placeholder' => 'exemplo@vialoja.com.br')); ?>
        </div>

      </div>
      <!-- /.box-body -->

      <div class="box-footer">
        <?= $this->Form->button(__('Alterar'), array('class' => 'btn btn-primary btn-lg', 'title' => 'Cadastrar Novo')) ?>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <?= $this->Html->link(__('Cancelar'), ['action' => 'index'], ['title'=>'Cancelar', 'class' => 'btn btn-sm btn-default']) ?>
      </div>
    <?= $this->Form->end() ?>
  </div>