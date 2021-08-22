<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBoardRequest;
use App\Http\Requests\UpdateBoardRequest;
use App\Models\Board;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class BoardController extends Controller
{
    function __construct()
    {
        $this->authorizeResource(Board::class, 'board');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $boards = Board::all();
        return response()->json(['status' => Response::HTTP_OK, 'data' => $boards], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreBoardRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreBoardRequest $request)
    {
        $board = Board::create($request->validated());
        // Attaching board to user (Uses detected inside StoreBoardRequest)
        if($board)
            $board->users()->attach($board->user_id);

        return response()->json(['status' => Response::HTTP_OK, 'data' => $board], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  Board $board
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Board $board)
    {
        return response()->json(['status' => Response::HTTP_OK, 'data' => $board], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateBoardRequest $request
     * @param  Board $board
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateBoardRequest $request, Board $board)
    {
        if(!$board->update($request->validated()))
            return response()->json(['status' => Response::HTTP_INTERNAL_SERVER_ERROR, 'error' => 'Can\'t update data'], Response::HTTP_INTERNAL_SERVER_ERROR);

        $board = Board::find($board->id);
        return response()->json(['status' => Response::HTTP_OK, 'data' => $board], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Board $board
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Board $board)
    {
        if (!$board->delete())
            return response()->json(['status' => Response::HTTP_BAD_REQUEST, 'message' => 'Board can\'t deleted'], Response::HTTP_BAD_REQUEST);

        return response()->json(['status' => Response::HTTP_OK, 'message' => 'Board was deleted!'], Response::HTTP_OK);
    }
}
