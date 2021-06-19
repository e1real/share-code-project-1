<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\StorePlacePhotosRequest;
use App\Models\PlacePhotos;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PlacePhotosController extends ControllerV1
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  StorePlacePhotosRequest  $request
     * @return JsonResponse
     */
    public function store(StorePlacePhotosRequest $request): JsonResponse
    {
        $request->validated();

        try {
            DB::beginTransaction();

            $file_path = $request
                ->file('photo')
                ->store('/place-photos/', 'public');

            $model = PlacePhotos::query()->create([
                'file_path' => $file_path,
                'place_id' => $request->get('place_id'),
                'url' => Storage::url($file_path),
            ]);

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
     * @param  \App\Models\PlacePhotos  $placePhotos
     * @return \Illuminate\Http\Response
     */
    public function show(PlacePhotos $placePhotos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PlacePhotos  $placePhotos
     * @return \Illuminate\Http\Response
     */
    public function edit(PlacePhotos $placePhotos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PlacePhotos  $placePhotos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PlacePhotos $placePhotos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PlacePhotos  $placePhotos
     * @return \Illuminate\Http\Response
     */
    public function destroy(PlacePhotos $placePhoto): JsonResponse
    {
        $placePhoto->delete();
        return response()->json();
    }
}
