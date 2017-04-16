<h1>
    #<?= $this->request->pass[0]; ?>
    <small>
    <?php
	$this->requestAction(
	    array(
	        'controller' => 'Ticket',
	        'action' => 'getAssuntoConteudoTicket',
	        'id' => $this->request->pass[0]
	    )
	);
	?>
    </small>
</h1>

<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Admin</a></li>
    <li><a href="#">Ticket</a></li>
    <li class="active">#<?= $this->request->pass[0]; ?></li>
</ol>