<?php

App::uses('Shell', 'Console');

class EmailNotificacaoForumShell extends AppShell {
    public function email_usuario() {
        ClassRegistry::init('EmailNotificacaoForum')->email_usuario();		
    }
}
