<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfilerLangRequest;
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
        $langAttributes = (new profilerLang)->langAttributes();
        return profilerLangResource::collection(IndexFilter::filter($langAttributes, $query, $request));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProfilerLangRequest $request
     * @return profilerLangResource
     * @throws Exception
     */
    public function store(ProfilerLangRequest $request): profilerLangResource
    {
        $lang = new profilerLang($request->all());
        if (!$lang->save()) {
            throw new Exception('Unexpected Error');
        }
        return new profilerLangResource($lang);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse|profilerLangResource
     */
    public function show(int $id): JsonResponse|profilerLangResource
    {
        $lang = profilerLang::query()->find($id);
        if (!$lang) {
            return response()->json(['error' => 'Unrecognised ID'], 400);
        }
        return profilerLangResource::make($lang);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProfilerLangRequest $request
     * @param int $id
     * @return profilerLangResource
     * @throws Exception
     */
    public function update(ProfilerLangRequest $request, int $id): profilerLangResource
    {
        $lang = profilerLang::query()->find($id);
        if (!$lang->update($request->all())) {
            throw new Exception('Unexpected Error');
        }
        $lang->refresh();
        return new profilerLangResource($lang);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return array
     * @throws Exception
     */
    #[ArrayShape(['Deleted-data' => "mixed"])]
    public function destroy(int $id): array
    {
        $lang = profilerLang::query()->find($id);
        if (!$lang->delete()) {
            throw new Exception('Unexpected Error');
        }
        return ['Deleted-data' => $lang];
    }
}
