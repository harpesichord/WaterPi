<?php namespace WaterPi\Http\Controllers;

use Request;
use Session;
use WaterPi\Http\Controllers\Controller;
use WaterPi\Http\Controllers\Validation;
use WaterPi\models\Zone;

class ZoneController extends Controller {

    /**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
    public function __construct()
	{
		//$this->middleware('guest');
	}
    
    /**
	 * Show the zones to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$zones = Zone::orderBy('NAME')->get();
		
		return view('zones.view_zones')->with('data', $zones);
	}
    
    /**
	 * Creates a new zone.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('zones.create_zone');
	}
	
	/**
	 * Creates a new zone.
	 *
	 * @return Response
	 */
	public function add()
	{
		$input = Request::all();
		$valid = Validation::createZone($input, true);
		
		if ($valid["status"])
		{
			$zo = new Zone();
			$zo->NAME = trim($input["name"]);
			$zo->RELAY_CHANNEL = trim($input["channel"]);
			$zo->DESCRIPTION = trim($input["desc"]);
			$zo->save();
			
			unset($input);
			$input = array();
		}
		
		return view('zones.create_zone')->with('data', $input)->with('errs', $valid);
	}
	
	/**
	 * Views a zone.
	 *
	 * @return Response
	 */
	public function viewZone($id)
	{
		$zone = Zone::where('ID', '=', $id)->first();
		
		if (!isset($zone))
			return $this->index();

		
		return view('zones.edit_zone')->with('data', $zone);
	}
	
	/**
	 * Updates a zone.
	 *
	 * @return Response
	 */
	public function updateZone()
	{
		$input = Request::all();
		
		$zo = Zone::find($input["id"]);
		
		if (!isset($zo))
		{
			$valid["status"] = false;
			$valid["errors"][] = "Error with page, please refresh and try again.";
		}
		else if (isset($input["delete"]))
		{
			Zone::destroy($input["id"]);
			return $this->index();
		}
		else if (isset($input["save"]))
		{
			$valid = Validation::createZone($input, false);
		
			if ($valid["status"])
			{
				$zo->NAME = trim($input["name"]);
				$zo->RELAY_CHANNEL = trim($input["channel"]);
				$zo->DESCRIPTION = trim($input["desc"]);
				$zo->save();
			}
		}
		
		return view('zones.edit_zone')->with('data', Zone::find($input["id"]))->with('errs', $valid);
	}
    
}    