<?php

App::uses('Shell', 'Console');

class PhotoShell extends AppShell {
    public function limpar() {
        ClassRegistry::init('Photo')->limpar();
		
		//print ('dddddddddddddddddddddddddddddddddddddddddddd');
    }
}
?>