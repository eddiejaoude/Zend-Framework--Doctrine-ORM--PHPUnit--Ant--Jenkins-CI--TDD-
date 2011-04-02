<?php
define('LIBRARY_PATH', '.');
require_once LIBRARY_PATH . '/Doctrine/Common/ClassLoader.php';


use Doctrine\Common\ClassLoader;

$classLoader = new ClassLoader('Doctrine\DBAL\Migrations', LIBRARY_PATH . '/Doctrine/DBAL/Migrations');
$classLoader->register();

#$doctrineAutoloader = new \Doctrine\Common\ClassLoader('Doctrine', LIBRARY_PATH );
#$doctrineAutoloader->register();

# configure doctrine
$cache = new Doctrine\Common\Cache\ArrayCache;
$config = new Doctrine\ORM\Configuration();
$config->setMetadataCacheImpl($cache);
$driverImpl = $config->newDefaultAnnotationDriver( LIBRARY_PATH );
$config->setMetadataDriverImpl($driverImpl);
$config->setQueryCacheImpl($cache);
$config->setProxyDir( LIBRARY_PATH );
$config->setProxyNamespace('Proxies');
$config->setAutoGenerateProxyClasses(true);

# database connection
$connectionOptions = array(
    'driver' => 'pdo_mysql',
    'host' => 'localhost',
    'dbname' => 'skeleton',
    'username' => 'root',
    'password' => ''
);
$_em = Doctrine\ORM\EntityManager::create($connectionOptions, $config);
$db = $_em->getConnection();


$helperSet = new \Symfony\Component\Console\Helper\HelperSet(array(
    'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($db),
    'dialog' => new \Symfony\Component\Console\Helper\DialogHelper(),
));


$cli = new \Symfony\Component\Console\Application('Doctrine Command Line Interface', Doctrine\Common\Version::VERSION);
$cli->setHelperSet($helperSet);
$cli->addCommands(array(
    // Migrations Commands
    new \Doctrine\DBAL\Migrations\Tools\Console\Command\DiffCommand(),
    new \Doctrine\DBAL\Migrations\Tools\Console\Command\ExecuteCommand(),
    new \Doctrine\DBAL\Migrations\Tools\Console\Command\GenerateCommand(),
    new \Doctrine\DBAL\Migrations\Tools\Console\Command\MigrateCommand(),
    new \Doctrine\DBAL\Migrations\Tools\Console\Command\StatusCommand(),
    new \Doctrine\DBAL\Migrations\Tools\Console\Command\VersionCommand()
));
$cli->run();