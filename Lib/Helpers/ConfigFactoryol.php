<?php
/**
 * Common Nuts and Bolts.Contains Application configuration variables,Parsed Via Config INI And other usefull functions
 * 
 * PHP version 5.3.8
 *
 * @category Configuration
 * @package  GroupOn
 * @author   Priyank Saini <priyank.saini@kelltontech.com>
 * @license  http://groupon.com/ HR Licence
 * @link     http://groupon.com/
 */

/**
 * Common Nuts and Bolts.Contains Application configuration variables,Parsed Via Config INI And other usefull functions
 * 
 * PHP version 5.3.8
 *
 * @category Configuration
 * @package  GroupOn
 * @author   Priyank Saini <priyank.saini@kelltontech.com>
 * @license  http://groupon.com/ HR Licence
 * @link     http://groupon.com/
 */
class ConfigFactory
{

    /**
     * to get application configuration varibales   
     * 
     * @param  string $name  varaible name to fetch
     * @param  string $index index of varaible name to fetch
     * 
     * @author Priyank Saini <priyank.saini@kelltontech.com>
     * @access public
     * @return mixed array or string based on arguments 
     * @todo Set ini path accordin to Yii
     */
    public static function getConfigVar($name, $index = '')
    {
        $ini_array = self::recursive_parse(self::parse_ini_file_advanced('../Configuration/config.ini'));
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
     * @author Priyank Saini <priyank.saini@kelltontech.com>
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
     * @author Priyank Saini <priyank.saini@kelltontech.com>
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
     * @author Priyank Saini <priyank.saini@kelltontech.com>
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
     * to pass string through for XSS prevention 
     * 
     * @param string $string String to sanitize
     * @param string|array $options If string, DB connection being used, otherwise set of options
     * 
     * @author Priyank Saini<priyank.saini@kelltontech.com>
     * @access Pubblic
     * @return String 
     * @todo include satizzing compoenet and santize accordingly
     */
    public static function cleanStr($string, $options = array()) 
    {
        if (is_array($string) || is_object($string)) {
            return $string;
        }
//        App::uses('Sanitize', 'Utility');
        $options['encode'] = true;
        $options['remove_html'] = true;
//        $cleanStr = Sanitize::clean($string, $options);
        $cleanStr = $string;
        return $cleanStr;
    }
}

?>