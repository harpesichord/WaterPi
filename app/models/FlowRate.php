<?php namespace WaterPi\models;

use Illuminate\Database\Eloquent\Model;
use WaterPi\models\zone;

class FlowRate extends Model {
    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'flow_rates';
	public $primaryKey  = 'ID';
	const UPDATED_AT = 'UPDATED';
	const CREATED_AT  = 'CREATED';
	
    public function Zone()
    {
        return $this->belongsTo('WaterPi\models\Zone', 'ID', 'ZONE');
    }

    
}