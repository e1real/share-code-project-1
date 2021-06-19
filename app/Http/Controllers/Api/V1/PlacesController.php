<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\FindScreenRequest;
use App\Http\Requests\Api\V1\StorePlaceRequest;
use App\Http\Requests\Api\V1\UpdatePlaceRequest;
use App\Models\PlaceMapData;
use App\Models\PlaceOpeningTime;
use App\Models\PlacePhotos;
use App\Models\Places;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PlacesController extends ControllerV1
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->has('per_page') ? (int)$request->get('per_page') : 10;

        if ($perPage === -1) {
            $models = Places::all();
        }
        if ($perPage !== -1) {
            $models = Places::query()->with('photos')->paginate($perPage);
        }

        return response()->json($models);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return JsonResponse
     */
    public function store(StorePlaceRequest $request): JsonResponse
    {
        $validated = $request->validated();

        try {
            DB::beginTransaction();
            $model = Places::query()->create(['name' => $validated['name']]);

            PlaceMapData::query()->create([
                'place_id' => $model->place_id,
                'address' => $validated['address'],
                'lat' => $validated['lat'],
                'lon' => $validated['lon'],
            ]);
            // create places opening time
            PlaceOpeningTime::create_place_week($model->place_id);
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
     * @param \App\Models\Places $place
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Places $place): JsonResponse
    {
        return response()->json([
            'place' => $place,
            'photos' => $place->photos()->get(),
            'map_data' => $place->map_data()->first(),
            'place_opening_time' => $place->opening_time()->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Places $places
     * @return \Illuminate\Http\Response
     */
    public function edit(Places $places)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StorePlaceRequest $request
     * @param Places $place
     * @return JsonResponse
     */
    public function update(UpdatePlaceRequest $request, Places $place): JsonResponse
    {
        $validated = $request->validated();

        $place->update($validated['place']);
        $mapData = $place->map_data();
        $mapData->update($validated['map_data']);

        $photoIds = $place->photos()->get()->map(function ($item) {
            return $item->place_photo_id;
        })->toArray();

        foreach ($validated['photos'] as $photo) {
            if ($photoIds && in_array($photo['place_photo_id'], $photoIds)) {
                continue;
            }
            $photoModel = PlacePhotos::query()->find($photo['place_photo_id']);
            $photoModel->place_id = $place->place_id;
            $photoModel->save();
        }

        $placeMap = PlaceMapData::query()->find($validated['map_data']['place_map_data_id']);
        $placeMap->update($validated['map_data']);

        $placeOpeningTime = $place->opening_time()->get();

        foreach ($placeOpeningTime as $placeTime) {
            foreach ($validated['place_opening_time'] as $item) {
                if ($placeTime->place_opening_time_id === $item['place_opening_time_id']) {
                    if ($item['open'] && $item['close']) {
                        $item['open'] = Carbon::parse($item['open'])->format('Y-m-d H:i:s');
                        $item['close'] = Carbon::parse($item['close'])->format('Y-m-d H:i:s');
                    }
                    $placeTime->update($item);
                }
            }
        }


        return response()->json($place, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Places $places
     * @return \Illuminate\Http\Response
     */
    public function destroy(Places $places)
    {
        //
    }

    /**
     * Find screen by name
     *
     * @param FindScreenRequest $request
     * @return JsonResponse
     */
    public function find_screen(FindScreenRequest $request): JsonResponse
    {
        $q = $request->get('q');
        $places = Places::query()->select(['place_id as id', 'name'])->where('name', 'like', '%' . $q . '%')->get();

        return response()->json($places);
    }
}
