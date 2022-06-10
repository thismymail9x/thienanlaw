<?php
// Path to the front controller (this file)
define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);
define( 'PUBLIC_HTML_PATH', __DIR__ . '/' );

if (defined('ENVIRONMENT')) {
    switch (ENVIRONMENT) {
        case 'development':
            error_reporting(E_ALL);
            break;

        case 'production':
            error_reporting(0);
            break;

        default:
            exit('The CodeIgniter application environment is not set correctly.');
    }
}

ini_set('display_errors', 1);
/*

 *---------------------------------------------------------------

 * BOOTSTRAP THE APPLICATION

 *---------------------------------------------------------------

 * This process sets up the path constants, loads and registers

 * our autoloader, along with Composer's, loads our constants

 * and fires up an environment-specific bootstrapping.

 */



// Ensure the current directory is pointing to the front controller's directory

chdir(__DIR__);


// Load our paths config file

// This is the line that might need to be changed, depending on your folder structure.

require realpath(FCPATH . 'app/Config/Paths.php') ?: FCPATH . 'app/Config/Paths.php';

// ^^^ Change this if you move your application folder

$paths = new Config\Paths();

// Location of the framework bootstrap file.
$bootstrap = rtrim($paths->systemDirectory, '\\/ ') . DIRECTORY_SEPARATOR . 'bootstrap.php';

$app       = require realpath($bootstrap) ?: $bootstrap;

/*

 *---------------------------------------------------------------

 * LAUNCH THE APPLICATION

 *---------------------------------------------------------------

 * Now that everything is setup, it's time to actually fire

 * up the engines and make this app do its thang.

 */

$app->run();

