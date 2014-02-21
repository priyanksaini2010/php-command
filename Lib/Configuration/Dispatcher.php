<?php
/**
 * This is a base class for resolving url names and calling expected function
 * 
 * PHP 5
 * 
 * @package  php-command
 * @category Architecture
 * @author   Priyank Saini <priyanksaini2010@gmail.com>
 */
class Dispatcher
{
    
   public $controller;
    
   public function __construct()
   {
       $pathInfo  = ConfigFactory::resolvePath($_SERVER['PATH_INFO']);
       if (!empty($pathInfo) && count($pathInfo) >0 && isset($pathInfo['controller'])) {
           $this->resolveController($pathInfo['controller']);
       }else {
//           $error = throw Exception('Not Founf', $code, $previous);
            die('Through 404 Exception');
       }
   }
   
   public function resolveController($controller) 
   {
       $controllerName = ConfigFactory::getControllerInstance($controller);
//       $this->controller = new $controllerName();
   }
}
?>
