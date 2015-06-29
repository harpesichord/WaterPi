<?php namespace WaterPi\Http\Controllers;

use WaterPi\models\Zone;

class Validation {
    
    public static function createZone($input, $new)
	{
		$results = array();
		$results["errors"] = array();
		
		if (trim($input["name"]) == "")
            $results["errors"][] = "The Zone Name must be filled in.";
        if ($new and Zone::where('NAME', '=', trim($input["name"]))->count() > 0)
        	$results["errors"][] = "There is already a zone with the name '" . trim($input["name"]) . "'.";
        if (!is_numeric(trim($input["channel"])) or (trim($input["channel"]) < 1 or trim($input["channel"]) > 8))
		    $results["errors"][] = "Channels can only be between 1 and 8.";
	    if (is_numeric(trim($input["channel"])) and Zone::where('RELAY_CHANNEL', '=', trim($input["channel"]))->count() > 0)
		    $results["errors"][] = "There is already a zone on this channel.";
		    
		if (count($results["errors"]) > 0) $results["status"] = false;
		else $results["status"] = true;
		
		return $results;
	}
    
}