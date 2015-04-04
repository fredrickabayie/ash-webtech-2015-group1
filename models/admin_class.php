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
     * @return type Description
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
    }//admin_display_all_tasks ( )
    
    
    /**
     * Function to preview a selected id
     * @param type $task_id The id of task to be previewed
     * @return type Description
     */
    function admin_preview_task ( $task_id )
    {
        $preview_query = "select task_id, task_description, task_title, user_fname, user_sname
                                    from system_tasks
                                    join system_users
                                    on system_users.user_id=system_tasks.user_id and system_tasks.task_id='$task_id'";
        if ( !$this->query ( $preview_query ) )
        {
            echo "error running preview query";
        }
        return $this->query ( $preview_query );
    }//end of admin_preview_task ( $task_id )
    
    
    /**
     * Function to delete a task
     * @param type $task_id The id of the task to delete
     * @return type Returning true or false
     */
    function admin_delete_task ( $task_id )
    {
        $delete_query = "delete from system_tasks where task_id='$task_id'";
        if ( !$this->query ( $delete_query ) )
        {
            echo "error running delete query";
        }
        return $this->query ( $delete_query );
    }//end of admin_delete_task ( $task_id )
    
    
    /**
     * Function to add a new task by the admin
     * @param type $admin_id The user id of the admin
     * @return type Returning true if the query is successful
     */
    function admin_add_new_task ( $task_title, $task_description, $admin_id )
    {
        $add_query = "insert into system_tasks ( task_title, task_description, user_id )"
                . "values ( '$task_title', '$task_description', '$admin_id' );";
        if ( !$this->query ( $add_query ) )
        {
            echo "error running admin add task query";
        }
        return $this->query ( $add_query );
    }//end of admin_add_new_task ( $admin_id )
    
        
}//end of class