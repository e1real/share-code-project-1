<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use App\Models\Campaigns;

class AddCampaignsDeliveryStatusList extends Migration
{
    /**
     * @var array[] $statusList - list of status delivery campaigns
     */
    public $statusList = [
        [
            "delivery_status_id" => Campaigns::NOT_DELIVERING,
            "name" => "Not delivering"
        ],
        [
            "delivery_status_id" => Campaigns::DELIVERING,
            "name" => "Delivering"
        ],
        [
            "delivery_status_id" => Campaigns::DELIVERED,
            "name" => "Delivered"
        ],
        [
            "delivery_status_id" => Campaigns::STOPPED,
            "name" => "Stopped"
        ],
        [
            "delivery_status_id" => Campaigns::IN_REVIEW,
            "name" => "In review"
        ],
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('campaigns_delivery_status')->insert($this->statusList);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('campaigns_delivery_status')->truncate();
    }
}
