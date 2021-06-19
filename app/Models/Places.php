<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\hasOne;

/**
 * @property integer $place_id
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
 */
class Places extends Model
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'place_id';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'name_de',
        'name_sk',
        'description',
        'description_de',
        'description_sk',
        'created_at',
        'updated_at',
        'opening_non_stop',
        'temporarily_closed',
    ];

    /**
     * @return belongsToMany
     */
    public function campaigns(): belongsToMany
    {
        return $this->belongsToMany(Campaigns::class);
    }

    /**
     * @return hasMany
     */
    public function screens(): hasMany
    {
        return $this->hasMany(Screens::class, 'place_id', 'place_id');
    }

    /**
     * @return hasMany
     */
    public function photos(): hasMany
    {
        return $this->hasMany(PlacePhotos::class, 'place_id', 'place_id');
    }

    /**
     * @return HasMany
     */
    public function opening_time(): HasMany
    {
        return $this->hasMany(PlaceOpeningTime::class, 'place_id', 'place_id');
    }

    /**
     * @return hasOne
     */
    public function map_data(): hasOne
    {
        return $this->hasOne(PlaceMapData::class, 'place_id', 'place_id');
    }
}
