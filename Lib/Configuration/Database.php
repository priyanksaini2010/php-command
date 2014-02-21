<?php
/**
 * This is a core configuration file is used to manage db connection for App
 * 
 * PHP 5
 * 
 * @package  Command App
 * @category Configuration
 * @author   Priyank Saini<priyank.saini@kelltontech.com>
 * 
 * host =>     the host you connect to the database. 
 * login =>    Username for DB Connection 
 * Paswword => Password For DB Connection
 * database => Use DB         
 */
class DBConfiguration {

    /**
     * Database Configuration for development environment
     *
     * @var Array
     */
    public $development = array(
            'host' => 'localhost',
            'login' => 'root',
            'password' => '',
            'database' => 'php_command',
            'prefix' => ''
    );

    /**
     * Database Configuration for Staging environment
     *
     * @var Array
     */
    public $staging = array(
            'datasource' => 'Database/Sqlserver',
            'persistent' => false,
            'host' => 'localhost',
            'login' => 'root',
            'password' => '',
            'database' => 'php_command',
            'prefix' => ''
    );

    /**
     * Database Configuration for Production environment
     *
     * @var Array
     */
    public $production = array(
            'datasource' => 'Database/Sqlserver',
            'persistent' => false,
            'host' => 'localhost',
            'login' => 'root',
            'password' => '',
            'database' => 'php_command',
            'prefix' => ''
    );
   
    /**
     * This method will switch DB Connection according to environment set in ini
     * file
     * 
     * @access public
     * @author Priyank Saini <priyank.saini@kelltontech.com>
     * @return void 
     */
    function __construct() {
        switch( ConfigFactory::getConfigVar('application','env') ){
            case 'development':
                $this->default = $this->development;
            break;    
            case 'staging':
                $this->default = $this->staging;
            break;    
            case 'production':
                $this->default = $this->production;
            break;    
        }
    }
}
?>
