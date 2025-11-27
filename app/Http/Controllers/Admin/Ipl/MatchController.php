<?php

namespace App\Http\Controllers\Admin\Ipl;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Auth;
use DataTables;
use App\Models\Ipl\SportMatch;
use App\Models\Ipl\MatchScore;

class MatchController extends Controller {

    public function __construct() {
        
    }

    public function index() {
        return view('Admin.Ipl.matched');
    }

    public function getMatchData() {

        $data = SportMatch::select('id', 'system_id', 'name', 'match_type', 'status', 'venue', 'date', 'datetime_gmt',
        'team1', 'team2', 'toss_winner', 'toss_choice', 'fantasy_enabled', 'bbb_enabled', 'has_squad', 'match_started', 'match_ended')
            ->orderByRaw("
            CASE 
                WHEN match_started = 1 AND match_ended = 0 THEN 1
                WHEN match_started = 0 AND match_ended = 0 THEN 2
                WHEN match_started = 1 AND match_ended = 1 THEN 3
                ELSE 4
            END
        ")
        ->orderBy('id', 'asc');

        return DataTables::of($data)
                            ->editColumn('date', function ($data) {
                                return date("d-m-Y", strtotime($data->date)); // Format: 12-Mar-2024
                            })
                            ->addColumn('match_status', function($data) {
                                if($data->match_started === 0 && $data->match_ended === 0){
                                    return '<span class="badge bg-grey-400">UPCOMMING</span>';
                                }elseif($data->match_started === 1 && $data->match_ended === 0){
                                    return '<span class="badge bg-success-400">LIVE</span>';
                                }elseif($data->match_started === 1 && $data->match_ended === 1){
                                    return '<span class="badge bg-blue">COMPLETE</span>';
                                }else{
                                   return '<span class="badge bg-danger">NA</span>';
                                }
                                
                            })
                            ->addColumn('action', function($data) {
                                return '<a class="font-size-16" href="' . route('admin.match.edit', ['id' => base64_encode($data->id)]) . '"  title="Update Score"><i class="icon-pencil7"></i></a>
                                <a class="update_recode font-size-16" data-value = "' . route('admin.match.storeMatchInfo', ['match_id' => $data->id, 'system_id' => $data->system_id]) . '" title = "Store Match Data"><i class="icon-reload-alt"></i></a>';
                            })
                            ->rawColumns(['action','match_status'])
                            ->addIndexColumn()
                            ->toJson();
    }

    public function edit($id, Request $request)
    {
        $id = base64_decode($id);
        $update = SportMatch::with('scores')->where('id', $id)->first();

        if ($request->isMethod('post')) {

            $update->status = $request->status;
            $update->toss_winner = $request->toss_winner;
            $update->toss_choice = $request->toss_choice;
            $update->fantasy_enabled = $request->fantasy_enabled;
            $update->bbb_enabled = $request->bbb_enabled;
            $update->has_squad = $request->has_squad;
            $update->match_started = $request->match_started;
            $update->match_ended = $request->match_ended;
            $update->save();
            

            if(isset($request->first_inning) && $request->first_inning == 1){
                MatchScore::updateOrCreate(
                    ['match_id' => $id, 'id' => $request->first_inning_id],
                    [
                        'inning' => $request->first_inning_name,
                        'runs' => $request->first_inning_runs,
                        'wickets' => $request->first_inning_wickets,
                        'overs' => $request->first_inning_overs,
                    ]
                ); 
            }

            if(isset($request->second_inning) && $request->second_inning == 2){
                MatchScore::updateOrCreate(
                    ['match_id' => $id, 'id' => $request->second_inning_id],
                    [
                        'inning' => $request->second_inning_name,
                        'runs' => $request->second_inning_runs,
                        'wickets' => $request->second_inning_wickets,
                        'overs' => $request->second_inning_overs,
                    ]
                ); 
            }

            if ($update) {
                return redirect()->route('admin.match.index')->with('success', 'Match is successfully updated');
            } else {
                return redirect()->route('admin.match.index')->with('error', 'something went wrong.');
            }
        }

        return view('Admin/Ipl/update_score',['update' => $update]);
    }

    public function storeMatchInfo($match_id,$system_id)
    {
        // Fetch match info from the API using the provided match_id
        $response = Http::get('https://api.cricapi.com/v1/match_info', [
            'apikey' => config('cricketapi.apikey'),
            'id' => $system_id // Use the dynamic match_id instead of hardcoding
        ]);

        // Check if the API call was successful and data exists
        if ($response->successful() && isset($response->json()['data'])) {
            $data = $response->json()['data'];

            // Find the existing match by ID
            $match = SportMatch::find($match_id);

            // If the match exists, update it; otherwise, return an error
            if ($match) {
                $match->update([
                    // 'name' => $data['name'],
                    // 'match_type' => $data['matchType'],
                    'status' => $data['status'],
                    // 'venue' => $data['venue'],
                    // 'date' => $data['date'],
                    // 'datetime_gmt' => $data['dateTimeGMT'],
                    // 'team1' => $data['teams'][0],
                    // 'team2' => $data['teams'][1],
                    'toss_winner' => !empty($data['tossWinner']) ? $data['tossWinner'] : NULL,
                    'toss_choice' => !empty($data['tossChoice']) ? $data['tossChoice'] : NULL,
                    'fantasy_enabled' => !empty($data['fantasyEnabled']) ? $data['fantasyEnabled'] : 0,
                    'bbb_enabled' => !empty($data['bbbEnabled']) ? $data['bbbEnabled'] : 0,
                    'has_squad' => !empty($data['hasSquad']) ? $data['hasSquad'] : 0,
                    'match_started' => !empty($data['matchStarted']) ? $data['matchStarted'] : 0,
                    'match_ended' => !empty($data['matchEnded']) ? $data['matchEnded'] : 0,
                ]);

                // Update or create scores for the match
                if (isset($data['score']) && is_array($data['score']) && !empty($data['score'])) {
                    foreach ($data['score'] as $scoreData) {
                        MatchScore::updateOrCreate(
                            ['match_id' => $match->id, 'inning' => $scoreData['inning']],
                            [
                                'runs' => $scoreData['r'],
                                'wickets' => $scoreData['w'],
                                'overs' => $scoreData['o'],
                            ]
                        );
                    }
                }

                return response()->json(['message' => 'Match info updated successfully']);
            } else {
                return response()->json(['message' => 'Match not found'], 404);
            }
        } else {
            return response()->json(['message' => 'Failed to fetch match info from API'], 500);
        }
    }
}
