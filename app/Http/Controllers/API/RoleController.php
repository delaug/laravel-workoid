<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required','string','max:32'],
            'description' => ['required','string','max:255'],
        ]);

        if($validator->fails()) {
            return response()->json(['status' => Response::HTTP_BAD_REQUEST, 'errors' => $validator->errors()], Response::HTTP_BAD_REQUEST);
        }

        $input = $request->all();

        $role = Role::create($input);
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
     * @param  \Illuminate\Http\Request  $request
     * @param  Role $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required','string','max:32'],
            'description' => ['required','string','max:255'],
        ]);

        if($validator->fails()) {
            return response()->json(['status' => Response::HTTP_BAD_REQUEST, 'errors' => $validator->errors()], Response::HTTP_BAD_REQUEST);
        }

        $input = $request->all();

        if(!$role->update($input))
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
            return response()->json(['status' => Response::HTTP_BAD_REQUEST, 'message' => 'Band can\'t deleted'], Response::HTTP_BAD_REQUEST);

        return response()->json(['status' => Response::HTTP_OK, 'data' => $role, 'message' => 'Band was deleted!'], Response::HTTP_OK);
    }
}
