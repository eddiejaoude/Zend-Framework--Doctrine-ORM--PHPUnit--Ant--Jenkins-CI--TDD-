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
    }
    
    /**
     * Setup the database connection
     * 
     * @author Koen Huybrechts
     */
    public function databaseAction()
    {
    	# load form
    	$this->databaseConnectForm =  new Install_Form_DatabaseConnect;
    	
    	# make connection and load data
    	$setup = $this->makeConnection();
    	
    	$this->view->databaseConnectForm = $setup;
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

    public function makeConnection()
    {
        # get form
        $form = $this->databaseConnectForm;
        if ($this->_request->isPost()) {
            # get params
            $data = $this->_request->getPost();
            # get config
	        $location = APPLICATION_PATH . 
	                DIRECTORY_SEPARATOR . 'configs' .
	                DIRECTORY_SEPARATOR . 'application.ini';
            # check validate form
            if ($form->isValid($data)) {
            	
            	# read existing configuration
            	$config = new Zend_Config_Ini(
            				  $location,
                              null,
                              array('skipExtends'        => true,
                                    'allowModifications' => true));

                # add new values
                $config->production->doctrine->connection = array();
				$config->production->doctrine->connection->host = $data['server'];
				$config->production->doctrine->connection->user = $data['username'];
				$config->production->doctrine->connection->password = $data['password'];
				$config->production->doctrine->connection->database = $data['database'];				
				
                # write new configuration
				$writer = new Zend_Config_Writer_Ini(array('config'   => $config,
				                                           'filename' => $location));
				$writer->write();
            }
            $form->populate($data);
        }
        return $form;
    }
}

