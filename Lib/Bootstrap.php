<?php 



function __autoload($class)
{
    require_once ('Configuration/'.$class.'.php');
}
function pr($data)
{
    echo "<pre>";
    print_r($data);
    die;
}
define('DS', '/');
require_once ('Configuration/Router.php');
?>
