<?php

namespace App\Http\Controllers;
use Illuminate\Queue\RedisQueue;
use TestComp\Transformers\PlayerTransformer;
use App\Http\Controllers\ApiController;
use App\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;


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
        $player = Player::all();

        return $this->respond([

            // transform -> method on controller
            'data' => $this->PlayerTransformer->transformCollection($player->all()) //->transformCollection($player->all())

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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if (! $request->input('id') or ! $request->input('player_first_name'))
        {
            // 400, 403, 422 - 400 Bad request - 403 Forbidden - 422 Unprocessable entity
            return $this->setStatusCode(422)
                ->respondWithError('Parameters failed the validation for a player');
        }

/*        $player = new Player;
        $player->first_name = $request->first_name;
        $player->last_name = $request->last_name;
        $player->DOB = $request->DOB;
        $player->nationality = $request->nationality;
        $player->position = $request->position;
        $player->market_value = $request->market_value;
        $player->is_test = $request->is_test;*/

        //$player->save();


/*        $player = Player::create($request->all());

        $player->save();*/

        Player::create(Input::all());

        return $this->setStatusCode(201)->respond([
           'message' => 'Player successfully created.'
        ]);

        //first_name', 'last_name', 'DOB', 'nationality', 'position', 'market_value'


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
