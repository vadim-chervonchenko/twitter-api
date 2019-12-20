<?php

namespace App\Http\Controllers;

use App\Http\Requests\TweetRequest;
use App\Models\Hashtag;
use App\Models\Tweet;
use App\Models\User;
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
             return Hashtag::where('name', $request->input('hashtag'))
                            ->firstOrFail()
                            ->tweets()
                            ->with('author:id,name')
                            ->get();

        } else if ( $request->input('mentions') ) {
            return User::where('name', $request->input('mentions'))
                         ->firstOrFail()
                         ->mentions()
                         ->with('author:id,name')
                         ->get();
        } else {
            return Tweet::with('author:id,name')
                        ->orderByDesc('id')
                        ->get();
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
        $tweet = $request
            ->user()
            ->tweets()
            ->create($request->post())
            ->loadMissing('author:id,name');

        $tweet->hashtags()->attach($this->findHashtag($request->input('content')));
        $tweet->mentions()->attach($this->findMention($request->input('content')));

        return $tweet;
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

    public function findHashtag($content) {
        $result = [];
        preg_match_all('/#(\w+)/', $content, $matches);
        foreach ($matches[1] as $hashtagName) {
            $hashtag = Hashtag::firstOrCreate(['name'=>$hashtagName]);
            $result[]=$hashtag->id;
        }
        return $result;
    }

    public function findMention($content) {
        $result = [];
        preg_match_all("/@(\w\S+)/", $content, $matches);
        foreach ($matches[1] as $userName) {
            $user = User::where('name', '=', $userName)->first();
            if ($user) {
                $result[] = $user->id;;
            }
        }
        return $result;
    }
}
