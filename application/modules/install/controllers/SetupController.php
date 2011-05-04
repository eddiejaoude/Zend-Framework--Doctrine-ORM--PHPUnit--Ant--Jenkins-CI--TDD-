<?php
/**
 * Auth Default Controller
 *
 *
 * @author          Koen Huybrechts
 * @package       Auth Module
 *
 */
class Install_SetupController extends Install_BaseController
{

    /**
     * Initialisation method
     *
     * @author          Koen Huybrechts
     * @param           void
     * @return           void
     *
     */
    public function init()
    {
        parent::init();
    }

    /**
     * post dispatch method
     *
     * @author          Koen Huybrechts
     * @param           void
     * @return           void
     *
     */
    public function  postDispatch()
    {
        parent::postDispatch();
    }

    /**
     * default method
     *
     * @author          Koen Huybrechts
     * @param           void
     * @return           void
     *
     */
    public function checksAction()
    {
        # Get PHP version
        $phpVersion = Array(
        	'value' => phpversion(),
        	'class' => (phpversion() >= 5.3 ? 'pass' : 'fail')
        );
        
        # Get MySQL version
        $mysqlVersion = Array(
        	'value' => mysql_get_server_info(),
        	'class' => 'neutral'
        );
        
        # Check if /tmp is writable
        $writable = is_writable(APPLICATION_PATH . DIRECTORY_SEPARATOR . 'tmp');
        
        $tmpWritable = Array(
        	'value' => ($writable ? 'Pass' : 'Fail'),
        	'class' => ($writable ? 'pass' : 'fail')
        );
        
        $this->view->assign('phpVersion', $phpVersion);
        $this->view->assign('mysqlVersion', $mysqlVersion);
        $this->view->assign('tmpWritable', $tmpWritable);
        $this->view->assign('databaseConnectForm', new Install_Form_DatabaseConnect);
    }
    
    /**
     * Setup the database connection
     * 
     * @author Koen Huybrechts
     */
    public function databaseAction()
    {
    	
    }

    /**
     * access denied method
     *
     * @author          Koen Huybrechts
     * @param           void
     * @return           void
     *
     */
    public function deniedAction()
    {
        
    }


}

