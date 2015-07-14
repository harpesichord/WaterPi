<?php namespace WaterPi\models;

use Illuminate\Database\Eloquent\Model;
use WaterPi\models\FlowRate;

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
	
    public function FlowRates()
    {
        return $this->hasMany('WaterPi\models\FlowRate', 'ZONE', 'ID');
    }

    
    public function WateringLengths()
	{
		return $this->hasMany('WaterPi\models\WateringLength', 'ID', 'ZONE');
	}
}