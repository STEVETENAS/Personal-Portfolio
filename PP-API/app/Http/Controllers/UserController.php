<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUser;
use App\Http\Requests\UpdateUser;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use JetBrains\PhpStorm\ArrayShape;
use Mosquitto\Exception;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = User::query();
        $userAttributes = (new User)->attributesToArray();
        return UserResource::collection(IndexFilter::filter($userAttributes, $query, $request));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUser $request
     * @return UserResource
     * @throws Exception
     */
    public function store(StoreUser $request): UserResource
    {
        $user = User::create($request->all());
        if ($user) {
            return new UserResource($user);
        }
        throw new Exception('Unexpected Error');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse|UserResource
     */
    public function show($id): JsonResponse|UserResource
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'Unrecognised ID'], 400);
        }
        return UserResource::make($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUser $request
     * @param int $id
     * @return UserResource
     * @throws Exception
     */
    public function update(UpdateUser $request, $id): UserResource
    {
        $user = User::find($id);
        if ($user->update($request->all())) {
            $user->flash();
            return new UserResource($user);
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
        $user = User::find($id);
        if ($user->delete()) {
            return ['Deleted-data' => $user->id];
        }
        throw new Exception('Unexpected Error');
    }
}
