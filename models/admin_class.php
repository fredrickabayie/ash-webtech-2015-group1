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
       $display_query = "select task_id, task_description, task_title, user_fname, user_sname
                                from system_tasks
                                join system_users
                                on system_tasks.user_id=system_users.user_id"; 
       if ( !$this->query ( $display_query ) )
       {
           echo 'error running query';
       }
       return $this->query ( $display_query );
    }//end of add_new_task
    
    
    /**
     * Function to preview a selected id
     * @param type $task_id id of task to be previewed
     */
    function admin_preview_task ( $task_id )
    {
        $preview_query = "";
        if ( !$this->query ( $preview_query ) )
        {
            echo "error running preview query";
        }
        return $this->query ( $preview_query );
    }
        
}//end of class