<?php

        //this needs to be changed on real server
	$backendUrl = 'http://127.0.0.1/FINAL/backend/app/QUERY/';
        //$backendUrl = 'http://www.network-issues.com/backend/app/QUERY/';
        

	function backendCall($url, $asociativeArray)
	{
		global $backendUrl;
		
		$fullUrl = $backendUrl.$url.".php?".http_build_query($asociativeArray);
		$json_raw = file_get_contents($fullUrl);
		
		$json = trim($json_raw, ")");
		$json = trim($json, "	");
		$json = trim($json, "(");
		
		return json_decode($json, true);
	}
?>