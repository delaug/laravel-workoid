<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Role;
use Illuminate\Http\Response;

class RoleController extends Controller
{
    function __construct()
    {
        $this->authorizeResource(Role::class, 'role');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $roles = Role::all();
        return response()->json(['status' => Response::HTTP_OK, 'data' => $roles], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRoleRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRoleRequest $request)
    {
        $role = Role::create($request->validated());
        return response()->json(['status' => Response::HTTP_OK, 'data' => $role], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  Role $role
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Role $role)
    {
        return response()->json(['status' => Response::HTTP_OK, 'data' => $role], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRoleRequest $request
     * @param  Role $role
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        if(!$role->update($request->validated()))
            return response()->json(['status' => Response::HTTP_INTERNAL_SERVER_ERROR, 'error' => 'Can\'t update data'], Response::HTTP_INTERNAL_SERVER_ERROR);

        $role = Role::find($role->id);
        return response()->json(['status' => Response::HTTP_OK, 'data' => $role], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Role $role
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Role $role)
    {
        if (!$role->delete())
            return response()->json(['status' => Response::HTTP_BAD_REQUEST, 'message' => 'Role can\'t deleted'], Response::HTTP_BAD_REQUEST);

        return response()->json(['status' => Response::HTTP_OK, 'message' => 'Role was deleted!'], Response::HTTP_OK);
    }
}
