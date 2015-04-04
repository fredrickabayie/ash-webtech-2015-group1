<!DOCTYPE html>
<html>
    <head><title>Add Modal</title></head>
     <!--<link type="text/css" rel="stylesheet" href="css/style.css">-->
    <body>
        <div id="showaddpanel" style="display: none">
        <div>
            <input id="task_title" name="task_title" type="text" placeholder="task title">
        </div><br> 
        <div>
            <input id="task_description" name="task_description" type="text" placeholder="task description" required="">
        </div><br>
        <div>
            <button id="add_button" type="button" name="add_button" onclick="insertTask ( )">Insert</button>
        </div><br>
        </div>
</body>
</html>