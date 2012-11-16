<?php
/**
 * User: michael.klapper
 * Date: 14.11.12
 * Time: 17:34
 */

error_reporting(E_ALL | E_STRICT);

// Ensure that composer has installed all dependencies
if (!file_exists(dirname(__DIR__) . '/composer.lock')) {
	die("Dependencies must be installed using composer:\n\nphp composer.phar install --dev\n\n"
		. "See http://getcomposer.org for help with installing composer\n");
}

require_once 'PHPUnit/TextUI/TestRunner.php';

// Include the composer autoloader
require dirname(__DIR__) . '/vendor/autoload.php';