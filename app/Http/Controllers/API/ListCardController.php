<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreListCardRequest;
use App\Http\Requests\UpdateListCardRequest;

use App\Models\ListCard;
use Illuminate\Http\Response;

class ListCardController extends Controller
{
    function __construct()
    {
       $this->authorizeResource(ListCard::class, 'list_card');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $lists = ListCard::all();
        return response()->json(['status' => Response::HTTP_OK, 'data' => $lists], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreListCardRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreListCardRequest $request)
    {
        $list = ListCard::create($request->validated());

        return response()->json(['status' => Response::HTTP_OK, 'data' => $list], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  ListCard $listCard
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(ListCard $listCard)
    {
        return response()->json(['status' => Response::HTTP_OK, 'data' => $listCard], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateListCardRequest $request
     * @param  ListCard $listCard
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateListCardRequest $request, ListCard $listCard)
    {
        if(!$listCard->update($request->validated()))
            return response()->json(['status' => Response::HTTP_INTERNAL_SERVER_ERROR, 'error' => 'Can\'t update data'], Response::HTTP_INTERNAL_SERVER_ERROR);

        $list = ListCard::find($listCard->id);
        return response()->json(['status' => Response::HTTP_OK, 'data' => $list], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  ListCard $listCard
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(ListCard $listCard)
    {
        if (!$listCard->delete())
            return response()->json(['status' => Response::HTTP_BAD_REQUEST, 'message' => 'List can\'t deleted'], Response::HTTP_BAD_REQUEST);

        return response()->json(['status' => Response::HTTP_OK, 'message' => 'List was deleted!'], Response::HTTP_OK);
    }
}
