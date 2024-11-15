<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use App\Models\Competition;

class FootballDataController extends Controller
{
    private $apiUrl = 'https://api.football-data.org/v4/competitions';



public function saveCompetitions()
{
    // Retrieve data from the Football Data API
    $response = Http::withHeaders([
        'X-Auth-Token' => env('FOOTBALL_API_KEY'),
    ])->get($this->apiUrl);

    if ($response->successful()) {
        $competitionsData = $response->json()['competitions'];

        foreach ($competitionsData as $data) {
            Competition::updateOrCreate(
                ['code' => $data['code']], // Match unique identifier
                [
                    'name' => $data['name'],
                    'country' => $data['area']['name'] ?? null,
                    'season_start' => $data['currentSeason']['startDate'] ?? null,
                    'season_end' => $data['currentSeason']['endDate'] ?? null,
                    'logo_url' => $data['emblem'] ?? null,
                ]
            );
        }

        return response()->json(['message' => 'Competitions saved successfully']);
    } else {
        return response()->json(['error' => 'Unable to fetch data'], $response->status());
    }
}

}
