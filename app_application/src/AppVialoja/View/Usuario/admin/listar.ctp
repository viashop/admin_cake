<!-- File: /app/View/Clientes/index.ctp -->
<?php
App::import('Vendor', 'Company' . DS . 'teste');
?>
<h1>Clientes do Blog</h1>
<table>
    <tr>
        <th>Id</th>
        <th>Título</th>
        <th>Data de Criação</th>
    </tr>

    <!-- Aqui é onde nós percorremos nossa matriz $clientes, imprimindo
         as informações dos Clientes -->

    <?php foreach ($cliente as $cliente): ?>
    <tr>
        <td><?php echo $cliente['Cliente']['id_cliente']; ?></td>
        <td>
            <?php echo $this->Html->link($cliente['Cliente']['login'],
array('controller' => 'cliente', 'action' => 'view', $cliente['Cliente']['id_cliente'])); ?>
        </td>
        <td><?php echo $cliente['Cliente']['senha']; ?></td>
    </tr>
    <?php endforeach; ?>

</table>

<?php
App::import('Vendor', 'Company' . DS . 'teste');
?>