<?php

namespace App\Traits;

use App\Models\Blog;
use App\Models\Category;
use App\Models\FooterCategory;
use Illuminate\Support\Facades\DB;
use App\Models\Ipl\Team;
use App\Models\Ipl\SportMatch;
use Carbon\Carbon;

trait CricketTrait
{
    public function getPointTable()
    {

        return Team::select('shortname', 'img', 'matches', 'wins', 'loss', 'nr', 'pts', 'nrr')
                ->orderBy('pts', 'desc') // Highest points first
                ->orderByRaw("COALESCE(CAST(NULLIF(nrr, '0') AS DECIMAL(10,3)), -9999) DESC") // Treat '0' or null as lowest
                ->orderBy('matches', 'desc') // More matches as tiebreaker
                ->limit(3)
                ->get();
    }

    public function getMatchCard()
    {
        $now = Carbon::now('UTC'); // Current time in UTC
        $today = Carbon::today('UTC'); // Start of today in UTC

        // Fetch the most relevant match for today (live or earliest upcoming)
        $match = SportMatch::with(['scores' => function ($query) {
                $query->select('match_id', 'inning', 'runs', 'wickets', 'overs')->whereNull('deleted_at')->orderBy('id', 'desc');
            },'firstteam:id,img','secondteam:id,img'])
            ->select('id', 'name', 'status', 'ipl_team_1_id', 'team1', 'ipl_team_2_id', 'team2', 'datetime_gmt', 'match_started', 'match_ended')
            ->whereDate('datetime_gmt', $today)
            ->where(function ($query) use ($now) {
                // Prioritize live match
                $query->where(function ($q) {
                    $q->where('match_started', 1)
                      ->where('match_ended', 0);
                })
                // If no live match, get upcoming
                ->orWhere(function ($q) use ($now) {
                    $q->where('match_started', 0)
                      ->where('datetime_gmt', '>=', $now);
                });
            })
            ->orderBy('match_started', 'desc') // Live (1) before upcoming (0)
            ->orderBy('datetime_gmt', 'asc') // Earliest first
            ->first(); // Get only one record

        if (!$match) {
            $match = SportMatch::with(['scores' => function ($query) {
                    $query->select('match_id', 'inning', 'runs', 'wickets', 'overs')
                            ->whereNull('deleted_at')
                            ->orderBy('id', 'desc');
                }, 'firstteam:id,img', 'secondteam:id,img'])
                ->select('id', 'name', 'status', 'ipl_team_1_id', 'team1', 'ipl_team_2_id', 'team2', 'datetime_gmt', 'match_started', 'match_ended')
                ->where('match_ended', 1) // Completed matches only
                ->orderBy('datetime_gmt', 'desc') // Most recent first
                ->first();
        }
        return $match;
    }
    
}

