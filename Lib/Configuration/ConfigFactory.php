<?php
/**
 * Common Nuts and Bolts.Contains Application configuration variables,Parsed Via Config INI And other usefull functions
 * 
 * PHP version 5.3.8
 *
 * @category Configuration
 * @package  php-command
 * @author   Priyank Saini <priyanksaini2010@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT License
 */
class ConfigFactory
{

    /**
     * to get application configuration varibales   
     * 
     * @param  string $name  varaible name to fetch
     * @param  string $index index of varaible name to fetch
     * 
     * @author Priyank Saini <priyanksaini2010@gmail.com>
     * @access public
     * @return mixed array or string based on arguments 
     * @todo Set ini path accordin to Yii
     */
    public static function getConfigVar($name, $index = '')
    {
        $ini_array = self::recursive_parse(self::parse_ini_file_advanced('config.ini'));
        $ini_array = self::toObject($ini_array);
        if (isset($ini_array->$name) && $name != '') {
            if ($index != '') {
                return $ini_array->$name->$index;
            }
            return $ini_array->$name;
        }
        return $ini_array;
    }

    /**
     * to parse ini file
     * 
     * @param string $filename <ini file to parse>
     * 
     * @author Priyank Saini <priyanksaini2010@gmail.com>
     * @access Public
     * @return objects
     */
    public static function parse_ini_file_advanced($filename) 
    {
        $array = parse_ini_file($filename, true);
        $returnArray = array();
        if (is_array($array)) {
            foreach ($array as $key => $value) {
                $x = explode(':', $key);
                if (!empty($x[1])) {
                    $x = array_reverse($x, true);
                    foreach ($x as $k => $v) {
                        $i = trim($x[0]);
                        $v = trim($v);
                        if (empty($returnArray[$i])) {
                            $returnArray[$i] = array();
                        }
                        if (isset($array[$v])) {
                            $returnArray[$i] = array_merge($returnArray[$i], $array[$v]);
                        }
                        if ($k === 0) {
                            $returnArray[$i] = array_merge($returnArray[$i], $array[$key]);
                        }
                    }
                } else {
                    $returnArray[$key] = $array[$key];
                }
            }
        } else {
            return false;
        }

        return $returnArray;
    }

    /**
     * to parse ini file recursively
     * 
     * @param string $array ini Data
     * 
     * @author Priyank Saini <priyanksaini2010@gmail.com>
     * @access Public
     * @return objects
     */
    public static function recursive_parse($array)
    {
        $returnArray = array();
        if (is_array($array)) {
            foreach ($array as $key => $value) {
                if (is_array($value)) {
                    $array[$key] = self::recursive_parse($value);
                }
                $x = explode('.', $key);
                if (!empty($x[1])) {
                    $x = array_reverse($x, true);
                    if (isset($returnArray[$key])) {
                        unset($returnArray[$key]);
                    }
                    if (!isset($returnArray[$x[0]])) {
                        $returnArray[$x[0]] = array();
                    }
                    $first = true;
                    foreach ($x as $k => $v) {
                        if ($first === true) {
                            $b = $array[$key];
                            $first = false;
                        }
                        $b = array($v => $b);
                    }
                    $returnArray[$x[0]] = array_merge_recursive($returnArray[$x[0]], $b[$x[0]]);
                } else {
                    $returnArray[$key] = $array[$key];
                }
            }
        }
        return $returnArray;
    }

    /**
     * to parse a multidimention array to STD Class Object
     * 
     * @param Array $array Multidimention array to convert>
     * 
     * @author Priyank Saini <priyanksaini2010@gmail.com>
     * @access Public
     * @return Std Class Object 
     */
    public static function toObject($array)
    {
        $returnValue = new stdClass();
        if (is_array($array)) {
            foreach ($array as $key => $value) {
                $returnValue->$key = is_array($value) ? self::toObject($value) : $value;
            }
        } else {
            $returnValue = (object) $array;
        }

        return $returnValue;
    }
    
    /**
     * Method check if a request made is usable or not
     * 
     * @author Priyank Saini<priyanksaini2010@gmail.com>
     * @access public
     * @return boolean
     */
    public static function checkRequest()
    {
        if ($_SERVER['argc'] < 12 || $_SERVER['argv']['1'] == '') {
            $error = new ErrorHandler();
            $error->badRequest();
            return false;
        }
        return true;
    }
    
    /**
     * Resolve the arrguments passed from the Linux Shell
     * 
     * @access public
     * @throws Exception Bad Request 400
     * @author Priyank Saini <priyanksaini2010@gmail.com>
     * @return Array array of credentials and data passed from bash
     */
    public static function resolveCredential()
    {
        if (isset($_SERVER['argv'][1]) && $_SERVER['argv'][1]!='') {
            $args['username'] = isset($_SERVER['argv'][2]) ?$_SERVER['argv'][2] : '';
            $args['password'] = isset($_SERVER['argv'][4]) ?$_SERVER['argv'][4] : '';
            $args['domain'] = isset($_SERVER['argv'][6]) ?$_SERVER['argv'][6] : '';
            $args['repo'] = isset($_SERVER['argv'][8]) ?$_SERVER['argv'][8] : '';
            $args['title'] = isset($_SERVER['argv'][10]) ?$_SERVER['argv'][10] : '';
            $args['content'] = isset($_SERVER['argv'][11]) ?$_SERVER['argv'][11] : '';
            if (self::validateCredentials($args)) {
                return $args;
            }
        } else {
            $error = new ErrorHandler;
            $error->badRequest();
        }
    }
    
    /**
     * Method will Validate domain namd and other credentials Supplied
     * 
     * @param array $params Parameters sent from bash
     * 
     * @access Protected
     * @author Priyank Saini <priyanksaini2010@gmail.com>
     * @return boolesn Return true if all parameters are passed and valid
     */
    protected static function validateCredentials($args)
    {
        if (self::checkDomain($args['domain']) && self::checkAuth($args['username'], $args['password'])&& self::checkRepo($args['repo']) && self::checkContent($args['title'], $args['content']) ) {
            return true;
        }
    }
    
    /**
     * Check If domain suplied and is valid or not
     * 
     * @param string $domain
     * 
     * @access protected
     * @author Priyank Saini<priyanksaini2010@gmail.com>
     * @throws Bad Domain Exception
     * @return boolean
     */
    protected static function checkDomain($domain)
    {
        $registeredDomains = array_keys((array)self::getConfigVar('domain'));
        if ($domain != '' && in_array($domain, $registeredDomains)) {
            return true;
        }
        $error = new ErrorHandler;
        $error->badDomain();
    }
    
    /**
     * Check If domain suplied and is valid or not
     * 
     * @param type $username Username For API Authorization
     * @param type $password Password For API Authorization
     * 
     * @access protected
     * @author Priyank Saini<priyanksaini2010@gmail.com>
     * @throws Bad Auth Exception
     * @return boolean
     */
    protected static function checkAuth($username, $password)
    {
        if ($username != '' && $password != '') {
            return true;
        }
        $error = new ErrorHandler;
        $error->badAuth();
    }
    
    /**
     * Check If repo name suplied and is valid or not
     * 
     * @param string $repo repo to create issue
     * 
     * @access protected
     * @author Priyank Saini<priyanksaini2010@gmail.com>
     * @throws Bad Auth Exception
     * @return boolean
     */
    protected static function checkRepo($repo)
    {
        if ($repo != '') {
            return true;
        }
        $error = new ErrorHandler;
        $error->badRepo();
    }
    
    /**
     * Check If title and body of Issue is provided
     * 
     * @param string $title Title Of Issue
     * @param string $body  Body Of Issue
     * 
     * @access protected
     * @author Priyank Saini<priyanksaini2010@gmail.com>
     * @throws Bad Content Exception
     * @return boolean
     */
    protected static function checkContent($title, $body)
    {
        if ($title != '' && $body != '') {
            return true;
        }
        $error = new ErrorHandler;
        $error->badContent();
    }
    
}

?>