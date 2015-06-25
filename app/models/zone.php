<?php namespace WaterPi\models;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model {
    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'zone';
	public $primaryKey  = 'ID';
	const UPDATED_AT = 'UPDATED';
	const CREATED_AT  = 'CREATED';
    
}