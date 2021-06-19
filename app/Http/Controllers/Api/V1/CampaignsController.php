<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Campaigns;
use App\Models\CampaignsDeliveryStatus;
use App\Models\Places;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Api\V1\StoreCampaignRequest;
use Illuminate\Support\Facades\DB;

class CampaignsController extends ControllerV1
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->has('per_page') ? (int)$request->get('per_page') : 10;

        $query = Campaigns::query()
            ->join('campaigns_delivery_status', 'campaigns.delivery_status_id', '=', 'campaigns_delivery_status.delivery_status_id')
            ->select(['campaigns.*', 'campaigns_delivery_status.name as delivery_status_name'])
            ->with('media');

        if ($request->has('status')) {
            $query->where('campaigns.delivery_status_id', $request->get('status'));
        }

        if ($request->has('name')) {
            $query->where('campaigns.name', 'LIKE', "%{$request->get('name')}%");
        }

        $start_date = $request->has('start_date') ? Carbon::parse($request->get('start_date')) : null;
        $end_date = $request->has('end_date') ? Carbon::parse($request->get('end_date')) : null;

        if ($start_date && $end_date) {
            $query->where([['campaigns.start_date', '<=', $start_date], ['campaigns.end_date', '>=', $end_date]])
                ->orwhereBetween('campaigns.start_date', array($start_date, $end_date))
                ->orWhereBetween('campaigns.end_date', array($start_date, $end_date));
        } else if ($start_date) {
            $query->whereDate('campaigns.start_date', '>=', $start_date);
        } else if ($end_date) {
            $query->whereDate('campaigns.end_date', '<=', $end_date);
        }

        return response()->json($query->paginate($perPage));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCampaignRequest $request
     * @return JsonResponse
     */
    public function store(StoreCampaignRequest $request): JsonResponse
    {
        $validated = $request->validated();

        try {
            DB::beginTransaction();

            $model = Campaigns::query()->create($validated);
            $model->screens()->attach($validated['screens']);
            $model->screen_groups()->attach($validated['screen_groups']);
            $model->places()->attach($validated['places']);

            DB::commit();
            return response()->json($model, 201);
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json($exception->getMessage(), 401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Campaigns $campaign
     * @return \Illuminate\Http\Response
     */
    public function show(Campaigns $campaign): JsonResponse
    {
        $response = $campaign->toArray();
        $response['places'] = $campaign->places()
            ->with('screens')
            ->get()
            ->map(function ($item) {
                $item['type'] = 'places';
                return $item;
            })
            ->toArray();
        $response['screens'] = $campaign->screens()
            ->get()
            ->map(function ($item) {
                $item['type'] = 'screens';
                return $item;
            })
            ->toArray();
        $response['screen_groups'] = $campaign->screen_groups()
            ->with('screens')
            ->get()
            ->map(function ($item) {
                $item['type'] = 'screen_groups';
                return $item;
            })
            ->toArray();

        return response()->json($response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Campaigns $campaigns
     * @return \Illuminate\Http\Response
     */
    public function edit(Campaigns $campaigns)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreCampaignRequest $request
     * @param \App\Models\Campaigns $campaign
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCampaignRequest $request, Campaigns $campaign): JsonResponse
    {
        $validated = $request->validated();

        $campaign->update($validated);

        $campaign->screens()->sync($validated['screens']);
        $campaign->screen_groups()->sync($validated['screen_groups']);
        $campaign->places()->sync($validated['places']);

        return response()->json($campaign, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Campaigns $campaigns
     * @return \Illuminate\Http\Response
     */
    public function destroy(Campaigns $campaigns)
    {
        //
    }

    /**
     * Display a listing of the campaign delivery status.
     *
     * @return JsonResponse
     */
    public function delivery_statuses(): JsonResponse
    {
        $models = CampaignsDeliveryStatus::all();

        return response()->json($models);
    }
}
