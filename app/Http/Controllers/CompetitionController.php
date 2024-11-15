<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use Illuminate\Http\Request;

class CompetitionController extends Controller
{
    public function index()
    {
        $competitions = Competition::all();
        return response()->json($competitions);
    }

    public function show($id)
    {
        $competition = Competition::findOrFail($id);
        return response()->json($competition);
    }
}
