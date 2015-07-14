<?php namespace WaterPi\Http\Controllers;

use Request;
use Session;
use WaterPi\Http\Controllers\Controller;
use WaterPi\Http\Controllers\Validation;
use WaterPi\models\Zone;
use WaterPi\models\FlowRate;

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
	
	public function flowRates()
	{
		return view('zones.flow_rate');
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
			$zo->ACTIVE = isset($input["active"]);
			$rate = 0.0;
			$zo->save();
			
			$flowRateIDs = $zo->FlowRates->lists('ID');
			if (count($flowRateIDs) <= 0) $flowRateIDs = array();
			
			for($index = 0; $index < count($input["diameter"]); $index++)
			{
				$flow = ($input["flowRatesID"][$index] == -1 ? new FlowRate() : $zo->FlowRates->find($input["flowRatesID"][$index]));
				$diam = floatval(trim($input["diameter"][$index]));
				$pressure = floatval(trim($input["pressure"][$index]));
				$quantity = floatval(trim($input["quantity"][$index]));
				$rate += ($quantity *  (28.9 * pow($diam, 2) * sqrt($pressure)));
				
				$flow->DIAMETER = $diam;
				$flow->PRESSURE = $pressure;
				$flow->QUANTITY = $quantity;
				
				$flow->ZONE = $zo->ID;
				$flow->save();
				
				if ($zo["flowRatesID"][$index] != -1) $flowRateIDs = array_diff($flowRateIDs, array($zo["flowRatesID"][$index]));
			}
			
			$zo->FLOW_RATE = $rate;
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
		$zone = Zone::find($id);
		
		if (!isset($zone))
		{	
			header( "Location: /zones" );
			exit();
		}

		
		return view('zones.edit_zone')->with('data', $this->getZoneInfo($zone));
	}
	
	/**
	 * Updates a zone.
	 *
	 * @return Response
	 */
	public function updateZone()
	{
		$input = Request::all();
		
		$zo = Zone::find(intval($input["id"]));
		
		if (!isset($zo))
		{
			$valid["status"] = false;
			$valid["errors"][] = "Error with page, please refresh and try again.";
		}
		else if (isset($input["delete"]))
		{
			Zone::destroy($input["id"]);
			header( "Location: /zones" );
			exit();
		}
		else if (isset($input["save"]))
		{
			$valid = Validation::createZone($input, false);
		
			if ($valid["status"])
			{
				$zo->NAME = trim($input["name"]);
				$zo->RELAY_CHANNEL = trim($input["channel"]);
				$zo->DESCRIPTION = trim($input["desc"]);
				$zo->ACTIVE = isset($input["active"]);
				$rate = 0.0;
			
				$flowRateIDs = $zo->FlowRates->lists('ID')->toArray();
				
				if (count($flowRateIDs) <= 0) $flowRateIDs = array();
				
				for($index = 0; $index < count($input["diameter"]); $index++)
				{
					$flow = ($input["flowRatesID"][$index] == -1 ? new FlowRate() : $zo->FlowRates->find($input["flowRatesID"][$index]));
					$diam = floatval(trim($input["diameter"][$index]));
					$pressure = floatval(trim($input["pressure"][$index]));
					$quantity = floatval(trim($input["quantity"][$index]));
					$rate += ($quantity *  (28.9 * pow($diam, 2) * sqrt($pressure)));
					
					$flow->DIAMETER = $diam;
					$flow->PRESSURE = $pressure;
					$flow->QUANTITY = $quantity;
					
					$flow->ZONE = $zo->ID;
					$flow->save();
					
					if ($input["flowRatesID"][$index] != -1) $flowRateIDs = array_diff($flowRateIDs, array($input["flowRatesID"][$index]));
				}
				
				$zo->FLOW_RATE = $rate;
				$zo->save();
				
				FlowRate::destroy($flowRateIDs);
			}
		}
		
		//Zone::find($input["id"])
		$data = $this->getZoneInfo($zo);
		return view('zones.edit_zone')->with('data', $data)->with('errs', $valid);
	}
	
	private function getZoneInfo($zone)
	{
		$data = array();
		$data["id"] = $zone->ID;
		$data["name"] = $zone->NAME;
		$data["relay"] = $zone->RELAY_CHANNEL;
		$data["desc"] = $zone->DESCRIPTION;
		$data["active"] = $zone->ACTIVE;
		$data["flowRate"] = round($zone->FLOW_RATE, 4, PHP_ROUND_HALF_UP);
		$data["rates"] = array();
		
		foreach ($zone->FlowRates()->get() as $flow)
		{
			$fl = array();
			$fl["flowRatesID"] = $flow->ID;
			$fl["diameter"] = $flow->DIAMETER;
			$fl["pressure"] = $flow->PRESSURE;
			$fl["quantity"] = $flow->QUANTITY;
			$data["rates"][] = $fl;
		}
		
		return $data;
	}
    
}
