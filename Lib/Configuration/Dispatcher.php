<?php
/**
 * This is a base class for Dispatching Http Client and Invooking Api
 * 
 * PHP 5
 * 
 * @package  php-command
 * @category Architecture
 * @author   Priyank Saini <priyanksaini2010@gmail.com>
 */
class Dispatcher
{
    
   /**
    * This variable stores the parameters passed
    *
    * @var array 
    */
   public $args;
    
   /**
    * Constructor would invoke base API And Client and set Arguuments
    * 
    * @access public
    * @author Priyank Saini <priyanksaini2010@gmail.com>
    * @throws Bad Request Exception
    */
   public function __construct()
   {
       try {
           $this->args  = ConfigFactory::resolveCredential();
           $this->base = new Api(array('username'=>$this->args['username'],'password'=>$this->args['password']), 
                                 array('title'=>$this->args['title'],'content' => $this->args['content']), 
                                 array('domain'=>$this->args['domain'], 'repo'=>$this->args['repo']));
       } catch (Exception $ex) {
           echo $ex->getMessage();
           exit;
       }
       
   }
}
?>
