<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaitController extends Controller
{
    public function baits()
    {
        return view('/baits/index');
    }

    public function show($id)
    {
        return view('baits.show', [
            'bait' => Bait::find($id)
        ]);
    }
}
