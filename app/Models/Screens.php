<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\hasOne;
use Illuminate\Database\Eloquent\Relations\belongsToMany;

/**
 * @property integer $screen_id
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
 */
class Screens extends Model
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'screen_id';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['name', 'created_at', 'place_id', 'screen_group_id', 'updated_at'];

    /**
     * @return belongsToMany
     */
    public function campaigns(): belongsToMany
    {
        return $this->belongsToMany(Campaigns::class);
    }

    /**
     * @return hasOne
     */
    public function place(): hasOne
    {
        return $this->hasOne(Places::class, 'place_id', 'place_id');
    }

    /**
     * @return hasOne
     */
    public function screen_group(): hasOne
    {
        return $this->hasOne(ScreenGroups::class, 'screen_group_id', 'screen_group_id');
    }
}
