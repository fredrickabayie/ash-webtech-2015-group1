<?php

/**
 * Including others files into this document
 */
include_once ( 'adb.php' );

/**
 * Creating an instance of other class in the include files
 */
class Users extends adb
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
     * @return type Returning the result of the query
     */
    function user_display_tasks ( $user_id )
    {
       $display_query = "select task_id, task_description, task_title, user_fname, user_sname
                                from system_tasks
                                join system_users
                                on system_tasks.user_id=system_users.user_id 
                                and system_tasks.user_id='$user_id'
                                order by task_id desc"; 
       return $this->query ( $display_query );
    }//end of_user_display_tasks ( )
    
    
    /**
     * Function to preview a selected id
     * @param type $task_id The id of task to be previewed
     * @return type Returning the result of the query
     */
    function user_preview_task ( $task_id )
    {
        $preview_query = "select task_id, task_description, task_title, user_fname, user_sname, system_tasks.user_id
                                    from system_tasks
                                    join system_users
                                    on system_users.user_id=system_tasks.user_id and system_tasks.task_id='$task_id'";
        return $this->query ( $preview_query );
    }//end of user_preview_task ( $task_id )
    
    
    /**
     * Function to delete a task
     * @param type $task_id The id of the task to delete
     * @return type Returning the result of the query
     */
    function user_delete_task ( $task_id )
    {
        $delete_query = "delete from system_tasks where task_id='$task_id'";
        return $this->query ( $delete_query );
    }//end of user_delete_task ( $task_id )
    
    
    /**
     * Function to add a new task by the admin
     * @param type $user_id The user id of the admin
     * @return type Returning the result of the query
     */
    function user_add_new_task ( $task_title, $task_description, $admin_id )
    {
        $add_query = "insert into `system_tasks` ( `task_title`, `task_description`, `user_id` )"
                . "values ( '$task_title', '$task_description', '$admin_id' )";
        return $this->query ( $add_query );        
    }//end of user_add_new_task ( $admin_id )
    
    /**
     * 
     * @param type $task_id
     * @param type $task_title
     * @param type $task_description
     * @param type $task_start_date
     * @param type $task_end_date
     * @return type Returning the result of the query
     */
    function user_update_task ( $task_id, $task_title, $task_description )
    {
        $update_query = "update system_tasks set system_tasks.task_title='$task_title',
                                   system_tasks.task_description='$task_description'
                                   where system_tasks.task_id='$task_id'";
        return $this->query ( $update_query );
    }//end of update or edit task
        
}//end of class