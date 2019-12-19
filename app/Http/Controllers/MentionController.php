<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MentionController extends Controller
{
    public function index() {
        return User::pluck('name');
    }

    public function search( Request $request) {
        return 'mention search : '. $request->input('mention');
    }
}
