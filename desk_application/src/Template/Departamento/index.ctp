<div class="Departamento index large-9 medium-8 columns content">

    <div class="row">
      <div class="col-md-12 pull-left"><?= $this->Html->link(__('Novo Departamento'), ['action' => 'add'], ['title'=>'Cadastrar Novo', 'class' => 'btn btn-sm btn-success']) ?></div>
      <br /><br />
    </div>

    <div class="box">
    <div class="box-header">
      <h2 class="box-title"><?= __('Ticket Departamento') ?></h2>

      <div class="box-tools">
        <ul class="pagination pagination-sm no-margin pull-right">
          <?= $this->Paginator->prev('< ' . __('anterior')) ?>
          <?= $this->Paginator->numbers() ?>
          <?= $this->Paginator->next(__('próximo') . ' >') ?>
        </ul>
      </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body no-padding">
      <table class="table">
        <tr>
          <th style="width: 10px">#</th>
          <th>Departamento</th>
          <th style="width: 135px">Ação</th>
        </tr>

        <?php foreach ($Departamento as $Departamento): ?>
        <tr>
          <td><?= $this->Number->format($Departamento->id) ?></td>
          <td><?= h($Departamento->departamento) ?></td>
          <td>
              <?= $this->Html->link(__('Editar'), ['action' => 'edit', $Departamento->id], ['title'=>'Editar', 'class' => 'btn btn-sm btn-primary']) ?>
              <?= $this->Form->postLink(__('Deletar'), ['action' => 'delete', $Departamento->id], ['title'=>'Remover', 'class' => 'btn btn-sm btn-danger', 'confirm' => __('Deseja realmente excluir o departamento # {0}?', $Departamento->id)]) ?>
          </td>
        </tr>

        <?php endforeach; ?>

      </table>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->


</div>




