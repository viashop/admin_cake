<?php
define('CONFIG_VIALOJA', dirname(dirname(ROOT)) . DS .'config'. DS );

if (!file_exists(CONFIG_VIALOJA . 'defines.vialoja.inc.php')) {
	trigger_error("defines.vialoja.inc não encontrado.");
	exit();
} else {
	require_once CONFIG_VIALOJA . 'defines.vialoja.inc.php';
}

if (!file_exists(PARTY3RD_VIALOJA . 'autoload.php')) {
	trigger_error("Autoload do Composer Não encontrado.");
	exit();
} else {
	require_once PARTY3RD_VIALOJA . 'autoload.php';
}
