<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer $campaign_id
 * @property string $name
 * @property string $client_name
 * @property integer $status
 * @property string $start_date
 * @property string $end_date
 * @property string $created_at
 * @property string $updated_at
 */
class Campaigns extends Model
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'campaign_id';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';


    /**
     * @var array
     */
    protected $fillable = ['delivery_status_id', 'name', 'client_name', 'is_active', 'start_date', 'end_date', 'impressions_frequency', 'created_at', 'updated_at'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'start_date' => 'date:m/d/Y',
        'end_date' => 'date:m/d/Y',
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
    ];

    /**
     * Delivery status - Not delivering
     *
     * @var string
     */
    public const NOT_DELIVERING = 1;

    /**
     * Delivery status - Delivering
     *
     * @var string
     */
    public const DELIVERING = 2;

    /**
     * Delivery status - Delivered
     *
     * @var string
     */
    public const DELIVERED = 3;

    /**
     * Delivery status - Stopped
     *
     * @var string
     */
    public const STOPPED = 4;

    /**
     * Delivery status - In review
     *
     * @var string
     */
    public const IN_REVIEW = 5;

    /**
     * @return BelongsTo
     */
    public function deliveryStatus(): BelongsTo
    {
        return $this->belongsTo('App\CampaignsDeliveryStatus', 'delivery_status_id', 'delivery_status_id');
    }

    /**
     * @return BelongsToMany
     */
    public function screens(): BelongsToMany
    {
        return $this->belongsToMany(Screens::class, 'campaign_m2m_screens', 'campaign_id', 'screen_id')
            ->withTimestamps();
    }

    /**
     * @return BelongsToMany
     */
    public function screen_groups(): BelongsToMany
    {
        return $this->belongsToMany(ScreenGroups::class, 'campaign_m2m_groups', 'campaign_id', 'screen_group_id')
            ->withTimestamps();
    }

    /**
     * @return BelongsToMany
     */
    public function places(): BelongsToMany
    {
        return $this->belongsToMany(Places::class, 'campaign_m2m_places', 'campaign_id', 'place_id')
            ->withTimestamps();
    }

    /**
     * @return BelongsToMany
     */
    public function media(): BelongsToMany
    {
        return $this->belongsToMany(Media::class, 'campaign_m2m_media', 'campaign_id', 'media_id')
            ->withTimestamps();
    }
}
