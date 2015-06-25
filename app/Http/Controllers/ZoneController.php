<?php namespace WaterPi\Http\Controllers;

use Request;
use Session;
use WaterPi\Http\Controllers\Controller;
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
		$data = array();
		
		return view('zones.view_zones')->with('data', $data);
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
		return view('zones.create_zone');
	}
    
}    