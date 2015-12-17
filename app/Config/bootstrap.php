<?php
/**
 * Bootstrap handler - perform the SMVC Framework boot stage.
 *
 * @author Virgil-Adrian Teaca - virgil@@giulianaeassociati.com
 * @version 3.0
 * @date December 15th, 2015
 */

use Smvc\Helpers\Session;
use Smvc\Modules\Manager as Modules;
use Smvc\Net\Router;
use Smvc\Config;

/**
 * Turn on output buffering.
 */
ob_start();

require dirname(__FILE__).DS.'constants.php';
require dirname(__FILE__).DS.'functions.php';
require dirname(__FILE__).DS.'config.php';

/**
 * Turn on custom error handling.
 */

set_exception_handler('Smvc\Logger::ExceptionHandler');
set_error_handler('Smvc\Logger::ErrorHandler');

/**
 * Set timezone.
 */
date_default_timezone_set(Config::get('timezone'));

/**
 * Start sessions.
 */
Session::init();

/** Get the Router instance. */
$router = Router::getInstance();

/** load routes */
require dirname(__FILE__).DS.'routes.php';

/** bootstrap the active modules (and their associated routes) */
Modules::bootstrap();

/** Execute matched routes. */
$router->dispatch();