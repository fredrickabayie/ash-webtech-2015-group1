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
    </head>
    <body>
        <div id="header">
            <div id="innerheader">
                <div id="innerheaderleft">
                    <div id="innerheaderleftlogo">
                        
                    </div>
                </div>
            
                 <div id="innerheaderright">
                     <div id="innerheaderrightprofilepicture">
                         
                     </div>
                </div>
            </div>
        </div>
        
        <div id="contentwrapper">
            <div id="leftnavigationmenu">
                <ul class="nav">
                    <li>
                        <a href="#">Nurses</a>
                    </li>
                    <li>
                        <a href="#">Tasks</a>
                    </li>
                     <li>
                        <a href="#">Departments</a>
                    </li>
                </ul>
            </div>
            
            <div id="displaycontainer">
                <div id="searchbar">
                    <input id="searchfield" name="searchfield" type="text" placeholder="Search">
                    <span><button type="button">Search</button></span>
                </div>
                
                <div id="displaycontent" style="overflow: auto">
                    <?php
                    
                        for ( $i = 0; $i < 40;  $i++ )
                        {
                       echo "<table id='contenttable'>
                                    <div id='cou'>
                                    <div><input type=checkbox style=float:left></div>
                                        <tr><td style='font-size: 20px; font-weight: normal'>Ayeley Commodore-Mensah</td><td>logos</td></tr>
                                        <tr><td style='font-size: 15px; height: 17px; color: #333'>Ashesi Female Premier League</td><td>2:01 PM</td></tr>
                                    </div>
                                </table> ";        
                        }
                    ?>
                </div>
                
                <div id="previewcontent">
                    
                </div>
            </div>
        </div>
        
    </body>
</html>
