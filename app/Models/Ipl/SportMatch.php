<?php

namespace App\Models\Ipl;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SportMatch extends Model {

    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sport_matches';

    protected $fillable = ['system_id', 'sport_series_id', 'name', 'match_type', 'status', 'venue', 'date', 'datetime_gmt', 'ipl_team_1_id', 'team1', 'ipl_team_2_id', 'team2', 'toss_winner', 'toss_choice', 'match_winner', 'fantasy_enabled', 'bbb_enabled', 'has_squad', 'match_started', 'match_ended', 'match_status'];

    function scores(){
        return $this->hasMany('App\Models\Ipl\MatchScore', 'match_id', 'id');
    }

    function firstteam(){
        return $this->hasOne('App\Models\Ipl\Team', 'id', 'ipl_team_1_id');
    }

    function secondteam(){
        return $this->hasOne('App\Models\Ipl\Team', 'id', 'ipl_team_2_id');
    }
    
}