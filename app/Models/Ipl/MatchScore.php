<?php

namespace App\Models\Ipl;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MatchScore extends Model {

    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'match_scores';

    protected $fillable = ['match_id', 'runs', 'wickets', 'overs', 'inning'];
    
}
