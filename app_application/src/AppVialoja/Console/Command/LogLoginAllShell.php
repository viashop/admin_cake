<?php

App::uses('Shell', 'Console');

class LogLoginAllShell extends AppShell {
    public function limpar() {
        ClassRegistry::init('LogLoginAll')->limpar();
    }
}
