<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfilerLang;
use App\Http\Requests\UpdateProfilerLang;
use App\Http\Resources\profilerLangResource;
use App\Models\ProfilerLang;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use JetBrains\PhpStorm\ArrayShape;
use Mosquitto\Exception;

class ProfilerLangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = profilerLang::query();
        $langAttributes = (new profilerLang)->attributesToArray();
        return profilerLangResource::collection(IndexFilter::filter($langAttributes, $query, $request));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreprofilerLang $request
     * @return profilerLangResource
     * @throws Exception
     */
    public function store(StoreprofilerLang $request): profilerLangResource
    {
        $lang = profilerLang::create($request->all());
        if ($lang) {
            return new profilerLangResource($lang);
        }
        throw new Exception('Unexpected Error');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse|profilerLangResource
     */
    public function show($id): JsonResponse|profilerLangResource
    {
        $lang = profilerLang::find($id);
        if (!$lang) {
            return response()->json(['error' => 'Unrecognised ID'], 400);
        }
        return profilerLangResource::make($lang);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateprofilerLang $request
     * @param int $id
     * @return profilerLangResource
     * @throws Exception
     */
    public function update(UpdateprofilerLang $request, $id): profilerLangResource
    {
        $lang = profilerLang::find($id);
        if ($lang->update($request->all())) {
            $lang->flash();
            return new profilerLangResource($lang);
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
        $lang = profilerLang::find($id);
        if ($lang->delete()) {
            return ['Deleted-data' => $lang];
        }
        throw new Exception('Unexpected Error');
    }
}
