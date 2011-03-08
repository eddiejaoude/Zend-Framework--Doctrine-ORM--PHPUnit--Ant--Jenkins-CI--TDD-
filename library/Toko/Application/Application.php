<?php

namespace Toko\Application;

/**
 * Deftek application class
 */
class Application
{
    /**
     * Singleton instance
     *
     * @var Application
     */
    protected static $instance;

    /**
     * Configuration data
     *
     * @var \Zend_Config
     */
    protected $config;

    /**
     * Environment
     *
     * @var string
     */
    protected $environment;

    /**
     * Default environment
     *
     * @var string
     */
    protected $environmentDefault = 'production';

    /**
     * Environment variable from which application environment is determined
     *
     * @var string
     */
    protected $environmentVariableName = 'APPLICATION_ENV';

    /**
     * Application paths
     *
     * @var array
     */
    protected $paths = array();

    /**
     * @var \Zend_Application
     */
    protected $zendApplication;

    /**
     * Returns Singleton instance of application
     *
     * @return Application
     */
    public static function getInstance()
    {
        // Create the Singleton instance if necessary
        if (null === self::$instance) {
            self::$instance = new static();
        }

        // Return the Singleton instance
        return self::$instance;
    }

    /**
     * Clears the Singleton instance of application
     *
     * @return void
     */
    public static function resetInstance()
    {
        self::$instance = null;
    }

    /**
     * Bootstraps application
     *
     * @return Application
     */
    public function bootstrap()
    {
        $this
            ->initEnvironment()
            ->initPaths()
            ->initIncludePath()
            ->initAutoloader()
            ->initSession()
            ->initZendApplication();

        return $this;
    }

    /**
     * Runs application
     *
     * @return Application
     */
    public function run()
    {
        return $this->runZendApplication();
    }

    /**
     * Returns application environment setting
     *
     * @return string
     */
    public function getEnvironment()
    {
        return $this->environment;
    }

    /**
     * Returns environment variable from which application environment is determined
     *
     * @return string
     */
    public function getEnvironmentVariableName()
    {
        return $this->environmentVariableName;
    }

    /**
     * Returns path by name, or returns all paths if no name given
     *
     * @param string $name
     * @return array|string
     * @throws OutOfBoundsException If specified path name does not exist
     */
    public function getPath($name = null)
    {
        // If no path name was given, return all paths
        if (null === $name) {
            return $this->paths;
        }

        // If requested path does not exist, throw an exception
        if (!array_key_exists($name, $this->paths)) {
            throw new \OutOfBoundsException("'$name' is not a valid path name");
        }

        // Return requested path
        return $this->paths[$name];
    }

    /**
     * Returns Zend application
     *
     * @return \Zend_Application
     */
    public function getZendApplication()
    {
        return $this->zendApplication;
    }

    /**
     * Prevents cloning
     *
     * @return void
     */
    protected function __clone()
    {
    }

    /**
     * Prevents instantiation with "new" operator
     *
     * @return void
     */
    protected function __construct()
    {
    }

    /**
     * Initializes environment
     *
     * @return Application
     */
    protected function initEnvironment()
    {
        // Fetch environment from environment variable if possible; otherwise, use default
        if (!$applicationEnvironment = getenv($this->environmentVariableName)) {
            $applicationEnvironment = $this->environmentDefault;
        }

        // Set environment
        $this->environment = $applicationEnvironment;

        return $this;
    }

    /**
     * Initializes application paths
     *
     * @return Application
     */
    protected function initPaths()
    {
        // Set root path
        $this->paths['root']    = realpath(__DIR__ . '/../../..');

        // Set public path
        $this->paths['public']     = "{$this->paths['root']}/public";

        // Set source path
        $this->paths['application']     = "{$this->paths['root']}/application";

        // Set library path
        $this->paths['library']     = "{$this->paths['root']}/library";
        return $this;
    }

    /**
     * Initializes PHP include_path
     *
     * @return Application
     */
    protected function initIncludePath()
    {
        set_include_path($this->getPath('library') . PATH_SEPARATOR . get_include_path());

        return $this;
    }

    /**
     * Initializes class file autoloader
     *
     * @return Application
     */
    protected function initAutoloader()
    {
        // Require the autoloader class file
        require_once 'Zend/Loader/Autoloader.php';

        // Get the Singleton instance of Zend_Loader_Autoloader
        $autoloader = \Zend_Loader_Autoloader::getInstance();

        // Set the autoloader as a fallback autoloader (loads all namespaces by default)
        $autoloader->setFallbackAutoloader(true);

        return $this;
    }

    /**
     * Initializes session
     *
     * @return Application
     */
    protected function initSession()
    {
        // Start session
        \Zend_Session::start();

        return $this;
    }

    /**
     * Initializes Zend application
     *
     * @return Application
     */
    protected function initZendApplication()
    {
        // Define APPLICATION_PATH for Zend application
        defined('APPLICATION_PATH') || define('APPLICATION_PATH', $this->getPath('application'));

        // Configuration file directory
        $configDir = $this->getPath('application') . '/configs';

        // Initialize configuration file to default
        $configFile = "{$configDir}/application.ini";

        // If local configuration file is readable, use it instead of default
        $configFileLocal = "{$configDir}/my.ini";
        if (is_readable($configFileLocal)) {
            $configFile = $configFileLocal;
        }

        // Instantiate Zend application with configuration
        $this->zendApplication = new \Zend_Application(
            $this->getEnvironment(),
            $configFile
            );

        // Bootstrap Zend application
        $this->zendApplication->bootstrap();

        return $this;
    }

    /**
     * Runs Zend_Application
     *
     * @return Application
     */
    protected function runZendApplication()
    {
        $this->zendApplication->run();

        return $this;
    }
}
