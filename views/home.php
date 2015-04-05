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
        <link rel="stylesheet" href="../assets/font-awesome-4.3.0/css/font-awesome.min.css" type="text/css">
        <link rel="stylesheet" href="../assets/font-awesome-4.3.0/css/font-awesome.css" type="text/css">
        
        <script>
                //function to get description of task
            function getPreview ( id )
            {
                var theUrl="../controllers/admin_controller.php?cmd=1&task_id="+id;
                var obj = sendRequest ( theUrl );		
                if ( obj.result === 1)
                {
                     $("#showaddpanel").slideUp ( 'slow', function ()
                    {
                       $ ( this ).hide ( );
//                       $ ( ".previewcontentheaderbody" ).show();
                    });
                    
                    $ ( ".previewcontentheaderbody" ).fadeIn ( 'slow', function ()
                    {
                        $ ( this ).show ( );
                         $(".previewcontentheaderbodyname2").text( obj.user_fname +" "+ obj.user_sname);
                    });
                    $ ( ".previewcontentheaderbodytitle" ).fadeIn ( 'slow', function ()
                    {
                        $ ( this ).show  ( );
                        $(".previewcontentheaderbodytitle2").text ( obj.task_title );
                    });
                    $ ( ".previewcontentheaderbodydescription" ).fadeIn ( 'slow', function ()
                    {
                        $ ( this ).show ( );
                        $(".previewcontentheaderbodydescription2").text ( obj.task_description );
                    });
                                            
                        console.log(obj.task_title);
                        console.log(obj.task_description);
                }
            }

            //function to send an ajax request
            function sendRequest ( u )
           {
               var obj = $.ajax({url:u,async:false});
                var result=$.parseJSON(obj.responseText);
                return result;
           }//end of sendRequest(u)
           
           
           //function to remove a tile
           $(function ( )
           {
               $ ( ".delete" ).click ( function ( )
               {
                 
                    var commentContainer = $ ( this ).parents ( ".showcontentdetailsinnertile" );
                    var icondelete = $ ( this ).children ( "#deleteicon" );
                    var id = $ ( this ).attr ( "id" );
                    console.log ( id );
                    var string = 'cmd=2&task_id='+ id ;

                    $.ajax ( 
                            {
                //                type: "POST",
                                url: "../controllers/admin_controller.php",
                                data: string,
                                cache: false,
                                success: function ( )
                                {
                                    icondelete.attr ( "class", "fa fa-spin fa-trash" );
                                    commentContainer.slideUp ( 'slow', function ( ) 
                                    {
                                        $ ( this ).remove ( );
                                    } );
                                 }

                            });
                            return false;
                });
            });
            
            
            //function to call the add task
            $ ( function ( )
            {
                $ ( ".newtaskbutton" ).click ( function ( )
                {
                    $ ( ".previewcontentheaderbody" ).fadeOut ( 'slow', function ()
                    {
                        $ ( this ).hide ( );
                    });
                    $ ( ".previewcontentheaderbodytitle" ).fadeOut ( 'slow', function ()
                    {
                        $ ( this ).hide  ( );
                    });
                    $ ( ".previewcontentheaderbodydescription" ).fadeOut ( 'slow', function ()
                    {
                        $ ( this ).hide ( );
                    });
                    
                    $("#showaddpanel").fadeIn ( 'slow', function ()
                    {
                         $ ( ".previewcontentheaderbody" ).show();
                       $ ( this ).show ( ).slideDown();
                      
                    });
//                    $ ( ".previewcontentheaderbody" ).show();
                });
            });
           
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
                       window.location.reload(true);
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
                                    Tasks
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
                                        <div class='showcontentdetailsinnertilename'>
                                        <span>{$row['user_fname']} {$row['user_sname']}</span>
                                          <div class='showcontentdetailsinnertiledelete showcontentdetailsinnertiledelete2' style='float:right; margin-right:10px'>
                                                <a class='delete' style='padding: 7px' id={$row['task_id']}><i id='deleteicon' class='fa fa-trash'></i></a>
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
                        <div class="showpreview2">
                            <div class="showpreviewinner">
                                <div class="showpreviewinner2">
                                    <div class="showpreviewinner2upper">
                                        <!--<span>Just Something will go here</span>-->
                                    </div>
                                    
                                    <div class="showpreviewinnercontent">
                                        <div class="showpreviewinnercontentheader">
                                            <div class="showpreviewinnercontentheaderinner">
                                                <div class="showpreviewinnercontentheaderinnerbuttons">
                                                    <button id="newtaskbutton" class="newtaskbutton" type="button">
                                                        <span style="padding-bottom: 7px; padding-top: 7px">
                                                            <i class="fa fa-2x fa-plus"></i>
                                                        </span>
                                                    </button>
                                                    <button id="deletetaskbutton" class="deletetaskbutton" type="button">
                                                        <span style="padding-bottom: 7px; padding-top: 7px">
                                                            <i class="fa fa-2x fa-trash"></i>
                                                        </span>
                                                    </button>
                                                    <button class="updatetaskbutton" type="button">
                                                        <span style="padding-bottom: 7px; padding-top: 7px">
                                                            <i class="fa fa-2x fa-pencil"></i>
                                                        </span>
                                                    </button>
                                                </div>
                                                
                                                <div class="previewcontentheaderbody">
                                                    <?php include '../views/add_task.php'; ?>
                                                    <button class="previewcontentheaderbodybutton">
                                                        <span>Somebutton</span>
                                                    </button>
                                                    <div class="showpreviewinnercontentheaderimage">
                                        
                                                     </div>
                                                    <div class="previewcontentheaderbodynamecontainer">
                                                        <div class="previewcontentheaderbodyname">
                                                            <span style="padding-left: 20px" class="previewcontentheaderbodyname2">Fredrick Abayie</span>
                                                        </div>
                                                        <div class="previewcontentheaderbodydate">
                                                            <span style="padding-left: 20px" class="previewcontentheaderbodydate2">Sat 04/04/2015 10:50pm</span>
                                                        </div>
                                                    </div>
                                                </div>                                                
                                            </div>
                                        </div>
                                        
                                        <div class="previewcontentheaderbodytitle">
                                            <span class="previewcontentheaderbodytitle2">Diseases In Africa</span>
                                       </div>
                                        
                                        <div class="previewcontentheaderbodydescription">
                                            <span style="padding-left: 20px" class="previewcontentheaderbodydescription2">Description</span>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>