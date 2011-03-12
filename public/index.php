<?php

/**
 * Public application facade
 */

namespace Toko\Application;

// Require Deftek application class file
require_once realpath(__DIR__ . '/../library/Toko/Application/Application.php');

// Bootstrap and run the application
Application::getInstance()
    ->bootstrap()
    ->run();
