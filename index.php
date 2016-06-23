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
                    <form class="" role="form" action="index.php" method="GET" enctype="multipart/form-data">
                        <div class=" row form-group">
                            <label class="col-sm-3" ><h3>Name of the user</h3></label>
                            <div class="col-sm-5">
                                <br>
                                <input type="text" name="name" class="form-control" >
                            </div>      
                            <div class="col-sm-2">
                                <br>
                                <input type="submit" name="stats" value="Track Statistics" class="btn btn-sample">
                            </div>      
                            <div class="col-sm-2">
                                <br>
                                <input type="submit" name="viewProf" value="View Profile"  class="btn btn-sample">
                            </div>  
                        </div>
                    </form>
                </div>
            </center>        
        </div>
        <br><br><br><br><br>
        <div class="row">
            <div class="col-sm-3 col-sm-offset-3">
                <button type="submit" name="addUser" class="btn btn-sample btn-lg" data-toggle="modal" data-target="#addUser">Add New User</button> 
            </div>
            <div class="col-sm-3">
                <button type="submit"  name="showdb" class="btn btn-sample btn-lg" data-toggle="modal" data-target="#showdb">View Records</button>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>

        
    <div class="footer">
      <div class="container-fluid">
           <center><p class="footerText">Codechef Stalker By <a href="">Shreya</a></p></center>
      </div>
    </div>

    <!--Add User Modal-->
    <form class="modal fade" id="addUser" action="index.php" method="GET" enctype="multipart/form-data">
		<div class="modal-dialog modal-md">
  			<div class="modal-content">
			    <div class="modal-header">
        			<button type="button" class="close" data-dismiss="modal">&times;</button>
       				<h4 class="modal-title">Add New User</h4>
   				</div>
       			<div class="modal-body" id="group">
					<br>
              	  	<div class="row form-group">
                    	<label class="col-sm-4" ><center><h4>Name of the user</h4></center></label>
                    	<div class="col-sm-7">
                        	<input type="text" name="newname" class="form-control" autocomplete="off" />
                    	</div>      
               		 </div>
                	<div class="row form-group">
                    	<label class="col-sm-4" ><center><h4>Codechef Username</h4></center></label>
                    	<div class="col-sm-7">
                       		<input type="text" name="username" class="form-control" autocomplete="off" />
                   		</div>      
                    </div> 
                </div>
       			<div class="modal-footer">
      				<input type="submit" name="newUser" value="Add User" class="btn btn-default"/>
   				</div>	
    		</div>
		</div>	
	</form>


	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>

</HTML>

<?php
    require_once('resources/init.php');
    error_reporting(0);

	if(isset($_GET['newUser']))
    {	
    	$newname=trim($_GET['newname']);
    	$username=trim($_GET['username']);
    	if(empty($newname) || empty($username))
        {
            echo '<script>alert("Please Fill All Fields")</script>';
        }
        else
        {
            if(exitsInDatabase($newname))
            {
              echo '<script>alert("This name already exists in the database. Please select another name!")</script>';  
            }
            else
            {
                $url="https://www.codechef.com/users/".$username;

                $insert_query="INSERT INTO subjects (name, cfusername, url) values ('$newname','$username','$url')";
            }
            if(mysql_query($insert_query))
            {
                echo "<script>alert('Data Inserted In Database')</script>";
            }
        }

    }
    if(isset($_GET['stats']) || isset($_GET['viewProf']))
    {
        $name=trim($_GET['name']);
        if(empty($name))
        {
            echo '<script>alert("Please enter a name")</script>';
        }
        else
        {
            if(!exitsInDatabase($name))
            {
              echo '<script>alert("This name doesn\'t exist in database.<br> Add name and username to database and then you can search as and when wou want!")</script>';  
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