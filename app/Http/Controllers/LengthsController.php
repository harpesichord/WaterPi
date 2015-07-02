<?php namespace WaterPi\Http\Controllers;

use Request;
use Session;
use WaterPi\Http\Controllers\Controller;
use WaterPi\Http\Controllers\Validation;
use WaterPi\models\Zone;
use WaterPi\models\WateringLength;

class LengthsController extends Controller {

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
	 * Show the watering lengths to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$lengths = WateringLength::orderBy('NAME')->get();
		
		return view('lengths.view_lengths')->with('data', $lengths);
	}
    
    /**
	 * Creates a new watering length.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('lengths.create_length')->with('zones', Zone::OrderBy('NAME')->get());
	}
	
	/**
	 * Creates a new zone.
	 *
	 * @return Response
	 */
	public function add()
	{
		$input = Request::all();
		$valid = Validation::createLength($input, true);
		
		if ($valid["status"])
		{
			$le = new WateringLength();
			$le->NAME = trim($input["name"]);
			$le->ZONE = trim($input["zone"]);
			$le->LENGTH = trim($input["length"]);
			$le->DESCRIPTION = trim($input["desc"]);
			$le->save();
			
			unset($input);
			$input = array();
		}
		
		return view('lengths.create_length')->with('data', $input)->with('zones', Zone::OrderBy('NAME')->get())->with('errs', $valid);
	}
	
	/**
	 * Views a zone.
	 *
	 * @return Response
	 */
	public function viewLength($id)
	{
		$length = WateringLength::find($id)->first();
		
		if (!isset($length))
		{	
			header( "Location: /lengths" );
			exit();
		}

		
		return view('lengths.edit_length')->with('data', $length)->with('zones', Zone::OrderBy('NAME')->get());
	}
	
	/**
	 * Updates a zone.
	 *
	 * @return Response
	 */
	public function updateLength()
	{
		$input = Request::all();
		
		$le = WateringLength::find($input["id"]);
		
		if (!isset($le))
		{
			$valid["status"] = false;
			$valid["errors"][] = "Error with page, please refresh and try again.";
		}
		else if (isset($input["delete"]))
		{
			WateringLength::destroy($input["id"]);
			header( "Location: /lengths" );
			exit();
		}
		else if (isset($input["save"]))
		{
			$valid = Validation::createLength($input, false);
		
			if ($valid["status"])
			{
				$le->NAME = trim($input["name"]);
				$le->NAME = trim($input["name"]);
				$le->ZONE = trim($input["zone"]);
				$le->LENGTH = trim($input["length"]);
				$le->DESCRIPTION = trim($input["desc"]);
				$le->save();
			}
		}
		
		return view('lengths.edit_length')->with('data', WateringLength::find($input["id"]))->with('zones', Zone::OrderBy('NAME')->get())->with('errs', $valid);
	}
    
}    