<?php

if ( isset ( $_REQUEST [ 'cmd' ] ) )
{
    $cmd = $_REQUEST[ 'cmd' ];
    
    switch ( $cmd )
    {
        case 1:
            display_all_tasks ( );
            break;
        
        case 2:
            add_task ( );
            break;
         
        default:
    }//end of switch
    
}//end of if


/**
 * Function to display all tasks
 */
function display_all_tasks ( )
{
    include '../models/admin_class.php';
    $obj = new Admin ( );
        
    if ( $row = $obj->admin_display_all_tasks())
    {
    echo '{"result":1, "id":"' .$row['task_id'].'",'
                . '"title":"' .$row['task_title'].'",'
                . '"description":"' .$row['task_description'].'"}';
    }
    else
    {
        echo ' { "result":0, "status": "Failed to display" }';
    }
//    while ( $row = $obj->admin_display_all_tasks ( ) )
//    { 
//        echo ' { "result": 1, "tasks": [ { "task_id": $row[task_id], "task_title": $row[task_title] } ] }';
//    }//end of while
    
}//end of display_all_tasks()


/**
 * Function to get preview of a task
 */
function task_preview ( )
{
//     include 'tasks.php';
     
     $obj=new TASKS ( );
     $id = $_REQUEST [ 'id' ];
     $obj->select_a_task ( $id );

     while ( $row = $obj->fetch ( ) )
     {
         echo '{"result":1, "title":"' .$row['task_title'].'",'
                . '"name":"' .$row['nurse_name'].'",'
                . '"description":"' .$row['task_description'].'"}';
     }
}//end of task_preview ( )


/**
 * Function to add a new task
 */
function add_task ( )
{
//    include 'tasks.php';
    
    $task_title = $_REQUEST [ 'task_title' ];
    $task_description = $_REQUEST [ 'task_description' ];
    $task_start_date = $_REQUEST [ 'task_start_date' ];
    $task_end_date = $_REQUEST [ 'task_end_date' ];
    $nurse_id = $_REQUEST [ 'nurse_id' ];
    
    $obj = new TASKS ( );
        
    if ( $obj->add_new_task ( $task_title, $task_description, $task_start_date, $task_end_date, $nurse_id ) )
    {
        echo ' { "result":1, "status": "Successfully added a new task to the database" } ';
    }
    else
    {
         echo ' { "result":0, "status": "Failed to add a new task to the database" }';
    }
}//end of add_task ( )