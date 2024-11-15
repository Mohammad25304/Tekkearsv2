<?php

namespace App\Http\Controllers;

use App\Models\Scorer;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class ScorerController extends Controller
{
    public function fetchScorers()
    {
        try {
            // Define cache key and duration
            $cacheKey = 'scorers_data';
            $cacheDuration = 60; // Cache duration in minutes

            // Check if data is cached
            $scorersData = Cache::get($cacheKey);

            if (!$scorersData) {
                // Fetch data from the API
                $response = Http::withHeaders([
                    'X-Auth-Token' => env('FOOTBALL_API_KEY'),
                ])->get('https://api.football-data.org/v4/scorers'); // Adjust endpoint if needed

                if ($response->successful()) {
                    $scorersData = $response->json()['scorers'] ?? []; // Adjust based on API response structure
                    Cache::put($cacheKey, $scorersData, $cacheDuration);
                } else {
                    return response()->json(['error' => 'Failed to load scorers'], $response->status());
                }
            }

            // Save scorers data to the database
            foreach ($scorersData as $scorerData) {
                Scorer::updateOrCreate(
                    ['name' => $scorerData['name']], // Unique identifier like name or API ID if available
                    [
                        'team' => $scorerData['team']['name'] ?? null,
                        'goals' => $scorerData['goals'] ?? 0,
                        'position' => $scorerData['position'] ?? null,
                        'assists' => $scorerData['assists'] ?? null,
                        'birthdate' => $scorerData['birthdate'] ?? null,
                        'nationality' => $scorerData['nationality'] ?? null,
                    ]
                );
            }

            return response()->json(['message' => 'Scorers fetched and stored successfully'], 200);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Error fetching scorers: ' . $e->getMessage()], 500);
        }
    }
}
