<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\FindScreenRequest;
use App\Http\Requests\Api\V1\StoreScreenGroupsRequest;
use App\Models\Places;
use App\Models\ScreenGroups;
use App\Models\Screens;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScreenGroupsController extends ControllerV1
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->has('per_page')  ? (int)$request->get('per_page') : 10;
        $query = ScreenGroups::query();

        if ($perPage === -1) {
            return response()->json($query->get());
        }

        if ($request->has('name')) {
            $query->where('name', 'LIKE', "%{$request->get('name')}%");
        }

        $query->with('screens');

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
     * @param  StoreScreenGroupsRequest  $request
     * @return JsonResponse
     */
    public function store(StoreScreenGroupsRequest $request): JsonResponse
    {
        $validated = $request->validated();

        try {
            DB::beginTransaction();
            $model = ScreenGroups::query()->create($validated);

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
     * @param  \App\Models\ScreenGroups  $screenGroups
     * @return \Illuminate\Http\Response
     */
    public function show(ScreenGroups $screenGroups)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ScreenGroups  $screenGroups
     * @return \Illuminate\Http\Response
     */
    public function edit(ScreenGroups $screenGroups)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ScreenGroups  $screenGroups
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ScreenGroups $screenGroups)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ScreenGroups  $screenGroups
     * @return \Illuminate\Http\Response
     */
    public function destroy(ScreenGroups $screenGroups)
    {
        //
    }
}
