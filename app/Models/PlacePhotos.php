<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer $place_photo_id
 * @property integer $place_id
 * @property string $url
 * @property string $created_at
 * @property string $updated_at
 * @property Place $place
 */
class PlacePhotos extends Model
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'place_photo_id';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['place_id', 'file_path', 'url', 'created_at', 'updated_at'];

    /**
     * @return BelongsTo
     */
    public function places(): BelongsTo
    {
        return $this->belongsTo(Places::class, 'place_id', 'place_id');
    }
}
