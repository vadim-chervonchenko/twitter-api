<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MentionController extends Controller
{
    public function index() {
        return 'mention index';
    }

    public function search( Request $request) {
        return 'mention search : '. $request->input('mention');
    }
}
