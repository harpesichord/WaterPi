<?php namespace WaterPi\models;

use Illuminate\Database\Eloquent\Model;

class WateringLength extends Model {
    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'watering_lengths';
	public $primaryKey  = 'ID';
	const UPDATED_AT = 'UPDATED';
	const CREATED_AT  = 'CREATED';
	
	public function Zone()
	{
		return $this->belongsTo('WaterPi\models\Zone', 'ZONE', 'ID');
	}
    
}