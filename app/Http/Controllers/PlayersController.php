<?php

namespace App\Http\Controllers;
use Illuminate\Queue\RedisQueue;
use TestComp\Transformers\PlayerTransformer;
use App\Http\Controllers\ApiController;
use App\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\Paginator;


class PlayersController extends ApiController
{

    protected $playerTransformer;

    function __construct(PlayerTransformer $playerTransformer)
    {
        $this->PlayerTransformer = $playerTransformer;

        // activate basic authentication - only on posts
        $this->middleware('auth.basic',['only'=> 'post']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $limit = Input::get('limit') ?: 10;

        $player = Player::paginate($limit);

        return $this->respond([

            // transform -> method on controller
            'data' => $this->PlayerTransformer->transformCollection($player->all()), //->transformCollection($player->all())

            'paginator' => [
                'total_count'   => $player->total(),
                'total_page'    => ceil($player->total() / $player->PerPage()),
                'current_page'  => $player->currentPage(),
                'limit'         => $player->PerPage()
            ]

        ]);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // ! $request->input('id') or !
        if (! $request->input('first_name'))
        {
            // 400, 403, 422 - 400 Bad request - 403 Forbidden - 422 Unprocessable entity
            return $this->respondCreatedFailed('The parameters failed the validation for a player');
        }

        Player::create(Input::all());

        return $this->respondCreated('Your new player has been successfully created!');
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $player = Player::find($id);

        if ( ! $player)
        {
            return $this->respondNotFound('Player does not exist.');
        }

        return $this->respond([

            'data' => $this->PlayerTransformer->transform($player)

        ]);
    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }




    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
