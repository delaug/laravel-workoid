<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Response;

class UserController extends Controller
{
    function __construct()
    {
        $this->authorizeResource(User::class, 'subject');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $users = User::all();
        return response()->json(['status' => Response::HTTP_OK, 'data' => $users], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreUserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);
        // Attaching role to user
        if($user)
            $user->roles()->attach(Role::IS_USER);

        return response()->json(['status' => Response::HTTP_OK, 'data' => $user], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  User $subject
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(User $subject)
    {
        return response()->json(['status' => Response::HTTP_OK, 'data' => $subject], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateUserRequest $request
     * @param  User $subject
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateUserRequest $request, User $subject)
    {
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);

        if(!$subject->update($data))
            return response()->json(['status' => Response::HTTP_INTERNAL_SERVER_ERROR, 'error' => 'Can\'t update data'], Response::HTTP_INTERNAL_SERVER_ERROR);

        $subject = User::find($subject->id);
        return response()->json(['status' => Response::HTTP_OK, 'data' => $subject], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User $subject
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(User $subject)
    {
        if (!$subject->delete())
            return response()->json(['status' => Response::HTTP_BAD_REQUEST, 'message' => 'User can\'t deleted'], Response::HTTP_BAD_REQUEST);

        return response()->json(['status' => Response::HTTP_OK, 'message' => 'User was deleted!'], Response::HTTP_OK);
    }
}
