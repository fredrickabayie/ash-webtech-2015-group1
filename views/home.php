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
         <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0, user-scalable=yes">
         <meta http-equiv="Pragma" content="no-cache">
         <meta http-equiv="Expires" content="-1">
         <meta http-equiv="X-UA-Compatible" content="IE=edge">
         
        <title>DASHBOARD</title>
        
        <!--Custom Css-->
        <link href="../assets/stylesheets/dashboard.css" rel="stylesheet" type="text/css">
        
        <!-- jQuery --> 
        <script src="../assets/javascripts/jquery-2.1.3.js" type="text/javascript"></script>
        
        <!--font awesome-->
        <link rel="stylesheet" href="../assets/stylesheets/font-awesome.min.css" type="text/css">
        <link rel="stylesheet" href="../assets/stylesheets/font-awesome.css" type="text/css">
        
        <script type="text/javascript">
            display ( );
                //function to get description of task
            function display ( )
            {
                var theUrl="../controllers/admin_controller.php?cmd=1";
                var obj = sendRequest ( theUrl );		
                if ( obj.result===1)
                {
                        $("#header").text(obj.title);
                        console.log(obj.id);
                        console.log(obj.title);
                        console.log(obj.description);
                }
                else
                {
//                     $("#header").text(obj.status);
                }
            }

            function sendRequest(u)
           {
               var obj = $.ajax({url:u,async:false});
                var result=$.parseJSON(obj.responseText);
                return result;
           }
        
        </script>
        
    </head>
    <body>
        <div class="maincontainer">
            <div class="innercontainer">
                <div class="header" id="header">
                    
                </div>
                <div class="inner2container">
                    
                    <div class="leftnavmenu">
                        
                    </div>
                    
                    <div class="seperator"></div>   
                    
                    <div class="showcontent">
                        <div class="showcontenttop"></div>        
                            <div class="showcontenttoplabel">
                                    
                            </div>
                        
                            <div class="showcontenttopsearch">
                                <input class="" type="text">                                
                            </div>
                        
                        <div class="showcontentdetails">
                            <div class="showcontentdetailsinner">
                                
                                <div class="showcontentdetailsinnertile">
                                    <input class="showcontentdetailsinnertilecheckbox" type="checkbox">
                                    <div class="showcontentdetailsinnertilename"><span>Commodo Dragon</span></div>
                                     <div class="showcontentdetailsinnertiletitle"><span></span>Malaria Research</div>
                                      <div class="showcontentdetailsinnertiledescription"><span>Africa needs to discover new frontiers in the course of fighting poverty amongst her people.  Ghana, the gateway to Africa, must lead the way, and education of these street and vulnerable children is the key.</span></div>
                                 </div>
                               
                            </div>                            
                        </div>
                        
                    </div>
                    
                    <div class="seperator2"></div>
                    
                    <div class="showpreview">
                        <div class="showpreviewinner">
                            <div class="showpreviewinnerbuttons">
                                <button class="newtaskbutton" type="button"><span class="fa-2x fa-android"></span></button>
                                <button class="deletetaskbutton" type="button"><span class="fa-2x fa-android"></span></button>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </body>
</html>