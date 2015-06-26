<?php namespace WaterPi\Http\Controllers;

class Validation {
    
    public static function createZone($input)
	{
		$results = array();
		$results["errors"] = array();
		
		if (trim($input["name"]) == "")
            $results["errors"][] = "The Zone Name must be filled in.";
        if (!is_numeric(trim($input["channel"])) or (trim($input["channel"]) < 1 or trim($input["channel"]) > 8))
		    $results["errors"][] = "Channels can only be between 1 and 8.";
		    
		    
		if (count($results["errors"]) > 0) $results["status"] = false;
		else $results["status"] = true;
		
		return $results;
	}
    
}