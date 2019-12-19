<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HashTagController extends Controller
{
    public function index() {
        return 'hashtag index';
    }

    public function search( Request $request) {
        return 'hashtag search : '. $request->input('hashtag');
    }
}
