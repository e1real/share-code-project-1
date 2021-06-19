<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property integer $media_id
 * @property string $title
 * @property string $file_name
 * @property string $file_path
 * @property string $file_type
 * @property string $created_at
 * @property string $updated_at
 * @property MediaProperty[] $mediaProperties
 */
class Media extends Model
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'media_id';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['title', 'file_name', 'file_path', 'file_type', 'created_at', 'updated_at'];


    /**
     * @return HasOne
     */
    public function properties(): HasOne
    {
        return $this->hasOne(MediaProperty::class, 'media_id', 'media_id');
    }

    /**
     * Generate
     */
}
