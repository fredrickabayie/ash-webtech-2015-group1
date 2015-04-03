<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>DASHBOARD</title>
        
        <!--Custom Css-->
        <link href="../assets/stylesheets/dashboard.css" rel="stylesheet" type="text/css">
        
        <!-- jQuery --> 
        <script src="../assets/javascripts/jquery-2.1.3.js"></script>
        
        <script>
            display ( );
                //function to get description of task
        function display( )
        {
                var theUrl="../controllers/admin_controller.php?cmd=1";
                var obj = sendRequest ( theUrl );		
                if ( obj.result===1)
                {					
                        $("#something").text(obj.title);
                        console.log(obj.id);
                        console.log(obj.title);
                        console.log(obj.description);
                }
                else
                {
                        $("#header").text(obj.status);
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
        <div id="maincontainer">
            <div id="innercontainer">
                <div id="header">
                    
                </div>
                <div id="inner2container">
                    
                    <div id="leftnavmenu">
                        
                    </div>
                    
                    <div id="seperator"></div>   
                    
                    <div id="showcontent">
                        <div id="showcontenttop"></div>        
                            <div id="showcontenttoplabel">
                                    TASKS
                            </div>
                        
                            <div id="showcontenttopsearch">
                                <input id="something" type="text">                                
                            </div>
                        
                        <div id="showcontentdetails">
                            <div id="showcontentdetailsinner">
                                
                                <div id="showcontentdetailsinnertile">
                                    <!--<input id="showcontentdetailsinnertilecheckbox" type="checkbox">-->
                                    <!--<div id="showcontentdetailsinnertilename"><span></span></div>-->
                                 </div>
                               
                            </div>                            
                        </div>
                        
                    </div>
                    
                    <div id="seperator2"></div>
                    
                    <div id="showpreview">
                        
                    </div>
                    
                </div>
            </div>
        </div>
    </body>
</html>