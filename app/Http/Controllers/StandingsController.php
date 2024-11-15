<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class StandingsController extends Controller
{
    public function viewStandingsFromApi($competitionId)
    {
        try {
            // Send request to the Football Data API to get standings
            $response = Http::withHeaders([
                'X-Auth-Token' => env('FOOTBALL_API_KEY'),
            ])->get("https://api.football-data.org/v4/competitions/{$competitionId}/standings");

            // Check if the response is successful
            if ($response->successful()) {
                return response()->json($response->json(), 200);
            } else {
                return response()->json([
                    'error' => 'Failed to load standings',
                    'status' => $response->status(),
                    'message' => $response->body()
                ], $response->status());
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error fetching standings: ' . $e->getMessage()], 500);
        }
    }
}
