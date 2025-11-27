<?php

namespace App\Models\Ipl;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SportSeries extends Model {

    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sport_series';

    protected $fillable = ['system_id', 'name', 'start_date', 'end_date', 'odi', 't20', 'test', 'squads', 'matches'];
    
}
