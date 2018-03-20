<!DOCTYPE html>
<?php
	session_start();
?>
<html>
    

    <head>
        <link rel="stylesheet" href="FormStyle_StaffPage.css">
        <meta charset="UTF-8">
    </head>
    
    <h1>

        htis is h1!
        
    </h1>
    
    <body>
                <?php
        // put your code here
        /* session_start();
        echo $_COOKIE["id"];
        echo $_COOKIE["state"];*/
        ?>
       <h1>Staff Page</h1>

       <div class="Options">
           <?php if ($_SESSION["pos"] == "Researcher") {echo '<a href="https://zeno.computing.dundee.ac.uk/2017-agile/team1/website/NewProject.php"> New Project</br></a>';} ?>
           <a href="https://zeno.computing.dundee.ac.uk/2017-agile/team1/website/ViewCurrentProjects.php"> All Projects</br></a>
           <?php if ($_SESSION["pos"] == "RIS") {echo '<a href="https://zeno.computing.dundee.ac.uk/2017-agile/team1/website/ViewCurrentProjects.php?pageType=3"> Unread Projects</br></a>';} ?>
           <a href="https://zeno.computing.dundee.ac.uk/2017-agile/team1/website/ViewCurrentProjects.php?pageType=1"> Pending Projects</br></a>
           <a href="https://zeno.computing.dundee.ac.uk/2017-agile/team1/website/ViewCurrentProjects.php?pageType=2"> Approved Projects</br></a>
           <a href='https://zeno.computing.dundee.ac.uk/2017-agile/team1/website/logout.php'> Log Out </br></a>
           <a href='https://www.dundee.ac.uk/'>University Main Site</br></a>
       </div>
       




    </body>

</html>
    