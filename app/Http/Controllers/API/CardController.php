<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCardRequest;
use App\Http\Requests\UpdateCardRequest;
use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CardController extends Controller
{
    function __construct()
    {
        $this->authorizeResource(Card::class, 'card');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $cards = Card::all();
        return response()->json(['status' => Response::HTTP_OK, 'data' => $cards], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreCardRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreCardRequest $request)
    {
        $card = Card::create($request->validated());

        return response()->json(['status' => Response::HTTP_OK, 'data' => $card], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  Card $card
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Card $card)
    {
        return response()->json(['status' => Response::HTTP_OK, 'data' => $card], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateCardRequest $request
     * @param  Card $card
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateCardRequest $request, Card $card)
    {
        if(!$card->update($request->validated()))
            return response()->json(['status' => Response::HTTP_INTERNAL_SERVER_ERROR, 'error' => 'Can\'t update data'], Response::HTTP_INTERNAL_SERVER_ERROR);

        $card = Card::find($card->id);
        return response()->json(['status' => Response::HTTP_OK, 'data' => $card], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Card $card
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Card $card)
    {
        if (!$card->delete())
            return response()->json(['status' => Response::HTTP_BAD_REQUEST, 'message' => 'Card can\'t deleted'], Response::HTTP_BAD_REQUEST);

        return response()->json(['status' => Response::HTTP_OK, 'message' => 'List was deleted!'], Response::HTTP_OK);
    }
}
