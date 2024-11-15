<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function fetchTeams()
    {
        try {
            // Fetch data from the Football Data API
            $response = Http::withHeaders([
                'X-Auth-Token' => env('FOOTBALL_API_KEY'),
            ])->get('https://api.football-data.org/v4/teams');

            if ($response->successful()) {
                $data = $response->json()['teams'] ?? []; // Adjust based on API response structure

                // Map and save data to the database
                foreach ($data as $teamData) {
                    Team::updateOrCreate(
                        ['tla' => $teamData['tla']],  // Unique identifier
                        [
                            'name' => $teamData['name'],
                            'short_name' => $teamData['shortName'] ?? null,
                            'area' => $teamData['area']['name'] ?? null,
                            'founded' => $teamData['founded'] ?? null,
                            'venue' => $teamData['venue'] ?? null,
                            'logo_url' => $teamData['crest'] ?? null,
                        ]
                    );
                }

                return response()->json(['message' => 'Teams fetched and stored successfully'], 200);
            } else {
                return response()->json(['error' => 'Failed to load teams'], $response->status());
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error loading teams: ' . $e->getMessage()], 500);
        }
    }
}
