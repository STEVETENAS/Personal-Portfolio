<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfilerInfo;
use App\Http\Requests\UpdateProfilerInfo;
use App\Http\Resources\profilerInfoResource;
use App\Models\ProfilerInfo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use JetBrains\PhpStorm\ArrayShape;
use Mosquitto\Exception;

class ProfilerInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = profilerInfo::query();
        $infoAttributes = (new profilerInfo)->attributesToArray();
        return profilerInfoResource::collection(IndexFilter::filter($infoAttributes, $query, $request));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProfilerInfo $request
     * @return profilerInfoResource
     * @throws Exception
     */
    public function store(StoreprofilerInfo $request): profilerInfoResource
    {
        $input = $request->all();

        if ($request->hasFile('profiler_image')) {
            $profilerImageName = $request->file('profiler_image')->getClientOriginalName();
            [$width, $height] = getimagesize($request->file('profiler_image'));
            $date = date('Y-m-d');
            $id = uniqid('', true);
            $profilerImagePath = "images/profiler_images/{$date}-{$profilerImageName}-{$id}-{$width}-{$height}";
            $input['profiler_image'] = $request->file('profiler_image')->store($profilerImagePath);
        }

        if ($request->hasFile('background_image')) {
            $bgImageName = $request->file('background_image')->getClientOriginalName();
            [$width, $height] = getimagesize($request->file('background_image'));
            $date = date('Y-m-d');
            $id = uniqid('', true);
            $bgImagePath = "images/bg_images/{$date}-{$bgImageName}-{$id}-{$width}-{$height}";
            $input['background_image'] = $request->file('background_image')->store($bgImagePath);
        }


        $info = profilerInfo::create($input);
        if ($info) {
            return new profilerInfoResource($info);
        }
        throw new Exception('Unexpected Error');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse|profilerInfoResource
     */
    public function show($id): JsonResponse|profilerInfoResource
    {
        $info = profilerInfo::find($id);
        if (!$info) {
            return response()->json(['error' => 'Unrecognised ID'], 400);
        }
        return profilerInfoResource::make($info);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateprofilerInfo $request
     * @param int $id
     * @return profilerInfoResource
     * @throws Exception
     */
    public function update(UpdateprofilerInfo $request, $id): profilerInfoResource
    {
        $input = $request->all();
        if ($request->hasFile('profiler_image')) {
            $profilerImageName = $request->file('profiler_image')->getClientOriginalName();
            [$width, $height] = getimagesize($request->file('profiler_image'));
            $date = date('Y-m-d');
            $id = uniqid('', true);
            $profilerImagePath = "images/profiler_images/{$date}-{$profilerImageName}-{$id}-{$width}-{$height}";
            $input['profiler_image'] = $request->file('profiler_image')->store($profilerImagePath);
        }

        if ($request->hasFile('background_image')) {
            $bgImageName = $request->file('background_image')->getClientOriginalName();
            [$width, $height] = getimagesize($request->file('background_image'));
            $date = date('Y-m-d');
            $id = uniqid('', true);
            $bgImagePath = "images/bg_images/{$date}-{$bgImageName}-{$id}-{$width}-{$height}";
            $input['background_image'] = $request->file('background_image')->store($bgImagePath);
        }

        $info = profilerInfo::find($id);
        if ($info->update($request->all())) {
            $info->flash();
            return new profilerInfoResource($input);
        }
        throw new Exception('Unexpected Error');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return array
     * @throws Exception
     */
    #[ArrayShape(['data' => "mixed"])]
    public function destroy($id): array
    {
        $info = profilerInfo::find($id);
        if ($info->delete()) {
            return ['Deleted-data' => $info->id];
        }
        throw new Exception('Unexpected Error');
    }
}
