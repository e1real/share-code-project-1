<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\StoreMediaRequest;
use App\Models\Campaigns;
use App\Models\Media;
use App\Models\MediaProperty;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mhor\MediaInfo\MediaInfo;


class MediaController extends ControllerV1
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = Media::all();

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
     * @param  StoreMediaRequest  $request
     * @return JsonResponse
     */
    public function store(StoreMediaRequest $request): JsonResponse
    {
        $validated = $request->validated();

        try {
            DB::beginTransaction();
            $mediaFile = $request->file('media');
            $mediaFilePath = $mediaFile->store('media');

            $mediaFileFullPath = storage_path('app') . '/' . $mediaFilePath;
            $mediaInfo = MediaProperty::getMediaMetaData( $mediaFileFullPath);

//            $model = Media::query()->create([
//                'title' => $mediaFile->getClientOriginalName(),
//                'file_name' => $mediaFilePath,
//                'file_path' => $mediaFilePath,
//                'file_type' => $mediaFile->getExtension(),
//            ]);

            DB::commit();
            return response()->json($mediaInfo, 201);
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json($exception->getMessage(), 401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function show(Media $media)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function edit(Media $media)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Media $media)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function destroy(Media $media)
    {
        //
    }
}
