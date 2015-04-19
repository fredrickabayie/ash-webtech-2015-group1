<?php
session_start();
if ( isset ( $_SESSION [ 'user_type' ] ) && isset ( $_SESSION [ 'user_id' ] )  )
{
    if ( $_SESSION [ 'user_type' ] == 'regular' )
    {
        $user_id = $_SESSION [ 'user_id'];
        $path = $_SESSION ['path'];
       echo "<input style='display: none' id='user_id' class='user_id' type='text' value='$user_id'>";
       echo "<input style='display: none' id='path' class='path' type='text' value='$path'>";
    }
    else{
//        echo "<input class='user_id' type='text' value='no id'>";
        header("Location: index.php");
        exit();
    }
}
else{
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="en">
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
            

//            Function to load the list of task
            $ ( document ).ready ( function ( )
            {
               var url = "../controllers/user_controller.php?cmd=5";
               var obj = sendRequest ( url );
               var path = "";
                if ( obj.result === 1 )
                {
                    path = $(".path").val();
                    $("#profileimage").attr("src", path );
                    var div = "";
                    var timer;
                    for ( var index in obj.tasks )
                    {
                        div += "<div class='showcontentdetailsinnertile showcontentdetailsinnertile2'\n\
                                    onclick='getPreview ( "+obj.tasks [index].task_id+" )'>";
                        div += "<input class='showcontentdetailsinnertilecheckbox showcontentdetailsinnertilecheckbox2'\n\
                                    value="+obj.tasks [index].task_id+" name='todelete[]' type='checkbox'>";
                        div += "<div class='showcontentdetailsinnertilename'>";
                        div += "<span>"+obj.tasks [index].user_fname+" "+obj.tasks [index].user_sname+"</span>";
                        div += "<div class='showcontentdetailsinnertiledelete showcontentdetailsinnertiledelete2' \n\
                                    style='float:right; margin-right:10px'>";
                        div += "<a class='delete' style='padding: 7px' id="+obj.tasks [index].task_id+"><i id='deleteicon' \n\
                                    class='fa fa-trash-o'></i></a>";
                        div += "</div>";
                        div += "</div>";
                        div += "<div class='showcontentdetailsinnertiletitle'>\n\
                                    <span>"+obj.tasks [index].task_title+"</span></div>";
                        div += "<div class='showcontentdetailsinnertiledescription'>\n\
                                    <span>"+obj.tasks [index].task_description+"</span></div>";
                        div += "</div>";
                    }
                    $ ( ".showcontentdetailsinner" ).html ( div );
//                     $ ( "#divStatus" ).text ( "Found " + obj.products.length + " results" );
                }
                else
                {
//                        $ ( "#divStatus" ).text ( obj.message );
//                        $ ( "#divStatus" ).css ( "backgroundColor", "red" );
                }

                timer = setTimeout ( '(this)', 1000 );
            });


                //function to get description of task
            function getPreview ( id )
            {
                $(".previewprompttext").hide();
                $(".addtaskbutton").fadeOut().hide();
                $(".newtaskbutton").slideDown().show();
                $(".updatetaskbutton").slideDown().show();
                $(".edittaskbutton").slideDown().hide();
                var theUrl="../controllers/user_controller.php?cmd=1&task_id="+id;
                var obj = sendRequest ( theUrl );		
                if ( obj )
                {
                     $(".preview").slideDown ( 'slow', function ( )
                    {
                       $ ( this ).show( );
                    });             
                    
                    $(".showpreviewinnercontentheaderimage img").attr( "src", obj.user_picture );
                    $(".previewcontentheaderbodyname2").text( obj.user_fname +" "+ obj.user_sname );
                    $(".previewcontentheaderbodytitle2").text ( obj.task_title );
                    $(".previewcontentheaderbodydescription2").text ( obj.task_description );
                    $(".previewcontentheaderbodycollaborator2").text ( obj.task_collaborator );
                    $ ( ".showpreviewinner2upper").text ( obj.task_id );

                    console.log(obj.task_title);
                    console.log(obj.task_description);
                }
                else
                {
                    alert("failed to preview a task");
                }
                 $(".add").hide();
                 $(".update").hide();
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

                    var divContainer = $ ( this ).parents ( ".showcontentdetailsinnertile" );
                    var icondelete = $ ( this ).children ( "#deleteicon" );
                    var id = $ ( this ).attr ( "id" );  
                    console.log ( id );
                    var string = 'cmd=2&task_id='+ id ; 

                    $.ajax (
                            {
                //                type: "POST",
                                url: "../controllers/user_controller.php",
                                data: string,
                                cache: false,
                                success: function ( )
                                {
                                    icondelete.attr ( "class", "fa fa-spin fa-trash-o" );
                                    divContainer.slideUp ( 'slow', function ( ) 
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
                    $(".add").slideDown ( 'slow', function ( )
                    {
                        $(".addtaskbutton").slideDown().show();
                        $(".newtaskbutton").slideDown().hide();
                         $(".updatetaskbutton").slideDown().show();
                         $(".edittaskbutton").slideDown().hide();
                        $(this).show();
                    });
                    $(".preview").hide();
                    $(".update").hide();
                });
            });
            
            
            //Function to load available collaborators
            $( document ).ready ( function ( )
            {
                var user_id = $(".user_id").val();
               var url = "../controllers/user_controller.php?cmd=9&user_id="+user_id;
               var obj = sendRequest ( url );
               if ( obj.result === 1 )
               {
                   var option = ""; 
                           option += "<option value='0'>--collaborator--</option>";
                   for ( var index in obj.collaborator )
                   {
                       option += "<option value="+obj.collaborator[index].user_id+">\n\
                                     "+obj.collaborator[index].user_fname+"&nbsp"
                                        +obj.collaborator[index].user_sname+"</option>";
                   }
                   $(".collaborator").html ( option );
               }
               else
               {
                    
               }
            });
            
            
            //Function to delete multiple tasks
            $( function ( )
            {
                $(".deletetaskbutton").click ( function ( )
                {
//                    var delete_array = [];
                    var delete_id = $ ( ".showcontentdetailsinnertilecheckbox" ).val();
                    console.log ( delete_id );
//                    var url = "../controllers/admin_controller.php?cmd=8"+delete_id;
//                    var obj = sendRequest ( url ); 
                    if ( obj.result === 1 )
                    {
                        alert ("Deleted");
                    }
                    else
                    {
                        alert ("Not deleted");
                    }
                });
            });


           /**
            * Function to process the edit button
            * @returns {Boolean}
            */
           $ ( function ( ) 
           {
               $ ( ".updatetaskbutton" ).click ( function ( ) 
               {
                   $(".addtaskbutton").fadeOut().hide();
                   $(".newtaskbutton").slideDown().show();
                   $(".edittaskbutton").slideDown().show();
                   $(".updatetaskbutton").slideDown().hide();
                   var task_id = $ ( ".showpreviewinner2upper" ).text();
                   var task_title = $ ( ".previewcontentheaderbodytitle2" ).text();
                   var task_description = $ ( ".previewcontentheaderbodydescription2" ).text();

                   $(".update").slideDown ( 'slow', function ( )
                    {
                        $(this).show();
                    });
                    $(".preview").hide();
                    $(".add").hide();

                   $ ( "#update_task_id" ).attr( "value", task_id );
                   $ ( "#update_task_title" ).attr( "value", task_title );
                   $ ( "#update_task_description" ).html( task_description );         
               });
           });


           /**
            * 
            * @param {type} id
            * @returns {undefined}
            */
           function deleteTask ( id )
           {
               var url = "../controllers/user_controller.php?cmd=2&task_id="+id;
               var obj = sendRequest ( url );		
                if ( obj.result === 1)
                {
                       return $(".leftnavmenuinnernotificationinner").text( obj.status );
                       window.location.reload(true);
                }
           }//end of deleteTask


           //function to add a new task
        function insertTask ( )
        {
                var task_title = encodeURI(document.getElementById("task_title").value);
                var task_description = encodeURI(document.getElementById("task_description").value);
                var user_id = encodeURI(document.getElementById("user_id").value);
                var user_collaborator = document.getElementById ( "collaborator" );
                var task_collaborator = user_collaborator.options [ user_collaborator.selectedIndex ].value;

                var url = "../controllers/user_controller.php?cmd=3&task_title="+task_title+
                        "&task_description="+task_description+"&user_id="+user_id+
                        "&task_collaborator="+task_collaborator;

                var obj = sendRequest ( url );

                if ( obj.status === 1)
                {
                     $(".leftnavmenuinnernotificationinner").text( obj.status );
                }
                else
                {
//                    $("#divStatus").text(obj.status);
//                     $("#divStatus").css("backgroundColor", "red");
                    return false;                    
                }
        }//end of insertTask


                 //function to add a new task
        function editTask ( )
        {
                var update_task_id = document.getElementById("update_task_id").value;
                var update_task_title = document.getElementById("update_task_title").value;
                var update_task_description = document.getElementById("update_task_description").value;
                

                var url = "../controllers/user_controller.php?cmd=4&update_task_title="+update_task_title+
                        "&update_task_description="+update_task_description+"&update_task_id="+update_task_id;
                
                var obj = sendRequest ( url );

                if ( obj.status === 1)
                {
//                     $("#divStatus").text(obj.status);
                }
                else
                {
//                    $("#divStatus").text(obj.status);
//                    $("#divStatus").css("backgroundColor", "red");
                    return false;                    
                }
        }


//        function to search for a task
        $( function ( )
        {
            $(".showcontenttopsearchfield").keyup ( function ( )
            {
                $search_text = $ ( ".showcontenttopsearchfield" ).val ( );
                console.log ( $search_text );
                var url = "../controllers/user_controller.php?cmd=6&search_text="+$search_text;
                var obj = sendRequest ( url );

                if ( obj.result === 1 )
                {
                    var div = "";
//                    var timer;
                    for ( var index in obj.tasks )
                    {
                        div += "<div class='showcontentdetailsinnertile showcontentdetailsinnertile2'\n\
                                    onclick='getPreview ( "+ obj.tasks [index].task_id+" )'>";  
                        div += "<input class='showcontentdetailsinnertilecheckbox showcontentdetailsinnertilecheckbox2'\n\
                                    value="+ obj.tasks [index].task_id+" name=todelete[] type='checkbox'>";
                        div += "<div class='showcontentdetailsinnertilename'>";
                        div += "<span>"+obj.tasks [index].user_fname+"&nbsp"+obj.tasks [index].user_sname+"</span>";
                        div += "<div class='showcontentdetailsinnertiledelete showcontentdetailsinnertiledelete2' \n\
                                    style='float:right; margin-right:10px'>";
                        div += "<a class='delete' style='padding: 7px' id="+ obj.tasks [index].task_id+"><i id='deleteicon' \n\
                                    class='fa fa-trash-o'></i></a>";
                        div += "</div>";
                        div += "</div>";
                        div += "<div class='showcontentdetailsinnertiletitle'>\n\
                                    <span>"+obj.tasks [index].task_title+"</span></div>";
                        div += "<div class='showcontentdetailsinnertiledescription'>\n\
                                    <span>"+obj.tasks [index].task_description+"</span></div>";
                        div += "</div>";
                    }
                    $ ( ".showcontentdetailsinnertile" ).slideDown ( 'slow' );
                    $ ( ".showcontentdetailsinner" ).html ( div );

//                     $ ( "#divStatus" ).text ( "Found " + obj.products.length + " results" );
                }
                else
                {
//                        $ ( "#divStatus" ).text ( obj.message );
//                        $ ( "#divStatus" ).css ( "backgroundColor", "red" );
                }
            });
        });
        
        
        //function to show the search field
        $( function ( )
        {
            $("#searchicon").click( function ( )
            {
                $(".showcontenttopsearchfield").fadeIn("slow").show( );
                $("#searchicon").attr("class","fa fa-close").fadeIn();
//                $("#searchicon").attr("id","closeicon");
            });
        });
        
        
        //function to disable right click and show footer
//        $ ( document ).ready ( function ( )
//        {
//            $ ( document ).bind ("contextmenu", function ( event )
//            {
//                $(".footer").slideToggle("fast").show();
////                event.preventDefault();
////                $("<div class='custom-menu' style='z-index:1000; position:absolute; padding:2px; border:1px solid black; background-color:#C0C0C0'>\n\
////                    <ul>\n\
////                    <li>Refresh</li>\n\
////                    <li>Logout</li>\n\
////                    </ul></div>")
////                    .appendTo("body")
////                    .css({top: event.pageY, left: event.pageX});
////                alert("Right Click");
//                     return false;
//            });
//        });
//        
//        $(function ()
//        {
//            $("#mytasks").on("click", function ( )
//            {
//                $(document).load("mytasks.php");
//            });
//        });
        
        </script>

    </head>
    <body>

        <div class="maincontainer">
            <div class="innercontainer">
                <div class="header" id="header">
                     <?php            
                        include_once 'header.php';
                     ?>
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
                                        <button class="buttonsbuttons">
                                            <span><i class="fa fa-chevron-up">&nbsp;&nbsp;&nbsp;Tasks</i></span>
                                        </button>
                                    </div>
                                    <div>
                                        <button class="buttonsbuttons" id="mytasks">
                                            <span><i class="fa fa-book">&nbsp;&nbsp;&nbsp;My Tasks</i></span>
                                        </button>
                                    </div>
                                    <div>
                                        <button class="buttonsbuttons">Ongoing Tasks</button>
                                    </div>
                                    <div>
                                        <button class="buttonsbuttons">Completed Tasks</button>
                                    </div>
                                </div>
                            </div>

                            <div class="leftnavmenuinnernotification">
                                <div class="leftnavmenuinnernotificationinner">
                                    Notification:
                                </div>                                
                            </div>

                        </div>

                    </div>

                    <div class="seperator"></div>
                    
                    <div class="showcontent">
                               <?php
                                     include_once 'content.php';
                               ?>
                    </div>

                    <div class="seperator2"></div>

                    <div class="showpreview">
                        <div class="showpreview2" style="padding-top: 20px">
                            <div class="showpreviewinner">
                                <div class="showpreviewinner2">
                                    <div style="display: none" class="showpreviewinner2upper">
                                        <span>Just Something will go here</span>
                                    </div>

                                    <!--<div class="showpreviewinnercontent">-->
                                    <div class="showpreviewinnercontentheaderinnerbuttons" style="padding-top: 20px">
                                                                                
                                            <button id="addtaskbutton" onclick="insertTask ( )" title="New task" class="addtaskbutton" type="button">
                                                  <span style="padding-bottom: 7px; padding-top: 7px">
                                                      <i id="addtaskicon" class="fa fa-2x fa-code"></i>
                                                  </span>
                                              </button>
                                        
                                             <button id="newtaskbutton" title="New task" class="newtaskbutton" type="button">
                                                  <span style="padding-bottom: 7px; padding-top: 7px">
                                                      <i id="newtaskicon" class="fa fa-2x fa-plus"></i>
                                                  </span>
                                              </button>
                                        
                                              <button id="deletetaskbutton" title="Delete Tasks" class="deletetaskbutton" type="button">
                                                  <span style="padding-bottom: 7px; padding-top: 7px">
                                                      <i class="fa fa-2x fa-trash-o"></i>
                                                  </span>
                                              </button>
                                        
                                              <button class="updatetaskbutton" title="Edit Task" type="button">
                                                  <span style="padding-bottom: 7px; padding-top: 7px">
                                                      <i class="fa fa-2x fa-flip-horizontal fa-pencil"></i>
                                                  </span>
                                              </button>
                                        
                                              <button id="edittaskbutton" onclick="editTask ( )" title="New task" class="edittaskbutton" type="button">
                                                  <span style="padding-bottom: 7px; padding-top: 7px">
                                                    <i id="edittaskicon" class="fa fa-2x fa-flip-horizontal fa-pencil-square"></i>
                                                  </span>
                                              </button>
                                        
                                    </div>

                                        <?php
                                        include_once 'preview.php';
                                        include_once 'add_task.php';
                                        include_once 'update_task.php';
                                        ?>
                                    
                                    <div class="previewprompttext" style="width: 100%; height: 100%; padding-top: 400px;
                                         text-align: center">
                                        Please select a task to preview its details
                                    </div>
                                    
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div style="display: none" class="footer" id="footer">
            
        </div>
    </body>
</html>