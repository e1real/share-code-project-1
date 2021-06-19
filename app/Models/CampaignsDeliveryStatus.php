<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $delivery_status_id
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
 * @property Campaigns[] $campaigns
 */
class CampaignsDeliveryStatus extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'campaigns_delivery_status';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'delivery_status_id';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['name', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function campaigns()
    {
        return $this->hasMany('AppModels\Campaign', 'delivery_status_id', 'delivery_status_id');
    }
}
