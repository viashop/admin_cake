<?php
/** 
 * As configurações básicas do WordPress.
 *
 * Esse arquivo contém as seguintes configurações: configurações de MySQL, Prefixo de Tabelas,
 * Chaves secretas, Idioma do WordPress, e ABSPATH. Você pode encontrar mais informações
 * visitando {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. Você pode obter as configurações de MySQL de seu servidor de hospedagem.
 *
 * Esse arquivo é usado pelo script ed criação wp-config.php durante a
 * instalação. Você não precisa usar o site, você pode apenas salvar esse arquivo
 * como "wp-config.php" e preencher os valores.
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar essas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define('DB_NAME', 'vialojac_opapp');

/** Usuário do banco de dados MySQL */
define('DB_USER', 'root');

/** Senha do banco de dados MySQL */
define('DB_PASSWORD', '123456');

/** nome do host do MySQL */
define('DB_HOST', 'localhost');

/** Conjunto de caracteres do banco de dados a ser usado na criação das tabelas. */
define('DB_CHARSET', 'utf8mb4');

/** O tipo de collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Você pode alterá-las a qualquer momento para desvalidar quaisquer cookies existentes. Isto irá forçar todos os usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'Nu%P6( 7hxgltYTLxQ+v+,_<%Ys}FPq?xd:9m2T^NS{j|3kt /ULf%bo#!{M|-r_');
define('SECURE_AUTH_KEY',  'Hj]0Vwp!]u,%Im_y9n+e/frN/TBZ=,+tt^/A`;v RFfcpq7TS&[+]b.Mvio* Nb1');
define('LOGGED_IN_KEY',    '-hTTV:!@i:1g@P2p4_Qm +L;!SfT9-Q3``X<-iUzNR~3m+cf L^ka:Vgqd.ffX:r');
define('NONCE_KEY',        '6BUzIwfNGa(Cwr_P~W@:y]$vUK3C}6)6xX;Iyu&Q. v+>,f+6ZUzN!J--(_u#Lj`');
define('AUTH_SALT',        '`u)$XWoUPuW>EzVpY[T9 FfNbN?YBpFpg3u<r:kf98/gu[07kj E})?_,tP4>3zg');
define('SECURE_AUTH_SALT', '~@q=WObnsq<u8+*Kx[d6G-vkrtscY9^<oZ0B[kD%6ID)OlU~tkcW8d|qWGFOOY%^');
define('LOGGED_IN_SALT',   'J2-V@vyyKGjp85YV`5Di-&WAq>2S*l]LDR7_V=HKz/q}(ilbw|B_IQXlx%-3d3xo');
define('NONCE_SALT',       'TeJ*-/h .9Q{k=|DV0=7_2r g23:y}^3Hph};FVwt!K&mF,rqf=YlOmlU$#s(v-`');

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der para cada um um único
 * prefixo. Somente números, letras e sublinhados!
 */
$table_prefix  = 'op_';


/**
 * Para desenvolvedores: Modo debugging WordPress.
 *
 * altere isto para true para ativar a exibição de avisos durante o desenvolvimento.
 * é altamente recomendável que os desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 */
define('WP_DEBUG', false);

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
	
/** Configura as variáveis do WordPress e arquivos inclusos. */
require_once(ABSPATH . 'wp-settings.php');
