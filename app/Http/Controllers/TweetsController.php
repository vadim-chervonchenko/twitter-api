<?php

namespace App\Http\Controllers;

use App\Http\Requests\TweetRequest;
use App\Models\Tweet;
use Illuminate\Http\Request;

class TweetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ( $request->input('hashtag') ) {

            return $request->input('hashtag');

        } else if ( $request->input('mention') ) {

            return $request->input('mention');

        } else {
            return Tweet::with('author:id,name')
                ->orderByDesc('id')
                ->paginate(7);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TweetRequest $request)
    {
        return $request
            ->user()
            ->tweets()
            ->create($request->post())
            ->loadMissing('author:id,name');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Tweet::findOrFail($id);
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
        Tweet::findOrFail($id)
            ->update($request->all());

        return Tweet::findOrFail($id)
            ->loadMissing('author:id,name');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        Tweet::findOrFail($id)->delete();
        return response()->json(['message' => 'Post deleted']);
    }
}
