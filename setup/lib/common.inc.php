<?php
/**
 * Loads libraries/common.inc.php and preforms some additional actions
 *
 * @package    phpMyAdmin-setup
 * @license    http://www.gnu.org/licenses/gpl.html GNU GPL 2.0
 */

/**
 * Do not include full common.
 * @ignore
 */
define('PMA_MINIMUM_COMMON', TRUE);
define('PMA_SETUP', TRUE);
chdir('..');

if (!file_exists('./libraries/common.inc.php')) {
    die('Bad invocation!');
}

require_once './libraries/common.inc.php';
require_once './libraries/config/config_functions.lib.php';
require_once './libraries/config/messages.inc.php';
require_once './libraries/config/ConfigFile.class.php';
require_once './libraries/url_generating.lib.php';

// use default error handler
restore_error_handler();

// Save current language in a cookie, required since we use PMA_MINIMUM_COMMON
$GLOBALS['PMA_Config']->setCookie('pma_lang', $GLOBALS['lang']);

if (!isset($_SESSION['ConfigFile'])) {
    $_SESSION['ConfigFile'] = array();
}
ConfigFile::getInstance()->setPersistKeys(array(
    'DefaultLang',
    'ServerDefault',
    'UploadDir',
    'SaveDir',
    'Servers/1/verbose',
    'Servers/1/host',
    'Servers/1/port',
    'Servers/1/socket',
    'Servers/1/extension',
    'Servers/1/connect_type',
    'Servers/1/auth_type',
    'Servers/1/user',
    'Servers/1/password'));

// allows for redirection even after sending some data
ob_start();

?>