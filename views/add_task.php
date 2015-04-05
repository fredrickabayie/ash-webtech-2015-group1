<!DOCTYPE html>
<html>
    <head><title>Add Modal</title></head>
     <!--<link type="text/css" rel="stylesheet" href="css/style.css">-->
    <body>
        <style>
            .add_button
{
/*    webkit-transition: background 0.1s ease-in-out;
    -moz-transition: background 0.1s ease-in-out;
    -ms-transition: background 0.1s ease-in-out;
    -o-transition: background 0.1s ease-in-out;*/
    /*font-family: cursive;*/
    font-size: 17px;
    box-shadow: none;
    border-style: none;
    width: 370px;
    height: 40px;
    display: inline-block;
    background-color: #00B159;
    color: white;
    border-radius: 5px;
    /*box-shadow: 0px 3px 0px 0px #008744;*/
}

.add_button:hover
{
    cursor: pointer;
   background-color:#008744;
}

.add_button:active
{
    /*box-shadow: 0px 2px 0px 0px #3293ba;*/
}

.task_title
{
    padding-left: 15px;
    padding-right: 15px;
    font-family: 'Helvetica Neue', Helvetica, sans-serif;;
    font-size: 15px;
    border: 1px solid black;
    /*width: 370px;*/
    width: 100%;
    height: 35px;
    border-radius: 3px;
/*     box-shadow: none;*/
    /*border-style: none;*/
}

.task_description
{
    padding-left: 2px;
    padding-right: 2px;
    font-family: 'Helvetica Neue', Helvetica, sans-serif;;
    font-size: 15px;
    border: 1px solid black;
    /*width: 370px;*/
    width: 100%;
    height: 135px;
    border-radius: 3px;
/*     box-shadow: none;*/
    /*border-style: none;*/
}
        </style>
        <div id="showaddpanel" style="display: none">
        <div>
            <input class="task_title" id="task_title" name="task_title" type="text" placeholder="task title">
        </div><br> 
        <div>
            <textarea class="task_description" id="task_description" name="task_description" type="text" placeholder="task description" required="">
            </textarea>
        </div><br>
        <div>
            <button class="add_button" id="add_button" type="button" name="add_button" onclick="insertTask ( )">Insert</button>
        </div><br>
        </div>
</body>
</html>