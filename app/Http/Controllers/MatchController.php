<?php

namespace App\Http\Controllers;

use App\Models\Fmatch;
use Illuminate\Http\Request;

class MatchController extends Controller
{
    public function index()
    {
        $matches = Fmatch::with('competition')->get();
        return response()->json($matches);
    }

    public function store(Request $request)
    {
        $match = Fmatch::create($request->all());
        return response()->json($match, 201);
    }
}
