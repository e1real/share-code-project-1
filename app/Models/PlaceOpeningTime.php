<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property integer $place_opening_time_id
 * @property integer $place_id
 * @property string $open
 * @property string $close
 * @property boolean $is_closed
 * @property string $created_at
 * @property string $updated_at
 * @property Place $place
 */
class PlaceOpeningTime extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'place_opening_time';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'place_opening_time_id';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['place_id', 'open', 'close', 'is_closed', 'day_number', 'day_name', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function place(): hasOne
    {
        return $this->hasOne(Places::class, 'place_id', 'place_id');
    }

    public static function create_place_week($place_id) {
        $days_array = [
            0 => 'Monday',
            1 => 'Tuesday',
            2 => 'Wednesday',
            3 => 'Thursday',
            4 => 'Friday',
            5 => 'Saturday',
            6 => 'Sunday',
        ];
        foreach ($days_array as $dayNumber => $dayName) {
            self::query()->create([
                'place_id' => $place_id,
                'day_number' => $dayNumber,
                'day_name' => $dayName,
            ]);
        }
    }
}
