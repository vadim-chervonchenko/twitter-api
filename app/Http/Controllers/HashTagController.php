<?php

namespace App\Http\Controllers;
use App\Models\Hashtag;

class HashTagController extends Controller
{
    public function index() {
        return Hashtag::orderBy('name', 'asc')
                      ->pluck('name');
    }

    public function search($name) {
        return Hashtag::where('name', 'like', $name.'%')
                      ->orderBy('name', 'asc')
                      ->get();
    }
}
