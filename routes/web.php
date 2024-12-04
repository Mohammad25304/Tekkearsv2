<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
use App\Http\Controllers\CompetitionController;
use App\Http\Controllers\FootballDataController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\ScorerController;
use App\Http\Controllers\StandingsController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\AuthController;
//for competition
Route::get('/competitions', [CompetitionController::class, 'index']);
Route::get('/competitions/{id}', [CompetitionController::class, 'show']);
Route::get('/api/save-competitions', [FootballDataController::class, 'saveCompetitions']);


//for matches
Route::get('/matches', [MatchController::class, 'index']);
Route::post('/matches', [MatchController::class, 'store']);

//for teams
Route::get('/fetch-teams', [TeamController::class, 'fetchTeams']);

//for players
Route::get('/fetch-players', [PlayerController::class, 'fetchPlayers']);

//for scorers
Route::get('/fetch-scorers', [ScorerController::class, 'fetchScorers']);

//for standing
Route::get('/api-standings/{competitionId}', [StandingsController::class, 'viewStandingsFromApi']);
















Route::get('/', function () {
    return view('welcome');



});
