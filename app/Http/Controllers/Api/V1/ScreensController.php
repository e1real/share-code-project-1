<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\StoreScreenRequest;
use App\Models\Places;
use App\Models\ScreenGroups;
use App\Models\Screens;
use Illuminate\Http\Request;
use App\Http\Requests\Api\V1\FindScreenRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class ScreensController extends ControllerV1
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->has('per_page') ? (int)$request->get('per_page') : 10;
        $query = Screens::query();
        
        if ($request->has('status')) {
            $query->where('status', $request->get('status'));
        }

        if ($request->has('place')) {
            $query->where('place_id', $request->get('place'));
        }

        if ($request->has('group')) {
            $query->where('screen_group_id', $request->get('group'));
        }

        $query->with('place');
        $query->with('screen_group');

        return response()->json($query->paginate($perPage));
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
     * @param  StoreScreenRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreScreenRequest $request): JsonResponse
    {
        $validated = $request->validated();

        try {
            DB::beginTransaction();
            $model = Screens::query()->create($validated);

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
     * @param  Screens  $screen
     * @return JsonResponse
     */
    public function show(Screens $screen): JsonResponse
    {
        return response()->json($screen);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Screens  $screens
     * @return \Illuminate\Http\Response
     */
    public function edit(Screens $screens)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Screens  $screens
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Screens $screens)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Screens  $screens
     * @return \Illuminate\Http\Response
     */
    public function destroy(Screens $screens)
    {
        //
    }

    /**
     * Find screen by name
     *
     * @param  FindScreenRequest  $request
     * @return JsonResponse
     */
    public function find_screen(FindScreenRequest $request): JsonResponse
    {
        $q = $request->get('q');
        $response = [];

        $screens = Screens::query()
            ->where('name', 'like', '%' . $q . '%')
            ->get();
        $screens->map(function ($item) {
            $item['id'] = $item['screen_id'];
            $item['type'] = 'screens';
            return $item;
        });
        if ($screens->first()) {
            $response = array_merge($response, $screens->toArray());
        }

        $screenGroups = ScreenGroups::query()
            ->where('name', 'like', '%' . $q . '%')
            ->with('screens')
            ->get();
        $screenGroups->map(function ($item) {
            $item['id'] = $item['screen_group_id'];
            $item['type'] = 'screen_groups';
            return $item;
        });
        if ($screenGroups->first()) {
            $response = array_merge($response, $screenGroups->toArray());
        }

        $places = Places::query()
            ->where('name', 'like', '%' . $q . '%')
            ->with('screens')
            ->get();
        $places->map(function ($item) {
            $item['id'] = $item['place_id'];
            $item['type'] = 'places';
            return $item;
        });
        if ($places->first()) {
            $response = array_merge($response, $places->toArray());
        }


        return response()->json($response);
    }
}
