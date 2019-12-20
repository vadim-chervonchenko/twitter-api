<?php

namespace App\Http\Controllers;

use App\Models\User;

class MentionController extends Controller
{
    public function index() {
        return User::pluck('name');
    }

    public function search($name) {
        return User::where('name', 'like', $name.'%')
                   ->orderBy('name', 'asc')
                   ->pluck('name');
    }
}
