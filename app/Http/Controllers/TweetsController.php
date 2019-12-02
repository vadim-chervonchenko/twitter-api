<?php

namespace App\Http\Controllers;

use App\Http\Requests\TweetRequest;
use App\Models\Tweet;
use Tymon\JWTAuth\Facades\JWTAuth;

class TweetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Tweet::with('user:id,name')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TweetRequest $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $tweet = Tweet::create( ['content' => $request['content'], 'user_id' => $user->id ] );
        return Tweet::with('user:id,name')->where('id', $tweet->id)->first();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Tweet::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TweetRequest $request, $id)
    {
        $tweet = Tweet::findOrFail($id);
        $tweet->update($request->all());

        return $tweet;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $tweet = Tweet::findOrFail($id);
        $tweet->delete();

        return 233;
    }
}
