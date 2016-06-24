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
	function scrapeURL($url)
	{
		$html=file_get_contents($url);
		$new_doc = new DOMDocument();
		libxml_use_internal_errors(TRUE); //disable libxml errors
		if(!empty($html))
		{
			$new_doc->loadHTML($html);
			libxml_clear_errors(); //remove errors for bad html
			$new_xpath = new DOMXPath($new_doc);

			$statsTable = $new_xpath->query('//table[@id="problem_stats"]');

			foreach($statsTable as $table)
			{
	          	$table_row=$new_xpath->query('tr', $table);
	          	$i=0;
	          	foreach($table_row as $tr)
	          	{
	            	$td=$new_xpath->query('td', $tr);
	            	if($i==1)
	            	{ 
		            	$j=0;
		           		foreach ($td as $key) 
			            {
			                switch ($j) 
			                {
			        	        case 0:
			                    	$total_solved=$key->nodeValue;
			                      	break;
			                    case 1:
			                        $partly_solved=$key->nodeValue;
			                      	break;
			                    case 2:
			                        $submitted=$key->nodeValue;
			                      	break;
			                    case 3:
			                        $partly_acc=$key->nodeValue;                       
			                    	break;
			                    case 4:
			                        $total_acc=$key->nodeValue;
			                   		break;
			                    case 5:
			                        $wa=$key->nodeValue;
			                      	break;
			                    case 6:
			                        $cte=$key->nodeValue;
			                      	break;
			                    case 7:
			                        $rte=$key->nodeValue;
			                      	break;
			                    case 8:
			                        $tle=$key->nodeValue;
			                      	break;  
			                }
			                $j=$j+1;
			            }
		       		}
		        $i=$i+1;
		      }
		    }

		    $r_table = $new_xpath->query('//table[@class="rating-table"]');

    	    foreach($r_table as $table)
    	    {
            	$table_row=$new_xpath->query('tr', $table);
               	$i=0;
          		foreach($table_row as $tr)
          		{
            		$td=$new_xpath->query('td', $tr);
	            	foreach ($td as $key) 
	            	{
                		switch ($i) 
                		{
                    		case 4:
                    	    	$long_rank=$key->nodeValue;
                      			break;
		                    case 5:
		                        $long_rating=$key->nodeValue;
		                      	break;
		                    case 7:
		                        $short_rank=$key->nodeValue;
		                      	break;
		                    case 8:
		                        $short_rating=$key->nodeValue;                       
		                      	break;
		                    case 10:
		                        $LTime_rank=$key->nodeValue;
		                      	break;
		                    case 11:
		                        $LTime_rating=$key->nodeValue;
		                      	break;
		                }
                	$i=$i+1;
    	            }
            	}
            }
			
		}
		return array($total_solved, $partly_solved, $submitted, $partly_acc, $total_acc, $wa, $cte, $rte, $tle, $long_rank,$long_rating, $short_rank, $short_rating, $LTime_rank, $LTime_rating);
	}


	function showStats($total_solved, $partly_solved, $submitted, $partly_acc, $total_acc, $wa, $cte, $rte, $tle, $long_rank,$long_rating, $short_rank, $short_rating, $LTime_rank, $LTime_rating)
	{
		echo "<strong>PROBLEM STATISTICS</strong><br>";
		echo "Problems Solved: ".$total_solved."<br>Problems Partially Solved: ".$partly_solved."<br>Total Submimssions: ".$submitted."<br>Solutions Accepted: ". $total_acc."<br>Solutions Partially Accepted: ". $partly_acc."<br>Wrong Answers: ". $wa."<br>Compile Time Error: ". $cte."<br>Run Time Error: ". $rte."<br>Time Limit Exceeded: ". $tle."<br><br>";
		echo "<strong>Ranks And Ratings</strong><br>"; 
		echo "Long Ranks: ".$long_rank."  Rating: ".$long_rating."<br>Short Rank: ". $short_rank."  Rating: ". $short_rating."<br>LTime Rank: ". $LTime_rank."  Rating: ".$LTime_rating;		
		
	}

	function takeTo($url)
	{
		header("Location: $url"); /* Redirect browser */
	}
	