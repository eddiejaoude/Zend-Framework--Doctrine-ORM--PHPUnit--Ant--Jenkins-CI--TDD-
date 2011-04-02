<?php
define('LIBRARY_PATH', '.');
require_once LIBRARY_PATH . '/Doctrine/Common/ClassLoader.php';


$classes = array
(
	'Doctrine\Common'          => LIBRARY_PATH . '/Doctrine/Common',
	'Doctrine\DBAL\Migrations' => LIBRARY_PATH . '/Doctrine/DBAL/Migrations',
	'Doctrine\DBAL'            => LIBRARY_PATH . '/DBAL',
);

foreach($classes as $namespace => $include_path)
{
	$classLoader = new Doctrine\Common\ClassLoader($namespace, $include_path);
	$classLoader->register();
}

// Database configuration
$helperSet = new \Symfony\Component\Console\Helper\HelperSet(array
(
	'dialog' => new \Symfony\Component\Console\Helper\DialogHelper(),
));

$cli = new \Symfony\Component\Console\Application('Doctrine Migrations', \Doctrine\DBAL\Migrations\MigrationsVersion::VERSION);
$cli->setCatchExceptions(true);
$cli->setHelperSet($helperSet);
$cli->addCommands(array
(
	// Migrations Commands
	new \Doctrine\DBAL\Migrations\Tools\Console\Command\DiffCommand(),
	new \Doctrine\DBAL\Migrations\Tools\Console\Command\ExecuteCommand(),
	new \Doctrine\DBAL\Migrations\Tools\Console\Command\GenerateCommand(),
	new \Doctrine\DBAL\Migrations\Tools\Console\Command\MigrateCommand(),
	new \Doctrine\DBAL\Migrations\Tools\Console\Command\StatusCommand(),
	new \Doctrine\DBAL\Migrations\Tools\Console\Command\VersionCommand()
));
$cli->run();