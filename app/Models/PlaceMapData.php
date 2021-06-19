<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property integer $place_map_data_id
 * @property integer $place_id
 * @property Place $place
 */
class PlaceMapData extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'place_map_data';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'place_map_data_id';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * Disable timestamps
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['place_id', 'address', 'lat', 'lon'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function place(): hasOne
    {
        return $this->hasOne(Places::class, 'place_id', 'place_id');
    }
}
