<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
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
        $userAttributes = (new User)->userAttributes();
        return UserResource::collection(IndexFilter::filter($userAttributes, $query, $request));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserRequest $request
     * @return UserResource
     * @throws Exception
     */
    public function store(UserRequest $request): UserResource
    {
        $user = new User($request->all());
        if (!$user->save()) {
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
    public function show(int $id): JsonResponse|UserResource
    {
        $user = User::query()->find($id);
        if (!$user) {
            return response()->json(['error' => 'Unrecognised ID'], 400);
        }
        return UserResource::make($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     * @param int $id
     * @return UserResource
     * @throws Exception
     */
    public function update(UserRequest $request, int $id): UserResource
    {
        $user = User::query()->find($id);
        if ($user->update($request->all())) {
            $user->refresh();
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
    #[ArrayShape(['Deleted-data' => "mixed"])]
    public function destroy(int $id): array
    {
        $user = User::query()->find($id);
        if (!$user->delete()) {
            throw new Exception('Unexpected Error');
        }
        return ['Deleted-data' => $user];
    }
}
