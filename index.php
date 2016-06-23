<!DOCTYPE html>
<HTML lang="en">
<head>
	<!--meta tags-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="A simple web-scrapper in php to track activities of your friends on the online juudge, codechef.com">
    <meta name="keywords" content="codechef, stalk, stalker, php, web-scrapping, web-scraper, scrape, file_get_contents()">
    <meta name="author" content="Shreya">
	
	<title>Codechef Stalker</title>

	<link href="css/stylesheet.css" rel="stylesheet">
	 <!--css for Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">

    <!--Fonts-->
   	<link href='https://fonts.googleapis.com/css?family=Roboto+Slab' rel='stylesheet' type='text/css'>

</head>

<body style="background-color:rgba(12, 23, 75, 0.95); color:white; font-family: 'Roboto Slab', serif">
	<!--Navigation bar-->
    <nav class="navbar navbar-inverse ">
        <div class="container">
        <ul class="topnav">
            <li><a href="#">About Me</a></li>
            <li><a href="#">Instructions</a></li>
        </ul>
        </div>
    </nav>

    <!--form to stalk-->
    <div class="container">
        <div class="row">
            <center>
                <div class="col-sm-12">
                    <h2>Stalk User :D</h2>
                    <form class="" role="form" action="index.php" method="GET">
                        <div class=" row form-group">
                            <label class="col-sm-3" ><h3>Name of the user</h3></label>
                            <div class="col-sm-5">
                                <br>
                                <input type="text" name="name" class="form-control" >
                            </div>      
                            <div class="col-sm-2">
                                <br>
                                <input type="button" name="stats" value="Track Statistics" class="btn btn-sample">
                            </div>      
                            <div class="col-sm-2">
                                <br>
                                <input type="button" name="viewProf" value="View Profile"  class="btn btn-sample">
                            </div>  
                        </div>
                    </form>
                </div>
            </center>        
        </div>
        <br><br><br><br><br>
        <div class="row">
            <form>
                <div class="col-sm-3 col-sm-offset-3">
                    <input type="submit" name="addUser" value="Add New User" class="btn btn-sample btn-lg" />
                </div>
                <div class="col-sm-3">
                    <input type="submit" name="showdb" value="View Records" class="btn btn-sample btn-lg" />
                </div>
            </form>

        </div>
    </div>
    <br>
        
    <div class="footer">
      <div class="container-fluid">
           <center><p class="footerText">Codechef Stalker By <a href="">Shreya</a></p></center>
      </div>
    </div>
<!--
         <div class="row">
            <div class="col-sm-7">
                    <h2>Add User To Database</h2>
                    <form class="" role="form" action="" method="get">
                        <div class="row form-group">
                            <label class="col-sm-4" ><h3>Name of the user</h3></label>
                            <div class="col-sm-8">
                                <br>
                                <input type="text" name="name" class="form-control">
                            </div>      
                        </div>
                        <div class="row form-group">
                            <label class="col-sm-4" ><h3>Codechef Username</h3></label>
                            <div class="col-sm-8">
                                <br>
                                <input type="text" name="username" class="form-control">
                            </div>      
                        </div> 
                        <div class="form-group">
                            <div class="col-sm-12">
                                <br>
                                <center><input type="button" name="add" value="add" ></center>
                            </div>      
                        </div>   
                    </form>  
            </div>
            <div class="col-sm-5">
                    <br><br><br>
                    <br><br><br>
                    <center><button>Show Database</button></center>
            </div>
        </div>
    </div>
-->

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>

</HTML>

<?php
    require_once('resources/init.php');

    if(isset($_GET['stats']) || isset($GET['viewProf']))
    {
        $name=trim($_GET['name']);
        if(empty($name))
        {
            echo 'alert("Please enter the name")';
        }
        else
        {
            if(!exitsInDatabase($name))
            {
              echo 'alert("This name doesn\'t exist in database.<br> Add name and username to database and then you can search as and when wou want!")';  
            }
            else
            {
                if(isset($_GET['stats']))
                {   
                    showStats($name);
                }
                if(isset($GET['viewProf']))
                {
                    $url=getURL($name);
                    takeTo($url);
                }
            }
        }

    }
?>