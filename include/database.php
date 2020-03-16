<?php

$querycount = 0;
function connectdb()
{
	global $config;
	try 
	{
		$db = new PDO('mysql:host=' . $config['mysql_host'] . ';dbname=' . $config['mysql_db'], $config['mysql_user'], $config['mysql_passwd'], array(PDO::ATTR_PERSISTENT => false));	}
	catch (Exception $e) 
	{
			die('Unable to connect to database');
	}
	return $db;
}



function escapestringex($db,$string) //Used for escaping
{
	$escaped = $db->quote($string);
	return $escaped;
}
function myinsert($qdb, $dbquery,$debug = FALSE) 
{
	global $querycount;
	
	$querycount++;
	
	$qdb->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );

	$dbquery = $qdb->prepare($dbquery);

	$dbquery->execute();
	if(!$dbquery)
	{ 
		$dbquery = null;
		error_log('QUERY ERROR: from page '.$qdb->errorInfo().'', 0);
	}
	else
	{
		$dbquery = null;
	}
}

function myquery($qdb, $dbquery,$return = TRUE,$debug = FALSE) 
{
	global $querycount;
	$querycount++;

	$qdb->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );

	$dbquery = $qdb->prepare($dbquery);

	$dbquery->execute();

	if($return === TRUE)
	{
		if($dbquery)
		{
			$result_array = array();
			while($row = $dbquery->fetch(PDO::FETCH_ASSOC))
			{	
				$result_array[] = $row;
			}
			$dbquery = null;
			return $result_array;
		}
		else
		{
			error_log('QUERY ERROR: from page '.$qdb->errorInfo().'', 0);
			$dbquery = null;
			return 0;
		}
	}
}