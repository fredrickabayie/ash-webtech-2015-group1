<?php
session_start();
if ( isset ( $_SESSION [ 'user_type' ] ) && isset ( $_SESSION [ 'user_id' ] )  )
{
    if ( $_SESSION [ 'user_type' ] == 'admin' )
    {
        $user_id = $_SESSION [ 'user_id'];
       echo "<input style='display:none' id='user_id' class='user_id' type='text' value='$user_id'>";
    }
    else{
        echo "<input class='user_id' type='text' value='no id>";
    }
}
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
         <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
         <!--<meta name="viewport" content="width=device-width, initial-scale=2.0, maximum-scale=1.0, user-scalable=yes">-->
         <meta http-equiv="Pragma" content="no-cache">
         <meta http-equiv="Expires" content="-1">
         <meta http-equiv="X-UA-Compatible" content="IE=edge">
         
        <title>DASHBOARD</title>
        
        <!--Custom Css-->
        <link href="../assets/stylesheets/dashboard.css" rel="stylesheet" type="text/css">
        
        <!-- jQuery --> 
        <script src="../assets/javascripts/jquery-2.1.3.js"></script>
        
        <!--font awesome-->
        <link rel="stylesheet" href="../assets/stylesheets/font-awesome.min.css" type="text/css">
        <link rel="stylesheet" href="../assets/stylesheets/font-awesome.css" type="text/css">
        
        <script>
                //function to get description of task
            function getPreview ( id )
            {
                var theUrl="../controllers/admin_controller.php?cmd=1&task_id="+id;
                var obj = sendRequest ( theUrl );		
                if ( obj.result === 1)
                {
                       return $(".showpreviewinnercontentbody").text( obj.task_title);
                        console.log(obj.id);
                        console.log(obj.title);
                        console.log(obj.description);
                }
            }

            function sendRequest ( u )
           {
               var obj = $.ajax({url:u,async:false});
                var result=$.parseJSON(obj.responseText);
                return result;
           }//end of sendRequest(u)
           
           /**
            * 
            * @param {type} id
            * @returns {undefined}
            */
           function deleteTask ( id )
           {
               var url = "../controllers/admin_controller.php?cmd=2&task_id="+id;
               var obj = sendRequest ( url );		
                if ( obj.result === 1)
                {
                       return $(".showpreviewinnercontentbody").text( obj.status );
                }
           }
           
           //function to add a new task
        function insertTask ( )
        {
            var task_title = encodeURI(document.getElementById("task_title").value);
                var task_description = encodeURI(document.getElementById("task_description").value);
                var user_id = encodeURI(document.getElementById("user_id").value);
                                
                var url = "../controllers/admin_controller.php?cmd=3&task_title="+task_title+
                        "&task_description="+task_description+"&user_id="+user_id;
                
                var obj = sendRequest ( url );
                
                if ( obj.status === 1)
                {
//                     $("#divStatus").text(obj.status);
                }
                else
                {
//                    $("#divStatus").text(obj.status);
//                     $("#divStatus").css("backgroundColor", "red");
                    return false;                    
                }
        }
                   
        </script>
        
    </head>
    <body>
        <script>
            
            function loadadd ( )
            {
//                $("#addpopup").fadeToggle();
                $("#showaddpanel").show();
                
                console.log("in load add");
            }
            
        </script>
        <div class="maincontainer">
            <div class="innercontainer">
                <div class="header" id="header">
                    <div class="">
                        
                    </div>
                    
                </div>
                <div class="inner2container">
                    
                    <div class="leftnavmenu">
                        <div class="leftnavmenuinner">
                            <div class="leftnavmenuinnertop">
                                
                            </div>
                            
                            <div class="leftnavmenuinnerdown">
                                <div class="leftnavmenuinnerdownnav">
                                    <div>
                                        <button class="buttonsbuttons">Tasks</button>
                                    </div>
                                    <div>
                                        <button class="buttonsbuttons">Nurses</button>
                                    </div>
                                    <div>
                                        <button class="buttonsbuttons">Departments</button>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        
                    </div>
                    
                    <div class="seperator"></div>   
                    
                    <div class="showcontent">
                        <div class="showcontenttop"></div>        
                            <div class="showcontenttoplabel">
                                    
                            </div>
                        
                            <div class="showcontenttopsearch">
                                <input class="showcontenttopsearchfield" placeholder="Search" type="text">                                
                            </div>
                        
                        <div class="showcontentdetails">
                            <div class="showcontentdetailsinner">
                                <?php
                                
                                include '../models/admin_class.php';
                                $obj = new Admin ( ); 
                                $obj->admin_display_all_tasks ( );
                                
                                while ( $row = $obj->fetch ( )  )
                                {
                                echo "<div class='showcontentdetailsinnertile showcontentdetailsinnertile2' onclick='getPreview ({$row['task_id']})'>
                                        <input class='showcontentdetailsinnertilecheckbox showcontentdetailsinnertilecheckbox2' value={$row['task_id']} name=todelete[] type='checkbox'>
                                        <div class='showcontentdetailsinnertilename'><span>{$row['user_fname']} {$row['user_sname']}</span>
                                          <div class='showcontentdetailsinnertiledelete showcontentdetailsinnertiledelete2' style='float:right; margin-right:40pz'>
                                                <a style='padding: 7px' onclick='deleteTask ({$row['task_id']})'>X</a>
                                            </div>
                                         </div>
                                         <div class='showcontentdetailsinnertiletitle'><span></span>{$row['task_title']}</div>
                                          <div class='showcontentdetailsinnertiledescription'><span>{$row['task_description']}</span></div>
                                        </div>";
                                }
                               ?>
                            </div>                            
                        </div>
                        
                    </div>
                    
                    <div class="seperator2"></div>
                    
                    <div class="showpreview">
                        <div class="showpreviewinner">
                            <div class="showpreviewinnerbuttons">
                                <button class="newtaskbutton" onclick="loadadd ( )" type="button"><span>+</span></button>
                                <button class="deletetaskbutton" type="button" onclick="deleteTask ( id )"><span>*</span></button>
                            </div>
                            
                            <div class="showpreviewinnercontent">
                                <div class="showpreviewinnercontentheader">
                                    <div class="showpreviewinnercontentheaderimage">
                                        
                                    </div>
                                    
                                </div>
                                
                                <div class="showpreviewinnercontentbody">
                                    <?php include '../views/add_task.php'; ?>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </body>
</html>