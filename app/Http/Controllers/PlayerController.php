<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function fetchPlayers()
    {
        try {
            // Define the cache key and duration (e.g., 60 minutes)
            $cacheKey = 'players_data';
            $cacheDuration = 60; // Cache for 1 hour

            // Check if the players data is already in the cache
            $playersData = Cache::get($cacheKey);

            // If no cached data, fetch from API and store in cache
            if (!$playersData) {
                // Fetch data from the Football Data API
                $response = Http::withHeaders([
                    'X-Auth-Token' => env('FOOTBALL_API_KEY'),
                ])->get('https://api.football-data.org/v4/players');

                if ($response->successful()) {
                    $playersData = $response->json()['players'] ?? []; // Adjust based on API response structure

                    // Cache the data for the specified duration
                    Cache::put($cacheKey, $playersData, $cacheDuration);
                } else {
                    return response()->json(['error' => 'Failed to load players'], $response->status());
                }
            }

            // Map and save data to the database
            foreach ($playersData as $playerData) {
                Player::updateOrCreate(
                    ['name' => $playerData['name']], // Unique identifier (could be ID if available)
                    [
                        'team' => $playerData['team']['name'] ?? null,
                        'position' => $playerData['position'] ?? null,
                        'jersey_number' => $playerData['shirtNumber'] ?? null,
                        'birthdate' => $playerData['dateOfBirth'] ?? null,
                        'nationality' => $playerData['nationality'] ?? null,
                    ]
                );
            }

            return response()->json(['message' => 'Players fetched and stored successfully'], 200);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Error fetching players: ' . $e->getMessage()], 500);
        }
    }
}
