<?php

namespace App\Http\Controllers\Admin\Ipl;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Auth;
use DataTables;
use App\Models\Ipl\Team;

class TeamController extends Controller {

    public function __construct() {
        
    }

    public function index() {
        return view('Admin.Ipl.teams');
    }

    public function getTeamData() {

        $data = Team::select('id', 'year', 'en_teamname', 'shortname', 'matches', 'wins', 'loss', 'ties', 'nr', 'pts', 'nrr')
                ->orderBy('year', 'desc')
                ->orderBy('pts','desc') // Highest points first
                 ->orderByRaw("COALESCE(CAST(NULLIF(nrr, '0') AS DECIMAL(10,3)), -9999) DESC")
                 //->orderBy('pts', 'desc')
                //->orderByRaw("CASTPillarsCAST(REPLACE(nrr, ' ', '') AS DECIMAL(10,3)) DESC")
                ->orderBy('matches', 'desc');

        return DataTables::of($data)
                        ->addColumn('action', function($data) {
                            return '<a class="ajaxviewmodel font-size-16" href="' . route('admin.ipl.edit', ['id' => base64_encode($data->id)]) . '"  title="Update"><i class="icon-pencil7"></i></a>';
                        })
                        ->rawColumns(['action'])
                        ->addIndexColumn()
                        ->toJson();
    }
    
    public function edit($id, Request $request) {
        
        $id = base64_decode($id);
        $update = Team::where('id', $id)->first();

        if ($request->isMethod('post')) {

            $update->matches = $request->matches;
            $update->wins = $request->wins;
            $update->loss = $request->loss;
            $update->ties = $request->ties;
            $update->nr = $request->nr;
            $update->pts = $request->pts;
            $update->nrr = $request->nrr;
            $update->save();
            if ($update) {
                return redirect()->route('admin.ipl.index')->with('success', 'Team is successfully updated');
            } else {
                return redirect()->route('admin.ipl.index')->with('error', 'something went wrong.');
            }
        }

        return view('Admin/Ipl/edit',['update' => $update]);
    }

    public function storeTeams(Request $request) {
        $response = Http::get('https://api.cricapi.com/v1/series_points', [
            'apikey' => config('cricketapi.apikey'),
            'id' => config('cricketapi.teams_series_id')
        ]);

        if ($response->successful()) {
            $data = $response->json();
            if ($data['status'] == 'success' && isset($data['data'])) {
                foreach ($data['data'] as $team) {
                    Team::updateOrCreate(
                        ['shortname' => $team['shortname']],
                        [
                            // 'en_teamname' => $team['teamname'],
                            // 'img' => $team['img'],
                            'matches' => $team['matches'],
                            'wins' => $team['wins'],
                            'loss' => $team['loss'],
                            'ties' => $team['ties'],
                            'nr' => $team['nr']
                        ]
                    );
                }
                return response()->json(['success' => true, 'message' => 'Teams saved successfully.']);
            }
        }
        return response()->json(['success' => false, 'message' => 'Failed to fetch data.'], 500);
    }

}
