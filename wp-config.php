<?php
/**
 * As configurações básicas do WordPress
 *
 * O script de criação wp-config.php usa esse arquivo durante a instalação.
 * Você não precisa usar o site, você pode copiar este arquivo
 * para "wp-config.php" e preencher os valores.
 *
 * Este arquivo contém as seguintes configurações:
 *
 * * Configurações do MySQL
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar estas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define( 'DB_NAME', 'carocronistabd' );

/** Usuário do banco de dados MySQL */
define( 'DB_USER', 'root' );

/** Senha do banco de dados MySQL */
define( 'DB_PASSWORD', '' );

/** Nome do host do MySQL */
define( 'DB_HOST', 'localhost' );

/** Charset do banco de dados a ser usado na criação das tabelas. */
define( 'DB_CHARSET', 'utf8mb4' );

/** O tipo de Collate do banco de dados. Não altere isso se tiver dúvidas. */
define( 'DB_COLLATE', '' );

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las
 * usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org
 * secret-key service}
 * Você pode alterá-las a qualquer momento para invalidar quaisquer
 * cookies existentes. Isto irá forçar todos os
 * usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '8QM&ClDRwNLVZT.kE4jTHllYpO?~r,jVzJqE8hDGDUuy3{PJ9J6(y$9R;/qLIjN&' );
define( 'SECURE_AUTH_KEY',  'NRzC=fDFK]N>*w:i<@rq.izdN9*7lGH%,PX<2#]gCtibs/hx %v$eyRx:_8Q4Gg_' );
define( 'LOGGED_IN_KEY',    'Bw LFN1eLybJHmm.gOA95LtVSAh*5}H-6:m-UbN=*0Wi}$3|)JP!Sodisy{/|.oI' );
define( 'NONCE_KEY',        'L/3+b%%!xL~uQ~r]<AlPYD{zrRgkxHd*0_TG 4um7/f~^0mR*zc:MvJnM2_YAOwR' );
define( 'AUTH_SALT',        'U%#HYvXAh?i6dwhH;G40t[if7@s>wl0}^do611S!uE!}o@6<E6q_M].r=j)x4vW/' );
define( 'SECURE_AUTH_SALT', '|/dv#ww(WM=o.2),#u(Iu7,#|-dX#]$a%%ns,6cNZQtS94L>(1r2!Ks k2(t4x#q' );
define( 'LOGGED_IN_SALT',   '-(s d2JRb>a%f[yb I_:k5u0[j4E:(;69e9w8XjE!?>2uhh5*g;M;^g@tVP0GbTb' );
define( 'NONCE_SALT',       'l5!l<aOb;Z]Uk.8c?)O%[iV8;%{s}#*57/`gFBn~-b=Y2wm/2$n/d2$w((v1+=(7' );

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * um prefixo único para cada um. Somente números, letras e sublinhados!
 */
$table_prefix = 'wp_';

/**
 * Para desenvolvedores: Modo de debug do WordPress.
 *
 * Altere isto para true para ativar a exibição de avisos
 * durante o desenvolvimento. É altamente recomendável que os
 * desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 *
 * Para informações sobre outras constantes que podem ser utilizadas
 * para depuração, visite o Codex.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Adicione valores personalizados entre esta linha até "Isto é tudo". */



/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Configura as variáveis e arquivos do WordPress. */
require_once ABSPATH . 'wp-settings.php';
