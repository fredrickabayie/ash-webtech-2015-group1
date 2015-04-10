<?php

if ( isset ( $_REQUEST [ 'cmd' ] ) )
{
    $cmd = $_REQUEST[ 'cmd' ];
    
    switch ( $cmd )
    {
        case 1:
            task_preview ( );
            break;
        
        default:
            echo '{"result":0,message:"unknown command"}';
            break;
    }//end of switch
    
}//end of if


function get_users ( )
{
    include_once 'user_class.php';
    $obj = new Users ( );
    $row = $obj->get_all_users();
    
    echo '{"result":1, "users" [{';
    while ( $row )
    {
        json_encode ( $row );
        if ( $row = $obj->get_all_users() )
        {
            echo ',';
        }
    }//end of while
    echo '}]';
    
}//end of get_users()


/**
 * Function to display all tasks
 */
function display_tasks ( )
{
    include '../models/admin_class.php';
    $obj = new Admin ( );
       
    if ( $obj->admin_display_all_tasks ( ) )
    {
        $row = $obj->fetch ( );
        echo '{"result":1, "tasks": [';
        while ( $row )
        {
            echo '{"task_id": "'.$row ["task_id"].'", "task_title": "'.$row ["task_title"].'", 
            "task_description": "'.$row ["task_description"].'",  "user_sname": "'.$row ["user_sname"].'",
            "user_fname": "'.$row ["user_fname"].'"}';
            
            if ($row = $obj->fetch ( ) )   {
                    echo ',';
            }
        }
            echo ']}';
    }   else
    {
        echo '{"result":0,"message": "An error occured for select product."}';
    }
}//end of display_all_tasks()