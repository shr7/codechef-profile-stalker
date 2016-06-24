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
	function showDB()
	{
		$show_query="SELECT * FROM subjects";
		$run_result=mysql_query($show_query);
		while ($row_result=mysql_fetch_array($run_result)) {
			$name=$row_result['name'];
			$username=$row_result['cfusername'];
			$url=$row_result['url'];
			echo "<h5>".$name."   "."<a href=\"$url\" target='_blank'>$url</a>"."</h5><br>";

		}

	}

	function getURL($name)
	{
		$url_query="SELECT url FROM subjects WHERE name = '$name'";
		$run_query=mysql_query($url_query);
		$row=mysql_fetch_row($run_query);
		return $row[0];

	}

	function showStats($name)
	{

	}

	function takeTo($url)
	{
		header("Location: $url"); /* Redirect browser */
		exit();
	}