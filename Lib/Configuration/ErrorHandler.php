<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class ErrorHandler
{
    
    
    /**
     * This method will show bad request error
     * 
     */
    public function badRequest()
    {
        throw new Exception('Bad Request',400);
    }
}
?>
