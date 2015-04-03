<?php

/**
 * Including others files into this document
 */
include_once ( 'adb.php' );

/**
 * Creating an instance of other class in the include files
 */
class Admin extends adb
{
    
    /**
     * Constructor
     */
    function _construct ( )
    {
        $this->establish_connection ( );
    }//end of constructor
    
    /**
     * Destructor
     */
    function _destruct ( )
    {
        $this->close_connection ( );
    }//end of destructor
        
    
    /**
     * Function to check nurse_id and nurse_password
     */
    function admin_display_all_tasks ( )
    {
       $display_query = "SELECT task_id, task_title, task_description FROM system_tasks limit 1"; 
       if ( !$this->query ( $display_query ) )
       {
           echo 'error running query';
       }
//       return $this->query ( $display_query );
       return $this->fetch ( );
    }//end of add_new_task
        
}//end of class