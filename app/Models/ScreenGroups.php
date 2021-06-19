<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property integer $screen_group_id
 * @property string $name
 * @property integer $default_price
 * @property string $created_at
 * @property string $updated_at
 */
class ScreenGroups extends Model
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'screen_group_id';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['name', 'created_at', 'default_price', 'description', 'updated_at'];

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
        return $this->hasMany(Screens::class, 'screen_group_id', 'screen_group_id');
    }


}
