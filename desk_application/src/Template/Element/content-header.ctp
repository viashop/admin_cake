<?php
//$this->request->controller . '<br />';
//$this->request->action . '<br />';
if ($this->request->controller=='Ticket'
    && $this->request->action == 'view') {

    echo $this->element('breadcrumb-ticket');

} elseif($this->request->controller=='Tickets'
    && $this->request->action == 'views') {

} else {
    echo $this->element('breadcrumb-default');
}
?>


