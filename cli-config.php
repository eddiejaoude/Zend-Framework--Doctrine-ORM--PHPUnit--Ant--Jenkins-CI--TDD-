<?php

/**
 * Configuration file for Doctrine CLI
 */

namespace Toko\Application;

// Require Deftek application class file
require_once realpath(__DIR__ . '/library/Toko/Application/Application.php');

// Fetch the application
$application = Application::getInstance();

// Bootstrap the application
$application->bootstrap();

// Fetch Doctrine ORM entity manager
$entityManager = $application->getZendApplication()->getBootstrap()->getResource('DoctrineORMEntityManager');

// Create Doctrine CLI helpers
$helpers = array(
    'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($entityManager->getConnection()),
    'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($entityManager)
    );

// Create Symfony console helper set
$helperSet = new \Symfony\Component\Console\Helper\HelperSet($helpers);

//$user = new \Toko_Model_Default_User();