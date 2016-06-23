<?php
	function exitsInDatabase($name)
	{
		$check_query="SELECT * FROM subjects WHERE name = '$name'";
		$run_result=mysql_query($check_query);
		if(mysql_num_rows($run_result)<1)
			return 0;
		else
			return 1;
	}
	function addToDB($newname,$username,$url)
	{
	    $insert_query="INSERT INTO subjects (name, cfusername, url) values ('$newname','$username','$url')";
	    if(mysql_query($insert_query))
        {
            echo "<script>alert('Data Inserted In Database')</script>";
        }

	}

	function getURL($name)
	{
		return "https://www.codechef.com/users/".$name;
	}

	function showStats($name)
	{

	}

	function takeTo($url)
	{
		echo "<script>$.get($url)</script>";
	}